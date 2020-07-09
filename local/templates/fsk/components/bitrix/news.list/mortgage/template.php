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
$this->setFrameMode(true);
?><?if(!empty($arResult["ITEMS"])){?>
<div class="ipo-table">
    <div class="ipo-table__row ipo-table__header">
        <div class="ipo-bank">Банк</div>
        <div class="ipo-info">
            <div class="ipo-info__col">
                <span class="hide-on-mob">Ежемес. </span>платёж, от
            </div>
            <div class="ipo-info__col">Срок</div>
            <div class="ipo-info__col">Ставка, от</div>
        </div>
    </div><?
    /*
    foreach($arResult["ITEMS"] as $arItem){
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="ipo-table__row ipo-table__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="ipo-bank">
                <img class="img lazyload" data-src="<?=CFile::GetPath($arItem['PROPERTIES']['UF_IMAGE']['VALUE'])?>" title="<?=$arItem['PROPERTIES']['UF_NAME']['VALUE']?>" alt="<?=$arItem['PROPERTIES']['UF_NAME']['VALUE']?>">
            </div>
            <div class="ipo-licence">
                <div><?=$arItem['PROPERTIES']['UF_NAME']['VALUE']?></div>
                <span class="sub-text">Лицензия № <?=$arItem['PROPERTIES']['UF_NUMBER']['VALUE']?> от <?=$arItem['PROPERTIES']['UF_DATE']['VALUE']?></span>
            </div>
            <div class="ipo-info">
                <div class="ipo-info__col" data-title="Ежемес. платёж, от">49 982 р.</div>
                <div class="ipo-info__col" data-title="Срок">до 30 лет</div>
                <div class="ipo-info__col" data-title="Ставка"><?=$arItem['PROPERTIES']['UF_VALUE']['VALUE']?>%</div>
            </div>
        </div>
        <?
    }*/
?></div>
<?}else{?>
<div class="results-empty">Ипотек с подходящими характеристиками не найдено.</div>
<?}?>
<?$APPLICATION->IncludeComponent(
    "slam:easyform",
    "mortgage",
    Array(
        "CATEGORY_BANK_NAME_CLASS" => "",
        "CATEGORY_BANK_NAME_PLACEHOLDER" => "",
        "CATEGORY_BANK_NAME_TITLE" => "Банк",
        "CATEGORY_BANK_NAME_TYPE" => "hidden",
        "CATEGORY_BANK_NAME_VALUE" => "",
        "CATEGORY_CUR_PAGE_CLASS" => "",
        "CATEGORY_CUR_PAGE_TITLE" => "Страница обращения:",
        "CATEGORY_CUR_PAGE_TYPE" => "hidden",
        "CATEGORY_CUR_PAGE_VALUE" => (@($_SERVER["HTTPS"]!="on")?"http://".$_SERVER["SERVER_NAME"]:"https://".$_SERVER["SERVER_NAME"]).($_SERVER["SERVER_PORT"]!=80?":".$_SERVER["SERVER_PORT"]:"").$_SERVER["REQUEST_URI"],
        "CATEGORY_PAYMENT_CLASS" => "",
        "CATEGORY_PAYMENT_PLACEHOLDER" => "",
        "CATEGORY_PAYMENT_TITLE" => "Ежемесячный платеж",
        "CATEGORY_PAYMENT_TYPE" => "hidden",
        "CATEGORY_PAYMENT_VALUE" => "",
        "CATEGORY_PHONE_CLASS" => "col-1-3",
        "CATEGORY_PHONE_INPUTMASK" => "N",
        "CATEGORY_PHONE_INPUTMASK_TEMP" => "+7 (999) 999-9999",
        "CATEGORY_PHONE_PLACEHOLDER" => "Номер телефона",
        "CATEGORY_PHONE_TITLE" => "Телефон:",
        "CATEGORY_PHONE_TYPE" => "tel",
        "CATEGORY_PHONE_VALUE" => "",
        "CATEGORY_RATE_CLASS" => "",
        "CATEGORY_RATE_PLACEHOLDER" => "",
        "CATEGORY_RATE_TITLE" => "Ставка",
        "CATEGORY_RATE_TYPE" => "hidden",
        "CATEGORY_RATE_VALUE" => "",
        "CATEGORY_TERM_CLASS" => "",
        "CATEGORY_TERM_PLACEHOLDER" => "",
        "CATEGORY_TERM_TITLE" => "Срок",
        "CATEGORY_TERM_TYPE" => "hidden",
        "CATEGORY_TERM_VALUE" => "",
        "CATEGORY_TITLE_CLASS" => "",
        "CATEGORY_TITLE_PLACEHOLDER" => "Ваше имя",
        "CATEGORY_TITLE_TITLE" => "Имя клиента:",
        "CATEGORY_TITLE_TYPE" => "text",
        "CATEGORY_TITLE_VALUE" => "",
        "CLEAR_FORM" => "N",
        "CREATE_SEND_MAIL" => "",
        "DISPLAY_FIELDS" => array("TITLE","PHONE","CUR_PAGE","BANK_NAME","RATE","TERM","PAYMENT",""),
        "EMAIL_BCC" => "",
        "EMAIL_FILE" => "N",
        "EMAIL_TO" => "",
        "ENABLE_SEND_MAIL" => "Y",
        "ERROR_TEXT" => "Произошла ошибка. Сообщение не отправлено.",
        "EVENT_MESSAGE_ID" => array("48"),
        "FIELDS_ORDER" => "TITLE,PHONE,CUR_PAGE,BANK_NAME,RATE,TERM,PAYMENT",
        "FORM_AUTOCOMPLETE" => "Y",
        "FORM_ID" => "ipo",
        "FORM_NAME" => "Подать заявку<br>на ипотеку - просто!",
        "FORM_SUBMIT_VALUE" => "Позвоните мне",
        "FORM_SUBMIT_VARNING" => "Отправляя форму, вы подтверждаете своё согласие на <a href=\"/privacy-policy/\" target=\"_blank\">обработку персональных данных</a>",
        "HIDE_ASTERISK" => "Y",
        "HIDE_FIELD_NAME" => "Y",
        "MAIL_SUBJECT_ADMIN" => "#SITE_NAME#: Сообщение из формы обратной связи",
        "OK_TEXT" => "Ваше сообщение отправлено. Мы свяжемся с вами в течение 2х часов",
        "REQUIRED_FIELDS" => array("PHONE"),
        "SEND_AJAX" => "Y",
        "SHOW_MODAL" => "Y",
        "USE_BOOTSRAP_CSS" => "N",
        "USE_BOOTSRAP_JS" => "N",
        "USE_CAPTCHA" => "N",
        "USE_FORMVALIDATION_JS" => "N",
        "USE_IBLOCK_WRITE" => "N",
        "USE_JQUERY" => "N",
        "USE_MODULE_VARNING" => "N",
        "WIDTH_FORM" => "",
        "_CALLBACKS" => "success"
    )
);?>
<div class="modal modal-success mfp-hide" id="modal-ipo-success">
    <div class="modal-success__inner">
        <div class="modal-success__img">
            <img alt="alt" data-src="/local/templates/fsk/img/icons/ic-success.svg" class="img lazyload">
        </div>
        <div class="h2 modal-success__title">
            Спасибо за Вашу заявку!
        </div>
        <p>
            Наш специалист свяжется с вами в&nbsp;ближайшее время и ответит на все интересующие вас вопросы.
        </p>
        <button class="btn btn--border success-btn mfp-close" type="button"><img width="12" alt="ic" data-src="/local/templates/fsk/img/icons/ic-tel.svg" height="20" class="svg svg-stroke btn__ic lazyload">Отлично, жду!</button>
    </div>
</div>

