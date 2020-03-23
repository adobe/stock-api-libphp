<?php
/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Core;

class Constants
{
    /**
     * @var array Query params
     */
    protected static $_queryParamsProps = [
        'IDS' => 'ids',
        'LOCALE' => 'locale',
        'SEARCH_PARAMETERS' => 'search_parameters',
        'RESULT_COLUMNS' => 'result_columns',
        'SIMILAR_IMAGE' => 'similar_image',
        'CATEGORY' => 'category_id',
    ];
    
    /**
     * @var array end points.
     */
    protected static $_end_points = [
        'search' => 'https://stock.adobe.io/Rest/Media/1/Search/Files',
        'category' => 'https://stock.adobe.io/Rest/Media/1/Search/Category',
        'category_tree' => 'https://stock.adobe.io/Rest/Media/1/Search/CategoryTree',
        'license' => 'https://stock.adobe.io/Rest/Libraries/1/Content/License',
        'license_info' => 'https://stock.adobe.io/Rest/Libraries/1/Content/Info',
        'user_profile' => 'https://stock.adobe.io/Rest/Libraries/1/Member/Profile',
        'abandon' => 'https://stock.adobe.io/Rest/Libraries/1/Member/Abandon',
        'license_history' => 'https://stock.adobe.io/Rest/Libraries/1/Member/LicenseHistory',
        'files' => 'https://stock.adobe.io/Rest/Media/1/Files'
    ];

    /**
     * @var array Http Method
     */
    protected static $_http_method = [
        'GET' => 'GET',
        'POST' => 'POST',
    ];
    
    /**
     * @var array Environment
     */
    protected static $_environments = [
        'PROD' => 'PROD',
        'STAGE' => 'STAGE',
    ];
    
    /**
     * @var array searchParamsOrders
     */
    protected static $_searchParamsOrders = [
        'RELEVANCE' => 'relevance',
        'CREATION' => 'creation',
        'POPULARITY' => 'popularity',
        'NB_DOWNLOADS' => 'nb_downloads',
        'UNDISCOVERED' => 'undiscovered',
    ];
    
    /**
     * @var array searchParamsOrientation
     */
    protected static $_searchParamsOrientation = [
        'HORIZONTAL' => 'horizontal',
        'VERTICAL' => 'vertical',
        'SQUARE' => 'square',
        'ALL' => 'all',
    ];
    
    /**
     * @var array searchParamsOrientation
     */
    protected static $_SearchParamsHasReleases = [
        'TRUE' => 'true',
        'FALSE' => 'false',
        'ALL' => 'all',
    ];
    
    /**
     * @var array searchParams3DTypes
     */
    protected static $_searchParams3DTypes = [
        'MODELS' => 1,
        'LIGHTS' => 2,
        'MATERIALS' => 3,
    ];
    
    /**
     * @var array Query searchParamsTemplateCategories
     */
    protected static $_searchParamsTemplateCategories = [
        'MOBILE' => 1,
        'WEB' => 2,
        'PRINT' => 3,
        'PHOTO' => 4,
        'FILM' => 5,
        'ART' => 6,
    ];
    
    /**
     * @var array searchParamsTemplateCategories
     */
    protected static $_searchParamsTemplateTypes = [
        'PSDT' => 1,
        'AIT' => 2,
    ];
    
    /**
     * @var array searchParamsThumbSizes
     */
    protected static $_searchParamsThumbSizes = [
        'MEDIUM' => 110,
        'BIG' => 160,
        'XL' => 500,
        'XXL' => 1000,
    ];
    
    /**
     * @var array Query searchParamsAge
     */
    protected static $_searchParamsAge = [
        'ONE_WEEK' => '1w',
        'ONE_MONTH' => '1m',
        'SIX_MONTH' => '6m',
        'ONE_YEAR' => '1y',
        'TWO_YEAR' => '2y',
        'ALL' => 'all',
    ];
    
    /**
     * @var array Query searchParamsVideoDuration
     */
    protected static $_searchParamsVideoDuration = [
        'TEN' => '10',
        'TWENTY' => '20',
        'THIRTY' => '30',
        'ABOVE_THIRTY' => '30-',
        'ALL' => 'all',
    ];
    
    /**
     * @var array Query searchParamsType
     */
    protected static $_searchParamsType = [
        'STRING' => 0,
        'INTEGER' => 1,
        'RANGE' => 2,
        'ARRAY' => 3,
    ];
    
    /**
     * @var array Query searchParamsPremium
     */
    protected static $_searchParamsPremium = [
        'TRUE' => 'true',
        'FALSE' => 'false',
        'ALL' => 'all',
    ];
    
