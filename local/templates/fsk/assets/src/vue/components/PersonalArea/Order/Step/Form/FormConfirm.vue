<template>
    <div class="content">
        <div class="lk">
            <div class="container instruction">
                <components :is="`${this.$store.getters.payType}-confirm-block`"></components>
                <div class="container instruction">
                    <div class="instruction-next" @click.prevent="confirmForm()">
                        <a class="instruction-next__btn btn-new btn--bg" href="#">
                            <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M21.7511 0.801702C21.4191 0.430683 20.881 0.430683 20.549 0.801702L10.3654 12.1834L6.45106 7.80851C6.11913 7.43749 5.58097 7.43753 5.24897 7.80851C4.91701 8.17949 4.91701 8.78096 5.24897 9.15198L9.7644 14.1986C10.0962 14.5695 10.6348 14.5693 10.9665 14.1986L21.7511 2.14521C22.083 1.77423 22.083 1.17272 21.7511 0.801702Z" fill="#FFFEFE"></path><path d="M10 1.5C5.31308 1.5 1.5 5.31308 1.5 10C1.5 14.6869 5.31308 18.5 10 18.5C14.6869 18.5 18.5 14.6869 18.5 10C18.5 5.31308 14.6869 1.5 10 1.5ZM10 0C15.5229 0 20 4.47715 20 10C20 15.5229 15.5229 20 10 20C4.47715 20 0 15.5229 0 10C0 4.47715 4.47715 0 10 0Z" fill="white"></path></svg>
                            Понятно, начинаем!
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Vue from 'vue';
    import FullConfirmBlock from './Confirm/FullConfirm.vue';
    import MortgageConfirmBlock from './Confirm/MortgageConfirm.vue';
    export default {
        props:[confirm],
        data () {
          return {
              type: {
                  "full": "full-confirm-block",
                  "mortgage": "full-confirm-block",
              }
          }
        },
        components: {
          FullConfirmBlock,
          MortgageConfirmBlock,
        },
        created() {},
        methods: {
            confirmForm() {
                this.$emit('confirmForm');
                window.scrollTo(0, 0);
            }
        },
    };
</script>
