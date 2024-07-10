<?php
use Bitrix\Main\Routing\RoutingConfigurator;
use Bitrix\Main\Routing\Controllers\PublicPageController;
return function (RoutingConfigurator $routes) {

    $routes->name('cart')
            ->get('/cart/', new PublicPageController('/local/pages/cart.php'));
    $routes->name('order')
            ->get('/order/', new PublicPageController('/local/pages/order.php'));
    $routes->name('about')
            ->get('/about/', new PublicPageController('/local/pages/about.php'));
    // кабинет
    $routes->name('personal')
            ->any('/personal/', new PublicPageController('/local/pages/personal.php'));
    $routes->prefix('personal')->group(function (RoutingConfigurator $routes) {
            $routes->name('personal/favorites')
                    ->any('favorites/', new PublicPageController('/local/pages/personal-favorites.php'));
            $routes->name('personal/register')
                    ->any(
                            'register/',
                            new PublicPageController('/local/pages/personal-register.php')
                        );
            $routes->name('personal/account')
                    ->any(
                            'account/',
                            new PublicPageController('/local/pages/personal-account.php')
                        );
            $routes->name('personal/account/info')
                    ->any(
                            'account/info/',
                            new PublicPageController('/local/pages/personal-account-info.php')
                        );
            $routes->name('personal/contact')
                    ->any(
                            'contact/',
                            new PublicPageController('/local/pages/personal-contact.php')
                        );
            $routes->name('personal/orders')
                    ->any(
                            'orders/',
                            new PublicPageController('/local/pages/personal-orders.php')
                        );
            $routes->name('personal/orders/detail')
                    ->any(
                            'orders/{OrderId}',
                            new PublicPageController('/local/pages/personal-orders-detail.php')
                        );
        });
    // новости
    $routes->name('news')
            ->get(
                    '/news/', 
                    new PublicPageController('/local/pages/news.php')
                );
    $routes->name('news/detail')
            ->get(
                    '/news/{News}/', 
                    new PublicPageController('/local/pages/news-detail.php')
                );
    // маршруты каталога
    // перенести в группу
    $routes->name('catalog')
            ->any('/catalog/', new PublicPageController('/local/pages/catalog.php'));
    $routes->prefix('catalog')->group(function (RoutingConfigurator $routes) {
            $routes->name('catalog/section')
                    ->get(
                            '{Section}/', 
                            new PublicPageController('/local/pages/catalog-section.php')
                        );
            $routes->name('catalog/element')
                    ->get(
                            '{Section}/{Element}/', 
                            new PublicPageController('/local/pages/catalog-element.php')
                        );
        });

};