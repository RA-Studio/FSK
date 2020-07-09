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
$arResultCart = [];
$cartStaticInfo = [];
$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_*", "TIMESTAMP_X");
$arFilter = Array(
    "IBLOCK_ID" => $arParams['IBLOCK_ID'],
    "ACTIVE"=>"Y",
    "SECTION_ID" => $arResult['VARIABLES']['SECTION_ID'],
    "INCLUDE_SUBSECTIONS" => "Y",
    "PROPERTY_category" => "flat",
);
$res = CIBlockElement::GetList(Array("PROPERTY_rooms" => "ASC", "PROPERTY_price" => "ASC"), $arFilter, false, Array(), $arSelect);
$timeUpdate = false;
$filterData = [];
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
    $filterData['price'][] = $temp['PROPERTIES']['price']['VALUE'];
    $filterData['area'][] = $temp['PROPERTIES']['area']['VALUE'];
    $filterData['floor'][] = $temp['PROPERTIES']['floor']['VALUE'];
    $filterData['kitchenspace'][] = $temp['PROPERTIES']['kitchenspace']['VALUE'];
    $filterData['builtyear'][] = $temp['PROPERTIES']['builtyear']['VALUE'];


}
$SectionInfo = array();
//Получаем тип раздела и основную информацию о разделе
if (intval($arResult["VARIABLES"]["SECTION_ID"]) > 0) {
    $SectionsRes = CIBlockSection::GetList(
            Array("SORT" => "ASC"),
            Array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ACTIVE" => "Y", "ID" => $arResult["VARIABLES"]["SECTION_ID"]),
            false,
            Array("IBLOCK_ID", "ID", "NAME", "UF_SECTION_NAME")
    );

    if ( $SectionsRes->SelectedRowsCount() ) {
        $SectionInfo = $SectionsRes->GetNext();
    }
}
?>
<?php
$fullProps = []; // массив со всеми данными ЖК
CModule::IncludeModule('iblock');
$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_*");
$arFilter = Array("IBLOCK_ID"=>5, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "ID"=>$SectionInfo["UF_SECTION_NAME"]);
$res = CIBlockElement::GetList(Array("RAND" => "ASC"), $arFilter, false, Array("nPageSize"=>1), $arSelect);
?>

<?php if($res->arResult): ?>
    <?php while($ob = $res->GetNextElement()): $fullProps['standartProps'] = $ob->GetFields(); $fullProps['userProps'] = $ob->GetProperties();?>
    <?php endwhile; ?>
<?php endif; ?>
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
            'filter' => array('UF_XML_ID' => $fullProps['userProps']['UF_FEATURES']['VALUE']),
            'limit' => '50',
    ));
    while ($arItem = $rsData->Fetch()) {
        $features[] = $arItem;
    }
}
?>
<?php
$progressGallery = []; // массив с галереей хода строительства этого ЖК
CModule::IncludeModule('iblock');
$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_*");
$arFilter = Array("IBLOCK_ID"=>6, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "SECTION_ID"=>$SectionInfo['ID']);

if($_REQUEST["date"]) {
    $arFilter['UF_GALLERY_MONTH'] = $_REQUEST["date"];
}

$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>999), $arSelect);

