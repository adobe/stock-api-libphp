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
    public function setName(string $name = null) : StockFileKeyword
    {
        $this->name = $name;
        return $this;
    }
}
