<?php
/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Models;

class StockFileKeyword
{
    /**
     * name of media keyword.
     * @var string
     */
    public $name;
    
    /**
     * Constructor for StockFileKeyword
     * @param array $raw_response Array contains value of various keys of StockFileKeyword Class
     */
    public function __construct(array $raw_response)
    {
        foreach ($raw_response as $key => $val) {
            if (property_exists($this, $key)) {
                $this->$key = $val;
            }
        }
    }
    
    /**
     * Get name of media keyword.
     * @return string|null
     */
    public function getName() : ?string
    {
        return $this->name;
    }
    
    /**
     * Sets name of media keyword.
     * @param string $name name of media keyword
     * @return StockFileKeyword
     */
    public function setName(?string $name = null) : StockFileKeyword
    {
        $this->name = $name;
        return $this;
    }
}
