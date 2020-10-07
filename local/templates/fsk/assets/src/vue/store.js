import Vue from 'vue';
import Vuex from 'vuex';
import states from './store/include/state.js'
import getter from './store/include/getters.js'
import mutation from './store/include/mutations.js'
import action from './store/include/actions.js'
import axios from 'axios';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {},
    getters: getter,
    state: states,
    mutations: mutation,
    actions: action
})
