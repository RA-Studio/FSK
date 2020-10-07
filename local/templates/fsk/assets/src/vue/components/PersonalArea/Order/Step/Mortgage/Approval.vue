<template>
    <div class="content">
        <step-block></step-block>
        <div class="info">
          <div class="container">
            <h2 class="h1 title">Единая ипотечная анкета</h2>
            <div class="info-withside">
              <div class="info-withside-content">
                <div class="info-load-row">Скачайте единую ипотечную анкету в блоке с документами на этой странице. Также вам необходимо скачать бланки согласий банков, в которых вы хотите получить одобрения. Если вы не нашли согласие на обработку данных для одобрения в желаемом вами банке - свяжитесь с нашим ипотечным отделом по почте: ipo@fsknw.ru или телефону +7 (812) 703-55-55</div>
                <div class="info-load-row">После скачивания, заполните, распечатайте и подпишите анкету и согласия.</div>
                <div class="info-load-row">Последним шагом нужно сфотографировать или отсканировать все страницы анкеты и согласий, и загрузить в специальную область на данной странице.</div>
              </div>
              <div class="info-withside-side">
                <div class="info-withside-side-load many-row">
                    <a class="info-withside-side-load-row" :href="$store.getters.approvalLink.all" download>
                        <svg width="36" height="45" viewBox="0 0 56 76" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="54.875" y="1" width="73.3105" height="53.8755" rx="1" transform="rotate(90 54.875 1)" stroke="#E94200" stroke-width="2"/><path d="M12.5977 24.3848L43.2797 24.3848" stroke="#E94200" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M12.5977 35.5399L43.2797 35.54" stroke="#E94200" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M12.5977 46.6986L20.9655 46.6986" stroke="#E94200" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M12.5977 57.8573L20.9655 57.8573" stroke="#E94200" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M20.9687 13.2261L34.9151 13.2261" stroke="#E94200" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M37.7025 59.6429C33.6333 59.6429 30.3347 56.3442 30.3347 52.275C30.3347 48.2059 33.6333 44.9072 37.7025 44.9072C41.7716 44.9072 45.0703 48.2059 45.0703 52.275C45.0703 56.3442 41.7716 59.6429 37.7025 59.6429Z" stroke="#E94200" stroke-width="2"/></svg>
                        Единая ипотечная анкета - универсальная
                    </a>
                    <a class="info-withside-side-load-row" :href="$store.getters.approvalLink.sber" download>
                        <svg width="34" height="33" viewBox="0 0 34 33" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10.3512 18.2827L0.335938 12.5019C0.405035 11.8774 0.540691 11.2621 0.740596 10.6665L10.2645 16.1438L29.9772 4.84229L31.0322 6.28749L10.3512 18.2827Z" fill="#31971B"/><path d="M10.2594 20.4046L0.0272952 14.4504C-0.0090984 14.8301 -0.0090984 15.2124 0.0272952 15.5921C0.0272952 20.0804 1.81029 24.385 4.98404 27.5587C8.15779 30.7325 12.4623 32.5155 16.9507 32.5155C21.4391 32.5155 25.7436 30.7325 28.9173 27.5587C32.0911 24.385 33.8741 20.0804 33.8741 15.5921C33.8966 12.9164 33.2614 10.2762 32.0242 7.90356L10.2594 20.4046Z" fill="#31971B"/><path d="M28.6164 3.41754C28.125 2.92616 27.6192 2.56486 27.1712 2.14575L10.2622 11.8865L2.16908 7.23289C1.88004 7.72426 1.591 8.30234 1.31641 8.86597L10.2044 14.0109L28.6164 3.41754Z" fill="#31971B"/><path d="M25.4211 0.997194C24.7771 0.624621 24.1111 0.291606 23.4267 0L10.2608 7.6018L4.36437 4.33563C3.94526 4.76919 3.58395 5.26056 3.15039 5.78083L10.203 9.82742L25.4211 0.997194Z" fill="#31971B"/></svg>
                        Скачать согласие на обработку данных для Сбербанк
                    </a>
                    <a class="info-withside-side-load-row" :href="$store.getters.approvalLink.spb" download>
                        <svg width="28" height="50" viewBox="0 0 28 50" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M27.2011 18.6529C26.2801 21.2631 24.6058 23.5416 22.3899 25.2003C20.174 26.859 17.5161 27.8235 14.7521 27.9717C11.9882 28.1199 9.24232 27.4452 6.86178 26.033C4.48124 24.6207 2.5729 22.5343 1.37805 20.0376C0.183199 17.5408 -0.244505 14.7459 0.149017 12.0061C0.542539 9.26625 1.73961 6.70464 3.58889 4.64513C5.43816 2.58561 7.85658 1.12067 10.5384 0.435538C13.2202 -0.249597 16.0449 -0.124162 18.6554 0.795983C20.3895 1.40665 21.9863 2.35309 23.3545 3.58121C24.7226 4.80933 25.8353 6.29505 26.6289 7.95343C27.4226 9.61182 27.8816 11.4104 27.9798 13.2462C28.0779 15.0821 27.8133 16.9194 27.2011 18.6529Z" fill="url(#paint0_linear)"/><path d="M27.9959 36.7957V38.2151C27.9959 40.905 21.7511 43.1108 14.0166 43.1397C6.282 43.1687 0.0206917 41.0043 0 38.3144V36.9033L27.9959 36.7957Z" fill="url(#paint1_linear)"/><path d="M27.9959 36.7951C27.9959 39.4892 21.747 41.6949 14.0166 41.7197C6.28614 41.7445 0 39.5885 0 36.9027C0 34.2169 6.25304 32.0029 13.9876 31.9739C21.7222 31.945 27.9876 34.1052 27.9959 36.7951Z" fill="url(#paint2_linear)"/><path d="M0 47.6166C0 47.2235 6.26959 46.8345 14 46.8345C21.7304 46.8345 27.9959 47.2235 27.9959 47.6166V48.4443C27.9959 48.8333 21.7304 49.2223 14 49.2223C6.26959 49.2223 0 48.8498 0 48.4608V47.6166Z" fill="url(#paint3_linear)"/><defs><linearGradient id="paint0_linear" x1="10.5878" y1="18.5779" x2="31.8675" y2="-9.99361" gradientUnits="userSpaceOnUse"><stop stop-color="#DB1E33"/><stop offset="1" stop-color="#F57E21"/></linearGradient><linearGradient id="paint1_linear" x1="18.7398" y1="39.9151" x2="30.8112" y2="40.2322" gradientUnits="userSpaceOnUse"><stop stop-color="#A11C34"/><stop offset="1" stop-color="#C22034"/></linearGradient><linearGradient id="paint2_linear" x1="12.2404" y1="37.7234" x2="41.1805" y2="23.267" gradientUnits="userSpaceOnUse"><stop stop-color="#DB1E33"/><stop offset="0.87" stop-color="#F38523"/><stop offset="1" stop-color="#F79421"/></linearGradient><linearGradient id="paint3_linear" x1="-158929" y1="46.2448" x2="-159931" y2="515.426" gradientUnits="userSpaceOnUse"><stop stop-color="#A11C34"/><stop offset="1" stop-color="#C22034"/></linearGradient></defs></svg>
                        Скачать согласие на обработку данных для банк Санкт-Петербург
                    </a>
                    <a class="info-withside-side-load-row" :href="$store.getters.approvalLink.alfa" download>
                        <svg width="23" height="35" viewBox="0 0 23 35" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M22.073 34.9258H0.347036C0.300856 34.9253 0.255233 34.9157 0.212781 34.8975C0.17033 34.8793 0.131884 34.8529 0.0996487 34.8199C0.067413 34.7868 0.0420208 34.7477 0.0249273 34.7048C0.00783385 34.6619 -0.000624887 34.616 3.59366e-05 34.5698V30.6198C-0.000492354 30.5737 0.00806433 30.528 0.0252174 30.4852C0.0423704 30.4424 0.0677838 30.4034 0.100006 30.3705C0.132229 30.3375 0.170629 30.3112 0.213015 30.2931C0.255401 30.275 0.300941 30.2654 0.347036 30.2648H22.073C22.1657 30.2664 22.2539 30.3047 22.3184 30.3712C22.3829 30.4378 22.4184 30.5272 22.417 30.6198V34.5698C22.4178 34.6158 22.4096 34.6615 22.3927 34.7042C22.3758 34.747 22.3507 34.786 22.3188 34.8191C22.2868 34.8522 22.2487 34.8786 22.2065 34.8969C22.1644 34.9152 22.119 34.9251 22.073 34.9258ZM4.76704 23.4308C4.72593 23.4309 4.68519 23.4231 4.64704 23.4078C4.50504 23.3518 2.62304 22.6218 1.71804 22.2718L1.50004 22.1868L1.04404 22.0098C0.957802 21.9746 0.888677 21.9072 0.851335 21.8219C0.813994 21.7366 0.811375 21.6401 0.844036 21.5528C0.954036 21.2458 2.42004 17.2308 3.97304 12.9808L4.00004 12.9078V12.8908C5.61904 8.44884 7.30004 3.85484 7.45704 3.41184C8.07504 1.68784 8.87504 0.00384182 11.21 0.00384182C11.6849 -0.0195384 12.1589 0.0640207 12.5972 0.248351C13.0354 0.432682 13.4267 0.713078 13.742 1.06884C14.2864 1.76976 14.6991 2.56361 14.96 3.41184C15.26 4.21684 21.544 21.4378 21.586 21.5518C21.619 21.639 21.6165 21.7357 21.5791 21.8211C21.5417 21.9065 21.4724 21.9739 21.386 22.0088L19.6 22.7038L19.555 22.7208C18.724 23.0438 17.864 23.3778 17.776 23.4108C17.7393 23.4247 17.7003 23.4318 17.661 23.4318C17.5898 23.4315 17.5204 23.4094 17.4622 23.3684C17.4039 23.3275 17.3595 23.2697 17.335 23.2028C17.296 23.0978 16.814 21.7638 16.389 20.5878L16.38 20.5638C16.098 19.7838 15.849 19.0938 15.789 18.9278H6.64004L5.78104 21.2898L5.08104 23.2028C5.05665 23.2681 5.01339 23.3247 4.95675 23.3653C4.90012 23.4059 4.83269 23.4287 4.76304 23.4308H4.76704ZM11.196 5.53084L8.10004 14.8168H14.336L11.236 5.52684L11.196 5.53084Z" fill="#FF0404"/></svg>
                        Скачать согласие на обработку данных для Альфа Банк
                    </a>
                    <a class="info-withside-side-load-row" :href="$store.getters.approvalLink.open" download>
                        <svg width="31" height="31" viewBox="0 0 31 31" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0)"><path d="M15.348 0C12.3124 2.57737e-08 9.34492 0.900183 6.82091 2.58673C4.2969 4.27328 2.32971 6.67044 1.16811 9.47504C0.00651813 12.2796 -0.297308 15.3657 0.295061 18.343C0.887429 21.3203 2.34938 24.055 4.49604 26.2014C6.6427 28.3478 9.37764 29.8094 12.355 30.4013C15.3323 30.9933 18.4184 30.6891 21.2228 29.5271C24.0273 28.3652 26.4242 26.3977 28.1104 23.8734C29.7966 21.3492 30.6964 18.3816 30.696 15.346C30.6955 11.2758 29.0782 7.3725 26.2 4.49463C23.3217 1.61675 19.4182 -3.45575e-08 15.348 0ZM12.115 22.873C12.2789 22.9639 12.4217 23.0886 12.5339 23.2387C12.6461 23.3888 12.7252 23.561 12.766 23.744C12.8437 24.0969 12.7855 24.4661 12.603 24.778C12.4877 24.9654 12.3243 25.1184 12.1298 25.2211C11.9352 25.3238 11.7167 25.3725 11.497 25.362C11.2372 25.3607 10.9807 25.3034 10.745 25.194L10.027 24.854C8.46584 23.9971 7.16844 22.73 6.27491 21.1895C5.38137 19.6489 4.92567 17.8936 4.957 16.113V14.6C4.92355 12.8128 5.37956 11.0504 6.27568 9.50372C7.1718 7.95702 8.47388 6.68491 10.041 5.82501C10.075 5.82501 10.741 5.495 10.741 5.495C10.9741 5.38278 11.2293 5.32402 11.488 5.323C11.7087 5.31415 11.9279 5.36403 12.123 5.4675C12.3182 5.57097 12.4825 5.72433 12.599 5.91199C12.7815 6.22387 12.8397 6.59312 12.762 6.94601C12.7196 7.13277 12.6379 7.30833 12.5224 7.46109C12.4068 7.61385 12.2601 7.74029 12.092 7.832C11.1842 8.25756 10.4178 8.93497 9.88401 9.78363C9.35021 10.6323 9.07148 11.6165 9.081 12.619V18.062C9.07733 19.0657 9.36059 20.0496 9.89741 20.8977C10.4342 21.7458 11.2023 22.4228 12.111 22.849L12.115 22.873ZM25.74 16.113C25.7713 17.8936 25.3156 19.6489 24.4221 21.1895C23.5286 22.73 22.2312 23.9971 20.67 24.854L19.952 25.194C19.7163 25.3034 19.4598 25.3607 19.2 25.362C18.9781 25.3739 18.7571 25.326 18.5601 25.2233C18.363 25.1206 18.1972 24.9668 18.08 24.778C17.8975 24.4661 17.8393 24.0969 17.917 23.744C17.9567 23.5619 18.0342 23.3902 18.1447 23.2402C18.2551 23.0901 18.396 22.965 18.558 22.873C19.4668 22.4468 20.2348 21.7698 20.7716 20.9217C21.3084 20.0736 21.5917 19.0897 21.588 18.086V12.624C21.5974 11.6221 21.3191 10.6386 20.7863 9.79013C20.2535 8.94164 19.4885 8.26378 18.582 7.83701C18.414 7.74282 18.2681 7.61379 18.1541 7.45856C18.0401 7.30333 17.9606 7.1255 17.921 6.93701C17.8433 6.58411 17.9015 6.2149 18.084 5.90302C18.2005 5.71647 18.364 5.56383 18.5582 5.46045C18.7523 5.35707 18.9702 5.30656 19.19 5.314C19.4504 5.31444 19.7073 5.37321 19.942 5.48599L20.642 5.81601C22.2136 6.67331 23.5201 7.94512 24.4192 9.49313C25.3184 11.0412 25.7759 12.8061 25.742 14.596L25.74 16.113Z" fill="#09CCFF"/></g><defs><clipPath id="clip0"><rect width="30.695" height="30.695" fill="white"/></clipPath></defs></svg>
                        Скачать согласие на обработку данных для Открытие
                    </a>
                </div>
                  <slot v-for="(user, userKey) in users">
                      <components :is="`default-file`" :input="input" :inputKey="`${inputKey}${userKey}`" :key="`${inputKey}${userKey}`" v-for="(input, inputKey) in user.files" :multiple="true"></components>
                  </slot>
              </div>
            </div>
              <div class="info-contract__btn-wrap">
              <a class="info-contract__btn btn-new btn--bg" href="#" @click.prevent="sendFile()">Подать на рассмотрение</a>
              </div>
          </div>
        </div>
      </div>
