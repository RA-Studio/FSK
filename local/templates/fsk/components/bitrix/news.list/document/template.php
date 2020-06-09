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
<div class="doc-list">
    <div class="f-row">
        <?foreach($arResult["ITEMS"] as $arItem){
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?><div class="cols col-1-4" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <div class="doc" tabindex="0">
                    <div class="doc__title"><?=$arItem['NAME']?></div>
                    <div class="ui-select ui-select-docs">
                        <div class="ui-select__trigger">
                            <img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-doc.svg" width="15" height="18" alt="">
                            Подробнее
                        </div>
                        <div class="ui-select__options">
                            <div class="ui-select__simplebar" data-simplebar data-simplebar-auto-hide="false">
                                <?foreach ($arItem['PROPERTIES']['UF_DOCS']['VALUE'] as $key=>$value){?>
                                    <div class="ui-select__doc">
                                        <pre style="display: none"><?print_r(CFile::GetById($value)->Fetch())?></pre>
                                        <a class="doc-title" href="<?=CFile::GetPath($value)?>" target="_blank"><?=preg_replace('/\.\w+$/', '',CFile::GetById($value)->Fetch()['ORIGINAL_NAME'])//explode('.',CFile::GetById($value)->Fetch()['ORIGINAL_NAME'])[0]?></a>
                                        <div class="sub-text"><?=$arItem['PROPERTIES']['UF_DOCS']['DESCRIPTION'][$key]?></div>
                                    </div>
                                <?}?>
                            </div>
                        </div>
                    </div>
                </div>
            </div><?
        }
    ?></div>
</div>