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
use \AdobeStock\Api\Request\License as LicenseRequest;
use \AdobeStock\Api\Core\Config as CoreConfig;
use \AdobeStock\Api\Client\Http\HttpInterface as HttpClientInterface;
use \AdobeStock\Api\Utils\APIUtils;
use \AdobeStock\Api\Response\License as LicenseResponse;

class License
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
}
