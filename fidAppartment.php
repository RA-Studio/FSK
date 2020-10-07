<?
$_SERVER['DOCUMENT_ROOT'] = realpath( dirname(__FILE__) );
$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];


$options = getopt("", array("LOAD_IMG::"));

if($options['LOAD_IMG'] == "Y") {
    ignore_user_abort(true);
    set_time_limit(0);
    $_GET['LOAD_IMG'] = "Y";
}


define('NO_KEEP_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS', true);
define('BX_NO_ACCELERATOR_RESET', true);
define('CHK_EVENT', true);

require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');



//$message = "Проверка крона";
//$message = wordwrap($message, 70, "\r\n");
//mail('ikapustin@ra-studio.ru', 'CRON', $message);

//if($options['LOAD_IMG'] == "Y") {
//    RaStudio\Api\LoggerAdapter::add("Начало выгрузки большого фида");
//    $_GET['LOAD_IMG'] = "Y";
//} else {
//    RaStudio\Api\LoggerAdapter::add("Начало выгрузки");
//}



$arResult = [];
$arResultSection = [];
$arResultSectionIn = [];
$arResultElementIn = [];
$iblockID = 1;



class fidAppartmentParse {
    private $sectionController;
    private $elementController;
    private $iblockID;
    public $apartments;
    public $allSectionInSite;
    private $allElementInSite;
    public $arResult;
    public $loadData;
    private $type;
    private $statistic;

    private $arrayItem = [
        "commercial-type" => [
            "auto repair" => "автосервис",
            "business" => "готовый бизнес",
            "free purpose" => "Свободное",
            "hotel" => "гостиница",
            "land" => "земли коммерческого назначения",
            "legal address" => "юридический адрес",
            "manufacturing" => "производственное помещение",
            "office" => "офисные помещения",
            "public catering" => "общепит",
            "retail" => "торговые помещения",
            "warehouse" => "склад",
        ]
    ];

    public function __construct($iblockID, $file, $type = false) {

        //RaStudio\Api\LoggerAdapter::add("Инициализация обмена");

        CModule::IncludeModule('iblock');
        $this->sectionController = new CIBlockSection;
        $this->elementController = new CIBlockElement;
        $this->iblockID = $iblockID;
        $this->apartments = \RaStudio\XmlParser::xmlToArray($file);
        //$this->apartments = $this->apartments['offer'];

        $this->type = $type;
        $this->getAllSectionInIBLOCK();
        $this->getAllElementInIBLOCK();
        $this->loadData = false;
        $this->statistic = [
            "UPDATAELEMENT"   => 0,
            "ACTIVATEELEMENT" => 0,
            "UPDATASECTION"   => 0,
            "ADDELEMENT"      => 0,
            "ADDSECTION"      => 0,
            "DELETEEMENT"     => 0,
            "DELETESECTION"   => 0,
            "ERROR"           => "",
        ];
    }

    private function getAllSectionInIBLOCK() {
        $arFilter = array('IBLOCK_ID' => $this->iblockID, "DEPTH_LEVEL" => 1);
        $rsSections = CIBlockSection::GetList(array(), $arFilter,false, array("ID","NAME","XML_ID"));
        while ($arSection = $rsSections->Fetch()) {
            $this->allSectionInSite[$arSection['XML_ID']] = [
                "NAME" => $arSection['NAME'],
                "ID" => $arSection['ID'],
            ];
        }
    }
    private function getAllElementInIBLOCK() {
        $arFilter = array('IBLOCK_ID' => $this->iblockID);
        if($this->type !== false && !empty($this->type)) {
            $arFilter['SECTION_CODE'] = $this->type;
            $arFilter['INCLUDE_SUBSECTIONS'] = true;
        }
        $rsElements = CIBlockElement::GetList(array(), $arFilter,false, false, array("ID","NAME","XML_ID","CODE","ACTIVE", "PROPERTY_image"));
        while ($arElement = $rsElements->Fetch()) {
            $this->allElementInSite[$arElement['CODE']] = [
                "NAME" => $arElement['NAME'],
                "ID" => $arElement['ID'],
                "ACTIVE" => $arElement['ACTIVE'],
                "img" => $arElement['PROPERTY_IMAGE_VALUE']
            ];
        }
    }
    private function addInnerSection($id,$paramsFilter = []) {
        $arFields = Array(
            "ACTIVE" => "Y",
            "IBLOCK_SECTION_ID" => $this->allSectionInSite[$id]['ID'],
            "IBLOCK_ID" => $this->iblockID,
        );
        foreach($paramsFilter as $key => $value) {
            $arFields[$key] = $value;
        }
        $ID = $this->sectionController->Add($arFields);
        $res = ($ID>0);
        if(!$res) {
            $this->statistic['ERROR'] .= $this->sectionController->LAST_ERROR."\n";
        } else {
            return $ID;
        }
    }

