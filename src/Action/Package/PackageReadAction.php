<?php

namespace App\Action\Package;

use App\Domain\User\Data\PackageData;
use App\Domain\User\Service\PackageReader;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action.
 */
final class PackageReadAction
{
    private PackageReader $packageReader;

    private Responder $responder;

    /**
     * The constructor.
     *
     * @param PackageReader $packageViewer The service
     * @param Responder $responder The responder
     */
    public function __construct(PackageReader $packageViewer, Responder $responder)
    {
        $this->packageReader = $packageViewer;
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
        $package = $this->packageReader->getPackageData($packageId);

        // Transform result
        return $this->transform($response, $package);
    }

    /**
     * Transform result to response.
     *
     * @param ResponseInterface $response The response
     * @param PackageData $user The user
     *
     * @return ResponseInterface The response
     */
    private function transform(ResponseInterface $response, PackageData $package): ResponseInterface
    {
        // Turn that object into a structured array
        $data = [
            'id' => $package->id,
            'weight' => $package->weight,
            'address' => $package->address,
        ];

        // Turn all of that into a JSON string and put it into the response body
        return $this->responder->withJson($response, $data);
    }
}
