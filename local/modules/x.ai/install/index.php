<?php
$lstDependencies = include __DIR__.'/../.dependencies.php';

foreach ($lstDependencies as $Dependency) {
    if (!\Bitrix\Main\Loader::includeModule($Dependency)) return;
}

if (!class_exists('X\Ai\Module')) include __DIR__.'/../lib/module.php';
if (!class_exists('X\Ai\Module')) return;

class x_ai extends \X\Ai\Module
// class x_ai extends CModule
{
    /*
    public $MODULE_ID = 'x.ai';
    
    function __construct() {
        $this->PARTNER_NAME = 'x';
        $this->PARTNER_URI = 'https://x.ru';
        parent::__construct();
    }

    public function DoInstall () {}
    public function DoUninstall () {}
    */
}