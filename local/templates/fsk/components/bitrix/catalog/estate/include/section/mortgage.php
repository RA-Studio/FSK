<?if($typeOfApartment != "commercial"):?>
            <div class="project-ipo scrollspy-item" id="p-7">
                <div class="container">
                    <h2 class="h1 title">Ипотека - это просто!</h2>
                    <div class="ipo">
                        <div class="ipo-calc">
                            <div class="filter-row">
                                <div class="filter-fields">
                                    <div class="filter__field filter-field" data-name="credit">
                                        <div class="filter-field__label">Стоимость, р. </div>
                                        <div class="ui-quantity" data-step="100000">
                                            <button class="ui-quantity__btn ui-quantity__minus" data-event="mortgageFilter">
                                                <svg class="svg" style="width: 10px;height: 2px" xmlns="http://www.w3.org/2000/svg" width="11.5" height="1.5" viewBox="0 0 11.5 1.5"><path d="M0,.5H10" transform="translate(0.75 0.25)" fill="none" stroke="#bebebe" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/></svg>
                                            </button>
                                            <input type="text" value="2 500 000">
                                            <button class="ui-quantity__btn ui-quantity__plus" data-event="mortgageFilter">
                                                <svg class="svg" style="width: 10px;height: 10px" xmlns="http://www.w3.org/2000/svg" width="11.5" height="11.5" viewBox="0 0 11.5 11.5"><g transform="translate(0.75 0.75)"><path d="M.357,0V10" transform="translate(4.643)" fill="none" stroke="#bebebe" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><path d="M0,.357H10" transform="translate(0 4.643)" fill="none" stroke="#bebebe" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/></g></svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="filter__field filter-field" data-name="first">
                                        <div class="filter-field__label">Первоначальный взнос</div>
                                        <div class="ui-quantity" data-step="100000">
                                            <button class="ui-quantity__btn ui-quantity__minus" data-event="mortgageFilter">
                                                <svg class="svg" style="width: 10px;height: 2px" xmlns="http://www.w3.org/2000/svg" width="11.5" height="1.5" viewBox="0 0 11.5 1.5"><path d="M0,.5H10" transform="translate(0.75 0.25)" fill="none" stroke="#bebebe" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/></svg>
                                            </button>
                                            <input type="text" value="1 500 000">
                                            <button class="ui-quantity__btn ui-quantity__plus" data-event="mortgageFilter">
                                                <svg class="svg" style="width: 10px;height: 10px" xmlns="http://www.w3.org/2000/svg" width="11.5" height="11.5" viewBox="0 0 11.5 11.5"><g transform="translate(0.75 0.75)"><path d="M.357,0V10" transform="translate(4.643)" fill="none" stroke="#bebebe" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><path d="M0,.357H10" transform="translate(0 4.643)" fill="none" stroke="#bebebe" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/></g></svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="filter__field filter-field" data-name="age">
                                        <div class="filter-field__label">Срок</div>
                                        <div class="ui-quantity ui-quantity--years" data-step="1">
                                            <button class="ui-quantity__btn ui-quantity__minus" data-event="mortgageFilter">
                                                <svg class="svg" style="width: 10px;height: 2px" xmlns="http://www.w3.org/2000/svg" width="11.5" height="1.5" viewBox="0 0 11.5 1.5"><path d="M0,.5H10" transform="translate(0.75 0.25)" fill="none" stroke="#bebebe" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/></svg>
                                            </button>
                                            <input class="years" type="text" value="10 лет">
                                            <button class="ui-quantity__btn ui-quantity__plus" data-event="mortgageFilter">
                                                <svg class="svg" style="width: 10px;height: 10px" xmlns="http://www.w3.org/2000/svg" width="11.5" height="11.5" viewBox="0 0 11.5 11.5"><g transform="translate(0.75 0.75)"><path d="M.357,0V10" transform="translate(4.643)" fill="none" stroke="#bebebe" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><path d="M0,.357H10" transform="translate(0 4.643)" fill="none" stroke="#bebebe" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/></g></svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="filter__field filter-field-result">
                                        <button class="btn btn--bg" type="button" id="schet-platezh" <?//data-event="mortgageFilter"?>>
                                            <svg class="svg btn__ic" style="width: 20px;height: 20px" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><g transform="translate(-1292 -4412)"><g transform="translate(1292 4412)" fill="none"><path d="M10,0A10,10,0,1,1,0,10,10,10,0,0,1,10,0Z" stroke="none"/><path d="M 10 1.5 C 5.313079833984375 1.5 1.5 5.313079833984375 1.5 10 C 1.5 14.68692016601563 5.313079833984375 18.5 10 18.5 C 14.68692016601563 18.5 18.5 14.68692016601563 18.5 10 C 18.5 5.313079833984375 14.68692016601563 1.5 10 1.5 M 10 0 C 15.52285003662109 0 20 4.477149963378906 20 10 C 20 15.52285003662109 15.52285003662109 20 10 20 C 4.477149963378906 20 0 15.52285003662109 0 10 C 0 4.477149963378906 4.477149963378906 0 10 0 Z" stroke="none" fill="#fff"/></g><g transform="translate(-0.77 -0.826)"><line y1="7" x2="6.77" transform="translate(1299.5 4419.326)" fill="none" stroke="#fff" stroke-linecap="round" stroke-width="1.5"/><g transform="translate(1298.77 4418.826)" fill="#fff" stroke="#fff" stroke-width="1"><circle cx="1" cy="1" r="1" stroke="none"/><circle cx="1" cy="1" r="0.5" fill="none"/></g><g transform="translate(1304.77 4424.826)" fill="#fff" stroke="#fff" stroke-width="1"><circle cx="1" cy="1" r="1" stroke="none"/><circle cx="1" cy="1" r="0.5" fill="none"/></g></g></g></svg>
                                            Рассчитать платеж
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:news.list",
                            "mortgage",
                            Array(
                                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                "ADD_SECTIONS_CHAIN" => "N",
                                "AJAX_MODE" => "N",
                                "AJAX_OPTION_ADDITIONAL" => "",
                                "AJAX_OPTION_HISTORY" => "N",
                                "AJAX_OPTION_JUMP" => "N",
                                "AJAX_OPTION_STYLE" => "Y",
                                "CACHE_FILTER" => "N",
                                "CACHE_GROUPS" => "Y",
                                "CACHE_TIME" => "36000000",
                                "CACHE_TYPE" => "A",
                                "CHECK_DATES" => "Y",
                                "DETAIL_URL" => "",
                                "DISPLAY_BOTTOM_PAGER" => "N",
                                "DISPLAY_DATE" => "N",
                                "DISPLAY_NAME" => "Y",
                                "DISPLAY_PICTURE" => "Y",
                                "DISPLAY_PREVIEW_TEXT" => "Y",
                                "DISPLAY_TOP_PAGER" => "N",
                                "FIELD_CODE" => array("",""),
                                "FILE_404" => "",
                                "FILTER_NAME" => "",
                                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                "IBLOCK_ID" => "11",
                                "IBLOCK_TYPE" => "kompleks",
                                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                "INCLUDE_SUBSECTIONS" => "N",
                                "MESSAGE_404" => "",
                                "NEWS_COUNT" => "20",
                                "PAGER_BASE_LINK_ENABLE" => "N",
                                "PAGER_DESC_NUMBERING" => "N",
                                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                "PAGER_SHOW_ALL" => "N",
                                "PAGER_SHOW_ALWAYS" => "N",
                                "PAGER_TEMPLATE" => ".default",
                                "PAGER_TITLE" => "Новости",
                                "PARENT_SECTION" => "",
                                "PARENT_SECTION_CODE" => "",
                                "PREVIEW_TRUNCATE_LEN" => "",
                                "PROPERTY_CODE" => array("UF_BIK","UF_DATE","UF_NAME","UF_NUMBER","UF_VALUE",""),
                                "SET_BROWSER_TITLE" => "N",
                                "SET_LAST_MODIFIED" => "N",
                                "SET_META_DESCRIPTION" => "N",
                                "SET_META_KEYWORDS" => "N",
                                "SET_STATUS_404" => "Y",
                                "SET_TITLE" => "N",
                                "SHOW_404" => "Y",
                                "SORT_BY1" => "ACTIVE_FROM",
                                "SORT_BY2" => "SORT",
                                "SORT_ORDER1" => "DESC",
                                "SORT_ORDER2" => "ASC",
                                "STRICT_SECTION_CHECK" => "N"
                            )
                        );?>
                    </div>
                    <div class="ipo-more show-more-ipoteka">
                        <button class="btn btn--transp" type="button" data-event="showMoreIpoteka">
                            <svg class="svg btn__ic ic-arrow ic-arrow--down" style="width: 20px;height: 20px" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><g transform="translate(0 20) rotate(-90)"><g transform="translate(20) rotate(90)" fill="none"><path d="M10,0A10,10,0,1,1,0,10,10,10,0,0,1,10,0Z" stroke="none"/><path d="M 10.00000095367432 1.500001907348633 C 5.313080787658691 1.500001907348633 1.500001907348633 5.313080787658691 1.500001907348633 10.00000095367432 C 1.500001907348633 14.68692111968994 5.313080787658691 18.5 10.00000095367432 18.5 C 14.68692111968994 18.5 18.5 14.68692111968994 18.5 10.00000095367432 C 18.5 5.313080787658691 14.68692111968994 1.500001907348633 10.00000095367432 1.500001907348633 M 10.00000095367432 1.9073486328125e-06 C 15.52285099029541 1.9073486328125e-06 20 4.477150917053223 20 10.00000095367432 C 20 15.52285099029541 15.52285099029541 20 10.00000095367432 20 C 4.477150917053223 20 1.9073486328125e-06 15.52285099029541 1.9073486328125e-06 10.00000095367432 C 1.9073486328125e-06 4.477150917053223 4.477150917053223 1.9073486328125e-06 10.00000095367432 1.9073486328125e-06 Z" stroke="none"/></g><g transform="translate(7.236 5.719)"><g transform="translate(5.504 5.4) rotate(90)"><g transform="translate(0 5.504) rotate(-90)"><path d="M0,0,2.752,2.752,5.5,0" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/></g></g><line y2="7.826" transform="translate(2.739)" fill="none" stroke-linecap="round" stroke-width="1.5"/></g></g></svg>
                            Показать ещё
                        </button>
                    </div>
                </div>
            </div>
        <?endif?>