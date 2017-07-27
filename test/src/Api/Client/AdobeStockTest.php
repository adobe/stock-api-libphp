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

class AdobeStockTest extends TestCase
{
    /**
     * Adobe Stock client for accesing stock apis.
     * @var AdobeStock
     */
    private $_adobe_stock_client;

    /**
     * Mocked Http client.
     * @var HttpClient.
     */
    private $_mocked_http_client;

    /**
     * @test
     * @before
     */
    public function initializeConstructorOfAdobeStockClient()
    {
        $this->_mocked_http_client = $this->createMock(HttpClient::class);
        $this->_adobe_stock_client = new AdobeStock('APIKey', 'Product', 'STAGE', null);
        $this->_adobe_stock_client = new AdobeStock('APIKey', 'Product', 'STAGE', $this->_mocked_http_client);
        $this->assertInstanceOf(AdobeStock::class, $this->_adobe_stock_client);
    }

    /**
     * @test
     */
    public function setHttpClientShouldSetCustomHttpClient()
    {
        $this->_adobe_stock_client->setHttpClient($this->_mocked_http_client);
        $this->assertNotNull($this->_adobe_stock_client);
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
        
        $mock = $this->getMockBuilder(AdobeStock::class)
            ->disableOriginalConstructor()
            ->getMock();
        $mock->method('searchCategory')
             ->will($this->returnValue($response));
        $this->assertEquals($response, $mock->searchCategory($request, ''));
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
        
        $mock = $this->getMockBuilder(AdobeStock::class)
        ->disableOriginalConstructor()
        ->getMock();
        $mock->method('searchCategoryTree')
        ->will($this->returnValue($response_array));
        $this->assertEquals($response_array, $mock->searchCategoryTree($request, ''));
    }
    
    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function searchCategoryTreeShouldThrowExceptionIfApiKeyIsIncorrect()
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
        $adobe_stock_client = new AdobeStock('APIKey', 'Product', 'STAGE', null);
        $this->assertEquals($response_array, $adobe_stock_client->searchCategoryTree($request, ''));
    }

    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function searchCategoryShouldThrowExceptionIfApiKeyIsIncorrect()
    {
        $raw_response = '{
            "id": 1043,
            "link": "/Category/travel/1043",
            "name": "Travel"
        }';
        $request = new SearchCategoryRequest();
        $request->setCategoryId(11);
        $response = new SearchCategoryResponse(json_decode($raw_response, true));
        $adobe_stock_client = new AdobeStock('APIKey', 'Product', 'STAGE', null);
        $this->assertEquals($response, $adobe_stock_client->searchCategory($request, ''));
    }
}
