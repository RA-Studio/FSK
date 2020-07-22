!function(a,b){"function"==typeof define&&define.amd?define([],b(a)):"object"==typeof exports?module.exports=b(a):a.inlineSVG=b(a)}("undefined"!=typeof global?global:this.window||this.global,function(a){var b,c={},d=!!document.querySelector&&!!a.addEventListener,e={svgSelector:"img.svg"},f=function(a,b){return function(){if(--a<1)return b.apply(this,arguments)}},g=function(){var a={},b=!1,c=0,d=arguments.length;"[object Boolean]"===Object.prototype.toString.call(arguments[0])&&(b=arguments[0],c++);for(var e=function(c){for(var d in c)Object.prototype.hasOwnProperty.call(c,d)&&(b&&"[object Object]"===Object.prototype.toString.call(c[d])?a[d]=g(!0,a[d],c[d]):a[d]=c[d])};c<d;c++){e(arguments[c])}return a},h=function(){return document.querySelectorAll(b.svgSelector)},i=function(a){var c=h(),d=f(c.length,a);Array.prototype.forEach.call(c,function(a,c){var e=a.src||a.getAttribute("data-src"),f=a.attributes,g=new XMLHttpRequest;g.open("GET",e,!0),g.onload=function(){if(g.status>=200&&g.status<400){var c=new DOMParser,e=c.parseFromString(g.responseText,"text/xml"),h=e.getElementsByTagName("svg")[0];if(h.removeAttribute("xmlns:a"),h.removeAttribute("width"),h.removeAttribute("height"),h.removeAttribute("x"),h.removeAttribute("y"),h.removeAttribute("enable-background"),h.removeAttribute("xmlns:xlink"),h.removeAttribute("xml:space"),h.removeAttribute("version"),Array.prototype.slice.call(f).forEach(function(a){"src"!==a.name&&"alt"!==a.name&&h.setAttribute(a.name,a.value)}),h.classList?h.classList.add("inlined-svg"):h.className+=" inlined-svg",h.setAttribute("role","img"),f.longdesc){var i=document.createElementNS("http://www.w3.org/2000/svg","desc"),j=document.createTextNode(f.longdesc.value);i.appendChild(j),h.insertBefore(i,h.firstChild)}if(f.alt){h.setAttribute("aria-labelledby","title");var k=document.createElementNS("http://www.w3.org/2000/svg","title"),l=document.createTextNode(f.alt.value);k.appendChild(l),h.insertBefore(k,h.firstChild)}a.parentNode&&a.parentNode.replaceChild(h,a),d&&d(b.svgSelector)}else console.error("There was an error retrieving the source of the SVG.")},g.onerror=function(){console.error("There was an error connecting to the origin server.")},g.send()})};return c.init=function(a,c){d&&(b=g(e,a||{}),i(c||function(){}))},c});
// preloader

var sliderPrevBtn = '<button type="button" class="slider-arrow slider-prev"><svg xmlns="http://www.w3.org/2000/svg" class="svg" width="12.121" height="6.811" viewBox="0 0 12.121 6.811"><g transform="translate(1.061 1.061)"><path d="M0,0,5,5l5-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/></g></svg></button>',
sliderNextBtn = '<button type="button" class="slider-arrow slider-next"><svg xmlns="http://www.w3.org/2000/svg" class="svg" width="12.121" height="6.811" viewBox="0 0 12.121 6.811"><g transform="translate(1.061 1.061)"><path d="M0,0,5,5l5-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/></g></svg></button>';

$(document).ready(function(){
    var lazyLoadInstance = new LazyLoad({
        elements_selector: ".lazyload"
    });
});
$(document).ready(function() {
    var updateCatalog = function(allmutations){
    // allmutations — массив, и мы можем использовать соответствующие методы JavaScript.
        allmutations.map( function(mr){
            var lazyLoadInstance = new LazyLoad({
                elements_selector: ".lazyload"
            });
        });
    },
    updateCatalogElement = document.querySelectorAll('body')[0],
    updateCatalogObserver = new MutationObserver(updateCatalog),
    updateCatalogOptions = {
        // обязательный параметр: наблюдаем за добавлением и удалением дочерних элементов.
        'childList': true,
        // наблюдаем за добавлением и удалением дочерних элементов любого уровня вложенности.
        'subtree': true
    }
    updateCatalogObserver.observe(updateCatalogElement, updateCatalogOptions);
});

$(window).on('load', function() {
    var myHash = location.hash;
    //location.hash = '';
    if(myHash[1] != undefined) {
      $('html, body').animate({scrollTop: $(myHash).offset().top - 100}, 1000);
    };
    var gets = (function() {
        var a = window.location.search;
        var b = new Object();
        a = a.substring(1).split("&");
        for (var i = 0; i < a.length; i++) {
          c = a[i].split("=");
            b[c[0]] = c[1];
        }
        return b;
    })();

    if(gets['data-id']){

        $('html,body').animate({ scrollTop: $('[data-id="#' + gets['data-id'] +'"]').offset().top - 100 }, 1000);
    }

    $('.preloader').fadeOut();
    $('preloader .pl').delay(350).fadeOut('slow');
});

