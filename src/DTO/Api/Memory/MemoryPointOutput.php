<?php

namespace DataMat\GrinningCat\DTO\Api\Memory;

use DataMat\GrinningCat\DTO\MemoryPoint;

class MemoryPointOutput extends MemoryPoint
{
    public string $id;

    /** @var float[]|float[][]|array<string, mixed> */
    public array $vector;

}