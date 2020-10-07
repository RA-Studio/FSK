<div class="card mfp-hide" id="card-example">
    <div class="p-relative">
        <button class="close-btn mfp-close" type="button"></button>
        <div class="h1 card__title">3-к квартира, 42 м<sup>2</sup></div>
        <div class="card__body js-tab-wrapper">
            <div class="card__col-1">
                <div class="card__tabs-wrap">
                    <div class="card__tabs js-tabs" style="justify-content: end;">
                        <button style="margin: 0 20px" class="js-tab js-tab--active" type="button">Планировка</button>
                        <button style="margin: 0 20px" class="js-tab" type="button">Отделка</button>
                    </div>
                </div>
                <div class="tooltip">
                    <div class="tooltip__icon"></div>
                    <div class="tooltip__hidden">
                        Информация на данном сайте, и в частности, на текущей странице не является офертой и
                        размещена для ознакомления. Данная планировка не является технической документацией
                        представлена для ознакомления.
                    </div>
                </div>
            </div>
            <div class="card__col-2">
                <div class="card__img js-tab-item">
                    <div class="card-img-btns">
                        <button class="ui-btn zoom-link" href="img/img-plan-big.jpg">
                            <img class="svg lazyload" data-src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-zoom.svg" width="15" height="15" alt="zoom">
                        </button>
                        <div class="interactive-btn interactive-favorite" href="#" data-role="favorite">
                            <img class="svg lazyload" data-src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-star.svg" alt="Добавить в закладки">
                        </div>
                    </div>
                    <img class="img lazyload" data-src="<?=SITE_TEMPLATE_PATH?>/img/img-plan.jpg" alt="plan">
                </div>
                <div class="card__img js-tab-item" style="min-height: 333px;">
                    <div class="card-img-btns">
                        <button class="ui-btn zoom-link" href="img/img-plan-big.jpg">
                            <img class="svg lazyload" data-src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-zoom.svg" width="15" height="15" alt="zoom">
                        </button>
                        <div class="interactive-btn interactive-favorite" href="#" data-role="favorite">
                            <img class="svg lazyload" data-src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-star.svg" alt="Добавить в закладки">
                        </div>
                    </div>
                    <img class="img lazyload" data-src="<?=SITE_TEMPLATE_PATH?>/img/svg-logo-gray.svg" alt="plan">
                </div>
                <div class="card__img js-tab-item" style="min-height: 333px;">
                    <div class="card-img-btns">
                        <button class="ui-btn zoom-link" href="img/img-plan-big.jpg">
                            <img class="svg lazyload" data-src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-zoom.svg" width="15" height="15" alt="zoom">
                        </button>
                        <div class="interactive-btn interactive-favorite" href="#" data-role="favorite">
                            <img class="svg lazyload" data-src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-star.svg" alt="Добавить в закладки">
                        </div>
                    </div>
                    <img class="img lazyload" data-src="<?=SITE_TEMPLATE_PATH?>/img/svg-logo-gray.svg" alt="plan">
                </div>
                <div class="card__img js-tab-item facing" style="min-height: 333px;">
                    <div class="card-img-btns">
                        <!--<button class="ui-btn zoom-link" href="img/img-plan-big.jpg">
                            <img class="svg" src="<?/*=SITE_TEMPLATE_PATH*/?>/img/icons/ic-zoom.svg" width="15" height="15" alt="zoom">
                        </button>-->
                        <div class="interactive-btn interactive-favorite" href="#" data-role="favorite">
                            <img class="svg lazyload" data-src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-star.svg" alt="Добавить в закладки">
                        </div>
                    </div>
                    <img class="img lazyload" data-src="<?=SITE_TEMPLATE_PATH?>/img/svg-logo-gray.svg" alt="plan">
                </div>
            </div>
            <div class="card__col-3">
                <div class="card__info">
                    <div class="interactive-btns">
                        <a class="interactive-btn interactive-download" href="#" title="Скачать" download></a>
                        <a class="interactive-btn interactive-print" href="print.html" target="_blank" title="Распечатать"></a>
                        <div class="interactive-btn interactive-favorite" data-role="favorite" data-id="">
                            <img class="svg lazyload" data-src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-star.svg" alt="Добавить в закладки">
                        </div>
                    </div>
                    <div class="card-data">
                        <div class="card-data__col-1">
                            <div class="h3 card-data__title">Студия</div>
                            <ul class="card-data__list">
                                <li><span>Общая площадь</span><span>27 м<sup>2</sup></span></li>
                                <li><span>Жилая площадь</span><span>16 м<sup>2</sup></span></li>
                                <li><span>Площадь кухни</span><span>5 м<sup>2</sup></span></li>
                                <li><span>Этаж / этажей</span><span>8/26</span></li>
                                <li><span>Корпус</span><span>3.1</span></li>
                                <li><span>Секция</span><span>2</span></li>
                                <li><span>Отделка</span><span>Предчистовая</span></li>
                            </ul>
                        </div>
                        <div class="card-data__col-2">
                            <p class="card-price-1">Стандартная цена: <span>7 200 360 </span>р.</p>
                            <p class="card-price-2">Цена по акции: <span>7 200 360 </span>р.</p><span class="card-id">ID квартиры: 45 702</span>
                            <div class="card-btn">
                                <!--button class="btn btn--cta js-call-callback" type="button"> <img class="svg btn__ic ic-tel" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-tel.svg" alt="phone" width="12" height="20">Позвоните мне</button-->
                                <style>
                                    .card-btn .btn{
                                        width: 100%;
                                    }
                                    .card-btn .popup-btn-FORM10{
                                        margin-bottom: 15px   
                                    }
                                    .results-offer__footer-wrap{
                                        margin-top: 20px
                                    }
                                    @media screen and (max-width:1199px) and (min-width:768px){
                                        .card-data{
                                            position: relative;
                                            padding-bottom: 85px;
                                        }
                                        .card-btn{
                                            position: absolute;
                                            width: 100%;
                                            left: 0;
                                            display: flex;
                                            justify-content: space-between;
                                            bottom: 0;
                                            z-index: 2;
                                        }
                                        .card-btn .popup-btn-FORM10{
                                            margin-bottom: 0   
                                        }
                                        .card-btn .btn{
                                            width: calc(50% - 12px);
                                        }
                                    }
                                </style>
                                <a href="#modal-FORM10" class="popup-btn-FORM10 btn btn--bg js-call-callback" type="button">
                                    <svg class="svg btn__ic ic-tel"  xmlns="http://www.w3.org/2000/svg" width="14.547" height="24.331" viewBox="0 0 14.547 24.331"><g transform="translate(-8967.75 1214.75)"><path d="M0,.5H13.047" transform="translate(8968.5 -1195.909)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><path d="M0,1.25H3.262" transform="translate(8973.393 -1211.988)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><rect width="13.047" height="22.831" rx="2" transform="translate(8968.5 -1214)" stroke-width="1.5" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" fill="none"/></g></svg>
                                    Консультация
                                </a>
                              <a href="#modal-FORM3" data-type="reserved" data-id="" data-iblock="1" class="btn btn--cta popup-btn-FORM3" type="button">
                                <svg class="svg btn__ic ic-tel" width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M7.5 10L7.5 12.6654" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                  <path d="M9.91016 13L4.82144 13" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                  <rect x="0.75" y="0.75" width="13.5" height="8.5" rx="1.25" stroke="white" stroke-width="1.5"/>
                                </svg>
                                Забронировать
                              </a>
    <a href="/reserve/" data-type="reserveBtn" data-id="" data-iblock="1" class=" btn btn--cta " type="button">
        <svg class="svg btn__ic ic-tel" width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M7.5 10L7.5 12.6654" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M9.91016 13L4.82144 13" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            <rect x="0.75" y="0.75" width="13.5" height="8.5" rx="1.25" stroke="white" stroke-width="1.5"/>
        </svg>
        Забронировать
    </a>




                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card__body-->
    </div>
    <!-- /.card__inner-->
