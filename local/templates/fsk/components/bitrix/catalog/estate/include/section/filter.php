<?
$filterData['room'] = array_values(array_unique($filterData['room']));
$filterData['price100short'] = array_values(array_unique($filterData['price100short']));
$filterData['area'] = array_values(array_unique($filterData['area']));
$filterData['floor'] = array_values(array_unique($filterData['floor']));
$filterData['kitchenspace'] = array_filter(array_values(array_unique($filterData['kitchenspace'])));
$filterData['builtyear'] = array_values(array_unique($filterData['builtyear']));
sort($filterData['builtyear']);
\RaStudio\Helper::arrayShiftInRight($filterData['builtyear']);
$downShow = false;
?>
<?/*<div class="filter-preloader" style="display: none"></div>*/?>

<form class="filter">
    <input type="hidden" value="<?=$arParams['IBLOCK_ID']?>" name="IBLOCK_ID">
    <input type="hidden" value="<?=$SectionInfo['ID']?>" name="SECTION_ID">
        <?if($apart){?>
            <div class="filter-row">
                <div class="filter-fields">

                    <div class="filter__field filter-field">
                        <div class="filter-field__label">Стоимость, млн/р.</div>
                        <div class="ui-range">
                            <div class="ui-range__col"><span>от</span>
                                <input class="ui-range__val ui-range__from" name = ">=PROPERTY_price100short" value="<?=floor(min($filterData['price100short']))?>">
                            </div>
                            <div class="ui-range__col"><span>до</span>
                                <input class="ui-range__val ui-range__to" name = "<=PROPERTY_price100short" value="<?=ceil(max($filterData['price100short']))?>">
                            </div>
                            <div
                                    class="ui-range__slider ui-range-cost"
                                    data-name = "PROPERTY_price100short"
                                    data-min = "<?=floor(min($filterData['price100short']))?>"
                                    data-max = "<?=ceil(max($filterData['price100short']))?>"
                                    data-step = "0.01"
                            ></div>
                        </div>
                    </div>
                    <div class="filter__field filter-field">
                        <div class="filter-field__label">Площадь, м<sup>2</sup></div>
                        <div class="ui-range">
                            <div class="ui-range__col"><span>от</span>
                                <input class="ui-range__val ui-range__from" name = ">=PROPERTY_area" value="<?=floor(min($filterData['area']))?>">
                            </div>
                            <div class="ui-range__col"><span>до</span>
                                <input class="ui-range__val ui-range__to" name = "<=PROPERTY_area" value="<?=ceil(max($filterData['area']))?>">
                            </div>
                            <div
                                    class="ui-range__slider ui-range-size"
                                    data-name = "PROPERTY_area"
                                    data-min = "<?=floor(min($filterData['area']))?>"
                                    data-max = "<?=ceil(max($filterData['area']))?>"
                                    data-step = "1"
                            ></div>
                        </div>
                    </div>
                    <?if(count(array_filter($filterData['floor'])) > 1):?>
                        <div class="filter__field filter-field">
                            <div class="filter-field__label">Этаж</div>
                            <div class="ui-range">
                                <div class="ui-range__col"><span>от</span>
                                    <input class="ui-range__val ui-range__from" name=">=PROPERTY_floor" value="<?=min($filterData['floor'])?>">
                                </div>
                                <div class="ui-range__col"><span>до</span>
                                    <input class="ui-range__val ui-range__to" name="<=PROPERTY_floor" value="<?=max($filterData['floor'])?>">
                                </div>
                                <div
                                        class="ui-range__slider ui-range-floor"
                                        data-name = "PROPERTY_floor"
                                        data-min = "<?=min($filterData['floor'])?>"
                                        data-max = "<?=max($filterData['floor'])?>"
                                        data-step = "1"
                                ></div>
                            </div>
                        </div>
                    <?endif;?>
                    <div class="filter__field filter-field">
                        <div class="filter__field filter-field-result" >
                            <a class="btn btn--bg" href="#p-6">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17.086 17.215" class="svg btn__ic inlined-svg" width="20" height="20" role="img" aria-labelledby="title"><title>phone</title><g transform="translate(88.284 -1899.289) rotate(45)"><g transform="translate(1287 1399)" fill="none" stroke="#fff" stroke-width="1.5"><circle cx="5.656" cy="5.656" r="5.656" stroke="none"></circle><circle cx="5.656" cy="5.656" r="4.906" fill="none"></circle></g><line x2="0.182" y2="6.168" transform="translate(1292.656 1409.797)" fill="none" stroke="#fff" stroke-linecap="round" stroke-width="1.5"></line><g transform="matrix(0.777, -0.629, 0.629, 0.777, 1288.615, 1403.878)"><path d="M.494,2.583A.494.494,0,0,1,.039,1.9,3.111,3.111,0,0,1,4.112.246a.494.494,0,1,1-.385.909A2.123,2.123,0,0,0,.948,2.281.494.494,0,0,1,.494,2.583Z" transform="translate(0 0)" fill="#fff"></path></g></g></svg>
                                Показать результаты
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="filter-row filter__hidden">
                <div class="filter-fields">
                    <!--div class="filter__field filter-field">
                        <div class="filter-field__label">Площадь кухни, м<sup>2</sup></div>
                        <div class="ui-range">
                            <div class="ui-range__col"><span>от</span>
                                <input class="ui-range__val ui-range__from" name=">=PROPERTY_kitchenspace" value="<?=min($filterData['kitchenspace'])?>">
                            </div>
                            <div class="ui-range__col"><span>до</span>
                                <input class="ui-range__val ui-range__to" name="<=PROPERTY_kitchenspace" value="<?=max($filterData['kitchenspace'])?>">
                            </div>
                            <div
                                class="ui-range__slider ui-range-kitchen"
                                data-min = "<?=min($filterData['kitchenspace'])?>"
                                data-max = "<?=max($filterData['kitchenspace'])?>"
                                data-step = "1"
                            ></div>
                        </div>
                    </div-->
                    <?if($filterData['builtyear'] && count($filterData['builtyear']) > 1):?>
                        <?$downShow = true?>
                        <div class="filter__field filter-field">
                            <div class="filter-field__label">Готовность до</div>
                            <select class="ui-select" name="PROPERTY_builtyear" data-placeholder="Любое" data-event-change="updateResult">
                                <option value="" class="active">Любое</option>
                                <?foreach ($filterData['builtyear'] as $key => $year):?>
                                    <option value="<?=$year?>"<?= $key === 0 ? ' class="active"' : '' ?> data-event="updateResult"><?=$year?></option>
                                <?endforeach;?>
                            </select>
                        </div>
                    <?endif;?>
                    <?/*
                    <div class="filter__field filter-field">
                        <div class="filter-field__label">Корпус</div>
                        <select class="ui-select" name="select_building" data-placeholder="2 корпус">
                            <option value="1 корпус">1 корпус</option>
                            <option class="active" value="2 корпус">2 корпус</option>
                            <option value="3 корпус">3 корпус</option>
                        </select>
                    </div>
                    */?>
                    <div class="filter__field filter-field-result">
                        <div class="btn btn--bg form-submit" data-event="getFilterApartment">
                            <img class="svg btn__ic lazyload" data-src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-search.svg" alt="phone" width="20" height="20">
                            Показать результаты
                            <!--Найдено <span class="filter-count">150 </span>квартир-->
                        </div>
                    </div>
                </div>
            </div>
        <?}else{?>
            <div class="filter-row">
                <div class="filter-fields">
                    <?if(count(array_filter($filterData['room'])) > 0):?>
                        <div class="filter__field filter-field">
                            <div class="filter-field__label">Количество комнат</div>
                            <div class="ui-checkbox-group">
                                <div class="ui-checkbox">
                                    <input class="ui-checkbox__input" id="room0" type="checkbox" name="PROPERTY_rooms" value="0" data-event-change="updateResult">
                                    <label class="ui-checkbox__label" for="room0">С</label>
                                </div>
                                <div class="ui-checkbox">
                                    <input class="ui-checkbox__input" id="room1" type="checkbox" name="PROPERTY_rooms" value="1" data-event-change="updateResult">
                                    <label class="ui-checkbox__label" for="room1" >1</label>
                                </div>
                                <div class="ui-checkbox">
                                    <input class="ui-checkbox__input" id="room2" type="checkbox" name="PROPERTY_rooms" value="2" data-event-change="updateResult">
                                    <label class="ui-checkbox__label" for="room2">2</label>
                                </div>
                                <div class="ui-checkbox">
                                    <input class="ui-checkbox__input" id="room3" type="checkbox" name="PROPERTY_rooms" value="3" data-event-change="updateResult">
                                    <label class="ui-checkbox__label" for="room3">3</label>
                                </div>
                                <div class="ui-checkbox">
                                    <input class="ui-checkbox__input" id="room4" type="checkbox" name="PROPERTY_rooms" value="4" data-event-change="updateResult">
                                    <label class="ui-checkbox__label" for="room4">4</label>
                                </div>
                                <?/*
                        <div class="ui-checkbox">
                            <input class="ui-checkbox__input" id="room5" type="checkbox" name="PROPERTY_rooms" value="5" data-event-change="updateResult">
                            <label class="ui-checkbox__label" for="room5">5</label>
                        </div>
                        */?>
                            </div>
                        </div>
                    <?endif;?>
                    <div class="filter__field filter-field">
                        <div class="filter-field__label">Стоимость, млн/р.</div>
                        <div class="ui-range">
                            <div class="ui-range__col"><span>от</span>
                                <input class="ui-range__val ui-range__from" name = ">=PROPERTY_price100short" value="<?=floor(min($filterData['price100short']))?>">
                            </div>
                            <div class="ui-range__col"><span>до</span>
                                <input class="ui-range__val ui-range__to" name = "<=PROPERTY_price100short" value="<?=ceil(max($filterData['price100short']))?>">
                            </div>
                            <div
                                    class="ui-range__slider ui-range-cost"
                                    data-name = "PROPERTY_price100short"
                                    data-min = "<?=floor(min($filterData['price100short']))?>"
                                    data-max = "<?=ceil(max($filterData['price100short']))?>"
                                    data-step = "0.01"
                            ></div>
                        </div>
                    </div>
                    <div class="filter__field filter-field">
                        <div class="filter-field__label">Площадь, м<sup>2</sup></div>
                        <div class="ui-range">
                            <div class="ui-range__col"><span>от</span>
                                <input class="ui-range__val ui-range__from" name = ">=PROPERTY_area" value="<?=floor(min($filterData['area']))?>">
                            </div>
                            <div class="ui-range__col"><span>до</span>
                                <input class="ui-range__val ui-range__to" name = "<=PROPERTY_area" value="<?=ceil(max($filterData['area']))?>">
                            </div>
                            <div
                                    class="ui-range__slider ui-range-size"
                                    data-name = "PROPERTY_area"
                                    data-min = "<?=floor(min($filterData['area']))?>"
                                    data-max = "<?=ceil(max($filterData['area']))?>"
                                    data-step = "1"
                            ></div>
                        </div>
                    </div>
                    <?if(count(array_filter($filterData['floor'])) > 1):?>
                        <div class="filter__field filter-field">
                            <div class="filter-field__label">Этаж</div>
                            <div class="ui-range">
                                <div class="ui-range__col"><span>от</span>
                                    <input class="ui-range__val ui-range__from" name=">=PROPERTY_floor" value="<?=min($filterData['floor'])?>">
                                </div>
                                <div class="ui-range__col"><span>до</span>
                                    <input class="ui-range__val ui-range__to" name="<=PROPERTY_floor" value="<?=max($filterData['floor'])?>">
                                </div>
                                <div
                                        class="ui-range__slider ui-range-floor"
                                        data-name = "PROPERTY_floor"
                                        data-min = "<?=min($filterData['floor'])?>"
                                        data-max = "<?=max($filterData['floor'])?>"
                                        data-step = "1"
                                ></div>
                            </div>
                        </div>
                    <?endif;?>

                    <?if(count(array_filter($filterData['room'])) == 0):?>
                        <?if($filterData['builtyear']):?>
                            <?$downShow = true?>
                            <div class="filter__field filter-field">
                                <div class="filter-field__label">Готовность до</div>
                                <select class="ui-select" name="PROPERTY_builtyear" data-placeholder="Любое" data-event-change="updateResult">
                                    <option value="" class="active">Любое</option>
                                    <?foreach ($filterData['builtyear'] as $key => $year):?>
                                        <option value="<?=$year?>"><?=$year?></option>
                                    <?endforeach;?>
                                </select>
                            </div>
                        <?endif;?>
                        <div class="filter__field filter-field-result" >
                            <a class="btn btn--bg" href="#p-6">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17.086 17.215" class="svg btn__ic inlined-svg" width="20" height="20" role="img" aria-labelledby="title"><title>phone</title><g transform="translate(88.284 -1899.289) rotate(45)"><g transform="translate(1287 1399)" fill="none" stroke="#fff" stroke-width="1.5"><circle cx="5.656" cy="5.656" r="5.656" stroke="none"></circle><circle cx="5.656" cy="5.656" r="4.906" fill="none"></circle></g><line x2="0.182" y2="6.168" transform="translate(1292.656 1409.797)" fill="none" stroke="#fff" stroke-linecap="round" stroke-width="1.5"></line><g transform="matrix(0.777, -0.629, 0.629, 0.777, 1288.615, 1403.878)"><path d="M.494,2.583A.494.494,0,0,1,.039,1.9,3.111,3.111,0,0,1,4.112.246a.494.494,0,1,1-.385.909A2.123,2.123,0,0,0,.948,2.281.494.494,0,0,1,.494,2.583Z" transform="translate(0 0)" fill="#fff"></path></g></g></svg>
                                Показать результаты
                            </a>
                        </div>
                    <?endif;?>
                </div>
            </div>
            <div class="filter-row filter__hidden">
                <div class="filter-fields">
					<?if($filterData['kitchenspace'] && count($filterData['kitchenspace']) > 1):?>
					<?$downShow = true?>
                    <div class="filter__field filter-field">
                        <div class="filter-field__label">Площадь кухни, м<sup>2</sup></div>
                        <div class="ui-range">
                            <div class="ui-range__col"><span>от</span>
                                <input class="ui-range__val ui-range__from" name=">=PROPERTY_kitchenspace" value="<?=floor(min($filterData['kitchenspace']))?>">
                            </div>
                            <div class="ui-range__col"><span>до</span>
                                <input class="ui-range__val ui-range__to" name="<=PROPERTY_kitchenspace" value="<?=ceil(max($filterData['kitchenspace']))?>">
                            </div>
                            <div
                                class="ui-range__slider ui-range-kitchen"
                                data-min = "<?=floor(min($filterData['kitchenspace']))?>"
                                data-max = "<?=ceil(max($filterData['kitchenspace']))?>"
                                data-step = "1"
                            ></div>
                        </div>
                    </div>
					<?endif?>
                    <?if($filterData['builtyear'] && count($filterData['builtyear']) > 1):?>
                        <?$downShow = true?>
                        <div class="filter__field filter-field">
                            <div class="filter-field__label">Готовность до</div>
                            <select class="ui-select" name="PROPERTY_builtyear" data-placeholder="Любое" data-event-change="updateResult">
                                <option value="" class="active">Любое</option>
                                <?foreach ($filterData['builtyear'] as $key => $year):?>
                                    <option value="<?=$year?>"<?= $key === 0 ? ' class="active"' : '' ?> data-event="updateResult"><?=$year?></option>
                                <?endforeach;?>
                            </select>
                        </div>
                    <?endif;?>
                    <?/*
                    <div class="filter__field filter-field">
                        <div class="filter-field__label">Корпус</div>
                        <select class="ui-select" name="select_building" data-placeholder="2 корпус">
                            <option value="1 корпус">1 корпус</option>
                            <option class="active" value="2 корпус">2 корпус</option>
                            <option value="3 корпус">3 корпус</option>
                        </select>
                    </div>
                    */?>
                    <div class="filter__field filter-field-result">
                        <div class="btn btn--bg form-submit" data-event="getFilterApartment">
                            <img class="svg btn__ic lazyload" data-src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-search.svg" alt="phone" width="20" height="20">
                            Показать результаты
                            <!--Найдено <span class="filter-count">150 </span>квартир-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="filter-row filter__tech">
                <?if(count(array_filter($filterData['room'])) > 0):?>
                    <?if($downShow):?>
                        <button class="filter-additional" type="button" data-event="updateResult">Дополнительные параметры</button>
                    <?endif;?>
                    <button class="filter-reset" type="button" data-event="clearfilter">Сбросить фильтр</button>
                    <a class="btn btn--bg form-submit" href="#p-6">
                        <img class="svg btn__ic lazyload" data-src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-search.svg" alt="phone" width="20" height="20">
                        Показать результаты
                    </a>
                <?endif;?>
            </div>
        <?}?>
</form>