function aeroBtnOnLoad() {
	setTimeout(() => {
		if ($('.project-build .custom-popup__video').is(':visible')){
			$('.project-photos .custom-popup__video').data('src', $('.project-build .custom-popup__video').data('src'));
			$('.project-photos .custom-popup__video').show();
		}
		if ($('.project-build .custom-popup__video').is(':hidden')) {
			$('.project-photos .custom-popup__video').hide();
		}
	}, 1600);
}

function declOfNum(number, titles) { // функция склонения строки
    cases = [2, 0, 1, 1, 1, 2];
    return titles[ (number%100>4 && number%100<20)? 2 : cases[(number%10<5)?number%10:5] ];
}


var queryLocalAll = localStorage.getItem('buildQuery');
if(queryLocalAll) {
    queryLocalAll = JSON.parse(queryLocalAll);

}

function loadPage() {

    // img.svg to inline svg
    inlineSVG.init();

    $("select.ui-select").each(function() {
        var classes = $(this).attr("class"),
            id      = $(this).attr("id"),
            name    = $(this).attr("name");
        var template =  '<div class="' + classes + '">';
        template += '<div class="ui-select__trigger">' + $(this).data("placeholder") + '</div>';
        template += `<div class="ui-select__options" data-link="${name}">`;
        template += '<div class="ui-select__simplebar" data-simplebar data-simplebar-auto-hide="false">';
        $(this).find("option").each(function() {
            template += '<span data-type="'+ $(this).data('type') +'" data-year="'+ $(this).data('year') +'" class="ui-select__option ' + $(this).attr("class") + '" data-value="' + $(this).attr("value") + '">' + $(this).html() + '</span>';
        });
        template += '</div></div></div>';
        $(this).addClass('ui-select__select');
        $(this).after(template);
    });

    // запись значений ренджа в подсказки
    function putResults(val1, val2) {
        $('.ui-range__from').text(val1);
        $('.ui-range__to').text(val2);
    }

    function upadateFilterData (el) {
        let form = $(el).parents('form');
        let temp = $(form).data(`filter-type`);
        if(temp == `build`) {
            window.controller.getData().buildFilter(el);
        } else {
            window.controller.getData().filterApartment(el);
        }
    }

    $(`[name="PROPERTY_rooms"]`).each(function(){
        if(queryLocalAll !== null ) {
            if(queryLocalAll['PROPERTY_rooms'] !== undefined) {
                if(!queryLocalAll['PROPERTY_rooms'].indexOf(this.value)) {
                    $(this).prop("checked", true);
                }
            }
        }
    });

    function initRanges() {
        $('.ui-range__slider').each(function (i, el) {
            let _this = this;
            var min = $(el).data('min');
            var max = $(el).data('max');

            if(queryLocalAll) {
                min = queryLocalAll[`>=${$(this).data('name')}`];
                max = queryLocalAll[`<=${$(this).data('name')}`];
            }
            $(this).slider({
                range: true,
                min: $(el).data('min'),
                max: $(el).data('max'),
                step: $(el).data('step'),
                values: [min, max],
                slide: function (event, ui) {
                    $(el).closest('.ui-range').find('.ui-range__from').val(ui.values[0]);
                    $(el).closest('.ui-range').find('.ui-range__to').val(ui.values[1]);
                },
                change: function( event, ui ) {
                    upadateFilterData(el);
                }
            });
            $(el).closest('.ui-range').find('input').change(function () {
                if ($(this).hasClass('ui-range__from')) {
                    if ($(el).data('min') <= $(this).val()) {
                        $(_this).slider("values", 0, $(this).val());
                    }
                } else if ($(this).hasClass('ui-range__to')) {
                    if ($(el).data('max') >= $(this).val()) {
                        $(_this).slider("values", 1, $(this).val())
                    }
                } else {
                    /*console.log("Нет такого параметра");*/
                }
                upadateFilterData(el);
            });
        });
    }
    initRanges();
    $('.ui-range__val').focusin(function () {
        $(this).closest('.ui-range').addClass('ui-range--focus');
    });
    $('.ui-range__val').focusout(function () {
        $(this).closest('.ui-range').removeClass('ui-range--focus');
    });




    // Слайдеры на странице ЖК
    $('#gallery-1').slick({
        infinite: false,
        speed: 800,
        fade: true,
        focusOnSelect: false,
        asNavFor: '#gallery-1-thumbs',
        prevArrow: sliderPrevBtn,
        nextArrow: sliderNextBtn,
        lazyLoad: 'ondemand',
        responsive: [
            {
                breakpoint: 767,
                settings: {
                    arrows: false
                }
            }
        ]
    });

    $('#gallery-1-thumbs').slick({
        infinite: false,
        slidesToShow: 8,
        arrows: false,
        speed: 800,
        focusOnSelect: true,
        asNavFor: '#gallery-1',
        lazyLoad: 'ondemand',
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 6,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 4,
                }
            }
        ]
    });

    $(document).on('click', '.tabs-gallery__btn', function (e) {
    	e.preventDefault();
		let tabContainers = $('.tab-gallery');
		tabContainers.removeClass('active');
		tabContainers.filter(this.hash).addClass('active');
		$('.tabs-gallery__btn').removeClass('btn--bg active').addClass('btn--transp');
		$(this).addClass('btn--bg active').removeClass('btn--transp')
		$('.tab-gallery .slick-initialized').slick('unslick');
		$('#gallery-1').slick({
	        infinite: false,
	        speed: 800,
	        fade: true,
	        focusOnSelect: false,
	        asNavFor: '#gallery-1-thumbs',
	        prevArrow: sliderPrevBtn,
	        nextArrow: sliderNextBtn,
	        lazyLoad: 'ondemand',
	        responsive: [
	            {
	                breakpoint: 767,
	                settings: {
	                    arrows: false
	                }
	            }
	        ]
	    });

	    $('#gallery-1-thumbs').slick({
	        infinite: false,
	        slidesToShow: 8,
	        arrows: false,
	        speed: 800,
	        focusOnSelect: true,
	        asNavFor: '#gallery-1',
	        lazyLoad: 'ondemand',
	        responsive: [
	            {
	                breakpoint: 1199,
	                settings: {
	                    slidesToShow: 6,
	                }
	            },
	            {
	                breakpoint: 767,
	                settings: {
	                    slidesToShow: 4,
	                }
	            }
	        ]
	    });


	    $('#gallery-slider1').slick({
	        infinite: false,
	        speed: 800,
	        fade: true,
	        focusOnSelect: false,
	        asNavFor: '#gallery-slider1-thumbs',
	        prevArrow: sliderPrevBtn,
	        nextArrow: sliderNextBtn,
	        lazyLoad: 'ondemand',
	        responsive: [
	            {
	                breakpoint: 767,
	                settings: {
	                    arrows: false
	                }
	            }
	        ]
	    });

	    $('#gallery-slider1-thumbs').slick({
	        infinite: false,
	        slidesToShow: 8,
	        arrows: false,
	        speed: 800,
	        focusOnSelect: true,
	        asNavFor: '#gallery-slider1',
	        lazyLoad: 'ondemand',
	        responsive: [
	            {
	                breakpoint: 1199,
	                settings: {
	                    slidesToShow: 6,
	                }
	            },
	            {
	                breakpoint: 767,
	                settings: {
	                    slidesToShow: 4,
	                }
	            }
	        ]
	    });
    });



    /*$('#gallery-1').on('afterChange', function (event) {
      $('#gallery-1-thumbs').find('.slick-current').removeClass('slick-current');
      $('#gallery-1-thumbs').find('[data-slick-index="' + $(this).find('.slick-current').data('slickIndex') + '"]').addClass('slick-current');
    });*/

    $('.advantages-slider-img').slick({
        arrows: false,
        speed: 800,
        asNavFor: '.advantages-slider-text',
        dotsClass: 'slider-dots slider-dots--dark'
    });
    $('.advantages-slider-text').slick({
        speed: 800,
        fade: true,
        asNavFor: '.advantages-slider-img',
        arrows: false,
        dotsClass: 'slider-dots slider-dots--dark',
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    arrows: false
                }
            },
            {
                breakpoint: 767,
                settings: {
                    adaptiveHeight: true
                }
            }
        ]
    });

    $('.advantages-slider .slider-prev').click(function(){
        $('.advantages-slider-text').slick('slickPrev');
    });
    $('.advantages-slider .slider-next').click(function(){
        $('.advantages-slider-text').slick('slickNext');
    });


  /*$('#gallery-2').on('afterChange', function (event) {
    $('#gallery-2-thumbs').find('.slick-current').removeClass('slick-current');
    $('#gallery-2-thumbs').find('[data-slick-index="' + $(this).find('.slick-current').data('slickIndex') + '"]').addClass('slick-current');
  });*/


    // BEGIN scrollspy в подменю на странице ЖК

    var scrollspyOffset;
    if( $('.scrollspy-menu').length ) {
        scrollspyOffset = $('.scrollspy-menu').offset().top -60;
    }

    $('.scrollspy-menu a, .anchor-scroll').on('click', function(e){
        var id = $(this).attr('href');
        e.preventDefault();
        $('html,body').stop().animate({ scrollTop: $(id).offset().top-150 }, 1000);
    });

    function AnchorActive() {
        /*console.log('AnchorActive');*/
        $('.scrollspy-item').each(function(e) {
            var dataName = $(this).attr('id');
            var posit = $(this).offset().top - 400;

            var windowPostition = $(window).scrollTop();

            if (windowPostition >= posit) {
                $('.scrollspy-menu a').removeClass('active');
                $('.scrollspy-menu [href="#'+ dataName + '"]').addClass('active');
            }

        });
    }


    function lineFixing() {
        /*console.log('lineFixing');*/
        if ( $(window).scrollTop() >= scrollspyOffset ) {
            $('.scrollspy-menu').addClass('scrollspy-menu--fixed');
            $('.wrapper').addClass('scrollspy-padding');
        } else {
            $('.scrollspy-menu').removeClass('scrollspy-menu--fixed');
            $('.wrapper').removeClass('scrollspy-padding');
        }
    }

    // $(window).scroll(function() {
    //     AnchorActive();
    //     lineFixing();
    // });


    // END scrollspy в подменю на странице ЖК


    /* Реинициализация элементов при ресайзе окна */
    $(window).on('load resize orientationchange', function() {
        // слайдер объектов О Компании
        $('.completed-projects').each(function(){
            var $carousel = $(this);
            if ($(window).width() > 1023) {
                if ($carousel.hasClass('slick-initialized')) {
                    $carousel.slick('unslick');
                }
            }
            else{
                if (!$carousel.hasClass('slick-initialized')) {
                    $carousel.slick({
                        arrows: false,
                        dots: true,
                        dotsClass: 'slider-dots slider-dots--dark',
                        slidesToShow: 2,
                        variableWidth: true,
                        responsive: [
                            {
                              breakpoint: 768,
                              settings: {
                                slidesToShow: 1
                              }
                            }
                          ]
                    });
                }
            }
        });

        // слайдер Социальная ответственность О Компании
        $('.contacts-social').each(function(){
            var $carousel = $(this);
            if ($(window).width() > 767) {
                if ($carousel.hasClass('slick-initialized')) {
                    $carousel.slick('unslick');
                }
            }
            else{
                if (!$carousel.hasClass('slick-initialized')) {
                    $carousel.slick({
                        arrows: false,
                        dots: true,
                        dotsClass: 'slider-dots slider-dots--dark',
                        slidesToShow: 1,
                        variableWidth: true,
                    });
                }
            }
        });

        // слайдер преимуществ на главной
        $('.advantages-list').each(function(){
            var $carousel = $(this);
            if ($(window).width() > 767) {
                if ($carousel.hasClass('slick-initialized')) {
                    $carousel.slick('unslick');
                }
            }
            else{
                if (!$carousel.hasClass('slick-initialized')) {
                    $carousel.slick({
                        arrows: false,
                        dots: true,
                        dotsClass: 'slider-dots slider-dots--dark',
                        mobileFirst: true,
                    });
                }
            }
        });


        // ограничение количетсва символов в тексте карточки ЖК
        var symbolsCount;
        if ($(window).width() >= 1200) {
            symbolsCount = 205;
        } else if ($(window).width() < 1200 && $(window).width() > 992) {
            symbolsCount = 330;
        } else if ($(window).width() <= 992 && $(window).width() > 767) {
            symbolsCount = 235;
        } else if ($(window).width() <= 767 && $(window).width() > 575) {
            symbolsCount = 160;
        } else {
            symbolsCount = 130;
        }

        $('.my-readmore').each(function () {
            var str = $(this).find('p').text();
            if( str.length > symbolsCount ) {
                str = str.substr(0,symbolsCount-16) + "... ";

                let linkT = setInterval(()=>{
                    /*console.log($(this).closest('.quarter').find('.quarter-link').html());*/
                    var linkHref = $(this).closest('.quarter').find('.quarter-link').attr('href');
                    if (linkHref != undefined && linkHref!= ''){
                        var link = '<a href="' + linkHref + '"' + '>Читать далее</a>';
                        $(this).find('p').append(link);
                        clearInterval(linkT);
                    }
                },200);

                $(this).find('p').text(str);
            }
        });


        // слайдер других объектов
        $('.project-data').each(function(){
            var $carousel = $(this);
            if ($(window).width() > 767) {
                if ($carousel.hasClass('slick-initialized')) {
                    $carousel.slick('unslick');
                }
            }
            else{
                if (!$carousel.hasClass('slick-initialized')) {
                    $carousel.slick({
                        arrows: false,
                        dots: true,
                        dotsClass: 'slider-dots slider-dots--dark',
                        mobileFirst: true,
                        rows: 3
                    });
                }
            }
        });

        // слайдер других объектов
        $('.project-other').each(function(){
            var $carousel = $(this);
            if ($(window).width() > 1199) {
                if ($carousel.hasClass('slick-initialized')) {
                    $carousel.slick('unslick');
                }
            }
            else{
                if (!$carousel.hasClass('slick-initialized')) {
                    $carousel.slick({
                        arrows: false,
                        dots: true,
                        dotsClass: 'slider-dots slider-dots--dark',
                        mobileFirst: true,
                    });
                }
            }
        });
        AnchorActive();
        lineFixing();
    });

    // Инициализая кастомного скролбара при ресайзе
    var addEvent = function(object, type, callback) {
        if (object == null || typeof(object) == 'undefined') return;
        if (object.addEventListener) {
            object.addEventListener(type, callback, false);
        } else if (object.attachEvent) {
            object.attachEvent("on" + type, callback);
        } else {
            object["on"+type] = callback;
        }
    };
    addEvent(window, "resize", function(event) {
        if( $('#results-screen').length ) {
            new SimpleBar(document.getElementById('results-screen'), {
                autoHide: false
            });
        }
    });

    // Jquery табы
    $(".js-tab").click(function() {
        var index = $(this).index();
        $(this).closest('.js-tab-wrapper').find(".js-tab").removeClass("js-tab--active").eq(index).addClass("js-tab--active");
        $(this).closest('.js-tab-wrapper').find(".js-tab-item").hide().eq(index).fadeIn("normal");
    });



    // Тогл блок в вакансиях
    $('.btn-vacancy').click(function (e) {
        $(this).closest('.vacancy').toggleClass('vacancy--open');
    });



    // Зум изображения в карточке квартиры
    setTimeout(() => {
        if($('.zoom-link').length){
            $('.zoom-link').fancybox({
                buttons: [
                    "close"
                ]
            });
        }
    }, 9000);


    // =============================== ДЛЯ ДЕМО ===============================
    // вызов модального окна благодарности на странице ипотеки
    $('.demo-modal-success').magnificPopup({
        items: {
            src: '#modal-ipo-success',
            type: 'inline'
        }
    });


    // Раскрытие карты в блоке результатов
    $('.results-geo__btn').click(function (e) {
        $('.results-geo').toggleClass('results-geo-map');
    });

    // Тогл блок фильтров в мобильной версии
    $('.filter-mob').click(function (e) {
        $(this).toggleClass('filter-mob-show');
        $('.filter-mob-collapse').slideToggle('100');
    });


    // Инпут с "плюс" "минус"
    // $('.ui-quantity__btn').click(function(){
    //
    // });
    /*
    $('.ui-quantity input').bind('input propertychange', function () {
        var $this = $(this);
        if ( $this.val().length == 0 || parseInt( $this.val() ) <= 0 )
            $this.val(1);
    });
*/




    // Анимации кнопок
    // Кнопки CTA
    var animateCta = function(e) {

        // Для демо
        // e.preventDefault();

        e.target.classList.remove('cta-animate');

        e.target.classList.add('cta-animate');
        setTimeout(function(){
            e.target.classList.remove('cta-animate');
        }, 700);

    };

    var bubblyButtons = document.getElementsByClassName("btn--cta");

    for (var i = 0; i < bubblyButtons.length; i++) {
        bubblyButtons[i].addEventListener('click', animateCta, false);
    }

    // Эффект клика
    [].map.call(document.querySelectorAll('.btn'), el=> {
        el.addEventListener('click',e => {
            e = e.touches ? e.touches[0] : e;
            const r = el.getBoundingClientRect(), d = Math.sqrt(Math.pow(r.width,2)+Math.pow(r.height,2)) * 2;
            el.style.cssText = `--s: 0; --o: 1;`;  el.offsetTop;
            el.style.cssText = `--t: 1; --o: 0; --d: ${d}; --x:${e.clientX - r.left}; --y:${e.clientY - r.top};`
        })
    })








	$('.custom-popup__btn').magnificPopup({
		items: {
			src: '#modal-callback',
			type: 'inline'
		},
		callbacks: {
			open: function() {
				$('body').addClass('mfp-card');
			},
			close: function() {
				$('body').removeClass('mfp-card');
			}
		}
	});




    /*$('.js-call-callback').magnificPopup({
        items: {
            src: '#modal-callback',
            type: 'inline'
        },
        callbacks: {
            open: function() {
                $('body').addClass('mfp-card mfp-top');
            },
            close: function() {
                $('body').removeClass('mfp-card mfp-top');
            }
        }
    });*/

    // =============================== ДЛЯ ДЕМО ===============================
    // вызов модального окна благодарности после заказа звонка
    /*$('#modal-callback .btn').magnificPopup({
        items: {
            src: '#modal-thanks',
            type: 'inline'
        },
        callbacks: {
            open: function() {
                $('body').addClass('mfp-card').removeClass('mfp-top');
            },
            close: function() {
                $('body').removeClass('mfp-card');
            }
        }
    });*/

}

