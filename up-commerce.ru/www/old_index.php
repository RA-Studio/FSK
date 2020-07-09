<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- fav and touch icons -->
    <link href="favicon.png" type="image/png" rel="shortcut icon"/>

    <!-- CSS -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="js/magnific-popup/magnific-popup.css" rel="stylesheet">
    <link href="js/photoswipe/dist/photoswipe.css" rel="stylesheet">
    <link href="js/photoswipe/dist/default-skin/default-skin.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet" media="screen">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Analytics -->
    <!-- Analytics end -->

    <!-- Metrika -->
    <!-- Metrika end -->

    <title>Коммерческие помещения в UP Кварталах</title>

</head>
<body>

<!-- navbar -->
<nav class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">

        <div class="navbar-brand">
            <img class="navbar_logo" src="images/icons_and_logo/fsk-lider-logo-200x43.png" alt="ФСК «Лидер»">
        </div>
        <div class="navbar_phone_wrap">
            <a class="" href="tel:+78127035555">+7 (812) 703-55-55</a>
        </div>

    </div>
</nav>
<!-- navbar end -->















<style type="text/css">
body {
 padding: 10%;
 font-family: sans-serif;
}
 
button {
 padding: 1em;
 border: 0;
 margin: 0.25em;
 color: #fff;
 cursor: pointer;
}
 
.f-red {
 background: #ff4136;
}
.f-red:hover {
 background: #e90d00;
}
 
.f-green {
 background: #2ecc40;
}
.f-green:hover {
 background: #208e2c;
}
 
.f-blue {
 background: #0074d9;
}
.f-blue:hover {
 background: #004b8c;
}
 
.f-all {
 background: #333;
}
.f-all:hover {
 background: #0d0d0d;
}
 
.red, .green, .blue {
 color: #fff;
 padding: 1em;
 margin-bottom: 0.25em;
}
 
.red {
 background: #ff4136;
}
 
.green {
 background: #2ecc40;
}
 
.blue {
 background: #0074d9;
}
.qqq div {
	font-size: 20px;
	font-weight: bold;
	color: #eee;
	width: 150px;
    margin: 0 20px;
    border: 2px dotted #eee;
    padding: 10px;
    display: none;
}

.sort a:hover, .sort a:active, .sort a:focus {
    text-decoration: none;
}
.sort .active a {
    border-bottom: 1px dotted;
}
.sort_link.desc a:after {
    content: '↓';
}
.sort_link.asc a:after {
    content: '↑';
}
.sort_link {
    cursor: pointer;
}
.sort_link.desc {
    padding-left: 6px;
    padding-right: 6px;
}
.sort_link_middle {
    padding-left: 6px;
    padding-right: 6px;
}
.sort_link.asc {
    padding-left: 6px;
    padding-right: 6px;
}
</style>










<h2>Фильтрация элементов с помощью jQuery</h2>
 
<p>
<button class="f-red">Фильтр красных элементов</button>
<button class="f-blue">Фильтр синих элементов</button>
<button class="f-green">Фильтр зеленых элементов</button>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<button class="f-all">Все элементы</button>
</p>

 



<div class="order">

	<!--
    <div class="header row">
        <div class="col-md-6" data-orderby="element">Срок сдачи</div>
        <div class="col-md-6" data-orderby="number">Площадь</div>
    </div>
    -->



    <div class="header row sort">
    	<div class="col-md-4">
        	Сортировать:
        </div>
        <div class="col-md-4" data-orderby="element">
        	<span class="sort_link desc active" data-value="stoimost"><a>по сроку сдачи </a></span>
        </div>
        <div class="col-md-4" data-orderby="number">
        	<span class="sort_link desc active" data-value="ploshad"><a>по площади </a></span>
        </div>
    </div>



    <div class="list">
		<div data-sort="2019" class="row qqq red">
			65 м²
			<br>
			сдан
			<div class="col-md-6"><span data-name="element">2019</span></div>
	        <div class="col-md-6"><span data-name="number">65 м²</span></div>
		</div>
		<div data-sort="2021" class="row qqq blue">
			73 м²
			<br>
			2021 год
			<div class="col-md-6"><span data-name="element">2021</span></div>
	        <div class="col-md-6"><span data-name="number">73 м²</span></div>
		</div>
		<div data-sort="2020" class="row qqq green">
			81 м²
			<br>
			2020 год
			<div class="col-md-6"><span data-name="element">2020</span></div>
	        <div class="col-md-6"><span data-name="number">81 м²</span></div>
		</div>
		<div data-sort="2019" class="row qqq red">
			96 м²
			<br>
			сдан
			<div class="col-md-6"><span data-name="element">2019</span></div>
	        <div class="col-md-6"><span data-name="number">96 м²</span></div>
		</div>
		<div data-sort="2021" class="row qqq blue">
			103 м²
			<br>
			2021 год
			<div class="col-md-6"><span data-name="element">2021</span></div>
	        <div class="col-md-6"><span data-name="number">103 м²</span></div>
		</div>
		<div data-sort="2022" class="row qqq blue">
			115 м²
			<br>
			2022 год
			<div class="col-md-6"><span data-name="element">2022</span></div>
	        <div class="col-md-6"><span data-name="number">115 м²</span></div>
		</div>
		<div data-sort="2020" class="row qqq green">
			132 м²
			<br>
			2020 год
			<div class="col-md-6"><span data-name="element">2020</span></div>
	        <div class="col-md-6"><span data-name="number">132 м²</span></div>
		</div>
	</div>

</div>

















