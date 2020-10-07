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
	<meta name="cmsmagazine" content="5030b50dd17858824f3ab635603e59bc" />
    <meta name="theme-color" content="#ffffff">
    <?if(!$USER->IsAdmin() && strpos($_SERVER['HTTP_USER_AGENT'],'Chrome-Lighthouse') == false):?>
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-WG2C29K');</script>
        <!-- End Google Tag Manager -->
    <?endif?>
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
    <?if(OPEN_SHOP):?>
    <style>
        .btn-login {
            background: #e94200;
            width: 40px;
            height: 40px;
            border-radius: 2em;
            padding: 5px;
            margin-right: 10px;
            cursor: pointer;
        }
        .none {
            display: none !important;
        }
        .black-sheet {
            position: absolute;
            background: #00000073;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 210;
        }
        .auth-block {
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%,-50%);
            z-index: 220;
        }

        .auth .tab-line {
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.3em;
            padding: 40px 50px 0px 50px;
        }
        .auth-block-content {
            padding-top: 0px;
        }
        .auth .tab-line span{
            cursor: pointer;
            padding: 0px 10px;
        }
        .auth .tab-line .active{
            color: #e94200;
        }
        .auth .auth-block .auth-block-content input.error {
            border: 1px solid red;
        }
        .auth .auth-block .close-btm {
            width: 20px;
            height: 20px;
            position: absolute;
            right: 15px;
            top: 15px;
            cursor: pointer;
        }
        .auth .auth-block .close-btm svg {
            width: 100%;
            height: 100%;
        }

        .auth .auth-block .close-btm svg:hover {
            width: 100%;
            height: 100%;
            fill: #e94200;
        }
    </style>
    <?=file_get_contents($_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH . '/include/authform.php')?>
    <?endif?>
    <script><?=file_get_contents($_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH . '/js/jquery.js')?></script>
    <?if(OPEN_SHOP === false):?>
        <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH . '/css/style-mini.css'?>">
    <?else:?>
        <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH . '/css/stylesnew.css'?>">
    <?endif?>

    <!-- calltouch -->
    <script type="text/javascript">
        (function(w,d,n,c){w.CalltouchDataObject=n;w[n]=function(){w[n]["callbacks"].push(arguments)};if(!w[n]["callbacks"]){w[n]["callbacks"]=[]}w[n]["loaded"]=false;if(typeof c!=="object"){c=[c]}w[n]["counters"]=c;for(var i=0;i<c.length;i+=1){p(c[i])}function p(cId){var a=d.getElementsByTagName("script")[0],s=d.createElement("script"),i=function(){a.parentNode.insertBefore(s,a)};s.type="text/javascript";s.async=true;s.src="https://mod.calltouch.ru/init.js?id="+cId;if(w.opera=="[object Opera]"){d.addEventListener("DOMContentLoaded",i,false)}else{i()}}})(window,document,"ct","2f2ec1fn");
    </script>
    <!-- calltouch -->
    
    <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH . '/assets/build/main.css'?>">
    <!--script src="<?=SITE_TEMPLATE_PATH . '/js/jquery.js'?>"></script-->

    <?if(strpos($_SERVER['HTTP_USER_AGENT'],'Chrome-Lighthouse') == false):?>
        <script src="/local/components/slam/easyform/script.js"></script>
    <?endif?>
    <script><?=file_get_contents($_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH . '/js/helper.js')?></script>
    <title><?$APPLICATION->ShowTitle()?></title>
    <?if(!in_array($_SERVER['REMOTE_ADDR'],['46.28.228.22']) && strpos($_SERVER['HTTP_USER_AGENT'],'Chrome-Lighthouse') == false):?>
        <script type="text/javascript">
            var __cs = __cs || [];
            __cs.push(["setCsAccount", "TCdqgdKk41PTkqYykKODPrcsrqM_2dHV"]);
        </script>
        <!--script type="text/javascript" async src="https://app.comagic.ru/static/cs.min.js"></script-->
    <?endif?>
