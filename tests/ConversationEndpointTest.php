<?php

namespace DataMat\CheshireCat\Tests;

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

        $cheshireCatClient = $this->getCheshireCatClient($this->apikey, $expected);

        $endpoint = $cheshireCatClient->conversation();
        $result = $endpoint->getConversationHistory('agent', 'user', 'chat');

        self::assertEquals($expected, $result->toArray());
    }

    /**
     * @throws GuzzleException|Exception|\JsonException
     */
    public function testDeleteConversationSuccess(): void
    {
        $expected = ['deleted' => true];

        $cheshireCatClient = $this->getCheshireCatClient($this->apikey, $expected);

        $endpoint = $cheshireCatClient->conversation();
        $result = $endpoint->deleteConversation('agent', 'user', 'chat');

        self::assertEquals($expected['deleted'], $result->deleted);
    }
}