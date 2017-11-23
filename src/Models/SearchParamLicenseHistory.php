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

class SearchParamLicenseHistory
{
    /**
     * Minimum number of assets that can be returned
     * in search results.
     * @var int
     */
    const MIN_LIMIT = 1;
    
    /**
     * Maximum number of assets in result.
     * @var int
     */
    public $limit;
    
    /**
     * Start position(index) in search results.
     * @var int
     */
    public $offset;
    
    /**
     * Valid values - 110,160,220,240,500,1000
     * @var int
     */
    public $thumbnail_size;
    
    /**
     * Get maximum number of assets that return in the api call.
     * @return int|null limit
     */
    public function getLimit() : ?int
    {
        return $this->limit;
    }
    
    /**
     * Sets maximum number of assets in search Params that you wants to return
     * in the api call.
     * @param int $limit maximum number of assets that return in the api call
     * @return SearchParamLicenseHistory object
     * @throws StockApiException if limit is less than 1
     */
    public function setLimit(int $limit) : SearchParamLicenseHistory
    {
        if ($limit < static::MIN_LIMIT) {
            throw StockApiException::WithMessage('Limit should be greater than 0');
        }
        
        $this->limit = $limit;
        return $this;
    }
    
    /**
     * Get start position(index) in search results.
     * @return int|null offset of type function
     */
    public function getOffset() : ?int
    {
        return $this->offset;
    }
    
    /**
     * Sets the start position(index) in search results.
     * @param int $offset starting index in the search results
     * @return SearchParamLicenseHistory object
     * @throws StockApiException if offset is not positive
     */
    public function setOffset(int $offset) : SearchParamLicenseHistory
    {
        if ($offset < 0) {
            throw StockApiException::WithMessage('Offset should be greater than 0');
        }
        
        $this->offset = $offset;
        return $this;
    }
    
    /**
     * Get Thumbnail Size in search results.
     * @return int|null
     */
    public function getThumbnailSize() : ?int
    {
        return $this->thumbnail_size;
    }
    
    /**
     * Sets the thumbnail size in search results.
     * @param int $thumbnail_size
     * @return SearchParamLicenseHistory object
     * @throws StockApiException if Invalid thumbnail size
     */
    public function setThumbnailSize(int $thumbnail_size) : SearchParamLicenseHistory
    {
        $size = CoreConstants::getSearchParamsLicenseThumbSizes();
        
        if (array_key_exists($thumbnail_size, $size)) {
            $this->thumbnail_size = $size[$thumbnail_size];
        } else {
            throw StockApiException::WithMessage('Invalid Thumbnail size');
        }
        
        return $this;
    }
}
