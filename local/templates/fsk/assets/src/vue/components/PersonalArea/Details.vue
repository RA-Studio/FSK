<template>
    <div class="content">
        <div class="lk">
          <div class="container">
            <div class="anketa-content" v-if="loadData">
              <div class="anketa-content-block section-margin" v-for="(block, blockKey) in user.block">
                <h2 class="h1 title">{{block.title}}</h2>
                <div class="anketa-content-block-row" v-for="(row, rowKey) in block.listItem">
                  <components :is="`default-input`" :input="input" :inputKey="inputKey" :key="inputKey" v-for="(input, inputKey) in row"></components>
                </div>
              </div>
              <div class="anketa-content-block section-margin">
                  <div class="anketa-content-block-row">
                    <div class="anketa-content-block-row__btn btn-new btn--bg" @click="sendDataInBack()">Сохранить данные</div>
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
    import DefaultInput from './../defaultInput.vue';
    import mask from './../../JSModules/mask.js';
    import { required, maxValue, maxLength, minLength, email } from 'vuelidate/lib/validators';
    import IMask from 'imask';
    export default {
        data () {
            return {
              loadData: false,
              user: {
                block: {

                    general: {
                      title: 'Основные данные',
                      listItem: {

                        0: {
                          lastName: {
                            type: 'text',
                            lable: 'Фамилия',
                            placeholder: 'Иванов',
                            value: '',
                            class: '',
                            mask: mask.rusCharsAll,
                            validata: { required, minLength: minLength(2) },
                          },
                          firstName: {
                            type: 'text',
                            lable: 'Имя',
                            placeholder: 'Иван',
                            value: '',
                            class: '',
                            mask: mask.rusCharsAll,
                            validata: { required, minLength: minLength(2) },
                          },
                          middleName: {
                            type: 'text',
                            lable: 'Отчество',
                            placeholder: 'Иванович',
                            value: '',
                            class: '',
                            mask: mask.rusCharsAll,
                          },
                        },
                        1: {
                          phone: {
                            type: 'text',
                            lable: 'Телефон',
                            placeholder: '+7 (999) 123-45-67',
                            value: '',
                            class: '',
                            mask: mask.phone,
                            closed: true,
                            validata: { required, minLength: minLength(18) },
                          },
                          email: {
                            type: 'text',
                            lable: 'E-mail',
                            placeholder: 'username@mail.ru',
                            value: '',
                            class: '',
                            mask: mask.email,
                            validata: { email },
                          }
                        }
                      },
                    },
                    passport: {
                      title: 'Паспортные данные',
                      listItem: {
                        0: {
                          serial: {
                            type: 'text',
                            lable: 'Серия',
                            placeholder: '0000',
                            value: '',
                            class: '',
                            mask: mask.passSeria,
                            validata:{ minLength: minLength(4) }
                          },
                          number: {
                            type: 'text',
                            lable: 'Номер',
                            placeholder: '000000',
                            value: '',
                            class: '',
                            mask: mask.passNumber,
                            validata:{ minLength: minLength(6) }
                          },
                          datePassport: {
                            type: 'text',
                            lable: 'Дата выдачи',
                            placeholder: 'ДД.ММ.ГГГГ',
                            value: '',
                            class: '',
                            mask: mask.date,
                            validata:{ minLength: minLength(10) }
                          },
                        },
                        1: {
                          issued: {
                            type: 'text',
                            lable: 'Выдан',
                            placeholder: '',
                            value: '',
                            class: 'col12',
                            mask: '',
                          },
                          unitCode: {
                            type: 'text',
                            lable: 'Код подразделения',
                            placeholder: '000-000',
                            value: '',
                            class: '',
                            mask: mask.passCode,
                            validata:{ minLength: minLength(7) }
                          }
                        },
                        2: {
                          citizenship: {
                            type: 'text',
                            lable: 'Гражданство',
                            placeholder: 'РФ',
                            value: '',
                            class: '',
                            mask: mask.rusChars,
                          },
                          placeBirth: {
                            type: 'text',
                            lable: 'Место рождения',
                            placeholder: '',
                            value: '',
                            class: 'col23',
                            mask: '',
                          }
                        },
                        3: {
                          registration: {
                            type: 'text',
                            lable: 'Зарегистрирован (прописка)',
                            placeholder: '',
                            value: '',
                            class: 'col13',
                            mask: '',
                          }
                        }
                      }
                    }

                }
              }
            }
        },
        components: {
          DefaultInput,
        },
        created() {
          axios.post('/ajax/?act=User.GetUserDataForLk', qs.stringify({})).then(response => {
              if(response.data.isSuccess) {
                this.setDataFromBack(response.data.result);
                this.loadData = true;
              } else {
                this.$store.dispatch('addGlobalMessege', {
                    type: 'error',
                    message: response.data.message,
                    time: 2000,
                });
              }
          }).catch(error => console.log(error));
        },
        updated() {},
        computed: {},
        methods: {
          setDataFromBack (user = false) {
            if(user === false) return false;
            if(user.phone) user.phone = IMask.createMask(mask.phone).resolve(user.phone);
            for(let blockKey in this.user.block) {
              let block = this.user.block[blockKey];
              for(let rowKey in block.listItem) {
                let row = block.listItem[rowKey];
                for(let inputKey in row) {
                  let input = row[inputKey];
                  let value = user[inputKey];
                  this.$set(input, 'value', value ? value : '');
                }
              }
            }
          },
          sendDataInBack() {
            let sendData = {};
            let error = false;
            for(let blockKey in this.user.block) {
              let block = this.user.block[blockKey];
              for(let rowKey in block.listItem) {
                let row = block.listItem[rowKey];
                for(let inputKey in row) {
                  let input = row[inputKey];
                  if(input.value) sendData[inputKey] = input.value;
                  if(input.error) error = true;
                }
              }
            }
            if(error) {
              this.$store.dispatch('addGlobalMessege', {
                  type: 'error',
                  message: 'Исправьте все ошибки',
              });
              return false;
            }

            axios.post('/ajax/?act=User.UpdateInfoLk', qs.stringify(sendData)).then(response => {
                if(response.data.isSuccess) {
                  this.$store.dispatch('addGlobalMessege', {
                      type: 'ok',
                      message: response.data.message,
                  });
                } else {
                  this.$store.dispatch('addGlobalMessege', {
                      type: 'error',
                      message: response.data.message,
                  });
                }
            }).catch(error => console.log(error));
          },
        },
    };
</script>
