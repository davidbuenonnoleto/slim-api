<?php

namespace App\Domain\RouteArea\Service;

use App\Domain\RouteArea\Data\RouteAreaData;
use App\Domain\RouteArea\Repository\RouteAreaFinderRepository;

/**
 * Service.
 */
final class RouteAreaFinder
{
    private RouteAreaFinderRepository $repository;

    /**
     * The constructor.
     *
     * @param RouteAreaFinderRepository $repository The repository
     */
    public function __construct(RouteAreaFinderRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Find routeArea.
     *
     * @return RouteAreaData[] A list of routeAreas
     */
    public function findRouteAreas(): array
    {
        // Input validation
        // ...

        return $this->repository->findRouteAreas();
    }
}
