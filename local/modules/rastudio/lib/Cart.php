<?
namespace RaStudio;

class Cart {

    public static function getFloorName($count) {
        switch ($count) {
            case "0": return "Студия"; break;
            case "1": return "1-к квартира"; break;
            case "2": return "2-к квартира"; break;
            case "3": return "3-к квартира"; break;
            case "4": return "4-к квартира"; break;
            case "5": return "5-к квартира"; break;
        }
    }

    public static function getFloorNameFull ($count) {
        switch ($count) {
            case "0": return "Квартиры студии"; break;
            case "1": return "Однокомнатные квартиры";    break;
            case "2": return "Двухкомнатные квартиры";    break;
            case "3": return "Трехкомнатные квартиры";    break;
            case "4": return "Четырехкомнатные квартиры"; break;
            case "5": return "Пятикомнатные квартиры";    break;
        }
    }

    public static function getApartment1CNumByID($ID) {
        if(!\CModule::IncludeModule("iblock"))  return 'Нет модуля';
        if(!$_SESSION['Apartment1CNum'][$ID]) {
            $_SESSION['Apartment1CNum'][$ID] = \CIBlockElement::GetByID($ID)->GetNext()['CODE'];
        }
        return $_SESSION['Apartment1CNum'][$ID];
    }

    public static function getIDByNum($num) {
        if(!\CModule::IncludeModule("iblock")) return 'Нет модуля';
        $arSelect = ['ID','CODE'];
        $arFilter = Array("IBLOCK_ID"=> 1, "CODE" => $num);
        $res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
        $arElement = [];
        while($ob = $res->GetNextElement()){
            $temp = $ob->GetFields();
        }
        return $temp['ID'] ? : false;
    }

    public static function getApartmentByIDs($IDs, $select = false, $getProp = true) {
        $arSelect = $select ? : ['*'];
        $arFilter = Array("IBLOCK_ID"=> 1, "ID" => $IDs);
        if(!\CModule::IncludeModule("iblock"))  return 'Нет модуля';
        $res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
        $arElement = [];
        while($ob = $res->GetNextElement()){
            $temp = $ob->GetFields();
            if($getProp) {
                $temp['PROPERTIES'] = $ob->GetProperties();
            }
            $arElement[$temp['ID']] = $temp;
        }
        return $arElement;
    }
    public static function setStatusByStatusArray($arrayApatments = false) {
        if($arrayApatments === false) return false;
        $slackInfo = "У `квартир` был сменен *статус* на:\n";
        if(count($arrayApatments) < 1) return false;
        $ids = [];
        foreach ($arrayApatments as $key => $apartmentInfo) {
            $slackInfo .= "`".$apartmentInfo['id']."`: *".$apartmentInfo['status']."*\n";
            $ids[$apartmentInfo['id']] = $apartmentInfo['status'];
        }
        $arSelect = Array("ID", "IBLOCK_ID","XML_ID");
        $arFilter = Array(
            "XML_ID" => array_keys($ids)
        );
        if(\CModule::IncludeModule("iblock")) {
            $res = \CIBlockElement::GetList(array(), $arFilter, false, array(), $arSelect);
            while ($ob = $res->GetNextElement()) {
                $field = $ob->GetFields();
                if($ids[$field['XML_ID']] != 'Ожидание' && $ids[$field['XML_ID']]) {
                    $status = $ids[$field['XML_ID']] == "ВСвободнойПродаже" ? "" : "31";
                    \CIBlockElement::SetPropertyValuesEx($field['ID'], $field['IBLOCK_ID'], array(113 => $status));
                }
            }
        }
        return $slackInfo;
    }
}
