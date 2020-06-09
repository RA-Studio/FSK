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
?>
<div class="page page--nohero docs">
    <div class="container">
        <?$APPLICATION->IncludeComponent(
            "bitrix:breadcrumb",
            "breadcrumb",
            array(
            ),
            false
        );?>
        <?if($arParams["DISPLAY_TOP_PAGER"]):?>
            <?=$arResult["NAV_STRING"]?><br />
        <?endif;?>
        <?foreach($arResult["ITEMS"] as $arItem){
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            $filterSection = ["IBLOCK_ID"=>$arItem['PROPERTIES']['UF_DOCS']['LINK_IBLOCK_ID'],"ID"=>$arItem['PROPERTIES']['UF_DOCS']['VALUE']];
            $rsSections = CIBlockSection::GetList(array(), $filterSection,false, array("ID","IBLOCK_ID","IBLOCK_SECTION_ID","NAME","DESCRIPTION","UF_*","PICTURE"));
            $arSections =array();
            while ($arSection = $rsSections->Fetch())
            {

                $arButtons = CIBlock::GetPanelButtons(
                    $arSection["IBLOCK_ID"],
                    0,
                    $arSection["ID"],
                    array("SESSID"=>false, "CATALOG"=>true)
                );
                $arSection["EDIT_LINK"] = $arButtons["edit"]["edit_section"]["ACTION_URL"];
                $arSection["DELETE_LINK"] = $arButtons["edit"]["delete_section"]["ACTION_URL"];
                $strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
                $strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
                $arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));
                $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
                $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
                $preview = !empty($arSection["UF_PHOTO"])?$arSection["UF_PHOTO"]:$arSection["PICTURE"];
                ?><div class="h1 title title-margin" data-id="#<?=$arItem['ID']?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>"><?=$arSection['NAME']?></div>
                <?if(!empty($preview)){?>
                        <div class="p-hero docs-hero" id="<?=$this->GetEditAreaId($arSection['ID'])?>" style="background-image: url('<?=CFile::GetPath($preview)?>')"></div>
                <?}?>
                <?if(!empty($arSection['UF_LINK'])){?>
                    <div class="doc-law">
                        <div class="doc-law__col-1">
                            <div class="doc-law__img">
                                <img class="img" src="<?=SITE_TEMPLATE_PATH?>/img/dom-rf.svg" width="52" height="52" alt="alt">
                            </div>
                        </div>
                        <div class="doc-law__col-2">
                            <p class="doc-law__txt"><?=$arSection['DESCRIPTION']?></p>
                        </div>
                        <div class="doc-law__col-3">
                            <a class="btn btn--bg" href="<?=$arSection['UF_LINK']?>" target="_blank">Перейти</a>
                        </div>
                    </div>
                <?}?><?
                $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "document",
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
                        "SECTION_ID" => $arSection["ID"],
                        "DISPLAY_BOTTOM_PAGER" => "N",
                        "DISPLAY_DATE" => "N",
                        "DISPLAY_NAME" => "N",
                        "DISPLAY_PICTURE" => "N",
                        "DISPLAY_PREVIEW_TEXT" => "N",
                        "DISPLAY_TOP_PAGER" => "N",
                        "FIELD_CODE" => array(
                            0 => "",
                            1 => "",
                        ),
                        "FILE_404" => "",
                        "FILTER_NAME" => "",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                        "IBLOCK_ID" => $arSection["IBLOCK_ID"],
                        "IBLOCK_TYPE" => "content",
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                        "INCLUDE_SUBSECTIONS" => "N",
                        "MESSAGE_404" => "",
                        "NEWS_COUNT" => "2000",
                        "PAGER_BASE_LINK_ENABLE" => "N",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_TEMPLATE" => ".default",
                        "PAGER_TITLE" => "Новости",
                        "PARENT_SECTION" => $arSection["ID"],
                        "PARENT_SECTION_CODE" => "",
                        "PREVIEW_TRUNCATE_LEN" => "",
                        "PROPERTY_CODE" => array(
                            0 => "",
                            1 => "UF_DOCS",
                        ),
                        "SET_BROWSER_TITLE" => "N",
                        "SET_LAST_MODIFIED" => "N",
                        "SET_META_DESCRIPTION" => "N",
                        "SET_META_KEYWORDS" => "N",
                        "SET_STATUS_404" => "Y",
                        "SET_TITLE" => "N",
                        "SHOW_404" => "Y",
                        "SORT_BY1" => "SORT",
                        "SORT_BY2" => "SORT",
                        "SORT_ORDER1" => "ASC",
                        "SORT_ORDER2" => "ASC",
                        "STRICT_SECTION_CHECK" => "N",
                        "COMPONENT_TEMPLATE" => "document"
                    ),
                    false
                );

            }
            }?>
        <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
            <br /><?=$arResult["NAV_STRING"]?>
        <?endif;?>
    </div>
</div>



