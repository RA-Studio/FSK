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
