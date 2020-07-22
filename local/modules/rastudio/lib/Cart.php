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

    public static function getIDByNum($num) {
        $arSelect = ['ID','CODE'];
        $arFilter = Array("IBLOCK_ID"=> 1, "CODE" => $num);
        $res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
        $arElement = [];
        while($ob = $res->GetNextElement()){
            $temp = $ob->GetFields();
        }
        return $temp['ID'] ? : false;
    }

}
