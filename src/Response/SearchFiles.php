<?php
/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Response;

use \AdobeStock\Api\Models\StockFile as StockFile;

class SearchFiles
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
     * InitializeResponse function for SearchFiles
     * @param array $raw_response Array contains value of various keys of SearchFiles Class
     */
    public function initializeResponse(array $raw_response)
    {
        foreach ($raw_response as $key => $val) {
            
            if (property_exists($this, $key)) {
                
                if (is_array($val) && $key == 'files') {
                    $result_array_objects = [];
                    
                    foreach ($val as $element) {
                        $stock_file_obj = new StockFile($element);
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
    public function getNbResults()
    {
        $value = $this->nb_results;
        return $value;
    }
    
    /**
     * Sets total number of found assets in the search results.
     * @param int $nb_results passed value for no of assets
     * @return SearchFiles
     */
    public function setNbResults(int $nb_results = null)
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
     * @return SearchFiles
     */
    public function setFiles(array $files)
    {
        $this->files = $files;
        return $this;
    }
}
