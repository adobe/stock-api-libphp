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

use \AdobeStock\Api\Client\AdobeStock;
use \AdobeStock\Api\Request\SearchCategory as SearchCategoryRequest;
use \PHPUnit\Framework\TestCase;
use \AdobeStock\Api\Client\Http\HttpClient;
use \AdobeStock\Api\Response\SearchCategory as SearchCategoryResponse;
use \AdobeStock\Api\Response\SearchFiles as SearchFilesResponse;
use \AdobeStock\Api\Core\Constants as CoreConstants;
use \AdobeStock\Api\Request\SearchFiles as SearchFilesRequest;
use \AdobeStock\Api\Models\SearchParameters as SearchParametersModels;
use \AdobeStock\Api\Request\License as LicenseRequest;
use \AdobeStock\Api\Response\License as LicenseResponse;

/**
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class AdobeStockTest extends TestCase
{
    /**
     * @test
     */
    public function setHttpClientShouldSetCustomHttpClient()
    {
        $adobe_client = new \AdobeStock\Api\Client\AdobeStock('APIKey', 'Product', 'STAGE', null);
        $adobe_client->setHttpClient($this->createMock(HttpClient::class));
        $this->assertNotNull($adobe_client);
    }

    /**
     * @test
     */
    public function searchCategoryShouldReturnSearchCategoryResponse()
    {
        $raw_response = '{
            "id": 1043,
            "link": "/Category/travel/1043",
            "name": "Travel"
        }';
        $request = new SearchCategoryRequest();
        $request->setCategoryId(11);
        $response = new SearchCategoryResponse(json_decode($raw_response, true));
        
        $external_mock = \Mockery::mock('overload:AdobeStock\Api\Client\SearchCategory');
        $external_mock->shouldReceive('getCategory')->once()->andReturn($response);
        
        $adobe_client = new \AdobeStock\Api\Client\AdobeStock('APIKey', 'Product', 'STAGE', $this->createMock(HttpClient::class));
        $adobe_client->searchCategory($request, '');
        $this->assertEquals($response, $adobe_client->searchCategory($request, ''));
    }

    /**
     * @test
     */
    public function searchCategoryTreeShouldReturnSearchCategoryResponseArray()
    {
        $raw_response = '{
            "id": 1043,
            "link": "/Category/travel/1043",
            "name": "Travel"
        }';
        $response_array = [];
        $request = new SearchCategoryRequest();
        $request->setCategoryId(11);
        $response = new SearchCategoryResponse(json_decode($raw_response, true));
        $response_array[] = $response;
        
        $external_mock = \Mockery::mock('overload:AdobeStock\Api\Client\SearchCategory');
        $external_mock->shouldReceive('getCategoryTree')->once()->andReturn($response_array);
        
        $adobe_client = new \AdobeStock\Api\Client\AdobeStock('APIKey', 'Product', 'STAGE', null);
        $adobe_client->searchCategoryTree($request, '');
        $this->assertEquals($response_array, $adobe_client->searchCategoryTree($request, ''));
    }

    /**
     * @test
     */
    public function testSearchFilesInitialize()
    {
        $results_columns = CoreConstants::getResultColumns();
        $search_params = new SearchParametersModels();
        $search_params->setWords('tree')->setLimit(3)->setOffset(0);
        
        $result_column_array = [
            $results_columns['NB_RESULTS'],
            $results_columns['COUNTRY_NAME'],
            $results_columns['ID'],
        ];
        $request = new SearchFilesRequest();
        $request->setLocale('En_US');
        $request->setSearchParams($search_params);
        $request->setResultColumns($result_column_array);
        $external_mock = \Mockery::mock('overload:AdobeStock\Api\Client\SearchFiles');
        $external_mock->shouldReceive('searchFilesInitialize')->once();
        $adobe_client = new \AdobeStock\Api\Client\AdobeStock('APIKey', 'Product', 'STAGE', null);
        $this->assertNotNull($adobe_client->searchFilesInitialize($request, ''));
    }

    /**
     * @test
     */
    public function testGetNextResponse()
    {
        $raw_response = [
            'nb_results' => 5716623,
            'files' => [
            [
                'id' => 104846837,
                'country_name' => 'United States of America',
            ],
            [
                'id' => 92291518,
                'country_name' => 'Spain',
            ],
            [
                'id' => 83502495,
                'country_name' => 'Russian Federation',
            ],
            ],
        ];

        $response = new SearchFilesResponse();
        $response->initializeResponse($raw_response);
    
        $external_mock = \Mockery::mock('overload:AdobeStock\Api\Client\SearchFiles');
        $external_mock->shouldReceive('getNextResponse')->once()->andReturn($response);
    
        $adobe_client = new \AdobeStock\Api\Client\AdobeStock('APIKey', 'Product', 'STAGE', null);
        $this->assertEquals($response, $adobe_client->getNextResponse());
    }
    
    /**
     * @test
     */
    public function testGetPreviousResponse()
    {
        $raw_response = [
            'nb_results' => 5716623,
            'files' => [
            [
                'id' => 92291518,
                'country_name' => 'Spain',
            ],
            [
                'id' => 83502495,
                'country_name' => 'Russian Federation',
            ],
            [
                'id' => 70577212,
                'country_name' => 'Ukraine',
            ],
            ],
        ];
        $response = new SearchFilesResponse();
        $response->initializeResponse($raw_response);
        $external_mock = \Mockery::mock('overload:AdobeStock\Api\Client\SearchFiles');
        $external_mock->shouldReceive('getPreviousResponse')->once()->andReturn($response);
        $adobe_client = new \AdobeStock\Api\Client\AdobeStock('APIKey', 'Product', 'STAGE', null);
        $this->assertEquals($response, $adobe_client->getPreviousResponse());
    }
    
    /**
     * @test
     */
    public function testGetLastResponse()
    {
        $raw_response = [
            'nb_results' => 5716623,
            'files' => [
                [
                    'id' => 92291518,
                    'country_name' => 'Spain',
                ],
                [
                    'id' => 83502495,
                    'country_name' => 'Russian Federation',
                ],
                [
                    'id' => 70577212,
                    'country_name' => 'Ukraine',
                ],
            ],
        ];
        $response = new SearchFilesResponse();
        $response->initializeResponse($raw_response);
        $external_mock = \Mockery::mock('overload:AdobeStock\Api\Client\SearchFiles');
        $external_mock->shouldReceive('getLastResponse')->once()->andReturn($response);
        
        $adobe_client = new \AdobeStock\Api\Client\AdobeStock('APIKey', 'Product', 'STAGE', null);
        $this->assertEquals($response, $adobe_client->getLastResponse());
    }
    /**
     * @test
     */
    public function testGetResponsePage()
    {
        $raw_response = [
            'nb_results' => 5716623,
            'files' => [
                [
                    'id' => 92291518,
                    'country_name' => 'Spain',
                ],
                [
                    'id' => 83502495,
                    'country_name' => 'Russian Federation',
                ],
                [
                    'id' => 70577212,
                    'country_name' => 'Ukraine',
                ],
            ],
        ];
        $response = new SearchFilesResponse();
        $response->initializeResponse($raw_response);
        $external_mock = \Mockery::mock('overload:AdobeStock\Api\Client\SearchFiles');
        $external_mock->shouldReceive('getResponsePage')->once()->andReturn($response);
        
        $adobe_client = new \AdobeStock\Api\Client\AdobeStock('APIKey', 'Product', 'STAGE', null);
        $this->assertEquals($response, $adobe_client->getResponsePage(1));
    }
    
    /**
     * @test
     */
    public function testTotalSearchFiles()
    {
        $total_files = 5716623;
        $external_mock = \Mockery::mock('overload:AdobeStock\Api\Client\SearchFiles');
        $external_mock->shouldReceive('totalSearchFiles')->once()->andReturn($total_files);
        
        $adobe_client = new \AdobeStock\Api\Client\AdobeStock('APIKey', 'Product', 'STAGE', null);
        $this->assertEquals($total_files, $adobe_client->totalSearchFiles());
    }
    
    /**
     * @test
     */
    public function testTotalSearchPages()
    {
        $total_pages = 1905541;
        $external_mock = \Mockery::mock('overload:AdobeStock\Api\Client\SearchFiles');
        $external_mock->shouldReceive('totalSearchPages')->once()->andReturn($total_pages);
        
        $adobe_client = new \AdobeStock\Api\Client\AdobeStock('APIKey', 'Product', 'STAGE', null);
        $this->assertEquals($total_pages, $adobe_client->totalSearchPages());
    }
    
    /**
     * @test
     */
    public function testCurrentSearchPageIndex()
    {
        $current_page = 1;
        $external_mock = \Mockery::mock('overload:AdobeStock\Api\Client\SearchFiles');
        $external_mock->shouldReceive('currentSearchPageIndex')->once()->andReturn($current_page);
        
        $adobe_client = new \AdobeStock\Api\Client\AdobeStock('APIKey', 'Product', 'STAGE', null);
        $this->assertEquals($current_page, $adobe_client->currentSearchPageIndex());
    }
    
    /**
     * @test
     */
    public function licenseContentInfoShouldReturnLicenseResponse()
    {
        $raw_response = '{ "member": {
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
                        }';
        $request = new LicenseRequest();
        $request->setContentId(59741022);
        $request->setLicenseState('STANDARD');
        $response = new LicenseResponse(json_decode($raw_response, true));
        
        $external_mock = \Mockery::mock('overload:AdobeStock\Api\Client\License');
        $external_mock->shouldReceive('getContentInfo')->once()->andReturn($response);
        
        $adobe_client = new \AdobeStock\Api\Client\AdobeStock('APIKey', 'Product', 'STAGE', null);
        $this->assertEquals($response, $adobe_client->getContentInfo($request, ''));
    }
    
    /**
     * @test
     */
    public function licenseContentShouldReturnLicenseResponse()
    {
        $raw_response = '{
                         "member": {
                            "stock_id": 1393839
                        },
                        "available_entitlement": null,
                        "contents": {
                            "84071201": {
                                "content_id": "84071201",
                                "size": "Comp",
                                "purchase_details": {
                                    "state": "not_possible",
                                    "url": "https://primary.staging.adobestock.com/84071201?sso_inbound=1",
                                    "message": ""
                                }
                            }
                        }
                        }';
        $request = new LicenseRequest();
        $request->setContentId(84071201);
        $request->setLicenseState('STANDARD');
        $response = new LicenseResponse(json_decode($raw_response, true));
        
        $external_mock = \Mockery::mock('overload:AdobeStock\Api\Client\License');
        $external_mock->shouldReceive('getContentLicense')->once()->andReturn($response);
        
        $adobe_client = new \AdobeStock\Api\Client\AdobeStock('APIKey', 'Product', 'STAGE', null);
        $this->assertEquals($response, $adobe_client->getContentLicense($request, ''));
    }
    
    /**
     * @test
     */
    public function memberProfileShouldReturnLicenseResponse()
    {
        $raw_response = '{ "available_entitlement": {
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
                            }
                            }';
        $request = new LicenseRequest();
        $request->setContentId(84071201);
        $request->setLicenseState('STANDARD');
        $response = new LicenseResponse(json_decode($raw_response, true));
        
        $external_mock = \Mockery::mock('overload:AdobeStock\Api\Client\License');
        $external_mock->shouldReceive('getMemberProfile')->once()->andReturn($response);
        
        $adobe_client = new \AdobeStock\Api\Client\AdobeStock('APIKey', 'Product', 'STAGE', null);
        $this->assertEquals($response, $adobe_client->getMemberProfile($request, ''));
    }
    
    /**
     * @test
     */
    public function abandonLicenseShouldReturnLicenseResponse()
    {
        $request = new LicenseRequest();
        $request->setContentId(84071201);
        
        $external_mock = \Mockery::mock('overload:AdobeStock\Api\Client\License');
        $external_mock->shouldReceive('abandonLicense')->once()->andReturn(204);
        
        $adobe_client = new \AdobeStock\Api\Client\AdobeStock('APIKey', 'Product', 'STAGE', null);
        $this->assertEquals(204, $adobe_client->abandonLicense($request, ''));
    }
}
