<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<?php echo '<pre style="display:none">',print_r($arResult,1),'</pre>'; ?>
<div class="gallery project-build section-margin scrollspy-item" id="p-8">
    <div class="container">
        <h2 class="h1 title">Ход строительства</h2>
        <div class="gallery-btns project-build__top">
            <div class="gallery-selects">
                <select class="ui-select" name="select_period" data-placeholder="Сентябрь">
                    <option value="Январь">Январь</option>
                    <option value="Февраль">Февраль</option>
                    <option value="Март">Март</option>
                    <option value="Апрель">Апрель</option>
                    <option value="Май">Май</option>
                    <option value="Июнь">Июнь</option>
                    <option value="Июль">Июль</option>
                    <option value="Август">Август</option>
                    <option class="active" value="Сентябрь">Сентябрь</option>
                    <option value="Октябрь">Октябрь</option>
                    <option value="Ноябрь">Ноябрь</option>
                    <option value="ДекабрьДекабрь">Декабрь</option>
                    <option value="Сентябрь">Сентябрь</option>
                </select>
                <select class="ui-select" name="select_period" data-placeholder="2019">
                    <option class="active" value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                </select>
            </div><a class="btn btn--transp" href="#"> <img class="svg svg-stroke btn__ic" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-circles.svg" width="20" height="20" alt="alt">Онлайн камера 1</a><a class="btn btn--transp" href="#"> <img class="svg svg-stroke btn__ic" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-circles.svg" width="20" height="20" alt="alt">Онлайн камера 2</a><a class="btn btn--transp" href="#"> <img class="svg svg-stroke btn__ic" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-circles.svg" width="20" height="20" alt="alt">Онлайн камера 3</a>
        </div>
        <div class="gallery-slider-xl" id="gallery-2">
            <div class="slide"><img class="img" src="<?=SITE_TEMPLATE_PATH?>/img/img-main-1.jpg" alt="alt">
                <button class="ui-btn zoom-link" href="img/img-main-1.jpg" data-fancybox="gallery2"><img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-zoom.svg" width="15" height="15" alt="zoom"></button>
            </div>
            <div class="slide"><img class="img" src="<?=SITE_TEMPLATE_PATH?>/img/img-main-2.jpg" alt="alt">
                <button class="ui-btn zoom-link" href="img/img-main-2.jpg" data-fancybox="gallery2"><img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-zoom.svg" width="15" height="15" alt="zoom"></button>
            </div>
            <div class="slide"><img class="img" src="<?=SITE_TEMPLATE_PATH?>/img/img-main-3.jpg" alt="alt">
                <button class="ui-btn zoom-link" href="img/img-main-3.jpg" data-fancybox="gallery2"><img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-zoom.svg" width="15" height="15" alt="zoom"></button>
            </div>
            <div class="slide"><img class="img" src="<?=SITE_TEMPLATE_PATH?>/img/img-main-4.jpg" alt="alt">
                <button class="ui-btn zoom-link" href="img/img-main-4.jpg" data-fancybox="gallery2"><img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-zoom.svg" width="15" height="15" alt="zoom"></button>
            </div>
            <div class="slide"><img class="img" src="<?=SITE_TEMPLATE_PATH?>/img/img-main-1.jpg" alt="alt">
                <button class="ui-btn zoom-link" href="img/img-main-1.jpg" data-fancybox="gallery2"><img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-zoom.svg" width="15" height="15" alt="zoom"></button>
            </div>
            <div class="slide"><img class="img" src="<?=SITE_TEMPLATE_PATH?>/img/img-main-2.jpg" alt="alt">
                <button class="ui-btn zoom-link" href="img/img-main-2.jpg" data-fancybox="gallery2"><img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-zoom.svg" width="15" height="15" alt="zoom"></button>
            </div>
            <div class="slide"><img class="img" src="<?=SITE_TEMPLATE_PATH?>/img/img-main-3.jpg" alt="alt">
                <button class="ui-btn zoom-link" href="img/img-main-3.jpg" data-fancybox="gallery2"><img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-zoom.svg" width="15" height="15" alt="zoom"></button>
            </div>
            <div class="slide"><img class="img" src="<?=SITE_TEMPLATE_PATH?>/img/img-main-4.jpg" alt="alt">
                <button class="ui-btn zoom-link" href="img/img-main-4.jpg" data-fancybox="gallery2"><img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-zoom.svg" width="15" height="15" alt="zoom"></button>
            </div>
            <div class="slide"><img class="img" src="<?=SITE_TEMPLATE_PATH?>/img/img-main-1.jpg" alt="alt">
                <button class="ui-btn zoom-link" href="img/img-main-1.jpg" data-fancybox="gallery2"><img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-zoom.svg" width="15" height="15" alt="zoom"></button>
            </div>
        </div>
        <!-- /.gallery-slider-xl-->
        <div class="gallery-slider-sm" id="gallery-2-thumbs">
            <div class="slide"><img class="img" src="<?=SITE_TEMPLATE_PATH?>/img/img-main-1.jpg" alt="alt"></div>
            <div class="slide"><img class="img" src="<?=SITE_TEMPLATE_PATH?>/img/img-main-2.jpg" alt="alt"></div>
            <div class="slide"><img class="img" src="<?=SITE_TEMPLATE_PATH?>/img/img-main-3.jpg" alt="alt"></div>
            <div class="slide"><img class="img" src="<?=SITE_TEMPLATE_PATH?>/img/img-main-4.jpg" alt="alt"></div>
            <div class="slide"><img class="img" src="<?=SITE_TEMPLATE_PATH?>/img/img-main-1.jpg" alt="alt"></div>
            <div class="slide"><img class="img" src="<?=SITE_TEMPLATE_PATH?>/img/img-main-2.jpg" alt="alt"></div>
            <div class="slide"><img class="img" src="<?=SITE_TEMPLATE_PATH?>/img/img-main-3.jpg" alt="alt"></div>
            <div class="slide"><img class="img" src="<?=SITE_TEMPLATE_PATH?>/img/img-main-4.jpg" alt="alt"></div>
            <div class="slide"><img class="img" src="<?=SITE_TEMPLATE_PATH?>/img/img-main-1.jpg" alt="alt"></div>
        </div>
        <!-- /.gallery-slider-sm-->
        <div class="gallery-btns project-build__bottom"><a class="btn btn--transp" href="#"> <img class="svg svg-stroke btn__ic" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-circles.svg" width="20" height="20" alt="alt">Онлайн камера 1</a><a class="btn btn--transp" href="#"> <img class="svg svg-stroke btn__ic" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-circles.svg" width="20" height="20" alt="alt">Онлайн камера 2</a><a class="btn btn--transp" href="#"> <img class="svg svg-stroke btn__ic" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-circles.svg" width="20" height="20" alt="alt">Онлайн камера 3</a></div>
    </div>
</div>
