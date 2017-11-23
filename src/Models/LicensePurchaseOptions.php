<?php

/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Models;

use \AdobeStock\Api\Core\Constants as CoreConstants;
use \AdobeStock\Api\Exception\StockApi as StockApiException;

class LicensePurchaseOptions
{
    /**
     * @var string User's purchase relationship to an asset.
     */
    public $state;
    
    /**
     * @var bool Whether a purchase in process requires going to
     * the Adobe Stock site for completion.
     */
    public $requires_checkout;
    
    /**
     * @var string Message to display to your user in response to a licensing API query.
     */
    public $message;
    
    /**
     * @var string The URL to see purchase options plan.
     */
    public $url;

    /**
     * @param array $raw_response
     */
    public function __construct(array $raw_response)
    {
        foreach ($raw_response as $key => $val) {
            if (property_exists($this, $key)) {
                $this->$key = $val;
            }
        }
    }

    /**
     * Get user's purchase relationship to an asset.
     * @return asset purchase state
     */
    public function getPurchaseState(): string
    {
        return $this->state;
    }

    /**
     * Get whether a purchase in process requires going to
     * the Adobe Stock site for completion.
     * @return true if requires going to Adobe Stock site else false
     */
    public function getRequiresCheckout(): bool
    {
        return $this->requires_checkout;
    }

    /**
     * Get Message to display to your user in response to a licensing API query.
     * @return message of type String
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Get the URL to see purchase options plan.
     * @return string
     */
    public function getPurchaseUrl(): string
    {
        return $this->url;
    }

    /**
     * Sets user's purchase relationship to an asset.
     * @param string $purchase_state specifying asset purchase status
     * @return LicensePurchaseOptions
     */
    public function setPurchaseState(string $purchase_state) : LicensePurchaseOptions
    {
        $state = CoreConstants::getPurchaseStateParams();
        
        if (array_key_exists($purchase_state, $state)) {
            $this->state = $state[$purchase_state];
        } else {
            throw StockApiException::withMessage('No such purchase state exists');
        }
        
        return $this;
    }

    /**
     * Sets whether a purchase in process requires going to
     * the Adobe Stock site for completion.
     * @param bool $val
     * @return LicensePurchaseOptions
     */
    public function setRequiresCheckout(bool $val) : LicensePurchaseOptions
    {
        $this->requires_checkout = $val;
        return $this;
    }

    /**
     * Sets Message to display to your user in response to a
     * licensing API query.
     * @param string $val
     * @return LicensePurchaseOptions
     */
    public function setMessage(string $val) : LicensePurchaseOptions
    {
        $this->message = $val;
        return $this;
    }

    /**
     * Sets the URL to see purchase options plan.
     * @param string $val
     * @return LicensePurchaseOptions
     */
    public function setPurchaseUrl(string $val) : LicensePurchaseOptions
    {
        $this->url = $val;
        return $this;
    }
}
