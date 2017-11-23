<?php
/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */
namespace AdobeStock\Api\Models;

use \AdobeStock\Api\Response\SearchCategory as SearchCategoryResponse;
use \AdobeStock\Api\Core\Constants as CoreConstants;

class StockFile
{
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
     * Media creation date.
     * @var string creation_date
     */
    public $creation_date;
    
    /**
     * Media creator country name.
     * @var string country_name
     */
    public $country_name;
    
    /**
     * URL for the default-sized asset thumbnail.
     * @var string thumbnail_url
     */
    public $thumbnail_url;
    
    /**
     * HTML <img> tag that you can use to display the default asset thumbnail.
     * @var string thumbnail_html_tag
     */
    public $thumbnail_html_tag;
    
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
     * Licensing state for the asset.
     * Special: Value assigned from Constants::$_licenseStateParams.
     * @var string is_licensed
     */
    public $is_licensed;
    
    /**
     * URL to the watermarked version of the asset.
     * @var string comp_url
     */
    public $comp_url;
    
    /**
     * Width in pixels of the asset's complementary (unlicensed) image.
     * @var int comp_width
     */
    public $comp_width;
    
    /**
     * Height in pixels of the asset's complementary (unlicensed) image.
     * @var int comp_height
     */
    public $comp_height;
    
    /**
     * Total views of the asset by all users.
     * @var int nb_views
     */
    public $nb_views;
    
    /**
     * Total downloads of the asset by all users.
     * @var int nb_downloads
     */
    public $nb_downloads;
    
    /**
     * Category of the media.
     * @var SearchCategoryResponse category
     */
    public $category;
    
    /**
     * List of localised keywords for the file.
     * It is Array of StockFileKeyword Objects.
     * @var array keywords
     */
    public $keywords;
    
    /**
     * Checks if content has any release IDs.
     * @var bool has_releases
     */
    public $has_releases;
    
    /**
     * Type of the asset.
     * Special: Value is assigned from Constants::$_assetType.
     * @var int asset_type_id
     */
    public $asset_type_id;
    
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
     * Frame rate for video.
     * @var float frame_rate
     */
    public $framerate;
    
    /**
     * Duration of video in milliseconds.
     * @var int duration
     */
    public $duration;
    
    /**
     * Stock identifier.
     * @var string stock_id
     */
    public $stock_id;
    
    /**
     * Contains properties for complementary assets.
     * @var StockFileComps comps
     */
    public $comps;
    
    /**
     * Url to stock details page for the asset.
     * @var string details_url
     */
    public $details_url;
    
    /**
     * (templates only) Id of the template.
     * Valus is assigned from Constants::$_searchParamsTemplateTypes.
     * @var int template_type_id
     */
    public $template_type_id;
    
    /**
     * (templates only) ArrayList of template category ids.
     * Value is assigned from Constant::$_searchParamsTemplateCategories.
     * @var array template_category_ids
     */
    public $template_category_ids;
    
    /**
     * (templates only) Marketing text for template.
     * @var string marketing_text
     */
    public $marketing_text;
    
    /**
     * (templates only) Description text for template.
     * @var string description
     */
    public $description;
    
    /**
     * (templates only) Size of the template file in bytes.
     * @var int size_bytes
     */
    public $size_bytes;
    
    /**
     * Identifies the asset premium(pricing) level.
     * Value is assigned from Constant::$_assetPremiumLevel.
     * @var int premium_level_id
     */
    public $premium_level_id;
    
    /**
     * True for premium assets (where premium_level_id > 1), false for standard.
     * assets.
     * @var bool is_premium
     */
    public $is_premium;
    
    /**
     * Contains available licenses for the media.
     * @var StockFileLicenses licenses
     */
    public $licenses;
    
    /**
     * (videos only) URL for the regular preview.
     * @var string video_preview_url
     */
    public $video_preview_url;
    
    /**
     * (videos only) Height of the regular preview in pixels.
     * @var int VideoPreviewHeight
     */
    public $VideoPreviewHeight;
    
    /**
     * (videos only) Width of the regular preview in pixels.
     * @var int video_preview_width
     */
    public $video_preview_width;
    
