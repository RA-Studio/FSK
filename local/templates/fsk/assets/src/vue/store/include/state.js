export default {
    auth: false,
    locationImg: '/local/templates/fsk/assets/src/images',
    idMessage: false,
    loader: false,
    lk: {
        fksPhone: '8 (812) 703-55-55',
        fskEmail: 'help@fsknw.ru',
        fskTimeWork: 'Ежедневно, с 9:00 до 21:00',
    },
    mortgage: {
        approval: {
            link: {
                'all'  : `/local/templates/fsk/assets/src/images/mortgage/VTB_anketa.pdf`,
                'sber' : `/local/templates/fsk/assets/src/images/mortgage/Sberbank_anketa.pdf`,
                'open' : `/local/templates/fsk/assets/src/images/mortgage/Otkrytie_sogl.docx`,
                'alfa' : `/local/templates/fsk/assets/src/images/mortgage/Alfabank_sogl.pdf`,
                'spb'  : `/local/templates/fsk/assets/src/images/mortgage/Spb_sogl.docx`,
            }
        }
    },
    updateOrderData: false,
    order: {
        orderMode: false,
        template: '',
        payType: '',
        marriageContract: '',
        data: {},
    }
}
