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

class LicenseMemberInfo
{
    /**
     * @var string User's Adobe Stock member identifier.
     */
    public $stock_id;

    /**
     * Constructor
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
     * Get user's Adobe Stock member identifier.
     * @return string
     */
    public function getStockId(): string
    {
        return $this->stock_id;
    }

    /**
     * Sets Adobe Stock member identifier.
     * @param string $val
     * @return LicenseMemberInfo
     */
    public function setStockId(string $val) : LicenseMemberInfo
    {
        $this->stock_id = $val;
        return $this;
    }
}
