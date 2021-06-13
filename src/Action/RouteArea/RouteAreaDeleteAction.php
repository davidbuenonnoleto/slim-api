<?php

namespace App\Action\RouteArea;

use App\Domain\User\Service\RouteAreaDeleter;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action.
 */
final class RouteAreaDeleteAction
{
    private RouteAreaDeleter $routeAreaDeleter;

    private Responder $responder;

    /**
     * The constructor.
     *
     * @param RouteAreaDeleter $routeAreaDeleter The service
     * @param Responder $responder The responder
     */
    public function __construct(RouteAreaDeleter $routeAreaDeleter, Responder $responder)
    {
        $this->routeAreaDeleter = $routeAreaDeleter;
        $this->responder = $responder;
    }

    /**
     * Action.
     *
     * @param ServerRequestInterface $request The request
     * @param ResponseInterface $response The response
     * @param array<mixed> $args The routing arguments
     *
     * @return ResponseInterface The response
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        // Fetch parameters from the request
        $routeAreaId = (int)$args['route_area_id'];

        // Invoke the domain (service class)
        $this->routeAreaDeleter->deleteRouteArea($routeAreaId);

        // Render the json response
        return $this->responder->withJson($response);
    }
}
