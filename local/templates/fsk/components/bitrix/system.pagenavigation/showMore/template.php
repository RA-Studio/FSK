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

if(!$arResult["NavShowAlways"])
{
    if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
        return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
?>
<?if ($arResult["NavPageNomer"]<$arResult["NavPageCount"]){?>
    <div class="p-list-more">
        <button class="btn btn--transp"  data-entity="showMore" data-num="<?=$arResult["NavNum"]?>" data-url="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>" data-count="<?=$arResult["NavPageNomer"]?>" data-limit="<?=$arResult["NavPageCount"]?>" type="button">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="svg btn__ic ic-arrow ic-arrow--down inlined-svg" width="20" height="20" role="img" aria-labelledby="title"><title>link</title><g transform="translate(0 20) rotate(-90)"><g transform="translate(20) rotate(90)" fill="none"><path d="M10,0A10,10,0,1,1,0,10,10,10,0,0,1,10,0Z" stroke="none"></path><path d="M 10.00000095367432 1.500001907348633 C 5.313080787658691 1.500001907348633 1.500001907348633 5.313080787658691 1.500001907348633 10.00000095367432 C 1.500001907348633 14.68692111968994 5.313080787658691 18.5 10.00000095367432 18.5 C 14.68692111968994 18.5 18.5 14.68692111968994 18.5 10.00000095367432 C 18.5 5.313080787658691 14.68692111968994 1.500001907348633 10.00000095367432 1.500001907348633 M 10.00000095367432 1.9073486328125e-06 C 15.52285099029541 1.9073486328125e-06 20 4.477150917053223 20 10.00000095367432 C 20 15.52285099029541 15.52285099029541 20 10.00000095367432 20 C 4.477150917053223 20 1.9073486328125e-06 15.52285099029541 1.9073486328125e-06 10.00000095367432 C 1.9073486328125e-06 4.477150917053223 4.477150917053223 1.9073486328125e-06 10.00000095367432 1.9073486328125e-06 Z" stroke="none"></path></g><g transform="translate(7.236 5.719)"><g transform="translate(5.504 5.4) rotate(90)"><g transform="translate(0 5.504) rotate(-90)"><path d="M0,0,2.752,2.752,5.5,0" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"></path></g></g><line y2="7.826" transform="translate(2.739)" fill="none" stroke-linecap="round" stroke-width="1.5"></line></g></g></svg>
            Показать ещё
        </button>
    </div>
<?}?>
