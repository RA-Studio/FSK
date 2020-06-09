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

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

$this->setFrameMode(true);

$arViewModeList = $arResult['VIEW_MODE_LIST'];

$arViewStyles = array(
	'LIST' => array(
		'CONT' => 'bx_sitemap',
		'TITLE' => 'bx_sitemap_title',
		'LIST' => 'bx_sitemap_ul',
	),
	'LINE' => array(
		'CONT' => 'bx_catalog_line',
		'TITLE' => 'bx_catalog_line_category_title',
		'LIST' => 'bx_catalog_line_ul',
		'EMPTY_IMG' => $this->GetFolder().'/images/line-empty.png'
	),
	'TEXT' => array(
		'CONT' => 'bx_catalog_text',
		'TITLE' => 'bx_catalog_text_category_title',
		'LIST' => 'bx_catalog_text_ul'
	),
	'TILE' => array(
		'CONT' => 'bx_catalog_tile',
		'TITLE' => 'bx_catalog_tile_category_title',
		'LIST' => 'bx_catalog_tile_ul',
		'EMPTY_IMG' => $this->GetFolder().'/images/tile-empty.png'
	)
);
$arCurView = $arViewStyles[$arParams['VIEW_MODE']];

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));

?>
<div class="container section-margin">
    <h2 class="h1 title">Другие объекты</h2>
    <div class="quarter-list view-2 other-objects">
        <div class="f-row project-other"> <!--  -->
            <?$category = [];?>
            <?foreach($arResult['SECTIONS'] as $key => $section):?>
                <?

                if($section['DEPTH_LEVEL'] > 1) continue;
                if($arParams['CURRENT_SECTION'] == $section['CODE']) continue;

                $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "IBLOCK_ID", "PROPERTY_*",'UF_*');
                $arFilter = Array(
                    "IBLOCK_ID"=> $arParams["IBLOCK_ID"],
                    "ACTIVE"=>"Y",
                    "SECTION_ID" => $section['ID'],
                    "INCLUDE_SUBSECTIONS" => "Y"
                );
                $res = CIBlockElement::GetList(Array(), $arFilter, array("PROPERTY_category"), Array(), $arSelect);
                while($ob = $res->GetNextElement()) {
                    $arFields = $ob->GetFields();
                    $category[$section['ID']][$arFields['PROPERTY_CATEGORY_VALUE']] = $arFields['CNT'];
                }

                if($arParams['PAGE_TYPE'] == 'commercial') {
                    if (!$category[$section['ID']]['commercial']) {
                        continue;
                    }
                } else {
                    if (!$category[$section['ID']]['flat']) {
                        continue;
                    }
                }
                ?>
                <?
                $this->AddEditAction($section['ID'], $section['EDIT_LINK'], $strSectionEdit);
                $this->AddDeleteAction($section['ID'], $section['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
                ?>
                <div class="cols col-1-2" id="<?=$this->GetEditAreaId($section['ID'])?>">
                    <?
                    $SectionInfo = array();
                    // Получаем тип раздела и основную информацию о разделе
                    if (intval($section["ID"]) > 0) {
                        $SectionsRes = CIBlockSection::GetList(
                            Array("SORT" => "ASC"),
                            Array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ACTIVE" => "Y", "ID" => $section["ID"]),
                            false,
                            Array("IBLOCK_ID", "ID", "NAME", "UF_SECTION_NAME")
                        );

                        if ( $SectionsRes->SelectedRowsCount() ) {
                            $SectionInfo = $SectionsRes->GetNext();
                        }
                    }
                    ?>
                    <?
                    $buildProps = array(); // массив с данными "О ЖК"
                    CModule::IncludeModule('iblock');
                    $arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_*", "UF_*");
                    $arFilter = Array("IBLOCK_ID"=>5, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "ID"=>$SectionInfo["UF_SECTION_NAME"]);
                    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
                    ?>
                    <?// if($res->arResult):?>
                        <? while($ob = $res->GetNextElement()):
                            $buildProps['standartProps'] = $ob->GetFields();
                            $buildProps['userProps'] = $ob->GetProperties();
                        ?>
                        <? endwhile;?>
                    <?// endif; ?>
                    <?$arFilter = array('IBLOCK_ID' => $section['IBLOCK_ID'], "ID"=>$section['ID']);
                    $photo = '';
                    $rsSections = CIBlockSection::GetList(array(), $arFilter,false,array("IBLOCK_ID","ID","UF_*"));
                    while ($arSction = $rsSections->Fetch()){
                        $photo = $arSction['UF_PHOTO'];
                    }
                    $photo= !empty($photo)?$photo:$section['PICTURE']['ID'];
                    ?>
                    <div class="quarter">
                        <? if ($section['PICTURE']['ID']) { ?>
                            <div class="quarter__img-wrap">
                                <?global $USER;
                                if($USER->IsAdmin()){?>
                                    <?$img = \CFile::ResizeImageGet($photo, array('width'=>470, 'height'=>250), BX_RESIZE_IMAGE_EXACT, true)['src']?>
                                <?}else{?>
                                    <?$img = \CFile::ResizeImageGet($section['PICTURE']['ID'], array('width'=>470, 'height'=>250), BX_RESIZE_IMAGE_EXACT, true)['src']?>
                                <?}?>

                                <img class="quarter__img lazyload" data-src="<?=$img?>" alt="<?=$section['NAME']?>">
                                <? if ($buildProps['userProps']['UF_MAIN_ICON']['VALUE']) {?>
                                    <div class="quarter__overlay">
                                        <img class="img lazyload" data-src="<?=CFile::GetPath($buildProps['userProps']['UF_MAIN_ICON']['VALUE']);?>" width="277" height="70" alt="<?=$section['NAME']?>">
                                    </div>
                                <?}?>
                            </div>
                        <?}else{?>
                            <div class="quarter__img-wrap">
                                <div class="img img-empty"></div>
                            </div>
                        <?}?>
                        <div class="quarter__content">
                            <div class="quarter__title"><?=$section['NAME']?></div>
                            <?
                            if ($buildProps['userProps']['UF_METRO']['VALUE']) {?>
                                <div class="quarter__transport flex"><?
                                    $metro = [];
                                    if (CModule::IncludeModule('highloadblock')) {
                                        $arHLBlock = Bitrix\Highloadblock\HighloadBlockTable::getById(11)->fetch();
                                        $obEntity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arHLBlock);
                                        $strEntityDataClass = $obEntity->getDataClass();
                                    }

                                    //Получение списка:
                                    if (CModule::IncludeModule('highloadblock')) {
                                        $rsData = $strEntityDataClass::getList(array(
                                            'select' => array('ID', 'UF_NAME', 'UF_COLOR'),
                                            'filter' => array('UF_XML_ID' => $buildProps['userProps']['UF_METRO']['VALUE']),
                                            'order' => array('ID' => 'ASC'),
                                        ));
                                        while ($arItem = $rsData->Fetch()) {
                                            $metro[] = $arItem;
                                        }
                                    }
                                    foreach ($metro as $item) {
                                        ?>
                                        <div class="p-metro flex">
                                            <div class="p-metro__branch" style="border-color: <?=$item['UF_COLOR']?>;"></div>
                                            <span><?=$item['UF_NAME'];?></span>
                                        </div>
                                        <?
                                    }?>
                                </div><?
                            }
                            ?>
                            <a class="btn btn--transp" href="<?=$section['SECTION_PAGE_URL']?>" target="_blank">
                                <img class="svg btn__ic ic-arrow lazyload" data-src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-arrow.svg" alt="link" width="20" height="20">
                                Посмотреть
                            </a>
                        </div>
                    </div>
                </div>
            <?endforeach?>
        </div>
    </div>
</div>
