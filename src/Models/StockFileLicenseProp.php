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

class StockFileLicenseProp
{
    /**
     * width property of license.
     * @var int
     */
    public $width;
    
    /**
     * height property of license.
     * @var int
     */
    public $height;
    
    /**
     * licensing url.
     * @var string
     */
    public $url;
    
    /**
     * Constructor for StockFileLicenseProp
     * @param array $raw_response Array contains value of various keys of StockFileLicenseProp Class
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
     * Get width property of license.
     * @return int|null width
     */
    public function getWidth() : ?int
    {
        return $this->width;
    }
    
    /**
     * Sets width property of license.
     * @param int $Width Width
     * @return StockFileLicenseProp
     */
    public function setWidth(int $Width = null) : StockFileLicenseProp
    {
        $this->width = $Width;
        return $this;
    }
    
    /**
     * Get height property of license.
     * @return int|null height
     */
    public function getHeight() : ?int
    {
        return $this->height;
    }
    
    /**
     * Sets height property of license.
     * @param int $height Height
     * @return StockFileLicenseProp
     */
    public function setHeight(int $height = null) : StockFileLicenseProp
    {
        $this->height = $height;
        return $this;
    }
    
    /**
     * Get licensing url.
     * @return string|null url
     */
    public function getUrl() : ?string
    {
        return $this->url;
    }
    
    /**
     * Sets licensing url.
     * @param string $url url of complementary image
     * @return StockFileLicenseProp
     */
    public function setUrl(string $url = null) : StockFileLicenseProp
    {
        $this->url = $url;
        return $this;
    }
}
