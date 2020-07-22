$(document).ready(function(){

  $(document).on('click', '#schet-platezh', function(e){
    //e.preventDefault();
    console.log('1');
    $('html, body').animate({
      scrollTop: $('.project-ipo').offset().top - 130
    });
  });
  /*$('[data-type="content"]').hide();
  $('.reservation-oferta').show();*/
  $('[data-btn="confirm"]').on('click',function (e) {
    $('html, body').animate({scrollTop: 0},500);
    $('[data-type="nav"]').removeClass('active');
    $('[data-id="confirm"]').addClass('completed');
    $('[data-id="card"]').addClass('active');
    $('.reservation-card').show();
    $('.reservation-oferta').hide();
  })
  $('[data-type="pay"]').on('click',function (e) {
    var form = $('#card');
    if(!raValidation(form)){
      return false
    }
    var data = form.serialize();
    var success = $('#success');
    $.ajax({
      url:'/ajax/?act=Order.CreatedOrder',
      type:'POST',
      dataType: 'json',
      data: data,
      success:function (success) {
        var href= `payment.php?ORDER_ID=${success.result.ORDER_ID}&PAYMENT=${success.result.ORDER_ID}/1`;
        switch (success.message) {
          case 'first_name':
            form.find('input[name="first_name"]').css('border','3px solid red')
            break;
          case 'last_name':
            form.find('input[name="last_name"]').css('border','3px solid red')
            break;
          case 'email':
            form.find('input[name="email"]').css('border','3px solid red')
            break;
          case 'tel':
            form.find('input[name="tel"]').css('border','3px solid red')
            break;
          case 'empty':
            //success.html('<p>В заказе нет квартиры!</p>');
            break;
          case 'nonexistent':
            //success.html('<p>На данный момент квартира не доступна для резирвирования!</p>');
            break;
          case 'ok':
            location.href=href;
          break;
          default:
            console.log(success.message);
            //success.html(success);
          break;
        }
      },
      error:(function (error) {
      })
    });
  });

  $('[data-type="reserveBtn"]').on('click',function (e) {
    e.preventDefault();
    var href = $(this).attr('href').toString();
    var iblock = $(this).data('iblock');
    var id =  $(this).data('id');
    $.ajax({
      url: href,
      type:'POST',
      dataType:'html',
      data: `id=${id}&iblock=${iblock}`,
      success:function (data) {
        //console.log($(data).find('#post').html());
        location.href=href;
      }
    });
  })
});

/*Пагинация готовых проектов*/
$(document).ready(function () {
  $('[data-entity="showMore"]').on('click',function (e) {
    let count = parseInt($(this).data('count'))+1;
    let limit = parseInt($(this).data('limit'));
    let url = $(this).data('url');
    let navNum = parseInt($(this).data('num'));
    let $this = $(this);
    let container = $(document).find(`[data-entity="container-${navNum}"]`);
    $.ajax({
      type: 'GET',
      url:url,
      success:function(result) {
        container.append($(result).find(`[data-entity="container-${navNum}"]`).html());
        if (limit>(count)) {
          $this.data('count', count);
        }else{
          $this.remove();
        }
      }
    });
  });



  $('#js-demo-more_project').on('click',function (e) {
    let count = parseInt($(this).data('count'))+1;
    let limit = parseInt($(this).data('count'));
    let _this = $(this).parent('.p-list-more').siblings('.completed-projects');
    $.ajax({
      type: 'GET',
      data: {PAGEN_1:count},
      success:function(result) {
        _this.append(result);
      }
    });
    if (limit>count) {
      $(this).data('count', count);
    }else{
      $(this).remove();
    }
  });
  $('#js-demo-more_raiting').on('click',function (e) {
    let count = parseInt($(this).data('count'))+1;
    let limit = parseInt($(this).data('count'));
    let _this = $(this).parent('.p-list-more').siblings('.f-row');
    $.ajax({
      type: 'GET',
      data: {PAGEN_2:count},
      success:function( result) {
        _this.append(result);
      }
    });
    if (limit>count) {
      $(this).data('count', count);
    }else{
      $(this).remove();
    }
  });
});
/*Пагинация готовых проектов конец*/
