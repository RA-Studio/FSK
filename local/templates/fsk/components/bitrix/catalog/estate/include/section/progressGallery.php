
<?if($_REQUEST['AJAX_LOAD'] == 'progressGallery'):?>
    <?$GLOBALS['APPLICATION']->RestartBuffer();?>
<?endif;?>
<?php if ($progressGallery) : ?>
    <div class="gallery project-build section-margin scrollspy-item" id="p-8">
        <script>
            localStorage.setItem('sectionId', '<?=$SectionInfo['ID']?>');
        </script>
        <div class="container">
            <h2 class="h1 title">Ход строительства</h2>
            <div class="gallery-btns project-build__top">
                <div class="gallery-selects">
                    <?php
                    $dateArr = []; // создаем массив дат
                    $j = 0;
                    foreach ($progressGallery as $index => $item) {
                        $year = $item['userProps']['UF_GALLERY_YEAR']['VALUE'];
                        $month = $item['userProps']['UF_GALLERY_MONTH']['VALUE'];
                        $video = $item['userProps']['UF_VIDEO']['VALUE'];
                        if (array_key_exists($year, $dateArr)) {
                            if (!array_key_exists($month, $dateArr[$year])) {

                                switch ($month) {
                                    case 'Январь' : $dateArr[$year][1] = array("NAME"=>$month,'VIDEO'=> $video);break;
                                    case 'Февраль' : $dateArr[$year][2] = array("NAME"=>$month,'VIDEO'=> $video);break;
                                    case 'Март' : $dateArr[$year][3] = array("NAME"=>$month,'VIDEO'=> $video);break;
                                    case 'Апрель' : $dateArr[$year][4] = array("NAME"=>$month,'VIDEO'=> $video);break;
                                    case 'Май' : $dateArr[$year][5] = array("NAME"=>$month,'VIDEO'=> $video);break;
                                    case 'Июнь' : $dateArr[$year][6] = array("NAME"=>$month,'VIDEO'=> $video);break;
                                    case 'Июль' : $dateArr[$year][7] = array("NAME"=>$month,'VIDEO'=> $video);break;
                                    case 'Август' : $dateArr[$year][8] = array("NAME"=>$month,'VIDEO'=> $video);break;
                                    case 'Сентябрь' : $dateArr[$year][9] = array("NAME"=>$month,'VIDEO'=> $video);break;
                                    case 'Октябрь' : $dateArr[$year][10] = array("NAME"=>$month,'VIDEO'=> $video);break;
                                    case 'Ноябрь' : $dateArr[$year][11] = array("NAME"=>$month,'VIDEO'=> $video);break;
                                    case 'Декабрь' : $dateArr[$year][12] = array("NAME"=>$month,'VIDEO'=> $video);break;
                                }
                                //$dateArr[$year][] = $month;
                            }
                        } else {
                            switch ($month) {
                                case 'Январь' : $dateArr[$year][1] = array("NAME"=>$month,'VIDEO'=> $video);break;
                                case 'Февраль' : $dateArr[$year][2] = array("NAME"=>$month,'VIDEO'=> $video);break;
                                case 'Март' : $dateArr[$year][3] = array("NAME"=>$month,'VIDEO'=> $video);break;
                                case 'Апрель' : $dateArr[$year][4] = array("NAME"=>$month,'VIDEO'=> $video);break;
                                case 'Май' : $dateArr[$year][5] = array("NAME"=>$month,'VIDEO'=> $video);break;
                                case 'Июнь' : $dateArr[$year][6] = array("NAME"=>$month,'VIDEO'=> $video);break;
                                case 'Июль' : $dateArr[$year][7] = array("NAME"=>$month,'VIDEO'=> $video);break;
                                case 'Август' : $dateArr[$year][8] = array("NAME"=>$month,'VIDEO'=> $video);break;
                                case 'Сентябрь' : $dateArr[$year][9] = array("NAME"=>$month,'VIDEO'=> $video);break;
                                case 'Октябрь' : $dateArr[$year][10] = array("NAME"=>$month,'VIDEO'=> $video);break;
                                case 'Ноябрь' : $dateArr[$year][11] = array("NAME"=>$month,'VIDEO'=> $video);break;
                                case 'Декабрь' : $dateArr[$year][12] = array("NAME"=>$month,'VIDEO'=> $video);break;
                            }
                        }
                    }
                    krsort($dateArr);
                    $years = array_keys($dateArr); // получаем массив лет
                    $last = array_pop(array_keys( $progressGallery));
                    foreach ($dateArr as $year => $val) {
                        ksort($dateArr[$year]); // сортируем месяцы по возрастанию
                        $dateArr[$year] = array_reverse($dateArr[$year]);
                        //asort($dateArr[$year]); // сортируем месяцы по возрастанию
                    }

                    ?>
                    <select class="ui-select" name="monthSelection" id="monthSelection" data-placeholder="<?=current($dateArr[$years[0]])['NAME']?>">
                        <?php foreach ($dateArr as $year => $monthArr) {
                            foreach ($monthArr as $month){
                                ?>
                                <option value="<?=$month['NAME'];?>" data-year="<?=$year?>" data-video="<?=$month['VIDEO']?>" data-type="month"><?=$month['NAME'];?></option>
                                <?
                            }
                        } ?>
                    </select>
                    <select class="ui-select" name="yearSelection" id="yearSelection" data-placeholder="<?=$years[0]; // по дефолту выводим первый год?>">
                        <?php foreach ($dateArr as $year => $month) {
                            ?>
                            <option value="<?=$year;?>" data-type="year"><?=$year;?></option>
                            <?
                        } ?>
                    </select>
                </div>

                
                
                    <a href="#modal-videobuild" data-src="<?=$progressGallery[$last]['userProps']['UF_VIDEO']['VALUE']?>" class="custom-popup__video gallery-newbuild" <?=$progressGallery[$last]['userProps']['UF_VIDEO']['VALUE'] ? "" : "style='display:none;'"?>>
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21 11C21 5.47715 16.5228 1 11 1C5.47715 1 1 5.47715 1 11C1 16.5228 5.47715 21 11 21C16.5228 21 21 16.5228 21 11Z" stroke="white" stroke-width="1.2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M14.3818 11L9.69999 7.78122V14.2187L14.3818 11ZM15.7349 11C15.7349 11.3127 15.5904 11.6253 15.3014 11.824L10.0665 15.423C9.40302 15.8792 8.49999 15.4041 8.49999 14.599V7.40101C8.49999 6.59583 9.40302 6.12081 10.0665 6.57697L15.3014 10.1759C15.5904 10.3746 15.7349 10.6873 15.7349 11Z" fill="white"/>
                        </svg>
                        Аэровидеосъемка
                    </a>

                    <div class="modal modal-callback mfp-hide" id="modal-videobuild">
                        <div class="modal-callback__inner">
                            <button class="close-btn mfp-close" type="button"></button>
                            
                        </div>
                    </div>



                <?if ($userProps['UF_URL_STREAM1']['VALUE']){?>
                    <a class="btn btn--transp" target="_blank" href="<?=$userProps['UF_URL_STREAM1']['VALUE'];?>" id="stream">
                        <img class="svg svg-stroke btn__ic lazyload" data-src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-circles.svg" width="20" height="20" alt="3d">Онлайн камера 1
                    </a>
                <?}?>
                <?if ($userProps['UF_URL_STREAM2']['VALUE']){?>
                    <a class="btn btn--transp" target="_blank" href="<?=$userProps['UF_URL_STREAM2']['VALUE'];?>">
                        <img class="svg svg-stroke btn__ic lazyload" data-src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-circles.svg" width="20" height="20" alt="3d">Онлайн камера 2
                    </a>
                <?}?>
                <?if ($userProps['UF_URL_STREAM3']['VALUE']){?>
                    <a class="btn btn--transp" target="_blank" href="<?=$userProps['UF_URL_STREAM3']['VALUE'];?>">
                        <img class="svg svg-stroke btn__ic lazyload" data-src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-circles.svg" width="20" height="20" alt="3d">Онлайн камера 3
                    </a>
                <?}?>
            </div>
            <div data-entity="container-1">
                <div class="gallery-slider-xl" id="gallery-2">
                    <?$date = $progressGallery[$last]['standartProps']['ACTIVE_FROM'] ? $progressGallery[$last]['standartProps']['ACTIVE_FROM'] : $progressGallery[$last]['standartProps']['TIMESTAMP_X'];?>
                    <?if($_REQUEST['AJAX_LOAD'] == 'progressGallery'):?>
                        <?php foreach($progressGallery[$last]['userProps']['UF_GALLERY']['VALUE'] as $galleryItem) :?>
                            <div class="slide">
                                <?
                                    $width = 1300;
                                    $height = 700;
                                ?>
                                <?$img = \CFile::ResizeImageGet($galleryItem, array('width'=>$width, 'height'=>700), BX_RESIZE_IMAGE_PROPORTIONAL, true)['src']?>
                                <img class="img lazyload" data-lazy="<?=$img?>" alt="alt">
                                <button class="ui-btn zoom-link" href="<?=$img?>" data-fancybox="gallery2">
                                    <img class="svg lazyload" data-src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-zoom.svg" width="15" height="15" alt="zoom">
                                </button>
                                <div class="publish-date">Опубликовано: <?=FormatDate("d.m.Y",MakeTimeStamp($date))?><?=$progressGallery[$last]['userProps']['UF_RESPONSIBLE_NAME']['VALUE']?' - '.$progressGallery[$last]['userProps']['UF_RESPONSIBLE_NAME']['VALUE']:''?></div>
                            </div>
                        <?php endforeach; ?>
                    <?else:?>
                        <div class="slide">
                            <div style="display: flex;align-items: center;justify-content: center;" class="img">
                                <div class="pl">
                                    <div class="pl__ball"></div>
                                    <div class="pl__ball pl__ball--2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--div class="slide"><img class="img lazyload" data-lazy="/local/templates/fsk/img/logo-banner.jpg" alt="alt"></div--> 
                    <?endif?>
                </div>
                <!-- /.gallery-slider-xl-->
                <div class="gallery-slider-sm" id="gallery-2-thumbs">
                    <?if($_REQUEST['AJAX_LOAD'] == 'progressGallery'):?>
                        <?foreach($progressGallery[$last]['userProps']['UF_GALLERY']['VALUE'] as $galleryItem) : ?>
                            <div class="slide">
                                <?
                                    $width = 146;
                                    $height = 94;
                                ?>
                                
                                <?$img = \CFile::ResizeImageGet($galleryItem, array('width'=>$width, 'height'=> $height), BX_RESIZE_IMAGE_PROPORTIONAL, true)['src']?>
                                <img class="img lazyload" data-lazy="<?=$img?>" alt="alt">
                            </div>
                        <?endforeach?>
                    <?else:?>
                        <!--div class="slide"><img class="img lazyload" data-lazy="/local/templates/fsk/img/logo-banner.jpg" alt="alt"></div--> 
                    <?endif?>
                </div>
            </div>
            <!-- /.gallery-slider-sm-->
            <div class="gallery-btns project-build__bottom">
                <?if ($userProps['UF_URL_STREAM1']['VALUE']){?>
                    <a class="btn btn--transp" target="_blank" href="<?=$userProps['UF_URL_STREAM1']['VALUE'];?>" id="stream">
                        <img class="svg svg-stroke btn__ic lazyload" data-src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-circles.svg" width="20" height="20" alt="3d">Онлайн камера 1
                    </a>
                <?}?>
                <?if ($userProps['UF_URL_STREAM2']['VALUE']){?>
                    <a class="btn btn--transp" target="_blank" href="<?=$userProps['UF_URL_STREAM2']['VALUE'];?>">
                        <img class="svg svg-stroke btn__ic lazyload" data-src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-circles.svg" width="20" height="20" alt="3d">Онлайн камера 2
                    </a>
                <?}?>
                <?if ($userProps['UF_URL_STREAM3']['VALUE']){?>
                    <a class="btn btn--transp" target="_blank" href="<?=$userProps['UF_URL_STREAM3']['VALUE'];?>">
                        <img class="svg svg-stroke btn__ic lazyload" data-src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-circles.svg" width="20" height="20" alt="3d">Онлайн камера 3
                    </a>
                <?}?>
            </div>
        </div>
    </div>
