<?php
/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Models;

class StockFileLicenseHistory
{
    /**
     * License State
     * @var string
     */
    public $license;
    
    /**
     * License Date
     * @var string
     */
    public $license_date;
    
    /**
     * Download url of asset
     * @var string
     */
    public $download_url;
    
    /**
     * Media unique ID.
     * @var int id
     */
    public $id;
    
    /**
     * Media title.
     * @var string title
     */
    public $title;
    
    /**
     * Media creator unique id.
     * @var int creator_id
     */
    public $creator_id;
    
    /**
     * Media creator name.
     * @var string creator_name
     */
    public $creator_name;
    
    /**
     * If the file is a vector indicates if its a "svg" or a ai/eps (reported as
     * "zip").
     * @var string vector_type
     */
    public $vector_type;
    
    /**
     * Mime type of the asset's content.
     * @var string content_type
     */
    public $content_type;
    
    /**
     * Media Type Id.
     * @var int media_type_id
     */
    public $media_type_id;
    
    /**
     * Original width of the file in pixels.
     * @var int width
     */
    public $width;
    
    /**
     * Original height of the file in pixels.
     * @var int height
     */
    public $height;
    
    /**
     * Url of content
     * @var string
     */
    public $content_url;
    
    /**
     * Url to stock details page for the asset.
     * @var string details_url
     */
    public $details_url;
    
    /**
     * URL for the default-sized asset thumbnail.
     * @var string thumbnail_url
     */
    public $thumbnail_url;
    
    /**
     * Media thumbnail width in pixels.
     * @var int thumbnail_width
     */
    public $thumbnail_width;
    
    /**
     * Media thumbnail height in pixels.
     * @var int thumbnail_height
     */
    public $thumbnail_height;
    
    /**
     * Url for 110px thumbnail.
     * @var string thumbnail_110_url
     */
    public $thumbnail_110_url;
    
    /**
     * Width for 110px thumbnail.
     * @var float thumbnail_110_width
     */
    public $thumbnail_110_width;
    
    /**
     * Height for 110px thumbnail.
     * @var int thumbnail_110_height
     */
    public $thumbnail_110_height;
    
    /**
     * Url for 160px thumbnail.
     * @var string thumbnail_160_url
     */
    public $thumbnail_160_url;
    
    /**
     * Width for 160px thumbnail.
     * @var float thumbnail_160_width
     */
    public $thumbnail_160_width;
    
    /**
     * Height for 160px thumbnail.
     * @var int thumbnail_160_height
     */
    public $thumbnail_160_height;
    
    /**
     * Url for 220px thumbnail.
     * @var string thumbnail_220_url
     */
    public $thumbnail_220_url;
    
    /**
     * Width for 220px thumbnail.
     * @var float thumbnail_220_width
     */
    public $thumbnail_220_width;
    
    /**
     * Height for 220px thumbnail.
     * @var int thumbnail_220_height
     */
    public $thumbnail_220_height;
    
    /**
     * Url for 240px thumbnail.
     * @var string thumbnail_240_url
     */
    public $thumbnail_240_url;
    
    /**
     * Width for 240px thumbnail.
     * @var float thumbnail_240_width
     */
    public $thumbnail_240_width;
    
    /**
     * Height for 240px thumbnail.
     * @var int thumbnail_240_height
     */
    public $thumbnail_240_height;
    
    /**
     * Url for 500px thumbnail.
     * @var string thumbnail_500_url
     */
    public $thumbnail_500_url;
    
    /**
     * Width for 500px thumbnail.
     * @var float thumbnail_500_Width
     */
    public $thumbnail_500_width;
    
    /**
     * Height for 500px thumbnail.
     * @var int thumbnail_500_height
     */
    public $thumbnail_500_height;
    
    /**
     * Url for 1000px thumbnail.
     * @var string thumbnail_1000_url
     */
    public $thumbnail_1000_url;
    
    /**
     * Width for 1000px thumbnail.
     * @var float thumbnail_1000_width
     */
    public $thumbnail_1000_width;
    
    /**
     * Height for 1000px thumbnail.
     * @var int thumbnail_1000_height
     */
    public $thumbnail_1000_height;
    
    /**
     * Default Constructor.
     * @param array $raw_response
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
     * Get license.
     * @return string|null
     */
    public function getLicense() : ?string
    {
        return $this->license;
    }
    
