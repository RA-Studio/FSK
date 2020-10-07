<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
    <div class="mob-menu">
        <?if(
            CSite::InDir('/newbuild/') ||
            CSite::InDir('/index.php') ||
            CSite::InDir('/commercial/')
        ):?>
            <a class="btn btn--bg header-top__link" href="#filter-anchor" onclick="$(`.menu-trigger`).trigger('click')">
                <svg class="svg btn__ic" style="width:15px; height: 15px" xmlns="http://www.w3.org/2000/svg" width="16.5" height="15.5" viewBox="0 0 16.5 15.5"><g transform="translate(0.75 0.75)"><path d="M0,0H15" transform="translate(0 7)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><circle cx="2" cy="2" r="2" transform="translate(2.872 5)" fill="#e94200" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><path d="M0,0H15" transform="translate(0 2)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><circle cx="2" cy="2" r="2" transform="translate(10.872)" fill="#e94200" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><path d="M0,0H15" transform="translate(0 12)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><circle cx="2" cy="2" r="2" transform="translate(10.872 10)" fill="#e94200" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/></g></svg>
                Выбрать квартиру
            </a>
        <?else:?>
            <a class="btn btn--bg header-top__link" href="/newbuild/">
            <svg class="svg btn__ic" style="width:15px; height: 15px" xmlns="http://www.w3.org/2000/svg" width="16.5" height="15.5" viewBox="0 0 16.5 15.5"><g transform="translate(0.75 0.75)"><path d="M0,0H15" transform="translate(0 7)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><circle cx="2" cy="2" r="2" transform="translate(2.872 5)" fill="#e94200" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><path d="M0,0H15" transform="translate(0 2)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><circle cx="2" cy="2" r="2" transform="translate(10.872)" fill="#e94200" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><path d="M0,0H15" transform="translate(0 12)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><circle cx="2" cy="2" r="2" transform="translate(10.872 10)" fill="#e94200" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/></g></svg>
                Выбрать квартиру
            </a>
        <?endif?>
        <ul class="mob-menu__list">
            <?
            foreach($arResult as $arItem):
                if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) continue;
            ?>
                <?if($arItem["TEXT"] != 'Кабинет покупателя'){?>
                    <li>
                        <a class="mob-menu__title" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                    </li>
                <?} else {?>
                    <li>
                        <a class="mob-menu__title login-modal-open" href="/lk/">Кабинет покупателя</a>
                    </li>
                <?}?>
            <?endforeach?>
            <li class="highlighted"><a class="sub-contacts__link" href="tel:+78127035555">
                <div class="ic-container"><svg style="width:12px; height: 20px" xmlns="http://www.w3.org/2000/svg" width="14.547" height="24.331" viewBox="0 0 14.547 24.331"><g transform="translate(-8967.75 1214.75)"><path d="M0,.5H13.047" transform="translate(8968.5 -1195.909)" fill="none" stroke="#e94200" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><path d="M0,1.25H3.262" transform="translate(8973.393 -1211.988)" fill="none" stroke="#e94200" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><rect width="13.047" height="22.831" rx="2" transform="translate(8968.5 -1214)" stroke-width="1.5" stroke="#e94200" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" fill="none"/></g></svg></div>
                +7 (812) 703-55-55</a>
            </li>
            <li class="highlighted">
                <a class="sub-contacts__link" href="mailto:info@fsknw.ru">
                    <div class="ic-container"><svg class="svg btn__ic" style="width:20px; height: 15px" xmlns="http://www.w3.org/2000/svg" width="19.748" height="15.1" viewBox="0 0 19.748 15.1"><g transform="translate(0.15 -57.6)"><g transform="translate(0 57.75)"><path d="M17.074,57.75H2.378A2.38,2.38,0,0,0,0,60.128V70.172A2.38,2.38,0,0,0,2.378,72.55H17.07a2.38,2.38,0,0,0,2.378-2.378V60.132A2.378,2.378,0,0,0,17.074,57.75Zm1.292,12.422a1.293,1.293,0,0,1-1.292,1.292H2.378a1.293,1.293,0,0,1-1.292-1.292V60.132A1.293,1.293,0,0,1,2.378,58.84H17.07a1.293,1.293,0,0,1,1.292,1.292v10.04Z" transform="translate(0 -57.75)" fill="#e94200" stroke="#e94200" stroke-width="0.3"/><path d="M64.533,113.474l4.168-3.737a.477.477,0,0,0-.638-.709l-5.747,5.158-1.121-1s-.007-.007-.007-.011a.706.706,0,0,0-.078-.067l-4.562-4.083a.477.477,0,0,0-.635.712l4.217,3.769-4.2,3.931a.478.478,0,0,0-.021.673.487.487,0,0,0,.349.152.477.477,0,0,0,.324-.127l4.263-3.988L62,115.18a.475.475,0,0,0,.635,0l1.188-1.065,4.238,4.026a.477.477,0,0,0,.673-.018.478.478,0,0,0-.018-.673Z" transform="translate(-52.583 -106.182)" fill="#e94200" stroke="#e94200" stroke-width="0.3"/></g></g></svg></div>
                    info@fsknw.ru
                </a>
            </li>
            <li class="highlighted">
                <a class="sub-contacts__link" href="<?=$arItem["LINK"]?>">
                    
                    <div class="ic-container"><svg class="svg btn__ic" style="width:14px; height: 19px" xmlns="http://www.w3.org/2000/svg" width="12.883" height="18.322" viewBox="0 0 12.883 18.322"><g transform="translate(-76)"><g transform="translate(76)"><path d="M82.441,0a6.442,6.442,0,0,0-5.48,9.828l5.113,8.24a.537.537,0,0,0,.456.254h0a.537.537,0,0,0,.456-.261l4.983-8.32A6.443,6.443,0,0,0,82.441,0Zm4.611,9.19-4.53,7.564L77.874,9.263a5.371,5.371,0,1,1,9.179-.073Z" transform="translate(-76 0)" fill="#ea4f10"/></g><g transform="translate(79.221 3.221)"><path d="M169.221,90a3.221,3.221,0,1,0,3.221,3.221A3.224,3.224,0,0,0,169.221,90Zm0,5.375a2.154,2.154,0,1,1,2.151-2.154A2.156,2.156,0,0,1,169.221,95.375Z" transform="translate(-166 -90)" fill="#ea4f10"/></g></g></svg></div>
                    Большой пр. ПС, д.48
                </a>
            </li>
            <li class="highlighted">
                <span class="sub-contacts__link">
                    <div class="ic-container">
                        <div class="ic-container"><svg xmlns="http://www.w3.org/2000/svg" class="svg btn__ic" width="19" height="19" viewBox="0 0 19 19"><g transform="translate(-724.5 -611)"><g transform="translate(131 -43)"><g transform="translate(593.5 654)" fill="none" stroke="#e94200" stroke-width="1.5"><circle cx="9.5" cy="9.5" r="9.5" stroke="none"/><circle cx="9.5" cy="9.5" r="8.75" fill="none"/></g><line y2="1" transform="translate(596 663.5) rotate(90)" fill="none" stroke="#e94200" stroke-linecap="round" stroke-width="1.5"/><line y2="1" transform="translate(603 655.5)" fill="none" stroke="#e94200" stroke-linecap="round" stroke-width="1.5"/><line y2="1" transform="translate(603 670.5)" fill="none" stroke="#e94200" stroke-linecap="round" stroke-width="1.5"/><line y1="3" transform="translate(603 660.5)" fill="none" stroke="#e94200" stroke-linecap="round" stroke-width="1.5"/><path d="M3.139,3.039,0,0" transform="translate(603 663.5)" fill="none" stroke="#e94200" stroke-linecap="round" stroke-width="1.5"/><line y2="1" transform="translate(611 663.5) rotate(90)" fill="none" stroke="#e94200" stroke-linecap="round" stroke-width="1.5"/></g></g></svg></div>
                    </div>
                    9:00 - 21:00 (Ежедневно)
                </span>
            </li>
        </ul>
    </div>
<?endif?>
