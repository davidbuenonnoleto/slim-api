<?php

namespace App\Action\Package;

use App\Domain\Package\Service\PackageDeleter;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action.
 */
final class PackageDeleteAction
{
    private PackageDeleter $packageDeleter;

    private Responder $responder;

    /**
     * The constructor.
     *
     * @param packageDeleter $packageDeleter The service
     * @param Responder $responder The responder
     */
    public function __construct(PackageDeleter $packageDeleter, Responder $responder)
    {
        $this->packageDeleter = $packageDeleter;
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
        $packageId = (int)$args['package_id'];

        // Invoke the domain (service class)
        $this->packageDeleter->deletePackage($packageId);

        // Render the json response
        return $this->responder->withJson($response);
    }
}
