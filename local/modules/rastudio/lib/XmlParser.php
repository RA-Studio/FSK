<?php

namespace RaStudio;
use Bitrix\Main\Loader;

class XmlParser {

    private static function normalizeSimpleXML($obj, &$result) {
        $data = $obj;
        if (is_object($data)) {
            $data = get_object_vars($data);
        }
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $res = null;
                self::normalizeSimpleXML($value, $res);
                if (($key == '@attributes') && ($key)) {
                    $result = $res;
                } else {
                    $result[$key] = $res;
                }
            }
        } else {
            $result = $data;
        }
    }

    private static function xml2assoc(&$xml, &$nn){
        $assoc = NULL;
        $n = 0;
        while($xml->read()) {
            if($xml->nodeType == \XMLReader::END_ELEMENT) break;
            if($xml->nodeType == \XMLReader::ELEMENT && !$xml->isEmptyElement){
                $name = $xml->name;
                $tag = false;

                if($xml->name != "offer" && $xml->name != "realty-feed") {
                    if($xml->hasAttributes) {
                        while($xml->moveToNextAttribute()) {
                            $tag = $xml->value;
                            break;
                        }
                    }
                }

                $value = self::xml2assoc($xml, $nn);
                if($xml->name == "offer") {
                    $name = $nn;
                    $nn++;
                    $n++;
                } else if ($tag != false) {
                    $name .= "|$tag";
                }
                $assoc[$name] = $value;
                if($xml->name == "offer") {
                     if($xml->hasAttributes) {
                        while($xml->moveToNextAttribute()) {
                            $tag = $xml->value;
                            if($xml->name == "internal-id") {
                                break;
                            }
                        }
                    }
                    $assoc[$name]["internal-id"] = $tag;
                }

            }
            else if($xml->nodeType == \XMLReader::TEXT) $assoc = $xml->value;
            else if(!$xml->isEmptyElement) {

            }
        }
        return $assoc;
    }

    public static function xmlToArray($filePath = false) {
        $xml = new \XMLReader();

        exec("wget -O - '$filePath'", $lines);   // -O в верхнем регистре
        $remote = implode("", $lines);

        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/parse.xml',$remote);

        $xml->open($_SERVER['DOCUMENT_ROOT'].'/parse.xml');
        $nn = 0;
        $assoc = self::xml2assoc($xml, $nn);

        unset($assoc['realty-feed']['generation-date|FSK_siteIntegration']);
        /*
        $xmlString = file_get_contents($filePath);
        $arResult = [];
        self::normalizeSimpleXML(simplexml_load_string($xmlString), $arResult);
        */
        return $assoc['realty-feed'];
    }
}
