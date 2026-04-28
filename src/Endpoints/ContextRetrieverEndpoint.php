<?php

namespace DataMat\GrinningCat\Endpoints;

use DataMat\GrinningCat\DTO\Api\Factory\FactoryObjectSettingOutput;
use DataMat\GrinningCat\DTO\Api\Factory\FactoryObjectSettingsOutput;
use GuzzleHttp\Exception\GuzzleException;

class ContextRetrieverEndpoint extends AbstractEndpoint
{
    protected string $prefix = '/context_retriever';

    /**
     * This endpoint returns the settings of all context retrievers.
     *
     * @throws GuzzleException
     */
    public function getContextRetrieversSettings(string $agentId): FactoryObjectSettingsOutput
    {
        return $this->get(
            $this->formatUrl('/settings'),
            $agentId,
            FactoryObjectSettingsOutput::class,
        );
    }

    /**
     * This endpoint returns the settings of a specific context retriever.
     *
     * @throws GuzzleException
     */
    public function getContextRetrieverSettings(string $contextRetriever, string $agentId): FactoryObjectSettingOutput
    {
        return $this->get(
            $this->formatUrl('/settings/' . $contextRetriever),
            $agentId,
            FactoryObjectSettingOutput::class,
        );
    }

    /**
     * This endpoint updates the settings of a specific context retriever.
     *
     * @param array<string, mixed> $values
     *
     * @throws GuzzleException
     */
    public function putContextRetrieverSettings(
        string $contextRetriever,
        string $agentId,
        array $values,
    ): FactoryObjectSettingOutput {
        return $this->put(
            $this->formatUrl('/settings/' . $contextRetriever),
            $agentId,
            FactoryObjectSettingOutput::class,
            $values,
        );
    }
}