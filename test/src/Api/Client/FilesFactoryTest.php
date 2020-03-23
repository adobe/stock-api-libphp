<?php
/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Test;

use \AdobeStock\Api\Client\Files as FilesFactory;
use \AdobeStock\Api\Core\Config as CoreConfig;
use \PHPUnit\Framework\MockObject\MockObject;
use \PHPUnit\Framework\TestCase;
use \AdobeStock\Api\Request\Files as FilesRequest;
use \AdobeStock\Api\Client\Http\HttpClient;
use \GuzzleHttp\Psr7;

class FilesFactoryTest extends TestCase
{
    /**
     * Files API object.
     * @var FilesFactory
     */
    private $_files_factory;

    /**
     * Config to be initialized.
     * @var CoreConfig
     */
    private $_config;

    /**
     * Mocked HttpClient.
     * @var MockObject HttpClient.
     */
    private $_mocked_http_client;

    /**
     * @test
     * @before
     */
    public function initializeConstructorOfFilesFactory() : void
    {
        $this->_mocked_http_client = $this->createMock(HttpClient::class);
        $this->_config = new CoreConfig('APIKey', 'Product', 'STAGE');
        $this->_files_factory = new FilesFactory($this->_config);
        $this->assertInstanceOf(FilesFactory::class, $this->_files_factory);
    }

    /**
     * @test
     */
    public function getFilesShouldReturnValidResponse() : void
    {
        $requestMock = $this->createMock(FilesRequest::class);
        $requestMock->method('toArray')->willReturn([]);
        $this->_mocked_http_client->method('doGet')->willReturn(Psr7\stream_for('{
            "nb_results":3,
            "files":[{"id":281266321},{"id":285285249},{"id":264874647}]
        }'));
        $response = $this->_files_factory->getFiles($requestMock, $this->_mocked_http_client, '');
        $this->assertEquals(3, $response->getNbResults());
        $this->assertTrue(is_array($response->getFiles()));
    }

    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function getFilesShouldThrowExceptionWhenAccessTokenIsNullWithIsLicensedColumn() : void
    {
        $requestMock = $this->createMock(FilesRequest::class);
        $requestMock->method('getResultColumns')->willReturn(['is_licensed']);
        $this->_files_factory->getFiles($requestMock, $this->_mocked_http_client);
    }
}
