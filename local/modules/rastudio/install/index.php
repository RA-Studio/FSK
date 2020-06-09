<?php

Class rastudio extends CModule {

    var $MODULE_ID = 'rastudio';
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $MODULE_CSS;

    function codepilots() {
        $arModuleVersion = array();

        $path = str_replace("\\", "/", __FILE__);
        $path = substr($path, 0, strlen($path) - strlen('/index.php'));
        include($path . '/version.php');

        if (is_array($arModuleVersion) && array_key_exists('VERSION', $arModuleVersion)) {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        }

        $this->MODULE_NAME = 'RA-Stdio модуль';
        $this->MODULE_DESCRIPTION = 'Включает в себя классы по работе с сайтом';
        $this->PARTNER_NAME = 'rastdio.ru';
        $this->PARTNER_URI = 'https://rastdio.ru';
    }

    function DoInstall() {
        global $DOCUMENT_ROOT, $APPLICATION;
        //$this->InstallFiles();
        RegisterModule($this->MODULE_ID);
        $APPLICATION->IncludeAdminFile('Установка модуля ' . $this->MODULE_ID, $DOCUMENT_ROOT. '/local/modules/' . $this->MODULE_ID . '/install/step.php');
    }

    function DoUninstall() {
        global $DOCUMENT_ROOT, $APPLICATION;
        //$this->UnInstallFiles();
        UnRegisterModule($this->MODULE_ID);
        $APPLICATION->IncludeAdminFile('Деинсталляция модуля ' . $this->MODULE_ID, $DOCUMENT_ROOT. '/local/modules/dv_module/install/unstep.php');
    }

    function InstallFiles($arParams = []) {
        CopyDirFiles(
            $_SERVER["DOCUMENT_ROOT"] . '/local/modules/' . $this->MODULE_ID . '/install/components',
            $_SERVER["DOCUMENT_ROOT"] . '/bitrix/components', true, true
        );
        return true;
    }

    function UnInstallFiles() {
        DeleteDirFilesEx('/bitrix/components/dv');
        return true;
    }

}