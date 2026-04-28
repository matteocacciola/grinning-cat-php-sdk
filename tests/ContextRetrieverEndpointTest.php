<?php

namespace DataMat\GrinningCat\Tests;

use DataMat\GrinningCat\Tests\Traits\TestTrait;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

class ContextRetrieverEndpointTest extends TestCase
{
    use TestTrait;

    /**
     * @throws GuzzleException|\JsonException|Exception
     */
    public function testGetContextRetrieversSettingsSuccess(): void
    {
        $expected = [
            'settings' => [
                [
                    'name' => 'testContextRetriever',
                    'value' => [
                        'property_first' => 'value_first',
                        'property_second' => 'value_second',
                    ],
                    'scheme' => [
                        'property_first' => 'value_first',
                        'property_second' => 'value_second',
                    ],
                ],
            ],
            'selected_configuration' => 'testContextRetriever',
        ];

        $grinningCatClient = $this->getGrinningCatClient($this->apikey, $expected);

        $endpoint = $grinningCatClient->contextRetriever();
        $result = $endpoint->getContextRetrieversSettings('agent');

        foreach ($expected['settings'] as $key => $setting) {
            self::assertEquals($setting['name'], $result->settings[$key]->name);
            foreach ($setting['value'] as $property => $value) {
                self::assertEquals($value, $result->settings[$key]->value[$property]);
            }
            foreach ($setting['scheme'] as $property => $value) {
                self::assertEquals($value, $result->settings[$key]->getScheme()[$property]);
            }
        }
        self::assertEquals($expected['selected_configuration'], $result->selectedConfiguration);
    }

    /**
     * @throws GuzzleException|\JsonException|Exception
     */
    public function testGetContextRetrieverSettingsSuccess(): void
    {
        $expected = [
            'name' => 'testContextRetriever',
            'value' => [
                'property_first' => 'value_first',
                'property_second' => 'value_second',
            ],
            'scheme' => [
                'property_first' => 'value_first',
                'property_second' => 'value_second',
            ],
        ];

        $grinningCatClient = $this->getGrinningCatClient($this->apikey, $expected);

        $endpoint = $grinningCatClient->contextRetriever();
        $result = $endpoint->getContextRetrieverSettings('testContextRetriever', 'agent');

        self::assertEquals($expected['name'], $result->name);
        foreach ($expected['value'] as $property => $value) {
            self::assertEquals($value, $result->value[$property]);
        }
        foreach ($expected['scheme'] as $property => $value) {
            self::assertEquals($value, $result->getScheme()[$property]);
        }
    }

    /**
     * @throws GuzzleException|\JsonException|Exception
     */
    public function testPutContextRetrieverSettingsSuccess(): void
    {
        $expected = [
            'name' => 'testContextRetriever',
            'value' => [
                'property_first' => 'value_first',
                'property_second' => 'value_second',
            ],
        ];

        $grinningCatClient = $this->getGrinningCatClient($this->apikey, $expected);

        $endpoint = $grinningCatClient->contextRetriever();
        $result = $endpoint->putContextRetrieverSettings('testContextRetriever', 'agent', $expected['value']);

        self::assertEquals($expected['name'], $result->name);
        foreach ($expected['value'] as $property => $value) {
            self::assertEquals($value, $result->value[$property]);
        }
    }
}