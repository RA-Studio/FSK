<template>
    <div>
        <!--div style="height: 2000px;" v-if="longBlock"></div>
        <div class="content">
            <div class="auth">
                <div class="black-sheet"></div>

                <div class="auth-block">
                    <div class="close-btm" data-closed-modal>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22.001 22L2.00098 2" stroke="#BEBEBE" stroke-width="1.5" stroke-linecap="round"/>
                            <path d="M2 22L22 2" stroke="#BEBEBE" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <div class="auth-block__img">
                        <img src="/local/templates/fsk/assets/src/images/auth.jpg" alt="">
                    </div>
                    <div>
                        <div class="auth-block-content" id = "authBySms">
                            <h2 class="h1 title">Вход в личный кабинет</h2>
                            <div class="auth-block-content-input">
                                <label for="">Телефон</label>
                                <input type="text" name='phone'>
                            </div>
                            <div class="auth-block-content-input none">
                                <label for="">Код подтверждения</label>
                                <input type="text" name='sms'>
                                <div class="confirm-code-repeat">
                                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="12.5" cy="12.5" r="12.5" fill="#E94200"></circle><g clip-path="url(#clip0)"><path d="M12.9165 6.70924V4.1665L9.28398 7.79898L12.9165 11.4315V8.16223C15.3139 8.16223 17.2754 10.1238 17.2754 12.5212C17.2754 14.9186 15.3139 16.8802 12.9165 16.8802C10.519 16.8802 8.55748 14.9186 8.55748 12.5212H7.10449C7.10449 15.7178 9.71988 18.3332 12.9165 18.3332C16.113 18.3332 18.7284 15.7178 18.7284 12.5212C18.7284 9.32462 16.113 6.70924 12.9165 6.70924Z" fill="white"></path></g><defs><clipPath id="clip0"><rect width="14.1667" height="14.1667" fill="white" transform="translate(5.8335 4.1665)"></rect></clipPath></defs></svg>
                                </div>
                            </div>
                            <a class="auth-block-content__btn btn-new btn--bg" href="#" data-send-sms>Получить пароль по смс</a>
                            <a class="auth-block-content__btn btn-new btn--bg none" href="#" data-send>Войти в кабинет</a>
                        </div>
                    </div>
                </div>
            </div>
        </div-->

        <div style="height: 2000px;" v-if="longBlock"></div>
        <div class="content">
            <div class="auth">
                <div class="black-sheet"></div>
                <div class="auth-block">
                    <a class="close-btm" href="/">
                        <svg id="Capa_1" enable-background="new 0 0 512.001 512.001" height="512" viewBox="0 0 512.001 512.001" width="512" xmlns="http://www.w3.org/2000/svg"><g><path d="m512.001 84.853-84.853-84.853-171.147 171.147-171.148-171.147-84.853 84.853 171.148 171.147-171.148 171.148 84.853 84.853 171.148-171.147 171.147 171.147 84.853-84.853-171.148-171.148z"/></g></svg>
                    </a>
                    <div class = "auth-block-in">
                        <div class ="tab-line">
                            <span :class="{active: tab.active}" @click="tabActive(keyTab)" v-for="(tab, keyTab) in tabs" v-html="tab.name"></span>
                        </div>

                        <div class="auth-block-content" v-for="(tab, keyTab) in tabs" v-if="tab.active">
                            <div class="auth-block-content-input" v-for="(input, key) in tab.inputs">
                                <label :for="key" v-html="input.label"></label>
                                <input :type="input.type" :name="key" :id="key" v-model="input.value" v-imask="input.mask">
                            </div>
                            <a class="auth-block-content__btn btn-new btn--bg" href="#" v-html="tab.btm" @click="sendData(keyTab)"></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</template>
<script>
    import Vue from 'vue';
    import axios from 'axios';
    import qs from 'qs';

    import mask from './../../JSModules/mask.js';
    import {IMaskDirective} from 'vue-imask';

    export default {
        data () {
            let obj = {
                longBlock: false,
                input: {
                    phone: {
                        value: '',
                        type: 'text',
                        label: 'Телефон',
                        mask: mask.phone,
                    },
                    fio: {
                        value: '',
                        type: 'text',
                        label: 'ФИО',
                        mask: mask.rusCharsAll,
                    },
                    password: {
                        value: '',
                        type: 'password',
                        label: 'Пароль',
                        mask: '',
                    },
                    'password_hange': {
                        value: '',
                        type: 'password',
                        label: 'Подтвердить пароль',
                        mask: '',
                    },
                },
            };
            obj.tabs = {
                auth: {
                    active: true,
                    btm: 'Войти в кабинет',
                    name: 'Вход',
                    inputs: {
                        phone: obj.input.phone,
                        password: obj.input.password,
                    },
                },
                register: {
                    active: false,
                    btm: 'Регистрация',
                    name: 'Регистрация',
                    inputs: {
                        fio: obj.input.fio,
                        phone: obj.input.phone,
                        password: obj.input.password,
                        'password_hange': obj.input['password_hange'],
                    },
                },
            };
            return obj;
        },
        directives: {
            imask: IMaskDirective,
        },
        created() {
            if(document.location.pathname == '/lk/auth/') {
                this.longBlock = true;
                document.querySelector('body').style.overflow = 'hidden';
            }
        },
        destroyed() {},
        updated() {},
        components: {},
        computed: {},
        methods: {
            tabActive(str = '') {
                for(let tabKey in this.tabs) {
                    this.$set(this.tabs[tabKey], 'active', false);
                }
                if(this.tabs[str].active !== undefined) this.$set(this.tabs[str], 'active', true);
            },
            sendData(str = false) {
                if(str === false) return false;
                let link = false;

                switch (str) {
                    case "register":
                        link = '/ajax/?act=User.RegisterUser';
                    break;
                    case "auth":
                        link = '/ajax/?act=User.LoginUser';
                    break;
                }

                let send = {};
                let tab = this.tabs[str];
                for(let inputKey in tab.inputs) {
                    let input = tab.inputs[inputKey];
                    send[inputKey] = input.value;
                }

                axios.post(link, qs.stringify(send)).then(response => {
                    if(response.data.isSuccess) {
                        let lastPath = localStorage.getItem('lastPath');
                        history.pushState(null, null, lastPath ? lastPath : '/lk/');
                        this.$store.dispatch('addGlobalMessege', { type: 'ok', message: response.data.message });
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    } else {
                        this.$store.dispatch('addGlobalMessege', {
                            type: 'error',
                            message: response.data.message,
                        });
                    }
                }).catch(error => console.log(error));
            }
        },
    };
</script>
<style scoped>
</style>
