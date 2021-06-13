<?php

namespace App\Action\Package;

use App\Domain\Package\Service\PackageFinder;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action.
 */
final class PackageFindAction
{
    private PackageFinder $packageFinder;

    private Responder $responder;

    /**
     * The constructor.
     *
     * @param PackageFinder $packageIndex The package index list viewer
     * @param Responder $responder The responder
     */
    public function __construct(PackageFinder $packageIndex, Responder $responder)
    {
        $this->packageFinder = $packageIndex;
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
        // Optional: Pass parameters from the request to the findPackages method
        $packages = $this->packageFinder->findPackages();

        return $this->transform($response, $packages);
    }

    /**
     * Transform to json response.
     * This could also be done within a specific Responder class.
     *
     * @param ResponseInterface $response The response
     * @param array $users The users
     *
     * @return ResponseInterface The response
     */
    private function transform(ResponseInterface $response, array $users): ResponseInterface
    {
        $packageList = [];

        foreach ($packages as $package) {
            $packageList[] = [
                'id' => $package->id,
                'weight' => $package->weight,
                'address' => $package->address,
            ];
        }

        return $this->responder->withJson(
            $response,
            [
                'packages' => $packageList,
            ]
        );
    }
}
