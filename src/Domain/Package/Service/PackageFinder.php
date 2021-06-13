<?php

namespace App\Domain\Package\Service;

use App\Domain\Package\Data\PackageData;
use App\Domain\Package\Repository\PackageFinderRepository;

/**
 * Service.
 */
final class PackageFinder
{
    private PackageFinderRepository $repository;

    /**
     * The constructor.
     *
     * @param PackageFinderRepository $repository The repository
     */
    public function __construct(PackageFinderRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Find packages.
     *
     * @return PackageData[] A list of packages
     */
    public function findPackages(): array
    {
        // Input validation
        // ...

        return $this->repository->findPackages();
    }
}
