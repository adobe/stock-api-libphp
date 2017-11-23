<?php
/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Models;

use \AdobeStock\Api\Models\StockFileCompProp as StockFileCompPropModels;

class StockFileComps
{
    /**
     * Standard format property of complementary asset.
     * @var StockFileCompPropModels
     */
    public $standard;
    
    /**
     * Video_HD format property of complementary asset.
     * @var StockFileCompPropModels
     */
    public $video_hd;
    
    /**
     * Video_4k format property of complementary asset.
     * @var StockFileCompPropModels
     */
    public $video_4k;
    
    /**
     * Json Mapper for class variables
     * @var array
     */
    public $json_mapper = [
        'Standard' => 'standard',
        'Video_HD' => 'video_hd',
        'Video_4K' => 'video_4k',
    ];
    
    /**
     * Constructor for StockFileCompPropModels
     * @param array $raw_response Array contains value of various keys of StockFileComps Class
     */
    public function __construct(array $raw_response)
    {
        foreach ($raw_response as $key => $val) {
            
            if (property_exists($this, $this->json_mapper[$key])) {
                
                if (is_array($val)) {
                    $this->json_mapper[$key] = new StockFileCompPropModels($val);
                }
            }
        }
    }
    
    /**
     * Get Standard format property of complementary asset.
     * @return StockFileCompPropModels
     */
    public function getStandard() : StockFileCompPropModels
    {
        return $this->standard;
    }
    
    /**
     * Get Video_HD format property of complementary asset.
     * @return StockFileCompPropModels
     */
    public function getVideoHD() : StockFileCompPropModels
    {
        return $this->video_hd;
    }
    
    /**
     * Get Video_4k format property of complementary asset.
     * @return StockFileCompPropModels
     */
    public function getVideo4K() : StockFileCompPropModels
    {
        return $this->video_4k;
    }
    
    /**
     * Sets Standard format property of complementary asset.
     * @param StockFileCompPropModels $standard
     * @return StockFileComps
     */
    public function setStandard(StockFileCompPropModels $standard) : StockFileComps
    {
        $this->standard = $standard;
        return $this;
    }
    
    /**
     * Sets Video_HD format property of complementary asset.
     * @param StockFileCompPropModels $video_hd
     * @return StockFileComps
     */
    public function setVideoHD(StockFileCompPropModels $video_hd) : StockFileComps
    {
        $this->video_hd = $video_hd;
        return $this;
    }
    
    /**
     * Sets Video_4k format property of complementary asset.
     * @param StockFileCompPropModels $video_4k
     * @return StockFileComps
     */
    public function setVideo4K(StockFileCompPropModels $video_4k) : StockFileComps
    {
        $this->video_4k = $video_4k;
        return $this;
    }
}
