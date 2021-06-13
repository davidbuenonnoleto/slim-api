<?php

namespace App\Domain\RouteArea\Service;

use App\Domain\RouteArea\Data\RouteAreaData;
use App\Domain\RouteArea\Repository\RouteAreaRepository;

/**
 * Service.
 */
final class RouteAreaReader
{
    private RouteAreaRepository $repository;

    /**
     * The constructor.
     *
     * @param RouteAreaRepository $repository The repository
     */
    public function __construct(RouteAreaRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Read a routeArea.
     *
     * @param int $routeAreaId The routeArea id
     *
     * @return RouteAreaData The routeArea data
     */
    public function getRouteAreaData(int $routeAreaId): RouteAreaData
    {
        // Input validation
        // ...

        // Fetch data from the database
        $routeArea = $this->repository->getRouteAreaById($routeAreaId);

        // Optional: Add or invoke your complex business logic here
        // ...

        // Optional: Map result
        // ...

        return $routeArea;
    }
}
