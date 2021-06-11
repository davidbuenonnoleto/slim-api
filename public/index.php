<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;


require __DIR__ . '/../vendor/autoload.php';

/** 
* Instantiate App
*/
$app = AppFactory::create();


/*
* Middleware for authentication
*/
$authMiddleware = function (Request $request, RequestHandler $handler) {
    $response = $handler->handle($request);
    $response->getBody()->write(' Authenticated ');

    return $response;
};

/**
 * API routes
*/
$app->get('/', function (Request $request, Response $response, array $args) {

    $response->getBody()->write("API using Slim Micro Framework");
    return $response->withHeader('Content-Type', 'application/json');
});

$app->group('/drivers[/{id:[0-9]+}]', function (RouteCollectorProxy $group) {
    $group->map(['GET', 'DELETE', 'PATCH', 'PUT'], '', function ($request, $response, array $args) {
        
        $response->getBody()->write('david, joao, bastiao, jonas');
        return $response->withHeader('Content-Type', 'application/json');
        
    });   
})->add($authMiddleware);

$app->group('/routes[/{id:[0-9]+}]', function (RouteCollectorProxy $group) {
    $group->map(['GET', 'DELETE', 'PATCH', 'PUT'], '', function ($request, $response, array $args) {
        
        $response->getBody()->write('s10570a, s10570b, s10570c, s10570d');
        return $response->withHeader('Content-Type', 'application/json');
        
    });   
})->add($authMiddleware);

$app->group('/packages[/{id:[0-9]+}]', function (RouteCollectorProxy $group) {
    $group->map(['GET', 'DELETE', 'PATCH', 'PUT'], '', function ($request, $response, array $args) {
        
        $response->getBody()->write('22, 45, 68, 72');
        return $response->withHeader('Content-Type', 'application/json');
        
    });   
})->add($authMiddleware);

// Run app
$app->run();