</head>
<body>
<?if(!in_array($_SERVER['REMOTE_ADDR'],['46.28.228.22']) && strpos($_SERVER['HTTP_USER_AGENT'],'Chrome-Lighthouse') == false):?>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WG2C29K" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
<?endif?>
<?$APPLICATION->ShowPanel()?>
<div class="wrapper">
    <!-- header-->
    <div class="preloader">
        <div class="pl">
            <div class="pl__ball"></div>
            <div class="pl__ball pl__ball--2"></div>
        </div>
    </div>
    <header class="header <?if(CSite::InDir('/lk/')){echo 'header-lk';}?>">
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
            <ul class="main-menu">
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
                        "MENU_CACHE_TYPE" => "Y",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "ROOT_MENU_TYPE" => "top_menu",
                        "USE_EXT" => "N",
                        "COMPONENT_TEMPLATE" => "top_menu"
                    ),
                    false
                );?>
                <li>
                    <a class="link-favourite" href="/favourite/">
                        <!--span class="dashed-underline">Избранное</span-->
                        <svg class="svg" xmlns="http://www.w3.org/2000/svg" width="22.712" height="21.673" viewBox="0 0 22.712 21.673"><path d="M10.606,0l3.277,6.64,7.329,1.071-5.3,5.165,1.252,7.3-6.555-3.447L4.052,20.173l1.252-7.3L0,7.711,7.329,6.64,10.606,0Z" transform="translate(0.75 0.75)" fill="none" stroke="#e94200" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/></svg>
                    </a>
                </li>
                <li style="margin-left: 22px;">
                    <a class="link-favourite link-lk login-modal-open" href="/lk/">
                        <!--span class="dashed-underline">Кабинет</span-->
                        <svg class="svg" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.9203 11.8542C10.9431 11.8542 10.9658 11.8542 10.9932 11.8542C11.0023 11.8542 11.0114 11.8542 11.0205 11.8542C11.0342 11.8542 11.0524 11.8542 11.0661 11.8542C12.4009 11.8314 13.4807 11.3622 14.2779 10.4647C16.0319 8.48747 15.7403 5.09795 15.7084 4.77449C15.5945 2.34624 14.4465 1.18451 13.4989 0.642369C12.7927 0.236902 11.9681 0.0182232 11.0478 0H11.016C11.0114 0 11.0023 0 10.9977 0H10.9704C10.4647 0 9.47153 0.0820046 8.51937 0.624146C7.56265 1.16629 6.39636 2.32802 6.28246 4.77449C6.25057 5.09795 5.959 8.48747 7.71299 10.4647C8.5057 11.3622 9.58543 11.8314 10.9203 11.8542ZM7.49887 4.88838C7.49887 4.87472 7.50342 4.86105 7.50342 4.85194C7.65376 1.58542 9.97267 1.23462 10.9658 1.23462H10.9841C10.9932 1.23462 11.0068 1.23462 11.0205 1.23462C12.2506 1.26196 14.3417 1.7631 14.4829 4.85194C14.4829 4.8656 14.4829 4.87927 14.4875 4.88838C14.492 4.92027 14.8109 8.01822 13.3622 9.6492C12.7882 10.2961 12.0228 10.615 11.016 10.6241C11.0068 10.6241 11.0023 10.6241 10.9932 10.6241C10.9841 10.6241 10.9795 10.6241 10.9704 10.6241C9.96812 10.615 9.19818 10.2961 8.62871 9.6492C7.18451 8.02734 7.49431 4.91572 7.49887 4.88838Z" fill="#E94200"/>
                            <path d="M20.3553 17.4761C20.3553 17.4715 20.3553 17.467 20.3553 17.4624C20.3553 17.426 20.3508 17.3895 20.3508 17.3485C20.3235 16.4465 20.2642 14.3371 18.287 13.6629C18.2733 13.6583 18.2551 13.6538 18.2415 13.6492C16.1868 13.1253 14.4784 11.9408 14.4601 11.9271C14.1822 11.7312 13.7995 11.7995 13.6036 12.0775C13.4077 12.3554 13.4761 12.738 13.754 12.9339C13.8314 12.9886 15.6446 14.2506 17.9134 14.8337C18.9749 15.2119 19.0934 16.3463 19.1253 17.385C19.1253 17.426 19.1253 17.4624 19.1298 17.4989C19.1344 17.9089 19.1071 18.5422 19.0342 18.9066C18.2961 19.3258 15.4032 20.7745 11.0023 20.7745C6.61958 20.7745 3.70842 19.3212 2.96583 18.9021C2.89293 18.5376 2.86104 17.9043 2.87015 17.4943C2.87015 17.4579 2.87471 17.4214 2.87471 17.3804C2.9066 16.3417 3.02505 15.2073 4.08656 14.8292C6.35535 14.246 8.16856 12.9795 8.24601 12.9294C8.52391 12.7335 8.59225 12.3508 8.39635 12.0729C8.20045 11.795 7.81776 11.7267 7.53986 11.9226C7.52163 11.9362 5.82232 13.1207 3.75854 13.6447C3.74031 13.6492 3.72665 13.6538 3.71298 13.6583C1.73576 14.3371 1.67653 16.4465 1.6492 17.344C1.6492 17.385 1.6492 17.4214 1.64464 17.4579C1.64464 17.4624 1.64464 17.467 1.64464 17.4715C1.64009 17.7084 1.63553 18.9248 1.87699 19.5353C1.92255 19.6538 2.00455 19.754 2.11389 19.8223C2.25056 19.9135 5.52619 22 11.0068 22C16.4875 22 19.7631 19.9089 19.8998 19.8223C20.0045 19.754 20.0911 19.6538 20.1367 19.5353C20.3645 18.9294 20.3599 17.713 20.3553 17.4761Z" fill="#E94200"/>
                        </svg>
                    </a>
                </li>
            </ul>
            <?if(OPEN_SHOP):?>
                <?global $USER;?>
                <?if (!$USER->IsAuthorized()):?>
                    <?/*<div class = "btn-login login-modal-open" >
                        <svg enable-background="new 0 0 511.999 511.999" version="1.1" viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" style="fill: white;">
                            <path d="m418.07 297.74h-324.14c-31.846 0-57.754 25.909-57.754 57.755s25.909 57.754 57.754 57.754h33.852l-4.369 3.549c-5.031 4.088-7.295 10.561-5.909 16.892 1.386 6.332 6.147 11.268 12.426 12.879l2.269 0.583-11.198 43.629c-1.373 5.35 1.851 10.799 7.2 12.172l34.009 8.729c0.819 0.211 1.654 0.314 2.486 0.314 1.776 0 3.537-0.474 5.091-1.393 2.283-1.351 3.936-3.553 4.595-6.121l11.199-43.631 2.269 0.583c6.279 1.611 12.828-0.421 17.092-5.304 4.264-4.882 5.396-11.645 2.956-17.649l-10.257-25.233h220.43v1e-3c31.846 0 57.754-25.908 57.754-57.754s-25.91-57.755-57.754-57.755zm-283.71 140.97-4e-3 0.015c2e-3 -6e-3 3e-3 -0.013 5e-3 -0.019-1e-3 2e-3 -1e-3 3e-3 -1e-3 4e-3zm47.752 0.606c-2.921-0.752-5.959-0.32-8.556 1.216-2.596 1.535-4.438 3.989-5.186 6.907l-10.879 42.387-14.638-3.758 10.878-42.382c0.751-2.922 0.319-5.961-1.218-8.558-1.537-2.596-3.992-4.438-6.906-5.182l-5.064-1.301 18.953-15.396 12.441-10.106 4.108 10.106 11.123 27.364-5.056-1.297zm185.75-46.066h-178.35l-4.126-10.15c-1.194-2.936-3.708-5.133-6.778-5.92-3.072-0.79-6.332-0.075-8.792 1.924l-17.414 14.146h-58.471c-20.818 0-37.754-16.937-37.754-37.754 0-20.818 16.937-37.755 37.754-37.755h273.93v75.509zm50.209 0h-30.208v-75.509h30.208c20.818 0 37.754 16.937 37.754 37.755-1e-3 20.817-16.938 37.754-37.754 37.754z"/>
                            <path d="m423.87 332.59c-3.425-4.332-9.714-5.069-14.046-1.642-4.333 3.425-5.067 9.714-1.642 14.046l6.735 8.519-6.735 8.519c-3.425 4.332-2.69 10.621 1.642 14.046 1.836 1.452 4.023 2.156 6.195 2.156 2.953-1e-3 5.877-1.302 7.851-3.798l11.64-14.721c2.875-3.635 2.875-8.77 0-12.404l-11.64-14.721z"/>
                            <path d="m96.979 359.32c0.25 0.61 0.56 1.19 0.92 1.73 0.37 0.55 0.79 1.06 1.25 1.52 0.46 0.461 0.97 0.881 1.52 1.24 0.54 0.36 1.12 0.67 1.72 0.92 0.61 0.25 1.23 0.44 1.87 0.57 0.65 0.13 1.3 0.2 1.96 0.2 0.65 0 1.3-0.07 1.95-0.2 0.64-0.13 1.27-0.32 1.87-0.57s1.19-0.56 1.73-0.92c0.54-0.359 1.06-0.779 1.52-1.24 0.46-0.46 0.88-0.97 1.24-1.52 0.36-0.54 0.67-1.12 0.92-1.73 0.25-0.6 0.44-1.229 0.57-1.869 0.13-0.641 0.2-1.301 0.2-1.95 0-0.65-0.07-1.311-0.2-1.96-0.13-0.63-0.32-1.26-0.57-1.87-0.25-0.601-0.56-1.18-0.92-1.72-0.36-0.551-0.78-1.061-1.24-1.521s-0.98-0.88-1.52-1.25c-0.54-0.36-1.13-0.67-1.73-0.92s-1.23-0.44-1.87-0.57c-3.25-0.649-6.7 0.41-9.02 2.74-0.46 0.46-0.88 0.97-1.25 1.521-0.36 0.54-0.67 1.119-0.92 1.72-0.25 0.61-0.44 1.24-0.57 1.87-0.13 0.649-0.19 1.31-0.19 1.96 0 0.649 0.06 1.31 0.19 1.95s0.32 1.27 0.57 1.869z"/>
                            <path d="m150.16 359.32c0.25 0.61 0.56 1.19 0.92 1.73 0.37 0.55 0.79 1.06 1.25 1.52 0.46 0.461 0.97 0.881 1.52 1.24 0.54 0.36 1.12 0.67 1.72 0.92 0.61 0.25 1.24 0.44 1.87 0.57 0.65 0.13 1.31 0.2 1.96 0.2s1.31-0.07 1.95-0.2 1.27-0.32 1.87-0.57c0.61-0.25 1.19-0.56 1.73-0.92 0.55-0.359 1.06-0.779 1.52-1.24 0.46-0.46 0.88-0.97 1.24-1.52 0.36-0.54 0.67-1.12 0.92-1.73 0.25-0.6 0.44-1.229 0.57-1.869 0.13-0.641 0.2-1.301 0.2-1.95 0-0.65-0.07-1.311-0.2-1.96-0.13-0.63-0.32-1.26-0.57-1.87-0.25-0.601-0.56-1.18-0.92-1.72-0.36-0.551-0.78-1.061-1.24-1.521-2.32-2.33-5.77-3.39-9.03-2.74-0.63 0.13-1.26 0.32-1.87 0.57-0.6 0.25-1.18 0.56-1.72 0.92-0.55 0.37-1.06 0.79-1.52 1.25s-0.88 0.97-1.25 1.521c-0.36 0.54-0.67 1.119-0.92 1.72-0.25 0.61-0.44 1.24-0.57 1.87-0.13 0.649-0.19 1.31-0.19 1.96 0 0.649 0.06 1.31 0.19 1.95s0.32 1.27 0.57 1.869z"/>
                            <path d="m203.35 359.32c0.25 0.61 0.56 1.19 0.92 1.73 0.36 0.55 0.78 1.06 1.24 1.52 0.46 0.461 0.97 0.881 1.52 1.24 0.54 0.36 1.12 0.67 1.73 0.92 0.6 0.25 1.23 0.44 1.87 0.57s1.3 0.2 1.95 0.2 1.31-0.07 1.95-0.2 1.27-0.32 1.87-0.57c0.61-0.25 1.19-0.56 1.73-0.92 0.55-0.359 1.06-0.779 1.52-1.24 0.46-0.46 0.88-0.97 1.24-1.52 0.36-0.54 0.67-1.12 0.92-1.73 0.25-0.6 0.44-1.229 0.57-1.869 0.13-0.641 0.2-1.301 0.2-1.95 0-0.65-0.07-1.311-0.2-1.96-0.12-0.63-0.32-1.26-0.57-1.87-0.25-0.601-0.56-1.18-0.92-1.72-0.36-0.551-0.78-1.061-1.24-1.521-2.32-2.33-5.78-3.39-9.02-2.74-0.64 0.13-1.27 0.32-1.88 0.57-0.6 0.25-1.18 0.56-1.72 0.92-0.55 0.37-1.06 0.79-1.52 1.25s-0.88 0.97-1.24 1.521c-0.36 0.54-0.67 1.119-0.92 1.72-0.25 0.61-0.45 1.24-0.57 1.87-0.13 0.649-0.2 1.31-0.2 1.96 0 0.649 0.07 1.31 0.2 1.95 0.12 0.64 0.32 1.27 0.57 1.869z"/>
                            <path d="m256.53 359.32c0.25 0.61 0.56 1.19 0.92 1.73 0.36 0.55 0.78 1.06 1.24 1.52 0.46 0.461 0.97 0.881 1.52 1.24 0.54 0.36 1.12 0.67 1.73 0.92 0.6 0.25 1.23 0.44 1.87 0.57s1.3 0.2 1.95 0.2 1.31-0.07 1.95-0.2 1.27-0.32 1.87-0.57c0.61-0.25 1.19-0.56 1.73-0.92 0.55-0.359 1.06-0.779 1.52-1.24 0.46-0.46 0.88-0.97 1.24-1.52 0.36-0.54 0.67-1.12 0.92-1.73 0.25-0.6 0.45-1.229 0.57-1.869 0.13-0.641 0.2-1.301 0.2-1.95 0-0.65-0.07-1.311-0.2-1.96-0.12-0.63-0.32-1.26-0.57-1.87-0.25-0.601-0.56-1.18-0.92-1.72-0.36-0.551-0.78-1.061-1.24-1.521-2.32-2.33-5.78-3.39-9.02-2.74-0.64 0.13-1.27 0.32-1.87 0.57-0.61 0.25-1.19 0.56-1.73 0.92-0.55 0.37-1.06 0.79-1.52 1.25s-0.88 0.97-1.24 1.521c-0.36 0.54-0.67 1.119-0.92 1.72-0.25 0.61-0.44 1.24-0.57 1.87-0.13 0.649-0.2 1.31-0.2 1.96 0 0.649 0.07 1.31 0.2 1.95s0.32 1.27 0.57 1.869z"/>
                            <path d="m309.71 359.32c0.25 0.61 0.56 1.19 0.92 1.73 0.36 0.55 0.78 1.06 1.24 1.52 0.46 0.461 0.97 0.881 1.52 1.24 0.54 0.36 1.12 0.67 1.73 0.92 0.6 0.25 1.23 0.44 1.87 0.57s1.3 0.2 1.95 0.2 1.31-0.07 1.96-0.2c0.63-0.13 1.26-0.32 1.87-0.57 0.6-0.25 1.18-0.56 1.72-0.92 0.55-0.359 1.06-0.779 1.52-1.24 0.46-0.46 0.88-0.97 1.25-1.52 0.36-0.54 0.67-1.12 0.92-1.73 0.25-0.6 0.44-1.229 0.57-1.869 0.13-0.641 0.19-1.301 0.19-1.95 0-0.65-0.06-1.311-0.19-1.96-0.13-0.63-0.32-1.26-0.57-1.87-0.25-0.601-0.56-1.18-0.92-1.72-0.37-0.551-0.79-1.061-1.25-1.521s-0.97-0.88-1.52-1.25c-0.54-0.36-1.12-0.67-1.72-0.92-0.61-0.25-1.24-0.44-1.87-0.57-1.29-0.26-2.62-0.26-3.91 0-0.64 0.13-1.27 0.32-1.87 0.57-0.61 0.25-1.19 0.56-1.73 0.92-0.55 0.37-1.06 0.79-1.52 1.25s-0.88 0.97-1.24 1.521c-0.36 0.54-0.67 1.119-0.92 1.72-0.25 0.61-0.44 1.24-0.57 1.87-0.13 0.649-0.2 1.31-0.2 1.96 0 0.649 0.07 1.31 0.2 1.95s0.32 1.27 0.57 1.869z"/>
                            <path d="m168.26 252.76c0.245 0.233 0.498 0.459 0.768 0.668 22.963 17.766 50.111 27.821 78.925 29.321 0.205 0.011 0.411 0.021 0.616 0.031 0.914 0.044 1.831 0.078 2.748 0.105 0.27 8e-3 0.54 0.018 0.81 0.025 1.131 0.026 2.263 0.043 3.399 0.043 1.142 0 2.281-0.017 3.419-0.043 0.26-6e-3 0.518-0.016 0.777-0.024 0.94-0.027 1.877-0.062 2.813-0.107 0.18-9e-3 0.359-0.018 0.538-0.028 29.286-1.515 56.797-11.843 79.972-30.112 0.318-0.251 0.617-0.522 0.899-0.806 32.324-25.951 53.057-65.775 53.057-110.36 1e-3 -78.012-63.465-141.48-141.48-141.48s-141.48 63.467-141.48 141.48c0 45.113 21.224 85.361 54.213 111.28zm100.26 9.496c-0.62 0.065-1.241 0.125-1.863 0.181-0.688 0.063-1.375 0.126-2.066 0.177-1.199 0.087-2.401 0.157-3.607 0.209-0.413 0.019-0.826 0.033-1.24 0.047-1.401 0.047-2.805 0.081-4.215 0.081-1.392 0-2.778-0.033-4.162-0.079-0.408-0.014-0.815-0.029-1.221-0.046-1.151-0.05-2.298-0.116-3.443-0.197-0.666-0.048-1.33-0.106-1.993-0.165-0.718-0.063-1.435-0.131-2.151-0.206-0.799-0.085-1.597-0.173-2.392-0.274-0.141-0.018-0.281-0.039-0.422-0.057-20.159-2.627-38.78-10.213-54.596-21.493v-18.105c0-23.827 11.834-44.928 29.92-57.779 11.304 8.834 25.509 14.119 40.934 14.119s29.631-5.284 40.934-14.119c18.086 12.851 29.92 33.952 29.92 57.779v17.412h1e-3c-16.74 12.185-36.696 20.204-58.338 22.515zm-12.99-242.26c66.983 0 121.48 54.494 121.48 121.48 0 30.622-11.394 58.63-30.159 80.018-0.265-29.199-14.371-55.15-36.064-71.597 7.453-10.756 11.835-23.793 11.835-37.841 0-3.305-0.245-6.629-0.729-9.88-0.813-5.462-5.897-9.231-11.363-8.419-5.463 0.813-9.232 5.899-8.419 11.362 0.339 2.279 0.511 4.613 0.511 6.937 0 10.303-3.366 19.832-9.048 27.557-4.61 6.268-10.747 11.341-17.859 14.673-5.99 2.807-12.667 4.385-19.707 4.385s-13.717-1.578-19.707-4.385c-7.112-3.332-13.249-8.405-17.859-14.673-5.682-7.725-9.048-17.253-9.048-27.557 0-25.703 20.911-46.614 46.614-46.614 3.538 0 7.061 0.396 10.473 1.179 5.389 1.239 10.749-2.129 11.982-7.513 1.234-5.383-2.129-10.747-7.512-11.981-4.875-1.118-9.903-1.685-14.942-1.685-36.731 0-66.614 29.883-66.614 66.614 0 14.048 4.382 27.085 11.835 37.841-21.901 16.604-36.075 42.893-36.075 72.433v0.222c-19.326-21.518-31.101-49.946-31.101-81.076-1e-3 -66.984 54.494-121.48 121.48-121.48z"/>
                            <path d="m288.26 77.37c0.25 0.6 0.56 1.18 0.92 1.72 0.36 0.55 0.78 1.06 1.24 1.52 0.46 0.471 0.97 0.881 1.52 1.25 0.54 0.36 1.12 0.671 1.73 0.921 0.6 0.25 1.23 0.439 1.87 0.569s1.3 0.19 1.95 0.19 1.31-0.061 1.95-0.19c0.64-0.13 1.27-0.319 1.88-0.569 0.6-0.25 1.18-0.561 1.72-0.921 0.55-0.369 1.06-0.779 1.52-1.25 0.46-0.46 0.88-0.97 1.24-1.52 0.36-0.54 0.67-1.12 0.92-1.72 0.25-0.61 0.45-1.23 0.57-1.87 0.13-0.65 0.2-1.3 0.2-1.96 0-0.65-0.07-1.311-0.2-1.95-0.12-0.64-0.32-1.271-0.57-1.87s-0.56-1.189-0.92-1.729c-0.36-0.551-0.78-1.061-1.24-1.521s-0.97-0.88-1.52-1.24c-0.54-0.359-1.12-0.67-1.72-0.92-0.61-0.25-1.24-0.439-1.88-0.569-1.29-0.261-2.61-0.261-3.9 0-0.64 0.13-1.27 0.319-1.87 0.569-0.61 0.25-1.19 0.561-1.73 0.92-0.55 0.36-1.06 0.78-1.52 1.24s-0.88 0.97-1.24 1.521c-0.36 0.54-0.67 1.13-0.92 1.729s-0.44 1.23-0.57 1.87-0.2 1.3-0.2 1.95c0 0.66 0.07 1.31 0.2 1.96 0.13 0.64 0.32 1.26 0.57 1.87z"/>
                        </svg>
                    </div>*/?>
                <?else:?>
                    <div class = "btn-login login-modal-logout" style="padding: 10px;">
                        <svg enable-background="new 0 0 512 512" version="1.1" viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" style="fill: white;">
                            <path d="m510.37 226.51c-1.088-2.603-2.645-4.971-4.629-6.955l-63.979-63.979c-8.341-8.32-21.824-8.32-30.165 0-8.341 8.341-8.341 21.845 0 30.165l27.584 27.584h-119.17c-11.797 0-21.333 9.557-21.333 21.333s9.536 21.333 21.333 21.333h119.17l-27.584 27.584c-8.341 8.341-8.341 21.845 0 30.165 4.16 4.181 9.621 6.251 15.083 6.251s10.923-2.069 15.083-6.251l63.979-63.979c1.984-1.963 3.541-4.331 4.629-6.955 2.154-5.203 2.154-11.091 0-16.296z"/>
                            <path d="m362.68 298.67c-11.797 0-21.333 9.557-21.333 21.333v106.67h-85.333v-341.33c0-9.408-6.187-17.728-15.211-20.437l-74.091-22.229h174.64v106.67c0 11.776 9.536 21.333 21.333 21.333s21.333-9.557 21.333-21.333v-128c0-11.777-9.536-21.334-21.333-21.334h-341.33c-0.768 0-1.451 0.32-2.197 0.405-1.003 0.107-1.92 0.277-2.88 0.512-2.24 0.576-4.267 1.451-6.165 2.645-0.469 0.299-1.045 0.32-1.493 0.661-0.172 0.129-0.236 0.364-0.407 0.492-2.325 1.834-4.266 4.074-5.674 6.741-0.299 0.576-0.363 1.195-0.597 1.792-0.683 1.621-1.429 3.2-1.685 4.992-0.107 0.64 0.085 1.237 0.064 1.856-0.021 0.427-0.299 0.811-0.299 1.237v426.67c0 10.176 7.189 18.923 17.152 20.907l213.33 42.667c1.387 0.299 2.795 0.427 4.181 0.427 4.885 0 9.685-1.685 13.525-4.843 4.928-4.053 7.808-10.091 7.808-16.491v-21.333h106.67c11.797 0 21.333-9.557 21.333-21.333v-128c0-11.776-9.536-21.333-21.333-21.333z"/>
                        </svg>
                    </div>
                <?endif?>
            <?endif?>
            <div class="header-call js-call-callback">
                <a href="#modal-FORM10" class="popup-btn-FORM10 header-call__ic">
                    <?if(OPEN_SHOP === false):?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="14.547" height="24.331" viewBox="0 0 14.547 24.331"><g transform="translate(-8967.75 1214.75)"><path d="M0,.5H13.047" transform="translate(8968.5 -1195.909)" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><path d="M0,1.25H3.262" transform="translate(8973.393 -1211.988)" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><rect width="13.047" height="22.831" rx="2" transform="translate(8968.5 -1214)" stroke-width="1.5" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" fill="none"/></g></svg>
                    <?endif?>
                </a>
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
            <?$APPLICATION->IncludeComponent(
                "bitrix:menu",
                "top_menu_mobile",
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
                    "ROOT_MENU_TYPE" => "top_menu_mobile",
                    "USE_EXT" => "N",
                    "COMPONENT_TEMPLATE" => "top_menu_mobile"
                ),
                false
            );?>
        </div>
    </header>
