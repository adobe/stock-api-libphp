<?php
/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Test;

use AdobeStock\Api\Client\AdobeStock;
use AdobeStock\Api\Models\SearchParameters;
use AdobeStock\Api\Request\SearchFiles as SearchFilesRequest;
use PHPUnit\Framework\TestCase;

class SearchFilesTest extends TestCase
{
    /**
     * Test SearchFiles with custom x-request-id header
     */
    public function testCustomRequestId()
    {
        $requestId = 'custom_request_id';

        $stream_mock = $this->getMockBuilder(\GuzzleHttp\Psr7\Stream::class)
            ->disableOriginalConstructor()
            ->setMethods(['__toString'])
            ->getMock();
        $stream_mock->expects($this->once())
            ->method('__toString')
            ->willReturn('{"item": 1}');
        $client_mock = $this->getMockBuilder(\AdobeStock\Api\Client\Http\HttpInterface::class)
            ->setMethods(['doGet'])
            ->getMockForAbstractClass();
        $client_mock->expects($this->once())
            ->method('doGet')
            ->with(
                $this->stringStartsWith('https://stock-stage.adobe.io/Rest/Media/1/Search/Files'),
                [
                    'headers' => [
                        'x-api-key' => 'APIKey',
                        'x-product' => 'Product',
                        'Authorization' => null,
                        'x-request-id' => $requestId
                    ]
                ]
            )
            ->willReturn($stream_mock);


        $adobe_client = new AdobeStock('APIKey', 'Product', 'STAGE', $client_mock);
        $request = new SearchFilesRequest();

        $search_params = new SearchParameters();
        $search_params->setWords('tree');

        $request->setLocale('En_US');
        $request->setSearchParams($search_params);
        $request->setResultColumns(['id']);
        $request->setRequestId($requestId);

        $client = $adobe_client->searchFilesInitialize($request, 'access_token');
        $client->getNextResponse();
    }
}
