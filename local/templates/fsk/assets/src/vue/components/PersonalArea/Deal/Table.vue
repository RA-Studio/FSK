<template>
    <div>
        <flat-block 
            v-for="(item, key) in list" 
            :key="key" :order="item" 
            @setOrderMode="setOrderMode(item)"
        ></flat-block>

        <div v-if="false" class="lk-deals-row header-row">
            <div class="lk-deals-row-col" v-for="(title, keyT) in titles" v-html="title.value"></div>
        </div>
        <div v-if="false" class="lk-deals-row" v-for="(item, key) in list">
            <div class="lk-deals-row-col" v-for="(title, keyT) in titles">
                <div v-if="title.type != 'detail'" class="lk-deals-row-col__title" v-html="title.value"></div>
                <span v-if="title.type == 'default'" v-html="item[title.field]"></span>
                <a v-else-if="title.type == 'link'" class="lk-deals-row-col__id" :href="item[title.field]"><span v-html="item[title.html]"></span></a>
                <div v-else-if="title.type == 'price'" class="lk-deals-row-col__payment" :class="{'success': item.status > 1}" v-html="title.postfix ? `${item[title.field]}${title.postfix}` : item[title.field]"></div>
                <a v-else-if="title.type == 'detail' && item.status > 1" class="lk-deals-row-col__btn btn-new btn--bg" :href="`#${item.order}`" @click.prevent="setOrderMode(item)">Продолжить оформление</a>
                <a v-else-if="title.type == 'detail' && item.status < 2" class="lk-deals-row-col__btn btn-new btn--bg" href="#" @click.prevent="setOrderMode(item)">Оплатить</a>
            </div>
        </div>

    </div>
</template>
<script>
    import Vue from 'vue';
    import FlatBlock from './Flat.vue';
    export default {
        props: ['titles','list'],
        data () {
          return {}
        },
        created() {},
        updated() {},
        components: {
            FlatBlock
        },
        computed: {},
        methods: {
            setOrderMode(order) {
                this.$store.commit('setOrderMode', order);
                var baseUrl = window.location.pathname;
                var newUrl = baseUrl + `?order=${order.order}`;
                history.pushState(null, null, newUrl);
            },
        },
    };
</script>
<style scoped>
    .btn--bg {
        color: #fff;
    }
</style>
