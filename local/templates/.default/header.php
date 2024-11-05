<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$bxApp = \Bitrix\Main\Application::getInstance();
$router = $bxApp->getRouter();
$request = $bxApp->getContext()->getRequest();
if (!$router->match($request)) die();    
?>
<!DOCTYPE html>
<html lang="<?=LANGUAGE_ID?>">
<head>
    <?include('head.php');?>
</head>
<body class="home">

    
