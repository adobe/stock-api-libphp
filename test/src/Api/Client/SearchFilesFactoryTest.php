<?php
/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Test;

use \AdobeStock\Api\Client\SearchFiles as SearchFilesFactory;
use \AdobeStock\Api\Core\Config as CoreConfig;
use \PHPUnit\Framework\TestCase;
use \AdobeStock\Api\Request\SearchFiles as SearchFilesRequest;
use \AdobeStock\Api\Client\Http\HttpClient;
use \GuzzleHttp\Psr7;
use \AdobeStock\Api\Response\SearchFiles as SearchFilesResponse;
use \AdobeStock\Api\Exception\StockApi as StockApiException;
use \AdobeStock\Api\Core\Constants as CoreConstants;
use \AdobeStock\Api\Models\SearchParameters as SearchParametersModels;

class SearchFilesFactoryTest extends TestCase
{
    /**
     * Factory object of all search Files api.
     * @var SearchFilesFactory
     */
    private $_search_files_factory;
    
    /**
     * Config to be initialized.
     * @var CoreConfig
     */
    private $_config;
    
    /**
     * Request object for search Files.
     * @var SearchFilesRequest
     */
    private $_request;
    
    /**
     * Mocked HttpClient.
     * @var Mocked HttpClient.
     */
    private $_mocked_http_client;
    
    /**
     * Default Limit.
     * @var int
     */
    const TEST_DEFAULT_LIMIT = 32;
    
    /**
     * Test NB Results.
     * @var int
     */
    const TEST_NB_RESULTS = 79247672;
    
    /**
     * Test File Id.
     * @var int
     */
    const TEST_FILE_ID = 148563830;
    
    /**
     * Total Pages.
     * @var int
     */
    const TEST_TOTAL_PAGES = 2476490;
    
    /**
     * Test Title
     * @var string
     */
    const TEST_FILE_TITLE = 'Red, white, and blue American flag for Memorial day or Veteran\'s day background';
    
    /**
     * Expected Response
     * @var array
     */
    const TEST_RESPONSE = [
        'nb_results' => 79247672,
        'files' => [
                [
                    'id' => 148563830,
                    'title' => 'Red, white, and blue American flag for Memorial day or Veteran\'s day background',
                ],
        ],
    ];
     /**
      * Helper function to verify the response.
      * @param SearchFilesResponse $response
      */
    private function _checkTestResponse(SearchFilesResponse $response)
    {
        $this->assertNotNull($response);
        $this->assertEquals(SearchFilesFactoryTest::TEST_NB_RESULTS, $response->getNbResults());
        $this->assertEquals(SearchFilesFactoryTest::TEST_FILE_ID, $response->getFiles()[0]->getId());
        $this->assertEquals(SearchFilesFactoryTest::TEST_FILE_TITLE, $response->getFiles()[0]->getTitle());
    }
    
    /**
     * @test
     * @before
     */
    public function initializeConstructorOfSearchFilesFactory()
    {
        $this->_mocked_http_client = $this->createMock(HttpClient::class);
        $this->_config = new CoreConfig('APIKey', 'Product', 'STAGE', $this->_mocked_http_client);
        $this->_search_files_factory = new SearchFilesFactory($this->_config);
        $this->assertInstanceOf(SearchFilesFactory::class, $this->_search_files_factory);
    }
    
    /**
     * @test
     */
    public function getNextResponseShouldReturnValidResponse()
    {
        $this->_mocked_http_client->method('doGet')
            ->willReturn(Psr7\Utils::streamFor(json_encode(SearchFilesFactoryTest::TEST_RESPONSE)));
        $this->_request = new SearchFilesRequest();
        $search_params = new SearchParametersModels();
        $search_params->setWords('tree');
        $this->_request->setSearchParams($search_params);
        $this->_search_files_factory->searchFilesInitialize($this->_request, '', $this->_mocked_http_client, true);
        $response = $this->_search_files_factory->getNextResponse();
        $this->_checkTestResponse($response);
        $this->assertEquals(0, $this->_search_files_factory->currentSearchPageIndex());
    }
    
