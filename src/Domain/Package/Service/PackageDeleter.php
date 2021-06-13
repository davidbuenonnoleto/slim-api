<?php

namespace App\Domain\Package\Service;

use App\Domain\Package\Repository\PackageRepository;

/**
 * Service.
 */
final class PackageDeleter
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
     * Delete package.
     *
     * @param int $packageId The package id
     *
     * @return void
     */
    public function deletePackage(int $packageId): void
    {
        // Input validation
        // ...

        $this->repository->deletePackageById($packageId);
    }
}
