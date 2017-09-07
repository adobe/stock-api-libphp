<?php
/*************************************************************************
 * ADOBE CONFIDENTIAL
 * ___________________
 *
 *  Copyright 2017 Adobe Systems Incorporated
 *  All Rights Reserved.
 *
 * NOTICE:  All information contained herein is, and remains
 * the property of Adobe Systems Incorporated and its suppliers,
 * if any.  The intellectual and technical concepts contained
 * herein are proprietary to Adobe Systems Incorporated and its
 * suppliers and are protected by all applicable intellectual property
 * laws, including trade secret and copyright laws.
 * Dissemination of this information or reproduction of this material
 * is strictly forbidden unless prior written permission is obtained
 * from Adobe Systems Incorporated.
 **************************************************************************/

namespace AdobeStock\Api\Test;

use \AdobeStock\Api\Core\Config as CoreConfig;
use \PHPUnit\Framework\TestCase;
use \AdobeStock\Api\Client\Http\HttpClient;
use \GuzzleHttp\Psr7;
use \AdobeStock\Api\Client\License as LicenseFactory;
use \AdobeStock\Api\Request\License as LicenseRequest;

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
        $this->_mocked_http_client->method('doGet')->willReturn(Psr7\stream_for('{
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
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function getContentInfoContentIdNullShouldThrowException()
    {
        $this->_request = new LicenseRequest();
        $final_response = $this->_license_factory->getContentInfo($this->_request, 'test', $this->_mocked_http_client);
    }
    
    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function getContentInfoLicenseStateNullShouldThrowException()
    {
        $this->_request = new LicenseRequest();
        $this->_request->setContentId(59741022);
        $final_response = $this->_license_factory->getContentInfo($this->_request, 'test', $this->_mocked_http_client);
    }
    
    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function getContentInfoAccessTokenEmptyShouldThrowException()
    {
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
        $this->_mocked_http_client->method('doGet')->willReturn(Psr7\stream_for('{
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
        $this->_mocked_http_client->method('doPost')->willReturn(Psr7\stream_for('{
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
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function getContentLicenseContentIdNullShouldThrowException()
    {
        $this->_request = new LicenseRequest();
        $final_response = $this->_license_factory->getContentLicense($this->_request, 'test', $this->_mocked_http_client);
    }
    
    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function getContentLicenseLicenseStateNullShouldThrowException()
    {
        $this->_request = new LicenseRequest();
        $this->_request->setContentId(59741022);
        $final_response = $this->_license_factory->getContentLicense($this->_request, 'test', $this->_mocked_http_client);
    }
    
    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function getContentLicenseAccessTokenEmptyShouldThrowException()
    {
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
        $this->_mocked_http_client->method('doGet')->willReturn(Psr7\stream_for('{
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
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function getMemberProfileContentIdNullShouldThrowException()
    {
        $this->_request = new LicenseRequest();
        $final_response = $this->_license_factory->getMemberProfile($this->_request, 'test', $this->_mocked_http_client);
    }
    
    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function getMemberProfileAccessTokenEmptyShouldThrowException()
    {
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
        $this->_mocked_http_client->method('doGet')->willReturn(Psr7\stream_for('204'));
        $final_response = $this->_license_factory->abandonLicense($this->_request, 'test', $this->_mocked_http_client);
        $this->assertEquals(204, $final_response);
    }
    
    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function getAbandonLicenseContentIdNullShouldThrowException()
    {
        $this->_request = new LicenseRequest();
        $final_response = $this->_license_factory->abandonLicense($this->_request, 'test', $this->_mocked_http_client);
    }
    
    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function getAbandonLicenseAccessTokenEmptyShouldThrowException()
    {
        $this->_request = new LicenseRequest();
        $this->_request->setContentId(59741022);
        $this->_request->setLicenseState('STANDARD');
        $final_response = $this->_license_factory->abandonLicense($this->_request, '', $this->_mocked_http_client);
    }
    
    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function getAbandonLicenseShouldThrowExceptionIfResponseCodeIsNot204()
    {
        $this->_request = new LicenseRequest();
        $this->_request->setContentId(59741022);
        $this->_request->setLicenseState('STANDARD');
        $this->_mocked_http_client->method('doGet')->willReturn(Psr7\stream_for('205'));
        $final_response = $this->_license_factory->abandonLicense($this->_request, 'test', $this->_mocked_http_client);
    }
}
