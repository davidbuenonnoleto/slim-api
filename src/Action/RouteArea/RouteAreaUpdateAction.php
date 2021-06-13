<?php

namespace App\Action\RouteArea;

use App\Domain\User\Service\RouteAreaUpdater;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action.
 */
final class RouteAreaUpdateAction
{
    private Responder $responder;

    private RouteAreaUpdater $routeAreaUpdater;

    /**
     * The constructor.
     *
     * @param Responder $responder The responder
     * @param RouteAreaUpdater $routeAreaUpdater The service
     */
    public function __construct(Responder $responder, RouteAreaUpdater $routeAreaUpdater)
    {
        $this->responder = $responder;
        $this->routeAreaUpdater = $routeAreaUpdater;
    }

    /**
     * Action.
     *
     * @param ServerRequestInterface $request The request
     * @param ResponseInterface $response The response
     * @param array $args The route arguments
     *
     * @return ResponseInterface The response
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        // Extract the form data from the request body
        $routeAreaId = (int)$args['routearea_id'];
        $data = (array)$request->getParsedBody();

        // Invoke the Domain with inputs and retain the result
        $this->routeAreaUpdater->updateUser($routeAreaId, $data);

        // Build the HTTP response
        return $this->responder->withJson($response);
    }
}