    /**
     * Get license date.
     * @return string|null
     */
    public function getLicenseDate() : ?string
    {
        return $this->license_date;
    }
    
    /**
     * Get download url.
     * @return string|null
     */
    public function getDownloadUrl() : ?string
    {
        return $this->download_url;
    }
    
    /**
     * Get content url.
     * @return string|null
     */
    public function getContentUrl() : ?string
    {
        return $this->content_url;
    }
    
    /**
     * Get media unique ID.
     * @return int|null
     */
    public function getId() : ?int
    {
        return $this->id;
    }
    
    /**
     * Get media title (used for title tag).
     * @return string|null
     */
    public function getTitle() : ?string
    {
        return $this->title;
    }
    
    /**
     * Get media creator unique id.
     * @return int|null
     */
    public function getCreatorId() : ?int
    {
        return $this->creator_id;
    }
    
    /**
     * Get media creator name.
     * @return string|null
     */
    public function getCreatorName() : ?string
    {
        return $this->creator_name;
    }
    
    /**
     * If the asset is a vector, this returns whether it is an
     * SVG or an AI/EPS (zip) asset.
     * @return string|null
     */
    public function getVectorType() : ?string
    {
        return $this->vector_type;
    }
    
    /**
     * Get URL for the default-sized asset thumbnail.
     * @return string|null
     */
    public function getThumbnailUrl() : ?string
    {
        return $this->thumbnail_url;
    }
    
    /**
     * Get media thumbnail width in pixels.
     * @return int|null
     */
    public function getThumbnailWidth() : ?int
    {
        return $this->thumbnail_width;
    }
    /**
     * Get media thumbnail height in pixels.
     * @return int|null
     */
    public function getThumbnailHeight() : ?int
    {
        return $this->thumbnail_height;
    }
    
    /**
     * Get url for 110px thumbnail.
     * @return string|null
     */
    public function getThumbnail110Url() : ?string
    {
        return $this->thumbnail_110_url;
    }
    
    /**
     * Get width for 110px thumbnail.
     * @return float|null
     */
    public function getThumbnail110Width() : ?float
    {
        return $this->thumbnail_110_width;
    }
    
    /**
     * Get height for 110px thumbnail.
     * @return int|null
     */
    public function getThumbnail110Height() : ?int
    {
        return $this->thumbnail_110_height;
    }
    
    /**
     * Get url for 160px thumbnail.
     * @return string|null
     */
    public function getThumbnail160Url() : ?string
    {
        return $this->thumbnail_160_url;
    }
    
    /**
     * Get width for 160px thumbnail.
     * @return float|null
     */
    public function getThumbnail160Width() : ?float
    {
        return $this->thumbnail_160_width;
    }
    
    /**
     * Get height for 160px thumbnail.
     * @return int|null
     */
    public function getThumbnail160Height() : ?int
    {
        return $this->thumbnail_160_height;
    }
    
    /**
     * Get url for 20px thumbnail.
     * @return string|null
     */
    public function getThumbnail220Url() : ?string
    {
        return $this->thumbnail_220_url;
    }
    
    /**
     * Get width for 20px thumbnail.
     * @return float|null
     */
    public function getThumbnail220Width() : ?float
    {
        return $this->thumbnail_220_width;
    }
    
    /**
     * Get height for 220px thumbnail.
     * @return int|null
     */
    public function getThumbnail220Height() : ?int
    {
        return $this->thumbnail_220_height;
    }
    
    /**
     * Get url for 240px thumbnail.
     * @return string|null
     */
    public function getThumbnail240Url() : ?string
    {
        return $this->thumbnail_240_url;
    }
    
    /**
     * Get width for 240px thumbnail.
     * @return float|null
     */
    public function getThumbnail240Width() : ?float
    {
        return $this->thumbnail_240_width;
    }
    
    /**
     * Get height for 240px thumbnail.
     * @return int|null
     */
    public function getThumbnail240Height() : ?int
    {
        return $this->thumbnail_240_height;
    }
    
    /**
     * Get url for 500px thumbnail.
     * @return string|null
     */
    public function getThumbnail500Url() : ?string
    {
        return $this->thumbnail_500_url;
    }
    
    /**
     * Get width for 500px thumbnail.
     * @return float|null
     */
    public function getThumbnail500Width() : ?float
    {
        return $this->thumbnail_500_width;
    }
    
