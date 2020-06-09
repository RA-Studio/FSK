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
if (!empty($arResult['NAV_RESULT']))
{
    $navParams =  array(
        'NavPageCount' => $arResult['NAV_RESULT']->NavPageCount,
        'NavPageNomer' => $arResult['NAV_RESULT']->NavPageNomer,
        'NavNum' => $arResult['NAV_RESULT']->NavNum
    );
}
$containerName = 'container-'.$navParams['NavNum'];
?>
<div class="content">
    <h2 class="h1 title">Рейтинги</h2>
    <div class="p-list p-ratings">
        <div class="f-row" data-entity="<?=$containerName?>">
            <?foreach($arResult["ITEMS"] as $arItem):?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
            <div class="cols col-1-4">
                <div class="p-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
                        <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
                        <?else:?>
                            <img
                                    class="preview_picture"
                                    border="0"
                                    src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
                                    width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
                                    height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
                                    alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
                                    title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
                                    style="float:left"
                            />
                        <?endif;?>
                    <?endif?>
                    <?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
                        <span class="news-date-time"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span>
                    <?endif?>
                    <?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
                        <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
                            <a class="p-item__content" href="<?echo $arItem["DETAIL_PAGE_URL"]?>">
                                <div class="p-ratings-title"><?echo $arItem["NAME"]?></div>
                                <div><?=(mb_strlen($arItem["DETAIL_TEXT"] ) > 250 ) ? mb_substr( $arItem["DETAIL_TEXT"], 0, 250 )."&nbsp;..." : $arItem["DETAIL_TEXT"]?><?//echo TruncateText($arItem["DETAIL_TEXT"], 413);?></div>
                            </a>
                        <?else:?>
                            <div class="p-ratings-title"><?echo $arItem["NAME"]?></div>
                        <?endif;?>
                    <?endif;?>

                    <?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
                        <div><?echo $arItem["PREVIEW_TEXT"];?></div>
                    <?endif;?>

                    <?foreach($arItem["FIELDS"] as $code=>$value):?>
                        <small>
                            <?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?>
                        </small><br />
                    <?endforeach;?>

                    <?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
                        <small>
                            <?=$arProperty["NAME"]?>:&nbsp;
                            <?if(is_array($arProperty["DISPLAY_VALUE"])):?>
                                <?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
                            <?else:?>
                                <?=$arProperty["DISPLAY_VALUE"];?>
                            <?endif?>
                        </small><br />
                    <?endforeach;?>

                </div>
            </div>
            <?endforeach;?>
        </div>
        <?if($arParams["DISPLAY_SHOW_MORE"]):?>
            <?=$arResult["NAV_STRING"]?>
        <?endif;?>
    </div>
</div>

