<?/*require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
global   $USER ;
$USER ->Authorize( 1 );*/
/*$address = "89.111.133.0";
$port = 80;
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

if( !$socket ) exit( socket_strerror( socket_last_error() ) );
else echo 'Socket_created!'."\r\n";

if( !socket_bind($socket, $address, $port) ) exit( socket_strerror( socket_last_error() ) );
else echo 'Socket_binded!'."\r\n";*/
/*require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
ini_set("display_errors", true);
error_reporting(6135);

$link = "https://terminal.scloud.ru/03/sc81501_base07/hs/FSK_API/ImageRealty/3a228de8-d3b3-11e9-bbc4-00155d463c42";


$ch = curl_init();
curl_setopt($ch, CURLOPT_POST, 0);
curl_setopt($ch, CURLOPT_PORT , 443);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch,CURLOPT_URL, $link);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result=curl_exec($ch);
curl_close($ch);

file_put_contents('test.jpg', $result);
echo '<pre>';
print_r($result);
echo '</pre>';*/
?>