<?php

namespace App\Action\Package;

use App\Domain\User\Service\PackageUpdater;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action.
 */
final class PackageUpdateAction
{
    private Responder $responder;

    private PackageUpdater $packageUpdater;

    /**
     * The constructor.
     *
     * @param Responder $responder The responder
     * @param PackageUpdater $packageUpdater The service
     */
    public function __construct(Responder $responder, PackageUpdater $packageUpdater)
    {
        $this->responder = $responder;
        $this->packageUpdater = $packageUpdater;
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
        $packageId = (int)$args['package_id'];
        $data = (array)$request->getParsedBody();

        // Invoke the Domain with inputs and retain the result
        $this->packageUpdater->packageUser($packageId, $data);

        // Build the HTTP response
        return $this->responder->withJson($response);
    }
}
