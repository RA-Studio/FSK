<!-- PhotoSwipe gallery -->
<!-- Root element of PhotoSwipe. Must have class pswp. -->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

    <!-- Background of PhotoSwipe. 
         It's a separate element, as animating opacity is faster than rgba(). -->
    <div class="pswp__bg"></div>

    <!-- Slides wrapper with overflow:hidden. -->
    <div class="pswp__scroll-wrap">

        <!-- Container that holds slides. PhotoSwipe keeps only 3 slides in DOM to save memory. -->
        <!-- don't modify these 3 pswp__item elements, data is added later on. -->
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>

        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
        <div class="pswp__ui pswp__ui--hidden">

            <div class="pswp__top-bar">

                <!--  Controls are self-explanatory. Order can be changed. -->

                <div class="pswp__counter"></div>

                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

                <button class="pswp__button pswp__button--share" title="Share"></button>

                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                <!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR -->
                <!-- element will get class pswp__preloader--active when preloader is running -->
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div> 
            </div>

            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
            </button>

            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
            </button>

            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>

        </div>

    </div>

</div>
<!-- PhotoSwipe gallery end -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->

<script src="js/bootstrap.min.js"></script>

<!-- PhotoSwipe -->
<script src="js/photoswipe/dist/photoswipe.min.js"></script>
<script src="js/photoswipe/dist/photoswipe-ui-default.min.js"></script>
<!-- PhotoSwipe end -->

<!-- photoswipe_implementation (для просмотрщика фотографий) -->
<script src="js/photoswipe_implementation.js"></script>
<!-- photoswipe_implementation (для просмотрщика фотографий) end -->

<!-- photoswipe_implementation_my-photogalereya-grid (для просмотрщика фотографий в section_photogalereya) -->
<script src="js/photoswipe_implementation_my-photogalereya-grid.js"></script>
<!-- photoswipe_implementation_my-photogalereya-grid (для просмотрщика фотографий в section_photogalereya) end -->

<!-- Tooltip (bootstrap) -->
<script type='text/javascript'>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip({
            'html':true
        });
    });
</script>
<!-- Tooltip (bootstrap) end -->

<!-- mask.js -->
<script src="js/mask.js"></script>
<!-- mask.js end -->

<!-- scrollToElement (navbar_with_menu_scroll) -->
<script>
    function scrollToDiv(element,navheight){
    var offset = element.offset();
    var offsetTop = offset.top; 
    var totalScroll = offsetTop-navheight;

    $('body,html').animate({
    scrollTop: totalScroll
    }, 1000); //скорость анимации прокрутки
    }

    $('.navbar_with_menu_scroll a').click(function(){ //тут вешаем обработчик на ссылку или что угодно
    var el = $(this).attr('href');
    var elWrapped = $(el);
    var offsetTop = 105; //вместо 105 можно указать любой offset (отступ от верхнего края)
    scrollToDiv(elWrapped, offsetTop); 

    return false;
    });
</script>
<!-- scrollToElement (navbar_with_menu_scroll) end -->

<!-- Auto-opening for modal #modal_with_auto_opening___discount_popup -->
<script type="text/javascript">
$(window).load(function() {
  // задержка 0,1 секунд
  setTimeout(function(){
    // вызвать модальное окно
    $('#modal_with_auto_opening___discount_popup').modal();
  }, 100);
});
</script>
<!-- Auto-opening for modal #modal_with_auto_opening___discount_popup end -->

<!-- Filter for f_list -->
<script type="text/javascript">
var fActive = '';
 
function filterColor(color){
 if(fActive != color){
 $('.f_list_item_filterable').filter('.'+color).slideDown();
 $('.f_list_item_filterable').filter(':not(.'+color+')').slideUp();
 fActive = color;
 }
}
 
$('.f-red').click(function(){ filterColor('red'); });
$('.f-blue').click(function(){ filterColor('blue'); });
$('.f-green').click(function(){ filterColor('green'); });
 
$('.f-all').click(function(){
 $('.f_list_item_filterable').slideDown();
 fActive = 'all';
});
</script>

<script type="text/javascript">
var orderdirection = new Array();
function is_num( text, flag )
{
    if( flag == 0 )
    {
        return text;
    }else
    {
        return parseFloat( text );
    }
}
function oi_div_order( selector, container, block, flag )
{
    block = container + ' ' + block;
    var ordered_dives = $( block ).sort(function (a, b)
    {
        a = $(a).find( '[data-name=' + selector + ']' ).text();
        b = $(b).find( '[data-name=' + selector + ']' ).text();
        if( orderdirection[ selector ] == undefined || orderdirection[ selector ] == 0 )
        {
            return ( is_num( a, flag ) > is_num( b, flag ) ) ? 1 : ( is_num( a, flag ) < is_num( b, flag ) ) ? -1 : 0;
        }else{
            return ( is_num( a, flag ) < is_num( b, flag ) ) ? 1 : ( is_num( a, flag ) > is_num( b, flag ) ) ? -1 : 0;
        }
    });
    $( container ).html( ordered_dives );
    
    if( orderdirection[ selector ] == undefined || orderdirection[ selector ] == 0 )
    {
        orderdirection[ selector ] = 1;
        $( '[data-order=' + selector + ']' ).addClass( 'up' );
    }else{
        orderdirection[ selector ] = 0;
        $( '[data-order=' + selector + ']' ).removeClass( 'up' );
    }
}
$('[data-orderby]').on('click', function () {
    var orderby = $(this).data( 'orderby' );
    switch ( orderby )
    {
      case 'number': flag = 1; break;
      default: flag = 0;
    }
    oi_div_order( orderby, '.f_list_block', '.f_list_item_filterable', flag );
});
</script>
<!-- Filter for f_list end -->

<!-- Sorting for f_list -->
<script type="text/javascript">
$('.sort_link').click(function (event) {
    const target = $(event.target.parentNode);
    if (target.hasClass('active')) {
        if (target.hasClass('asc')) {
            target.removeClass('asc');
            target.addClass('desc');
        } else {
            target.removeClass('desc');
            target.addClass('asc');
        }
    } else {
        $('.sort_link').removeClass('active')
        target.addClass('active');
    }

    window.location.href = setUrlParameter(window.location.href.replace(/#/g, ''), 'sort', `${($('.sort_link.active').hasClass('desc') ? '-' : '')}${$('.sort_link.active').data('value')}`);

    event.preventDefault();
});
</script>
<!-- Sorting for f_list end -->

<!-- -->
<script type="text/javascript">
$(document).ready(function(){
    $('.f_list_navbar_filer_wrap button').click(function () {
    $(".f_list_navbar_filer_wrap button").toggleClass('active');
    });
});
</script>
<!-- -->

<!-- Envybox -->
<link rel="stylesheet" href="https://cdn.envybox.io/widget/cbk.css">
<script type="text/javascript" src="https://cdn.envybox.io/widget/cbk.js?wcb_code=d34c8e032f67b6a1e5bc2e0924f1f9ad" charset="UTF-8" async></script>
<!-- Envybox end -->

</body>
</html>