<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?>
<?global $USER;
if ($USER->IsAdmin()):?>
<form class="sms_form" style="width: 500px; margin-top: 100px">
    <input type="text" data-type="tel" name="phone" id="phone">
    <p class="success" style="display:none;">Сообщение отправлено</p>
    <input type="submit" class="send_sms_btn" value="Отправить">
</form>

<script>
    $(document).on('click', '.send_sms_btn', function (e) {
        e.preventDefault();
        const form = $(this).closest('form');
        const phoneType = /^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/;
        let userField = form.find('[name="phone"]').val();
        let phoneValid = phoneType.test(userField);
        var success = form.find('.success');
        let url = '/local/templates/fsk/php/SMS/sendsms.php';
        //let url = '/local/templates/fsk/php/smsAuth/sendcode.php';

        if (phoneValid) {
            let phone = userField.replace(/[^\d;]/g, '');
            console.log(phone);
            $('[name="phone"]').removeClass('input-err');

            $.ajax({
                type: 'POST',
                url: url,
                dataType: 'json',
                data: {
                    phone: phone
                },
                success: function(data){
                    console.log(data);
                    success.fadeIn();
                },
                error: function(jqXHR, exception){
                    success.fadeOut();
                    console.log(exception);
                }
            });
        } else {
            console.log(phoneValid);
            $('[name="phone"]').addClass('input-err');
        }
    })
</script>
<?endif;?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
