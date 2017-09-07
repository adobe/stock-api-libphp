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

class LicenseThumbnail
{
    /**
     * The URL from which the thumbnail can be downloaded.
     * @var string
     */
    public $url;
    
    /**
     * Type of the asset thumbnail.
     * @var string
     */
    public $content_type;
    
    /**
     * Width of asset thumbnail in pixels.
     * @var int
     */
    public $width;
    
    /**
     * Height of asset thumbnail in pixels.
     * @var int
     */
    public $height;

    /**
     * @param array $response
     */
    public function __construct(array $response)
    {
        foreach ($response as $key => $val) {
            if (property_exists($this, $key)) {
                $this->$key = $val;
            }
        }
    }

    /**
     * Getter for asset URL
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Getter for asset Content Type
     * @return string
     */
    public function getContentType(): string
    {
        return $this->content_type;
    }

    /**
     * Getter for asset Width
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * Getter for asset Height
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * Setter for asset URL
     * @param string $val
     * @return LicenseThumbnail
     */
    public function setUrl(string $val) : LicenseThumbnail
    {
        $this->url = $val;
        return $this;
    }

    /**
     * Setter for asset Content Type
     * @param string $val
     * @return LicenseThumbnail
     */
    public function setContentType(string $val) : LicenseThumbnail
    {
        $this->content_type = $val;
        return $this;
    }

    /**
     * Setter for asset Width
     * @param int $val
     * @return LicenseThumbnail
     */
    public function setWidth(int $val) : LicenseThumbnail
    {
        $this->width = $val;
        return $this;
    }

    /**
     * Setter for asset Height
     * @param int $val
     * @return LicenseThumbnail
     */
    public function setHeight(int $val) : LicenseThumbnail
    {
        $this->height = $val;
        return $this;
    }
}
