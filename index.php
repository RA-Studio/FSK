<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetPageProperty("description", "Группа компаний ФСК - одна из крупнейших строительных компаний России. По версии делового журнала Forbes, входит в топ-10 самых надежных застройщиков страны.");
$APPLICATION->SetPageProperty("TITLE", "Строительная компания ФСК");
$APPLICATION->SetTitle("Главная");
$typeOfApartment = "flat";
if(CSite::InDir('/commercial/')) {
    $typeOfApartment = "commercial";
}
?>
<div class="page page-main">
	<div class="main-hero">
		<div class="container">
			<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"slider_main_top", 
	array(
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
		"CACHE_TYPE" => "N",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "DETAIL_PICTURE",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "2",
		"IBLOCK_TYPE" => "Sliders",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "10",
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
		"PROPERTY_CODE" => array(
			0 => "UF_SLIDER_TITLE",
			1 => "UF_SLIDER_URL",
			2 => "UF_PHOTO",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "ACTIVE_FROM",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "DESC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "slider_main_top"
	),
	false
);?>
		</div>
	</div>
	<!-- /.main-hero-->
    <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"advantages", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BLOCK_DESCRIPTION" => "",
		"BLOCK_TITLE" => "ГК ФСК в цифрах",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "advantages",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_LIKE_BLOCK" => "Y",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILE_404" => "",
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "8",
		"IBLOCK_TYPE" => "content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "200",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "951",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "UF_PREVIEW",
			2 => "",
		),
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
	),
	false
);?>
    <?
    $arResultCart = [];
    $cartStaticInfo = [];
    $build = [];
    $arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_*", "TIMESTAMP_X", "IBLOCK_SECTION_ID");
    $arFilter = Array(
        "IBLOCK_ID" => 1,
        "ACTIVE"=>"Y",
        "INCLUDE_SUBSECTIONS" => "Y",
        "PROPERTY_category" => "flat",
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
        $filterData['priceshort'][] = $temp['PROPERTIES']['price100short']['VALUE'];
        $filterData['area'][] = $temp['PROPERTIES']['area']['VALUE'];
        $filterData['floor'][] = $temp['PROPERTIES']['floor']['VALUE'];
        $filterData['kitchenspace'][] = $temp['PROPERTIES']['kitchenspace']['VALUE'];
        $currYear = date("Y");
        $filterData['builtyear'][] = $currYear > $temp['PROPERTIES']['builtyear']['VALUE'] ? "Сдан" : $temp['PROPERTIES']['builtyear']['VALUE'];

    }
    ?>
    <?
    $filterData['room'] = array_values(array_unique($filterData['room']));
    $filterData['priceshort'] = array_values(array_unique($filterData['priceshort']));
    $filterData['area'] = array_values(array_unique($filterData['area']));
    $filterData['floor'] = array_values(array_unique($filterData['floor']));
    $filterData['kitchenspace'] = array_filter(array_values(array_unique($filterData['kitchenspace'])));
    $filterData['builtyear'] = array_values(array_unique($filterData['builtyear']));
    sort($filterData['builtyear']);
    \RaStudio\Helper::arrayShiftInRight($filterData['builtyear']);
    ?>
	    <div class="container">
		<h2 class="h1 title">Выбор недвижимости</h2><?/* Выбор <?=$typeOfApartment == "commercial" ? "помещений" : "недвижимости"?> */?>
		<form class="filter" id="filter-anchor" data-filter-type="build">
            <input type="hidden" value="1" name="IBLOCK_ID">
			<div class="filter-mob">Фильтр по <?=$typeOfApartment == "commercial" ? "помещениям" : "квартирам"?>
				<button class="ui-btn ui-btn--stroke" type="button"><img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-dropdown-arrow.svg" alt="link" width="12" height="7"></button>
			</div>
			<div class="filter-mob-collapse">
				<div class="filter-row">
					<div class="filter-fields filter-fields--padding">
						<div class="filter__field filter-field">
							<div class="filter-field__label">Количество комнат</div>
                            <div class="ui-checkbox-group">
                                <div class="ui-checkbox">
                                    <input class="ui-checkbox__input" id="room0" type="checkbox" name="PROPERTY_rooms" value="0" data-event-change="getFilterBuild">
                                    <label class="ui-checkbox__label" for="room0">С</label>
                                </div>
                                <div class="ui-checkbox">
                                    <input class="ui-checkbox__input" id="room1" type="checkbox" name="PROPERTY_rooms" value="1" data-event-change="getFilterBuild">
                                    <label class="ui-checkbox__label" for="room1" >1</label>
                                </div>
                                <div class="ui-checkbox">
                                    <input class="ui-checkbox__input" id="room2" type="checkbox" name="PROPERTY_rooms" value="2" data-event-change="getFilterBuild">
                                    <label class="ui-checkbox__label" for="room2">2</label>
                                </div>
                                <div class="ui-checkbox">
                                    <input class="ui-checkbox__input" id="room3" type="checkbox" name="PROPERTY_rooms" value="3" data-event-change="getFilterBuild">
                                    <label class="ui-checkbox__label" for="room3">3</label>
                                </div>
                                <div class="ui-checkbox">
                                    <input class="ui-checkbox__input" id="room4" type="checkbox" name="PROPERTY_rooms" value="4" data-event-change="getFilterBuild">
                                    <label class="ui-checkbox__label" for="room4">4</label>
                                </div>
                                <?/*
                                <div class="ui-checkbox">
                                    <input class="ui-checkbox__input" id="room5" type="checkbox" name="PROPERTY_rooms" value="5" data-event-change="getFilterBuild">
                                    <label class="ui-checkbox__label" for="room5">5</label>
                                </div>
                                */?>
                            </div>
						</div>
						<div class="filter__field filter-field">
							<div class="filter-field__label">Стоимость, млн/р.</div>
							<div class="ui-range">
								<div class="ui-range__col"><span>от</span>
									<input class="ui-range__val ui-range__from" name = ">=PROPERTY_price100short" min="<?=floor(min($filterData['priceshort']))?>" max="<?=ceil(max($filterData['priceshort']))?>" step="1" value="<?=floor(min($filterData['priceshort']))?>">
								</div>
								<div class="ui-range__col"><span>до</span>
									<input class="ui-range__val ui-range__to" name = "<=PROPERTY_price100short" min="<?=floor(min($filterData['priceshort']))?>" max="<?=ceil(max($filterData['priceshort']))?>" step="1" value="<?=ceil(max($filterData['priceshort']))?>">
								</div>
                                <div
                                        class="ui-range__slider ui-range-cost"
                                        data-min = "<?=floor(min($filterData['priceshort']))?>"
                                        data-max = "<?=ceil(max($filterData['priceshort']))?>"
                                        data-step = "0.1"
                                ></div>
							</div>
						</div>
						<div class="filter__field filter-field">
							<div class="filter-field__label">Площадь, м<sup>2</sup></div>
							<div class="ui-range">
								<div class="ui-range__col"><span>от</span>
									<input class="ui-range__val ui-range__from" name = ">=PROPERTY_area" min="<?=floor(min($filterData['area']))?>" max="<?=ceil(max($filterData['area']))?>" step="1" value="<?=floor(min($filterData['area']))?>">
								</div>
								<div class="ui-range__col"><span>до</span>
									<input class="ui-range__val ui-range__to" name = "<=PROPERTY_area" min="<?=floor(min($filterData['area']))?>" max="<?=ceil(max($filterData['area']))?>" step="1" value="<?=ceil(max($filterData['area']))?>">
								</div>
                                <div
                                        class="ui-range__slider ui-range-size"
                                        data-min = "<?=floor(min($filterData['area']))?>"
                                        data-max = "<?=ceil(max($filterData['area']))?>"
                                        data-step = "1"
                                ></div>
							</div>
						</div>
						<div class="filter__field filter-field">
							<div class="filter-field__label">Готовность до</div>
							<select class="ui-select" name="PROPERTY_builtyear" data-placeholder="Любой" data-event-change="getFilterBuild">
								<option class="active" value="Любой" data-event-change="getFilterBuild">Любой</option>
                                <?foreach ($filterData['builtyear'] as $key => $year):?>
                                    <option value="<?=$year?>" data-event-change="getFilterBuild"><?=$year?></option>
                                <?endforeach;?>
							</select>
						</div>
					</div>
				</div>
				<!-- /.filter__row-->
				<!-- /.filter__row-->
				<!-- /.filter__row-->
			</div>
		</form>
		<!-- /.filter-->
		<div class="results results-geo">
			<div class="results-geo__label">Показать <span class="results-geo__result"><?=count($build)?> объекта</span></div>
			<button class="ui-btn ui-btn--stroke results-geo__btn" type="button"><img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-dropdown-arrow.svg" alt="link" width="12" height="7"></button>
			<div class="map" id="map_index" style="width: 100%; height: 617px"></div>
          </div>
          <!-- /.results-->
        </div>
        <!-- /.container-->
        <div class="container section-margin">
          <h2 class="h1 title">Объекты</h2>
          <div class="quarter-list view-1"></div>
          <!-- /.quarter-list 1-->
          <div class="quarter-list view-2"><div class="f-row"></div></div>
          <!-- /.quarter-list 2-->
          <?/*
          <div class="results-empty">По вашему запросу ничего не найдено.</div>
          <div class="quarter-list view-1">
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
                  <div class="p-distance flex"><img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-walk-dist.svg" width="8" height="13" alt="alt"><span>
                      5 мин./пешком</span></div>
                  <div class="p-distance flex"><img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-transport-dist.svg" width="15" height="16" alt="alt"><span>
                      10 мин./транспортом</span></div>
                </div>
                <div class="quarter__info my-readmore">
                  <p>240 квартир со скидкой от 450 000. Выгодное предложения июня 2019. Успейте с максимальными скидками. Акция действует только в Июне, и если не купите вы - купят другие. 240 квартир со скидкой от 450 000. Выгодное предложения июня 2019. Успейте с максимальными скидками. Акция действует только в Июне, и если не купите вы - купят другие</p>
                </div>
                <div class="p-discount flex">
                  <div class="p-discount__ic">%</div>
                  <p class="p-discount__txt">Только до 15 сентября до 15%!</p>
                </div>
                <div class="quarter__footer">
                  <div class="p-key p-key--blue">
                    <div class="p-key__ic"> </div>
                    <div class="p-key__txt">Квартиры от <b>15.6 </b>млн/р.</div>
                  </div>
                  <div class="p-key p-key--green">
                    <div class="p-key__ic"> </div>
                    <div class="p-key__txt">Ключи 1 оч. в 2020!</div>
                  </div><a class="btn btn--bg quarter-link" href="#"> <img class="svg btn__ic ic-arrow" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-arrow.svg" alt="link" width="20" height="20">Подробнее</a>
                </div>
              </div>
            </div>
            <!-- /.quarter-->
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
                  <div class="p-distance flex"><img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-walk-dist.svg" width="8" height="13" alt="alt"><span>
                      5 мин./пешком</span></div>
                  <div class="p-distance flex"><img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-transport-dist.svg" width="15" height="16" alt="alt"><span>
                      10 мин./транспортом</span></div>
                </div>
                <div class="quarter__info my-readmore">
                  <p>240 квартир со скидкой от 450 000. Выгодное предложения июня 2019. Успейте с максимальными скидками. Акция действует только в Июне, и если не купите вы - купят другие.</p>
                </div>
                <div class="p-discount flex">
                  <div class="p-discount__ic">%</div>
                  <p class="p-discount__txt">Только до 15 сентября до 15%!</p>
                </div>
                <div class="quarter__footer">
                  <div class="p-key p-key--blue">
                    <div class="p-key__ic"> </div>
                    <div class="p-key__txt">Квартиры от <b>15.6 </b>млн/р.</div>
                  </div>
                  <div class="p-key p-key--green">
                    <div class="p-key__ic"> </div>
                    <div class="p-key__txt">Ключи 1 оч. в 2020!</div>
                  </div><a class="btn btn--bg quarter-link" href="#"> <img class="svg btn__ic ic-arrow" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-arrow.svg" alt="link" width="20" height="20">Подробнее</a>
                </div>
              </div>
            </div>
            <!-- /.quarter-->
          </div>
          <!-- /.quarter-list 1-->
            */?>
        </div>
        <!-- /.container-->
    <? $APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"stockMain", 
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
		"CACHE_TIME" => "360",
		"CACHE_TYPE" => "A",
		"COMPATIBLE_MODE" => "Y",
		"CONVERT_CURRENCY" => "N",
		"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_COMPARE" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "SORT",
		"ELEMENT_SORT_FIELD2" => "SORT",
		"ELEMENT_SORT_ORDER" => "DESC",
		"ELEMENT_SORT_ORDER2" => "DESC",
		"ENLARGE_PRODUCT" => "STRICT",
		"FILE_404" => "",
		"FILTER_NAME" => "arrFilter",
		"HIDE_NOT_AVAILABLE" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"IBLOCK_ID" => "3",
		"IBLOCK_TYPE" => "content",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LABEL_PROP" => array(
		),
		"LAZY_LOAD" => "N",
		"LINE_ELEMENT_COUNT" => "3",
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
		"PAGE_ELEMENT_COUNT" => "2",
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
		"COMPONENT_TEMPLATE" => "stockMain",
		"PROPERTY_CODE_MOBILE" => array(
		)
	),
	false
);?>
</div>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>
