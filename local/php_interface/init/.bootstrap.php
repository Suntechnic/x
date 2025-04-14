<?php
// установите на тестовй среде:
// SetEnv APPLICATION_ENV 'dev'

// определение констаны типа окружения
if (isset($_SERVER['APPLICATION_ENV']) || isset($_SERVER['REDIRECT_APPLICATION_ENV'])) {
    if (!$_SERVER['APPLICATION_ENV']) $_SERVER['APPLICATION_ENV'] = $_SERVER['REDIRECT_APPLICATION_ENV'];
    define('APPLICATION_ENV',$_SERVER['APPLICATION_ENV']);
} else {
    define('APPLICATION_ENV','production');
}

// автозагрузка классов
include_once(__DIR__.'/../vendor/autoload.php');

// подключение и преднастройка библиотеки Kint
if (class_exists('\Kint')) { 
    \Kint\Renderer\RichRenderer::$folder = true;
    if (!defined('APPLICATION_ENV') || APPLICATION_ENV != 'dev') {
        \Kint::$enabled_mode = false;
    } else if (defined('APPLICATION_ENV') || APPLICATION_ENV != 'production') {
        define('VUEJS_DEBUG', true);
    }
}

// установка пути к шаблону по умолчанию
$DefaultTemplatePath = \Bitrix\Main\Application::getDocumentRoot().'/local/templates/.default';
define('DEFAULT_TEMPLATE_PATH',$DefaultTemplatePath);