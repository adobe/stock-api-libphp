<?php

/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Client;

use \AdobeStock\Api\Exception\StockApi as StockApiException;
use \AdobeStock\Api\Request\License as LicenseRequest;
use \AdobeStock\Api\Core\Config as CoreConfig;
use \AdobeStock\Api\Client\Http\HttpInterface as HttpClientInterface;
use \AdobeStock\Api\Utils\APIUtils;
use \AdobeStock\Api\Response\License as LicenseResponse;
use \AdobeStock\Api\Core\Constants as CoreConstants;
use \GuzzleHttp\Middleware;
use \GuzzleHttp\Psr7\Request;
use \GuzzleHttp\HandlerStack;
use \Psr\Http\Message\RequestInterface;
use \Psr\Http\Message\ResponseInterface;

class License
{
    /**
     * Configuration that need to be initialized
     * before calling apis.
     * @var CoreConfig
     */
    private $_config;
    
    /**
     * Redirect url
     * @var string
     */
    private $_url;

    /**
     * Constructor.
     * @param CoreConfig $config config to be initialized.
     */
    public function __construct(CoreConfig $config)
    {
        $this->_config = $config;
    }

    /**
     * Method to return URL to asset
     * @return string $_url
     */
    protected function _getDownloadUrl(): string
    {
        return $this->_url;
    }

    /**
     * Method which updates download URL
     * @param string $url
     * @param string $access_token
     */
    protected function _setDownloadUrl(string $url, string $access_token = null)
    {
        if ($access_token) {
            $url .= '?token=' . $access_token;
        }

        $this->_url = $url;
    }

    /**
     * Method to validate Params.
     * @param LicenseRequest $request
     * @param string         $access_token
     * @throws StockApiException
     */
    private function _validateParams(LicenseRequest $request, string $access_token)
    {
        if ($request->getContentId() === null) {
            throw StockApiException::withMessage('Asset Content id must be present in the license request');
        }
        
        if (empty($access_token)) {
            throw StockApiException::withMessage('Access token can\'t be empty');
        }
    }

    /**
     * Requests licensing information about a specific asset for a specific user
     * @param LicenseRequest      $request
     * @param string              $access_token
     * @param HttpClientInterface $http_client  client that to be used in calling apis.
     * @return LicenseResponse contains LicenseEntitlement,LicensePurchaseOptions,LicenseMemberInfo,cce_agency and contents
     */
    public function getContentInfo(LicenseRequest $request, string $access_token, HttpClientInterface $http_client): LicenseResponse
    {
        $this->_validateParams($request, $access_token);
        
        if ($request->getLicenseState() === null) {
            throw StockApiException::withMessage('Licensing state must be present in the license request');
        }
        
        $end_point = $this->_config->getEndPoints()['license_info'];
        $request_url = $end_point . '?' . http_build_query($request);
        $headers = APIUtils::generateCommonAPIHeaders($this->_config, $access_token);
        $raw_response = $http_client->doGet($request_url, $headers);
        $license_response = new LicenseResponse(json_decode($raw_response, true));
        return $license_response;
    }

