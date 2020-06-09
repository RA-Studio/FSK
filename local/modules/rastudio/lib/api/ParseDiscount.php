<?

namespace RaStudio\Api;

class ParseDiscount {

    const SKU_IBLOCK_ID = 81;
    const IBLOCK_ID = 80;

    private static function check($state,$array){
        if($array['CLASS_ID'] == $state) {
            return "Не известное состояние";
        } elseif(is_array($array['CHILDREN'])) {
            return "mass empty";
        }
        return false;
    }

    private static function checkArray($array = false){
        if(is_array($array)){
            return $array;
        } elseif($array) {
            return unserialize($array);
        } else {
            return false;
        }
    }

    private static function getLogic($array = false){
        return $array['DATA']['All'];
    }

    private static function getValue($array = false){
        return $array['DATA']['value'];
    }

    private static function getNameIf($array) {
        $type = $array['CLASS_ID'];
        $tree = [
            'CondIBElement'         => "ID",
            'CondIBIBlock'          => "IBLOCK_ID",
            'CondIBSection'         => "SECTION_ID",
            'CondIBCode'            => "CODE",
            'CondIBXmlID'           => "XML_ID",
            'CondIBName'            => "NAME",
            'CondIBActive'          => "ACTIVE",
            'CondIBDateActiveFrom'  => "ACTIVE_FROM",
            'CondIBDateActiveTo'    => "ACTIVE_TO",
            'CondIBSort'            => "SORT",
            'CondIBPreviewText'     => "PREVIEW_TEXT",
            'CondIBDetailText'      => "DETAIL_TEXT",
            'CondIBDateCreate'      => "DATE_CREATE",
            'CondIBCreatedBy'       => "CREATED_BY",
            'CondIBTimestampX'      => "timestamp_x",
            'CondIBModifiedBy'      => "modified_by",
            'CondIBTags'            => "tags",
            'CondCatQuantity'       => "CATALOG_QUANTITY",
            'CondCatWeight'         => "CATALOG_WEIGHT",
        ];
        if($tree[$type]) {
            return $tree[$type];
        } else {
            return false;
        }
    }

    private static function getEqual($array) {
        $type = $array['DATA']['logic'];
        $tree = [
            'Equal' => "=",
            'Not'   => "!=",
            'Great' => ">",
            'Less'  => "<",
            'EqGr'  => ">=",
            'EqLs'  => "<=",
        ];
        if($tree[$type]) {
            return $tree[$type];
        } else {
            return false;
        }
    }

    private static function getProp($array){
        $tree = [
            "S" => false,
            "N" => false,
            "F" => false,
            "L" => false,
            "E" => false,
            "G" => false,
        ];
        /* S - строка, N - число, F - файл, L - список, E - привязка к элементам, G - привязка к группам. */
        $res = explode(":",$array['CLASS_ID']);
        if(is_array($res)){
            $IBLOCK_ID = $res[1];
            $res = \CIBlock::GetProperties($IBLOCK_ID, Array(), Array("ID"=>$res[2]));
            $res = $res->Fetch();
            $type = $tree[$res['PROPERTY_TYPE']] ? "_VALUE" : "";
            if($IBLOCK_ID == self::SKU_IBLOCK_ID) {
                $equaL = self::getEqual($array);

                return [
                    "SKU_PROP" => [$equaL."PROPERTY_".$res['CODE'].$type => self::getValue($array)],

                ];
                /*

                */
            } else {
                return "PROPERTY_".$res['CODE'].$type;
            }
        } else {
            return false;
        }
    }

    private static function generLineFilter($array = false) {
        $nameIf = self::getNameIf($array);
        $equal = self::getEqual($array);
        if($nameIf === false && $equal === false) {
            return $array;
        } elseif ($nameIf === false) {
            $nameIf = self::getProp($array);
            if($nameIf === false) {
                return $nameIf;
            } elseif(is_object($nameIf) || is_array($nameIf)) {
                return $nameIf;
            }
        }
        $arLine["$equal$nameIf"] = self::getValue($array);
        return $arLine;
    }

