<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "Ипотека с ФСК");
$APPLICATION->SetPageProperty("description", "Ипотека с ФСК");
$APPLICATION->SetPageProperty("TITLE", "Ипотека с ФСК");
$APPLICATION->SetTitle("Ипотека с ФСК");
?><div class="page page--nohero">
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
		<p>
 <img width="100%" alt="Ipo_head.png" src="https://fsknw.ru/upload/iblock/61f/61fa104f137503f9d83bf68c7db6cb98.jpg" title="Ipo_head.png" align="middle"><br>
		</p>
		<p>
			 Покупка недвижимости от ГК «ФСК» с использованием ипотечного кредита – это удобно, быстро и выгодно. Ипотечный консультант подберет программы, подходящие именно вам, заполнит все необходимые анкеты, проведет переговоры с сотрудниками банков и будет сопровождать вас на всех этапах сделки. Для наших клиентов действуют специальные выгодные условия кредитования.
		</p>
		<ul class="ipo-adv flex">
			<li class="ipo-adv__item">
			<div class="ipo-adv__img">
 <img width="52" alt="alt" src="/local/templates/fsk/img/ipo/ic-electronic.svg" height="44" class="img">
			</div>
 <span class="ipo-adv__txt">Электронная регистрация сделки</span> </li>
			<li class="ipo-adv__item">
			<div class="ipo-adv__img">
 <img width="35" alt="alt" src="/local/templates/fsk/img/ipo/ic-calendar.svg" height="43" class="img">
			</div>
 <span class="ipo-adv__txt">Решение банка <span class="nowrap">за 1-2 дня</span></span> </li>
			<li class="ipo-adv__item">
			<div class="ipo-adv__img">
 <img width="35" alt="alt" src="/local/templates/fsk/img/ipo/ic-file-text.svg" height="44" class="img">
			</div>
 <span class="ipo-adv__txt">Единая анкета <span class="nowrap">для всех банков</span></span> </li>
			<li class="ipo-adv__item">
			<div class="ipo-adv__img">
 <img width="44" alt="alt" src="/local/templates/fsk/img/ipo/ic-percentage.svg" height="44" class="img">
			</div>
 <span class="ipo-adv__txt">Процентная ставка <span class="nowrap">от 0.01%</span></span> </li>
		</ul>
		 <!-- /.ipo-adv-->
		<div class="ipo">
			<div class="ipo-calc">
				<div class="filter-row">
					<div class="filter-fields">
						<div class="filter__field filter-field" data-name="credit">
							<div class="filter-field__label">
								 Стоимость, р.
							</div>
							<div class="ui-quantity" data-step="100000">
 <button class="ui-quantity__btn ui-quantity__minus" data-event="mortgageFilter"><img width="10" src="/local/templates/fsk/img/icons/ic-minus.svg" height="2" class="svg" alt="Минус"></button> <input type="text" value="2 500 000"> <button class="ui-quantity__btn ui-quantity__plus" data-event="mortgageFilter"><img width="10" src="/local/templates/fsk/img/icons/ic-plus.svg" height="10" class="svg" alt="Плюс"></button>
							</div>
						</div>
						<div class="filter__field filter-field" data-name="first">
							<div class="filter-field__label">
								 Первоначальный взнос
							</div>
							<div class="ui-quantity" data-step="100000">
 <button class="ui-quantity__btn ui-quantity__minus" data-event="mortgageFilter"><img width="10" src="/local/templates/fsk/img/icons/ic-minus.svg" height="2" class="svg" alt="Минус"></button> <input type="text" value="1 500 000"> <button class="ui-quantity__btn ui-quantity__plus" data-event="mortgageFilter"><img width="10" src="/local/templates/fsk/img/icons/ic-plus.svg" height="10" class="svg" alt="Плюс"></button>
							</div>
						</div>
						<div class="filter__field filter-field" data-name="age">
							<div class="filter-field__label">
								 Срок, лет
							</div>
							<div class="ui-quantity ui-quantity--years" data-step="1">
 <button class="ui-quantity__btn ui-quantity__minus" data-event="mortgageFilter"> <img width="10" src="/local/templates/fsk/img/icons/ic-minus.svg" height="2" class="svg" alt="Минус"></button> <input class="years" type="text" value="10"> <button class="ui-quantity__btn ui-quantity__plus" data-event="mortgageFilter"> <img width="10" src="/local/templates/fsk/img/icons/ic-plus.svg" height="10" class="svg" alt="Плюс"> </button>
							</div>
						</div>
						<div class="filter__field filter-field-result">
 <button class="btn btn--bg" type="button" data-event="mortgageFilter"><img width="20" src="/local/templates/fsk/img/icons/ic-btn-percentage.svg" height="20" class="svg btn__ic" alt="Минус">Рассчитать платеж</button>
						</div>
					</div>
				</div>
			</div>
			 <?//НЕ удалять
                /*
                <!-- /.ipo-calc-->
                */?> <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"mortgage",
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
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array("",""),
		"FILE_404" => "",
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "11",
		"IBLOCK_TYPE" => "kompleks",
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
		"PROPERTY_CODE" => array("UF_BIK","UF_DATE","UF_NAME","UF_NUMBER","UF_VALUE",""),
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
);?> <!-- /.ipo-table-->
		</div>
		 <!-- /.ipo-->
		<div class="ipo-more show-more-ipoteka">
 <button class="btn btn--transp" type="button" data-event="showMoreIpoteka"> <img width="20" alt="link" src="/local/templates/fsk/img/icons/ic-arrow.svg" height="20" class="svg btn__ic ic-arrow ic-arrow--down">
			Показать ещё </button>
		</div>
	</div>
	<div class="container" id="matcapital">
		<div class="content">
			<h2 class="title title-margin">Материнский капитал</h2>
 <img alt="Материнский капитал" src="/local/templates/fsk/img/img-ipo-1.jpg" class="img ipo-block__img">
			<p>
 <br>
				 Во проектах ГК «ФСК» вы можете использовать материнский капитал для приобретения недвижимости в комплексах в разных районах города.
			</p>
			<div class="h3 text-bold">
				 Материнский капитал выплачивается:<br>
			</div>
			<ul class="list">
				<li>при рождении второго ребенка в размере 616 617 руб.*<br>
 </li>
				<li>при рождении первого ребенка в размере 466 617 руб.*</li>
			</ul>
 <i>*для семей, где дети родились после 1 января 2020 года.</i>
			<ul>
			</ul>
			<div class="h3 text-bold">
				 Кто имеет использовать материнский капитал для приобретения квартиры:<br>
			</div>
			<ul class="list">
				<li>Мать или отец ребенка, на имя которого выдан сертификат.<br>
 </li>
			</ul>
			<ul>
			</ul>
			<div class="h3 text-bold">
				 Как можно использовать материнский капитал:<br>
			</div>
			<ul class="list">
				<li>Как часть оплаты недвижимости<br>
 </li>
				<li>Для погашения ипотечного кредита</li>
				<li>В качестве первого взноса для ипотечного кредита (при условии покрытия не менее 20% стоимости квартиры)</li>
			</ul>
			<ul>
			</ul>
			<div class="h3 text-bold">
				 Какие документы требуются для получения сертификата:
			</div>
			<ul class="list">
				<li>Паспорт гражданина РФ;<br>
 </li>
				<li>Свидетельства о рождении ребенка/детей (для усыновлённых — свидетельства об усыновлении);</li>
				<li>Документы, подтверждающие российское гражданство ребенка/детей</li>
			</ul>
		</div>
	</div>
	 <!-- /.container--> <!-- form--> <?$APPLICATION->IncludeComponent(
	"slam:easyform",
	"mainForm",
	Array(
		"CATEGORY_CUR_PAGE_CLASS" => "general-itemInput",
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
		"CATEGORY_USER_ID_CLASS" => "general-itemInput",
		"CATEGORY_USER_ID_TITLE" => "USER_ID",
		"CATEGORY_USER_ID_TYPE" => "hidden",
		"CATEGORY_USER_ID_VALUE" => $_SERVER["REMOTE_ADDR"],
		"CLEAR_FORM" => "N",
		"COMPONENT_TEMPLATE" => "mainForm",
		"CREATE_SEND_MAIL" => "",
		"DISPLAY_FIELDS" => array(0=>"TITLE",1=>"PHONE",2=>"CUR_PAGE",3=>"USER_ID",4=>"",),
		"EMAIL_BCC" => "",
		"EMAIL_FILE" => "N",
		"EMAIL_TO" => "",
		"ENABLE_SEND_MAIL" => "Y",
		"ERROR_TEXT" => "Произошла ошибка. Сообщение не отправлено.",
		"EVENT_MESSAGE_ID" => array(0=>"49",),
		"FIELDS_ORDER" => "TITLE,PHONE,CUR_PAGE,USER_ID",
		"FORM_AUTOCOMPLETE" => "Y",
		"FORM_ID" => "FORM4",
		"FORM_NAME" => "Нужна консультация специалиста?",
		"FORM_SUBMIT_VALUE" => "Позвоните мне",
		"FORM_SUBMIT_VARNING" => "Отправляя форму, вы подтверждаете своё согласие на <a href=\"/privacy-policy/\" target=\"_blank\">обработку персональных данных</a>",
		"HIDE_ASTERISK" => "Y",
		"HIDE_FIELD_NAME" => "Y",
		"MAIL_SUBJECT_ADMIN" => "#SITE_NAME#: Сообщение из формы обратной связи",
		"OK_TEXT" => "Ваше сообщение отправлено. Мы свяжемся с вами в течение 2х часов",
		"REQUIRED_FIELDS" => array(0=>"PHONE",),
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
);?> <!-- /.form-->
	<div class="container" id="voen">
		<div class="content">
			<h2 class="title title-margin">Военная ипотека</h2>
			<div class="ipo-block">
 <img alt="Военная ипотека" src="/local/templates/fsk/img/img-ipo-2.jpg" class="img ipo-block__img">
				<div class="ipo-block__content">
					<p>
						 Военная ипотека позволяет приобрести квартиру участникам накопительно-ипотечной системы жилищного обеспечения военнослужащих в проектах ГК ФСК.
					</p>
					<div class="h3 text-bold">
						 Документы для получения военной ипотеки:
					</div>
					<ul class="content-list">
						<li>
						<div class="content-list__img">
 <img width="31" alt="alt" src="/local/templates/fsk/img/ipo/ic-file-text-2.svg" height="38" class="img">
						</div>
 <span class="content-list__txt">Свид-во участника программы НИС</span> </li>
						<li>
						<div class="content-list__img">
 <img width="32" alt="alt" src="/local/templates/fsk/img/ipo/ic-file-text-3.svg" height="40" class="img">
						</div>
 <span class="content-list__txt">Российский паспорт</span> </li>
						<li>
						<div class="content-list__img">
 <img width="31" alt="alt" src="/local/templates/fsk/img/ipo/ic-file-text-4.svg" height="40" class="img">
						</div>
 <span class="content-list__txt">Заполненная анкета</span> </li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	 <!-- /.container-->
</div>
 <!-- /.page--><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>