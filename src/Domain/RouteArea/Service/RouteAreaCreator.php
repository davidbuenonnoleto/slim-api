<?php

namespace App\Domain\RouteArea\Service;

use App\Domain\RouteArea\Data\RouteAreaData;
use App\Domain\RouteArea\Repository\RouteAreaRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

/**
 * Service.
 */
final class RouteAreaCreator
{
    private RouteAreaRepository $repository;

    private RouteAreaValidator $routeAreaValidator;

    private LoggerInterface $logger;

    /**
     * The constructor.
     *
     * @param RouteAreaRepository $repository The repository
     * @param RouteAreaValidator $routeAreaValidator The validator
     * @param LoggerFactory $loggerFactory The logger factory
     */
    public function __construct(
        RouteAreaRepository $repository,
        RouteAreaValidator $routeAreaValidator,
        LoggerFactory $loggerFactory
    ) {
        $this->repository = $repository;
        $this->routeAreaValidator = $routeAreaValidator;
        $this->logger = $loggerFactory
            ->addFileHandler('route_area_creator.log')
            ->createLogger();
    }

    /**
     * Create a new routeArea.
     *
     * @param array<mixed> $data The form data
     *
     * @return int The new routeArea ID
     */
    public function createUser(array $data): int
    {
        // Input validation
        $this->routeAreaValidator->validateUser($data);

        // Map form data to routeArea DTO (model)
        $routeArea = new RouteAreaData($data);

        // Insert routeArea and get new routeArea ID
        $routeAreaId = $this->repository->insertRouteArea($routeArea);

        // Logging
        $this->logger->info(sprintf('RouteArea created successfully: %s', $routeAreaId));

        return $routeAreaId;
    }
}
