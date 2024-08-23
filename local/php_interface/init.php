<?php
// установите на тестовй среде:
// SetEnv APPLICATION_ENV 'dev'

if ($_SERVER['APPLICATION_ENV'] || $_SERVER['REDIRECT_APPLICATION_ENV']) {
    if (!$_SERVER['APPLICATION_ENV']) $_SERVER['APPLICATION_ENV'] = $_SERVER['REDIRECT_APPLICATION_ENV'];
    define('APPLICATION_ENV',$_SERVER['APPLICATION_ENV']);
} else {
    define('APPLICATION_ENV','production');
}

require __DIR__ . '/vendor/autoload.php';

\Kint\Renderer\RichRenderer::$folder = true;
if (!defined('APPLICATION_ENV') || APPLICATION_ENV != 'dev') {
    \Kint::$enabled_mode = false;
} else if (defined('APPLICATION_ENV') || APPLICATION_ENV != 'production') {
    define('VUEJS_DEBUG', true);
}

$DefaultTemplatePath = \Bitrix\Main\Application::getDocumentRoot().'/local/templates/.default';
define('DEFAULT_TEMPLATE_PATH',$DefaultTemplatePath);

// подгрузка всего из папки init
$lstInitsFile = scandir(__DIR__.'/init');
if ($lstInitsFile) $lstInitsFile = array_filter($lstInitsFile,function ($N) {return (
        substr($N,-4) == '.php'
    );});
if ($lstInitsFile) foreach ($lstInitsFile as $FileName) include(__DIR__.'/init/'.$FileName);