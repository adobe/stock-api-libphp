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

namespace AdobeStock\Api\Client;

use \AdobeStock\Api\Client\SearchCategory as SearchCategoryFactory;
use \AdobeStock\Api\Core\Config as CoreConfig;
use \AdobeStock\Api\Request\SearchCategory as SearchCategoryRequest;
use \AdobeStock\Api\Response\SearchCategory as SearchCategoryResponse;
use \AdobeStock\Api\Client\Http\HttpInterface;
use \AdobeStock\Api\Client\Http\HttpClient;

class AdobeStock
{

    /**
     * Configuration that needs to be initialized.
     * @var CoreConfig
     */
    private $_config;

    /**
     * Factory object of all search category apis.
     * @var SearchCategoryFactory
     */
    private $_search_category_factory;

    /**
     * Custom http client object.
     * @var HttpInterface
     */
    private $_http_client;

    /**
     * Constructor for AdobeStock client that requires following
     * configuration to be initialized.
     * @param string        $api_key     Api Key for config
     * @param string        $product     Target Product
     * @param string        $target_env  Target Environment Prod/Stage
     * @param HttpInterface $http_client Custom http client
     */
    public function __construct(string $api_key, string $product, string $target_env, HttpInterface $http_client = null)
    {
        $this->_config = new CoreConfig($api_key, $product, $target_env);

        if ($this->_search_category_factory === null) {
            $this->_search_category_factory = new SearchCategoryFactory($this->_config);
        }

        if ($http_client === null) {
            $this->_http_client = new HttpClient();
        } else {
            $this->_http_client = $http_client;
        }
    }

    /**
     * Setter function for custom Http client.
     * @param HttpInterface $http_client custom Http client
     * @return AdobeStock client.
     */
    public function setHttpClient(HttpInterface $http_client) : AdobeStock
    {
        $this->_http_client = $http_client;
        return $this;
    }

    /**
     * Get information about a category of Stock assets, such as travel
     * or animals for a specified category identifier, optionally localized.
     * @param SearchCategoryRequest $request      object containing
     * category-id and locale
     * @param string                $access_token Users ims access token
     * @return SearchCategoryResponse contains id,name and link of the asset category.
     */
    public function searchCategory(SearchCategoryRequest $request, string $access_token) : SearchCategoryResponse
    {
        $response = $this->_search_category_factory->getCategory($request, $access_token, $this->_http_client);
        return $response;
    }

    /**
     * Get category information for zero or more category identifiers.
     * If you request information without specifying a category,
     * this returns a list of all stock categories.
     * @param SearchCategoryRequest $request      object containing
     * category-id and locale
     * @param string                $access_token Users ims access token
     * @return array list of SearchCategoryResponse objects each containing information about asset category.
     */
    public function searchCategoryTree(SearchCategoryRequest $request, string $access_token) : array
    {
        $response = $this->_search_category_factory->getCategoryTree($request, $access_token, $this->_http_client);
        return $response;
    }
}
