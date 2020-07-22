<template>
    <div class="content">
        <step-block></step-block>
        <div class="info">
          <div class="container">
            <h2 class="h1 title">Загрузка файла УКЭП</h2>
            <div class="info-withside">
              <div class="info-withside-content">
                <div class="info-load-row">Максимум в течение часа на этой странице появится бланк заявления на УКЭП, кроме того мы продублируем его вам на электронную почту. Его потребуется распечатать и подписать.</div>
                <div class="info-load-row">Подписанное заявление отсканируйте или сфотографируйте и загрузите в окно справа. </div>
                <div class="info-load-row">Оригинал заявления сохраните - его позднее нужно будет передать в офис застройщика. Менеджер предложит удобный вариант обмена документами. </div>
                <div class="info-load-row">С момента отправки заявления УКЭП формируется от нескольких минут до 24 часов. Мы сообщим о готовности в том числе по SMS.</div>
              </div>
              <div class="info-withside-side">
                <div class="info-withside-side-load" v-if="filesLoad.length === 0">
                    <svg width="56" height="76" viewBox="0 0 56 76" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="54.875" y="1" width="73.3105" height="53.8755" rx="1" transform="rotate(90 54.875 1)" stroke="#E94200" stroke-width="2"></rect><path d="M12.5977 24.3848L43.2797 24.3848" stroke="#E94200" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M12.5977 35.5399L43.2797 35.54" stroke="#E94200" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M12.5977 46.6986L20.9655 46.6986" stroke="#E94200" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M12.5977 57.8573L20.9655 57.8573" stroke="#E94200" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M20.9687 13.2261L34.9151 13.2261" stroke="#E94200" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M37.7025 59.6429C33.6333 59.6429 30.3347 56.3442 30.3347 52.275C30.3347 48.2059 33.6333 44.9072 37.7025 44.9072C41.7716 44.9072 45.0703 48.2059 45.0703 52.275C45.0703 56.3442 41.7716 59.6429 37.7025 59.6429Z" stroke="#E94200" stroke-width="2"></path></svg>
                    Ваш УКЭП скоро будет доступен для скачивания. Ожидайте...
                </div>
                <div class="info-withside-side-download" v-if="filesLoad.length > 0" v-for="(link, index) in filesLoad">
                    <span>
                        УКЭП
                        <a :href="link" download="">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.5 10.3984L9.252 13.1504L12 10.3984" stroke="#E94200" stroke-width="1.3" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path><path d="M9.24219 5V12.826" stroke="#E94200" stroke-width="1.3" stroke-linecap="round"></path><circle cx="9" cy="9" r="8.35" transform="rotate(90 9 9)" stroke="#E94200" stroke-width="1.3"></circle></svg>
                            Скачать {{$store.getters.getFileNameByUrl(link)}}
                        </a>
                    </span>
                </div>
                <slot v-for="(user, userKey) in users">
                    <components :is="`default-file`" :input="input" :inputKey="`${inputKey}${userKey}`" :key="`${inputKey}${userKey}`" v-for="(input, inputKey) in user.files" :multiple="false"></components>
                </slot>
              </div>
            </div>
              <div class="info-contract__btn-wrap" v-if="sendOpen">
                <a class="info-contract__btn btn-new btn--bg" href="#" @click.prevent="sendFile()">Оформить УКЭП</a>
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
    import StepBlock from './../Step.vue'
    export default {
        data () {
            return {
                users: {},
                filesLoad: [],
                filesLoadType: 'выпусксертификатаукэп',
                sendOpen: false,
            }
        },
        created() {
            if(this.$store.getters.file1C) {
                for(let i in this.$store.getters.file1C[this.filesLoadType]) {
                    this.filesLoad.push(this.$store.getters.file1C[this.filesLoadType][i]);
                }
            }

            this.time = setInterval(() => {
                this.filesLoad = [];
                if(this.$store.getters.file1C) {
                    for(let i in this.$store.getters.file1C[this.filesLoadType]) {
                        this.filesLoad.push(this.$store.getters.file1C[this.filesLoadType][i]);
                    }
                }
            }, 5000);

            let usersIdentification = Object.keys(this.$store.getters.userInfo);
            usersIdentification.forEach((keyUser) => this.fileUserAdd(keyUser, this.$store.getters.userInfo[keyUser].data));
        },
        watch: {
            filesLoad: function (val) {
                this.sendOpen = val.length > 0;
            },
        },
        updated() {},
        components: {
            DefaultFile,
            StepBlock,
        },
        computed: {},
        methods: {
            fileUserAdd(iterator, info) {
                if(!iterator) return false;
                let lastName = info.lastName ? info.lastName.value : '';
                let firstName = info.firstName ? info.firstName.value : '';
                let middleName = info.middleName ? info.middleName.value : '';

                let nameFromFile = `${lastName} ${firstName[0]}.${middleName ? ` ${middleName[0]}.` : ''}`;

                this.$set(this.users, iterator, {
                    files: {
                        ukepStatement: { type: 'file', lable: `Скан заявления на УКЭП (${nameFromFile})`, class: '', files: {} },
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
                let form = this.collectBlockFile();
                let status = 6;
                form.append('dir', 'order');
                form.append('saveInOrder', 'Y');
                form.append(`reserve`, this.$store.getters.reserve);
                form.append(`status`, status);
                axios.post('/ajax/?act=Order.SaveFileOrder', form, { headers: { 'Content-Type': 'multipart/form-data'}}).then(response => {
                    this.$store.commit('setLoader', { status: false });
                    if(response.data.isSuccess) {
                        this.$store.dispatch('addGlobalMessege', {  type: 'ok', message: 'Ваши файлы успешно отправлены' });
                        if (status !== undefined) this.$store.commit('newStep', status);
                    } else {
                        this.$store.dispatch('addGlobalMessege', { type: 'error', message: response.data.message });
                    }
                }).catch(error => this.$store.commit('setLoader', { status: false }));
            },
        },
    };
</script>
