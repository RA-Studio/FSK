<?php

namespace RaStudio;
use Bitrix\Main\Loader;
Loader::includeModule("highloadblock"); 
use Bitrix\Highloadblock as HL; 
use Bitrix\Main\Entity;



class Highload {

    public static function getHLById($id, $arFilter = [], $arParams = []) {
        $hlblock = HL\HighloadBlockTable::getById($id)->fetch();
        $entity = HL\HighloadBlockTable::compileEntity($hlblock); 
        $entity_data_class = $entity->getDataClass();

        if(!$arParams['select']) {
            $arParams['select'] = array("*");
        }
        if(!$arParams['order']) {
            $arParams['order'] = array("ID" => "ASC");
        }

        if($arFilter) {
            $arParams['filter'] = $arFilter;
        }
        
        $rsData = $entity_data_class::getList($arParams);
        return $rsData->fetchAll();
    }
    
}