<template>
    <div class="content">
        <step-block></step-block>
        <div class="info" v-if="dduFile">
          <div class="container">
            <div class="info-contract">
              <h2 class="h1 title">Ваш договор на покупку</h2>
                <p>
                    Пожалуйста, ознакомьтесь с текстом договора и нажмите «Подтверждаю данные».<br>
                    Если у вас есть вопросы к содержанию документа, пожалуйста, обратитесь к менеджеру по тел. <a href="tel:88127035555">+7 (812)-703-55-55</a>.
                </p>
                <iframe :src="dduFile"></iframe>
                <div class="info-contract__btn-wrap">
                    <a class="info-contract__btn btn-new btn--bg" href="#" @click.prevent="confirmDdu()">
                        <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M21.7511 0.801702C21.4191 0.430683 20.881 0.430683 20.549 0.801702L10.3654 12.1834L6.45106 7.80851C6.11913 7.43749 5.58097 7.43753 5.24897 7.80851C4.91701 8.17949 4.91701 8.78096 5.24897 9.15198L9.7644 14.1986C10.0962 14.5695 10.6348 14.5693 10.9665 14.1986L21.7511 2.14521C22.083 1.77423 22.083 1.17272 21.7511 0.801702Z" fill="#FFFEFE"></path><path d="M10 1.5C5.31308 1.5 1.5 5.31308 1.5 10C1.5 14.6869 5.31308 18.5 10 18.5C14.6869 18.5 18.5 14.6869 18.5 10C18.5 5.31308 14.6869 1.5 10 1.5ZM10 0C15.5229 0 20 4.47715 20 10C20 15.5229 15.5229 20 10 20C4.47715 20 0 15.5229 0 10C0 4.47715 4.47715 0 10 0Z" fill="white"></path></svg>
                        Подтверждаю данные
                    </a>
                </div>
            </div>
          </div>
        </div>
        <div class="info" v-else>
            <div class="container">
                <div class="info-load">
                    <div class="info-load-block">
                        <svg width="57" height="57" viewBox="0 0 57 57" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M28.0016 55.4123C43.1342 55.4123 55.4016 43.3639 55.4016 28.5015C55.4016 13.6392 43.1342 1.59082 28.0016 1.59082C12.869 1.59082 0.601562 13.6392 0.601562 28.5015C0.601562 43.3639 12.869 55.4123 28.0016 55.4123Z" stroke="#E94200" stroke-width="1.2"></path><path d="M39.6362 15.942H37.3704V13.6765C37.3704 13.6154 37.3584 13.5549 37.3351 13.4985C37.3117 13.4421 37.2775 13.3909 37.2343 13.3477C37.1912 13.3045 37.1399 13.2703 37.0835 13.2469C37.0271 13.2236 36.9666 13.2116 36.9056 13.2116H21.8752C21.8451 13.2116 21.8151 13.2147 21.7857 13.2206H21.783C21.743 13.2292 21.7044 13.2429 21.668 13.2615C21.66 13.2655 21.6526 13.2698 21.6446 13.2743C21.6081 13.2944 21.5744 13.3193 21.5445 13.3484L16.033 18.8615C16.004 18.891 15.9791 18.9245 15.9592 18.9608C15.9544 18.969 15.9499 18.977 15.9456 18.9855C15.9274 19.0214 15.9139 19.0596 15.9053 19.0989V19.105C15.8996 19.1332 15.8967 19.1618 15.8965 19.1906V41.5955C15.8965 41.7188 15.9455 41.837 16.0326 41.9242C16.1198 42.0114 16.238 42.0603 16.3613 42.0603H18.6274V44.3259C18.6273 44.3869 18.6393 44.4474 18.6627 44.5038C18.686 44.5602 18.7203 44.6115 18.7634 44.6546C18.8066 44.6978 18.8579 44.732 18.9143 44.7554C18.9707 44.7787 19.0312 44.7907 19.0922 44.7907H39.6367C39.6978 44.7907 39.7582 44.7787 39.8146 44.7554C39.8711 44.732 39.9223 44.6978 39.9655 44.6546C40.0087 44.6115 40.0429 44.5602 40.0662 44.5038C40.0896 44.4474 40.1016 44.3869 40.1016 44.3259V16.4068C40.1016 16.3457 40.0896 16.2852 40.0662 16.2288C40.0428 16.1723 40.0085 16.121 39.9653 16.0779C39.9221 16.0347 39.8708 16.0004 39.8143 15.9771C39.7578 15.9538 39.6973 15.9419 39.6362 15.942ZM21.4111 14.7985V18.7257H17.4831L21.4111 14.7985ZM16.8256 19.6554H21.8752C21.9362 19.6554 21.9967 19.6434 22.0531 19.6201C22.1095 19.5967 22.1608 19.5625 22.2039 19.5193C22.2471 19.4762 22.2814 19.4249 22.3047 19.3685C22.3281 19.3121 22.3401 19.2516 22.34 19.1906V18.4699H32.6763C32.7996 18.4699 32.9178 18.4209 33.005 18.3338C33.0922 18.2466 33.1411 18.1284 33.1411 18.0051C33.1411 17.8818 33.0922 17.7636 33.005 17.6764C32.9178 17.5892 32.7996 17.5402 32.6763 17.5402H22.3408V14.1413H36.4407V41.1306H16.8256V19.6554ZM39.1713 43.861H19.5565V42.0603H36.9056C36.9666 42.0604 37.0271 42.0484 37.0835 42.025C37.1399 42.0017 37.1912 41.9674 37.2343 41.9243C37.2775 41.8811 37.3117 41.8298 37.3351 41.7734C37.3584 41.717 37.3704 41.6565 37.3704 41.5955V16.8717H39.1713V43.861Z" fill="black"></path><path d="M20.5908 24.8913H32.6768C32.8 24.8913 32.9183 24.8423 33.0055 24.7551C33.0926 24.6679 33.1416 24.5497 33.1416 24.4264C33.1416 24.3031 33.0926 24.1849 33.0055 24.0977C32.9183 24.0106 32.8 23.9616 32.6768 23.9616H20.5908C20.4675 23.9616 20.3493 24.0106 20.2621 24.0977C20.175 24.1849 20.126 24.3031 20.126 24.4264C20.126 24.5497 20.175 24.6679 20.2621 24.7551C20.3493 24.8423 20.4675 24.8913 20.5908 24.8913Z" fill="black"></path><path d="M20.5908 28.1013H32.6768C32.8 28.1013 32.9183 28.0523 33.0055 27.9651C33.0926 27.8779 33.1416 27.7597 33.1416 27.6364C33.1416 27.5131 33.0926 27.3949 33.0055 27.3077C32.9183 27.2205 32.8 27.1716 32.6768 27.1716H20.5908C20.4675 27.1716 20.3493 27.2205 20.2621 27.3077C20.175 27.3949 20.126 27.5131 20.126 27.6364C20.126 27.7597 20.175 27.8779 20.2621 27.9651C20.3493 28.0523 20.4675 28.1013 20.5908 28.1013Z" fill="black"></path><path d="M20.5908 31.3136H32.6768C32.8 31.3136 32.9183 31.2647 33.0055 31.1775C33.0926 31.0903 33.1416 30.9721 33.1416 30.8488C33.1416 30.7255 33.0926 30.6073 33.0055 30.5201C32.9183 30.4329 32.8 30.3839 32.6768 30.3839H20.5908C20.4675 30.3839 20.3493 30.4329 20.2621 30.5201C20.175 30.6073 20.126 30.7255 20.126 30.8488C20.126 30.9721 20.175 31.0903 20.2621 31.1775C20.3493 31.2647 20.4675 31.3136 20.5908 31.3136Z" fill="black"></path><path d="M20.5908 34.5223H32.6768C32.8 34.5223 32.9183 34.4733 33.0055 34.3862C33.0926 34.299 33.1416 34.1807 33.1416 34.0575C33.1416 33.9342 33.0926 33.8159 33.0055 33.7288C32.9183 33.6416 32.8 33.5926 32.6768 33.5926H20.5908C20.4675 33.5926 20.3493 33.6416 20.2621 33.7288C20.175 33.8159 20.126 33.9342 20.126 34.0575C20.126 34.1807 20.175 34.299 20.2621 34.3862C20.3493 34.4733 20.4675 34.5223 20.5908 34.5223Z" fill="black"></path><path d="M20.5908 37.7331H32.6768C32.8 37.7331 32.9183 37.6841 33.0055 37.5969C33.0926 37.5097 33.1416 37.3915 33.1416 37.2682C33.1416 37.1449 33.0926 37.0267 33.0055 36.9395C32.9183 36.8524 32.8 36.8034 32.6768 36.8034H20.5908C20.4675 36.8034 20.3493 36.8524 20.2621 36.9395C20.175 37.0267 20.126 37.1449 20.126 37.2682C20.126 37.3915 20.175 37.5097 20.2621 37.5969C20.3493 37.6841 20.4675 37.7331 20.5908 37.7331Z" fill="black"></path><path d="M20.5908 21.6805H32.6768C32.8 21.6805 32.9183 21.6315 33.0055 21.5444C33.0926 21.4572 33.1416 21.339 33.1416 21.2157C33.1416 21.0924 33.0926 20.9741 33.0055 20.887C32.9183 20.7998 32.8 20.7508 32.6768 20.7508H20.5908C20.4675 20.7508 20.3493 20.7998 20.2621 20.887C20.175 20.9741 20.126 21.0924 20.126 21.2157C20.126 21.339 20.175 21.4572 20.2621 21.5444C20.3493 21.6315 20.4675 21.6805 20.5908 21.6805Z" fill="black"></path></svg>
                        Договор в стадии формирования
                    </div>
                    <div class="info-load-row">Наши специалисты проверяют корректность данных, внесенных в договор. Проверка занимает от 10 минут до 24 часов.</div>
                    <div class="info-load-row">После проверки договор появится на этой странице. Не беспокойтесь - мы оповестим вас об этом по SMS и на e-mail. </div>
                    <div class="info-load-row">Внимательно прочтите договор и нажмите кнопку согласования - это будет означать, что его содержание вами подтверждено.  </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Vue from 'vue';
    import axios from 'axios';
    import qs from 'qs';

    import StepBlock from './../Step.vue';

    export default {
        data () {
          return {
              dduFile: false,
              checkDdu: false,
          }
        },
        created() {
            if(this.$store.state.order.data.dduFile) {
                this.dduFile = this.$store.state.order.data.dduFile;
            } else {
                let sendData = { 'orderID': this.$store.state.order.data.order };
                this.checkDdu = setInterval(() => {
                    axios.post('/ajax/?act=Order.CkeckDduFileByOrder', qs.stringify(sendData)).then(response => {
                        if(response.data.isSuccess) {
                           this.dduFile = response.data.result.contract;
                           clearInterval(this.checkDdu);
                        }
                    }).catch(error => console.log(error));
                }, 5000);
            }
        },
        destroy() {
            if(this.checkDdu !== false) clearInterval(this.checkDdu);
        },
        updated() {},
        components: {
            StepBlock,
        },
        methods: {
            confirmDdu() {
                const status =  parseInt(this.$store.getters.orderStatus) + 1;
                let sendData = { 'orderID': this.$store.state.order.data.order, status };
                this.$store.commit('setLoader', { status: true });
                axios.post('/ajax/?act=Order.ConfirmOrderDdu', qs.stringify(sendData)).then(response => {
                    this.$store.commit('setLoader', { status: false });
                    if(response.data.isSuccess) {

                    } else {
                        this.$store.dispatch('addGlobalMessege', { type: 'error', message: response.data.message });
                    }
                }).catch(error =>  this.$store.commit('setLoader', { status: false }));
            }
        },
    };
</script>
