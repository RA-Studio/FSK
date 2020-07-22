import Vue from 'vue'
import PersonalArea from './components/PersonalArea.vue'
import Vuelidate from 'vuelidate'
import store from './store';
import axios from 'axios';
axios.defaults.headers.post = {
    'Content-Type': 'application/x-www-form-urlencoded'
};
Vue.config.productionTip = false
Vue.use(Vuelidate);

if (document.querySelector('#personalArea') !== null) {
    let personalArea = new Vue({
        el: '#personalArea',
        render: h => {
            return h(PersonalArea)
        },
        store,
    });
}