</template>
<script>
    import Vue from 'vue';
    import DefaultFile from './../../../../defaultFile.vue';
    import axios from 'axios';
    import qs from 'qs';

    import StepBlock from './../Step.vue';

    export default {
        data () {
            return {
                users: {},
            }
        },
        created() {

            let usersIdentification = Object.keys(this.$store.getters.userInfo);
            let keyUser = usersIdentification[0];
            this.fileUserAdd(keyUser, this.$store.getters.userInfo[keyUser].data);
            console.log(this.users);
        },
        updated() {},
        components: {
            DefaultFile,
            StepBlock,
        },
        computed: {},
        methods: {
            fileUserAdd(iterator, info = {}) {
                this.$set(this.users, iterator, {
                    files: {
                        approval: { type: 'file', lable: `Подписанная анкета и согласие`, class: '', files: {} },
                    },
                });
            },
            collectBlockFile() {
                let formDataFile = new FormData();
                for(let userID in this.users) {
                    for(let fieldKey in this.users[userID].files) {
                        let file = this.users[userID].files[fieldKey].files;
                        for(let i in file) {
                            if (Object.keys(file).length > 0) formDataFile.append(`files[${userID}][${fieldKey}][${i}]`, file[i]);
                        }
                    }
                }
                return formDataFile;
            },
            checkFile() {
                let error = false;
                for(let userID in this.users) {
                    for(let fieldKey in this.users[userID].files) {
                        let file = this.users[userID].files[fieldKey].files;
                        if (Object.keys(file).length === 0) error = true;
                    }
                }
                return error;
            },
            sendFile() {
                if(this.checkFile()) {
                    this.$store.dispatch('addGlobalMessege', {  type: 'error', message: 'Для отправки нужно загрузить все файлы' });
                    return false;
                }
                this.$store.commit('setLoader', { status: true });
                let status = this.$store.getters.orderStatus + 1;
                let form = this.collectBlockFile();
                form.append('dir', 'order');
                form.append('saveInOrder', 'Y');
                form.append(`reserve`, this.$store.getters.reserve);
                form.append(`status`, status);
                axios.post('/ajax/?act=Order.SaveFileOrder', form, { headers: { 'Content-Type': 'multipart/form-data'}}).then(response => {
                    if(response.data.isSuccess) {
                        this.$store.dispatch('addGlobalMessege', {  type: 'ok', message: 'Ваши файлы успешно отправлены' });
                    } else {
                        this.$store.dispatch('addGlobalMessege', { type: 'error', message: response.data.message });
                    }
                }).catch(error =>  this.$store.commit('setLoader', { status: false }));
            },
        },
    };
</script>
