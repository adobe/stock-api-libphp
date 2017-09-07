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
use \AdobeStock\Api\Request\SearchFiles as SearchFilesRequest;
use \AdobeStock\Api\Response\SearchFiles as SearchFilesResponse;
use \AdobeStock\Api\Client\Http\HttpClient;
use \AdobeStock\Api\Request\License as LicenseRequest;
use \AdobeStock\Api\Client\License as LicenseFactory;
use \AdobeStock\Api\Response\License as LicenseResponse;

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
     * Factory object of all search Files apis.
     * @var SearchFiles
     */
    private $_search_files_factory;
    
    /**
     * Factory object of all license apis.
     * @var LicenseFactory;
     */
    private $_license_factory;

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
        $this->_search_category_factory = new SearchCategoryFactory($this->_config);
        $this->_search_files_factory = new SearchFiles($this->_config);
        $this->_license_factory = new LicenseFactory($this->_config);

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

    /**
     * Method to initialize search files.
     * @param SearchFilesRequest $request
     * @param string             $access_token
     * @return AdobeStock
     */
    public function searchFilesInitialize(SearchFilesRequest $request, string $access_token = null) : AdobeStock
    {
        $this->_search_files_factory->searchFilesInitialize($request, $access_token, $this->_http_client, true);
        return $this;
    }

    /**
     * Method to get next search files response page.
     * @return SearchFilesResponse
     */
    public function getNextResponse() : SearchFilesResponse
    {
        $response = $this->_search_files_factory->getNextResponse();
        return $response;
    }

    /**
     * Method to get to previous search files response page.
     * @return SearchFilesResponse
     */
    public function getPreviousResponse() : SearchFilesResponse
    {
        $response = $this->_search_files_factory->getPreviousResponse();
        return $response;
    }

    /**
     * Method to get response from last api call.
     * @return SearchFilesResponse
     */
    public function getLastResponse() : SearchFilesResponse
    {
        $response = $this->_search_files_factory->getLastResponse();
        return $response;
    }

    /**
     * Method to skip to a specific search files response page.
     * @param int $page_index
     * @return SearchFilesResponse
     */
    public function getResponsePage(int $page_index) : SearchFilesResponse
    {
        $response = $this->_search_files_factory->getResponsePage($page_index);
        return $response;
    }

    /**
     * Method to get total search files available.
     * @return int
     */
    public function totalSearchFiles() : int
    {
        $total_files = $this->_search_files_factory->totalSearchFiles();
        return $total_files;
    }

    /**
     * Method to get total search results pages.
     * @return int
     */
    public function totalSearchPages() : int
    {
        $total_pages = $this->_search_files_factory->totalSearchPages();
        return $total_pages;
    }

    /**
     * Method to get response from last api call.
     * @return int
     */
    public function currentSearchPageIndex() : int
    {
        $current_page = $this->_search_files_factory->currentSearchPageIndex();
        return $current_page;
    }
    
    /**
     * Requests licensing information about a specific asset for a specific user
     * @param LicenseRequest $request      object containing
     * category-id and locale
     * @param string         $access_token Users ims access token
     * @return LicenseResponse contains LicenseEntitlement,LicensePurchaseOptions,LicenseMemberInfo,cce_agency and contents
     */
    public function getContentInfo(LicenseRequest $request, string $access_token) : LicenseResponse
    {
        $response = $this->_license_factory->getContentInfo($request, $access_token, $this->_http_client);
        return $response;
    }
    
    /**
     * Requests a license for an asset for a specific user.
     * @param LicenseRequest $request
     * @param string         $access_token
     * @return LicenseResponse contains LicenseEntitlement,LicensePurchaseOptions,LicenseMemberInfo,cce_agency and contents
     */
    public function getContentLicense(LicenseRequest $request, string $access_token) : LicenseResponse
    {
        $response = $this->_license_factory->getContentLicense($request, $access_token, $this->_http_client);
        return $response;
    }
    
    /**
     * It can be used to get the licensing capabilities for a specific user.
     * This API returns the user's available purchase quota, the member
     * identifier, and information that you can use to present licensing
     * options to the user when the user next requests an asset purchase.
     * In this 3 cases can occur -
     * User has enough quota to license the next asset.
     * User doesn't have enough quota and is set up to handle overage.
     * User doesn't have quota and there is no overage plan.
     * @param LicenseRequest $request
     * @param string         $access_token
     * @return LicenseResponse contains LicenseEntitlement,LicensePurchaseOptions,LicenseMemberInfo,cce_agency and contents
     */
    public function getMemberProfile(LicenseRequest $request, string $access_token) : LicenseResponse
    {
        $response = $this->_license_factory->getMemberProfile($request, $access_token, $this->_http_client);
        return $response;
    }
    
    /**
     * Notifies the system when a user cancels a licensing operation.
     * It can be used if the user refuses the opportunity to purchase
     * or license the requested asset.
     * @param LicenseRequest $request
     * @param string         $access_token
     * @return int $response_code
     */
    public function abandonLicense(LicenseRequest $request, string $access_token) : int
    {
        $response_code = $this->_license_factory->abandonLicense($request, $access_token, $this->_http_client);
        return $response_code;
    }
}
