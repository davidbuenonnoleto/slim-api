<?php

namespace App\Domain\RouteArea\Repository;

use App\Domain\RouteArea\Data\RouteAreaData;
use App\Factory\QueryFactory;
use Cake\Chronos\Chronos;
use DomainException;

/**
 * Repository.
 */
final class RouteAreaRepository
{
    private QueryFactory $queryFactory;

    /**
     * The constructor.
     *
     * @param QueryFactory $queryFactory The query factory
     */
    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
    }

    /**
     * Insert routeArea row.
     *
     * @param RouteAreaData $routeArea The routeArea data
     *
     * @return int The new ID
     */
    public function insertRouteArea(RouteAreaData $routeArea): int
    {
        $row = $this->toRow($routeArea);
        $row['created_at'] = Chronos::now()->toDateTimeString();

        return (int)$this->queryFactory->newInsert('routeareas', $row)
            ->execute()
            ->lastInsertId();
    }

    /**
     * Get routeArea by id.
     *
     * @param int $routeAreaId The routeArea id
     *
     * @throws DomainException
     *
     * @return RouteAreaData The routeArea
     */
    public function getRouteAreaById(int $routeAreaId): RouteAreaData
    {
        $query = $this->queryFactory->newSelect('routeareas');
        $query->select(
            [
                'id',
                'areacode',
                'desciption',
            ]
        );

        $query->andWhere(['id' => $routeAreaId]);

        $row = $query->execute()->fetch('assoc');

        if (!$row) {
            throw new DomainException(sprintf('RouteArea not found: %s', $routeAreaId));
        }

        return new RouteAreaData($row);
    }

    /**
     * Update routeArea row.
     *
     * @param RouteAreaData $routeArea The routeArea
     *
     * @return void
     */
    public function updateRouteArea(RouteAreaData $routeArea): void
    {
        $row = $this->toRow($routeArea);

        $row['updated_at'] = Chronos::now()->toDateTimeString();

        $this->queryFactory->newUpdate('routeareas', $row)
            ->andWhere(['id' => $routeArea->id])
            ->execute();
    }

    /**
     * Check routeArea id.
     *
     * @param int $routeAreaId The routeArea id
     *
     * @return bool True if exists
     */
    public function existsRouteAreaId(int $routeAreaId): bool
    {
        $query = $this->queryFactory->newSelect('routeareas');
        $query->select('id')->andWhere(['id' => $routeAreaId]);

        return (bool)$query->execute()->fetch('assoc');
    }

    /**
     * Delete routeArea row.
     *
     * @param int $routeAreaId The routeArea id
     *
     * @return void
     */
    public function deleteRouteAreaById(int $routeAreaId): void
    {
        $this->queryFactory->newDelete('routeareas')
            ->andWhere(['id' => $routeAreaId])
            ->execute();
    }

    /**
     * Convert to array.
     *
     * @param RouteAreaData $routeArea The routeArea data
     *
     * @return array The array
     */
    private function toRow(RouteAreaData $routeArea): array
    {
        return [
            'id' => $routeArea->id,
            'areacode' => $routeArea->areacode,
            'description' => $routeArea->description,
        ];
    }
}
