<?php
/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Test;

use \AdobeStock\Api\Core\Config as CoreConfig;
use \PHPUnit\Framework\TestCase;
use \AdobeStock\Api\Client\Http\HttpClient;
use \GuzzleHttp\Psr7;
use \AdobeStock\Api\Client\License as LicenseFactory;
use \AdobeStock\Api\Request\License as LicenseRequest;
use \GuzzleHttp\Psr7\Request;
use \GuzzleHttp\Psr7\Response;

class LicenseFactoryTest extends TestCase
{
    /**
     * Factory object of all license api.
     * @var LicenseFactory
     */
    private $_license_factory;

    /**
     * Config to be initialized.
     * @var CoreConfig
     */
    private $_config;

    /**
     * Request object for license.
     * @var LicenseRequest
     */
    private $_request;

    /**
     * Mocked HttpClient.
     * @var Mocked HttpClient.
     */
    private $_mocked_http_client;

    /**
     * @test
     * @before
     */
    public function initializeConstructorOfLicenseFactory()
    {
        $this->_mocked_http_client = $this->createMock(HttpClient::class);
        $this->_config = new CoreConfig('APIKey', 'Product', 'STAGE');
        $this->_license_factory = new LicenseFactory($this->_config);
        $this->assertInstanceOf(LicenseFactory::class, $this->_license_factory);
    }

    /**
     * @test
     */
    public function getContentInfoShouldReturnValidResponse()
    {
        $this->_request = new LicenseRequest();
        $this->_request->setContentId(59741022);
        $this->_request->setLicenseState('STANDARD');
        $this->_mocked_http_client->method('doGet')->willReturn(Psr7\Utils::streamFor('{
             "member": {
                "stock_id": 1393839
                       },
             "contents": {
                "59741022": {
                 "content_id": "59741022",
                    "size": "Comp",
                    "purchase_details": {
                        "state": "not_purchased",
                        "stock_id": 1393839
                    }
                }
           }
        }'));
        $final_response = $this->_license_factory->getContentInfo($this->_request, 'test', $this->_mocked_http_client);
        $this->assertEquals(1393839, $final_response->getMemberInfo()->getStockId());
    }
    
    
    /**
     * @test
     */
    public function getContentInfoContentIdNullShouldThrowException()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->_request = new LicenseRequest();
        $final_response = $this->_license_factory->getContentInfo($this->_request, 'test', $this->_mocked_http_client);
    }
    
