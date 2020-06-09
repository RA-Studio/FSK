<?php

namespace RaStudio;

use \Bitrix\Main\IO;

class Directory extends IO\Directory {

    public function __construct($path, $siteId = null) {
        parent::__construct($path, $siteId);
    }

    public function getChildren()
    {
        //if (!$this->isExists())
            //throw new FileNotFoundException($this->originalPath);

        $arResult = array();

        if ($handle = opendir($this->getPhysicalPath()))
        {
            while (($file = readdir($handle)) !== false)
            {
                if ($file == "." || $file == ".." || $file[0] == ".")
                    continue;

                $pathLogical = \Bitrix\Main\IO\Path::combine($this->path, \Bitrix\Main\IO\Path::convertPhysicalToLogical($file));
                $pathPhysical = \Bitrix\Main\IO\Path::combine($this->getPhysicalPath(), $file);

                if (is_dir($pathPhysical)) {
                    $arResult[] = new Directory($pathLogical);
                } else {
                    $arResult[] = new File($pathLogical);
                }

            }
            closedir($handle);
        }

        return $arResult;
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