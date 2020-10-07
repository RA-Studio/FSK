<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

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

$typeOfApartment = "flat";

if(CSite::InDir('/commercial/')) {
    $typeOfApartment = "commercial";
}

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
    $filterData['priceshort'][] = $temp['PROPERTIES']['priceshort']['VALUE'];
    $filterData['area'][] = $temp['PROPERTIES']['area']['VALUE'];
    $filterData['floor'][] = $temp['PROPERTIES']['floor']['VALUE'];
    $filterData['kitchenspace'][] = $temp['PROPERTIES']['kitchenspace']['VALUE'];
    $filterData['builtyear'][] = $temp['PROPERTIES']['builtyear']['VALUE'];
}
?>
<?
$filterData['room'] = array_values(array_unique($filterData['room']));
$filterData['priceshort'] = array_values(array_unique($filterData['priceshort']));
$filterData['area'] = array_values(array_unique($filterData['area']));
$filterData['floor'] = array_values(array_unique($filterData['floor']));
$filterData['kitchenspace'] = array_filter(array_values(array_unique($filterData['kitchenspace'])));
$filterData['builtyear'] = array_values(array_unique($filterData['builtyear']));
?>
<div class="page page--nohero<?=" $typeOfApartment"?>">
    <div class="container">
        <h2 class="h1 title">Выбор квартир</h2>
        <form class="filter" id="filter-anchor" data-filter-type="build">
            <input type="hidden" value="1" name="IBLOCK_ID">
            <div class="filter-mob">Фильтр по квартирам
                <button class="ui-btn ui-btn--stroke" type="button"><img class="svg lazyload" data-src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-dropdown-arrow.svg" alt="link" width="12" height="7"></button>
            </div>
            <div class="filter-mob-collapse">
                <div class="filter-row">
                    <div class="filter-fields filter-fields--padding">
                        <?if(count(array_filter($filterData['room'])) > 0):?>
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
                        <?endif;?>
                        <div class="filter__field filter-field">
                            <div class="filter-field__label">Стоимость, млн/р.</div>
                            <div class="ui-range">
                                <div class="ui-range__col"><span>от</span>
                                    <input class="ui-range__val ui-range__from" name = ">=PROPERTY_priceshort" value="<?=min($filterData['priceshort'])?>">
                                </div>
                                <div class="ui-range__col"><span>до</span>
                                    <input class="ui-range__val ui-range__to" name = "<=PROPERTY_priceshort" value="<?=max($filterData['priceshort'])?>">
                                </div>
                                <div
                                        class="ui-range__slider ui-range-cost"
                                        data-min = "<?=min($filterData['priceshort'])?>"
                                        data-max = "<?=max($filterData['priceshort'])?>"
                                        data-step = "0.1"
                                ></div>
                            </div>
                        </div>
                        <div class="filter__field filter-field">
                            <div class="filter-field__label">Площадь, м<sup>2</sup></div>
                            <div class="ui-range">
                                <div class="ui-range__col"><span>от</span>
                                    <input class="ui-range__val ui-range__from" name = ">=PROPERTY_area" value="<?=round(min($filterData['area']), 0, PHP_ROUND_HALF_DOWN)?>">
                                </div>
                                <div class="ui-range__col"><span>до</span>
                                    <input class="ui-range__val ui-range__to" name = "<=PROPERTY_area" value="<?=round(max($filterData['area']), 0, PHP_ROUND_HALF_UP)?>">
                                </div>
                                <div
                                        class="ui-range__slider ui-range-size"
                                        data-min = "<?=round(min($filterData['area']), 0, PHP_ROUND_HALF_DOWN)?>"
                                        data-max = "<?=round(max($filterData['area']), 0, PHP_ROUND_HALF_UP)?>"
                                        data-step = "1"
                                ></div>
                            </div>
                        </div>
                        <div class="filter__field filter-field">
                            <div class="filter-field__label">Готовность до</div>
                            <select class="ui-select" name="PROPERTY_builtyear" data-placeholder="Любой" data-event-change="getFilterBuild">
                                <option class="active" value="" data-event-change="getFilterBuild">Любой</option>
                                <?foreach ($filterData['builtyear'] as $key => $year):?>
                                    <option value="<?=$year?>" data-event-change="getFilterBuild"><?=$year?></option>
                                <?endforeach;?>
                            </select>
                        </div>
                        <?if(count(array_filter($filterData['room'])) == 0):?>
                            <div class="filter__field filter-field-result"><a class="btn btn--bg" href="#"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17.086 17.215" class="svg btn__ic inlined-svg" width="20" height="20" role="img" aria-labelledby="title"><title>phone</title><g transform="translate(88.284 -1899.289) rotate(45)"><g transform="translate(1287 1399)" fill="none" stroke="#fff" stroke-width="1.5"><circle cx="5.656" cy="5.656" r="5.656" stroke="none"></circle><circle cx="5.656" cy="5.656" r="4.906" fill="none"></circle></g><line x2="0.182" y2="6.168" transform="translate(1292.656 1409.797)" fill="none" stroke="#fff" stroke-linecap="round" stroke-width="1.5"></line><g transform="matrix(0.777, -0.629, 0.629, 0.777, 1288.615, 1403.878)"><path d="M.494,2.583A.494.494,0,0,1,.039,1.9,3.111,3.111,0,0,1,4.112.246a.494.494,0,1,1-.385.909A2.123,2.123,0,0,0,.948,2.281.494.494,0,0,1,.494,2.583Z" transform="translate(0 0)" fill="#fff"></path></g></g></svg>Показать результаты</a></div>
                        <?endif;?>
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
            <button class="ui-btn ui-btn--stroke results-geo__btn" type="button"><img class="svg lazyload" data-src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-dropdown-arrow.svg" alt="link" width="12" height="7"></button>
            <div class="map" id="map_index" style="width: 100%; height: 617px"></div>
        </div>
        <!-- /.results-->
    </div>
    <div class="container section-margin">
        <h2 class="h1 title">Объекты</h2>
        <div class="quarter-list view-1"></div>
        <div class="quarter-list view-2"><div class="f-row"></div></div>
    </div>
    <?/*
        <div class="container">
          <div class="breadcrumbs" itemscope="" itemtype="http://schema.org/BreadcrumbList"><span itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem"> <a rel="nofollow" itemprop="item" title="Главная" href="/"> <span itemprop="name">Главная </span>
                <meta itemprop="position" content="1"></a></span><span itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem"> <a rel="nofollow" itemprop="item" title="Новостройки" href="#"> <span itemprop="name">Новостройки</span>
                <meta itemprop="position" content="2"></a></span></div>
          <!-- /.breadcrumbs-->
          <h2 class="h1 title">Выбор квартир</h2>
          <div class="filter" id="filter-anchor">
            <div class="filter-mob">Фильтр по квартирам
              <button class="ui-btn ui-btn--stroke" type="button"><img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-dropdown-arrow.svg" alt="link" width="12" height="7"></button>
            </div>
            <div class="filter-mob-collapse">
              <div class="filter-row">
                <div class="filter-fields filter-fields--padding">
                  <div class="filter__field filter-field">
                    <div class="filter-field__label">Количество комнат</div>
                    <div class="ui-checkbox-group">
                      <div class="ui-checkbox">
                        <input class="ui-checkbox__input" id="checkbox-rooms-0" type="checkbox" name="filter_rooms_C">
                        <label class="ui-checkbox__label" for="checkbox-rooms-0">С</label>
                      </div>
                      <div class="ui-checkbox">
                        <input class="ui-checkbox__input" id="checkbox-rooms-1" type="checkbox" name="filter_rooms_1">
                        <label class="ui-checkbox__label" for="checkbox-rooms-1">1</label>
                      </div>
                      <div class="ui-checkbox">
                        <input class="ui-checkbox__input" id="checkbox-rooms-2" type="checkbox" name="filter_rooms_2">
                        <label class="ui-checkbox__label" for="checkbox-rooms-2">2</label>
                      </div>
                      <div class="ui-checkbox">
                        <input class="ui-checkbox__input" id="checkbox-rooms-3" type="checkbox" name="filter_rooms_3">
                        <label class="ui-checkbox__label" for="checkbox-rooms-3">3</label>
                      </div>
                      <div class="ui-checkbox">
                        <input class="ui-checkbox__input" id="checkbox-rooms-4" type="checkbox" name="filter_rooms_4">
                        <label class="ui-checkbox__label" for="checkbox-rooms-4">4</label>
                      </div>
                      <div class="ui-checkbox">
                        <input class="ui-checkbox__input" id="checkbox-rooms-5" type="checkbox" name="filter_rooms_5">
                        <label class="ui-checkbox__label" for="checkbox-rooms-5">5</label>
                      </div>
                    </div>
                  </div>
                  <div class="filter__field filter-field">
                    <div class="filter-field__label">Стоимость, млн/р.</div>
                    <div class="ui-range">
                      <div class="ui-range__col"><span>от</span>
                        <input class="ui-range__val ui-range__from" value="1.95">
                      </div>
                      <div class="ui-range__col"><span>до</span>
                        <input class="ui-range__val ui-range__to" value="12.8">
                      </div>
                      <div class="ui-range__slider ui-range-cost"></div>
                    </div>
                  </div>
                  <div class="filter__field filter-field">
                    <div class="filter-field__label">Площадь, м<sup>2</sup></div>
                    <div class="ui-range">
                      <div class="ui-range__col"><span>от</span>
                        <input class="ui-range__val ui-range__from" value="22">
                      </div>
                      <div class="ui-range__col"><span>до</span>
                        <input class="ui-range__val ui-range__to" value="158">
                      </div>
                      <div class="ui-range__slider ui-range-size"></div>
                    </div>
                  </div>
                  <div class="filter__field filter-field">
                    <div class="filter-field__label">Готовность до</div>
                    <select class="ui-select" name="select_period" data-placeholder="Любой">
                      <option class="active" value="Любой">Любой</option>
                      <option value="2020">2020</option>
                      <option value="2021">2021</option>
                      <option value="2022">2022</option>
                    </select>
                  </div>
                </div>
              </div>
              <!-- /.filter__row-->
              <!-- /.filter__row-->
              <!-- /.filter__row-->
            </div>
          </div>
          <!-- /.filter-->
          <div class="results results-geo">
            <div class="results-geo__label">Показать <span class="results-geo__result">2 объекта</span></div>
            <button class="ui-btn ui-btn--stroke results-geo__btn" type="button"><img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-dropdown-arrow.svg" alt="link" width="12" height="7"></button>
            <div class="map" id="map"></div>
          </div>
          <!-- /.results-->
        </div>
		<?
			$APPLICATION->IncludeComponent(
				"bitrix:catalog.section.list",
				"",
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
					"SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
					"HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
					"ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : '')
				),
				$component,
				($arParams["SHOW_TOP_ELEMENTS"] !== "N" ? array("HIDE_ICONS" => "Y") : array())
			);
		?>
    */?>
		<!-- form-->
    <?$APPLICATION->IncludeComponent(
	"slam:easyform",
	"mainForm",
	array(
		"COMPONENT_TEMPLATE" => "mainForm",
		"FORM_ID" => "FORM4",
		"FORM_NAME" => "Нужна консультация специалиста?",
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
		"_CALLBACKS" => "success_FORM4",
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
		"CATEGORY_CUR_PAGE_CLASS" => "",
		"CATEGORY_CUR_PAGE_VALUE" => (@($_SERVER["HTTPS"]!="on")?"http://".$_SERVER["SERVER_NAME"]:"https://".$_SERVER["SERVER_NAME"]).($_SERVER["SERVER_PORT"]!=80?":".$_SERVER["SERVER_PORT"]:"").$_SERVER["REQUEST_URI"]
	),
	false
);?>
        <!-- /.form-->
        <div class="container section-margin">
          <div class="content">
            <p class="sub-color mb-0">ГК ФСК работает не только в Москве и Московской области, но также в Санкт-Петербурге и Ленинградской области, Калужской области и Краснодарском крае. В структуру холдинга входят собственные производственные мощности, генподрядные организации, технический заказчик, агентство недвижимости, сервисные службы. Компания, основанная в 2005 году, зарекомендовала себя надежным партнером, который всегда выполняет обязательства. Вертикально интегрированная структура ФСК позволяет в короткие сроки своими силами проектировать и строить объекты любого уровня сложности, используя преимущественно собственное финансирование. Именно поэтому бизнес компании очень устойчив, а кредитная нагрузка минимальна. В 2016 году в структуру холдинга вошел ДСК-1 – крупнейшее предприятие по производству панельных домов с полувековой историей. В результате этой сделки компания вышла на новый для нее рынок индустриального домостроения, а также укрепила свои позиции и расширила ассортимент в сегментах стандарт и комфорт.</p>
          </div>
        </div>
      </div>
