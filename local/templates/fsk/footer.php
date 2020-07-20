
<title>phone</title>
<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?> <?use Bitrix\Main\Page\Asset;?> <!-- footer--> <footer class="footer">

	<link rel="stylesheet" href="/local/components/slam/easyform/templates/uniform/uniform.css">
	<?
    if(!CSite::InDir(SITE_DIR . "index.php")){
        ?>
        <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH . '/css/air-datepicker-mini.css'?>">
        <?
    }
    ?>
    <script src="<?=SITE_TEMPLATE_PATH . '/js/magnific.js'?>"></script>

	<?if(strpos($_SERVER['HTTP_USER_AGENT'],'Chrome-Lighthouse') == false):?>
    	<!--script src="<?=SITE_TEMPLATE_PATH . '/js/jquery-ui.min.js'?>"></script-->
	<?endif?>
    <script src="<?=SITE_TEMPLATE_PATH . '/libs/jquery.ui.touch-punch.js'?>"></script>
    <script src="<?=SITE_TEMPLATE_PATH . '/js/jquery.cookie.js'?>"></script>
    <?
    if(!CSite::InDir(SITE_DIR . "index.php") && !CSite::InDir('/vacancy/') && !CSite::InDir('/clients/')){
        ?><script src="<?=SITE_TEMPLATE_PATH . '/js/SimpleBar.js'?>"></script><?
    }
    ?>
	<script src="<?=SITE_TEMPLATE_PATH . '/js/lazyload.js'?>"></script>
	<?if(
		!CSite::InDir('/contacts/') && !CSite::InDir('/vacancy/') && !CSite::InDir('/docs/') && !CSite::InDir('/clients/')
	):?>
		<script src="<?=SITE_TEMPLATE_PATH . '/js/slider.js'?>"></script>
    	<script src="<?=SITE_TEMPLATE_PATH . '/js/script-1.js'?>"></script>
		<script src="<?=SITE_TEMPLATE_PATH . '/js/ApartmentControl3.js'?>"></script>

	<?endif?>
	<script src="<?=SITE_TEMPLATE_PATH . '/js/scripts7.js'?>"></script>
	<script src="<?=SITE_TEMPLATE_PATH . '/js/ajax.js'?>"></script>

	<?if(strpos($_SERVER['HTTP_USER_AGENT'],'Chrome-Lighthouse') == false):?>
		<!--script class="g-recaptcha-script" src="https://www.google.com/recaptcha/api.js" async defer></script-->
	<?endif?>

	<?


	?>

<?global $USER;
        if (!$USER->IsAdmin()) {?>
<div class="corona">
	<div class="corona-wrap">
		<div class="corona-popup">
			<div class="corona-popup__close">
			</div>
			<div class="corona-popup__img">
 <img class="lazyload" data-src="/local/templates/fsk/img/Pop-up_fsk_1.jpg">
			</div>
			<div class="corona-popup-info">
				 ГК ФСК – одна из крупнейших и наиболее надежных строительных компаний России, включенная в перечень системообразующих организаций, и реализующая более 20 проектов в Петербурге, Москве и других регионах. В это непростое время мы желаем вам и вашим близким здоровья и терпения. И предлагаем не откладывать важные планы! <br>
 <br>
				 Наш сайт позволяет вам забронировать и приобрести квартиру онлайн, получить ипотечный кредит и оформить собственность, не выходя из дома. Бронирование осуществляется из карточек квартир. Онлайн-бронь позволяет зафиксировать стоимость на срок до 14 дней. <br>
 <br>
				 Мы рекомендуем вам не откладывать покупку квартиры – скоро цены на недвижимость вырастут. До 31 мая мы продлили специальные акции со скидками до 1 000 000 руб. - успейте купить по максимально низкой цене! А при онлайн-бронировании на этом сайте действует дополнительная скидка - 1%!
				<div class="corona-popup-info-accordeon">
					<div class="corona-popup-info-accordeon__title">
 <img src="/local/templates/fsk/img/corona-icon1.svg" alt="">
						Смотреть схему покупки квартиры <img src="/local/templates/fsk/img/corona-icon2.svg" alt="">
					</div>
					<div class="corona-popup-info-accordeon__text">
						 - Выберите квартиру на сайте <br>
						 - Забронируйте ее через сайт <br>
						 - Согласуйте детали сделки по телефону или видеочату с менеджером <br>
						 - Подпишите договор на приобретение квартиры с помощью электронной подписи или получите его на дом с нашим курьером <br>
						 - При 100% оплате откройте аккредитивный счет/оплатите на расчетный счет (в зависимости от проекта) <br>
						 - При ипотеке оформите удаленную заявку на кредит через нашего менеджера <br>
						 - Ожидайте регистрацию сделки и празднуйте важную покупку!
					</div>
				</div>
				<div class="corona-popup-info-btns">
 <a href="#modal-FORM10" class="popup-btn-FORM10 btn btn--cta">
					Позвоните мне </a>
					<div class="btn btn--transp corona-popup-info-btns__close">
						 Закрыть уведомление
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
 <?}?>
