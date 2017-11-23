<?php
/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Test\Helper;

use \GuzzleHttp\ClientInterface as GuzzleHttpClientInterface;
use \PHPUnit\Framework\TestCase;
use \Psr\Http\Message\ResponseInterface;

abstract class BaseTest extends TestCase
{

    /**
     * Mock the HttpClient and return the Mock
     *
     * @return GuzzleHttpClientInterface
     */
    public function getHttpClientMock() : GuzzleHttpClientInterface
    {
        return $this->getMockBuilder(GuzzleHttpClientInterface::class)
            ->disableOriginalConstructor()
            ->setMethods([
                'getConfig',
                'request',
                'requestAsync',
                'send',
                'sendAsync',
            ])
            ->getMock();
    }

    /**
     * Returns a mock of the GuzzleResponseInterface
     *
     * @return ResponseInterface
     */
    public function getGuzzleResponseInterfaceMock() : ResponseInterface
    {
        return $this->getMockBuilder(ResponseInterface::class)
            ->disableOriginalConstructor()
            ->setMethods([
                'getStatusCode',
                'withStatus',
                'getReasonPhrase',
                'getProtocolVersion',
                'withProtocolVersion',
                'getHeaders',
                'hasHeader',
                'getHeader',
                'getHeaderLine',
                'withHeader',
                'withAddedHeader',
                'withoutHeader',
                'getBody',
                'withBody',
            ])
            ->getMock();
    }
}
