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

namespace AdobeStock\Api\Client\Http;

use \GuzzleHttp\Client;
use \GuzzleHttp\Psr7\Response;
use \AdobeStock\Api\Exception\StockApi as StockApiException;
use \GuzzleHttp\Psr7\Stream;

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
    public function __construct(Client $client = null)
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
}
