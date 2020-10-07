export default {
    userInfo: state => state.order.data.userInfo,
    userLastInfo: state => state.order.data.lastOrder.userInfo,
    reserve: state => state.order.data.reserve,
    payType: state => state.order.payType,
    mortgageMode: state => state.order.data.mortgageMode,
    orderStatus: state => + state.order.data.status,
    orderID: state => state.order.data.order,
    orderData: state => state.order.data,
    approvalLink: state => state.mortgage.approval.link,
    file1C: state => state.order.data.file1C,
    getFileNameByUrl: state => url => {
        let urlMass = url.split('/');
        return urlMass[urlMass.length - 1];
    },
    template: state => word => {
        return {
            'empty' : false,
            '2no':'select-block',

            '2fullno':'form-block',
            '3fullno':'order-file-block',
            '4fullno':'application-block',
            '5fullno':'ukep-block',
            '6fullno':'identity-block',
            '7fullno':'check-documents-block',
            '8fullno':'payment-credit-block',
            '9fullno':'prepare-registration-block',
            '10fullno':'sending-registration-block',
            '11fullno':'registration-process-block',
            '12fullno':'deal-end-block',

            '2mortgageno':'form-block',
            '3mortgageA':'order-file-block',
            '3mortgageno':'approval-block',
            '4mortgageno':'mortgage-application-review-block',
            '5mortgageno':'order-file-block',
            '6mortgageno':'signing-purchase-agreement-block',
            '7mortgageno':'identity-block',
            '8mortgageno':'check-documents-block',
            '9mortgageno':'sending-registration-block',
            '10mortgageno':'registration-process-block',
            '11mortgageno':'deal-end-block',
        }[word];
    },
    getUrlParams: state => {
        let query = {};
        const vars = window.location.search.substring(1).split("&");
        if(vars[0] === '') return false;
        vars.forEach((item) => {
            let [key, value] = [...(item.split("="))];
            value = decodeURIComponent(value);
            if(typeof query[key] === "string") query[key] = [query[key]];
            if(typeof query[key] === "undefined") {
                query[key] = value
            } else {
                query[key].push(value)
            }
        });
        return query;
    },
}
