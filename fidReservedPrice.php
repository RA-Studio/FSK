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


$arResult = array();
$arResultSection = array();
$arResultSectionIn = array();
$arResultElementIn = array();
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

    private $arrayItem = array(
        "commercial-type" => array(
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
        )
    );

    public function xmlToArray ($file) {
        /*exec("wget -O - '$file'", $lines);
        $remote = implode("", $lines);*/
        $xmlFile = $_SERVER['DOCUMENT_ROOT'].'/newflat.xml';
        /*file_put_contents($xmlFile, $remote);*/

        return (array)simplexml_load_file($xmlFile);
    }

    public function __construct($iblockID, $file, $type = false) {

        //RaStudio\Api\LoggerAdapter::add("Инициализация обмена");

        CModule::IncludeModule('iblock');
        $this->sectionController = new CIBlockSection;
        $this->elementController = new CIBlockElement;
        $this->iblockID = $iblockID;
        $this->apartments = \RaStudio\XmlParser::xmlToArray($file);//$this->xmlToArray($file);//

        $this->type = $type;
        $this->getAllElementInIBLOCK();
        $this->loadData = false;
        $this->statistic = array(
            "UPDATAELEMENT"   => 0,
            "ACTIVATEELEMENT" => 0,
            "UPDATASECTION"   => 0,
            "ADDELEMENT"      => 0,
            "ADDSECTION"      => 0,
            "DELETEEMENT"     => 0,
            "DELETESECTION"   => 0,
            "ERROR"           => "",
        );
    }

    private function getAllElementInIBLOCK() {
        $arFilter = array('IBLOCK_ID' => $this->iblockID);
        if($this->type !== false && !empty($this->type)) {
            $arFilter['SECTION_CODE'] = $this->type;
            $arFilter['INCLUDE_SUBSECTIONS'] = true;
        }
        $rsElements = CIBlockElement::GetList(array(), $arFilter,false, false, array("ID","NAME","XML_ID","CODE","ACTIVE", "PROPERTY_image"));
        while ($arElement = $rsElements->Fetch()) {
            $this->allElementInSite[$arElement['CODE']] = array(
                "NAME" => $arElement['NAME'],
                "ID" => $arElement['ID'],
                "ACTIVE" => $arElement['ACTIVE'],
                "img" => $arElement['PROPERTY_IMAGE_VALUE']
            );
        }
    }
    public function addApartment(){
        global $USER;
        foreach ($this->apartments as $keyS => $apartment) {
            $ID = $this->allElementInSite[$apartment['internal-id']]["ID"];
            foreach ($apartment as $key => $value) {
                $key = preg_replace( "/[^a-zA-ZА-Яа-я0-9\s]/", '', $key );
                if($key == "priceGrant100" || $key == "priceOnline100") {
                    if ($key == 'priceGrant100'){
                        $property["priceGrant100exceptions"] = json_encode($value['exceptions']);
                    }
                    $property[$key] = $value['value'];
                }
            }
            CIBlockElement::SetPropertyValuesEx($ID, $this->iblockID, $property);
        }
    }
}

$arElementReservedAll = array();
//$homepage = "https://terminal.scloud.ru/03/sc81501_base03/hs/FSK_API/siteIntegration/newflat";
$homepage = "http://fsknw.spb.ru/newflat.xml";
$parserReserved = new fidAppartmentParse(1, $homepage);
$parserReserved->addApartment();

