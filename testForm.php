<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?>



<?$APPLICATION->IncludeComponent(
	"slam:easyform", 
	".default", 
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
		"CATEGORY_PHONE_PLACEHOLDER" => "",
		"CATEGORY_PHONE_TITLE" => "Мобильный телефон",
		"CATEGORY_PHONE_TYPE" => "tel",
		"CATEGORY_PHONE_VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY_PHONE_VALUE" => "",
		"CATEGORY_TITLE_PLACEHOLDER" => "",
		"CATEGORY_TITLE_TITLE" => "Ваше имя",
		"CATEGORY_TITLE_TYPE" => "text",
		"CATEGORY_TITLE_VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY_TITLE_VALUE" => "",
		"CREATE_SEND_MAIL" => "",
		"DISPLAY_FIELDS" => array(
			0 => "TITLE",
			1 => "EMAIL",
			2 => "PHONE",
			3 => "MESSAGE",
			4 => "USER_IP",
			5 => "",
		),
		"EMAIL_BCC" => "",
		"EMAIL_FILE" => "N",
		"EMAIL_TO" => "",
		"ENABLE_SEND_MAIL" => "Y",
		"ERROR_TEXT" => "Произошла ошибка. Сообщение не отправлено.",
		"EVENT_MESSAGE_ID" => array(
			0 => "60",
		),
		"FIELDS_ORDER" => "TITLE,EMAIL,PHONE,MESSAGE,USER_IP",
		"FORM_AUTOCOMPLETE" => "Y",
		"FORM_ID" => "FORM5",
		"FORM_NAME" => "Форма обратной связи 7",
		"FORM_SUBMIT_VALUE" => "Отправить",
		"FORM_SUBMIT_VARNING" => "Нажимая на кнопку \"#BUTTON#\", вы даете согласие на обработку <a target=\"_blank\" href=\"#\">персональных данных</a>",
		"HIDE_ASTERISK" => "N",
		"HIDE_FIELD_NAME" => "N",
		"HIDE_FORMVALIDATION_TEXT" => "N",
		"INCLUDE_BOOTSRAP_JS" => "Y",
		"MAIL_SUBJECT_ADMIN" => "#SITE_NAME#: Сообщение из формы обратной связи",
		"OK_TEXT" => "Ваше сообщение отправлено. Мы свяжемся с вами в течение 2х часов",
		"REQUIRED_FIELDS" => array(
			0 => "EMAIL",
			1 => "PHONE",
		),
		"SEND_AJAX" => "Y",
		"SHOW_MODAL" => "N",
		"TITLE_SHOW_MODAL" => "Спасибо!",
		"USE_BOOTSRAP_CSS" => "Y",
		"USE_BOOTSRAP_JS" => "N",
		"USE_CAPTCHA" => "N",
		"USE_FORMVALIDATION_JS" => "Y",
		"USE_IBLOCK_WRITE" => "N",
		"USE_JQUERY" => "N",
		"USE_MODULE_VARNING" => "Y",
		"WIDTH_FORM" => "500px",
		"_CALLBACKS" => "",
		"COMPONENT_TEMPLATE" => ".default",
		"CLEAR_FORM" => "N",
		"EMAIL_SEND_FROM" => "N",
		"CATEGORY_TITLE_CLASS" => "general-itemInput",
		"CATEGORY_EMAIL_CLASS" => "general-itemInput",
		"CATEGORY_PHONE_CLASS" => "general-itemInput",
		"CATEGORY_MESSAGE_CLASS" => "general-itemInput",
		"CATEGORY_USER_IP_TITLE" => "USER_IP",
		"CATEGORY_USER_IP_TYPE" => "hidden",
		"CATEGORY_USER_IP_CLASS" => "general-itemInput",
		"CATEGORY_USER_IP_VALUE" => $_SERVER["REMOTE_ADDR"],
		"CATEGORY_PHONE_VALIDATION_MESSAGE" => "Обязательное поле"
	),
	false
);?>



<?
/*global   $USER ;

$rsUser = CUser::GetByID(7);
$arUser = $rsUser->Fetch();
echo "<pre>"; print_r($arUser); echo "</pre>";

$USER ->Authorize(7);*/
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>