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

use \PHPUnit\Framework\TestCase;
use \AdobeStock\Api\Client\Http\HttpClient;
use \GuzzleHttp\Client;
use \GuzzleHttp\Psr7\Response;
use \AdobeStock\Api\Exception\StockApi as StockApiException;
use \GuzzleHttp\HandlerStack;
use \GuzzleHttp\Psr7\Request;

class HttpClientTest extends TestCase
{
    /**
     * Default Http Client.
     * @var HttpClient
     */
    private $_client;

    /**
     * Mocked Guzzle Client.
     * @var Client
     */
    private $_mocked_http_client;

    /**
     * @test
     * @before
     */
    public function initializeConstructorOfHttpClient()
    {
        $this->_mocked_http_client = $this->createMock(Client::class);
        $this->_client = new HttpClient($this->_mocked_http_client);
        $this->assertNotNull($this->_client);
    }

    /**
     * @test
     */
    public function executeDoGetSuccessfully()
    {
        $response = new Response(200, [], 'response');
        $this->_mocked_http_client->method('request')->willReturn($response);
        $this->assertEquals($response->getBody(), $this->_client->doGet('some uri', []));
    }

    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function executeDoGetWithException()
    {
        $exception = StockApiException::withMessage('Exception thrown');
        $this->_mocked_http_client->method('request')->will($this->throwException($exception));
        $this->_client->doGet('some uri', []);
    }
    
    /**
     * @test
     */
    public function executeDoPostSuccessfully()
    {
        $response = new Response(200, [], 'response');
        $this->_mocked_http_client->method('request')->willReturn($response);
        $this->assertEquals($response->getBody(), $this->_client->doPost('some uri', [], []));
    }
    
    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function executeDoPostWithException()
    {
        $exception = StockApiException::withMessage('Exception thrown');
        $this->_mocked_http_client->method('request')->will($this->throwException($exception));
        $this->_client->doPost('some uri', [], []);
    }
    
    /**
     * @test
     */
    public function executeDoMultiPartSuccessfully()
    {
        $response = new Response(200, [], 'response');
        $this->_mocked_http_client->method('request')->willReturn($response);
        $this->assertEquals($response->getBody(), $this->_client->doMultiPart('some uri', [], 'test/resources/SmallImage.jpg'));
    }
    
    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function executeDoMultiPartWithException()
    {
        $exception = StockApiException::withMessage('Exception thrown');
        $this->_mocked_http_client->method('request')->will($this->throwException($exception));
        $this->_client->doMultiPart('some uri', [], 'test/resources/SmallImage.jpg');
    }
    
    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function executeDoMultiPartWithExceptionIfFileIsNotReadable()
    {
        $exception = StockApiException::withMessage('Exception thrown');
        $this->_mocked_http_client->method('request')->will($this->throwException($exception));
        $this->_client->doMultiPart('some uri', [], '');
    }
    
    /**
     * @test
     */
    public function testGetHandlerStack()
    {
        $stack = new HandlerStack();
        $this->_mocked_http_client->method('getConfig')->willReturn($stack);
        $this->assertEquals($stack, $this->_client->getHandlerStack());
    }
    
    /**
     * @test
     */
    public function testSendRequest()
    {
        $response = new Response(200, [], '');
        $this->_mocked_http_client->method('send')->willReturn($response);
        $this->assertEquals($response, $this->_client->sendRequest(new Request('GET', '')));
    }
}