<!-- section_commerce_planirovki -->
<div class="section section_commerce_planirovki section_gray">
    <div class="container text_center">
        <h2 class="section_t">Продажа коммерческих помещений в новостройках</h2>

        <div class="section_subt commerce_first_screen_section_subt">

            <div class="light_gray">
                Помещения в жилых комплексах комфорт-класса:
            </div>

            <ul class="commerce_first_screen_zhk_list">
                <li class="row">
                    <div class="commerce_first_screen_zhk_list_item_icon col-xs-2">
                        <i class="fa fa-circle" aria-hidden="true"></i>
                    </div>
                    <div class="commerce_first_screen_zhk_list_item_text col-xs-10">
                        UP-квартал «Комендантский»,
                        <span class="commerce_first_screen_zhk_list_item_metro_text">
                            <img class="commerce_first_screen_zhk_list_item_metro_logo" src="images/icons_and_logo/metro-logo-dark-gray.svg">
                            Комендантский проспект
                        </span>
                    </div>
                </li>
                <li class="row">
                    <div class="commerce_first_screen_zhk_list_item_icon col-xs-2">
                        <i class="fa fa-circle" aria-hidden="true"></i>
                    </div>
                    <div class="commerce_first_screen_zhk_list_item_text col-xs-10">
                        UP-квартал «Московский»,
                        <span class="commerce_first_screen_zhk_list_item_metro_text">
                            Шушары,
                            <img class="commerce_first_screen_zhk_list_item_metro_logo" src="images/icons_and_logo/metro-logo-dark-gray.svg">
                            Купчино
                        </span>
                    </div>
                </li>
            </ul>

        </div>

        <div class="commerce_list_block">


            <!-- commerce_list_item (komendantskiy) -->
            <div class="commerce_list_item">

                <div class="row">

                    <div class="commerce_list_item_img_wrap col-xs-12 col-sm-3 col-md-3 col-lg-4">

                        <div class="">
                            <img src="images/commerce_planirovki/komendantskiy-commerce-67.74-250x250.png">
                        </div>

                    </div>

                    <div class="commerce_list_item_description col-xs-12 col-sm-5 col-md-4 col-lg-5">
                        <div class="commerce_list_item_t">
                            Коммерческое помещение <span class="commerce_list_room_area_text">67.74 м²</span>
                        </div>

                        <div>
                            <div>
                                Санкт-Петербург, Парашютная ул./Шуваловский пр.
                            </div>
                            <div class="row">
                                <div class="commerce_list_item_metro_logo col-xs-2">
                                    <img src="images/icons_and_logo/metro-logo-violet.svg">
                                </div>
                                <div class="commerce_list_item_metro_text col-xs-10">
                                    Комендантский проспект
                                </div>
                            </div>
                        </div>
                        
                        <div class="commerce_list_item_advantages">
                            
                            <span class="commerce_list_item_discount_text hidden-xs hidden-sm">
                                Только в декабре <span class="hidden-md">– </span>скидки до 850 000 руб.!
                            </span>

                            <span class="commerce_list_item_discount_text hidden-md hidden-lg">
                                Только в декабре
                            </span>
                            <span class="hidden-md hidden-lg">
                                <br>
                            </span>
                            <span class="commerce_list_item_discount_text hidden-md hidden-lg">
                                Скидки до 850 000 руб.!
                            </span>

                        </div>

                        <div class="commerce_list_item_btn_wrap">
                            <span class="b_link b_link_lg b_link_orange">
                                <span class="commerce_list_item_btn_discount_text">
                                    Узнать цену со скидкой
                                </span>
                            </span>
                        </div>

                    </div>

                    <div class="commerce_list_item_info col-xs-12 col-sm-4 col-md-5 col-lg-3">

                        <div class="commerce_list_item_info_t row">
                            ЖК UP-квартал «Комендантский»
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Класс:
                            </div>
                            <div class="col-xs-7">
                                Комфорт-класс
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-5">
                                Кол-во квартир:
                            </div>
                            <div class="col-xs-7">
                                1449 квартир
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Срок сдачи:
                            </div>
                            <div class="col-xs-7">
                                1 очередь – 4 кв. 2017
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Этаж:
                            </div>
                            <div class="col-xs-7">
                                Первый
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Площадь:
                            </div>
                            <div class="col-xs-7">
                                67.74 м²
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Жилой блок:
                            </div>
                            <div class="col-xs-7">
                                3.1
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-5">
                                Секция:
                            </div>
                            <div class="col-xs-7">
                                3
                            </div>
                        </div>

                    </div>

                </div>

                <a href="#callbackwidget" class="commerce_list_item_link_mask"></a>

            </div>
            <!-- commerce_list_item (komendantskiy) end -->


            <!-- commerce_list_item (komendantskiy) -->
            <div class="commerce_list_item">

                <div class="row">

                    <div class="commerce_list_item_img_wrap col-xs-12 col-sm-3 col-md-3 col-lg-4">

                        <div class="">
                            <img src="images/commerce_planirovki/komendantskiy-commerce-115.7-250x250.png">
                        </div>

                    </div>

                    <div class="commerce_list_item_description col-xs-12 col-sm-5 col-md-4 col-lg-5">
                        <div class="commerce_list_item_t">
                            Коммерческое помещение <span class="commerce_list_room_area_text">115.7 м²</span>
                        </div>

                        <div>
                            <div>
                                Санкт-Петербург, Парашютная ул./Шуваловский пр.
                            </div>
                            <div class="row">
                                <div class="commerce_list_item_metro_logo col-xs-2">
                                    <img src="images/icons_and_logo/metro-logo-violet.svg">
                                </div>
                                <div class="commerce_list_item_metro_text col-xs-10">
                                    Комендантский проспект
                                </div>
                            </div>
                        </div>

                        <div class="commerce_list_item_advantages">
                            
                            <span class="commerce_list_item_discount_text hidden-xs hidden-sm">
                                Только в декабре <span class="hidden-md">– </span>скидки до 850 000 руб.!
                            </span>

                            <span class="commerce_list_item_discount_text hidden-md hidden-lg">
                                Только в декабре
                            </span>
                            <span class="hidden-md hidden-lg">
                                <br>
                            </span>
                            <span class="commerce_list_item_discount_text hidden-md hidden-lg">
                                Скидки до 850 000 руб.!
                            </span>

                        </div>

                        <div class="commerce_list_item_btn_wrap">
                            <span class="b_link b_link_lg b_link_orange">
                                <span class="commerce_list_item_btn_discount_text">
                                    Узнать цену со скидкой
                                </span>
                            </span>
                        </div>

                    </div>

                    <div class="commerce_list_item_info col-xs-12 col-sm-4 col-md-5 col-lg-3">

                        <div class="commerce_list_item_info_t row">
                            ЖК UP-квартал «Комендантский»
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Класс:
                            </div>
                            <div class="col-xs-7">
                                Комфорт-класс
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-5">
                                Кол-во квартир:
                            </div>
                            <div class="col-xs-7">
                                1449 квартир
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Срок сдачи:
                            </div>
                            <div class="col-xs-7">
                                1 очередь – 4 кв. 2017
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Этаж:
                            </div>
                            <div class="col-xs-7">
                                Первый
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Площадь:
                            </div>
                            <div class="col-xs-7">
                                115.7 м²
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Жилой блок:
                            </div>
                            <div class="col-xs-7">
                                3.1
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-5">
                                Секция:
                            </div>
                            <div class="col-xs-7">
                                3
                            </div>
                        </div>

                    </div>

                </div>

                <a href="#callbackwidget" class="commerce_list_item_link_mask"></a>

            </div>
            <!-- commerce_list_item (komendantskiy) end -->


            <!-- commerce_list_item (komendantskiy) -->
            <div class="commerce_list_item">

                <div class="row">

                    <div class="commerce_list_item_img_wrap col-xs-12 col-sm-3 col-md-3 col-lg-4">

                        <div class="">
                            <img src="images/commerce_planirovki/komendantskiy-commerce-124.52-250x250.png">
                        </div>

                    </div>

                    <div class="commerce_list_item_description col-xs-12 col-sm-5 col-md-4 col-lg-5">
                        <div class="commerce_list_item_t">
                            Коммерческое помещение <span class="commerce_list_room_area_text">124.52 м²</span>
                        </div>

                        <div>
                            <div>
                                Санкт-Петербург, Парашютная ул./Шуваловский пр.
                            </div>
                            <div class="row">
                                <div class="commerce_list_item_metro_logo col-xs-2">
                                    <img src="images/icons_and_logo/metro-logo-violet.svg">
                                </div>
                                <div class="commerce_list_item_metro_text col-xs-10">
                                    Комендантский проспект
                                </div>
                            </div>
                        </div>

                        <div class="commerce_list_item_advantages">
                            
                            <span class="commerce_list_item_discount_text hidden-xs hidden-sm">
                                Только в декабре <span class="hidden-md">– </span>скидки до 850 000 руб.!
                            </span>

                            <span class="commerce_list_item_discount_text hidden-md hidden-lg">
                                Только в декабре
                            </span>
                            <span class="hidden-md hidden-lg">
                                <br>
                            </span>
                            <span class="commerce_list_item_discount_text hidden-md hidden-lg">
                                Скидки до 850 000 руб.!
                            </span>

                        </div>

                        <div class="commerce_list_item_btn_wrap">
                            <span class="b_link b_link_lg b_link_orange">
                                <span class="commerce_list_item_btn_discount_text">
                                    Узнать цену со скидкой
                                </span>
                            </span>
                        </div>

                    </div>

                    <div class="commerce_list_item_info col-xs-12 col-sm-4 col-md-5 col-lg-3">

                        <div class="commerce_list_item_info_t row">
                            ЖК UP-квартал «Комендантский»
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Класс:
                            </div>
                            <div class="col-xs-7">
                                Комфорт-класс
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-5">
                                Кол-во квартир:
                            </div>
                            <div class="col-xs-7">
                                1449 квартир
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-5">
                                Срок сдачи:
                            </div>
                            <div class="col-xs-7">
                                1 очередь – 4 кв. 2017
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Этаж:
                            </div>
                            <div class="col-xs-7">
                                Первый
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Площадь:
                            </div>
                            <div class="col-xs-7">
                                124.52 м²
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Жилой блок:
                            </div>
                            <div class="col-xs-7">
                                3.1
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-5">
                                Секция:
                            </div>
                            <div class="col-xs-7">
                                1
                            </div>
                        </div>

                    </div>

                </div>

                <a href="#callbackwidget" class="commerce_list_item_link_mask"></a>

            </div>
            <!-- commerce_list_item (komendantskiy) end -->


            <!-- commerce_list_item (komendantskiy - 2 ochered) -->
            <div class="commerce_list_item">

                <div class="row">

                    <div class="commerce_list_item_img_wrap col-xs-12 col-sm-3 col-md-3 col-lg-4">

                        <div class="">
                            <img src="images/commerce_planirovki/komendantskiy-commerce-2-ochered-67,74.png">
                        </div>

                    </div>

                    <div class="commerce_list_item_description col-xs-12 col-sm-5 col-md-4 col-lg-5">
                        <div class="commerce_list_item_t">
                            Коммерческое помещение <span class="commerce_list_room_area_text">67.74 м²</span>
                        </div>

                        <div>
                            <div>
                                Санкт-Петербург, Парашютная ул./Шуваловский пр.
                            </div>
                            <div class="row">
                                <div class="commerce_list_item_metro_logo col-xs-2">
                                    <img src="images/icons_and_logo/metro-logo-violet.svg">
                                </div>
                                <div class="commerce_list_item_metro_text col-xs-10">
                                    Комендантский проспект
                                </div>
                            </div>
                        </div>

                        <div class="commerce_list_item_advantages">
                            Лучшая цена на старте продаж!
                        </div>

                        <div class="commerce_list_item_btn_wrap">
                            <span class="b_link b_link_lg b_link_orange">
                                <span class="commerce_list_item_btn_discount_text">
                                    Узнать цену
                                </span>
                            </span>
                        </div>

                    </div>

                    <div class="commerce_list_item_info col-xs-12 col-sm-4 col-md-5 col-lg-3">

                        <div class="commerce_list_item_info_t row">
                            ЖК UP-квартал «Комендантский»
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Класс:
                            </div>
                            <div class="col-xs-7">
                                Комфорт-класс
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-5">
                                Кол-во квартир:
                            </div>
                            <div class="col-xs-7">
                                1449 квартир
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-5">
                                Срок сдачи:
                            </div>
                            <div class="col-xs-7">
                                2 очередь – 2 кв. 2019
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Этаж:
                            </div>
                            <div class="col-xs-7">
                                Первый
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Площадь:
                            </div>
                            <div class="col-xs-7">
                                67.74 м²
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Жилой блок:
                            </div>
                            <div class="col-xs-7">
                                3.2
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-5">
                                Секция:
                            </div>
                            <div class="col-xs-7">
                                3
                            </div>
                        </div>

                    </div>

                </div>

                <a href="#callbackwidget" class="commerce_list_item_link_mask"></a>

            </div>
            <!-- commerce_list_item (komendantskiy - 2 ochered) end -->


            <!-- commerce_list_item (komendantskiy - 2 ochered) -->
            <div class="commerce_list_item">

                <div class="row">

                    <div class="commerce_list_item_img_wrap col-xs-12 col-sm-3 col-md-3 col-lg-4">

                        <div class="">
                            <img src="images/commerce_planirovki/komendantskiy-commerce-2-ochered-101,51.png">
                        </div>

                    </div>

                    <div class="commerce_list_item_description col-xs-12 col-sm-5 col-md-4 col-lg-5">
                        <div class="commerce_list_item_t">
                            Коммерческое помещение <span class="commerce_list_room_area_text">101.51 м²</span>
                        </div>

                        <div>
                            <div>
                                Санкт-Петербург, Парашютная ул./Шуваловский пр.
                            </div>
                            <div class="row">
                                <div class="commerce_list_item_metro_logo col-xs-2">
                                    <img src="images/icons_and_logo/metro-logo-violet.svg">
                                </div>
                                <div class="commerce_list_item_metro_text col-xs-10">
                                    Комендантский проспект
                                </div>
                            </div>
                        </div>

                        <div class="commerce_list_item_advantages">
                            Лучшая цена на старте продаж!
                        </div>

                        <div class="commerce_list_item_btn_wrap">
                            <span class="b_link b_link_lg b_link_orange">
                                <span class="commerce_list_item_btn_discount_text">
                                    Узнать цену
                                </span>
                            </span>
                        </div>

                    </div>

                    <div class="commerce_list_item_info col-xs-12 col-sm-4 col-md-5 col-lg-3">

                        <div class="commerce_list_item_info_t row">
                            ЖК UP-квартал «Комендантский»
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Класс:
                            </div>
                            <div class="col-xs-7">
                                Комфорт-класс
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-5">
                                Кол-во квартир:
                            </div>
                            <div class="col-xs-7">
                                1449 квартир
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-5">
                                Срок сдачи:
                            </div>
                            <div class="col-xs-7">
                                2 очередь – 2 кв. 2019
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Этаж:
                            </div>
                            <div class="col-xs-7">
                                Первый
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Площадь:
                            </div>
                            <div class="col-xs-7">
                                101.51 м²
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Жилой блок:
                            </div>
                            <div class="col-xs-7">
                                3.2
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-5">
                                Секция:
                            </div>
                            <div class="col-xs-7">
                                1
                            </div>
                        </div>

                    </div>

                </div>

                <a href="#callbackwidget" class="commerce_list_item_link_mask"></a>

            </div>
            <!-- commerce_list_item (komendantskiy - 2 ochered) end -->


            <!-- commerce_list_item (komendantskiy - 2 ochered) -->
            <div class="commerce_list_item">

                <div class="row">

                    <div class="commerce_list_item_img_wrap col-xs-12 col-sm-3 col-md-3 col-lg-4">

                        <div class="">
                            <img src="images/commerce_planirovki/komendantskiy-commerce-2-ochered-108,70.png">
                        </div>

                    </div>

                    <div class="commerce_list_item_description col-xs-12 col-sm-5 col-md-4 col-lg-5">
                        <div class="commerce_list_item_t">
                            Коммерческое помещение <span class="commerce_list_room_area_text">108.70 м²</span>
                        </div>

                        <div>
                            <div>
                                Санкт-Петербург, Парашютная ул./Шуваловский пр.
                            </div>
                            <div class="row">
                                <div class="commerce_list_item_metro_logo col-xs-2">
                                    <img src="images/icons_and_logo/metro-logo-violet.svg">
                                </div>
                                <div class="commerce_list_item_metro_text col-xs-10">
                                    Комендантский проспект
                                </div>
                            </div>
                        </div>

                        <div class="commerce_list_item_advantages">
                            Лучшая цена на старте продаж!
                        </div>

                        <div class="commerce_list_item_btn_wrap">
                            <span class="b_link b_link_lg b_link_orange">
                                <span class="commerce_list_item_btn_discount_text">
                                    Узнать цену
                                </span>
                            </span>
                        </div>

                    </div>

                    <div class="commerce_list_item_info col-xs-12 col-sm-4 col-md-5 col-lg-3">

                        <div class="commerce_list_item_info_t row">
                            ЖК UP-квартал «Комендантский»
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Класс:
                            </div>
                            <div class="col-xs-7">
                                Комфорт-класс
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-5">
                                Кол-во квартир:
                            </div>
                            <div class="col-xs-7">
                                1449 квартир
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-5">
                                Срок сдачи:
                            </div>
                            <div class="col-xs-7">
                                2 очередь – 2 кв. 2019
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Этаж:
                            </div>
                            <div class="col-xs-7">
                                Первый
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Площадь:
                            </div>
                            <div class="col-xs-7">
                                108.70 м²
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Жилой блок:
                            </div>
                            <div class="col-xs-7">
                                3.2
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-5">
                                Секция:
                            </div>
                            <div class="col-xs-7">
                                2
                            </div>
                        </div>

                    </div>

                </div>

                <a href="#callbackwidget" class="commerce_list_item_link_mask"></a>

            </div>
            <!-- commerce_list_item (komendantskiy - 2 ochered) end -->


            <!-- commerce_list_item (komendantskiy - 2 ochered) -->
            <div class="commerce_list_item">

                <div class="row">

                    <div class="commerce_list_item_img_wrap col-xs-12 col-sm-3 col-md-3 col-lg-4">

                        <div class="">
                            <img src="images/commerce_planirovki/komendantskiy-commerce-2-ochered-115,70.png">
                        </div>

                    </div>

                    <div class="commerce_list_item_description col-xs-12 col-sm-5 col-md-4 col-lg-5">
                        <div class="commerce_list_item_t">
                            Коммерческое помещение <span class="commerce_list_room_area_text">115.70 м²</span>
                        </div>

                        <div>
                            <div>
                                Санкт-Петербург, Парашютная ул./Шуваловский пр.
                            </div>
                            <div class="row">
                                <div class="commerce_list_item_metro_logo col-xs-2">
                                    <img src="images/icons_and_logo/metro-logo-violet.svg">
                                </div>
                                <div class="commerce_list_item_metro_text col-xs-10">
                                    Комендантский проспект
                                </div>
                            </div>
                        </div>

                        <div class="commerce_list_item_advantages">
                            Лучшая цена на старте продаж!
                        </div>

                        <div class="commerce_list_item_btn_wrap">
                            <span class="b_link b_link_lg b_link_orange">
                                <span class="commerce_list_item_btn_discount_text">
                                    Узнать цену
                                </span>
                            </span>
                        </div>

                    </div>

                    <div class="commerce_list_item_info col-xs-12 col-sm-4 col-md-5 col-lg-3">

                        <div class="commerce_list_item_info_t row">
                            ЖК UP-квартал «Комендантский»
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Класс:
                            </div>
                            <div class="col-xs-7">
                                Комфорт-класс
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-5">
                                Кол-во квартир:
                            </div>
                            <div class="col-xs-7">
                                1449 квартир
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-5">
                                Срок сдачи:
                            </div>
                            <div class="col-xs-7">
                                2 очередь – 2 кв. 2019
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Этаж:
                            </div>
                            <div class="col-xs-7">
                                Первый
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Площадь:
                            </div>
                            <div class="col-xs-7">
                                115.70 м²
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Жилой блок:
                            </div>
                            <div class="col-xs-7">
                                3.2
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-5">
                                Секция:
                            </div>
                            <div class="col-xs-7">
                                3
                            </div>
                        </div>

                    </div>

                </div>

                <a href="#callbackwidget" class="commerce_list_item_link_mask"></a>

            </div>
            <!-- commerce_list_item (komendantskiy - 2 ochered) end -->


            <!-- commerce_list_item (komendantskiy - 2 ochered) -->
            <div class="commerce_list_item">

                <div class="row">

                    <div class="commerce_list_item_img_wrap col-xs-12 col-sm-3 col-md-3 col-lg-4">

                        <div class="">
                            <img src="images/commerce_planirovki/komendantskiy-commerce-2-ochered-125,10.png">
                        </div>

                    </div>

                    <div class="commerce_list_item_description col-xs-12 col-sm-5 col-md-4 col-lg-5">
                        <div class="commerce_list_item_t">
                            Коммерческое помещение <span class="commerce_list_room_area_text">125.10 м²</span>
                        </div>

                        <div>
                            <div>
                                Санкт-Петербург, Парашютная ул./Шуваловский пр.
                            </div>
                            <div class="row">
                                <div class="commerce_list_item_metro_logo col-xs-2">
                                    <img src="images/icons_and_logo/metro-logo-violet.svg">
                                </div>
                                <div class="commerce_list_item_metro_text col-xs-10">
                                    Комендантский проспект
                                </div>
                            </div>
                        </div>

                        <div class="commerce_list_item_advantages">
                            Лучшая цена на старте продаж!
                        </div>

                        <div class="commerce_list_item_btn_wrap">
                            <span class="b_link b_link_lg b_link_orange">
                                <span class="commerce_list_item_btn_discount_text">
                                    Узнать цену
                                </span>
                            </span>
                        </div>

                    </div>

                    <div class="commerce_list_item_info col-xs-12 col-sm-4 col-md-5 col-lg-3">

                        <div class="commerce_list_item_info_t row">
                            ЖК UP-квартал «Комендантский»
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Класс:
                            </div>
                            <div class="col-xs-7">
                                Комфорт-класс
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-5">
                                Кол-во квартир:
                            </div>
                            <div class="col-xs-7">
                                1449 квартир
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-5">
                                Срок сдачи:
                            </div>
                            <div class="col-xs-7">
                                2 очередь – 2 кв. 2019
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Этаж:
                            </div>
                            <div class="col-xs-7">
                                Первый
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Площадь:
                            </div>
                            <div class="col-xs-7">
                                125.10 м²
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Жилой блок:
                            </div>
                            <div class="col-xs-7">
                                3.2
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-5">
                                Секция:
                            </div>
                            <div class="col-xs-7">
                                2
                            </div>
                        </div>

                    </div>

                </div>

                <a href="#callbackwidget" class="commerce_list_item_link_mask"></a>

            </div>
            <!-- commerce_list_item (komendantskiy - 2 ochered) end -->


            <!-- commerce_list_item (komendantskiy - 2 ochered) -->
            <div class="commerce_list_item">

                <div class="row">

                    <div class="commerce_list_item_img_wrap col-xs-12 col-sm-3 col-md-3 col-lg-4">

                        <div class="">
                            <img src="images/commerce_planirovki/komendantskiy-commerce-2-ochered-131,60.png">
                        </div>

                    </div>

                    <div class="commerce_list_item_description col-xs-12 col-sm-5 col-md-4 col-lg-5">
                        <div class="commerce_list_item_t">
                            Коммерческое помещение <span class="commerce_list_room_area_text">131.60 м²</span>
                        </div>

                        <div>
                            <div>
                                Санкт-Петербург, Парашютная ул./Шуваловский пр.
                            </div>
                            <div class="row">
                                <div class="commerce_list_item_metro_logo col-xs-2">
                                    <img src="images/icons_and_logo/metro-logo-violet.svg">
                                </div>
                                <div class="commerce_list_item_metro_text col-xs-10">
                                    Комендантский проспект
                                </div>
                            </div>
                        </div>

                        <div class="commerce_list_item_advantages">
                            Лучшая цена на старте продаж!
                        </div>

                        <div class="commerce_list_item_btn_wrap">
                            <span class="b_link b_link_lg b_link_orange">
                                <span class="commerce_list_item_btn_discount_text">
                                    Узнать цену
                                </span>
                            </span>
                        </div>

                    </div>

                    <div class="commerce_list_item_info col-xs-12 col-sm-4 col-md-5 col-lg-3">

                        <div class="commerce_list_item_info_t row">
                            ЖК UP-квартал «Комендантский»
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Класс:
                            </div>
                            <div class="col-xs-7">
                                Комфорт-класс
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-5">
                                Кол-во квартир:
                            </div>
                            <div class="col-xs-7">
                                1449 квартир
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-5">
                                Срок сдачи:
                            </div>
                            <div class="col-xs-7">
                                2 очередь – 2 кв. 2019
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Этаж:
                            </div>
                            <div class="col-xs-7">
                                Первый
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Площадь:
                            </div>
                            <div class="col-xs-7">
                                131.60 м²
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Жилой блок:
                            </div>
                            <div class="col-xs-7">
                                3.2
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-5">
                                Секция:
                            </div>
                            <div class="col-xs-7">
                                1
                            </div>
                        </div>

                    </div>

                </div>

                <a href="#callbackwidget" class="commerce_list_item_link_mask"></a>

            </div>
            <!-- commerce_list_item (komendantskiy - 2 ochered) end -->


            <!-- commerce_list_item (moskovskiy) -->
            <div class="commerce_list_item">

                <div class="row">

                    <div class="commerce_list_item_img_wrap col-xs-12 col-sm-3 col-md-3 col-lg-4">

                        <div class="">
                            <img src="images/commerce_planirovki/moskovskiy-commerce-75.19-250x250.png">
                        </div>

                    </div>

                    <div class="commerce_list_item_description col-xs-12 col-sm-5 col-md-4 col-lg-5">
                        <div class="commerce_list_item_t">
                            Коммерческое помещение <span class="commerce_list_room_area_text">75.19 м²</span>
                        </div>

                        <div>
                            <div>
                                Санкт-Петербург, Шушары, Школьная улица
                            </div>
                            <div class="row">
                                <div class="commerce_list_item_metro_logo col-xs-2">
                                    <img src="images/icons_and_logo/metro-logo-blue.svg">
                                </div>
                                <div class="commerce_list_item_metro_text col-xs-10">
                                    Купчино
                                </div>
                            </div>
                        </div>

                        <div class="commerce_list_item_advantages">

                            <span class="commerce_list_item_discount_text hidden-xs hidden-sm">
                                Только в декабре <span class="hidden-md">– </span>скидки до 700 000 руб.!
                            </span>

                            <span class="commerce_list_item_discount_text hidden-md hidden-lg">
                                Только в декабре
                            </span>
                            <span class="hidden-md hidden-lg">
                                <br>
                            </span>
                            <span class="commerce_list_item_discount_text hidden-md hidden-lg">
                                Скидки до 700 000 руб.!
                            </span>

                        </div>
                        
                        <div class="commerce_list_item_btn_wrap">
                            <span class="b_link b_link_lg b_link_orange">
                                <span class="commerce_list_item_btn_discount_text">
                                    Узнать цену со скидкой
                                </span>
                            </span>
                        </div>

                    </div>

                    <div class="commerce_list_item_info col-xs-12 col-sm-4 col-md-5 col-lg-3">

                        <div class="commerce_list_item_info_t row">
                            ЖК UP-квартал «Московский»
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Класс:
                            </div>
                            <div class="col-xs-7">
                                Комфорт-класс
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-5">
                                Кол-во квартир:
                            </div>
                            <div class="col-xs-7">
                                831 квартира
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-5">
                                Срок сдачи:
                            </div>
                            <div class="col-xs-7">
                                1 очередь – 1 кв. 2018
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Этаж:
                            </div>
                            <div class="col-xs-7">
                                Первый
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Площадь:
                            </div>
                            <div class="col-xs-7">
                                75.19 м²
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Номер офиса:
                            </div>
                            <div class="col-xs-7">
                                6
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-5">
                                Секция:
                            </div>
                            <div class="col-xs-7">
                                3
                            </div>
                        </div>

                    </div>

                </div>

                <a href="#callbackwidget" class="commerce_list_item_link_mask"></a>

            </div>
            <!-- commerce_list_item (moskovskiy) end -->


            <!-- commerce_list_item (moskovskiy) -->
            <div class="commerce_list_item">

                <div class="row">

                    <div class="commerce_list_item_img_wrap col-xs-12 col-sm-3 col-md-3 col-lg-4">

                        <div class="">
                            <img src="images/commerce_planirovki/moskovskiy-commerce-81.74-250x250.png">
                        </div>

                    </div>

                    <div class="commerce_list_item_description col-xs-12 col-sm-5 col-md-4 col-lg-5">
                        <div class="commerce_list_item_t">
                            Коммерческое помещение <span class="commerce_list_room_area_text">81.74 м²</span>
                        </div>

                        <div>
                            <div>
                                Санкт-Петербург, Шушары, Школьная улица
                            </div>
                            <div class="row">
                                <div class="commerce_list_item_metro_logo col-xs-2">
                                    <img src="images/icons_and_logo/metro-logo-blue.svg">
                                </div>
                                <div class="commerce_list_item_metro_text col-xs-10">
                                    Купчино
                                </div>
                            </div>
                        </div>

                        <div class="commerce_list_item_advantages">
                            
                            <span class="commerce_list_item_discount_text hidden-xs hidden-sm">
                                Только в декабре <span class="hidden-md">– </span>скидки до 700 000 руб.!
                            </span>

                            <span class="commerce_list_item_discount_text hidden-md hidden-lg">
                                Только в декабре
                            </span>
                            <span class="hidden-md hidden-lg">
                                <br>
                            </span>
                            <span class="commerce_list_item_discount_text hidden-md hidden-lg">
                                Скидки до 700 000 руб.!
                            </span>

                        </div>
                        
                        <div class="commerce_list_item_btn_wrap">
                            <span class="b_link b_link_lg b_link_orange">
                                <span class="commerce_list_item_btn_discount_text">
                                    Узнать цену со скидкой
                                </span>
                            </span>
                        </div>

                    </div>

                    <div class="commerce_list_item_info col-xs-12 col-sm-4 col-md-5 col-lg-3">

                        <div class="commerce_list_item_info_t row">
                            ЖК UP-квартал «Московский»
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Класс:
                            </div>
                            <div class="col-xs-7">
                                Комфорт-класс
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-5">
                                Кол-во квартир:
                            </div>
                            <div class="col-xs-7">
                                831 квартира
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-5">
                                Срок сдачи:
                            </div>
                            <div class="col-xs-7">
                                1 очередь – 1 кв. 2018
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Этаж:
                            </div>
                            <div class="col-xs-7">
                                Первый
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Площадь:
                            </div>
                            <div class="col-xs-7">
                                81.74 м²
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Номер офиса:
                            </div>
                            <div class="col-xs-7">
                                11
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-5">
                                Секция:
                            </div>
                            <div class="col-xs-7">
                                3
                            </div>
                        </div>

                    </div>

                </div>

                <a href="#callbackwidget" class="commerce_list_item_link_mask"></a>

            </div>
            <!-- commerce_list_item (moskovskiy) end -->


            <!-- commerce_list_item (moskovskiy) -->
            <div class="commerce_list_item">

                <div class="row">

                    <div class="commerce_list_item_img_wrap col-xs-12 col-sm-3 col-md-3 col-lg-4">

                        <div class="">
                            <img src="images/commerce_planirovki/moskovskiy-commerce-131.23-250x250.png">
                        </div>

                    </div>

                    <div class="commerce_list_item_description col-xs-12 col-sm-5 col-md-4 col-lg-5">
                        <div class="commerce_list_item_t">
                            Коммерческое помещение <span class="commerce_list_room_area_text">131.23 м²</span>
                        </div>

                        <div>
                            <div>
                                Санкт-Петербург, Шушары, Школьная улица
                            </div>
                            <div class="row">
                                <div class="commerce_list_item_metro_logo col-xs-2">
                                    <img src="images/icons_and_logo/metro-logo-blue.svg">
                                </div>
                                <div class="commerce_list_item_metro_text col-xs-10">
                                    Купчино
                                </div>
                            </div>
                        </div>

                        <div class="commerce_list_item_advantages">
                            
                            <span class="commerce_list_item_discount_text hidden-xs hidden-sm">
                                Только в декабре <span class="hidden-md">– </span>скидки до 700 000 руб.!
                            </span>

                            <span class="commerce_list_item_discount_text hidden-md hidden-lg">
                                Только в декабре
                            </span>
                            <span class="hidden-md hidden-lg">
                                <br>
                            </span>
                            <span class="commerce_list_item_discount_text hidden-md hidden-lg">
                                Скидки до 700 000 руб.!
                            </span>

                        </div>
                        
                        <div class="commerce_list_item_btn_wrap">
                            <span class="b_link b_link_lg b_link_orange">
                                <span class="commerce_list_item_btn_discount_text">
                                    Узнать цену со скидкой
                                </span>
                            </span>
                        </div>

                    </div>

                    <div class="commerce_list_item_info col-xs-12 col-sm-4 col-md-5 col-lg-3">

                        <div class="commerce_list_item_info_t row">
                            ЖК UP-квартал «Московский»
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Класс:
                            </div>
                            <div class="col-xs-7">
                                Комфорт-класс
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-5">
                                Кол-во квартир:
                            </div>
                            <div class="col-xs-7">
                                831 квартира
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-5">
                                Срок сдачи:
                            </div>
                            <div class="col-xs-7">
                                1 очередь – 1 кв. 2018
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Этаж:
                            </div>
                            <div class="col-xs-7">
                                Первый
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Площадь:
                            </div>
                            <div class="col-xs-7">
                                131.23 м²
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Номер офиса:
                            </div>
                            <div class="col-xs-7">
                                3
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-5">
                                Секция:
                            </div>
                            <div class="col-xs-7">
                                2
                            </div>
                        </div>

                    </div>

                </div>

                <a href="#callbackwidget" class="commerce_list_item_link_mask"></a>

            </div>
            <!-- commerce_list_item (moskovskiy) end -->


            <!-- commerce_list_item (moskovskiy) -->
            <div class="commerce_list_item">

                <div class="row">

                    <div class="commerce_list_item_img_wrap col-xs-12 col-sm-3 col-md-3 col-lg-4">

                        <div class="">
                            <img src="images/commerce_planirovki/moskovskiy-commerce-156.78-250x250.png">
                        </div>

                    </div>

                    <div class="commerce_list_item_description col-xs-12 col-sm-5 col-md-4 col-lg-5">
                        <div class="commerce_list_item_t">
                            Коммерческое помещение <span class="commerce_list_room_area_text">156.78 м²</span>
                        </div>

                        <div>
                            <div>
                                Санкт-Петербург, Шушары, Школьная улица
                            </div>
                            <div class="row">
                                <div class="commerce_list_item_metro_logo col-xs-2">
                                    <img src="images/icons_and_logo/metro-logo-blue.svg">
                                </div>
                                <div class="commerce_list_item_metro_text col-xs-10">
                                    Купчино
                                </div>
                            </div>
                        </div>

                        <div class="commerce_list_item_advantages">
                            
                            <span class="commerce_list_item_discount_text hidden-xs hidden-sm">
                                Только в декабре <span class="hidden-md">– </span>скидки до 700 000 руб.!
                            </span>

                            <span class="commerce_list_item_discount_text hidden-md hidden-lg">
                                Только в декабре
                            </span>
                            <span class="hidden-md hidden-lg">
                                <br>
                            </span>
                            <span class="commerce_list_item_discount_text hidden-md hidden-lg">
                                Скидки до 700 000 руб.!
                            </span>

                        </div>
                        
                        <div class="commerce_list_item_btn_wrap">
                            <span class="b_link b_link_lg b_link_orange">
                                <span class="commerce_list_item_btn_discount_text">
                                    Узнать цену со скидкой
                                </span>
                            </span>
                        </div>

                    </div>

                    <div class="commerce_list_item_info col-xs-12 col-sm-4 col-md-5 col-lg-3">

                        <div class="commerce_list_item_info_t row">
                            ЖК UP-квартал «Московский»
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Класс:
                            </div>
                            <div class="col-xs-7">
                                Комфорт-класс
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-5">
                                Кол-во квартир:
                            </div>
                            <div class="col-xs-7">
                                831 квартира
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-5">
                                Срок сдачи:
                            </div>
                            <div class="col-xs-7">
                                1 очередь – 1 кв. 2018
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Этаж:
                            </div>
                            <div class="col-xs-7">
                                Первый
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Площадь:
                            </div>
                            <div class="col-xs-7">
                                156.78 м²
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Номер офиса:
                            </div>
                            <div class="col-xs-7">
                                2
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-5">
                                Секция:
                            </div>
                            <div class="col-xs-7">
                                1
                            </div>
                        </div>

                    </div>

                </div>

                <a href="#callbackwidget" class="commerce_list_item_link_mask"></a>

            </div>
            <!-- commerce_list_item (moskovskiy) end -->


        </div>

        <div class="row after_commerce_list_zhk_images_wrap">
            <div class="after_commerce_list_zhk_images_item col-xs-6">
                <img src="images/zhk-komendantskiy-378x275.png">
                <div class="after_commerce_list_zhk_images_item_text light_gray">
                    UP-квартал «Комендантский»
                    <div class="after_commerce_list_zhk_images_item_metro_logo_wrap">
                        <img class="after_commerce_list_zhk_images_item_metro_logo" src="images/icons_and_logo/metro-logo-violet.svg">
                        Комендантский пр.
                    </div>
                </div>
            </div>
            <div class="after_commerce_list_zhk_images_item col-xs-6">
                <img src="images/zhk-moskovskiy-378x275.png">
                <div class="after_commerce_list_zhk_images_item_text light_gray">
                    UP-квартал «Московский»
                    <div class="after_commerce_list_zhk_images_item_metro_logo_wrap">
                        <img class="after_commerce_list_zhk_images_item_metro_logo" src="images/icons_and_logo/metro-logo-blue.svg">
                        Купчино
                    </div>
                </div>
            </div>            
        </div>

        <div class="commerce_disclaimer_notes_wrap">
            <div class="commerce_disclaimer_notes_text">
                ФСК «Лидер». Дополнительную информацию по вопросам приобретения коммерческих помещений
                можно уточнить в отделе продаж по телефону:
            </div>
            <div class="commerce_disclaimer_notes_phone_wrap">
                <a class="callibri_phone" href="tel:+78124438406">+7 (812) 703-55-55</a>
            </div>
        </div>

    </div>
