<?php

namespace DataMat\GrinningCat\Tests;

use DataMat\GrinningCat\Endpoints\AbstractEndpoint;
use DataMat\GrinningCat\Tests\Traits\TestTrait;
use GuzzleHttp\Client as HttpClient;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use WebSocket\Client as WsClient;

class BaseTest extends TestCase
{
    use TestTrait;

    /**
     * @throws \JsonException|Exception
     */
    public function testFailGetClientFromHttpClient(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('You must provide an apikey or a token');

        $httpClient = $this->getHttpClient();
        $httpClient->getClient();
    }

    /**
     * @throws \JsonException|Exception
     */
    public function testFailGetClientFromWSClient(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('You must provide an apikey or a token');

        $wsClient = $this->getWsClient();
        $wsClient->getClient('agent', 'user');
    }

    /**
     * @throws \JsonException|Exception
     */
    public function testGetGuzzleClientsFromGrinningCatClientWithApikeySuccess(): void
    {
        $grinningCatClient = $this->getGrinningCatClient($this->apikey);

        self::assertInstanceOf(HttpClient::class, $grinningCatClient->getHttpClient()->getClient());
        self::assertInstanceOf(WsClient::class, $grinningCatClient->getWsClient()->getClient('agent', 'user'));
    }

    /**
     * @throws \JsonException|Exception
     */
    public function testGetGuzzleClientsFromGrinningCatClientWithTokenSuccess(): void
    {
        $grinningCatClient = $this->getGrinningCatClient();
        $grinningCatClient->addToken($this->token);

        self::assertInstanceOf(HttpClient::class, $grinningCatClient->getHttpClient()->getClient());
        self::assertInstanceOf(WsClient::class, $grinningCatClient->getWsClient()->getClient('agent', 'user'));
    }

    /**
     * @throws Exception|\JsonException
     */
    public function testFactorySuccess(): void
    {
        $grinningCatClient = $this->getGrinningCatClient($this->apikey);
        $endpoint = $grinningCatClient->admins();

        self::assertInstanceOf(AbstractEndpoint::class, $endpoint);
    }
}