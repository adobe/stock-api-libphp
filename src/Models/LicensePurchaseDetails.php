<?php

/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Models;

use \AdobeStock\Api\Exception\StockApi as StockApiException;
use \AdobeStock\Api\Core\Constants as CoreConstants;

class LicensePurchaseDetails
{
    /**
     * Date when the asset was purchased or licensed.
     * @var string
     */
    public $date;
    
    /**
     * Date when the asset purchase/license was cancelled.
     * @var string
     */
    public $cancelled;
    
    /**
     * The URL from which the complementary asset can be downloaded.
     * @var string|null
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
     * Asset licensing state.
     * @var string
     */
    public $license;
    
    /**
     * Asset purchasing state.
     * @var string|null
     */
    public $state;

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
     * getter for License State
     * @return string
     */
    public function getLicense(): string
    {
        return $this->license;
    }

    /**
     * getter for AssestPurchaseState
     * @return string|null
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * Getter for string
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * Getter for cancelled date
     * @return string
     */
    public function getCancelled(): string
    {
        return $this->cancelled;
    }

    /**
     * Getter for URL
     * @return string|null
     */
    public function getUrl() : ?string
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
    public function getFrameRate(): float
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
     * Sets Date when the asset was purchased or licensed.
     * @param string $val
     * @throws StockApiException if date format is not valid
     * @return LicensePurchaseDetails
     */
    public function setDate(string $val) : LicensePurchaseDetails
    {
        $check_date_millisecond = \DateTime::createFromFormat('Y-m-d h:m:s.u', $val);
        $check_date_second = \DateTime::createFromFormat('Y-m-d h:m:s', $val);
        
        if ($check_date_millisecond != false) {
            $this->date = $val;
        } else if ($check_date_second != false) {
            $this->date = $val;
        } else {
            throw StockApiException::withMessage('Could not parse the date string');
        }
        
        return $this;
    }

    /**
     * Sets Date when the asset purchase/license was cancelled.
     * @param string $val
     * @throws StockApiException if date format is not valid
     * @return LicensePurchaseDetails
     */
    public function setCancelled(string $val) : LicensePurchaseDetails
    {
        $check_date_millisecond = \DateTime::createFromFormat('Y-m-d h:m:s.u', $val);
        $check_date_second = \DateTime::createFromFormat('Y-m-d h:m:s', $val);
        
        if ($check_date_millisecond != false) {
            $this->cancelled = $val;
        } else if ($check_date_second != false) {
            $this->cancelled = $val;
        } else {
            throw StockApiException::withMessage('Could not parse the date string');
        }
        
        return $this;
    }

    /**
     * Setter for Asset License State
     * @param string $license_state
     * @return LicensePurchaseDetails
     */
    public function setLicense(string $license_state) : LicensePurchaseDetails
    {
        $state = CoreConstants::getLicenseStateParams();
        
        if (array_key_exists($license_state, $state)) {
            $this->license = $state[$license_state];
        } else {
            throw StockApiException::withMessage('No such license state exists');
        }
        
        return $this;
    }

    /**
     * setter for AssestPurchaseState
     * @param string $purchase_state
     * @return LicensePurchaseDetails
     */
    public function setState(string $purchase_state) : LicensePurchaseDetails
    {
        $state_params = CoreConstants::getPurchaseStateParams();
        
        if (array_key_exists($purchase_state, $state_params)) {
            $this->state = $state_params[$purchase_state];
        } else {
            throw StockApiException::withMessage('No such purchase state exists');
        }
        
        return $this;
    }

    /**
     * Setter for URL
     * @param string $val
     * @return LicensePurchaseDetails
     */
    public function setUrl(string $val) : LicensePurchaseDetails
    {
        $this->url = $val;
        return $this;
    }

    /**
     * Setter for Content Type
     * @param string $val
     * @return LicensePurchaseDetails
     */
    public function setContentType(string $val) : LicensePurchaseDetails
    {
        $this->content_type = $val;
        return $this;
    }

    /**
     * Setter for width
     * @param int $val
     * @return LicensePurchaseDetails
     */
    public function setWidth(int $val) : LicensePurchaseDetails
    {
        $this->width = $val;
        return $this;
    }

    /**
     * Setter for frame rate
     * @param float $val
     * @return LicensePurchaseDetails
     */
    public function setFrameRate(float $val) : LicensePurchaseDetails
    {
        $this->frame_rate = $val;
        return $this;
    }

    /**
     * Setter for height
     * @param int $val
     * @return LicensePurchaseDetails
     */
    public function setHeight(int $val) : LicensePurchaseDetails
    {
        $this->height = $val;
        return $this;
    }

    /**
     * Setter for content length
     * @param int $val
     * @return LicensePurchaseDetails
     */
    public function setContentLength(int $val) : LicensePurchaseDetails
    {
        $this->content_length = $val;
        return $this;
    }

    /**
     * Setter for duration
     * @param int $val
     * @return LicensePurchaseDetails
     */
    public function setDuration(int $val) : LicensePurchaseDetails
    {
        $this->duration = $val;
        return $this;
    }
}