</div>
<!-- section_commerce_planirovki end -->


<!-- PhotoSwipe gallery -->
<!-- Root element of PhotoSwipe. Must have class pswp. -->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

    <!-- Background of PhotoSwipe. 
         It's a separate element, as animating opacity is faster than rgba(). -->
    <div class="pswp__bg"></div>

    <!-- Slides wrapper with overflow:hidden. -->
    <div class="pswp__scroll-wrap">

        <!-- Container that holds slides. PhotoSwipe keeps only 3 slides in DOM to save memory. -->
        <!-- don't modify these 3 pswp__item elements, data is added later on. -->
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>

        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
        <div class="pswp__ui pswp__ui--hidden">

            <div class="pswp__top-bar">

                <!--  Controls are self-explanatory. Order can be changed. -->

                <div class="pswp__counter"></div>

                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

                <button class="pswp__button pswp__button--share" title="Share"></button>

                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                <!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR -->
                <!-- element will get class pswp__preloader--active when preloader is running -->
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div> 
            </div>

            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
            </button>

            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
            </button>

            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>

        </div>

    </div>

</div>
<!-- PhotoSwipe gallery end -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->

<script src="js/bootstrap.min.js"></script>

<!-- jquery.magnific-popup -->
<script src="js/magnific-popup/jquery.magnific-popup.min.js"></script>
<!-- jquery.magnific-popup end -->

