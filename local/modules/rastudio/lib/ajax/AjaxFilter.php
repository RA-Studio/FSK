<?php

namespace RaStudio\Ajax;

use RaStudio\Api\LoggerAdapter as LoggerAdapter;
use \Bitrix\Highloadblock\HighloadBlockTable as HighloadBlockTable;

class AjaxFilter {

    const MortgageIblockID = 11;

    public static function actionInMortgage() {

        $request = \RaStudio\Ajax\Response::getRequestObj();

        if(!\CModule::IncludeModule("iblock")) return $request['response']->shapeError([],"Ошибка");

        $arRequest = $request['postList'];
        $arResult = [];
        $arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_*", "TIMESTAMP_X");
        $arFilter = Array(
            "ACTIVE"=>"Y",
            "IBLOCK_ID" => self::MortgageIblockID,
        );

        $res = \CIBlockElement::GetList(Array("SORT" => "ASC"), $arFilter, false, Array(), $arSelect);

        while($ob = $res->GetNextElement()) {
            $temp = $ob->GetFields();
            $temp['PROPERTIES'] = $ob->GetProperties();

            $img = \CFile::ResizeImageGet(
                $temp['PROPERTIES']["UF_IMAGE"]['VALUE'],
                array('width'=>130, 'height'=>33),
                BX_RESIZE_IMAGE_PROPORTIONAL,
                true
            );
            $temp['PROPERTIES']['UF_STAV']['VALUE'] = 30;
            $temp['PROPERTIES']["UF_IMAGE"]['VALUE'] = $img['src'];
            $arResult[] = $temp;
        }

        if($arResult) {
            return $request['response']->shapeOk($arResult, "Данные по ипотеке получены");
        } else {
            return $request['response']->shapeError([],"Обишка чтения");
        }
    }

