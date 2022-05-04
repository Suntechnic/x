<?


require __DIR__ . '/vendor/autoload.php';

// подключение xCore  
// https://github.com/Suntechnic/xCore/blob/master/README.md  
if (\Bitrix\Main\Loader::includeModule('x.core')) {
    
} else {
    
    // настройки кинт (если не используется x.core)
    \Kint\Renderer\RichRenderer::$folder = true;
    if (APPLICATION_ENV != 'dev') {
        \Kint::$enabled_mode = false;
        define('VUEJS_DEBUG', true);
    }
}