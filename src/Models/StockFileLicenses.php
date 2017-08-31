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