    private static function setSkuFilter(&$array, $logic) {
        if($array['SKU_PROP']) {
            $array['ID'] = \CIBlockElement::SubQuery(
                "PROPERTY_CML2_LINK",
                array(
                    "IBLOCK_ID" => self::SKU_IBLOCK_ID,
                    "ACTIVE" => "Y",
                    array(
                        "LOGIC" => $logic,
                        $array['SKU_PROP'],
                    ),
                )
            );
            unset($array['SKU_PROP']);
        }
    }

    public static function convertToFilterArray($ar = false) {
        $arResult = [];
        $arResultSku = [];
        $ar = self::checkArray($ar);
        $check = self::check("CondGroup",$ar);
        if($check && $ar) {

            $arResult = [
                'IBLOCK_ID' => self::IBLOCK_ID,
                'LOGIC' => self::getLogic($ar),
            ];
            $arResultSku = [
                'IBLOCK_ID' => self::SKU_IBLOCK_ID,
                'LOGIC' => self::getLogic($ar),
            ];

            foreach ($ar['CHILDREN'] as $key => $value) {

                $arResult[$key] = [
                    'LOGIC' => self::getLogic($value),
                ];
                $arResultSku[$key] = [
                    'LOGIC' => self::getLogic($value),
                ];

                $check = self::check("ActSaleBsktGrp", $value['CHILDREN']);
                if ($check) {
                    return $check;
                }
                foreach ($value['CHILDREN'] as $key_in_one => $value_in_one) {
                    if($value_in_one['CHILDREN']) {
                        $tempArray = [
                            'LOGIC' => self::getLogic($value_in_one),
                        ];
                        foreach ($value_in_one['CHILDREN'] as $key_in_two => $value_in_two) {
                            $temp = self::generLineFilter($value_in_two);
                            $key_temp = key($temp);
                            if(is_object($temp) || is_array($temp)) {
                                if(!$tempArray[$key_temp][$key_in_two]) {
                                    if($key_temp == "SKU_PROP") {
                                        $key_temp_inner = key($temp[$key_temp]);
                                        $tempArray[$key_temp][$key_temp_inner][] = $temp[$key_temp][$key_temp_inner];
                                    } else {
                                        $tempArray[$key_temp][] = $temp[$key_temp];
                                    }
                                }
                            } else {
                                $tempArray[$key_temp][] = $temp[$key_temp];
                            }
                        }
                        if($tempArray['SKU_PROP']) {
                            $arResultSku[$key][$key_in_one] = $tempArray['SKU_PROP'];
                        }
                        self::setSkuFilter($tempArray, $tempArray['LOGIC']);
                        $arResult[$key][$key_in_one] = $tempArray;
                    } else {
                        $tempArray = self::generLineFilter($value_in_one);
                        if($tempArray['SKU_PROP']) {
                            $arResultSku[$key][$key_in_one] = $tempArray['SKU_PROP'];
                        }
                        self::setSkuFilter($tempArray, $arResult[$key]['LOGIC']);
                        $arResult[$key][$key_in_one] = $tempArray;
                    }
                }
            }
        }
        return [
            'ELEMENTS' => $arResult,
            'SKU' => $arResultSku,
        ];
    }

    public static function getActionById($saleIDs = false) {
        $arResult = [];
        $arFilter = array (
            'filter'   =>  array ('ACTIVE'  =>  'Y'),
            'select' => array('ID','ACTIONS'),
        );
        if($saleIDs) {
            $arFilter['filter']['ID'] = $saleIDs;
        }
        if (\CModule::IncludeModule( 'sale' )){
            $result  = \Bitrix\Sale\Internals\DiscountTable::getList($arFilter);
            while  ($data  =  $result ->fetch()){
                $arResult[] = $data;
            }
        }
        return $arResult;
    }

    public static function getSaleProductByActionId($saleIDs = false){
        $IDs = [];
        $arSale = self::getActionById($saleIDs);
        foreach ($arSale as $sale) {
            $jsonArr = $sale['ACTIONS'];
            $temp = \RaStudio\Api\ParseDiscount::convertToFilterArray($jsonArr);
            $res = \CIBlockElement::GetList(
                array(),
                $temp['ELEMENTS'],
                false,
                array(),
                array('ID')
            );
            while($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();
                $IDs[] = $arFields['ID'];
            }
        }
        return $IDs;
    }

}
?>