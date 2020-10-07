<template>
    <div :class="{
        'anketa-content-block-row-input':true,
        'input-error': error,
        [input.class]: true,
        'disabled': (!error && $v.$dirty && (input.validata != undefined || input.value )),
    }" v-show="input.hidden === undefined || input.hidden === false">
        <label class="general-itemInput__label_top">{{input.lable}}</label>
        <input
            :type="input.type"
            v-model="input.value"
            :placeholder="input.placeholder"
            :id="inputKey"
            :name="inputKey"
            v-imask="input.mask"
            @input="checkValidation()"
            :disabled="input.closed !== undefined && input.closed === true"
        >
        <label
            :class="{
                'input-error__label': true,
                'general-itemInput__label_top': false,
            }"
            :for="inputKey"
            v-if="input.validata != undefined && error"
        >Не заполнено, или ошибка ввода</label>
    </div>
</template>
<script>

import Vue from 'vue'

import Inputmask from 'inputmask';
import {IMaskDirective} from 'vue-imask';

export default {
    props: {
        input: Object,
        inputKey: String,
    },
    directives: {
        imask: IMaskDirective,
    },
    methods: {
        checkValidation() {

            if(this.input.mask !== undefined && this.input.mask !== "") {
                let value = IMask.createMask(this.input.mask).resolve(this.input.value);
                this.$set(this.input, 'value', value);
            }
            this.$v.$touch();
            this.$set(this.input, 'error', this.error)

        },
    },
    computed: {
        error() {
            return this.input.validata !== undefined && (( ('required' in this.input.validata) && this.$v.$error) || (this.input.value && !('required' in this.input.validata) && this.$v.$error))
        }
    },
    mounted() {
        if(this.input.value) this.$v.$touch();
        let error = this.error;
        if('validata' in this.input) {
            if('required' in this.input.validata && !this.input.value) {
                error = true;
            }
        }
        this.$set(this.input, 'error', error);
        this.$set(this.input, 'valid', this.$v);
        this.$set(this.input, 'checkValidation', () => {
            console.log('this.checkValidation');
            this.checkValidation();
        });
    },
    validations() {
        if(this.input.validata === undefined) return false;
        return { input: { value: this.input.validata } };
    }
}
</script>
