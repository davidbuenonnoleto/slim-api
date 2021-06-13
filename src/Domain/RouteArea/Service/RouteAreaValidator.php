<?php

namespace App\Domain\RouteArea\Service;

use App\Domain\RouteArea\Repository\RouteAreaRepository;
use App\Factory\ValidationFactory;
use Cake\Validation\Validator;
use Selective\Validation\Exception\ValidationException;

/**
 * Service.
 */
final class RouteAreaValidator
{
    private RouteAreaRepository $repository;

    private ValidationFactory $validationFactory;

    /**
     * The constructor.
     *
     * @param RouteAreaRepository $repository The repository
     * @param ValidationFactory $validationFactory The validation
     */
    public function __construct(RouteAreaRepository $repository, ValidationFactory $validationFactory)
    {
        $this->repository = $repository;
        $this->validationFactory = $validationFactory;
    }

    /**
     * Validate update.
     *
     * @param int $routeAreaId The routeArea id
     * @param array<mixed> $data The data
     *
     * @return void
     */
    public function validateRouteAreaUpdate(int $routeAreaId, array $data): void
    {
        if (!$this->repository->existsRouteAreaId($routeAreaId)) {
            throw new ValidationException(sprintf('RouteArea not found: %s', $routeAreaId));
        }

        $this->validateRouteArea($data);
    }

    /**
     * Validate new routeArea.
     *
     * @param array<mixed> $data The data
     *
     * @throws ValidationException
     *
     * @return void
     */
    public function validateRouteArea(array $data): void
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
            ->notEmptyString('areacode', 'Input required')
            ->notEmptyString('description', 'Input required');
    }
}
