<?php
/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Response;

use \AdobeStock\Api\Models\StockFileLicenseHistory;

class LicenseHistory
{
    /**
     * @var int nb_results
     */
    public $nb_results;
    
    /**
     * @var array files arrayofStockFiles
     */
    public $files;
    
    /**
     * Default Constructor function.
     */
    public function __construct()
    {
        $this->nb_results = null;
        $this->files = [];
    }
    
    /**
     * InitializeResponse function for License History
     * @param array $raw_response Array contains value of various keys of LicenseHistory Class
     */
    public function initializeResponse(array $raw_response)
    {
        foreach ($raw_response as $key => $val) {
            
            if (property_exists($this, $key)) {
                
                if (is_array($val) && $key == 'files') {
                    $result_array_objects = [];
                    
                    foreach ($val as $element) {
                        $stock_file_obj = new StockFileLicenseHistory($element);
                        $result_array_objects[] = $stock_file_obj;
                    }
                    
                    $this->files = $result_array_objects;
                } else {
                    $this->$key = $val;
                }
            }
        }
    }
    
    
    /**
     * Get total number of found assets in the search results.
     * @return int|null
     */
    public function getNbResults() : ?int
    {
        return $this->nb_results;
    }
    
    /**
     * Sets total number of found assets in the search results.
     * @param int $nb_results passed value for no of assets
     * @return LicenseHistory
     */
    public function setNbResults(int $nb_results = null) : LicenseHistory
    {
        $this->nb_results = $nb_results;
        return $this;
    }
    
    /**
     * Get list of stock media files
     * @return array
     */
    public function getFiles() : array
    {
        return $this->files;
    }
    
    /**
     * Sets list of stock media files.
     * @param array $files
     * @return LicenseHistory
     */
    public function setFiles(array $files) : LicenseHistory
    {
        $this->files = $files;
        return $this;
    }
}