    /**
     * Get height for 500px thumbnail.
     * @return int|null
     */
    public function getThumbnail500Height() : ?int
    {
        return $this->thumbnail_500_height;
    }
    
    /**
     * Get url for 1000px thumbnail.
     * @return string|null
     */
    public function getThumbnail1000Url() : ?string
    {
        return $this->thumbnail_1000_url;
    }
    
    /**
     * Get width for 1000px thumbnail.
     * @return float|null
     */
    public function getThumbnail1000Width() : ?float
    {
        return $this->thumbnail_1000_width;
    }
    
    /**
     * Get height for 1000px thumbnail.
     * @return int|null
     */
    public function getThumbnail1000Height() : ?int
    {
        return $this->thumbnail_1000_height;
    }
    
    /**
     * Get Media Type Id.
     * @return int|null
     */
    public function getMediaTypeId() : ?int
    {
        return $this->media_type_id;
    }
    
    /**
     * Get original width of the file in pixels.
     * @return int|null
     */
    public function getWidth() : ?int
    {
        return $this->width;
    }
    
    /**
     * Get original height of the file in pixels.
     * @return int|null
     */
    public function getHeight() : ?int
    {
        return $this->height;
    }
    
    /**
     * Get mime type of the asset's content.
     * @return string|null
     */
    public function getContentType() : ?string
    {
        return $this->content_type;
    }
    
    /**
     * Get url of stock details page for the asset.
     * @return string|null
     */
    public function getDetailsUrl() : ?string
    {
        return $this->details_url;
    }
    
    /**
     * Set license.
     * @param string $license
     * @return StockFileLicenseHistory
     */
    public function setLicense(string $license) : StockFileLicenseHistory
    {
        $this->license = $license;
        return $this;
    }
    
    /**
     * Set license date.
     * @param string $license_date
     * @return StockFileLicenseHistory
     */
    public function setLicenseDate(string $license_date) : StockFileLicenseHistory
    {
        $this->license_date = $license_date;
        return $this;
    }
    
    /**
     * Set download url.
     * @param string $url
     * @return StockFileLicenseHistory
     */
    public function setDownloadUrl(string $url) : StockFileLicenseHistory
    {
        $this->download_url = $url;
        return $this;
    }
    
    /**
     * Sets media unique ID.
     * @param int $id media unique ID
     * @return StockFileLicenseHistory
     */
    public function setId(int $id) : StockFileLicenseHistory
    {
        $this->id = $id;
        return $this;
    }
    
    /**
     * Sets media title.
     * @param string $title media title
     * @return StockFileLicenseHistory
     */
    public function setTitle(string $title) : StockFileLicenseHistory
    {
        $this->title = $title;
        return $this;
    }
    
    /**
     * Sets media creator unique id.
     * @param int $creator_id media creator unique id
     * @return StockFileLicenseHistory
     */
    public function setCreatorId(int $creator_id) : StockFileLicenseHistory
    {
        $this->creator_id = $creator_id;
        return $this;
    }
    
    /**
     * Sets media creator name.
     * @param string $creator_name media creator name
     * @return StockFileLicenseHistory
     */
    public function setCreatorName(string $creator_name) : StockFileLicenseHistory
    {
        $this->creator_name = $creator_name;
        return $this;
    }
    
    /**
     * Sets URL for the default-sized asset thumbnail.
     * @param string $thumbnail_url media thumbnail url
     * @return StockFileLicenseHistory
     */
    public function setThumbnailUrl(string $thumbnail_url) : StockFileLicenseHistory
    {
        $this->thumbnail_url = $thumbnail_url;
        return $this;
    }
    
    /**
     * Sets media thumbnail width in pixels.
     * @param int $thumbnail_width media thumbnail width in pixels
     * @return StockFileLicenseHistory
     */
    public function setThumbnailWidth(int $thumbnail_width) : StockFileLicenseHistory
    {
        $this->thumbnail_width = $thumbnail_width;
        return $this;
    }
    
    /**
     * Sets media thumbnail height in pixels.
     * @param int $thumbnail_height Height media thumbnail height in pixels
     * @return StockFileLicenseHistory
     */
    public function setThumbnailHeight(int $thumbnail_height) : StockFileLicenseHistory
    {
        $this->thumbnail_height = $thumbnail_height;
        return $this;
    }
    