    private function getIDInnerSection($buildingID,$code = false) {
        if($code === false) return false;
        $arFilter = Array(
            'IBLOCK_ID' => $this->iblockID,
            "SECTION_ID" => $this->allSectionInSite[$buildingID],
            "CODE" => $code,
        );
        $rsSections = \CIBlockSection::GetList(array(), $arFilter, false, array("ID", "NAME", "XML_ID", "IBLOCK_ID"));
        while ($arSection = $rsSections->Fetch()) {
            return $arSection['ID'];
        }
        return false;
    }

    private function getRoomNameByCount($count,$area){
        switch ($count) {
            case 0: $name = "Студия, $area"; break;
            case 1: $name = "1-комнатная, $area"; break;
            case 2: $name = "2-комнатная, $area"; break;
            case 3: $name = "3-комнатная, $area"; break;
            case 4: $name = "4-комнатная, $area"; break;
            case 5: $name = "5-комнатная, $area"; break;
        }
        return $name;
    }
    public function generateArrayApartment ($arrayParamInner,$sectionInnerInAdd) {
        $arResultSection = [];
        $apartment = [];
        foreach($this->apartments as $key => $value) {
            $apartment[$value['internal-id']] = $value;
        }
        foreach($apartment as $key => $value) {

            if($this->type === 'parking' && $value['category'] != "garage" ) continue;
            if($this->type === 'apartment' && $value['category'] != "flat" ) continue;
            if($this->type === 'commercial' && $value['category'] != "commercial" ) continue;
            if($this->type === 'storeroom' && $value['category'] != "storeroom" ) continue;

            $buildingID = $value['yandex-building-id'];
            $val = false;
            if(!$arResultSection[$buildingID]) {
                if(!$this->allSectionInSite[$buildingID]) {
                    $codeSection = \RaStudio\Helper::transliterate($value['building-name']);
                    $arFields = Array(
                        "ACTIVE" => "Y",
                        "IBLOCK_ID" => $this->iblockID,
                        "CODE" => $codeSection,
                        "NAME" => $value['building-name'],
                        "XML_ID" => $buildingID,
                        //"DESCRIPTION" => $value['description'],
                    );
                    $this->statistic['ADDSECTION']++;
                    $ID = $this->sectionController->Add($arFields);
                    $res = ( $ID > 0 );
                    if(!$res) {
                        echo $this->sectionController->LAST_ERROR."\n";
                    } else {
                        $val = $this->addInnerSection($ID,$arrayParamInner);
                    }
                } else {
                    $val = $this->getIDInnerSection($buildingID,$sectionInnerInAdd);
                    if($val === false) {
                        $val = $this->addInnerSection($buildingID, $arrayParamInner);
                    }
                }
                $arResultSection[$buildingID]["NAME"] = $value['building-name'];
            }
            if($val) {
                $value['sectionAddID'] = $val;
            }
            $this->arResult[$buildingID][$value['internal-id']] = $value;

        }
    }

