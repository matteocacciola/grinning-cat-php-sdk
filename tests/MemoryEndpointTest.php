<?php

namespace DataMat\GrinningCat\Tests;

use DataMat\GrinningCat\Builders\MemoryPointBuilder;
use DataMat\GrinningCat\GrinningCatUtility;
use DataMat\GrinningCat\DTO\Api\Memory\MemoryPointsOutput;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\MockObject\Exception;

class MemoryEndpointTest extends BaseTest
{
    /**
     * @throws GuzzleException|Exception|\JsonException
     */
    public function testGetMemoryCollectionsSuccess(): void
    {
        $expected = [
            'collections' => [
                ['name' => 'declarative', 'vectors_count' => 100],
            ],
        ];

        $grinningCatClient = $this->getGrinningCatClient($this->apikey, $expected);

        $endpoint = $grinningCatClient->memory();
        $result = $endpoint->getMemoryCollections('agent');

        foreach ($expected['collections'] as $key => $collection) {
            self::assertEquals($collection['name'], $result->collections[$key]->name);
            self::assertEquals($collection['vectors_count'], $result->collections[$key]->vectorsCount);
        }
    }

    /**
     * @throws GuzzleException|Exception|\JsonException
     */
    public function testDeleteMemoryCollectionsSuccess(): void
    {
        $expected = [
            'deleted' => [
                'declarative' => false,
            ],
        ];

        $grinningCatClient = $this->getGrinningCatClient($this->apikey, $expected);

        $endpoint = $grinningCatClient->memory();
        $result = $endpoint->deleteAllMemoryCollectionPoints('agent');

        foreach ($expected['deleted'] as $key => $value) {
            self::assertEquals($value, $result->deleted[$key]);
        }
    }

    /**
     * @throws GuzzleException|Exception|\JsonException
     */
    public function testDeleteMemoryCollectionSuccess(): void
    {
        $expected = [
            'deleted' => [
                'declarative' => true,
            ],
        ];

        $grinningCatClient = $this->getGrinningCatClient($this->apikey, $expected);

        $endpoint = $grinningCatClient->memory();
        $result = $endpoint->deleteAllSingleMemoryCollectionPoints('declarative', 'agent');

        self::assertEquals($expected['deleted']['declarative'], $result->deleted['declarative']);
    }

    /**
     * @throws GuzzleException|Exception|\JsonException
     */
    public function testGetMemoryRecallSuccess(): void
    {
        $expected = [
            'query' => ['text' => 'test', 'vector' => []],
            'vectors' => [
                'embedder' => 'testEmbedder',
                'collections' => [
                    'declarative' => [],
                ],
            ],
        ];

        $grinningCatClient = $this->getGrinningCatClient($this->apikey, $expected);

        $endpoint = $grinningCatClient->memory();
        $result = $endpoint->getMemoryRecall($expected['query']['text'], 'agent', 'user');

        self::assertEquals($expected['vectors']['embedder'], $result->vectors->embedder);
    }

    /**
     * @throws GuzzleException|Exception|\JsonException
     */
    public function testPostMemoryPointSuccess(): void
    {
        $expected = [
            'content' => 'test',
            'metadata' => [],
            'id' => 'test_test_test',
            'vector' => [],
        ];

        $grinningCatClient = $this->getGrinningCatClient($this->apikey, $expected);

        $endpoint = $grinningCatClient->memory();

        $memoryPoint = MemoryPointBuilder::create()
            ->setContent($expected['content'])
            ->setMetadata($expected['metadata'])
            ->build();
        $result = $endpoint->postMemoryPoint('declarative', 'agent', 'user', $memoryPoint);

        self::assertEquals($expected['id'], $result->id);
        self::assertEquals($expected['vector'], $result->vector);
    }

    /**
     * @throws GuzzleException|Exception|\JsonException
     */
    public function testPutMemoryPointSuccess(): void
    {
        $expected = [
            'content' => 'test',
            'metadata' => [],
            'id' => 'test_test_test',
            'vector' => [],
        ];

        $grinningCatClient = $this->getGrinningCatClient($this->apikey, $expected);

        $endpoint = $grinningCatClient->memory();

        $memoryPoint = MemoryPointBuilder::create()
            ->setContent($expected['content'])
            ->setMetadata($expected['metadata'])
            ->build();
        $result = $endpoint->putMemoryPoint(
            'declarative',
            'agent',
            'user',
            $memoryPoint,
            $expected['id']
        );

        self::assertEquals($expected['id'], $result->id);
        self::assertEquals($expected['vector'], $result->vector);
    }

    /**
     * @throws GuzzleException|Exception|\JsonException
     */
    public function testDeleteMemoryPointSuccess(): void
    {
        $expected = [
            'deleted' => 'test',
        ];

        $grinningCatClient = $this->getGrinningCatClient($this->apikey, $expected);

        $endpoint = $grinningCatClient->memory();
        $result = $endpoint->deleteMemoryPoint('declarative', 'agent', $expected['deleted']);

        self::assertEquals($expected['deleted'], $result->deleted);
    }

    /**
     * @throws GuzzleException|Exception|\JsonException
     */
    public function testDeleteMemoryPointsByMetadataSuccess(): void
    {
        $metadata = [
            'property1' => 'value1',
            'property2' => 'value2',
            'property3' => 'value3',
            'property4' => 'value4',
            'property5' => 'value5',
        ];

        $expected = [
            'deleted' => ['operation_id' => 21212414, 'status' => 'ok'],
        ];

        $grinningCatClient = $this->getGrinningCatClient($this->apikey, $expected);

        $endpoint = $grinningCatClient->memory();
        $result = $endpoint->deleteMemoryPointsByMetadata('declarative', 'agent', $metadata);

        foreach ($expected['deleted'] as $key => $value) {
            self::assertEquals($value, $result->deleted->{GrinningCatUtility::camelCase($key)});
        }
    }

    /**
     * @throws GuzzleException|Exception|\JsonException
     */
    public function testGetMemoryPointsSuccess(): void
    {
        $expected = [
            'points' => [
                ['id' => 'dgwrgsehsreysery'],
                ['id' => 'weuhg42jdgouwrow4ls'],
            ],
            'next_offset' => 0,
        ];

        $grinningCatClient = $this->getGrinningCatClient($this->apikey, $expected);

        $endpoint = $grinningCatClient->memory();
        $result = $endpoint->getMemoryPoints('declarative', 'agent');

        self::assertInstanceOf(MemoryPointsOutput::class, $result);
    }
}