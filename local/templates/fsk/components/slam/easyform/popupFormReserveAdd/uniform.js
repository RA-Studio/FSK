$(document).ready(function(){$(document).find('[data-type="tel"]').inputmask({mask:"+7 (999) 999-99-99",showMaskOnHover:!1,showMaskOnFocus:!0});$('[data-type="email"]').each(function(){if($(this).attr('data-regexp')===undefined){$(this).inputmask({alias:"email",showMaskOnHover:!1,showMaskOnFocus:!0})}})});var pattern=/^[a-z0-9_-]+@[a-z0-9-]+\.([a-z]{1,6}\.)?[a-z]{2,6}$/i;$(document).on('blur','input.general-itemInput__input:not(input[data-type="tel"]):not(input[data-type="email"]), textarea',function(){if($(this).val()!=''){$(this).addClass('input-border');$(this).removeClass('input-err')}else{$(this).removeClass('input-border')}});$(document).on('blur','input.general-itemInput__input, textarea',function(){if($(this).val()!=''){$(this).parent().find('label:not(.general-itemInput__check)').addClass('general-itemInput__label_top')}else{$(this).parent().find('label:not(.general-itemInput__check)').removeClass('general-itemInput__label_top')}})
$(document).on('blur','input[data-type="tel"], input[data-type="email"]',function(){if($(this).attr('data-required')!==undefined){if($(this).attr('data-regexp')!==undefined){if($(this).val()!=''){if($(this).val().search(pattern)==0){$(this).removeClass('input-err');$(this).addClass("input-border")}else{$(this).addClass('input-err');$(this).removeClass("input-border")}}else{$(this).removeClass('input-err');$(this).removeClass("input-border")}}else{if(!$(this).inputmask("isComplete")){$(this).addClass("input-err");$(this).removeClass("input-border")}else{$(this).removeClass("input-err");$(this).addClass("input-border")}
  if($(this).val()==''){$(this).removeClass("input-err");$(this).removeClass("input-border")}}}else{if($(this).attr('data-regexp')!==undefined){if($(this).val().search(pattern)==0){$(this).addClass("input-border")}else{$(this).removeClass("input-border")}}else{if(!$(this).inputmask("isComplete")){$(this).removeClass("input-border")}else{$(this).addClass("input-border")}}}});$(document).on('click','button[type="submit"]',function(e){e.preventDefault();if(!raValidation($(this).closest('form'))){return!1}else{$(this).closest('form').submit()}});function raValidation(form){let inputs=form.find('[data-required=""]'),temp=!0;for(var i=0;i<inputs.length;i++){if(!inputs.eq(i).hasClass('input-border')){inputs.eq(i).addClass('input-err');temp=!1}else{inputs.eq(i).removeClass('input-err')}}
  if(temp==!1){return!1}else{return!0}}
$('button[data-type="cleanForm"]').click(function(e){e.preventDefault();$(this).closest('form').find('input, textarea').prop('checked',!1).removeClass('input-err').removeClass('input-border').val('')});$(document).on('change','input[type=file]',function(){let i=0,inp=this,files1=inp.files,len=files1.length,forma=$(this).closest('form');forma.find('.general-itemInput_file__label').fadeOut('fast');setTimeout(()=>{for(;i<len;i++){forma.find('.general-itemInput-box').append('<p class="general-itemInput-box__item">'+$(this)[0].files[i].name+'</p>')}
  forma.find('.general-itemInput__exit').fadeIn('fast')},200)});$(document).on('click','.general-itemInput__exit',function(){$(this).closest('form').find('.general-itemInput_file__label').fadeIn();$(this).fadeOut();$(this).closest('form').find('.general-itemInput-box p').remove();$(this).closest('form').find('input[type=file]').files=[]})