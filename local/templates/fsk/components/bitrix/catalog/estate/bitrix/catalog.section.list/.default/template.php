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

<!-- /.container-->
<section class="section-margin">
  <div class="container">
    <h2 class="h1 title">Новостройки</h2>
    <div class="quarter-list view-1">
	<?foreach($arResult['SECTIONS'] as $key => $section): if($section['DEPTH_LEVEL'] > 1) continue;?>
		<?				
		$this->AddEditAction($section['ID'], $section['EDIT_LINK'], $strSectionEdit);
		$this->AddDeleteAction($section['ID'], $section['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
		?>
		<div class="quarter" id="<?=$this->GetEditAreaId($section['ID'])?>">
            <?php
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
            <?php
            $buildProps = []; // массив с данными "О ЖК"
            CModule::IncludeModule('iblock');
            $arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_*");
            $arFilter = Array("IBLOCK_ID"=>5, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "ID"=>$SectionInfo["UF_SECTION_NAME"]);

            $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>999), $arSelect);

            ?>
            <?php if($res->arResult):?>
                <?php while($ob = $res->GetNextElement()): $buildProps['standartProps'] = $ob->GetFields(); $buildProps['userProps'] = $ob->GetProperties();;?>
                <?php endwhile;?>
            <?php endif; ?>
            <?php if ($section['PICTURE']['ID']) {
                ?>
                <div class="quarter__img-wrap">
                    <img class="quarter__img" src="<?=CFile::GetPath($section['PICTURE']['ID'])?>" alt="alt">
                    <?php if ($buildProps['userProps']['UF_MAIN_ICON']['VALUE']) {
                        ?>
                        <div class="quarter__overlay">
                            <img class="img" src="<?=CFile::GetPath($buildProps['userProps']['UF_MAIN_ICON']['VALUE']);?>" width="277" height="70" alt="alt">
                        </div>
                        <?
                    } ?>
                </div>
                <?
            }else{?>
                <div class="quarter__img-wrap">
                    <div class="img img-empty"></div>
                </div>
            <?}?>
			<div class="quarter__content">
                <div class="quarter__title"><?=$section['NAME']?></div>
                <div class="quarter__transport flex">
                    <?php
                        if ($buildProps['userProps']['UF_METRO']['VALUE']) {
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
                                        'limit' => '999',
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
                            }
                        }
                    ?>
                    <?php
                        if ($buildProps['userProps']['UF_WALK_TIME']['VALUE']) {
                            ?>
                            <div class="p-distance flex">
                                <img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-walk-dist.svg" width="8" height="13" alt="alt">
                                <span><?=$buildProps['userProps']['UF_WALK_TIME']['VALUE'];?></span>
                            </div>
                            <?
                        }
                    ?>
                    <?php
                        if ($buildProps['userProps']['UF_TRANSPORT_TIME']['VALUE']) {
                            ?>
                            <div class="p-distance flex">
                                <img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-transport-dist.svg" width="15" height="16" alt="alt">
                                <span><?=$buildProps['userProps']['UF_TRANSPORT_TIME']['VALUE'];?></span>
                            </div>
                            <?
                        }
                    ?>
                </div>
                <div class="quarter__info my-readmore">
                    <p><?=$section['~DESCRIPTION']?></p>
                </div>
                <?php if ($buildProps['userProps']['UF_DISCOUNT_TEXT']['VALUE']) {
                    ?>
                    <div class="p-discount flex">
                        <div class="p-discount__ic">%</div>
                        <p class="p-discount__txt"><?=$buildProps['userProps']['UF_DISCOUNT_TEXT']['VALUE'];?></p>
                    </div>
                    <?
                } ?>
                <?
                    $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_*", "IBLOCK_ID");
                    $arFilter = Array(
                        "IBLOCK_ID" => $section['IBLOCK_ID'],
                        "INCLUDE_SUBSECTIONS" => "Y",
                        "ACTIVE" => "Y",
                        "SECTION_ID" => $section['ID'],
                        "PROPERTY_propertytype" => "жилая"
                    );
                    $minPriceApartment = [];
                    $res = CIBlockElement::GetList(Array("PROPERTY_price" => "ASC"), $arFilter, false, Array("nPageSize"=>1), $arSelect);
                    while($ob = $res->GetNextElement()) {
                        $minPriceApartment = $ob->GetFields();
                        $minPriceApartment['PROPERTIES'] = $ob->GetProperties();
                    }
                    $minPriceArray = number_format(  $minPriceApartment['PROPERTIES']['price']['VALUE'], 0, '', ' ');
                    $minPriceArray = explode(" ",$minPriceArray);
                ?>
                <div class="quarter__footer">
                    <div class="p-key p-key--blue">
                        <div class="p-key__ic"> </div>
                        <div class="p-key__txt">Квартиры от <b><?=$minPriceArray[0]. "," .$minPriceArray[1][0]?> </b>млн/р.</div>
                    </div>
                    <?php
                    if ($buildProps['userProps']['UF_KEYS_DATE']["VALUE"]) {
                        ?>
                        <div class="p-key p-key--green">
                            <div class="p-key__ic"> </div>
                            <div class="p-key__txt"><?=$buildProps['userProps']['UF_KEYS_DATE']["VALUE"];?></div>
                        </div>
                        <?
                    }
                    ?>

                    <a class="btn btn--bg" href="<?=$section['SECTION_PAGE_URL']?>">
                        <img class="svg btn__ic ic-arrow" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-arrow.svg" alt="link" width="20" height="20">Подробнее
                    </a>
                </div>
			</div>
		</div>
	<?endforeach?>
    </div>
    <!-- /.quarter-list 1-->
  </div>
  <!-- /.container-->
