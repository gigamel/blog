<?php declare(strict_types=1);

use Gigamel\Http\Router\Route;

return [
    new Route(
        'home',
        '/',
        \App\Controller\DefaultController::class
    ),
    new Route(
        'dashboard',
        '/admin/dashboard/',
        \App\Controller\Admin\DashboardController::class
    ),
];
