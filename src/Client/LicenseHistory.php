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

use \AdobeStock\Api\Exception\StockApi as StockApiException;
use \AdobeStock\Api\Core\Config as CoreConfig;
use \AdobeStock\Api\Client\Http\HttpInterface as HttpClientInterface;
use \AdobeStock\Api\Utils\APIUtils;
use \AdobeStock\Api\Request\LicenseHistory as LicenseHistoryRequest;
use \AdobeStock\Api\Response\LicenseHistory as LicenseHistoryResponse;

class LicenseHistory
{
    /**
     * Error code for LicenseHistory invalid state.
     * @var int
     */
    const LICENSE_HISTORY_RETURN_ERROR = -1;
    
    /**
     * Default limit for number of files in the results page.
     * @var integer
     */
    const DEFAULT_LICENSE_HISTORY_FILES_LIMIT = 100;
    
    /**
     * @var CoreConfig configuration that need to be initialized
     * before calling apis.
     */
    private $_config;
    
    /**
     * Access token string to be used with api calls.
     * @var string
     */
    private $_access_token;
    
    /**
     * Stores response from last search files api call.
     * @var LicenseHistoryResponse
     */
    private $_current_response;
    
    /**
     * Request object to be used for search files api query.
     * @var LicenseHistoryRequest
     */
    private $_current_request;
    
    /**
     * Flag to show if it initial invalid state.
     * @var boolean
     */
    private $_initial_invalid_state = true;
    
    /**
     * Checks if any search files api request is in progress.
     * @var boolean
     */
    private $_api_in_progress;
    
    /**
     * Offset Value
     * @var int
     */
    private $_offset;
    
    /**
     * @var HttpInterface custom http client object
     */
    private $_http_client;
    
    /**
     * Constructor.
     * @param CoreConfig $config config to be initialized.
     */
    public function __construct(CoreConfig $config)
    {
        $this->_config = $config;
    }
    
    /**
     * Method to do license history api call.
     * @param LicenseHistoryRequest $request
     * @throws StockApiException
     * @return LicenseHistoryResponse
     */
    private function _doApiCall(LicenseHistoryRequest $request) : LicenseHistoryResponse
    {
        if ($this->_api_in_progress) {
            throw StockApiException::withMessage('Some other search is already in progress!');
        }
        
        try {
            $this->_api_in_progress = true;
            $response = $this->_getFiles($request, $this->_access_token);
            $this->_doOnSuccess($response);
        } catch (StockApiException $e) {
            $this->_doOnError();
            throw $e;
        }
        
        return $this->_current_response;
    }
    
    /**
     * Method to do stuff on api call success.
     * @param LicenseHistoryResponse $response
     */
    private function _doOnSuccess(LicenseHistoryResponse $response)
    {
        $this->_current_response = $response;
        $this->_api_in_progress = false;
        
        if ($this->_initial_invalid_state) {
            $this->_initial_invalid_state = false;
        }
    }
    
    /**
     * Method to do stuff on api call failure.
     */
    private function _doOnError()
    {
        $this->_api_in_progress = false;
    }
    
    /**
     * Method to create and send request to the apis and parse result to response object.
     * @param LicenseHistoryRequest $license_file_request object containing license request parameters
     * @param string                $access_token         access token string to be used with api calls
     * @throws StockApiException
     * @return LicenseHistoryResponse response object from the api call
     */
    private function _getFiles(LicenseHistoryRequest $license_file_request, string $access_token = null) : LicenseHistoryResponse
    {
        $headers = APIUtils::generateCommonAPIHeaders($this->_config, $access_token);
        $end_point = $this->_config->getEndPoints()['license_history'];
        $request_url = $end_point . '?' . http_build_query($license_file_request);
        $offset_value = $this->_offset;
        $previous_offset_value = $license_file_request->getSearchParams()->getOffset();
        $find = 'search_parameters%5Boffset%5D=' . $previous_offset_value;
        $replace = 'search_parameters%5Boffset%5D=' . $offset_value;
        $request_url = str_replace($find, $replace, $request_url);
        $response_json = $this->_http_client->doGet($request_url, $headers);
        $response_array = json_decode($response_json, true);
        
        if (empty($response_array)) {
            throw StockApiException::withMessage('No more license file results available!');
        } else {
            //set offset of license request object if the api returns files
            $license_file_request->getSearchParams()->setOffset($this->_offset);
        }
        
        $license_history_response = new LicenseHistoryResponse();
        $license_history_response->initializeResponse($response_array);
        return $license_history_response;
    }
    