    /**
     * @test
     */
    public function getContentInfoLicenseStateNullShouldThrowException()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->_request = new LicenseRequest();
        $this->_request->setContentId(59741022);
        $final_response = $this->_license_factory->getContentInfo($this->_request, 'test', $this->_mocked_http_client);
    }
    
    /**
     * @test
     */
    public function getContentInfoAccessTokenEmptyShouldThrowException()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->_request = new LicenseRequest();
        $this->_request->setContentId(59741022);
        $this->_request->setLicenseState('STANDARD');
        $final_response = $this->_license_factory->getContentInfo($this->_request, '', $this->_mocked_http_client);
    }
    
    /**
     * @test
     */
    public function getContentLicenseWithGetRequestShouldReturnValidResponse()
    {
        $this->_request = new LicenseRequest();
        $this->_request->setContentId(59741022);
        $this->_request->setLicenseState('STANDARD');
        $this->_mocked_http_client->method('doGet')->willReturn(Psr7\Utils::streamFor('{
             "member": {
                "stock_id": 1393839
                },
                "available_entitlement": null,
                "contents": {
                    "59741022": {
                        "content_id": "59741022",
                        "size": "Comp",
                        "purchase_details": {
                            "state": "not_possible",
                            "url": "https://primary.staging.adobestock.com/59741022?sso_inbound=1",
                            "message": ""
                        }
                    }
                }
        }'));
        $final_response = $this->_license_factory->getContentLicense($this->_request, 'test', $this->_mocked_http_client);
        $this->assertEquals(1393839, $final_response->getMemberInfo()->getStockId());
    }
    
    /**
     * @test
     */
    public function getContentLicenseWithPostRequestShouldReturnValidResponse()
    {
        $this->_request = new LicenseRequest();
        $this->_request->setContentId(59741022);
        $this->_request->setLicenseState('STANDARD');
        $data = [
                [
                    'id' => 123,
                    'value' => 'test',
                ],
        ];
        $this->_request->setLicenseReference($data);
        $this->_mocked_http_client->method('doPost')->willReturn(Psr7\Utils::streamFor('{
             "member": {
                "stock_id": 1393839
                },
                "available_entitlement": null,
                "contents": {
                    "59741022": {
                        "content_id": "59741022",
                        "size": "Comp",
                        "purchase_details": {
                            "state": "not_possible",
                            "url": "https://primary.staging.adobestock.com/59741022?sso_inbound=1",
                            "message": ""
                        }
                    }
                }
        }'));
        $final_response = $this->_license_factory->getContentLicense($this->_request, 'test', $this->_mocked_http_client);
        $this->assertEquals(1393839, $final_response->getMemberInfo()->getStockId());
    }
    
    /**
     * @test
     */
    public function getContentLicenseContentIdNullShouldThrowException()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->_request = new LicenseRequest();
        $final_response = $this->_license_factory->getContentLicense($this->_request, 'test', $this->_mocked_http_client);
    }
    
    /**
     * @test
     */
    public function getContentLicenseLicenseStateNullShouldThrowException()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->_request = new LicenseRequest();
        $this->_request->setContentId(59741022);
        $final_response = $this->_license_factory->getContentLicense($this->_request, 'test', $this->_mocked_http_client);
    }
    
    /**
     * @test
     */
    public function getContentLicenseAccessTokenEmptyShouldThrowException()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->_request = new LicenseRequest();
        $this->_request->setContentId(59741022);
        $this->_request->setLicenseState('STANDARD');
        $final_response = $this->_license_factory->getContentLicense($this->_request, '', $this->_mocked_http_client);
    }
    
    /**
     * @test
     */
    public function getMemberProfileShouldReturnValidResponse()
    {
        $this->_request = new LicenseRequest();
        $this->_request->setContentId(84071201);
        $this->_request->setLicenseState('STANDARD');
        $this->_mocked_http_client->method('doGet')->willReturn(Psr7\Utils::streamFor('{
             "available_entitlement": {
                "quota": 0,
                "full_entitlement_quota": []
                },
                "member": {
                    "stock_id": 1393839
                },
                "purchase_options": {
                    "state": "not_possible",
                    "requires_checkout": true,
                    "message": "You have 0 licenses. Purchase on Adobe Stock?",
                    "url": "https://primary.staging.adobestock.com/84071201?sso_inbound=1&license=1"
                },
                "cce_agency" : []
        }'));
        $final_response = $this->_license_factory->getMemberProfile($this->_request, 'test', $this->_mocked_http_client);
        $this->assertEquals(1393839, $final_response->getMemberInfo()->getStockId());
    }
    
    /**
     * @test
     */
    public function getMemberProfileContentIdNullShouldThrowException()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->_request = new LicenseRequest();
        $final_response = $this->_license_factory->getMemberProfile($this->_request, 'test', $this->_mocked_http_client);
    }
    
    /**
     * @test
     */
    public function getMemberProfileAccessTokenEmptyShouldThrowException()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->_request = new LicenseRequest();
        $this->_request->setContentId(59741022);
        $this->_request->setLicenseState('STANDARD');
        $final_response = $this->_license_factory->getMemberProfile($this->_request, '', $this->_mocked_http_client);
    }
    
    /**
     * @test
     */
    public function getAbandonLicenseShouldReturnValidResponse()
    {
        $this->_request = new LicenseRequest();
        $this->_request->setContentId(84071201);
        $this->_mocked_http_client->method('doGet')->willReturn(Psr7\Utils::streamFor('204'));
        $final_response = $this->_license_factory->abandonLicense($this->_request, 'test', $this->_mocked_http_client);
        $this->assertEquals(204, $final_response);
    }
    
    /**
     * @test
     */
    public function getAbandonLicenseContentIdNullShouldThrowException()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->_request = new LicenseRequest();
        $final_response = $this->_license_factory->abandonLicense($this->_request, 'test', $this->_mocked_http_client);
    }
    
    /**
     * @test
     */
    public function getAbandonLicenseAccessTokenEmptyShouldThrowException()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->_request = new LicenseRequest();
        $this->_request->setContentId(59741022);
        $this->_request->setLicenseState('STANDARD');
        $final_response = $this->_license_factory->abandonLicense($this->_request, '', $this->_mocked_http_client);
    }
    
    /**
     * @test
     */
    public function getAbandonLicenseShouldThrowExceptionIfResponseCodeIsNot204()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->_request = new LicenseRequest();
        $this->_request->setContentId(59741022);
        $this->_request->setLicenseState('STANDARD');
        $this->_mocked_http_client->method('doGet')->willReturn(Psr7\Utils::streamFor('205'));
        $final_response = $this->_license_factory->abandonLicense($this->_request, 'test', $this->_mocked_http_client);
    }
    
    /**
     * @test
     */
    public function downloadAssetRequestShouldReturnValidRequestObject()
    {
        $response = [
            'member' =>
            [
                'stock_id' => '5PAGXppkUvXRR851OtNbz9HaODSXa7BV',
            ],
            'available_entitlement' =>
            [
                'quota' => 4,
            ],
            'contents' =>
            [
                '84071201' =>
                ['content_id' => '84071201',
                    'size' => 'Comp',
                    'purchase_details' =>
                    [
                        'state' => 'purchased',
                        'license' => 'Standard',
                        'date' => '2017-06-21 10:38:52',
                        'url' => 'https://primary.staging.adobestock.com/Rest/Libraries/Download/84071201/1',
                        'content_type' => 'image/jpeg',
                        'width' => 4000,
                        'height' => 3928,
                            
                    ],
                ],
            ],
        ];
                                
        $this->_mocked_http_client->method('doGet')->willReturn(Psr7\Utils::streamFor(json_encode($response)));
        $request = new LicenseRequest();
        $request->setContentId(84071201)->setLicenseState('STANDARD');
        $guzzle_request = $this->_license_factory->downloadAssetRequest($request, 'access_token', $this->_mocked_http_client);
    }
    
    /**
     * @test
     */
    public function downloadAssetRequestShouldThrowExceptionSinceLicenseInfoNull()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->expectExceptionMessage('Could not find the licensing information for the asset');
        $response = [];
        $this->_mocked_http_client->method('doGet')->willReturn(Psr7\Utils::streamFor(json_encode($response)));
        $request = new LicenseRequest();
        $request->setContentId(84071201)->setLicenseState('STANDARD');
        $guzzle_request = $this->_license_factory->downloadAssetRequest($request, 'access_token', $this->_mocked_http_client);
    }
    
    /**
     * @test
     */
    public function downloadAssetRequestShouldThrowExceptionSincePurchaseDetailsNull()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->expectExceptionMessage('Could not find the purchase details for the asset');
        $response = [
            'member' =>
            [
                'stock_id' => '5PAGXppkUvXRR851OtNbz9HaODSXa7BV',
            ],
            'available_entitlement' =>
            [
                'quota' => 4,
            ],
            'contents' =>
            [
                '84071201' =>
                ['content_id' => '84071201',
                    'size' => 'Comp',
                    'purchase_options' =>
                        [
                            'state' => 'not_possible',
                        ],
                ],
            ],
        ];
        $this->_mocked_http_client->method('doGet')->willReturn(Psr7\Utils::streamFor(json_encode($response)));
        $request = new LicenseRequest();
        $request->setContentId(84071201)->setLicenseState('STANDARD');
        $guzzle_request = $this->_license_factory->downloadAssetRequest($request, 'access_token', $this->_mocked_http_client);
    }
    
    /**
     * @test
     */
    public function downloadAssetRequestShouldThrowExceptionSinceAssetNotPurchasedButCanBeLicensed()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->expectExceptionMessage(
            'Content not licensed but have enough quota or overage plan, so first buy the license'
        );
        $response = [
            'member' =>
            [
                'stock_id' => '5PAGXppkUvXRR851OtNbz9HaODSXa7BV',
            ],
            'available_entitlement' =>
            [
                'quota' => 4,
            ],
            'contents' =>
            [
                '84071201' =>
                [
                    'content_id' => '84071201',
                    'size' => 'Comp',
                    'purchase_details' =>
                    [
                        'state' => 'not_purchased',
                    ],
                ],
            ],
            'purchase_options' =>
            [
                'state' => 'not_possible',
                'requires_checkout' => 'false',
                'message' => 'This will use 1 of your 6 licenses.',
            ],
        ];
        $this->_mocked_http_client->method('doGet')->willReturn(Psr7\Utils::streamFor(json_encode($response)));
        $request = new LicenseRequest();
        $request->setContentId(84071201)->setLicenseState('STANDARD');
        $guzzle_request = $this->_license_factory->downloadAssetRequest($request, 'access_token', $this->_mocked_http_client);
    }
    
    /**
     * @test
     */
    public function downloadAssetRequestShouldThrowExceptionSinceAssetNotPurchasedAndCannotBeLicensed()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->expectExceptionMessage('Content not licensed and also you do not have enough quota or overage plan');
        $response = [
            'member' =>
            [
                'stock_id' => '5PAGXppkUvXRR851OtNbz9HaODSXa7BV',
            ],
            'available_entitlement' =>
            [
                'quota' => 0,
            ],
            'contents' =>
            [
                '84071201' =>
                [
                    'content_id' => '84071201',
                    'size' => 'Comp',
                    'purchase_details' =>
                    [
                        'state' => 'not_purchased',
                    ],
                ],
            ],
            'purchase_options' =>
            [
                'state' => 'not_possible',
                'requires_checkout' => 'false',
                'message' => 'This will use 1 of your 6 licenses.',
            ],
        ];
        $this->_mocked_http_client->method('doGet')->willReturn(Psr7\Utils::streamFor(json_encode($response)));
        $request = new LicenseRequest();
        $request->setContentId(84071201)->setLicenseState('STANDARD');
        $guzzle_request = $this->_license_factory->downloadAssetRequest($request, 'access_token', $this->_mocked_http_client);
    }
    
    /**
     * @test
     */
    public function downloadAssetRequestShouldThrowExceptionSinceAssetNotPurchasedButOveragePlanPresent()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->expectExceptionMessage(
            'Content not licensed but have enough quota or overage plan, so first buy the license'
        );
        $response = [
            'member' =>
            [
                'stock_id' => '5PAGXppkUvXRR851OtNbz9HaODSXa7BV',
            ],
            'available_entitlement' =>
            [
                'quota' => 4,
            ],
            'contents' =>
            [
                '84071201' =>
                [
                    'content_id' => '84071201',
                    'size' => 'Comp',
                    'purchase_details' =>
                    [
                        'state' => 'not_purchased',
                    ],
                ],
            ],
            'purchase_options' =>
            [
                'state' => 'overage',
                'requires_checkout' => 'false',
                'message' => 'This will use 1 of your 6 licenses.',
            ],
        ];
        $this->_mocked_http_client->method('doGet')->willReturn(Psr7\Utils::streamFor(json_encode($response)));
        $request = new LicenseRequest();
        $request->setContentId(84071201)->setLicenseState('STANDARD');
        $guzzle_request = $this->_license_factory->downloadAssetRequest($request, 'access_token', $this->_mocked_http_client);
    }
    
    /**
     * @test
     */
    public function downloadAssetRequestShouldThrowExceptionSinceAssetUrlNotPresent()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->expectExceptionMessage('Could not find the purchase details for the asset');
        $response = [
            'member' =>
            [
                'stock_id' => '5PAGXppkUvXRR851OtNbz9HaODSXa7BV',
            ],
            'available_entitlement' =>
            [
                'quota' => 4,
            ],
            'contents' =>
            [
                '84071201' =>
                ['content_id' => '84071201',
                    'size' => 'Comp',
                    'purchase_details' =>
                    [
                        'state' => 'purchased',
                        'license' => 'Standard',
                        'date' => '2017-06-21 10:38:52',
                        'content_type' => 'image/jpeg',
                        'width' => 4000,
                        'height' => 3928,
                            
                    ],
                ],
            ],
        ];
        $this->_mocked_http_client->method('doGet')->willReturn(Psr7\Utils::streamFor(json_encode($response)));
        $request = new LicenseRequest();
        $request->setContentId(84071201)->setLicenseState('STANDARD');
        $guzzle_request = $this->_license_factory->downloadAssetRequest($request, 'access_token', $this->_mocked_http_client);
    }
    
    /**
     * @test
     */
    public function downloadAssetRequestShouldThrowExceptionSinceEntitlementIsNotPresent()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->expectExceptionMessage('Could not find the available licenses for the user');
        $response = [
            'member' =>
            [
                'stock_id' => '5PAGXppkUvXRR851OtNbz9HaODSXa7BV',
            ],
            'contents' =>
            [
                '84071201' =>
                [
                    'content_id' => '84071201',
                    'size' => 'Comp',
                    'purchase_details' =>
                    [
                        'state' => 'not_purchased',
                    ],
                ],
            ],
            'purchase_options' =>
            [
                'state' => 'overage',
                'requires_checkout' => 'false',
                'message' => 'This will use 1 of your 6 licenses.',
            ],
        ];
        $this->_mocked_http_client->method('doGet')->willReturn(Psr7\Utils::streamFor(json_encode($response)));
        $request = new LicenseRequest();
        $request->setContentId(84071201)->setLicenseState('STANDARD');
        $guzzle_request = $this->_license_factory->downloadAssetRequest($request, 'access_token', $this->_mocked_http_client);
    }
    
    /**
     * @test
     */
    public function downloadAssetRequestShouldThrowExceptionSincePurchasingOptionsIsNotPresent()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->expectExceptionMessage('Could not find the user purchasing options for the asset');
        $response = [
            'member' =>
            [
                'stock_id' => '5PAGXppkUvXRR851OtNbz9HaODSXa7BV',
            ],
            'available_entitlement' =>
            [
                'quota' => 4,
            ],
            'contents' =>
            [
                '84071201' =>
                [
                    'content_id' => '84071201',
                    'size' => 'Comp',
                    'purchase_details' =>
                    [
                        'state' => 'not_purchased',
                    ],
                ],
            ],
        ];
        $this->_mocked_http_client->method('doGet')->willReturn(Psr7\Utils::streamFor(json_encode($response)));
        $request = new LicenseRequest();
        $request->setContentId(84071201)->setLicenseState('STANDARD');
        $guzzle_request = $this->_license_factory->downloadAssetRequest($request, 'access_token', $this->_mocked_http_client);
    }
    
    /**
     * @test
     */
    public function downloadAssetRequestShouldThrowExceptionSincePurchasingStateIsNotPresent()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->expectExceptionMessage('Could not find the purchase details for the asset');
        $response = [
            'member' =>
            [
                'stock_id' => '5PAGXppkUvXRR851OtNbz9HaODSXa7BV',
            ],
            'contents' =>
            [
                '84071201' =>
                [
                    'content_id' => '84071201',
                    'size' => 'Comp',
                    'purchase_details' =>
                    [
                    ],
                ],
            ],
        ];
        $this->_mocked_http_client->method('doGet')->willReturn(Psr7\Utils::streamFor(json_encode($response)));
        $request = new LicenseRequest();
        $request->setContentId(84071201)->setLicenseState('STANDARD');
        $guzzle_request = $this->_license_factory->downloadAssetRequest($request, 'access_token', $this->_mocked_http_client);
    }
    
    /**
     * @test
     */
    public function downloadAssetUrlShouldReturnValidUrl()
    {
        $request = new LicenseRequest();
        $guzzle_request = new Request('GET', 'TEST');
        $mock = $this->getMockBuilder('AdobeStock\Api\Client\License')
               ->disableOriginalConstructor()
               ->setMethods([
                   'downloadAssetRequest',
               ])
               ->getMock();
        $mock->method('downloadAssetRequest')
             ->will($this->returnValue($guzzle_request));
        $url = $mock->downloadAssetUrl($request, '', $this->_mocked_http_client);
        $this->assertEquals('TEST', $url);
    }
    
    /**
     * @test
     */
    public function downloadAssetStreamShouldReturnStream()
    {
        $response = new Response(200, [], 'image');
        $this->_mocked_http_client->method('sendRequest')
            ->willReturn($response);
        $request = new LicenseRequest();
        $guzzle_request = new Request('GET', 'TEST');
        $mock = $this->getMockBuilder('AdobeStock\Api\Client\License')
               ->disableOriginalConstructor()
               ->setMethods([
                   'downloadAssetRequest',
               ])
        ->getMock();
        $mock->method('downloadAssetRequest')
        ->will($this->returnValue($guzzle_request));
        $stream = $mock->downloadAssetStream($request, '', $this->_mocked_http_client);
        $this->assertEquals('image', $stream);
    }
}
