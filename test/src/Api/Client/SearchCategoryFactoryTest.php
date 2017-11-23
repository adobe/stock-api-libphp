<?php
/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

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
