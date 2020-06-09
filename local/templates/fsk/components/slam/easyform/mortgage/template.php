<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Localization\Loc;

$FORM_ID           = trim($arParams['FORM_ID']);
$FORM_AUTOCOMPLETE = $arParams['FORM_AUTOCOMPLETE'] ? 'on' : 'off';
$FORM_ACTION_URI   = "";
$WITH_FORM = strlen($arParams['WIDTH_FORM']) > 0 ? 'style="max-width:'.$arParams['WIDTH_FORM'].'"' : '';
?>
<div class="modal ipo-request mfp-hide" id="<?=$FORM_ID?>-request">
    <div class="ipo-request__body">
        <div class="ipo-request__header">
            <div class="ipo-bank">
                <img src="/local/templates/fsk/img/ipo/vtb.png" class="img" alt="ВТБ">
            </div>
            <button class="close-btn mfp-close" type="button"></button>
        </div>
        <div class="ipo-request__data">
            <div class="data-col">
                <div>
                    Банк ВТБ
                </div>
                <div class="sub-text">
                    Лицензия № 1481 от 11.08.2015
                </div>
            </div>
            <div class="data-row">
                <div class="data-col">
                    <div class="sub-text text-bold">
                        Ставка
                    </div>
                    от 6.5%
                </div>
                <div class="data-col">
                    <div class="sub-text text-bold">
                        Срок
                    </div>
                    до 25 лет
                </div>
                <div class="data-col">
                    <div class="sub-text text-bold">
                        Ежемесячный платёж, р.
                    </div>
                    50 782
                </div>
            </div>
        </div>
    </div>
    <div class="ipo-request__form">
        <div class="h2 cta__title">
            <?=$arParams['~FORM_NAME']?>
        </div>
        <div class="cta__form cta-form">
            <form id="<?=$FORM_ID?>"
                  enctype="multipart/form-data"
                  method="POST"
                  action="<?=$FORM_ACTION_URI;?>"
                  autocomplete="<?=$FORM_AUTOCOMPLETE?>"
                  novalidate="novalidate">
                <div class="cta-form__row f-row">
                    <input type="hidden" name="FORM_ID" value="<?=$FORM_ID?>">
                    <input type="text" style="display: none" name="ANTIBOT[NAME]" value="<?=$arResult['ANTIBOT']['NAME'];?>" class="hidden">
                    <?//hidden fields
                    foreach($arResult['FORM_FIELDS'] as $fieldCode => $arField)
                    {
                    if($arField['TYPE'] == 'hidden')
                    {
                    ?>
                    <input type="hidden" name="<?=$arField['NAME']?>" value="<?=$arField['VALUE'];?>"/>
                    <?
                        unset($arResult['FORM_FIELDS'][$fieldCode]);
                    }
                }?>
                    <?if(!empty($arResult['FORM_FIELDS'])){?>
                        <?foreach($arResult['FORM_FIELDS'] as $fieldCode => $arField){
                            if(!$arParams['HIDE_ASTERISK'] && !$arParams['HIDE_FIELD_NAME']){
                                $asteriks = ':';
                                if($arField['REQUIRED']) {
                                    $asteriks = '<span class="asterisk">*</span>:';
                                }
                                $arField['TITLE'] = $arField['TITLE'].$asteriks;
                            }
                            switch ($arField['TYPE']){
                            case 'textarea':?>
                                <div class="general-itemInput">
                                    <textarea rows="1" oninput="auto_grow(this)" class="general-itemInput__input general-itemInput__input_text" id="<?=$arField['ID']?>" cols="30" name="<?=$arField['NAME']?>" <?=$arField['PLACEHOLDER_STR'];?> <?=$arField['REQUIRED']?'data-required':''?>><?=$arField['VALUE'];?></textarea>
                                    <script>
                                        function auto_grow(element) {
                                            element.style.height = "2px";
                                            element.style.height = (element.scrollHeight)+"px";
                                        }
                                    </script>
                                    <? if(!$arParams['HIDE_FIELD_NAME']): ?>
                                        <label for="<?=$arField['ID']?>" class="general-itemInput__label"><?=$arField['TITLE']?></label>
                                    <? endif; ?>
                                </div>
                                <?break;
                            case 'checkbox':
                            ?>
                            <div class="general-btnBlock__title <?= $arField['CLASS'] ?>"><?= $arField['TITLE'] ?></div>
                            <div class="general-btnBlock-wrap"><?
                                foreach ($arField['VALUE'] as $key => $arVal) {
                                    if (!empty($arVal)) {
                                        ?>
                                        <input type="<?= $arField['TYPE'] ?>" name="<?= $arField['NAME'] ?>"
                                               value="<?= $arVal ?>" <?= $arField['REQUIRED'] ? 'data-required' : '' ?> id="<?= $arField['ID'].$key?>"
                                               class="general-btnBlock__check">
                                        <label class="general-btnBlock__label" for="<?= $arField['ID'] . $key ?>"><?= $arVal ?></label>
                                        <?
                                    }
                                }
                            ?></div><?
                            break;
                            case 'tel':
                                ?><div class="cols col-1-3">
                                    <input type="text" data-type="<?= $arField['TYPE']; ?>" name="<?= $arField['NAME'] ?>"
                                           value="<?= $arField['VALUE']; ?>" <?= $arField['PLACEHOLDER_STR']; ?> <?= $arField['REQUIRED'] ? 'data-required' : '' ?> <?= $arField['MASK_STR'] ?>
                                           id="<?= $arField['ID'] ?>" class="input">
                                    <?
                                    if (!$arParams['HIDE_FIELD_NAME']) {
                                        ?>
                                        <label for="<?= $arField['ID'] ?>" class="general-itemInput__label"><?= $arField['TITLE'] ?></label>
                                        <?
                                    } ?>
                                </div><?
                                break;
                            case 'accept':?>
                                <div class="general-itemInput general-itemInput_c <?=$arField['CLASS']?>">
                                    <input type="checkbox" value="<?=Loc::getMessage('SLAM_EASYFORM_YES')?>" <?=$arField['REQUIRED']?'data-required':''?>  name="<?=$arField['NAME']?>" class="general-itemInput__check" id="soglasen-huli">
                                    <label for="soglasen-huli" class="general-itemInput__check-label">
                                        <div>
                                            <span></span>
                                        </div>
                                        <?=htmlspecialcharsBack($arField['VALUE'])?>
                                    </label>
                                </div>
                                <?
                                break;
                            case 'email':
                                ?>
                            <div class="general-itemInput <?= $arField['CLASS'] ?>">
                                <input type="text" data-type="<?= $arField['TYPE']; ?>" name="<?= $arField['NAME'] ?>"
                                       value="<?= $arField['VALUE']; ?>" <?= $arField['PLACEHOLDER_STR']; ?> <?= $arField['REQUIRED'] ? 'data-required' : '' ?> <?= $arField['MASK_STR'] ?>
                                       id="<?= $arField['ID'] ?>" class="general-itemInput__input"><?
                                if (!$arParams['HIDE_FIELD_NAME']) {
                                    ?>
                                    <label for="<?= $arField['ID'] ?>" class="general-itemInput__label"><?= $arField['TITLE'] ?></label>
                                    <?
                                } ?>
                                </div><?
                                break;
                            case 'radio':
                                ?>

                                <div class="general-btnBlock__title"><?=$arField['TITLE'] ?></div>
                                <div class="general-btnBlock-wrap"><?
                                    foreach ($arField['VALUE'] as $key => $arVal) {
                                        if (!empty($arVal)) {
                                            ?>
                                            <input type="<?= $arField['TYPE'] ?>" name="<?= $arField['NAME'] ?>"
                                                   value="<?= $arVal ?>" <?=$arField['REQUIRED']?'data-required':''?> id="<?= $arField['ID'] . $key ?>"
                                                   class="general-btnBlock__check">
                                            <label class="general-btnBlock__label" for="<?= $arField['ID'] . $key ?>"><?= $arVal ?></label>
                                            <?
                                        }
                                    }
                                    ?>
                                </div>
                                <?
                                break;
                            case 'file':?>
                                <div class="general-itemInput general-itemInput_file">
                                    <? $CID = $GLOBALS["APPLICATION"]->IncludeComponent(
                                        'bitrix:main.file.input',
                                        $arField['DROPZONE_INCLUDE'] ? 'drag_n_drop' : '.default',
                                        array(
                                            'HIDE_FIELD_NAME' => $arParams['HIDE_FIELD_NAME'],
                                            'INPUT_NAME' => $arField['CODE'],
                                            "TITLE"=> $arField['TITLE'],
                                            'INPUT_TITLE' => $arField['TITLE'],
                                            'INPUT_NAME_UNSAVED' => $arField['CODE'],
                                            'MAX_FILE_SIZE' => $arField['FILE_MAX_SIZE'],//'20971520', //20Mb
                                            'MULTIPLE' => 'Y',
                                            'CONTROL_ID' => $arField['ID'],
                                            'MODULE_ID' => 'slam.easyform',
                                            'ALLOW_UPLOAD' => 'F',
                                            'ALLOW_UPLOAD_EXT' => $arField['FILE_EXTENSION'],
                                        ),
                                        $component,
                                        array("HIDE_ICONS" => "Y")
                                    );?>
                                    <div class="general-itemInput-box"></div>
                                </div>
                                <?
                                break;
                            case 'select':
                                break;
                            default:
                                ?>
                                <div class="cols col-1-3">
                                    <input type="text" data-type="" name="<?= $arField['NAME'] ?>"
                                             value="<?= $arField['VALUE']; ?>" <?= $arField['PLACEHOLDER_STR']; ?> <?= $arField['REQUIRED'] ? 'data-required' : '' ?> <?= $arField['MASK_STR'] ?>
                                             id="<?= $arField['ID'] ?>" class="input">
                                    <?
                                    if (!$arParams['HIDE_FIELD_NAME']) {
                                        ?>
                                        <label for="<?= $arField['ID'] ?>" class="general-itemInput__label"><?= $arField['TITLE'] ?></label>
                                        <?
                                    } ?>
                                </div>
                                <?
                                break;
                            }
                        }?>
                    <?}?>
                    <div class="cols col-1-3">
                        <button class="btn btn--cta" type="submit" data-default="<?=$arParams['FORM_SUBMIT_VALUE']?>">
                            <img class="svg btn__ic ic-tel" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-tel.svg" alt="phone" width="12" height="20">
                            <?=$arParams['FORM_SUBMIT_VALUE']?>
                        </button>
                    </div>
                </div>
                <?if($arResult['WARNING_MSG']){?>
                    <p class="privacy"><?=$arResult['WARNING_MSG'];?></p>
                <?}?>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    var easyForm = new JCEasyForm(<?echo CUtil::PhpToJSObject($arParams)?>);
    function <?=$arParams['_CALLBACKS']?>() {
          $('#<?=$FORM_ID?>').find('input, textarea, button').attr('disabled', 'disabled');
          setTimeout(function(){
              $('#<?=$FORM_ID?>').find('input, textarea').val('').removeClass('input-border');
              $('#<?=$FORM_ID?>').find('input, textarea, button').removeAttr('disabled');
              $.magnificPopup.open({
                  items: {
                      src: '#modal-ipo-success',
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
          }, 1000);
    }
</script>
