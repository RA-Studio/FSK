<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Localization\Loc;
$FORM_ID           = trim($arParams['FORM_ID']);
$FORM_AUTOCOMPLETE = $arParams['FORM_AUTOCOMPLETE'] ? 'on' : 'off';
$FORM_ACTION_URI   = "";
$WITH_FORM = strlen($arParams['WIDTH_FORM']) > 0 ? 'style="max-width:'.$arParams['WIDTH_FORM'].'"' : '';
?>
<div class="project-ipo" id="<?=$FORM_ID?>-request">
    <div class="container">
        <form class="new-form"
              id="<?=$FORM_ID?>"
              enctype="multipart/form-data"
              method="POST"
              action="<?=$FORM_ACTION_URI;?>"
              autocomplete="<?=$FORM_AUTOCOMPLETE?>"
              novalidate="novalidate">
            <input type="hidden" name="FORM_ID" value="<?=$FORM_ID?>">
            <input type="text" style="display: none" name="ANTIBOT[NAME]" value="<?=$arResult['ANTIBOT']['NAME'];?>" class="hidden">
            <div class="new-form-img">
                <img src="/local/templates/fsk/img/call-agent.png" alt="">
                <div class="new-form-img-text">
                    <div class="new-form-img-text__back"></div>
                    <span><?=$arParams['~FORM_NAME']?></span>
                </div>
            </div>
            <div class="new-form-content">
                <?if(!empty($arResult['FORM_FIELDS'])):?>
                    <?foreach ($arResult['FORM_FIELDS'] as $fieldCode => $arField):?>
                        <?if ($arField['TYPE'] === 'radio'):?>
                            <?foreach ($arField['VALUE'] as $key => $radio):?>
                                <?if($key == 0):?>
                                    <div class="new-form-content__text">Удобный для вас канал связи:</div>
                                    <div class="new-form-content-row">
                                <?endif;?>
                                <?$arRadio = explode('|', $radio);?>
                                <label class="new-form-content-row-item">
                                    <img src="/local/templates/fsk/img/<?=$arRadio[1]?>" alt="">
                                    <input id="<?=$arField['ID']?>"
                                           type="<?=$arField['TYPE']?>"
                                           data-type="<?=$arField['TYPE']?>"
                                           name="<?=$arField['NAME']?>" <?=$arField['REQUIRED']?'data-required':''?>
                                           value="<?=$arRadio[0]?>">
                                    <span><?=$arRadio[0]?></span>
                                </label>
                                <?if((count($arField['VALUE'])-1) == $key):?>
                                    </div>
                                <?endif;?>
                            <?endforeach;?>
                        <?elseif ($arField['TYPE'] === 'text'):?>
                            <?if ($arField['CODE'] === 'TITLE'):?>
                                <div class="new-form-content__text">Контактные данные и время:</div>
                                <div class="new-form-content-row">
                            <?endif;?>
                            <?if ($arField['CODE'] === 'TIME'):?>
                                <input class="new-form-content-row__input datepicker-here"
                                       data-timepicker="true"
                                       type="<?=$arField['TYPE']?>" <?=$arField['REQUIRED']?'data-required':''?>
                                       id="<?=$arField['ID']?>"
                                       name="<?=$arField['NAME']?>"
                                       placeholder="<?=$arField['PLACEHOLDER']?>"
                                >
                                </div>
                            <?else:?>
                                <input class="new-form-content-row__input"
                                       id="<?=$arField['ID']?>"
                                       type="<?=$arField['TYPE']?>" 
                                       data-type="<?=$arField['TYPE']?>"
                                       name="<?=$arField['NAME']?>"
                                       placeholder="<?=$arField['PLACEHOLDER']?>"
                                       <?= $arField['REQUIRED'] ? 'data-required' : '' ?>
                                >
                            <?endif;?>
                        <?elseif ($arField['TYPE'] === 'hidden'):?>
                            <input type="hidden" name="<?=$arField['NAME']?>" value="<?=$arField['VALUE'];?>"/>
                        <?endif;?>
                    <?endforeach;?>
                <?endif;?>
                <div class="new-form-content-row">
                    <p>Отправляя форму, вы подтверждаете своё согласие на <a href="">обработку персональных данных</a></p>
                    <button class="btn btn--cta" type="submit" data-default="<?=$arParams['FORM_SUBMIT_VALUE']?>">
                        <?=$arParams['FORM_SUBMIT_VALUE']?></button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    var easyForm = new JCEasyForm(<?echo CUtil::PhpToJSObject($arParams)?>);
    function success_<?=$FORM_ID?>() {
          console.log($('#<?=$FORM_ID?>'));
          $('#<?=$FORM_ID?>').find('input, textarea, button').attr('disabled', 'disabled');
          setTimeout(function(){
              $('#<?=$FORM_ID?>').find('input, textarea').val('').removeClass('input-border');
              $('#<?=$FORM_ID?>').find('input, textarea, button').removeAttr('disabled');
              $.magnificPopup.open({
                  items: {
                      src: '#modal-thanks',
                      type: 'inline'
                  },
                  callbacks: {
                      open: function() {
                          $('body').addClass('mfp-card').removeClass('mfp-top');
                          console.log('open');
                      },
                      close: function() {
                          $('body').removeClass('mfp-card');
                          console.log('close');
                      }
                  }
              });
          }, 500);
    }
</script>
