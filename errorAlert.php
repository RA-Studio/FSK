<?php
define('FILENAME', 'reserve.log');
// проверяем наличие содержимого в файле, считывая содержимое файла в строку
if (!file_get_contents(FILENAME))
    echo "Ошибок нет!";
else{
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From: error \r\n";
    $headers .= "Reply-To: vasilevich-a-s@mail.ru\r\n";
    $headers .= "X-Priority: 1 (Highest)\r\n";
    $headers .= "X-MSMail-Priority: High\r\n";
    $headers .= "Importance: High\r\n";
    if(
    mail("vasilevich-a-s@mail.ru", "Ошибки на сайте ".$_SERVER['SERVER_NAME'], file_get_contents(FILENAME),$headers)
    )
        echo "Почтовая система работает!";
    else
        echo "Неудача, почтовая система не работает, попробуйте еще!";

}
?>