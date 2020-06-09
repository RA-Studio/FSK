<?
$filterData['room'] = array_values(array_unique($filterData['room']));
$filterData['price'] = array_values(array_unique($filterData['price']));
$filterData['area'] = array_values(array_unique($filterData['area']));
$filterData['floor'] = array_values(array_unique($filterData['floor']));
$filterData['kitchenspace'] = array_filter(array_values(array_unique($filterData['kitchenspace'])));
$filterData['builtyear'] = array_values(array_unique($filterData['builtyear']));
?>
<div class="filter-preloader" style="display: none"></div>
<form class="filter">
    <input type="hidden" value="<?=$arParams['IBLOCK_ID']?>" name="IBLOCK_ID">
    <input type="hidden" value="<?=$arResult['VARIABLES']['SECTION_ID']?>" name="SECTION_ID">
    <div class="filter-row">
        <div class="filter-fields">
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
                    <div class="ui-checkbox">
                        <input class="ui-checkbox__input" id="room5" type="checkbox" name="PROPERTY_rooms" value="5" data-event-change="updateResult">
                        <label class="ui-checkbox__label" for="room5">5</label>
                    </div>
                </div>
            </div>
            <div class="filter__field filter-field">
                <div class="filter-field__label">Стоимость, млн/р.</div>
                <div class="ui-range">
                    <div class="ui-range__col"><span>от</span>
                        <input class="ui-range__val ui-range__from" name = ">=PROPERTY_price" value="<?=min($filterData['price'])?>">
                    </div>
                    <div class="ui-range__col"><span>до</span>
                        <input class="ui-range__val ui-range__to" name = "<=PROPERTY_price" value="<?=max($filterData['price'])?>">
                    </div>
                    <div
                        class="ui-range__slider ui-range-cost"
                        data-min = "<?=min($filterData['price'])?>"
                        data-max = "<?=max($filterData['price'])?>"
                        data-step = "1"
                    ></div>
                </div>
            </div>
            <div class="filter__field filter-field">
                <div class="filter-field__label">Площадь, м<sup>2</sup></div>
                <div class="ui-range">
                    <div class="ui-range__col"><span>от</span>
                        <input class="ui-range__val ui-range__from" name = ">=PROPERTY_area" value="<?=min($filterData['area'])?>">
                    </div>
                    <div class="ui-range__col"><span>до</span>
                        <input class="ui-range__val ui-range__to" name = "<=PROPERTY_area" value="<?=max($filterData['area'])?>">
                    </div>
                    <div
                        class="ui-range__slider ui-range-size"
                        data-min = "<?=min($filterData['area'])?>"
                        data-max = "<?=max($filterData['area'])?>"
                        data-step = "1"
                    ></div>
                </div>
            </div>
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
                        data-min = "<?=min($filterData['floor'])?>"
                        data-max = "<?=max($filterData['floor'])?>"
                        data-step = "1"
                    ></div>
                </div>
            </div>
        </div>
    </div>
    <div class="filter-row filter__hidden">
        <div class="filter-fields">
            <div class="filter__field filter-field">
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
            </div>
            <?if($filterData['builtyear'] && count($filterData['builtyear']) > 1):?>
                <div class="filter__field filter-field">
                    <div class="filter-field__label">Готовность до</div>
                    <select class="ui-select" name="PROPERTY_builtyear" data-placeholder="<?=$filterData['builtyear'][0]?>">
                        <?foreach ($filterData['builtyear'] as $key => $year):?>
                            <option value="<?=$year?>"<?= $key === 0 ? ' class="active"' : '' ?>><?=$year?></option>
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
                    <img class="svg btn__ic" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-search.svg" alt="phone" width="20" height="20">
                    Найдено <span class="filter-count">150 </span>квартир
                </div>
            </div>
        </div>
    </div>
    <div class="filter-row filter__tech">
        <button class="filter-additional" type="button" data-event="updateResult">Дополнительные параметры</button>
        <button class="filter-reset" type="button">Сбросить фильтр</button>

        <div class="btn btn--bg form-submit" data-event="getFilterApartment">
            <img class="svg btn__ic" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-search.svg" alt="phone" width="20" height="20">
            Показать результаты
        </div>

    </div>
</form>
