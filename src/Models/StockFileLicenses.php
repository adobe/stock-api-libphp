<?php
/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Models;

use \AdobeStock\Api\Models\StockFileLicenseProp as StockFileLicensePropModels;

class StockFileLicenses
{
    /**
     * Standard license type.
     * @var StockFileLicensePropModels
     */
    public $standard;
    
    /**
     * Half-priced premium license type.
     * @var StockFileLicensePropModels
     */
    public $standard_m;
    
    /**
     * Json Mapper for class variables
     * @var array
     */
    public $json_mapper = [
        'Standard' => 'standard',
        'Standard_M' => 'standard_m',
    ];
    
    /**
     * Constructor for StockFileLicenses
     * @param array $raw_response Array contains value of various keys of StockFileLicenses Class
     */
    public function __construct(array $raw_response)
    {
        foreach ($raw_response as $key => $val) {
            
            if (property_exists($this, $this->json_mapper[$key])) {
                if (is_array($val)) {
                    $this->json_mapper[$key] = new StockFileLicensePropModels($val);
                }
            }
        }
    }
    
    /**
     * Get Standard license type.
     * @return StockFileLicensePropModels
     */
    public function getstandard() : StockFileLicensePropModels
    {
        return $this->standard;
    }
    
    /**
     * Get half-priced premium license type.
     * @return StockFileLicensePropModels
     */
    public function getStandardM() : StockFileLicensePropModels
    {
        return $this->standard_m;
    }
    
    /**
     * Sets Standard license type.
     * @param StockFileLicensePropModels $standard
     * @return StockFileLicenses
     */
    public function setStandard(StockFileLicensePropModels $standard) : StockFileLicenses
    {
        $this->standard = $standard;
        return $this;
    }
    
    /**
     * Sets half-priced premium license type.
     * @param StockFileLicensePropModels $standard_m
     * @return StockFileLicenses
     */
    public function setStandardM(StockFileLicensePropModels $standard_m) : StockFileLicenses
    {
        $this->standard_m = $standard_m;
        return $this;
    }
}
