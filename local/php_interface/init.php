<?
if (\Bitrix\Main\Loader::includeModule('rastudio') === false) {
    require_once($_SERVER['DOCUMENT_ROOT'] . '/local/modules/rastudio/install/index.php');
    $oModule = new \rastudio();
    $oModule->DoInstall();
}

if(!\CModule::IncludeModule('rastudio')) {
    echo("Модуль rastudio не подключен");
}

$aDeveloperIps = [ '46.28.228.22' ];

if (in_array($_SERVER['REMOTE_ADDR'], $aDeveloperIps)) {
    define('OPEN_SHOP', true);
} else {
    define('OPEN_SHOP', false);
}




function reserveCheck()
{
    $orders = \RaStudio\Table\OrderTable::getOrderList(array("UF_STATUS"=>1, "<UF_DATA_CREATED"=>time()-(20 * 60)));
    foreach ($orders as $order){
        \RaStudio\Table\OrderTable::update($order['ID'], array('ID'=>$order['ID'],'UF_STATUS'=>0));
        \RaStudio\Table\OrderTable::sendError($order['ID']);
    }
    return "reserveCheck()";
}
/**/
function reserveCancel()
{
    $orders = \RaStudio\Table\OrderTable::getOrderList(array("UF_STATUS"=>2, "<UF_DATA_CREATED"=>time()-(2 *7*24*60* 60)));//2 week
    foreach ($orders as $order){
        $PRODUCT_ID = $order['UF_PRODUCT'];
        if (CModule::IncludeModule("iblock")) {
            CIBlockElement::SetPropertyValuesEx(
                $PRODUCT_ID, false, array("UF_STATUS" => '30')
            );
        }
    \RaStudio\Table\OrderTable::update($order['ID'], array('ID'=>$order['ID'],'UF_STATUS'=>0));// 0 - cancele; 1 - init; 2 - pay
    }
    return "reserveCancel()";
}
function setSettings($name, $iblock, $elementID){
    if (CModule::IncludeModule("iblock")){
        $UF_SETTING_SITE = [];
        $db_props = CIBlockElement::GetProperty($iblock, $elementID, array("sort" => "asc"));
        while($ar_props = $db_props->Fetch()){
            if($ar_props['PROPERTY_TYPE'] == 'F' || $ar_props['MULTIPLE'] == 'Y'){
                if ($ar_props['PROPERTY_TYPE'] == 'F') {
                    $ar_props['VALUE'] = CFile::GetPath($ar_props['VALUE']);
                }
                $add = array( //добавление только нужных полей, можно поменять
                    'PROPERTY_VALUE_ID' => $ar_props['PROPERTY_VALUE_ID'],
                    'VALUE'=> $ar_props['VALUE'],
                    'DESCRIPTION' =>$ar_props['DESCRIPTION']
                );
                if (!empty($UF_SETTING_SITE[$ar_props['CODE']])){
                    array_push($UF_SETTING_SITE[$ar_props['CODE']]['VALUES'],$add);
                }else{
                    $UF_SETTING_SITE[$ar_props['CODE']] = $ar_props;
                    $UF_SETTING_SITE[$ar_props['CODE']]['VALUES'] = array($add);
                }
            }else{

                $UF_SETTING_SITE[$ar_props['CODE']] = $ar_props;
            }
        }
        $GLOBALS['UF_SETTINGS_'.$name] =  $UF_SETTING_SITE;
    };
}

?>
