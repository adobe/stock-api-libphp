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