const initTopSlider = () => { // Слайдеры на главной
    $('.bg-slider').slick({ speed: 1800, asNavFor: '.main-slider', prevArrow: sliderPrevBtn, nextArrow: sliderNextBtn, lazyLoad: 'progressive', responsive: [{ breakpoint: 768, settings: { arrows: false } } ] });
    $('.main-slider').slick({ arrows: false, dots: true, dotsClass: 'slider-dots', speed: 1800, fade: true, asNavFor: '.bg-slider', });
}

$(document).ready(function() {
    initTopSlider();
    setTimeout(() => {
        $listImg = document.querySelectorAll('[data-loda-img]');
        $listImg.forEach(element => {
            /*console.log(element.getAttribute('data-loda-img'));*/
            let img = element.getAttribute('data-loda-img');
            element.setAttribute('src', img);
        });
    }, 3000);

    let timeLoad = 2000;
    let path = window.location.pathname;

    /*console.log(path,'local');*/
    switch(path) {
        case '/':
            timeLoad = 2000;
        break;
        case '/newbuild/':
            timeLoad = 0;
        break;
        default:
            timeLoad = 0;
            break;
    }
    /*console.log(timeLoad,'time');*/

    setTimeout(() => {
        try {
            if( $('#results-screen').length ) {
                window.controller.initData().crollBar(`results-screen`);
            }
            var mortgageInit = false;
            window.controller.getData().filterApartment($(`.filter`).find(`.form-submit`)).then(function () {
                window.controller.initData().map(false);
                window.controller.getData().mortgageFilter();
            });
            var page = document.location.pathname;
            if(page == "/mortgage/") {
                window.controller.getData().mortgageFilter();
            }
        } catch (e) {

        } 
    }, timeLoad);

    setTimeout(() => {
        loadPage();
    }, 3000);

    $(document).on("click", ".ui-select__trigger", function(event) {
        if( $(this).closest(".ui-select").hasClass('opened') ){
            $(this).closest(".ui-select").removeClass("opened");
            return
        } else {
            $(".ui-select").removeClass("opened");
            $(this).closest(".ui-select").addClass("opened");
            return
        }
        $('html').one('click',function() {
            $(".ui-select").removeClass("opened");
        });
        event.stopPropagation();
    });

    $(document).on("click", ".ui-select__option", function() {
        let link = $(this).parents(`.ui-select__options`).data(`link`);
        $(`select[name=${link}]`).val($(this).data("value"));
        $(this).closest(".ui-select").find("select").val($(this).data("value"));
        $(this).closest(".ui-select__options").find(".ui-select__option").removeClass("active");
        $(this).addClass("active");
        $(this).closest(".ui-select").removeClass("opened");
        $(this).closest(".ui-select").find(".ui-select__trigger").text($(this).text());
       /* console.log($(this).parents(".ui-select"));//.data(`event-change`)*/

        if($($(this).parents(".ui-select")[0].previousElementSibling).data(`event-change`) == `updateResult`) {
            window.controller.getData().filterApartment(this);
        } else {
            window.controller.getData().buildFilter(this);
        }

        let selectValue = $(`select[name=${link}]`).val(),
            selectVideo = $(`select[name=${link}] option[value=${selectValue}]`).data(`video`)
        if(selectVideo){
            $(this).closest(`.gallery-btns.project-build__top`).find('iframe').attr('src', selectVideo)
        }
    });

    // Тогл блок дополнительных фильтров
    $(document).on('click', '.filter-additional', function (e){
        $(this).toggleClass('filter-additional--opened');
        $(this).closest('.filter').toggleClass('filter--toggle');
        $(this).closest('.filter').find('.filter__hidden').slideToggle(200);
    });



    // Зaпрет на ввод всего кроме цифр
    $(document).on('focus', '.filter input:not([type="checkbox"])', function(){
        $(this).val(parseInt($(this).val()));
        $(this).attr('type', 'number');
    });

    $(document).on('change', '.filter input:not([type="checkbox"])', function(){
       /* console.log($(this).closest('.ui-range').find('.ui-range__slider').data('max'));*/
        if( $(this).closest('.ui-range').find('.ui-range__slider').data('max') < $(this).val() ){
            $(this).val($(this).closest('.ui-range').find('.ui-range__slider').data('max'));
        }
        /*console.log($(this).closest('.ui-range').find('.ui-range__slider').data('min'));*/
        if( $(this).closest('.ui-range').find('.ui-range__slider').data('min') > $(this).val() ){
            $(this).val($(this).closest('.ui-range').find('.ui-range__slider').data('min'));
        }
    });

    $(document).on('click','.menu-trigger', function (e) {
        $(this).toggleClass('menu-open');
        $('.toggle-menu').toggleClass('menu-open');
    });

    $(document).on('click','.js-accordion-btn', function() {
        var dropDown = $(this).parent().find('.js-accordion-content');
        $(this).closest('.js-accordion').find('.js-accordion-content').not(dropDown).slideUp();
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
        } else {
            $(this).closest('.js-accordion').find('.js-accordion-btn.active').removeClass('active');
            $(this).addClass('active');
        }
        dropDown.stop(false, true).slideToggle();
    });
});

