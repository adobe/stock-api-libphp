<?php
/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */
namespace AdobeStock\Api\Test;

use \AdobeStock\Api\Core\Config as CoreConfig;
use \AdobeStock\Api\Client\Http\HttpClient;
use \AdobeStock\Api\Client\LicenseHistory as LicenseHistoryFactory;
use \AdobeStock\Api\Request\LicenseHistory as LicenseHistoryRequest;
use \AdobeStock\Api\Response\LicenseHistory as LicenseHistoryResponse;
use \GuzzleHttp\Psr7;
use \AdobeStock\Api\Models\SearchParamLicenseHistory as SearchParamLicenseHistoryModels;
use \PHPUnit\Framework\TestCase;

class LicenseHistoryFactoryTest extends TestCase
{
    /**
     * Factory object of License History api.
     * @var LicenseHistoryFactory
     */
    private $_license_history_factory;
    
    /**
     * Config to be initialized.
     * @var CoreConfig
     */
    private $_config;
    
    /**
     * Request object for License History.
     * @var LicenseHistoryRequest
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
    const TEST_DEFAULT_LIMIT = 100;
    
    /**
     * Test NB Results.
     * @var int
     */
    const TEST_NB_RESULTS = 2;
    
    /**
     * Test File Id.
     * @var int
     */
    const TEST_FILE_ID = 133927025;
    
    /**
     * Total Pages.
     * @var int
     */
    const TEST_TOTAL_PAGES = 2476490;
    
    /**
     * Test Title
     * @var string
     */
    const TEST_FILE_TITLE = 'A floating lantern being set free amongst many others at night.';
    
    /**
     * Expected Response
     * @var array
     */
    const TEST_RESPONSE = [
        'nb_results' => 2,
        'files' => [
                [
                    'id' => 133927025,
                    'title' => 'A floating lantern being set free amongst many others at night.',
                ],
        ],
    ];
    
    /**
     * Helper function to verify the response.
     * @param LicenseHistoryResponse $response
     */
    private function _checkTestResponse(LicenseHistoryResponse $response)
    {
        $this->assertNotNull($response);
        $this->assertEquals(LicenseHistoryFactoryTest::TEST_NB_RESULTS, $response->getNbResults());
        $this->assertEquals(LicenseHistoryFactoryTest::TEST_FILE_ID, $response->getFiles()[0]->getId());
        $this->assertEquals(LicenseHistoryFactoryTest::TEST_FILE_TITLE, $response->getFiles()[0]->getTitle());
    }
    
    /**
     * @test
     * @before
     */
    public function initializeConstructorOfLicenseHistoryFactory()
    {
        $this->_mocked_http_client = $this->createMock(HttpClient::class);
        $this->_config = new CoreConfig('APIKey', 'Product', 'STAGE', $this->_mocked_http_client);
        $this->_license_history_factory = new LicenseHistoryFactory($this->_config);
        $this->assertInstanceOf(LicenseHistoryFactory::class, $this->_license_history_factory);
    }
    
    /**
     * @test
     */
    public function getNextLicenseHistoryShouldReturnValidResponse()
    {
        $this->_mocked_http_client->method('doGet')
            ->willReturn(Psr7\Utils::streamFor(json_encode(LicenseHistoryFactoryTest::TEST_RESPONSE)));
        $this->_request = new LicenseHistoryRequest();
        $search_params = new SearchParamLicenseHistoryModels();
        $search_params->setLimit(1);
        $this->_request->setSearchParams($search_params);
        $this->_license_history_factory->initializeLicenseHistory($this->_request, 'test', $this->_mocked_http_client);
        $response = $this->_license_history_factory->getNextLicenseHistory();
        $this->_checkTestResponse($response);
        $this->assertEquals(0, $this->_license_history_factory->currentLicenseHistoryPageIndex());
    }
    
