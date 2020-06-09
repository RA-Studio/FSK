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
<div class="page page--nohero">
    <div class="container">
        <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "main_breadcrumbs", Array(
            "PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                "SITE_ID" => "s1",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                "START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
            ),
            false
        );?>
        <h1 class="title title-margin">Новости</h1>
        <div class="p-list">
            <div class="f-row">
                <?if($arParams["DISPLAY_TOP_PAGER"]):?>
                    <?=$arResult["NAV_STRING"]?><br />
                <?endif;?>
                <?foreach($arResult["ITEMS"] as $arItem):?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                <div class="cols col-1-2">
                    <div class="p-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                        <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
                            <div class="p-item__img">
                                <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                                    <img
                                        class="img"
                                        src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
                                        width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>px"
                                        height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>px"
                                        alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
                                        title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
                                    >
                                </a>
                            </div>
                        <?endif?>
                        <?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
                            <?echo $arItem["PREVIEW_TEXT"];?>
                        <?endif;?>
                        <div class="p-item__content">
                            <span class="p-item__date"><?=$arItem['DISPLAY_ACTIVE_FROM'];?></span>
                            <div class="p-item__title">
                                <?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
                                    <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
                                        <a href="<?=$arItem["DETAIL_PAGE_URL"];?>"><?=$arItem['PROPERTIES']['UF_NEWS_SUBTITLE']['VALUE'];?></a>
                                    <?else:?>
                                        <b><?echo $arItem["NAME"]?></b><br />
                                    <?endif;?>
                                <?endif;?>
                            </div>
                            <a class="btn btn--transp" href="<?=$arItem["DETAIL_PAGE_URL"];?>">
                                <img class="svg btn__ic ic-read" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-read.svg" alt="link" width="15" height="19">
                                Подробнее
                            </a>
                        </div>
                    </div>
                </div>
                <?endforeach;?>
                <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
                    <br /><?=$arResult["NAV_STRING"]?>
                <?endif;?>
            </div>
            <div class="p-list-more">
                <button class="btn btn--transp" type="button"><img class="svg btn__ic ic-arrow ic-arrow--down" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-arrow.svg" alt="link" width="20" height="20">Показать ещё</button>
            </div>
        </div>
    </div>
    <!-- /.container-->
</div>
