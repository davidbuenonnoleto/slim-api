<?php

namespace App\Domain\Package\Service;

use App\Domain\Package\Repository\PackageRepository;
use App\Factory\ValidationFactory;
use Cake\Validation\Validator;
use Selective\Validation\Exception\ValidationException;

/**
 * Service.
 */
final class PackageValidator
{
    private PackageRepository $repository;

    private ValidationFactory $validationFactory;

    /**
     * The constructor.
     *
     * @param PackageRepository $repository The repository
     * @param ValidationFactory $validationFactory The validation
     */
    public function __construct(PackageRepository $repository, ValidationFactory $validationFactory)
    {
        $this->repository = $repository;
        $this->validationFactory = $validationFactory;
    }

    /**
     * Validate update.
     *
     * @param int $packageId The package id
     * @param array<mixed> $data The data
     *
     * @return void
     */
    public function validatePackageUpdate(int $packageId, array $data): void
    {
        if (!$this->repository->existsPackageId($packageId)) {
            throw new ValidationException(sprintf('Package not found: %s', $packageId));
        }

        $this->validatePackage($data);
    }

    /**
     * Validate new package.
     *
     * @param array<mixed> $data The data
     *
     * @throws ValidationException
     *
     * @return void
     */
    public function validatePackage(array $data): void
    {
        $validator = $this->createValidator();

        $validationResult = $this->validationFactory->createValidationResult(
            $validator->validate($data)
        );

        if ($validationResult->fails()) {
            throw new ValidationException('Please check your input', $validationResult);
        }
    }

    /**
     * Create validator.
     *
     * @return Validator The validator
     */
    private function createValidator(): Validator
    {
        $validator = $this->validationFactory->createValidator();

        return $validator
            ->notEmptyString('weight', 'Input required')
            ->notEmptyString('address', 'Input required');
    }
}
