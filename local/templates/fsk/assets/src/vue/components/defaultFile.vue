<template>
    <div class="anketa-content-block-row-files" ref="fileForm">
        <label v-html="input.lable"></label>
        <div class="anketa-content-block-row-files-dropzone" :class="{'error' : (input.sendError)}">
            <div class="anketa-content-block-row-files-dropzone__info" @click="fileClick()">
                <svg width="51" height="51" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M46.6977 44.1425V31.1671H49.4043V44.1425C49.4043 47.0423 47.0441 49.4024 44.1444 49.4024H5.85987C2.96011 49.4024 0.6 47.0423 0.6 44.1425V31.1671H3.30658V44.1425C3.30658 45.5509 4.45146 46.6958 5.85987 46.6958H44.1444C45.5528 46.6958 46.6977 45.5509 46.6977 44.1425Z" fill="#E94200" stroke="white" stroke-width="1.2"></path><path d="M23.6569 30.4436V0.6H26.3635V30.4436V31.8921L27.3878 30.8679L34.386 23.8696L36.2998 25.7834L25.0102 37.0731L13.7206 25.7834L15.6344 23.8696L22.6327 30.8679L23.6569 31.8921V30.4436Z" fill="#E94200" stroke="white" stroke-width="1.2"></path></svg>
                <slot v-if="dragState.dragonActive === false">
                    Просто перетяните файлы<br>в эту область или нажмите для загрузки
                </slot>
                <slot v-else>
                    Отпустите файл
                </slot>
            </div>
            <input type="file" :data-file="inputKey" @change="changeFile" ref="file">
            <div class="anketa-content-block-row-files-dropzone-list" :class="{ active: (count > 0 && dragState.dragonActive === false), scroll: count > 12 }">
                 <div class="anketa-content-block-row-files-dropzone-list__title" @click="fileClick()">
                     <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16.5938 11.0039V15.8906C16.5938 16.2783 16.2783 16.5938 15.8906 16.5938H2.10938C1.72167 16.5938 1.40625 16.2783 1.40625 15.8906V11.0039H0V15.8906C0 17.0537 0.946266 18 2.10938 18H15.8906C17.0537 18 18 17.0537 18 15.8906V11.0039H16.5938Z" :fill="openBlock ? '#E94200' : '#BEBEBE'"></path><path d="M12.3762 8.28689L9.70432 10.9588V0H8.29807V10.9588L5.6262 8.28689L4.63184 9.28125L9.0012 13.6506L13.3706 9.28125L12.3762 8.28689Z" :fill="openBlock ? '#E94200' : '#BEBEBE'"></path></svg>
                     Добавить ещё файлы
                 </div>
                 <div class="anketa-content-block-row-files-dropzone-list-items">
                     <div class="anketa-content-block-row-files-dropzone-list-items__item" v-for="(file, fileKey) in this.input.files">
                         {{file.name.replace(".", " . ")}}
                         <svg @click="deleteFile(fileKey)" width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.65234 10.9554L10.9557 3.65213" stroke="#E94200" stroke-linecap="round"></path><path d="M3.65234 3.65167L10.9557 10.955" stroke="#E94200" stroke-linecap="round"></path></svg>
                     </div>
                 </div>
            </div>
        </div>
    </div>
