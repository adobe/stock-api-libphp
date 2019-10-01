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

class SearchParameters
{
    /**
     * Maximum number of assets that can be returned
     * in search results.
     * @var int
     */
    const MAX_LIMIT = 64;
    
    /**
     * Minimum number of assets that can be returned
     * in search results.
     * @var int
     */
    const MIN_LIMIT = 1;
    
    /**
     * Specific asset creator's ID.
     * @var int
     */
    public $creator_id;
    
    /**
     * Unique identifier of a specific asset.
     * @var int
     */
    public $media_id;
    
    /**
     * Specific person id.
     * @var int
     */
    public $model_id;
    
    /**
     * Asset's series Id.
     * @var int
     */
    public $serie_id;
    
    /**
     * Similar media id for specific search.
     * @var int
     */
    public $similar;
    
    /**
     * Specific category id to search assests.
     * @var int
     */
    public $category;
    
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
     * Keywords that you want to include in your files search.
     * @var string
     */
    public $words;
    
    /**
     * URL for searching assests that are similar in appearance
     * to an image at a specific URL.
     * @var string
     */
    public $similar_url;
    
    /**
     * Search assets that contain the specific colors.
     * @var string
     */
    public $filters_colors;
    
    /**
     * Gallery Id filter for search params.
     * @var string
     */
    public $gallery_id;
    
    /**
     * Image sizes in pixels for returned assets in search.
     * @var int
     */
    public $filters_area_pixels;
    
    /**
     * SimilarImage filter can be true or false to find
     * visualy similar images.
     * @var int
     */
    public $similar_image;
    
    /**
     * ContentTypePhoto filter can be true or false
     * to find assets that are photos.
     * @var int
     */
    public $filters_content_type_photos;
    
    /**
     * ContentTypeIllustration filter can be true or false
     * to find assets that are illustrations.
     * @var int
     */
    public $filters_content_type_illustration;
    
    /**
     * ContentTypeVector filter can be true or false
     * to find assets that are vectors.
     * @var int
     */
    public $filters_content_type_vector;
    
    /**
     * ContentTypeVideo filter can be true or false
     * to find assets that are videos.
     * @var int
     */
    public $filters_content_type_video;
    
    /**
     * ContentTypeTemplate filter can be true or false
     * to find assets that are templates.
     * @var int
     */
    public $filters_content_type_template;
    
    /**
     * ContentType3D filter can be true or false
     * to find assets that are 3D.
     * @var int
     */
    public $filters_content_type_3d;
    
    /**
     * ContentTypeAll filter can be true or false
     * to find assets that are of all types.
     * @var int
     */
    public $filters_content_type_all;
    
    /**
     * Editorial filter can be true or false
     * to find assets that are of editorial.
     * @var int
     */
    public $filters_editorial;
    
    /**
     * Offensive2 filter can be true or false to find assets only if they
     * are flagged as including Explicit/Nudity/Violence.
     * @var int
     */
    public $filters_offensive_2;
    
    /**
     * IsolatedOn filter can be true or false to find assets only if the
     * subject is isolated from the background by being on a uniformly colored
     * background.
     * @var int
     */
    public $filters_isolated_on;
    
    /**
     * PanoromicOn filter can be true or false to find assets
     * that are panoromic.
     * @var int
     */
    public $filters_panoromic_on;
    
    /**
     * Size of thumbnail(in pixels) for each found asset in search
     * results.
     * @var int
     */
    public $filters_thumbnail_size;
    
    /**
     * Orientation filter in search Params for searching files of specific
     * orientation.
     * @var string
     */
    public $filters_orientation;
    
    /**
     * Specified asset age groups that can be used in search parameters
     * for searching assets.
     * @var int
     */
    public $filters_age;
    
    /**
     * Specified video duration that can be used in search parameters
     * for searching videos whose duration is no longer than the specified
     * duration in seconds.
     * @var string
     */
    public $filters_video_duration;
    
    /**
     * specified template types that can be used in Search
     * Parameters for searching assets, if asset is a template.
     * @var array
     */
    public $filters_template_type_id = [];
    
    /**
     * 3D types that can be used in search parameters for
     * searching assets.
     * @var array
     */
    public $filters_3d_type_id = [];
    
