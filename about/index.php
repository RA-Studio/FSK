<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("О застройщике");
$page = $APPLICATION->GetCurPage();
?><div class="page desktop-padding">
    <div class="container">
        <?global $USER;
        if($USER->IsAdmin() && $_GET['bitrix_include_areas']=='Y'){?>
        <?
            $APPLICATION->IncludeFile(
                $page."/include/background.php",
                array(),
                array(
                    "NAME"=>"Картинка",
                    "MODE" => "html",
                )
            );
        ?>
        <?}
        $example = function($page){
            ob_start();
            $GLOBALS['APPLICATION']->IncludeFile(
                $page."/include/background.php",
                array(),
                array(
                    "NAME"=>"Картинка",
                    "MODE" => "html",
                )
            );
            $returnStr = @ob_get_contents();
            ob_get_clean();
            return $returnStr;
        };
        ;
        $background = explode('"',stristr(stristr($example($page),'src="'),'"'))[1];
        ?>
        <div class="p-hero" style="background-image: url('<?=$background?>')">
            <div class="p-hero__inner">
                <h1 class="h2 p-hero__title"><?=$APPLICATION->ShowTitle(false)?></h1>
                <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "main_breadcrumbs", Array(
                    "PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                    "SITE_ID" => "s1",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                    "START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
                ),
                    false
                );?>
            </div>
        </div>

        <?$APPLICATION->IncludeFile(
                $page."/include/akpa.php",
                array(),
                array(
                    "NAME"=>"ГК ФСК сегодня",
                    "MODE" => "html",
                )
        );?>

        <?$APPLICATION->IncludeFile(
            $page."/include/advantages.php",
            array(),
            array(
                "NAME"=>"ФСК в цифрах",
                "MODE" => "html",
            )
        );?>

        <?
            $GLOBALS['raitingsFilter'] = ["PROPERTY_UF_NEWS_RAITINGS_VALUE" => 'Да'];
        ?>
<div class="content">
    <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"compl_projects", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "Y",
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
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "18",
		"IBLOCK_TYPE" => "content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "8",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "showMore",
		"PAGER_TITLE" => "Реализованные проекты",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "413",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "UF_ADRES",
			1 => "UF_YEAR",
			2 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "compl_projects",
		"FILTER_NAME" => "",
		"DISPLAY_SHOW_MOR" => "Y",
		"DISPLAY_SHOW_MORE" => "Y"
	),
	false
);?>
    <?$APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "compl_projects_mobile",
        array(
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "ADD_SECTIONS_CHAIN" => "N",
            "AJAX_MODE" => "Y",
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
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "N",
            "DISPLAY_TOP_PAGER" => "N",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "IBLOCK_ID" => "18",
            "IBLOCK_TYPE" => "content",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "INCLUDE_SUBSECTIONS" => "Y",
            "MESSAGE_404" => "",
            "NEWS_COUNT" => "800",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => ".default",
            "PAGER_TITLE" => "Реализованные проекты",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "PREVIEW_TRUNCATE_LEN" => "413",
            "FIELD_CODE" => array(
                0 => "",
                1 => "",
            ),
            "PROPERTY_CODE" => array(
                0 => "UF_ADRES",
                1 => "UF_YEAR",
                2 => "",
            ),
            "SET_BROWSER_TITLE" => "N",
            "SET_LAST_MODIFIED" => "N",
            "SET_META_DESCRIPTION" => "N",
            "SET_META_KEYWORDS" => "Y",
            "SET_STATUS_404" => "N",
            "SET_TITLE" => "N",
            "SHOW_404" => "N",
            "SORT_BY1" => "ACTIVE_FROM",
            "SORT_BY2" => "SORT",
            "SORT_ORDER1" => "DESC",
            "SORT_ORDER2" => "ASC",
            "STRICT_SECTION_CHECK" => "N",
            "COMPONENT_TEMPLATE" => "compl_projects",
            "FILTER_NAME" => ""
        ),
        false
    );?>
</div>
        <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"raitings", 
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
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FILTER_NAME" => "raitingsFilter",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "3",
		"IBLOCK_TYPE" => "content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "4",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "showMore",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "413",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "raitings",
		"DISPLAY_SHOW_MORE" => "Y"
	),
	false
);?>

        <?$APPLICATION->IncludeFile(
            $page."/include/awards.php",
            array(),
            array(
                "NAME"=>"Награды",
                "MODE" => "html",
            )
        );?>

        <?$APPLICATION->IncludeFile(
                $page."/include/social.php",
                array(),
                array(
                    "NAME"=>"Социальная ответственность",
                    "MODE" => "html",
                )
        );?>

        <?$APPLICATION->IncludeFile(
            $page."/include/contacts.php",
            array(),
            array(
                "NAME"=>"Контакты",
                "MODE" => "html",
            )
        );
        $APPLICATION->IncludeFile(
            $page."/include/vacancy.php",
            array(),
            array(
                "NAME"=>"Вакансии",
                "MODE" => "html",
            )
        );
        $APPLICATION->IncludeFile(
            $page."/include/news.php",
            array(),
            array(
                "NAME"=>"Новости",
                "MODE" => "html",
            )
        );
        $APPLICATION->IncludeFile(
            $page."/include/SEO.php",
            array(),
            array(
                "NAME"=>"SEO",
                "MODE" => "html",
            )
        );

    ?></div>
</div><?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>