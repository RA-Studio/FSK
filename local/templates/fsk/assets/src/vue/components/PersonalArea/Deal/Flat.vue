<template>
    <div class="card__body js-tab-wrapper">
        <div class="card__col-1">
            <div class="card__tabs-wrap">
                <div class="card__tabs">
                    <button
                        class="js-tab-new"
                        :class="{'js-tab--active':tab.active}"
                        type="button"
                        v-for="(tab, id) in tabs" v-html="tab.tabName"
                        @click="activateTab(id)"
                    ></button>
                </div>
            </div>
            <div class="tooltip">
                <div class="tooltip__icon"></div>
                <div class="tooltip__hidden">
                    Информация на данном сайте, и в частности, на текущей странице не является офертой и
                    размещена для ознакомления. Данная планировка не является технической документацией
                    представлена для ознакомления.
                </div>
            </div>
        </div>
        <div class="card__col-2">
            <div class="card__img js-tab-item" v-for="(tab, id) in tabs" v-if="tab.active">
                <img class="img" alt="plan" :src="tab.minImg">
            </div>
            <div class="card__img js-tab-item">
                <div class="card-img-btns" v-if="">
                    <button class="ui-btn zoom-link" href="/upload/iblock/92e/92e5f2099302ca91658b2f8725326dc4.png">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17.121 17.121" class="svg lazyload inlined-svg" data-src="/local/templates/fsk/img/icons/ic-zoom.svg" width="15" height="15" role="img" aria-labelledby="title"><title>zoom</title><g transform="translate(1.061 1.061)"><path d="M0,0H5V5" transform="translate(10)" fill="#fff" stroke="#727272" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"></path><path d="M5,5H0V0" transform="translate(0 10)" fill="#fff" stroke="#727272" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"></path><path d="M5.833,0,0,5.833" transform="translate(9.167)" fill="#fff" stroke="#727272" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"></path><path d="M0,5.833,5.833,0" transform="translate(0 9.167)" fill="#fff" stroke="#727272" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"></path></g></svg>
                    </button>
                    <div class="interactive-btn interactive-favorite" href="#" data-role="favorite" data-id="472">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22.712 21.673" class="svg lazyload inlined-svg" data-src="/local/templates/fsk/img/icons/ic-star.svg" role="img" aria-labelledby="title"><title>Добавить в закладки</title><path d="M10.606,0l3.277,6.64,7.329,1.071-5.3,5.165,1.252,7.3-6.555-3.447L4.052,20.173l1.252-7.3L0,7.711,7.329,6.64,10.606,0Z" transform="translate(0.75 0.75)" fill="none" stroke="#e94200" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"></path></svg>
                    </div>
                </div>
                <img class="img lazyload" data-src="/upload/iblock/92e/92e5f2099302ca91658b2f8725326dc4.png" alt="plan">
            </div>
        </div>
        <div class="card__col-3">
            <div class="card__info">
                <div class="interactive-btns"></div>
                <div class="card-data">
                    <div class="card-data__col-1">
                        <div class="h3 card-data__title" v-if="apartment.apartments !== 'true'">{{ convert(apartment.name) }} м<sup>2</sup></div>
                        <div class="h3 card-data__title" v-if="apartment.apartments === 'true'">Лот {{convert(apartment.area)}} м<sup>2</sup></div>
                        <ul class="card-data__list">
                            <li v-if="apartment.area"><span>Общая площадь</span><span>{{apartment.area}} м<sup>2</sup></span></li>
                            <li v-if="apartment.livingSpace"><span>Жилая площадь</span><span>{{apartment.livingSpace}} м<sup>2</sup></span></li>
                            <li v-if="apartment.kitchenSpace"><span>Площадь кухни</span><span>{{apartment.kitchenSpace}}</span></li>
                            <li v-if="apartment.floor"><span>Этаж / этажей</span><span>{{`${apartment.floor}/${apartment.floorsTotal}`}}</span></li>
                            <li v-if="apartment.renovation"><span>Отделка</span><span>{{apartment.renovation}}</span></li>
                        </ul>
                    </div>
                    <div class="card-data__col-1">
                        <ul class="card-data__list">
                            <li><span>Бронирование</span><span>№{{order.order}}</span></li>
                            <li>
                                <span>Оплата</span>
                                <span>
                                    <svg v-if="order.status > 1" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="7" cy="7" r="7" fill="#A3C904"/><path d="M10.6861 4.39622C10.5754 4.27808 10.3959 4.27808 10.2852 4.39622L6.09708 8.96206L4.79157 7.56909C4.68086 7.45096 4.50138 7.45097 4.39065 7.56909C4.27994 7.68721 4.27994 7.87872 4.39065 7.99685L5.89662 9.60367C6.0073 9.72179 6.18691 9.72171 6.29754 9.60367L10.6861 4.82399C10.7968 4.70587 10.7968 4.51435 10.6861 4.39622Z" fill="white" stroke="white" stroke-width="0.5"/></svg>
                                    {{order.price}}
                                </span>
                            </li>
                            <li v-if="order.create"><span>Дата брони</span><span>{{order.create}}</span></li>
                            <li v-if="order.reserveDate"><span>Резерв до</span><span>{{order.reserveDate}}</span></li>
                        </ul>
                    </div>
                    <div class="card-data__col-2">
                        <p class="card-price-1">Цена по акции: <span>{{numberWithCommas(this.price)}}</span></p>
                        <span class="card-id">Стандартная цена: {{numberWithCommas(apartment.price)}}</span><br>
                        <span class="card-id">ID квартиры: {{apartment.number}}</span>
                        <div class="card-btn">
                            <a href="#modal-FORM10" @click.prevent="setOrderMode()" class="popup-btn-FORM10 btn btn--bg js-call-callback" type="button">Продолжить оформление</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Vue from 'vue';
    import FlatBlock from './Flat.vue';
    export default {
        props: ['order'],
        data () {
          return {
              apartment: this.order.apartment,
              tabs: {},
              listTabs: {
                  plan: 'Планировка',
                  floor_plan: 'На этаже',
                  section: 'Схема корпусов',
                  decoration: 'Отделка',
              },
              price:0,
          }
        },
        created() {},
        mounted(){
            /*if ((this.apartment.apartments === "false") && (this.apartment.category === "storeroom" || this.apartment.category === "flat")){
              this.apartment.price100 = Math.round(this.apartment.price100*0.99);
            }*/
          let price = 0;
          if (this.apartment.category === "flat"){
            if (this.apartment.priceOnline100 != ''){
              this.price = this.apartment.priceOnline100;
            }else{
              this.price = Math.round(this.apartment.price100*0.99);
            }
          }else{
            this.price = this.apartment.price100;
          }
            let index = 0;
            for(let i in this.apartment.image.big) {
                let bigImg = this.apartment.image.big[i];
                let minImg = this.apartment.image.min[i];
                this.$set(this.tabs, i, {
                    tabName: this.listTabs[i],
                    bigImg,
                    minImg,
                    active: index === 0,
                });
                index++;
            }

        },
        updated() {},
        components: {},
        computed: {},
        methods: {
            setOrderMode() {
                this.$emit('setOrderMode');
            },
            activateTab(id) {
                for(let i in this.tabs) {
                    this.$set(this.tabs[i], 'active', i === id);
                }
            },
            numberWithCommas(x) {
              return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ")+' р.';
            },
            convert(str) {
              return str.replace(/&quot;/g,'"')
                  .replace(/&gt;/g,'>')
                  .replace(/&lt;/g,'<')
                  .replace(/&amp;/g,'&');
            }
        },
    };