$(document).ready(function(){
    var myHash = location.hash;
    $(document).on('click', 'a:not(.tabs-navigation-item):not(.tabs-gallery__btn):not(.custom-popup__video)', function () {
      if($(this.hash).length){
        $('html,body').animate({scrollTop: $(this.hash).offset().top - 100}, 1000);
      }
    });

    $(document).on('click touchend','[data-role="favorite"]',function(e){
        favorite(this);
        e.preventDefault();
    });

    if($('.map-salepoint').length){
        $('.map-salepoint').each(function (index, item, array) {
            let coordsSalePoint = $(item).attr('data-coordinate');
            let zoom = $(item).attr('data-zoom');
            if(coordsSalePoint) {
                let coordNumber = coordsSalePoint.split(','),
                    mapId = $(item).attr('id');
                for (var i = 0; i < coordNumber.length; i++) {
                    coordNumber[i] = +coordNumber[i];
                }
                var initYandexMapSalepoint = setInterval(() => {
                    try {
                        ymaps.ready(init);
                        clearInterval(initYandexMapSalepoint);
                    } catch(e) {

                    }
                }, 1000);
                function init(){
                    var myMap = new ymaps.Map(mapId, {
                        center: coordNumber,
                        zoom: zoom !== ""? zoom : 10,
                        controls: [/*'zoomControl'*/],
                    });
                    /*myMap.behaviors.disable('scrollZoom');*/
                    var myPlacemark = new ymaps.Placemark(coordNumber, {}, {
                        iconLayout: 'default#image',
                        iconImageHref: '/local/templates/fsk/img/marker.svg',
                        iconImageSize: [30, 50],
                        iconImageOffset: [-3, -35],
                    });

                    myMap.geoObjects.add(myPlacemark);

                }
            }
        });
    }

    if($('.advantages-new-slider').length){
      $('.advantages-new-slider').slick({
        //slidesToShow: 2,
        slidesToScroll: 1,
        arrows: true,
        dots: true,
        variableWidth: true,
        prevArrow: $('.advantages-new-slider__prev'),
        nextArrow: $('.advantages-new-slider__next'),
        slidesToShow: 2,
        infinite: true,
        lazyLoad: 'progressive',
        responsive: [{
          breakpoint: 1023,
          settings: {
            arrows: false,
          }
        },{
          breakpoint: 767,
          settings: {
            slidesToShow: 1,
            variableWidth: false,
            arrows: false,
          }
        }]
      })
    }

    /*    $(document).find('.slick-cloned').removeAttr('data-fancybox');*/


    if($('.types-block-tabs-tab-slider').length){
    	$('.types-block-tabs-tab.active .types-block-tabs-tab-slider').slick({
    		slidesToScroll: 1,
        	arrows: true,
        	responsive: [
			    {
			      breakpoint: 1024,
			      settings: {
			        arrows: false,
			        dots: true
			      }
			    }
			]
    	});
    }
});


