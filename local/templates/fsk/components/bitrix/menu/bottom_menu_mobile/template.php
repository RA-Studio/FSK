<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
    <div class="mob-menu">
        <div class="footer__logo">
            <img class="img" src="<?=SITE_TEMPLATE_PATH?>/img/svg-logo-gray.svg" alt="FSK">
            <!--svg xmlns="http://www.w3.org/2000/svg" width="153.35" height="51.379" viewBox="0 0 153.35 51.379"><g transform="translate(-102.357 -167.459)"><g transform="translate(161.737 172.331)"><path d="M281.971,205.1a7.475,7.475,0,1,1-1.2-11.113l4.073-5.733A14.516,14.516,0,1,0,286.09,210.9Z" transform="translate(-222.812 -179.261)"/><path d="M224.706,182.514l-4.06,5.717a7.98,7.98,0,0,1-.817,15.919v-28.8h-6.762v6.3a14.513,14.513,0,0,0,0,29.027v6.536h6.762v-6.536a14.505,14.505,0,0,0,4.877-28.169M205.088,196.17a7.981,7.981,0,0,1,7.98-7.981V204.15a7.98,7.98,0,0,1-7.98-7.979" transform="translate(-198.555 -175.352)"/><path d="M315.2,214.372h-7.384V186.5H315.2Zm.94-13.934,9.99-13.934h7.685l-10.073,13.734,10.6,14.134h-7.792l-10.412-13.934" transform="translate(-240.371 -179.62)"/></g><g transform="translate(102.357 167.459)"><path d="M134.871,183.557h29.091a25.758,25.758,0,0,0-15.207-13.884Z" transform="translate(-114.801 -168.306)" fill="#e94200"/><path d="M152.943,186.8H117.488a2.046,2.046,0,0,1-1.446-3.493l15.595-15.595a25.683,25.683,0,0,0-28.675,30.965H138.8a2.046,2.046,0,0,1,1.447,3.493L123.918,218.5a25.7,25.7,0,0,0,29.025-31.7Z" transform="translate(-102.357 -167.459)" fill="#e94200"/><path d="M135.02,224.668H105.387a25.763,25.763,0,0,0,15.092,14.542Z" transform="translate(-103.517 -189.355)" fill="#e94200"/></g></g></svg-->
        </div>
        <ul class="mob-menu__list">
            <?
            foreach($arResult as $arItem):
                if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
                    continue;
            ?>
                <?php if ($arItem["TEXT"] === 'Избранное') {
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
            ?><?/*
                <li>
                    <a class="lk-link sub-color" href="<?=$arItem["LINK"]?>">Кабинет покупателя</a>
                </li>
                <li>
                    <a class="confidence-link" href="#">Политика конфиденциальности</a>
                </li>*/?>
            <?
            }else {
                ?>
                <li>
                    <a class="mob-menu__title" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                </li>
                <?
            }?>
            <?endforeach?>
        </ul>
    </div>
<?endif?>
