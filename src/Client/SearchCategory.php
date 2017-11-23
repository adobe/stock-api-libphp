<?php
/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Client;

use \AdobeStock\Api\Exception\StockApi as StockApiException;
use \AdobeStock\Api\Request\SearchCategory as SearchCategoryRequest;
use \AdobeStock\Api\Core\Config as CoreConfig;
use \AdobeStock\Api\Client\Http\HttpInterface as HttpClientInterface;
use \AdobeStock\Api\Response\SearchCategory as SearchCategoryResponse;
use \AdobeStock\Api\Utils\APIUtils;

class SearchCategory
{
    /**
     * Configuration that need to be initialized
     * before calling apis.
     * @var CoreConfig
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
     * Get information about a category of Stock assets, such as travel
     * or animals for a specified category identifier, optionally localized.
     * @param SearchCategoryRequest $request      object containing
     * category-id and locale
     * @param string                $access_token Users ims access token
     * @param HttpClientInterface   $http_client  client that to be used in calling apis.
     * @return SearchCategoryResponse consists of is, name and link of the asset category.
     * @throws StockException if category id is not set.
     */
    public function getCategory(SearchCategoryRequest $request, string $access_token, HttpClientInterface $http_client) : SearchCategoryResponse
    {
        if ($request->getCategoryId() === null) {
            throw StockApiException::withMessage('Category Id cannot be null');
        }

        $end_point = $this->_config->getEndPoints()['category'];
        $request_url = $end_point . '?' . http_build_query($request);
        $headers = APIUtils::generateCommonAPIHeaders($this->_config, $access_token);
        $raw_response = $http_client->doGet($request_url, $headers);
        $search_category_response = new SearchCategoryResponse(json_decode($raw_response, true));
        return $search_category_response;
    }

    /**
     * Get category information for zero or more category identifiers.
     * If you request information without specifying a category, this returns a list of all stock categories
     * @param SearchCategoryRequest $request      object containing category-id and locale
     * @param string                $access_token Users ims access token
     * @param HttpClientInterface   $http_client  client that to be used in calling apis.
     * @throws StockApiException if category id is not set.
     * @return array list of SearchCategoryResponse
     */
    public function getCategoryTree(SearchCategoryRequest $request, string $access_token, HttpClientInterface $http_client) : array
    {
        if ($request->getCategoryId() == null) {
            throw StockApiException::withMessage('Category Id cannot be null');
        }
        
        $end_point = $this->_config->getEndPoints()['category_tree'];
        $request_url = $end_point . '?' . http_build_query($request);
        $headers = APIUtils::generateCommonAPIHeaders($this->_config, $access_token);
        $raw_response = $http_client->doGet($request_url, $headers);
        return $this->_createSearchCategoryResponseArray(json_decode($raw_response, true));
    }

    /**
     * Util function to convert json array to SearchCategoryResponse Array.
     * @param array $response_array raw response.
     * @return array list of SearchCategoryResponse objects
     */
    private function _createSearchCategoryResponseArray(array $response_array) : array
    {
        $search_category_response_array = [];
        
        foreach ($response_array as $response) {
            $search_category_response = new SearchCategoryResponse($response);
            $search_category_response_array[] = $search_category_response;
        }
        
        return $search_category_response_array;
    }
}
