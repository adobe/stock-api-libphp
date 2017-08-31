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
