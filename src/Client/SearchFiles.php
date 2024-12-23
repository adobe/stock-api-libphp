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
use \PHPUnit\Util\Configuration;
use \AdobeStock\Api\Utils\APIUtils;
use \AdobeStock\Api\Request\SearchFiles as SearchFilesRequest;
use \AdobeStock\Api\Response\SearchFiles as SearchFilesResponse;
use \AdobeStock\Api\Models\SearchParameters as SearchParametersModels;
use function \GuzzleHttp\json_decode;

class SearchFiles
{
    /**
     * Error code for SearchFiles invalid state.
     * @var int
     */
    const SEARCH_FILES_RETURN_ERROR = -1;

    /**
     * Default limit for number of files in the results page.
     * @var integer
     */
    const DEFAULT_SEARCH_FILES_LIMIT = 32;

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
     * Flag to show if it initial invalid state.
     * @var boolean
     */
    private $_initial_invalid_state = true;

    /**
     * if nb_results is present in user's search files requested result columns.
     * @var boolean
     */
    private $_nb_results_present;

    /**
     * Checks if any search files api request is in progress.
     * @var boolean
     */
    private $_api_in_progress;

    /**
     * Stores response from last search files api call.
     * @var SearchFilesResponse
     */
    private $_current_response;

    /**
     * Request object to be used for search files api query.
     * @var SearchFilesRequest
     */
    private $_current_request;

    /**
     * Offset Value
     * @var int
     */
    private $_offset;

    /**
     * Custom http client object
     * @var HttpInterface
     */
    private $_http_client;

    /**
     * Http Method to be used in Api hit.
     * @var string
     */
    private $_http_method;
    /**
     * Constructor.
     * @param CoreConfig $config config to be initialized.
     * @throws StockApiException if config is null.
     */
    public function __construct(CoreConfig $config)
    {
        $this->_config = $config;
    }

    /**
     * Method to validate Search Params.
     * @param SearchFilesRequest $request
     * @param string             $access_token
     * @throws StockApiException
     */
    private function _validateSearchParams(SearchFilesRequest $request, ?string $access_token = null)
    {
        if ($request->getSearchParams() == null) {
            throw StockApiException::withMessage('Search parameter must be present in the request object');
        }

        if (!empty($request->getResultColumns())) {
            if (in_array('is_licensed', $request->getResultColumns()) && $access_token === null) {
                throw StockApiException::withMessage('Access Token missing! Result Column is_licensed requires authentication');
            }
        }

        if ($request->getSearchParams()->getSimilarImage() == true && $request->getSimilarImage() == null) {
            throw StockApiException::withMessage('Image Data missing! Search parameter similar_image requires similar_image in query parameters');
        }
    }

    /**
     * Method to create and send request to the apis and parse result to response object.
     * @param SearchFilesRequest $search_file_request object containing search request parameters
     * @param string             $access_token        access token string to be used with api calls
     * @return SearchFilesResponse response object from the api call
     */
    public function getFiles(SearchFilesRequest $search_file_request, ?string $access_token = null) : SearchFilesResponse
    {
        $this->_http_method = $this->_getHttpMethod($search_file_request);
        $headers = APIUtils::generateCommonAPIHeaders($this->_config, $access_token);
        $end_point = $this->_config->getEndPoints()['search'];
        $request_url = $end_point . '?' . http_build_query($search_file_request);

        $search_param_object = new SearchParametersModels();
        $json_map_array = [];
        $json_map_array = $search_param_object->getjsonMapper();

        foreach ($json_map_array as $key => $val) {
            $find = '%5B' . $key . '%5D';
            $request_url = str_replace($find, $val, $request_url);
        }

        $offset_value = $this->_offset;
        $previous_offset_value = $search_file_request->getSearchParams()->getOffset();
        $find = 'search_parameters%5Boffset%5D=' . $previous_offset_value;
        $replace = 'search_parameters%5Boffset%5D=' . $offset_value;
        $request_url = str_replace($find, $replace, $request_url);

        if ($this->_http_method == 'GET') {
            $response_json = $this->_http_client->doGet($request_url, $headers);
        } else {
            $similar_image_data = APIUtils::downSampleImage($search_file_request->getSimilarImage());
            $response_json = $this->_http_client->doMultiPart($request_url, $headers, $similar_image_data);
        }

        $response_array = json_decode($response_json, true);

        if (empty($response_array)) {
            throw StockApiException::withMessage('No more search results available!');
        } else {
            $search_file_request->getSearchParams()->setOffset($this->_offset);
        }

        $search_files_response = new SearchFilesResponse();
        $search_files_response->initializeResponse($response_array);
        return $search_files_response;
    }

    /**
     * Method to do stuff on api call success.
     * @param SearchFilesResponse $response
     */
    private function _doOnSuccess(SearchFilesResponse $response)
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
     * Method to do search files api call.
     * @param SearchFilesRequest $request
     * @return SearchFilesResponse
     */
    public function doApiCall(SearchFilesRequest $request) : SearchFilesResponse
    {
        if ($this->_api_in_progress) {
            throw StockApiException::withMessage('Some other search is already in progress!');
        }

        try {
            $this->_api_in_progress = true;
            $response = $this->getFiles($request, $this->_access_token);
            $this->_doOnSuccess($response);
        } catch (StockApiException $e) {
            $this->_doOnError();
            throw $e;
        }

        return $this->_current_response;
    }

