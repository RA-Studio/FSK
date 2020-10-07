<?
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
$siteLink = 'https://fsknw.ru';
$assetsLink = 'https://fsknw.ru/'.SITE_TEMPLATE_PATH;
?>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">
    <link rel="manifest" href="img/favicon/site.webmanifest">
    <link rel="mask-icon" href="img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="img/favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="img/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <title>FSK - PDF</title>
    <!-- Стили-->
    <link rel="stylesheet" href="<?=$assetsLink?>/css/styles.css">
</head>
<body>
<?
if($_GET['ID']) {
    if (CModule::IncludeModule("catalog") && CModule::IncludeModule("iblock")) {

    }
    $arResult = [];
    $arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_*", "IBLOCK_SECTION_ID");//IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
    $arFilter = Array("IBLOCK_ID" => 1, "ID" => $_GET['ID'], "ACTIVE" => "Y");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arProps = $ob->GetProperties();
        foreach ($arProps as $key => $value) {
            $arProps[$key] = $arProps[$key]['VALUE'];
        }
        $arResult = $arFields;
        $arResult['PROPERTIES'] = $arProps;
    }

    $resSection = CIBlockSection::GetNavChain(false, $arResult['IBLOCK_SECTION_ID']);
    while ($arSection = $resSection->GetNext()) {
        $array_sections[] = $arSection;
    }

    $SectionInfo = array();
    if ($array_sections[0]["CODE"]) {
        $SectionsRes = CIBlockSection::GetList(
            Array("SORT" => "ASC"),
            Array("IBLOCK_ID" => 1, "ACTIVE" => "Y", "CODE" => $array_sections[0]["CODE"]),
            false,
            Array("IBLOCK_ID", "ID", "NAME", "UF_SECTION_NAME", "PICTURE")
        );

        if ( $SectionsRes->SelectedRowsCount() ) {
            $SectionInfo = $SectionsRes->GetNext();
        }
    }
    ?>
    <?
    $fullProps = []; // массив со всеми данными ЖК
    CModule::IncludeModule('iblock');
    $arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_*");
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
            $features[] = $arItem;
        }
    }
}
?>
<div class="print">
    <div class="container" style="width:1354px; max-width: none">
        <div class="print-pdf">
            <div class="print-hero"><img class="img print-hero__img" src="<?=$siteLink?><?=(CFile::GetPath($array_sections[0]['PICTURE'])) ? CFile::GetPath($array_sections[0]['PICTURE']) : "";?>" alt="alt">
                <div class="print-center">
                    <div class="print-header">
                        <h1 class="h1 p-hero__title"><?=$array_sections[0]['~NAME']?></h1><img class="img print-header__el" src="<?=$assetsLink?>/img/print-hero-el.png" alt="alt">
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
                        }
                        ?>
                        <?if($userProps['UF_METRO']['VALUE']):?>
                            <div class="print-data flex">

                                <div class="p-metro flex">
                                    <div class="p-metro__branch" style="    border-color: <?=$metro[0]['UF_COLOR'];?>;"></div><span><?=$metro[0]['UF_NAME'];?></span>
                                </div>
                                <? if ($userProps['UF_WALK_TIME']['VALUE']) :?>
                                    <div class="p-distance flex"><img class="img" src="<?=$assetsLink?>/img/icons/ic-walk-dist.svg" width="8" height="13" alt="alt"><span><?=$userProps['UF_WALK_TIME']['VALUE']?></span></div>
                                <?endif;?>
                            </div>
                        <?endif?>
                        <?if ($userProps['UF_DISCOUNT_TEXT']['VALUE']):?>
                            <div class="p-discount flex">
                                <div class="p-discount__ic">%</div>
                                <p class="p-discount__txt"><?=$userProps['UF_DISCOUNT_TEXT']['VALUE']?></p>
                            </div>
                        <?endif?>
                    </div>
                </div>
            </div>
            <div class="print-center" style="width: 1050px; max-width: none;">
                <div class="content">
                    <div class="content-margin">
                        <h2 class="h1 title">О проекте</h2>
                        <?=$userProps['UF_PROJECT_NAME']['~VALUE']['TEXT'];?>
                    </div>
                    <?
                    $roomName = "Лот";
                    switch($arResult['PROPERTIES']['rooms']) {
                        case "0":
                            $roomName = "Квартира студия";
                            break;
                        case "1":
                            if($arResult['PROPERTIES']['category'] == "commercial") {
                                $roomName = "Лот";
                            } else {
                                $roomName = "Однокомнатная квартира";
                            }

                            break;
                        case "2":
                            $roomName = "Двухкомнатная квартира";
                            break;
                        case "3":
                            $roomName = "Трехкомнатная квартира";
                            break;
                    }

                    ?>
                    <div class="content-margin">
                        <?//?>
                        <h2 class="h1 title"><?=$roomName?></h2><!-- Лот -->
                        <div class="f-row print-row">
                            <div class="cols col-1-3">
                                <ul class="card-data__list">
                                    <?if($arResult['PROPERTIES']['area']):?>
                                        <li><span>Общая площадь</span><span><?=$arResult['PROPERTIES']['area']?> м<sup>2</sup></span></li>
                                    <?endif?>
                                    <?if($arResult['PROPERTIES']['livingspace']):?>
                                        <li><span>Жилая площадь</span><span><?=$arResult['PROPERTIES']['livingspace']?> м<sup>2</sup></span></li>
                                    <?endif?>
                                    <?if($arResult['PROPERTIES']['kitchenspace']):?>
                                        <li><span>Площадь кухни</span><span><?=$arResult['PROPERTIES']['kitchenspace']?> м<sup>2</sup></span></li>
                                    <?endif?>
                                    <?if($arResult['PROPERTIES']['floor']):?>
                                        <li><span>Этаж / этажей</span><span><?=$arResult['PROPERTIES']['floor']?>/<?=$arResult['PROPERTIES']['floorstotal']?></span></li>
                                    <?endif?>
                                    <?if($arResult['PROPERTIES']['renovation']):?>
                                        <li><span>Отделка</span><span><?=$arResult['PROPERTIES']['renovation']?></span></li>
                                    <?endif?>
                                </ul>
                            </div>
                            <div class="cols col-1-3">
                                <ul class="card-data__list">
                                    <!--li><span>Корпус</span><span>3.1</span></li>
                                    <li><span>Секция</span><span>2</span></li-->

                                </ul>
                            </div>
                            <div class="cols col-1-3 print-col">
                                <?if($arResult['PROPERTIES']['price']):?>
                                    <p class="print-info">Цена: <span class="dashed-border"><?=$arResult['PROPERTIES']['price']?></span></p>
                                <?endif;?>
                                <?if($arResult['PROPERTIES']['price100']):?>
                                    <p class="print-info accent-color">Цена по акции: <span class="dashed-border"><?=$arResult['PROPERTIES']['price100']?></span></p>
                                <?else:?>
                                    <p class="print-info accent-color">Цена по акции: <span class="dashed-border">по запросу</span></p>
                                <?endif;?>
                                <?if($arResult['PROPERTIES']['lotnumber']):?>
                                    <p class="print-info sub-color">ID квартиры: <span><?=$arResult['PROPERTIES']['lotnumber']?></span></p>
                                <?endif?>
                            </div>
                        </div>
                        <div class="print-table">
                            <?$open = false?>
                            <?foreach($arResult['PROPERTIES']['image'] as $key => $img):
                            if($key == 0) {
                                ?><div class="print-img print-img-1"><img style="max-width: 721px; max-height: 423px;" class="img" src="<?=$siteLink.CFile::GetPath($img);?>" alt="alt"></div><?
                            }
                            if($key > 0) {
                            if(!$open) {
                            $open = true;
                            ?><div><?
                                }
                                ?>
                                <div class="print-img print-img-<?=$key+1?>"><img style="max-width: 240px; max-height: 215px;" class="img" src="<?=$siteLink.CFile::GetPath($img);?>" alt="alt"></div>
                                <?
                                }
                                if ($key === 2) break;
                                endforeach;
                                if($open) {
                                    echo("</div>");
                                }
                                ?>

                                <div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="print-footer">
                        <div class="print-footer__logo"><img class="img" src="<?=$assetsLink?>/img/svg-logo.svg" alt="alt"></div>
                        <div class="print-footer__col">
                            <div class="print-footer__address">
                                <p class="text-bold">Центральный офис продаж:</p>
                                <p>Санкт-Петербург, Большой пр. ПС, д.48, лит.А, 1 этаж</p>
                            </div>
                            <div class="print-data flex">
                                <div class="print-contact">
                                    <div class="print-contact__ic"><img class="img" src="<?=$assetsLink?>/img/icons/ic-mail.svg" width="33" height="17" alt="alt"></div><span>info@fsknw.ru</span>
                                </div>
                                <div class="print-contact">
                                    <div class="print-contact__ic"><img class="img" src="<?=$assetsLink?>/img/icons/ic-tel.svg" width="14" height="23" alt="alt"></div><span>+7 (812) 703-55-55</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <body>
</html>
