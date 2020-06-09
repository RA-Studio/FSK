<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
    <ul class="sub-menu__list">
        <?
        foreach($arResult as $arItem):
            if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
                continue;
        ?>
            <li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
            <?/*if($arItem["SELECTED"]):*/?><!--
                <li><a href="<?/*=$arItem["LINK"]*/?>" class="active"><?/*=$arItem["TEXT"]*/?></a></li>
            <?/*else:*/?>
                <li><a href="<?/*=$arItem["LINK"]*/?>"><?/*=$arItem["TEXT"]*/?></a></li>
            --><?/*endif*/?>
        <?endforeach?>
    </ul>
<?endif?>
