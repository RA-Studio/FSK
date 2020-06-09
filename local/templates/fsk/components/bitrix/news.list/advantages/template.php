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
$block = $arParams['DISPLAY_LIKE_BLOCK'];
if($block=='Y'){
?><div class="container section-margin">
    <h2 class="h1 title"><?=$arParams['BLOCK_TITLE']?></h2><?
}
?><div class="advantages-list"><?
        if($arParams["DISPLAY_TOP_PAGER"]):?>
            <?=$arResult["NAV_STRING"]?><br />
        <?endif;
        foreach($arResult["ITEMS"] as $arItem){
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?><div class="advantage" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <img class="img" src="<?=CFile::GetPath($arItem['PROPERTIES']['UF_PREVIEW']['VALUE'])?>" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>">
                <div class="advantage__content">
                    <?=$arItem['PREVIEW_TEXT']?>
                </div>
            </div><?
        }
        if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
            <br /><?=$arResult["NAV_STRING"]?>
        <?endif;
    ?></div><?
if($block=='Y'){
?></div><?
}?>