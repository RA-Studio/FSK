Number.prototype.formatMoney = function(c, d, t){
    var n = this,
        c = isNaN(c = Math.abs(c)) ? 0 : c,
        d = d == undefined ? "," : d,
        t = t == undefined ? " " : t,
        s = n < 0 ? "-" : "",
        i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
        j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};


$(function () {

    $.fn.showAlert = function(sMessage, sType) {
        var $node = $('<div>'),
            sNodeClass = 'cp-alert',
            $nodes = $('.' + sNodeClass),
            iNodePosition,
            $lastNode;

        sType = 'cp-alert--' + sType || '';

        if ($nodes.length) {
            $lastNode = $nodes.last();
            iNodePosition = $lastNode.position().top + $lastNode.innerHeight() + 10;
        }

        $node
            .css('top', iNodePosition + 'px')
            .addClass(sNodeClass + ' ' + sType)
            .html('<div class="btn_remove"></div><p class="cp-alert__text">' + sMessage + '</p>');

        $(this).append($node);

        setTimeout(function() {
            $node.fadeOut(300);
            setTimeout(function() { $node.remove(); }, 900);
        }, 3000);

        $node.on('click', function() {
            $(this).remove();
        });
    };

});
