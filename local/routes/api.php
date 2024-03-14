<?php
use Bitrix\Main\Routing\RoutingConfigurator;
return function (RoutingConfigurator $routes) {
    $routes->post('/api/user', [\App\Controller::class,'getUserProfile']);
    $routes->post('/api/user/update', [\App\Controller::class,'setUserProfile']);

    $routes->post('/api/config', [\App\Controller::class,'config']);

    $routes->post('/catalog/products', [\App\Controller::class,'refProductInfo']);

    $routes->post('/api/basket', [\App\Controller::class,'basket']);
    $routes->post('/api/basket/add', [\App\Controller::class,'basketAdd']);
    $routes->post('/api/basket/update', [\App\Controller::class,'basketUpdate']);
    $routes->post('/api/basket/del', [\App\Controller::class,'basketDelete']);
    $routes->post('/api/basket/coupon/add', [\App\Controller::class,'applyCoupon']);
    $routes->post('/api/basket/coupon/del', [\App\Controller::class,'deleteCoupon']);

    $routes->post('/api/favorites', [\App\Controller::class,'favorites']);
    $routes->post('/api/favorites/add', [\App\Controller::class,'favoritesAdd']);
    $routes->post('/api/favorites/del', [\App\Controller::class,'favoritesDelete']);
};