    /**
     * Specified template category identifiers that can be used in Search
     * Parameters for searching assets, if asset is a template.
     * @var array
     */
    public $filters_template_category_id = [];
    
    /**
     * Sort order in which to return found assets.
     * @var string
     */
    public $order;
    
    /**
     * Asset's premium (pricing) level that can be used in function
     * for searching assets.
     * @var string
     */
    public $filters_premium;
    
    /**
     * Asset's model or property releases that can be used in
     * search parameters for searching assets.
     * @var string
     */
    public $filters_has_releases;
    
    /**
     * json mapper
     * @var array
     */
    protected $_json_mapper = [
        'filters_colors' => '[filters][colors]',
        'filters_area_pixels' => '[filters][area_pixels]',
        'filters_content_type_photos' => '[filters][content_type:photo]',
        'filters_content_type_illustration' => '[filters][content_type:illustration]',
        'filters_content_type_vector' => '[filters][content_type:vector]',
        'filters_content_type_video' => '[filters][content_type:video]',
        'filters_content_type_template' => '[filters][content_type:template]',
        'filters_content_type_3d' => '[filters][content_type:3D]',
        'filters_content_type_all' => '[filters][content_type:all]',
        'filters_editorial' => '[filters][editorial]',
        'filters_offensive_2' => '[filters][offensive:2]',
        'filters_isolated_on' => '[filters][isolated:on]',
        'filters_panoramic_on' => '[filters][panoramic:on]',
        'filters_thumbnail_size' => '[filters][thumbnail_size]',
        'filters_orientation' => '[filters][orientation]',
        'filters_age' => '[filters][age]',
        'filters_video_duration' => '[filters][video_duration]',
        'filters_template_type_id' => '[filters][template_type_id][]',
        'filters_3d_type_id' => '[filters][3d_type_id][]',
        'filters_template_category_id' => '[filters][template_category_id][]',
        'filters_premium' => '[filters][premium]',
        'filters_has_releases' => '[filters][has_releases]',
    ];
    
    /**
     * Get a specific asset creator's ID.
     * @return int|null creator Id of type function
     */
    public function getCreatorId() : ?int
    {
        return $this->creator_id;
    }
    
    /**
     * Sets a specific asset creator's ID in search Params for searching files.
     * @param int $creator_id Specific asset creator's ID
     * @return SearchParameters object
     * @throws StockApiException if creator Id is not positive
     */
    public function setCreatorId(int $creator_id) : SearchParameters
    {
        
        if ($creator_id <= 0) {
            throw StockApiException::withMessage('Should be a valid creator Id');
        }
        
        $this->creator_id = $creator_id;
        return $this;
    }
    
    /**
     * Get unique identifier of a specific asset (media Id).
     * @return int|null media id
     */
    public function getMediaId() : ?int
    {
        return $this->media_id;
    }
    
    /**
     * Sets unique identifier of a specific asset in search Params for searching
     * files.
     * @param int $media_id unique identifier of a asset
     * @return SearchParameters object
     * @throws StockApiException if media Id is not positive
     */
    public function setMediaId(int $media_id) : SearchParameters
    {
        
        if ($media_id <= 0) {
            throw StockApiException::WithMessage('Should be a valid Media Id');
        }
        
        $this->media_id = $media_id;
        return $this;
    }
    
    /**
     * Get a specific person (model) using the model's ID.
     * @return int|null ModelId of type function
     */
    public function getModelId() : ?int
    {
        return $this->model_id;
    }
    
    /**
     * Sets a specific person (model) Id in search Params for searching files.
     * @param int $model_id a specific person (model) Id
     * @return SearchParameters object
     * @throws StockApiException if model Id is not positive
     */
    public function setModelId(int $model_id) : SearchParameters
    {
        if ($model_id <= 0) {
            throw StockApiException::WithMessage('Should be a valid Model Id');
        }
        
        $this->model_id = $model_id;
        return $this;
    }
    
    /**
     * Get current asset's series Id.
     * @return int|null SerieId of type function
     */
    public function getSerieId() : ?int
    {
        return $this->serie_id;
    }
    