    /**
     * Initialize an api object
     * @param LicenseHistoryRequest $request
     * @param string                $access_token
     * @param HttpClientInterface   $http_client
     * @throws StockApiException
     * @return LicenseHistory
     */
    public function initializeLicenseHistory(LicenseHistoryRequest $request = null, string $access_token = null, HttpClientInterface $http_client) : LicenseHistory
    {
        if ($request === null) {
            throw StockApiException::withMessage('request cannot be null');
        }
        
        if ($request->getSearchParams() === null) {
            throw StockApiException::withMessage('Search parameter must be present in the request object');
        }
        
        if (empty($access_token)) {
            throw StockApiException::withMessage('Access token cannot be null or empty');
        }
        
        $this->_current_request = $request;
        $this->_current_response = new LicenseHistoryResponse();
        $this->_access_token = $access_token;
        $this->_api_in_progress = false;
        $this->_http_client = $http_client;
        $search_params = $request->getSearchParams();
        
        if ($search_params->getLimit() === null) {
            $this->_current_request->getSearchParams()->setLimit(self::DEFAULT_LICENSE_HISTORY_FILES_LIMIT);
        }
        
        $this->_offset = $search_params->getOffset();
        
        if ($this->_offset === null) {
            $this->_current_request->getSearchParams()->setOffset(0);
            $this->_offset = 0;
        }
        
        return $this;
    }
    
    /**
     * Method to get next license history response page.
     * @throws StockApiException
     * @return LicenseHistoryResponse
     */
    public function getNextLicenseHistory() : LicenseHistoryResponse
    {
        $request = $this->_current_request;
        $offset_value = $request->getSearchParams()->getOffset();
        
        if (!$this->_initial_invalid_state) {
            $limit = $request->getSearchParams()->getLimit();
            $offset_value = $limit + $offset_value;
            
            if ($this->_current_response->getNbResults() === null || $offset_value >= $this->_current_response->getNbResults()) {
                throw StockApiException::withMessage('No more search results available!');
            }
            
        }
        
        $this->_offset = $offset_value;
        $response = $this->_doApiCall($request);
        return $response;
    }
    
    /**
     * Method to get to previous search files response page.
     * @throws StockApiException
     * @return SearchFilesResponse
     */
    public function getPreviousLicenseHistory() : LicenseHistoryResponse
    {
        try {
            $request = $this->_current_request;
            $offset_value = $request->getSearchParams()->getOffset() - $request->getSearchParams()->getLimit();
            
            if ($offset_value < 0) {
                throw StockApiException::WithMessage('Offset should not be negative');
            }
            
            $this->_offset = $offset_value;
            return $this->_doApiCall($request);
        } catch (StockApiException $e) {
            throw StockApiException::withMessage('No more search results available!', $e);
        }
    }
    
    /**
     * Method to get response from last api call.
     * @return LicenseHistoryResponse
     */
    public function getLastLicenseHistory() : LicenseHistoryResponse
    {
        $user_response = new LicenseHistoryResponse();
        
        if (!$this->_initial_invalid_state) {
            $user_response = $this->_current_response;
        }
        
        return $user_response;
    }
    
    /**
     * Method to skip to a specific search files response page.
     * @param int $page_index
     * @throws StockApiException
     * @return LicenseHistoryResponse
     */
    public function getLicenseHistoryPage(int $page_index) : LicenseHistoryResponse
    {
        $request = $this->_current_request;
        $total_pages = $this->getTotalLicenseHistoryPages();
        
        if ($page_index < 0 || ($total_pages !== self::LICENSE_HISTORY_RETURN_ERROR && $page_index >= $total_pages)) {
            throw StockApiException::withMessage('Page index out of bounds');
        }
        
        $offset_value = $page_index * $request->getSearchParams()->getLimit();
        $this->_offset = $offset_value;
        return $this->_doApiCall($request);
    }
    
    /**
     * Method to get total search results pages.
     * @return int
     */
    public function getTotalLicenseHistoryPages() : int
    {
        if (!$this->_initial_invalid_state && $this->_current_response->getNbResults() !== null) {
            return (integer) ceil((double) $this->_current_response->getNbResults() / $this->_current_request->getSearchParams()->getLimit());
        }
        
        return self::LICENSE_HISTORY_RETURN_ERROR;
    }
    
    /**
     * Method to get total search files available.
     * @return int
     */
    public function getTotalLicenseHistoryFiles() : int
    {
        if (!$this->_initial_invalid_state && $this->_current_response->getNbResults() !== null) {
            return $this->_current_response->getNbResults();
        }
        
        return self::LICENSE_HISTORY_RETURN_ERROR;
    }
    
    /**
     * Method to get response from last api call.
     * @return int
     */
    public function currentLicenseHistoryPageIndex() : int
    {
        if (!$this->_initial_invalid_state && $this->_current_response->getNbResults() !== null) {
            $offset_value = $this->_current_request->getSearchParams()->getOffset();
            $result = (integer) (ceil((double) $offset_value / $this->_current_request->getSearchParams()->getLimit()));
            return $result;
        }
        
        return self::LICENSE_HISTORY_RETURN_ERROR;
    }
}