<?

if ($arParams["USE_COMPARE"] === "Y")
{
	$APPLICATION->IncludeComponent(
		"bitrix:catalog.compare.list",
		"",
		array(
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"NAME" => $arParams["COMPARE_NAME"],
			"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
			"COMPARE_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["compare"],
			"ACTION_VARIABLE" => (!empty($arParams["ACTION_VARIABLE"]) ? $arParams["ACTION_VARIABLE"] : "action"),
			"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
			'POSITION_FIXED' => isset($arParams['COMPARE_POSITION_FIXED']) ? $arParams['COMPARE_POSITION_FIXED'] : '',
			'POSITION' => isset($arParams['COMPARE_POSITION']) ? $arParams['COMPARE_POSITION'] : ''
		),
		$component,
		array("HIDE_ICONS" => "Y")
	);
}

if ($arParams["SHOW_TOP_ELEMENTS"] !== "N")
{
	if (isset($arParams['USE_COMMON_SETTINGS_BASKET_POPUP']) && $arParams['USE_COMMON_SETTINGS_BASKET_POPUP'] === 'Y')
	{
		$basketAction = isset($arParams['COMMON_ADD_TO_BASKET_ACTION']) ? $arParams['COMMON_ADD_TO_BASKET_ACTION'] : '';
	}
	else
	{
		$basketAction = isset($arParams['TOP_ADD_TO_BASKET_ACTION']) ? $arParams['TOP_ADD_TO_BASKET_ACTION'] : '';
	}

	$APPLICATION->IncludeComponent(
		"bitrix:catalog.top",
		"",
		array(
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"ELEMENT_SORT_FIELD" => $arParams["TOP_ELEMENT_SORT_FIELD"],
			"ELEMENT_SORT_ORDER" => $arParams["TOP_ELEMENT_SORT_ORDER"],
			"ELEMENT_SORT_FIELD2" => $arParams["TOP_ELEMENT_SORT_FIELD2"],
			"ELEMENT_SORT_ORDER2" => $arParams["TOP_ELEMENT_SORT_ORDER2"],
			"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
			"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
			"BASKET_URL" => $arParams["BASKET_URL"],
			"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
			"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
			"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
			"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
			"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
			"ELEMENT_COUNT" => $arParams["TOP_ELEMENT_COUNT"],
			"LINE_ELEMENT_COUNT" => $arParams["TOP_LINE_ELEMENT_COUNT"],
			"PROPERTY_CODE" => (isset($arParams["TOP_PROPERTY_CODE"]) ? $arParams["TOP_PROPERTY_CODE"] : []),
			"PROPERTY_CODE_MOBILE" => $arParams["TOP_PROPERTY_CODE_MOBILE"],
			"PRICE_CODE" => $arParams["~PRICE_CODE"],
			"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
			"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
			"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
			"PRICE_VAT_SHOW_VALUE" => $arParams["PRICE_VAT_SHOW_VALUE"],
			"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
			"ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
			"PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
			"PRODUCT_PROPERTIES" => (isset($arParams["PRODUCT_PROPERTIES"]) ? $arParams["PRODUCT_PROPERTIES"] : []),
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"OFFERS_CART_PROPERTIES" => (isset($arParams["OFFERS_CART_PROPERTIES"]) ? $arParams["OFFERS_CART_PROPERTIES"] : []),
			"OFFERS_FIELD_CODE" => $arParams["TOP_OFFERS_FIELD_CODE"],
			"OFFERS_PROPERTY_CODE" => (isset($arParams["TOP_OFFERS_PROPERTY_CODE"]) ? $arParams["TOP_OFFERS_PROPERTY_CODE"] : []),
			"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
			"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
			"OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
			"OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
			"OFFERS_LIMIT" => (isset($arParams["TOP_OFFERS_LIMIT"]) ? $arParams["TOP_OFFERS_LIMIT"] : 0),
			'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
			'CURRENCY_ID' => $arParams['CURRENCY_ID'],
			'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],
			'VIEW_MODE' => (isset($arParams['TOP_VIEW_MODE']) ? $arParams['TOP_VIEW_MODE'] : ''),
			'ROTATE_TIMER' => (isset($arParams['TOP_ROTATE_TIMER']) ? $arParams['TOP_ROTATE_TIMER'] : ''),
			'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),

			'LABEL_PROP' => $arParams['LABEL_PROP'],
			'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
			'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
			'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
			'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
			'PRODUCT_BLOCKS_ORDER' => $arParams['TOP_PRODUCT_BLOCKS_ORDER'],
			'PRODUCT_ROW_VARIANTS' => $arParams['TOP_PRODUCT_ROW_VARIANTS'],
			'ENLARGE_PRODUCT' => $arParams['TOP_ENLARGE_PRODUCT'],
			'ENLARGE_PROP' => isset($arParams['TOP_ENLARGE_PROP']) ? $arParams['TOP_ENLARGE_PROP'] : '',
			'SHOW_SLIDER' => $arParams['TOP_SHOW_SLIDER'],
			'SLIDER_INTERVAL' => isset($arParams['TOP_SLIDER_INTERVAL']) ? $arParams['TOP_SLIDER_INTERVAL'] : '',
			'SLIDER_PROGRESS' => isset($arParams['TOP_SLIDER_PROGRESS']) ? $arParams['TOP_SLIDER_PROGRESS'] : '',

			'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
			'OFFER_TREE_PROPS' => (isset($arParams['OFFER_TREE_PROPS']) ? $arParams['OFFER_TREE_PROPS'] : []),
			'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
			'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
			'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
			'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
			'MESS_BTN_BUY' => $arParams['~MESS_BTN_BUY'],
			'MESS_BTN_ADD_TO_BASKET' => $arParams['~MESS_BTN_ADD_TO_BASKET'],
			'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],
			'MESS_BTN_DETAIL' => $arParams['~MESS_BTN_DETAIL'],
			'MESS_NOT_AVAILABLE' => $arParams['~MESS_NOT_AVAILABLE'],
			'ADD_TO_BASKET_ACTION' => $basketAction,
			'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
			'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
			'USE_COMPARE_LIST' => 'Y',

			'COMPATIBLE_MODE' => (isset($arParams['COMPATIBLE_MODE']) ? $arParams['COMPATIBLE_MODE'] : '')
		),
		$component
	);
	unset($basketAction);
}
