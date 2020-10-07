<?require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');?>
<?
use RaStudio\Api\LoggerAdapter;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Application;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\SystemException;
use \Bitrix\Sale\Order;
use \Bitrix\Sale\PaySystem;
use RaStudio\Table\OrderTable;
use RaStudio\Api\ShopWorker;

use RaStudio\User;
use RaStudio\Helper;
?>

<?
$oderId = explode('_',$_REQUEST['orderNumber'])[0];

LoggerAdapter::add("Ответ от сбербанка по заказу `$oderId`: ```".print_r($_REQUEST,true)."```");

$order = OrderTable::getOrderById($oderId);
$userGuid = User::getByLogin(Helper::parsePhone($order[OrderTable::COL_PHONE]))['XML_ID'];

if(CModule::IncludeModule("iblock")) {

}

$arFilter = Array("IBLOCK_ID"=> 1, "ID" => $order[OrderTable::COL_BASKET]);//, "ACTIVE"=>"Y"
$res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
$arElement = [];
while($ob = $res->GetNextElement()) { $arElement = $ob->GetFields(); $arElement['PROPERTIES'] = $ob->GetProperties(); }

if ($_REQUEST['status']){

    $payType = array_flip(ShopWorker::$payType);
    $res = ShopWorker::confirmReservation([
        'order_guid' => $order[OrderTable::COL_RESERVE],
        'client_guid' => $userGuid,
        'flat_id' =>  $arElement['CODE'],
        'pay_type' => $payType[$order[OrderTable::COL_PAY_TYPE]],
    ]);
    if($res['status'] === 'ok') {
        OrderTable::update($oderId, array('ID' => $oderId, OrderTable::COL_STATUS => 2, OrderTable::COL_RESERVE_DATE => $res['reserve_dataEnd']));
        OrderTable::sendSuccess($oderId);
    }
} else {
//    OrderTable::update($oderId, array('ID' => $oderId, OrderTable::COL_STATUS => 0));
//    OrderTable::sendError($oderId);
//    $request = ShopWorker::canselReservation([
//        'order_guid' => $order[OrderTable::COL_RESERVE],
//        'client_guid' => $userGuid,
//        'flat_id' => $arElement['CODE'],
//    ]);
}

?>