?>
<?php echo '<pre style="display:none">',print_r($SectionInfo,1),'</pre>'; ?>
    <div class="page page-project">
        <div class="p-hero project-hero" style="background-image: url('<?=SITE_TEMPLATE_PATH?>/img/card-img.jpg')">
            <div class="container">
                <div class="p-hero__inner">
                    <div class="project-hero__img">
                        <img class="img" src="<?=CFile::GetPath($fullProps['userProps']['UF_MAIN_ICON']['VALUE']);?>" alt="alt">
                    </div>
                    <h1 class="h1 p-hero__title"><?=$fullProps['standartProps']['NAME'];?></h1>
                    <?php
                        if ($fullProps['userProps']['UF_METRO']['VALUE']) { // если метро задано то подгружаем хайлоадблок
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
                                        'filter' => array('UF_XML_ID' => $fullProps['userProps']['UF_METRO']['VALUE']),
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
                                <?php
                                    if ($fullProps['userProps']['UF_WALK_TIME']['VALUE']) { // если время до метро задано
                                        ?>
                                        <div class="p-distance flex">
                                            <img class="img" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-walk-dist.svg" width="8" height="13" alt="alt">
                                            <span><?=$fullProps['userProps']['UF_WALK_TIME']['VALUE'];?></span>
                                        </div>
                                        <?
                                    }
                                    if ($fullProps['userProps']['UF_TRANSPORT_TIME']['VALUE']) {
                                        ?>
                                        <div class="p-distance flex">
                                            <img class="svg" src="<?=SITE_TEMPLATE_PATH?>img/icons/ic-transport-dist.svg" width="15" height="16" alt="alt">
                                            <span><?=$fullProps['userProps']['UF_TRANSPORT_TIME']['VALUE'];?></span>
                                        </div>
                                        <?
                                    }
                                ?>

                            </div>
                            <?
                        }
                    ?>
                    <?php
                        if ($fullProps['userProps']['UF_DISCOUNT_TEXT']['VALUE']) {
                            ?>
                            <div class="p-discount flex">
                                <div class="p-discount__ic">%</div>
                                <p class="p-discount__txt"><?=$fullProps['userProps']['UF_DISCOUNT_TEXT']['VALUE'];?></p>
                            </div>
                            <?
                        }
                    ?>
                    <div class="breadcrumbs" itemscope="" itemtype="http://schema.org/BreadcrumbList"><span itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a rel="nofollow" itemprop="item" title="Главная" href="/"><span itemprop="name">Главная</span>
                    <meta itemprop="position" content="1"></a></span><span itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a rel="nofollow" itemprop="item" title="Новостройки" href="newbuild.html"><span itemprop="name">Новостройки</span>
                    <meta itemprop="position" content="2"></a></span><span itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a rel="nofollow" itemprop="item" title="UP &quot;Пушкинский&quot;" href="#"><span itemprop="name">UP "Пушкинский"</span>
                    <meta itemprop="position" content="3"></a></span></div>
                </div>
            </div>
        </div>
        <div class="scrollspy-menu">
            <div class="container scrollspy-menu__slider"><a class="active" href="#p-1">О проекте</a><a href="#p-2">Галерея</a><a href="#p-3">Расположение</a><a href="#p-4">Преимущества</a><a href="#p-5">Акции</a><a href="#p-6">Квартиры</a><a href="#p-7">Ипотека</a><a href="#p-8">Ход строительства</a><a href="#p-9">Офис продаж</a><a href="#p-10">Документы</a></div>
        </div>
        <div class="project-about scrollspy-item" id="p-1">
            <div class="container">
                <h2 class="h1 title">О проекте</h2>
                <?=$fullProps['userProps']['UF_PROJECT_NAME']['~VALUE']['TEXT'];?>
                <!--<p>Жилой комплекс бизнес-класса в престижном Хорошёвском районе в окружении исторической сталинской застройки и статусных жилых комплексов. Это идеальное сочетание престижа района, авторской архитектуры, индивидуального подхода к планировкам и дизайну интерьеров комплекса. Жилой комплекс бизнес-класса в престижном Хорошёвском районе в окружении исторической сталинской застройки и статусных жилых комплексов. Это идеальное сочетание престижа района, авторской архитектуры, индивидуального подхода к планировкам и дизайну интерьеров комплекса.</p>-->
                <?php if (!empty($features)): ?>
                    <div class="project-data">
                        <?php foreach ($features as $item): ?>
                            <div class="project-data__col">
                                <img class="img" src="<?=CFile::GetPath($item['UF_FILE']);?>" alt="alt">
                                <div>
                                    <div class="sub-text"><?=$item['UF_NAME'];?></div>
                                    <div class="project-data__val"><?=$item['UF_DESCRIPTION'];?></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="gallery project-photos section-margin scrollspy-item" id="p-2">
            <div class="container">
                <h2 class="h1 title">Галерея</h2>
                <div class="gallery-slider-xl" id="gallery-1">
                    <?php foreach($fullProps['userProps']['UF_GALLERY']['VALUE'] as $galleryItem) : ?>
                        <div class="slide">
                            <img class="img" src="<?=CFile::GetPath($galleryItem);?>" alt="alt">
                            <button class="ui-btn zoom-link" href="<?=CFile::GetPath($galleryItem);?>" data-fancybox="gallery1">
                                <img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-zoom.svg" width="15" height="15" alt="zoom">
                            </button>
                        </div>
                    <?php endforeach; ?>
                    <!--<div class="slide"><img class="img" src="<?/*=SITE_TEMPLATE_PATH*/?>/img/img-main-2.jpg" alt="alt">
                        <button class="ui-btn zoom-link" href="img/img-main-2.jpg" data-fancybox="gallery1"><img class="svg" src="<?/*=SITE_TEMPLATE_PATH*/?>/img/icons/ic-zoom.svg" width="15" height="15" alt="zoom"></button>
                    </div>
                    <div class="slide"><img class="img" src="<?/*=SITE_TEMPLATE_PATH*/?>/img/img-main-3.jpg" alt="alt">
                        <button class="ui-btn zoom-link" href="img/img-main-3.jpg" data-fancybox="gallery1"><img class="svg" src="<?/*=SITE_TEMPLATE_PATH*/?>/img/icons/ic-zoom.svg" width="15" height="15" alt="zoom"></button>
                    </div>
                    <div class="slide"><img class="img" src="<?/*=SITE_TEMPLATE_PATH*/?>/img/img-main-4.jpg" alt="alt">
                        <button class="ui-btn zoom-link" href="img/img-main-4.jpg" data-fancybox="gallery1"><img class="svg" src="<?/*=SITE_TEMPLATE_PATH*/?>/img/icons/ic-zoom.svg" width="15" height="15" alt="zoom"></button>
                    </div>
                    <div class="slide"><img class="img" src="<?/*=SITE_TEMPLATE_PATH*/?>/img/img-main-1.jpg" alt="alt">
                        <button class="ui-btn zoom-link" href="img/img-main-1.jpg" data-fancybox="gallery1"><img class="svg" src="<?/*=SITE_TEMPLATE_PATH*/?>/img/icons/ic-zoom.svg" width="15" height="15" alt="zoom"></button>
                    </div>
                    <div class="slide"><img class="img" src="<?/*=SITE_TEMPLATE_PATH*/?>/img/img-main-2.jpg" alt="alt">
                        <button class="ui-btn zoom-link" href="img/img-main-2.jpg" data-fancybox="gallery1"><img class="svg" src="<?/*=SITE_TEMPLATE_PATH*/?>/img/icons/ic-zoom.svg" width="15" height="15" alt="zoom"></button>
                    </div>
                    <div class="slide"><img class="img" src="<?/*=SITE_TEMPLATE_PATH*/?>/img/img-main-3.jpg" alt="alt">
                        <button class="ui-btn zoom-link" href="img/img-main-3.jpg" data-fancybox="gallery1"><img class="svg" src="<?/*=SITE_TEMPLATE_PATH*/?>/img/icons/ic-zoom.svg" width="15" height="15" alt="zoom"></button>
                    </div>
                    <div class="slide"><img class="img" src="<?/*=SITE_TEMPLATE_PATH*/?>/img/img-main-4.jpg" alt="alt">
                        <button class="ui-btn zoom-link" href="img/img-main-4.jpg" data-fancybox="gallery1"><img class="svg" src="<?/*=SITE_TEMPLATE_PATH*/?>/img/icons/ic-zoom.svg" width="15" height="15" alt="zoom"></button>
                    </div>
                    <div class="slide"><img class="img" src="<?/*=SITE_TEMPLATE_PATH*/?>/img/img-main-1.jpg" alt="alt">
                        <button class="ui-btn zoom-link" href="img/img-main-1.jpg" data-fancybox="gallery1"><img class="svg" src="<?/*=SITE_TEMPLATE_PATH*/?>/img/icons/ic-zoom.svg" width="15" height="15" alt="zoom"></button>
                    </div>-->
                </div>
                <!-- /.gallery-slider-xl-->
                <div class="gallery-slider-sm" id="gallery-1-thumbs">
                    <?php foreach($fullProps['userProps']['UF_GALLERY']['VALUE'] as $galleryItem) : ?>
                        <div class="slide">
                            <img class="img" src="<?=CFile::GetPath($galleryItem);?>" alt="alt">
                        </div>
                    <?php endforeach; ?>
                    <!--<div class="slide"><img class="img" src="<?/*=SITE_TEMPLATE_PATH*/?>/img/img-main-1.jpg" alt="alt"></div>
                    <div class="slide"><img class="img" src="<?/*=SITE_TEMPLATE_PATH*/?>/img/img-main-2.jpg" alt="alt"></div>-->
                    <!--<div class="slide">
                        <img class="img" src="<?/*=SITE_TEMPLATE_PATH*/?>/img/img-main-3.jpg" alt="alt">
                    </div>-->
                    <!--<div class="slide"><img class="img" src="<?/*=SITE_TEMPLATE_PATH*/?>/img/img-main-4.jpg" alt="alt"></div>
                    <div class="slide"><img class="img" src="<?/*=SITE_TEMPLATE_PATH*/?>/img/img-main-1.jpg" alt="alt"></div>-->
                    <!--div class="slide"><img class="img" src="<?/*=SITE_TEMPLATE_PATH*/?>/img/img-main-2.jpg" alt="alt"></div>
                    <div class="slide"><img class="img" src="<?/*=SITE_TEMPLATE_PATH*/?>/img/img-main-3.jpg" alt="alt"></div>
                    <div class="slide"><img class="img" src="<?/*=SITE_TEMPLATE_PATH*/?>/img/img-main-4.jpg" alt="alt"></div>
                    <div class="slide"><img class="img" src="<?/*=SITE_TEMPLATE_PATH*/?>/img/img-main-1.jpg" alt="alt"></div>-->
                </div>
                <!-- /.gallery-slider-sm-->
                <?php
                    if ($fullProps['userProps']['UF_URL_3D']['VALUE'] || $fullProps['userProps']['UF_URL_STREAM']['VALUE'] || $fullProps['userProps']['UF_URL_PROGRESS']['VALUE']) { // если есть хотя бы какая то ссылка то выводим
                        ?>
                        <div class="gallery-btns">
                            <?php if ($fullProps['userProps']['UF_URL_3D']['VALUE']): ?>
                                <a class="btn btn--transp" href="<?=$fullProps['userProps']['UF_URL_3D']['VALUE'];?>">
                                    <img class="svg svg-stroke btn__ic" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-circles.svg" width="22" height="22" alt="3d">3D-тур по объекту
                                </a>
                            <?php endif; ?>
                            <?php if ($fullProps['userProps']['UF_URL_3D']['VALUE']): ?>
                                <a class="btn btn--transp" href="<?=$fullProps['userProps']['UF_URL_STREAM']['VALUE'];?>">
                                    <img class="svg svg-stroke btn__ic" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-circles.svg" width="20" height="20" alt="3d">Онлайн трансляция
                                </a>
                            <?php endif; ?>
                            <?php if ($fullProps['userProps']['UF_URL_3D']['VALUE']): ?>
                                <a class="btn btn--transp" href="<?=$fullProps['userProps']['UF_URL_PROGRESS']['VALUE'];?>">
                                    <img class="svg svg-stroke btn__ic" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-circles.svg" width="20" height="20" alt="3d">Ход строительства
                                </a>
                            <?php endif; ?>
                        </div>
                        <?
                    }
                ?>

            </div>
        </div>
        <div class="project-geo section-margin scrollspy-item" id="p-3">
            <div class="container">
                <h2 class="h1 title">Расположение и инфраструктура</h2>
            </div>
            <!--<div class="map" id="map1" style="background: url('<?/*=SITE_TEMPLATE_PATH*/?>/img/img-map-marks.jpg') no-repeat 50% 50% / cover"></div>-->
            <div class="map" id="map"></div> <!-- загружаем карту -->
            <script>
                <?echo $fullProps['userProps']['UF_MAP_CODE']['~VALUE']['TEXT']?>
            </script>
            <!--<div class="f-row">
                <div class="cols col-1-3">
                    <div class="geo-label">
                        <span class="geo-label__ic" style="background: #F35E41"> </span>Надземные и подземные парковки;
                    </div>
                    <div class="geo-label">
                        <span class="geo-label__ic" style="background: #FD5EB6"> </span>Коммерческие помещения на первых этажах;
                    </div>
                    <div class="geo-label">
                        <span class="geo-label__ic" style="background: #19A91C"> </span>Поликлиника;
                    </div>
                    <div class="geo-label">
                        <span class="geo-label__ic" style="background: #FD8C40"> </span>Торговый центр.
                    </div>
                </div>
                <div class="cols col-1-3">
                    <div class="geo-label">
                        <span class="geo-label__ic" style="background: #F35E41"> </span>Надземные и подземные парковки;
                    </div>
                    <div class="geo-label">
                        <span class="geo-label__ic" style="background: #FD5EB6"> </span>Коммерческие помещения на первых этажах;
                    </div>
                    <div class="geo-label">
                        <span class="geo-label__ic" style="background: #19A91C"> </span>Поликлиника;
                    </div>
                    <div class="geo-label">
                        <span class="geo-label__ic" style="background: #FD8C40"> </span>Торговый центр.
                    </div>
                </div>
                <div class="cols col-1-3">
                    <div class="geo-label">
                        <span class="geo-label__ic" style="background: #F35E41"> </span>Надземные и подземные парковки;
                    </div>
                    <div class="geo-label">
                        <span class="geo-label__ic" style="background: #FD5EB6"> </span>Коммерческие помещения на первых этажах;
                    </div>
                    <div class="geo-label">
                        <span class="geo-label__ic" style="background: #19A91C"> </span>Поликлиника;
                    </div>
                    <div class="geo-label">
                        <span class="geo-label__ic" style="background: #FD8C40"> </span>Торговый центр.
                    </div>
                </div>
            </div>-->
            <?php if ($fullProps['userProps']['UF_MAP_LABELS']) : ?>
                <?php
                // Если есть подписи - вызываем хайлоадблок
                $mapLabels = [];
                if (CModule::IncludeModule('highloadblock')) {
                    $arHLBlock = Bitrix\Highloadblock\HighloadBlockTable::getById(9)->fetch();
                    $obEntity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arHLBlock);
                    $strEntityDataClass = $obEntity->getDataClass();
                }

                //Получение списка:
                if (CModule::IncludeModule('highloadblock')) {
                    $rsData = $strEntityDataClass::getList(array(
                            'select' => array('ID','UF_DESCRIPTION', 'UF_NAME', 'UF_FULL_DESCRIPTION'),
                            'order' => array('ID' => 'ASC'),
                            'limit' => '50',
                    ));
                    while ($arItem = $rsData->Fetch()) {
                        $mapLabels[] = $arItem;
                    }
                }

                ?>
                <div class="container">
                    <div class="f-row">
                        <?php foreach($mapLabels as $index => $label) : ?>
                            <?php if ($index === 0) :?>
                                <div class="cols col-1-3">
                            <?php endif; ?>
                                <div class="geo-label">
                                    <span class="geo-label__ic" style="background: <?=$label['UF_DESCRIPTION']?>"> </span><?=$label['UF_NAME']?>
                                </div>
                            <?php if (($index+1) % 4 === 0) :?>
                                </div>
                            <?php endif;?>
                            <?php if (($index+1) % 4 === 0) :?>
                                <div class="cols col-1-3">
                            <?php endif; ?>
                        <?php endforeach;?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <?php if ($fullProps['userProps']['UF_ADVANTAGES_GALLERY']['VALUE']) :?>
            <?php
            // Если есть галерея - вызываем хайлоадблок
            $advantages = [];
            if (CModule::IncludeModule('highloadblock')) {
                $arHLBlock = Bitrix\Highloadblock\HighloadBlockTable::getById(8)->fetch();
                $obEntity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arHLBlock);
                $strEntityDataClass = $obEntity->getDataClass();
            }

            //Получение списка:
            if (CModule::IncludeModule('highloadblock')) {
                $rsData = $strEntityDataClass::getList(array(
                        'select' => array('ID','UF_FILE','UF_DESCRIPTION', 'UF_NAME'),
                        'order' => array('ID' => 'ASC'),
                        'limit' => '50',
                ));
                while ($arItem = $rsData->Fetch()) {
                    $advantages[] = $arItem;
                }
            }
            ?>

            <div class="project-advantages section-margin scrollspy-item" id="p-4">
            <div class="container">
                <h2 class="h1 title">Преимущества</h2>
                <div class="advantages-slider">
                    <div class="slide">
                        <div class="p-item page-block">
                            <div class="p-item__img">
                                <div class="advantages-slider-img">
                                    <?php foreach($advantages as $advantagesItem) : ?>
                                        <div class="slide">
                                            <img class="img" src="<?=CFile::GetPath($advantagesItem['UF_FILE']);?>" alt="alt">
                                            <button class="ui-btn zoom-link" href="<?=CFile::GetPath($advantagesItem['UF_FILE']);?>" data-fancybox="advantage1">
                                                <img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-zoom.svg" width="15" height="15" alt="zoom">
                                            </button>
                                        </div>
                                    <?php endforeach; ?>
                                    <!--<div class="slide"><img class="img" src="<?/*=SITE_TEMPLATE_PATH*/?>/img/img-advantage-1.jpg" alt="alt">
                                        <button class="ui-btn zoom-link" href="img/img-advantage-1.jpg" data-fancybox="advantage1"><img class="svg" src="<?/*=SITE_TEMPLATE_PATH*/?>/img/icons/ic-zoom.svg" width="15" height="15" alt="zoom"></button>
                                    </div>
                                    <div class="slide"><img class="img" src="<?/*=SITE_TEMPLATE_PATH*/?>/img/img-advantage-1.jpg" alt="alt">
                                        <button class="ui-btn zoom-link" href="img/img-advantage-1.jpg" data-fancybox="advantage1"><img class="svg" src="<?/*=SITE_TEMPLATE_PATH*/?>/img/icons/ic-zoom.svg" width="15" height="15" alt="zoom"></button>
                                    </div>-->
                                </div>
                            </div>
                            <div class="p-item__content">
                                <div class="advantages-slider-text">
                                    <?php foreach($advantages as $advantagesItem) : ?>
                                        <div class="slide">
                                            <div class="h2 text-bold"><?=$advantagesItem['UF_NAME'];?></div>
                                            <div class="p-item__title"><?=$advantagesItem['UF_DESCRIPTION'];?></div>
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
                                        </div>
                                    <?php endforeach; ?>
                                        <!--<div class="slide">
                                            <div class="h2 text-bold">Рядом красивый парк</div>
                                            <div class="p-item__title">Жилой комплекс бизнес-класса в престижном Хорошёвском районе в окружении исторической сталинской застройки и статусных жилых комплексов. Это идеальное сочетание престижа района, авторской архитектуры, индивидуального подхода к планировкам и дизайну интерьеров комплекса.</div>
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
                                        </div>-->
                                    <!--<div class="slide">
                                        <div class="h2 text-bold">Преимущество 2</div>
                                        <div class="p-item__title">Жилой комплекс бизнес-класса в престижном Хорошёвском районе в окружении исторической сталинской застройки и статусных жилых комплексов. Это идеальное сочетание престижа района, авторской архитектуры, индивидуального подхода к планировкам и дизайну интерьеров комплекса. Жилой комплекс бизнес-класса в престижном Хорошёвском районе в окружении исторической сталинской застройки и статусных жилых комплексов. Это идеальное сочетание престижа района, авторской архитектуры, индивидуального подхода к планировкам и дизайну интерьеров комплекса.</div>
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
                                    </div>
                                    <div class="slide">
                                        <div class="h2 text-bold">Преимущество 3</div>
                                        <div class="p-item__title">Жилой</div>
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
                                    </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="container section-margin scrollspy-item" id="p-5">
            <h2 class="h1 title">Акции и скидки</h2>
            <div class="p-list">
                <div class="f-row">
                    <div class="cols col-1-2">
                        <div class="p-item">
                            <div class="p-item__img"><a href="news-page.html"><img class="img" src="<?=SITE_TEMPLATE_PATH?>/img/img-thumb-1.jpg" alt="news1"></a></div>
                            <div class="p-item__content"><span class="p-item__date">31 января 2020</span>
                                <div class="p-item__title"><a href="news-page.html">Длинный заголовок какой-то новости или акции, которая длится очень долго и...</a></div><a class="btn btn--transp" href="news-page.html"><img class="svg btn__ic ic-read" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-read.svg" alt="link" width="15" height="19">Подробнее</a>
                            </div>
                        </div>
                    </div>
                    <div class="cols col-1-2">
                        <div class="p-item">
                            <div class="p-item__img"><a href="news-page.html"><img class="img" src="<?=SITE_TEMPLATE_PATH?>/img/img-thumb-1.jpg" alt="news1"></a></div>
                            <div class="p-item__content"><span class="p-item__date">31 января 2020</span>
                                <div class="p-item__title"><a href="news-page.html">Длинный заголовок какой-то новости или акции, которая длится очень долго и...</a></div><a class="btn btn--transp" href="news-page.html"><img class="svg btn__ic ic-read" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-read.svg" alt="link" width="15" height="19">Подробнее</a>
                            </div>
                        </div>
                    </div>
                    <div class="cols col-1-2">
                        <div class="p-item">
                            <div class="p-item__img"><a href="news-page.html">
                                    <div class="img img-empty"></div></a></div>
                            <div class="p-item__content"><span class="p-item__date">31 января 2020</span>
                                <div class="p-item__title"><a href="news-page.html">Длинный заголовок какой-то новости или акции, которая длится очень долго и...</a></div><a class="btn btn--transp" href="news-page.html"><img class="svg btn__ic ic-read" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-read.svg" alt="link" width="15" height="19">Подробнее</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container section-margin scrollspy-item container__relative" id="p-6">
            <h2 class="h1 title" id="filter-anchor">Выбор квартир</h2>
            <?include($_SERVER['DOCUMENT_ROOT']."$templateFolder/include/section/filter.php")?>
            <!-- /.filter-->
            <div class="results">
                <div class="results__row results__header">
                    <div class="results__col">
                        <div class="results__row">
                            <!-- десктопная сортировка-->
                            <div class="results__cell results-cell-1"><span>План</span></div>
                            <div class="results__cell results-cell-2">
                                <button class="sort sort--active" type="button"><img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-sort.svg" width="9.5" height="9.25" alt="sort"><span>Площадь, м<sup>2</sup></span></button>
                            </div>
                            <div class="results__cell results-cell-3"><span>Этаж</span></div>
                            <div class="results__cell results-cell-4">
                                <button class="sort sort--flip" type="button"><img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-sort.svg" width="9.5" height="9.25" alt="sort"><span>Готовность</span></button>
                            </div>
                            <div class="results__cell results-cell-5">
                                <button class="sort" type="button"><img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-sort.svg" width="9.5" height="9.25" alt="sort"><span>Цена</span></button>
                            </div>
                            <!-- мобильная сортировка-->
                            <div class="mob-sort"><span class="mob-sort__hint">Сортировать</span>
                                <select class="ui-select" name="mob_sort" data-placeholder="по цене">
                                    <option class="active" value="2020">по цене</option>
                                    <option value="2021">по площади</option>
                                    <option value="2022">по готовности</option>
                                </select><img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-sort.svg" width="9.5" height="9.25" alt="sort">
                            </div>
                        </div>
                    </div>
                    <!-- /.results__col	-->
                    <div class="interactive-btns"><a class="interactive-btn interactive-download" href="#" title="Скачать" download></a><a class="interactive-btn interactive-print" href="print.html" target="_blank" title="Распечатать"></a><a class="interactive-btn interactive-favorite" href="#"><img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-star.svg" alt="Добавить в закладки"></a></div>
                </div>
                <!-- /.results__row-->
                <div class="results__body">
                    <div class="results__col">
                        <div class="results-screen" id="results-screen">
                            <?foreach ($cartStaticInfo as $key => $category):?>
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
                                    <div class="results__row" data-plan="<?=CFile::GetPath($cart['PROPERTIES']['image']['VALUE'][0])?>">
                                        <div class="results__cell results-cell-1 js-call-card" style="    min-height: 60px;"><img class="img plan-thumb" src="<?=CFile::GetPath($cart['PROPERTIES']['image']['VALUE'][0])?>" alt="alt"></div>
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
                            <?endforeach;?>
                        </div>
                    </div>
                    <!-- /.results__col	-->
                    <div class="results__offer results-offer">
                        <div class="results__img">
                            <img class="img" src="<?=SITE_TEMPLATE_PATH?>/img/img-plan.jpg" alt="plan" style="max-height: 100%;">
                            <button class="results-offer__modal js-call-card" type="button"><img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-flat-plan.svg" width="36" height="44" alt="flat plan"></button>
                        </div>
                        <div class="results-offer__footer">
                            <div class="results-offer__text">
                                <p>Интересует студия 22 м<sup>2</sup> ? </p>
                                <p>Посмотрите
                                    <button class="text-btn js-call-card" button="button">подробнее!</button>
                                </p>
                            </div>
                            <div class="results-offer__btn">
                                <button class="btn btn--cta js-call-callback" type="button"> <img class="svg btn__ic ic-tel" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-tel.svg" alt="phone" width="12" height="20">Позвоните мне</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.results__offer-->
                </div>
                <!-- /.results__body-->
            </div>
            <!-- /.results-->
            <div class="results-refresh">
                <img class="svg btn__ic" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-refresh.svg" alt="refresh" width="14" height="14">
                Информация обновлена
                <span><?=CIBlockFormatProperties::DateFormat("j M Y", strtotime($timeUpdate));?></span>.
            </div>
            <div class="results-more">
                <button class="btn btn--transp" type="button"><img class="svg btn__ic ic-arrow ic-arrow--down" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-arrow.svg" alt="link" width="20" height="20">Показать ещё</button>
            </div>
        </div>
        <div class="project-ipo scrollspy-item" id="p-7">
            <div class="container">
                <h2 class="h1 title">Ипотека - это просто!</h2>
                <div class="ipo">
                    <div class="ipo-calc">
                        <div class="filter-row">
                            <div class="filter-fields">
                                <div class="filter__field filter-field">
                                    <div class="filter-field__label">Стоимость, р. </div>
                                    <div class="ui-quantity" data-step="100000">
                                        <button class="ui-quantity__btn ui-quantity__minus"><img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-minus.svg" width="10" height="2" alt="Минус"></button>
                                        <input type="text" value="2 500 000">
                                        <button class="ui-quantity__btn ui-quantity__plus"><img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-plus.svg" width="10" height="10" alt="Плюс"></button>
                                    </div>
                                </div>
                                <div class="filter__field filter-field">
                                    <div class="filter-field__label">Первоначальный взнос</div>
                                    <div class="ui-quantity" data-step="100000">
                                        <button class="ui-quantity__btn ui-quantity__minus"><img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-minus.svg" width="10" height="2" alt="Минус"></button>
                                        <input type="text" value="1 500 000">
                                        <button class="ui-quantity__btn ui-quantity__plus"><img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-plus.svg" width="10" height="10" alt="Плюс"></button>
                                    </div>
                                </div>
                                <div class="filter__field filter-field">
                                    <div class="filter-field__label">Срок</div>
                                    <div class="ui-quantity ui-quantity--years" data-step="1">
                                        <button class="ui-quantity__btn ui-quantity__minus"><img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-minus.svg" width="10" height="2" alt="Минус"></button>
                                        <input class="years" type="text" value="10 лет">
                                        <button class="ui-quantity__btn ui-quantity__plus"><img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-plus.svg" width="10" height="10" alt="Плюс"></button>
                                    </div>
                                </div>
                                <div class="filter__field filter-field-result">
                                    <button class="btn btn--bg" type="button"><img class="svg btn__ic" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-btn-percentage.svg" width="20" height="20" alt="Минус">Рассчитать платеж</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.ipo-calc-->
                    <div class="ipo-table">
                        <div class="ipo-table__row ipo-table__header">
                            <div class="ipo-bank">Банк</div>
                            <div class="ipo-info">
                                <div class="ipo-info__col"><span class="hide-on-mob">Ежемесячный </span>платёж, р.</div>
                                <div class="ipo-info__col">Срок</div>
                                <div class="ipo-info__col">Ставка</div>
                            </div>
                        </div>
                        <div class="ipo-table__row">
                            <div class="ipo-bank"><img class="img" src="<?=SITE_TEMPLATE_PATH?>/img/ipo/sber.png" alt="Сбербанк"></div>
                            <div class="ipo-licence">
                                <div>Сбербанк России ПАО</div><span class="sub-text">Лицензия № 1481 от 11.08.2015</span>
                            </div>
                            <div class="ipo-info">
                                <div class="ipo-info__col" data-title="Ежемесячный платёж, р.">49 982</div>
                                <div class="ipo-info__col" data-title="Срок">до 30 лет</div>
                                <div class="ipo-info__col" data-title="Ставка">6%</div>
                            </div>
                        </div>
                        <div class="ipo-table__row">
                            <div class="ipo-bank"><img class="img" src="<?=SITE_TEMPLATE_PATH?>/img/ipo/vtb.png" alt="ВТБ"></div>
                            <div class="ipo-licence">
                                <div>Банк ВТБ</div><span class="sub-text">Лицензия № 1481 от 11.08.2015</span>
                            </div>
                            <div class="ipo-info">
                                <div class="ipo-info__col" data-title="Ежемесячный платёж, р.">49 982</div>
                                <div class="ipo-info__col" data-title="Срок">до 30 лет</div>
                                <div class="ipo-info__col" data-title="Ставка">6%</div>
                            </div>
                        </div>
                        <div class="ipo-table__row">
                            <div class="ipo-bank"><img class="img" src="<?=SITE_TEMPLATE_PATH?>/img/ipo/absolute-bank.png" alt="Абсолют банк АКБ"></div>
                            <div class="ipo-licence">
                                <div>Абсолют банк АКБ (ЗАО)</div><span class="sub-text">Лицензия № 1481 от 11.08.2015</span>
                            </div>
                            <div class="ipo-info">
                                <div class="ipo-info__col" data-title="Ежемесячный платёж, р.">49 982</div>
                                <div class="ipo-info__col" data-title="Срок">до 30 лет</div>
                                <div class="ipo-info__col" data-title="Ставка">6%</div>
                            </div>
                        </div>
                    </div>
                    <!-- /.ipo-table-->
                </div>
                <!-- /.ipo-->
                <div class="ipo-more">
                    <button class="btn btn--transp" type="button"><img class="svg btn__ic ic-arrow ic-arrow--down" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-arrow.svg" alt="link" width="20" height="20">Показать ещё</button>
                </div>
            </div>
        </div>
        <div class="cta">
            <div class="container">
                <div class="cta__inner">
                    <div class="h2 cta__title">Вопрос по ипотеке?<br> Мы ответим!</div>
                    <div class="cta__form cta-form">
                        <form action="#">
                            <div class="cta-form__row f-row">
                                <div class="cols col-1-3">
                                    <input class="input" type="text" name="name" placeholder="Ваше имя" reqiured>
                                </div>
                                <div class="cols col-1-3">
                                    <input class="input" type="tel" name="tel" placeholder="Номер телефона" reqiured>
                                </div>
                                <div class="cols col-1-3">
                                    <button class="btn btn--cta" type="submit"> <img class="svg btn__ic ic-tel" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-tel.svg" alt="phone" width="12" height="20">Позвоните мне</button>
                                </div>
                            </div>
                            <p class="privacy">Отправляя форму, вы подтверждаете своё согласие на <a href="confidence.html" target="_blank">обработку персональных данных</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php if($res->arResult): $i = 0;?>
            <?php while($ob = $res->GetNextElement()): $progressGallery[$i]['standartProps'] = $ob->GetFields(); $progressGallery[$i]['userProps'] = $ob->GetProperties(); $i++;?>
            <?php endwhile;?>
        <?php endif; ?>
        <?php if ($progressGallery) : ?>
            <div class="gallery project-build section-margin scrollspy-item" id="p-8">

                <script>
                    localStorage.setItem('sectionId', '<?=$SectionInfo['ID']?>');
                </script>
                <div class="container">
                    <h2 class="h1 title">Ход строительства</h2>
                    <div class="gallery-btns project-build__top">
                        <div class="gallery-selects">
                            <?php
                                $dateArr = []; // создаем массив дат
                                $j = 0;
                                foreach ($progressGallery as $index => $item) {
                                    $year = $item['userProps']['UF_GALLERY_YEAR']['VALUE'];
                                    $month = $item['userProps']['UF_GALLERY_MONTH']['VALUE'];

                                    if (array_key_exists($year, $dateArr)) {
                                        if (!array_key_exists($month, $dateArr[$year])) {

                                            switch ($month) {
                                                case 'Январь' : $dateArr[$year][1] = $month;break;
                                                case 'Февраль' : $dateArr[$year][2] = $month;break;
                                                case 'Март' : $dateArr[$year][3] = $month;break;
                                                case 'Апрель' : $dateArr[$year][4] = $month;break;
                                                case 'Май' : $dateArr[$year][5] = $month;break;
                                                case 'Июнь' : $dateArr[$year][6] = $month;break;
                                                case 'Июль' : $dateArr[$year][7] = $month;break;
                                                case 'Август' : $dateArr[$year][8] = $month;break;
                                                case 'Сентябрь' : $dateArr[$year][9] = $month;break;
                                                case 'Октябрь' : $dateArr[$year][10] = $month;break;
                                                case 'Ноябрь' : $dateArr[$year][11] = $month;break;
                                                case 'Декабрь' : $dateArr[$year][12] = $month;break;
                                            }
                                            //$dateArr[$year][] = $month;
                                        }
                                    } else {
                                        switch ($month) {
                                            case 'Январь' : $dateArr[$year][1] = $month;break;
                                            case 'Февраль' : $dateArr[$year][2] = $month;break;
                                            case 'Март' : $dateArr[$year][3] = $month;break;
                                            case 'Апрель' : $dateArr[$year][4] = $month;break;
                                            case 'Май' : $dateArr[$year][5] = $month;break;
                                            case 'Июнь' : $dateArr[$year][6] = $month;break;
                                            case 'Июль' : $dateArr[$year][7] = $month;break;
                                            case 'Август' : $dateArr[$year][8] = $month;break;
                                            case 'Сентябрь' : $dateArr[$year][9] = $month;break;
                                            case 'Октябрь' : $dateArr[$year][10] = $month;break;
                                            case 'Ноябрь' : $dateArr[$year][11] = $month;break;
                                            case 'Декабрь' : $dateArr[$year][12] = $month;break;
                                        }
                                        // $dateArr[$year][] = $month;
                                    }
                                }
                            $years = array_keys($dateArr); // получаем массив лет
                            ?>

                            <select class="ui-select" name="monthSelection" id="monthSelection" data-placeholder="Январь">
                                <?php foreach ($dateArr as $year => $monthArr) {
                                    foreach ($monthArr as $month){
                                        ?>
                                        <option value="<?=$month;?>" data-year="<?=$year?>" data-type="month"><?=$month;?></option>
                                        <?
                                    }
                                } ?>
                            </select>
                            <select class="ui-select" name="yearSelection" id="yearSelection" data-placeholder="<?=$years[0]; // по дефолту выводим первый год?>">
                                <?php foreach ($dateArr as $year => $month) {
                                    ?>
                                    <option value="<?=$year;?>" data-type="year"><?=$year;?></option>
                                    <?
                                } ?>
                            </select>
                        </div>
                        <a class="btn btn--transp" href="#">
                            <img class="svg svg-stroke btn__ic" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-circles.svg" width="20" height="20" alt="alt">Онлайн камера 1
                        </a>
                        <a class="btn btn--transp" href="#">
                            <img class="svg svg-stroke btn__ic" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-circles.svg" width="20" height="20" alt="alt">Онлайн камера 2
                        </a>
                        <a class="btn btn--transp" href="#">
                            <img class="svg svg-stroke btn__ic" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-circles.svg" width="20" height="20" alt="alt">Онлайн камера 3
                        </a>
                    </div>
                    <div data-entity="container-1">
                        <div class="gallery-slider-xl" id="gallery-2">
                            <?php foreach($progressGallery[0]['userProps']['UF_GALLERY']['VALUE'] as $galleryItem) : ?>
                                <div class="slide">
                                    <img class="img" src="<?=CFile::GetPath($galleryItem);?>" alt="alt">
                                    <button class="ui-btn zoom-link" href="<?=CFile::GetPath($galleryItem);?>" data-fancybox="gallery2">
                                        <img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-zoom.svg" width="15" height="15" alt="zoom">
                                    </button>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <!-- /.gallery-slider-xl-->
                        <div class="gallery-slider-sm" id="gallery-2-thumbs">
                            <?php foreach($progressGallery[0]['userProps']['UF_GALLERY']['VALUE'] as $galleryItem) : ?>
                                <div class="slide">
                                    <img class="img" src="<?=CFile::GetPath($galleryItem);?>" alt="alt">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <!-- /.gallery-slider-sm-->
                    <div class="gallery-btns project-build__bottom"><a class="btn btn--transp" href="#"> <img class="svg svg-stroke btn__ic" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-circles.svg" width="20" height="20" alt="alt">Онлайн камера 1</a><a class="btn btn--transp" href="#"> <img class="svg svg-stroke btn__ic" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-circles.svg" width="20" height="20" alt="alt">Онлайн камера 2</a><a class="btn btn--transp" href="#"> <img class="svg svg-stroke btn__ic" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-circles.svg" width="20" height="20" alt="alt">Онлайн камера 3</a></div>
                </div>
            </div>
        <?php endif; ?>
        <div class="project-contacts section-margin scrollspy-item" id="p-9">
            <div class="container">
                <h1 class="title title-margin">Контакты офиса продаж</h1>
                <div class="contact">
                    <div class="contact__map">
                        <div class="map" id="map1" style="background: url('<?=SITE_TEMPLATE_PATH?>/img/img-map.jpg') no-repeat 50% 50% / cover"><span class="demo-marker"></span></div>
                    </div>
                    <div class="contact__content">
                        <div class="contact__title h2">Центральный офис продаж</div>
                        <div class="contact__metro">
                            <div class="p-metro flex">
                                <div class="p-metro__branch" style="border-color: #33B7FB;"></div><span>Московская</span>
                            </div>
                            <div class="p-metro flex">
                                <div class="p-metro__branch" style="border-color: #9E33FB;"></div><span>Чкаловская</span>
                            </div>
                        </div>
                        <div class="contact__data">
                            <div class="data">
                                <div class="data-label sub-text">Адрес:</div>
                                <div class="data-value">Большой пр. ПС, д. 48, офис 1</div>
                            </div>
                            <div class="data data-col">
                                <div class="data-label sub-text">Время работы:</div>
                                <div class="data-value">Ежедневно с 9:00 до 21:00</div>
                            </div>
                            <div class="data data-col">
                                <div class="data-label sub-text">Телефон:</div>
                                <div class="data-value"><a href="tel:+74951064607">+7 (495) 106-4607</a></div>
                            </div>
                            <div class="data">
                                <div class="data-label sub-text">Как добраться:</div>
                                <div class="data-value">Двигаясь по Садовому кольцу в сторону Нижней Краснохолмской улицы, съезд направо на Космодамианскую набережную. Через 900 м съезд налево. Далее прямо 670м. Комплекс будет слева. Двигаясь по Садовому кольцу в сторону Нижней Краснохолмской улицы.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="project-docs section-margin scrollspy-item" id="p-10">
            <div class="container">
                <h2 class="h1 title">Документация по объекту</h2>
                <div class="project-docs__block">
                    <p>В данном разделе находится вся документация по проекту, среди которой: разрешение на строительство, проектная декларация, проект договора ДДУ, документы на земельный участок пр.</p><a class="btn btn--transp" href="docs.html"><img class="svg svg-stroke btn__ic" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-doc.svg" width="15" height="18" alt="">К документам</a>
                </div>
            </div>
        </div>
        <div class="cta">
            <div class="container">
                <div class="cta__inner">
                    <div class="h2 cta__title">Остались вопросы?<br> Мы ответим!</div>
                    <div class="cta__form cta-form">
                        <form action="#">
                            <div class="cta-form__row f-row">
                                <div class="cols col-1-3">
                                    <input class="input" type="text" name="name" placeholder="Ваше имя" reqiured>
                                </div>
                                <div class="cols col-1-3">
                                    <input class="input" type="tel" name="tel" placeholder="Номер телефона" reqiured>
                                </div>
                                <div class="cols col-1-3">
                                    <button class="btn btn--cta" type="submit"> <img class="svg btn__ic ic-tel" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-tel.svg" alt="phone" width="12" height="20">Позвоните мне</button>
                                </div>
                            </div>
                            <p class="privacy">Отправляя форму, вы подтверждаете своё согласие на <a href="confidence.html" target="_blank">обработку персональных данных</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container section-margin">
            <h2 class="h1 title">Другие объекты</h2>
            <div class="quarter-list view-2 other-objects">
                <div class="f-row project-other">
                    <div class="cols col-1-2">
                        <div class="quarter">
                            <div class="quarter__img-wrap"><img class="quarter__img" src="<?=SITE_TEMPLATE_PATH?>/img/img-quarter.jpg" alt="alt">
                                <div class="quarter__overlay"><img class="img" src="<?=SITE_TEMPLATE_PATH?>/img/quarter-name.svg" width="277" height="70" alt="alt"></div>
                            </div>
                            <div class="quarter__content">
                                <div class="quarter__title">UP-квартал Комендантский </div>
                                <div class="quarter__transport flex">
                                    <div class="p-metro flex">
                                        <div class="p-metro__branch" style="border-color: #33B7FB;"></div><span>Московская</span>
                                    </div>
                                </div><a class="btn btn--transp" href="#"><img class="svg btn__ic ic-arrow" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-arrow.svg" alt="link" width="20" height="20">Посмотреть</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.quarter-->
                    <div class="cols col-1-2">
                        <div class="quarter">
                            <div class="quarter__img-wrap"><img class="quarter__img" src="<?=SITE_TEMPLATE_PATH?>/img/img-quarter.jpg" alt="alt">
                                <div class="quarter__overlay"><img class="img" src="<?=SITE_TEMPLATE_PATH?>/img/quarter-name.svg" width="277" height="70" alt="alt"></div>
                            </div>
                            <div class="quarter__content">
                                <div class="quarter__title">UP-квартал Комендантский </div>
                                <div class="quarter__transport flex">
                                    <div class="p-metro flex">
                                        <div class="p-metro__branch" style="border-color: #33B7FB;"></div><span>Московская</span>
                                    </div>
                                </div><a class="btn btn--transp" href="#"><img class="svg btn__ic ic-arrow" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-arrow.svg" alt="link" width="20" height="20">Посмотреть</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.quarter-->
                    <div class="cols col-1-2">
                        <div class="quarter">
                            <div class="quarter__img-wrap"><img class="quarter__img" src="<?=SITE_TEMPLATE_PATH?>/img/img-quarter.jpg" alt="alt">
                                <div class="quarter__overlay"><img class="img" src="<?=SITE_TEMPLATE_PATH?>/img/quarter-name.svg" width="277" height="70" alt="alt"></div>
                            </div>
                            <div class="quarter__content">
                                <div class="quarter__title">UP-квартал Комендантский </div>
                                <div class="quarter__transport flex">
                                    <div class="p-metro flex">
                                        <div class="p-metro__branch" style="border-color: #33B7FB;"></div><span>Московская</span>
                                    </div>
                                </div><a class="btn btn--transp" href="#"><img class="svg btn__ic ic-arrow" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-arrow.svg" alt="link" width="20" height="20">Посмотреть</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.quarter-->
                    <div class="cols col-1-2">
                        <div class="quarter">
                            <div class="quarter__img-wrap"><img class="quarter__img" src="<?=SITE_TEMPLATE_PATH?>/img/img-quarter.jpg" alt="alt">
                                <div class="quarter__overlay"><img class="img" src="<?=SITE_TEMPLATE_PATH?>/img/quarter-name.svg" width="277" height="70" alt="alt"></div>
                            </div>
                            <div class="quarter__content">
                                <div class="quarter__title">UP-квартал Комендантский </div>
                                <div class="quarter__transport flex">
                                    <div class="p-metro flex">
                                        <div class="p-metro__branch" style="border-color: #33B7FB;"></div><span>Московская</span>
                                    </div>
                                </div><a class="btn btn--transp" href="#"><img class="svg btn__ic ic-arrow" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-arrow.svg" alt="link" width="20" height="20">Посмотреть</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.quarter-->
                </div>
            </div>
            <!-- /.quarter-list 2-->
        </div>
        <div class="container section-margin">
            <div class="content">
                <p class="sub-color mb-0">ГК ФСК работает не только в Москве и Московской области, но также в Санкт-Петербурге и Ленинградской области, Калужской области и Краснодарском крае. В структуру холдинга входят собственные производственные мощности, генподрядные организации, технический заказчик, агентство недвижимости, сервисные службы. Компания, основанная в 2005 году, зарекомендовала себя надежным партнером, который всегда выполняет обязательства. Вертикально интегрированная структура ФСК позволяет в короткие сроки своими силами проектировать и строить объекты любого уровня сложности, используя преимущественно собственное финансирование. Именно поэтому бизнес компании очень устойчив, а кредитная нагрузка минимальна. В 2016 году в структуру холдинга вошел ДСК-1 – крупнейшее предприятие по производству панельных домов с полувековой историей. В результате этой сделки компания вышла на новый для нее рынок индустриального домостроения, а также укрепила свои позиции и расширила ассортимент в сегментах стандарт и комфорт.</p>
            </div>
        </div>
    </div>
    <?include($_SERVER['DOCUMENT_ROOT']."$templateFolder/include/section/modal.php")?>
