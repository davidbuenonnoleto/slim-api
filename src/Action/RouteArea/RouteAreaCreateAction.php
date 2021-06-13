<?php

namespace App\Action\RouteArea;

use App\Domain\User\Service\RouteAreaCreator;
use App\Responder\Responder;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action.
 */
final class RouteAreaCreateAction
{
    private Responder $responder;

    private RouteAreaCreator $routeAreaCreator;

    /**
     * The constructor.
     *
     * @param Responder $responder The responder
     * @param RouteAreaCreator $routeAreaCreator The service
     */
    public function __construct(Responder $responder, RouteAreaCreator $routeAreaCreator)
    {
        $this->responder = $responder;
        $this->routeAreaCreator = $routeAreaCreator;
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
        // Extract the form data from the request body
        $data = (array)$request->getParsedBody();

        // Invoke the Domain with inputs and retain the result
        $routeAreaId = $this->routeAreaCreator->createRouteArea($data);

        // Build the HTTP response
        return $this->responder
            ->withJson($response, ['routearea_id' => $routeAreaId])
            ->withStatus(StatusCodeInterface::STATUS_CREATED);
    }
}