</script>
<style scoped>
    a.popup-btn-FORM10.btn.btn--bg.js-call-callback {
        width: 100%;
    }
    .card__img {
        padding: 0px;
    }
    p.card-price-1 {
        font-size: 18px;
        margin-bottom: 0px;
    }
    @media screen and (max-width: 1199px) {
        .card__tabs .js-tab-new {
            height: 50px;
            margin-right: 25px;
        }
    }
    .card__tabs .js-tab-new {
        position: relative;
        height: 80px;
        font-weight: 300;
        white-space: nowrap;
        -webkit-box-shadow: none;
        box-shadow: none;
        -webkit-transition: all 0.1s linear;
        -o-transition: all 0.1s linear;
        transition: all 0.1s linear;
    }
    .card__tabs .js-tab-new::after {
        content: "";
        display: block;
        width: 100%;
        height: 3px;
        position: absolute;
        left: 0;
        bottom: 0;
        background: transparent;
        -webkit-transition: all 0.1s linear;
        -o-transition: all 0.1s linear;
        transition: all 0.1s linear;
    }
    .card__tabs .js-tab--active {
        color: var(--sub-text-color);
    }
    .card__tabs .js-tab--active::after {
        background: var(--accent-color);
    }
		.card__body{
			background: none;
			padding: 0;
			border: 1px solid #E5E8E8;
			box-sizing: border-box;
			border-radius: 3px;
			height: 640px;
		}
		.card__body + .card__body{
			margin-top: 40px;
		}
		.card__info::after{
			height: 100%;
    	top: 0px;
		}
		.card-data__title,
		.card-price-1{
			font-weight: 400
		}
</style>
