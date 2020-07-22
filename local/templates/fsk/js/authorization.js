

class Authorization {
    constructor() {
        this.data = {
            confirmCodeRepeat:false,
        };
        this.$c = {
            modalBtmOpen: ".login-modal-open",
            modalBtmLogout: ".login-modal-logout",
            form: ".auth",
            formAuthorize: "#auth",
            formRegister: "#register",
            tabElement: "[data-tabs-selector]",
            tabAuhorize: "[data-tabs-selector=auth]",
            sendBtm: "[data-send]",
            sendSMSBtm: "[data-send-sms]",
            closeModalBtm: "[data-closed-modal]",
            phone: "[name=phone]",
            confirmCodeRepeat: ".confirm-code-repeat",
        };
        this.initUseElement();
        this.initEvent();
    }
    initUseElement() {
        this.$e = {};
        for(let key in this.$c) {
            this.$e[key] = document.querySelectorAll(this.$c[key]);
        }
    }
    checkDataActiveForm() {
        let formData = {};

        let error = false;
        let errorMessage = '';

        let form = document.querySelector('.auth .auth-block .auth-block-content:not(.none)');
        let formType = form.getAttribute('id');

        let input = form.querySelectorAll('input');

        input.forEach(element => {
            let name = element.getAttribute('name');
            formData[name] = element.value;
            let errorInner = false;
            let length = false;

            if(!element.value) {
                errorInner = true;
                errorMessage = "Поле не заполнено";
            }

            if(errorInner === false) {
                switch(name) {
                    case "fio":
                        let fio = element.value.match(/ /g);
                        if(fio == null || fio.length > 2) {
                            errorInner = true;
                            if(error == false) errorMessage = "Не верный формат ФИО";
                        }
                    break;
                    case "phone":
                        if(element.value.replace(/\D+/g,"").length != 11) {
                            errorInner = true;
                            if(error == false) errorMessage = "Не правильно введен телефон";
                        }
                    break;
                }
            }

            if(errorInner) {
                element.classList.add('error');
                error = true;
            } else {
                element.classList.remove('error');
            }
        });

        if(formData.password !== undefined && formData.password_change !== undefined) {
            if(formData.password != formData.password_change) {
                if(error === false) {
                    errorMessage = 'Пароли не совпадают';
                }
                error = true;
            }
        }
        if(error) {
            alert(errorMessage);
        } else {
            this.sendDataActiveForm(formType, formData);
        }
    }
    sendDataActiveForm(formType, data) {
        let formData = new FormData();
        let link = false;
        for(let key in data) {
            formData.append(key, data[key]);
        }
        switch (formType) {
            case "register":
                link = '/ajax/?act=User.RegisterUser';
            break;
            case "auth":
                link = '/ajax/?act=User.LoginUser';
            break;
            case "authBySms":
                link = '/ajax/?act=User.LoginUserBySMS';
            break;
        }
        QuerySend.querySendPost(formData, (response) => {
            if (response.isSuccess == true) {
                alert(response.message);
                if(formType) {
                    window.location.href = '/lk/';
                } else {
                    window.location.reload();
                }
            } else {
                alert(response.message);
            }
        }, link);

        console.log(formType, data);
    }
    closeConfirmCodeRepeat() {
        this.$e.confirmCodeRepeat[0].classList.add('none');
        this.data.confirmCodeRepeat = setTimeout(() => {
            this.$e.confirmCodeRepeat[0].classList.remove('none');
        }, 60000);
    }
    actionLogOut() {
        QuerySend.querySendPost({}, (response) => {
            if (response.isSuccess == true) {
                window.location.reload();
            } else {
                alert(response.message);
            }
        }, '/ajax/?act=User.Logout');
    }
    actionSendSMS() {
        let form = document.querySelector('.auth .auth-block .auth-block-content:not(.none)');
        let input = form.querySelectorAll('input');
        let formData = {};
        let formDataS = new FormData();
        input.forEach(element => {
            let name = element.getAttribute('name');
            formData[name] = element.value;
            formDataS.append(name, element.value);
        });


        //return false;
        if(formData['phone']) {
            QuerySend.querySendPost(formDataS, (response) => {
                if (response.isSuccess == true) {
                    this.closeConfirmCodeRepeat();
                    let smsFiled = document.querySelectorAll('[name="sms"]');
                    this.$e.sendBtm[0].classList.remove('none');
                    this.$e.sendSMSBtm[0].classList.add('none');
                    smsFiled[0].closest('.auth-block-content-input').classList.remove('none');
                } else alert(response.message);
            }, '/ajax/?act=User.SendSMSCheck');
        } else {
            alert('Не введен телефон');
        }
    }
    initEvent() {

        if(this.$e.modalBtmLogout.length === 0) {
            this.$e.phone.forEach( element => Helper.initMask(element, { mask: '+{7} (000) 000-00-00' }) );

            Helper.addEvent(document, 'click', this.$c.sendBtm, (e) => this.checkDataActiveForm() );
            Helper.addEvent(document, 'click', this.$c.sendSMSBtm, (e) => this.actionSendSMS() );
            Helper.addEvent(document, 'click', this.$c.confirmCodeRepeat, (e) => this.actionSendSMS() );

            [this.$c.closeModalBtm, this.$c.modalBtmOpen].forEach((selector) => {
                Helper.addEvent(document, 'click', selector, (e) => {
                    e.preventDefault();
                    let event = (selector == this.$c.modalBtmOpen) ? 'openBlock' : 'closedBlock';
                    Helper[event](this.$e.form[0]);
                    //this.$e.tabAuhorize[0].click();
                    return false;
                });
            });
            Helper.addEvent(document, 'click', this.$c.modalBtmOpen, (e) => Helper.openBlock(this.$e.form[0]) );
            // Helper.addEvent(document, 'click', this.$c.tabElement, (e) => {
            //     const nameTab = e.target.getAttribute('data-tabs-selector');
            //     this.$e.tabElement.forEach(element => element.classList.remove('active') );
            //     e.target.classList.add('active');
            //     Helper.ocBlcok(this.$e.formAuthorize[0], nameTab == 'auth');
            //     Helper.ocBlcok(this.$e.formRegister[0], nameTab == 'register');
            // });
        } else {
            Helper.addEvent(document, 'click', this.$c.modalBtmLogout, (e) => this.actionLogOut() );
        }
    }
}
new Authorization();
