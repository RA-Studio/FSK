        <?if($_REQUEST['AJAX_LOAD'] == "UF_GALLERY"):?>
            <?$GLOBALS['APPLICATION']->RestartBuffer();?>
        <?endif?>
            <?if ( ($userProps['UF_GALLERY']['VALUE'] || $userProps['UF_GALLERY_IN']['VALUE']) ):?>
                <div class="gallery project-photos section-margin scrollspy-item" id="p-2">
                    <div class="container">
                        <h2 class="h1 title">Галерея</h2>
                        <?if($userProps['UF_GALLERY_IN']['VALUE']):?>
                        <div class="tab-gallery<?=!$userProps['UF_GALLERY']['VALUE'] ? " active" : ""?>" id="gallery-tab1">
                            <div class="gallery-slider-xl" id="gallery-1">
                                <?if($_REQUEST['AJAX_LOAD'] == 'UF_GALLERY'):?>
                                    <? foreach($userProps['UF_GALLERY_IN']['VALUE'] as $galleryItem) : ?>
                                        <?//$img = \CFile::ResizeImageGet($galleryItem, array('width'=>1200, 'height'=>700), BX_RESIZE_IMAGE_PROPORTIONAL, true)['src']?>
                                        <div class="slide">
                                            <img class="img lazyload" data-src="<?=CFile::GetPath($galleryItem)?>" alt="alt">
                                            <button class="ui-btn zoom-link" href="<?=CFile::GetPath($galleryItem)?>" data-fancybox="gallery1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17.121" height="17.121" viewBox="0 0 17.121 17.121"><g transform="translate(1.061 1.061)"><path d="M0,0H5V5" transform="translate(10)" fill="#fff" stroke="#727272" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><path d="M5,5H0V0" transform="translate(0 10)" fill="#fff" stroke="#727272" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><path d="M5.833,0,0,5.833" transform="translate(9.167)" fill="#fff" stroke="#727272" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><path d="M0,5.833,5.833,0" transform="translate(0 9.167)" fill="#fff" stroke="#727272" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/></g></svg>
                                            </button>
                                        </div>
                                    <? endforeach; ?>
                                <?else:?>
                                    <div class="slide">
                                        <div style="display: flex;align-items: center;justify-content: center;" class="img">
                                            <div class="pl">
                                                <div class="pl__ball"></div>
                                                <div class="pl__ball pl__ball--2"></div>
                                            </div>
                                        </div>
                                    </div>
                                <?endif?>
                            </div>
                            <div class="gallery-slider-sm" id="gallery-1-thumbs">
                                <?if($_REQUEST['AJAX_LOAD'] == 'UF_GALLERY'):?>
                                    <?foreach($userProps['UF_GALLERY_IN']['VALUE'] as $galleryItem) : ?>
                                        <?$img = \CFile::ResizeImageGet($galleryItem, array('width'=>145, 'height'=>94), BX_RESIZE_IMAGE_EXACT, true)['src']?>
                                        <div class="slide">
                                            <img class="img lazyload" data-src="<?=$img?>" alt="alt">
                                        </div>
                                    <?endforeach?>
                                <?endif?>
                            </div>
                        </div>
                        <?endif?>
                        <?if($userProps['UF_GALLERY']['VALUE']):?>
                        <div class="tab-gallery<?=!$userProps['UF_GALLERY']['VALUE'] ? "" : " active"?>" id="gallery-tab2">
                            <div class="gallery-slider-xl" id="gallery-slider1">
                                <?if($_REQUEST['AJAX_LOAD'] == 'UF_GALLERY'):?>
                                    <? foreach($userProps['UF_GALLERY']['VALUE'] as $galleryItem) : ?>
                                        <?//$img = \CFile::ResizeImageGet($galleryItem, array('width'=>1200, 'height'=>700), BX_RESIZE_IMAGE_PROPORTIONAL, true)['src']?>
                                        <div class="slide">
                                            <img class="img lazyload" data-lazy="<?=CFile::GetPath($galleryItem)?>" alt="alt">
                                            <button class="ui-btn zoom-link" href="<?=CFile::GetPath($galleryItem)?>" data-fancybox="gallery1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17.121" height="17.121" viewBox="0 0 17.121 17.121"><g transform="translate(1.061 1.061)"><path d="M0,0H5V5" transform="translate(10)" fill="#fff" stroke="#727272" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><path d="M5,5H0V0" transform="translate(0 10)" fill="#fff" stroke="#727272" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><path d="M5.833,0,0,5.833" transform="translate(9.167)" fill="#fff" stroke="#727272" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/><path d="M0,5.833,5.833,0" transform="translate(0 9.167)" fill="#fff" stroke="#727272" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/></g></svg>
                                            </button>
                                            <?/*
                                            <div class="publish-date">Опубликовано: <?=FormatDate("d.m.Y",MakeTimeStamp($fullProps['TIMESTAMP_X']))?><?=$userProps['UF_RESPONSIBLE_NAME']['VALUE']?' - '.$userProps['UF_RESPONSIBLE_NAME']['VALUE']:''?></div>
                                            */?>
                                        </div>
                                    <? endforeach; ?>
                                <?else:?>
                                    <div class="slide">
                                        <div style="display: flex;align-items: center;justify-content: center;" class="img">
                                            <div class="pl">
                                                <div class="pl__ball"></div>
                                                <div class="pl__ball pl__ball--2"></div>
                                            </div>
                                        </div>
                                    </div>
                                <?endif?>
                            </div>
                            <div class="gallery-slider-sm" id="gallery-slider1-thumbs">
                                <?if($_REQUEST['AJAX_LOAD'] == 'UF_GALLERY'):?>
                                    <?foreach($userProps['UF_GALLERY']['VALUE'] as $galleryItem) : ?>
                                        <?$img = \CFile::ResizeImageGet($galleryItem, array('width'=>145, 'height'=>94), BX_RESIZE_IMAGE_EXACT, true)['src']?>
                                        <div class="slide">
                                            <img class="img lazyload" data-lazy="<?=$img?>" alt="alt">
                                        </div>
                                    <?endforeach?>
                                <?endif?>
                            </div>
                        </div>
                        <?endif?>

                        <?if (
                            $userProps['UF_URL_3D']['VALUE'] ||
                            $userProps['UF_URL_STREAM1']['VALUE'] ||
                            $userProps['UF_URL_STREAM2']['VALUE'] ||
                            $userProps['UF_URL_STREAM3']['VALUE']
                        ) {
                        ?>
                            <div class="gallery-btns">
                                <? if ($userProps['UF_URL_3D']['VALUE']): ?>
                                    <a target="_blank" class="btn btn--transp" href="<?=$userProps['UF_URL_3D']['VALUE'];?>">
                                        <svg class="svg svg-stroke btn__ic" xmlns="http://www.w3.org/2000/svg" width="21.5" height="21.5" viewBox="0 0 21.5 21.5"><g transform="translate(0.75 0.75)"><rect width="20" height="20" rx="10" stroke-width="1.5" stroke="#e94200" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" fill="none"/><rect width="6.667" height="6.667" rx="3.333" transform="translate(6.667 6.667)" stroke-width="1.5" stroke="#e94200" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" fill="none"/></g></svg>
                                        Аэропанорама
                                    </a>
                                <? endif; ?>


                                <?global $USER;
                                if ($USER->IsAdmin() && $userProps['UF_GALLERY_IN']['VALUE'] && $userProps['UF_GALLERY']['VALUE']) {?>
                                    <?if($userProps['UF_GALLERY']['VALUE']):?>
                                        <a class="btn btn--bg active tabs-gallery__btn" href="#gallery-tab2">
                                            <svg class="svg svg-stroke btn__ic" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M17.2919 0.0839966H11.861C11.7766 0.0806248 11.6924 0.0943147 11.6134 0.12428C11.5345 0.154245 11.4624 0.199866 11.4015 0.258374C11.3406 0.316882 11.2922 0.387103 11.2591 0.464795C11.226 0.542487 11.2089 0.626015 11.2089 0.710461C11.2089 0.794908 11.226 0.878497 11.2591 0.956189C11.2922 1.03388 11.3406 1.1041 11.4015 1.16261C11.4624 1.22112 11.5345 1.26674 11.6134 1.2967C11.6924 1.32667 11.7766 1.34036 11.861 1.33699H15.753L12.872 4.21797L10.295 6.795L6.95499 10.135C6.83785 10.2567 6.77307 10.4195 6.77469 10.5884C6.77631 10.7573 6.84421 10.9189 6.96365 11.0383C7.0831 11.1578 7.24457 11.2256 7.41348 11.2272C7.5824 11.2288 7.74526 11.1641 7.86697 11.047L11.2069 7.70698L13.784 5.12996L16.6649 2.24897V6.14497C16.6714 6.3068 16.7403 6.45988 16.8571 6.57209C16.9739 6.68431 17.1295 6.74696 17.2914 6.74696C17.4534 6.74696 17.6091 6.68431 17.7259 6.57209C17.8426 6.45988 17.9115 6.3068 17.918 6.14497V0.714001C17.9184 0.631495 17.9025 0.549692 17.8712 0.47334C17.84 0.396987 17.7939 0.327583 17.7357 0.269055C17.6776 0.210528 17.6084 0.164031 17.5323 0.132275C17.4561 0.100519 17.3744 0.0841273 17.2919 0.0839966Z" fill="#E94200"/>
                                                <path d="M17.398 11.8579C17.3283 11.8251 17.2529 11.8063 17.176 11.8027C17.0991 11.7991 17.0222 11.8106 16.9497 11.8367C16.8773 11.8628 16.8107 11.903 16.7538 11.9548C16.6969 12.0066 16.6507 12.0692 16.618 12.1389C16.08 13.2829 15.2735 14.28 14.2672 15.0453C13.2608 15.8105 12.0845 16.3211 10.8383 16.5338C9.59205 16.7464 8.3129 16.6547 7.10975 16.2665C5.9066 15.8783 4.81509 15.2051 3.92817 14.3042C3.04126 13.4033 2.38519 12.3013 2.01588 11.0923C1.64657 9.88318 1.57494 8.60275 1.80708 7.36002C2.03922 6.11729 2.56825 4.94909 3.34913 3.95487C4.13002 2.96064 5.1396 2.16986 6.29194 1.64987C6.42747 1.58195 6.53148 1.46426 6.58216 1.32138C6.63285 1.17851 6.62633 1.02155 6.56391 0.883395C6.50149 0.745245 6.38804 0.636623 6.24732 0.580234C6.1066 0.523844 5.94952 0.524027 5.80897 0.580844C4.48389 1.17839 3.32288 2.08741 2.42482 3.23038C1.52675 4.37335 0.918237 5.71646 0.651134 7.1453C0.38403 8.57413 0.46624 10.0463 0.890758 11.4366C1.31528 12.8268 2.06951 14.0938 3.08924 15.1297C4.10898 16.1656 5.36395 16.9396 6.74732 17.3859C8.1307 17.8322 9.60146 17.9375 11.0343 17.6929C12.4672 17.4483 13.8197 16.861 14.9766 15.981C16.1336 15.101 17.0607 13.9544 17.679 12.6389C17.7119 12.5692 17.7308 12.4936 17.7345 12.4166C17.7382 12.3396 17.7267 12.2626 17.7006 12.19C17.6745 12.1175 17.6343 12.0508 17.5823 11.9938C17.5304 11.9368 17.4678 11.8906 17.398 11.8579Z" fill="#E94200" stroke="#E94200" stroke-width="0.2"/>
                                            </svg>
                                            Вид снаружи
                                        </a>
                                    <?endif?>
                                    <?if($userProps['UF_GALLERY_IN']['VALUE']):?>
                                        <a class="btn btn--transp <?=!$userProps['UF_GALLERY']['VALUE'] ? " active" : ""?> tabs-gallery__btn" href="#gallery-tab1">
                                            <svg class="svg svg-stroke btn__ic" width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M7.85092 6.51392C7.85092 6.3463 7.78432 6.18555 7.6658 6.06703C7.54728 5.94851 7.38652 5.88191 7.2189 5.88191C7.05129 5.88191 6.89056 5.94851 6.77203 6.06703C6.65351 6.18555 6.58691 6.3463 6.58691 6.51392V11.9909C6.58691 12.1585 6.65351 12.3193 6.77203 12.4378C6.89056 12.5563 7.05129 12.6229 7.2189 12.6229H12.6959C12.7789 12.6229 12.8611 12.6066 12.9378 12.5748C13.0145 12.5431 13.0841 12.4965 13.1428 12.4378C13.2015 12.3791 13.2481 12.3095 13.2798 12.2328C13.3116 12.1561 13.3279 12.0739 13.3279 11.9909C13.3279 11.9079 13.3116 11.8257 13.2798 11.7491C13.2481 11.6724 13.2015 11.6027 13.1428 11.544C13.0841 11.4853 13.0145 11.4388 12.9378 11.407C12.8611 11.3753 12.7789 11.3589 12.6959 11.3589H8.77191L15.5799 4.55092C15.7022 4.42865 15.7708 4.26282 15.7708 4.08992C15.7708 3.91702 15.7022 3.75119 15.5799 3.62892C15.4577 3.50667 15.2918 3.43799 15.1189 3.43799C14.946 3.43799 14.7802 3.50667 14.6579 3.62892L7.84991 10.4369L7.85092 6.51392Z" fill="#E94200"/>
                                                <path d="M18.2229 6.63606C18.1715 6.48765 18.0634 6.36566 17.9223 6.29686C17.7811 6.22805 17.6184 6.21805 17.4699 6.26905C17.3215 6.32039 17.1995 6.4285 17.1306 6.56967C17.0618 6.71083 17.0519 6.87353 17.1029 7.02206C17.3894 7.85408 17.535 8.72808 17.5338 9.60806C17.5315 11.7089 16.6959 13.723 15.2104 15.2085C13.7248 16.6941 11.7107 17.5297 9.6099 17.5321C7.50905 17.5297 5.49489 16.6941 4.00937 15.2085C2.52385 13.723 1.68827 11.7089 1.68589 9.60806C1.68827 7.50721 2.52385 5.49309 4.00937 4.00757C5.49489 2.52205 7.50905 1.68644 9.6099 1.68405C10.3891 1.68379 11.1641 1.79836 11.9099 2.02406C11.9843 2.04672 12.0625 2.05447 12.14 2.04687C12.2174 2.03928 12.2927 2.01648 12.3613 1.97979C12.4299 1.94311 12.4907 1.89325 12.54 1.83306C12.5894 1.77288 12.6264 1.70355 12.6489 1.62905C12.6716 1.5546 12.6793 1.4764 12.6717 1.39894C12.6641 1.32149 12.6413 1.24629 12.6046 1.17765C12.5679 1.10901 12.518 1.04828 12.4579 0.998928C12.3977 0.949579 12.3284 0.912584 12.2539 0.890056C11.3953 0.630111 10.503 0.498358 9.60587 0.499057C8.40918 0.495778 7.22374 0.729898 6.11814 1.18786C5.01254 1.64583 4.00875 2.31854 3.16489 3.16706C2.31637 4.01092 1.64367 5.0147 1.1857 6.1203C0.727739 7.22591 0.493581 8.41137 0.49686 9.60806C0.493581 10.8048 0.727739 11.9902 1.1857 13.0958C1.64367 14.2014 2.31637 15.2052 3.16489 16.0491C4.00875 16.8976 5.01254 17.5703 6.11814 18.0282C7.22374 18.4862 8.40918 18.7203 9.60587 18.7171C10.8026 18.7203 11.988 18.4862 13.0936 18.0282C14.1992 17.5703 15.203 16.8976 16.0468 16.0491C16.8953 15.2052 17.568 14.2014 18.026 13.0958C18.4839 11.9902 18.7181 10.8047 18.7149 9.60806C18.7173 8.59693 18.551 7.59247 18.2229 6.63606Z" fill="#E94200"/>
                                            </svg>
                                            Интерьер (холлы)
                                        </a>
                                    <?endif?>
                                <?}?>

                                <? if ($userProps['UF_URL_STREAM1']['VALUE'] || $userProps['UF_URL_STREAM2']['VALUE'] || $userProps['UF_URL_STREAM3']['VALUE']) : ?>
                                    <?/*?>
                                    <a class="btn btn--transp" href="#p-8">
                                        <svg class="svg svg-stroke btn__ic" xmlns="http://www.w3.org/2000/svg" width="21.5" height="21.5" viewBox="0 0 21.5 21.5"><g transform="translate(0.75 0.75)"><rect width="20" height="20" rx="10" stroke-width="1.5" stroke="#e94200" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" fill="none"/><rect width="6.667" height="6.667" rx="3.333" transform="translate(6.667 6.667)" stroke-width="1.5" stroke="#e94200" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" fill="none"/></g></svg>
                                        <?/*<img class="svg svg-stroke btn__ic" src="<?=SITE_TEMPLATE_PATH;?>/img/icons/ic-circles.svg" width="20" height="20" alt="3d">*/?>
                                    <?/*?>
                                        Онлайн трансляция
                                    </a>
                                <?*/?>
                                    <?if($userProps['UF_JK_STATUS']['VALUE'] === 'Да'):
                                        $last = array_pop(array_keys( $progressGallery));
                                        ?>
                                        <a href="#modal-videobuild" data-src="<?=$progressGallery[$last]['userProps']['UF_VIDEO']['VALUE']?>" class="custom-popup__video gallery-newbuild" <?=$progressGallery[$last]['userProps']['UF_VIDEO']['VALUE'] ? "" : "style='display:none;'"?>>
                                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M21 11C21 5.47715 16.5228 1 11 1C5.47715 1 1 5.47715 1 11C1 16.5228 5.47715 21 11 21C16.5228 21 21 16.5228 21 11Z" stroke="white" stroke-width="1.2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M14.3818 11L9.69999 7.78122V14.2187L14.3818 11ZM15.7349 11C15.7349 11.3127 15.5904 11.6253 15.3014 11.824L10.0665 15.423C9.40302 15.8792 8.49999 15.4041 8.49999 14.599V7.40101C8.49999 6.59583 9.40302 6.12081 10.0665 6.57697L15.3014 10.1759C15.5904 10.3746 15.7349 10.6873 15.7349 11Z" fill="white"/>
                                            </svg>
                                            Аэровидеосъемка
                                        </a>
                                        <a class="btn btn--transp btn-last" href="#p-8">
                                            <svg class="svg svg-stroke btn__ic" xmlns="http://www.w3.org/2000/svg" width="21.5" height="21.5" viewBox="0 0 21.5 21.5"><g transform="translate(0.75 0.75)"><rect width="20" height="20" rx="10" stroke-width="1.5" stroke="#e94200" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" fill="none"/><rect width="6.667" height="6.667" rx="3.333" transform="translate(6.667 6.667)" stroke-width="1.5" stroke="#e94200" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" fill="none"/></g></svg>
                                            Ход строительства
                                        </a>
                                    <?endif;?>
                                <? endif; ?>

                            </div>
                        <?}?>
                    </div>
                </div>
            <?endif?>
        <?if($_REQUEST['AJAX_LOAD'] == "UF_GALLERY"):?>
            <?die()?>
        <?endif?>
        <?if(strpos($_SERVER['HTTP_USER_AGENT'],'Chrome-Lighthouse') == false):?>
        <script id = "UF_GALLERY" data-skip-moving="true">
            document.addEventListener('DOMContentLoaded', (event) => {

                const initUfGallery = () => {
                    
                    var sliderPrevBtn = '<button type="button" class="slider-arrow slider-prev"><svg xmlns="http://www.w3.org/2000/svg" class="svg" width="12.121" height="6.811" viewBox="0 0 12.121 6.811"><g transform="translate(1.061 1.061)"><path d="M0,0,5,5l5-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/></g></svg></button>',
                    sliderNextBtn = '<button type="button" class="slider-arrow slider-next"><svg xmlns="http://www.w3.org/2000/svg" class="svg" width="12.121" height="6.811" viewBox="0 0 12.121 6.811"><g transform="translate(1.061 1.061)"><path d="M0,0,5,5l5-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/></g></svg></button>';

                    $('#gallery-slider1').slick({
                        infinite: false,
                        speed: 800,
                        fade: true,
                        focusOnSelect: false,
                        asNavFor: '#gallery-slider1-thumbs',
                        prevArrow: sliderPrevBtn,
                        nextArrow: sliderNextBtn,
                        lazyLoad: 'ondemand',
                        responsive: [ { breakpoint: 767, settings: { arrows: false } } ]
                    });

                    $('#gallery-slider1-thumbs').slick({
                        infinite: false,
                        slidesToShow: 8,
                        arrows: false,
                        speed: 800,
                        focusOnSelect: true,
                        asNavFor: '#gallery-slider1',
                        lazyLoad: 'ondemand',
                        responsive: [{breakpoint: 1199, settings:{slidesToShow: 6 }},{ breakpoint: 767, settings: { slidesToShow: 4 }}]
                    });
                };
                var requestGallery = new XMLHttpRequest();
                var scriptsGallery = document.getElementById( "UF_GALLERY" );
                requestGallery.onload = function() {
                    document.getElementById( "p-2" ).remove();
                    var div = document.createElement('div');
                    div.innerHTML = requestGallery.responseText;
                    scriptsGallery.parentNode.replaceChild(div, scriptsGallery);
                    initUfGallery();
                    $('.custom-popup__video').magnificPopup({
                        items: {
                            src: '#modal-videobuild',
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
                }
                requestGallery.open('GET', `${window.location.pathname}?AJAX_LOAD=UF_GALLERY`);
                setTimeout(() => {
                    requestGallery.send();
                }, 3000);
            });
        </script>
        <?endif?>