<div class="container">
	 <!-- desktop-->
	<div class="sub-menu">
		<div class="f-row">
			<div class="cols col-1-4">
				<div class="sub-menu__title">
					 Новостройки
				</div>
				 <?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"bottom_menu", 
	array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "left",
		"COMPONENT_TEMPLATE" => "bottom_menu",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "Y",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "bottom_menu1",
		"USE_EXT" => "N"
	),
	false
);?>
			</div>
			<div class="cols col-1-4">
				<div class="sub-menu__title">
					 О застройщике
				</div>
				 <?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"bottom_menu", 
	array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "left",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "Y",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "bottom_menu2",
		"USE_EXT" => "N",
		"COMPONENT_TEMPLATE" => "bottom_menu"
	),
	false
);?>
			</div>
			<div class="cols col-1-4">
				<div class="sub-menu__title">
					 Оплата
				</div>
				 <?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"bottom_menu", 
	array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "left",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "Y",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "bottom_menu3",
		"USE_EXT" => "N",
		"COMPONENT_TEMPLATE" => "bottom_menu"
	),
	false
);?>
			</div>
			<div class="cols col-1-4">
				<div class="sub-menu__title">
					 Покупателям
				</div>
				 <?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"bottom_menu2", 
	array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "left",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "Y",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "bottom_menu4",
		"USE_EXT" => "N",
		"COMPONENT_TEMPLATE" => "bottom_menu2"
	),
	false
);?> <a class="confidence-link" href="/privacy-policy/">Политика конфиденциальности</a>
			</div>
		</div>
	</div>
	 <!-- mobile--> <?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"bottom_menu_mobile", 
	array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "left",
		"COMPONENT_TEMPLATE" => "bottom_menu_mobile",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "Y",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "bottom_menu_mobile",
		"USE_EXT" => "N"
	),
	false
);?>
    <?/*
          <div class="footer__line">
            <div class="contact-links">
                <a class="contact-link" href="tel:
                <?$APPLICATION->IncludeFile(
                    "/include/phone.php",
                    array(),
                    array(
                        "NAME"=>"Телефон",
                        "MODE" => "html",
                        "SHOW_BORDER"=>false
                    )
                );?>
                ">
                    <div class="ic-container">
                        <img class="svg svg-stroke btn__ic" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-tel.svg" alt="tel" width="12" height="20">
                    </div>
                    <?$APPLICATION->IncludeFile(
                        "/include/phone.php",
                        array(),
                        array(
                            "NAME"=>"Телефон",
                            "MODE" => "html",
                        )
                    );?>
                </a>
                <a class="contact-link" href="mailto:
                <?$APPLICATION->IncludeFile(
                    "/include/mail.php",
                    array(),
                    array(
                        "NAME"=>"Почта",
                        "MODE" => "html",
                        "SHOW_BORDER"=>false
                    )
                );?>">
                    <div class="ic-container">
                        <img class="svg btn__ic" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-envelope.svg" alt="email" width="20" height="15">
                    </div><?$APPLICATION->IncludeFile(
                        "/include/mail.php",
                        array(),
                        array(
                            "NAME"=>"Почта",
                            "MODE" => "html",
                        )
                    );?>
                </a>
                <?$APPLICATION->IncludeFile(
                        "/include/location.php",
                        array(),
                        array(
                            "NAME"=>"Адрес",
                            "MODE" => "html",
                        )
                    );?>
                <span class="contact-link">
                    <div class="ic-container">
                        <img class="svg btn__ic" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-time.svg" alt="geo" width="19" height="19">
                    </div>
                     <?$APPLICATION->IncludeFile(
                         "/include/timeWork.php",
                         array(),
                         array(
                             "NAME"=>"Время работы",
                             "MODE" => "html",
                         )
                     );?>
                </span>

            </div>
            <button class="btn btn--cta js-call-callback" type="button">
                <img class="svg btn__ic ic-tel" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-tel.svg" alt="phone" width="12" height="20">
                Позвоните мне
            </button>
          </div>
        */?>
	<div class="footer__text">
		<div>
			 <?$APPLICATION->IncludeFile(
                    "/include/copyright.php",
                    array(),
                    array(
                        "NAME"=>"Копирайт",
                        "MODE" => "html",
                    )
                );?>
		</div>
		 <?$APPLICATION->IncludeFile(
                  "/include/logoFooter.php",
                  array(),
                  array(
                      "NAME"=>"Логотип футера",
                      "MODE" => "html",
                  )
              );?>
	</div>
