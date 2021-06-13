<?php

namespace App\Domain\RouteArea\Service;

use App\Domain\RouteArea\Repository\RouteAreaRepository;

/**
 * Service.
 */
final class RouteAreaDeleter
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
     * Delete routeArea.
     *
     * @param int $routeAreaId The routeArea id
     *
     * @return void
     */
    public function deleteRouteArea(int $routeAreaId): void
    {
        // Input validation
        // ...

        $this->repository->deleteRouteAreaById($routeAreaId);
    }
}
