<template>
    <div class="lk-wrap">
        <div class="preloader" v-if="$store.state.loader">
            <div class="pl">
                <div class="pl__ball"></div>
                <div class="pl__ball pl__ball--2"></div>
            </div>
        </div>
        <components :is="page"></components>
    </div>
</template>
<script>
    import Vue from 'vue'
    import axios from 'axios';
    import qs from 'qs';

    import LkBlock from './PersonalArea/Main.vue';
    import BasketBlock from './PersonalArea/Basket.vue';
    import DetailsBlock from './PersonalArea/Details.vue';
    import FaqBlock from './PersonalArea/Faq.vue';
    import AuthBlock from './PersonalArea/Authorize.vue';

    export default {
        data () {
            return {
                page: 'lk-block',
                setCheckAuthorizeIntervalID: false,
            }
        },
        created() {
            this.isAuthorize();
            window.addEventListener("popstate", () => this.setUrl(), false);
        },
        updated() {},
        components: {
            LkBlock,
            BasketBlock,
            DetailsBlock,
            FaqBlock,
            AuthBlock,
        },
        computed: {},
        methods: {
            isAuthorize() {
                axios.post('/ajax/?act=User.IsAuthorize', qs.stringify({})).then(response => {
                    if(response.data.isSuccess) {
                        this.setUrl();
                    } else {
                        this.setUrl('auth');
                        localStorage.setItem('lastPath', document.location.pathname);
                        history.pushState(null, null, '/lk/auth/');
                        history.pushState(null, null, '/lk/auth/');
                        history.back();
                        clearInterval(this.setCheckAuthorizeIntervalID);
                    }
                }).catch(error => console.log(error));
            },
            setCheckAuthorize() {
                this.setCheckAuthorizeIntervalID = setInterval(() => this.isAuthorize(), 1000);//(minuts * 60) * 1000)
            },
            getUrlParams() {
                let query = {};
                const vars = window.location.search.substring(1).split("&");
                if(vars[0] === '') return false;
                vars.forEach((item) => {
                    let [key, value] = [...(item.split("="))];
                    value = decodeURIComponent(value);
                    if(typeof query[key] === "string") query[key] = [query[key]];
                    if(typeof query[key] === "undefined") {
                        query[key] = value
                    } else {
                        query[key].push(value)
                    }
                });
                return query;
            },
            setOrderDataByOrder(orderID) {
                axios.post('/ajax/?act=Order.GetByID', qs.stringify({ orderID })).then(response => {
                    if(response.data.isSuccess) {
                        this.$store.commit('setOrderMode', response.data.result);
                    } else {
                        this.$store.dispatch('addGlobalMessege', { type: 'error', message: response.data.message });
                    }
                }).catch(error => console.log(error));
            },
            setUrl(url = false) {
                if(this.setCheckAuthorizeIntervalID === false) this.setCheckAuthorize();
                let page = url ? url : document.location.pathname.split('/').filter(word => word.length > 0).pop();
                let pageParams = this.getUrlParams();
                if(pageParams.order === undefined) {
                    this.$store.commit('updateOrderDataClear');
                    this.$store.commit('clearOrderData');
                } else if (pageParams.order !== undefined && this.$store.state.updateOrderData === false) {
                    this.setOrderDataByOrder(pageParams.order);
                    let updateOrderData = setInterval(() => {
                        this.setOrderDataByOrder(pageParams.order);
                    }, 6000);
                    this.$store.commit('updateOrderDataSet', updateOrderData);
                }
                this.$set(this, 'page', `${page}-block`);
            }
        },
    };
</script>
<style scoped>
    .preloader {
        display: flex !important;
        background-color: #f6f8fa70;
    }
</style>
