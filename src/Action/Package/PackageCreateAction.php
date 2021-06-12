<?php

namespace App\Action\Package;

use App\Domain\Package\Service\PackageCreator;
use App\Responder\Responder;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action.
 */
final class PackageCreateAction
{
    private Responder $responder;

    private PackageCreator $packageCreator;

    /**
     * The constructor.
     *
     * @param Responder $responder The responder
     * @param UserCreator $userCreator The service
     */
    public function __construct(Responder $responder, PackageCreator $packageCreator)
    {
        $this->responder = $responder;
        $this->userCreator = $packageCreator;
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
        $userId = $this->userCreator->createPackage($data);

        // Build the HTTP response
        return $this->responder
            ->withJson($response, ['user_id' => $userId])
            ->withStatus(StatusCodeInterface::STATUS_CREATED);
    }
}
