<?php

namespace App\Domain\Package\Repository;

use App\Domain\Package\Data\PackageData;
use App\Factory\QueryFactory;
use Cake\Chronos\Chronos;
use DomainException;

/**
 * Repository.
 */
final class PackageRepository
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
     * Insert package row.
     *
     * @param PackageData $package The Package data
     *
     * @return int The new ID
     */
    public function insertPackage(PackageData $package): int
    {
        $row = $this->toRow($package);
        $row['created_at'] = Chronos::now()->toDateTimeString();

        return (int)$this->queryFactory->newInsert('package', $row)
            ->execute()
            ->lastInsertId();
    }

    /**
     * Get package by id.
     *
     * @param int $packageId The package id
     *
     * @throws DomainException
     *
     * @return PackageData The package
     */
    public function getPackageById(int $packageId): PackageData
    {
        $query = $this->queryFactory->newSelect('package');
        $query->select(
            [
                'id',
                'weight',
                'address'
            ]
        );

        $query->andWhere(['id' => $packageId]);

        $row = $query->execute()->fetch('assoc');

        if (!$row) {
            throw new DomainException(sprintf('Package not found: %s', $packageId));
        }

        return new PackageData($row);
    }

    /**
     * Update package row.
     *
     * @param PackageData $package The package
     *
     * @return void
     */
    public function updatePackage(PackageData $package): void
    {
        $row = $this->toRow($package);

        $row['updated_at'] = Chronos::now()->toDateTimeString();

        $this->queryFactory->newUpdate('package', $row)
            ->andWhere(['id' => $package->id])
            ->execute();
    }

    /**
     * Check package id.
     *
     * @param int $packageId The package id
     *
     * @return bool True if exists
     */
    public function existsPackageId(int $packageId): bool
    {
        $query = $this->queryFactory->newSelect('package');
        $query->select('id')->andWhere(['id' => $packageId]);

        return (bool)$query->execute()->fetch('assoc');
    }

    /**
     * Delete package row.
     *
     * @param int $packageId The package id
     *
     * @return void
     */
    public function deletePackageById(int $packageId): void
    {
        $this->queryFactory->newDelete('package')
            ->andWhere(['id' => $packageId])
            ->execute();
    }

    /**
     * Convert to array.
     *
     * @param PackageData $package The package data
     *
     * @return array The array
     */
    private function toRow(PackageData $package): array
    {
        return [
            'id' => $package->id,
            'username' => $package->weight,
            'password' => $package->address,
        ];
    }
}
