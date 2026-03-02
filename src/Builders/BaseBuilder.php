<?php

namespace DataMat\GrinningCat\Builders;

interface BaseBuilder
{
    public static function create(): self;

    public function build(): mixed;
}