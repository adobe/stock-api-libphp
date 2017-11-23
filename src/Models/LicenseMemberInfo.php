<?php

/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

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