<?

/*
$this->setFrameMode(true);
$this->addExternalCss("/bitrix/css/main/bootstrap.css");

if (!isset($arParams['FILTER_VIEW_MODE']) || (string)$arParams['FILTER_VIEW_MODE'] == '')
	$arParams['FILTER_VIEW_MODE'] = 'VERTICAL';
$arParams['USE_FILTER'] = (isset($arParams['USE_FILTER']) && $arParams['USE_FILTER'] == 'Y' ? 'Y' : 'N');

$isVerticalFilter = ('Y' == $arParams['USE_FILTER'] && $arParams["FILTER_VIEW_MODE"] == "VERTICAL");
$isSidebar = ($arParams["SIDEBAR_SECTION_SHOW"] == "Y" && isset($arParams["SIDEBAR_PATH"]) && !empty($arParams["SIDEBAR_PATH"]));
$isFilter = ($arParams['USE_FILTER'] == 'Y');

if ($isFilter)
{
	$arFilter = array(
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ACTIVE" => "Y",
		"GLOBAL_ACTIVE" => "Y",
	);
	if (0 < intval($arResult["VARIABLES"]["SECTION_ID"]))
		$arFilter["ID"] = $arResult["VARIABLES"]["SECTION_ID"];
	elseif ('' != $arResult["VARIABLES"]["SECTION_CODE"])
		$arFilter["=CODE"] = $arResult["VARIABLES"]["SECTION_CODE"];

	$obCache = new CPHPCache();
	if ($obCache->InitCache(36000, serialize($arFilter), "/iblock/catalog"))
	{
		$arCurSection = $obCache->GetVars();
	}
	elseif ($obCache->StartDataCache())
	{
		$arCurSection = array();
		if (Loader::includeModule("iblock"))
		{
			$dbRes = CIBlockSection::GetList(array(), $arFilter, false, array("ID"));

			if(defined("BX_COMP_MANAGED_CACHE"))
			{
				global $CACHE_MANAGER;
				$CACHE_MANAGER->StartTagCache("/iblock/catalog");

				if ($arCurSection = $dbRes->Fetch())
					$CACHE_MANAGER->RegisterTag("iblock_id_".$arParams["IBLOCK_ID"]);

				$CACHE_MANAGER->EndTagCache();
			}
			else
			{
				if(!$arCurSection = $dbRes->Fetch())
					$arCurSection = array();
			}
		}
		$obCache->EndDataCache($arCurSection);
	}
	if (!isset($arCurSection))
		$arCurSection = array();
}
?>
<div class="row">
<?
if ($isVerticalFilter)
	include($_SERVER["DOCUMENT_ROOT"]."/".$this->GetFolder()."/section_vertical.php");
else
	include($_SERVER["DOCUMENT_ROOT"]."/".$this->GetFolder()."/section_horizontal.php");
?>
</div>
*/