    /**
     * Sets specific series for assets in search Params that you want to search.
     * @param int $serie_id Specific series Id of assests
     * @return SearchParameters object
     * @throws StockApiException if serie Id is not positive
     */
    public function setSerieId(int $serie_id) : SearchParameters
    {
        if ($serie_id <= 0) {
            throw StockApiException::WithMessage('Should be a valid Series Id');
        }
        
        $this->serie_id = $serie_id;
        return $this;
    }
    
    /**
     * Get a specific media ID for similar search.
     * @return int|null similar medi id
     */
    public function getSimilar() : ?int
    {
        return $this->similar;
    }
    
    /**
     * Sets specific media ID that is similar in appearance to an asset in
     * search Params for searching similar files.
     * @param int $similar specific media ID
     * @return SearchParameters object
     * @throws StockApiException if similar is not positive
     */
    public function setSimilar(int $similar) : SearchParameters
    {
        if ($similar <= 0) {
            throw StockApiException::WithMessage('Should be a valid previous mediaId');
        }
        
        $this->similar = $similar;
        return $this;
    }
    
    /**
     * Get a specific category ID.
     * @return int|null category id
     */
    public function getCategory() : ?int
    {
        return $this->category;
    }
    
    /**
     * Sets a specific category ID in search Params for searching files of this
     * category.
     * @param int $category specific category ID
     * @return SearchParameters object
     * @throws StockApiException if category Id is not positive
     */
    public function setCategory(int $category) : SearchParameters
    {
        if ($category <= 0) {
            throw StockApiException::WithMessage('Should be a valid category');
        }
        
        $this->category = $category;
        return $this;
    }
    
    /**
     * Get maximum number of assets that return in the api call.
     * @return int|null|null limit of type function
     */
    public function getLimit() : ?int
    {
        return $this->limit;
    }
    
    /**
     * Sets maximum number of assets in search Params that you wants to return
     * in the api call.
     * @param int $limit maximum number of assets that return in the api call
     * @return SearchParameters object
     * @throws StockApiException if limit doesn't lie between 1 and 64
     */
    public function setLimit(int $limit) : SearchParameters
    {
        if ($limit < static::MIN_LIMIT || $limit > static::MAX_LIMIT) {
            throw StockApiException::WithMessage('Limit should be greator than 1 and less than 64');
        }
        
        $this->limit = $limit;
        return $this;
    }
    
    /**
     * Get start position(index) in search results.
     * @return int|null|null offset of type function
     */
    public function getOffset() : ?int
    {
        return $this->offset;
    }
    
    /**
     * Sets the start position(index) in search results.
     * @param int $offset starting index in the search results
     * @return SearchParameters object
     * @throws StockApiException if offset is not positive
     */
    public function setOffset(int $offset) : SearchParameters
    {
        if ($offset < 0) {
            throw StockApiException::WithMessage('Offset should be between 0 and MaxResults');
        }
        
        $this->offset = $offset;
        return $this;
    }
    
    /**
     * Get keywords that you included in your specific files search.
     * @return string|null words of type String
     */
    public function getWords() : ?string
    {
        return $this->words;
    }
    
    /**
     * Sets keywords in search Params for searching files.
     * @param string $words keywords that you want to search
     * @return SearchParameters object
     */
    public function setWords(string $words) : SearchParameters
    {
        $this->words = $words;
        return $this;
    }
    
    /**
     * Get URL that you have set for searching assests that are similar in
     * appearance to an image at a specific URL.
     * @return string|null similarURL of type String
     */
    public function getSimilarURL() : ?string
    {
        return $this->similar_url;
    }
    
    /**
     * Sets a URL for searching assests that are similar in appearance to an
     * image at a specific URL.
     * @param string $similar_url URL to search a similar file
     * @return SearchParameters object
     * @throws StockApiException if similarURL is null or blank
     */
    public function setSimilarURL(string $similar_url) : SearchParameters
    {
        if (empty($similar_url)) {
            throw StockApiException::WithMessage('Should not be blank or null values in similarURL field');
        }
        
        $this->similar_url = $similar_url;
        return $this;
    }
    
    /**
     * Get color that you have included in search params to search assets that
     * contain the specified colors.
     * @return string|null filterColors of type String
     */
    public function getFilterColors() : ?string
    {
        return $this->filters_colors;
    }
    
