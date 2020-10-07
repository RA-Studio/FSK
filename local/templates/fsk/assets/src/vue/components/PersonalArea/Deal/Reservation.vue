<template>
    <div class="container">
        <div>
            <h2 class="h1 title" v-html="title"></h2>
            <div>
                <table-block :titles="titles" :list="list"></table-block>
            </div>
        </div>
        <div class="lk-deals__text" v-html="text"></div>
    </div>
</template>
<script>
    import Vue from 'vue';
    import TableBlock from './Table.vue';
    export default {
        props: {
            list: Object,
        },
        data () {
          return {
            title: 'Мое бронирование',
            text: `На данный момент вы забронировали квартиру. Для продолжения сделки вы можете использовать функцию онлайн-покупки. Нажмите “Продолжить оформление” - на следующем экране будет пошаговая инструкция. По любым вопросам вам поможет индивидуальный менеджер.`,
            titles: {
                0: { value: "Бронирование", type: "default", field: "order" },
                1: { value: "Объект", type: "default", field: "apartmentName" },
                2: { value: "ID объекта", type: "link", field: "apartmentLink", html: "apartmentNum" },
                3: { value: "Дата", type: "default", field: "create" },
                4: { value: "Оплата", type: "price", field: "price", postfix: ' р.' },
                5: { value: "Резерв до", type: "default", field: "reserveDate" },
                6: { value: "Онлайн покупка", type: "detail" },
            },
          }
        },
        created() {},
        updated() {},
        components: {
            TableBlock,
        },
        computed: {},
        methods: {},
    };
</script>
