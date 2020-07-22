<template>
    <div class="content">

        <div class="float-block-loader" v-if="this.filesAnketa.length">
            <div class="block-loader-content">

                <div v-for="(block, index) in this.filesAnketa">
                    <div class="progress-box">
                        <p>
                            <slot v-if="block.outNameUser">Пользователь: <b>{{`${users[block.userID].data.lastName.value} ${users[block.userID].data.firstName.value} ${users[block.userID].data.middleName.value}`}}</b><br></slot>
                            Файлы: <b>{{`${users[block.userID].data[block.fieldKey].lable}`}}</b>
                        </p>
                        <div class="progress-container">
                            <span class="percent">{{block.loadProgress}}%</span>
                            <div class="progress-line" :style="{
                                width: `${block.loadProgress}%`,
                            }"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="lk">
            <div class="container" v-if="this.$store.state.order.data.comment">
                <div class="info-block">
                    <svg width="52" height="46" viewBox="0 0 52 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.68344 45.8516C4.88617 45.8516 4.11735 45.6931 3.39828 45.3793C2.71578 45.0807 2.10946 44.6582 1.59555 44.123C1.0918 43.5989 0.696721 42.9916 0.421487 42.3202C0.14219 41.6377 0.00101822 40.9217 2.59104e-06 40.1905C-0.00101303 39.1515 0.296565 38.1257 0.861253 37.2218L21.1616 2.83273L21.1758 2.80938C21.7029 1.96844 22.4392 1.27984 23.3055 0.817734C24.1272 0.38 25.0534 0.148438 25.9848 0.148438H26H26.0152C26.9466 0.148438 27.8728 0.38 28.6945 0.817734C29.5608 1.27984 30.2971 1.96844 30.8242 2.80938L30.8384 2.83273L43.7836 24.7621V24.7631C43.9217 24.9967 43.9603 25.2699 43.8923 25.532C43.8242 25.795 43.6587 26.0154 43.4251 26.1535C43.2687 26.2459 43.0909 26.2947 42.9102 26.2947C42.5516 26.2947 42.2165 26.1027 42.0347 25.795L29.0997 3.88289C28.4192 2.80531 27.2888 2.18477 26 2.17969C24.7142 2.18477 23.5859 2.80328 22.9044 3.87578L2.60305 38.2669L2.58883 38.2902C2.22016 38.8803 2.03227 39.5191 2.03125 40.1905C2.03024 41.1157 2.405 42.0359 3.05907 42.7143C3.75782 43.4354 4.66883 43.8183 5.69258 43.8203H46.3074C47.3312 43.8183 48.2412 43.4354 48.9399 42.7143C49.595 42.0359 49.9698 41.1157 49.9688 40.1905C49.9677 39.5202 49.7798 38.8803 49.4102 38.2902L49.397 38.2669L46.6812 33.6661C46.543 33.4325 46.5045 33.1593 46.5725 32.8963C46.6395 32.6342 46.8061 32.4128 47.0397 32.2757C47.1961 32.1833 47.3738 32.1345 47.5546 32.1345C47.9131 32.1345 48.2483 32.3255 48.4301 32.6332L51.1408 37.2259C51.7045 38.1277 52.001 39.1525 52 40.1905C51.999 40.9217 51.8578 41.6377 51.5785 42.3202C51.3033 42.9916 50.9082 43.5989 50.4034 44.123C49.8905 44.6582 49.2842 45.0807 48.6017 45.3793C47.8827 45.6921 47.1138 45.8516 46.3166 45.8516H5.68344Z" fill="black"></path>
                        <path d="M26 36.6094C24.32 36.6094 22.9531 35.2425 22.9531 33.5625C22.9531 31.8825 24.32 30.5156 26 30.5156C27.68 30.5156 29.0469 31.8825 29.0469 33.5625C29.0469 35.2425 27.68 36.6094 26 36.6094ZM26 32.5469C25.44 32.5469 24.9844 33.0025 24.9844 33.5625C24.9844 34.1225 25.44 34.5781 26 34.5781C26.56 34.5781 27.0156 34.1225 27.0156 33.5625C27.0156 33.0025 26.56 32.5469 26 32.5469Z" fill="black"></path>
                        <path d="M26 28.4844C24.887 28.4844 24.4403 27.1928 24.2495 26.6413C24.0118 25.9541 23.7817 25.0188 23.5653 23.8611C23.186 21.8312 22.9531 19.6845 22.9531 19.0391C22.9531 17.359 24.32 15.9922 26 15.9922C27.68 15.9922 29.0469 17.359 29.0469 19.0391C29.0469 19.6845 28.814 21.8312 28.4347 23.8611C28.2183 25.0188 27.9882 25.9541 27.7505 26.6413C27.5597 27.1928 27.1131 28.4844 26 28.4844ZM26 18.0234C25.44 18.0234 24.9844 18.479 24.9844 19.0391C24.9844 19.4267 25.1489 21.1072 25.4632 22.9367C25.66 24.0815 25.8444 24.8802 26 25.4335C26.1555 24.8801 26.34 24.0815 26.5368 22.9367C26.8511 21.1072 27.0156 19.4267 27.0156 19.0391C27.0156 18.479 26.56 18.0234 26 18.0234Z" fill="black"></path>
                        <path d="M45.2314 30.2302C45.7924 30.2302 46.2471 29.7755 46.2471 29.2146C46.2471 28.6537 45.7924 28.199 45.2314 28.199C44.6705 28.199 44.2158 28.6537 44.2158 29.2146C44.2158 29.7755 44.6705 30.2302 45.2314 30.2302Z" fill="black"></path>
                    </svg>
                    <div class="info-block__text">
                        <b>Комментарий специалиста: </b> <span v-html="this.$store.state.order.data.comment"></span>
                    </div>
                </div>
            </div>
            <div v-if="loadData">
                <form-confirm-block v-if="infoConfirm === false" @confirmForm="infoConfirmForm()"></form-confirm-block>
                <div class="anketa" v-else>
                    <div class="container">
                        <div class="anketa-tabs">
                            <div class="anketa-tabs__item btn-new btn" @click="changeUser(key)" :class="{active:user.active, 'btn--transp': !user.active}" v-for="(user,key) in this.users">
                                <svg width="18" class="btn__ic" height="21" viewBox="0 0 18 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.87064 9.67067C10.0618 9.67067 11.0932 9.24344 11.9361 8.40051C12.7787 7.55773 13.2061 6.52652 13.2061 5.3352C13.2061 4.14428 12.7789 3.11294 11.936 2.26988C11.093 1.42723 10.0617 1 8.87064 1C7.67931 1 6.6481 1.42723 5.80531 2.27002C4.96252 3.1128 4.53516 4.14414 4.53516 5.3352C4.53516 6.52652 4.96252 7.55786 5.80531 8.40065C6.64838 9.2433 7.67972 9.67067 8.87064 9.67067ZM6.55128 3.01585C7.19797 2.36917 7.95657 2.05482 8.87064 2.05482C9.78456 2.05482 10.5433 2.36917 11.1901 3.01585C11.8368 3.66267 12.1513 4.42141 12.1513 5.3352C12.1513 6.24926 11.8368 7.00786 11.1901 7.65468C10.5433 8.3015 9.78456 8.61585 8.87064 8.61585C7.95685 8.61585 7.19824 8.30136 6.55128 7.65468C5.90446 7.008 5.58998 6.24926 5.58998 5.3352C5.58998 4.42141 5.90446 3.66267 6.55128 3.01585Z" fill="#E94200" stroke="#E94200" stroke-width="0.4"></path><path d="M16.9612 15.9776C16.9353 15.6383 16.8829 15.2683 16.8058 14.8775C16.728 14.4838 16.6278 14.1117 16.5078 13.7715C16.3837 13.4199 16.2153 13.0727 16.0068 12.74C15.7907 12.3946 15.5367 12.0939 15.2517 11.8465C14.9537 11.5876 14.5887 11.3795 14.1668 11.2277C13.7463 11.0766 13.2803 11.0001 12.7818 11.0001C12.586 11.0001 12.3967 11.0731 12.031 11.2892C11.806 11.4224 11.5428 11.5765 11.249 11.7469C10.9978 11.8922 10.6574 12.0283 10.2371 12.1516C9.82697 12.2721 9.41056 12.3332 8.99941 12.3332C8.58857 12.3332 8.17216 12.2721 7.76175 12.1516C7.34183 12.0285 7.00135 11.8923 6.75057 11.747C6.45955 11.5782 6.19619 11.4241 5.96779 11.289C5.60245 11.0729 5.41312 11 5.21735 11C4.71871 11 4.25285 11.0766 3.83249 11.2278C3.41081 11.3793 3.04576 11.5875 2.74743 11.8466C2.46241 12.0942 2.20841 12.3948 1.99245 12.74C1.78424 13.0727 1.61569 13.4198 1.49161 13.7716C1.37178 14.1118 1.27156 14.4838 1.19372 14.8775C1.11647 15.2678 1.06423 15.6379 1.03833 15.978C1.01288 16.3104 1 16.6564 1 17.006C1 17.9148 1.31823 18.6505 1.94577 19.1931C2.56556 19.7285 3.3855 20 4.38292 20H13.6171C14.6142 20 15.4341 19.7285 16.0541 19.1931C16.6818 18.6509 17 17.9149 17 17.0059C16.9999 16.6551 16.9868 16.3091 16.9612 15.9776ZM15.2792 18.4539C14.8697 18.8078 14.326 18.9798 13.6169 18.9798H4.38292C3.67374 18.9798 3.13004 18.8078 2.72065 18.4541C2.31902 18.107 2.12384 17.6332 2.12384 17.006C2.12384 16.6798 2.13569 16.3577 2.15939 16.0485C2.18251 15.7451 2.22977 15.4119 2.29985 15.0578C2.36906 14.708 2.45714 14.3798 2.5619 14.0827C2.66242 13.7978 2.79951 13.5157 2.96953 13.2439C3.13179 12.9849 3.31849 12.7627 3.5245 12.5837C3.71719 12.4162 3.96007 12.2791 4.24626 12.1763C4.51095 12.0812 4.8084 12.0291 5.13132 12.0213C5.17067 12.0403 5.24076 12.0765 5.3543 12.1437C5.58533 12.2804 5.85162 12.4364 6.146 12.607C6.47784 12.7991 6.90537 12.9726 7.41615 13.1223C7.93835 13.2755 8.47093 13.3534 8.99956 13.3534C9.52819 13.3534 10.0609 13.2755 10.5828 13.1224C11.094 12.9724 11.5214 12.7991 11.8537 12.6068C12.155 12.432 12.4138 12.2806 12.6448 12.1437C12.7584 12.0767 12.8284 12.0403 12.8678 12.0213C13.1909 12.0291 13.4883 12.0812 13.7531 12.1763C14.0392 12.2791 14.2821 12.4163 14.4748 12.5837C14.6808 12.7626 14.8675 12.9848 15.0297 13.2441C15.1999 13.5157 15.3371 13.7979 15.4375 14.0826C15.5424 14.3801 15.6306 14.7082 15.6997 15.0576C15.7696 15.4124 15.8171 15.7458 15.8402 16.0486V16.0489C15.864 16.3569 15.876 16.6789 15.8762 17.006C15.876 17.6333 15.6808 18.107 15.2792 18.4539Z" fill="#E94200" stroke="#E94200" stroke-width="0.4"></path></svg>
                                Собственник #{{parseInt(user.index) + 1}}
                                <span @click="deleteUser(key)">
                                    <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.65234 10.9554L10.9557 3.65213" stroke="#E94200" stroke-linecap="round"></path><path d="M3.65234 3.65167L10.9557 10.955" stroke="#E94200" stroke-linecap="round"></path></svg>
                                </span>
                            </div>
                            <div class="anketa-tabs__add btn-new" @click="addUser()" v-if="countUser < 4">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="9" cy="9" r="8.5" stroke="#BEBEBE"></circle><path d="M9.16406 13.3242V4.99605" stroke="#BEBEBE" stroke-linecap="round"></path><path d="M5 9.16019L13.3281 9.16019" stroke="#BEBEBE" stroke-linecap="round"></path></svg>
                                Добавить собственника
                            </div>
                        </div>
                        <anketa-data-block :group="groupField" :user="user.data" v-for="(user,key) in this.users" :key="key" :keyItemRow="key" v-if="user.active"></anketa-data-block>
                        <div class="anketa-content-block section-margin">
                            <div class="anketa-content-block-row">
                            <div class="anketa-content-block-row__add btn-new" @click="addUser()" v-if="countUser < 4">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="9" cy="9" r="8.5" stroke="#E94200"></circle><path d="M9.16406 13.3242V4.99611" stroke="#E94200" stroke-linecap="round"></path><path d="M5 9.16016L13.3281 9.16016" stroke="#E94200" stroke-linecap="round"></path></svg>
                                Добавить собственника
                            </div>
                            <a class="anketa-content-block-row__btn btn-new btn--bg" @click="sendForm()">Сформировать договор</a>
                            </div>
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
    import mask from './../../../../JSModules/mask.js';
    import { required, maxValue, maxLength, minLength, email } from 'vuelidate/lib/validators';
    import IMask from 'imask';

    import FormConfirmBlock from './Form/FormConfirm.vue';
    import AnketaDataBlock from './Form/AnketaData.vue';

    export default {
        data () {
          return {
              infoConfirm: localStorage.getItem(`confirm_order_${this.$store.getters.orderID}`) === "true",
              users: {},
              groupField: {
                    general: {
                        title: 'Основные данные',
                        listItem: {
                            0: ['lastName','firstName','middleName'],
                            1: ['dateBirth','gender'],
                            2: ['phone','email','numberTIN'],
                            3: ['numberSNILS']
                        }
                    },
                  passport: {
                    title: 'Паспортные данные',
                    listItem: { 0: ['serial','number','datePassport'], 1: ['issued','unitCode'], 2: ['citizenship','placeBirth'], 3: ['registration'] },
                  },
                  family: {
                    title: 'Семейное положение',
                    listItem: { 0: ['familyStatus','marriageContract'] },
                  },
                  file: {
                      title: '',
                      listItem: { 0: ['scanPassport','scanTIN','scanSNILS'] }
                  }
              },
              loadData: {},
              firstUser: false,
              filesAnketa: [],
          }
        },
        created() {
            let userData = this.$store.getters.userInfo;
            if(userData) {
                this.insertUserData(userData);
            } else {
                this.addUser();
                this.getUserDataFromLk();
            }
        },
        updated() {},
        components: {
            FormConfirmBlock,
            AnketaDataBlock,
        },
        computed: {
            countUser: (_this) => Object.keys(_this.users).length,
        },
        methods: {
            insertUserData(usersInfo) {
                for(let userKey in usersInfo) {
                    let userInfo = usersInfo[userKey].data;
                    this.addUser(userKey);
                    for(let fildKey in this.users[userKey].data) {
                        let fild = this.users[userKey].data[fildKey];
                        if(userInfo[fildKey] !== undefined) {
                            this.$set(fild, 'value', userInfo[fildKey].value);
                        }
                    }
                }
            },
            getUserDataFromLk() {
                axios.post('/ajax/?act=User.GetUserDataForLk', qs.stringify({})).then(response => {
                    if(response.data.isSuccess) {
                        let data = this.users[this.firstUser].data;
                        let res = response.data.result;
                        if(res.phone) res.phone = IMask.createMask(mask.phone).resolve(res.phone);
                        for(let key in data) {
                            let value = res[key];
                            if(value) this.$set(data[key], 'value', value);
                        }
                        this.loadData = true;
                    } else {
                        this.$store.dispatch('addGlobalMessege', { type: 'error', message: response.data.message, time: 2000 });
                    }
                }).catch(error => console.log(error));
            },
            formattingDataProfile() {
                let user = {}; let files = {};
                for(let userKey in this.users) {
                    user[userKey] = {}; files[userKey] = {}; user[userKey].data = {};
                    let fields = this.users[userKey].data;
                    user[userKey].index = this.users[userKey].index;
                    for(let fieldKey in fields) {
                        let field = fields[fieldKey];
                        if(field.value !== undefined) {
                            user[userKey].data[fieldKey] = {};
                            user[userKey].data[fieldKey].value = field.value;
                            user[userKey].data[fieldKey].lable = field.lable;
                        }
                        if(field.files !== undefined) {
                            if(Object.keys(field.files).length === 0) {
                                this.$set(field, 'error', true);
                            } else this.$set(field, 'error', false);
                            files[userKey][fieldKey] = field.files;
                        }
                    }
                }
                return {user, files};
            },
            sendForm() {
                let userData = this.formattingDataProfile();
                let check = this.checkErrorField();
                if(check.error) {
                    this.$store.dispatch('addGlobalMessege', {
                        type: 'error',
                        message: `Поля Собственник #${+check.user + 1} заполнено не корректно поле: <br>(${check.lable})`
                    });
                    return false;
                }
                this.$store.state.order.data.userInfo = userData.user;
                let sendData = this.collectAnketa(userData);
                let filesForm = this.collectAnketaFile(userData);
                let countFileFormSend = [];
                filesForm.forEach((form, index)=>{
                    axios.post('/ajax/?act=Order.SaveFileAnketa', form, {
                        headers: { 'Content-Type': 'multipart/form-data'},
                        onUploadProgress: (progressEvent) => {
                            let proc = parseInt(Math.round(( progressEvent.loaded / progressEvent.total) * 100));
                            this.$set(this.filesAnketa[index], 'loadProgress', proc);
                        }
                    }).then(response => {
                        if(response.data.isSuccess) {
                            countFileFormSend.push(response.data.result);
                            if(filesForm.length === countFileFormSend.length) {
                                setTimeout(() => {
                                    this.$set(this, 'filesAnketa', []);
                                    sendData['files'] = countFileFormSend;
                                    this.orderSaveAnketa(sendData);
                                }, 3000);
                            }
                        }
                    }).catch(error => console.log(error));
                });

            },
            collectAnketa(userData) {
                return {
                    orderID: this.$store.getters.orderID,
                    data: userData.user,
                    orderData: this.$store.getters.orderData,
                    payType: this.$store.getters.payType,
                }
            },
            collectAnketaFile(userData) {
                this.$set(this, 'filesAnketa', []);
                let filesForm = [];
                let userInclude = [];
                for (let userID in userData['files']) {
                    let userFiles = userData['files'][userID];
                    for(let fieldKey in userFiles) {
                        let file = userFiles[fieldKey];
                        let formDataFile = new FormData();
                        for(let i in file) {
                            if(Object.keys(file).length > 0) formDataFile.append(`files[${userID}][${fieldKey}][${i}]`, file[i]);
                        }
                        formDataFile.append(`reserve`, this.$store.getters.reserve);
                        filesForm.push(formDataFile);
                        let b = { loadProgress: 0, userID, fieldKey, outNameUser: true };
                        if(userInclude.indexOf(userID) === -1) {
                            userInclude.push(userID);
                        } else {
                            b.outNameUser = false;
                        }
                        this.filesAnketa.push(b);
                    }
                }
                return filesForm;
            },
            orderSaveAnketa(sendData) {
                axios.post('/ajax/?act=Order.SaveAnketa', qs.stringify(sendData)).then(response => {//qs.stringify(sendData)
                    if (response.data.isSuccess) {
                        const status = response.data.result.status;
                        if (status !== undefined) this.$store.commit('newStep', status);
                    } else {
                        this.$store.dispatch('addGlobalMessege', { type: 'error', message: response.data.message });
                    }
                }).catch(error => console.log(error));
            },
            checkErrorField(error = false, user = 0, field = "") {
                let lable = '';
                for(let userKey in this.users) {
                    let fields = this.users[userKey].data;
                    for(let fieldKey in fields) {
                        let field = fields[fieldKey];
                        if(field.error) {
                            if('valid' in field) field.valid.$touch();
                            if(error === false) {
                                error = true;
                                user = this.users[userKey].index;
                                lable = field.lable;
                            }
                            if(fields[fieldKey].type === 'file') {
                                this.$set(fields[fieldKey], 'sendError', true);
                                console.log(fields);
                            }
                        } else {
                            if(fields[fieldKey].type === 'file') this.$set(fields[fieldKey], 'sendError', false);
                        }
                    }
                }

                return { error, user, lable };
            },
            changeUser(key) {
                for(let userKey in this.users) this.$set(this.users[userKey], 'active', userKey === key);
            },
            uuidv4: () => ([1e7]+-1e3+-4e3+-8e3+-1e11).replace(/[018]/g, c => (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)),//RFC4122
            deleteUser(index) {
                //if(this.users[index].active) this.$set(user[index - 1], 'active', true);
                this.$delete(this.users, index);
                this.recountUsers();
            },
            recountUsers() {
                let iterator = 0;
                for(let userKey in this.users) {
                    this.$set(this.users[userKey], 'index', iterator);
                    iterator++;
                }
                for(let userKey in this.users) {
                    this.$set(this.users[userKey], 'active', this.users[userKey].index === 0);
                }
            },
            addUser(iterator = this.uuidv4()) {
                let index= this.countUser;

                this.$set(this.users, iterator, {
                    data: {
                        firstName: { type: 'text', lable: 'Имя', placeholder: 'Иван', value: '', class: '', mask: mask.rusCharsAll, validata: { required, minLength: minLength(2) }, closed: index === 0 },
                        middleName: { type: 'text', lable: 'Отчество', placeholder: 'Иванович', value: '', class: '', mask: mask.rusCharsAll, validata: { minLength: minLength(2) }, closed: false, },
                        lastName: { type: 'text', lable: 'Фамилия', placeholder: 'Иванов', value: '', class: '', mask: mask.rusCharsAll, validata: { required, minLength: minLength(2) }, closed: index === 0, },
                        dateBirth: { type: 'text',lable: 'Дата рождения', placeholder: 'ДД.ММ.ГГГГ', value: '', class: '', mask: mask.date, validata:{ required, minLength: minLength(10) } },
                        gender: { type: 'radio', lable: 'Пол', value: 'Мужской', class: '', list: { 'Мужской':'Мужской', 'Женский':'Женский' } },
                        phone: { type: 'text', lable: 'Телефон', placeholder: '+7 (999) 123-45-67', value: '', class: '', mask: mask.phone, validata: { required, minLength: minLength(18) }, closed: index === 0 },
                        email: {
                            type: 'text',
                            lable: 'E-mail',
                            placeholder: 'username@mail.ru',
                            value: '',
                            class: '',
                            mask: mask.email,
                            validata: { required, email },
                        },
                        numberTIN: {
                            type: 'text',
                            lable: 'ИНН',
                            placeholder: mask.inn.mask,
                            value: '',
                            class: '',
                            mask: mask.inn,
                            validata:{ required, minLength: minLength(mask.inn.mask.length) }
                        },
                        numberSNILS: {
                            type: 'text',
                            lable: 'Номер СНИЛС',
                            placeholder: mask.snils.mask,
                            value: '',
                            class: '',
                            mask: mask.snils,
                            validata:{ required, minLength: minLength(mask.snils.mask.length) }
                        },
                        serial: {
                            type: 'text',
                            lable: 'Серия',
                            placeholder: mask.passSeria.mask,
                            value: '',
                            class: '',
                            mask: mask.passSeria,
                            validata:{ required, minLength: minLength(mask.passSeria.mask.length) }
                        },
                        number: {
                            type: 'text',
                            lable: 'Номер',
                            placeholder: mask.passNumber.mask,
                            value: '',
                            class: '',
                            mask: mask.passNumber,
                            validata:{ required, minLength: minLength(mask.passNumber.mask.length) }
                        },
                        datePassport: {
                            type: 'text',
                            lable: 'Дата выдачи',
                            placeholder: 'ДД.ММ.ГГГГ',
                            value: '',
                            class: '',
                            mask: mask.date,
                            validata:{ required, minLength: minLength(10) }
                        },
                        issued: {
                            type: 'text',
                            lable: 'Выдан',
                            placeholder: '',
                            value: '',
                            class: 'col12',
                            mask: '',
                            validata:{ required }
                        },
                        unitCode: {
                            type: 'text',
                            lable: 'Код подразделения',
                            placeholder: mask.passCode.mask,
                            value: '',
                            class: '',
                            mask: mask.passCode,
                            validata:{ required, minLength: minLength(mask.passCode.mask.length) }
                        },
                        citizenship: {
                            type: 'text',
                            lable: 'Гражданство',
                            placeholder: 'РФ',
                            value: 'РФ',
                            class: '',
                            mask: mask.rusChars,
                            validata:{ required },
                            hidden: true,
                        },
                        placeBirth: {
                            type: 'text',
                            lable: 'Место рождения',
                            placeholder: '',
                            value: '',
                            class: 'col13',
                            mask: '',
                            validata:{ required },
                        },
                        registration: {
                            type: 'text',
                            lable: 'Зарегистрирован (прописка)',
                            placeholder: '',
                            value: '',
                            class: 'col13',
                            mask: '',
                            validata:{ required }
                        },
                        familyStatus: {
                            type: 'radio',
                            lable: 'Семейное положение',
                            value: 'False',
                            class: '',
                            list: {
                                'True':'Состою в браке',
                                'False':'Не состою в браке'
                            },
                        },
                        marriageContract: {
                            type: 'radio',
                            lable: 'Брачный договор',
                            value: 'False',
                            class: '',
                            list: {
                                'True':'Есть',
                                'False':'Нет'
                            },
                            hidden: true,
                        },
                        scanPassport: {
                            type: 'file',
                            lable: 'Скан паспорта (все страницы)',
                            class: '',
                            files: {},
                        },
                        scanTIN: {
                            type: 'file',
                            lable: 'Скан ИНН',
                            class: '',
                            files: {},
                        },
                        scanSNILS: {
                            type: 'file',
                            lable: 'Скан СНИЛС',
                            class: '',
                            files: {},
                        },

                    },
                    index: index,
                    active: index === 0,
                });
                if(index === 0) this.firstUser = iterator;
                for(let userKey in this.users) {
                    this.$set(this.users[userKey], 'active', iterator === userKey);
                }
            },
            infoConfirmForm() {
                localStorage.setItem(`confirm_order_${this.$store.getters.orderID}`, "true");
                this.infoConfirm = true;
            },
        },
    };
</script>
<style scoped>
    .anketa .anketa-content-block-row .btn--bg {
        color: #fff;
    }
    .float-block-loader {
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        background-color: #ffffffb3;
        z-index: 99;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .block-loader-content {
        background: white;
        box-shadow: 0px 0px 3px -2px;
        padding: 15px 30px;
        max-height: 720px;
        overflow-y: auto;
    }
    .progress-box {
        margin-bottom: 20px;
        margin-top: 20px;
    }
    .progress-container {
        height: 20px;
        width: 100%;
        box-shadow: 0px 0px 2px -1px black;
        position: relative;
    }
    .percent {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        font-size: 16px;
        font-weight: 600;
    }
    .progress-line {
        height: 100%;width: 0%;background: #e94200;
    }
</style>
