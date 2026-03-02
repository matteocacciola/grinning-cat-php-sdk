<?php

namespace DataMat\GrinningCat\DTO\Api\Memory;

use DataMat\GrinningCat\DTO\Api\Memory\Nested\Record;

class MemoryPointsOutput
{
    /** @var Record[] */
    public array $points;

    public string|int|null $nextOffset = null;
}