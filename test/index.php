<?
// вместо хедера
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
CModule::IncludeModule("x.module");
$module = new \X\Module\Module;


\Kint::dump($module->getAdminFiles());