<template>
		<components :is="$store.state.order.template"></components>	
</template>
<script>
    import Vue from 'vue';


    //all
        import SelectBlock from './Step/Select.vue'; //2
        import FormBlock from './Step/Form.vue'; //full: 2, mortgage: 2
        import OrderFileBlock from './Step/Full/OrderFile.vue';//full: 3, mortgage: 5
        import CheckDocumentsBlock from './Step/Full/CheckDocuments.vue';//full: 7, mortgage: 8
        import IdentityBlock from './Step/Full/Identity.vue';//full: 6, mortgage: 7
        import SendingRegistrationBlock from './Step/Full/SendingRegistration.vue';//full: 10, mortgage: 9
        import RegistrationProcessBlock from './Step/Full/RegistrationProcess.vue';//full: 11, mortgage: 10
        import DealEndBlock from './Step/Full/DealEnd.vue';//full: 12, mortgage: 11
    //all
    //full
        import ApplicationBlock from './Step/Full/ApplicationUKEP.vue'; //full: 4
        import UkepBlock from './Step/Full/UKEP.vue';//full: 5
        import PaymentCreditBlock from './Step/Full/PaymentCredit.vue';//full: 8
        import PrepareRegistrationBlock from './Step/Full/PrepareRegistration.vue';//full: 9
    //full
    // mortgage
        import ApprovalBlock from './Step/Mortgage/Approval.vue';//mortgage: 3
        import MortgageApplicationReviewBlock from './Step/Mortgage/MortgageApplicationReview.vue';//mortgage: 4
        import SigningPurchaseAgreementBlock from './Step/Mortgage/SigningPurchaseAgreement.vue';//mortgage: 6
    // mortgage
    export default {
        data () {
          return {}
        },
        created() {},
        updated() {},
        components: {
            SelectBlock,
            FormBlock,
            //full
                OrderFileBlock,
                ApplicationBlock,
                UkepBlock,
                SendingRegistrationBlock,
                RegistrationProcessBlock,
                PrepareRegistrationBlock,
                PaymentCreditBlock,
                CheckDocumentsBlock,
                IdentityBlock,
                DealEndBlock,
            //full
            //mortgage
                ApprovalBlock,
                MortgageApplicationReviewBlock,
                SigningPurchaseAgreementBlock,
            //mortgage
        },
        methods: {},
    };
</script>
