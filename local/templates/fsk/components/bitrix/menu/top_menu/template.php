<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<ul class="main-menu">
    <?
    foreach($arResult as $arItem):
        if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
            continue;
    ?>
        <?if($arItem["SELECTED"]):?>
            <?php if($arItem["TEXT"] === 'Избранное'): ?>
                <li>
                    <a class="link-favourite" href="<?=$arItem["LINK"]?>">
                        <span class="dashed-underline"><?=$arItem["TEXT"]?></span>
                        <svg class="svg" xmlns="http://www.w3.org/2000/svg" width="22.712" height="21.673" viewBox="0 0 22.712 21.673"><path d="M10.606,0l3.277,6.64,7.329,1.071-5.3,5.165,1.252,7.3-6.555-3.447L4.052,20.173l1.252-7.3L0,7.711,7.329,6.64,10.606,0Z" transform="translate(0.75 0.75)" fill="none" stroke="#e94200" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/></svg>
                        <!--img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-star.svg" alt="Избранное"-->
                    </a>
                </li>
            <?php else: ?>
                <li class="active">
                    <a href="<?=$arItem["LINK"]?>" class="selected"><?=$arItem["TEXT"]?></a>
                </li>
            <?php endif; ?>
        <?else:?>
            <li>
                <?if ($arItem["TEXT"] === 'Избранное') { ?>
                    <a class="link-favourite" href="<?=$arItem["LINK"]?>">
                        <span class="dashed-underline"><?=$arItem["TEXT"]?></span>
                        <svg class="svg" xmlns="http://www.w3.org/2000/svg" width="22.712" height="21.673" viewBox="0 0 22.712 21.673"><path d="M10.606,0l3.277,6.64,7.329,1.071-5.3,5.165,1.252,7.3-6.555-3.447L4.052,20.173l1.252-7.3L0,7.711,7.329,6.64,10.606,0Z" transform="translate(0.75 0.75)" fill="none" stroke="#e94200" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/></svg>
                        <!--img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-star.svg" alt="Избранное"-->
                    </a>
                    <?
                } else { ?>
                    <a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                    <?
                }?>
            </li>
        <?endif?>

    <?endforeach?>
</ul>
<?endif?>
