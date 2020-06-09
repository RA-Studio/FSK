<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("TITLE", "Материнский капитал");
$APPLICATION->SetPageProperty("keywords", "Материнский капитал");
$APPLICATION->SetPageProperty("description", "Материнский капитал");
$APPLICATION->SetTitle("Материнский капитал");
?><div class="page page--nohero">
        <div class="container">
            <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "main_breadcrumbs", Array(
                "PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                "SITE_ID" => "s1",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                "START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
            ),
                false
            );?>
                <h1 class="title title-margin"><?=$APPLICATION->ShowTitle(false)?></h1>
                    <img alt="Материнский капитал" src="/local/templates/fsk/img/img-ipo-1.jpg" class="img ipo-block__img">
                    <div class="ipo-block__content">
                        <p>
                            Для поддержки семей с двумя и болле детьми государство с 2007 года реализует специальную социальную программу — материнский капитал. Использовать материнский капитал можно при покупке жилья в любом из наших объектов.
                        </p>
                        <div class="h3 text-bold">
                            Кто имеет право на получение материнского капитала:
                        </div>
                        <ul class="list">
                            <li>Мать или Отец ребенка на имя которого выдан сертификат на материнский капитал;</li>
                        </ul>
                        <div class="h3 text-bold">
                            Кто имеет право на получение материнского капитала:
                        </div>
                        <ul class="list">
                            <li>Паспорт гражданина РФ;</li>
                            <li>Свидетельства о рождении всех детей (для усыновлённых — свидетельства об усыновлении);</li>
                            <li>Документы подтверждающие Российское гражданство второго ребёнка.</li>
                        </ul>
                    </div>
                <div class="ipo">
                    <div class="ipo-calc">
                        <div class="filter-row">
                            <div class="filter-fields">
                                <div class="filter__field filter-field">
                                    <div class="filter-field__label">
                                        Стоимость, р.
                                    </div>
                                    <div class="ui-quantity" data-step="100000">
                                        <button class="ui-quantity__btn ui-quantity__minus"><img width="10" src="/local/templates/fsk/img/icons/ic-minus.svg" height="2" class="svg" alt="Минус"></button> <input type="text" value="2 500 000"> <button class="ui-quantity__btn ui-quantity__plus"><img width="10" src="/local/templates/fsk/img/icons/ic-plus.svg" height="10" class="svg" alt="Плюс"></button>
                                    </div>
                                </div>
                                <div class="filter__field filter-field">
                                    <div class="filter-field__label">
                                        Первоначальный взнос
                                    </div>
                                    <div class="ui-quantity" data-step="100000">
                                        <button class="ui-quantity__btn ui-quantity__minus"><img width="10" src="/local/templates/fsk/img/icons/ic-minus.svg" height="2" class="svg" alt="Минус"></button> <input type="text" value="1 500 000"> <button class="ui-quantity__btn ui-quantity__plus"><img width="10" src="/local/templates/fsk/img/icons/ic-plus.svg" height="10" class="svg" alt="Плюс"></button>
                                    </div>
                                </div>
                                <div class="filter__field filter-field">
                                    <div class="filter-field__label">
                                        Срок
                                    </div>
                                    <div class="ui-quantity ui-quantity--years" data-step="1">
                                        <button class="ui-quantity__btn ui-quantity__minus"><img width="10" src="/local/templates/fsk/img/icons/ic-minus.svg" height="2" class="svg" alt="Минус"></button> <input class="years" type="text" value="10 лет"> <button class="ui-quantity__btn ui-quantity__plus"><img width="10" src="/local/templates/fsk/img/icons/ic-plus.svg" height="10" class="svg" alt="Плюс"></button>
                                    </div>
                                </div>
                                <div class="filter__field filter-field-result">
                                    <button class="btn btn--bg" type="button"><img width="20" src="/local/templates/fsk/img/icons/ic-btn-percentage.svg" height="20" class="svg btn__ic" alt="Минус">Рассчитать платеж</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.ipo-calc-->
                    <div class="ipo-table">
                        <div class="ipo-table__row ipo-table__header">
                            <div class="ipo-bank">
                                Банк
                            </div>
                            <div class="ipo-info">
                                <div class="ipo-info__col">
                                    <span class="hide-on-mob">Ежемесячный </span>платёж, р.
                                </div>
                                <div class="ipo-info__col">
                                    Срок
                                </div>
                                <div class="ipo-info__col">
                                    Ставка
                                </div>
                            </div>
                        </div>
                        <div class="ipo-table__row">
                            <div class="ipo-bank">
                                <img src="/local/templates/fsk/img/ipo/sber.png" class="img" alt="Сбербанк">
                            </div>
                            <div class="ipo-licence">
                                <div>
                                    Сбербанк России ПАО
                                </div>
                                <span class="sub-text">Лицензия № 1481 от 11.08.2015</span>
                            </div>
                            <div class="ipo-info">
                                <div class="ipo-info__col" data-title="Ежемесячный платёж, р.">
                                    49 982
                                </div>
                                <div class="ipo-info__col" data-title="Срок">
                                    до 30 лет
                                </div>
                                <div class="ipo-info__col" data-title="Ставка">
                                    6%
                                </div>
                            </div>
                        </div>
                        <div class="ipo-table__row">
                            <div class="ipo-bank">
                                <img src="/local/templates/fsk/img/ipo/vtb.png" class="img" alt="ВТБ">
                            </div>
                            <div class="ipo-licence">
                                <div>
                                    Банк ВТБ
                                </div>
                                <span class="sub-text">Лицензия № 1481 от 11.08.2015</span>
                            </div>
                            <div class="ipo-info">
                                <div class="ipo-info__col" data-title="Ежемесячный платёж, р.">
                                    49 982
                                </div>
                                <div class="ipo-info__col" data-title="Срок">
                                    до 30 лет
                                </div>
                                <div class="ipo-info__col" data-title="Ставка">
                                    6%
                                </div>
                            </div>
                        </div>
                        <div class="ipo-table__row">
                            <div class="ipo-bank">
                                <img alt="Абсолют банк АКБ" src="/local/templates/fsk/img/ipo/absolute-bank.png" class="img">
                            </div>
                            <div class="ipo-licence">
                                <div>
                                    Абсолют банк АКБ (ЗАО)
                                </div>
                                <span class="sub-text">Лицензия № 1481 от 11.08.2015</span>
                            </div>
                            <div class="ipo-info">
                                <div class="ipo-info__col" data-title="Ежемесячный платёж, р.">
                                    49 982
                                </div>
                                <div class="ipo-info__col" data-title="Срок">
                                    до 30 лет
                                </div>
                                <div class="ipo-info__col" data-title="Ставка">
                                    6%
                                </div>
                            </div>
                        </div>
                        <div class="ipo-table__row">
                            <div class="ipo-bank">
                                <img alt="Банк Возрождение" src="/local/templates/fsk/img/ipo/vozrojdenie-bank.png" class="img">
                            </div>
                            <div class="ipo-licence">
                                <div>
                                    Банк Возрождение
                                </div>
                                <span class="sub-text">Лицензия № 1481 от 11.08.2015</span>
                            </div>
                            <div class="ipo-info">
                                <div class="ipo-info__col" data-title="Ежемесячный платёж, р.">
                                    49 982
                                </div>
                                <div class="ipo-info__col" data-title="Срок">
                                    до 30 лет
                                </div>
                                <div class="ipo-info__col" data-title="Ставка">
                                    6%
                                </div>
                            </div>
                        </div>
                        <div class="ipo-table__row">
                            <div class="ipo-bank">
                                <img src="/local/templates/fsk/img/ipo/sber.png" class="img" alt="Сбербанк">
                            </div>
                            <div class="ipo-licence">
                                <div>
                                    Сбербанк России ПАО
                                </div>
                                <span class="sub-text">Лицензия № 1481 от 11.08.2015</span>
                            </div>
                            <div class="ipo-info">
                                <div class="ipo-info__col" data-title="Ежемесячный платёж, р.">
                                    49 982
                                </div>
                                <div class="ipo-info__col" data-title="Срок">
                                    до 30 лет
                                </div>
                                <div class="ipo-info__col" data-title="Ставка">
                                    6%
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.ipo-table-->
                </div>
                <!-- /.ipo-->
                <div class="ipo-more">
                    <button class="btn btn--transp" type="button"><img width="20" alt="link" src="/local/templates/fsk/img/icons/ic-arrow.svg" height="20" class="svg btn__ic ic-arrow ic-arrow--down">Показать ещё</button>
                </div>
        </div>
        <!-- form-->
        <div class="cta">
            <div class="container">
                <div class="cta__inner">
                    <div class="h2 cta__title">
                        Нужна консультация специалиста?
                    </div>
                    <div class="cta__form cta-form">
                        <form action="#">
                            <div class="cta-form__row f-row">
                                <div class="cols col-1-3">
                                    <input class="input" type="text" name="name" placeholder="Ваше имя" reqiured="">
                                </div>
                                <div class="cols col-1-3">
                                    <input class="input" type="tel" name="tel" placeholder="Номер телефона" reqiured="">
                                </div>
                                <div class="cols col-1-3">
                                    <button class="btn btn--cta" type="submit"> <img width="12" alt="phone" src="/local/templates/fsk/img/icons/ic-tel.svg" height="20" class="svg btn__ic ic-tel">Позвоните мне</button>
                                </div>
                            </div>
                            <p class="privacy">
                                Отправляя форму, вы подтверждаете своё согласие на <a href="confidence.html" target="_blank">обработку персональных данных</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.form-->
    </div>
    <!-- /.page-->
