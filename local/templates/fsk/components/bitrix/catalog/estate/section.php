<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

if(CSite::InDir('/commercial/')) {
    $typeOfApartment = "commercial";
}elseif(CSite::InDir('/parking/')) {
    $typeOfApartment = "parking";
}else{
    $typeOfApartment = "flat";
}?>
    <?
    $APPLICATION->IncludeComponent(
        "bitrix:catalog.section.list",
        "empty",
        array(
            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
            "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
            "CACHE_TIME" => $arParams["CACHE_TIME"],
            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
            "COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
            "TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
            "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
            "VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
            "SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
            "HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
            "ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : '')
        ),
        $component,
        array("HIDE_ICONS" => "Y")
    );
    $arResultCart = [];
    $cartStaticInfo = [];
    $arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_*", "TIMESTAMP_X");
    $arFilter = Array(
        "IBLOCK_ID" => $arParams['IBLOCK_ID'],
        "ACTIVE"=>"Y",
        "SECTION_CODE" => $arResult['VARIABLES']['SECTION_CODE'],
        "INCLUDE_SUBSECTIONS" => "Y",
        "PROPERTY_category" => $typeOfApartment,
    );
    $res = CIBlockElement::GetList(Array("PROPERTY_rooms" => "ASC", "PROPERTY_priceshort" => "ASC"), $arFilter, false, Array(), $arSelect);
    $timeUpdate = false;
    $filterData = [];
    $allApp = [];
    while($ob = $res->GetNextElement()){
        $temp = $ob->GetFields();
        $temp['PROPERTIES'] = $ob->GetProperties();

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
        $filterData['priceshort'][] = $temp['PROPERTIES']['priceshort']['VALUE'];
        $filterData['price100short'][] = $temp['PROPERTIES']['price100short']['VALUE'];
        $filterData['area'][] = $temp['PROPERTIES']['area']['VALUE'];
        $filterData['floor'][] = $temp['PROPERTIES']['floor']['VALUE'];
        $filterData['kitchenspace'][] = $temp['PROPERTIES']['kitchenspace']['VALUE'];
        $currYear = date("Y");
        $filterData['builtyear'][] = $currYear > $temp['PROPERTIES']['builtyear']['VALUE'] ? "Сдан" : $temp['PROPERTIES']['builtyear']['VALUE'];
    }

    $SectionInfo = array();
//Получаем тип раздела и основную информацию о разделе
    if ($arResult["VARIABLES"]["SECTION_CODE"]) {
        $SectionsRes = CIBlockSection::GetList(
            Array("SORT" => "ASC"),
            Array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ACTIVE" => "Y", "CODE" => $arResult["VARIABLES"]["SECTION_CODE"]),
            false,
            Array("IBLOCK_ID", "ID", "NAME", "UF_SECTION_NAME", "PICTURE","UF_APART","UF_PHOTO")
        );

        if ( $SectionsRes->SelectedRowsCount() ) {
            $SectionInfo = $SectionsRes->GetNext();
        }
    }
    ?>
    <?
    $fullProps = []; // массив со всеми данными ЖК
    CModule::IncludeModule('iblock');
    $arSelect = Array("ID", "IBLOCK_ID", "NAME","DATE_CREATE","TIMESTAMP_X", "PROPERTY_*");
    $arFilter = Array("IBLOCK_ID"=>5, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "ID"=>$SectionInfo["UF_SECTION_NAME"]);
    $res = CIBlockElement::GetList(Array("RAND" => "ASC"), $arFilter, false, Array("nPageSize"=>1), $arSelect);
    $userProps = $fullProps['userProps'];
    ?>
    <? if($res->arResult): ?>
        <? while($ob = $res->GetNextElement()): $fullProps['standartProps'] = $ob->GetFields(); $userProps = $ob->GetProperties();?>
        <? endwhile; ?>
    <? endif; ?>
    <?
// Вывод особенностей из хайлоад блока:
    $features = [];
    if (CModule::IncludeModule('highloadblock')) {
        $arHLBlock = Bitrix\Highloadblock\HighloadBlockTable::getById(7)->fetch();
        $obEntity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arHLBlock);
        $strEntityDataClass = $obEntity->getDataClass();
    }