    public static function globalSetting() {
        if (\CModule::IncludeModule("iblock")) :
            $db_props = \CIBlockElement::GetProperty(15, 1202, array("sort" => "asc"));
            while($ar_props = $db_props->Fetch()){
                if($ar_props['PROPERTY_TYPE'] == 'F'){
                    $ar_props['VALUE'] = CFile::GetPath($ar_props['VALUE']);
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
            return $UF_SETTING_SITE;
        endif;
    }

    public static function actionInBuildFilter() {

        $start = microtime(true);

        $request = \RaStudio\Ajax\Response::getRequestObj();
        $arRequest = $request['postList'];

        $arSelect = Array(
            "ID",
            "IBLOCK_ID",
            "NAME",
            "DATE_ACTIVE_FROM",
            "TIMESTAMP_X",
            "CODE",
            "IBLOCK_SECTION_ID"
        );

        $arResultCart   = [];
        $cartStaticInfo = [];

        $iblockID = $arRequest['IBLOCK_ID'];
        $sectionID = $arRequest['SECTION_ID'];

        unset($arRequest['IBLOCK_ID']);
        unset($arRequest['SECTION_ID']);

            if($arRequest['PROPERTY_builtyear'] == "Любой") {
                unset($arRequest['PROPERTY_builtyear']);
            }

            if($arRequest['PROPERTY_builtyear'] == "Сдан") {
                unset($arRequest['PROPERTY_builtyear']);
                $arRequest['<PROPERTY_builtyear'] = date('Y');
            }

        $arFilter = Array(
            "ACTIVE"=>"Y",
            "INCLUDE_SUBSECTIONS" => "Y",
            "IBLOCK_ID" => $iblockID,
            "SECTION_ID" => $sectionID,
            $arRequest
        );

        $global = AjaxFilter::globalSetting();

        $globalFilter = $arFilter;//array_merge($arFilter, $arRequest);;

        if(!\CModule::IncludeModule("iblock")) return $request['response']->shapeError([],"Ошибка");

        $res = \CIBlockElement::GetList(Array("PROPERTY_area" => "ASC", "PROPERTY_priceshort" => "ASC"), $globalFilter, false, Array(), $arSelect);
        $allArea = [];
		$arrRoom = [];
		$interator = 0;
        while($ob = $res->GetNextElement()) {

            $temp = $ob->GetFields();
            $property = $ob->GetProperties();

            $temp['PROPERTIES']['price']['VALUE'] = $property['price']['VALUE'];
            $temp['PROPERTIES']['price100']['VALUE'] = $property['price100']['VALUE'];
            $temp['PROPERTIES']['rooms']['VALUE'] = $property['rooms']['VALUE'];
            $temp['PROPERTIES']['area']['VALUE'] = $property['area']['VALUE'];
            $temp['PROPERTIES']['floor']['VALUE'] = $property['floor']['VALUE'];
            $temp['PROPERTIES']['image']['VALUE'] = $property['image']['VALUE'];
            $temp['PROPERTIES']['livingspace']['VALUE'] = $property['livingspace']['VALUE'];
            $temp['PROPERTIES']['kitchenspace']['VALUE'] = $property['kitchenspace']['VALUE'];
            $temp['PROPERTIES']['floorstotal']['VALUE'] = $property['floorstotal']['VALUE'];
            $temp['PROPERTIES']['buildingsection']['VALUE'] = $property['buildingsection']['VALUE'];
            $temp['PROPERTIES']['section']['VALUE'] = $property['section']['VALUE'];
            $temp['PROPERTIES']['builtyear']['VALUE'] = $property['builtyear']['VALUE'];
            $temp['PROPERTIES']['renovation']['VALUE'] = $property['renovation']['VALUE'];
            $temp['PROPERTIES']['buildingphase']['VALUE'] = $property['buildingphase']['VALUE'];
            $temp['PROPERTIES']['electriccapacity']['VALUE'] = $property['electriccapacity']['VALUE'];
            $temp['PROPERTIES']['watersupply']['VALUE'] = $property['watersupply']['VALUE'];
            $temp['PROPERTIES']['commercialtype']['VALUE'] = $property['commercialtype']['VALUE'];
            $temp['PROPERTIES']['UF_STATUS']['VALUE'] = $property['UF_STATUS']['VALUE'];


            unset($temp['IBLOCK_ID']);
            unset($temp['PROPERTY_PRICESHORT_VALUE']);
            unset($temp['PROPERTY_PRICESHORT_VALUE_ID']);
            unset($temp['PROPERTY_ROOMS_VALUE']);
            unset($temp['PROPERTY_ROOMS_VALUE_ID']);
            unset($temp['~DATE_ACTIVE_FROM']);
            unset($temp['~IBLOCK_ID']);
            unset($temp['~ID']);
            unset($temp['~NAME']);
            unset($temp['~PROPERTY_PRICESHORT_VALUE']);
            unset($temp['~PROPERTY_PRICESHORT_VALUE_ID']);
            unset($temp['~PROPERTY_ROOMS_VALUE']);
            unset($temp['~PROPERTY_ROOMS_VALUE_ID']);
            unset($temp['~TIMESTAMP_X']);



            $price =        $temp['PROPERTIES']['price100']['VALUE'];
            $room  =        $temp['PROPERTIES']['rooms']['VALUE'];
            $area  =        $temp['PROPERTIES']['area']['VALUE'];

			if(!$arrRoom[$room][$area]) {
				$arrRoom[$room][$area] = 0;
			} else {
				$arrRoom[$room][$area] = $arrRoom[$room][$area] + 1;
			}

            $allArea [] = $area;

            $array_sections = [];
            if($arRequest["PROPERTY_category"] == "commercial") {
                $room = "Помещения";
                if(empty($sectionID)) {
                    $resSection = \CIBlockSection::GetNavChain(false, $temp['IBLOCK_SECTION_ID']);
                    while ($arSection = $resSection->GetNext()) {
                        $array_sections[] = $arSection;
                    }
                    $nameR = $array_sections[0]['NAME'];
                    $room = str_replace("&quot;","",  $nameR);
                }

            }

            unset($temp['IBLOCK_SECTION_ID']);
            unset($temp['~IBLOCK_SECTION_ID']);

            $cartStaticInfo[$room]['price'][] = $price;
            $cartStaticInfo[$room]['area'][] = $area;

            if($global['show_price']['VALUE_XML_ID'] != "show") {
                $temp['PROPERTIES']['price']['VALUE'] = "close";
                $temp['PROPERTIES']['price100']['VALUE'] = "close";
            }


			//if(!$arResultCart[$room][$area]) {
                foreach($temp['PROPERTIES']['image']['VALUE'] as $value) {
                    $value = \CFile::GetFileArray($value);
                    $temp['PROPERTIES']['image_out_big']['VALUE'][$value['DESCRIPTION']] = $value['SRC'];

                    $temp['PROPERTIES']['image_out']['VALUE'][$value['DESCRIPTION']] = \CFile::ResizeImageGet($value, array('width'=>600, 'height'=>600), BX_RESIZE_IMAGE_PROPORTIONAL, true)['src'];
                }

                $temp['PROPERTIES']['image_out_big_new'] = $temp['PROPERTIES']['image_out_big']['VALUE'];
                $temp['PROPERTIES']['image_out_big']['VALUE'] = $temp['PROPERTIES']['image_out_big']['VALUE']['plan'];
                $temp['PROPERTIES']['image_out_new']['VALUE'] = $temp['PROPERTIES']['image_out']['VALUE'];
                $temp['PROPERTIES']['image_out']['VALUE'] = $temp['PROPERTIES']['image_out']['VALUE']['plan'];


				$area = $area."_".$interator;
                $arResultCart[$room][$area] = $temp;
                $floor = $temp['PROPERTIES']['floor']['VALUE'];
				$arResultCart[$room][$area]['PROPERTIES']['area_dop']['VALUE'] = $area;
                $arResultCart[$room][$area]['PROPERTIES']['floor']['VALUE'] = [$floor];
				$interator++;
			//} else {
			//    $arResultCart[$room][$area]['PROPERTIES']['floor']['VALUE'][] = $temp['PROPERTIES']['floor']['VALUE'];
			//}

        }

        $arResult = [
            "arResultCart" => $arResultCart,
            "cartStaticInfo" => $cartStaticInfo,
        ];

        $finish = microtime(true);
        $delta = $finish - $start;

        if($arResult['arResultCart'] && $arResult['cartStaticInfo']) {
            return $request['response']->shapeOk($arResult, print_r($arrRoom, true));//"Время работы $delta .сек");
        } else {
            return $request['response']->shapeError([],print_r($globalFilter, true));
        }
    }

    public static function actionInBuildFilterCountElement() {

        $request = \RaStudio\Ajax\Response::getRequestObj();
        $arRequest = $request['postList'];

        $arResultList       = [];
        $arSectionList      = [];

        $iblockID = $arRequest['IBLOCK_ID'];

        unset($arRequest['IBLOCK_ID']);

        if(!\CModule::IncludeModule("iblock")) return $request['response']->shapeError([],"Ошибка");

        $arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_*", "TIMESTAMP_X", "IBLOCK_SECTION_ID");
        $arFilter = Array(
            "ACTIVE"=>"Y",
            "IBLOCK_ID" => 1,
        );

        $res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

        $resultBuildPrice = [];
        $resultBuildArea = [];

        while($ob = $res->GetNextElement()) {
            $temp = $ob->GetFields();
            $temp['PROPERTIES'] = $ob->GetProperties();
            $resultBuildPrice[$temp['IBLOCK_SECTION_ID']][$temp['PROPERTIES']['rooms']['VALUE']][] = $temp['PROPERTIES']['price100short']['VALUE'];
            $resultBuildArea[$temp['IBLOCK_SECTION_ID']][$temp['PROPERTIES']['rooms']['VALUE']][] = $temp['PROPERTIES']['area']['VALUE'];
        }

        $rsSections = \CIBlockSection::GetList(
            array("SORT" => "ASC"),
            array("IBLOCK_ID" => 1, "ACTIVE" => "Y", "DEPTH_LEVEL" => 1),
            false,
            array("ID", "CODE","PICTURE","IBLOCK_ID","NAME","DESCRIPTION", "SECTION_PAGE_URL", "LANG_DIR","UF_*")
        );

        while ($arSection = $rsSections->Fetch()) {
            if (!empty($arSection['UF_PHOTO'])){
                if (\CModule::IncludeModule("iblock")) {
                    $arSection['UF_PHOTO'] = \CFile::GetPath($arSection['UF_PHOTO']);
                    $arSection['PICTURE'] = $arSection['UF_PHOTO'];
                }
            }else{
                $arSection['UF_PHOTO']='';
            }
            $arSectionList[$arSection['ID']] = $arSection;
        }


        if($arRequest['PROPERTY_builtyear'] == "Любой" || !$arRequest['PROPERTY_builtyear']) {
            unset($arRequest['PROPERTY_builtyear']);
        } else if($arRequest['PROPERTY_builtyear'] == "Cдан") {
            //unset($arRequest['PROPERTY_builtyear']);
            //$arRequest['=PROPERTY_builtyear'] = "Сдан";//date('Y');
        } else {
            $arRequest[] = array(
                "LOGIC" => "OR",
                "<=PROPERTY_builtyear" => $arRequest['PROPERTY_builtyear'],
                "PROPERTY_builtyear" => "Cдан",
            );
            unset($arRequest['PROPERTY_builtyear']);
        }

        if(!empty($arRequest['PROPERTY_rooms']) && ($arRequest['PROPERTY_rooms'] == 0 || in_array(0,$arRequest['PROPERTY_rooms'])) ) {
            $newArray = array(
                "PROPERTY_rooms" => 1,
                "SECTION_ID" => "23",
            );
        }

        if($arRequest["PROPERTY_category"] == "commercial") {
            $arFilter = Array(
                "IBLOCK_ID" => $iblockID,
                "ACTIVE"=>"Y",
                "INCLUDE_SUBSECTIONS" => "Y",
                $arRequest,
            );
            if($newArray) {
                $arFilter[] = array(
                    "LOGIC" => "AND",
                    $newArray,
                );
            }
        } elseif($arRequest["PROPERTY_category"] == "parking") {
            $arFilter = Array(
                "IBLOCK_ID" => $iblockID,
                "ACTIVE"=>"Y",
                "INCLUDE_SUBSECTIONS" => "Y",
                $arRequest,
            );
            if($newArray) {
                $arFilter[] = array(
                    "LOGIC" => "AND",
                    $newArray,
                );
            }
        } else {
            $arFilter = Array(
                "LOGIC" => "OR",
                "IBLOCK_ID" => $iblockID,
                "ACTIVE"=>"Y",
                "INCLUDE_SUBSECTIONS" => "Y",
                array(
                    "LOGIC" => "AND",
                    $arRequest,
                ),
            );
            if($newArray) {
                $arFilter[] = array(
                    "LOGIC" => "AND",
                    $newArray,
                );
            }
        }

        $folder = '/newbuild/';
        if($arRequest["PROPERTY_category"] == 'commercial') {
            $folder = '/commercial/';
        } else if ($arRequest["PROPERTY_category"] == 'parking') {
            $folder = '/parking/';
        }
        //$folder = $arRequest["PROPERTY_category"] == "commercial" ? "/commercial/" : "/newbuild/";

        $globalFilter = $arFilter;

        $res = \CIBlockElement::GetList(Array(), $globalFilter, array("IBLOCK_SECTION_ID"), Array(), $arSelect);
        $exit = [];
        while($ob = $res->GetNextElement()) {
            $temp = $ob->GetFields();
            $iblockSectionId = $temp['IBLOCK_SECTION_ID'];
            $nav = \CIBlockSection::GetNavChain( $iblockID, $temp['IBLOCK_SECTION_ID'], array("ID", "DEPTH_LEVEL", "CODE"));
            while ( $arSectionPath = $nav->GetNext() ) {


                if($arSectionPath['DEPTH_LEVEL'] > 1 || in_array($arSectionPath["ID"],$exit)) continue;


                $temp = $arSectionList[$arSectionPath["ID"]];
                $exit[] = $arSectionPath["ID"];
                if($arSectionList[$arSectionPath["ID"]]) {

                    $arSelect = Array("ID", "IBLOCK_ID", "NAME","DATE_CREATE","TIMESTAMP_X", "PROPERTY_*");
                    $arFilter = Array("IBLOCK_ID"=>5, "ACTIVE"=>"Y", "ID"=> $temp['UF_SECTION_NAME']);
                    $resMetro = \CIBlockElement::GetList(Array("RAND" => "ASC"), $arFilter, false, Array("nPageSize"=>1), $arSelect);
                    $userProps = [];

                    while($ob = $resMetro->GetNextElement()):
                        $fullProps['standartProps'] = $ob->GetFields();
                        $userProps = $ob->GetProperties();
                    endwhile;

                    if ($userProps['UF_METRO']['VALUE']) { // если метро задано то подгружаем хайлоадблок
                        $metro = [];
                        if (\CModule::IncludeModule('highloadblock')) {
                            $arHLBlock = HighloadBlockTable::getById(11)->fetch();
                            $obEntity = HighloadBlockTable::compileEntity($arHLBlock);
                            $strEntityDataClass = $obEntity->getDataClass();
                        }

                        //Получение списка:
                        if (\CModule::IncludeModule('highloadblock')) {
                            $rsData = $strEntityDataClass::getList(array(
                                    'select' => array('ID', 'UF_NAME', 'UF_COLOR'),
                                    'filter' => array('UF_XML_ID' => $userProps['UF_METRO']['VALUE']),
                                    'order' => array('ID' => 'ASC'),
                                    'limit' => '999',
                            ));
                            while ($arItem = $rsData->Fetch()) {
                                $metro[] = $arItem;
                            }
                        }
                    }
                    $massField = [
                        "#SITE_DIR#"   => "none",
                        "#SECTION_ID#" => "ID",
                        "#SECTION_CODE#" => "CODE",
                    ];

                    foreach ($massField as $key => $field) {
                        $temp['SECTION_PAGE_URL'] = str_replace($key, $temp[$field], $temp['SECTION_PAGE_URL']);
                    }


                    $arResultList['items'][] = [
                        "id"     => $temp['ID'],
                        "name"   => $temp['NAME'],
                        "center" => $temp['UF_MAP_COORDS'],
                        "adress" => $temp['adress'],
                        "apartment" => (bool)$temp['UF_APART'],
                        "urlold"    => $folder.$arSectionPath["ID"]."/",
                        "urloldold" => $temp['SECTION_PAGE_URL'],
                        "url"       => $folder.$arSectionPath["CODE"]."/",
                        "metro"     => $metro,
                        "SORT" => $temp['SORT'],
                    ];

                    $arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_*");
                    $arFilter = Array("IBLOCK_ID"=>5, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "ID" => $temp["UF_SECTION_NAME"]);

                    $resIn = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
                    while ($obIn = $resIn->GetNextElement()) {
                        $buildProps = $obIn->GetFields();
                        $buildProps['PROPERTY'] = $obIn->GetProperties();

                        if($buildProps['PROPERTY']['UF_MAIN_ICON']['VALUE']) {
                            $buildProps['PROPERTY']['UF_MAIN_ICON']['VALUE'] = \CFile::GetPath($buildProps['PROPERTY']['UF_MAIN_ICON']['VALUE']);
                        }

                        if ($buildProps['PROPERTY']['UF_METRO']['VALUE']) {
                            $metro = [];
                            if (\CModule::IncludeModule('highloadblock')) {
                                $arHLBlock = \Bitrix\Highloadblock\HighloadBlockTable::getById(11)->fetch();
                                $obEntity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arHLBlock);
                                $strEntityDataClass = $obEntity->getDataClass();

                                $rsData = $strEntityDataClass::getList(array(
                                    'select' => array('ID', 'UF_NAME', 'UF_COLOR'),
                                    'filter' => array('UF_XML_ID' => $buildProps['PROPERTY']['UF_METRO']['VALUE']),
                                    'order' => array('ID' => 'ASC'),
                                ));
                                while ($arItem = $rsData->Fetch()) {
                                    $metro[] = $arItem;
                                }
                            }
                            foreach ($metro as $item) {
                                $buildProps['metro'][] = $item;
                            }
                        }

                        if ($buildProps['PROPERTY']['UF_KEYS_DATE']['VALUE']) {
                            $keys = [];
                            if (\CModule::IncludeModule('highloadblock')) {
                                $arHLBlock = \Bitrix\Highloadblock\HighloadBlockTable::getById(13)->fetch();
                                $obEntity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arHLBlock);
                                $strEntityDataClass = $obEntity->getDataClass();

                                $rsData = $strEntityDataClass::getList(array(
                                        'select' => array('ID', 'UF_NAME', 'UF_BACKGROUND', 'UF_FILE'),
                                        'filter' => array('UF_XML_ID' => $buildProps['PROPERTY']['UF_KEYS_DATE']['VALUE']),
                                        'order' => array('ID' => 'ASC'),
                                ));
                                while ($arItem = $rsData->Fetch()) {
                                    $keys[] = $arItem;
                                }
                            }
                            foreach ($keys as $item) {
                                if ($item['UF_FILE']) {
                                    $buildProps['keys']['SRC'] = \CFile::GetPath($item['UF_FILE']);
                                }
                                $buildProps['keys'][] = $item;
                            }
                        }

                        $temp["INFO"] = $buildProps;
                    }
                    if($temp['PICTURE']) {
                        $temp['PICTURE'] = \CFile::ResizeImageGet($temp['PICTURE'], array('width'=>800, 'height'=>500), BX_RESIZE_IMAGE_PROPORTIONAL, true)['src'];
                    }
                    $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_*", "IBLOCK_ID");
                    $arFilter = Array(
                        "IBLOCK_ID" => $iblockID,
                        "INCLUDE_SUBSECTIONS" => "Y",
                        "ACTIVE" => "Y",
                        "SECTION_ID" => $temp['ID'],
                        "PROPERTY_propertytype" => "жилая",
                        "!PROPERTY_price" => false,
                    );

                    if($arRequest["PROPERTY_category"] == "commercial") {
                        $arFilter["PROPERTY_category"] = "commercial";
                        unset($arFilter["PROPERTY_propertytype"]);
                    }
                    if($arRequest["PROPERTY_category"] == "parking") {
                        $arFilter["PROPERTY_category"] = "parking";
                        unset($arFilter["PROPERTY_propertytype"]);
                    }

                    $minPriceApartment = [];

                    $resIn = \CIBlockElement::GetList(Array("PROPERTY_price100" => "ASC"), $arFilter, false, Array("nPageSize"=>1), $arSelect);

                    while($obIn = $resIn->GetNextElement()) {
                        $minPriceApartment = $obIn->GetFields();
                        $minPriceApartment['PROPERTIES'] = $obIn->GetProperties();
                    }

                    $minPriceArray = number_format(  $minPriceApartment['PROPERTIES']['price100']['VALUE'], 0, '', ' ');
                    $minPriceArray = explode    (" ",$minPriceArray);

                    if(!$minPriceArray[1]) {
                        $minPriceArray[1] = "0";
                    }

                    $arFilter = Array (
                        "ACTIVE"=>"Y",
                        "INCLUDE_SUBSECTIONS" => "Y",
                        "PROPERTY_category" => "flat",
                        "IBLOCK_ID" => $iblockID,
                        "IBLOCK_SECTION_ID" => $iblockSectionId,
                        $arRequest
                    );

                    $resIn = \CIBlockElement::GetList(Array(), $arFilter, array("PROPERTY_rooms"), Array());

                    $resultFilterApartment = [];

                    while($obIn = $resIn->GetNextElement()) {
                        $tempIn = $obIn->GetFields();
                        $resultFilterApartment[$tempIn['PROPERTY_ROOMS_VALUE']] = true;
                    }

                    $temp['minPriceArray'] = $minPriceArray;
                    $temp['resultBuildPrice'] = $resultBuildPrice[$iblockSectionId];
                    $temp['resultBuildArea'] = $resultBuildArea[$iblockSectionId];
                    $temp['resultFilterApartment'] = $resultFilterApartment;
                    $ID = $temp['ID'];
                    $arResultList['section'][] = $temp;
                }
            }
        }
        if($arResultList) {

            usort($arResultList['section'], function($a, $b){
                return ($a['SORT'] - $b['SORT']);
            });
            usort($arResultList['items'], function($a, $b){
                return ($a['SORT'] - $b['SORT']);
            });
            return $request['response']->shapeOk($arResultList, '');
        } else {
            return $request['response']->shapeError($arRequest, "По вашему запросу ничего не найдено");
        }
    }
}