<?/*
    <div class="modal ipo-request mfp-hide" id="ipo-request">
        <div class="ipo-request__body">
            <div class="ipo-request__header">
                <div class="ipo-bank">
                    <img src="/local/templates/fsk/img/ipo/vtb.png" class="img" alt="ВТБ">
                </div>
                <button class="close-btn mfp-close" type="button"></button>
            </div>
            <div class="ipo-request__data">
                <div class="data-col">
                    <div>
                        Банк ВТБ
                    </div>
                    <div class="sub-text">
                        Лицензия № 1481 от 11.08.2015
                    </div>
                </div>
                <div class="data-row">
                    <div class="data-col">
                        <div class="sub-text text-bold">
                            Ставка
                        </div>
                        от 6.5%
                    </div>
                    <div class="data-col">
                        <div class="sub-text text-bold">
                            Срок
                        </div>
                        до 25 лет
                    </div>
                    <div class="data-col">
                        <div class="sub-text text-bold">
                            Ежемесячный платёж, р.
                        </div>
                        50 782
                    </div>
                </div>
            </div>
        </div>
        <div class="ipo-request__form">
            <div class="h2 cta__title">
                Подать заявку<br>
                на ипотеку - просто!
            </div>
            <div class="cta__form cta-form">
                <form action="#">
                    <div class="cta-form__row f-row">
                        <div class="cols col-1-3">
                            <input class="input" type="text" name="name" placeholder="Ваше имя" reqiured="">
                        </div>
                        <div class="cols col-1-3">
                            <input class="input" type="tel" name="tel" placeholder="Номер телефона" reqiured="">
                        </div>
                        <div class="cols col-1-3">
                            <button class="btn btn--cta demo-modal-success" type="submit"> <img width="12" alt="phone" src="/local/templates/fsk/img/icons/ic-tel.svg" height="20" class="svg btn__ic ic-tel">Позвоните мне</button>
                        </div>
                    </div>
                    <p class="privacy">
                        Отправляя форму, вы подтверждаете своё согласие на <a href="confidence.html" target="_blank">обработку персональных данных</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
    */?>
    <div class="modal modal-success mfp-hide" id="modal-ipo-success">
        <div class="modal-success__inner">
            <div class="modal-success__img">
                <img alt="alt" src="/local/templates/fsk/img/icons/ic-success.svg" class="img">
            </div>
            <div class="h2 modal-success__title">
                Спасибо за Вашу заявку!
            </div>
            <p>
                Наш специалист свяжется с вами в&nbsp;ближайшее время и ответит на все интересующие вас вопросы.
            </p>
            <button class="btn btn--border success-btn mfp-close" type="button"><img width="12" alt="ic" src="/local/templates/fsk/img/icons/ic-tel.svg" height="20" class="svg svg-stroke btn__ic">Отлично, жду!</button>
        </div>
    </div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>