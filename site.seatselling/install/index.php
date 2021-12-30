<?php

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;

Loc::loadLanguageFile(__FILE__);

class site_seatselling extends CModule
{
    public $MODULE_NAME = '';
    public $MODULE_DESCRIPTION = '';
	public $MODULE_VERSION = '';
	public $MODULE_VERSION_DATE = '';
	public $MODULE_ID = 'site.seatselling';

    public function __construct()
    {
        $this->MODULE_NAME = Loc::getMessage('SITE_SEAT_SELLING_MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('SITE_SEAT_SELLING_DESCRIPTION');

        include(__DIR__ . '/version.php');
        if (is_array($arModuleVersion)
            && array_key_exists('VERSION', $arModuleVersion)
            && array_key_exists('VERSION_DATE', $arModuleVersion)
        ) {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        }
        else
        {
            $this->MODULE_VERSION = '1.0.0';
            $this->MODULE_VERSION_DATE = '2021.12.30 13:41:00';
        }
    }

    public function InstallDB()
    {
        
    }

    public function UnInstallDB()
    {
        
    }

    public function DoInstall()
    {
        $this->InstallDB();

        ModuleManager::registerModule($this->MODULE_ID);
    }

    public function DoUninstall()
    {
        $this->UnInstallDB();

        ModuleManager::unRegisterModule($this->MODULE_ID);
    }
}