/*Табы на апартаментах*/
$(document).on('click', '.tabs-navigation-item', function (e) {
	e.preventDefault();
	let tabContainers = $(this).closest('.tabs').find('.tabs-tab');
	tabContainers.removeClass('active');
	tabContainers.filter(this.hash).addClass('active');
	$(this).closest('.tabs').find('.tabs-navigation-item').removeClass('active');
	$(this).addClass('active');
	$('.types-block-tabs-tab-slider.slick-initialized').slick('unslick');
	$('.types-block-tabs-tab.active .types-block-tabs-tab-slider').slick({
    	slidesToScroll: 1,
        arrows: true,
        responsive: [
		    {
		      breakpoint: 1024,
		      settings: {
		        arrows: false,
		        dots: true
		      }
		    }
		]
    });
});
$(document).on('click', '.types-block-tabs-tab-nav__item', function (e) {
	$('.types-block-tabs-tab.active .types-block-tabs-tab-nav__item').removeClass('active');
	$(this).addClass('active');
	if($(this).hasClass('plan')){
		$(this).closest('.types-block-tabs-tab').find('.types-block-tabs-tab-slider').hide();
		$(this).closest('.types-block-tabs-tab').find('.types-block-tabs-tab-scheme').show().css('display', 'flex');
	} else {
		$(this).closest('.types-block-tabs-tab').find('.types-block-tabs-tab-slider').show();
		$(this).closest('.types-block-tabs-tab').find('.types-block-tabs-tab-scheme').hide();
		$('.types-block-tabs-tab-slider.slick-initialized').slick('unslick');
		$('.types-block-tabs-tab.active .types-block-tabs-tab-slider').slick({
	    	slidesToScroll: 1,
	        arrows: true,
	        responsive: [
			    {
			      breakpoint: 1024,
			      settings: {
			        arrows: false,
			        dots: true
			      }
			    }
			]
	    });
	}
});
/*Табы на апартаментах Конец*/


