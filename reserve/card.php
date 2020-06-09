<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->RestartBuffer();
?>
            <div class="reservation-card" >
                <h2 class="h1 title">Информация для брони</h2>
                <div class="reservation-card-form">
                    <div class="reservation-card__title">Данные покупателя</div>
                    <div class="reservation-card-form-content">
                        <div class="reservation-card-form-content-col">
                            <span>Имя:</span>
                            <input type="text">
                        </div>
                        <div class="reservation-card-form-content-col">
                            <span>Фамилия:</span>
                            <input type="text">
                        </div>
                        <div class="reservation-card-form-content-col">
                            <span>E-mail:</span>
                            <input type="text">
                        </div>
                        <div class="reservation-card-form-content-col">
                            <span>Телефон:</span>
                            <input type="text">
                        </div>
                    </div>
                </div>
                <p>Все поля в данной форме являются обязательными к заполнению.</p>
                <div class="reservation-card-main">
                    <div class="reservation-card__title">Информация об объекте</div>
                    <div class="reservation-card-main-content">
                        <div class="reservation-card-main-content__img">
                            <img alt="plan" src="/upload/resize_cache/iblock/317/600_600_1/317c81fb4b0323c5889ee30e1dd130f6.png">
                        </div>
                        <div class="reservation-card-main-content-info">
                            <div class="reservation-card-main-content-info__name">Студия - 25 м2</div>
                            <div class="reservation-card-main-content-info-row">
                                <span>Общая площадь</span>
                                <span>25,7 м2</span>
                            </div>
                            <div class="reservation-card-main-content-info-row">
                                <span>Жилая площадь</span>
                                <span>15,7 м2</span>
                            </div>
                            <div class="reservation-card-main-content-info-row">
                                <span>Этаж / этажей</span>
                                <span>15,7 м2</span>
                            </div>
                            <div class="reservation-card-main-content-info-row">
                                <span>Отделка</span>
                                <span>Чистовая</span>
                            </div>
                            <div class="reservation-card-main-content-info-row reservation__price">
                                <span>Стоимость при резерве</span>
                                <span>2 387 560 р.</span>
                            </div>
                            <div class="reservation-card-main-content-info__id">ID объекта: 42 538</div>
                        </div>
                    </div>
                </div>
                <div class="reservation-card-bot">
                    <span>Отправляя форму, вы подтверждаете своё согласие на обработку персональных данных, условия пользовтельского соглашения, договора оферты, а также правил использования кретитных карт. </span>
                    <div class="btn btn--bg reservation-card-bot__btn">
                        <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21.7511 0.801702C21.4191 0.430683 20.881 0.430683 20.549 0.801702L10.3654 12.1834L6.45106 7.80851C6.11913 7.43749 5.58097 7.43753 5.24897 7.80851C4.91701 8.17949 4.91701 8.78096 5.24897 9.15198L9.7644 14.1986C10.0962 14.5695 10.6348 14.5693 10.9665 14.1986L21.7511 2.14521C22.083 1.77423 22.083 1.17272 21.7511 0.801702Z" fill="#FFFEFE"/>
                            <path d="M10 1.5C5.31308 1.5 1.5 5.31308 1.5 10C1.5 14.6869 5.31308 18.5 10 18.5C14.6869 18.5 18.5 14.6869 18.5 10C18.5 5.31308 14.6869 1.5 10 1.5ZM10 0C15.5229 0 20 4.47715 20 10C20 15.5229 15.5229 20 10 20C4.47715 20 0 15.5229 0 10C0 4.47715 4.47715 0 10 0Z" fill="white"/>
                        </svg>
                        Перейти к оплате
                    </div>
                </div>
            </div>
<?
die();
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>