//Получение списка:
    if (CModule::IncludeModule('highloadblock')) {
        $rsData = $strEntityDataClass::getList(array(
            'select' => array('ID','UF_FILE','UF_DESCRIPTION', 'UF_NAME', "UF_XML_ID"),
            'order' => array('ID' => 'ASC'),
            'filter' => array('UF_XML_ID' => $userProps['UF_FEATURES']['VALUE']),
            'limit' => '50',
        ));
        while ($arItem = $rsData->Fetch()) {
            $features[$arItem['UF_XML_ID']] = $arItem;
        }
    }
    ?>
    <?
    $progressGallery = []; // массив с галереей хода строительства этого ЖК
    CModule::IncludeModule('iblock');
    $arSelect = Array("ID", "IBLOCK_ID", "NAME","DATE_CREATE","TIMESTAMP_X","ACTIVE_FROM" , "PROPERTY_*");
    $arFilter = Array("IBLOCK_ID"=>6, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "SECTION_ID"=>$SectionInfo['ID']);

    if($_REQUEST["date"]) {
        $arFilter['UF_GALLERY_MONTH'] = $_REQUEST["date"];
    }

    $res = CIBlockElement::GetList(Array("SORT" => "ASC"), $arFilter, false, Array("nPageSize"=>999), $arSelect);

    $ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues($arParams["IBLOCK_ID"],$SectionInfo["ID"]);
    $values = $ipropValues->getValues();
//выводим наши мета-данные
    if($values['SECTION_META_TITLE']){
        $APPLICATION->SetPageProperty("title", $values['SECTION_META_TITLE']);
    }
    if($values['SECTION_META_DESCRIPTION']){
        $APPLICATION->SetPageProperty("description", $values['SECTION_META_DESCRIPTION']);
    }
    if($values['SECTION_META_KEYWORDS']){
        $APPLICATION->SetPageProperty("keywords", $values['SECTION_META_KEYWORDS']);
    }

    if($userProps['UF_YELLOW_OFF']['VALUE']=='Y' || empty($userProps['UF_YELLOW_TEXT']['VALUE']['TEXT'])) {
        $APPLICATION->SetPageProperty('yellowTop','');
    }else{
        $text = '';
        if (!empty($userProps['UF_YELLOW_LINK']['VALUE'])) {
            $text .= '<a href="'. $userProps['UF_YELLOW_LINK']['VALUE'] .'" class="reserve-info">';
        }
        else{
            $text .= '<div class="reserve-info">';
        }
        if (!empty($userProps['UF_YELLOW_SVG']['VALUE'])) {
            $text .= '<img src="' . CFile::GetPath($userProps['UF_YELLOW_SVG']['VALUE']) . '">';
        }
        if (!empty($userProps['UF_YELLOW_TEXT']['VALUE']['TEXT'])) {
            $text .=  '<div class="reserve-info__text">'.$userProps['UF_YELLOW_TEXT']['VALUE']['TEXT'].'</div>';
        }
        $text .= '<div class="reserve-info__close">
<svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M17 17L2 2" stroke="black" stroke-width="1.5" stroke-linecap="round"/>
<path d="M2 17L17 2" stroke="black" stroke-width="1.5" stroke-linecap="round"/>
</svg>
</div>';
        if (!empty($userProps['UF_YELLOW_LINK']['VALUE'])) {
            $text .= '</a>';
        }
        else{
            $text .= '</div>';
        }
        if (!empty($text)) {
            $APPLICATION->SetPageProperty('yellowTop', $text);
            $APPLICATION->SetPageProperty('yellowPageClass', 'page-yellow-info');
        }
    }





    $apart = $SectionInfo['UF_APART'];
    $typeBuilding = "";

    if($apart) {
        $typeBuilding = 'apart';
    } elseif (CSite::InDir('/commercial/')) {
        $typeBuilding = 'commercial';
    }
    /*echo($typeBuilding);*/
    if($typeBuilding) {
        $APPLICATION->SetPageProperty('apart','Выбрать апартаменты');
    } elseif ($typeBuilding == 'commercial') {
        $APPLICATION->SetPageProperty('apart','Коммерческие помещения');
    } else {
        $APPLICATION->SetPageProperty('apart','Выбрать квартиру');
    }

    ?>
    <? if($res->arResult): $i = 0;?>
        <? while($ob = $res->GetNextElement()): $progressGallery[$i]['standartProps'] = $ob->GetFields(); $progressGallery[$i]['userProps'] = $ob->GetProperties(); $i++;?>
        <? endwhile;?>
    <? endif; ?>
    <?include($_SERVER['DOCUMENT_ROOT']."$templateFolder/include/section/type/".$typeOfApartment.".php")?>



