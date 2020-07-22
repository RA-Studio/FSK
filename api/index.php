<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");


if (!CModule::IncludeModule('rastudio')) {
    return;
}

RaStudio\Api\LoggerAdapter::add(print_r([file_get_contents('php://input'), $_SERVER['REQUEST_METHOD']], true));

$sControllerName = "ApiController";



try {
    $sClassPath = RS_MODULE_DIR . "/lib/api/" . $sControllerName;
    $sFileName = "$sClassPath.php";
    if (!file_exists($sFileName)) {
        throw new \Exception('Указано неверное наименование контроллера.');
    }

    $sClassName = "\\RaStudio\\Api\\$sControllerName";
    $sMethodName = ucfirst(strtolower($sMethodName));
    $sMethodName = "action";

    if (!class_exists($sClassName)) {
        throw new \Exception("Класса $sClassName не существует.");
    } elseif (!method_exists($sClassName, $sMethodName)) {
        throw new \Exception("Метода $sMethodName в классе $sClassName не существует.");
    }

    list($code, $xml) = $sClassName::$sMethodName($_SERVER['REQUEST_METHOD'], $_REQUEST["ENTITY"], file_get_contents('php://input'));

    echo $xml;

} catch (\Exception $e) {
    var_dump($e);
    http_response_code($code);
    echo $e->getMessage();
}
