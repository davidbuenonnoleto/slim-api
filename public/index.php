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

/**
 * API routes/subroutes
*/
$app->get('/', function (Request $request, Response $response, array $args) {
    $response->getBody()->write("API using Slim Micro Framework");
    return $response->withHeader('Content-Type', 'application/json');
});

$app->group('drivers', function (RouteCollectorProxy $group) {
    $group->get('/all', function (Request $request, Response $response) {
        $response->getBody()->write('List all drivers');
        return $response->withHeader('Content-Type', 'application/json');
    });
    $group->post('/add', function (Request $request, Response $response) {
        $response->getBody()->write('Add driver');
        return $response->withHeader('Content-Type', 'application/json');
    });
    $group->get('/{id}', function (Request $request, Response $response) {
        $response->getBody()->write('List driver by id');
        return $response->withHeader('Content-Type', 'application/json');
    });
    $group->put('/{id}', function (Request $request, Response $response) {
        $response->getBody()->write('Update driver');
        return $response->withHeader('Content-Type', 'application/json');
    });
    $group->delete('/{id}', function (Request $request, Response $response) {
        $response->getBody()->write('Delete driver');
        return $response->withHeader('Content-Type', 'application/json');
    });
});

// Run app
$app->run();