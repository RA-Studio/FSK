<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
Loader::includeModule("highloadblock"); 
use Bitrix\Highloadblock as HL; 
use Bitrix\Main\Entity;

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$this->setFrameMode(true);

if(CSite::InDir('/commercial/')) {
    $typeOfApartment = "commercial";
}elseif(CSite::InDir('/parking/')) {
    $typeOfApartment = "parking";
}else{
    $typeOfApartment = "flat";
}
?>
    <?
    $arResultCart = [];
    $cartStaticInfo = [];
    $build = [];
    $arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_*", "TIMESTAMP_X", "IBLOCK_SECTION_ID");
    $arFilter = Array(
        "IBLOCK_ID" => 1,
        "ACTIVE"=>"Y",
        "INCLUDE_SUBSECTIONS" => "Y",
        "PROPERTY_category" => $typeOfApartment,
    );
    if(!\CModule::IncludeModule("iblock")) return $request['response']->shapeError([],"Ошибка");
    $res = CIBlockElement::GetList(Array("PROPERTY_rooms" => "ASC", "PROPERTY_price" => "ASC"), $arFilter, false, Array(), $arSelect);
    $timeUpdate = false;
    $filterData = [];
    while($ob = $res->GetNextElement()) {
        $temp = $ob->GetFields();
        $temp['PROPERTIES'] = $ob->GetProperties();
        $build[$temp["IBLOCK_SECTION_ID"]] = true;
        $room = $temp['PROPERTIES']['rooms']['VALUE'];
        $area = $temp['PROPERTIES']['area']['VALUE'];
        if(!$arResultCart[$room][$area]) {
            $arResultCart[$room][$area] = $temp;
            $floor = $arResultCart[$room][$area]['PROPERTIES']['floor']['VALUE'];
            $arResultCart[$room][$area]['PROPERTIES']['floor']['VALUE'] = [$floor];
        } else {
            $arResultCart[$room][$area]['PROPERTIES']['floor']['VALUE'][] = $temp['PROPERTIES']['floor']['VALUE'];
        }
        $cartStaticInfo[$room]['price'][] = $temp['PROPERTIES']['price']['VALUE'];
        $cartStaticInfo[$room]['area'][] = $area;
        $timeUpdate = $timeUpdate === false ? $temp['TIMESTAMP_X'] : $timeUpdate < $temp['TIMESTAMP_X'] ? $temp['TIMESTAMP_X'] : $timeUpdate;

        $filterData['room'][] = $room;
        $filterData['price100short'][] = $temp['PROPERTIES']['price100short']['VALUE'];
        $filterData['area'][] = $temp['PROPERTIES']['area']['VALUE'];
        $filterData['floor'][] = $temp['PROPERTIES']['floor']['VALUE'];
        $filterData['kitchenspace'][] = $temp['PROPERTIES']['kitchenspace']['VALUE'];
        $currYear = date("Y");
        $filterData['builtyear'][] = $currYear > $temp['PROPERTIES']['builtyear']['VALUE'] ? "Сдан" : $temp['PROPERTIES']['builtyear']['VALUE'];
    }
    ?>
    <?
    $filterData['room'] = array_values(array_unique($filterData['room']));
    $filterData['price100short'] = array_values(array_unique($filterData['price100short']));
    $filterData['area'] = array_values(array_unique($filterData['area']));
    $filterData['floor'] = array_values(array_unique($filterData['floor']));
    $filterData['kitchenspace'] = array_filter(array_values(array_unique($filterData['kitchenspace'])));
    $filterData['builtyear'] = array_values(array_unique($filterData['builtyear']));
    sort($filterData['builtyear']);
    \RaStudio\Helper::arrayShiftInRight($filterData['builtyear']);
    ?>
    <?include($_SERVER['DOCUMENT_ROOT']."$templateFolder/include/sections/type/".$typeOfApartment.".php")?>


