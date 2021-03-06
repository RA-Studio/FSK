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


$ParkingInfo=[];
//Получаем тип раздела и основную информацию о разделе
if ($arResult["VARIABLES"]["SECTION_CODE"]) {
    $SectionsRes = CIBlockSection::GetList(
        Array("SORT" => "ASC"),
        Array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ACTIVE" => "Y","IBLOCK_SECTION_ID"=>$SectionInfo['ID'], "CODE" => $typeOfApartment),
        false,
        Array("IBLOCK_ID", "ID", "NAME", "UF_SECTION_NAME", "PICTURE","UF_APART","UF_PHOTO")
    );

    if ( $SectionsRes->SelectedRowsCount() ) {
        $ParkingInfo = $SectionsRes->GetNext();
    }
}
$fullProps = []; // массив со всеми данными ЖК
CModule::IncludeModule('iblock');
$arSelect = Array("ID", "IBLOCK_ID", "NAME","DATE_CREATE","TIMESTAMP_X", "PROPERTY_*");
$arFilter = Array("IBLOCK_ID"=>5, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "ID"=>$ParkingInfo["UF_SECTION_NAME"]);
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

/*желтая полоска вверху*/
$text = '';
if (!empty($userProps['UF_YELLOW_LINK']['VALUE'])) {
    $text .= '<a href="'. $userProps['UF_YELLOW_LINK']['VALUE'] .'" class="reserve-info">';
}
else{
    $text .= '<div class="reserve-info">';
}
if (!empty($userProps['UF_YELLOW_SVG']['VALUE'])) {
    $text .= '<img src="' . CFile::GetPAth($userProps['UF_YELLOW_SVG']['VALUE']) . '">';
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


?>
<div class="page page-project<?=" $typeOfApartment"?>">
    <div class="p-hero project-hero" style="background-image: url('<?=!empty($ParkingInfo['UF_PHOTO'])? CFile::GetPath($ParkingInfo['UF_PHOTO']):CFile::GetPath($ParkingInfo['PICTURE']) ;?>')">
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
    <div class="container section-margin scrollspy-item container__relative" id="p-6">
        <h2 class="h1 title" id="filter-anchor">Выбор кладовых</h2>
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
	                <?/*
	                    <div class="interactive-btns">
	                        <a class="interactive-btn interactive-download" href="javascript:void(0);" title="Скачать" data-event="loadPDF"></a>
	                        <a class="interactive-btn interactive-print" href="print.html" target="_blank" title="Распечатать"></a>
	                        <div class="interactive-btn interactive-favorite" data-role="favorite">
	                            <svg xmlns="http://www.w3.org/2000/svg" width="22.712" height="21.673" viewBox="0 0 22.712 21.673"><path d="M10.606,0l3.277,6.64,7.329,1.071-5.3,5.165,1.252,7.3-6.555-3.447L4.052,20.173l1.252-7.3L0,7.711,7.329,6.64,10.606,0Z" transform="translate(0.75 0.75)" fill="none" stroke="#e94200" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/></svg>
	                        </div>
	                    </div>
	                */?>
	            </div>
	            <?/*
	                <div class="results-onlinebuy">

	                    <?if (CSite::InDir('/newbuild/zoom_apart/')) {?>
	                        <div class="results-onlinebuy__title">Купите апартаменты, не выходя из дома!</div>
	                        <div class="results-onlinebuy__text"><?=$userProps['UF_YELLOW_STRIP']['~DESCRIPTION']?></div>

	                    <?} else {?>
	                        <div class="results-onlinebuy__title">Ипотека со ставкой 0.01%</div>
	                        <div class="results-onlinebuy__text">Нулевая ставка: успейте забронировать!</div>
	                    <?}?>

	                </div>
	            */?>
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
	                        <img class="img" alt="plan" style="max-height: 100%;">
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
                                  <a href="#modal-FORM3" data-type="reserved" data-id="" data-iblock="1" class="btn btn--cta popup-btn-FORM3" type="button">
                                    <svg class="svg btn__ic ic-tel" width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M7.5 10L7.5 12.6654" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                      <path d="M9.91016 13L4.82144 13" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                      <rect x="0.75" y="0.75" width="13.5" height="8.5" rx="1.25" stroke="white" stroke-width="1.5"/>
                                    </svg>
                                    Забронировать
                                  </a>
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
		<?global $USER;
		if($USER->IsAdmin()){?>
			<style>
				.storeroom-banner{
					height: 130px;
					margin-top: 50px;
					margin-bottom: 40px;
					display: -webkit-flex;
					display: -moz-flex;
					display: -ms-flex;
					display: -o-flex;
					display: flex;
					-webkit-flex-direction: column;
					-moz-flex-direction: column;
					-ms-flex-direction: column;
					-o-flex-direction: column;
					flex-direction: column;
					justify-content: center;
					-ms-align-items: flex-start;
					align-items: flex-start;
					padding-left: 33px;
					background: url(/local/templates/fsk/img/storeroom-banner.png) center/cover no-repeat;
					border: 1px solid #E5E5E5;
				}
				.storeroom-banner__title{
					margin-bottom: 6px;
					font-size: 25px;
					line-height: 30px;
				}
				.storeroom-banner__text{
					display: -webkit-flex;
					display: -moz-flex;
					display: -ms-flex;
					display: -o-flex;
					display: flex;
					-ms-align-items: center;
					align-items: center;
					font-size: 16px;
					line-height: 19px;
					color: #BEBEBE;
				}
				.storeroom-banner__text svg{
					margin-left: 6px;
				}
	        </style>
			<a class="storeroom-banner" href="#">
	            <div class="storeroom-banner__title">Кладовые помещения</div>
	            <div class="storeroom-banner__text">
	            	Выбирайте и бронируйте online
	            	<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M9 14L12.1579 10L9 6" stroke="#E94200" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
						<circle cx="10" cy="10" r="9.25" transform="rotate(-90 10 10)" stroke="#E94200" stroke-width="1.5"/>
					</svg>
	            </div>
	         </a>
	    <?}?>

      <div class="results-refresh">
        <div class="results-refresh__wrapper">
          <div class="results-refresh__item">
            <svg class="svg btn__ic" style="width: 14px;height: 14px" xmlns="http://www.w3.org/2000/svg" width="12.662" height="13.637" viewBox="0 0 12.662 13.637"><g transform="translate(-17.067)"><g transform="translate(17.067)"><g transform="translate(0)"><path d="M28.268,0a.487.487,0,0,0-.487.487V2.266A6.319,6.319,0,0,0,17.067,6.818a.487.487,0,1,0,.974,0A5.357,5.357,0,0,1,27.35,3.2l-2.158.719a.488.488,0,1,0,.308.925l2.922-.974a.487.487,0,0,0,.333-.464V.487A.487.487,0,0,0,28.268,0Z" transform="translate(-17.067)" fill="#e94200"/></g></g><g transform="translate(18.041 6.331)"><g transform="translate(0)"><path d="M62.4,221.867a.487.487,0,0,0-.487.487A5.357,5.357,0,0,1,52.6,225.97l2.158-.719a.488.488,0,1,0-.308-.925l-2.922.974a.487.487,0,0,0-.333.464v2.922a.487.487,0,0,0,.974,0v-1.779a6.319,6.319,0,0,0,10.715-4.552A.487.487,0,0,0,62.4,221.867Z" transform="translate(-51.198 -221.867)" fill="#e94200"/></g></g></g></svg>
            Информация обновлена
            <span>&nbsp;<?=CIBlockFormatProperties::DateFormat("j.m.Y", strtotime($timeUpdate));?></span>.
          </div>
          <div class="results-refresh__item">
            <svg width="11" height="15" viewBox="0 0 11 15" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M9.59814 5.61456H8.90706V3.90591C8.90706 1.75219 7.15487 0 5.00118 0C2.84742 0 1.09516 1.75219 1.09516 3.90591V5.61456H0.404088C0.180884 5.61456 0 5.79545 0 6.01862V13.5973C0 13.8205 0.180884 14.0014 0.404088 14.0014H9.59817C9.82131 14.0014 10.0022 13.8205 10.0022 13.5973V6.01862C10.0022 5.79545 9.82127 5.61456 9.59814 5.61456ZM5.63113 10.2271V11.8405C5.63113 11.9814 5.51689 12.0957 5.37593 12.0957H4.62622C4.4853 12.0957 4.37103 11.9814 4.37103 11.8405V10.2271C4.09225 10.0294 3.91019 9.70445 3.91019 9.33673C3.91019 8.73433 4.39858 8.24588 5.00108 8.24588C5.60351 8.24588 6.0919 8.73433 6.0919 9.33673C6.09194 9.70445 5.90987 10.0294 5.63113 10.2271ZM7.04221 5.61456H2.96002V3.90591C2.96002 2.78044 3.87567 1.86485 5.00118 1.86485C6.12662 1.86485 7.04221 2.78044 7.04221 3.90591V5.61456Z" fill="#BEBEBE"></path>
            </svg>
            Предварительная бронь
          </div>
        </div>
      </div>
        <div class="results-more">
            <button class="btn btn--transp" type="button">
                <svg class="svg btn__ic ic-arrow ic-arrow--down" style="width: 20px;height: 20px" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><g transform="translate(0 20) rotate(-90)"><g transform="translate(20) rotate(90)" fill="none"><path d="M10,0A10,10,0,1,1,0,10,10,10,0,0,1,10,0Z" stroke="none"/><path d="M 10.00000095367432 1.500001907348633 C 5.313080787658691 1.500001907348633 1.500001907348633 5.313080787658691 1.500001907348633 10.00000095367432 C 1.500001907348633 14.68692111968994 5.313080787658691 18.5 10.00000095367432 18.5 C 14.68692111968994 18.5 18.5 14.68692111968994 18.5 10.00000095367432 C 18.5 5.313080787658691 14.68692111968994 1.500001907348633 10.00000095367432 1.500001907348633 M 10.00000095367432 1.9073486328125e-06 C 15.52285099029541 1.9073486328125e-06 20 4.477150917053223 20 10.00000095367432 C 20 15.52285099029541 15.52285099029541 20 10.00000095367432 20 C 4.477150917053223 20 1.9073486328125e-06 15.52285099029541 1.9073486328125e-06 10.00000095367432 C 1.9073486328125e-06 4.477150917053223 4.477150917053223 1.9073486328125e-06 10.00000095367432 1.9073486328125e-06 Z" stroke="none"/></g><g transform="translate(7.236 5.719)"><g transform="translate(5.504 5.4) rotate(90)"><g transform="translate(0 5.504) rotate(-90)"><path d="M0,0,2.752,2.752,5.5,0" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/></g></g><line y2="7.826" transform="translate(2.739)" fill="none" stroke-linecap="round" stroke-width="1.5"/></g></g></svg>
                Показать ещё
            </button>
        </div>
    </div>
</div>

<?include($_SERVER['DOCUMENT_ROOT']."$templateFolder/include/section/storeroomModal.php")?>
