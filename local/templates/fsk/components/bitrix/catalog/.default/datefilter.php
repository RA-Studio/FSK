<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if(isset($_POST['date']))  :
?>
    <?php
    $ajaxGallery = []; // массив с галереей хода строительства этого ЖК
    CModule::IncludeModule('iblock');
    $arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_*");
    $arFilter = Array("IBLOCK_ID"=>6, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "SECTION_ID"=>$_POST['sectionId'], "PROPERTY_UF_GALLERY_MONTH_VALUE" => $_POST['date'], "PROPERTY_UF_GALLERY_YEAR_VALUE" => $_POST['year']);


    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>999), $arSelect);

    ?>
    <?php if($res->arResult): $i = 0;?>
        <?php while($ob = $res->GetNextElement()): $ajaxGallery[$i]['standartProps'] = $ob->GetFields(); $ajaxGallery[$i]['userProps'] = $ob->GetProperties(); $i++;?>
        <?php endwhile;?>
    <?php endif; ?>
    <??>
    <!--<div class="container">-->
        <!--<h2 class="h1 title">Ход строительства</h2>
        <div class="gallery-btns project-build__top">
            <div class="gallery-selects">
                <?php
/*                    $dateArr = []; // создаем массив дат
                    $j = 0;
                    foreach ($progressGallery as $index => $item) {
                        $year = $item['userProps']['UF_GALLERY_YEAR']['VALUE'];
                        $month = $item['userProps']['UF_GALLERY_MONTH']['VALUE'];

                        if (array_key_exists($year, $dateArr)) {
                            if (!array_key_exists($month, $dateArr[$year])) {

                                switch ($month) {
                                    case 'Январь' : $dateArr[$year][1] = $month;break;
                                    case 'Февраль' : $dateArr[$year][2] = $month;break;
                                    case 'Март' : $dateArr[$year][3] = $month;break;
                                    case 'Апрель' : $dateArr[$year][4] = $month;break;
                                    case 'Май' : $dateArr[$year][5] = $month;break;
                                    case 'Июнь' : $dateArr[$year][6] = $month;break;
                                    case 'Июль' : $dateArr[$year][7] = $month;break;
                                    case 'Август' : $dateArr[$year][8] = $month;break;
                                    case 'Сентябрь' : $dateArr[$year][9] = $month;break;
                                    case 'Октябрь' : $dateArr[$year][10] = $month;break;
                                    case 'Ноябрь' : $dateArr[$year][11] = $month;break;
                                    case 'Декабрь' : $dateArr[$year][12] = $month;break;
                                }
                                //$dateArr[$year][] = $month;
                            }
                        } else {
                            switch ($month) {
                                case 'Январь' : $dateArr[$year][1] = $month;break;
                                case 'Февраль' : $dateArr[$year][2] = $month;break;
                                case 'Март' : $dateArr[$year][3] = $month;break;
                                case 'Апрель' : $dateArr[$year][4] = $month;break;
                                case 'Май' : $dateArr[$year][5] = $month;break;
                                case 'Июнь' : $dateArr[$year][6] = $month;break;
                                case 'Июль' : $dateArr[$year][7] = $month;break;
                                case 'Август' : $dateArr[$year][8] = $month;break;
                                case 'Сентябрь' : $dateArr[$year][9] = $month;break;
                                case 'Октябрь' : $dateArr[$year][10] = $month;break;
                                case 'Ноябрь' : $dateArr[$year][11] = $month;break;
                                case 'Декабрь' : $dateArr[$year][12] = $month;break;
                            }
                            // $dateArr[$year][] = $month;
                        }
                    }
                */?>
                <script>
                    var dateArr = '<?/*=json_encode($dateArr)*/?>';
                    console.log(dateArr);
                </script>
                <select class="ui-select" name="monthSelection" id="monthSelection" data-placeholder="Сентябрь">
                    <?php /*foreach ($dateArr as $year => $monthArr) {
                        foreach ($monthArr as $month){
                        */?>
                            <option value="<?/*=$month;*/?>"><?/*=$month;*/?></option>
                        <?/*
                        }
                    } */?>
                </select>
                <select class="ui-select" name="yearSelection" id="yearSelection" data-placeholder="2019">
                    <?php /*foreach ($dateArr as $year => $month) {
                            */?>
                            <option value="<?/*=$year;*/?>"><?/*=$year;*/?></option>
                            <?/*

                    } */?>
                </select>
            </div>
            <a class="btn btn--transp" href="#">
                <img class="svg svg-stroke btn__ic" src="<?/*=SITE_TEMPLATE_PATH*/?>/img/icons/ic-circles.svg" width="20" height="20" alt="alt">Онлайн камера 1
            </a>
            <a class="btn btn--transp" href="#">
                <img class="svg svg-stroke btn__ic" src="<?/*=SITE_TEMPLATE_PATH*/?>/img/icons/ic-circles.svg" width="20" height="20" alt="alt">Онлайн камера 2
            </a>
            <a class="btn btn--transp" href="#">
                <img class="svg svg-stroke btn__ic" src="<?/*=SITE_TEMPLATE_PATH*/?>/img/icons/ic-circles.svg" width="20" height="20" alt="alt">Онлайн камера 3
            </a>
        </div>-->
        <div class="gallery-slider-xl" id="gallery-2">
            <?php foreach($ajaxGallery as $item) : ?>
                <?php if ($item['userProps']['UF_GALLERY_MONTH']['VALUE'] === $_POST['date'] && $item['userProps']['UF_GALLERY_YEAR']['VALUE'] === $_POST['year']): ?>
                    <?php foreach ($item['userProps']['UF_GALLERY']['VALUE'] as $month) : ?>
                        <div class="slide">
                            <img class="img" src="<?=CFile::GetPath($month);?>" alt="alt">
                            <button class="ui-btn zoom-link" href="<?=CFile::GetPath($month);?>" data-fancybox="gallery2">
                                <img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-zoom.svg" width="15" height="15" alt="zoom">
                            </button>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <!-- /.gallery-slider-xl-->
        <div class="gallery-slider-sm" id="gallery-2-thumbs">
            <?php foreach($ajaxGallery as $item) : ?>
            <?php if ($item['userProps']['UF_GALLERY_MONTH']['VALUE'] === $_POST['date'] && $item['userProps']['UF_GALLERY_YEAR']['VALUE'] === $_POST['year']): ?>
                <?php foreach ($item['userProps']['UF_GALLERY']['VALUE'] as $month) : ?>
                    <div class="slide">
                        <img class="img" src="<?=CFile::GetPath($month);?>" alt="alt">
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php endforeach; ?>
        </div>
<?/*
        <!-- /.gallery-slider-sm-->
        <div class="gallery-btns project-build__bottom"><a class="btn btn--transp" href="#"> <img class="svg svg-stroke btn__ic" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-circles.svg" width="20" height="20" alt="alt">Онлайн камера 1</a><a class="btn btn--transp" href="#"> <img class="svg svg-stroke btn__ic" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-circles.svg" width="20" height="20" alt="alt">Онлайн камера 2</a><a class="btn btn--transp" href="#"> <img class="svg svg-stroke btn__ic" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-circles.svg" width="20" height="20" alt="alt">Онлайн камера 3</a></div>
    <!--</div>-->
*/?>
<?endif;?>