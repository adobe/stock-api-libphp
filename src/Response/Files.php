<?php
/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Response;

use \AdobeStock\Api\Models\StockFile;

class Files
{
    /**
     * @var int nb_results
     */
    public $nb_results;

    /**
     * @var StockFile[] array of StockFile
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
     * InitializeResponse function for Files
     * @param array $raw_response Array contains value of various keys of Files Class
     */
    public function initializeResponse(array $raw_response) : void
    {
        foreach ($raw_response as $key => $val) {
            if (property_exists($this, $key)) {
                if (is_array($val) && $key == 'files') {
                    $result_array_objects = [];
                    foreach ($val as $element) {
                        $result_array_objects[] = new StockFile($element);
                    }
                    $this->files = $result_array_objects;
                } else {
                    $this->$key = $val;
                }
            }
        }
    }

    /**
     * Get total number of found assets in the response.
     *
     * @return int|null
     */
    public function getNbResults() : ?int
    {
        return $this->nb_results;
    }

    /**
     * Sets total number of found assets in the response.
     *
     * @param int $nb_results passed value for no of assets
     * @return Files
     */
    public function setNbResults(?int $nb_results = null) : Files
    {
        $this->nb_results = $nb_results;
        return $this;
    }

    /**
     * Get list of stock media files
     *
     * @return StockFile[]
     */
    public function getFiles() : array
    {
        return $this->files;
    }

    /**
     * Sets list of stock media files.
     *
     * @param StockFile[] $files
     * @return Files
     */
    public function setFiles(array $files) : Files
    {
        $this->files = $files;
        return $this;
    }
}
