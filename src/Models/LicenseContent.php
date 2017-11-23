<?php

/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Models;

use \AdobeStock\Api\Models\LicensePurchaseDetails;
use \AdobeStock\Api\Models\LicenseComp;
use \AdobeStock\Api\Models\LicenseThumbnail;
use \AdobeStock\Api\Core\Constants as CoreConstants;
use \AdobeStock\Api\Exception\StockApi as StockApiException;

class LicenseContent
{
    /**
     * Asset's unique identifier.
     * @var string
     */
    public $content_id;
    
    /**
     * Information about the user's purchase/license of this asset.
     * @var LicensePuchaseDetails|null
     */
    public $purchase_details;
    
    /**
     * The size of the asset, indicating whether it is the free
     * complementary size or the original full-sized asset.
     * @var string
     */
    public $size;
    
    /**
     * Information about the complementary or watermarked asset.
     * @var LicenseComp|null
     */
    public $comp;
    
    /**
     * Information about the asset thumbnail.
     * @var LicenseThumbnail|null
     */
    public $thumbnail;
    
    /**
     * @param array $response
     */
    public function __construct(array $response)
    {
        foreach ($response as $key => $val) {
            if (property_exists($this, $key)) {
                if ($key == 'purchase_details') {
                    $this->purchase_details = new LicensePurchaseDetails($val);
                } else if ($key == 'comp') {
                    $this->comp = new LicenseComp($val);
                } else if ($key == 'thumbnail') {
                    $this->thumbnail = new LicenseThumbnail($val);
                } else {
                    $this->$key = $val;
                }
            }
        }
    }

    /**
     * Getter for ContentId
     * @return string
     */
    public function getContentId(): string
    {
        return $this->content_id;
    }

    /**
     * Getter for user's purchase/license details
     * @return LicensePurchaseDetails|null
     */
    public function getPurchaseDetails(): ?LicensePurchaseDetails
    {
        return $this->purchase_details;
    }

    /**
     * Getter for size of the asset, indicating whether it is the free
     * complementary size or the original full-sized asset.
     * @return string
     */
    public function getSize(): string
    {
        return $this->size;
    }

    /**
     * Get Information about the complementary or watermarked asset.
     * @return LicenseComp|null
     */
    public function getComp(): ?LicenseComp
    {
        return $this->comp;
    }

    /**
     * Get information about the asset thumbnail.
     * @return LicenseThumbnail|null
     */
    public function getThumbnail(): ?LicenseThumbnail
    {
        return $this->thumbnail;
    }

    /**
     * Setter for ContentId
     * @param string $val
     * @return LicenseContent
     */
    public function setContentId(string $val) : LicenseContent
    {
        $this->content_id = $val;
        return $this;
    }

    /**
     * Setter for user's purchase/license details
     * @param LicensePurchaseDetails $val
     * @return LicenseContent
     */
    public function setPurchaseDetails(LicensePurchaseDetails $val) : LicenseContent
    {
        $this->purchase_details = $val;
        return $this;
    }

    /**
     * Seter for size
     * @param string $val
     * @return LicenseContent
     */
    public function setSize(string $val) : LicenseContent
    {
        $size = CoreConstants::getAssetLicenseSize();
        
        if (array_key_exists($val, $size)) {
            $this->size = $size[$val];
        } else {
            throw StockApiException::withMessage('This Size doesn\'t exist');
        }
        
        return $this;
    }

    /**
     * Set Information about the complementary or watermarked asset.
     * @param LicenseComp $val
     * @return LicenseContent
     */
    public function setComp(LicenseComp $val) : LicenseContent
    {
        $this->comp = $val;
        return $this;
    }

    /**
     * Set information about the asset thumbnail.
     * @param LicenseThumbnail $val
     * @return LicenseContent
     */
    public function setThumbnail(LicenseThumbnail $val) : LicenseContent
    {
        $this->thumbnail = $val;
        return $this;
    }
}
