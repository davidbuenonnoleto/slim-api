<?php

namespace App\Domain\Package\Data;

use Selective\ArrayReader\ArrayReader;

/**
 * Package Model.
 */
final class PackageData
{
    public ?int $id = null;

    public ?string $weight = null;

    public ?string $address = null;


    /**
     * The constructor.
     *
     * @param array $data The data
     */
    public function __construct(array $data = [])
    {
        $reader = new ArrayReader($data);

        $this->id = $reader->findInt('id');
        $this->weight = $reader->findString('weight');
        $this->address = $reader->findString('address');
    }
}
