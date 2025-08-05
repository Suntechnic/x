<?php
/**
 * Файл устанавливает две константы:
 * APPLICATION_ENV - тип окружения (production, dev)
 * DEFAULT_TEMPLATE_PATH - путь к шаблону по умолчанию (прибит гвоздями к .default)
 * Также подключает автозагрузчик классов
 * и отключает отладку Kint в режиме production.
 * 
 * установите на тестовой среде APPLICATION_ENV 'dev'
 * и на продакшн APPLICATION_ENV 'production'
 * 
 * Пример для htaccess:
 * SetEnv APPLICATION_ENV 'dev'
 */

// определение констаны типа окружения
if ($_SERVER['APPLICATION_ENV'] || $_SERVER['REDIRECT_APPLICATION_ENV']) {
    if (!$_SERVER['APPLICATION_ENV']) $_SERVER['APPLICATION_ENV'] = $_SERVER['REDIRECT_APPLICATION_ENV'];
    define('APPLICATION_ENV',$_SERVER['APPLICATION_ENV']);
} else {
    define('APPLICATION_ENV','production');
}

// автозагрузка классов
include_once(__DIR__.'/../vendor/autoload.php');

if (!defined('APPLICATION_ENV') || APPLICATION_ENV != 'dev') { // если не дев
    if (class_exists('\Kint')) \Kint::$enabled_mode = false; // погасим отдалку если она есть
} else if (defined('APPLICATION_ENV') || APPLICATION_ENV != 'production') { // если не продакшн...
    define('VUEJS_DEBUG', true);
    if (class_exists('\Kint')) \Kint\Renderer\RichRenderer::$folder = true;
    \CAdminNotify::Add([
            'MESSAGE' => 'Сайт работает в режиме разработки',
            'TAG' => 'DEVELOPMENT_MODE',
            'NOTIFY_TYPE' => \CAdminNotify::TYPE_ERROR
        ]);
}


// установка пути к шаблону по умолчанию
$DefaultTemplatePath = \Bitrix\Main\Application::getDocumentRoot().'/local/templates/.default';
define('DEFAULT_TEMPLATE_PATH',$DefaultTemplatePath);