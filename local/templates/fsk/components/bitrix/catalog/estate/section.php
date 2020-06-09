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

$typeOfApartment = "flat";

if(CSite::InDir('/commercial/')) {
    $typeOfApartment = "commercial";
}

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
    <div class="page page-project<?=" $typeOfApartment"?>">
        <div class="p-hero project-hero" style="background-image: url('<?=!empty($SectionInfo['UF_PHOTO'])? CFile::GetPath($SectionInfo['UF_PHOTO']):CFile::GetPath($SectionInfo['PICTURE']) ;?>')">
            <div class="container">
                <div class="p-hero__inner">
                    <? if($userProps['UF_MAIN_ICON']['VALUE']) : ?>
                        <div class="project-hero__img">
                            <img class="img lazyload" data-src="<?=CFile::GetPath($userProps['UF_MAIN_ICON']['VALUE']);?>" alt="alt">
                        </div>
                    <? endif; ?>
                    <? if ($SectionInfo['NAME']) :?>
                        <h1 class="h1 p-hero__title"><?=$SectionInfo['NAME'];?></h1>
                    <? endif; ?>
                    <?
                        if ($userProps['UF_METRO']['VALUE']) { // если метро задано то подгружаем хайлоадблок
                            $metro = [];
                            if (CModule::IncludeModule('highloadblock')) {
                                $arHLBlock = Bitrix\Highloadblock\HighloadBlockTable::getById(11)->fetch();
                                $obEntity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arHLBlock);
                                $strEntityDataClass = $obEntity->getDataClass();
                            }

                            //Получение списка:
                            if (CModule::IncludeModule('highloadblock')) {
                                $rsData = $strEntityDataClass::getList(array(
                                        'select' => array('ID', 'UF_NAME', 'UF_COLOR'),
                                        'filter' => array('UF_XML_ID' => $userProps['UF_METRO']['VALUE']),
                                        'order' => array('ID' => 'ASC'),
                                        'limit' => '999',
                                ));
                                while ($arItem = $rsData->Fetch()) {
                                    $metro[] = $arItem;
                                }
                            }
                            ?>
                            <div class="project-hero__distance">
                                <div class="p-metro flex">
                                    <div class="p-metro__branch" style="border-color: <?=$metro[0]['UF_COLOR'];?>;"></div><span><?=$metro[0]['UF_NAME'];?></span>
                                </div>
                                <?
                                    if ($userProps['UF_WALK_TIME']['VALUE']) { // если время до метро задано
                                        ?>
                                        <div class="p-distance flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="8" height="13.201" viewBox="0 0 8 13.201">
                                                <path id="Walking_Copy_3" data-name="Walking Copy 3" d="M6.436,13.2a.752.752,0,0,1-.64-.356L3.691,9.583l-.26-.4L2.51,7.753a.949.949,0,0,1-.146-.779l.041-.2.487-2.326a2.978,2.978,0,0,0-1.1.92,3.663,3.663,0,0,0-.281,1.9.53.53,0,1,1-1.059,0A4.54,4.54,0,0,1,.888,4.825a4.127,4.127,0,0,1,1.683-1.41A2.969,2.969,0,0,1,3.9,3.1h.356a.861.861,0,0,1,.665.332.833.833,0,0,1,.162.716L4.687,5.783,4.5,6.571,4.241,7.646l2.826,4.38a.756.756,0,0,1-.6,1.174Zm-5.679,0a.756.756,0,0,1-.565-1.26l1.495-1.727.471-2.249,1.159,1.8-.184.941a.757.757,0,0,1-.17.35L1.335,12.93A.754.754,0,0,1,.757,13.2ZM7.47,7.25a.51.51,0,0,1-.128-.015,4.528,4.528,0,0,1-2.281-.989l-.049-.05.344-1.436a2.119,2.119,0,0,0,.447.73A3.8,3.8,0,0,0,7.584,6.2.529.529,0,0,1,7.47,7.25ZM4.678,2.7A1.349,1.349,0,1,1,6.034,1.349,1.35,1.35,0,0,1,4.678,2.7Z" transform="translate(0)" fill="#fff"/>
                                            </svg>
                                            <span><?=$userProps['UF_WALK_TIME']['VALUE'];?></span>
                                        </div>
                                        <?
                                    }
                                    if ($userProps['UF_TRANSPORT_TIME']['VALUE']) {
                                        ?>
                                        <div class="p-distance flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14.644" height="16" viewBox="0 0 14.644 16"><path d="M15.827,3.912a5.933,5.933,0,0,0-.668-2.663C13.8-.358,4.293-.475,3.213,1.25a7.658,7.658,0,0,0-.574,2.665.805.805,0,0,0-.713.8V6.277a.806.806,0,0,0,.528.756c-.073,2.464-.014,5.035.1,6.314,0,.987.663.823.663.823h.622v1.066A.887.887,0,0,0,4.807,16a.888.888,0,0,0,.973-.764V14.17H13.01v1.066a.887.887,0,0,0,.973.764.887.887,0,0,0,.972-.764V14.17h.2s.78.107.83-.358c0-1.275.08-4.1.014-6.768a.8.8,0,0,0,.566-.767V4.712A.8.8,0,0,0,15.827,3.912ZM5.535,1.479h7.3v1.1h-7.3Zm.1,11.433a1.038,1.038,0,1,1,1.038-1.038A1.038,1.038,0,0,1,5.64,12.912Zm7.158,0a1.038,1.038,0,1,1,1.038-1.038A1.039,1.039,0,0,1,12.8,12.912Zm1.319-4.543H4.255V3.2h9.862Z" transform="translate(-1.926 0)" fill="#bebebe"/></svg>
                                            <span><?=$userProps['UF_TRANSPORT_TIME']['VALUE'];?></span>
                                        </div>
                                        <?
                                    }
                                ?>

                            </div>
                            <?
                        }
                    ?>
                    <?
                        if ($userProps['UF_DISCOUNT_TEXT']['VALUE'] && $typeOfApartment === 'flat') {
                            ?>
                            <div class="p-discount flex">
                                <div class="p-discount__ic">%</div>
                                <p class="p-discount__txt"><?=$userProps['UF_DISCOUNT_TEXT']['VALUE'];?></p>
                            </div>
                            <?
                        }
                    ?>
                    <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "main_breadcrumbs", Array(
                        "PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                        "SITE_ID" => "s1",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                        "START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
                    ),
                        false
                    );?>

						<div class="online-buy"><?=$userProps['UF_YELLOW_STRIP']['~VALUE']?></div>

                </div>
            </div>
        </div>
        <?global $USER?>
        <?if(CSite::InDir('/newbuild/zoom_apart/') && $USER->IsAdmin()):?>
	        <div class="scrollspy-menu apart-menu">
	            <div class="container scrollspy-menu__slider">
	                <? if ($userProps['UF_PROJECT_NAME']['~VALUE']['TEXT']) :?>
	                    <a class="active" href="#p-1">О проекте</a>
	                <?endif;?>
	                <? if ($userProps['UF_GALLERY']['VALUE']){?>
	                    <a href="#p-2">Галерея</a>
	                <?}?>
	                <? if ($userProps['UF_MAP_CODE']['VALUE']){?>
	                    <a href="#p-3">Расположение</a>
	                <?}?>
	                <? if ($userProps['UF_ADVANTAGES_GALLERY']['VALUE']){?>
	                    <a href="#p-4">Преимущества</a>
	                <?}?>
	                <a href="#p-11">Типы номеров</a>
	                <a href="#p-12">Доходность</a>

	                <? if (!empty($userProps['UF_DISCOUNTS_LIST']['VALUE'])){?>
	                    <a href="#p-5">Акции</a>
	                <?}?>
	                <a href="#p-6">Стоимость</a>
	                <?/*if($typeBuilding == 'apart'):?>
	                    <a href="#p-6">Апартаменты</a>
	                <?elseif ($typeBuilding == 'commercial'):?>
	                    <a href="#p-6">Коммерческие помещения</a>
	                <?else:?>
	                    <a href="#p-6">Квартиры</a>
	                <?endif;?>
	                <?if($typeOfApartment != "commercial"):?>
	                    <a href="#p-7">Ипотека</a>
	                <?endif;*/?>
	                <?if ($progressGallery && $userProps['UF_JK_STATUS']['VALUE'] === 'Да'){?>
	                    <a href="#p-8">Ход строительства</a>
	                <?}?>
	                <?if(!empty($userProps['UF_CONTACTS']['VALUE'])){?>
	                    <a href="#p-9">Офис продаж</a>
	                <?}?>
	                <a href="#p-10">Документы</a>
	            </div>
	        </div>
	    <?else:?>
	        <div class="scrollspy-menu">
	            <div class="container scrollspy-menu__slider">
	                <? if ($userProps['UF_PROJECT_NAME']['~VALUE']['TEXT']) :?>
	                    <a class="active" href="#p-1">О проекте</a>
	                <?endif;?>
	                <? if ($userProps['UF_GALLERY']['VALUE']){?>
	                    <a href="#p-2">Галерея</a>
	                <?}?>
	                <? if ($userProps['UF_MAP_CODE']['VALUE']){?>
	                    <a href="#p-3">Расположение</a>
	                <?}?>
	                <? if ($userProps['UF_ADVANTAGES_GALLERY']['VALUE']){?>
	                    <a href="#p-4">Преимущества</a>
	                <?}?>
	                <? if (!empty($userProps['UF_DISCOUNTS_LIST']['VALUE'])){?>
	                    <a href="#p-5">Акции</a>
	                <?}?>
	                    <?if($typeBuilding == 'apart'):?>
	                        <a href="#p-6">Апартаменты</a>
	                    <?elseif ($typeBuilding == 'commercial'):?>
	                        <a href="#p-6">Коммерческие помещения</a>
	                    <?else:?>
	                        <a href="#p-6">Квартиры</a>
	                    <?endif;?>
	                <?if($typeOfApartment != "commercial"):?>
	                    <a href="#p-7">Ипотека</a>
	                <?endif;?>
	                <?if ($progressGallery && $userProps['UF_JK_STATUS']['VALUE'] === 'Да'){?>
	                    <a href="#p-8">Ход строительства</a>
	                <?}?>
	                <?if(!empty($userProps['UF_CONTACTS']['VALUE'])){?>
	                    <a href="#p-9">Офис продаж</a>
	                <?}?>
	                <a href="#p-10">Документы</a>
	            </div>
	        </div>
        <?endif?>
        <? if ($userProps['UF_PROJECT_NAME']['~VALUE']['TEXT']) : ?>
            <div class="project-about scrollspy-item" id="p-1">
                <div class="container">
                    <h2 class="h1 title">О проекте</h2>
                    <?=$userProps['UF_PROJECT_NAME']['~VALUE']['TEXT'];?>
                    <!--<p>Жилой комплекс бизнес-класса в престижном Хорошёвском районе в окружении исторической сталинской застройки и статусных жилых комплексов. Это идеальное сочетание престижа района, авторской архитектуры, индивидуального подхода к планировкам и дизайну интерьеров комплекса. Жилой комплекс бизнес-класса в престижном Хорошёвском районе в окружении исторической сталинской застройки и статусных жилых комплексов. Это идеальное сочетание престижа района, авторской архитектуры, индивидуального подхода к планировкам и дизайну интерьеров комплекса.</p>-->
                    <? if (!empty($features)): ?>
                        <div class="project-data">
                            <? foreach ($userProps['UF_FEATURES']['VALUE'] as $key): ?>
                                <?$item = $features[$key]?>
                                <div class="project-data__col">
                                    <img class="img lazyload" data-src="<?=CFile::GetPath($item['UF_FILE']);?>" alt="alt">
                                    <div>
                                        <div class="sub-text"><?=$item['UF_NAME'];?></div>
                                        <div class="project-data__val"><?=$item['UF_DESCRIPTION'];?></div>
                                    </div>
                                </div>
                            <? endforeach; ?>
                        </div>
                    <? endif; ?>
                </div>
            </div>
        <? endif; ?>
        <?if($typeOfApartment == 'commercial'):?>
        <div class="container section-margin scrollspy-item container__relative" id="p-6">
            <?if($typeBuilding == 'apart'):?>
                <h2 class="h1 title" id="filter-anchor">Выбор апартаментов</h2>
            <?elseif ($typeBuilding == 'commercial'):?>
                <h2 class="h1 title" id="filter-anchor">Выбор коммерческих помещений</h2>
            <?else:?>
                <h2 class="h1 title" id="filter-anchor">Выбор квартир</h2>
            <?endif;?>

            <?include($_SERVER['DOCUMENT_ROOT']."$templateFolder/include/section/filter.php")?>
            <div class="results">
                <div class="filter-preloader" style="display: none;"></div>
                <div class="results__row results__header">
                    <div class="results__col">
                        <div class="results__row">
                            <div class="results__cell results-cell-1"><span>План</span></div>
                            <div class="results__cell results-cell-2">
                                <button class="sort sort--active sort--flip" type="button" data-field="area" data-event="sortApartmentFun">
                                    <svg class="svg" style="width: 9.25px; height: 9.25px" xmlns="http://www.w3.org/2000/svg" width="9.502" height="9.254" viewBox="0 0 9.502 9.254"><path d="M2.961,85.754H6.128V84.191H2.961ZM0,76.5v1.563H9.5V76.5Zm1.61,5.346H7.944V80.283H1.61Z" transform="translate(0 -76.5)"/></svg>
                                    <span>Площадь, м<sup>2</sup></span>
                                </button>
                            </div>
                            <div class="results__cell results-cell-3"><span>Этаж</span></div>
                            <div class="results__cell results-cell-4">
                                <button class="sort" type="button" data-field = "builtyear" data-event="sortApartmentFun">
                                    <svg class="svg" style="width: 9.25px; height: 9.25px" xmlns="http://www.w3.org/2000/svg" width="9.502" height="9.254" viewBox="0 0 9.502 9.254"><path d="M2.961,85.754H6.128V84.191H2.961ZM0,76.5v1.563H9.5V76.5Zm1.61,5.346H7.944V80.283H1.61Z" transform="translate(0 -76.5)"/></svg>
                                    <span>Готовность</span></button>
                            </div>
                            <div class="results__cell results-cell-5">
                                <?/*<button class="sort <?//sort--active sort--flip?>" type="button" data-field = "price" <?//data-event="sortApartmentFun"?>>

                                    <svg class="svg" style="width: 9.25px; height: 9.25px" xmlns="http://www.w3.org/2000/svg" width="9.502" height="9.254" viewBox="0 0 9.502 9.254"><path d="M2.961,85.754H6.128V84.191H2.961ZM0,76.5v1.563H9.5V76.5Zm1.61,5.346H7.944V80.283H1.61Z" transform="translate(0 -76.5)"/></svg>
                                    <span>Цена</span></button>
                                */?>
                                    <span>Цена</span>
                            </div>
                            <div class="mob-sort"><span class="mob-sort__hint">Сортировать</span>
                                <select class="ui-select" name="mob_sort" data-placeholder="по цене">
                                    <option class="active" value="2020">по цене</option>
                                    <option value="2021">по площади</option>
                                    <option value="2022">по готовности</option>
                                </select>
                                <svg class="svg" style="width: 9.25px; height: 9.25px" xmlns="http://www.w3.org/2000/svg" width="9.502" height="9.254" viewBox="0 0 9.502 9.254"><path d="M2.961,85.754H6.128V84.191H2.961ZM0,76.5v1.563H9.5V76.5Zm1.61,5.346H7.944V80.283H1.61Z" transform="translate(0 -76.5)"/></svg>
                            </div>
                        </div>
                    </div>
                    <div class="interactive-btns">
                        <a class="interactive-btn interactive-download" href="javascript:void(0);" title="Скачать" data-event="loadPDF"></a>
                        <a class="interactive-btn interactive-print" href="print.html" target="_blank" title="Распечатать"></a>
                        <div class="interactive-btn interactive-favorite" data-role="favorite">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22.712" height="21.673" viewBox="0 0 22.712 21.673"><path d="M10.606,0l3.277,6.64,7.329,1.071-5.3,5.165,1.252,7.3-6.555-3.447L4.052,20.173l1.252-7.3L0,7.711,7.329,6.64,10.606,0Z" transform="translate(0.75 0.75)" fill="none" stroke="#e94200" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/></svg>
                        </div>
                    </div>
                </div>
                <div class="results__body">
                    <div class="results__col">
                        <div class="results-screen" id="results-screen">
                            <?/*foreach ($cartStaticInfo as $key => $category):?>
                                <div class="results__row results-screen__header">
                                    <div><?=\RaStudio\Cart::getFloorNameFull($key)?> от <span class="filter-data"><?=min($category['area'])?> </span>до <span class="filter-data"><?=max($category['area'])?> </span>м<sup>2</sup></div>
                                    <div>от <span class="filter-data"><?=number_format(min($category['price']), 0, '', ' ');?> р.</span></div>
                                </div>
                                <?$countApartment = \RaStudio\Cart::getFloorName($key)?>
                                <?foreach ($arResultCart[$key] as $keyCart => $cart):?>
                                    <?
                                    $maxFloor = max($cart['PROPERTIES']['floor']['VALUE']);
                                    $minFloor = min($cart['PROPERTIES']['floor']['VALUE']);
                                    $stringFloor = (($minFloor != $maxFloor) && $maxFloor) ? "$minFloor...$maxFloor" : $minFloor;
                                    ?>
                                    <div class="results__row" data-event="updatePopup" data-count="<?=$key?>" data-area="<?=$cart['PROPERTIES']['area']['VALUE']?>" data-plan="<?=CFile::GetPath($cart['PROPERTIES']['image']['VALUE'][0])?>">
                                        <div class="results__cell results-cell-1 js-call-card" style="    min-height: 60px;"><img class="img plan-thumb" src="<?=CFile::ResizeImageGet($cart['PROPERTIES']['image']['VALUE'][0], array('width'=>60, 'height'=>60), BX_RESIZE_IMAGE_PROPORTIONAL, true)['src'];?>" alt="alt"></div>
                                        <div class="results__cell results-cell-2"><span><?=$cart['PROPERTIES']['area']['VALUE']?> м<sup>2</sup></span></div>
                                        <div class="results__cell results-cell-3"><span><?=$stringFloor?></span></div>
                                        <div class="results__cell results-cell-4"><span><?=$cart['PROPERTIES']['area']['VALUE']?></span></div>
                                        <div class="results__cell results-cell-5"><span><?=number_format($cart['PROPERTIES']['price']['VALUE'], 0, '', ' ');?> р.</span></div>
                                        <div class="results-cell-mob">
                                            <p class="data-1"><?=$countApartment?> - <?=$cart['PROPERTIES']['area']['VALUE']?> м<sup>2</sup></p>
                                            <p class="data-2"> <span><?=number_format($cart['PROPERTIES']['price']['VALUE'], 0, '', ' ');?> </span>р.</p>
                                        </div>
                                        <div class="results-cell-btns">
                                            <button class="interactive-btn interactive-follow" type="button"><img class="svg ic-arrow" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-arrow.svg" width="20" height="20" alt="Перейти"></button>
                                        </div>
                                    </div>
                                <?endforeach;?>
                            <?endforeach;*/?>
                        </div>
                    </div>
                    <div class="results__offer results-offer ">
                        <div class="results__img js-call-card">
                            <img class="img lazyload" data-src="<?=SITE_TEMPLATE_PATH?>/img/img-plan.jpg" alt="plan" style="max-height: 100%;">
                            <button class="results-offer__modal" type="button">
                                <svg class="svg" style="width: 36px;height: 44px" xmlns="http://www.w3.org/2000/svg" width="36" height="44" viewBox="0 0 36 44"><g transform="translate(-1282 -653)"><g transform="translate(1.831 -1.631)"><g transform="translate(1280.169 654.631)" fill="none" stroke="#fff" stroke-width="1.5"><rect width="30" height="40" rx="2" stroke="none"/><rect x="0.75" y="0.75" width="28.5" height="38.5" rx="1.25" fill="none"/></g><g transform="translate(1286.078 659.875)"><path d="M0,4.781v13.41H10.378V17.4H6.919V16.35H6.054V17.4H.865v-6.31H6.054v2.1h.865v-.526H12.4V11.88H6.919V7.147H6.054V10.3H.865V5.57H17.586v6.31H15.279V10.828h-.865v1.841h3.171v7.888H13.838V17.928h-.865v3.418h5.478V4.781Z" transform="translate(0 -4.781)" fill="#fff" stroke="#fff" stroke-width="0.5"/></g><line x2="17.591" transform="translate(1286.078 680.215)" fill="none" stroke="#fff" stroke-linecap="round" stroke-width="1.5"/><line x2="13.591" transform="translate(1286.078 684.784)" fill="none" stroke="#fff" stroke-linecap="round" stroke-width="1.5"/><line x2="10.708" transform="translate(1286.078 689.354)" fill="none" stroke="#fff" stroke-linecap="round" stroke-width="1.5"/></g><g transform="translate(0 -1)"><g transform="translate(-2 -1)"><g transform="translate(1305 684)" fill="#eb5418" stroke="#fff" stroke-width="1.5"><circle cx="7.5" cy="7.5" r="7.5" stroke="none"/><circle cx="7.5" cy="7.5" r="6.75" fill="none"/></g></g><g transform="translate(1277.476 686.206)"><path d="M34.732,7.237l-.117.463q-.527.2-.841.307a2.287,2.287,0,0,1-.729.106,1.489,1.489,0,0,1-.992-.3.961.961,0,0,1-.354-.765,2.62,2.62,0,0,1,.026-.368q.027-.188.086-.425l.439-1.5q.059-.216.1-.41a1.725,1.725,0,0,0,.04-.352.534.534,0,0,0-.123-.4.711.711,0,0,0-.47-.114,1.269,1.269,0,0,0-.349.052c-.119.034-.222.067-.307.1l.117-.464q.432-.17.826-.291a2.545,2.545,0,0,1,.747-.121,1.452,1.452,0,0,1,.977.3.969.969,0,0,1,.343.77c0,.065-.008.181-.024.345a2.242,2.242,0,0,1-.088.454l-.437,1.5a3.87,3.87,0,0,0-.1.413,2.058,2.058,0,0,0-.043.35.5.5,0,0,0,.138.407.8.8,0,0,0,.478.108,1.424,1.424,0,0,0,.362-.054A2.07,2.07,0,0,0,34.732,7.237Zm.111-6.29a.864.864,0,0,1-.306.667,1.061,1.061,0,0,1-.737.276,1.073,1.073,0,0,1-.74-.276.863.863,0,0,1-.309-.667A.871.871,0,0,1,33.06.278a1.12,1.12,0,0,1,1.477,0A.872.872,0,0,1,34.843.947Z" transform="translate(0 0)" fill="#fff"/></g></g></g></svg>
                            </button>
                        </div>
                        <div class="results-offer__footer">
                            <div class="results-offer__text">
                                <p id="results-offer-square-text">Интересует студия 22 м<sup>2</sup> ? </p>
                                <p>Посмотрите
                                    <button class="text-btn js-call-card" button="button">подробнее!</button>
                                </p>
                            </div>
                            <div class="results-offer__btn">
                                <!--button class="btn btn--cta js-call-callback" type="button">
                                    <svg class="svg btn__ic ic-tel"  xmlns="http://www.w3.org/2000/svg" width="14.547" height="24.331" viewBox="0 0 14.547 24.331"><g transform="translate(-8967.75 1214.75)"><path d="M0,.5H13.047" transform="translate(8968.5 -1195.909)" fill="none" stroke="#e94200" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><path d="M0,1.25H3.262" transform="translate(8973.393 -1211.988)" fill="none" stroke="#e94200" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><rect width="13.047" height="22.831" rx="2" transform="translate(8968.5 -1214)" stroke-width="1.5" stroke="#e94200" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" fill="none"/></g></svg>
                                    Позвоните мне
                                </button-->
                                <a href="#callbackwidget" class="btn btn--cta js-call-callback" type="button">
                                    <svg class="svg btn__ic ic-tel"  xmlns="http://www.w3.org/2000/svg" width="14.547" height="24.331" viewBox="0 0 14.547 24.331"><g transform="translate(-8967.75 1214.75)"><path d="M0,.5H13.047" transform="translate(8968.5 -1195.909)" fill="none" stroke="#e94200" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><path d="M0,1.25H3.262" transform="translate(8973.393 -1211.988)" fill="none" stroke="#e94200" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><rect width="13.047" height="22.831" rx="2" transform="translate(8968.5 -1214)" stroke-width="1.5" stroke="#e94200" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" fill="none"/></g></svg>
                                    Забронировать
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="results-empty" style="display: none">По вашему запросу ничего не найдено.</div>
            </div>
            <div class="results-refresh">
                <svg class="svg btn__ic" style="width: 14px;height: 14px" xmlns="http://www.w3.org/2000/svg" width="12.662" height="13.637" viewBox="0 0 12.662 13.637"><g transform="translate(-17.067)"><g transform="translate(17.067)"><g transform="translate(0)"><path d="M28.268,0a.487.487,0,0,0-.487.487V2.266A6.319,6.319,0,0,0,17.067,6.818a.487.487,0,1,0,.974,0A5.357,5.357,0,0,1,27.35,3.2l-2.158.719a.488.488,0,1,0,.308.925l2.922-.974a.487.487,0,0,0,.333-.464V.487A.487.487,0,0,0,28.268,0Z" transform="translate(-17.067)" fill="#e94200"/></g></g><g transform="translate(18.041 6.331)"><g transform="translate(0)"><path d="M62.4,221.867a.487.487,0,0,0-.487.487A5.357,5.357,0,0,1,52.6,225.97l2.158-.719a.488.488,0,1,0-.308-.925l-2.922.974a.487.487,0,0,0-.333.464v2.922a.487.487,0,0,0,.974,0v-1.779a6.319,6.319,0,0,0,10.715-4.552A.487.487,0,0,0,62.4,221.867Z" transform="translate(-51.198 -221.867)" fill="#e94200"/></g></g></g></svg>
                Информация обновлена
                <span><?=CIBlockFormatProperties::DateFormat("j M Y", strtotime($timeUpdate));?></span>.
            </div>
            <div class="results-more">
                <button class="btn btn--transp" type="button">
                    <svg class="svg btn__ic ic-arrow ic-arrow--down" style="width: 20px;height: 20px" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><g transform="translate(0 20) rotate(-90)"><g transform="translate(20) rotate(90)" fill="none"><path d="M10,0A10,10,0,1,1,0,10,10,10,0,0,1,10,0Z" stroke="none"/><path d="M 10.00000095367432 1.500001907348633 C 5.313080787658691 1.500001907348633 1.500001907348633 5.313080787658691 1.500001907348633 10.00000095367432 C 1.500001907348633 14.68692111968994 5.313080787658691 18.5 10.00000095367432 18.5 C 14.68692111968994 18.5 18.5 14.68692111968994 18.5 10.00000095367432 C 18.5 5.313080787658691 14.68692111968994 1.500001907348633 10.00000095367432 1.500001907348633 M 10.00000095367432 1.9073486328125e-06 C 15.52285099029541 1.9073486328125e-06 20 4.477150917053223 20 10.00000095367432 C 20 15.52285099029541 15.52285099029541 20 10.00000095367432 20 C 4.477150917053223 20 1.9073486328125e-06 15.52285099029541 1.9073486328125e-06 10.00000095367432 C 1.9073486328125e-06 4.477150917053223 4.477150917053223 1.9073486328125e-06 10.00000095367432 1.9073486328125e-06 Z" stroke="none"/></g><g transform="translate(7.236 5.719)"><g transform="translate(5.504 5.4) rotate(90)"><g transform="translate(0 5.504) rotate(-90)"><path d="M0,0,2.752,2.752,5.5,0" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/></g></g><line y2="7.826" transform="translate(2.739)" fill="none" stroke-linecap="round" stroke-width="1.5"/></g></g></svg>
                    Показать ещё
                </button>
            </div>
        </div>
        <?endif?>
        <? if ($userProps['UF_GALLERY']['VALUE'] || $userProps['UF_GALLERY_IN']['VALUE']) : ?>
            <div class="gallery project-photos section-margin scrollspy-item" id="p-2">
                <div class="container">
                    <h2 class="h1 title">Галерея</h2>
                    <?if($userProps['UF_GALLERY_IN']['VALUE']):?>
                    <div class="tab-gallery<?=!$userProps['UF_GALLERY']['VALUE'] ? " active" : ""?>" id="gallery-tab1">
                        <div class="gallery-slider-xl" id="gallery-1">
                            <? foreach($userProps['UF_GALLERY_IN']['VALUE'] as $galleryItem) : ?>
                                <?//$img = \CFile::ResizeImageGet($galleryItem, array('width'=>1200, 'height'=>700), BX_RESIZE_IMAGE_PROPORTIONAL, true)['src']?>
                                <div class="slide">
                                    <img class="img lazyload" data-src="<?=CFile::GetPath($galleryItem)?>" alt="alt">
                                    <button class="ui-btn zoom-link" href="<?=CFile::GetPath($galleryItem)?>" data-fancybox="gallery1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="17.121" height="17.121" viewBox="0 0 17.121 17.121"><g transform="translate(1.061 1.061)"><path d="M0,0H5V5" transform="translate(10)" fill="#fff" stroke="#727272" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><path d="M5,5H0V0" transform="translate(0 10)" fill="#fff" stroke="#727272" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><path d="M5.833,0,0,5.833" transform="translate(9.167)" fill="#fff" stroke="#727272" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><path d="M0,5.833,5.833,0" transform="translate(0 9.167)" fill="#fff" stroke="#727272" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/></g></svg>
                                    </button>
                                    <?/*
                                    <div class="publish-date">Опубликовано: <?=FormatDate("d.m.Y",MakeTimeStamp($fullProps['TIMESTAMP_X']))?><?=$userProps['UF_RESPONSIBLE_NAME']['VALUE']?' - '.$userProps['UF_RESPONSIBLE_NAME']['VALUE']:''?></div>
                                     */?>
                                </div>
                            <? endforeach; ?>
                        </div>
                        <div class="gallery-slider-sm" id="gallery-1-thumbs">
                            <?foreach($userProps['UF_GALLERY_IN']['VALUE'] as $galleryItem) : ?>
                                <?$img = \CFile::ResizeImageGet($galleryItem, array('width'=>145, 'height'=>94), BX_RESIZE_IMAGE_EXACT, true)['src']?>
                                <div class="slide">
                                    <img class="img lazyload" data-src="<?=$img?>" alt="alt">
                                </div>
                            <?endforeach?>
                        </div>
                    </div>
                    <?endif?>
                    <?if($userProps['UF_GALLERY']['VALUE']):?>
                    <div class="tab-gallery<?=!$userProps['UF_GALLERY']['VALUE'] ? "" : " active"?>" id="gallery-tab2">
                        <div class="gallery-slider-xl" id="gallery-slider1">
                            <? foreach($userProps['UF_GALLERY']['VALUE'] as $galleryItem) : ?>
                                <?//$img = \CFile::ResizeImageGet($galleryItem, array('width'=>1200, 'height'=>700), BX_RESIZE_IMAGE_PROPORTIONAL, true)['src']?>
                                <div class="slide">
                                    <img class="img lazyload" data-src="<?=CFile::GetPath($galleryItem)?>" alt="alt">
                                    <button class="ui-btn zoom-link" href="<?=CFile::GetPath($galleryItem)?>" data-fancybox="gallery1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="17.121" height="17.121" viewBox="0 0 17.121 17.121"><g transform="translate(1.061 1.061)"><path d="M0,0H5V5" transform="translate(10)" fill="#fff" stroke="#727272" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><path d="M5,5H0V0" transform="translate(0 10)" fill="#fff" stroke="#727272" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><path d="M5.833,0,0,5.833" transform="translate(9.167)" fill="#fff" stroke="#727272" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><path d="M0,5.833,5.833,0" transform="translate(0 9.167)" fill="#fff" stroke="#727272" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/></g></svg>
                                    </button>
                                    <?/*
                                    <div class="publish-date">Опубликовано: <?=FormatDate("d.m.Y",MakeTimeStamp($fullProps['TIMESTAMP_X']))?><?=$userProps['UF_RESPONSIBLE_NAME']['VALUE']?' - '.$userProps['UF_RESPONSIBLE_NAME']['VALUE']:''?></div>
                                     */?>
                                </div>
                            <? endforeach; ?>
                        </div>
                        <div class="gallery-slider-sm" id="gallery-slider1-thumbs">
                            <?foreach($userProps['UF_GALLERY']['VALUE'] as $galleryItem) : ?>
                                <?$img = \CFile::ResizeImageGet($galleryItem, array('width'=>145, 'height'=>94), BX_RESIZE_IMAGE_EXACT, true)['src']?>
                                <div class="slide">
                                    <img class="img lazyload" data-src="<?=$img?>" alt="alt">
                                </div>
                            <?endforeach?>
                        </div>
                    </div>
                    <?endif?>

                    <?if (
                        $userProps['UF_URL_3D']['VALUE'] ||
                        $userProps['UF_URL_STREAM1']['VALUE'] ||
                        $userProps['UF_URL_STREAM2']['VALUE'] ||
                        $userProps['UF_URL_STREAM3']['VALUE']
                    ) {
                    ?>
                        <div class="gallery-btns">
                            <? if ($userProps['UF_URL_3D']['VALUE']): ?>
                                <a target="_blank" class="btn btn--transp" href="<?=$userProps['UF_URL_3D']['VALUE'];?>">
                                    <svg class="svg svg-stroke btn__ic" xmlns="http://www.w3.org/2000/svg" width="21.5" height="21.5" viewBox="0 0 21.5 21.5"><g transform="translate(0.75 0.75)"><rect width="20" height="20" rx="10" stroke-width="1.5" stroke="#e94200" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" fill="none"/><rect width="6.667" height="6.667" rx="3.333" transform="translate(6.667 6.667)" stroke-width="1.5" stroke="#e94200" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" fill="none"/></g></svg>
                                    Аэропанорама
                                </a>
                            <? endif; ?>


                            <?global $USER;
                            if ($USER->IsAdmin() && $userProps['UF_GALLERY_IN']['VALUE'] && $userProps['UF_GALLERY']['VALUE']) {?>
                                <?if($userProps['UF_GALLERY']['VALUE']):?>
                                    <a class="btn btn--bg active tabs-gallery__btn" href="#gallery-tab2">
                                        <svg class="svg svg-stroke btn__ic" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M17.2919 0.0839966H11.861C11.7766 0.0806248 11.6924 0.0943147 11.6134 0.12428C11.5345 0.154245 11.4624 0.199866 11.4015 0.258374C11.3406 0.316882 11.2922 0.387103 11.2591 0.464795C11.226 0.542487 11.2089 0.626015 11.2089 0.710461C11.2089 0.794908 11.226 0.878497 11.2591 0.956189C11.2922 1.03388 11.3406 1.1041 11.4015 1.16261C11.4624 1.22112 11.5345 1.26674 11.6134 1.2967C11.6924 1.32667 11.7766 1.34036 11.861 1.33699H15.753L12.872 4.21797L10.295 6.795L6.95499 10.135C6.83785 10.2567 6.77307 10.4195 6.77469 10.5884C6.77631 10.7573 6.84421 10.9189 6.96365 11.0383C7.0831 11.1578 7.24457 11.2256 7.41348 11.2272C7.5824 11.2288 7.74526 11.1641 7.86697 11.047L11.2069 7.70698L13.784 5.12996L16.6649 2.24897V6.14497C16.6714 6.3068 16.7403 6.45988 16.8571 6.57209C16.9739 6.68431 17.1295 6.74696 17.2914 6.74696C17.4534 6.74696 17.6091 6.68431 17.7259 6.57209C17.8426 6.45988 17.9115 6.3068 17.918 6.14497V0.714001C17.9184 0.631495 17.9025 0.549692 17.8712 0.47334C17.84 0.396987 17.7939 0.327583 17.7357 0.269055C17.6776 0.210528 17.6084 0.164031 17.5323 0.132275C17.4561 0.100519 17.3744 0.0841273 17.2919 0.0839966Z" fill="#E94200"/>
                                            <path d="M17.398 11.8579C17.3283 11.8251 17.2529 11.8063 17.176 11.8027C17.0991 11.7991 17.0222 11.8106 16.9497 11.8367C16.8773 11.8628 16.8107 11.903 16.7538 11.9548C16.6969 12.0066 16.6507 12.0692 16.618 12.1389C16.08 13.2829 15.2735 14.28 14.2672 15.0453C13.2608 15.8105 12.0845 16.3211 10.8383 16.5338C9.59205 16.7464 8.3129 16.6547 7.10975 16.2665C5.9066 15.8783 4.81509 15.2051 3.92817 14.3042C3.04126 13.4033 2.38519 12.3013 2.01588 11.0923C1.64657 9.88318 1.57494 8.60275 1.80708 7.36002C2.03922 6.11729 2.56825 4.94909 3.34913 3.95487C4.13002 2.96064 5.1396 2.16986 6.29194 1.64987C6.42747 1.58195 6.53148 1.46426 6.58216 1.32138C6.63285 1.17851 6.62633 1.02155 6.56391 0.883395C6.50149 0.745245 6.38804 0.636623 6.24732 0.580234C6.1066 0.523844 5.94952 0.524027 5.80897 0.580844C4.48389 1.17839 3.32288 2.08741 2.42482 3.23038C1.52675 4.37335 0.918237 5.71646 0.651134 7.1453C0.38403 8.57413 0.46624 10.0463 0.890758 11.4366C1.31528 12.8268 2.06951 14.0938 3.08924 15.1297C4.10898 16.1656 5.36395 16.9396 6.74732 17.3859C8.1307 17.8322 9.60146 17.9375 11.0343 17.6929C12.4672 17.4483 13.8197 16.861 14.9766 15.981C16.1336 15.101 17.0607 13.9544 17.679 12.6389C17.7119 12.5692 17.7308 12.4936 17.7345 12.4166C17.7382 12.3396 17.7267 12.2626 17.7006 12.19C17.6745 12.1175 17.6343 12.0508 17.5823 11.9938C17.5304 11.9368 17.4678 11.8906 17.398 11.8579Z" fill="#E94200" stroke="#E94200" stroke-width="0.2"/>
                                        </svg>
                                        Вид снаружи
                                    </a>
                                <?endif?>
                                <?if($userProps['UF_GALLERY_IN']['VALUE']):?>
                                    <a class="btn btn--transp <?=!$userProps['UF_GALLERY']['VALUE'] ? " active" : ""?> tabs-gallery__btn" href="#gallery-tab1">
                                        <svg class="svg svg-stroke btn__ic" width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7.85092 6.51392C7.85092 6.3463 7.78432 6.18555 7.6658 6.06703C7.54728 5.94851 7.38652 5.88191 7.2189 5.88191C7.05129 5.88191 6.89056 5.94851 6.77203 6.06703C6.65351 6.18555 6.58691 6.3463 6.58691 6.51392V11.9909C6.58691 12.1585 6.65351 12.3193 6.77203 12.4378C6.89056 12.5563 7.05129 12.6229 7.2189 12.6229H12.6959C12.7789 12.6229 12.8611 12.6066 12.9378 12.5748C13.0145 12.5431 13.0841 12.4965 13.1428 12.4378C13.2015 12.3791 13.2481 12.3095 13.2798 12.2328C13.3116 12.1561 13.3279 12.0739 13.3279 11.9909C13.3279 11.9079 13.3116 11.8257 13.2798 11.7491C13.2481 11.6724 13.2015 11.6027 13.1428 11.544C13.0841 11.4853 13.0145 11.4388 12.9378 11.407C12.8611 11.3753 12.7789 11.3589 12.6959 11.3589H8.77191L15.5799 4.55092C15.7022 4.42865 15.7708 4.26282 15.7708 4.08992C15.7708 3.91702 15.7022 3.75119 15.5799 3.62892C15.4577 3.50667 15.2918 3.43799 15.1189 3.43799C14.946 3.43799 14.7802 3.50667 14.6579 3.62892L7.84991 10.4369L7.85092 6.51392Z" fill="#E94200"/>
                                            <path d="M18.2229 6.63606C18.1715 6.48765 18.0634 6.36566 17.9223 6.29686C17.7811 6.22805 17.6184 6.21805 17.4699 6.26905C17.3215 6.32039 17.1995 6.4285 17.1306 6.56967C17.0618 6.71083 17.0519 6.87353 17.1029 7.02206C17.3894 7.85408 17.535 8.72808 17.5338 9.60806C17.5315 11.7089 16.6959 13.723 15.2104 15.2085C13.7248 16.6941 11.7107 17.5297 9.6099 17.5321C7.50905 17.5297 5.49489 16.6941 4.00937 15.2085C2.52385 13.723 1.68827 11.7089 1.68589 9.60806C1.68827 7.50721 2.52385 5.49309 4.00937 4.00757C5.49489 2.52205 7.50905 1.68644 9.6099 1.68405C10.3891 1.68379 11.1641 1.79836 11.9099 2.02406C11.9843 2.04672 12.0625 2.05447 12.14 2.04687C12.2174 2.03928 12.2927 2.01648 12.3613 1.97979C12.4299 1.94311 12.4907 1.89325 12.54 1.83306C12.5894 1.77288 12.6264 1.70355 12.6489 1.62905C12.6716 1.5546 12.6793 1.4764 12.6717 1.39894C12.6641 1.32149 12.6413 1.24629 12.6046 1.17765C12.5679 1.10901 12.518 1.04828 12.4579 0.998928C12.3977 0.949579 12.3284 0.912584 12.2539 0.890056C11.3953 0.630111 10.503 0.498358 9.60587 0.499057C8.40918 0.495778 7.22374 0.729898 6.11814 1.18786C5.01254 1.64583 4.00875 2.31854 3.16489 3.16706C2.31637 4.01092 1.64367 5.0147 1.1857 6.1203C0.727739 7.22591 0.493581 8.41137 0.49686 9.60806C0.493581 10.8048 0.727739 11.9902 1.1857 13.0958C1.64367 14.2014 2.31637 15.2052 3.16489 16.0491C4.00875 16.8976 5.01254 17.5703 6.11814 18.0282C7.22374 18.4862 8.40918 18.7203 9.60587 18.7171C10.8026 18.7203 11.988 18.4862 13.0936 18.0282C14.1992 17.5703 15.203 16.8976 16.0468 16.0491C16.8953 15.2052 17.568 14.2014 18.026 13.0958C18.4839 11.9902 18.7181 10.8047 18.7149 9.60806C18.7173 8.59693 18.551 7.59247 18.2229 6.63606Z" fill="#E94200"/>
                                        </svg>
                                        Интерьер (холлы)
                                    </a>
                                <?endif?>
                            <?}?>

                            <? if ($userProps['UF_URL_STREAM1']['VALUE'] || $userProps['UF_URL_STREAM2']['VALUE'] || $userProps['UF_URL_STREAM3']['VALUE']) : ?>
                                <?/*?>
                                <a class="btn btn--transp" href="#p-8">
                                    <svg class="svg svg-stroke btn__ic" xmlns="http://www.w3.org/2000/svg" width="21.5" height="21.5" viewBox="0 0 21.5 21.5"><g transform="translate(0.75 0.75)"><rect width="20" height="20" rx="10" stroke-width="1.5" stroke="#e94200" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" fill="none"/><rect width="6.667" height="6.667" rx="3.333" transform="translate(6.667 6.667)" stroke-width="1.5" stroke="#e94200" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" fill="none"/></g></svg>
                                    <?/*<img class="svg svg-stroke btn__ic" src="<?=SITE_TEMPLATE_PATH;?>/img/icons/ic-circles.svg" width="20" height="20" alt="3d">*/?>
                                <?/*?>
                                    Онлайн трансляция
                                </a>
                            <?*/?>
                                <?if($userProps['UF_JK_STATUS']['VALUE'] === 'Да'):?>
                                    <a href="#modal-videobuild" data-src="" class="custom-popup__video gallery-newbuild" style="display: none">
                                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M21 11C21 5.47715 16.5228 1 11 1C5.47715 1 1 5.47715 1 11C1 16.5228 5.47715 21 11 21C16.5228 21 21 16.5228 21 11Z" stroke="white" stroke-width="1.2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M14.3818 11L9.69999 7.78122V14.2187L14.3818 11ZM15.7349 11C15.7349 11.3127 15.5904 11.6253 15.3014 11.824L10.0665 15.423C9.40302 15.8792 8.49999 15.4041 8.49999 14.599V7.40101C8.49999 6.59583 9.40302 6.12081 10.0665 6.57697L15.3014 10.1759C15.5904 10.3746 15.7349 10.6873 15.7349 11Z" fill="white"/>
                                        </svg>
                                        Аэровидеосъемка
                                    </a>
                                    <a class="btn btn--transp btn-last" href="#p-8">
                                        <svg class="svg svg-stroke btn__ic" xmlns="http://www.w3.org/2000/svg" width="21.5" height="21.5" viewBox="0 0 21.5 21.5"><g transform="translate(0.75 0.75)"><rect width="20" height="20" rx="10" stroke-width="1.5" stroke="#e94200" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" fill="none"/><rect width="6.667" height="6.667" rx="3.333" transform="translate(6.667 6.667)" stroke-width="1.5" stroke="#e94200" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" fill="none"/></g></svg>
                                        Ход строительства
                                    </a>
                                <?endif;?>
                            <? endif; ?>

                        </div>
                    <?}?>
                </div>
            </div>
        <? endif; ?>
        <? if ($userProps['UF_MAP_CODE']['VALUE']) : ?>
            <div class="project-geo section-margin scrollspy-item" id="p-3">
                <div class="container">
                    <h2 class="h1 title">Расположение и инфраструктура</h2>
                </div>
                <div class="map" id="map"></div>
                <script>
                    <?echo $userProps['UF_MAP_CODE']['~VALUE']['TEXT']?>
                </script>
                <? if ($userProps['UF_MAP_LABELS']['VALUE']) : ?>
                    <?
                    $mapLabels = [];
                    if (CModule::IncludeModule('highloadblock')) {
                        $arHLBlock = Bitrix\Highloadblock\HighloadBlockTable::getById(9)->fetch();
                        $obEntity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arHLBlock);
                        $strEntityDataClass = $obEntity->getDataClass();
                    }
                    if (CModule::IncludeModule('highloadblock')) {
                        $rsData = $strEntityDataClass::getList(array(
                                'select' => array('ID','UF_DESCRIPTION', 'UF_NAME', 'UF_FULL_DESCRIPTION', 'UF_XML_ID', 'UF_FILE'),
                                'order' => array('ID' => 'ASC'),
                                'filter' => array('UF_XML_ID' => $userProps['UF_MAP_LABELS']['VALUE']),
                                'limit' => '50',
                        ));
                        while ($arItem = $rsData->Fetch()) {
                            $mapLabels[] = $arItem;
                        }
                    }
                    ?>			
					<div class="container">
						<div class="geo-labels">
							<div class="f-row">
							<?foreach($mapLabels as $index => $label) : ?>
								<?if ($index === 0) :?>
									<div class="cols col-1-3">
								<?endif; ?>
									<div class="geo-label">											
										<?$lbSVG = CFile::GetPath($label['UF_FILE']);?>
										<?if($lbSVG):?>
											<img src="<?=$lbSVG?>" />
										<?else:?>
											<span class="geo-label__ic" style="background: <?=$label['UF_DESCRIPTION']?>"> </span>
										<?endif;?>
										<?=$label['UF_NAME']?>
									</div>
								<?if (($index+1) % 4 === 0) :?>
									</div>
								<?endif;?>
								<?if (($index+1) % 4 === 0) :?>
									<div class="cols col-1-3">
								<? endif; ?>
							<?endforeach;?>
									</div>
						</div>
						</div>
					</div>		
                <? endif; ?>
            </div>
        <? endif; ?>
        <? if ($userProps['UF_ADVANTAGES_GALLERY']['VALUE']) :?>
            <?
            $advantages = [];
            if (CModule::IncludeModule('highloadblock')) {
                $arHLBlock = Bitrix\Highloadblock\HighloadBlockTable::getById(8)->fetch();
                $obEntity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arHLBlock);
                $strEntityDataClass = $obEntity->getDataClass();
            }
            if (CModule::IncludeModule('highloadblock')) {
                $rsData = $strEntityDataClass::getList(array(
                        'select' => array('ID','UF_FILE','UF_DESCRIPTION', 'UF_NAME', 'UF_XML_ID', 'UF_ALT_FIELD'),
                        'order' => array('ID' => 'ASC'),
                        'filter' => array('UF_XML_ID' => $userProps['UF_ADVANTAGES_GALLERY']['VALUE']),
                        'limit' => '50',
                ));
                while ($arItem = $rsData->Fetch()) {
                    $advantages[] = $arItem;
                }
                foreach ($advantages as $aKey => $aItem) {
                    $hiXMLIDs[] = $advantages[$aKey]['UF_XML_ID'];
                }
                $customerSorted = array_replace(array_flip($userProps['UF_ADVANTAGES_GALLERY']['VALUE']), array_flip($hiXMLIDs));
                $advantages = array_replace(array_flip($customerSorted), $advantages);
            }
            ?>

			<div class="scrollspy-item" id="p-4">
	            <div class="container advantages-new-top" >
	              <h2 class="h1 title advantages-new__title">Преимущества</h2>
	                  <?if(count($advantages)>1){?>
	                      <div class="advantages-new-slider__prev"><svg version="1.1" viewBox="0 0 7 12"><path fill="currentColor" stroke="none" pid="0" d="M.47 1.53A.75.75 0 111.53.47l5 5a.75.75 0 010 1.06l-5 5a.75.75 0 01-1.06-1.06L4.94 6 .47 1.53z" _fill="#fff" fill-rule="nonzero"></path></svg></div>
	                      <div class="advantages-new-slider__next"><svg version="1.1" viewBox="0 0 7 12"><path fill="currentColor" stroke="none" pid="0" d="M.47 1.53A.75.75 0 111.53.47l5 5a.75.75 0 010 1.06l-5 5a.75.75 0 01-1.06-1.06L4.94 6 .47 1.53z" _fill="#fff" fill-rule="nonzero"></path></svg></div>
	                  <?}?>
	            </div>
	            <div class="advantages-new">
	              <div class="advantages-new-slider">
	                <? foreach($advantages as $advantagesItem) {?>
	                    <div class="advantages-new-slide">
	                      <div class="advantages-new-slide-imgbox">
	                        <?$img = \CFile::ResizeImageGet($advantagesItem['UF_FILE'], array('width'=>590, 'height'=>330), BX_RESIZE_IMAGE_EXACT, true)['src']?>
	                        <img class="lazyload" data-src="<?=$img;?>" alt="<?echo ($advantagesItem['UF_ALT_FIELD']) ? $advantagesItem['UF_ALT_FIELD'] : 'advantage'?>">
	                      </div>
	                      <div class="advantages-new-slide-content">
	                        <div class="advantages-new-slide-content-description">
	                          <h3 class="advantages-new-slide-content__title"><?=$advantagesItem['UF_NAME'];?></h3>
	                          <p>
	                              <?=$advantagesItem['UF_DESCRIPTION'];?>
	                          </p>
	                        </div>
	                      </div>
	                    </div>
	                    <?}?>
	              </div>
	            </div>
            </div>
