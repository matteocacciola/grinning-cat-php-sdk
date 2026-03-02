<?php

namespace DataMat\GrinningCat;

use DataMat\GrinningCat\Endpoints\AbstractEndpoint;

class GrinningCatFactory
{
    public static function build(string $class, GrinningCatClient $client): AbstractEndpoint
    {
        if (!class_exists($class)) {
            throw new \BadMethodCallException();
        }

        return new $class($client);
    }
}
