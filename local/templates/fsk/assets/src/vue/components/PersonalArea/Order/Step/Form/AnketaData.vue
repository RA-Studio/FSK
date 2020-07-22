<template>
    <div class="anketa-content">
        <div class="anketa-content-block section-margin" v-for="(block, blockKey) in group">
            <h2 class="h1 title">{{block.title}}</h2>
            <div class="anketa-content-block-row" v-for="(row, rowKey) in block.listItem">
                <components v-if="user[inputKey] !== undefined" :is="template[user[inputKey].type]" :input="user[inputKey]" :inputKey="inputKey" :key="keyItem" v-for="(inputKey, keyItem) in row"></components>
            </div>
        </div>
    </div>
</template>
<script>
    import Vue from 'vue'

    import DefaultInput from './../../../../defaultInput.vue';
    import DefaultRadio from './../../../../defaultRadio.vue';
    import DefaultFile from './../../../../defaultFile.vue';

    export default {
        props: {
            group: { type: Object, default: {} },
            user: { type: Object, default: {} },
            keyItemRow: String,
        },
        data () {
            return {
                template: { 'text': 'default-input', 'radio': 'default-radio', 'file': 'default-file' }
            }
        },
        components: {
          DefaultInput,
          DefaultRadio,
          DefaultFile,
        },
        created() {},
        updated() {},
        computed: {},
        methods: {},
    };
</script>
