<template>
    <div class="anketa-content-block-row-checkbox" v-show="input.hidden === undefined || input.hidden === false">
      <label for="">{{input.lable}}</label>
      <div class="anketa-content-block-row-checkbox-row">
        <label class="anketa-content-block-row-checkbox-row-input" v-for="(item,key) in input.list">
          <input type="radio" :name="inputKey" :checked="input.value === key" v-model="input.value" :value="key"><span> </span><span v-html="item">Мужской</span>
        </label>
      </div>
    </div>
</template>
<script>

import Vue from 'vue'
import axios from 'axios';
import qs from 'qs';

import Inputmask from 'inputmask';

export default {

    props: {
        input: Object,
        inputKey: String,
    },
    created() {
        this.$set(this.input, 'error', false)
    },
}
</script>