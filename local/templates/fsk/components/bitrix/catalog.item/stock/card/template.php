<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array $price
 * @var array $measureRatio
 * @var bool $haveOffers
 * @var bool $showSubscribe
 * @var array $morePhoto
 * @var bool $showSlider
 * @var bool $itemHasDetailUrl
 * @var string $imgTitle
 * @var string $productTitle
 * @var string $buttonSizeClass
 * @var CatalogSectionComponent $component
 */
use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;
$date = $item['DATE_ACTIVE_FROM']?$item['DATE_ACTIVE_FROM']:$item['DATE_CREATE'];
$preview = !empty($item['PROPERTIES']['UF_PREVIEW_PICTURE']['VALUE'])?$item['PROPERTIES']['UF_PREVIEW_PICTURE']['VALUE']:$item['PREVIEW_PICTURE']['ID'];
?><div class="p-item__img">
    <a href="<?=$item['DETAIL_PAGE_URL']?>" target="_blank">
    <?if(!empty($item['PREVIEW_PICTURE']['SRC'])){?>
        <?$img = \CFile::ResizeImageGet($preview, array('width'=>3, 'height'=>1), BX_RESIZE_IMAGE_EXACT, true)['src']?>
		<?$imgL = \CFile::ResizeImageGet($preview, array('width'=>306, 'height'=>240), BX_RESIZE_IMAGE_EXACT, true)['src']?>
        <img alt="<?=$item['PREVIEW_PICTURE']['ALT']?>" data-loda-img="<?=$imgL?>" data-src="<?=$img?>" class="img"><?
    }
    ?></a><?
    if(!empty($item['PROPERTIES']['UF_DISCOUNTS_TAGS']['VALUE'])){
        ?><div class="p-labels p-labels--absolute"><?
            foreach ($item['PROPERTIES']['UF_DISCOUNTS_TAGS']['VALUE'] as $tag){
                ?><span class="p-label"><?=$tag?></span><?
            }
        ?></div><?
    }
?></div>
<div class="p-item__content">
    <span class="p-item__date"><?= FormatDate('d F Y', MakeTimeStamp($date))?></span>
    <div class="p-item__title">
        <a href="<?=$item['DETAIL_PAGE_URL']?>"><?=$item['PROPERTIES']['UF_DISCOUNTS_SUBTITLE']['VALUE']?$item['PROPERTIES']['UF_DISCOUNTS_SUBTITLE']['VALUE']:$item['NAME']?></a>
    </div>
    <a class="btn btn--transp" href="<?=$item['DETAIL_PAGE_URL']?>" target="_blank">
        <img width="20" alt="link" data-src="/local/templates/fsk/img/icons/ic-read.svg" height="20" class="svg btn__ic ic-read lazyload">
        Подробнее
    </a>
</div>