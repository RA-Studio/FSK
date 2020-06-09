<?
namespace RaStudio;

use \Bitrix\Main\IO;

class FileStatic {

    public static function getOneFile($XML_ID, $COLOR_ID) {

        $folderimg = $_SERVER['DOCUMENT_ROOT'] . "/catalogcolor/" . $XML_ID . "/";
        $color_folder = $folderimg . $COLOR_ID;

        $imgpath = $color_folder . "/1.jpg";
        if ( IO\File::isFileExists($imgpath) ) {
            return $imgpath;
        }
        $imgpath = $color_folder . "/1.png";
        if (IO\File::isFileExists($imgpath)) {
            return $imgpath;
        }

        $folderimg = "/catalogcolor/" . $XML_ID . "/" . $COLOR_ID . "/";
        $dir = new \RaStudio\Directory($color_folder);
        $imglist = $dir->getChildren();

        return $folderimg . $imglist[0]->getName();

    }

    public static function getAllFile($XML_ID, $COLOR_ID) {

        $folderimg = $_SERVER['DOCUMENT_ROOT'] . "/catalogcolor/" . $XML_ID . "/";
        $color_folder = $folderimg . $COLOR_ID;

        $dir = new \RaStudio\Directory($color_folder);
        $imglist = $dir->getChildren();

        return $imglist;

    }


}