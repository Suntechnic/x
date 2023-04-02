<?
if ($_SERVER['APPLICATION_ENV']) {
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