</section>

 

<?
/*
?><div class="<? echo $arCurView['CONT']; ?>"><?
if ('Y' == $arParams['SHOW_PARENT_NAME'] && 0 < $arResult['SECTION']['ID'])
{
	$this->AddEditAction($arResult['SECTION']['ID'], $arResult['SECTION']['EDIT_LINK'], $strSectionEdit);
	$this->AddDeleteAction($arResult['SECTION']['ID'], $arResult['SECTION']['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

	?><h1
		class="<? echo $arCurView['TITLE']; ?>"
		id="<? echo $this->GetEditAreaId($arResult['SECTION']['ID']); ?>"
	><a href="<? echo $arResult['SECTION']['SECTION_PAGE_URL']; ?>"><?
		echo (
			isset($arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]) && $arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"] != ""
			? $arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]
			: $arResult['SECTION']['NAME']
		);
	?></a></h1><?
}
if (0 < $arResult["SECTIONS_COUNT"])
{
?>
<ul class="<? echo $arCurView['LIST']; ?>">
<?
	switch ($arParams['VIEW_MODE'])
	{
		case 'LINE':
			foreach ($arResult['SECTIONS'] as &$arSection)
			{
				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

				if (false === $arSection['PICTURE'])
					$arSection['PICTURE'] = array(
						'SRC' => $arCurView['EMPTY_IMG'],
						'ALT' => (
							'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
							? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
							: $arSection["NAME"]
						),
						'TITLE' => (
							'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
							? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
							: $arSection["NAME"]
						)
					);
				?><li id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
				<a
					href="<? echo $arSection['SECTION_PAGE_URL']; ?>"
					class="bx_catalog_line_img"
					style="background-image: url('<? echo $arSection['PICTURE']['SRC']; ?>');"
					title="<? echo $arSection['PICTURE']['TITLE']; ?>"
				></a>
				<h2 class="bx_catalog_line_title"><a href="<? echo $arSection['SECTION_PAGE_URL']; ?>"><? echo $arSection['NAME']; ?></a><?
				if ($arParams["COUNT_ELEMENTS"])
				{
					?> <span>(<? echo $arSection['ELEMENT_CNT']; ?>)</span><?
				}
				?></h2><?
				if ('' != $arSection['DESCRIPTION'])
				{
					?><p class="bx_catalog_line_description"><? echo $arSection['DESCRIPTION']; ?></p><?
				}
				?><div style="clear: both;"></div>
				</li><?
			}
			unset($arSection);
			break;
		case 'TEXT':
			foreach ($arResult['SECTIONS'] as &$arSection)
			{
				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

				?><li id="<? echo $this->GetEditAreaId($arSection['ID']); ?>"><h2 class="bx_catalog_text_title"><a href="<? echo $arSection['SECTION_PAGE_URL']; ?>"><? echo $arSection['NAME']; ?></a><?
				if ($arParams["COUNT_ELEMENTS"])
				{
					?> <span>(<? echo $arSection['ELEMENT_CNT']; ?>)</span><?
				}
				?></h2></li><?
			}
			unset($arSection);
			break;
		case 'TILE':
			foreach ($arResult['SECTIONS'] as &$arSection)
			{
				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

				if (false === $arSection['PICTURE'])
					$arSection['PICTURE'] = array(
						'SRC' => $arCurView['EMPTY_IMG'],
						'ALT' => (
							'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
							? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
							: $arSection["NAME"]
						),
						'TITLE' => (
							'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
							? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
							: $arSection["NAME"]
						)
					);
				?><li id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
				<a
					href="<? echo $arSection['SECTION_PAGE_URL']; ?>"
					class="bx_catalog_tile_img"
					style="background-image:url('<? echo $arSection['PICTURE']['SRC']; ?>');"
					title="<? echo $arSection['PICTURE']['TITLE']; ?>"
					> </a><?
				if ('Y' != $arParams['HIDE_SECTION_NAME'])
				{
					?><h2 class="bx_catalog_tile_title"><a href="<? echo $arSection['SECTION_PAGE_URL']; ?>"><? echo $arSection['NAME']; ?></a><?
					if ($arParams["COUNT_ELEMENTS"])
					{
						?> <span>(<? echo $arSection['ELEMENT_CNT']; ?>)</span><?
					}
				?></h2><?
				}
				?></li><?
			}
			unset($arSection);
			break;
		case 'LIST':
			$intCurrentDepth = 1;
			$boolFirst = true;
			foreach ($arResult['SECTIONS'] as &$arSection)
			{
				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

				if ($intCurrentDepth < $arSection['RELATIVE_DEPTH_LEVEL'])
				{
					if (0 < $intCurrentDepth)
						echo "\n",str_repeat("\t", $arSection['RELATIVE_DEPTH_LEVEL']),'<ul>';
				}
				elseif ($intCurrentDepth == $arSection['RELATIVE_DEPTH_LEVEL'])
				{
					if (!$boolFirst)
						echo '</li>';
				}
				else
				{
					while ($intCurrentDepth > $arSection['RELATIVE_DEPTH_LEVEL'])
					{
						echo '</li>',"\n",str_repeat("\t", $intCurrentDepth),'</ul>',"\n",str_repeat("\t", $intCurrentDepth-1);
						$intCurrentDepth--;
					}
					echo str_repeat("\t", $intCurrentDepth-1),'</li>';
				}

				echo (!$boolFirst ? "\n" : ''),str_repeat("\t", $arSection['RELATIVE_DEPTH_LEVEL']);
				?><li id="<?=$this->GetEditAreaId($arSection['ID']);?>"><h2 class="bx_sitemap_li_title"><a href="<? echo $arSection["SECTION_PAGE_URL"]; ?>"><? echo $arSection["NAME"];?><?
				if ($arParams["COUNT_ELEMENTS"])
				{
					?> <span>(<? echo $arSection["ELEMENT_CNT"]; ?>)</span><?
				}
				?></a></h2><?

				$intCurrentDepth = $arSection['RELATIVE_DEPTH_LEVEL'];
				$boolFirst = false;
			}
			unset($arSection);
			while ($intCurrentDepth > 1)
			{
				echo '</li>',"\n",str_repeat("\t", $intCurrentDepth),'</ul>',"\n",str_repeat("\t", $intCurrentDepth-1);
				$intCurrentDepth--;
			}
			if ($intCurrentDepth > 0)
			{
				echo '</li>',"\n";
			}
			break;
	}
?>
</ul>
<?
	echo ('LINE' != $arParams['VIEW_MODE'] ? '<div style="clear: both;"></div>' : '');
}
?></div>