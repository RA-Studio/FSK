<template>
    <div>
        <div style="height: 2000px;" v-if="longBlock"></div>
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
                                <input type="text" name='phone' ref='phone' v-imask="mask.phone" v-model="phone">
                            </div>
                            <div class="auth-block-content-input" :class="{'none' : enterPhone === false}">
                                <label for="">Код подтверждения</label>
                                <input type="text" name='sms' v-modal="code">
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
        </div>
    </div>
</template>
<script>
    import Vue from 'vue'
    import axios from 'axios';
    import qs from 'qs';

    import mask from './../../JSModules/mask.js';
    import {IMaskDirective} from 'vue-imask';

    export default {
        data () {
            return {
                enterPhone: false,
                phone: '',
                code: '',
            }
        },
        directives: {
            imask: IMaskDirective,
        },
        methods: {
            actionSendSMS() {
                if(this.phone && this.phone.length === 18) {
                    let send = {
                        phone: this.phone,
                    };
                    axios.post('/ajax/?act=User.SendSMSCheck', qs.stringify(send)).then(response => {

                    });
                } else {
                    this.$store.dispatch('addGlobalMessege', {
                        type: 'error',
                        message: 'Не верно введен телефон',
                    });
                }
            }
        }
    }
</script>