/*Тултипы апартаменты*/
$(document).on('click', '.scheme-tooltip', function (e) {
	if($(this).hasClass('active')){
		$(this).find('span').hide();
		$(this).removeClass('active');
	} else {
		$(document).find('.scheme-tooltip span').hide();
		$(document).find('.scheme-tooltip').removeClass('active');
		$(this).find('span').show();
		$(this).addClass('active');
	}

});
$(document).on('click', function (e) {
	if(!$('.scheme-tooltip.active').is(e.target) && $('.scheme-tooltip.active').has(e.target).length === 0){
		$(document).find('.scheme-tooltip').removeClass('active');
		$(document).find('.scheme-tooltip span').hide();
	}
});
/*Тултипы апартаменты Конец*/


/*Подмена последнего пункта меню апартаментов*/
$(document).ready(function(){
	if (document.documentElement.clientWidth >= 1200) {
		$(document).find('.scrollspy-menu.apart-menu a:last-child').text('Док...');
	}
});
/*Подмена последнего пункта меню апартаментов Конец*/


/*Выпадающий список типов номеров*/
if (document.documentElement.clientWidth < 1300) {
	$(document).on('click', '.types-block-nav__active', function (e) {
		$(this).closest('.types-block-nav-wrap').find('.types-block-nav').toggle();
		$(this).toggleClass('active');
	});
	$(document).on('click', '.types-block-nav__item', function (e) {
		$('.types-block-nav').hide();
		$('.types-block-nav__active').removeClass('active').html($(this).html());
	});
	$(document).on('click', function (e) {
		if(!$('.types-block-nav-wrap').is(e.target) && $('.types-block-nav-wrap').has(e.target).length === 0){
			$('.types-block-nav').hide();
			$('.types-block-nav__active').removeClass('active');
		}
	});
}
/*Выпадающий список типов номеров Конец*/


