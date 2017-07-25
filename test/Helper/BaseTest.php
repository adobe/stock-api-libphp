<?php
/*************************************************************************
 * ADOBE CONFIDENTIAL
 * ___________________
 *
 *  Copyright 2016 Adobe Systems Incorporated
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