    /**
     * Sets Color filter in search Params to search assets that contain the
     * specific colors.
     * @param string $filters_colors Hexadecimal value of color
     * @return SearchParameters object
     * @throws StockApiException if filterColors is null or blank
     */
    public function setFilterColors(string $filters_colors) : SearchParameters
    {
        if (empty($filters_colors)) {
            throw StockApiException::WithMessage('Should not be blank or null values in filterColors field');
        }
        
        $this->filters_colors = $filters_colors;
        return $this;
    }
    
    /**
     * Get current galleryId filter.
     * @return string|null galleryId of type String
     */
    public function getGalleryId() : ?string
    {
        return $this->gallery_id;
    }
    
    /**
     * Sets galleryId filter in search Params for searching files.
     * @param string $gallery_id specific gallery Id
     * @return SearchParameters object
     * @throws StockApiException if galleryId is null or blank
     */
    public function setGalleryId(string $gallery_id) : SearchParameters
    {
        if (empty($gallery_id)) {
            throw StockApiException::WithMessage('Should not be blank or null values in galleryId field');
        }
        
        $this->gallery_id = $gallery_id;
        return $this;
    }
    
    /**
     * Get image sizes in pixels that you have set in search parameters for
     * returned assets.
     * @return int|null filterAreaPixels
     */
    public function getFilterAreaPixels() : ?int
    {
        return $this->filters_area_pixels;
    }
    
    /**
     * Sets image sizes in pixels for returned assets in search parameters.
     * @param int $filters_area_pixels Image Size in pixels
     * @return SearchParameters object
     * @throws StockApiException if filterAreaPixels is not positive
     */
    public function setFilterAreaPixels(int $filters_area_pixels) : SearchParameters
    {
        if ($filters_area_pixels < 0) {
            throw StockApiException::WithMessage('FilterAreaPixels should be greater than zero');
        }
        
        $this->filters_area_pixels = $filters_area_pixels;
        return $this;
    }
    
    /**
     * Get whether you want to visual serach images or not.
     * @return bool|null whether SimilarImage filter is on or off
     */
    public function getSimilarImage() : ?bool
    {
        return ($this->similar_image == 1) ? true : false;
    }
    
    /**
     * Sets whether you want to visual serach images or not.
     * @param bool $similar_image True or False value
     * @return SearchParameters object
     * @throws StockApiException if Similar image filter is null
     */
    public function setSimilarImage(bool $similar_image) : SearchParameters
    {
        $this->similar_image = ($similar_image == true ) ? 1 : 0;
        return $this;
    }
    
    /**
     * Get whether photos filter is on/off to find assets that are photos.
     * @return bool|null whether ContentTypeVector filter is on or off
     */
    public function getFilterContentTypePhotos() : ?bool
    {
        return ($this->filters_content_type_photos == 1) ? true : false;
    }
    
    /**
     * Sets ContentTypephotos filter in search Params to find assets that are
     * photos.
     * @param bool $filters_content_type_photos True or False value
     * @return SearchParameters object
     * @throws StockApiException if filterContentTypephotos is null
     */
    public function setFilterContentTypePhotos(bool $filters_content_type_photos) : SearchParameters
    {
        $this->filters_content_type_photos = ($filters_content_type_photos == true ) ? 1 : 0;
        return $this;
    }
    /**
     * Get whether illustration filter is on/off to find assets that are illustration.
     * @return bool|null whether ContentTypeillustration filter is on or off
     */
    public function getFilterContentTypeIllustration() : ?bool
    {
        return ($this->filters_content_type_illustration == 1) ? true : false;
    }
    
    /**
     * Sets ContentTypeillustration filter in search Params to find assets that are
     * illustration.
     * @param bool $filters_content_type_illustration True or False value
     * @return SearchParameters object
     * @throws StockApiException if filterContentTypeillustration is null
     */
    public function setFilterContentTypeIllustration(bool $filters_content_type_illustration) : SearchParameters
    {
        $this->filters_content_type_illustration = ($filters_content_type_illustration == true ) ? 1 : 0;
        return $this;
    }
    
    /**
     * Get whether Vector filter is on/off to find assets that are vectors.
     * @return bool|null whether ContentTypeVector filter is on or off
     */
    public function getFilterContentTypeVector() : ?bool
    {
        return ($this->filters_content_type_vector == 1) ? true : false;
    }
    