// /*Всплывашка КоронаВирус*/
// $(document).on('click', '.corona-popup__close, .corona-popup-info-btns .btn', function (e) {
// 	$('.corona').fadeOut();
// 	$('html').css({
//         	'overflow': 'visible',
//         	'margin-right': '0'
//         })
// });
// $(document).on('click', '.corona', function (e) {
// 	var div = $('.corona-popup');
// 	if(!div.is(e.target) && div.has(e.target).length === 0){
// 		$('.corona').fadeOut();
// 		$('html').css({
//         	'overflow': 'visible',
//         	'margin-right': '0'
//         })
// 	}
// });
// $(document).on('click', '.corona-popup-info-accordeon__title', function (e) {
// 	$(this).next('.corona-popup-info-accordeon__text').slideToggle();
// });
// $(function() {
//     // Проверяем запись в куках о посещении
//     // Если запись есть - ничего не происходит
//     if (!$.cookie('hideModal')) {
//     // если cookie не установлено появится окно
//     // с задержкой 5 секунд
//         var delay_popup = 100;
//         setTimeout("document.querySelector('.corona').style.display='block'", delay_popup);
//         $('html').css({
//         	'overflow': 'hidden',
//         	'margin-right': '17px'
//         })
//     }
//     $.cookie('hideModal', true, {
//     // Время хранения cookie в днях
//         expires: 1,
//         path: '/'
//     });
// });
// /*Всплывашка КоронаВирус Конец*/


