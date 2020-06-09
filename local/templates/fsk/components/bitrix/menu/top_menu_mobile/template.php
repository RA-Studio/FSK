<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
    <div class="mob-menu">
        <?if(
            CSite::InDir('/newbuild/') ||
            CSite::InDir('/index.php') ||
            CSite::InDir('/commercial/')
        ):?>
            <a class="btn btn--bg header-top__link" href="#filter-anchor" onclick="$(`.menu-trigger`).trigger('click')">
                <img class="svg btn__ic" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-filters-white.svg" width="15" height="15" alt="alt">
                Выбрать квартиру
            </a>
        <?else:?>
            <a class="btn btn--bg header-top__link" href="/newbuild/">
                <img class="svg btn__ic" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-filters-white.svg" width="15" height="15" alt="alt">
                Выбрать квартиру
            </a>
        <?endif?>

        <ul class="mob-menu__list">
            <?
            foreach($arResult as $arItem):
                if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
                    continue;
            ?>
                <?/* if ($arItem["TEXT"] === 'Избранное') {
                ?>
                <li>
                    <a class="mob-link-favourite" href="/favourite/">
                        <div class="ic-container">
                            <img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-star.svg" width="22" height="21" alt="Закладки">
                        </div>
                        <?=$arItem["TEXT"];?>
                    </a>
                </li>
                <li class="highlighted"><a class="sub-contacts__link" href="tel:+78127035555">
                    <div class="ic-container"><img class="svg svg-stroke btn__ic" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-tel.svg" alt="tel" width="12" height="20"></div>
                    +7 (812) 703-55-55</a>
                </li>
                <li class="highlighted">
                    <a class="sub-contacts__link" href="mailto:info@fsknw.ru">
                        <div class="ic-container"><img class="svg btn__ic" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-envelope.svg" alt="email" width="20" height="15"></div>
                            info@fsknw.ru
                    </a>
                </li>
                <li class="highlighted">
                    <a class="sub-contacts__link" href="<?=$arItem["LINK"]?>">
                        <div class="ic-container"><img class="svg btn__ic" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-map-pin-sm-accent.svg" alt="geo" width="14" height="19"></div>
                        Большой пр. ПС, д.48
                    </a>
                </li>
                <li class="highlighted">
                    <span class="sub-contacts__link">
                        <div class="ic-container">
                            <img class="svg btn__ic" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-time.svg" alt="geo" width="19" height="19">
                        </div>
                        9:00 - 21:00 (Ежедневно)
                    </span>
                </li>
                <?
            } else if ($arItem["TEXT"] === 'Контакты') {
            ?>
                <li class="highlighted">
                    <a class="sub-contacts__link" href="<?=$arItem["LINK"]?>">
                        <div class="ic-container"><img class="svg btn__ic" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-map-pin-sm-accent.svg" alt="geo" width="14" height="19"></div>
                        Большой пр. ПС, д.48
                    </a>
                </li>
                <li class="highlighted">
                    <span class="sub-contacts__link">
                        <div class="ic-container">
                            <img class="svg btn__ic" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-time.svg" alt="geo" width="19" height="19">
                        </div>
                        9:00 - 21:00 (Ежедневно)
                    </span>
                </li>
            <?
            }else if ($arItem["TEXT"] === 'Кабинет покупателя') {

            }else {*/
                ?>
                <li>
                    <a class="mob-menu__title" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                </li>
                <?
            //}?>
            <?endforeach?>
            <!--<li>
                <a class="mob-link-favourite" href="/favourite/">
                    <div class="ic-container">
                        <img class="svg" src="<?/*=SITE_TEMPLATE_PATH*/?>/img/icons/ic-star.svg" width="22" height="21" alt="Закладки">
                    </div>
                    <?/*=$arItem["TEXT"];*/?>
                </a>
            </li>-->
            <li class="highlighted"><a class="sub-contacts__link" href="tel:+78127035555">
                    <div class="ic-container"><img class="svg svg-stroke btn__ic" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-tel.svg" alt="tel" width="12" height="20"></div>
                    +7 (812) 703-55-55</a>
            </li>
            <li class="highlighted">
                <a class="sub-contacts__link" href="mailto:info@fsknw.ru">
                    <div class="ic-container"><img class="svg btn__ic" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-envelope.svg" alt="email" width="20" height="15"></div>
                    info@fsknw.ru
                </a>
            </li>
            <li class="highlighted">
                <a class="sub-contacts__link" href="<?=$arItem["LINK"]?>">
                    <div class="ic-container"><img class="svg btn__ic" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-map-pin-sm-accent.svg" alt="geo" width="14" height="19"></div>
                    Большой пр. ПС, д.48
                </a>
            </li>
            <li class="highlighted">
                    <span class="sub-contacts__link">
                        <div class="ic-container">
                            <img class="svg btn__ic" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-time.svg" alt="geo" width="19" height="19">
                        </div>
                        9:00 - 21:00 (Ежедневно)
                    </span>
            </li>
        </ul>
    </div>
<?endif?>
