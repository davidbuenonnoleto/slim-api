<?php

namespace App\Domain\Package\Service;

use App\Domain\Package\Data\PackageData;
use App\Domain\Package\Repository\PackageRepository;

/**
 * Service.
 */
final class PackageReader
{
    private PackageRepository $repository;

    /**
     * The constructor.
     *
     * @param PackageRepository $repository The repository
     */
    public function __construct(PackageRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Read a package.
     *
     * @param int $packageId The package id
     *
     * @return PackageData The package data
     */
    public function getPackageData(int $packageId): PackageData
    {
        // Input validation
        // ...

        // Fetch data from the database
        $package = $this->repository->getPackageById($packageId);

        // Optional: Add or invoke your complex business logic here
        // ...

        // Optional: Map result
        // ...

        return $package;
    }
}