function favorite(item){
    let ids = item.getAttribute('data-id');//$(item).data('ids');
    let to  = 'FAVORITE';
    let data = {"TO":to,"ID":ids};
    $.ajax({
        url:'/favourite/',
        type:'POST',
        data: data,
        success:function(result){
            if(location.pathname == '/favourite/') {
                let r = $(result).find('[data-entity="container-1"]').html();
                if(r === undefined) {
                    r = ``;
                }
                $(document).find('[data-entity="container-1"]').html(r);

            };


            //$('.results__header').find('.interactive-favorite').toggleClass('active');
            //$('.card__info').find('.interactive-favorite').toggleClass('active');

            $.getJSON('/favourite/data.json', function(data) {
                if(data != undefined && data != null && (Object.keys(data).length > 0)){
                    $(`[data-role="favorite"][data-id="${ids}"]`).toggleClass(`active`);
                    $('.link-favourite, .mob-link-favourite').addClass('active');
                } else {
                    $(`[data-role="favorite"][data-id="${ids}"]`).removeClass(`active`);
                    $('.link-favourite, .mob-link-favourite').removeClass('active');
                    if($('.results-empty.favourite-empty').length){
                        $('.results-empty.favourite-empty').css('display', 'flex');
                    }
                }
            });

            //favorite();
            inlineSVG.init();
        }
    });
}

$(document).on('click', '.reserve-info__close, .reserve-info__close svg', function (e) {
    e.preventDefault();
    $('.reserve-info').hide();
    $('.page.reservation.reserv-info-padding').removeClass('reserv-info-padding');
    $('.page.page-project.flat').removeClass('reserv-padding');
});


$(document).ready(function(){

    if($('.page.page-project.flat').length && $('.reserve-info').length ){
        $('.page.page-project.flat').addClass('reserv-padding');
    }
    if($('.contacts-today-content').innerHeight() > 290){
        $('.contacts-today-content').addClass('hide')
    }


});

$(document).on('click', '.contacts-today-content__btn', function (e) {
    $('.contacts-today-content').removeClass('hide')
});


window.onload = function() {
    setTimeout(() => {
        let scriptMap = document.createElement('script'),
            scriptDate = document.createElement('script'),
            scriptMask = document.createElement('script'),
            scriptForm = document.createElement('script'),
            scriptFancybox = document.createElement('script');
        scriptMap.src = "https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=75dbee99-a6cf-46b3-b846-8323b7986d25";
        scriptDate.src = "/local/templates/fsk/js/air-datepicker.js";
        scriptMask.src = "/local/templates/fsk/js/input-mask.js";
        scriptForm.src = "/local/components/slam/easyform/templates/uniform/uniform.js";
        scriptFancybox.src = "/local/templates/fsk/js/fancybox.js";
        document.getElementsByTagName('head')[0].appendChild(scriptMap);
        document.getElementsByTagName('head')[0].appendChild(scriptDate);
        document.getElementsByTagName('head')[0].appendChild(scriptMask);
        document.getElementsByTagName('head')[0].appendChild(scriptForm);
        document.getElementsByTagName('head')[0].appendChild(scriptFancybox);
    }, 3000);
};

$(document).on('click', '.custom-popup__video', function (e) {
    let videoSrc = this.dataset.src;
    $('#modal-videobuild .modal-callback__inner iframe').remove();
    $('#modal-videobuild .modal-callback__inner').append(`<iframe width="560" height="315" src="${videoSrc}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`)
});
