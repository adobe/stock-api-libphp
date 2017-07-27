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

use \AdobeStock\Api\Client\SearchCategory as SearchCategoryFactory;
use \AdobeStock\Api\Core\Config as CoreConfig;
use \PHPUnit\Framework\TestCase;
use \AdobeStock\Api\Request\SearchCategory as SearchCategoryRequest;
use \AdobeStock\Api\Client\Http\HttpClient;
use \GuzzleHttp\Psr7;

class SearchCategoryFactoryTest extends TestCase
{
    /**
     * Factory object of all search category api.
     * @var SearchCategoryFactory
     */
    private $_search_category_factory;

    /**
     * Config to be initialized.
     * @var CoreConfig
     */
    private $_config;

    /**
     * Request object for search category.
     * @var SearchCategoryRequest
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
    public function initializeConstructorOfSearchCategoryFactory()
    {
        $this->_mocked_http_client = $this->createMock(HttpClient::class);
        $this->_config = new CoreConfig('APIKey', 'Product', 'STAGE');
        $this->_search_category_factory = new SearchCategoryFactory($this->_config);
        $this->assertInstanceOf(SearchCategoryFactory::class, $this->_search_category_factory);
    }

    /**
     * @test
     */
    public function getCategoryShouldReturnValidResponse()
    {
        $this->_request = new SearchCategoryRequest();
        $this->_request->setCategoryId(1043);
        $this->_mocked_http_client->method('doGet')->willReturn(Psr7\stream_for('{
            "id": 1043,
            "link": "/Category/travel/1043",
            "name": "Travel"
        }'));
        $final_response = $this->_search_category_factory->getCategory($this->_request, '', $this->_mocked_http_client);
        $this->assertEquals('Travel', $final_response->getName());
    }

    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function getCategoryShouldThrowExceptionIfCategoryIdIsNull()
    {
        $this->_request = new SearchCategoryRequest();
        $this->_mocked_http_client->method('doGet')->willReturn(Psr7\stream_for('{
            "id": 1043,
            "link": "/Category/travel/1043",
            "name": "Travel"
        }'));
        $final_response = $this->_search_category_factory->getCategory($this->_request, '', $this->_mocked_http_client);
    }

    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function getCategoryTreeShouldThrowExceptionIfCategoryIdIsNull()
    {
        $this->_request = new SearchCategoryRequest();
        $this->_mocked_http_client->method('doGet')->willReturn(Psr7\stream_for('{
            "id": 1043,
            "link": "/Category/travel/1043",
            "name": "Travel"
        }'));
        $final_response = $this->_search_category_factory->getCategoryTree($this->_request, '', $this->_mocked_http_client);
    }

    /**
     * @test
     */
    public function getCategoryTreeShouldReturnValidResponse()
    {
        $this->_request = new SearchCategoryRequest();
        $this->_request->setCategoryId(1043);
        $this->_mocked_http_client->method('doGet')->willReturn(Psr7\stream_for('[{
            "id": 1043,
            "link": "/Category/travel/1043",
            "name": "Travel"
        }]'));
        $final_response = $this->_search_category_factory->getCategoryTree($this->_request, '', $this->_mocked_http_client);
        $this->assertEquals('Travel', $final_response[0]->getName());
    }
}
