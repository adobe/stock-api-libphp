<?php
/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Core;

use \AdobeStock\Api\Core\Constants;

class Config
{
    /**
     * Api key required in headers during Api call.
     * @var string.
     */
    protected $_api_key;

    /**
     * Product required in headers during Api call.
     * @var string.
     */
    protected $_product;

    /**
     * Environment required to identify which endpoint need to be hit.
     * @var string.
     */
    protected $_target_env;

    /**
     * Endpoints that need to be hit depending on the environment.
     * @var array.
     */
    protected $_endpoints;

    /**
     * Constructor for Config class.
     * @param string $api_key _api_key header for the api calls.
     * @param string $product _product header for the api calls.
     * @param string $env     defines the environment for the client.
     */
    public function __construct(string $api_key, string $product, ?string $env = null)
    {
        $environment = Constants::getEnvironments();
        $end_points = Constants::getEndpoints() ;
        
        if ($env === null) {
            $env = 'PROD';
        }

        if ($env == 'PROD') {
            $this->_target_env = $environment[$env];
            $this->_endpoints = $end_points;
        } else {
            $this->_target_env = $environment['STAGE'];
            $this->_endpoints = str_replace('stock', 'stock-stage', $end_points);
        }

        if ($api_key !== null) {
            $this->_api_key = $api_key;
        }

        if ($product !== null) {
            $this->_product = $product;
        }
    }

    /**
     * Returns the api key.
     * @return string
     */
    public function getapiKey() : string
    {
        return $this->_api_key;
    }

    /**
     * Returns the product.
     * @return string
     */
    public function getProduct() : string
    {
        return $this->_product;
    }

    /**
     * Returns the targetEnv.
     * @return string
     */
    public function getTargetEnv() : string
    {
        return $this->_target_env;
    }

    /**
     * Returns the endPoint.
     * @return array
     */
    public function getEndPoints() : array
    {
        return $this->_endpoints;
    }

    /**
     * Set the api_key.
     * @param string $val api key.
     * @return Config
     */
    public function setApiKey(string $val) : Config
    {
        $this->_api_key = $val;
        return $this;
    }

    /**
     * Set the Product.
     * @param string $val product.
     * @return Config
     */
    public function setProduct(string $val) : Config
    {
        $this->_product = $val;
        return $this;
    }

    /**
     * Set the targetEnv.
     * @param string $val
     * @return Config
     */
    public function setTargetEnv(string $val) : Config
    {
        $this->_target_env = $val;
        return $this;
    }

    /**
     * Set the EndPoint.
     * @param array $val endpoint.
     * @return Config
     */
    public function setEndPoints(array $val) : Config
    {
        $this->_endpoints = $val;
        return $this;
    }

    /**
     * Checks if the config is initialized/set
     * @return bool true if config is initialized/set, false otherwise
     */
    public function isConfigInitialized() : bool
    {
        return ($this->_target_env && $this->_endpoints && $this->_api_key && $this->_product);
    }
}
