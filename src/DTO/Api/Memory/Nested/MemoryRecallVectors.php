<?php

namespace DataMat\GrinningCat\DTO\Api\Memory\Nested;

class MemoryRecallVectors
{
    public string $embedder;

    /** @var array<string, array<array<string, mixed>>> */
    public array $collections;
}