</template>
<script>
import Vue from 'vue'
export default {
    props: {
        input: Object,
        inputKey: String,
        multiple: {
            type: Boolean,
            default: true,
        },
        typeRecommendedOut: {
            type: Array,
            default: () => [],
        },
    },
    data () {
        let dopType = this.typeRecommendedOut.length ? this.typeRecommendedOut : ["image/jpeg","application/pdf","image/png"];
        return {
            dragAndDropCapable: false,
            showFileBlock: false,
            openBlock: false,
            errorMessage: "",
            dragState: {
                dragonActive: false,
                point: false,
            },
            typeRecommended: dopType,
            size: 10*1024*1024,
            dopType: {
                'sig' : 'application/sig',
            },
        }
    },
    directives: {},
    methods: {
        changeFile(event) {
            this.forMassFile(event.target.files);
            this.$refs.file.value = '';
        },
        countFile() {
            return Object.keys(this.input.files).length;
        },
        toggleBlockFile() {
            if(this.countFile() > 0) {
                this.$set(this, 'showFileBlock', !this.showFileBlock);
            } else {
                this.$store.dispatch('addGlobalMessege', {  type: 'warning', message: 'Пока файлов нет' });
            }
        },
        deleteFile(key) {
            if(key) {
                this.$delete(this.input.files, key);
                if(Object.keys(this.input.files).length === 0) {
                    this.openBlock = false;
                    this.showFileBlock = false;
                    this.$set(this.input, 'error', true);
                }
            }
        },
        fileClick() {
            this.$refs.file.click();
        },
        determineDragAndDropCapable(){
            let div = document.createElement('div');
            return ( ( 'draggable' in div )|| ( 'ondragstart' in div && 'ondrop' in div ) ) && 'FormData' in window && 'FileReader' in window;
        },
        forMassFile(files) {
            this.errorMessage = '';
            console.log(files);
            for( let i = 0; i < files.length; i++ ){
                let file = files[i];
                if(file.name === undefined) continue;
                let out = this.addFile(file);
                if(out !== false && out !== true) this.errorMessage += `${out}<br>`;
            }
            this.outGlobalMessage(this.errorMessage);
        },
        addFile(file) {
            let ext = file.name.split('.').pop();
            let type = file.type;
            if(this.dopType[ext]) type = this.dopType[ext];
            if(this.typeRecommended.indexOf(type) === -1) return `Недопустиаый тип файла (${file.name})`;
            if(file.size > this.size) return `Размер файла превышает допустимый (${file.name})`;
            if(file.lastModified !== undefined) {
                if(this.multiple === false) this.$set(this.input, `files`, {});
                this.$set(this.input.files, `${file.lastModified}${file.name}`, file);
                this.openBlock = true;
                this.$set(this, 'showFileBlock', true);
                this.$set(this.input, 'error', false);
                this.$set(this.input, 'sendError', false);
                return true;
            }
            return false;
        },
        outGlobalMessage(message) {
            if(message) this.$store.dispatch('addGlobalMessege', {  type: 'error', message: message });
        },
    },
    mounted(){
        this.dragAndDropCapable = this.determineDragAndDropCapable();
        if( this.dragAndDropCapable ) {
            ['drag', 'dragstart', 'dragend', 'dragover', 'dragenter', 'dragleave', 'drop'].forEach(function (evt) {
                this.$refs.fileForm.addEventListener(evt, function(e) {
                    if(evt === 'dragover') {
                        clearTimeout(this.point);
                        this.$set(this.dragState, 'dragonActive', true);
                        this.point = setTimeout(() => {
                            this.$set(this.dragState, 'dragonActive', false);
                        }, 500);
                    }
                    e.preventDefault();
                    e.stopPropagation();
                }.bind(this), false);
            }.bind(this));

            this.$refs.fileForm.addEventListener('drop', function(e) {
                this.$set(this.dragState, 'dragonActive', false);
                this.forMassFile(e.dataTransfer.files);
                this.$set(this, 'showFileBlock', true);
            }.bind(this));
        }
        if(this.multiple) this.$refs.file.setAttribute('multiple', '');
    },
    computed: {
        count() {
            return Object.keys(this.input.files).length;
        },
    },
    created() {
        this.$set(this.input, 'error', this.count === 0);
    },
}
</script>
<style scoped>
    [type='file'] {
        display:none;
    }
    .anketa-content-block-row-files-dropzone-list.active.scroll {
        overflow-y: scroll;
    }
    .anketa-content-block-row-files-dropzone.error {
        border: 1px dashed #ff0000;
    }
</style>