<?/*
            <div class="project-advantages section-margin scrollspy-item" id="p-4">
                <div class="container">
                    <h2 class="h1 title">Преимущества</h2>

                    <div class="advantages-slider">
                        <div class="slide">
                            <div class="p-item page-block">
                                <div class="p-item__img">
                                    <div class="advantages-slider-img">
                                        <? foreach($advantages as $advantagesItem) : ?>
                                            <div class="slide">
                                                <img class="img" src="<?=CFile::GetPath($advantagesItem['UF_FILE']);?>" alt="<?echo ($advantagesItem['UF_ALT_FIELD']) ? $advantagesItem['UF_ALT_FIELD'] : 'alt'?>">
                                                <button class="ui-btn zoom-link" href="<?=CFile::GetPath($advantagesItem['UF_FILE']);?>" data-fancybox="advantage1">
                                                    <svg class="svg" style="width: 15px; height: 15px" xmlns="http://www.w3.org/2000/svg" width="17.121" height="17.121" viewBox="0 0 17.121 17.121"><g transform="translate(1.061 1.061)"><path d="M0,0H5V5" transform="translate(10)" fill="#fff" stroke="#727272" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><path d="M5,5H0V0" transform="translate(0 10)" fill="#fff" stroke="#727272" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><path d="M5.833,0,0,5.833" transform="translate(9.167)" fill="#fff" stroke="#727272" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><path d="M0,5.833,5.833,0" transform="translate(0 9.167)" fill="#fff" stroke="#727272" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/></g></svg>
                                                </button>
                                            </div>
                                        <? endforeach; ?>
                                    </div>
                                </div>
                                <div class="p-item__content">
                                    <div class="advantages-slider-text">
                                        <? foreach($advantages as $advantagesItem) : ?>
                                            <div class="slide">
                                                <div class="h2 text-bold"><?=$advantagesItem['UF_NAME'];?></div>
                                                <div class="p-item__title"><?=$advantagesItem['UF_DESCRIPTION'];?></div>
                                                <?if(count($advantages)>1){?>
                                                    <div class="advantages-slider-btns">
                                                        <button class="slider-arrow slider-prev" type="button">
                                                            <svg class="svg" xmlns="http://www.w3.org/2000/svg" width="12.121" height="6.811" viewbox="0 0 12.121 6.811">
                                                                <g transform="translate(1.061 1.061)"></g>
                                                                <path d="M0,0,5,5l5-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"></path>
                                                            </svg>
                                                        </button>
                                                        <button class="slider-arrow slider-next" type="button">
                                                            <svg class="svg" xmlns="http://www.w3.org/2000/svg" width="12.121" height="6.811" viewbox="0 0 12.121 6.811">
                                                                <g transform="translate(1.061 1.061)"></g>
                                                                <path d="M0,0,5,5l5-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"></path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                <?}?>
                                            </div>
                                        <? endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            */?>


            <?
            if (CSite::InDir('/newbuild/zoom_apart/')) {?>
            <div class="container section-margin scrollspy-item" id="p-11">
                <h2 class="h1 title">Типы номеров</h2>
                <div class="types-block tabs">
                	<div class="types-block-nav-wrap">
                		<div class="types-block-nav__active">18.6 м<sup>2</sup></a></div>
	                    <div class="types-block-nav">
	                        <a href="#tab1" class="types-block-nav__item tabs-navigation-item active">18.6 м<sup>2</sup></a>
                            <a href="#tab5" class="types-block-nav__item tabs-navigation-item">18.6 м<sup>2</sup>  (Тип 2)</a>
                            <a href="#tab4" class="types-block-nav__item tabs-navigation-item">24.6 м<sup>2</sup></a>
	                        <a href="#tab2" class="types-block-nav__item tabs-navigation-item">27.2 м<sup>2</sup></a>
                            <a href="#tab6" class="types-block-nav__item tabs-navigation-item">30.7 м<sup>2</sup></a>
	                        <a href="#tab3" class="types-block-nav__item tabs-navigation-item">32.2 м<sup>2</sup></a>
	                    </div>
	                </div>
                    <div class="types-block-tabs">
                        <div class="types-block-tabs-tab tabs-tab active" id="tab1">
                            <div class="types-block-tabs-tab-nav">
                                <div class="types-block-tabs-tab-nav__item plan">Планировка</div>
                                <div class="types-block-tabs-tab-nav__item gallery active">Интерьеры</div>
                            </div>
                            <div class="types-block-tabs-tab-scheme">
                                <div class="types-block-tabs-tab-scheme-wrap">
                                    <img src="/local/templates/fsk/img/zoom-apart/1/0.png" alt="">
                                    <div class="scheme-tooltip" style="top:110px;left:245px"><span>Эргономичный санузел</br> с тропическим душем</span></div>
                                    <div class="scheme-tooltip" style="top:330px;left:260px"><span>Спальная зона с</br> индивидуальным светом</span></div>
                                    <div class="scheme-tooltip" style="top:250px;left:240px"><span>Обеденная зона</span></div>
                                    <div class="scheme-tooltip right" style="top:470px;left:130px"><span>Окна с функцией микропроветривания</br> и шторы "блэк-аут"</span></div>
                                    <div class="scheme-tooltip right" style="top:150px;left:80px"><span>Место для уличной одежды</span></div>
                                    <div class="scheme-tooltip right" style="top:50px;left:160px"><span>Вместительный гардероб</span></div>
                                    <div class="scheme-tooltip right" style="top:390px;left:80px"><span>Рабочее пространство.</br>Smart TV</span></div>
                                </div>
                            </div>
                            <div class="types-block-tabs-tab-slider">
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/1/1.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/1/2.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/1/3.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/1/4.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/1/5.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/1/6.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/1/7.jpg" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="types-block-tabs-tab tabs-tab" id="tab2">
                            <div class="types-block-tabs-tab-nav">
                                <div class="types-block-tabs-tab-nav__item plan">Планировка</div>
                                <div class="types-block-tabs-tab-nav__item gallery active">Интерьеры</div>
                            </div>
                            <div class="types-block-tabs-tab-scheme">
                                <div class="types-block-tabs-tab-scheme-wrap">
                                    <img src="/local/templates/fsk/img/zoom-apart/2/0.jpg" alt="">
                                    <div class="scheme-tooltip right" style="top:380px;left:135px"><span>Эргономичный санузел</br> с тропическим душем</span></div>
                                    <div class="scheme-tooltip right" style="top:200px;left:60px"><span>Спальная зона с</br> индивидуальным светом</span></div>
                                    <div class="scheme-tooltip right" style="top:270px;left:130px"><span>Обеденная зона</span></div>
                                    <div class="scheme-tooltip right" style="top:50px;left:170px"><span>Окна с функцией микропроветривания</br> и шторы "блэк-аут"</span></div>
                                    <div class="scheme-tooltip" style="top:430px;left:300px"><span>Место для уличной одежды</span></div>
                                    <div class="scheme-tooltip" style="top:120px;left:300px"><span>Рабочая зона</span></div>
                                    <div class="scheme-tooltip" style="top:200px;left:300px"><span>Smart TV</span></div>
                                </div>
                            </div>
                            <div class="types-block-tabs-tab-slider">
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/2/1.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/2/2.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/2/3.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/2/4.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/2/5.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/2/6.jpg" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="types-block-tabs-tab tabs-tab" id="tab3">
                            <div class="types-block-tabs-tab-nav">
                                <div class="types-block-tabs-tab-nav__item plan">Планировка</div>
                                <div class="types-block-tabs-tab-nav__item gallery active">Интерьеры</div>
                            </div>
                            <div class="types-block-tabs-tab-scheme">
                                <div class="types-block-tabs-tab-scheme-wrap">
                                    <img src="/local/templates/fsk/img/zoom-apart/3/0.png" alt="">
                                    <div class="scheme-tooltip right" style="top:420px;left:135px"><span>Эргономичный санузел</br> с тропическим душем</span></div>
                                    <div class="scheme-tooltip right" style="top:110px;left:100px"><span>Спальная зона с</br> индивидуальным светом</span></div>
                                    <div class="scheme-tooltip right" style="top:250px;left:150px"><span>Обеденная зона</span></div>
                                    <div class="scheme-tooltip right" style="top:40px;left:170px"><span>Окна с функцией микропроветривания</br> и шторы "блэк-аут"</span></div>
                                    <div class="scheme-tooltip" style="top:380px;left:260px"><span>Место для уличной одежды</span></div>
                                    <div class="scheme-tooltip" style="top:150px;left:260px"><span>Smart TV</span></div>
                                </div>
                            </div>
                            <div class="types-block-tabs-tab-slider">
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/3/1.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/3/2.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/3/3.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/3/4.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/3/5.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/3/6.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/3/7.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/3/8.jpg" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="types-block-tabs-tab tabs-tab" id="tab4">
                            <div class="types-block-tabs-tab-nav">
                                <div class="types-block-tabs-tab-nav__item plan">Планировка</div>
                                <div class="types-block-tabs-tab-nav__item gallery active">Интерьеры</div>
                            </div>
                            <div class="types-block-tabs-tab-scheme">
                                <div class="types-block-tabs-tab-scheme-wrap">
                                    <img src="/local/templates/fsk/img/zoom-apart/4/0.jpg" alt="">
                                    <div class="scheme-tooltip" style="top:350px;left:285px"><span>Эргономичный санузел</br> с тропическим душем</span></div>
                                    <div class="scheme-tooltip right" style="top:150px;left:50px"><span>Спальная зона с</br> индивидуальным светом</span></div>
                                    <div class="scheme-tooltip" style="top:130px;left:290px"><span>Обеденная зона</span></div>
                                    <div class="scheme-tooltip right" style="top:40px;left:140px"><span>Окна с функцией микропроветривания</br> и шторы "блэк-аут"</span></div>
                                    <div class="scheme-tooltip right" style="top:450px;left:40px"><span>Место для уличной одежды</span></div>
                                    <div class="scheme-tooltip" style="top:160px;left:210px"><span>Рабочее пространство.</br>Smart TV</span></div>
                                </div>
                            </div>
                            <div class="types-block-tabs-tab-slider">
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/4/1.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/4/2.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/4/3.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/4/4.jpg" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="types-block-tabs-tab tabs-tab" id="tab5">
                            <div class="types-block-tabs-tab-nav">
                                <div class="types-block-tabs-tab-nav__item plan">Планировка</div>
                                <div class="types-block-tabs-tab-nav__item gallery active">Интерьеры</div>
                            </div>
                            <div class="types-block-tabs-tab-scheme">
                                <div class="types-block-tabs-tab-scheme-wrap">
                                    <img src="/local/templates/fsk/img/zoom-apart/5/0.png" alt="">
                                    <div class="scheme-tooltip right" style="top:370px;left:90px"><span>Эргономичный санузел</br> с тропическим душем</span></div>
                                    <div class="scheme-tooltip" style="top:170px;left:290px"><span>Спальная зона с</br> индивидуальным светом</span></div>
                                    <div class="scheme-tooltip right" style="top:160px;left:60px"><span>Обеденная зона</span></div>
                                    <div class="scheme-tooltip" style="top:100px;left:280px"><span>Окна с функцией микропроветривания</br> и шторы "блэк-аут"</span></div>
                                    <div class="scheme-tooltip" style="top:420px;left:300px"><span>Место для уличной одежды</span></div>
                                    <div class="scheme-tooltip right" style="top:150px;left:160px"><span>Рабочее пространство.</br>Smart TV</span></div>
                                </div>
                            </div>
                            <div class="types-block-tabs-tab-slider">
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/5/1.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/5/2.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/5/3.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/5/4.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/5/5.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/5/6.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/5/7.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/5/8.jpg" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="types-block-tabs-tab tabs-tab" id="tab6">
                            <div class="types-block-tabs-tab-nav">
                                <div class="types-block-tabs-tab-nav__item plan">Планировка</div>
                                <div class="types-block-tabs-tab-nav__item gallery active">Интерьеры</div>
                            </div>
                            <div class="types-block-tabs-tab-scheme">
                                <div class="types-block-tabs-tab-scheme-wrap">
                                    <img src="/local/templates/fsk/img/zoom-apart/6/0.png" alt="">
                                    <div class="scheme-tooltip right" style="top:330px;left:95px"><span>Эргономичный санузел</br> с тропическим душем</span></div>
                                    <div class="scheme-tooltip" style="top:130px;left:290px"><span>Спальная зона с</br> индивидуальным светом</span></div>
                                    <div class="scheme-tooltip right" style="top:140px;left:60px"><span>Обеденная зона</span></div>
                                    <div class="scheme-tooltip right" style="top:30px;left:180px"><span>Окна с функцией микропроветривания</br> и шторы "блэк-аут"</span></div>
                                    <div class="scheme-tooltip" style="top:250px;left:260px"><span>Зона отдыха</span></div>
                                    <div class="scheme-tooltip right" style="top:180px;left:160px"><span>Smart TV</span></div>
                                    <div class="scheme-tooltip" style="top:440px;left:260px"><span>Вместительный гардероб</span></div>
                                </div>
                            </div>
                            <div class="types-block-tabs-tab-slider">
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/6/1.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/6/2.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/6/3.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/6/4.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/6/5.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/6/6.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/6/7.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/6/8.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/6/9.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container section-margin scrollspy-item" id="p-12">
                <h2 class="h1 title">Доходность апартаментов</h2>
                <div class="profit-wrap">
                    <div class="profit-block">
                        <div class="profit-block__title">Программа Zoom Invest</div>
                        <div class="profit-block__text">Программа с высоким потенциальным доходом для инвесторов, ориентированных на максимальную прибыль!</div>
                        <div class="profit-block-row">
                            <span>Доходность</span>
                            <span>до 17% годовых</span>
                        </div>
                        <div class="profit-block-row">
                            <span>Срок окупаемости</span>
                            <span>6 лет</span>
                        </div>
                        <div class="profit-block-row">
                            <span>Максимальный доход в месяц</span>
                            <span>58 000 р.</span>
                        </div>
                        <div class="profit-block-row">
                            <span>Средний доход в год / 3 года</span>
                            <span>453 000 р. / 1 480 000 р.</span>
                        </div>
                        <a class="btn btn--bg profit-block__btn popup-btn-FORM11" href="#modal-FORM11">
                            <svg class="svg btn__ic" style="width: 20px;height: 20px" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><g transform="translate(-1292 -4412)"><g transform="translate(1292 4412)" fill="none"><path d="M10,0A10,10,0,1,1,0,10,10,10,0,0,1,10,0Z" stroke="none"></path><path d="M 10 1.5 C 5.313079833984375 1.5 1.5 5.313079833984375 1.5 10 C 1.5 14.68692016601563 5.313079833984375 18.5 10 18.5 C 14.68692016601563 18.5 18.5 14.68692016601563 18.5 10 C 18.5 5.313079833984375 14.68692016601563 1.5 10 1.5 M 10 0 C 15.52285003662109 0 20 4.477149963378906 20 10 C 20 15.52285003662109 15.52285003662109 20 10 20 C 4.477149963378906 20 0 15.52285003662109 0 10 C 0 4.477149963378906 4.477149963378906 0 10 0 Z" stroke="none" fill="#fff"></path></g><g transform="translate(-0.77 -0.826)"><line y1="7" x2="6.77" transform="translate(1299.5 4419.326)" fill="none" stroke="#fff" stroke-linecap="round" stroke-width="1.5"></line><g transform="translate(1298.77 4418.826)" fill="#fff" stroke="#fff" stroke-width="1"><circle cx="1" cy="1" r="1" stroke="none"></circle><circle cx="1" cy="1" r="0.5" fill="none"></circle></g><g transform="translate(1304.77 4424.826)" fill="#fff" stroke="#fff" stroke-width="1"><circle cx="1" cy="1" r="1" stroke="none"></circle><circle cx="1" cy="1" r="0.5" fill="none"></circle></g></g></g></svg>
                            Получить расчет
                        </a>
                    </div>
                    
                    <div class="profit-graf">
                        <div class="profit-graf__title">Прогноз роста цены юнита</div>
                        <div class="profit-graf__text">График роста стоимости вашего апартамента за период от начала строительства до сдачи в эксплуатацию. Ваш актив увеличится в стоимости до <b>+40%.</b></div>
                        <div class="profit-graf__img">
                            <svg class="desctop-graf" xmlns="http://www.w3.org/2000/svg" width="509" height="200" viewBox="0 0 509 200" fill="none" preserveAspectRatio="none">
                                <path d="M5 195L150.5 103L333 48L502.5 4.5" stroke="#727272"/>
                                <circle cx="5" cy="195" r="5" fill="#E84001"/>
                                <circle cx="504" cy="5" r="5" fill="#E84001"/>
                                <circle cx="150" cy="103" r="5" fill="#E84001"/>
                                <circle cx="333" cy="48" r="5" fill="#E84001"/>
                            </svg>
                            <svg class="mobile-graf" width="306" height="190" viewBox="0 0 306 190" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                                <path d="M4.84375 183.971L91.213 97.4632L199.545 45.7468L300.161 4.84375" stroke="#727272"/>
                                <circle cx="91.1758" cy="98.9219" r="5" fill="#E84001"/>
                                <circle cx="300.32" cy="5" r="5" fill="#E84001"/>
                                <circle cx="195.746" cy="47.6016" r="5" fill="#E84001"/>
                                <circle cx="5" cy="184.129" r="5" fill="#E84001"/>
                            </svg>
                            <div class="profit-graf__img-text">Расчет на основе стоимости юнита 2&nbsp;340&nbsp;000&nbsp;руб. </br>Не является офертой.</div>
                            <div class="graf-value graf-value-1">2 340 000</div>
                            <div class="graf-value graf-value-2">3 042 000</div>
                            <div class="graf-value graf-value-3">3 159 000</div>
                            <div class="graf-value graf-value-4">3 276 000</div>
                            <div class="graf-percent graf-percent-1">+30%</div>
                            <div class="graf-percent graf-percent-2">+35%</div>
                            <div class="graf-percent graf-percent-3">+40%</div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="container section-margin scrollspy-item" id="p-13">
                <h2 class="h1 title">Сравнение доходности</h2>
                <div class="compare-block">
                    <div class="compare-block-wrap">
                        <div class="compare-block-row">
                            <div class="compare-block-row-col compare-block-row-4-col">Тип инвестиций</div>
                            <div class="compare-block-row-col compare-block-row-4-col">Доходность</div>
                            <div class="compare-block-row-col compare-block-row-4-col">Безоп-ть вложений</div>
                            <!--<div class="compare-block-row-col">Стабильность</div>-->
                            <!--<div class="compare-block-row-col">Доступность</div>-->
                            <div class="compare-block-row-col compare-block-row-4-col">Силы и время</div>
                        </div>
                        <div class="compare-block-row">
                            <div class="compare-block-row-col compare-block-row-4-col">Квартира</div>
                            <div class="compare-block-row-col compare-block-row-4-col">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15">
                                  <g id="Group_3114" data-name="Group 3114" transform="translate(1425 4820) rotate(180)">
                                    <circle id="Ellipse_62" data-name="Ellipse 62" cx="7.5" cy="7.5" r="7.5" transform="translate(1410 4805)" fill="#b70000"/>
                                    <g id="Group_3108" data-name="Group 3108" transform="translate(0.021 0.035)">
                                      <line id="Line_359" data-name="Line 359" y2="6.986" transform="translate(1417.479 4808.034)" fill="none" stroke="#fff" stroke-width="2"/>
                                      <path id="Polygon_2" data-name="Polygon 2" d="M2.5,0,5,5H0Z" transform="translate(1419.979 4817.965) rotate(180)" fill="#fff"/>
                                    </g>
                                  </g>
                                </svg>
                                <span>4-6%</span>
                            </div>
                            <div class="compare-block-row-col compare-block-row-4-col">Средняя</div>
                            <!--<div class="compare-block-row-col">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16.174" height="19.174" viewBox="0 0 16.174 19.174">
                                  <g id="Group_3083" data-name="Group 3083" transform="translate(-1043 -3717.826)">
                                    <g id="Ellipse_60" data-name="Ellipse 60" transform="translate(1043 3722)" fill="#fff" stroke="#e94200" stroke-width="1">
                                      <circle cx="7.5" cy="7.5" r="7.5" stroke="none"/>
                                      <circle cx="7.5" cy="7.5" r="7" fill="none"/>
                                    </g>
                                    <g id="Group_3077" data-name="Group 3077" transform="translate(0 1)">
                                      <line id="Line_352" data-name="Line 352" x2="4" y2="7" transform="translate(1046.5 3725.91)" fill="none" stroke="#000" stroke-linecap="round" stroke-width="1"/>
                                      <line id="Line_353" data-name="Line 353" x1="8" y2="15.41" transform="translate(1050.5 3717.5)" fill="none" stroke="#000" stroke-linecap="round" stroke-width="1"/>
                                    </g>
                                  </g>
                                </svg>
                            </div>
                            <div class="compare-block-row-col">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16.174" height="19.174" viewBox="0 0 16.174 19.174">
                                  <g id="Group_3083" data-name="Group 3083" transform="translate(-1043 -3717.826)">
                                    <g id="Ellipse_60" data-name="Ellipse 60" transform="translate(1043 3722)" fill="#fff" stroke="#e94200" stroke-width="1">
                                      <circle cx="7.5" cy="7.5" r="7.5" stroke="none"/>
                                      <circle cx="7.5" cy="7.5" r="7" fill="none"/>
                                    </g>
                                    <g id="Group_3077" data-name="Group 3077" transform="translate(0 1)">
                                      <line id="Line_352" data-name="Line 352" x2="4" y2="7" transform="translate(1046.5 3725.91)" fill="none" stroke="#000" stroke-linecap="round" stroke-width="1"/>
                                      <line id="Line_353" data-name="Line 353" x1="8" y2="15.41" transform="translate(1050.5 3717.5)" fill="none" stroke="#000" stroke-linecap="round" stroke-width="1"/>
                                    </g>
                                  </g>
                                </svg>
                            </div>-->
                            <div class="compare-block-row-col compare-block-row-4-col">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15">
                                  <g id="Group_3111" data-name="Group 3111" transform="translate(1425 4820) rotate(180)">
                                    <circle id="Ellipse_62" data-name="Ellipse 62" cx="7.5" cy="7.5" r="7.5" transform="translate(1410 4805)" fill="#b70000"/>
                                    <g id="Group_3108" data-name="Group 3108" transform="translate(0.021 0.035)">
                                      <line id="Line_359" data-name="Line 359" y2="6.986" transform="translate(1417.479 4808.034)" fill="none" stroke="#fff" stroke-width="2"/>
                                      <path id="Polygon_2" data-name="Polygon 2" d="M2.5,0,5,5H0Z" transform="translate(1419.979 4817.965) rotate(180)" fill="#fff"/>
                                    </g>
                                  </g>
                                </svg>
                                <span>Много</span>
                            </div>
                        </div>
                        <div class="compare-block-row">
                            <div class="compare-block-row-col compare-block-row-4-col">Депозит в банке</div>
                            <div class="compare-block-row-col compare-block-row-4-col">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15">
                                  <g id="Group_3112" data-name="Group 3112" transform="translate(1425 4820) rotate(180)">
                                    <circle id="Ellipse_62" data-name="Ellipse 62" cx="7.5" cy="7.5" r="7.5" transform="translate(1410 4805)" fill="#fbda07"/>
                                    <g id="Group_3108" data-name="Group 3108" transform="translate(0.021 0.035)">
                                      <line id="Line_359" data-name="Line 359" y2="6.986" transform="translate(1417.479 4808.034)" fill="none" stroke="#fff" stroke-width="2"/>
                                      <path id="Polygon_2" data-name="Polygon 2" d="M2.5,0,5,5H0Z" transform="translate(1419.979 4817.965) rotate(180)" fill="#fff"/>
                                    </g>
                                  </g>
                                </svg>
                                <span>5-7%</span>
                            </div>
                            <div class="compare-block-row-col compare-block-row-4-col">Низкая</div>
                            <!--<div class="compare-block-row-col">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16.174" height="19.174" viewBox="0 0 16.174 19.174">
                                  <g id="Group_3083" data-name="Group 3083" transform="translate(-1043 -3717.826)">
                                    <g id="Ellipse_60" data-name="Ellipse 60" transform="translate(1043 3722)" fill="#fff" stroke="#e94200" stroke-width="1">
                                      <circle cx="7.5" cy="7.5" r="7.5" stroke="none"/>
                                      <circle cx="7.5" cy="7.5" r="7" fill="none"/>
                                    </g>
                                    <g id="Group_3077" data-name="Group 3077" transform="translate(0 1)">
                                      <line id="Line_352" data-name="Line 352" x2="4" y2="7" transform="translate(1046.5 3725.91)" fill="none" stroke="#000" stroke-linecap="round" stroke-width="1"/>
                                      <line id="Line_353" data-name="Line 353" x1="8" y2="15.41" transform="translate(1050.5 3717.5)" fill="none" stroke="#000" stroke-linecap="round" stroke-width="1"/>
                                    </g>
                                  </g>
                                </svg>
                            </div>
                            <div class="compare-block-row-col">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16.174" height="19.174" viewBox="0 0 16.174 19.174">
                                  <g id="Group_3083" data-name="Group 3083" transform="translate(-1043 -3717.826)">
                                    <g id="Ellipse_60" data-name="Ellipse 60" transform="translate(1043 3722)" fill="#fff" stroke="#e94200" stroke-width="1">
                                      <circle cx="7.5" cy="7.5" r="7.5" stroke="none"/>
                                      <circle cx="7.5" cy="7.5" r="7" fill="none"/>
                                    </g>
                                    <g id="Group_3077" data-name="Group 3077" transform="translate(0 1)">
                                      <line id="Line_352" data-name="Line 352" x2="4" y2="7" transform="translate(1046.5 3725.91)" fill="none" stroke="#000" stroke-linecap="round" stroke-width="1"/>
                                      <line id="Line_353" data-name="Line 353" x1="8" y2="15.41" transform="translate(1050.5 3717.5)" fill="none" stroke="#000" stroke-linecap="round" stroke-width="1"/>
                                    </g>
                                  </g>
                                </svg>
                            </div>-->
                            <div class="compare-block-row-col compare-block-row-4-col">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15">
                                  <g id="Group_3109" data-name="Group 3109" transform="translate(-1410 -4805)">
                                    <circle id="Ellipse_62" data-name="Ellipse 62" cx="7.5" cy="7.5" r="7.5" transform="translate(1410 4805)" fill="#87b700"/>
                                    <g id="Group_3108" data-name="Group 3108" transform="translate(0.021 0.035)">
                                      <line id="Line_359" data-name="Line 359" y2="6.986" transform="translate(1417.479 4808.034)" fill="none" stroke="#fff" stroke-width="2"/>
                                      <path id="Polygon_2" data-name="Polygon 2" d="M2.5,0,5,5H0Z" transform="translate(1419.979 4817.965) rotate(180)" fill="#fff"/>
                                    </g>
                                  </g>
                                </svg>
                                <span>Мало</span>
                            </div>
                        </div>
                        <div class="compare-block-row">
                            <div class="compare-block-row-col compare-block-row-4-col">Апартаменты</div>
                            <div class="compare-block-row-col compare-block-row-4-col">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15">
                                  <g id="Group_3113" data-name="Group 3113" transform="translate(1425 4820) rotate(180)">
                                    <circle id="Ellipse_62" data-name="Ellipse 62" cx="7.5" cy="7.5" r="7.5" transform="translate(1410 4805)" fill="#87b700"/>
                                    <g id="Group_3108" data-name="Group 3108" transform="translate(0.021 0.035)">
                                      <line id="Line_359" data-name="Line 359" y2="6.986" transform="translate(1417.479 4808.034)" fill="none" stroke="#fff" stroke-width="2"/>
                                      <path id="Polygon_2" data-name="Polygon 2" d="M2.5,0,5,5H0Z" transform="translate(1419.979 4817.965) rotate(180)" fill="#fff"/>
                                    </g>
                                  </g>
                                </svg>
                                <span>до 17%</span>
                            </div>
                            <div class="compare-block-row-col compare-block-row-4-col">Высокая</div>
                            <!--<div class="compare-block-row-col">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16.174" height="19.174" viewBox="0 0 16.174 19.174">
                                  <g id="Group_3083" data-name="Group 3083" transform="translate(-1043 -3717.826)">
                                    <g id="Ellipse_60" data-name="Ellipse 60" transform="translate(1043 3722)" fill="#fff" stroke="#e94200" stroke-width="1">
                                      <circle cx="7.5" cy="7.5" r="7.5" stroke="none"/>
                                      <circle cx="7.5" cy="7.5" r="7" fill="none"/>
                                    </g>
                                    <g id="Group_3077" data-name="Group 3077" transform="translate(0 1)">
                                      <line id="Line_352" data-name="Line 352" x2="4" y2="7" transform="translate(1046.5 3725.91)" fill="none" stroke="#000" stroke-linecap="round" stroke-width="1"/>
                                      <line id="Line_353" data-name="Line 353" x1="8" y2="15.41" transform="translate(1050.5 3717.5)" fill="none" stroke="#000" stroke-linecap="round" stroke-width="1"/>
                                    </g>
                                  </g>
                                </svg>
                            </div>
                            <div class="compare-block-row-col">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16.174" height="19.174" viewBox="0 0 16.174 19.174">
                                  <g id="Group_3083" data-name="Group 3083" transform="translate(-1043 -3717.826)">
                                    <g id="Ellipse_60" data-name="Ellipse 60" transform="translate(1043 3722)" fill="#fff" stroke="#e94200" stroke-width="1">
                                      <circle cx="7.5" cy="7.5" r="7.5" stroke="none"/>
                                      <circle cx="7.5" cy="7.5" r="7" fill="none"/>
                                    </g>
                                    <g id="Group_3077" data-name="Group 3077" transform="translate(0 1)">
                                      <line id="Line_352" data-name="Line 352" x2="4" y2="7" transform="translate(1046.5 3725.91)" fill="none" stroke="#000" stroke-linecap="round" stroke-width="1"/>
                                      <line id="Line_353" data-name="Line 353" x1="8" y2="15.41" transform="translate(1050.5 3717.5)" fill="none" stroke="#000" stroke-linecap="round" stroke-width="1"/>
                                    </g>
                                  </g>
                                </svg>
                            </div>-->
                            <div class="compare-block-row-col compare-block-row-4-col">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15">
                                  <g id="Group_3109" data-name="Group 3109" transform="translate(-1410 -4805)">
                                    <circle id="Ellipse_62" data-name="Ellipse 62" cx="7.5" cy="7.5" r="7.5" transform="translate(1410 4805)" fill="#87b700"/>
                                    <g id="Group_3108" data-name="Group 3108" transform="translate(0.021 0.035)">
                                      <line id="Line_359" data-name="Line 359" y2="6.986" transform="translate(1417.479 4808.034)" fill="none" stroke="#fff" stroke-width="2"/>
                                      <path id="Polygon_2" data-name="Polygon 2" d="M2.5,0,5,5H0Z" transform="translate(1419.979 4817.965) rotate(180)" fill="#fff"/>
                                    </g>
                                  </g>
                                </svg>
                                <span>Мало</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?}?>



        <? endif; ?>
        <? if (!empty($userProps['UF_DISCOUNTS_LIST']['VALUE'])) :
                $GLOBALS['stockFilter']=["ID"=>$userProps['UF_DISCOUNTS_LIST']['VALUE']];
            ?><div class="container section-margin scrollspy-item" id="p-5">
                <h2 class="h1 title">Акции и скидки</h2><?
                $APPLICATION->IncludeComponent(
                    "bitrix:catalog.section",
                    "stock",
                    array(
                        "ACTION_VARIABLE" => "action",
                        "ADD_PICT_PROP" => "-",
                        "ADD_PROPERTIES_TO_BASKET" => "N",
                        "ADD_SECTIONS_CHAIN" => "N",
                        "ADD_TO_BASKET_ACTION" => "ADD",
                        "AJAX_MODE" => "N",
                        "AJAX_OPTION_ADDITIONAL" => "",
                        "AJAX_OPTION_HISTORY" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "BACKGROUND_IMAGE" => "-",
                        "BASKET_URL" => "/personal/basket.php",
                        "BROWSER_TITLE" => "-",
                        "CACHE_FILTER" => "N",
                        "CACHE_GROUPS" => "Y",
                        "CACHE_TIME" => "36000000",
                        "CACHE_TYPE" => "A",
                        "COMPATIBLE_MODE" => "Y",
                        "CONVERT_CURRENCY" => "N",
                        "CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
                        "DETAIL_URL" => "",
                        "DISABLE_INIT_JS_IN_COMPONENT" => "N",
                        "DISPLAY_BOTTOM_PAGER" => "N",
                        "DISPLAY_COMPARE" => "N",
                        "DISPLAY_TOP_PAGER" => "N",
                        "ELEMENT_SORT_FIELD" => "sort",
                        "ELEMENT_SORT_FIELD2" => "id",
                        "ELEMENT_SORT_ORDER" => "desc",
                        "ELEMENT_SORT_ORDER2" => "desc",
                        "ENLARGE_PRODUCT" => "STRICT",
                        "FILE_404" => "",
                        "FILTER_NAME" => "stockFilter",
                        "HIDE_NOT_AVAILABLE" => "N",
                        "HIDE_NOT_AVAILABLE_OFFERS" => "N",
                        "IBLOCK_ID" => $userProps['UF_DISCOUNTS_LIST']['LINK_IBLOCK_ID'],
                        "IBLOCK_TYPE" => "content",
                        "INCLUDE_SUBSECTIONS" => "Y",
                        "LABEL_PROP" => array(
                        ),
                        "LAZY_LOAD" => "N",
                        "LINE_ELEMENT_COUNT" => "1",
                        "LOAD_ON_SCROLL" => "N",
                        "MESSAGE_404" => "",
                        "MESS_BTN_ADD_TO_BASKET" => "В корзину",
                        "MESS_BTN_BUY" => "Купить",
                        "MESS_BTN_DETAIL" => "Подробнее",
                        "MESS_BTN_SUBSCRIBE" => "Подписаться",
                        "MESS_NOT_AVAILABLE" => "Нет в наличии",
                        "META_DESCRIPTION" => "-",
                        "META_KEYWORDS" => "-",
                        "OFFERS_LIMIT" => "5",
                        "PAGER_BASE_LINK_ENABLE" => "N",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_TEMPLATE" => ".default",
                        "PAGER_TITLE" => "Новости",
                        "PAGE_ELEMENT_COUNT" => "9999999",
                        "PARTIAL_PRODUCT_PROPERTIES" => "N",
                        "PRICE_CODE" => array(
                        ),
                        "PRICE_VAT_INCLUDE" => "Y",
                        "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
                        "PRODUCT_ID_VARIABLE" => "id",
                        "PRODUCT_PROPS_VARIABLE" => "prop",
                        "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                        "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false}]",
                        "PRODUCT_SUBSCRIPTION" => "Y",
                        "RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
                        "RCM_TYPE" => "personal",
                        "SECTION_CODE" => "",
                        "SECTION_ID" => "",
                        "SECTION_ID_VARIABLE" => "SECTION_ID",
                        "SECTION_URL" => "",
                        "SECTION_USER_FIELDS" => array(
                            0 => "",
                            1 => "",
                        ),
                        "SEF_MODE" => "N",
                        "SET_BROWSER_TITLE" => "Y",
                        "SET_LAST_MODIFIED" => "N",
                        "SET_META_DESCRIPTION" => "Y",
                        "SET_META_KEYWORDS" => "Y",
                        "SET_STATUS_404" => "Y",
                        "SET_TITLE" => "Y",
                        "SHOW_404" => "Y",
                        "SHOW_ALL_WO_SECTION" => "Y",
                        "SHOW_CLOSE_POPUP" => "N",
                        "SHOW_DISCOUNT_PERCENT" => "N",
                        "SHOW_FROM_SECTION" => "N",
                        "SHOW_MAX_QUANTITY" => "N",
                        "SHOW_OLD_PRICE" => "N",
                        "SHOW_PRICE_COUNT" => "1",
                        "SHOW_SLIDER" => "Y",
                        "SLIDER_INTERVAL" => "3000",
                        "SLIDER_PROGRESS" => "N",
                        "TEMPLATE_THEME" => "blue",
                        "USE_ENHANCED_ECOMMERCE" => "N",
                        "USE_MAIN_ELEMENT_SECTION" => "N",
                        "USE_PRICE_COUNT" => "N",
                        "USE_PRODUCT_QUANTITY" => "N",
                        "COMPONENT_TEMPLATE" => "stockMain"
                    ),
                    false
                );
            ?></div>
        <? endif; ?>
        <?if($typeOfApartment != 'commercial'):?>
        <div class="container section-margin scrollspy-item container__relative" id="p-6">
            <?if($typeBuilding == 'apart'):?>
                <h2 class="h1 title" id="filter-anchor">Выбор апартаментов</h2>
            <?elseif ($typeBuilding == 'commercial'):?>
                <h2 class="h1 title" id="filter-anchor">Выбор коммерческих помещений</h2>
            <?else:?>
                <h2 class="h1 title" id="filter-anchor">Выбор квартир</h2>
            <?endif;?>

            <?include($_SERVER['DOCUMENT_ROOT']."$templateFolder/include/section/filter.php")?>
            <div class="results">
                <div class="filter-preloader" style="display: none;"></div>
                <div class="results__row results__header">
                    <div class="results__col">
                        <div class="results__row">
                            <div class="results__cell results-cell-1"><span>План</span></div>
                            <div class="results__cell results-cell-2">
                                <button class="sort sort--active sort--flip" type="button" data-field="area" data-event="sortApartmentFun">
                                    <svg class="svg" style="width: 9.25px; height: 9.25px" xmlns="http://www.w3.org/2000/svg" width="9.502" height="9.254" viewBox="0 0 9.502 9.254"><path d="M2.961,85.754H6.128V84.191H2.961ZM0,76.5v1.563H9.5V76.5Zm1.61,5.346H7.944V80.283H1.61Z" transform="translate(0 -76.5)"/></svg>
                                    <span>Площадь, м<sup>2</sup></span>
                                </button>
                            </div>
                            <div class="results__cell results-cell-3"><span>Этаж</span></div>
                            <div class="results__cell results-cell-4">
                                <button class="sort" type="button" data-field = "builtyear" data-event="sortApartmentFun">
                                    <svg class="svg" style="width: 9.25px; height: 9.25px" xmlns="http://www.w3.org/2000/svg" width="9.502" height="9.254" viewBox="0 0 9.502 9.254"><path d="M2.961,85.754H6.128V84.191H2.961ZM0,76.5v1.563H9.5V76.5Zm1.61,5.346H7.944V80.283H1.61Z" transform="translate(0 -76.5)"/></svg>
                                    <span>Готовность</span></button>
                            </div>
                            <div class="results__cell results-cell-5">
                                <?/*<button class="sort <?//sort--active sort--flip?>" type="button" data-field = "price" <?//data-event="sortApartmentFun"?>>

                                    <svg class="svg" style="width: 9.25px; height: 9.25px" xmlns="http://www.w3.org/2000/svg" width="9.502" height="9.254" viewBox="0 0 9.502 9.254"><path d="M2.961,85.754H6.128V84.191H2.961ZM0,76.5v1.563H9.5V76.5Zm1.61,5.346H7.944V80.283H1.61Z" transform="translate(0 -76.5)"/></svg>
                                    <span>Цена</span></button>
                                */?>
                                    <span>Цена</span>
                            </div>
                            <div class="mob-sort"><span class="mob-sort__hint">Сортировать</span>
                                <select class="ui-select" name="mob_sort" data-placeholder="по цене">
                                    <option class="active" value="2020">по цене</option>
                                    <option value="2021">по площади</option>
                                    <option value="2022">по готовности</option>
                                </select>
                                <svg class="svg" style="width: 9.25px; height: 9.25px" xmlns="http://www.w3.org/2000/svg" width="9.502" height="9.254" viewBox="0 0 9.502 9.254"><path d="M2.961,85.754H6.128V84.191H2.961ZM0,76.5v1.563H9.5V76.5Zm1.61,5.346H7.944V80.283H1.61Z" transform="translate(0 -76.5)"/></svg>
                            </div>
                        </div>
                    </div>
                    <div class="interactive-btns">
                        <a class="interactive-btn interactive-download" href="javascript:void(0);" title="Скачать" data-event="loadPDF"></a>
                        <a class="interactive-btn interactive-print" href="print.html" target="_blank" title="Распечатать"></a>
                        <div class="interactive-btn interactive-favorite" data-role="favorite">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22.712" height="21.673" viewBox="0 0 22.712 21.673"><path d="M10.606,0l3.277,6.64,7.329,1.071-5.3,5.165,1.252,7.3-6.555-3.447L4.052,20.173l1.252-7.3L0,7.711,7.329,6.64,10.606,0Z" transform="translate(0.75 0.75)" fill="none" stroke="#e94200" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/></svg>
                        </div>
                    </div>
                </div>
                <div class="results-onlinebuy">
					<?if (CSite::InDir('/newbuild/zoom_apart/')) {?>
                            <div class="results-onlinebuy__title">Купите апартаменты, не выходя из дома!</div>
                        <div class="results-onlinebuy__text"><?=$userProps['UF_YELLOW_STRIP']['~DESCRIPTION']?></div>

                        <?} else {?>
                            <div class="results-onlinebuy__title">Ипотека 0,5% до конца 2020 г.</div>
                        <div class="results-onlinebuy__text">Далее по льготной ставке 6,5% на весь срок кредита</div>
                    <?}?>

                </div>
                <div class="results__body">
                    <div class="results__col">
                        <div class="results-screen" id="results-screen">
                            <?/*foreach ($cartStaticInfo as $key => $category):?>
                                <div class="results__row results-screen__header">
                                    <div><?=\RaStudio\Cart::getFloorNameFull($key)?> от <span class="filter-data"><?=min($category['area'])?> </span>до <span class="filter-data"><?=max($category['area'])?> </span>м<sup>2</sup></div>
                                    <div>от <span class="filter-data"><?=number_format(min($category['price']), 0, '', ' ');?> р.</span></div>
                                </div>
                                <?$countApartment = \RaStudio\Cart::getFloorName($key)?>
                                <?foreach ($arResultCart[$key] as $keyCart => $cart):?>
                                    <?
                                    $maxFloor = max($cart['PROPERTIES']['floor']['VALUE']);
                                    $minFloor = min($cart['PROPERTIES']['floor']['VALUE']);
                                    $stringFloor = (($minFloor != $maxFloor) && $maxFloor) ? "$minFloor...$maxFloor" : $minFloor;
                                    ?>
                                    <div class="results__row" data-event="updatePopup" data-count="<?=$key?>" data-area="<?=$cart['PROPERTIES']['area']['VALUE']?>" data-plan="<?=CFile::GetPath($cart['PROPERTIES']['image']['VALUE'][0])?>">
                                        <div class="results__cell results-cell-1 js-call-card" style="    min-height: 60px;"><img class="img plan-thumb" src="<?=CFile::ResizeImageGet($cart['PROPERTIES']['image']['VALUE'][0], array('width'=>60, 'height'=>60), BX_RESIZE_IMAGE_PROPORTIONAL, true)['src'];?>" alt="alt"></div>
                                        <div class="results__cell results-cell-2"><span><?=$cart['PROPERTIES']['area']['VALUE']?> м<sup>2</sup></span></div>
                                        <div class="results__cell results-cell-3"><span><?=$stringFloor?></span></div>
                                        <div class="results__cell results-cell-4"><span><?=$cart['PROPERTIES']['area']['VALUE']?></span></div>
                                        <div class="results__cell results-cell-5"><span><?=number_format($cart['PROPERTIES']['price']['VALUE'], 0, '', ' ');?> р.</span></div>
                                        <div class="results-cell-mob">
                                            <p class="data-1"><?=$countApartment?> - <?=$cart['PROPERTIES']['area']['VALUE']?> м<sup>2</sup></p>
                                            <p class="data-2"> <span><?=number_format($cart['PROPERTIES']['price']['VALUE'], 0, '', ' ');?> </span>р.</p>
                                        </div>
                                        <div class="results-cell-btns">
                                            <button class="interactive-btn interactive-follow" type="button"><img class="svg ic-arrow" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-arrow.svg" width="20" height="20" alt="Перейти"></button>
                                        </div>
                                    </div>
                                <?endforeach;?>
                            <?endforeach;*/?>
                        </div>
                    </div>
                    <div class="results__offer results-offer ">
                        <div class="results__img js-call-card">
                            <img class="img lazyload" data-src="<?=SITE_TEMPLATE_PATH?>/img/img-plan.jpg" alt="plan" style="max-height: 100%;">
                            <button class="results-offer__modal" type="button">
                                <svg class="svg" style="width: 36px;height: 44px" xmlns="http://www.w3.org/2000/svg" width="36" height="44" viewBox="0 0 36 44"><g transform="translate(-1282 -653)"><g transform="translate(1.831 -1.631)"><g transform="translate(1280.169 654.631)" fill="none" stroke="#fff" stroke-width="1.5"><rect width="30" height="40" rx="2" stroke="none"/><rect x="0.75" y="0.75" width="28.5" height="38.5" rx="1.25" fill="none"/></g><g transform="translate(1286.078 659.875)"><path d="M0,4.781v13.41H10.378V17.4H6.919V16.35H6.054V17.4H.865v-6.31H6.054v2.1h.865v-.526H12.4V11.88H6.919V7.147H6.054V10.3H.865V5.57H17.586v6.31H15.279V10.828h-.865v1.841h3.171v7.888H13.838V17.928h-.865v3.418h5.478V4.781Z" transform="translate(0 -4.781)" fill="#fff" stroke="#fff" stroke-width="0.5"/></g><line x2="17.591" transform="translate(1286.078 680.215)" fill="none" stroke="#fff" stroke-linecap="round" stroke-width="1.5"/><line x2="13.591" transform="translate(1286.078 684.784)" fill="none" stroke="#fff" stroke-linecap="round" stroke-width="1.5"/><line x2="10.708" transform="translate(1286.078 689.354)" fill="none" stroke="#fff" stroke-linecap="round" stroke-width="1.5"/></g><g transform="translate(0 -1)"><g transform="translate(-2 -1)"><g transform="translate(1305 684)" fill="#eb5418" stroke="#fff" stroke-width="1.5"><circle cx="7.5" cy="7.5" r="7.5" stroke="none"/><circle cx="7.5" cy="7.5" r="6.75" fill="none"/></g></g><g transform="translate(1277.476 686.206)"><path d="M34.732,7.237l-.117.463q-.527.2-.841.307a2.287,2.287,0,0,1-.729.106,1.489,1.489,0,0,1-.992-.3.961.961,0,0,1-.354-.765,2.62,2.62,0,0,1,.026-.368q.027-.188.086-.425l.439-1.5q.059-.216.1-.41a1.725,1.725,0,0,0,.04-.352.534.534,0,0,0-.123-.4.711.711,0,0,0-.47-.114,1.269,1.269,0,0,0-.349.052c-.119.034-.222.067-.307.1l.117-.464q.432-.17.826-.291a2.545,2.545,0,0,1,.747-.121,1.452,1.452,0,0,1,.977.3.969.969,0,0,1,.343.77c0,.065-.008.181-.024.345a2.242,2.242,0,0,1-.088.454l-.437,1.5a3.87,3.87,0,0,0-.1.413,2.058,2.058,0,0,0-.043.35.5.5,0,0,0,.138.407.8.8,0,0,0,.478.108,1.424,1.424,0,0,0,.362-.054A2.07,2.07,0,0,0,34.732,7.237Zm.111-6.29a.864.864,0,0,1-.306.667,1.061,1.061,0,0,1-.737.276,1.073,1.073,0,0,1-.74-.276.863.863,0,0,1-.309-.667A.871.871,0,0,1,33.06.278a1.12,1.12,0,0,1,1.477,0A.872.872,0,0,1,34.843.947Z" transform="translate(0 0)" fill="#fff"/></g></g></g></svg>
                            </button>
                        </div>
                        <style>
                            .results-offer__btn{
                                display: flex;
                                justify-content: space-between;
                                width: 100%;
                            }
                            .results-offer__btn .btn{
                                width: calc(50% - 10px)
                            }
                        </style>
                        <div class="results-offer__footer-wrap">
                            <div class="results-offer__text">
                                <p id="results-offer-square-text">Интересует студия 22 м<sup>2</sup> ? </p>
                                <p>Посмотрите
                                    <button class="text-btn js-call-card" button="button">подробнее!</button>
                                </p>
                            </div>
                            <div class="results-offer__footer">
                                <div class="results-offer__btn">
                                    <!--button class="btn btn--cta js-call-callback" type="button">
                                        <svg class="svg btn__ic ic-tel"  xmlns="http://www.w3.org/2000/svg" width="14.547" height="24.331" viewBox="0 0 14.547 24.331"><g transform="translate(-8967.75 1214.75)"><path d="M0,.5H13.047" transform="translate(8968.5 -1195.909)" fill="none" stroke="#e94200" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><path d="M0,1.25H3.262" transform="translate(8973.393 -1211.988)" fill="none" stroke="#e94200" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><rect width="13.047" height="22.831" rx="2" transform="translate(8968.5 -1214)" stroke-width="1.5" stroke="#e94200" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" fill="none"/></g></svg>
                                        Позвоните мне
                                    </button-->
                                    <a href="#modal-FORM10" class="popup-btn-FORM10 btn btn--bg js-call-callback" type="button">
                                        <svg class="svg btn__ic ic-tel"  xmlns="http://www.w3.org/2000/svg" width="14.547" height="24.331" viewBox="0 0 14.547 24.331"><g transform="translate(-8967.75 1214.75)"><path d="M0,.5H13.047" transform="translate(8968.5 -1195.909)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><path d="M0,1.25H3.262" transform="translate(8973.393 -1211.988)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><rect width="13.047" height="22.831" rx="2" transform="translate(8968.5 -1214)" stroke-width="1.5" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" fill="none"/></g></svg>
                                        Консультация
                                    </a>
                                        <div data-type="reserved" class="btn--reserved" >
                                            <svg class="svg btn__ic ic-tel" width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M7.5 10L7.5 12.6654" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M9.91016 13L4.82144 13" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                <rect x="0.75" y="0.75" width="13.5" height="8.5" rx="1.25" stroke="white" stroke-width="1.5"/>
                                            </svg>
                                            Забронировано
                                        </div>
                                        <a href="/reserve/" data-type="reserveBtn" data-id="" data-iblock="1" class=" btn btn--cta " type="button">
                                            <svg class="svg btn__ic ic-tel" width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M7.5 10L7.5 12.6654" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M9.91016 13L4.82144 13" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                <rect x="0.75" y="0.75" width="13.5" height="8.5" rx="1.25" stroke="white" stroke-width="1.5"/>
                                            </svg>
                                            Забронировать
                                        </a>


                                </div>
                            </div>
                        </div>
                        <?/*}else{?>
                        <div class="results-offer__footer">
                            <div class="results-offer__text">
                                <p id="results-offer-square-text">Интересует студия 22 м<sup>2</sup> ? </p>
                                <p>Посмотрите
                                    <button class="text-btn js-call-card" button="button">подробнее!</button>
                                </p>
                            </div>
                            <div class="results-offer__btn">
                                <!--button class="btn btn--cta js-call-callback" type="button">
                                    <svg class="svg btn__ic ic-tel"  xmlns="http://www.w3.org/2000/svg" width="14.547" height="24.331" viewBox="0 0 14.547 24.331"><g transform="translate(-8967.75 1214.75)"><path d="M0,.5H13.047" transform="translate(8968.5 -1195.909)" fill="none" stroke="#e94200" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><path d="M0,1.25H3.262" transform="translate(8973.393 -1211.988)" fill="none" stroke="#e94200" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><rect width="13.047" height="22.831" rx="2" transform="translate(8968.5 -1214)" stroke-width="1.5" stroke="#e94200" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" fill="none"/></g></svg>
                                    Позвоните мне
                                </button-->
                                <a href="#modal-callback" class="custom-popup__btn btn btn--cta js-call-callback" type="button">
                                    <svg class="svg btn__ic ic-tel"  xmlns="http://www.w3.org/2000/svg" width="14.547" height="24.331" viewBox="0 0 14.547 24.331"><g transform="translate(-8967.75 1214.75)"><path d="M0,.5H13.047" transform="translate(8968.5 -1195.909)" fill="none" stroke="#e94200" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><path d="M0,1.25H3.262" transform="translate(8973.393 -1211.988)" fill="none" stroke="#e94200" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><rect width="13.047" height="22.831" rx="2" transform="translate(8968.5 -1214)" stroke-width="1.5" stroke="#e94200" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" fill="none"/></g></svg>
                                    Забронировать
                                </a>
                            </div>
                        </div>
                        <?}*/?>
                    </div>
                </div>
                <div class="results-empty" style="display: none">По вашему запросу ничего не найдено.</div>
            </div>
            <div class="results-refresh">
                <svg class="svg btn__ic" style="width: 14px;height: 14px" xmlns="http://www.w3.org/2000/svg" width="12.662" height="13.637" viewBox="0 0 12.662 13.637"><g transform="translate(-17.067)"><g transform="translate(17.067)"><g transform="translate(0)"><path d="M28.268,0a.487.487,0,0,0-.487.487V2.266A6.319,6.319,0,0,0,17.067,6.818a.487.487,0,1,0,.974,0A5.357,5.357,0,0,1,27.35,3.2l-2.158.719a.488.488,0,1,0,.308.925l2.922-.974a.487.487,0,0,0,.333-.464V.487A.487.487,0,0,0,28.268,0Z" transform="translate(-17.067)" fill="#e94200"/></g></g><g transform="translate(18.041 6.331)"><g transform="translate(0)"><path d="M62.4,221.867a.487.487,0,0,0-.487.487A5.357,5.357,0,0,1,52.6,225.97l2.158-.719a.488.488,0,1,0-.308-.925l-2.922.974a.487.487,0,0,0-.333.464v2.922a.487.487,0,0,0,.974,0v-1.779a6.319,6.319,0,0,0,10.715-4.552A.487.487,0,0,0,62.4,221.867Z" transform="translate(-51.198 -221.867)" fill="#e94200"/></g></g></g></svg>
                Информация обновлена
                <span><?=CIBlockFormatProperties::DateFormat("j M Y", strtotime($timeUpdate));?></span>.
            </div>
            <div class="results-more">
                <button class="btn btn--transp" type="button">
                    <svg class="svg btn__ic ic-arrow ic-arrow--down" style="width: 20px;height: 20px" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><g transform="translate(0 20) rotate(-90)"><g transform="translate(20) rotate(90)" fill="none"><path d="M10,0A10,10,0,1,1,0,10,10,10,0,0,1,10,0Z" stroke="none"/><path d="M 10.00000095367432 1.500001907348633 C 5.313080787658691 1.500001907348633 1.500001907348633 5.313080787658691 1.500001907348633 10.00000095367432 C 1.500001907348633 14.68692111968994 5.313080787658691 18.5 10.00000095367432 18.5 C 14.68692111968994 18.5 18.5 14.68692111968994 18.5 10.00000095367432 C 18.5 5.313080787658691 14.68692111968994 1.500001907348633 10.00000095367432 1.500001907348633 M 10.00000095367432 1.9073486328125e-06 C 15.52285099029541 1.9073486328125e-06 20 4.477150917053223 20 10.00000095367432 C 20 15.52285099029541 15.52285099029541 20 10.00000095367432 20 C 4.477150917053223 20 1.9073486328125e-06 15.52285099029541 1.9073486328125e-06 10.00000095367432 C 1.9073486328125e-06 4.477150917053223 4.477150917053223 1.9073486328125e-06 10.00000095367432 1.9073486328125e-06 Z" stroke="none"/></g><g transform="translate(7.236 5.719)"><g transform="translate(5.504 5.4) rotate(90)"><g transform="translate(0 5.504) rotate(-90)"><path d="M0,0,2.752,2.752,5.5,0" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/></g></g><line y2="7.826" transform="translate(2.739)" fill="none" stroke-linecap="round" stroke-width="1.5"/></g></g></svg>
                    Показать ещё
                </button>
            </div>
        </div>
        <?endif?>

        <?$APPLICATION->IncludeComponent(
	"slam:easyform", 
	"consult", 
	array(
		"CATEGORY_EMAIL_PLACEHOLDER" => "",
		"CATEGORY_EMAIL_TITLE" => "Ваш E-mail",
		"CATEGORY_EMAIL_TYPE" => "email",
		"CATEGORY_EMAIL_VALIDATION_ADDITIONALLY_MESSAGE" => "data-bv-emailaddress-message=\"E-mail введен некорректно\"",
		"CATEGORY_EMAIL_VALIDATION_MESSAGE" => "Обязательное поле",
		"CATEGORY_EMAIL_VALUE" => "",
		"CATEGORY_MESSAGE_PLACEHOLDER" => "",
		"CATEGORY_MESSAGE_TITLE" => "Сообщение",
		"CATEGORY_MESSAGE_TYPE" => "textarea",
		"CATEGORY_MESSAGE_VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY_MESSAGE_VALUE" => "",
		"CATEGORY_PHONE_INPUTMASK" => "N",
		"CATEGORY_PHONE_INPUTMASK_TEMP" => "+7 (999) 999-9999",
		"CATEGORY_PHONE_PLACEHOLDER" => "Телефон / Email (для Teams)",
		"CATEGORY_PHONE_TITLE" => "Телефон:",
		"CATEGORY_PHONE_TYPE" => "text",
		"CATEGORY_PHONE_VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY_PHONE_VALUE" => "",
		"CATEGORY_TITLE_PLACEHOLDER" => "Ваше имя",
		"CATEGORY_TITLE_TITLE" => "Имя клиента:",
		"CATEGORY_TITLE_TYPE" => "text",
		"CATEGORY_TITLE_VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY_TITLE_VALUE" => "",
        "CATEGORY_USER_IP_TITLE" => "USER_IP",
        "CATEGORY_USER_IP_TYPE" => "hidden",
        "CATEGORY_USER_IP_CLASS" => "general-itemInput",
        "CATEGORY_USER_IP_VALUE" => $_SERVER["REMOTE_ADDR"],
		"CREATE_SEND_MAIL" => "",
		"DISPLAY_FIELDS" => array(
			0 => "TITLE",
			1 => "PHONE",
			2 => "CUR_PAGE",
			3 => "TIME",
			4 => "METHOD",
			5 => "USER_IP",
		),
		"EMAIL_BCC" => "",
		"EMAIL_FILE" => "N",
		"EMAIL_TO" => "",
		"ENABLE_SEND_MAIL" => "Y",
		"ERROR_TEXT" => "Произошла ошибка. Сообщение не отправлено.",
		"EVENT_MESSAGE_ID" => array(
			0 => "54",
		),
		"FIELDS_ORDER" => "METHOD,TITLE,PHONE,TIME,CUR_PAGE",
		"FORM_AUTOCOMPLETE" => "Y",
		"FORM_ID" => "consult",
		"FORM_NAME" => "Консультируйтесь по видеосвязи с любого устройства",
		"FORM_SUBMIT_VALUE" => "Отправить заявку",
		"FORM_SUBMIT_VARNING" => "Нажимая на кнопку \"#BUTTON#\", вы даете согласие на обработку <a target=\"_blank\" href=\"#\">персональных данных</a>",
		"HIDE_ASTERISK" => "Y",
		"HIDE_FIELD_NAME" => "Y",
		"HIDE_FORMVALIDATION_TEXT" => "N",
		"INCLUDE_BOOTSRAP_JS" => "Y",
		"MAIL_SUBJECT_ADMIN" => "#SITE_NAME#: Сообщение из формы обратной связи",
		"OK_TEXT" => "Ваше сообщение отправлено. Мы свяжемся с вами в течение 2х часов",
		"REQUIRED_FIELDS" => array(
			0 => "PHONE",
		),
		"SEND_AJAX" => "Y",
		"SHOW_MODAL" => "Y",
		"TITLE_SHOW_MODAL" => "Спасибо!",
		"USE_BOOTSRAP_CSS" => "N",
		"USE_BOOTSRAP_JS" => "N",
		"USE_CAPTCHA" => "N",
		"USE_FORMVALIDATION_JS" => "N",
		"USE_IBLOCK_WRITE" => "N",
		"USE_JQUERY" => "N",
		"USE_MODULE_VARNING" => "N",
		"WIDTH_FORM" => "500px",
		"_CALLBACKS" => "success_consult",
		"COMPONENT_TEMPLATE" => "consult",
		"EMAIL_SEND_FROM" => "N",
		"CATEGORY_CUR_PAGE_TITLE" => "CUR_PAGE",
		"CATEGORY_CUR_PAGE_TYPE" => "hidden",
		"CATEGORY_CUR_PAGE_VALUE" => (@($_SERVER["HTTPS"]!="on")?"http://".$_SERVER["SERVER_NAME"]:"https://".$_SERVER["SERVER_NAME"]).($_SERVER["SERVER_PORT"]!=80?":".$_SERVER["SERVER_PORT"]:"").$_SERVER["REQUEST_URI"],
		"CATEGORY_TIME_TITLE" => "TIME",
		"CATEGORY_TIME_TYPE" => "text",
		"CATEGORY_TIME_PLACEHOLDER" => "Дата и время",
		"CATEGORY_TIME_VALUE" => "",
		"CATEGORY_METHOD_TITLE" => "METHOD",
		"CATEGORY_METHOD_TYPE" => "radio",
		"CATEGORY_METHOD_VALUE" => array(
			0 => "WhatsApp|new-form-whatsapp.svg",
			1 => "Telegram|new-form-telegram.svg",
			2 => "Microsoft Teams|new-form-microsoft.svg",
			3 => "",
		),
		"CATEGORY_METHOD_SHOW_INLINE" => "Y",
		"CLEAR_FORM" => "N",
		"CATEGORY_TITLE_CLASS" => "general-itemInput",
		"CATEGORY_PHONE_CLASS" => "general-itemInput",
		"CATEGORY_CUR_PAGE_CLASS" => "general-itemInput",
		"CATEGORY_TIME_CLASS" => "general-itemInput",
		"CATEGORY_METHOD_CLASS" => "general-itemInput"
	),
	false
);?>
        
        <?if($typeOfApartment != "commercial"):?>
            <div class="project-ipo scrollspy-item" id="p-7">
                <div class="container">
                    <h2 class="h1 title">Ипотека - это просто!</h2>
                    <div class="ipo">
                        <div class="ipo-calc">
                            <div class="filter-row">
                                <div class="filter-fields">
                                    <div class="filter__field filter-field" data-name="credit">
                                        <div class="filter-field__label">Стоимость, р. </div>
                                        <div class="ui-quantity" data-step="100000">
                                            <button class="ui-quantity__btn ui-quantity__minus" data-event="mortgageFilter">
                                                <svg class="svg" style="width: 10px;height: 2px" xmlns="http://www.w3.org/2000/svg" width="11.5" height="1.5" viewBox="0 0 11.5 1.5"><path d="M0,.5H10" transform="translate(0.75 0.25)" fill="none" stroke="#bebebe" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/></svg>
                                            </button>
                                            <input type="text" value="2 500 000">
                                            <button class="ui-quantity__btn ui-quantity__plus" data-event="mortgageFilter">
                                                <svg class="svg" style="width: 10px;height: 10px" xmlns="http://www.w3.org/2000/svg" width="11.5" height="11.5" viewBox="0 0 11.5 11.5"><g transform="translate(0.75 0.75)"><path d="M.357,0V10" transform="translate(4.643)" fill="none" stroke="#bebebe" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><path d="M0,.357H10" transform="translate(0 4.643)" fill="none" stroke="#bebebe" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/></g></svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="filter__field filter-field" data-name="first">
                                        <div class="filter-field__label">Первоначальный взнос</div>
                                        <div class="ui-quantity" data-step="100000">
                                            <button class="ui-quantity__btn ui-quantity__minus" data-event="mortgageFilter">
                                                <svg class="svg" style="width: 10px;height: 2px" xmlns="http://www.w3.org/2000/svg" width="11.5" height="1.5" viewBox="0 0 11.5 1.5"><path d="M0,.5H10" transform="translate(0.75 0.25)" fill="none" stroke="#bebebe" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/></svg>
                                            </button>
                                            <input type="text" value="1 500 000">
                                            <button class="ui-quantity__btn ui-quantity__plus" data-event="mortgageFilter">
                                                <svg class="svg" style="width: 10px;height: 10px" xmlns="http://www.w3.org/2000/svg" width="11.5" height="11.5" viewBox="0 0 11.5 11.5"><g transform="translate(0.75 0.75)"><path d="M.357,0V10" transform="translate(4.643)" fill="none" stroke="#bebebe" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><path d="M0,.357H10" transform="translate(0 4.643)" fill="none" stroke="#bebebe" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/></g></svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="filter__field filter-field" data-name="age">
                                        <div class="filter-field__label">Срок, лет</div>
                                        <div class="ui-quantity ui-quantity--years" data-step="1">
                                            <button class="ui-quantity__btn ui-quantity__minus" data-event="mortgageFilter">
                                                <svg class="svg" style="width: 10px;height: 2px" xmlns="http://www.w3.org/2000/svg" width="11.5" height="1.5" viewBox="0 0 11.5 1.5"><path d="M0,.5H10" transform="translate(0.75 0.25)" fill="none" stroke="#bebebe" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/></svg>
                                            </button>
                                            <input class="years" type="text" value="10">
                                            <button class="ui-quantity__btn ui-quantity__plus" data-event="mortgageFilter">
                                                <svg class="svg" style="width: 10px;height: 10px" xmlns="http://www.w3.org/2000/svg" width="11.5" height="11.5" viewBox="0 0 11.5 11.5"><g transform="translate(0.75 0.75)"><path d="M.357,0V10" transform="translate(4.643)" fill="none" stroke="#bebebe" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><path d="M0,.357H10" transform="translate(0 4.643)" fill="none" stroke="#bebebe" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/></g></svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="filter__field filter-field-result">
                                        <button class="btn btn--bg" type="button" id="schet-platezh" <?//data-event="mortgageFilter"?>>
                                            <svg class="svg btn__ic" style="width: 20px;height: 20px" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><g transform="translate(-1292 -4412)"><g transform="translate(1292 4412)" fill="none"><path d="M10,0A10,10,0,1,1,0,10,10,10,0,0,1,10,0Z" stroke="none"/><path d="M 10 1.5 C 5.313079833984375 1.5 1.5 5.313079833984375 1.5 10 C 1.5 14.68692016601563 5.313079833984375 18.5 10 18.5 C 14.68692016601563 18.5 18.5 14.68692016601563 18.5 10 C 18.5 5.313079833984375 14.68692016601563 1.5 10 1.5 M 10 0 C 15.52285003662109 0 20 4.477149963378906 20 10 C 20 15.52285003662109 15.52285003662109 20 10 20 C 4.477149963378906 20 0 15.52285003662109 0 10 C 0 4.477149963378906 4.477149963378906 0 10 0 Z" stroke="none" fill="#fff"/></g><g transform="translate(-0.77 -0.826)"><line y1="7" x2="6.77" transform="translate(1299.5 4419.326)" fill="none" stroke="#fff" stroke-linecap="round" stroke-width="1.5"/><g transform="translate(1298.77 4418.826)" fill="#fff" stroke="#fff" stroke-width="1"><circle cx="1" cy="1" r="1" stroke="none"/><circle cx="1" cy="1" r="0.5" fill="none"/></g><g transform="translate(1304.77 4424.826)" fill="#fff" stroke="#fff" stroke-width="1"><circle cx="1" cy="1" r="1" stroke="none"/><circle cx="1" cy="1" r="0.5" fill="none"/></g></g></g></svg>
                                            Рассчитать платеж
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:news.list",
                            "mortgage",
                            Array(
                                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                "ADD_SECTIONS_CHAIN" => "N",
                                "AJAX_MODE" => "N",
                                "AJAX_OPTION_ADDITIONAL" => "",
                                "AJAX_OPTION_HISTORY" => "N",
                                "AJAX_OPTION_JUMP" => "N",
                                "AJAX_OPTION_STYLE" => "Y",
                                "CACHE_FILTER" => "N",
                                "CACHE_GROUPS" => "Y",
                                "CACHE_TIME" => "36000000",
                                "CACHE_TYPE" => "A",
                                "CHECK_DATES" => "Y",
                                "DETAIL_URL" => "",
                                "DISPLAY_BOTTOM_PAGER" => "N",
                                "DISPLAY_DATE" => "N",
                                "DISPLAY_NAME" => "Y",
                                "DISPLAY_PICTURE" => "Y",
                                "DISPLAY_PREVIEW_TEXT" => "Y",
                                "DISPLAY_TOP_PAGER" => "N",
                                "FIELD_CODE" => array("",""),
                                "FILE_404" => "",
                                "FILTER_NAME" => "",
                                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                "IBLOCK_ID" => "11",
                                "IBLOCK_TYPE" => "kompleks",
                                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                "INCLUDE_SUBSECTIONS" => "N",
                                "MESSAGE_404" => "",
                                "NEWS_COUNT" => "20",
                                "PAGER_BASE_LINK_ENABLE" => "N",
                                "PAGER_DESC_NUMBERING" => "N",
                                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                "PAGER_SHOW_ALL" => "N",
                                "PAGER_SHOW_ALWAYS" => "N",
                                "PAGER_TEMPLATE" => ".default",
                                "PAGER_TITLE" => "Новости",
                                "PARENT_SECTION" => "",
                                "PARENT_SECTION_CODE" => "",
                                "PREVIEW_TRUNCATE_LEN" => "",
                                "PROPERTY_CODE" => array("UF_BIK","UF_DATE","UF_NAME","UF_NUMBER","UF_VALUE",""),
                                "SET_BROWSER_TITLE" => "N",
                                "SET_LAST_MODIFIED" => "N",
                                "SET_META_DESCRIPTION" => "N",
                                "SET_META_KEYWORDS" => "N",
                                "SET_STATUS_404" => "Y",
                                "SET_TITLE" => "N",
                                "SHOW_404" => "Y",
                                "SORT_BY1" => "ACTIVE_FROM",
                                "SORT_BY2" => "SORT",
                                "SORT_ORDER1" => "DESC",
                                "SORT_ORDER2" => "ASC",
                                "STRICT_SECTION_CHECK" => "N"
                            )
                        );?>
                    </div>
                    <div class="ipo-more show-more-ipoteka">
                        <button class="btn btn--transp" type="button" data-event="showMoreIpoteka">
                            <svg class="svg btn__ic ic-arrow ic-arrow--down" style="width: 20px;height: 20px" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><g transform="translate(0 20) rotate(-90)"><g transform="translate(20) rotate(90)" fill="none"><path d="M10,0A10,10,0,1,1,0,10,10,10,0,0,1,10,0Z" stroke="none"/><path d="M 10.00000095367432 1.500001907348633 C 5.313080787658691 1.500001907348633 1.500001907348633 5.313080787658691 1.500001907348633 10.00000095367432 C 1.500001907348633 14.68692111968994 5.313080787658691 18.5 10.00000095367432 18.5 C 14.68692111968994 18.5 18.5 14.68692111968994 18.5 10.00000095367432 C 18.5 5.313080787658691 14.68692111968994 1.500001907348633 10.00000095367432 1.500001907348633 M 10.00000095367432 1.9073486328125e-06 C 15.52285099029541 1.9073486328125e-06 20 4.477150917053223 20 10.00000095367432 C 20 15.52285099029541 15.52285099029541 20 10.00000095367432 20 C 4.477150917053223 20 1.9073486328125e-06 15.52285099029541 1.9073486328125e-06 10.00000095367432 C 1.9073486328125e-06 4.477150917053223 4.477150917053223 1.9073486328125e-06 10.00000095367432 1.9073486328125e-06 Z" stroke="none"/></g><g transform="translate(7.236 5.719)"><g transform="translate(5.504 5.4) rotate(90)"><g transform="translate(0 5.504) rotate(-90)"><path d="M0,0,2.752,2.752,5.5,0" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/></g></g><line y2="7.826" transform="translate(2.739)" fill="none" stroke-linecap="round" stroke-width="1.5"/></g></g></svg>
                            Показать ещё
                        </button>
                    </div>
                </div>
            </div>
        <?endif?>
        <?$APPLICATION->IncludeComponent(
	"slam:easyform",
	"mainForm",
            array(
                "COMPONENT_TEMPLATE" => "mainForm",
                "FORM_ID" => "FORM2",
                "FORM_NAME" => "Вопрос по ипотеке? Мы ответим!",
                "WIDTH_FORM" => "500px",
                "DISPLAY_FIELDS" => array(
                    0 => "TITLE",
                    1 => "PHONE",
                    2 => "CUR_PAGE",
                    3 => "USER_IP",
                ),
                "REQUIRED_FIELDS" => array(
                    0 => "PHONE",
                    1 => "",
                ),
                "FIELDS_ORDER" => "TITLE,PHONE,CUR_PAGE",
                "CLEAR_FORM" => "N",
                "FORM_AUTOCOMPLETE" => "Y",
                "HIDE_FIELD_NAME" => "Y",
                "HIDE_ASTERISK" => "Y",
                "FORM_SUBMIT_VALUE" => "Позвоните мне",
                "SEND_AJAX" => "Y",
                "SHOW_MODAL" => "N",
                "_CALLBACKS" => "success_FORM2",
                "OK_TEXT" => "Ваше сообщение отправлено. Мы свяжемся с вами в течение 2х часов",
                "ERROR_TEXT" => "Произошла ошибка. Сообщение не отправлено.",
                "ENABLE_SEND_MAIL" => "Y",
                "CREATE_SEND_MAIL" => "",
                "EVENT_MESSAGE_ID" => array(
                    0 => "48",
                ),
                "EMAIL_TO" => "",
                "EMAIL_BCC" => "",
                "MAIL_SUBJECT_ADMIN" => "#SITE_NAME#: Сообщение из формы обратной связи",
                "EMAIL_FILE" => "N",
                "USE_IBLOCK_WRITE" => "N",
                "CATEGORY_TITLE_TITLE" => "Имя клиента:",
                "CATEGORY_TITLE_TYPE" => "text",
                "CATEGORY_TITLE_PLACEHOLDER" => "Ваше имя",
                "CATEGORY_TITLE_CLASS" => "col-1-3",
                "CATEGORY_TITLE_VALUE" => "",
                "CATEGORY_PHONE_TITLE" => "Телефон:",
                "CATEGORY_PHONE_TYPE" => "tel",
                "CATEGORY_PHONE_PLACEHOLDER" => "Номер телефона",
                "CATEGORY_PHONE_CLASS" => "col-1-3",
                "CATEGORY_PHONE_VALUE" => "",
                "CATEGORY_PHONE_INPUTMASK" => "N",
                "CATEGORY_PHONE_INPUTMASK_TEMP" => "+7 (999) 999-9999",
                "CATEGORY_USER_IP_TITLE" => "USER_IP",
                "CATEGORY_USER_IP_TYPE" => "hidden",
                "CATEGORY_USER_IP_CLASS" => "general-itemInput",
                "CATEGORY_USER_IP_VALUE" => $_SERVER["REMOTE_ADDR"],
                "USE_CAPTCHA" => "N",
                "USE_MODULE_VARNING" => "N",
                "USE_FORMVALIDATION_JS" => "N",
                "USE_JQUERY" => "N",
                "USE_BOOTSRAP_CSS" => "N",
                "USE_BOOTSRAP_JS" => "N",
                "FORM_SUBMIT_VARNING" => "Отправляя форму, вы подтверждаете своё согласие на <a href=\"/privacy-policy/\" target=\"_blank\">обработку персональных данных</a>",
                "CATEGORY_CUR_PAGE_TITLE" => "Страница обращения:",
                "CATEGORY_CUR_PAGE_TYPE" => "hidden",
                "CATEGORY_CUR_PAGE_CLASS" => "general-itemInput",
                "CATEGORY_CUR_PAGE_VALUE" => (@($_SERVER["HTTPS"]!="on")?"http://".$_SERVER["SERVER_NAME"]:"https://".$_SERVER["SERVER_NAME"]).($_SERVER["SERVER_PORT"]!=80?":".$_SERVER["SERVER_PORT"]:"").$_SERVER["REQUEST_URI"]
            ),
            false
        );?>
        <?//p-8?>
        <?if($userProps['UF_JK_STATUS']['VALUE'] === 'Да'):?>
            <?include($_SERVER['DOCUMENT_ROOT']."$templateFolder/include/section/progressGallery.php")?>
        <?endif;?>

        <?if(!empty($userProps['UF_CONTACTS']['VALUE'])){
            $GLOBALS['objectContact']=["ID"=>$userProps['UF_CONTACTS']['VALUE']];
            ?><div class="project-contacts section-margin scrollspy-item" id="p-9">
                <div class="container">
                    <h2 class="title title-margin">Контакты офиса продаж</h2><?
                    $APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "office",
                        Array(
                            "ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "AJAX_MODE" => "N",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "CACHE_FILTER" => "N",
                            "CACHE_GROUPS" => "Y",
                            "CACHE_TIME" => "36000000",
                            "CACHE_TYPE" => "A",
                            "CHECK_DATES" => "Y",
                            "COMPONENT_TEMPLATE" => ".default",
                            "DETAIL_URL" => "",
                            "DISPLAY_BOTTOM_PAGER" => "N",
                            "DISPLAY_DATE" => "N",
                            "DISPLAY_NAME" => "N",
                            "DISPLAY_PICTURE" => "N",
                            "DISPLAY_PREVIEW_TEXT" => "N",
                            "DISPLAY_TOP_PAGER" => "N",
                            "FIELD_CODE" => array(0=>"",1=>"",),
                            "FILE_404" => "",
                            "FILTER_NAME" => "objectContact",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "IBLOCK_ID" => "10",
                            "IBLOCK_TYPE" => "content",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            "INCLUDE_SUBSECTIONS" => "N",
                            "MESSAGE_404" => "",
                            "NEWS_COUNT" => "20",
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_TEMPLATE" => ".default",
                            "PAGER_TITLE" => "Новости",
                            "PARENT_SECTION" => "",
                            "PARENT_SECTION_CODE" => "",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "PROPERTY_CODE" => array(0=>"UF_METRO",1=>"UF_ADDRESS",2=>"UF_WORK_TIME",3=>"UF_PHONE",4=>"UF_COORDINATES",5=>"",),
                            "SET_BROWSER_TITLE" => "N",
                            "SET_LAST_MODIFIED" => "N",
                            "SET_META_DESCRIPTION" => "N",
                            "SET_META_KEYWORDS" => "N",
                            "SET_STATUS_404" => "Y",
                            "SET_TITLE" => "N",
                            "SHOW_404" => "Y",
                            "SORT_BY1" => "ACTIVE_FROM",
                            "SORT_BY2" => "SORT",
                            "SORT_ORDER1" => "DESC",
                            "SORT_ORDER2" => "ASC",
                            "STRICT_SECTION_CHECK" => "N"
                        )
                    );
                ?></div>
            </div><?
        }
        ?><div class="project-docs section-margin scrollspy-item" id="p-10">
            <div class="container">
                <h2 class="h1 title">Документация по объекту</h2>
                <div class="project-docs__block">
                    <p>
                        В данном разделе находится вся документация по проекту, среди которой: разрешение на строительство,
                        проектная декларация, проект договора ДДУ, документы на земельный участок пр.
                    </p>
                    <a class="btn btn--transp" href="/docs/?data-id=<?=$fullProps['standartProps']['ID']?>" target="_blank">
                            <svg style="width: 15px; height: 18px; margin-right: 10px;" xmlns="http://www.w3.org/2000/svg" width="14.735" height="18.142" viewBox="0 0 14.735 18.142"><g transform="translate(-2.965 0.25)"><g transform="translate(3.215)"><path d="M16.125,17.642H4.54a1.326,1.326,0,0,1-1.325-1.325V1.325A1.326,1.326,0,0,1,4.54,0h8.413a.265.265,0,1,1,0,.53H4.54a.8.8,0,0,0-.795.795V16.317a.8.8,0,0,0,.795.795H16.125a.8.8,0,0,0,.795-.795V4.612a.265.265,0,1,1,.53,0V16.318A1.326,1.326,0,0,1,16.125,17.642Z" transform="translate(-3.215)" fill="#e94808" stroke="#ea4d0f" stroke-width="0.5"/><path d="M26.307,5.74H21.4a.307.307,0,0,1-.307-.307V.524a.307.307,0,0,1,.615,0v4.6h4.6a.308.308,0,0,1,0,.615Z" transform="translate(-12.38 -0.102)" fill="#e94808" stroke="#ea4d0f" stroke-width="0.5"/><path d="M25.589,4.878a.265.265,0,0,1-.19-.08L21.168.451a.265.265,0,1,1,.38-.369l4.232,4.347a.265.265,0,0,1-.19.449Z" transform="translate(-11.619 -0.001)" fill="#e94808" stroke="#ea4d0f" stroke-width="0.5"/></g><line x2="7.635" transform="translate(6.294 14.5)" fill="none" stroke="#ea4d0f" stroke-linecap="round" stroke-width="1"/><line x2="7.635" transform="translate(6.294 11.5)" fill="none" stroke="#ea4d0f" stroke-linecap="round" stroke-width="1"/><line x2="7.635" transform="translate(6.294 8.5)" fill="none" stroke="#ea4d0f" stroke-linecap="round" stroke-width="1"/><line x2="3" transform="translate(6.294 5.5)" fill="none" stroke="#ea4d0f" stroke-linecap="round" stroke-width="1"/></g></svg>
                            <?/*<img class="svg svg-stroke btn__ic" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-doc.svg" width="15" height="18" alt="">*/?>
                        К документам
                    </a>
                </div>
            </div>
        </div>
        <?$APPLICATION->IncludeComponent(
	"slam:easyform",
	"mainForm",
                array(
                    "COMPONENT_TEMPLATE" => "mainForm",
                    "FORM_ID" => "FORM4",
                    "FORM_NAME" => "Остались вопросы? Мы ответим!",
                    "WIDTH_FORM" => "500px",
                    "DISPLAY_FIELDS" => array(
                        0 => "TITLE",
                        1 => "PHONE",
                        2 => "CUR_PAGE",
                        3 => "USER_IP",
                    ),
                    "REQUIRED_FIELDS" => array(
                        0 => "PHONE",
                        1 => "",
                    ),
                    "FIELDS_ORDER" => "TITLE,PHONE,CUR_PAGE",
                    "CLEAR_FORM" => "N",
                    "FORM_AUTOCOMPLETE" => "Y",
                    "HIDE_FIELD_NAME" => "Y",
                    "HIDE_ASTERISK" => "Y",
                    "FORM_SUBMIT_VALUE" => "Позвоните мне",
                    "SEND_AJAX" => "Y",
                    "SHOW_MODAL" => "N",
                    "_CALLBACKS" => "success_FORM2",
                    "OK_TEXT" => "Ваше сообщение отправлено. Мы свяжемся с вами в течение 2х часов",
                    "ERROR_TEXT" => "Произошла ошибка. Сообщение не отправлено.",
                    "ENABLE_SEND_MAIL" => "Y",
                    "CREATE_SEND_MAIL" => "",
                    "EVENT_MESSAGE_ID" => array(
                        0 => "50",
                    ),
                    "EMAIL_TO" => "",
                    "EMAIL_BCC" => "",
                    "MAIL_SUBJECT_ADMIN" => "#SITE_NAME#: Сообщение из формы обратной связи",
                    "EMAIL_FILE" => "N",
                    "USE_IBLOCK_WRITE" => "N",
                    "CATEGORY_TITLE_TITLE" => "Имя клиента:",
                    "CATEGORY_TITLE_TYPE" => "text",
                    "CATEGORY_TITLE_PLACEHOLDER" => "Ваше имя",
                    "CATEGORY_TITLE_CLASS" => "col-1-3",
                    "CATEGORY_TITLE_VALUE" => "",
                    "CATEGORY_PHONE_TITLE" => "Телефон:",
                    "CATEGORY_PHONE_TYPE" => "tel",
                    "CATEGORY_PHONE_PLACEHOLDER" => "Номер телефона",
                    "CATEGORY_PHONE_CLASS" => "col-1-3",
                    "CATEGORY_PHONE_VALUE" => "",
                    "CATEGORY_PHONE_INPUTMASK" => "N",
                    "CATEGORY_PHONE_INPUTMASK_TEMP" => "+7 (999) 999-9999",
                    "CATEGORY_USER_IP_TITLE" => "USER_IP",
                    "CATEGORY_USER_IP_TYPE" => "hidden",
                    "CATEGORY_USER_IP_CLASS" => "general-itemInput",
                    "CATEGORY_USER_IP_VALUE" => $_SERVER["REMOTE_ADDR"],
                    "USE_CAPTCHA" => "N",
                    "USE_MODULE_VARNING" => "N",
                    "USE_FORMVALIDATION_JS" => "N",
                    "USE_JQUERY" => "N",
                    "USE_BOOTSRAP_CSS" => "N",
                    "USE_BOOTSRAP_JS" => "N",
                    "FORM_SUBMIT_VARNING" => "Отправляя форму, вы подтверждаете своё согласие на <a href=\"/privacy-policy/\" target=\"_blank\">обработку персональных данных</a>",
                    "CATEGORY_CUR_PAGE_TITLE" => "Страница обращения:",
                    "CATEGORY_CUR_PAGE_TYPE" => "hidden",
                    "CATEGORY_CUR_PAGE_CLASS" => "general-itemInput",
                    "CATEGORY_CUR_PAGE_VALUE" => (@($_SERVER["HTTPS"]!="on")?"http://".$_SERVER["SERVER_NAME"]:"https://".$_SERVER["SERVER_NAME"]).($_SERVER["SERVER_PORT"]!=80?":".$_SERVER["SERVER_PORT"]:"").$_SERVER["REQUEST_URI"]
                ),
                false
            );?>
            <?
            $APPLICATION->IncludeComponent(
                "bitrix:catalog.section.list",
                "sectionBlock",
                array(
                    "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                    "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                    "CACHE_TIME" => $arParams["CACHE_TIME"],
                    "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                    "COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
                    "TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
                    "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                    "VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
                    "PAGE_TYPE" => $typeOfApartment,
                    "SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
                    "HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
                    "ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : ''),
                    "CURRENT_SECTION" => $arResult['VARIABLES']['SECTION_CODE']
                ),
                $component,
                array("HIDE_ICONS" => "N")
                //($arParams["SHOW_TOP_ELEMENTS"] !== "N" ? array("HIDE_ICONS" => "N") : array())
            );
            ?>
            <?if(!empty($userProps['UF_SEO_BOTTOM']['VALUE']['TEXT'])){?>
                <div class="container section-margin">
                    <div class="content">
                        <p class="sub-color mb-0"><?=$userProps['UF_SEO_BOTTOM']['VALUE']['TEXT']?></p>
                    </div>
                </div>
            <?}?>
    </div>
    <?include($_SERVER['DOCUMENT_ROOT']."$templateFolder/include/section/modal.php")?>
