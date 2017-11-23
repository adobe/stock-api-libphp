<?php

/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Models;

class LicenseComp
{
    /**
     * The URL from which the complementary asset can be downloaded.
     * @var string
     */
    public $url;
    
    /**
     * Type of the complementary asset.
     * @var string
     */
    public $content_type;
    
    /**
     * Width of complementary asset in pixels.
     * @var int
     */
    public $width;
    
    /**
     * Height of complementary asset in pixels.
     * @var int
     */
    public $height;
    
    /**
     * Frame rate for video.
     * @var float
     */
    public $frame_rate;
    
    /**
     * Size of complementary asset file in bytes.
     * @var int
     */
    public $content_length;
    
    /**
     * Duration of video in milliseconds.
     * @var int
     */
    public $duration;
    
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
     * Getter for URL
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Getter for Content Type
     * @return string
     */
    public function getContentType(): string
    {
        return $this->content_type;
    }

    /**
     * Getter for width
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * Getter for frame rate
     * @return float
     */
    public function getFrameRate() : float
    {
        return $this->frame_rate;
    }

    /**
     * Getter for height
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * Getter for content length
     * @return int
     */
    public function getContentLength(): int
    {
        return $this->content_length;
    }

    /**
     * Getter for duration
     * @return int
     */
    public function getDuration(): int
    {
        return $this->duration;
    }

    /**
     * Setter for URL
     * @param string $val
     * @return LicenseComp
     */
    public function setUrl(string $val) : LicenseComp
    {
        $this->url = $val;
        return $this;
    }

    /**
     * Setter for Content Type
     * @param string $val
     * @return LicenseComp
     */
    public function setContentType(string $val) : LicenseComp
    {
        $this->content_type = $val;
        return $this;
    }

    /**
     * Setter for width
     * @param int $val
     * @return LicenseComp
     */
    public function setWidth(int $val) : LicenseComp
    {
        $this->width = $val;
        return $this;
    }

    /**
     * Setter for frame rate
     * @param float $val
     * @return LicenseComp
     */
    public function setFrameRate(float $val) : LicenseComp
    {
        $this->frame_rate = $val;
        return $this;
    }

    /**
     * Setter for height
     * @param int $val
     * @return LicenseComp
     */
    public function setHeight(int $val) : LicenseComp
    {
        $this->height = $val;
        return $this;
    }

    /**
     * Setter for content length
     * @param int $val
     * @return LicenseComp
     */
    public function setContentLength(int $val) : LicenseComp
    {
        $this->content_length = $val;
        return $this;
    }

    /**
     * Setter for duration
     * @param int $val
     * @return LicenseComp
     */
    public function setDuration(int $val) : LicenseComp
    {
        $this->duration = $val;
        return $this;
    }
}