    /**
     * Sets ContentTypeVector filter in search Params to find assets that are
     * vectors.
     * @param bool $filters_content_type_vector True or False value
     * @return SearchParameters object
     * @throws StockApiException if filterContentTypeVector is null
     */
    public function setFilterContentTypeVector(bool $filters_content_type_vector) : SearchParameters
    {
        $this->filters_content_type_vector = ($filters_content_type_vector == true ) ? 1 : 0;
        return $this;
    }
    
    /**
     * Get whether Videos filter is on/off to find assets that are videos.
     * @return bool|null whether ContentTypeVideo filter is on or off
     */
    public function getFilterContentTypeVideo() : ?bool
    {
        return ($this->filters_content_type_video == 1) ? true : false;
    }
    
    /**
     * Sets ContentTypeVideo filter in search Params to find assets that are
     * videos.
     * @param bool $filters_content_type_video True or False value
     * @return SearchParameters object
     * @throws StockApiException if filterContentTypeVector is null
     */
    public function setFilterContentTypeVideo(bool $filters_content_type_video) : SearchParameters
    {
        $this->filters_content_type_video = ($filters_content_type_video == true ) ? 1 : 0;
        return $this;
    }
    
    /**
     * Get whether Template filter is on/off to find assets that are templates.
     * @return bool|null whether ContentTypeVideo filter is on or off
     */
    public function getFilterContentTypeTemplate() : ?bool
    {
        return ($this->filters_content_type_template == 1) ? true : false;
    }
    
    /**
     * Sets ContentTypeTemplate filter in search Params to find assets that are
     * videos.
     * @param bool $filters_content_type_template True or False value
     * @return SearchParameters object
     * @throws StockApiException if filterContentTypeTemplate is null
     */
    public function setFilterContentTypeTemplate(bool $filters_content_type_template) : SearchParameters
    {
        $this->filters_content_type_template = ($filters_content_type_template == true ) ? 1 : 0;
        return $this;
    }
    
    /**
     * Get whether 3D filter is on/off to find assets that are templates.
     * @return bool|null whether ContentType3D filter is on or off
     */
    public function getFilterContentType3D() : ?bool
    {
        return ($this->filters_content_type_3d == 1) ? true : false;
    }
    
    /**
     * Sets ContentType3D filter in search Params to find assets that are
     * 3D.
     * @param bool $filters_content_type_3d True or False value
     * @return SearchParameters object
     * @throws StockApiException if filterContentType3D is null
     */
    public function setFilterContentType3D(bool $filters_content_type_3d) : SearchParameters
    {
        $this->filters_content_type_3d = ($filters_content_type_3d == true ) ? 1 : 0;
        return $this;
    }
    
    /**
     * Get whether ContentTypeAll filter is on/off to find assets that are templates.
     * @return bool|null whether ContentTypeAll filter is on or off
     */
    public function getFilterContentTypeAll() : ?bool
    {
        return ($this->filters_content_type_all == 1) ? true : false;
    }
    
    /**
     * Sets ContentTypeAll filter in search Params to find assets that are
     * of all types.
     * @param bool $filters_content_type_all True or False value
     * @return SearchParameters object
     * @throws StockApiException if filterContentTypeAll is null
     */
    public function setFilterContentTypeAll(bool $filters_content_type_all) : SearchParameters
    {
        $this->filters_content_type_all = ($filters_content_type_all == true ) ? 1 : 0;
        return $this;
    }
    
    /**
     * Get whether Editorial filter is on/off to find assets that are editorial.
     * @return bool|null whether Editorial filter is on or off
     */
    public function getFilterContentTypeEditorial() : ?bool
    {
        return ($this->filters_editorial == 1) ? true : false;
    }
    
    /**
     * Sets ContentTypeTemplate filter in search Params to find assets that are
     * videos.
     * @param bool $filters_editorial True or False value
     * @return SearchParameters object
     * @throws StockApiException if filterContentTypeVector is null
     */
    public function setFilterContentTypeEditorial(bool $filters_editorial) : SearchParameters
    {
        $this->filters_editorial = ($filters_editorial == true ) ? 1 : 0;
        return $this;
    }
    
    /**
     * Get whether Offensive2 filter is on or off to find assets only if they
     * are flagged as including Explicit/Nudity/Violence.
     * @return bool|null whether Offensive2 filter is on or off
     */
    public function getFilterOffensive2() : ?bool
    {
        return ($this->filters_offensive_2 == 1) ? true : false;
    }
    