    public function addApartment(){
        global $USER;
        foreach ($this->arResult as $keyS => $building) {
            $addSection = false;
            $elem = current($building);
            if($elem['sectionAddID']) {
                $addSection = $elem['sectionAddID'];
            }
            if($addSection === false) {
                $this->statistic['ERROR'] .= "Нет раздела для добавления"."<br>";
                continue;
            }
            foreach ($building as $keyA => $apartment) {
                $property = [];
                $area = "";

                $ID = $this->allElementInSite[$apartment['internal-id']]["ID"];
                $ACTIVE = $this->allElementInSite[$apartment['internal-id']]['ACTIVE'];
                $imgOld = $this->allElementInSite[$apartment['internal-id']]['img'];

                if($apartment['area']['value']) {
                    $area = $apartment['area']['value'];
                }

                if( $apartment['studio'] == "true") {
                    $apartment['rooms'] = 0;
                }

                if( $apartment['building-state'] == "hand-over" || ($apartment['built-year'] < date('Y')) ) {
                    $apartment['built-year'] = "Cдан";
                }
                if($apartment['commercial-type']) {
                    $apartment['commercial-type'] = $this->arrayItem["commercial-type"][$apartment['commercial-type']];
                }



                foreach ($apartment as $key => $value) {
                    $imgKey = $key;
                    $key = preg_replace( "/[^a-zA-ZА-Яа-я0-9\s]/", '', $key );
                    if(is_array($value)) {
                        //echo($imgKey);
                        if(!$value['value']) $value['value'] = '';
                        if($value['value'] || $value['value'] === ''){

                            if($key == "price" || $key == "price100") {

                                $temp = number_format($value['value'],0,'',' ');
                                $temp = explode(" ", $temp);

                                if($key == "price") $property["priceshort"] = $temp[0].".".$temp[1][0].$temp[1][1];
                                if($key == "price100") $property["price100short"] = $temp[0].".".$temp[1][0].$temp[1][1];

                            }
                            if ($key == 'priceGrant100'){
                                $property["priceGrant100exceptions"] = json_encode($value['exceptions']);
                            }
                            $property[$key] = $value['value'];
                        }
                    } else {
                        if( strpos($imgKey, 'image') !== false ) {

                            $field = explode("|", $imgKey)[1];

                            if($_GET["LOAD_IMG"] == "Y") {
                                $ch = curl_init();
                                curl_setopt($ch, CURLOPT_POST, 0);
                                curl_setopt($ch, CURLOPT_PORT , 443);
                                curl_setopt($ch, CURLOPT_VERBOSE, 0);
                                curl_setopt($ch,CURLOPT_URL, $value);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                                $result=curl_exec($ch);
                                curl_close($ch);
                                $link = $_SERVER['DOCUMENT_ROOT'].'/imgload/temp'.$ID.$field.'img.png';
                                file_put_contents($link,$result);
                                $arFile = CFile::MakeFileArray($link);
                                $property['image'][] = array("VALUE" => $arFile, "DESCRIPTION" => $field);
                            }

                        } else {
                            $property[$key] = $value;
                        }

                    }
                }


                if($apartment['category'] == "storeroom") {
                    $buildName = $apartment['building-name'];
                    $name = "Кладовая в ЖК «".$buildName. "», ".$area;
                    $property['category'] = "storeroom";
                    echo($name);
                } else if($apartment['category'] == "garage") {
                    $buildName = $apartment['building-name'];
                    $name = "ПРК в ЖК «".$buildName. "», ".$area;
                    $property['category'] = "parking";
                } else if($apartment['category'] == "commercial") {
                    $buildName = $apartment['building-name'];
                    $name = "ПСН в ЖК «".$buildName. "», ".$area;
                } else {
                    $name = $this->getRoomNameByCount($apartment['rooms'],$area);
                }



                //if($apartment['category'] != "garage") {
                    if($ID) {
                        if($ACTIVE == "N")  $this->statistic['ACTIVATEELEMENT']++;
                        $this->elementController->Update($ID, array(
                                'ACTIVE' => 'Y',
                                "NAME" => $name,
                            )
                        );
                        $this->statistic['UPDATAELEMENT']++;
                        $this->allElementInSite[$apartment['internal-id']]["UPDATE"] = "Y";
                        CIBlockElement::SetPropertyValuesEx($ID, $this->iblockID, $property);
                    } else {
                        $arLoadProductArray = Array(
                            "MODIFIED_BY"    => $USER->GetID(),
                            "IBLOCK_SECTION_ID" => $addSection,
                            "IBLOCK_ID"      => $this->iblockID,
                            "PROPERTY_VALUES"=> $property,
                            "NAME"           => $name,
                            "ACTIVE"         => "Y",
                            "CODE"           => $apartment['internal-id'],
                            "XML_ID"         => $apartment['internal-id'],
                        );
                        if($PRODUCT_ID = $this->elementController->Add($arLoadProductArray)) {
                            $this->statistic['ADDELEMENT']++;
                            echo "New ID: ".$PRODUCT_ID;
                        } else {
                            $this->statistic['ERROR'] .= $this->elementController->LAST_ERROR."<br>";
                        }
                    }
                //}

            }
        }
        $this->deactivationNotIncludeElement();
    }