    /**
     * Sets url for 110px thumbnail.
     * @param string $thumbnail_110_url url for 110px thumbnail
     * @return StockFileLicenseHistory
     */
    public function setThumbnail110Url(string $thumbnail_110_url) : StockFileLicenseHistory
    {
        $this->thumbnail_110_url = $thumbnail_110_url;
        return $this;
    }
    
    /**
     * Sets width for 110px thumbnail.
     * @param float $thumbnail_110_width width for 110px thumbnail
     * @return StockFileLicenseHistory
     */
    public function setThumbnail110Width(float $thumbnail_110_width) : StockFileLicenseHistory
    {
        $this->thumbnail_110_width = $thumbnail_110_width;
        return $this;
    }
    
    /**
     * Sets height for 110px thumbnail.
     * @param int $thumbnail_110_height height for 110px thumbnail
     * @return StockFileLicenseHistory
     */
    public function setThumbnail110Height(int $thumbnail_110_height) : StockFileLicenseHistory
    {
        $this->thumbnail_110_height = $thumbnail_110_height;
        return $this;
    }
    
    /**
     * Sets url for 160px thumbnail.
     * @param string $thumbnail_160_url url for 160px thumbnail
     * @return StockFileLicenseHistory
     */
    public function setThumbnail160Url(string $thumbnail_160_url) : StockFileLicenseHistory
    {
        $this->thumbnail_160_url = $thumbnail_160_url;
        return $this;
    }
    
    /**
     * Sets width for 160px thumbnail.
     * @param float $thumbnail_160_width width for 160px thumbnail
     * @return StockFileLicenseHistory
     */
    public function setThumbnail160Width(float $thumbnail_160_width) : StockFileLicenseHistory
    {
        $this->thumbnail_160_width = $thumbnail_160_width;
        return $this;
    }
    
    /**
     * Sets height for 160px thumbnail.
     * @param int $thumbnail_160_height height for 160px thumbnail
     * @return StockFileLicenseHistory
     */
    public function setThumbnail160Height(int $thumbnail_160_height) : StockFileLicenseHistory
    {
        $this->thumbnail_160_height = $thumbnail_160_height;
        return $this;
    }
    
    /**
     * Sets url for 20px thumbnail.
     * @param string $thumbnail_220_url url for 220px thumbnail
     * @return StockFileLicenseHistory
     */
    public function setThumbnail220Url(string $thumbnail_220_url) : StockFileLicenseHistory
    {
        $this->thumbnail_220_url = $thumbnail_220_url;
        return $this;
    }
    
    /**
     * Sets width for 220px thumbnail.
     * @param float $thumbnail_220_width width for 220px thumbnail
     * @return StockFileLicenseHistory
     */
    public function setThumbnail220Width(float $thumbnail_220_width) : StockFileLicenseHistory
    {
        $this->thumbnail_220_width = $thumbnail_220_width;
        return $this;
    }
    
    /**
     * Sets height for 220px thumbnail.
     * @param int $thumbnail_220_height height for 220px thumbnail
     * @return StockFileLicenseHistory
     */
    public function setThumbnail220Height(int $thumbnail_220_height) : StockFileLicenseHistory
    {
        $this->thumbnail_220_height = $thumbnail_220_height;
        return $this;
    }
    
    /**
     * Sets url for 240px thumbnail.
     * @param string $thumbnail_240_url url for 240px thumbnail
     * @return StockFileLicenseHistory
     */
    public function setThumbnail240Url(string $thumbnail_240_url) : StockFileLicenseHistory
    {
        $this->thumbnail_240_url = $thumbnail_240_url;
        return $this;
    }
    
    /**
     * Sets width for 240px thumbnail.
     * @param float $thumbnail_240_width width for 240px thumbnail
     * @return StockFileLicenseHistory
     */
    public function setThumbnail240Width(float $thumbnail_240_width) : StockFileLicenseHistory
    {
        $this->thumbnail_240_width = $thumbnail_240_width;
        return $this;
    }
    
    /**
     * Sets height for 240px thumbnail.
     * @param int $thumbnail_240_height height for 240px thumbnail
     * @return StockFileLicenseHistory
     */
    public function setThumbnail240Height(int $thumbnail_240_height) : StockFileLicenseHistory
    {
        $this->thumbnail_240_height = $thumbnail_240_height;
        return $this;
    }
    
