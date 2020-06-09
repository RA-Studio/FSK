<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;
/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */
$this->setFrameMode(false);
$detail = !empty($arResult['PROPERTIES']['UF_DETAIL_PICTURE']['VALUE'])?$arResult['PROPERTIES']['UF_DETAIL_PICTURE']['VALUE']:$arResult['DETAIL_PICTURE']['ID'];
?><div class="p-hero" id="<?=$itemIds['ID']?>" style="background-image: url('<?=CFile::GetPath($detail)?>')">
    <div class="p-hero__inner" id="<?=$itemIds['ID']?>">
        <div class="p-hero__top"><?=FormatDate('d F Y', MakeTimeStamp($date))?></div>
        <h1 class="h2 p-hero__title"><?=$arResult['NAME']?></h1>
        <?$APPLICATION->IncludeComponent(
            "bitrix:breadcrumb",
            "breadcrumb",
            Array(
                "COMPONENT_TEMPLATE" => "breadcrumb",
                "PATH" => "",
                "SITE_ID" => "s1",
                "START_FROM" => "0",
                "SHOW_BORDER" => false
            )
        );?>
    </div>
</div>
<div class="content">
    <?=$arResult['DETAIL_TEXT']?><?
    if(!empty($arResult['PROPERTIES']['UF_DISCOUNTS_TAGS']['VALUE'])){?>
        <div class="p-labels p-labels--static mt-50">
            <?if(CSite::InDir('/news/')):?>
                <div class="p-labels__title">Другие новости</div>
            <?else:?>
                <div class="p-labels__title"><?=Loc::getMessage('CT_BCE_CATALOG_DESCRIPTION_TAG')?></div>
            <?endif?>
            <?
            foreach ($arResult['PROPERTIES']['UF_DISCOUNTS_TAGS']['VALUE'] as $tag){
                ?><span class="p-label"><?=$tag?></span><?
            }
        ?></div><?
    }
?></div>
