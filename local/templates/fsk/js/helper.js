class Helper {
    static ready(callbackFunc) {
        if (document.readyState !== 'loading') {
            callbackFunc();
        } else if (document.addEventListener) {
            document.addEventListener('DOMContentLoaded', callbackFunc);
        } else {
            document.attachEvent('onreadystatechange', function() {
                if (document.readyState === 'complete') {
                    callbackFunc();
                }
            });
        }
    }
    static getUrlParams(query = {}) {
        const vars = window.location.search.substring(1).split("&");
        if(vars[0] === '') return false;
        vars.forEach((item) => {
            let [key, value] = [...(item.split("="))];
            value = decodeURIComponent(value);
            if(typeof query[key] === "string") query[key] = [query[key]];
            if(typeof query[key] === "undefined") {
                query[key] = value;
            } else {
                query[key].push(value);
            }
        });
        return query;
    }
    static addEvent(parent, evt, selector, handler) {
        parent.addEventListener(evt, function(event) {
            if (event.target.matches(selector + ', ' + selector + ' *')) {
                handler.apply(event.target.closest(selector), arguments);
            }
        });
    }
    static easeInCubic (t) {
        return t*t*t
    }
    static scrollToElem (startTime, currentTime, duration, scrollEndElemTop, startScrollOffset) {
        const runtime = currentTime - startTime;
        let progress = runtime / duration;

        progress = Math.min(progress, 1);

        const ease = Helper.easeInCubic(progress);

        window.scroll(0, startScrollOffset + (scrollEndElemTop * ease));
        if(runtime < duration){
            requestAnimationFrame((timestamp) => {
                const currentTime = timestamp || new Date().getTime();
                scrollToElem(startTime, currentTime, duration, scrollEndElemTop, startScrollOffset);
            })
        }
    }
    static deletElementArray(array, deleteIndex) {
        var index = array.indexOf(deleteIndex);
        return index > -1 ? array.splice(index, 1) : array;
    }
    static openBlock(elem) {
        elem.classList.remove("none")
    }
    static closedBlock(elem) {
        elem.classList.add("none")
    }
    static ocBlcok(elem, open = true) {
        if(open) Helper.openBlock(elem);
        else Helper.closedBlock(elem);
    }
    static initMask(elem, mask) {
        IMask(elem, mask);
    }
    static click (elem) {
        let evt = new MouseEvent('click', { bubbles: true, cancelable: true, view: window });
        !elem.dispatchEvent(evt);
    };
}
class QuerySend {
    static querySendPost(data, callback, pathSend = false) {
        pathSend = pathSend ? pathSend : window.location.pathname;
        let newXHR = new XMLHttpRequest();
        newXHR.addEventListener( 'load', (request) => {
            if(request.target.readyState == 4 && request.target.status) {
                let response = JSON.parse(request.target.response);
                callback(response);
            } else alert('Ошибка обратитесь к администратору');
        });
        newXHR.open( 'POST', pathSend, true);
        newXHR.send( data );
    }
}