    /**
     * Sets Offensive2 filter in search Params to find assets only if they are
     * flagged as including Explicit/Nudity/Violence.
     * @param bool $filters_offensive_2 True or False Value
     * @return SearchParameters object
     * @throws StockApiException if Offensive2 is null
     */
    public function setFilterOffensive2(bool $filters_offensive_2)
    {
        $this->filters_offensive_2 = ($filters_offensive_2 == true) ? 1 : 0;
        return $this;
    }
    
    /**
     * Get whether IsolatedOn filter is on or off to find assets only if the
     * subject is isolated from the background by being on a uniformly colored
     * background.
     * @return whether IsolatedOn filter is on or off
     */
    public function getFilterIsolatedOn() : ?bool
    {
        return ($this->filters_isolated_on == 1) ? true : false;
    }
    
    /**
     * Sets IsolatedOn filter in search Params to find assets only if the
     * subject is isolated from the background by being on a uniformly colored
     * background.
     * @param bool $filters_isolated_on True or False value
     * @return SearchParameters object
     * @throws StockApiException if IsolatedOn is null
     */
    public function setFilterIsolatedOn(bool $filters_isolated_on)
    {
        $this->filters_isolated_on = ($filters_isolated_on == true) ? 1 : 0;
        return $this;
    }
    
    /**
     * Get whether PanoromicOn filter is on or off to find assets that are panoromic.
     * background.
     * @return bool|null whether PanoromicOn filter is on or off
     */
    public function getFilterPanoromicOn() : ?bool
    {
        return ($this->filters_panoromic_on == 1) ? true : false;
    }
    
    /**
     * Sets PanoromicOn filter in search Params to find assets that are Panoromic.
     * @param bool $filters_panoramic_on True or False value
     * @return SearchParameters object
     * @throws StockApiException if IsolatedOn is null
     */
    public function setFilterPanoromicOn(bool $filters_panoramic_on) : SearchParameters
    {
        $this->filters_panoramic_on = ($filters_panoramic_on == true) ? 1 : 0;
        return $this;
    }
    
    /**
     * Get the size of thumbnail(in pixels) for each found asset in search
     * results.
     * @return int|null
     */
    public function getThumbnailSize() : ?int
    {
        return $this->filters_thumbnail_size;
    }
    
    /**
     * Sets the size of thumbnail(in pixels) for each found asset in search
     * results.
     * @param string $filters_thumbnail_size
     * @return SearchParameters object
     * @throws StockApiException if thumbnailSize is not valid
     */
    public function setThumbnailSize(string $filters_thumbnail_size) : SearchParameters
    {
        $sizes = CoreConstants::getSearchParamsThumbSizes();
        $this->filters_thumbnail_size = $sizes[$filters_thumbnail_size];
        return $this;
    }
    
    /**
     * Get the orientation of for each found asset in search results.
     * @return string|null
     */
    public function getOrientation() : ?string
    {
        return $this->filters_orientation;
    }
    
    /**
     * Sets the orientation for each found asset in search results.
     * @param string $filters_orientation
     * @return SearchParameters object
     */
    public function setOrientation(string $filters_orientation) : SearchParameters
    {
        $orientation = CoreConstants::getSearchParamsOrientation();
        $this->filters_orientation = $orientation[$filters_orientation];
        return $this;
    }
    
    /**
     * Get age filter to find assets of the specified age.
     * @return string|null Age of type AssetAge enum
     */
    public function getFilterAge() : ?string
    {
        return $this->filters_age;
    }
    
    /**
     * Sets Age filter in search Params to find assets of the specified age.
     * @param string $filters_age
     * @return SearchParameters object
     */
    public function setFilterAge(string $filters_age) : SearchParameters
    {
        $age = CoreConstants::getSearchParamsAge();
        $this->filters_age = $age[$filters_age];
        return $this;
    }
    
    /**
     * Get VideoDuration that you have set to find videos whose duration is no
     * longer than the specified duration in seconds.
     * @return string|null VideoDuration of type AssetVideoDuration enum
     */
    public function getFilterVideoDuration() : ?string
    {
        return $this->filters_video_duration;
    }
    
