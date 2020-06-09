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

?><div class="f-row">
    <?if($arParams["DISPLAY_TOP_PAGER"]):?>
        <?=$arResult["NAV_STRING"]?><br />
    <?endif;?>

    <?foreach($arResult["ITEMS"] as $index=>$arItem){
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        $preview = !empty($arItem['PROPERTIES']['UF_PREVIEW_PICTURE']['VALUE'])?$arItem['PROPERTIES']['UF_PREVIEW_PICTURE']['VALUE']:$arItem['PREVIEW_PICTURE']['ID'];

        ?><div class="cols col-1-2">
    <div class="vacancy" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <?if (!empty($arItem['PREVIEW_PICTURE']['SRC'])){
                    ?><div class="vacancy__img">
                        <img class="img" src="<?=CFile::GetPath($preview)?>" alt="<?=$arItem['PREVIEW_PICTURE']['SRC']?>">
                    </div><?
                }
                ?><div class="vacancy__content">
                    <h2 class="h3 vacancy__title"><?=$arItem['NAME']?></h2><?
                    if (!empty($arItem['PROPERTIES']['UF_DUTIES']['~VALUE']['TEXT'])){
                        ?><div class="vacancy__text">
                        <p> <b>Обязанности:</b></p><?=$arItem['PROPERTIES']['UF_DUTIES']['~VALUE']['TEXT']
                        ?></div><?
                    }
                    if (!empty($arItem['PROPERTIES']['UF_REQUIREMENT']['~VALUE']['TEXT'])){
                        ?><div class="vacancy__text">
                            <p> <b>Требования:</b></p><?=$arItem['PROPERTIES']['UF_REQUIREMENT']['~VALUE']['TEXT']
                        ?></div><?
                    }
                    if (!empty($arItem['PROPERTIES']['UF_CONDITIONS']['~VALUE']['TEXT'])){
                        ?><div class="vacancy__text">
                            <p> <b>Условия:</b></p><?=$arItem['PROPERTIES']['UF_CONDITIONS']['~VALUE']['TEXT']
                        ?></div><?
                    }
                ?></div>
                <div class="vacancy__footer">
                    <div class="email-row"><img class="svg btn__ic" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-mail.svg" alt="email" width="32" height="16">
                        <p>Ждем ваши резюме на <a href="mailto:hr@fsknw.ru">hr@fsknw.ru</a></p>
                    </div>
                    <button class="btn btn-vacancy" type="button"><img class="svg btn__ic ic-arrow ic-arrow--down" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-arrow.svg" alt="link" width="20" height="20">Развернуть</button>
                </div>
            </div>
        </div>
        <?
           /* if(($index+1)%(count($arResult['ITEMS'])/2+1) == 0){
                */?><!--</div>
                <div class="cols col-1-2">--><?/*
            }*/
    }
    ?></div><?
if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;
?></div>