<!-- PhotoSwipe -->
<script src="js/photoswipe/dist/photoswipe.min.js"></script>
<script src="js/photoswipe/dist/photoswipe-ui-default.min.js"></script>
<!-- PhotoSwipe end -->

<!-- photoswipe_implementation (для просмотрщика фотографий) -->
<script src="js/photoswipe_implementation.js"></script>
<!-- photoswipe_implementation (для просмотрщика фотографий) end -->

<!-- Tooltip (bootstrap) -->
<script type='text/javascript'>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip({
            'html':true
        });
    });
</script>
<!-- Tooltip (bootstrap) end -->

<!-- Envybox -->
<link rel="stylesheet" href="https://cdn.envybox.io/widget/cbk.css">
<script type="text/javascript" src="https://cdn.envybox.io/widget/cbk.js?wcb_code=7d458869621243cadb5726865bc396de" charset="UTF-8" async></script>
<!-- Envybox end -->

<!-- Callibri -->
<script src="//cdn.callibri.ru/callibri.js" type="text/javascript" charset="utf-8"></script>
<!-- Callibri end -->


<script type="text/javascript">
var fActive = '';
 
function filterColor(color){
 if(fActive != color){
 $('.qqq').filter('.'+color).slideDown();
 $('.qqq').filter(':not(.'+color+')').slideUp();
 fActive = color;
 }
}
 