    /**
     * Requests a license for an asset for a specific user.
     * @param LicenseRequest      $request
     * @param string              $access_token
     * @param HttpClientInterface $http_client  client that to be used in calling apis.
     * @return LicenseResponse contains LicenseEntitlement,LicensePurchaseOptions,LicenseMemberInfo,cce_agency and contents
     */
    public function getContentLicense(LicenseRequest $request, string $access_token, HttpClientInterface $http_client): LicenseResponse
    {
        $this->_validateParams($request, $access_token);
        
        if ($request->getLicenseState() === null) {
            throw StockApiException::withMessage('Licensing state must be present in the license request');
        }
        
        $end_point = $this->_config->getEndPoints()['license'];
        $request_url = $end_point . '?' . http_build_query($request);
        $headers = APIUtils::generateCommonAPIHeaders($this->_config, $access_token);
        
        if ($request->getLicenseReference() != null) {
            $raw_response = $http_client->doPost($request_url, $headers, $request->getLicenseReference());
        } else {
            $raw_response = $http_client->doGet($request_url, $headers);
        }
        
        return new LicenseResponse(json_decode($raw_response, true));
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
     * @param LicenseRequest      $request
     * @param string              $access_token
     * @param HttpClientInterface $http_client  client that to be used in calling apis.
     * @return LicenseResponse contains LicenseEntitlement,LicensePurchaseOptions,LicenseMemberInfo,cce_agency and contents
     */
    public function getMemberProfile(LicenseRequest $request, string $access_token, HttpClientInterface $http_client): LicenseResponse
    {
        $this->_validateParams($request, $access_token);
        $end_point = $this->_config->getEndPoints()['user_profile'];
        $request_url = $end_point . '?' . http_build_query($request);
        $headers = APIUtils::generateCommonAPIHeaders($this->_config, $access_token);
        $raw_response = $http_client->doGet($request_url, $headers);
        $license_response = new LicenseResponse(json_decode($raw_response, true));
        return $license_response;
    }

    /**
     * Notifies the system when a user cancels a licensing operation.
     * It can be used if the user refuses the opportunity to purchase
     * or license the requested asset.
     * @param LicenseRequest      $request
     * @param string              $access_token
     * @param HttpClientInterface $http_client  client that to be used in calling apis.
     * @return int $code
     */
    public function abandonLicense(LicenseRequest $request, string $access_token, HttpClientInterface $http_client) : int
    {
        $this->_validateParams($request, $access_token);
        $end_point = $this->_config->getEndPoints()['abandon'];
        $request_url = $end_point . '?' . http_build_query($request);
        $headers = APIUtils::generateCommonAPIHeaders($this->_config, $access_token);
        $response = $http_client->doGet($request_url, $headers);
        $code = (int) $response->getContents();
        
        if ($code != 204) {
            throw StockApiException::withMessage('Stock API returned with an error');
        }
        
        return $code;
    }
    
    /**
     * Provide the guzzle request object that contains url of the asset that can be downloaded by hitting request with guzzle client send method if it is already licensed otherwise throws Exception showing a message whether user has enough quota and can buy the license or not.
     * @param LicenseRequest      $request      request object containing content_id and license state
     * @param string              $access_token ims user access token
     * @param HttpClientInterface $http_client  http client
     * @throws StockApiException if request is not valid or asset is not licensed licensing information is not present for the asset or API returns with an error
     * @return Request guzzle request object containing url of the asset.
     */
    public function downloadAssetRequest(LicenseRequest $request, string $access_token, HttpClientInterface $http_client) : Request
    {
        $purchase_state_params_array = CoreConstants::getPurchaseStateParams();
        $content_info = $this->getContentInfo($request, $access_token, $http_client);
        
        if ($content_info->getContents() === null) {
            throw StockApiException::withMessage('Could not find the licensing information for the asset');
        }
        
        $purchase_details = $content_info->getContents()[$request->getContentId()]->getPurchaseDetails();
        
        if ($purchase_details === null || $purchase_details->getState() === null) {
            throw StockApiException::withMessage('Could not find the purchase details for the asset');
        }
        
        //when user doesnot have sufficient quota or the entitlement array or the purchase_options array is null then StockApiException is thrown
        if ($purchase_details->getState() != $purchase_state_params_array['PURCHASED']) {
            $member_profile = $this->getMemberProfile($request, $access_token, $http_client);
            
            if ($member_profile->getEntitlement() === null) {
                throw StockApiException::withMessage('Could not find the available licenses for the user');
            }
            
            if ($member_profile->getPurchaseOptions() === null) {
                throw StockApiException::withMessage('Could not find the user purchasing options for the asset');
            }
            
            $can_buy = (bool) (($member_profile->getEntitlement()->getQuota() != 0) || ($member_profile->getPurchaseOptions()->getPurchaseState() == $purchase_state_params_array['OVERAGE']));
            
            if ($can_buy) {
                throw StockApiException::withMessage('Content not licensed but have enough quota or overage plan, so first buy the license');
            } else {
                throw StockApiException::withMessage('Content not licensed and also you do not have enough quota or overage plan');
            }
        }
        
        $content_license = $this->getContentLicense($request, $access_token, $http_client);
        
        $purchase_details = $content_license->getContents()[$request->getContentId()]->getPurchaseDetails();
        
        if ($purchase_details == null || $purchase_details->getUrl() === null) {
            throw StockApiException::withMessage('Could not find the purchase details for the asset');
        }
        
        $url = $purchase_details->getUrl();
        $headers = APIUtils::generateCommonAPIHeaders($this->_config, $access_token);
        $headers['allow_redirects'] = false;
        $client_handler = $http_client->getHandlerStack();
        //adds middleware in the client which controls the redirection behaviour.
        $this->_addHandler($client_handler);
        //store original url
        $this->_setDownloadUrl($url, $access_token);
        //guzzle get request by client to fetch s3 url
        $http_client->doGet($url, $headers);
        //guzzle request object is created which can be used to download asset
        $guzzle_request = new Request('GET', $this->_getDownloadUrl());
        $client_handler->remove('Redirection check');
        return $guzzle_request;
    }
    
    /**
     * Provide the url of the asset if it is already licensed otherwise throws Exception showing a message whether user has enough quota and can buy the license or not.
     * @param LicenseRequest      $request      request object containing content_id and license state
     * @param string              $access_token ims user access token
     * @param HttpClientInterface $http_client  http client
     * @throws StockApiException if request is not valid or asset is not licensed licensing information is not present for the asset or API returns with an error
     * @return string url of the asset.
     */
    public function downloadAssetUrl(LicenseRequest $request, string $access_token, HttpClientInterface $http_client) : string
    {
        $guzzle_request = $this->downloadAssetRequest($request, $access_token, $http_client);
        //to fetch the s3 url
        return $guzzle_request->getUri()->__toString();
    }
    
    /**
     * Provide the Image Buffer if it is already licensed otherwise throws Exception showing a message whether user has enough quota and can buy the license or not.
     * @param LicenseRequest      $request      request object containing content_id and license state
     * @param string              $access_token ims user access token
     * @param HttpClientInterface $http_client  http client
     * @throws StockApiException if request is not valid or asset is not licensed licensing information is not present for the asset or API returns with an error
     * @return string Image stream.
     */
    public function downloadAssetStream(LicenseRequest $request, string $access_token, HttpClientInterface $http_client) : string
    {
        $guzzle_request = $this->downloadAssetRequest($request, $access_token, $http_client);
        //to fetch the image buffer which is present in the body of the guzzle response
        return $http_client->sendRequest($guzzle_request)->getBody()->getContents();
    }
    
    /**
     * Method to add middleware in custom http client
     * @param HandlerStack $stack
     */
    private function _addHandler(HandlerStack $stack)
    {
        $stack->push(Middleware::mapRequest(function (RequestInterface $request) {
            $url = $request->getUri()->__toString();
            $pattern = '/^.*\.(adobe\.(io|com)|adobestock\.com)/';
            
            if (!preg_match($pattern, $url)) {
                return $request->withoutHeader('Authorization');
            }
            
            return $request;
        }));
        
        $stack->push(Middleware::mapResponse(function (ResponseInterface $response) {
            $http_status_code = $response->getStatusCode();
                
            if (intval($http_status_code) == 200) {
                // append content-disposition header to url
                $header = $response->getHeader('Content-Disposition');
                $this->_setDownloadUrl($this->_getDownloadUrl() . '&' . $header[0]);
            } else if (intval($http_status_code / 100) == 3) {
                // override url with redirect link
                $this->_setDownloadUrl($response->getHeader('Location')[0]);
            } else {
                throw StockApiException::withMessage('No redirection done by server');
            }
            
            return $response;
        }), 'Redirection check');
    }
}
