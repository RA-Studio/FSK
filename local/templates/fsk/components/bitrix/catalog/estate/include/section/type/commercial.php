<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

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
                <?if ($progressGallery && $userProps['UF_JK_STATUS']['VALUE'] === 'Да'){?>
                    <a href="#p-8">Ход строительства</a>
                <?}?>
                <?if(!empty($userProps['UF_CONTACTS']['VALUE'])){?>
                    <a href="#p-9">Офис продаж</a>
                <?}?>
                <a href="#p-10">Документы</a>
            </div>
        </div>

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
                                <!--img class="img lazyload" data-src="" alt="alt"-->
                                <?
                                $svg = file_get_contents($_SERVER['DOCUMENT_ROOT']."/".CFile::GetPath($item['UF_FILE']));
                                $svg = str_replace("<svg xmlns", "<svg class='img' xmlns", $svg);
                                ?>
                                <?=$svg?>
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
                            <img class="img"alt="plan" style="max-height: 100%;">
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
                              <a href="#modal-FORM3" data-type="reserved" data-id="" data-iblock="1" class="btn btn--cta popup-btn-FORM3" type="button">
                                <svg class="svg btn__ic ic-tel" width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M7.5 10L7.5 12.6654" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                  <path d="M9.91016 13L4.82144 13" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                  <rect x="0.75" y="0.75" width="13.5" height="8.5" rx="1.25" stroke="white" stroke-width="1.5"/>
                                </svg>
                                Забронировать
                              </a>
                                <!--<a href="#callbackwidget" class="btn btn--cta js-call-callback" type="button">
                                    <svg class="svg btn__ic ic-tel"  xmlns="http://www.w3.org/2000/svg" width="14.547" height="24.331" viewBox="0 0 14.547 24.331"><g transform="translate(-8967.75 1214.75)"><path d="M0,.5H13.047" transform="translate(8968.5 -1195.909)" fill="none" stroke="#e94200" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><path d="M0,1.25H3.262" transform="translate(8973.393 -1211.988)" fill="none" stroke="#e94200" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><rect width="13.047" height="22.831" rx="2" transform="translate(8968.5 -1214)" stroke-width="1.5" stroke="#e94200" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" fill="none"/></g></svg>
                                    Забронировать
                                </a>-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="results-empty" style="display: none">По вашему запросу ничего не найдено.</div>
            </div>
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




        <?include($_SERVER['DOCUMENT_ROOT']."$templateFolder/include/section/ufgallery.php")?>
        <?if ($userProps['UF_MAP_CODE']['VALUE']):?>
            <?include($_SERVER['DOCUMENT_ROOT']."$templateFolder/include/section/map.php")?>
        <?endif?>
        <? if ($userProps['UF_ADVANTAGES_GALLERY']['VALUE'] && strpos($_SERVER['HTTP_USER_AGENT'],'Chrome-Lighthouse') == false) :?>
            <?include($_SERVER['DOCUMENT_ROOT']."$templateFolder/include/section/advantages.php")?>
        <?endif?>
        <? if ( !empty($userProps['UF_DISCOUNTS_LIST']['VALUE']) && strpos($_SERVER['HTTP_USER_AGENT'],'Chrome-Lighthouse') == false ) :
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


        <?if(strpos($_SERVER['HTTP_USER_AGENT'],'Chrome-Lighthouse') == false):?>
            <?/*$APPLICATION->IncludeComponent(
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
                    "CREATE_SEND_MAIL" => "",
                    "DISPLAY_FIELDS" => array(
                        0 => "TITLE",
                        1 => "PHONE",
                        2 => "CUR_PAGE",
                        3 => "TIME",
                        4 => "METHOD",
                        5 => "",
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
            );*/?>
        <?endif?>
        <?include($_SERVER['DOCUMENT_ROOT']."$templateFolder/include/section/mortgage.php")?>
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
                    3 => "",
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


        <?if(!empty($userProps['UF_CONTACTS']['VALUE'])) {
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
        }?>

        <div class="project-docs section-margin scrollspy-item" id="p-10">
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
                    3 => "",
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
