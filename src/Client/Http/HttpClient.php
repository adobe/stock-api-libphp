<?php
/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Client\Http;

use \GuzzleHttp\Client;
use \GuzzleHttp\Psr7\Response;
use \AdobeStock\Api\Exception\StockApi as StockApiException;
use \GuzzleHttp\Psr7\Stream;
use \GuzzleHttp\HandlerStack;
use \GuzzleHttp\Psr7\Request;

class HttpClient implements HttpInterface
{
    /**
     * Guzzle http client.
     * @var Client.
     */
    protected $_http_client;

    /**
     * Constructor
     * @param Client $client GuzzleClient
     */
    public function __construct(?Client $client = null)
    {
        if ($client === null) {
            $client = new Client();
        }

        $this->_http_client = $client;
    }

    /**
     * Execute GET query for fetching results using Guzzle client.
     * @param string $url     Endpoint that need to be hit.
     * @param array  $headers headers passed along api call
     * @return Stream raw response from api call.
     * @throws StockException if api doesn't return with successful response.
     */
    public function doGet(string $url, array $headers) : Stream
    {
        try {
            $raw_response = $this->_http_client->request('GET', $url, $headers);
            $http_status_code = $raw_response->getStatusCode();
            $raw_headers = $this->getHeadersAsString($raw_response);
            $response_body = $raw_response->getBody();
        } catch (\Exception $e) {
            throw StockApiException::withMessageAndErrorCode($e->getMessage(), $e->getCode(), $e);
        }

        return $response_body;
    }

    /**
     * Method to execute POST queries using custom http clients.
     * @param string $url       Endpoint that needs to hit.
     * @param array  $headers   associative array of headers.
     * @param array  $post_data data that need to send with post query.
     * @return Stream raw response returned from the api call.
     */
    public function doPost(string $url, array $headers, array $post_data) : Stream
    {
        try {
            $headers['body'] = json_encode($post_data);
            $raw_response = $this->_http_client->request('POST', $url, $headers);
            $http_status_code = $raw_response->getStatusCode();
            $raw_headers = $this->getHeadersAsString($raw_response);
            $response_body = $raw_response->getBody();
        } catch (\Exception $e) {
            throw StockApiException::withMessageAndErrorCode($e->getMessage(), $e->getCode(), $e);
        }
        
        return $response_body;
    }
    
    /**
     * Method to upload multipart data using custom http clients.
     * @param string $url     Endpoint that needs to hit.
     * @param array  $headers associative array of headers.
     * @param string $file    File to be uploaded.
     * @return Stream raw response returned from the api call.
     */
    public function doMultiPart(string $url, array $headers, string $file) : Stream
    {
        if (!is_readable($file)) {
            throw StockApiException::withMessage('Image File is not readable');
        }
        
        try {
            $headers['multipart'] = [
                    [
                        'name' => 'image',
                        'contents' => $file,
                    ],
            ];
            $raw_response = $this->_http_client->request('POST', $url, $headers);
            $http_status_code = $raw_response->getStatusCode();
            $raw_headers = $this->getHeadersAsString($raw_response);
            $response_body = $raw_response->getBody();
        } catch (\Exception $e) {
            throw StockApiException::withMessageAndErrorCode($e->getMessage(), $e->getCode(), $e);
        }
        
        return $response_body;
    }
    
    /**
     * Returns the Guzzle array of headers as a string.
     * @param Response $response The Guzzle response.
     * @return string of headers
     */
    public function getHeadersAsString(Response $response) : string
    {
        $headers = $response->getHeaders();
        $raw_headers = [];

        foreach ($headers as $name => $values) {
            $raw_headers[] = $name . ': ' . implode(', ', $values);
        }

        return implode("\r\n", $raw_headers);
    }
    
    /**
     * Returns HandlerStack of http client
     * @return HandlerStack
     */
    public function getHandlerStack() : HandlerStack
    {
        return $this->_http_client->getConfig('handler');
    }
    
    /**
     * Method to send request using guzzle request object
     * @param Request $request
     * @return Response
     */
    public function sendRequest(Request $request) : Response
    {
        return $this->_http_client->send($request);
    }
}