    /**
     * Sets url for 500px thumbnail.
     * @param string $thumbnail_500_url url for 500px thumbnail
     * @return StockFileLicenseHistory
     */
    public function setThumbnail500Url(string $thumbnail_500_url) : StockFileLicenseHistory
    {
        $this->thumbnail_500_url = $thumbnail_500_url;
        return $this;
    }
    
    /**
     * Sets width for 500px thumbnail.
     * @param float $thumbnail_500_width width for 500px thumbnail
     * @return StockFileLicenseHistory
     */
    public function setThumbnail500Width(float $thumbnail_500_width) : StockFileLicenseHistory
    {
        $this->thumbnail_500_width = $thumbnail_500_width;
        return $this;
    }
    
    /**
     * Sets height for 500px thumbnail.
     * @param int $thumbnail_500_height height for 500px thumbnail
     * @return StockFileLicenseHistory
     */
    public function setThumbnail500Height(int $thumbnail_500_height) : StockFileLicenseHistory
    {
        $this->thumbnail_500_height = $thumbnail_500_height;
        return $this;
    }
    
    /**
     * Sets url for 1000px thumbnail.
     * @param string $thumbnail_1000_url url for 1000px thumbnail
     * @return StockFileLicenseHistory
     */
    public function setThumbnail1000Url(string $thumbnail_1000_url) : StockFileLicenseHistory
    {
        $this->thumbnail_1000_url = $thumbnail_1000_url;
        return $this;
    }
    
    /**
     * Sets width for 1000px thumbnail.
     * @param float $thumbnail_1000_width width for 1000px thumbnail
     * @return StockFileLicenseHistory
     */
    public function setThumbnail1000Width(float $thumbnail_1000_width) : StockFileLicenseHistory
    {
        $this->thumbnail_1000_width = $thumbnail_1000_width;
        return $this;
    }
    
    /**
     * Sets height for 1000px thumbnail.
     * @param int $thumbnail_1000_height height for 1000px thumbnail
     * @return StockFileLicenseHistory
     */
    public function setThumbnail1000Height(int $thumbnail_1000_height) : StockFileLicenseHistory
    {
        $this->thumbnail_1000_height = $thumbnail_1000_height;
        return $this;
    }
    
    /**
     * Sets Media Type Id.
     * @param int $media_type_id Media Type Id
     * @return StockFileLicenseHistory
     */
    public function setMediaTypeId(int $media_type_id) : StockFileLicenseHistory
    {
        $this->media_type_id = $media_type_id;
        return $this;
    }
    
    /**
     * Sets original width of the file in pixels.
     * @param int $width original width of the file
     * @return StockFileLicenseHistory
     */
    public function setWidth(int $width) : StockFileLicenseHistory
    {
        $this->width = $width;
        return $this;
    }
    
    /**
     * Sets original height of the file in pixels.
     * @param int $height original height of the file
     * @return StockFileLicenseHistory
     */
    public function setHeight(int $height) : StockFileLicenseHistory
    {
        $this->height = $height;
        return $this;
    }
    
    /**
     * If the asset is a vector, sets whether it is an SVG or an AI/EPS asset.
     * @param string $vector_type file vector type
     * @return StockFileLicenseHistory
     */
    public function setVectorType(string $vector_type) : StockFileLicenseHistory
    {
        $this->vector_type = $vector_type;
        return $this;
    }
    
    /**
     * Sets mime type of the asset's content.
     * @param string $content_type mime type of the asset's content
     * @return StockFileLicenseHistory
     */
    public function setContentType(string $content_type) : StockFileLicenseHistory
    {
        $this->content_type = $content_type;
        return $this;
    }
    
    /**
     * Set content url
     * @param string $url
     * @return StockFileLicenseHistory
     */
    public function setContentUrl(string $url) : StockFileLicenseHistory
    {
        $this->content_url = $url;
        return $this;
    }
    
    /**
     * Sets url of stock details page for the asset.
     * @param string $details_url url of stock details page for the asset
     * @return StockFileLicenseHistory
     */
    public function setDetailsUrl(string $details_url) : StockFileLicenseHistory
    {
        $this->details_url = $details_url;
        return $this;
    }
}