    /**
     * Sets VideoDuration to find videos whose duration is no longer than the
     * specified duration in seconds.
     * @param string $filters_video_duration
     * @return SearchParameters object
     */
    public function setFilterVideoDuration(string $filters_video_duration) : SearchParameters
    {
        $duration = CoreConstants::getSearchParamsVideoDuration();
        $this->filters_video_duration = $duration[$filters_video_duration];
        return $this;
    }
    
    /**
     * Get array specifying which template types to return in search results.
     * @return array TemplateTypes
     */
    public function getFilterTemplateTypes() : array
    {
        return $this->filters_template_type_id;
    }
    
    /**
     * Sets array specifying which template types to return in search results.
     * @param array $filters_template_type_id Array of AssetTemplatesType values
     * @return SearchParameters object
     * @throws StockApiException if array is empty or null
     */
    public function setFilterTemplateTypes(array $filters_template_type_id) : SearchParameters
    {
        if ($filters_template_type_id == null) {
            throw StockApiException::WithMessage('Template Types should not be null');
        }
        
        $this->filters_template_type_id = $filters_template_type_id;
        return $this;
    }
    
    /**
     * Get array specifying which 3D types to return in search results.
     * @return array
     */
    public function getFilter3DTypeIds() : array
    {
        return $this->filters_content_type_3d;
    }
    
    /**
     * Sets array specifying which 3D types to return in search results.
     * @param array $filters_content_type_3d
     * @return SearchParameters object
     * @throws StockApiException if 3dTypeIds is null
     */
    public function setFilter3DTypeIds(array $filters_content_type_3d) : SearchParameters
    {
        if ($filters_content_type_3d == null) {
            throw StockApiException::WithMessage('3D Types should not be null');
        }
        
        $this->filters_content_type_3d = $filters_content_type_3d;
        return $this;
    }
    
    /**
     * Get array specifying which template categories to return.
     * @return array
     */
    public function getFilterTemplateCategoryIds() : array
    {
        return $this->filters_template_category_id;
    }
    
    /**
     * Sets array specifying which template categories to return.
     * @param array $filters_template_category_id Array of AssetTemplateCategory values
     * @return SearchParameters object
     * @throws StockApiException if TemplateCategoryIds is null
     */
    public function setFilterTemplateCategoryIds(array $filters_template_category_id)
    {
        if ($filters_template_category_id == null) {
            throw StockApiException::WithMessage('TemplateCategory Ids should not be null');
        }
        
        $this->filters_template_category_id = $filters_template_category_id;
        return $this;
    }
    
    /**
     * Get sorting order in which it will return found assets.
     * @return string|null
     */
    public function getOrder() : ?string
    {
        return $this->order;
    }
    
    /**
     * Sets sorting order in which it will return found assets.
     * @param string $order
     * @return function object
     */
    public function setOrder($order) : SearchParameters
    {
        $order_array = CoreConstants::getSearchParamsOrders();
        $this->order = $order_array[$order];
        return $this;
    }
    
    /**
     * Get premium (pricing) level to find the assests.
     * @return string|null
     */
    public function getFilterPremium() : ?string
    {
        return $this->filters_premium;
    }
    
    /**
     * Sets premium (pricing) level to find the assests.
     * @param string $filters_premium
     * @return SearchParameters object
     */
    public function setFilterPremium(string $filters_premium) : SearchParameters
    {
        $premium = CoreConstants::getSearchParamsPremium();
        $this->filters_premium = $premium[$filters_premium];
        return $this;
    }
    
    /**
     * Get HasReleases filter that you have set to find assets which has model
     * or property releases.
     * @return string|null
     */
    public function getFilterHasReleases() : ?string
    {
        return $this->filters_has_releases;
    }
    
    /**
     * Sets HasReleases filter to find assets which has model or property
     * releases.
     * @param string $filters_has_releases
     * @return SearchParamters
     */
    public function setFilterHasReleases(string $filters_has_releases) : SearchParameters
    {
        $has_releases = CoreConstants::getSearchParamsHasReleases();
        $this->filters_has_releases = $has_releases[$filters_has_releases];
        return $this;
    }
    
    /**
     * array to map variables in uri
     * @return array
     */
    public function getJsonMapper() : array
    {
        return $this->_json_mapper;
    }
}
