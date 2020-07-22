<template>
  <div>
    <slot v-if="$store.state.order.orderMode">
      <order-block></order-block>
    </slot>
    <slot v-else>
      <div class="content">
        <div class="lk">
          <deal-block v-if="Object.keys(block.deal).length" :list="block.deal"></deal-block>
          <reservation-block :list="block.reservation"></reservation-block>
        </div>
      </div>
    </slot>
  </div>
</template>
<script>
    import Vue from 'vue';
    import axios from 'axios';
    import qs from 'qs';

    import ReservationBlock from './Deal/Reservation.vue';
    import DealBlock from './Deal/Deal.vue';
    import OrderBlock from './Order/Order.vue';

    export default {
        data () {
          return {
            block: {
              reservation: {},
              deal: {},
            }
          }
        },
        created() {
          axios.post('/ajax/?act=Order.GetAllByID', qs.stringify({})).then(response => {
              if(response.data.isSuccess) {
                for(let key in response.data.result) {
                  let order = response.data.result[key];
                  this.$set(this.block.reservation, (Object.keys(this.block.reservation).length), order);
                }
                this.$store.dispatch('addGlobalMessege', { type: 'ok', message: response.data.message, time: 2000 });
              } else {
                this.$store.dispatch('addGlobalMessege', { type: 'error', message: response.data.message });
              }
          }).catch(error => console.log(error));
        },
        updated() {},
        components: {
          ReservationBlock,
          OrderBlock,
          DealBlock,
        },
        computed: {},
        methods: {},
    };
</script>
