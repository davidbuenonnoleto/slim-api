<?php

// Define app routes

use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use Tuupola\Middleware\HttpBasicAuthentication;

return function (App $app) {
    
    // Home Page
    $app->get('/', \App\Action\Home\HomeAction::class);

    // Password protected area
    $app->group(
        '/api',
        function (RouteCollectorProxy $app) {
            $app->get('/users', \App\Action\User\UserFindAction::class);
            $app->post('/users', \App\Action\User\UserCreateAction::class);
            $app->get('/users/{user_id}', \App\Action\User\UserReadAction::class);
            $app->put('/users/{user_id}', \App\Action\User\UserUpdateAction::class);
            $app->delete('/users/{user_id}', \App\Action\User\UserDeleteAction::class);
        }
    );//->add(HttpBasicAuthentication::class);
    $app->group(
        '/api',
        function (RouteCollectorProxy $app) {
            $app->get('/packages', \App\Action\Package\PackageFindAction::class);
            $app->post('/packages', \App\Action\Package\PackageCreateAction::class);
            $app->get('/packages/{package_id}', \App\Action\Package\PackageReadAction::class);
            $app->put('/packages/{package_id}', \App\Action\Package\PackageUpdateAction::class);
            $app->delete('/packages/{package_id}', \App\Action\Package\PackageDeleteAction::class);
        }
    );
    $app->group(
        '/api',
        function (RouteCollectorProxy $app) {
            $app->get('/routes', \App\Action\RouteArea\RouteAreaFindAction::class);
            $app->post('/routes', \App\Action\RouteArea\RouteAreaCreateAction::class);
            $app->get('/routes/{route_id}', \App\Action\RouteArea\RouteAreaReadAction::class);
            $app->put('/routes/{route_id}', \App\Action\RouteArea\RouteAreaUpdateAction::class);
            $app->delete('/routes/{route_id}', \App\Action\RouteArea\RouteAreaDeleteAction::class);
        }
    );
};
