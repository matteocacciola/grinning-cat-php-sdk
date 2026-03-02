<?php

namespace DataMat\GrinningCat\DTO\Api\Admins;

use DataMat\GrinningCat\DTO\Api\Plugin\PluginToggleOutput;

class PluginInstallFromRegistryOutput extends PluginToggleOutput
{
    public string $url;

    public string $info;
}