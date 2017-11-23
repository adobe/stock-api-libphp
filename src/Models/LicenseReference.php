<?php

/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Models;

use \AdobeStock\Api\Exception\StockApi as StockApiException;

class LicenseReference
{
    /**
     * The license reference id.
     * @var int
     */
    public $id;
    
    /**
     * Value of license reference "id" .
     * Value can be found with the "/Rest/Libraries/1/Member/Profile" API.
     * @var string
     */
    public $value;

    /**
     * @param array $response
     */
    public function __construct(array $response)
    {
        foreach ($response as $key => $val) {
            if (property_exists($this, $key)) {
                $this->$key = $val;
            }
        }
    }

    /**
     * Getter for license reference id.
     * @return int
     */
    public function getLicenseReferenceId(): int
    {
        return $this->id;
    }

    /**
     * Setter for License Reference Id
     * @param int $val
     * @return LicenseReference
     */
    public function setLicenseReferenceId(int $val): LicenseReference
    {
        if ($val < 0) {
            throw StockApiException::withMessage('License Reference id cannot be negative');
        }
        
        $this->id = $val;
        return $this;
    }

    /**
     * Getter for license reference value.
     * @return string
     */
    public function getLicenseReferenceValue(): string
    {
        return $this->value;
    }

    /**
     * Setter for license reference value.
     * @param string $val
     * @return LicenseReference
     */
    public function setLicenseReferenceValue(string $val): LicenseReference
    {
        if (empty($val)) {
            throw StockApiException::withMessage('License Reference value cannot be empty');
        }
        
        $this->value = $val;
        return $this;
    }
}
