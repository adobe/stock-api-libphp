<?php

/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Request;

use \AdobeStock\Api\Exception\StockApi as StockApiException;
use \AdobeStock\Api\Models\LicenseReference;
use \AdobeStock\Api\Core\Constants as CoreConstants;

class License
{
    /**
     * Language location code
     * @var string
     */
    public $locale;
    
    /**
     * Asset's unique identifer
     * @var int
     */
    public $content_id;
    
    /**
     * The Adobe Stock licensing state for the asset
     * @var string
     */
    public $license;
    
    /**
     * The asset purchase state
     * @var string
     */
    public $state;
    
    /**
     * Panel version >=2.10 will send this parameter to get the "message_ccx"
     * field in the JSON response.
     * @var string
     */
    public $format;
    
    /**
     * Array of license references of type LicenseReference.
     * Must be in the POST body.
     * @var array|null of LicenseReference
     */
    public $license_reference;

    /**
     * Getter for Locale.
     * @return string Language location code.
     */
    public function getLocale(): string
    {
        return $this->locale;
    }

    /**
     * Setter for Locale.
     * @param string $locale Language location code.
     * @return License
     * @throws StockApiException if locale is empty.
     */
    public function setLocale(string $locale): License
    {
        if (!empty($locale)) {
            $this->locale = $locale;
        } else {
            throw StockApiException::withMessage('Locale cannot be empty string');
        }
        
        return $this;
    }

    /**
     * Getter for ContentId.
     * @return int|null Asset identifier for an existing asset.
     */
    public function getContentId(): ?int
    {
        return $this->content_id;
    }

    /**
     * Setter for ContentId.
     * @param int $content_id Unique identifier for an asset.
     * @return License
     * @throws StockApiException if content id is negative.
     */
    public function setContentId(int $content_id): License
    {
        if ($content_id < 0) {
            throw StockApiException::withMessage('Content Id cannot be negative');
        }
        
        $this->content_id = $content_id;
        return $this;
    }

    /**
     * Getter for LicenseState.
     * @return string|null The Adobe Stock licensing state for the asset of type
     * string.Not required for Member/Abondon api. If passed,
     * field will be ignored while calling this api.
     */
    public function getLicenseState(): ?string
    {
        return $this->license;
    }

    /**
     * Setter for LicenseState.
     * @param string $license_state
     * @return License
     * @throws StockApi exception
     */
    public function setLicenseState(string $license_state): License
    {
        $state = CoreConstants::getLicenseStateParams();
        
        if (array_key_exists($license_state, $state)) {
            $this->license = $state[$license_state];
        } else {
            throw StockApiException::withMessage('No such license state exists');
        }
        
        return $this;
    }

    /**
     * Getter for PurchaseState.
     * @return The asset purchase state from the Member/Profile results of type string
     */
    public function getPurchaseState(): string
    {
        return $this->state;
    }

    /**
     * Setter for PurchaseState.
     * @param string $purchase_state
     * @return Object of LicenseRequest
     * @throws IllegalArgumentException if purchase state is set to null.
     */
    public function setPurchaseState(string $purchase_state): License
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
     * Getter for format
     * @return bool Format
     */
    public function getFormat(): bool
    {
        if ($this->format === 'message_ccx') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param bool $val sets format to message_ccx if it is true else null.
     * @return License
     * @throws StockApiException if null value is passed.
     */
    public function setFormat(bool $val): License
    {
        if ($val === true) {
            $this->format = 'message_ccx';
        }
        
        return $this;
    }

    /**
     * Gets array of licensing references having id and values pair of type LicenseReference.
     * @return array|null
     */
    public function getLicenseReference(): ?array
    {
        return $this->license_reference;
    }

    /**
     * @param array $val
     * @return License
     */
    public function setLicenseReference(array $val): License
    {
        if (empty($val)) {
            throw StockApiException::withMessage('LicenseReference array cannot be empty');
        }
        
        foreach ($val as $index => $key) {
            $this->license_reference [$index] = new LicenseReference($key);
        }
        
        return $this;
    }
}
