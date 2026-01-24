<?php

namespace DataMat\CheshireCat\DTO;

class FilterSource
{
    public ?string $source = null;
    public ?string $hash = null;

    private function validate(): void
    {
        if ($this->source === null && $this->hash === null) {
            throw new \InvalidArgumentException('Either source or hash must be provided.');
        }
    }

    public function __construct(?string $source = null, ?string $hash = null)
    {
        $this->source = $source;
        $this->hash = $hash;
        $this->validate();
    }
}