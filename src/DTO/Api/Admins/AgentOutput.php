<?php

namespace DataMat\CheshireCat\DTO\Api\Admins;

use Symfony\Component\Serializer\Annotation\SerializedName;

class AgentOutput
{
    #[SerializedName('agent_id')]
    public string $agentId;

    /** @var array<string, mixed> */
    public array $metadata;
}