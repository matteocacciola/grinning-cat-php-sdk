<?php

namespace DataMat\GrinningCat\Tests;

use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\MockObject\Exception;

class RabbitHoleEndpointTest extends BaseTest
{
    /**
     * @throws GuzzleException|Exception|\JsonException
     */
    public function testGetAllowedMimeTypesSuccess(): void
    {
        $expected = ['allowed' => ['application/pdf', 'text/plain', 'text/markdown', 'text/html']];

        $grinningCatClient = $this->getGrinningCatClient($this->apikey, $expected);

        $endpoint = $grinningCatClient->rabbitHole();
        $result = $endpoint->getAllowedMimeTypes('agent');

        self::assertEquals($expected['allowed'], $result->allowed);
    }

}