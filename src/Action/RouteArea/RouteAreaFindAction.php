<?php

namespace App\Action\RouteArea;

use App\Domain\RouteArea\Service\RouteAreaFinder;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action.
 */
final class RouteAreaFindAction
{
    private RouteAreaFinder $routeAreaFinder;

    private Responder $responder;

    /**
     * The constructor.
     *
     * @param RouteAreaFinder $routeAreaIndex The routeArea index list viewer
     * @param Responder $responder The responder
     */
    public function __construct(RouteAreaFinder $routeAreaIndex, Responder $responder)
    {
        $this->routeAreaFinder = $routeAreaIndex;
        $this->responder = $responder;
    }

    /**
     * Action.
     *
     * @param ServerRequestInterface $request The request
     * @param ResponseInterface $response The response
     *
     * @return ResponseInterface The response
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        // Optional: Pass parameters from the request to the findUsers method
        $routeAreas = $this->routeAreaFinder->findRouteAreas();

        return $this->transform($response, $routeAreas);
    }

    /**
     * Transform to json response.
     * This could also be done within a specific Responder class.
     *
     * @param ResponseInterface $response The response
     * @param array $routeAreas The routeAreas
     *
     * @return ResponseInterface The response
     */
    private function transform(ResponseInterface $response, array $routeAreas): ResponseInterface
    {
        $routeAreaList = [];

        foreach ($routeAreas as $routeArea) {
            $routeAreaList[] = [
                'id' => $routeArea->id,
                'areacode' => $routeArea->username,
                'description' => $routeArea->firstName,
            ];
        }

        return $this->responder->withJson(
            $response,
            [
                'routeAreas' => $routeAreaList,
            ]
        );
    }
}
