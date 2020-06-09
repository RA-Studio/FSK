<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');?>
<br>
<br>
<br>
<br>
<br>
<br>
<?
use RaStudio\Api\RestApi;
//da9dba46-98fb-11ea-bbc5-00155d463c42

$dataSend = array(
  "firstName" => "TEST",
  "secondName" => "TEST",
  "lastName" => "TESST",
  "phone" => "89100000001",
);
$result = RestApi::simple_curl(
  '/client',
  'POST',
  $dataSend
);
?>
<pre><?print_r($result)?></pre>
<?
$result = RestApi::simple_curl(
    '/client?guid='.$result['guid'],
    'GET'
);
/*
$dataSend = array(
	"client_guid" => "da9dba51-98fb-11ea-bbc5-00155d463c42",
	"flat_id" => "41062"
);
$result = RestApi::simple_curl(
  '/reservation/create',
  'POST',
  $dataSend
);
*/
?><pre><?print_r($result)?></pre><?

/*
$curl = curl_init();



curl_setopt_array($curl, array(
  CURLOPT_URL => "https://terminal.scloud.ru/03/sc81501_base03/hs/siteExchange/client?guid=07c348c8-083b-11ea-bbc4-00155d463c42",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Authorization: Basic aXRzZXJ2aWNlOldlcjM0cmQ1Ng=="
  ),
));

$response = curl_exec($curl);
print_r($response);
curl_close($curl);
echo $response;
