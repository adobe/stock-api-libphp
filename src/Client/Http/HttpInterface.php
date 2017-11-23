<?php
/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Client\Http;

use \GuzzleHttp\Psr7\Stream;
use \GuzzleHttp\HandlerStack;
use \GuzzleHttp\Psr7\Request;
use \GuzzleHttp\Psr7\Response;

interface HttpInterface
{
    /**
     * Method to execute GET queries using custom http clients.
     * @param string $url     Endpoint that needs to hit.
     * @param array  $headers associative array of headers.
     * @return Stream raw response returned from the api call.
     */
    public function doGet(string $url, array $headers) : Stream;
    
    /**
     * Method to execute POST queries using custom http clients.
     * @param string $url       Endpoint that needs to hit.
     * @param array  $headers   associative array of headers.
     * @param array  $post_data data that need to send with post query.
     * @return Stream raw response returned from the api call.
     */
    public function doPost(string $url, array $headers, array $post_data) : Stream;
    
    /**
     * Method to upload multipart data using custom http clients.
     * @param string $url     Endpoint that needs to hit.
     * @param array  $headers associative array of headers.
     * @param string $file    File to be uploaded.
     * @return Stream raw response returned from the api call.
     */
    public function doMultiPart(string $url, array $headers, string $file) : Stream;
    
    /**
     * Returns HandlerStack of http client
     * @return HandlerStack
     */
    public function getHandlerStack() : HandlerStack;
    
    /**
     * Method to send request using guzzle request object
     * @param Request $request
     * @return Response
     */
    public function sendRequest(Request $request) : Response;
}
