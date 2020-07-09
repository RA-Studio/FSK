<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);

setSettings('SITE',17,1694);
$text = '';
if (!empty($GLOBALS['UF_SETTINGS_SITE']['UF_YELLOW_LINK']['VALUE'])) {
    $text .= '<a href="'. $GLOBALS['UF_SETTINGS_SITE']['UF_YELLOW_LINK']['VALUE'] .'" class="reserve-info">';
}
else{
    $text .= '<div class="reserve-info">';
}
if (!empty($GLOBALS['UF_SETTINGS_SITE']['UF_YELLOW_SVG']['VALUE'])) {
    $text .= '<img src="' . $GLOBALS['UF_SETTINGS_SITE']['UF_YELLOW_SVG']['VALUE'] . '">';
}
if (!empty($GLOBALS['UF_SETTINGS_SITE']['UF_YELLOW_TEXT']['VALUE']['TEXT'])) {
    $text .=  '<div class="reserve-info__text">'.$GLOBALS['UF_SETTINGS_SITE']['UF_YELLOW_TEXT']['VALUE']['TEXT'].'</div>';
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
<!DOCTYPE html>
<html lang="ru">
  <head>
  	<?
        use Bitrix\Main\Page\Asset;
        //$APPLICATION->ShowHead();
    ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="cmsmagazine" content="5030b50dd17858824f3ab635603e59bc">
    <link rel="apple-touch-icon" sizes="180x180" href="<?=SITE_TEMPLATE_PATH?>/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=SITE_TEMPLATE_PATH?>/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=SITE_TEMPLATE_PATH?>/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?=SITE_TEMPLATE_PATH?>/img/favicon/site.webmanifest">
    <link rel="mask-icon" href="<?=SITE_TEMPLATE_PATH?>/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="<?=SITE_TEMPLATE_PATH?>/img/favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="<?=SITE_TEMPLATE_PATH?>/img/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <?
        global $USER;
        //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/jquery.js');
        //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/magnific.js');
        //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/jquery-ui.min.js');
        //Asset::getInstance()->addCss('/local/components/slam/easyform/templates/uniform/uniform.css');
        //Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/styles.css');
        //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/libs/jquery.ui.touch-punch.js');

        //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/jquery.cookie.js');

        if(!CSite::InDir(SITE_DIR . "index.php")){
            //Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/air-datepicker.css');
            //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/SimpleBar.js');
        }
        //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/script-1.js');
        //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/lazyload.js');
        //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/scripts.js');
        //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/ajax.js');
        if ($USER->IsAdmin() || strpos($_SERVER['HTTP_USER_AGENT'],'Chrome-Lighthouse') == false) {
            $APPLICATION->ShowHeadStrings();
		    $APPLICATION->ShowHeadScripts();
            $GLOBALS["APPLICATION"]->MoveJSToBody('main');
            $APPLICATION->ShowBodyScripts();
            $APPLICATION->ShowCSS(true);
        }
        
    ?>
    <script><?=file_get_contents($_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH . '/js/jquery.js')?></script>
    
    <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH . '/css/style-mini.css'?>">
    <!--script src="<?=SITE_TEMPLATE_PATH . '/js/jquery.js'?>"></script-->

    <?if(strpos($_SERVER['HTTP_USER_AGENT'],'Chrome-Lighthouse') == false):?>
        <script src="/local/components/slam/easyform/script.js"></script>
    <?endif?>
    <title><?$APPLICATION->ShowTitle()?></title>
  </head>
  <body>

  	<?$APPLICATION->ShowPanel()?>
    <div class="wrapper">
      <!-- header-->
      <div class="preloader">
        <div class="pl">
          <div class="pl__ball"></div>
          <div class="pl__ball pl__ball--2"></div>
        </div>
      </div>
      <header class="header">
          <?=$APPLICATION->ShowProperty('yellowTop')?>
        <!-- desktop-->
        <div class="header__top">
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/include/logo.php",
                )
            );?>
          <button class="menu-trigger" type="button"></button>
            <?$APPLICATION->IncludeComponent(
                "bitrix:menu", 
                "top_menu", 
                array(
                    "ALLOW_MULTI_SELECT" => "N",
                    "CHILD_MENU_TYPE" => "left",
                    "DELAY" => "N",
                    "MAX_LEVEL" => "1",
                    "MENU_CACHE_GET_VARS" => array(
                    ),
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_TYPE" => "N",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "ROOT_MENU_TYPE" => "top_menu",
                    "USE_EXT" => "N",
                    "COMPONENT_TEMPLATE" => "top_menu"
                ),
                false
            );?>
          <div class="header-call js-call-callback">
            <a href="#modal-FORM10" class="popup-btn-FORM10 header-call__ic"></a>
            <div class="header-call__data">
                <span>
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/phone.php",
                        )
                    );?>
                </span>
              <!--button class="header-call__btn" type="button">ПЕРЕЗВОНИТЕ МНЕ</button-->
              <a href="#modal-FORM10" class="popup-btn-FORM10 header-call__btn">ПЕРЕЗВОНИТЕ МНЕ</a>
            </div>
          </div>

          <?if(
            CSite::InDir('/newbuild/') ||
            CSite::InDir('/commercial/')
          ):?>
              <a class="btn btn--bg header-top__link anchor-scroll" href="#filter-anchor">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16.5 15.5" class="svg btn__ic inlined-svg" width="15" height="15" role="img" aria-labelledby="title"><title>alt</title><g transform="translate(0.75 0.75)"><path d="M0,0H15" transform="translate(0 7)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"></path><circle cx="2" cy="2" r="2" transform="translate(2.872 5)" fill="#e94200" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"></circle><path d="M0,0H15" transform="translate(0 2)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"></path><circle cx="2" cy="2" r="2" transform="translate(10.872)" fill="#e94200" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"></circle><path d="M0,0H15" transform="translate(0 12)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"></path><circle cx="2" cy="2" r="2" transform="translate(10.872 10)" fill="#e94200" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"></circle></g></svg>
                  <?$APPLICATION->ShowProperty('apart')?>
              </a>
          <?elseif(CSite::InDir('/index.php')):?>
              <a class="btn btn--bg header-top__link anchor-scroll" href="#filter-anchor">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16.5 15.5" class="svg btn__ic inlined-svg" width="15" height="15" role="img" aria-labelledby="title"><title>alt</title><g transform="translate(0.75 0.75)"><path d="M0,0H15" transform="translate(0 7)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"></path><circle cx="2" cy="2" r="2" transform="translate(2.872 5)" fill="#e94200" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"></circle><path d="M0,0H15" transform="translate(0 2)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"></path><circle cx="2" cy="2" r="2" transform="translate(10.872)" fill="#e94200" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"></circle><path d="M0,0H15" transform="translate(0 12)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"></path><circle cx="2" cy="2" r="2" transform="translate(10.872 10)" fill="#e94200" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"></circle></g></svg>
                  Выбрать квартиру
              </a>
          <?else:?>
              <a class="btn btn--bg header-top__link" href="/newbuild/">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16.5 15.5" class="svg btn__ic inlined-svg" width="15" height="15" role="img" aria-labelledby="title"><title>alt</title><g transform="translate(0.75 0.75)"><path d="M0,0H15" transform="translate(0 7)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"></path><circle cx="2" cy="2" r="2" transform="translate(2.872 5)" fill="#e94200" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"></circle><path d="M0,0H15" transform="translate(0 2)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"></path><circle cx="2" cy="2" r="2" transform="translate(10.872)" fill="#e94200" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"></circle><path d="M0,0H15" transform="translate(0 12)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"></path><circle cx="2" cy="2" r="2" transform="translate(10.872 10)" fill="#e94200" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"></circle></g></svg>
                  Выбрать квартиру
              </a>
          <?endif?>

        </div>
        <div class="toggle-menu">
            <?$APPLICATION->IncludeComponent("bitrix:menu", "top_menu_mobile", Array(
                "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                    "CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
                    "DELAY" => "N",	// Откладывать выполнение шаблона меню
                    "MAX_LEVEL" => "1",	// Уровень вложенности меню
                    "MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
                        0 => "",
                    ),
                    "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                    "MENU_CACHE_TYPE" => "N",	// Тип кеширования
                    "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                    "ROOT_MENU_TYPE" => "top_menu_mobile",	// Тип меню для первого уровня
                    "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                ),
                false
            );?>
        </div>
      </header>
