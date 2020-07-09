<?/*
<html>
    <body>
        <div onclick="name()">Click</div>
        <script type="text/javascript">
            function name () {
                var ifrm = document.createElement("iframe");
                ifrm.setAttribute("src", "test.php");
                ifrm.style.width = "100%";
                ifrm.style.height = "100%";
                ifrm.style.display = "none";
                document.body.appendChild(ifrm);
            }
        </script>
    </body>

</html>
*/?>
<?
//phpinfo();
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
ini_set("display_errors", true);
error_reporting(6135);

$arrContextOptions=array(
    "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ),
);
$value = "https://terminal.scloud.ru/03/sc81501_base07/hs/FSK_API/ImageRealty/3a228de8-d3b3-11e9-bbc4-00155d463c42";
//$headers = get_headers($value);
$test = file_get_contents($value, false, stream_context_create($arrContextOptions));

$arFile = CFile::MakeFileArray($value);


/*
$value = "http://www.imagetext.ru/pics_max/images_11831.JPG";
$v = file_get_contents($value);
//echo($v);

$arFile = CFile::MakeFileArray($value);
echo "<pre>";
print_r($arFile);
echo "</pre>";*/

/*


*/
/*echo $_SERVER['SERVER_ADDR'];
echo "<pre>";
print_r($_SERVER);
echo "</pre>";


//Проверка на работоспособность функции fsockopen
if(!function_exists('fsockopen'))
{ echo 'fsockopen не работает!'; return; }
//Используем определённые сервера на которых точно открыты нужные порты
$tests = array(
    25 => 'smtp.sendgrid.com',
    2525 => 'smtp.sendgrid.com',
    587 => 'smtp.sendgrid.com',
    443 => 'ssl://smtp.sendgrid.com'
);
//По циклу тестируем
foreach($tests as $port => $server) {
    //Соединяемся
    $fp = @fsockopen($server,$port,$errno,$errstr,5);
    //Если удачное соединение
    if($fp){ echo 'Порт '.$port.' открыт на вашем сервере!'.'<br>'; fclose($fp); }
//Если неудачное соединение
    else{
        echo 'Порт '.$port.' не открыт на вашем сервере!'.'<br>';
        //Вывод номера и причины ошибки
        echo " error num: ".$errno.' : '.$errstr.'<br>';
    }
}

stream_context_set_default([
    "ssl" => [
        'verify_peer' => false,
        'verify_peer_name' => false,
    ],
]);
$value = "https://terminal.scloud.ru/03/sc81501_base07/hs/FSK_API/ImageRealty/3a228de8-d3b3-11e9-bbc4-00155d463c42";
$headers = get_headers($value);

$arFile = CFile::MakeFileArray($value);
echo "<pre>";
print_r($headers);
echo "</pre>";*/

/*
$_SERVER['DOCUMENT_ROOT'] = realpath( dirname(__FILE__) );
$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];

define('NO_KEEP_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS', true);
define('BX_NO_ACCELERATOR_RESET', true);
define('CHK_EVENT', true);

require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

$value = "https://terminal.scloud.ru/03/sc81501_base07/hs/FSK_API/ImageRealty/3a228de8-d3b3-11e9-bbc4-00155d463c42";
$ID = "1319";
$field = "plan";
exec("wget -O - '".$value."'", $lines);
echo($lines);
$remote = implode("", $lines);

$link = $_SERVER['DOCUMENT_ROOT'].'/imgload/temp'.$ID.$field.'img.png';

file_put_contents($link,$remote);

$arFile = CFile::MakeFileArray($link);
echo "<pre>";
    print_r($arFile);
echo "</pre>";
*/
?>
