<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Избранное");

$tempS = $_SESSION['FAVORITE'];

if(!empty($_POST['TO']) && $_POST['TO']=='FAVORITE' && $_POST['ID']){
    if( $tempS[$_POST['ID']] ){
        unset( $tempS[$_POST['ID']] );
    }else{
        $tempS[$_POST['ID']] = $_POST['ID'];
    }
}


$_SESSION['FAVORITE'] = $tempS;

?>
	<?
		file_put_contents('data.json', json_encode($_SESSION['FAVORITE']));
	?>
<div class="page page--nohero" style="padding-bottom: 0px">
	<div class="container">
		 <?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb",
	"main_breadcrumbs",
	Array(
		"PATH" => "",
		"SITE_ID" => "s1",
		"START_FROM" => "0"
	)
);?>
		<h1 class="title title-margin"><?=$APPLICATION->ShowTitle(false)?></h1>
    <?if(count($tempS)>0){?>
        <?
            $GLOBALS['arrFavoriteFilter'] = [ 'ID' => $tempS ];
        ?>
		 <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"favorite",
	Array(
		"ACTION_VARIABLE" => "action",
		"ADD_PICT_PROP" => "image",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
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
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPATIBLE_MODE" => "Y",
		"CONVERT_CURRENCY" => "Y",
		"CURRENCY_ID" => "RUB",
		"CUSTOM_FILTER" => "",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_COMPARE" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"ENLARGE_PRODUCT" => "STRICT",
		"FILE_404" => "",
		"FILTER_NAME" => "arrFavoriteFilter",
		"HIDE_NOT_AVAILABLE" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"IBLOCK_ID" => "1",
		"IBLOCK_TYPE" => "kompleks",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LABEL_PROP" => array(),
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
		"PAGER_TEMPLATE" => "blog",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "100",
		"PARTIAL_PRODUCT_PROPERTIES" => "Y",
		"PRICE_CODE" => array(),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false}]",
		"PRODUCT_SUBSCRIPTION" => "Y",
		"PROPERTY_CODE_MOBILE" => array(),
		"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
		"RCM_TYPE" => "personal",
		"SECTION_CODE" => "",
		"SECTION_ID" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array("UF_SECTION_NAME",""),
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "Y",
		"SET_TITLE" => "N",
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
		"USE_MAIN_ELEMENT_SECTION" => "Y",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "Y"
	)
);?>


		<div class="results-empty favourite-empty" style="display: none;" >
			Пока вы не добавили ни одного объекта.
		</div>
    <?}else{?>
        <div class="results-empty favourite-empty" style="display: flex;" >
            Пока вы не добавили ни одного объекта.
        </div>
			<?}?>
    
	</div>
	 <!-- /.container--> <?$APPLICATION->IncludeComponent(
	"slam:easyform",
	"mainForm",
	Array(
		"CATEGORY_CUR_PAGE_CLASS" => "",
		"CATEGORY_CUR_PAGE_TITLE" => "Страница обращения:",
		"CATEGORY_CUR_PAGE_TYPE" => "hidden",
		"CATEGORY_CUR_PAGE_VALUE" => (@($_SERVER["HTTPS"]!="on")?"http://".$_SERVER["SERVER_NAME"]:"https://".$_SERVER["SERVER_NAME"]).($_SERVER["SERVER_PORT"]!=80?":".$_SERVER["SERVER_PORT"]:"").$_SERVER["REQUEST_URI"],
		"CATEGORY_PHONE_CLASS" => "col-1-3",
		"CATEGORY_PHONE_INPUTMASK" => "N",
		"CATEGORY_PHONE_INPUTMASK_TEMP" => "+7 (999) 999-9999",
		"CATEGORY_PHONE_PLACEHOLDER" => "Номер телефона",
		"CATEGORY_PHONE_TITLE" => "Телефон:",
		"CATEGORY_PHONE_TYPE" => "tel",
		"CATEGORY_PHONE_VALUE" => "",
		"CATEGORY_TITLE_CLASS" => "col-1-3",
		"CATEGORY_TITLE_PLACEHOLDER" => "Ваше имя",
		"CATEGORY_TITLE_TITLE" => "Имя клиента:",
		"CATEGORY_TITLE_TYPE" => "text",
		"CATEGORY_TITLE_VALUE" => "",
		"CLEAR_FORM" => "N",
		"COMPONENT_TEMPLATE" => "mainForm",
		"CREATE_SEND_MAIL" => "",
		"DISPLAY_FIELDS" => array(0=>"TITLE",1=>"PHONE",2=>"CUR_PAGE",3=>"",),
		"EMAIL_BCC" => "",
		"EMAIL_FILE" => "N",
		"EMAIL_TO" => "",
		"ENABLE_SEND_MAIL" => "Y",
		"ERROR_TEXT" => "Произошла ошибка. Сообщение не отправлено.",
		"EVENT_MESSAGE_ID" => array(0=>"48",),
		"FIELDS_ORDER" => "TITLE,PHONE,CUR_PAGE",
		"FORM_AUTOCOMPLETE" => "Y",
		"FORM_ID" => "FORM4",
		"FORM_NAME" => "Нужна консультация специалиста?",
		"FORM_SUBMIT_VALUE" => "Позвоните мне",
		"FORM_SUBMIT_VARNING" => "Отправляя форму, вы подтверждаете своё согласие на <a href=\"/privacy-policy/\" target=\"_blank\">обработку персональных данных</a>",
		"HIDE_ASTERISK" => "Y",
		"HIDE_FIELD_NAME" => "Y",
		"MAIL_SUBJECT_ADMIN" => "#SITE_NAME#: Сообщение из формы обратной связи",
		"OK_TEXT" => "Ваше сообщение отправлено. Мы свяжемся с вами в течение 2х часов",
		"REQUIRED_FIELDS" => array(0=>"PHONE",1=>"",),
		"SEND_AJAX" => "Y",
		"SHOW_MODAL" => "N",
		"USE_BOOTSRAP_CSS" => "N",
		"USE_BOOTSRAP_JS" => "N",
		"USE_CAPTCHA" => "N",
		"USE_FORMVALIDATION_JS" => "N",
		"USE_IBLOCK_WRITE" => "N",
		"USE_JQUERY" => "N",
		"USE_MODULE_VARNING" => "N",
		"WIDTH_FORM" => "500px",
		"_CALLBACKS" => "success_FORM4"
	)
);?>
<?/*
    <!-- form-->
    <div class="cta">
        <div class="container">
            <div class="cta__inner">
                <div class="h2 cta__title">Нужна консультация специалиста?</div>
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
    <!-- /.form-->
    */?>
</div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