    /**
     * @test
     */
    public function getNextResponseShouldThrowExceptionSinceOffsetExceedResultCount()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->expectExceptionMessage('No more search results available!');
        $this->_mocked_http_client->method('doGet')
            ->willReturn(Psr7\Utils::streamFor(json_encode(SearchFilesFactoryTest::TEST_RESPONSE)));
        $this->_request = new SearchFilesRequest();
        $search_params = new SearchParametersModels();
        $offset_value  = SearchFilesFactoryTest::TEST_NB_RESULTS - SearchFilesFactoryTest::TEST_DEFAULT_LIMIT;
        $search_params->setWords('tree')->setOffset($offset_value);
        $this->_request->setSearchParams($search_params);
        $this->_search_files_factory->searchFilesInitialize($this->_request, '', $this->_mocked_http_client, true);
        $response = $this->_search_files_factory->getNextResponse();
        $response = $this->_search_files_factory->getNextResponse();
    }
    
    /**
     * @test
     */
    public function getNextResponseShouldThrowExceptionWhenResultCountZero()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->expectExceptionMessage('No more search results available!');
        $_zero_response = [
            'nb_results' => 0,
            'files' => [
                ],
        ];
        $this->_mocked_http_client->method('doGet')
            ->willReturn(Psr7\Utils::streamFor(json_encode($_zero_response)));
        $this->_request = new SearchFilesRequest();
        $search_params = new SearchParametersModels();
        $search_params->setWords('tree');
        $this->_request->setSearchParams($search_params);
        $this->_search_files_factory->searchFilesInitialize($this->_request, '', $this->_mocked_http_client, true);
        $response = $this->_search_files_factory->getNextResponse();
        $response = $this->_search_files_factory->getNextResponse();
    }
    
    /**
     * @test
     */
    public function getNextResponseShouldThrowExceptionWhenResultsCountNotPresentResponse()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->expectExceptionMessage('No more search results available!');
        $_zero_response = [];
        $this->_mocked_http_client->method('doGet')
            ->willReturn(Psr7\Utils::streamFor(json_encode($_zero_response)));
        $this->_request = new SearchFilesRequest();
        $search_params = new SearchParametersModels();
        $search_params->setWords('tree');
        $this->_request->setSearchParams($search_params);
        $this->_search_files_factory->searchFilesInitialize($this->_request, '', $this->_mocked_http_client, true);
        $response = $this->_search_files_factory->getNextResponse();
    }
    
    /**
     * @test
     */
    public function getPreviousResponseShouldReturnValidResponse()
    {
        $this->_mocked_http_client->method('doGet')
            ->willReturn(Psr7\Utils::streamFor(json_encode(SearchFilesFactoryTest::TEST_RESPONSE)));
        $this->_request = new SearchFilesRequest();
        $search_params = new SearchParametersModels();
        $offset_value  = SearchFilesFactoryTest::TEST_DEFAULT_LIMIT;
        $search_params->setWords('tree')->setOffset($offset_value);
        $this->_request->setSearchParams($search_params);
        $this->_search_files_factory->searchFilesInitialize($this->_request, '', $this->_mocked_http_client, true);
        $response = $this->_search_files_factory->getPreviousResponse();
        $this->_checkTestResponse($response);
        $this->assertEquals(0, $this->_search_files_factory->currentSearchPageIndex());
    }
    
    /**
     * @test
     */
    public function getPreviousResponseShouldThrowExceptionWhenOffsetIsNegative()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->expectExceptionMessage('Offset should be between 0 and MaxResults');
        $this->_mocked_http_client->method('doGet')
            ->willReturn(Psr7\Utils::streamFor(json_encode(SearchFilesFactoryTest::TEST_RESPONSE)));
        $this->_request = new SearchFilesRequest();
        $search_params = new SearchParametersModels();
        $search_params->setWords('tree')->setOffset(0);
        $this->_request->setSearchParams($search_params);
        $this->_search_files_factory->searchFilesInitialize($this->_request, '', $this->_mocked_http_client, true);
        $response = $this->_search_files_factory->getPreviousResponse();
    }
    
    /**
     * @test
     */
    public function getResponsePageShouldThrowExceptionWhenInvalidPageindex()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->expectExceptionMessage('Page index out of bounds');
        $this->_mocked_http_client->method('doGet')
            ->willReturn(Psr7\Utils::streamFor(json_encode(SearchFilesFactoryTest::TEST_RESPONSE)));
        $this->_request = new SearchFilesRequest();
        $search_params = new SearchParametersModels();
        $search_params->setWords('tree');
        $this->_request->setSearchParams($search_params);
        $this->_search_files_factory->searchFilesInitialize($this->_request, '', $this->_mocked_http_client, true);
        $response = $this->_search_files_factory->getNextResponse();
        $page_index = -1;
        
        try {
            $response = $this->_search_files_factory->getResponsePage(-1);
        } catch (StockApiException $e) {
            throw StockApiException::withMessage('Page index out of bounds');
            
        }
    }
    
    /**
     * @test
     */
    public function getResponsePageShouldReturnValidResponse()
    {
        $this->_mocked_http_client->method('doGet')
            ->willReturn(Psr7\Utils::streamFor(json_encode(SearchFilesFactoryTest::TEST_RESPONSE)));
        $this->_request = new SearchFilesRequest();
        $search_params = new SearchParametersModels();
        $search_params->setWords('tree');
        $this->_request->setSearchParams($search_params);
        $this->_search_files_factory->searchFilesInitialize($this->_request, '', $this->_mocked_http_client, true);
        $random_no = (float) rand() / (float) getrandmax();
        $page_index = (int) ($random_no * SearchFilesFactoryTest::TEST_TOTAL_PAGES);
        $response = $this->_search_files_factory->getResponsePage($page_index);
        $this->_checkTestResponse($response);
        $this->assertEquals($page_index, $this->_search_files_factory->currentSearchPageIndex());
        $this->_checkTestResponse($this->_search_files_factory->getLastResponse());
    }
    
    /**
     * @test
     */
    public function getLastResponseShouldReturnNullResponseWithoutApicall()
    {
        $constants_response = new CoreConstants();
        $result_column_array = [];
        $result_column_array[] = $constants_response->getResultColumns()['ID'];
        $result_column_array[] = $constants_response->getResultColumns()['TITLE'];
        $this->_request = new SearchFilesRequest();
        $search_params = new SearchParametersModels();
        $search_params->setWords('tree');
        $this->_request->setSearchParams($search_params);
        $this->_request->setResultColumns($result_column_array);
        $this->_mocked_http_client->method('doGet')
            ->willReturn(Psr7\Utils::streamFor(json_encode(SearchFilesFactoryTest::TEST_RESPONSE)));
        $this->_search_files_factory->searchFilesInitialize($this->_request, '', $this->_mocked_http_client, true);
        $response = $this->_search_files_factory->getLastResponse();
        $this->assertNull($response->getNbResults());
    }
    
    /**
     * @test
     */
    public function getLastResponseShouldNotReturnWhenNotPresentNbResults()
    {
        $constants_response = new CoreConstants();
        $result_column_array = [];
        $result_column_array[] = $constants_response->getResultColumns()['ID'];
        $result_column_array[] = $constants_response->getResultColumns()['TITLE'];
        $this->_request = new SearchFilesRequest();
        $search_params = new SearchParametersModels();
        $search_params->setWords('tree');
        $this->_request->setSearchParams($search_params);
        $this->_request->setResultColumns($result_column_array);
        $this->_mocked_http_client->method('doGet')
            ->willReturn(Psr7\Utils::streamFor(json_encode(SearchFilesFactoryTest::TEST_RESPONSE)));
        $this->_search_files_factory->searchFilesInitialize($this->_request, '', $this->_mocked_http_client, true);
        $response = $this->_search_files_factory->getLastResponse();
        $this->assertNull($response->getNbResults());
    }
    
    /**
     * @test
     */
    public function currentSearchPageIndexShouldReturnErrorwhenCalledWithoutApiCall()
    {
        
        $this->_request = new SearchFilesRequest();
        $search_params = new SearchParametersModels();
        $search_params->setWords('tree');
        $this->_request->setSearchParams($search_params);
        $this->_mocked_http_client->method('doGet')
            ->willReturn(Psr7\Utils::streamFor(json_encode(SearchFilesFactoryTest::TEST_RESPONSE)));
        $this->_search_files_factory->searchFilesInitialize($this->_request, '', $this->_mocked_http_client, true);
        $response = $this->_search_files_factory->currentSearchPageIndex();
        $this->assertEquals(-1, $response);
    }
    
    /**
     * @test
     */
    public function totalSearchFilesShouldReturnErrorWhenCalledWithoutApiCall()
    {
        
        $this->_request = new SearchFilesRequest();
        $search_params = new SearchParametersModels();
        $search_params->setWords('tree');
        $this->_request->setSearchParams($search_params);
        $this->_mocked_http_client->method('doGet')
            ->willReturn(Psr7\Utils::streamFor(json_encode(SearchFilesFactoryTest::TEST_RESPONSE)));
        $this->_search_files_factory->searchFilesInitialize($this->_request, '', $this->_mocked_http_client, true);
        $response = $this->_search_files_factory->totalSearchFiles();
        $this->assertEquals(-1, $response);
    }
    
    /**
     * @test
     */
    public function totalSearchFilesShouldReturnTotalFiles()
    {
        
        $this->_request = new SearchFilesRequest();
        $search_params = new SearchParametersModels();
        $search_params->setWords('tree');
        $this->_request->setSearchParams($search_params);
        $this->_mocked_http_client->method('doGet')
            ->willReturn(Psr7\Utils::streamFor(json_encode(SearchFilesFactoryTest::TEST_RESPONSE)));
        $this->_search_files_factory->searchFilesInitialize($this->_request, '', $this->_mocked_http_client, true);
        $response = $this->_search_files_factory->getNextResponse();
        $count = $this->_search_files_factory->totalSearchFiles();
        $this->assertEquals(SearchFilesFactoryTest::TEST_NB_RESULTS, $count);
    }
    
    /**
     * @test
     */
    public function searchFilesShouldReturnNewObjectOfSearchFilesClass()
    {
        
        $this->_request = new SearchFilesRequest();
        $search_params = new SearchParametersModels();
        $search_params->setWords('tree');
        $this->_request->setSearchParams($search_params);
        $result_column_array[] = 'nb_results';
        $this->_request->setResultColumns($result_column_array);
        $response = $this->_search_files_factory->searchFilesInitialize($this->_request, '', $this->_mocked_http_client, true);
        $this->assertInstanceOf(SearchFilesFactory::class, $response);
    }
    
    /**
     * @test
     */
    public function searchFilesInitializeShouldThrowStockExceptionSinceSearchRequestParameterIsNull()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->expectExceptionMessage('request cannot be null');
        $this->_request = null;
        
        try {
            $this->_search_files_factory->searchFilesInitialize($this->_request, '', $this->_mocked_http_client, true);
        } catch (StockApiException $e) {
            throw $e;
            
        }
    }
    
    /**
     * @test
     */
    public function searchFilesShouldThrowStockExceptionSinceSearchParametersFieldOfRequestParameterIsNull()
    {
        $this->_request = new SearchFilesRequest();
        $search_params = new SearchParametersModels();
        $this->_request->setSearchParams($search_params);
        $this->_request->setLocale('En-US');
        
        try {
            $this->_search_files_factory->searchFilesInitialize($this->_request, '', $this->_mocked_http_client, true);
        } catch (StockApiException $e) {
            throw $e;
            
        }
    }
    
    /**
     * @test
     */
    public function searchFilesShouldThrowStockexceptionSinceSearchParamsAreNull()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->expectExceptionMessage('Search parameter must be present in the request object');
        $this->_request = new SearchFilesRequest();
        $result_column_array[] = 'is_licensed';
        $this->_request->setResultColumns($result_column_array);
        $this->_search_files_factory->searchFilesInitialize($this->_request, null, $this->_mocked_http_client, true);
    }
    
    /**
     * @test
     */
    public function searchFilesShouldThrowStockexceptionSinceIsLicensedRequestedInResultsAndAccessTokenIsNull()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->expectExceptionMessage('Access Token missing! Result Column is_licensed requires authentication');
        $this->_request = new SearchFilesRequest();
        $search_params = new SearchParametersModels();
        $search_params->setWords('tree');
        $this->_request->setSearchParams($search_params);
        $result_column_array[] = 'is_licensed';
        $this->_request->setResultColumns($result_column_array);
        
        try {
            $this->_search_files_factory->searchFilesInitialize($this->_request, null, $this->_mocked_http_client, true);
        } catch (StockApiException $e) {
            throw $e;
            
        }
    }
    
    /**
     * @test
     */
    public function testVisualSearch()
    {
        $this->_mocked_http_client->method('doMultiPart')
            ->willReturn(Psr7\Utils::streamFor(json_encode(SearchFilesFactoryTest::TEST_RESPONSE)));
        $this->_request = new SearchFilesRequest();
        $search_params = new SearchParametersModels();
        $search_params->setSimilarImage(true);
        $this->_request->setSearchParams($search_params);
        $this->_request->setSimilarImage('test/resources/TestFile.png');
        $response = $this->_search_files_factory->searchFilesInitialize($this->_request, null, $this->_mocked_http_client, true)->getNextResponse();
    }
    
    /**
     * @test
     */
    public function testVisualSearchThrowExceptionIfSimilarImageISNotSet()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->expectExceptionMessage(
            'Image Data missing! Search parameter similar_image requires similar_image in query parameters'
        );
        $this->_mocked_http_client->method('doMultiPart')
            ->willReturn(Psr7\Utils::streamFor(json_encode(SearchFilesFactoryTest::TEST_RESPONSE)));
        $this->_request = new SearchFilesRequest();
        $search_params = new SearchParametersModels();
        $search_params->setSimilarImage(true);
        $this->_request->setSearchParams($search_params);
        $response = $this->_search_files_factory->searchFilesInitialize($this->_request, null, $this->_mocked_http_client, true)->getNextResponse();
    }
}
