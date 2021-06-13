<?php

namespace App\Domain\RouteArea\Repository;

use App\Domain\RouteArea\Data\RouteAreaData;
use App\Factory\QueryFactory;
use App\Support\Hydrator;

/**
 * Repository.
 */
final class RouteAreaFinderRepository
{
    private QueryFactory $queryFactory;

    private Hydrator $hydrator;

    /**
     * The constructor.
     *
     * @param QueryFactory $queryFactory The query factory
     * @param Hydrator $hydrator The hydrator
     */
    public function __construct(QueryFactory $queryFactory, Hydrator $hydrator)
    {
        $this->queryFactory = $queryFactory;
        $this->hydrator = $hydrator;
    }

    /**
     * Find routeAreas.
     *
     * @return RouteAreaData[] A list of routeAreas
     */
    public function findRouteAreas(): array
    {
        $query = $this->queryFactory->newSelect('routeAreas');

        $query->select(
            [
                'id',
                'areacode',
                'description',
            ]
        );

        // Add more "use case specific" conditions to the query
        // ...

        $rows = $query->execute()->fetchAll('assoc') ?: [];

        // Convert to list of objects
        return $this->hydrator->hydrate($rows, UserData::class);
    }
}