    public function deactivationNotIncludeElement() {
        $property["ACTIVE"] = "Y";
        foreach ($this->allElementInSite as $key => $element) {
            if($element['UPDATE'] != "Y" && $element['ACTIVE'] == "Y") {
                $this->statistic['DELETEEMENT']++;
                $this->elementController->Update($element['ID'],array('ACTIVE' => 'N'));
            }
        }
    }
    public function mailSend($data) {


        if($_GET["LOAD_IMG"] == "Y") {
            $to = 'ikapustin@ra-studio.ru, rnet2005@gmail.com, ran@ra-studio.ru'; // обратите внимание на запятую
            $to .= ", y.zavislyak@fsknw.ru";
            $subject = 'Данные об окончании обновлении фида';
            $message = $data;
            $headers[]  = 'MIME-Version: 1.0';
            $headers[]  = 'Content-type: text/html; charset=UTF-8';
            $headers[] = 'From: FSK_fid_Data <fsknw@example.com>';
            mail($to, $subject, $message, implode("\r\n", $headers));
        }


    }
    public function printStatistic() {
        $type = $this->type;
        $updateelement = $this->statistic['UPDATAELEMENT'];
        $activateelement = $this->statistic['ACTIVATEELEMENT'];
        $updatesection = $this->statistic['UPDATASECTION'];
        $addelement    = $this->statistic['ADDELEMENT'];
        $addsection    = $this->statistic['ADDSECTION'];
        $deleteelement = $this->statistic['DELETEEMENT'];
        $deletesection = $this->statistic['DELETESECTION'];
        $error         = $this->statistic['ERROR'];
        $bigFid = $_GET['LOAD_IMG'];
//        RaStudio\Api\LoggerAdapter::add("```Информация по обновлению $type```<br>
//            *Обновлено элементов* `$updateelement` <br>
//            *Обновлено секций* `$updatesection`<br>
//            *Активированные элементы* `$activateelement`<br>
//            *Добавно элементов* `$addelement`<br>
//            *Добавно ЖК* `$addsection`<br>
//            *Удалено элементов* `$deleteelement`<br>
//            *Удалено ЖК* `$deletesection`<br>
//            *Ошибки*: `$error`
//            *Большой фид*: `$bigFid`
//            "
//        );

        self::mailSend("```Информация по обновлению $type```<br>
        *Обновлено элементов* `$updateelement` <br>
        *Обновлено секций* `$updatesection`<br>
        *Активированные элементы* `$activateelement`<br>
        *Добавно элементов* `$addelement`<br>
        *Добавно ЖК* `$addsection`<br>
        *Удалено элементов* `$deleteelement`<br>
        *Удалено ЖК* `$deletesection`<br>
        *Ошибки*: `$error`"
    );

    }
}
//if(false) {
    /***********************************************************************************************/
    $homepage = "https://terminal.scloud.ru/03/sc81501_base07/hs/FSK_API/siteIntegration/newflat";
    $arElementApartmentAll = [];
    $parserApartment = new fidAppartmentParse(1, $homepage, "storeroom");
    $parserApartment->generateArrayApartment([
        "NAME" => "Кладовки",
        "CODE" => "storeroom",
    ], "storeroom");
    $parserApartment->addApartment();
    $parserApartment->printStatistic();
    /***********************************************************************************************/
    $homepage = "https://terminal.scloud.ru/03/sc81501_base07/hs/FSK_API/siteIntegration/newflat";
    $arElementApartmentAll = [];
    $parserApartment = new fidAppartmentParse(1, $homepage, "parking");
    $parserApartment->generateArrayApartment([
        "NAME" => "Паркинг",
        "CODE" => "parking",
    ],"parking");
    $parserApartment->addApartment();
    $parserApartment->printStatistic();
    /**********************************************************************************************/
    $homepage = "https://terminal.scloud.ru/03/sc81501_base07/hs/FSK_API/siteIntegration/newflat";
    $arElementApartmentAll = [];
    $parserApartment = new fidAppartmentParse(1, $homepage, "apartment");
    $parserApartment->generateArrayApartment([
        "NAME" => "Квартиры",
        "CODE" => "apartment",
    ],"apartment");
    $parserApartment->addApartment();
    $parserApartment->printStatistic();
    /**********************************************************************************************/
    $arElementСommercialAll = [];
    $homepage = "https://terminal.scloud.ru/03/sc81501_base07/hs/FSK_API/siteIntegration/commercial";
    $parserСommercial = new fidAppartmentParse(1, $homepage, "commercial");
    $parserСommercial->generateArrayApartment([
        "NAME" => "Комерческие помещения",
        "CODE" => "commercial",
    ],"commercial");
    $parserСommercial->addApartment();
    $parserСommercial->printStatistic();
    /*************************************************************************************************/
//}

?>
