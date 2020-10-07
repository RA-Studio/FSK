<template>
	<div>
		<div class="reservation-top">
		   <slot v-for="(step, index) in listActual">
			   <div  class="contaner-step-nav">
				   <div data-type="nav" data-id="confirm" class="reservation-top-item" :class="{'active': step.step === $store.getters.orderStatus, 'completed' : step.step < $store.getters.orderStatus}">
					   <div class="reservation-top-item__circle" v-html="+index + 1"></div>
					   <div class="reservation-top-item__text" v-html="step.name"></div>
				   </div>
			   </div>
			   <svg width="12" height="30" viewBox="0 0 12 30" fill="none" xmlns="http://www.w3.org/2000/svg" v-if="listActual.length - 1 !== index">
				   <path d="M1 1L11 15L1 29" stroke="#BEBEBE" stroke-width="1.5"></path>
			   </svg>
		   </slot>
		</div>
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
	</div>
</template>
<script>
   import Vue from 'vue';
   export default {
       data () {
           return {
               steps: {
                   full: [
                       { name: 'Договор', step: 3 },
                       { name: 'Заявление<br> УКЭП', step: 4 },
                       { name: 'УКЭП', step: 5 },
                       { name: 'Тождественность', step: 6, filter: [
                           this.$store.state.order.marriageContract
                       ]},
                       { name: 'Проверка<br> документов', step: 7 },
                       { name: 'Оплата', step: 8 },
                       { name: 'Подготовка<br> к регистрации', step: 9 },
                       { name: 'Отправка<br> на регистрацию', step: 10 },
                       { name: 'Регистрация<br> в РосРеестре', step: 11 },
                       { name: 'Сделка<br> завершена', step: 12 }
                   ],
                   mortgage: [
                       { name: 'Единая ипотечная<br> анкета', step: 3 },
                       { name: 'Рассмотрение<br> ипотечной заявки', step: 4 },
                       { name: 'Договор', step: 5 },
                       { name: 'Кредитный<br> договор', step: 6 },
                       { name: 'Тождественность', step: 7 , filter: [
                           this.$store.state.order.marriageContract
                       ]},
                       { name: 'Проверка<br> документов', step: 8 },
                       { name: 'Отправка на<br> регистрацию', step: 9 },
                       { name: 'Регистрация<br> в РосРеестре', step: 10 },
                       { name: 'Сделка<br> завершена', step: 11 },
                   ],
               }
           }
       },
       computed: {
           listActual() {
                return this.steps[this.$store.getters.payType].filter(step => {
                    if(step.filter === undefined) return true;
                    let f = true;
                    step.filter.forEach(item => {
                        if(item === false) f = false;
                    });
                    return f;
                });
           }
       },
   }
</script>
<style scoped>
    .reservation-top {
        overflow-x: scroll;
        justify-content: flex-start !important;
        padding: 0 20px;
    }
    .reservation-top > svg {
        flex: 0 0 12px;
    }
    .contaner-step-nav {
        display: flex;
        align-items: center;
    }
    .reservation-top-item__circle {
        flex: 0 0 50px;
    }
    .reservation-top-item__text {
        white-space: nowrap;
    }
    .reservation-top:after {
        content: " ";
        flex: 0 0 20px;
        height: 1px;
    }
</style>