    /**
     * (videos only) File size of the regular preview in bytes.
     * @var int video_preview_content_length
     */
    public $video_preview_content_length;
    
    /**
     * (videos only) Content type (i.e. MIME type) of the regular preview.
     * @var string video_preview_content_type
     */
    public $video_preview_content_type;
    
    /**
     * (videos only) URL for the small preview.
     * @var string video_small_preview_url
     */
    public $video_small_preview_url;
    
    /**
     * (videos only) Height of the small preview in pixels.
     * @var int video_small_preview_height
     */
    public $video_small_preview_height;
    
    /**
     * (videos only) Width of the small preview in pixels.
     * @var int video_small_preview_width
     */
    public $video_small_preview_width;
    
    /**
     * (videos only) File size of the small preview in bytes.
     * @var int video_small_preview_content_length
     */
    public $video_small_preview_content_length;
    
    /**
     * (videos only) Content type (i.e. MIME type) of the small preview.
     * @var string video_small_preview_content_type
     */
    public $video_small_preview_content_type;
    
    /**
     * Default Constructor.
     * @param array $raw_response
     */
    public function __construct(array $raw_response)
    {
        foreach ($raw_response as $key => $val) {
            
            if (property_exists($this, $key)) {
                
                if (is_array($val)) {
                    
                    if ($key == 'category') {
                        $this->$key = new SearchCategoryResponse($val);
                        
                    } else if ($key == 'keywords') {
                        $result = [];
                        
                        foreach ($val as $element) {
                            $result[] = new StockFileKeyword($element);
                        }
                        
                        $this->$key = $result;
                        
                    } else if ($key == 'comps') {
                        $this->$key = new StockFileComps($val);
                        
                    } else if ($key == 'licenses') {
                        $this->$key = new StockFileLicenses($val);
                    }
                } else if ($key == 'creation_date') {
                    $date = new \DateTime($val);
                    $this->$key = $date->format('Y-m-d H:i:s');
                    
                } else {
                    $this->$key = $val;
                }
                
            }
        }
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
     * Get media creation date.
     * @return string|null
     */
    public function getCreationDate() : ?string
    {
        return $this->creation_date;
    }
    
    /**
     * Get media creator country name.
     * @return string|null
     */
    public function getCountryName() : ?string
    {
        return $this->country_name;
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
     * Get HTML &lt;img&gt; tag that you can use to display the
     * default asset thumbnail.
     * @return string|null
     */
    public function getThumbnailHtmlTag() : ?string
    {
        return $this->thumbnail_html_tag;
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
    
    
    /** Get licensing state for the asset.
     * @return string|null
     */
    public function getIsLicensed() : ?string
    {
        return $this->is_licensed;
    }
    
    /**
     * Get URL to the watermarked version of the asset.
     * @return string|null
     */
    public function getCompUrl() : ?string
    {
        return $this->comp_url;
    }
    
    /**
     * Get width in pixels of the asset's complementary (unlicensed) image.
     * @return int|null
     */
    public function getCompWidth() : ?int
    {
        return $this->comp_width;
    }
    
    /**
     * Get height in pixels of the asset's complementary (unlicensed) image.
     * @return int|null
     */
    public function getCompHeight() : ?int
    {
        return $this->comp_height;
    }
    
    /**
     * Get total views of the asset by all users.
     * @return int|null
     */
    public function getNbViews() : ?int
    {
        return $this->nb_views;
    }
    
    /**
     * Get total downloads of the asset by all users.
     * @return int|null
     */
    public function getNbDownloads() : ?int
    {
        return $this->nb_downloads;
    }
    
    /**
     * Get category of the media.
     * @return SearchCategoryResponse|null
     */
    public function getCategory() : ?SearchCategoryResponse
    {
        return $this->category;
    }
    
    /**
     * Get list of localised keywords for the file.
     * @return array|null
     */
    public function getKeywords() : ?array
    {
        return $this->keywords;
    }
    
    /**
     * Get hasReleases value
     * @return bool|null
     */
    public function getHasReleases() : ?bool
    {
        return $this->has_releases;
    }
    
    /**
     * Get type of the asset.
     * @return int|null
     */
    public function getAssetTypeId() : ?int
    {
        return $this->asset_type_id;
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
     * Get mime type of the asset's content.
     * @return string|null
     */
    public function getContentType() : ?string
    {
        return $this->content_type;
    }
    
    /**
     * Get frame rate for video.
     * @return float|null
     */
    public function getFrameRate() : ?float
    {
        return $this->framerate;
    }
    
    /**
     * Get duration of video in milliseconds.
     * @return int|null
     */
    public function getDuration() : ?int
    {
        return $this->duration;
    }
    
    /**
     * Get stock identifier.
     * @return string|null
     */
    public function getStockId() : ?string
    {
        return $this->stock_id;
    }
    
    /**
     * Get properties for complementary assets.
     * @return StockFileComps|null
     */
    public function getComps() : ?StockFileComps
    {
        return $this->comps;
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
     * Get id of the template type if the returned asset is a template.
     * @return int|null
     */
    public function getTemplateTypeId() : ?int
    {
        return $this->template_type_id;
    }
    
    /**
     * Get array of template category ids if the returned asset is a template.
     *
     * @return array|null
     */
    public function getTemplateCategoryIds() : ?array
    {
        return $this->template_category_ids;
    }
    
    /**
     * Get marketing text if the returned asset is a template.
     * @return string|null
     */
    public function getMarketingText() : ?string
    {
        return $this->marketing_text;
    }
    
    /**
     * Get description text if the returned asset is a template.
     * @return string|null
     */
    public function getDescription() : ?string
    {
        return $this->description;
    }
    
    /**
     * Get size of the template file in bytes if the
     *  returned asset is a template.
     * @return int|null
     */
    public function getSizeBytes() : ?int
    {
        return $this->size_bytes;
    }
    
    /**
     * Get premium level id.
     * @return int|null
     */
    public function getPremiumLevelId() : ?int
    {
        return $this->premium_level_id;
    }
    
    /**
     * Checks if premium asset.
     * @return bool|null
     */
    public function getIsPremium() : ?bool
    {
        return $this->is_premium;
    }
    
    /**
     * Get available licenses for the media.
     * @return StockFileLicenses|null
     */
    public function getLicenses() : ?StockFileLicenses
    {
        return $this->licenses;
    }
    
    /**
     * Get url for the video preview.
     * @return string|null
     */
    public function getVideoPreviewUrl() : ?string
    {
        return $this->video_preview_url;
    }
    
    /**
     * Get height for the video preview in pixels.
     * @return int|null
     */
    public function getVideoPreviewHeight() : ?int
    {
        return $this->video_preview_height;
    }
    
    /**
     * Get width for the video preview in pixels.
     * @return int|null
     */
    public function getVideoPreviewWidth() : ?int
    {
        return $this->video_preview_width;
    }
    
    /**
     * Get file size of video preview in bytes.
     * @return int|null
     */
    public function getVideoPreviewContentLength() : ?int
    {
        return $this->video_preview_content_length;
    }
    
    /**
     * Get content type of video preview.
     * @return string|null
     */
    public function getVideoPreviewContentType() : ?string
    {
        return $this->video_preview_content_type;
    }
    
    /**
     * Get url of the small video preview.
     * @return string|null
     */
    public function getVideoSmallPreviewUrl() : ?string
    {
        return $this->video_small_preview_url;
    }
    
    /**
     * Get height of the small video preview in pixels.
     *
     * @return int|null
     */
    public function getVideoSmallPreviewHeight() : ?int
    {
        return $this->video_small_preview_height;
    }
    
    /**
     * Get width of the small video preview in pixels.
     * @return int|null
     */
    public function getVideoSmallPreviewWidth() : ?int
    {
        return $this->video_small_preview_width;
    }
    
    /**
     * Get file size of the small video preview in bytes.
     * @return int|null
     */
    public function getVideoSmallPreviewContentLength() : ?int
    {
        return $this->video_small_preview_content_length;
    }
    
    /**
     * Get content type of the small video preview in bytes.
     *
     * @return string|null
     */
    public function getVideoSmallPreviewContentType() : ?string
    {
        return $this->video_small_preview_content_type;
    }
    
    
    /**
     * Sets media unique ID.
     * @param int $id media unique ID
     * @return StockFile
     */
    public function setId(int $id = null) : StockFile
    {
        $this->id = $id;
        return $this;
    }
    
    /**
     * Sets media title.
     * @param string $title media title
     * @return StockFile
     */
    public function setTitle(string $title = null) : StockFile
    {
        $this->title = $title;
        return $this;
    }
    
    /**
     * Sets media creator unique id.
     * @param int $creator_id media creator unique id
     * @return StockFile
     */
    public function setCreatorId(int $creator_id = null) : StockFile
    {
        $this->creator_id = $creator_id;
        return $this;
    }
    
    /**
     * Sets media creator name.
     * @param string $creator_name media creator name
     * @return StockFile
     */
    public function setCreatorName(string $creator_name = null) : StockFile
    {
        $this->creator_name = $creator_name;
        return $this;
    }
    
    /**
     * Sets media creation date.
     * @param string $creation_date media creation date string
     * @return StockFile
     */
    public function setCreationDate(string $creation_date = null) : StockFile
    {
        $date = new \DateTime($creation_date);
        $without_ms_date = $date->format('Y-m-d H:i:s');
        $this->creation_date = $without_ms_date;
        return $this;
    }
    
    /**
     * Sets media creator country name.
     * @param string $country_name media creator country name
     * @return StockFile
     */
    public function setCountryName(string $country_name = null) : StockFile
    {
        $this->country_name = $country_name;
        return $this;
    }
    
    /**
     * Sets URL for the default-sized asset thumbnail.
     * @param string $thumbnail_url media thumbnail url
     * @return StockFile
     */
    public function setThumbnailUrl(string $thumbnail_url = null) : StockFile
    {
        $this->thumbnail_url = $thumbnail_url;
        return $this;
    }
    
    /**
     * Sets HTML &lt;img&gt; tag that you can use to display the default
     * asset thumbnail.
     * @param string $thumbnail_html_tag media thumbnail html tag
     * @return StockFile
     */
    public function setThumbnailHtmlTag(string $thumbnail_html_tag = null) : StockFile
    {
        $this->thumbnail_html_tag = $thumbnail_html_tag;
        return $this;
    }
    
    /**
     * Sets media thumbnail width in pixels.
     * @param int $thumbnail_width media thumbnail width in pixels
     * @return StockFile
     */
    public function setThumbnailWidth(int $thumbnail_width = null) : StockFile
    {
        $this->thumbnail_width = $thumbnail_width;
        return $this;
    }
    
    /**
     * Sets media thumbnail height in pixels.
     * @param int $thumbnail_height Height media thumbnail height in pixels
     * @return StockFile
     */
    public function setThumbnailHeight(int $thumbnail_height = null) : StockFile
    {
        $this->thumbnail_height = $thumbnail_height;
        return $this;
    }
    
    /**
     * Sets url for 110px thumbnail.
     * @param string $thumbnail_110_url url for 110px thumbnail
     * @return StockFile
     */
    public function setThumbnail110Url(string $thumbnail_110_url = null) : StockFile
    {
        $this->thumbnail_110_url = $thumbnail_110_url;
        return $this;
    }
    
    /**
     * Sets width for 110px thumbnail.
     * @param float $thumbnail_110_width width for 110px thumbnail
     * @return StockFile
     */
    public function setThumbnail110Width(float $thumbnail_110_width = null) : StockFile
    {
        $this->thumbnail_110_width = $thumbnail_110_width;
        return $this;
    }
    
    /**
     * Sets height for 110px thumbnail.
     * @param int $thumbnail_110_height height for 110px thumbnail
     * @return StockFile
     */
    public function setThumbnail110Height(int $thumbnail_110_height = null) : StockFile
    {
        $this->thumbnail_110_height = $thumbnail_110_height;
        return $this;
    }
    
    /**
     * Sets url for 160px thumbnail.
     * @param string $thumbnail_160_url url for 160px thumbnail
     * @return StockFile
     */
    public function setThumbnail160Url(string $thumbnail_160_url = null) : StockFile
    {
        $this->thumbnail_160_url = $thumbnail_160_url;
        return $this;
    }
    
    /**
     * Sets width for 160px thumbnail.
     * @param float $thumbnail_160_width width for 160px thumbnail
     * @return StockFile
     */
    public function setThumbnail160Width(float $thumbnail_160_width = null) : StockFile
    {
        $this->thumbnail_160_width = $thumbnail_160_width;
        return $this;
    }
    
    /**
     * Sets height for 160px thumbnail.
     * @param int $thumbnail_160_height height for 160px thumbnail
     * @return StockFile
     */
    public function setThumbnail160Height(int $thumbnail_160_height = null) : StockFile
    {
        $this->thumbnail_160_height = $thumbnail_160_height;
        return $this;
    }
    
    /**
     * Sets url for 20px thumbnail.
     * @param string $thumbnail_220_url url for 220px thumbnail
     * @return StockFile
     */
    public function setThumbnail220Url(string $thumbnail_220_url = null) : StockFile
    {
        $this->thumbnail_220_url = $thumbnail_220_url;
        return $this;
    }
    
    /**
     * Sets width for 220px thumbnail.
     * @param float $thumbnail_220_width width for 220px thumbnail
     * @return StockFile
     */
    public function setThumbnail220Width(float $thumbnail_220_width = null) : StockFile
    {
        $this->thumbnail_220_width = $thumbnail_220_width;
        return $this;
    }
    
    /**
     * Sets height for 220px thumbnail.
     * @param int $thumbnail_220_height height for 220px thumbnail
     * @return StockFile
     */
    public function setThumbnail220Height(int $thumbnail_220_height = null) : StockFile
    {
        $this->thumbnail_220_height = $thumbnail_220_height;
        return $this;
    }
    
    /**
     * Sets url for 240px thumbnail.
     * @param string $thumbnail_240_url url for 240px thumbnail
     * @return StockFile
     */
    public function setThumbnail240Url(string $thumbnail_240_url = null) : StockFile
    {
        $this->thumbnail_240_url = $thumbnail_240_url;
        return $this;
    }
    
    /**
     * Sets width for 240px thumbnail.
     * @param float $thumbnail_240_width width for 240px thumbnail
     * @return StockFile
     */
    public function setThumbnail240Width(float $thumbnail_240_width = null) : StockFile
    {
        $this->thumbnail_240_width = $thumbnail_240_width;
        return $this;
    }
    
    /**
     * Sets height for 240px thumbnail.
     * @param int $thumbnail_240_height height for 240px thumbnail
     * @return StockFile
     */
    public function setThumbnail240Height(int $thumbnail_240_height = null) : StockFile
    {
        $this->thumbnail_240_height = $thumbnail_240_height;
        return $this;
    }
    
    /**
     * Sets url for 500px thumbnail.
     * @param string $thumbnail_500_url url for 500px thumbnail
     * @return StockFile
     */
    public function setThumbnail500Url(string $thumbnail_500_url = null) : StockFile
    {
        $this->thumbnail_500_url = $thumbnail_500_url;
        return $this;
    }
    
    /**
     * Sets width for 500px thumbnail.
     * @param float $thumbnail_500_width width for 500px thumbnail
     * @return StockFile
     */
    public function setThumbnail500Width(float $thumbnail_500_width = null) : StockFile
    {
        $this->thumbnail_500_width = $thumbnail_500_width;
        return $this;
    }
    
    /**
     * Sets height for 500px thumbnail.
     * @param int $thumbnail_500_height height for 500px thumbnail
     * @return StockFile
     */
    public function setThumbnail500Height(int $thumbnail_500_height = null) : StockFile
    {
        $this->thumbnail_500_height = $thumbnail_500_height;
        return $this;
    }
    
    /**
     * Sets url for 1000px thumbnail.
     * @param string $thumbnail_1000_url url for 1000px thumbnail
     * @return StockFile
     */
    public function setThumbnail1000Url(string $thumbnail_1000_url = null) : StockFile
    {
        $this->thumbnail_1000_url = $thumbnail_1000_url;
        return $this;
    }
    
    /**
     * Sets width for 1000px thumbnail.
     * @param float $thumbnail_1000_width width for 1000px thumbnail
     * @return StockFile
     */
    public function setThumbnail1000Width(float $thumbnail_1000_width = null) : StockFile
    {
        $this->thumbnail_1000_width = $thumbnail_1000_width;
        return $this;
    }
    
    /**
     * Sets height for 1000px thumbnail.
     * @param int $thumbnail_1000_height height for 1000px thumbnail
     * @return StockFile
     */
    public function setThumbnail1000Height(int $thumbnail_1000_height = null) : StockFile
    {
        $this->thumbnail_1000_height = $thumbnail_1000_height;
        return $this;
    }
    
    /**
     * Sets Media Type Id.
     * @param int $media_type_id Media Type Id
     * @return StockFile
     */
    public function setMediaTypeId(int $media_type_id = null) : StockFile
    {
        $this->media_type_id = $media_type_id;
        return $this;
    }
    
    /**
     * Sets original width of the file in pixels.
     * @param int $width original width of the file
     * @return StockFile
     */
    public function setWidth(int $width = null) : StockFile
    {
        $this->width = $width;
        return $this;
    }
    
    /**
     * Sets original height of the file in pixels.
     * @param int $height original height of the file
     * @return StockFile
     */
    public function setHeight(int $height = null) : StockFile
    {
        $this->height = $height;
        return $this;
    }
    
    /**
     * Sets licensing state for the asset.
     * @param string $is_licensed licensing state for the asset
     * @return StockFile
     */
    public function setIsLicensed(string $is_licensed = null) : StockFile
    {
        $constants_response = new CoreConstants();
        $constant_array = $constants_response->getLicenseStateParams();
        $license_value = $constant_array[$is_licensed];
        $this->is_licensed = $license_value;
        return $this;
    }
    
    /**
     * Sets URL to the watermarked version of the asset.
     * @param string $comp_url URL to the watermarked version of the asset
     * @return StockFile
     */
    public function setCompUrl(string $comp_url = null) : StockFile
    {
        $this->comp_url = $comp_url;
        return $this;
    }
    
    /**
     * Sets width in pixels of the asset's complementary (unlicensed) image.
     * @param int $comp_width width in pixels
     * @return StockFile
     */
    public function setCompWidth(int $comp_width = null) : StockFile
    {
        $this->comp_width = $comp_width;
        return $this;
    }
    
    /**
     * Sets height in pixels of the asset's complementary (unlicensed) image.
     * @param int $comp_height height in pixels
     * @return StockFile
     */
    public function setCompHeight(int $comp_height = null) : StockFile
    {
        $this->comp_height = $comp_height;
        return $this;
    }
    
    /**
     * Sets total views of the asset by all users.
     * @param int $nb_views total views of the asset by all users
     * @return StockFile
     */
    public function setNbViews(int $nb_views = null) : StockFile
    {
        $this->nb_views = $nb_views;
        return $this;
    }
    
    /**
     * Sets total downloads of the asset by all users.
     * @param int $nb_downloads total downloads of the asset by all users
     * @return StockFile
     */
    public function setNbDownloads(int $nb_downloads = null) : StockFile
    {
        $this->nb_downloads = $nb_downloads;
        return $this;
    }
    
    /**
     * Sets category of the media.
     * @param int    $id   category id of the media
     * @param string $name name of the media
     * @return StockFile
     */
    public function setCategory(int $id = null, string $name = null) : StockFile
    {
        $value = [
            'id' => $id,
            'name' => $name,
        ];
        $this->category = new SearchCategoryResponse($value);
        return $this;
    }
    
    /**
     * Sets list of localised keywords for the file.
     * @param array $keywords arraylist of localised keywords for the file
     * @return StockFile
     */
    public function setKeywords(array $keywords = null) : StockFile
    {
        $this->keywords = $keywords;
        return $this;
    }
    
    /**
     * Sets if content has any release IDs.
     * @param bool $has_releases "1" if content has any release IDs else "0"
     * @return StockFile
     */
    public function setHasReleases(bool $has_releases = null) : StockFile
    {
        $this->has_releases = $has_releases;
        return $this;
    }
    
    /**
     * Sets type of the asset.
     * @param string $asset_type type of the asset
     * @return StockFile
     */
    public function setAssetTypeId(string $asset_type = null) : StockFile
    {
        $constants_response = new CoreConstants();
        $constant_array = $constants_response->getAssetType();
        $asset_value = $constant_array[$asset_type];
        $this->asset_type_id = $asset_value;
        return $this;
    }
    
    /**
     * If the asset is a vector, sets whether it is an SVG or an AI/EPS asset.
     * @param string $vector_type file vector type
     * @return StockFile
     */
    public function setVectorType(string $vector_type = null) : StockFile
    {
        $this->vector_type = $vector_type;
        return $this;
    }
    
    /**
     * Sets mime type of the asset's content.
     * @param string $content_type mime type of the asset's content
     * @return StockFile
     */
    public function setContentType(string $content_type = null) : StockFile
    {
        $this->content_type = $content_type;
        return $this;
    }
    
    /**
     * Sets frame rate for video.
     * @param float $framerate frame rate for video
     * @return StockFile
     */
    public function setFrameRate(float $framerate = null) : StockFile
    {
        $this->framerate = $framerate;
        return $this;
    }
    
    /**
     * Sets duration of video in milliseconds.
     * @param int $duration duration of video in milliseconds
     * @return StockFile
     */
    public function setDuration(int $duration = null) : StockFile
    {
        $this->duration = $duration;
        return $this;
    }
    
    /**
     * Sets stock identifier.
     * @param string $stock_id stock identifier
     * @return StockFile
     */
    public function setStockId(string $stock_id = null) : StockFile
    {
        $this->stock_id = $stock_id;
        return $this;
    }
    
    /**
     * Sets properties for complementary assets.
     * @param StockFileComps $comps properties for complementary assets
     * @return StockFile
     */
    public function setComps(StockFileComps $comps = null) : StockFile
    {
        $this->comps = $comps;
        return $this;
    }
    
    /**
     * Sets url of stock details page for the asset.
     * @param string $details_url url of stock details page for the asset
     * @return StockFile
     */
    public function setDetailsUrl(string $details_url = null) : StockFile
    {
        $this->details_url = $details_url;
        return $this;
    }
    
    /**
     * Sets id of the template.
     * @param string $template_type_id id of the template
     * @return StockFile
     */
    public function setTemplateTypeId(string $template_type_id = null) : StockFile
    {
        $constants_response = new CoreConstants();
        $constant_array = $constants_response->getSearchParamsTemplateTypes();
        $template_type_id_value = $constant_array[$template_type_id];
        $this->template_type_id = $template_type_id_value;
        return $this;
    }
    
    /**
     * Sets array of template category ids.
     * @param array $template_category_ids arraylist of template category ids
     * @return StockFile
     */
    public function setTemplateCategoryIds(array $template_category_ids = null) : StockFile
    {
        $constants_response = new CoreConstants();
        $constant_array = $constants_response->getSearchParamsTemplateCategories();
        
        $i = 0;
        
        foreach ($template_category_ids as $value) {
            
            $result[$i] = $constant_array[$value];
            $i++;
        }
        
        $this->template_category_ids = $result;
        return $this;
    }
    
    /**
     * Sets marketing text for template.
     * @param string $marketing_text marketing text for template
     * @return StockFile
     */
    public function setMarketingText(string $marketing_text = null) : StockFile
    {
        $this->marketing_text = $marketing_text;
        return $this;
    }
    
    /**
     * Sets description text for template.
     * @param string $description description text for template
     * @return StockFile
     */
    public function setDescription(string $description = null) : StockFile
    {
        $this->description = $description;
        return $this;
    }
    
    /**
     * Sets size of the template file in bytes.
     * @param int $size_bytes size of the template file in bytes
     * @return StockFile
     */
    public function setSizeBytes(int $size_bytes = null) : StockFile
    {
        $this->size_bytes = $size_bytes;
        return $this;
    }
    
    /**
     * Sets premium level id.
     * @param string $premium_level_id premium level id of type {@link AssetPremiumLevel}
     * @return StockFile
     */
    public function setPremiumLevelId(string $premium_level_id = null) : StockFile
    {
        $constants_response = new CoreConstants();
        $constant_array = $constants_response->getAssetPremiumLevel();
        $premium_level_id_value = $constant_array[$premium_level_id];
        $this->premium_level_id = $premium_level_id_value;
        return $this;
    }
    
    /**
     * Sets if premium asset.
     * @param bool $is_premium true for premium assets and false for standard assets
     * @return StockFile
     */
    public function setIsPremium(bool $is_premium = null) : StockFile
    {
        $this->is_premium = $is_premium;
        return $this;
    }
    
    /**
     * Sets available licenses for the media.
     * @param StockFileLicenses $licenses available licenses for the media
     * @return StockFile
     */
    public function setLicenses(StockFileLicenses $licenses = null) : StockFile
    {
        $this->licenses = $licenses;
        return $this;
    }
    
    /**
     * Sets url for the video preview.
     * @param string $video_preview_url url for the video preview
     * @return StockFile
     */
    public function setVideoPreviewUrl(string $video_preview_url = null) : StockFile
    {
        $this->video_preview_url = $video_preview_url;
        return $this;
    }
    
    /**
     * Sets height for the video preview in pixels.
     * @param int $video_preview_height height for the video preview in pixels
     * @return StockFile
     */
    public function setVideoPreviewHeight(int $video_preview_height = null) : StockFile
    {
        $this->video_preview_height = $video_preview_height;
        return $this;
    }
    
    /**
     * Sets width for the video preview in pixels.
     * @param int $video_preview_width width for the video preview in pixels
     * @return StockFile
     */
    public function setVideoPreviewWidth(int $video_preview_width = null) : StockFile
    {
        $this->video_preview_width = $video_preview_width;
        return $this;
    }
    
    /**
     * Sets file size of video preview in bytes.
     * @param int $video_preview_content_length file size of video preview in bytes
     * @return StockFile
     */
    public function setVideoPreviewContentLength(int $video_preview_content_length = null) : StockFile
    {
        $this->video_preview_content_length = $video_preview_content_length;
        return $this;
    }
    
    /**
     * Sets content type of video preview.
     * @param string $video_preview_content_type content type of video preview
     * @return StockFile
     */
    public function setVideoPreviewContentType(string $video_preview_content_type = null) : StockFile
    {
        $this->video_preview_content_type = $video_preview_content_type;
        return $this;
    }
    
    /**
     * Sets url of the small video preview.
     * @param string $video_small_preview_url url of the small video preview
     * @return StockFile
     */
    public function setVideoSmallPreviewUrl(string $video_small_preview_url = null) : StockFile
    {
        $this->video_small_preview_url = $video_small_preview_url;
        return $this;
    }
    
    /**
     * Sets height of the small video preview in pixels.
     * @param int $video_small_preview_height height of the small video preview in pixels
     * @return StockFile
     */
    public function setVideoSmallPreviewHeight(int $video_small_preview_height = null) : StockFile
    {
        $this->video_small_preview_height = $video_small_preview_height;
        return $this;
    }
    
    /**
     * Sets width of the small video preview in pixels.
     * @param int $video_small_preview_width width of the small video preview in pixels
     * @return StockFile
     */
    public function setVideoSmallPreviewWidth(int $video_small_preview_width = null) : StockFile
    {
        $this->video_small_preview_width = $video_small_preview_width;
        return $this;
    }
    
    /**
     * Sets file size of the small video preview in bytes.
     * @param int $video_small_preview_content_length file size of the small video preview in bytes
     * @return StockFile
     */
    public function setVideoSmallPreviewContentLength(int $video_small_preview_content_length = null)
    {
        $this->video_small_preview_content_length = $video_small_preview_content_length;
        return $this;
    }
    
    /**
     * Sets content type of the small video preview in bytes.
     * @param string $video_small_preview_content_type content type of the small video preview in bytes
     * @return StockFile
     */
    public function setVideoSmallPreviewContentType(string $video_small_preview_content_type = null) : StockFile
    {
        $this->video_small_preview_content_type = $video_small_preview_content_type;
        return $this;
    }
}
