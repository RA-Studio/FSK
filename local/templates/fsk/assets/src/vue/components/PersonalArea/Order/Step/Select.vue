<template>
    <div class="content">
        <div class="lk">
            <div class="auth-block-select">
                <div class="auth-block__img">
                    <img :src="`${$store.state.locationImg}/auth.jpg`" alt="">
                </div>
                <div class="auth-block-content">
                    <p class ="title-select"><b>100% оплата</b></p>
                    <p class = "text-description">
                        Выберете этот вариант, если планируете оплатить полную стоимость недвижемости в течении 5 рабочих дней 
                        с даты заключение договора без привлечения ипотечных кретитов или рассрочки, то есть за счет собственных средств.
                    </p>
                    <a class="auth-block-content__btn btn-new btn--bg" href="#" @click.prevent="setTypPay('full')">100% оплата</a>
                    <div class="delimeter"></div>
                    <p class ="title-select"><b>Покупка в ипотеку</b></p>
                    <p class = "text-description">Заполните кредитную анкету, а мы направим ее в крупнейшие банки и предложим вам наилучшие условия ипотечных кредитов, включая специальные ставки для наших клиентво</p>
                    <a class="auth-block-content__btn btn-new btn--bg" href="#" @click.prevent="setTypPay('mortgage')">К оформлению ипотеки</a>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Vue from 'vue';
    export default {
        data () {
          return {}
        },
        created() {},
        updated() {},
        components: {},
        computed: {},
        methods: {
            setTypPay(type = false){
                if(type === false) return false;
                this.$store.commit('setTypePay', type);
                this.$store.commit('setOrderTemplate');
            }
        },
    };
</script>
<style scoped>
    .auth-block-select {
        background: #FFFFFF;
        box-shadow: 0px 7px 20px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        max-width: 840px;
        height: 550px;
        margin: 40px auto 0;
        display: flex;
        flex-direction: row-reverse;
    }
    .auth-block-content {
        padding: 40px 40px;
    }
    .text-description {
        font-size: 10pt;
    }
    .auth-block-content__btn {
        width: 50%;
        height: 40px;
        line-height: 40px;
        background-color: #fff;
        border-color: #a19f9f54;
        color: black;
        border: 1px solid #a19f9f82;
    }
    .auth-block-content__btn:hover {
        background-color: #e94200;
        border-color: #e94200;
        color: #fff;
    }
    .title-select {
        margin-bottom: 10px;
    }
    .delimeter {
        border-bottom: 2px dotted #a19f9f54;
        margin: 40px 0px;
    }
</style>