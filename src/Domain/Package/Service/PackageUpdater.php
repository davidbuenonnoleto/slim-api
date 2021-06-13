<?php

namespace App\Domain\Package\Service;

use App\Domain\Package\Data\PackageData;
use App\Domain\Package\Repository\PackageRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

/**
 * Service.
 */
final class PackageUpdater
{
    private PackageRepository $repository;

    private PackageValidator $packageValidator;

    private LoggerInterface $logger;

    /**
     * The constructor.
     *
     * @param PackageRepository $repository The repository
     * @param PackageValidator $packageValidator The validator
     * @param LoggerFactory $loggerFactory The logger factory
     */
    public function __construct(
        PackageRepository $repository,
        PackageValidator $packageValidator,
        LoggerFactory $loggerFactory
    ) {
        $this->repository = $repository;
        $this->packageValidator = $packageValidator;
        $this->logger = $loggerFactory
            ->addFileHandler('package_updater.log')
            ->createLogger();
    }

    /**
     * Update package.
     *
     * @param int $packageId The package id
     * @param array<mixed> $data The request data
     *
     * @return void
     */
    public function updatePackage(int $packageId, array $data): void
    {
        // Input validation
        $this->packageValidator->validatePackageUpdate($packageId, $data);

        // Validation was successfully
        $package = new PackageData($data);
        $package->id = $packageId;

        // Update the package
        $this->repository->updatePackage($package);

        // Logging
        $this->logger->info(sprintf('Package updated successfully: %s', $packageId));
    }
}
