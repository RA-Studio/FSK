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
<div class="completed-projects_mobile">
    <h2 class="h1 title"><?=$arParams['PAGER_TITLE']?></h2>
    <div class="completed-projects">
        <?if(!empty($_GET['PAGEN_PR'])){
            $APPLICATION->RestartBuffer();
        }?>
        <?foreach($arResult["ITEMS"] as $arItem):?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="completed-projects-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <div class="completed-projects-item-img">
                    <div class="completed-projects-item-img__date"><?=$arItem['PROPERTIES']['UF_YEAR']['~VALUE']?></div>
                    <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
                         width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
                         height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
                         alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
                         title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
                    >
                </div>
                <div class="completed-projects-item-info">
                    <div class="completed-projects-item-info__title"><?=$arItem['NAME']?></div>
                    <div class="completed-projects-item-info__address"><?=$arItem['PROPERTIES']['UF_ADRES']['~VALUE']?></div>
                </div>
            </div>
        <?endforeach;?>
        <?if(!empty($_GET['PAGEN_PR'])){
            die();
        }?>
    </div>
</div>

