export default {
    setOrderMode(state, order = false) {
        if(order.status == 0) alert('Ваш заказ отменен');
        if(order.status == 1) location.href=`/pay/?order=${order.order}`;

        state.order.orderMode = true;
        state.order.marriageContract = false;
        if(order.file1C && typeof order.file1C === 'string') {
            order.file1C = JSON.parse(order.file1C);
        }
        if(order.userInfo && typeof order.userInfo === 'string') {
            order.userInfo = JSON.parse(order.userInfo);
            console.log(order.userInfo);
            for( let userKey in order.userInfo ) {
                let user = order.userInfo[userKey].data;
                //if(order.userInfo[userKey].index == 0) {
                    if(user.familyStatus.value == 'True')  state.order.marriageContract = true;
                //}
            }
        }
        let update = true;
        if(state.order.data != undefined) {
            if(state.order.data.status != undefined) {
                if(state.order.data.status === order.status) update = false;
            }
        }
        state.order.data = order;
        state.order.payType = order.payType;
        this.commit('setOrderTemplate', update);
    },
    setOrderTemplate(state, update = true) {
        if(update) {
            window.scrollTo(0, 0);
        }
        let status = state.order.data.status;
        let mortgage = state.order.data.statusMode ? state.order.data.statusMode : "no";
        let payType = state.order.payType === null ? '' : state.order.payType;

        if(state.order.marriageContract === false) {
            if(status == 6 && payType == 'full') {
                status = 7;
                state.order.data.status = 7;
            }
            if(status == 7 && payType == 'mortgage') {
                status = 8;
                state.order.data.status = 8;
            }
        }
        state.order.template = this.getters.template(`${status}${payType}${mortgage}`);
    },
    setMortgageMode: (state, mode) =>  state.order.data.mortgageMode = mode,
    setTypePay: (state, type) => state.order.payType = type,
    clearOrderData: state => {
        state.order = {
            orderMode: false,
            template: '',
            payType: '',
            data: {}
        };
    },
    updateOrderDataSet: (state, interval) => {
        if(state.updateOrderData !== false) clearInterval(state.updateOrderData);
        state.updateOrderData = interval;
    },
    updateOrderDataClear: state => {
        if(state.updateOrderData !== false) clearInterval(state.updateOrderData);
        state.updateOrderData = false;
    },
    newStep(state, status) {
        state.order.data.status = status;
        this.commit('setOrderTemplate');
    },
    setLoader(state, data) {
        state.loader = data.status;
    },
}