    /**
     * Method to get next search files response page.
     * @return SearchFilesResponse
     */
    public function getNextResponse() : SearchFilesResponse
    {
        $request = $this->_current_request;
        $offset_value = $request->getSearchParams()->getOffset();

        if (!$this->_initial_invalid_state) {
            $limit = $request->getSearchParams()->getOffset();
            $offset = $request->getSearchParams()->getLimit();
            $offset_value = $limit + $offset;

            if (($this->_current_response->getNbResults() === null) || ($offset_value >= $this->_current_response->getNbResults())) {
                throw StockApiException::withMessage('No more search results available!');
            }
        }

        $this->_offset = $offset_value;
        $response = $this->doApiCall($request);
        return $response;
    }

    /**
     * Method to get to previous search files response page.
     * @return SearchFilesResponse
     */
    public function getPreviousResponse() : SearchFilesResponse
    {
        $request = $this->_current_request;
        $offset_value = $request->getSearchParams()->getOffset() - $request->getSearchParams()->getLimit();

        if ($offset_value < 0) {
            throw StockApiException::WithMessage('Offset should be between 0 and MaxResults');
        }

        $this->_offset = $offset_value;
        $response = $this->doApiCall($request);
        return $response;
    }

    /**
     * Method to get response from last api call.
     * @return SearchFilesResponse
     */
    public function getLastResponse() : SearchFilesResponse
    {
        $user_response = new SearchFilesResponse();

        if (!$this->_initial_invalid_state) {
            $user_response = $this->_current_response;

            if (!$this->_nb_results_present) {
                $user_response->setNbResults(null);
            }
        }

        return $user_response;
    }

    /**
     * Method to skip to a specific search files response page.
     * @param int $page_index
     * @return SearchFilesResponse
     */
    public function getResponsePage(int $page_index) : SearchFilesResponse
    {
        $request = $this->_current_request;
        $total_pages = $this->totalSearchPages();

        if (($page_index < 0) || ($total_pages != SearchFiles::SEARCH_FILES_RETURN_ERROR && $page_index >= $total_pages)) {
            throw StockApiException::withMessage('Page index out of bounds');
        }

        $offset_value = $page_index * $request->getSearchParams()->getLimit();
        $this->_offset = $offset_value;
        return $this->doApiCall($request);
    }

    /**
     * Method to get total search results pages.
     * @return int
     */
    public function totalSearchPages() : int
    {
        if (!$this->_initial_invalid_state && ($this->_current_response->getNbResults() != null)) {
            return (integer) ceil((double) $this->_current_response->getNbResults() / $this->_current_request->getSearchParams()->getLimit());
        }

        return SearchFiles::SEARCH_FILES_RETURN_ERROR;
    }

    /**
     * Method to get total search files available.
     * @return int
     */
    public function totalSearchFiles() : int
    {
        if (!$this->_initial_invalid_state && ($this->_current_response->getNbResults() != null)) {
            return $this->_current_response->getNbResults();
        }

        return SearchFiles::SEARCH_FILES_RETURN_ERROR;
    }

    /**
     * Method to get response from last api call.
     * @return int
     */
    public function currentSearchPageIndex() : int
    {
        if (!$this->_initial_invalid_state && ($this->_current_response->getNbResults() != null)) {
            $offset_value = $this->_current_request->getSearchParams()->getOffset();
            $result = (integer) (ceil((double) $offset_value / $this->_current_request->getSearchParams()->getLimit()));
            return $result;
        }

        return SearchFiles::SEARCH_FILES_RETURN_ERROR;
    }

    /**
     * Initialize an api object
     * @param SearchFilesRequest  $request
     * @param string              $access_token
     * @param HttpClientInterface $http_client
     * @throws StockApiException
     * @return SearchFiles
     */
    public function searchFilesInitialize(?SearchFilesRequest $request, ?string $access_token, HttpClientInterface $http_client) : SearchFiles
    {
        if ($request == null) {
            throw StockApiException::withMessage('request cannot be null');
        }

        $this->_validateSearchParams($request, $access_token);
        $this->_current_response = new SearchFilesResponse();
        $this->_current_request = $request;

        //Including number of results in ResultColumns if user has not set ResultColumns in request object.
        if (empty($request->getResultColumns())) {
            $this->_nb_results_present = true;
        } else {
            $this->_nb_results_present = in_array('nb_results', $request->getResultColumns());
        }

        //Including number of results in ResultColumns if user has not set it in ResultColumns.
        if (!$this->_nb_results_present) {
            $this->_current_request = $request;
            array_push($this->_current_request->result_columns, 'nb_results');
        }

        $this->_access_token = $access_token;
        $this->_api_in_progress = false;
        $this->_http_client = $http_client;

        if ($request->getSearchParams()->getLimit() == null) {
            $this->_current_request->getSearchParams()->setLimit(SearchFiles::DEFAULT_SEARCH_FILES_LIMIT);
        }

        if ($request->getSearchParams()->getOffset() == null) {
            $this->_current_request->getSearchParams()->setOffset(0);
        }

        $this->_offset = $this->_current_request->getSearchParams()->getOffset();
        return $this;
    }

    /**
     * Utility method to choose whether Http method is GET or MultiPart.
     * @param SearchFilesRequest $request Request params for searchFiles
     * @return string http method to be called
     */
    private function _getHttpMethod(SearchFilesRequest $request) : string
    {
        $http_method = 'GET';

        if (($request->getSearchParams() != null) && ($request->getSimilarImage() != null) && $request->getSearchParams()->getSimilarImage() == true) {
            $http_method = 'POST';
        }

        return $http_method;
    }
}