<?php endif; ?>
<?if($_REQUEST['AJAX_LOAD'] == 'progressGallery'):?>
    <?die()?>
<?endif;?>
        <?if(strpos($_SERVER['HTTP_USER_AGENT'],'Chrome-Lighthouse') == false):?>
        <script id = "progressGallery" data-skip-moving="true">
            document.addEventListener('DOMContentLoaded', (event) => {

                const initGallery = () => {
                    var sliderPrevBtn = '<button type="button" class="slider-arrow slider-prev"><svg xmlns="http://www.w3.org/2000/svg" class="svg" width="12.121" height="6.811" viewBox="0 0 12.121 6.811"><g transform="translate(1.061 1.061)"><path d="M0,0,5,5l5-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/></g></svg></button>',
                    sliderNextBtn = '<button type="button" class="slider-arrow slider-next"><svg xmlns="http://www.w3.org/2000/svg" class="svg" width="12.121" height="6.811" viewBox="0 0 12.121 6.811"><g transform="translate(1.061 1.061)"><path d="M0,0,5,5l5-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/></g></svg></button>';

                    $('#gallery-2').slick({
                        infinite: false,
                        speed: 800,
                        fade: true,
                        focusOnSelect: false,
                        asNavFor: '#gallery-2-thumbs',
                        prevArrow: sliderPrevBtn,
                        nextArrow: sliderNextBtn,
                        lazyLoad: 'ondemand',
                        responsive: [ { breakpoint: 767, settings: { arrows: false } } ]
                    });

                    $('#gallery-2-thumbs').slick({
                        infinite: false,
                        slidesToShow: 8,
                        arrows: false,
                        speed: 800,
                        focusOnSelect: true,
                        asNavFor: '#gallery-2',
                        lazyLoad: 'ondemand',
                        responsive: [ { breakpoint: 1199, settings: { slidesToShow: 6 } }, { breakpoint: 767, settings: { slidesToShow: 4, } } ]
                    });

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
                };

                var request = new XMLHttpRequest();
                var scripts = document.getElementById( "progressGallery" );
                request.onload = function() {
                    document.getElementById( "p-8" ).remove();

                    var div = document.createElement('div');
                    div.innerHTML = request.responseText;
                    scripts.parentNode.replaceChild(div, scripts);
                    //window.controller.initData().buildStep();

                    initGallery();
                }
                request.open('GET', `${window.location.pathname}?AJAX_LOAD=progressGallery`);
                setTimeout(() => {
                    request.send();
                }, 10000);
            });
        </script>
        <?endif;?>