<?php

namespace App\Domain\RouteArea\Data;

use Selective\ArrayReader\ArrayReader;

/**
 * RouteArea Model.
 */
final class RouteAreaData
{
    public ?int $id = null;

    public ?string $areacode = null;

    public ?string $description = null;


    /**
     * The constructor.
     *
     * @param array $data The data
     */
    public function __construct(array $data = [])
    {
        $reader = new ArrayReader($data);

        $this->id = $reader->findInt('id');
        $this->areacode = $reader->findString('areacode');
        $this->description = $reader->findString('description');
    }
}
