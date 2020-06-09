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
use Bitrix\Highloadblock\HighloadBlockTable as HLBT;
CModule::IncludeModule('highloadblock');
function GetEntityDataClass($HlBlockId) {
    if (empty($HlBlockId) || $HlBlockId < 1)
    {
        return false;
    }
    $hlblock = HLBT::getById($HlBlockId)->fetch();
    $entity = HLBT::compileEntity($hlblock);
    $entity_data_class = $entity->getDataClass();
    return $entity_data_class;
}
?>

<?foreach($arResult["ITEMS"] as $arItem){
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?><div class="contact" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <div class="contact__map">
            <div class="map-salepoint" id="map<?=$arItem['ID']?>" data-zoom="<?=$arItem['PROPERTIES']['UF_ZOOM']['VALUE']?>" data-coordinate="<?=$arItem['PROPERTIES']['UF_COORDINATES']['VALUE']?>" style="width: 100%; height: 100%"></div>
        </div>
        <div class="contact__content">
            <div class="contact__title h2"><?=$arItem['NAME']?></div>
            <?if(!empty($arItem['PROPERTIES']['UF_METRO']['PROPERTY_VALUE_ID'])){?>
                <div class="contact__metro">
                    <?foreach ($arItem['PROPERTIES']['UF_METRO']['VALUE'] as $value){
                        $entity_data_class = GetEntityDataClass(11);
                        $rsData = $entity_data_class::getList(array(
                            'order' => array('UF_NAME'=>'ASC'),
                            'select' => array('*'),
                            'filter' => array('UF_XML_ID'=>$value)
                        ));
                        $fields = $rsData->fetch();?>
                        <div class="p-metro flex">
                            <div class="p-metro__branch" style="border-color: <?=$fields['UF_COLOR']?$fields['UF_COLOR']:'#33B7FB'?>;"></div><span><?=$fields['UF_NAME']?></span>
                        </div>
                    <?}?>
                </div>
            <?}?>
            <div class="contact__data">
                <?if(!empty($arItem['PROPERTIES']['UF_ADDRESS']['VALUE'])){?>
                    <div class="data">
                        <div class="data-label sub-text">Адрес:</div>
                        <div class="data-value"><?=$arItem['PROPERTIES']['UF_ADDRESS']['VALUE']?></div>
                    </div>
                <?}?>
                <?if(!empty($arItem['PROPERTIES']['UF_WORK_TIME']['VALUE'])){?>
                    <div class="data data-col">
                        <div class="data-label sub-text">Время работы:</div>
                        <div class="data-value"><?=$arItem['PROPERTIES']['UF_WORK_TIME']['VALUE']?></div>
                    </div>
                <?}?>
                <?if(!empty($arItem['PROPERTIES']['UF_PHONE']['VALUE'])){?>
                    <div class="data data-col">
                        <div class="data-label sub-text">Телефон:</div>
                        <div class="data-value">
                            <a href="tel:<?=$arItem['PROPERTIES']['UF_PHONE']['VALUE']?>">
                                <?=$arItem['PROPERTIES']['UF_PHONE']['VALUE']?>
                            </a>
                        </div>
                    </div>
                <?}?>
                <?if(!empty($arItem['PREVIEW_TEXT'])){?>
                    <div class="data">
                        <div class="data-label sub-text">Как добраться:</div>
                        <div class="data-value"><?=$arItem['PREVIEW_TEXT']?></div>
                    </div>
                <?}?>
            </div>
        </div>
    </div>
<?}?>
