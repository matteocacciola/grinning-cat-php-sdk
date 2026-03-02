<?php

namespace DataMat\GrinningCat\Tests;

use DataMat\GrinningCat\Tests\Traits\TestTrait;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

class UtilsEndpointTest extends TestCase
{
    use TestTrait;

    /**
     * @throws GuzzleException|\JsonException|Exception
     */
    public function testFactoryResetSuccess(): void
    {
        $expected = [
            'deleted_settings' => true,
            'deleted_memories' => true,
            'deleted_plugin_folders' => true,
        ];

        $grinningCatClient = $this->getGrinningCatClient($this->apikey, $expected);

        $endpoint = $grinningCatClient->utils();
        $result = $endpoint->postFactoryReset();

        self::assertTrue($result->deletedSettings);
        self::assertTrue($result->deletedMemories);
        self::assertTrue($result->deletedPluginFolders);
    }

    /**
     * @throws GuzzleException|\JsonException|Exception
     */
    public function testAgentResetSuccess(): void
    {
        $expected = [
            'deleted_settings' => true,
            'deleted_memories' => true,
        ];

        $grinningCatClient = $this->getGrinningCatClient($this->apikey, $expected);

        $endpoint = $grinningCatClient->utils();
        $result = $endpoint->postAgentReset('agent');

        self::assertTrue($result->deletedSettings);
        self::assertTrue($result->deletedMemories);
    }

    /**
     * @throws GuzzleException|\JsonException|Exception
     */
    public function testAgentDestroySuccess(): void
    {
        $expected = [
            'deleted_settings' => true,
            'deleted_memories' => true,
        ];

        $grinningCatClient = $this->getGrinningCatClient($this->apikey, $expected);

        $endpoint = $grinningCatClient->utils();
        $result = $endpoint->postAgentDestroy('agent');

        self::assertTrue($result->deletedSettings);
        self::assertTrue($result->deletedMemories);
    }

    /**
     * @throws GuzzleException|\JsonException|Exception
     */
    public function testAgentCreateSuccess(): void
    {
        $expected = [
            'created' => true,
        ];

        $grinningCatClient = $this->getGrinningCatClient($this->apikey, $expected);

        $endpoint = $grinningCatClient->utils();
        $result = $endpoint->postAgentCreate('agent');

        self::assertTrue($result->created);
    }
}