    /**
     * @test
     */
    public function getNextLicenseHistoryShouldThrowExceptionSinceOffsetExceedResultCount()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->expectExceptionMessage('No more search results available!');
        $this->_mocked_http_client->method('doGet')
            ->willReturn(Psr7\Utils::streamFor(json_encode(LicenseHistoryFactoryTest::TEST_RESPONSE)));
        $this->_request = new LicenseHistoryRequest();
        $search_params = new SearchParamLicenseHistoryModels();
        $search_params->setLimit(1)->setOffset(3);
        $this->_request->setSearchParams($search_params);
        $this->_license_history_factory->initializeLicenseHistory($this->_request, 'test', $this->_mocked_http_client);
        $response = $this->_license_history_factory->getNextLicenseHistory();
        $response = $this->_license_history_factory->getNextLicenseHistory();
    }
    
    /**
     * @test
     */
    public function getNextLicenseHistoryShouldThrowExceptionWhenResultCountZero()
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
        $this->_request = new LicenseHistoryRequest();
        $search_params = new SearchParamLicenseHistoryModels();
        $search_params->setLimit(1);
        $this->_request->setSearchParams($search_params);
        $this->_license_history_factory->initializeLicenseHistory($this->_request, 'test', $this->_mocked_http_client);
        $response = $this->_license_history_factory->getNextLicenseHistory();
        $response = $this->_license_history_factory->getNextLicenseHistory();
    }
    
    /**
     * @test
     */
    public function getNextLicenseHistoryShouldThrowExceptionWhenResultsCountNotPresentResponse()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->expectExceptionMessage('No more license file results available!');
        $_zero_response = [];
        $this->_mocked_http_client->method('doGet')
            ->willReturn(Psr7\Utils::streamFor(json_encode($_zero_response)));
        $this->_request = new LicenseHistoryRequest();
        $search_params = new SearchParamLicenseHistoryModels();
        $search_params->setLimit(1);
        $this->_request->setSearchParams($search_params);
        $this->_license_history_factory->initializeLicenseHistory($this->_request, 'test', $this->_mocked_http_client);
        $response = $this->_license_history_factory->getNextLicenseHistory();
    }
    
    /**
     * @test
     */
    public function getPreviousLicenseHistoryShouldReturnValidResponse()
    {
        $this->_mocked_http_client->method('doGet')
            ->willReturn(Psr7\Utils::streamFor(json_encode(LicenseHistoryFactoryTest::TEST_RESPONSE)));
        $this->_request = new LicenseHistoryRequest();
        $search_params = new SearchParamLicenseHistoryModels();
        $search_params->setLimit(1)->setOffset(1);
        $this->_request->setSearchParams($search_params);
        $this->_license_history_factory->initializeLicenseHistory($this->_request, 'test', $this->_mocked_http_client);
        $response = $this->_license_history_factory->getPreviousLicenseHistory();
        $this->_checkTestResponse($response);
        $this->assertEquals(0, $this->_license_history_factory->currentLicenseHistoryPageIndex());
    }
    
    /**
     * @test
     */
    public function getPreviousLicenseHistoryShouldThrowExceptionWhenOffsetIsNegative()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->expectExceptionMessage('No more search results available!');
        $this->_mocked_http_client->method('doGet')
            ->willReturn(Psr7\Utils::streamFor(json_encode(LicenseHistoryFactoryTest::TEST_RESPONSE)));
        $this->_request = new LicenseHistoryRequest();
        $search_params = new SearchParamLicenseHistoryModels();
        $search_params->setLimit(1)->setOffset(0);
        $this->_request->setSearchParams($search_params);
        $this->_license_history_factory->initializeLicenseHistory($this->_request, 'test', $this->_mocked_http_client);
        $response = $this->_license_history_factory->getPreviousLicenseHistory();
    }
    
    /**
     * @test
     */
    public function getLicenseHistoryPageShouldThrowExceptionWhenInvalidPageindex()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->expectExceptionMessage('Page index out of bounds');
        $this->_mocked_http_client->method('doGet')
            ->willReturn(Psr7\Utils::streamFor(json_encode(LicenseHistoryFactoryTest::TEST_RESPONSE)));
        $this->_request = new LicenseHistoryRequest();
        $search_params = new SearchParamLicenseHistoryModels();
        $search_params->setLimit(1);
        $this->_request->setSearchParams($search_params);
        $this->_license_history_factory->initializeLicenseHistory($this->_request, 'test', $this->_mocked_http_client);
        $this->_license_history_factory->getLicenseHistoryPage(-1);
    }
    
    /**
     * @test
     */
    public function getLicenseHistoryPageShouldReturnValidResponse()
    {
        $this->_mocked_http_client->method('doGet')
            ->willReturn(Psr7\Utils::streamFor(json_encode(LicenseHistoryFactoryTest::TEST_RESPONSE)));
        $this->_request = new LicenseHistoryRequest();
        $search_params = new SearchParamLicenseHistoryModels();
        $search_params->setLimit(1);
        $this->_request->setSearchParams($search_params);
        $this->_license_history_factory->initializeLicenseHistory($this->_request, 'test', $this->_mocked_http_client);
        $response = $this->_license_history_factory->getLicenseHistoryPage(1);
        $this->_checkTestResponse($response);
        $this->_checkTestResponse($this->_license_history_factory->getLastLicenseHistory());
    }
    
    /**
     * @test
     */
    public function getLastLicenseHistoryShouldReturnNullResponseWithoutApicall()
    {
        $this->_mocked_http_client->method('doGet')
            ->willReturn(Psr7\Utils::streamFor(json_encode(LicenseHistoryFactoryTest::TEST_RESPONSE)));
        $this->_request = new LicenseHistoryRequest();
        $search_params = new SearchParamLicenseHistoryModels();
        $search_params->setLimit(1);
        $this->_request->setSearchParams($search_params);
        $this->_license_history_factory->initializeLicenseHistory($this->_request, 'test', $this->_mocked_http_client);
        $response = $this->_license_history_factory->getLastLicenseHistory();
        $this->assertNull($response->getNbResults());
    }
    
    /**
     * @test
     */
    public function currentLicenseHistoryPageIndexShouldReturnErrorwhenCalledWithoutApiCall()
    {
        $this->_mocked_http_client->method('doGet')
            ->willReturn(Psr7\Utils::streamFor(json_encode(LicenseHistoryFactoryTest::TEST_RESPONSE)));
        $this->_request = new LicenseHistoryRequest();
        $search_params = new SearchParamLicenseHistoryModels();
        $search_params->setLimit(1);
        $this->_request->setSearchParams($search_params);
        $this->_license_history_factory->initializeLicenseHistory($this->_request, 'test', $this->_mocked_http_client);
        $response = $this->_license_history_factory->currentLicenseHistoryPageIndex();
        $this->assertEquals(-1, $response);
    }
    
    /**
     * @test
     */
    public function getTotalLicenseHistoryFilesShouldReturnErrorWhenCalledWithoutApiCall()
    {
        $this->_mocked_http_client->method('doGet')
            ->willReturn(Psr7\Utils::streamFor(json_encode(LicenseHistoryFactoryTest::TEST_RESPONSE)));
        $this->_request = new LicenseHistoryRequest();
        $search_params = new SearchParamLicenseHistoryModels();
        $search_params->setLimit(1);
        $this->_request->setSearchParams($search_params);
        $this->_license_history_factory->initializeLicenseHistory($this->_request, 'test', $this->_mocked_http_client);
        $response = $this->_license_history_factory->getTotalLicenseHistoryFiles();
        $this->assertEquals(-1, $response);
    }
    
    /**
     * @test
     */
    public function getTotalLicenseHistoryFilesShouldReturnTotalFiles()
    {
        $this->_mocked_http_client->method('doGet')
            ->willReturn(Psr7\Utils::streamFor(json_encode(LicenseHistoryFactoryTest::TEST_RESPONSE)));
        $this->_request = new LicenseHistoryRequest();
        $search_params = new SearchParamLicenseHistoryModels();
        $search_params->setLimit(1);
        $this->_request->setSearchParams($search_params);
        $this->_license_history_factory->initializeLicenseHistory($this->_request, 'test', $this->_mocked_http_client);
        $response = $this->_license_history_factory->getNextLicenseHistory();
        $count = $this->_license_history_factory->getTotalLicenseHistoryFiles();
        $this->assertEquals(LicenseHistoryFactoryTest::TEST_NB_RESULTS, $count);
    }
    
    /**
     * @test
     */
    public function getTotalLicenseHistoryPagesShouldReturnTotalPages()
    {
        $this->_mocked_http_client->method('doGet')
            ->willReturn(Psr7\Utils::streamFor(json_encode(LicenseHistoryFactoryTest::TEST_RESPONSE)));
        $this->_request = new LicenseHistoryRequest();
        $search_params = new SearchParamLicenseHistoryModels();
        $search_params->setLimit(1);
        $this->_request->setSearchParams($search_params);
        $this->_license_history_factory->initializeLicenseHistory($this->_request, 'test', $this->_mocked_http_client);
        $response = $this->_license_history_factory->getNextLicenseHistory();
        $count = $this->_license_history_factory->getTotalLicenseHistoryPages();
        $this->assertEquals(2, $count);
    }
    
    /**
     * @test
     */
    public function licenseHistoryShouldReturnNewObjectOfLicenseHistoryClass()
    {
        $this->_request = new LicenseHistoryRequest();
        $search_params = new SearchParamLicenseHistoryModels();
        $search_params->setLimit(1);
        $this->_request->setSearchParams($search_params);
        $response = $this->_license_history_factory->initializeLicenseHistory($this->_request, 'test', $this->_mocked_http_client);
        $this->assertInstanceOf(LicenseHistoryFactory::class, $response);
    }
    
    /**
     * @test
     */
    public function initializeLicenseHistoryShouldThrowExceptionSinceExcessTokenIsNull()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->expectExceptionMessage('Access token cannot be null or empty');
        $this->_request = new LicenseHistoryRequest();
        $search_params = new SearchParamLicenseHistoryModels();
        $search_params->setLimit(1);
        $this->_request->setSearchParams($search_params);
        $this->_license_history_factory->initializeLicenseHistory($this->_request, '', $this->_mocked_http_client);
    }
    
    /**
     * @test
     */
    public function initializeLicenseHistoryShouldThrowStockExceptionSinceRequestIsNull()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->expectExceptionMessage('request cannot be null');
        $this->_request = null;
        $this->_license_history_factory->initializeLicenseHistory($this->_request, '', $this->_mocked_http_client);
    }
    
    /**
     * @test
     */
    public function licenseHistoryShouldThrowStockexceptionSinceSearchParamsAreNull()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->expectExceptionMessage('Search parameter must be present in the request object');
        $this->_request = new LicenseHistoryRequest();
        $result_column_array[] = 'THUMBNAIL_110_URL';
        $this->_request->setResultColumns($result_column_array);
        $this->_license_history_factory->initializeLicenseHistory($this->_request, 'test', $this->_mocked_http_client);
    }
}
