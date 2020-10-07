<?php

namespace RaStudio;

use CModule,
    CIBlockSection,
    \Bitrix\Iblock\ElementTable;

class Helper {

    public static function arrayShiftInRight (&$arr) {
        array_unshift ($arr, array_pop($arr));
    }

    public static function arrayShiftInLeft (&$arr) {
        array_push ($arr, array_shift($arr));
    }

    public static function pr($mData, $bExit = true) {
        echo '<pre>';
        print_r($mData);
        if ($bExit) {
            exit;
        }
    }
    public static function isMobile() {
        $agent = $_SERVER['HTTP_USER_AGENT'];
        return preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$agent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($agent,0,4));
    }

    function GetSectionList($arFilter = [],$arSelect = ["*"]) {
        if(CModule::IncludeModule("iblock")) {
            $rsSections = CIBlockSection::GetList(array(), $arFilter, false, $arSelect);
            $arrResult = [];
            while ($arSection = $rsSections->Fetch()) {
                $arrResult[] = $arSection;
            }
            return $arrResult;
        }
    }

    function StructureMenu($arrMenu){
        $NewMenu = [];
        foreach ($arrMenu as $key => $item) {
            $temp = "";
            if ($item["DEPTH_LEVEL"] > 1) {
                $temp = &$NewMenu;
                foreach ($item['CHAIN'] as $key2 => $item2) {
                    if ($key2 == (count($item['CHAIN']) - 1)) continue;
                    $temp = &$temp[$item2];
                }
                $temp["ELEM"][$item["TEXT"]] = $item;
            } else {
                $NewMenu[$item["TEXT"]] = $item;
            }
            unset($temp);
        }
        return $NewMenu;
    }

    function InFil ($NAMEFILE = "", $NAMETITLE = "", $FOLDER = "", $show = true){
        if($NAMEFILE == "" || $NAMETITLE == "") {
            echo("Не правильно заданы параметры функции");
        }else{
            global $APPLICATION;
            $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/block/" . $FOLDER . $NAMEFILE, [], [
                "MODE"        => "php",
                "NAME"        => $NAMETITLE,
                "SHOW_BORDER" => $show,
            ]);
        }
    }

    /**
     * @param $namefile название файла
     * @param $nametitle Подпись области
     * @param $folder путь до папки
     * @show показать влючаемую область
    **/
    public static function InFilPhp ($namefile = "", $nametitle = "", $folder = "", $show = true) {
        if($namefile == "" || $nametitle == "") {
            echo("Не правильно заданы параметры функции");
        }else{
            $namefile = $namefile.".php";
            global $APPLICATION;
            $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include" . $folder . $namefile, [], [
                "MODE"        => "php",
                "NAME"        => $nametitle,
                "SHOW_BORDER" => $show,
            ]);
        }
    }

    public static function GetFilePhp($namefile = "",$folder = ""){
        if(!$namefile || !$folder) {
            return 0;
        }
        $path = $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH . "/include" . $folder . $namefile.".php";
        if (file_exists($path)) {
            include_once ($path);
        } else {
            $path = SITE_TEMPLATE_PATH . "/include" . $folder . $namefile.".php";
            echo("Создайте файл по маршруту: $path");
        }
    }

    public static function getElementByIblockId($iblockId = 0, $arFilterN = [], $arSelect = ["*"]) {
        if(CModule::IncludeModule("iblock")) {
            $arFilter = [
                "IBLOCK_ID" => IntVal($iblockId)
            ];
            $arFilter = $arFilter + $arFilterN;
            $res = \CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, Array(), $arSelect);
            $arResult = [];

            while ( $ob = $res->GetNextElement() ) {

                $arFields = $ob->GetFields();
                $arFields["PROPERTIES"] = $ob->GetProperties();
                $arResult[] = $arFields;

            }

            return $arResult;
        }
    }

    public static function urlPathEncode($url) {
        $path = parse_url($url, PHP_URL_PATH);
        if (strpos($path,'%') !== false) return $url; //avoid double encoding
        else {
            $encoded_path = array_map('urlencode', explode('/', $path));
            return str_replace($path, implode('/', $encoded_path), $url);
        }
    }

    public static function getUrlData($sUrl) {
        return array_filter(explode('/', $sUrl));
    }

    public static function formatMultiFilesArray(array $aGlobalFiles, $bFilter = false) {
        $aResult = [];
        $aFilesIds = $bFilter ? array_keys(array_filter($aGlobalFiles['name'])) : array_keys($aGlobalFiles['name']);
        $aFilesKeys = $bFilter ? array_keys(array_filter($aGlobalFiles)) : array_keys($aGlobalFiles);

        foreach ($aFilesIds as $iId) {
            foreach ($aFilesKeys as $sKey) {
                $aResult[$iId][$sKey] = $aGlobalFiles[$sKey][$iId];
            }
        }

        return $aResult;
    }

    public static function formatToTree($aFlatData, $sParentIdKey = 'ID') {
        $aExcludedIds = [];
        foreach ($aFlatData as $iId => $aItem) {
            $iParentId = $aItem[$sParentIdKey];
            if (isset($aFlatData[$iParentId])) {
                $aExcludedIds[] = $iId;
                $aFlatData[$iParentId]['CHILDREN'][$iId] = &$aFlatData[$iId];
            }
        }
        foreach ($aExcludedIds as $iId) {
            unset($aFlatData[$iId]);
        }
        return $aFlatData;
    }

    /**
     * Sort array by multiple conditions:
     * Util::asortByField($product_list, 'sort');                      // Sort by $a['sort']
     * Util::asortByField($product_list, ['sort', 'data']]);           // Sort by $a['sort'] field, then by $a['data']
     * Util::asortByField($product_list, ['sort', ['data', 'price']]); // Sort by $a['sort'] field, then by $a['data']['price']
     *
     * @param $aArray
     * @param $aField
     * @param bool|false $bDesc
     * @return bool
     */
    public static function sortByFields(&$aArray, $aField, $bDesc = false) {
        if (!is_array($aField)) {
            $aField = [$aField];
        }

        return uasort($aArray, function($a, $b) use ($aField, $bDesc) {
            $result = 0;

            foreach ($aField as $aKeys) {
                if (!is_array($aKeys)) {
                    $aKeys = [$aKeys];
                }

                $av = $a;
                $bv = $b;

                foreach ($aKeys as $sKey) {
                    $av = $av[$sKey];
                    $bv = $bv[$sKey];
                }

                if ($av == $bv) {
                    continue;
                } else {
                    $result = strnatcmp($av, $bv);
                    if ($result) {
                        break;
                    }
                }
            }

            if ($bDesc) {
                $result *= -1;
            }

            return $result;
        });
    }

    public static function getDate($iTimeStamp = null) {
        $iTimeStamp = !$iTimeStamp ? time() : $iTimeStamp;
        return date('d.m.Y', $iTimeStamp);
    }

    public static function resizeImagesByIds($aIds, $iWidth, $iHeight, $iResizeType = BX_RESIZE_IMAGE_PROPORTIONAL) {
        if (!array_filter($aIds)) {
            return [];
        }

        $aImages = [];

        $aImages = \CFile::ResizeImageGet($aIds, ['width' => $iWidth, 'height' => $iHeight], $iResizeType, true);

        return $aImages;
    }

    public static function setCookie($sKey, $mValue, $iTime) {
        $bResult = false;
        if (self::getCookie($sKey) !== $mValue) {
            $bResult = setcookie($sKey, $mValue, time() + $iTime, '/');
        }
        return $bResult;
    }

    public static function getCookie($sKey) {
        return !isset($_COOKIE[$sKey]) ? '' : $_COOKIE[$sKey];
    }

    public static function getRealIP() {
        $sIP = false;
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $aIPs = explode(', ', $_SERVER['HTTP_X_FORWARDED_FOR']);
            for ($i = 0; $i < count($aIPs); $i++) {
                if (!preg_match("/^(10|172\\.16|192\\.168)\\./", $aIPs[$i])) {
                    $sIP = $aIPs[$i];
                    break;
                }
            }
        }
        return ($sIP ? $sIP : $_SERVER['REMOTE_ADDR']);
    }

    public static function getTemplate($sTemplateFileName, $aParams = []) {
        $sFileName = ROOT_DIR.SITE_TEMPLATE_PATH.'/includes/'.$sTemplateFileName.'.php';
        if (!file_exists($sFileName)) {
            throw new \Exception("Шаблон $sFileName не существует.");
        }

        ob_start();
        require $sFileName;
        return ob_get_clean();
    }

    public static function getComponentTemplate($sComponentName = '', $sTemplateName = '', $aParams = []) {
        if (!$sComponentName) {
            throw new \Exception('Не определено название поключаемого компонента');
        }

        ob_start();
        global $APPLICATION;
        $APPLICATION->IncludeComponent($sComponentName, $sTemplateName, $aParams);
        return ob_get_clean();
    }

    public static function parsePhone($sPhone) {
        $sPhone = preg_replace('/[^\d]/', '', $sPhone);

        $iLength = strlen($sPhone);

        // форматирование
        if ($iLength == 11) {
            if (substr($sPhone, 0, 2) == '89') {
                $sPhone = '79' . substr($sPhone, 2);
            }
        } elseif ($iLength == 10) {
            $sPhone = '7' . $sPhone;
        }

        // валидация
        $iLength = strlen($sPhone);
        if ($iLength < 10 || $iLength > 11) {
            return null;
        }

        return $sPhone;
    }

    public static function transliterate($sTextCyr = null, $sTextLat = null) {
        $aCyr = array(
            'ы', 'ж', 'ч', 'щ', 'ш', 'ю', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ъ', 'ь', 'я',
            'Ы', 'Ж', 'Ч', 'Щ', 'Ш', 'Ю', 'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ъ', 'Ь', 'Я');

        $aLat = array(
            'y', 'zh', 'ch', 'sch', 'sh', 'yu', 'a', 'b', 'v', 'g', 'd', 'e', 'yo', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', '', '', 'ya',
            'Y', 'Zh', 'Ch', 'Sch', 'Sh', 'Yu', 'A', 'B', 'V', 'G', 'D', 'E', 'Yo', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', '', '', 'Ya');

        if ($sTextCyr) {
            return str_replace($aCyr, $aLat, $sTextCyr);
        } elseif ($sTextLat) {
            return str_replace($aLat, $aCyr, $sTextLat);
        } else {
            return null;
        }
    }

    /**
     * Делает первую букву заглавной php кирилица.
     * https://htmler.ru/2016/10/26/kak-sdelat-pervuyu-bukvu-zaglovnoy-php-kirilitsa/
     *
     * @param $str
     * @param string $encoding
     * @return string
     */
    public static function mbUcfirst($str, $encoding='UTF-8') {
        $str = mb_ereg_replace('^[\ ]+', '', $str);
        $str = mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding).
            mb_substr($str, 1, mb_strlen($str), $encoding);
        return $str;
    }

    static function randString($sPassLen = 10, $sPassChars = false) {
        static $sAllChars = 'abcdefghijklnmopqrstuvwxyzABCDEFGHIJKLNMOPQRSTUVWXYZ0123456789';
        $sString = '';

        if (is_array($sPassChars)) {
            while(strlen($sString) < $sPassLen) {
                if (function_exists('shuffle')) {
                    shuffle($sPassChars);
                }

                foreach($sPassChars as $chars) {
                    $n = strlen($chars) - 1;
                    $sString .= $chars[mt_rand(0, $n)];
                }
            }

            if (strlen($sString) > count($sPassChars)) {
                $sString = substr($sString, 0, $sPassLen);
            }
        } else {
            if ($sPassChars !== false) {
                $chars = $sPassChars;
                $n = strlen($sPassChars) - 1;
            } else {
                $chars = $sAllChars;
                $n = 61;
            }

            for ($i = 0; $i < $sPassLen; $i++) {
                $sString .= $chars[mt_rand(0, $n)];
            }
        }

        return $sString;
    }

}