</div>
 </footer>
<?$APPLICATION->IncludeComponent(
	"slam:easyform",
	"popupForm",
	Array(
		"CAPTCHA_TITLE" => "",
		"CATEGORY_CUR_PAGE_CLASS" => "general-itemInput",
		"CATEGORY_CUR_PAGE_TITLE" => "CUR_PAGE",
		"CATEGORY_CUR_PAGE_TYPE" => "hidden",
		"CATEGORY_CUR_PAGE_VALUE" => (@($_SERVER["HTTPS"]!="on")?"http://".$_SERVER["SERVER_NAME"]:"https://".$_SERVER["SERVER_NAME"]).($_SERVER["SERVER_PORT"]!=80?":".$_SERVER["SERVER_PORT"]:"").$_SERVER["REQUEST_URI"],
		"CATEGORY_OBJECT_CLASS" => "general-itemInput",
		"CATEGORY_OBJECT_TITLE" => "OBJECT",
		"CATEGORY_OBJECT_TYPE" => "hidden",
		"CATEGORY_OBJECT_VALUE" => "",
		"CATEGORY_PHONE_CLASS" => "col-1-3",
		"CATEGORY_PHONE_INPUTMASK" => "N",
		"CATEGORY_PHONE_INPUTMASK_TEMP" => "+7 (999) 999-9999",
		"CATEGORY_PHONE_PLACEHOLDER" => "Номер телефона",
		"CATEGORY_PHONE_TITLE" => "Номер телефона",
		"CATEGORY_PHONE_TYPE" => "tel",
		"CATEGORY_PHONE_VALUE" => "",
		"CATEGORY_TITLE_CLASS" => "col-1-3",
		"CATEGORY_TITLE_PLACEHOLDER" => "ФИО",
		"CATEGORY_TITLE_TITLE" => "Ваше имя",
		"CATEGORY_TITLE_TYPE" => "text",
		"CATEGORY_TITLE_VALUE" => "",
		"CLEAR_FORM" => "N",
		"COMPONENT_TEMPLATE" => "popupForm",
		"CREATE_SEND_MAIL" => "",
		"CUSTOM_FORM" => "",
		"DISPLAY_FIELDS" => array(0=>"TITLE",1=>"PHONE",2=>"CUR_PAGE",3=>"OBJECT",4=>"",),
		"EMAIL_BCC" => "",
		"EMAIL_FILE" => "N",
		"EMAIL_TO" => "",
		"ENABLE_SEND_MAIL" => "Y",
		"ERROR_TEXT" => "Произошла ошибка. Сообщение не отправлено.",
		"EVENT_MESSAGE_ID" => array(0=>"53",),
		"FIELDS_ORDER" => "PHONE,TITLE,CUR_PAGE,OBJECT",
		"FORM_AUTOCOMPLETE" => "Y",
		"FORM_ID" => "callback",
		"FORM_NAME" => "Бронирование онлайн со скидкой 1%",
		"FORM_SUBMIT_VALUE" => "Забронировать",
		"FORM_SUBMIT_VARNING" => "Отправляя форму, вы подтверждаете своё согласие на <a href=\"/privacy-policy/\" target=\"_blank\">обработку персональных данных.</a> Бронирование является предварительным, для подтверждения с вами свяжется менеджер. Не оферта.",
		"HIDE_ASTERISK" => "Y",
		"HIDE_FIELD_NAME" => "Y",
		"MAIL_SUBJECT_ADMIN" => "#SITE_NAME#: Сообщение из формы обратной связи",
		"OK_TEXT" => "Ваше сообщение отправлено. Мы свяжемся с вами в течение 2х часов",
		"REQUIRED_FIELDS" => array(0=>"PHONE",),
		"SEND_AJAX" => "Y",
		"SHOW_MODAL" => "N",
		"USE_BOOTSRAP_CSS" => "N",
		"USE_BOOTSRAP_JS" => "N",
		"USE_CAPTCHA" => "Y",
		"USE_FORMVALIDATION_JS" => "N",
		"USE_IBLOCK_WRITE" => "N",
		"USE_JQUERY" => "N",
		"USE_MODULE_VARNING" => "N",
		"WIDTH_FORM" => "500px",
		"_CALLBACKS" => "success_callback"
	)
);?> <?
if($USER->IsAdmin()) {

	$APPLICATION->IncludeComponent(
		"slam:easyform",
		"popupFormCallBack",
		Array(
			"CATEGORY_CUR_PAGE_CLASS" => "general-itemInput",
			"CATEGORY_CUR_PAGE_TITLE" => "CUR_PAGE",
			"CATEGORY_CUR_PAGE_TYPE" => "hidden",
			"CATEGORY_CUR_PAGE_VALUE" => (@($_SERVER["HTTPS"]!="on")?"http://".$_SERVER["SERVER_NAME"]:"https://".$_SERVER["SERVER_NAME"]).($_SERVER["SERVER_PORT"]!=80?":".$_SERVER["SERVER_PORT"]:"").$_SERVER["REQUEST_URI"],
			"CATEGORY_OBJECT_CLASS" => "general-itemInput",
			"CATEGORY_OBJECT_TITLE" => "OBJECT",
			"CATEGORY_OBJECT_TYPE" => "hidden",
			"CATEGORY_OBJECT_VALUE" => "",
			"CATEGORY_PHONE_CLASS" => "col-1-3",
			"CATEGORY_PHONE_INPUTMASK" => "N",
			"CATEGORY_PHONE_INPUTMASK_TEMP" => "+7 (999) 999-9999",
			"CATEGORY_PHONE_PLACEHOLDER" => "Номер телефона",
			"CATEGORY_PHONE_TITLE" => "Номер телефона",
			"CATEGORY_PHONE_TYPE" => "tel",
			"CATEGORY_PHONE_VALUE" => "",
			"CATEGORY_TITLE_CLASS" => "col-1-3",
			"CATEGORY_TITLE_PLACEHOLDER" => "ФИО",
			"CATEGORY_TITLE_TITLE" => "Ваше имя",
			"CATEGORY_TITLE_TYPE" => "text",
			"CATEGORY_TITLE_VALUE" => "",
			"CLEAR_FORM" => "N",
			"COMPONENT_TEMPLATE" => "popupFormCallBack",
			"CREATE_SEND_MAIL" => "",
			"DISPLAY_FIELDS" => array(0=>"TITLE",1=>"PHONE",2=>"CUR_PAGE",3=>"OBJECT",4=>"",),
			"EMAIL_BCC" => "",
			"EMAIL_FILE" => "N",
			"EMAIL_TO" => "",
			"ENABLE_SEND_MAIL" => "Y",
			"ERROR_TEXT" => "Произошла ошибка. Сообщение не отправлено.",
			"EVENT_MESSAGE_ID" => array(0=>"51",),
			"FIELDS_ORDER" => "PHONE,TITLE,CUR_PAGE,OBJECT",
			"FORM_AUTOCOMPLETE" => "Y",
			"FORM_ID" => "FORM10",
			"FORM_NAME" => "Заказ обратного звонка",
			"FORM_SUBMIT_VALUE" => "Отправить",
			"FORM_SUBMIT_VARNING" => "Отправляя форму, вы подтверждаете своё согласие на <a href=\"/privacy-policy/\" target=\"_blank\">обработку персональных данных.</a> Бронирование является предварительным, для подтверждения с вами свяжется менеджер. Не оферта.",
			"HIDE_ASTERISK" => "Y",
			"HIDE_FIELD_NAME" => "Y",
			"HIDE_FORMVALIDATION_TEXT" => "Y",
			"INCLUDE_BOOTSRAP_JS" => "Y",
			"MAIL_SUBJECT_ADMIN" => "#SITE_NAME#: Сообщение из формы обратной связи",
			"OK_TEXT" => "Ваше сообщение отправлено. Мы свяжемся с вами в течение 2х часов",
			"REQUIRED_FIELDS" => array(0=>"PHONE",),
			"SEND_AJAX" => "Y",
			"SHOW_MODAL" => "N",
			"USE_BOOTSRAP_CSS" => "N",
			"USE_BOOTSRAP_JS" => "N",
			"USE_CAPTCHA" => "Y",
			"USE_FORMVALIDATION_JS" => "N",
			"USE_IBLOCK_WRITE" => "N",
			"USE_JQUERY" => "N",
			"USE_MODULE_VARNING" => "N",
			"WIDTH_FORM" => "500px",
			"_CALLBACKS" => "success_FORM10"
		)
	);
} else {
	$APPLICATION->IncludeComponent(
		"slam:easyform",
		"popupFormCallBack",
		Array(
			"CATEGORY_CUR_PAGE_CLASS" => "general-itemInput",
			"CATEGORY_CUR_PAGE_TITLE" => "CUR_PAGE",
			"CATEGORY_CUR_PAGE_TYPE" => "hidden",
			"CATEGORY_CUR_PAGE_VALUE" => (@($_SERVER["HTTPS"]!="on")?"http://".$_SERVER["SERVER_NAME"]:"https://".$_SERVER["SERVER_NAME"]).($_SERVER["SERVER_PORT"]!=80?":".$_SERVER["SERVER_PORT"]:"").$_SERVER["REQUEST_URI"],
			"CATEGORY_OBJECT_CLASS" => "general-itemInput",
			"CATEGORY_OBJECT_TITLE" => "OBJECT",
			"CATEGORY_OBJECT_TYPE" => "hidden",
			"CATEGORY_OBJECT_VALUE" => "",
			"CATEGORY_PHONE_CLASS" => "col-1-3",
			"CATEGORY_PHONE_INPUTMASK" => "N",
			"CATEGORY_PHONE_INPUTMASK_TEMP" => "+7 (999) 999-9999",
			"CATEGORY_PHONE_PLACEHOLDER" => "Номер телефона",
			"CATEGORY_PHONE_TITLE" => "Номер телефона",
			"CATEGORY_PHONE_TYPE" => "tel",
			"CATEGORY_PHONE_VALUE" => "",
			"CATEGORY_TITLE_CLASS" => "col-1-3",
			"CATEGORY_TITLE_PLACEHOLDER" => "ФИО",
			"CATEGORY_TITLE_TITLE" => "Ваше имя",
			"CATEGORY_TITLE_TYPE" => "text",
			"CATEGORY_TITLE_VALUE" => "",
			"CLEAR_FORM" => "N",
			"COMPONENT_TEMPLATE" => "popupFormCallBack",
			"CREATE_SEND_MAIL" => "",
			"DISPLAY_FIELDS" => array(0=>"TITLE",1=>"PHONE",2=>"CUR_PAGE",3=>"OBJECT",4=>"",),
			"EMAIL_BCC" => "",
			"EMAIL_FILE" => "N",
			"EMAIL_TO" => "",
			"ENABLE_SEND_MAIL" => "Y",
			"ERROR_TEXT" => "Произошла ошибка. Сообщение не отправлено.",
			"EVENT_MESSAGE_ID" => array(0=>"51",),
			"FIELDS_ORDER" => "PHONE,TITLE,CUR_PAGE,OBJECT",
			"FORM_AUTOCOMPLETE" => "Y",
			"FORM_ID" => "FORM10",
			"FORM_NAME" => "Заказ обратного звонка",
			"FORM_SUBMIT_VALUE" => "Отправить",
			"FORM_SUBMIT_VARNING" => "Отправляя форму, вы подтверждаете своё согласие на <a href=\"/privacy-policy/\" target=\"_blank\">обработку персональных данных.</a> Бронирование является предварительным, для подтверждения с вами свяжется менеджер. Не оферта.",
			"HIDE_ASTERISK" => "Y",
			"HIDE_FIELD_NAME" => "Y",
			"HIDE_FORMVALIDATION_TEXT" => "Y",
			"INCLUDE_BOOTSRAP_JS" => "Y",
			"MAIL_SUBJECT_ADMIN" => "#SITE_NAME#: Сообщение из формы обратной связи",
			"OK_TEXT" => "Ваше сообщение отправлено. Мы свяжемся с вами в течение 2х часов",
			"REQUIRED_FIELDS" => array(0=>"PHONE",),
			"SEND_AJAX" => "Y",
			"SHOW_MODAL" => "N",
			"USE_BOOTSRAP_CSS" => "N",
			"USE_BOOTSRAP_JS" => "N",
			"USE_CAPTCHA" => "Y",
			"USE_FORMVALIDATION_JS" => "N",
			"USE_IBLOCK_WRITE" => "N",
			"USE_JQUERY" => "N",
			"USE_MODULE_VARNING" => "N",
			"WIDTH_FORM" => "500px",
			"_CALLBACKS" => "success_FORM10"
		)
	);
}


