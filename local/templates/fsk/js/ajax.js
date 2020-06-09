$(function() {
    // when select changes
    $(document).on('click','.ui-select__option', function () {
        if ($(this).data('type') === 'month') {
            // create data from form input(s)
            var date = $(this).data('value');
            var year = $(this).data('year');
            // send data to your endpoint
            $.ajax({
                method: "POST",
                url: '/local/templates/fsk/components/bitrix/catalog/estate/datefilter.php',
                data: {
                    date: date,
                    year: year,
                    sectionId: localStorage.getItem('sectionId'),
                    AJAX__: "Y",
                },
                dataType: "text",
            }).done(function( result ) {
                $(document).find('[data-entity="container-1"]').html(result);
                window.controller.initData().buildStep();
            });
            $.ajax({
                method: "POST",
                url: '/local/templates/fsk/components/bitrix/catalog/estate/datefilter.php',
                data: {
                    date: date,
                    year: year,
                    sectionId: localStorage.getItem('sectionId'),
                    AJAX__: "Y",
                    getVideo: "Y",
                },
                dataType: "text",
            }).done(function( result ) {
                var element = $(document).find('.gallery-btns.project-build__top .gallery-newbuild');
                element.attr('data-src', result);
                if(result) {
                    element.show();
                } else {
                    element.hide();
                }
                //$(document).find('[data-entity="container-1"]').html(result);
            });
        } else {
            return false;
        }

    });
});

$(function(){ // фильтрация на стороне клиента, со стороны сервера есть полный массив месяцев + лет хода строительства
    $(".ui-select__option[data-type='month']").each(function(index) {
        if ($(this).data('year') === parseInt($("#yearSelection").attr('data-placeholder'))) {
            if (index === 0) {
                $(this).first().addClass("active");
            } else {
                $(this).first().removeClass("active");
            }
            $(this).show()
        } else {
            $(this).hide()
        }
    });

    $(document).on('click','.ui-select__option', function () {
        if ($(this).data('type') === 'year') {
            var year = $(this).data('value');
            var first = true;
            $(".ui-select__option").each(function() {
                if ($(this).data('type') === 'month') {
                    if ($(this).data('year') === year) {
                        if (first) {
                            first = false;
                            $(this).addClass("active");
                        } else {
                            $(this).removeClass("active");
                        }
                        first = false;
                        $(this).show()
                    } else {
                        $(this).removeClass("active");
                        $(this).hide()
                    }
                }
            });
            $('[data-type="month"].active').trigger('click');
            /*var element = $(document).find('.gallery-btns.project-build__top .gallery-newbuild');
            element.attr('data-src', result);
            if(result) {
                element.show();
            } else {
                element.hide();
            }*/
        }
    })
});

$(function() { // показать еще
    /*
    if ($('.ipo-table')) {

        var showCounter = 5; // количество уже показанных слайдов
        var length = $('.ipo-table__item').length - 1;

        if (showCounter < length) {
            $('.ipo-more').show();

            for (var i = length; i > 4; i--) {
                $('.ipo-table__item:eq('+i+')').hide();
            }
        } else {
            $('.ipo-more').hide();
        }

        $('.ipo-more').click(function (e) {
            e.preventDefault();
            var offset = 0;

            console.log(showCounter)
            console.log(length)
            if (showCounter <= length) {
                $('.ipo-more').show();
                for (var i = showCounter; i <= (showCounter+4); i++) {
                    $('.ipo-table__item:eq('+i+')').show();
                    console.log(i)
                    offset++;
                }
                showCounter = showCounter + offset;
                if (showCounter > length) {$('.ipo-more').hide();}
            } else {
                $('.ipo-more').hide();
            }
        })
    }
    */
    /*hideBlocks();

    function hideBlocks() {
        var counterBlock = $(document).find('.subsidies-show-more__open');
        var counterHideBlock = $(document).find('.subsidies-show-more__close');
        var programs = $(document).find('.subsidies-bank-programs-row:not(.title)');
        var numberOfPrograms = programs.length - 1;

        counterHideBlock.hide();
        counterBlock.css('display', 'block').hide().show();

        if (numberOfPrograms >= 5) {

            counter.html(numberOfPrograms - 4);

            var i = 0;

            for (i; i < numberOfPrograms + 1; i++) {
                if (i >= 5) programs.eq(i).hide();
            }

        } else {
            counterBlock.hide();
        }
    };

    function showBlocks() {

        var counterBlock = $(document).find('.subsidies-show-more__open');
        var counterHideBlock = $(document).find('.subsidies-show-more__close');
        var programs = $(document).find('.subsidies-bank-programs-row:not(.title)');

        counterBlock.hide();
        counterHideBlock.css('display', 'flex').hide().show();

        var i = 1;

        for (i; i < programs.length; i++) {
            programs.eq(i).show();
        }
    };*/
})
