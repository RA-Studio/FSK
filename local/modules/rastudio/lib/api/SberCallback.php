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


/*лог*/
LoggerAdapter::add(print_r($_REQUEST, true));
LoggerAdapter::add(print_r("up", true));



?>
<?/*
error

https://fsknw.ru/local/modules/rastudio/lib/api/SberCallback.php?orderNumber=258_0&mdOrder=6be4f964-077e-7ef8-85c7-5d1a020bb65c&operation=declinedByTimeout&status=0


success

https://fsknw.ru/local/modules/rastudio/lib/api/SberCallback.php?orderNumber=258_0&mdOrder=08122399-b658-74ba-a072-c3e7020bb65c&operation=deposited&status=1
*/?>
<?
$oderId = explode('_',$_REQUEST['orderNumber'])[0];
if ($_REQUEST['status']){
    //echo 'success';
    OrderTable::update($oderId, array('ID'=>$oderId,'UF_STATUS'=>2));
    OrderTable::sendSuccess($oderId);

}else{
    //echo 'error';
    OrderTable::update($oderId, array('ID'=>$oderId,'UF_STATUS'=>0));
    OrderTable::sendError($oderId);
}

?>
