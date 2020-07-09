class ApartmentControll {
    constructor() {

        this.dataObject = {
            currentElement: false,
            activeElement: false,
            lastQuery: {
                build: false,
                apartment: false,
            },
            mortgage: {
                items: {},
                itemsShow: {},
                option: {
                    credit: 2500000,
                    first: 1500000,
                    age: 10,
                },
                navOption: {
                    index: 0,
                    step: 5,
                }
            },
            firstOut: {
                load: true,
                list: false,
            },
            controllerBtn: {
                sliderPrevBtn:'<button type="button" class="slider-arrow slider-prev"><svg xmlns="http://www.w3.org/2000/svg" class="svg" width="12.121" height="6.811" viewBox="0 0 12.121 6.811"><g transform="translate(1.061 1.061)"><path d="M0,0,5,5l5-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/></g></svg></button>',
                sliderNextBtn:'<button type="button" class="slider-arrow slider-next"><svg xmlns="http://www.w3.org/2000/svg" class="svg" width="12.121" height="6.811" viewBox="0 0 12.121 6.811"><g transform="translate(1.061 1.061)"><path d="M0,0,5,5l5-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/></g></svg></button>'
            },
            mapIndexPage: {
                object: false,
                myBalloonLayout: false,
            },
            templates: {
                buildSectionUrl: "/newbuild/",
            },
            sort: {
                field: "price",
                nav: "ASC"
            }
        }
        ;

        this.crollBar = false;
        this.modeLoad = false;
        this.pathPage = document.location.pathname;

        if(this.pathPage.indexOf(`commercial`) != -1) {
            this.modeLoad = "commercial"
        } else if (this.pathPage.indexOf(`newbuild`) != -1 || this.pathPage == "/") {
            this.modeLoad = "flat";
        }

        if(this.modeLoad == "commercial") {
            this.dataObject.templates.buildSectionUrl = "/commercial/";
        }

        if( $(window).width() > 1200 ) {
            if( $('#results-screen').length ) {
                this.crollBar = this.initData().crollBar(`results-screen`);
            }
        }

    }
    initData() {
        let _this = this;
        return {
            map(dataFromAjax = false) {
                return new Promise((resolve, reject) => {
                    if ($('#map_index').length) {
                        function init() {
                            if (_this.dataObject.mapIndexPage.object === false) {

                                _this.dataObject.mapIndexPage.object = new ymaps.Map("map_index", {
                                    center: [59.937123, 30.311470],
                                    zoom: 9,
                                    controls: [/*'zoomControl'*/]
                                });
                                /*_this.dataObject.mapIndexPage.myBalloonLayout = ymaps.templateLayoutFactory.createClass(
                                    '<a class="close" href="#">&times;</a>' +
                                    '<div class="popover-img"><img src="/local/templates/fsk/img/marker.svg"></div>' +
                                    '<div><h3 class="popover-title">$[properties.balloonHeader]</h3>' +
                                    '<div class="popover-content">$[properties.balloonContent]</div>', {
                                    }
                                );*/
                                // Создание макета балуна на основе Twitter Bootstrap.
                                _this.dataObject.mapIndexPage.MyBalloonLayout = ymaps.templateLayoutFactory.createClass(
                                    '<div class="popover top">' +
                                    '<div class="arrow"></div>' +
                                    '<div class="popover-inner">' +
                                    '$[[options.contentLayout observeSize minWidth=235]]' +
                                    '</div>' +
                                    '</div>', {
                                        build: function () {
                                            this.constructor.superclass.build.call(this);
                                            this._$element = $('.popover', this.getParentElement());
                                            this._$element.find('.close')
                                                .on('click', $.proxy(this.onCloseClick, this));
                                        },
                                        onCloseClick: function (e) {
                                            e.preventDefault();
                                            this.events.fire('userclose');
                                        },
                                    }),

                                    // Создание вложенного макета содержимого балуна.
                                    _this.dataObject.mapIndexPage.MyBalloonContentLayout = ymaps.templateLayoutFactory.createClass(
                                        '<div class="popover-wrap">' +
                                        '<div class="popover-img"><img class = "lazyload" data-src="/local/templates/fsk/img/marker.svg"></div>' +
                                        '<div class="popover-content">' +
                                        /*'<a class="close" href="#">&times;</a>' +*/
                                        `<a href="$[properties.balloonUrl]"><h3 class="popover-title">$[properties.balloonHeader]</h3></a>` +
                                        '<div class="popover-text"><div class="p-metro flex"><div class="p-metro__branch" style="border-color: $[properties.metroColor];"></div><span>$[properties.metroName]</span></div></div>' +
                                        /*'<a class="popover-btn" href="$[properties.balloonUrl]">Подробнее</a>'+               $[properties.balloonContent]*/
                                        '</div>' +
                                        '</div>'
                                    )
                                /*_this.dataObject.mapIndexPage.object.behaviors.disable('scrollZoom');*/

                            }

                            var addresses;
                            reload_data();
                            set_placemarks();

                            function reload_data(success) {
                                let dataFromAjaxString = JSON.stringify(dataFromAjax);
                                let dataToJSONSpb = JSON.parse(dataFromAjaxString, function (key, value) {
                                    if (key == 'id') return +value;
                                    if (key == 'center' && value) {
                                        value = value.replace(/\s/g, '');
                                        let coordNumber = value.split(',');
                                        for (var i = 0; i < coordNumber.length; i++) {
                                            coordNumber[i] = +coordNumber[i];
                                        }
                                        return coordNumber;
                                    }
                                    return value;
                                });
                                addresses = dataToJSONSpb.items;
                            }

                            function set_placemarks() {
                                if (!addresses) return false;
                                _this.dataObject.mapIndexPage.object.geoObjects.removeAll();

                                var i = 0;
                                var myPlacemarks = [];
                                for (var j = 0; j < addresses.length; j++) {
                                    myPlacemarks[i++] = new ymaps.Placemark(addresses[j].center, {
                                        hintContent: addresses[j].name,
                                        dataId: addresses[j].id,
                                        balloonHeader: addresses[j].name,
                                        balloonContent: addresses[j].adress,
                                        balloonUrl: addresses[j].url,
                                        metroName: addresses[j].metro[0].UF_NAME,
                                        metroColor: addresses[j].metro[0].UF_COLOR,
                                    }, {
                                        iconLayout: 'default#image',
                                        iconImageHref: '/local/templates/fsk/img/marker.svg',
                                        iconImageSize: [30, 50],
                                        iconImageOffset: [-3, -35],
                                        balloonPanelMaxMapArea: 0,
                                        balloonShadow: false,
                                        /*balloonLayout: _this.dataObject.mapIndexPage.myBalloonLayout,*/
                                        balloonLayout: _this.dataObject.mapIndexPage.MyBalloonLayout,
                                        balloonContentLayout: _this.dataObject.mapIndexPage.MyBalloonContentLayout,
                                        hideIconOnBalloonOpen: false
                                    });
                                }

                                if (myPlacemarks.length) {
                                    for (var j = 0; j < myPlacemarks.length; j++) {
                                        _this.dataObject.mapIndexPage.object.geoObjects.add(myPlacemarks[j]);
                                    }
                                }
                            }
                        }

                        if (dataFromAjax === false) {
                            _this.getData().buildFilter();
                        } else {
                            var initYandexMap = setInterval(() => {
                                try {
                                    ymaps.ready(init);
                                    clearInterval(initYandexMap);
                                } catch(e) {

                                }
                            }, 1000);
                        }

                    }
                    else {
                        if (dataFromAjax === false) {
                            _this.getData().buildFilter();
                        }
                    }
                });
            },
            event() {
                try {
                    $(document).ready(function(){
                        $.getJSON('/favourite/data.json', function(data) {
                            if(data != null) {
                                if(Object.keys(data).length){
                                    $('.link-favourite, .mob-link-favourite').addClass('active');
                                }
                            }

                        });
                    })
                } catch (e) {

                }



                $(document).on('keyup', '[data-name="first"] input, [data-name="credit"] input', function(){
                    $(this).val($(this).val().replace(/[^\+\d]/g, ''));
                });

                $(document).on('focus', '[data-name="credit"] input', function(){
                    let inputCredit = $(this);
                    let string = inputCredit.val().replace(/ /g, '');
                    inputCredit.val(string);
                })



                $(document).on('focus', '[data-name="first"] input', function(){
                    let inputFirst = $(this);
                    let string = inputFirst.val().replace(/ /g, '');
                    inputFirst.val(string);


                })




                $(document).on('blur', '[data-name="credit"] input', function(){
                    let inputCredit = $(this);
                    let inputCreditVal = parseInt(inputCredit.val());
                    let sosedInputFirstVal = $('[data-name="first"]').find('input').val().replace(/ /g, '');

                    if(parseInt(inputCreditVal) < parseInt(sosedInputFirstVal)){
                        inputCreditVal = parseInt(sosedInputFirstVal) + 100000;
                    }

                    if (typeof inputCreditVal === "string" || inputCreditVal instanceof String) {
                        inputCreditVal = parseInt(sosedInputFirstVal) + 100000;
                    }


                    inputCredit.val(inputCreditVal);
                    _this.setData().printMortgageData(this);

                    //inputCreditVal = parseInt(parseInt(inputCreditVal) / 100000) * 100000;
                    inputCreditVal = ('' + inputCreditVal).replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
                    //inputCredit.attr('type', 'text');
                    inputCredit.val(inputCreditVal);




                })



                $(document).on('blur', '[data-name="first"] input', function(){
                    let inputFirst = $(this);
                    let inputFirstVal = parseInt(inputFirst.val());
                    let sosedInputCreditVal = $('[data-name="credit"]').find('input').val().replace(/ /g, '');

                    if(parseInt(inputFirstVal) > parseInt(sosedInputCreditVal)){
                        inputFirstVal = parseInt(sosedInputCreditVal) - 100000;
                    }

                    if(parseInt(inputFirstVal) < 100000){
                        inputFirstVal = 100000;
                    }

                    console.log(inputFirstVal);

                    if (typeof inputFirstVal === "string" || inputFirstVal instanceof String) {
                        inputFirstVal = parseInt(sosedInputCreditVal) - 100000;
                    }

                    inputFirst.val(inputFirstVal);
                    _this.setData().printMortgageData(inputFirst);

                    //inputFirstVal = parseInt(parseInt(inputFirstVal) / 100000) * 100000;

                    inputFirstVal = ('' + inputFirstVal).replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');

                    inputFirst.val(inputFirstVal);


                })


                /* years ручной ввод */

                $(document).on('keyup', 'input.years', function(){
                    $(this).val($(this).val().replace(/[^\+\d]/g, ''));
                });

                $(document).on('input', 'input.years', function(){
                    let years = parseInt($(this).val().replace (/[^\+\d]/g, ''));
                    $(this).val(years);
                })
                $(document).on('focus', 'input.years', function(){
                    let years = parseInt($(this).val().replace (/[^\+\d]/g, ''));
                    $(this).val(years);
                })


                $(document).on('blur', 'input.years', function(){

                    let years = parseInt($(this).val().replace (/[^\+\d]/g, ''));
                    if($(this).val() > 30) {
                        years = 30;
                    } else if ($(this).val() < 1){
                        years = 1;
                    }
                    $(this).val(years ); //+ ' лет'


                    _this.setData().printMortgageData(this);
                })
                /* years ручной ввод конец */


                $(document).on('click','[data-event]',function() {
                    _this.eventList(this,this.getAttribute("data-event"));
                });
                $(document).on('change','[data-event-change]',function() {
                    _this.eventList(this,this.getAttribute("data-event-change"));
                });
                $(document).on('click','[data-plan]',function(e) {
                    $('[data-plan]').removeClass('current');
                    $(this).addClass('current');
                    $('.results__img').find('.img').attr('src', $(this).data('plan'));
                    if( $(window).width() < 1200 ) {
                        e.stopPropagation();
                        $.magnificPopup.open({
                            items: {
                                src: '#card-example',
                            },
                            type: 'inline',
                            callbacks: {
                                open: function() {
                                    $('body').addClass('mfp-card');
                                },
                                close: function() {
                                    $('body').removeClass('mfp-card');
                                }
                            }
                        });
                    }
                });
                $(document).on('click',`.interactive-print`, function(e) {
                    let ifrm = document.createElement("iframe");
                    let id = this.getAttribute('data-id');
                    ifrm.setAttribute("src", `/print.php?ID=${id}`);
                    ifrm.style.width = "0px";
                    ifrm.style.height = "0px";
                    document.body.appendChild(ifrm);
                    e.preventDefault();
                    return false;
                });
            },
            crollBar(idElement) {
                return new SimpleBar(document.getElementById(idElement), {
                    autoHide: false
                });
            },
            buildStep() {
                try {
                    $('#gallery-2').slick({
                        infinite: false,
                        speed: 800,
                        fade: true,
                        focusOnSelect: false,
                        asNavFor: '#gallery-2-thumbs',
                        prevArrow: _this.dataObject.controllerBtn.sliderPrevBtn,
                        nextArrow: _this.dataObject.controllerBtn.sliderNextBtn,
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

                    $('#gallery-2-thumbs').slick({
                        infinite: false,
                        slidesToShow: 8,
                        arrows: false,
                        speed: 800,
                        focusOnSelect: true,
                        asNavFor: '#gallery-2',
                        lazyLoad: 'ondemand',
                        // variableWidth: true,
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

                  /*$('#gallery-2').on('afterChange', function (event) {
                    $('#gallery-2-thumbs').find('.slick-current').removeClass('slick-current');
                    $('#gallery-2-thumbs').find('[data-slick-index="' + $(this).find('.slick-current').data('slickIndex') + '"]').addClass('slick-current');
                  });*/

                } catch (e) {
                    console.log(e);
                }

            },
            mortgagePopup () {
                $('.ipo-table__row').magnificPopup({
                    items: {
                        src: '#ipo-request',
                        type: 'inline'
                    },
                    callbacks: {
                        open: function(e) {

                            let first = _this.dataObject.mortgage.option.first;
                            let credit = _this.dataObject.mortgage.option.credit - first;
                            let age = _this.dataObject.mortgage.option.age;
                            let id = $(this.st.el[0]).data(`id`);
                            let popupMortgage = $(`#ipo-request`);
                            let mortgage = _this.dataObject.mortgage.itemsShow[id];
                            let dataColBlock = $(popupMortgage).find(`.ipo-request__data .data-col`);

                            $(popupMortgage).find(`.ipo-request__header .img`).attr('src', mortgage['PROPERTIES']['UF_IMAGE']['VALUE']);

                            let data = `
                                <div class="data-col">
                                    <div>${mortgage['~NAME']}</div>
                                    <div class="sub-text">Лицензия № ${mortgage['PROPERTIES']['UF_NUMBER']['VALUE']} от ${mortgage['PROPERTIES']['UF_DATE']['VALUE']}</div>
                                </div>
                                <div class="data-row">
                                    <div class="data-col">
                                        <div class="sub-text text-bold">Ставка</div><span>от ${mortgage['PROPERTIES']['UF_VALUE']['VALUE']}%</span>
                                    </div>
                                    <div class="data-col">
                                        <div class="sub-text text-bold">Срок</div><span>${mortgage['PROPERTIES']['UF_STAV']['VALUE']} лет</span>
                                    </div>
                                    <div class="data-col">
                                        <div class="sub-text text-bold">Ежемесячный платёж, р.</div><span>${_this.helper().firstPriceMortgage(credit, mortgage['PROPERTIES']['UF_VALUE']['VALUE'], age)}</span>
                                    </div>
                                </div>
                            `

                            $(popupMortgage).find(`.ipo-request__data`).html(data);
                            $(popupMortgage).find('form [name="FIELDS[BANK_NAME]"]').val(`${mortgage['~NAME']}`);
                            $(popupMortgage).find('form [name="FIELDS[RATE]"]').val(`${mortgage['PROPERTIES']['UF_VALUE']['VALUE']}`);
                            $(popupMortgage).find('form [name="FIELDS[TERM]"]').val(`${mortgage['PROPERTIES']['UF_STAV']['VALUE']}`);
                            $(popupMortgage).find('form [name="FIELDS[PAYMENT]"]').val(`${_this.helper().firstPriceMortgage(credit, mortgage['PROPERTIES']['UF_VALUE']['VALUE'], age)}`);
                            /*$(popupMortgage).find('form [name="FIELDS[CUR_PAGE]"]').val(location.href);*/
                            $('body').addClass('mfp-card mfp-top');
                        },
                        close: function() {
                            $('body').removeClass('mfp-card mfp-top');
                        }
                    }
                });
            }
        }
    }
    getData() {
        let _this = this;
        return {
            mortgageFilter() {
                _this.getDataAjax({}, "Filter.InMortgage").then((request) => {
                    let result = request.result;
                    if(request.isSuccess) {
                        _this.dataObject.mortgage.items = result;
                        $('.show-more-ipoteka').show();
                        _this.setData().moreIpoteka(true);
                    }
                });
            },
            buildFilter (i) {

                let form = $(i).parents('form');
                let prelouder = $(i).parents('.container').find(`.filter-preloader`);
                let data = form.serializeArray();
                let jsonSend = {};

                $(prelouder).show();

                for(let element of data) {

                    if(
                        !$(form).hasClass('filter--toggle') &&
                        (
                            element['name'] == `PROPERTY_builtyear` && !element['value']
                        )
                    ) continue;

                    if(jsonSend[element['name']]) {
                        let type = typeof jsonSend[element['name']];
                        if( type === "string" ) {
                            let temp = jsonSend[element['name']];
                            jsonSend[element['name']] = [];
                            jsonSend[element['name']].push(temp);
                            jsonSend[element['name']].push(element['value']);
                        } else {
                            jsonSend[element['name']].push(element['value']);
                        }
                    } else {
                        jsonSend[element['name']] = element['value'];
                    }
                }

                if(_this.modeLoad === false) {
                    return false;
                }

                jsonSend[`PROPERTY_category`] = _this.modeLoad;

                _this.dataObject.lastQuery.build = jsonSend;

                _this.getDataAjax(jsonSend, "Filter.InBuildFilterCountElement").then((request) => {
                    $(prelouder).hide();
                    let result = request.result;
                    if(request.isSuccess && result.items) {
                        _this.initData().map(result);
                        _this.setData().printBuildLine(result);
                        // console.log(_this.pathPage);
                        if(_this.pathPage == `/commercial/`) {
                            if(!_this.dataObject.firstOut.load && result !== false) {
                                // console.log(`InBuildFilter`);
                                _this.getDataAjax(jsonSend, "Filter.InBuildFilter").then((request) => {
                                    $(prelouder).hide();
                                    let result = request.result;
                                    if(request.isSuccess && result) {
                                        $(`#p-6 .results .results__row.results__header`).show();
                                        $(`#p-6 .results .results__body`).show();
                                        $(`#p-6 .results .results-empty`).hide();
                                        _this.setData().printApartmentLine(result);
                                    } else {

                                        $(`#p-6 .results .results__row.results__header`).hide();
                                        $(`#p-6 .results .results__body`).hide();
                                        $(`#p-6 .results .results-empty`).show();
                                    }
                                });
                            }
                        }

                    } else {
                        _this.initData().map({});
                        _this.setData().printBuildLine(false,_this.dataObject.firstOut.list);
                    }
                    if(result.items) {
                        let endOfStr = declOfNum(result.items.length, ['объект', 'объекта', 'объектов']);
                        // $(`.results-geo__result`).html(`${result.items.length} объекта`);
                        $(`.results-geo__result`).html(result.items.length + ' ' + endOfStr);
                        $('.results-geo__result').show();
                        aeroBtnOnLoad();
                    } else {
                        $(`.results-geo__result`).html(`0 объектов`);
                        $('.results-geo__result').show();
                    }
                });

            },
            filterApartment (i) {
                return new Promise((resolve, reject) => {
                    let form = $(i).parents('form');
                    let prelouder = $(i).parents('.container').find(`.filter-preloader`);
                    let data = form.serializeArray();
                    let jsonSend = {};

                    $(prelouder).show();

                    for (let element of data) {

                        if (
                            !$(form).hasClass('filter--toggle') &&
                            (
                                element['name'] == `<=PROPERTY_kitchenspace` ||
                                element['name'] == `>=PROPERTY_kitchenspace`
                            )
                        ) continue;

                        if (jsonSend[element['name']]) {
                            let type = typeof jsonSend[element['name']];
                            if (type === "string") {
                                let temp = jsonSend[element['name']];
                                jsonSend[element['name']] = [];
                                jsonSend[element['name']].push(temp);
                                jsonSend[element['name']].push(element['value']);
                            } else {
                                jsonSend[element['name']].push(element['value']);
                            }
                        } else {
                            jsonSend[element['name']] = element['value'];
                        }
                    }

                    let queryLocal = localStorage.getItem('buildQuery');
                    if (queryLocal) {
                        queryLocal = JSON.parse(queryLocal);
                        console.log(queryLocal);
                        for (let itemF in queryLocal) {
                            let y = queryLocal[itemF];

                            if (jsonSend[itemF]) {
                                jsonSend[itemF] = y;
                                $(`[name='${itemF}']`).val(y);
                            }
                        }
                        $(`[href="#p-6"]`).trigger(`click`);
                        localStorage.removeItem('buildQuery');
                    }

                    if (_this.modeLoad === false) {
                        return false;
                    }

                    jsonSend[`PROPERTY_category`] = _this.modeLoad;

                    _this.getDataAjax(jsonSend, "Filter.InBuildFilter").then((request) => {
                        $(prelouder).hide();
                        let result = request.result;
                        if (request.isSuccess && result) {
                            $(`#p-6 .results .results__row.results__header`).show();
                            $(`#p-6 .results .results__body`).show();
                            $(`#p-6 .results .results-empty`).hide();
                            _this.setData().printApartmentLine(result);
                        } else {
                            $(`#p-6`).remove();
                            $(`[href="#p-6"]`).remove();

                            /*$(`#p-6 .results .results__row.results__header`).hide();
                            $(`#p-6 .results .results__body`).hide();
                            $(`#p-6 .results .results-empty`).show();*/
                            // _this.setData().apartmentList(`<div style="text-align: center;width: 100%;padding: 25px 0px;font-size: 20px;height: 100%;">По вашему запросу ничего не найдено</div>`);
                        }
                        resolve();
                    });
                });
            }
        }
    }
    eventList(i,e) {
        let _this = this;
        switch (e) {
            case "getFilterBuild":
                _this.getData().buildFilter(i);
                break;
            case "getFilterApartment":
                _this.getData().filterApartment(i);
                break;
            case "updateResult":
                _this.getData().filterApartment(i);
                break;
            case "updatePopup":
                _this.setData().popupData(i);
                break;
            case "showMoreIpoteka":
                _this.setData().moreIpoteka();
                break;
            case "mortgageFilter":
                _this.setData().filterData(i);
                break;
            case "buildRedirect":
                _this.action().buildRedirect(i);
            break;
            case "sortApartmentFun":
                _this.action().sortApartmentFun(i);
                break;
            case "clearfilter":
                _this.action().clearFilter(i);
                break;
            case "loadPDF":
                _this.action().loadPDF(i);
            break;
        }
    }
    action() {
        let _this = this;
        return {
            loadPDF(e) {
                var request = $.ajax({
                    url: `https://api.restpack.io/pdf/preview/convert?url=https://fsknw.ru/print.php?ID=${$(e).data(`id`)}&json=true&pdf_page=A4&emulate_media=print`,
                    method: "GET",
                    dataType: "html"
                });
                request.done(function( msg ) {
                    let data = JSON.parse(msg);
                    window.open(data.file, '_blank');
                });
                return false;
            },
            clearFilter(e) {
                let form = e.closest('form');
                let inputTxt = form.querySelectorAll(`input:not([type="hidden"]):not([type="checkbox"])`);
                let inputCheckbox = form.querySelectorAll(`input:checked[type="checkbox"]:not([type="hidden"])`);

                inputCheckbox.forEach(function(item, i, arr) {
                    item.checked = false;
                });

                inputTxt.forEach(function(item, i, arr) {
                    let uirange = item.closest(`.ui-range`);
                    let name = item.getAttribute(`name`);
                    if(uirange) {
                        let uislider = uirange.querySelectorAll(`.ui-slider`)[0];
                        let value = false;
                        if(name.indexOf(`>=`) != -1) {
                            value = uislider.getAttribute(`data-min`);
                        } else if (name.indexOf(`<=`) != -1) {
                            value = uislider.getAttribute(`data-max`);
                        }
                        $(item).val(value);
                        $(item).trigger(`change`);
                    } else {
                        console.log("не изветсное значение");
                    }
                });
            },
            buildRedirect(e){
                let href = e.getAttribute('data-href');
                localStorage.setItem('buildQuery', JSON.stringify(_this.dataObject.lastQuery.build));
                window.location = href;
            },
            sortApartmentFun(e) {

                $('.sort--active').removeClass('sort--active');
                $(e).addClass('sort--active');
                $(e).removeClass('sort--flip');

                let field = $(e).data(`field`);
                if( _this.dataObject.sort.field == field ) {
                    if(_this.dataObject.sort.nav == "ASC") {
                        _this.dataObject.sort.nav = "DESC";
                        $(e).removeClass('sort--flip');
                    } else {
                        _this.dataObject.sort.nav = "ASC";
                        $(e).addClass('sort--flip');
                    }
                } else {
                    _this.dataObject.sort.field = field;
                    $(e).addClass('sort--flip');
                    _this.dataObject.sort.nav = "ASC";
                }



                _this.setData().printApartmentLine({
                    'arResultCart' : _this.dataObject.currentElement,
                    'cartStaticInfo' : _this.dataObject.cartStaticInfo
                });
            },
            setImgPopupBlock(plan,index, mini, first = false){

                let poppupForm = $(`#card-example`);
                let planBlockNew = $(poppupForm).find(`.card__col-2 .card__img`).eq(index);
                if(index == -1) {
                    $(poppupForm).find(`.card__tabs .js-tab`).css('width','360px');
                    $(poppupForm).find(`.card__tabs .js-tab`).eq(index).hide();
                    planBlockNew.hide();
                    //return false;
                } else {
                    if(!mini) {
                        planBlockNew.find(`.img-empty`).show();
                        plan = `/local/templates/fsk/img/svg-logo-gray.svg`;
                        planBlockNew.find(`.img`).hide();
                        planBlockNew.append('<div class="img img-empty"></div>');
                    } else {
                        planBlockNew.find(`.img`).show();
                        if(first == false) {
                            planBlockNew.find(`.img`).attr('src', mini);
                        }
                        planBlockNew.find(`.img`).attr('data-src', mini);
                        planBlockNew.find(`.img-empty`).hide();
                        planBlockNew.find(`button.zoom-link`).attr('href', plan);
                    }
                }


            }
        }
    }
    setData() {
        let _this = this;
        return {
            filterData(e) {

                let parent = e.closest(`.filter-field`);
                let field =  parent.getAttribute(`data-name`);

                var $_inp = $(e).closest('.ui-quantity').find('input');
                var $_step = +$(e).closest('.ui-quantity').data('step');
                var oldValue = parseInt( $(e).closest('.ui-quantity').find('input').val().replace(/\s/g, '') );
                if( $(e).hasClass('ui-quantity__minus') ) {
                    if(oldValue == $_step){
                        return false
                    } else {
                        var $_val = oldValue - $_step;
                    }

                } else {
                    var $_val = oldValue + $_step;
                }
                let value = $_val;

                $_val = ("" + $_val).replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');

                if( $_inp.hasClass('years') ) {

                    if (value > 30 || value < 1) {
                        if(value > 30) {
                            $_inp.val( 30 ); //+ " лет"
                        } else if (value < 1) {
                            $_inp.val( 1 ); // + " лет"
                        }
                        return false;
                    }
                    $_inp.val( $_val );// + " лет"
                } else {
                    $_inp.val($_val);
                }

                _this.dataObject.mortgage.option[field] = value;

                if(_this.dataObject.mortgage.option['credit'] <= _this.dataObject.mortgage.option['first']) {
                    $_val = ("" + oldValue).replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
                    _this.dataObject.mortgage.option[field] = oldValue;
                    $_inp.val($_val);
                    return false;
                }


                let str = ``;

                str += _this.templates().outMortgageHead();

                let items = _this.dataObject.mortgage.items;
                let stringOut = ``;
                let countItems = items.length;

                for( let index in _this.dataObject.mortgage.itemsShow ) {
                    let mortgage = _this.dataObject.mortgage.itemsShow[index];
                    str += _this.templates().outMortgage(mortgage, index);
                }

                $(`.ipo-table`).html(str);

                $_inp.trigger('propertychange');
                _this.initData().mortgagePopup();
                return false;
            },
            moreIpoteka(first = false) {
                let str = ``;
                if(first) {
                    str += _this.templates().outMortgageHead();
                }
                let items = _this.dataObject.mortgage.items;
                let stringOut = ``;
                let countItems = items.length;

                for( let i = 0; i < _this.dataObject.mortgage.navOption.step; i++ ) {

                    let index = _this.dataObject.mortgage.navOption.index;
                    let mortgage = items[index];

                    _this.dataObject.mortgage.itemsShow[index] = mortgage;
                    str += _this.templates().outMortgage(mortgage,index);
                    _this.dataObject.mortgage.navOption.index++;

                    if(countItems <= _this.dataObject.mortgage.navOption.index) {
                        $('.show-more-ipoteka').hide();
                        break;
                    }

                }

                if(first) {
                    //console.log(str, 'moreIpoteka', 'str');
                    $(`.ipo-table`).html(str);
                } else {
                    $(`.ipo-table`).append(str);
                }
                _this.initData().mortgagePopup();
            },
            printBuildLine(result, listEmpty) {
                let stringOut = ``;
                let stringOutTwo = ``;
				let countTypeApartment = 1;
                if(result) {
					countTypeApartment = 0;
                    let sections = result.section;
                    let items  = result.items;
                    let buildInfo = result.info;
                    let i =0;
                    for (let section of sections) {
                        let item = items[i];
						countTypeApartment += section.resultFilterApartment.length;
                        stringOut += _this.templates().outBuildLineOne(section,item);
                        stringOutTwo += _this.templates().outBuildLineTwo(section,item);
                        i++;

                    }
                } else {
                    $(`#p-6`).hide();
                    $(`[href="#p-6"]`).hide();
                    /*stringOut = `<div class="results-empty">По вашему запросу ничего не найдено.</div>`;
                    let sections = listEmpty.section;
                    let items  = listEmpty.items;
                    let i =0;
                    for (let section of sections) {
                        let item = items[i];
                        stringOut += _this.templates().outBuildLineOne(section, item);
                        stringOutTwo += _this.templates().outBuildLineTwo(section, item);
                        i++;
                    }*/
                }
				if(countTypeApartment == 0) {
					let temp = stringOutTwo;
					stringOutTwo = `<div class="results-empty" style="width: 100%;border: 1px dashed #E5E8E8;margin-bottom: 20px;">По вашему запросу ничего не найдено. Ознакомьтесь с доступными вариантами ниже.</div>`;
					stringOutTwo += temp;
				}
                if(_this.dataObject.firstOut.load || result === false) {
                    _this.dataObject.firstOut.load = false;

                    if(result !== false) _this.dataObject.firstOut.list = result;
                    if(_this.pathPage == `/newbuild/` || _this.pathPage == `/commercial/` || _this.pathPage == `/`) {
                        $(`.quarter-list.view-1`).html(stringOut);
                        $(`.quarter-list.view-2 .f-row`).html(``);
                    }
                    if(_this.pathPage == `/commercial/`) {
                        $(`.results.results--nofloors`).hide();
                        $(`.container.section-margin`).show();
                    }
                } else {

                    if(_this.pathPage == `/commercial/`) {
                        $(`.results.results--nofloors`).show();
                        $(`.quarter-list.view-1`).html(``);
                        $(`.container.section-margin`).hide();
                    } else {
                        $(`.quarter-list.view-1`).html(``);
                        $(`.quarter-list.view-2 .f-row`).html(stringOutTwo);
                    }
                }


            },
            printApartmentLine(result) {
                _this.dataObject.currentElement = Object.assign({}, result.arResultCart);
                _this.dataObject.cartStaticInfo = Object.assign({}, result.cartStaticInfo);
                let stringOut = ``;
                let first = false;
                for(let key in result.cartStaticInfo) {
                    let category = result.cartStaticInfo[key];
                    let minArea = Math.min.apply(null, category.area);
                    let maxArea = Math.max.apply(null, category.area);
                    let minPrice = _this.helper().XFormatPrice(Math.min.apply(null, category.price));
                    let maxPrice = _this.helper().XFormatPrice(Math.max.apply(null, category.price));
                    let floorFullName = _this.helper().getFloorNameFull(key);

                    if( _this.modeLoad == "flat" ) {

                        stringOut += `
						<div class="results__row results-screen__header">
                            <div>${floorFullName} от <span class="filter-data">${minArea} </span>до <span class="filter-data">${maxArea} </span>м<sup>2</sup></div>
                        `;
                            if(minPrice !== NaN && minPrice && minPrice != NaN && minPrice != "NaN"){
                                stringOut += `<div>от <span class="filter-data">${minPrice} р.</span></div>`;
                            }
                        stringOut += `</div>`;
                    } else {
                        $(`.results-cell-3`).hide();

                        stringOut += `
						<div class="results__row results-screen__header">
                            <div>${key}</div>
                        `;
                            if(minPrice !== NaN && minPrice && minPrice != NaN && minPrice != "NaN"){
                                stringOut += `<div>от <span class="filter-data">${minPrice} р.</span></div>`;
                            }
                        stringOut += `</div>`;
                    }

                    let nm = {  };
                    var indexInndeSort = 0;
                    const fSortCart = (a, b) => {
                        let z =  parseFloat(result.arResultCart[key][a].PROPERTIES[_this.dataObject.sort.field].VALUE);
                        let x =  parseFloat(result.arResultCart[key][b].PROPERTIES[_this.dataObject.sort.field].VALUE);
                        return _this.dataObject.sort.nav == "ASC" ? (z - x) : (x - z);
                    }
                    Object.keys(result.arResultCart[key]).sort(fSortCart).forEach(function (v) {
                        nm[indexInndeSort] = result.arResultCart[key][v];
                        indexInndeSort++;
                    });

                    result.arResultCart[key] = nm;

                    let countApartment = _this.helper().getFloorName(key);
                    for(let keyCart in result.arResultCart[key]) {
                        let cart = result.arResultCart[key][keyCart];
                        let maxFloor =  Math.max.apply(null, cart['PROPERTIES']['floor']['VALUE']);
                        let minFloor =  Math.min.apply(null, cart['PROPERTIES']['floor']['VALUE']);
                        let stringFloor = ((minFloor != maxFloor) && maxFloor) ? `${minFloor}...${maxFloor}` : minFloor;

                        if(first === false) {
                            first = document.createElement("div");
                            first.setAttribute(`data-count`, key);
                            first.setAttribute(`data-area`, cart['PROPERTIES']['area']['VALUE']);
                            first.setAttribute(`data-area-id`, keyCart);
                            first.setAttribute(`data-plan`, cart['PROPERTIES']['image_out_big']['VALUE']);
                        }

                        if(!cart['PROPERTIES']['image_out']['VALUE']) {
                            cart['PROPERTIES']['image_out']['VALUE'] = `/local/templates/fsk/img/svg-logo-gray.svg`;
                        }
                        if(!cart['PROPERTIES']['image_out_big']['VALUE']) {
                            cart['PROPERTIES']['image_out_big']['VALUE'] = `/local/templates/fsk/img/svg-logo-gray.svg`;
                        }

                        let price = _this.helper().XFormatPrice(cart['PROPERTIES']['price100']['VALUE']);
                                stringOut += `  <div class="results__row" data-area-id="${cart['PROPERTIES']['area_dop']['VALUE']}" data-event="updatePopup" data-count="${key}" data-area="${cart['PROPERTIES']['area']['VALUE']}"  data-id="${result.arResultCart[key][keyCart]['ID']}" data-plan="${cart['PROPERTIES']['image_out_big']['VALUE']}"> `;
                               if(cart['PROPERTIES']['image_out']['VALUE']){
                                   stringOut += ` <div class="results__cell results-cell-1 js-call-card" style="min-height: 60px;"><img class="img plan-thumb lazyload" data-src="${cart['PROPERTIES']['image_out']['VALUE']}" alt="alt"></div> `;
                               }else{
                                   stringOut +='<div class="results__cell results-cell-1 js-call-card" style="min-height: 60px;"><div class="img img-empty"></div></div>';
                               };


                                stringOut += `<div class="results__cell results-cell-2"><span>${cart['PROPERTIES']['area']['VALUE']} м<sup>2</sup></span></div>`;
                                if( _this.modeLoad == "flat" ) stringOut += `<div class="results__cell results-cell-3"><span>${stringFloor}</span></div>`;
                                stringOut += `<div class="results__cell results-cell-4"><span>${cart['PROPERTIES']['builtyear']['VALUE']}</span></div>`;
                                stringOut += `<div class="results__cell results-cell-5">`;

                                if(price !== NaN && price && price != NaN && price != "NaN"){
                                    stringOut += `<span>${price} р.</span>`
                                } else {
                                    stringOut += `<span class="dashed-underline">По запросу</span>`
                                }

                                stringOut +=`        
                                </div>
                                    <div class="results-cell-mob">
                                            <p class="data-1">${countApartment} - ${cart['PROPERTIES']['area']['VALUE']} м<sup>2</sup></p>
                                            ${price !== NaN && price && price != NaN && price != "NaN" ? `<p class="data-2"> <span>${price} </span>р.</p>` : `<p class="data-2"><span class="dashed-underline">По запросу</span></p>`}
                                        </div>
                                        <div class="results-cell-btns">
                                          <button class="interactive-btn interactive-follow" type="button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="svg ic-arrow inlined-svg" width="20" height="20" role="img" aria-labelledby="title"><title>Перейти</title><g transform="translate(0 20) rotate(-90)"><g transform="translate(20) rotate(90)" fill="none"><path d="M10,0A10,10,0,1,1,0,10,10,10,0,0,1,10,0Z" stroke="none"></path><path d="M 10.00000095367432 1.500001907348633 C 5.313080787658691 1.500001907348633 1.500001907348633 5.313080787658691 1.500001907348633 10.00000095367432 C 1.500001907348633 14.68692111968994 5.313080787658691 18.5 10.00000095367432 18.5 C 14.68692111968994 18.5 18.5 14.68692111968994 18.5 10.00000095367432 C 18.5 5.313080787658691 14.68692111968994 1.500001907348633 10.00000095367432 1.500001907348633 M 10.00000095367432 1.9073486328125e-06 C 15.52285099029541 1.9073486328125e-06 20 4.477150917053223 20 10.00000095367432 C 20 15.52285099029541 15.52285099029541 20 10.00000095367432 20 C 4.477150917053223 20 1.9073486328125e-06 15.52285099029541 1.9073486328125e-06 10.00000095367432 C 1.9073486328125e-06 4.477150917053223 4.477150917053223 1.9073486328125e-06 10.00000095367432 1.9073486328125e-06 Z" stroke="none"></path></g><g transform="translate(7.236 5.719)"><g transform="translate(5.504 5.4) rotate(90)"><g transform="translate(0 5.504) rotate(-90)"><path d="M0,0,2.752,2.752,5.5,0" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"></path></g></g><line y2="7.826" transform="translate(2.739)" fill="none" stroke-linecap="round" stroke-width="1.5"></line></g></g></svg></button>
                                        </div>
                                    </div>

                                `;
                    }
                }
                _this.setData().apartmentList(stringOut);
                //_this.setData().popupData(first);
            },
            apartmentList(html) {
                if( $('#results-screen').length ) {
                    $(`#results-screen .simplebar-content`).html(html);
                    _this.crollBar = _this.initData().crollBar(`results-screen`);

                    if( $(window).width() >= 1200 ) {
                        let first = $(`.simplebar-content .results__row:not(.results-screen__header):first`)[0];

                        let windowLocationHash = window.location.hash.split('#')[1],
                            hashFlat = $(`.simplebar-content  .results__row[data-id="${windowLocationHash}"]`);


                        if(windowLocationHash && hashFlat.length) {
                            first = hashFlat;
                        }

                        _this.setData().popupData(first , true);

                        $('.js-call-card').magnificPopup({
                            items: {
                                src: '#card-example',
                                type: 'inline'
                            },
                            callbacks: {
                                open: function() {
                                    $('body').addClass('mfp-card');
                                    setTimeout(() => {
                                        window.location.hash = $('#card-example').attr('hash');
                                    }, 500);
                                },
                                close: function() {
                                    $('body').removeClass('mfp-card');
                                    history.replaceState(null, null, ' ');
                                }
                            }
                        });

                        if(windowLocationHash && hashFlat.length) {
                            hashFlat.find('.js-call-card').trigger('click');
                        }

                    }


                }
            },
            popupData(i, first = false) {

                let count = $(i).data(`count`);
                let area  = $(i).data(`area-id`);

                let idFlat  = $(i).data(`id`);
                $('#card-example').attr('hash', idFlat);

                if(first) {
                    $('.results__img').find('.img').attr('src', $(i).data('plan'));
                }

                let element = _this.dataObject.currentElement[count][area];
                let prop = element['PROPERTIES'];
                let elementArea = prop['area'];
                let poppupForm = $(`#card-example`);
                let maxFloor =  Math.max.apply(null, prop['floor']['VALUE']);
                let minFloor =  Math.min.apply(null, prop['floor']['VALUE']);
                let stringFloor = ((minFloor != maxFloor) && maxFloor) ? `${minFloor}...${maxFloor}` : minFloor;

                document.querySelector('#callback input[name="FIELDS[OBJECT]"]').value = 'ID - '+_this.helper().XFormatPrice(element['CODE'])+', Название - '+element.NAME+'м.кв.';

                let plan = false;
                if(element['PROPERTIES']['image_out_big']['VALUE']) {
                    plan = element['PROPERTIES']['image_out_big']['VALUE'];
                }
                let planBlock = $(poppupForm).find(`.card__col-2 .card__img`).eq(0);
                try {
                    if(element['PROPERTIES']['image_out_new']['VALUE'] == undefined) element['PROPERTIES']['image_out_new']['VALUE'] = {};
                    if(element['PROPERTIES']['image_out_new']['VALUE'].plan == undefined) element['PROPERTIES']['image_out_new']['VALUE'].plan = {};
                        _this.action().setImgPopupBlock(plan, 0, element['PROPERTIES']['image_out_new']['VALUE']['plan'], first);
                }catch (e) {
                    console.log(e);
                }

                if(element['PROPERTIES']['image_out_big_new'] != undefined) {
                	_this.action().setImgPopupBlock(element['PROPERTIES']['image_out_big_new']['floor_plan'],1,element['PROPERTIES']['image_out_new']['VALUE']['floor_plan'], first);
                    _this.action().setImgPopupBlock(element['PROPERTIES']['image_out_big_new']['section'],2,element['PROPERTIES']['image_out_new']['VALUE']['section'], first);
                    _this.action().setImgPopupBlock(element['PROPERTIES']['image_out_big_new']['decoration'],3,element['PROPERTIES']['image_out_new']['VALUE']['decoration'], first);
                }
                if ( element.PROPERTIES.UF_STATUS.VALUE==='Забронирована'){//изменение кнопки если зарезервирована
                    var btns = document.querySelectorAll('[data-type="reserveBtn"]');
                    for (i = 0; i < btns.length; ++i) {
                        btns[i].style.display = "none";
                    }
                    var reserve = document.querySelectorAll('[data-type="reserved"]');
                    for (i = 0; i < reserve.length; ++i) {
                        reserve[i].style.display = "inline-flex";
                    }
                }else{
                    var btns = document.querySelectorAll('[data-type="reserveBtn"]');
                    for (i = 0; i < btns.length; ++i) {
                        btns[i].style.display = "inline-flex";
                    }
                    var reserve = document.querySelectorAll('[data-type="reserved"]');
                    for (i = 0; i < reserve.length; ++i) {
                        reserve[i].style.display = "none";
                    }
                }
               // console.log(element.PROPERTIES.UF_STATUS.VALUE);
                var reserve = document.querySelectorAll('[data-type="reserveBtn"]');
                for (i = 0; i < reserve.length; ++i) {
                    reserve[i].dataset.id =element.ID;
                }
                //poppupForm.find('[data-type="reserveBtn"]').attr('data-id',element.ID);

                poppupForm.find('[data-event="loadPDF"]').attr('data-id',element.ID);
                poppupForm.find('[data-role="favorite"]').attr('data-id',element.ID);
                let cardInfo = $(poppupForm).find(`.card__info .card-data`);
                if(document.querySelector(`[href="#p-6"]`) && document.querySelector(`[href="#p-6"]`).innerText == "Апартаменты") {
                    $(cardInfo).find(`.card-data__title`).html(`Лот ${element.NAME.split(' ').pop()} м<sup>2</sup>`);
                }else{
                    $(cardInfo).find(`.card-data__title`).html(`${element.NAME} м<sup>2</sup>`);
                }


                let listParam = $(cardInfo).find(`.card-data__list li`);
                $(listParam).eq(0).find(`span`).eq(1).html(`${prop['area']['VALUE']} м<sup>2</sup>`);

                /*if(prop['livingspace']['VALUE']) {
                    $(listParam).eq(1).find(`span`).eq(1).html(`${prop['livingspace']['VALUE']} м<sup>2</sup>`);
                    $(listParam).eq(1).show();
                } else {*/
                    $(listParam).eq(1).hide();
                //}

                if(prop['kitchenspace']['VALUE'] && (document.location.href.indexOf('moskov')=='-1')){
                    $(listParam).eq(2).find(`span`).eq(1).html(`${prop['kitchenspace']['VALUE']} м<sup>2</sup>`);
                    $(listParam).eq(2).show();
                } else {
                    $(listParam).eq(2).hide();
                }

                $(listParam).eq(3).find(`span`).eq(1).html(`${stringFloor}/${prop['floorstotal']['VALUE']}`);
                $(listParam).eq(4).hide();
                $(listParam).eq(5).hide();

                if(prop['buildingsection']['VALUE']){
                    $(listParam).eq(4).find(`span`).eq(1).html(`${prop['buildingsection']['VALUE']}`);
                    $(listParam).eq(4).show();
                } else {
                    $(listParam).eq(4).hide();
                }
                if(prop['section']['VALUE']){
                    $(listParam).eq(5).find(`span`).eq(1).html(`${prop['section']['VALUE']}`);
                    $(listParam).eq(5).show();
                } else {
                    $(listParam).eq(5).hide();
                }

                //$(listParam).eq(4).remove();
                //$(listParam).eq(5).remove();
                if(prop['renovation']['VALUE']) { $(listParam).eq(6).find(`span`).eq(1).html(`${prop['renovation']['VALUE']}`); } else { $(listParam).eq(6).hide(); }
                if(prop['buildingphase']['VALUE']) { $(listParam).eq(7).find(`span`).eq(1).html(`${prop['buildingphase']['VALUE']}`); } else { $(listParam).eq(7).hide(); }
                if(prop['electriccapacity']['VALUE']) { $(listParam).eq(8).find(`span`).eq(1).html(`${prop['electriccapacity']['VALUE']} кВт`); } else { $(listParam).eq(8).hide(); }
                if(prop['watersupply']['VALUE']) { $(listParam).eq(9).find(`span`).eq(1).html(`Есть`); } else { $(listParam).eq(9).hide(); }
                if(prop['commercialtype']['VALUE']) { $(listParam).eq(10).find(`span`).eq(1).html(`${prop['commercialtype']['VALUE']}`); } else { $(listParam).eq(10).hide(); }

                $(`[data-role='favorite']`).attr('data-id',element.ID);
                $('[data-event="loadPDF"]').attr('data-id',element.ID);
                $(`.interactive-print`).attr('data-id',element.ID)

                let priceOld = _this.helper().XFormatPrice(prop['price']['VALUE']);
                let priceNew = _this.helper().XFormatPrice(prop['price100']['VALUE']);

                if(priceOld !== NaN && priceOld && priceOld != NaN && priceOld != "NaN"){
                    $(cardInfo).find(`.card-data__col-2 .card-price-2`).html(`Стандартная цена: <span>${priceOld}</span>`);
                } else {
                    $(cardInfo).find(`.card-data__col-2 .card-price-2`).html(`Стандартная цена: <span class="dashed-underline">по запросу</span>`);
                }
                if(priceNew !== NaN && priceNew && priceNew != NaN && priceNew != "NaN"){
                    $(cardInfo).find(`.card-data__col-2 .card-price-1`).html(`Цена по акции: <span>${priceNew}</span>`);
                } else {
                    $(cardInfo).find(`.card-data__col-2 .card-price-1`).html(`Цена по акции: <span class="dashed-underline">по запросу</span>`);
                }
                $(cardInfo).find(`.card-data__col-2 .card-id`).html(`ID объекта: <a href="/detail.php?ID=${element.ID}" style="color: var(--sub-text-color);">${_this.helper().XFormatPrice(element['CODE'])}</a>`);
                if(document.querySelector(`[href="#p-6"]`) && document.querySelector(`[href="#p-6"]`).innerText == "Апартаменты") {
                    $(poppupForm).find(`.card__title`).html(`Лот ${element.NAME.split(' ').pop()} м<sup>2</sup>`);
                }else{
                    $(poppupForm).find(`.card__title`).html(`${element.NAME} м<sup>2</sup>`);
                }


                if(document.querySelector(`[href="#p-6"]`) && document.querySelector(`[href="#p-6"]`).innerText == "Апартаменты") {
                    $(`#results-offer-square-text`).html(`Интересует лот ${element.NAME.split(' ').pop()} м<sup>2</sup>?`);
                }else{
                    $(`#results-offer-square-text`).html(`Интересует ${element.NAME} м<sup>2</sup>?`);
                }


                $.getJSON('/favourite/data.json', function(data) {
                    if(data != undefined && data != null) {
                        //console.log(data[element.ID]);
                        if(data[element.ID] != undefined ) {
                            $(`[data-role="favorite"][data-id="${element.ID}"]`).addClass(`active`);
                            return true;
                        }
                    }
                    $(`[data-role="favorite"][data-id="${element.ID}"]`).removeClass(`active`);
                    //$('.link-favourite, .mob-link-favourite').removeClass('active');
                    if($('.results-empty.favourite-empty').length){
                        $('.results-empty.favourite-empty').css('display', 'flex');
                    }

                    //$(`[data-role="favorite"][data-id="${element.ID}"]`).remove(`active`);
                    return false;
                });

            },
            printMortgageData(tr){
                let field = $(tr).closest('.filter__field').data('name');
                let value = parseInt($(tr).val());
                // console.log(value);
                _this.dataObject.mortgage.option[field] = value;


                let str = ``;

                str += _this.templates().outMortgageHead();
                let items = _this.dataObject.mortgage.items;
                let stringOut = ``;
                let countItems = items.length;
                for( let index in _this.dataObject.mortgage.itemsShow ) {
                    let mortgage = _this.dataObject.mortgage.itemsShow[index];
                    str += _this.templates().outMortgage(mortgage, index);
                }
                $('.ipo-table').html(str);
                _this.initData().mortgagePopup();
            }
        }
    }
    helper(){
        let _this = this;
        return {
            firstPriceMortgage (sum, rate, period) {
                let i,koef,result;
                i = (rate / 12) / 100;
                koef = (i * (Math.pow(1 + i, period * 12))) / (Math.pow(1 + i, period * 12) - 1);
                result = sum * koef;
                return this.XFormatPrice(result.toFixed());
                /*
                stavka = stavka/100;
                let a = Math.pow(1+stavka,srok);
                return this.XFormatPrice(summa*stavka*a/(a-1));
                */
            },
            XFormatPrice(_number) {
                var decimal=0;
                var separator=' ';
                var decpoint = '.';
                var format_string = '#';

                var r = parseFloat(_number)

                var exp10=Math.pow(10,decimal);// приводим к правильному множителю
                r=Math.round(r*exp10)/exp10;// округляем до необходимого числа знаков после запятой

                let rr = Number(r).toFixed(decimal).toString().split('.');

                let b=rr[0].replace(/(\d{1,3}(?=(\d{3})+(?:\.\d|\b)))/g,"\$1"+separator);

                r=(rr[1]?b+ decpoint +rr[1]:b);
                return format_string.replace('#', r);
            },
            getFloorName($count) {
                if(document.querySelector(`[href="#p-6"]`) && document.querySelector(`[href="#p-6"]`).innerText == "Апартаменты") {
                    return "Лот";
                } else {
                    switch ($count) {
                        case "0":
                            return "Студия";
                            break;
                        case "1":
                            return "1-к квартира";
                            break;
                        case "2":
                            return "2-к квартира";
                            break;
                        case "3":
                            return "3-к квартира";
                            break;
                        case "4":
                            return "4-к квартира";
                            break;
                        case "5":
                            return "5-к квартира";
                            break;
                    }
                }
            },
            getFloorNameFull ($count) {
                if(document.querySelector(`[href="#p-6"]`) && document.querySelector(`[href="#p-6"]`).innerText == "Апартаменты") {
                    return "Апартаменты";
                } else {
                    switch ($count) {
                        case "0": return "Квартиры студии"; break;
                        case "1": return "Однокомнатные квартиры";    break;
                        case "2": return "Двухкомнатные квартиры";    break;
                        case "3": return "Трехкомнатные квартиры";    break;
                        case "4": return "Четырехкомнатные квартиры"; break;
                        case "5": return "Пятикомнатные квартиры";    break;
                    }
                }

            },
            colorIntensive(hex) {
                let rgb = _this.helper().hexToRgb(hex);
                if(hex && rgb !== null) {
                    let intensive = (0.2126 * rgb.r + 0.7152 * rgb.g + 0.0722 * rgb.b);
                    return intensive;
                } else {
                    return false;
                }

            },
            componentToHex(c) {
                let hex = c.toString(16);
                return hex.length == 1 ? "0" + hex : hex;
            },
            rgbToHex(r, g, b) {
                return "#" + componentToHex(r) + componentToHex(g) + componentToHex(b);
            },
            hexToRgb(hex) {
                let result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
                return result ? {
                    r: parseInt(result[1], 16),
                    g: parseInt(result[2], 16),
                    b: parseInt(result[3], 16)
                } : null;
            },
            decodeHtmlEntity(str){
                return str.replace(/&#(\d+);/g, function(match, dec) {
                    return String.fromCharCode(dec);
                });
            },
            encodeHtmlEntity(str){
                var buf = [];
                for (var i=str.length-1;i>=0;i--) {
                    buf.unshift(['&#', str[i].charCodeAt(), ';'].join(''));
                }
                return buf.join('');
            },
        }
    }
    poppup(){
        let _this = this;
        return {
            show(block) {
                $(block).show();
            },
            hide(block) {
                $(block).hide();
            }
        }
    }
    getDataAjax(data = {}, act = "", callbackFun) {
        return new Promise((resolve, reject) => {
            // console.log(act)
            let request = $.ajax({
                context: this,
                url: `/ajax/?act=${act}`,
                type: "POST",
                cache: false,
                async: true,
                dataType: "json",
                data: data,
            });
            request.done((response) => {
                resolve(response);
            });
            request.fail(( jqXHR, textStatus ) => {
                reject();
                console.log( "Request failed: " + textStatus );
            });
        })
    }
    validation() {
        let _this = this;
        return {
            checkEmpty(v) {
                return (typeof v === "undefined" || v === null || v ===  "");
            },
        }
    }
    templates () {
        let _this = this;
        return {
            outMortgageHead() {
                return `
                     <div class="ipo-table__row ipo-table__header">
                        <div class="ipo-bank">Банк</div>
                        <div class="ipo-info">
                            <div class="ipo-info__col">
                                <span class="hide-on-mob">Ежемес. </span>платёж, от
                            </div>
                            <div class="ipo-info__col">Срок</div>
                            <div class="ipo-info__col">Ставка, от</div>
                        </div>
                    </div>
                `;
            },
            outMortgage(mortgage, index) {
                let stringOut = ``;
                let first = _this.dataObject.mortgage.option.first;
                let credit = _this.dataObject.mortgage.option.credit - first;
                let age = _this.dataObject.mortgage.option.age;
                if(mortgage === undefined) return "";
                if(mortgage['PROPERTIES'] === undefined) return "";
                stringOut += `
                <div class="ipo-table__row ipo-table__item" data-id = "${index}">
                    <div class="ipo-bank">
                        <img class="img lazyload" data-src="${mortgage['PROPERTIES']['UF_IMAGE']['VALUE']}" title="${mortgage['~NAME']}" alt="${mortgage['~NAME']}">
                    </div>
                    <div class="ipo-licence">
                        <div>${mortgage['~NAME']}</div>
                        <span class="sub-text">Лицензия № ${mortgage['PROPERTIES']['UF_NUMBER']['VALUE']} от ${mortgage['PROPERTIES']['UF_DATE']['VALUE']}</span>
                    </div>
                    <div class="ipo-info">
                        <div class="ipo-info__col" data-title="Ежемес. платёж, от">${_this.helper().firstPriceMortgage(credit, mortgage['PROPERTIES']['UF_VALUE']['VALUE'], age)} р.</div>
                        <div class="ipo-info__col" data-title="Срок">до ${mortgage['PROPERTIES']['UF_STAV']['VALUE']} лет</div>
                        <div class="ipo-info__col" data-title="Ставка">${mortgage['PROPERTIES']['UF_VALUE']['VALUE']}%</div>
                    </div>
                </div>
                `;
                return stringOut;
            },
            outBuildLineOne (section,item) {
                // console.log(section)
                let stringOut = ``;
                stringOut += `<div class="quarter">`;
                if (section['UF_PHOTO'] === null || section['UF_PHOTO']===''){}else{
                    section['PICTURE'] = section['UF_PHOTO'];
                }
                    if( section['PICTURE'] === null ) {
                        stringOut += `
                        <a href="${item['url']}"  class="quarter__img-wrap quarter-link">
                            <div class="img img-empty"></div>
                        </a>
                        `;
                    } else {
                        stringOut += `<a href="${item['url']}" class="quarter__img-wrap quarter-link"><img class="quarter__img lazyload" data-src="${section['PICTURE']}" alt="alt">`;
                            if(section['INFO']['PROPERTY']['UF_MAIN_ICON']['VALUE']) {
                                stringOut += `
                                <div class="quarter__overlay">
                                    <img class="img lazyload" data-src="${section['INFO']['PROPERTY']['UF_MAIN_ICON']['VALUE']}" width="277" height="70" alt="alt">
                                </div>
                                `;
                            }
                        stringOut += `</a>`;
                    }

                    stringOut += `<div class="quarter__content">`;
                            stringOut += `<a href="${item['url']}" class="quarter__title">${section['NAME']}</a>`;
                            stringOut += `<div class="quarter__transport flex">`;
                                if(section['INFO']['metro']) {
                                    for (let metro of section['INFO']['metro']) {
                                        stringOut += `
                                        <div class="p-metro flex">
                                            <div class="p-metro__branch" style="border-color: ${metro['UF_COLOR']};"></div>
                                            <span>${metro['UF_NAME']}</span>
                                        </div>
                                        `;
                                    }
                                }
                                if(section['INFO']['PROPERTY']['UF_WALK_TIME']['VALUE']) {
                                    stringOut += `
                                    <div class="p-distance flex">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 13.201" class="svg inlined-svg" width="8" height="13" role="img" aria-labelledby="title"><title>alt</title>
                                          <path id="Walking_Copy_3" data-name="Walking Copy 3" d="M6.436,13.2a.752.752,0,0,1-.64-.356L3.691,9.583l-.26-.4L2.51,7.753a.949.949,0,0,1-.146-.779l.041-.2.487-2.326a2.978,2.978,0,0,0-1.1.92,3.663,3.663,0,0,0-.281,1.9.53.53,0,1,1-1.059,0A4.54,4.54,0,0,1,.888,4.825a4.127,4.127,0,0,1,1.683-1.41A2.969,2.969,0,0,1,3.9,3.1h.356a.861.861,0,0,1,.665.332.833.833,0,0,1,.162.716L4.687,5.783,4.5,6.571,4.241,7.646l2.826,4.38a.756.756,0,0,1-.6,1.174Zm-5.679,0a.756.756,0,0,1-.565-1.26l1.495-1.727.471-2.249,1.159,1.8-.184.941a.757.757,0,0,1-.17.35L1.335,12.93A.754.754,0,0,1,.757,13.2ZM7.47,7.25a.51.51,0,0,1-.128-.015,4.528,4.528,0,0,1-2.281-.989l-.049-.05.344-1.436a2.119,2.119,0,0,0,.447.73A3.8,3.8,0,0,0,7.584,6.2.529.529,0,0,1,7.47,7.25ZM4.678,2.7A1.349,1.349,0,1,1,6.034,1.349,1.35,1.35,0,0,1,4.678,2.7Z" transform="translate(0)" fill="#fff"></path>
                                        </svg>
                                        <span>${section['INFO']['PROPERTY']['UF_WALK_TIME']['VALUE']}</span>
                                    </div>
                                    `;
                                }
                                if(section['INFO']['PROPERTY']['UF_TRANSPORT_TIME']['VALUE']) {
                                    stringOut += `
                                    <div class="p-distance flex">
                                        <img class="svg lazyload" data-src="/local/templates/fsk/img/icons/ic-transport-dist.svg" width="15" height="16" alt="alt">
                                        <span>${section['INFO']['PROPERTY']['UF_TRANSPORT_TIME']['VALUE']}</span>
                                    </div>
                                    `;
                                }
                            stringOut += `</div>`;

                            if(section['DESCRIPTION']) {
                                stringOut += `<div class="quarter__info my-readmore"><p>${section['DESCRIPTION']}</p></div>`;
                            }

                            if (section['INFO']['PROPERTY']['UF_DISCOUNT_TEXT']['VALUE'] && _this.modeLoad != "commercial") {
                                stringOut += `
                                <div class="p-discount flex">
                                    <div class="p-discount__ic">%</div>
                                    <p class="p-discount__txt">${section['INFO']['PROPERTY']['UF_DISCOUNT_TEXT']['VALUE']}</p>
                                </div>
                                `;
                            }
                            stringOut += `<div class="quarter__footer">`;
                            let nameStingEnd = '';
                            if(_this.modeLoad == "commercial") {
                                nameStingEnd = "Помещения";
                            } else if (item.apartment) {
                                nameStingEnd = "Апартаменты";
                            } else {
                                nameStingEnd = "Квартиры";
                            }
                            if(section['minPriceArray'][0]=== '0' && section['minPriceArray'][1]=== '0'){
                                stringOut += `
                                <div class="p-key p-key--blue">
                                    <div class="p-key__ic"> </div>
                                    <div class="p-key__txt">Все квартиры проданы</div>
                                </div>
                            `;
                            }else {
                                stringOut += `
                                <div class="p-key p-key--blue">
                                    <div class="p-key__ic"> </div>
                                    <div class="p-key__txt">${nameStingEnd} от <b>${section['minPriceArray'][0]},${section['minPriceArray'][1][0]} </b>млн/р.</div>
                                </div>
                            `;
                            }
                            if (section['INFO']['PROPERTY']['UF_KEYS_DATE']["VALUE"]) {
                                let css_class='';
                                if(section['INFO']['keys']['0']["UF_BACKGROUND"] == '#3399ff'){
                                    css_class = 'p-key--blue';
                                }else{
                                    css_class = 'p-key--green';
                                };
                                stringOut += `
                                <div class="p-key ${css_class}">
                                    <div class="p-key__ic" style="background-image: url(${section['INFO']['keys']['SRC']}); background-color: ${section['INFO']['keys']['0']["UF_BACKGROUND"]};"> </div>
                                    <div class="p-key__txt">${section['INFO']['keys']['0']["UF_NAME"]}</div>
                                </div>
                                `;
                            }
                            stringOut += `
                            <a class="btn btn--bg" href="${item['url']}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="svg btn__ic ic-arrow inlined-svg" width="20" height="20" role="img" aria-labelledby="title"><title>link</title><g transform="translate(0 20) rotate(-90)"><g transform="translate(20) rotate(90)" fill="none"><path d="M10,0A10,10,0,1,1,0,10,10,10,0,0,1,10,0Z" stroke="none"></path><path d="M 10.00000095367432 1.500001907348633 C 5.313080787658691 1.500001907348633 1.500001907348633 5.313080787658691 1.500001907348633 10.00000095367432 C 1.500001907348633 14.68692111968994 5.313080787658691 18.5 10.00000095367432 18.5 C 14.68692111968994 18.5 18.5 14.68692111968994 18.5 10.00000095367432 C 18.5 5.313080787658691 14.68692111968994 1.500001907348633 10.00000095367432 1.500001907348633 M 10.00000095367432 1.9073486328125e-06 C 15.52285099029541 1.9073486328125e-06 20 4.477150917053223 20 10.00000095367432 C 20 15.52285099029541 15.52285099029541 20 10.00000095367432 20 C 4.477150917053223 20 1.9073486328125e-06 15.52285099029541 1.9073486328125e-06 10.00000095367432 C 1.9073486328125e-06 4.477150917053223 4.477150917053223 1.9073486328125e-06 10.00000095367432 1.9073486328125e-06 Z" stroke="none"></path></g><g transform="translate(7.236 5.719)"><g transform="translate(5.504 5.4) rotate(90)"><g transform="translate(0 5.504) rotate(-90)"><path d="M0,0,2.752,2.752,5.5,0" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"></path></g></g><line y2="7.826" transform="translate(2.739)" fill="none" stroke-linecap="round" stroke-width="1.5"></line></g></g></svg>
                                Подробнее
                            </a>
                            `;
                        stringOut += `</div>`;
                    stringOut += `</div>`;
                stringOut += `</div>`;
                return stringOut;
            },
            outBuildLineTwo (section,item) {
                console.log(section['']);
                if(section['resultBuildPrice'] == null) return '';
                let stringOut = ``;
                stringOut += `<div class="cols col-1-2">`;
                stringOut += `<div class="quarter">`;
                stringOut += `<a href="${item['url']}" class="quarter__img-wrap quarter-link">`;
                if (section['UF_PHOTO'] === null || section['UF_PHOTO']===''){}else{
                    section['PICTURE'] = section['UF_PHOTO'];
                }
                if( section['PICTURE'] === null ) {
                    stringOut += `<div class="img img-empty"></div>`;
                } else {
                    stringOut += `<img class="quarter__img lazyload" data-src="${section['PICTURE']}" alt="alt">`;
                    if(section['INFO']['PROPERTY']['UF_MAIN_ICON']['VALUE']) {
                        stringOut += ` <div class="quarter__overlay"> <img class="img lazyload" data-src="${section['INFO']['PROPERTY']['UF_MAIN_ICON']['VALUE']}" width="277" height="70" alt="alt"></div>`;
                    }
                }
                stringOut += `</a>`;

                stringOut += `<div class="quarter__content">`;
                stringOut += `<a href="${item['url']}" class="quarter__title">${section['NAME']}</a>`;

                stringOut += `<div class="quarter__transport flex">`;
                if(section['INFO']['metro']) {
                    stringOut += `<div class="p-metro flex">`;
                    for (let metro of section['INFO']['metro']) {
                        stringOut += `<div class="p-metro__branch" style="border-color: ${metro['UF_COLOR']};"></div><span>${metro['UF_NAME']}</span>`;
                    }
                    stringOut += `</div>`;
                }
                stringOut += `</div>`;

                let rBP = section['resultBuildPrice'];
                let rFA = section['resultFilterApartment'];
                let massBuildInfo = false;
                stringOut += `<div class="quarter__info quater__links">`;

                if(item.apartment) {
                    stringOut += `<p><a class="${rBP[1] ? "" : "sub-link none-event"}${rFA[1] ? " accent-link" : ""}" data-event="buildRedirect" data-href='${item['url']}' href="javascript:void(0)">Апартаменты - ${rBP[1] ? `от ${Math.min.apply(null,rBP[1])} млн /р.` : `нет в продаже`}</a></p>`
                } else {
                    stringOut += ` <p><a class="${rBP[0] ? "" : "sub-link none-event"}${rFA[0] ? " accent-link" : ""}" data-href='${item['url']}' href="javascript:void(0)" data-event="buildRedirect" > Студии -  ${rBP[0] ? `от ${Math.min.apply(null,rBP[0])} млн /р.` : `нет в продаже`} </a></p>`;
                    stringOut += `
                      <p><a class="${rBP[1] ? "" : "sub-link none-event"}${rFA[1] ? " accent-link" : ""}" data-event="buildRedirect" data-href='${item['url']}' href="javascript:void(0)">1 ккв - ${rBP[1] ? `от ${Math.min.apply(null,rBP[1])} млн /р.` : `нет в продаже`}</a></p>
                      <p><a class="${rBP[2] ? "" : "sub-link none-event"}${rFA[2] ? " accent-link" : ""}" data-event="buildRedirect" data-href='${item['url']}' href="javascript:void(0)">2 ккв - ${rBP[2] ? `от ${Math.min.apply(null,rBP[2])} млн /р.` : `нет в продаже`}</a></p>
                      <p><a class="${rBP[3] ? "" : "sub-link none-event"}${rFA[3] ? " accent-link" : ""}" data-event="buildRedirect" data-href='${item['url']}' href="javascript:void(0)">3 ккв - ${rBP[3] ? `от ${Math.min.apply(null,rBP[3])} млн /р.` : `нет в продаже`}</a></p>
                      <p><a class="${rBP[4] ? "" : "sub-link none-event"}${rFA[4] ? " accent-link" : ""}" data-event="buildRedirect" data-href='${item['url']}' href="javascript:void(0)">4 ккв - ${rBP[4] ? `от ${Math.min.apply(null,rBP[4])} млн /р.` : `нет в продаже`}</a></p>
                    `;
                }

                stringOut += `</div>`;
                //<!--p><a class="${rBP[5] ? "" : "sub-link none-event"}${rFA[5] ? " accent-link" : ""}" data-event="buildRedirect" data-href='${item['url']}' href="javascript:void(0)">5 ккв - ${rBP[5] ? `от ${Math.min.apply(null,rBP[5])} млн /р.` : `нет в продаже`}</a></p-->

                if(section['INFO']['PROPERTY']['UF_DISCOUNT_TEXT']['VALUE']) {
                    stringOut += `
                        <div class="p-discount flex">
                                <div class="p-discount__ic">%</div>
                                <p class="p-discount__txt">${section['INFO']['PROPERTY']['UF_DISCOUNT_TEXT']['VALUE']}</p>
                        </div>
                    `;
                }
                if (section['INFO']['PROPERTY']['UF_KEYS_DATE']["VALUE"]) {

                    let css_class='';
                    if(section['INFO']['keys']['0']["UF_BACKGROUND"] == '#3399ff'){
                        css_class = 'p-key--blue';
                    }else{
                        css_class = 'p-key--green';
                    };
                    stringOut += `<div class="p-discount flex ">
                            <div class="p-key ${css_class}">
                                 <div class="p-key__ic" style="background-image: url(${section['INFO']['keys']['SRC']}); background-color: ${section['INFO']['keys']['0']["UF_BACKGROUND"]};"> </div>
                                <div class="p-key__txt">${section['INFO']['keys'][0]["UF_NAME"]}</div>
                            </div>
                            </div>
                        `;
                }
                stringOut += `</div>`;
                stringOut += `</div>`;
                stringOut += `</div>`;
                return stringOut;
            }
        }
    }
}
try {
    window.controller = new ApartmentControll();
    window.controller.initData().event();
    $('.results-geo__result').hide();
} catch (e) {
    console.log(e);
}