    /**
     * @var array Query resultColumns
     */
    protected static $_resultColumns = [
        'NB_RESULTS' => 'nb_results',
        'ID' => 'id',
        'TITLE' => 'title',
        'CREATOR_NAME' => 'creator_name',
        'CREATOR_ID' => 'creator_id',
        'COUNTRY_NAME' => 'country_name',
        'WIDTH' => 'width',
        'HEIGHT' => 'height',
        'THUMBNAIL_URL' => 'thumbnail_url',
        'THUMBNAIL_HTML_TAG' => 'thumbnail_html_tag',
        'THUMBNAIL_WIDTH' => 'thumbnail_width',
        'THUMBNAIL_HEIGHT' => 'thumbnail_height',
        'THUMBNAIL_110_URL' => 'thumbnail_110_url',
        'THUMBNAIL_110_WIDTH' => 'thumbnail_110_width',
        'THUMBNAIL_110_HEIGHT' => 'thumbnail_110_height',
        'THUMBNAIL_160_URL' => 'thumbnail_160_url',
        'THUMBNAIL_160_WIDTH' => 'thumbnail_160_width',
        'THUMBNAIL_160_HEIGHT' => 'thumbnail_160_height',
        'THUMBNAIL_220_URL' => 'thumbnail_220_url',
        'THUMBNAIL_220_WIDTH' => 'thumbnail_220_width',
        'THUMBNAIL_220_HEIGHT' => 'thumbnail_220_height',
        'THUMBNAIL_240_URL' => 'thumbnail_240_url',
        'THUMBNAIL_240_WIDTH' => 'thumbnail_240_width',
        'THUMBNAIL_240_HEIGHT' => 'thumbnail_240_height',
        'THUMBNAIL_500_URL' => 'thumbnail_500_url',
        'THUMBNAIL_500_WIDTH' => 'thumbnail_500_width',
        'THUMBNAIL_500_HEIGHT' => 'thumbnail_500_height',
        'THUMBNAIL_1000_URL' => 'thumbnail_1000_url',
        'THUMBNAIL_1000_WIDTH' => 'thumbnail_1000_width',
        'THUMBNAIL_1000_HEIGHT' => 'thumbnail_1000_height',
        'MEDIA_TYPE_ID' => 'media_type_id',
        'CATEGORY' => 'category',
        'CATEGORY_HIERARCHY' => 'category_hierarchy',
        'NB_VIEWS' => 'nb_views',
        'NB_DOWNLOADS' => 'nb_downloads',
        'CREATION_DATE' => 'creation_date',
        'KEYWORDS' => 'keywords',
        'HAS_RELEASES' => 'has_releases',
        'COMP_URL' => 'comp_url',
        'COMP_WIDTH' => 'comp_width',
        'COMP_HEIGHT' => 'comp_height',
        'IS_LICENSED' => 'is_licensed',
        'VECTOR_TYPE' => 'vector_type',
        'CONTENT_TYPE' => 'content_type',
        'FRAMERATE' => 'framerate',
        'DURATION' => 'duration',
        'STOCK_ID' => 'stock_id',
        'COMPS' => 'comps',
        'DETAILS_URL' => 'details_url',
        'TEMPLATE_TYPE_ID' => 'template_type_id',
        'TEMPLATE_CATEGORY_IDS' => 'template_category_ids',
        'MARKETING_TEXT' => 'marketing_text',
        'DESCRIPTION' => 'description',
        'SIZE_BYTES' => 'size_bytes',
        'PREMIUM_LEVEL_ID' => 'premium_level_id',
        'IS_PREMIUM' => 'is_premium',
        'LICENSES' => 'licenses',
        'VIDEO_PREVIEW_URL' => 'video_preview_url',
        'VIDEO_PREVIEW_WIDTH' => 'video_preview_width',
        'VIDEO_PREVIEW_HEIGHT' => 'video_preview_height',
        'VIDEO_PREVIEW_CONTENT_LENGTH' => 'video_preview_content_length',
        'VIDEO_PREVIEW_CONTENT_TYPE' => 'video_preview_content_type',
        'VIDEO_SMALL_PREVIEW_URL' => 'video_small_preview_url',
        'VIDEO_SMALL_PREVIEW_WIDTH' => 'video_small_preview_width',
        'VIDEO_SMALL_PREVIEW_HEIGHT' => 'video_small_preview_height',
        'VIDEO_SMALL_PREVIEW_CONTENT_LENGTH' => 'video_small_preview_content_length',
        'VIDEO_SMALL_PREVIEW_CONTENT_TYPE' => 'video_small_preview_content_type',
        'IS_EDITORIAL' => 'is_editorial',
    ];
    
    /**
     * @var array Query licenseStateParams
     */
    protected static $_licenseStateParams = [
        'STANDARD' => 'Standard',
        'EXTENDED' => 'Extended',
        'VIDEO_HD' => 'Video_HD',
        'VIDEO_4K' => 'Video_4K',
        'STANDARD_M' => 'Standard_M',
        'EMPTY' => '',
    ];
    
    /**
     * @var array Asset type id
     */
    protected static $_assetType = [
        'PHOTOS' => 1,
        'ILLUSTRATIONS' => 2,
        'VECTORS' => 3,
        'VIDEOS' => 4,
        'INSTANT_PHOTOS' => 5,
        'THREE_DIMENSIONAL' => 6,
        'TEMPLATES' => 7,
    ];
    
