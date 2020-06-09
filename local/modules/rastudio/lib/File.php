<?
namespace RaStudio;

use \Bitrix\Main\IO;

class File extends IO\File {

    public function __construct($path, $siteId = null)
    {
        parent::__construct($path, $siteId);
    }
    
    public function getPath() {
        return $this->path;
    }
    public function getName() {
        $name = explode("/",$this->path);
        return $name[ count($name) - 1 ];
    }

    public function getParents() {
        $dir = explode("/",$this->path);
        return array_filter($dir);
    }

}