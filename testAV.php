<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle("Главная");
?>

<?php
\RaStudio\Table\OrderTable::sendSuccess(258);

/*
$orders = \RaStudio\Table\OrderTable::getOrderList(array("UF_STATUS"=>2));
foreach ($orders as $order){
    if (CModule::IncludeModule("iblock")) {
        CIBlockElement::SetPropertyValuesEx(
            $order['UF_PRODUCT'], false, array("UF_STATUS" => '30')
        );
    }
    \RaStudio\Table\OrderTable::update($order['ID'], array('ID'=>$order['ID'],'UF_STATUS'=>0));
    //\RaStudio\Table\OrderTable::sendError($order['ID']);
}*/
/*

$orders = \RaStudio\Table\OrderTable::getOrderList(array("UF_STATUS"=>1,"<UF_DATA_CREATED"=>time()-(20 * 60)));
foreach ($orders as $order){
    \RaStudio\Table\OrderTable::update($order['ID'], array('ID'=>$order['ID'],'UF_STATUS'=>0));
    \RaStudio\Table\OrderTable::sendError($order['ID']);
}*/
?>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>