<?php

namespace App\Domain\RouteArea\Service;

use App\Domain\RouteArea\Data\RouteAreaData;
use App\Domain\RouteArea\Repository\RouteAreaRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

/**
 * Service.
 */
final class RouteAreaUpdater
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
            ->addFileHandler('route_area_updater.log')
            ->createLogger();
    }

    /**
     * Update routeArea.
     *
     * @param int $routeAreaId The routeArea id
     * @param array<mixed> $data The request data
     *
     * @return void
     */
    public function updateRouteArea(int $routeAreaId, array $data): void
    {
        // Input validation
        $this->routeAreaValidator->validateRouteAreaUpdate($routeAreaId, $data);

        // Validation was successfully
        $routeArea = new RouteAreaData($data);
        $routeArea->id = $routeAreaId;

        // Update the routeArea
        $this->repository->updateRouteArea($routeArea);

        // Logging
        $this->logger->info(sprintf('RouteArea updated successfully: %s', $routeAreaId));
    }
}
