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

class StockFileCompProp
{
    /**
     * Width in pixels of the asset's complementary (unlicensed) image.
     * @var int
     */
    public $width;
    
    /**
     * Height in pixels of the asset's complementary (unlicensed) image.
     * @var int
     */
    public $height;
    
    /**
     * URL to the watermarked version of the asset.
     * @var string
     */
    public $url;
    /**
     * Constructor for StockFileCompProp
     * @param array $raw_response Array contains value of various keys of StockFileCompProp Class
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
     * Get width of complementary image.
     * @return int|null
     */
    public function getWidth() : ?int
    {
        return $this->width;
    }
    
    /**
     * Sets width of complementary image.
     * @param int $width
     * @return StockFileCompProp
     */
    public function setWidth(int $width = null)
    {
        $this->width = $width;
        return $this;
    }
    
    /**
     * Get height of complementary image.
     * @return int|null
     */
    public function getHeight() : ?int
    {
        return $this->height;
    }
    
    /**
     * Sets Height of complementary image.
     * @param int $height
     * @return StockFileCompProp
     */
    public function setHeight(int $height = null) : StockFileCompProp
    {
        $this->height = $height;
        return $this;
    }
    
    /**
     * Get url of complementary image.
     * @return string|null
     */
    public function getUrl() : string
    {
        return $this->url;
    }
    /**
     * Sets url of complementary image.
     * @param string $url url of complementary image.
     * @return StockFileCompProp
     */
    public function setUrl(string $url = null) : StockFileCompProp
    {
        $this->url = $url;
        return $this;
    }
}