</div>
<?/*
<div class="modal ipo-request mfp-hide" id="ipo-request">
    <div class="ipo-request__body">
        <div class="ipo-request__header">
            <div class="ipo-bank"><img class="img" src="<?=SITE_TEMPLATE_PATH?>/img/ipo/vtb.png" alt="ВТБ"></div>
            <button class="close-btn mfp-close" type="button"></button>
        </div>
        <div class="ipo-request__data">
            <div class="data-col">
                <div>Банк ВТБ</div>
                <div class="sub-text">Лицензия № 1481 от 11.08.2015</div>
            </div>
            <div class="data-row">
                <div class="data-col">
                    <div class="sub-text text-bold">Ставка</div><span>от 6.5%</span>
                </div>
                <div class="data-col">
                    <div class="sub-text text-bold">Срок</div><span>до 25 лет</span>
                </div>
                <div class="data-col">
                    <div class="sub-text text-bold">Ежемесячный платёж, р.</div><span>50 782</span>
                </div>
            </div>
        </div>
    </div>
    <div class="ipo-request__form">
        <div class="h2 cta__title">Подать заявку<br> на ипотеку - просто!</div>
        <div class="cta__form cta-form">
            <form action="#">
                <div class="cta-form__row f-row">
                    <div class="cols col-1-3">
                        <input class="input" type="text" name="name" placeholder="Ваше имя" reqiured>
                    </div>
                    <div class="cols col-1-3">
                        <input class="input" type="tel" name="tel" placeholder="Номер телефона" reqiured>
                    </div>
                    <div class="cols col-1-3">
                        <button class="btn btn--cta demo-modal-success" type="submit"> <img class="svg btn__ic ic-tel" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-tel.svg" alt="phone" width="12" height="20">Позвоните мне</button>
                    </div>
                </div>
                <p class="privacy">Отправляя форму, вы подтверждаете своё согласие на <a href="confidence.html" target="_blank">обработку персональных данных</a></p>
            </form>
        </div>
    </div>
</div>
*/?>
<div class="modal modal-success mfp-hide" id="modal-success">
    <div class="modal-success__inner">
        <div class="modal-success__img"><img class="img lazyload" data-src="/local/templates/fsk/img/icons/ic-success.svg" alt="alt"></div>
        <div class="h2 modal-success__title">Спасибо за Вашу заявку!</div>
        <p>Наш специалист свяжется с вами в&nbsp;ближайшее время и ответит на все интересующие вас вопросы.</p>
        <button class="btn btn--border mfp-close" type="button"><img class="svg svg-stroke btn__ic lazyload" data-src="/local/templates/fsk/img/icons/ic-tel.svg" width="12" height="20" alt="ic">Отлично, жду!</button>
    </div>
</div>
