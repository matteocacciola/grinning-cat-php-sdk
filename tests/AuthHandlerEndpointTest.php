<?php

namespace DataMat\GrinningCat\Tests;

use DataMat\GrinningCat\Tests\Traits\TestTrait;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

class AuthHandlerEndpointTest extends TestCase
{
    use TestTrait;

    /**
     * @throws GuzzleException|\JsonException|Exception
     */
    public function testGetAuthHandlersSettingsSuccess(): void
    {
        $expected = [
            'settings' => [
                [
                    'name' => 'testAuthHandler',
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
            'selected_configuration' => 'testAuthHandler',
        ];

        $grinningCatClient = $this->getGrinningCatClient($this->apikey, $expected);

        $endpoint = $grinningCatClient->authHandler();
        $result = $endpoint->getAuthHandlersSettings('agent');

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
    public function testGetAuthHandlerSettingsSuccess(): void
    {
        $expected = [
            'name' => 'testAuthHandler',
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

        $endpoint = $grinningCatClient->authHandler();
        $result = $endpoint->getAuthHandlerSettings('testAuthHandler', 'agent');

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
    public function testPutAuthHandlerSettingsSuccess(): void
    {
        $expected = [
            'name' => 'testAuthHandler',
            'value' => [
                'property_first' => 'value_first',
                'property_second' => 'value_second',
            ],
        ];

        $grinningCatClient = $this->getGrinningCatClient($this->apikey, $expected);

        $endpoint = $grinningCatClient->authHandler();
        $result = $endpoint->putAuthHandlerSettings('testAuthHandler', 'agent', $expected['value']);

        self::assertEquals($expected['name'], $result->name);
        foreach ($expected['value'] as $property => $value) {
            self::assertEquals($value, $result->value[$property]);
        }
    }
}