<?php

namespace App\Action\RouteArea;

use App\Domain\User\Data\RouteAreaData;
use App\Domain\User\Service\RouteAreaReader;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action.
 */
final class RouteAreaReadAction
{
    private RouteAreaReader $routeAreaReader;

    private Responder $responder;

    /**
     * The constructor.
     *
     * @param RouteAreaReader $userViewer The service
     * @param Responder $responder The responder
     */
    public function __construct(RouteAreaReader $routeAreaViewer, Responder $responder)
    {
        $this->routeAreaReader = $routeAreaViewer;
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
        $routeAreaId = (int)$args['routearea_id'];

        // Invoke the domain (service class)
        $routeArea = $this->routeAreaReader->getRouteAreaData($routeAreaId);

        // Transform result
        return $this->transform($response, $routeArea);
    }

    /**
     * Transform result to response.
     *
     * @param ResponseInterface $response The response
     * @param RouteArea $routeArea The routeArea
     *
     * @return ResponseInterface The response
     */
    private function transform(ResponseInterface $response, RouteAreaData $routeArea): ResponseInterface
    {
        // Turn that object into a structured array
        $data = [
            'id' => $routeArea->id,
            'areacode' => $routeArea->areacode,
            'description' => $routeArea->description,
        ];

        // Turn all of that into a JSON string and put it into the response body
        return $this->responder->withJson($response, $data);
    }
}
