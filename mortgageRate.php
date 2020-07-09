<?
$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];

define('NO_KEEP_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS', true);
define('BX_NO_ACCELERATOR_RESET', true);
define('CHK_EVENT', true);

require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

class mortgageRateParse {
    private $elementController;
    private $iblockID;
    private $allElementInSite;
    public $arResult;
    public $xmlData;

    public function __construct($iblockID, $file) {
        CModule::IncludeModule('iblock');
        $this->elementController = new CIBlockElement;
        $this->iblockID = $iblockID;
        $this->xmlData = $this->xmlToArray($file);
        $this->getAllIBElem();
        $this->updateMortgage();
        $this->deactivationNotIncludeElement();
    }
    
    public function xmlToArray ($file) {
        exec("wget -O - '$file'", $lines);
        $remote = implode("", $lines);
        $xmlFile = $_SERVER['DOCUMENT_ROOT'].'/mortgage.xml';
        file_put_contents($xmlFile, $remote);
       
        return (array)simplexml_load_file($xmlFile);
    }
    public function getAllIBElem ($iblockID = false) {
        $arFilter = array('IBLOCK_TYPE'=>'kompleks', 'IBLOCK_ID' => $iblockID?:$this->iblockID);
        $arSelect = Array("ID","IBLOCK_ID","NAME","XML_ID","CODE","ACTIVE","PROPERTY_*");
        $rsElements = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
        while ($arElement = $rsElements->GetNextElement()) {
            $arFields = $arElement->GetFields();
            $arProps = $arElement->GetProperties();
            $this->allElementInSite[$arFields['CODE']] = [
                "NAME" => $arFields['NAME'],
                "ID" => $arFields['ID'],
                "ACTIVE" => $arFields['ACTIVE'],
                "PROPERTIES" => $arProps
            ];
        }
    }
    public function addNewMortgage ($mortgage = false) {
        $date = $mortgage['bank']['license']['date'];
        $newDate = new DateTime($date);

        $mortProps =  Array(
            "UF_BIK" => Array(
                "VALUE" => $mortgage['bank']['bik']
            ),
            "UF_VALUE" => array(
                "VALUE" => $mortgage['value']
            ),
            "UF_NUMBER" => array(
                "VALUE" => $mortgage['bank']['license']['number']
            ),
            "UF_DATE" => array(
                "VALUE" => strftime("%d.%m.%Y", $newDate->getTimestamp())
            ),
            "UF_IMAGE" => array(
                "VALUE" => CFile::MakeFileArray($this->getImage(trim($mortgage['bank']['image']), $mortgage['bank']['bik']))
            )
        );
        $adMortgageArray = Array(
            'MODIFIED_BY' => $GLOBALS['USER']->GetID(),
            'IBLOCK_SECTION_ID' => false,
            'IBLOCK_ID' => 11,
            'NAME' => $mortgage['bank']['name'],
            'ACTIVE' => 'Y',
            "PROPERTY_VALUES" => $mortProps,
            "CODE" => \RaStudio\Helper::transliterate($mortgage['bank']['name'])
        );

        if($PRODUCT_ID = $this->elementController->Add($adMortgageArray)) {
            echo 'New ID: '.$PRODUCT_ID;
        } else {
            echo 'Error: '.$this->elementController->LAST_ERROR;
        }
    }
    private function getImage ($url, $id) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_PORT , 443);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        $info = curl_getinfo($ch);
        $fileType = explode('/', $info['content_type']);
        curl_close($ch);
        $link = $_SERVER['DOCUMENT_ROOT'].'/mortgage/logo/'.$id.'logo.'.$fileType[1];
        file_put_contents($link,$result);
        return $link;
    }
    public function updateMortgage () {
        foreach ($this->xmlData['rate'] as $mKey => $mortgage){
            $mortgage = (array)$mortgage;
            $mortgage['bank'] = (array)$mortgage['bank'];
            $mortgage['bank']['license'] = (array)$mortgage['bank']['license'];
            $flag = false;
            foreach ($this->allElementInSite as $eKey => $eSite) {
                if ($eSite['PROPERTIES']['UF_BIK']['VALUE'] == $mortgage['bank']['bik']){
                    $date = $mortgage['bank']['license']['date'];
                    $newDate = new DateTime($date);

                    $mortProps =  Array(
                        "UF_NAME" => array(
                            "VALUE" => $mortgage['bank']['name']
                        ),
                        "UF_BIK" => Array(
                            "VALUE" => $mortgage['bank']['bik']
                        ),
                        "UF_VALUE" => array(
                            "VALUE" => $mortgage['value']
                        ),
                        "UF_NUMBER" => array(
                            "VALUE" => $mortgage['bank']['license']['number']
                        ),
                        "UF_DATE" => array(
                            "VALUE" => strftime("%d.%m.%Y", $newDate->getTimestamp())
                        ),
                        "UF_IMAGE" => array(
                            "VALUE" => CFile::MakeFileArray($this->getImage(trim($mortgage['bank']['image']), $mortgage['bank']['bik']))
                        )
                    );
                    $adMortgageArray = Array(
                        'MODIFIED_BY' => $GLOBALS['USER']->GetID(),
                        'IBLOCK_SECTION_ID' => false,
                        'IBLOCK_ID' => 11,
                        'NAME' => $mortgage['bank']['name'],
                        'ACTIVE' => 'Y',
                        "PROPERTY_VALUES" => $mortProps,
                        "CODE" => mb_strtolower(trim(\RaStudio\Helper::transliterate($mortgage['bank']['name'])))
                    );

                    $res = $this->elementController->Update($eSite['ID'], $adMortgageArray);
                    echo $mortgage['bank']['name'].' - '.$res.'<br>';

                    $this->allElementInSite[$eKey]['UPDATE'] = 'Y';
                    $flag = true;
                }
            }
            if(!$flag){
                $this->addNewMortgage($mortgage);
            }
        }
    }
    public function deactivationNotIncludeElement() {
        echo '<br><br>Декативированы:<br>';
        foreach ($this->allElementInSite as $key => $element) {
            if(!isset($element['UPDATE']) && $element['ACTIVE'] === 'Y') {
                echo $element['NAME'].'<br>';
                $this->elementController->Update($element['ID'],array('ACTIVE' => 'N'));
            }
        }
    }
}
$url = 'https://terminal.scloud.ru/03/sc81501_base07/hs/FSK_API/mortgageRate';
$mortgage = new mortgageRateParse(11, $url);

?>