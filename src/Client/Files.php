<?php
/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Client;

use \AdobeStock\Api\Exception\StockApi as StockApiException;
use \AdobeStock\Api\Core\Config as CoreConfig;
use \AdobeStock\Api\Client\Http\HttpInterface as HttpClientInterface;
use \AdobeStock\Api\Utils\APIUtils;
use \AdobeStock\Api\Request\Files as FilesRequest;
use \AdobeStock\Api\Response\Files as FilesResponse;
use function \GuzzleHttp\json_decode;

class Files
{
    /**
     * @var CoreConfig configuration that need to be initialized
     * before calling apis.
     */
    private $_config;

    /**
     * Constructor.
     * @param CoreConfig $config config to be initialized.
     */
    public function __construct(CoreConfig $config)
    {
        $this->_config = $config;
    }

    /**
     * Method to create and send request to the apis and parse result to response object.
     *
     * @param FilesRequest $file_request object containing files request parameters
     * @param HttpClientInterface $http_client
     * @param string $access_token access token string to be used with api calls
     * @return FilesResponse response object from the api call
     * @throws StockApiException
     */
    public function getFiles(
        FilesRequest $file_request,
        HttpClientInterface $http_client,
        string $access_token = null
    ) : FilesResponse {
        $this->_validateRequest($file_request, $access_token);
        $response_json = $http_client->doGet(
            $this->_getUrl($file_request),
            APIUtils::generateCommonAPIHeaders($this->_config, $access_token)
        );
        $files_response = new FilesResponse();
        $files_response->initializeResponse(json_decode($response_json, true));
        return $files_response;
    }

    /**
     * Method to validate request.
     *
     * @param FilesRequest $request
     * @param string $access_token
     * @throws StockApiException
     */
    private function _validateRequest(FilesRequest $request, string $access_token = null) : void
    {
        if (!empty($request->getResultColumns())) {
            if (in_array('is_licensed', $request->getResultColumns()) && $access_token === null) {
                throw StockApiException::withMessage(
                    'Access Token missing! Result Column is_licensed requires authentication'
                );
            }
        }
    }

    /**
     * Build request URL with parameters
     *
     * @param FilesRequest $filesRequest
     * @return string
     */
    private function _getUrl(FilesRequest $filesRequest) : string
    {
        return $this->_config->getEndPoints()['files'] . '?' . http_build_query($filesRequest->toArray());
    }
}
