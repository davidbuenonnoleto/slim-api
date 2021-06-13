<?php

namespace App\Domain\Package\Repository;

use App\Domain\Package\Data\PackageData;
use App\Factory\QueryFactory;
use App\Support\Hydrator;

/**
 * Repository.
 */
final class PackageFinderRepository
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
     * Find packages.
     *
     * @return PackageData[] A list of packages
     */
    public function findPackages(): array
    {
        $query = $this->queryFactory->newSelect('packages');

        $query->select(
            [
                'id',
                'weight',
                'address',
            ]
        );

        // Add more "use case specific" conditions to the query
        // ...

        $rows = $query->execute()->fetchAll('assoc') ?: [];

        // Convert to list of objects
        return $this->hydrator->hydrate($rows, PackageData::class);
    }
}