$('.f-red').click(function(){ filterColor('red'); });
$('.f-blue').click(function(){ filterColor('blue'); });
$('.f-green').click(function(){ filterColor('green'); });
 
$('.f-all').click(function(){
 $('.qqq').slideDown();
 fActive = 'all';
});
</script>

<script type="text/javascript">
var orderdirection = new Array();
function is_num( text, flag )
{
    if( flag == 0 )
    {
        return text;
    }else
    {
        return parseFloat( text );
    }
}
function oi_div_order( selector, container, block, flag )
{
    block = container + ' ' + block;
    var ordered_dives = $( block ).sort(function (a, b)
	{
        a = $(a).find( '[data-name=' + selector + ']' ).text();
        b = $(b).find( '[data-name=' + selector + ']' ).text();
		if( orderdirection[ selector ] == undefined || orderdirection[ selector ] == 0 )
		{
			return ( is_num( a, flag ) > is_num( b, flag ) ) ? 1 : ( is_num( a, flag ) < is_num( b, flag ) ) ? -1 : 0;
		}else{
			return ( is_num( a, flag ) < is_num( b, flag ) ) ? 1 : ( is_num( a, flag ) > is_num( b, flag ) ) ? -1 : 0;
		}
    });
    $( container ).html( ordered_dives );
	
	if( orderdirection[ selector ] == undefined || orderdirection[ selector ] == 0 )
	{
		orderdirection[ selector ] = 1;
		$( '[data-order=' + selector + ']' ).addClass( 'up' );
	}else{
		orderdirection[ selector ] = 0;
		$( '[data-order=' + selector + ']' ).removeClass( 'up' );
	}
}
$('[data-orderby]').on('click', function () {
	var orderby = $(this).data( 'orderby' );
	switch ( orderby )
	{
	  case 'number': flag = 1; break;
	  default: flag = 0;
	}
    oi_div_order( orderby, '.list', '.row', flag );
});
</script>

<script type="text/javascript">
$('.sort_link').click(function (event) {
    const target = $(event.target.parentNode);
    if (target.hasClass('active')) {
        if (target.hasClass('asc')) {
            target.removeClass('asc');
            target.addClass('desc');
        } else {
            target.removeClass('desc');
            target.addClass('asc');
        }
    } else {
        $('.sort_link').removeClass('active')
        target.addClass('active');
    }

    window.location.href = setUrlParameter(window.location.href.replace(/#/g, ''), 'sort', `${($('.sort_link.active').hasClass('desc') ? '-' : '')}${$('.sort_link.active').data('value')}`);

    event.preventDefault();
});
</script>

</body>
</html>