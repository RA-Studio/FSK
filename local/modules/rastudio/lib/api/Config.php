<?php
namespace RaStudio\Api;
class Config
{
    const RESPONSE_STATUS_ERROR = 400;
    const RESPONSE_STATUS_OK = 200;


    const METHOD_TYPE_CREATE = 'POST';
    const METHOD_TYPE_UPDATE = 'PUT';
    const METHOD_TYPE_GET = 'GET';
    const FILE_DIR = '/upload/order';
    const METHOD_INSTALLMENT_LIST = 'ListInstallmentPlanApartment';
    const METHOD_CALCULATE_INSTALLMENT = 'CalculateInstallmentPlanApartment';
    const METHOD_CANSEL_ORDER = 'CancelOrder';
    const METHOD_SEND_MORTGAGE = 'SendIpotekaInfo';
    const METHOD_SEND_MORTGAGE_FILE = 'SendIpotekaFile';
    const METHOD_SEND_ORDER_FILE = 'SendFile';
    const METHOD_UPDATE_MORTGAGE = 'UpdateIpoteka';
    const METHOD_SEND_DOM_CLICK = 'SendCodeDomclick';
    const CHANGE_APPARTMENT = 'ChangeApartment';

    const METHOD_CREATED_SUVENIR_ORDER = 'CreateUpdateOrder';

    const METHOD_SEND_MORTGAGE_ORDER = 'SendIpotekaInfo_Order';
}
?>