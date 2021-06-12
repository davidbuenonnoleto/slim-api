<?php

namespace App\Domain\Package\Service;

use App\Domain\Package\Data\PackageData;
use App\Domain\Package\Repository\PackageRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

/**
 * Service.
 */
final class PackageCreator
{
    private PackageRepository $repository;

    //private PackageValidator $packageValidator;

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
        //PackageValidator $packageValidator,
        LoggerFactory $loggerFactory
    ) {
        $this->repository = $repository;
        //$this->packageValidator = $packageValidator;
        $this->logger = $loggerFactory
            ->addFileHandler('package_creator.log')
            ->createLogger();
    }

    /**
     * Create a new package.
     *
     * @param array<mixed> $data The form data
     *
     * @return int The new package ID
     */
    public function createPackage(array $data): int
    {
        // Input validation
        $this->packageValidator->validateUser($data);

        // Map form data to package DTO (model)
        $package = new PackageData($data);

        // Insert package and get new package ID
        $packageId = $this->repository->insertPackage($package);

        // Logging
        $this->logger->info(sprintf('Package created successfully: %s', $packageId));

        return $packageId;
    }
}
