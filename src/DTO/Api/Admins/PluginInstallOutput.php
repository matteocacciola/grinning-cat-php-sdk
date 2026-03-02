<?php

namespace DataMat\GrinningCat\DTO\Api\Admins;

use DataMat\GrinningCat\DTO\Api\Plugin\PluginToggleOutput;

class PluginInstallOutput extends PluginToggleOutput
{
    public string $filename;
    public string $contentType;
}