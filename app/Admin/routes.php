<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('currencys', CurrencyController::class);
    $router->resource('accountlists', AccountListController::class);
    $router->resource('accounttypes', AccountTypeController::class);
    $router->resource('ticketheaders', TicketHeaderController::class);
    $router->resource('tickettitles', TicketTitleController::class);
    $router->resource('ports', PortController::class);
    $router->resource('tickets', TicketController::class);


});