?> <?$APPLICATION->IncludeComponent(
	"slam:easyform",
	"popupFormCalculation",
	Array(
		"CATEGORY_CUR_PAGE_CLASS" => "general-itemInput",
		"CATEGORY_CUR_PAGE_TITLE" => "CUR_PAGE",
		"CATEGORY_CUR_PAGE_TYPE" => "hidden",
		"CATEGORY_CUR_PAGE_VALUE" => (@($_SERVER["HTTPS"]!="on")?"http://".$_SERVER["SERVER_NAME"]:"https://".$_SERVER["SERVER_NAME"]).($_SERVER["SERVER_PORT"]!=80?":".$_SERVER["SERVER_PORT"]:"").$_SERVER["REQUEST_URI"],
		"CATEGORY_OBJECT_CLASS" => "general-itemInput",
		"CATEGORY_OBJECT_TITLE" => "OBJECT",
		"CATEGORY_OBJECT_TYPE" => "hidden",
		"CATEGORY_OBJECT_VALUE" => "",
		"CATEGORY_PHONE_CLASS" => "col-1-3",
		"CATEGORY_PHONE_INPUTMASK" => "N",
		"CATEGORY_PHONE_INPUTMASK_TEMP" => "+7 (999) 999-9999",
		"CATEGORY_PHONE_PLACEHOLDER" => "Номер телефона",
		"CATEGORY_PHONE_TITLE" => "Номер телефона",
		"CATEGORY_PHONE_TYPE" => "tel",
		"CATEGORY_PHONE_VALUE" => "",
		"CATEGORY_TITLE_CLASS" => "col-1-3",
		"CATEGORY_TITLE_PLACEHOLDER" => "ФИО",
		"CATEGORY_TITLE_TITLE" => "Ваше имя",
		"CATEGORY_TITLE_TYPE" => "text",
		"CATEGORY_TITLE_VALUE" => "",
		"CLEAR_FORM" => "N",
		"COMPONENT_TEMPLATE" => "popupFormCallBack",
		"CREATE_SEND_MAIL" => "",
		"DISPLAY_FIELDS" => array(0=>"TITLE",1=>"PHONE",2=>"CUR_PAGE",3=>"OBJECT",4=>"",),
		"EMAIL_BCC" => "",
		"EMAIL_FILE" => "N",
		"EMAIL_TO" => "",
		"ENABLE_SEND_MAIL" => "Y",
		"ERROR_TEXT" => "Произошла ошибка. Сообщение не отправлено.",
		"EVENT_MESSAGE_ID" => array(0=>"55",),
		"FIELDS_ORDER" => "PHONE,TITLE,CUR_PAGE,OBJECT",
		"FORM_AUTOCOMPLETE" => "Y",
		"FORM_ID" => "FORM11",
		"FORM_NAME" => "Получить расчет дохода",
		"FORM_SUBMIT_VALUE" => "Получить расчет",
		"FORM_SUBMIT_VARNING" => "Отправляя форму, вы подтверждаете своё согласие на <a href=\"/privacy-policy/\" target=\"_blank\">обработку персональных данных.</a> Бронирование является предварительным, для подтверждения с вами свяжется менеджер. Не оферта.",
		"HIDE_ASTERISK" => "Y",
		"HIDE_FIELD_NAME" => "Y",
		"MAIL_SUBJECT_ADMIN" => "#SITE_NAME#: Сообщение из формы обратной связи",
		"OK_TEXT" => "Ваше сообщение отправлено. Мы свяжемся с вами в течение 2х часов",
		"REQUIRED_FIELDS" => array(0=>"PHONE",),
		"SEND_AJAX" => "Y",
		"SHOW_MODAL" => "N",
		"USE_BOOTSRAP_CSS" => "N",
		"USE_BOOTSRAP_JS" => "N",
		"USE_CAPTCHA" => "Y",
		"USE_FORMVALIDATION_JS" => "N",
		"USE_IBLOCK_WRITE" => "N",
		"USE_JQUERY" => "N",
		"USE_MODULE_VARNING" => "N",
		"WIDTH_FORM" => "500px",
		"_CALLBACKS" => "success_FORM11"
	)
);?> <!-- Модальная форма обратного звонка--> <?/*     <div class="modal modal-callback mfp-hide" id="modal-callback">
        <div class="modal-callback__inner">
          <div class="modal-callback__img" style="background-image: url('<?=SITE_TEMPLATE_PATH?>/img/img-callback-girl.jpg')"></div>
          <button class="close-btn mfp-close" type="button"></button>
          <div class="modal-callback__col">
            <div class="h3 text-bold">Заявка на бронирование</div>
            <div class="modal-callback__form">
              <form action="#">
			    <input class="input" type="tel" name="tel" placeholder="+7 (___) ___-__-__" reqiured>
                <input class="input" type="text" name="name" placeholder="ФИО" reqiured>
                <div class="text-center">
                  <button class="btn btn--cta" type="submit"> <img class="svg btn__ic ic-tel" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-tel.svg" alt="phone" width="12" height="20">Позвоните мне</button>
                </div>
                <p class="privacy">Отправляя форму, вы подтверждаете своё согласие на <a href="confidence.html" target="_blank">обработку персональных данных</a></p>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Модальное окно благодарности-->
      <div class="modal modal-callback modal-thanks mfp-hide" id="modal-thanks">
        <div class="modal-callback__inner">
          <div class="modal-callback__img" style="background-image: url('<?=SITE_TEMPLATE_PATH?>/img/img-callback-girl.jpg')"></div>
          <div class="modal-callback__col">
            <div class="modal-success__inner">
              <div class="modal-success__img"><img class="img" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-success.svg" alt="alt"></div>
              <div class="h2 modal-success__title">Спасибо за Вашу заявку!</div>
              <p>Наш специалист свяжется с вами в&nbsp;ближайшее время и ответит на все интересующие вас вопросы.</p>
              <button class="btn btn--border success-btn mfp-close" type="button"><img class="svg svg-stroke btn__ic" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-tel.svg" width="12" height="20" alt="ic">Отлично, жду!</button>
            </div>
          </div>
        </div>
      </div>
 */?><!-- Модальное окно благодарности--> <?/*
<div class="modal ipo-request mfp-hide" id="ipo-request">
    <div class="ipo-request__body">
        <div class="ipo-request__header">
            <div class="ipo-bank">
                <img src="/local/templates/fsk/img/ipo/vtb.png" class="img" alt="ВТБ">
            </div>
            <button class="close-btn mfp-close" type="button"></button>
        </div>
        <div class="ipo-request__data">
            <div class="data-col">
                <div>
                    Банк ВТБ
                </div>
                <div class="sub-text">
                    Лицензия № 1481 от 11.08.2015
                </div>
            </div>
            <div class="data-row">
                <div class="data-col">
                    <div class="sub-text text-bold">
                        Ставка
                    </div>
                    от 6.5%
                </div>
                <div class="data-col">
                    <div class="sub-text text-bold">
                        Срок
                    </div>
                    до 25 лет
                </div>
                <div class="data-col">
                    <div class="sub-text text-bold">
                        Ежемесячный платёж, р.
                    </div>
                    50 782
                </div>
            </div>
        </div>
    </div>
    <div class="ipo-request__form">
        <div class="h2 cta__title">
            Подать заявку<br>
            на ипотеку - просто!
        </div>
        <div class="cta__form cta-form">
            <form action="#">
                <div class="cta-form__row f-row">
                    <div class="cols col-1-3">
                        <input class="input" type="text" name="name" placeholder="Ваше имя" reqiured="">
                    </div>
                    <div class="cols col-1-3">
                        <input class="input" type="tel" name="tel" placeholder="Номер телефона" reqiured="">
                    </div>
                    <div class="cols col-1-3">
                        <button class="btn btn--cta demo-modal-success" type="submit"> <img width="12" alt="phone" src="/local/templates/fsk/img/icons/ic-tel.svg" height="20" class="svg btn__ic ic-tel">Позвоните мне</button>
                    </div>
                </div>
                <p class="privacy">
                    Отправляя форму, вы подтверждаете своё согласие на <a href="confidence.html" target="_blank">обработку персональных данных</a>
                </p>
            </form>
        </div>
    </div>
</div>
*/?>
<div class="modal modal-callback modal-thanks mfp-hide" id="modal-thanks">
	<div class="modal-callback__inner">
		<div class="modal-callback__img" style="background-image: url('/local/templates/fsk/img/img-callback-girl.jpg')">
		</div>
		<div class="modal-callback__col">
			<div class="modal-success__inner">
				<div class="modal-success__img">
 <img alt="alt" src="/local/templates/fsk/img/icons/ic-success.svg" class="img">
				</div>
				<div class="h2 modal-success__title">
					 Спасибо за Вашу заявку!
				</div>
				<p>
					 Наш специалист свяжется с вами в&nbsp;ближайшее время для подтверждения брони.
				</p>
 <button class="btn btn--border success-btn mfp-close" type="button"><img width="12" alt="ic" src="/local/templates/fsk/img/icons/ic-tel.svg" height="20" class="svg svg-stroke btn__ic">Отлично, жду!</button>
			</div>
		</div>
	</div>
</div>
<div class="modal modal-callback modal-thanks mfp-hide" id="modal-consult-thanks">
	<div class="modal-callback__inner">
		<div class="modal-callback__img" style="background-image: url('/local/templates/fsk/img/img-callback-girl.jpg')">
		</div>
		<div class="modal-callback__col">
			<div class="modal-success__inner">
				<div class="modal-success__img">
 <img alt="alt" src="/local/templates/fsk/img/icons/ic-success.svg" class="img">
				</div>
				<div class="h2 modal-success__title">
					 Спасибо за Вашу заявку!
				</div>
				<p>
					 Наш специалист свяжется с вами в&nbsp;ближайшее время.
				</p>
 <button class="btn btn--border success-btn mfp-close" type="button"><img width="12" alt="ic" src="/local/templates/fsk/img/icons/ic-tel.svg" height="20" class="svg svg-stroke btn__ic">Отлично, жду!</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" async src="//smartcallback.ru/api/SmartCallBack.js?t=Fr9lXI3PcKIGGYKZlcyj" charset="utf-8"></script>
      <!-- /.footer-->
    <!-- /.wrapper-->
