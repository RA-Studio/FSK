<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');?>
<br>
<br>
<br>
<br>
<br>
<br>
<?
use RaStudio\Api\RestApi;
use RaStudio\Api\ShopWorker;
/*
$dataSend = array( "firstName" => "TEST", "secondName" => "TEST", "lastName" => "TESST", "phone" => "89100000001" );
//ShopWorker::createdUser($dataSend);
?>
<?
$result = ShopWorker::getFreeApartment();
?><pre>Колличество квартир: <?print_r(count($result))?></pre><?

$clientGUID = "f464ed72-99a6-11ea-bbc5-00155d463c43";
$flatID = $result[0]['flat_id'];

$result = ShopWorker::getUser($clientGUID);
?><pre>Пользователь: <?print_r($result)?></pre><?

?><pre>Квартира: <?print_r($flatID)?></pre><?

$dataSend = array( "client_guid" => $clientGUID, "flat_id" => $flatID );

$result = ShopWorker::createReservation($dataSend);

$reservationGUID = $result['guid'];
?><pre>Заказ: <?print_r($reservationGUID)?></pre><?

$dataSend = array( "client_guid" => $clientGUID, "flat_id" => $flatID, "order_guid" => $reservationGUID, "pay_type" => ShopWorker::PAYMENT_TYPE_FULL );

$result = ShopWorker::confirmReservation($dataSend);
?><pre><?print_r($result)?></pre><? 


$result = ShopWorker::canselReservation($dataSend);
?><pre><?print_r($result)?></pre><?