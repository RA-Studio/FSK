import "../scss/style.scss";

import "./App.js";
import "../vue/app.js";

// Temp for show popups
$(function () {

    var oMainApp = {

        oBody: $('body'),
        oAuthModal: $('#auth-popup'),
        oSignUpModal: $('#reg-popup'),
        oConfirmModal: $('#confirm-popup'),
        oSuccessModal: $('#success-popup'),
        oUkepModal: $('#ukep-popup'),

        oOrderWrapper: $('.j_order_wrapper'),
        oConfirmOrderWrapper: $('.j_order_confirm_wrapper'),

        init: function() {

        }
    };

    oMainApp.init();
});


