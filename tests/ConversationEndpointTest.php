<?php

namespace DataMat\GrinningCat\Tests;

use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\MockObject\Exception;

class ConversationEndpointTest extends BaseTest
{

    /**
     * @throws GuzzleException|Exception|\JsonException
     */
    public function testGetConversationHistorySuccess(): void
    {
        $expected = [
            'history' => [
                [
                    'who' => 'user',
                    'when' => 0.0,
                    'content' => [
                        'text' => 'Hey you!',
                    ],
                ],
                [
                    'who' => 'assistant',
                    'when' => 0.1,
                    'content' => [
                        'text' => 'Hi!',
                    ],
                ],
            ],
        ];

        $grinningCatClient = $this->getGrinningCatClient($this->apikey, $expected);

        $endpoint = $grinningCatClient->conversation();
        $result = $endpoint->getConversationHistory('agent', 'user', 'chat');

        self::assertEquals($expected, $result->toArray());
    }

    /**
     * @throws GuzzleException|Exception|\JsonException
     */
    public function testDeleteConversationSuccess(): void
    {
        $expected = ['deleted' => true];

        $grinningCatClient = $this->getGrinningCatClient($this->apikey, $expected);

        $endpoint = $grinningCatClient->conversation();
        $result = $endpoint->deleteConversation('agent', 'user', 'chat');

        self::assertEquals($expected['deleted'], $result->deleted);
    }
}