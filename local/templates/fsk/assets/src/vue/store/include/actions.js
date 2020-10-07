export default {
    addGlobalMessege({state}, data = {message: false, type: 'ok', time: 5000}) {
        if(data.message == false) data.message = '';
        if(data.time == false || data.time == undefined) data.time = 5000;
        if(data.type == 'ok') {
            data.type = 'success';
        } else if (data.type == 'error') {
            data.type = 'error';
        } else if (data.type == 'warning') {
            data.type = 'warning';
        }else {
            console.log('Такого типа сообщений не существует');
            return false;
        }

        const clearMessage = () => {
            clearTimeout(state.idMessage);
            document.querySelectorAll('[data-popup-block-float]').forEach(element => {
              element.remove();
            });
        };

        clearMessage();
        let body = document.getElementsByTagName("body")[0];
        let messageBody = `<div data-popup-block-float class = "global-popup-message ${data.type}"><div>${data.message}</div></div>`;
        body.insertAdjacentHTML('beforeend', messageBody);
        state.idMessage = setTimeout(() => clearMessage(), data.time);
    }
}