    /**
     * @var array Assest premium level id
     */
    protected static $_assetPremiumLevel = [
        'CORE' => 0,
        'FREE' => 1,
        'PREMIUM1' => 2,
        'PREMIUM2' => 3,
        'PREMIUM3' => 4,
    ];
    
    /**
     * @var array Query purchaseStateParams
     */
    protected static $_purchaseStateParams = [
        'NOT_PURCHASED' => 'not_purchased',
        'PURCHASED' => 'purchased',
        'CANCELLED' => 'cancelled',
        'NOT_POSSIBLE' => 'not_possible',
        'JUST_PURCHASED' => 'just_purchased',
        'OVERAGE' => 'overage',
    ];
    
    /**
     * The size of the asset, indicating whether it is the free
     * complementary size or the original full-sized asset.
     * @var array assest license size
     */
    protected static $_asset_license_size = [
        'Comp' => 'Comp',
        'Original' => 'Original',
    ];
    
    /**
     * @var array searchParamLicenseThumbSizes
     */
    protected static $_search_params_license_thumb_sizes = [
        110 => 110,
        160 => 160,
        220 => 220,
        240 => 240,
        500 => 500,
        1000 => 1000,
    ];

    /**
     * Getter for QueryParamProps.
     * @return array
     */
    public static function getQueryParamsProps()
    {
        return static::$_queryParamsProps;
    }
    
    /**
     * Getter for HttpMethod.
     * @return array
     */
    public static function getHttpMethod()
    {
        return static::$_http_method;
    }
    
    /**
     * Getter for Environment.
     * @return array
     */
    public static function getEnvironments() : array
    {
        return static::$_environments;
    }
    
    /**
     * Getter for EndPoints.
     * @return array
     */
    public static function getEndPoints() : array
    {
        return static::$_end_points;
    }
    
    /**
     * Getter for Asset Premium level.
     * @return array
     */
    public static function getAssetPremiumLevel() : array
    {
        return static::$_assetPremiumLevel;
    }
    
    /**
     * Getter for Asset Type.
     * @return array
     */
    public static function getAssetType() : array
    {
        return static::$_assetType;
    }

    /**
     * Getter for SearchParamsOrders.
     * @return array
     */
    public static function getSearchParamsOrders() : array
    {
        return static::$_searchParamsOrders;
    }
    
    /**
     * Getter for SearchParamsOrientation.
     * @return array
     */
    public static function getSearchParamsOrientation() : array
    {
        return static::$_searchParamsOrientation;
    }
    
    /**
     * Getter for SearchParamsHasReleases.
     * @return array
     */
    public static function getSearchParamsHasReleases() : array
    {
        return static::$_SearchParamsHasReleases;
    }
    
    /**
     * Getter for SearchParams3DTypes.
     * @return string
     */
    public static function getSearchParams3DTypes() : array
    {
        return static::$_searchParams3DTypes;
    }
    
    /**
     * Getter for SearchParamsTemplateCategories.
     * @return array
     */
    public static function getSearchParamsTemplateCategories() : array
    {
        return static::$_searchParamsTemplateCategories;
    }
    
    /**
     * Getter for Query Param Props.
     * @return array
     */
    public static function getSearchParamsTemplateTypes() : array
    {
        return static::$_searchParamsTemplateTypes;
    }
    
    /**
     * Getter for SearchParamsThumbSizes.
     * @return array
     */
    public static function getSearchParamsThumbSizes() : array
    {
        return static::$_searchParamsThumbSizes;
    }
    
    /**
     * Getter for SearchParamsAge.
     * @return array
     */
    public static function getSearchParamsAge() : array
    {
        return static::$_searchParamsAge;
    }
    
    /**
     * Getter for SearchParamsVideoDuration.
     * @return array
     */
    public static function getSearchParamsVideoDuration() : array
    {
        return static::$_searchParamsVideoDuration;
    }
    
    /**
     * Getter for SearchParamsType.
     * @return array
     */
    public static function getSearchParamsType() : array
    {
        return static::$_searchParamsType;
    }
    
    /**
     * Getter for SearchParamsPremium.
     * @return array
     */
    public static function getSearchParamsPremium() : array
    {
        return static::$_searchParamsPremium;
    }

    /**
     * Getter for ResultColumns.
     * @return array
     */
    public static function getResultColumns() : array
    {
        return static::$_resultColumns;
    }
    
    /**
     * Getter for LicenseStateParams.
     * @return array
     */
    public static function getLicenseStateParams() : array
    {
        return static::$_licenseStateParams;
    }
    
    /**
     * Getter for PurchaseStateParams.
     * @return array
     */
    public static function getPurchaseStateParams() : array
    {
        return static::$_purchaseStateParams;
    }
    
    /**
     * Getter for assest license size.
     * @return array of asset License Size
     */
    public static function getAssetLicenseSize() : array
    {
        return static::$_asset_license_size;
    }
    
    /**
     * Getter for SearchParamsThumbSizes.
     * @return array
     */
    public static function getSearchParamsLicenseThumbSizes() : array
    {
        return static::$_search_params_license_thumb_sizes;
    }
}
