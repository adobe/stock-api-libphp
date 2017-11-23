<?php
/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Test;

use \PHPUnit\Framework\TestCase;
use \AdobeStock\Api\Models\StockFile as StockFileModels;
use \AdobeStock\Api\Response\SearchCategory as SearchCategoryResponse;
use \AdobeStock\Api\Models\StockFileComps as StockFileCompsModels;
use \AdobeStock\Api\Models\StockFileLicenses as StockFileLicensesModels;

class StockFileTest extends TestCase
{
    /**
     * StockFileTest class object
     * @var StockFileTest
     */
    private $_stock_file_object;
    
    /**
     * @test
     * @before
     */
    public function initializeConstructorOfStockFile()
    {
        $raw_response = [
            'category' => [
                'name' => 'TreeSearch',
            ],
            'keywords' => [
                [
                    'name' => 'Forest',
                ],
                [
                    'name' => 'Tree',
                ],
            ],
            'comps' => [
                'Standard' => [
                    'width' => 100,
                    'height' => 200,
                    'url' => 'http://adobetest.com',
                ],
            ],
            'licenses' => [
                'Standard' => [],
            ],
            'creation_date' => '',
        ];
        $this->_stock_file_object = new StockFileModels($raw_response);
        $this->assertInstanceOf(StockFileModels::class, $this->_stock_file_object);
    }
    
    /**
     * @test
     */
    public function testAllTheGettersSettersReturnandSetTheProperValue()
    {
        $this->_stock_file_object = new StockFileModels([]);
        
        $this->_stock_file_object->setId(101);
        $this->assertEquals(101, $this->_stock_file_object->getId());
        
        $this->_stock_file_object->setTitle('tree');
        $this->assertEquals('tree', $this->_stock_file_object->getTitle());
        
        $this->_stock_file_object->setCreatorId(101);
        $this->assertEquals(101, $this->_stock_file_object->getCreatorId());
        
        $this->_stock_file_object->setCreatorName('John');
        $this->assertEquals('John', $this->_stock_file_object->getCreatorName());
        
        $this->_stock_file_object->setCreationDate('2017-07-25 23:45:55.123456');
        $this->assertEquals('2017-07-25 23:45:55', $this->_stock_file_object->getCreationDate());
        
        $this->_stock_file_object->setCountryName('England');
        $this->assertEquals('England', $this->_stock_file_object->getCountryName());
        
        $this->_stock_file_object->setThumbnailUrl('https://as2.ftcdn.net/jpg/00/97/43/17/500_F_97431744_D04XIt3wHS2hJI1ooXoHIdtHbLOrBMSE.jpg');
        $this->assertEquals('https://as2.ftcdn.net/jpg/00/97/43/17/500_F_97431744_D04XIt3wHS2hJI1ooXoHIdtHbLOrBMSE.jpg', $this->_stock_file_object->getThumbnailUrl());
        
        $this->_stock_file_object->setThumbnailHtmlTag('<img src=\"https://as2.ftcdn.net/jpg/00/97/43/17/500_F_97431744_D04XIt3wHS2hJI1ooXoHIdtHbLOrBMSE.jpg\" alt=\"play button icon design Illustration\" title=\"Vector: play button icon design Illustration\" zoom_ratio=\"0\" />');
        $this->assertEquals('<img src=\"https://as2.ftcdn.net/jpg/00/97/43/17/500_F_97431744_D04XIt3wHS2hJI1ooXoHIdtHbLOrBMSE.jpg\" alt=\"play button icon design Illustration\" title=\"Vector: play button icon design Illustration\" zoom_ratio=\"0\" />', $this->_stock_file_object->getThumbnailHtmlTag());
        
        $this->_stock_file_object->setThumbnailWidth(101);
        $this->assertEquals(101, $this->_stock_file_object->getThumbnailWidth());
        
        $this->_stock_file_object->setThumbnailHeight(101);
        $this->assertEquals(101, $this->_stock_file_object->getThumbnailHeight());
        
        $this->_stock_file_object->setThumbnail110Url('https://as2.ftcdn.net/jpg/00/97/43/17/110_F_97431744_D04XIt3wHS2hJI1ooXoHIdtHbLOrBMSE.jpg');
        $this->assertEquals('https://as2.ftcdn.net/jpg/00/97/43/17/110_F_97431744_D04XIt3wHS2hJI1ooXoHIdtHbLOrBMSE.jpg', $this->_stock_file_object->getThumbnail110Url());
        
        $this->_stock_file_object->setThumbnail110Width(110.0);
        $this->assertEquals(110.0, $this->_stock_file_object->getThumbnail110Width());
        
        $this->_stock_file_object->setThumbnail110Height(110);
        $this->assertEquals(110, $this->_stock_file_object->getThumbnail110Height());
        
        $this->_stock_file_object->setThumbnail160Url(null);
        $this->assertEquals(null, $this->_stock_file_object->getThumbnail160Url());
        
        $this->_stock_file_object->setThumbnail160Width(160.0);
        $this->assertEquals(160.0, $this->_stock_file_object->getThumbnail160Width());
        
        $this->_stock_file_object->setThumbnail160Height(null);
        $this->assertEquals(null, $this->_stock_file_object->getThumbnail160Height());
        
        $this->_stock_file_object->setThumbnail220Url(null);
        $this->assertEquals(null, $this->_stock_file_object->getThumbnail220Url());
        
        $this->_stock_file_object->setThumbnail220Width(220.0);
        $this->assertEquals(220.0, $this->_stock_file_object->getThumbnail220Width());
        
        $this->_stock_file_object->setThumbnail220Height(null);
        $this->assertEquals(null, $this->_stock_file_object->getThumbnail220Height());
        
        $this->_stock_file_object->setThumbnail240Url(null);
        $this->assertEquals(null, $this->_stock_file_object->getThumbnail240Url());
        
        $this->_stock_file_object->setThumbnail240Width(240.0);
        $this->assertEquals(240.0, $this->_stock_file_object->getThumbnail240Width());
        
        $this->_stock_file_object->setThumbnail240Height(null);
        $this->assertEquals(null, $this->_stock_file_object->getThumbnail240Height());
        
        $this->_stock_file_object->setThumbnail500Url(null);
        $this->assertEquals(null, $this->_stock_file_object->getThumbnail500Url());
        
        $this->_stock_file_object->setThumbnail500Width(500.0);
        $this->assertEquals(500.0, $this->_stock_file_object->getThumbnail500Width());
        
        $this->_stock_file_object->setThumbnail500Height(null);
        $this->assertEquals(null, $this->_stock_file_object->getThumbnail500Height());
        
        $this->_stock_file_object->setThumbnail1000Url(null);
        $this->assertEquals(null, $this->_stock_file_object->getThumbnail1000Url());
        
        $this->_stock_file_object->setThumbnail1000Width(1000.0);
        $this->assertEquals(1000.0, $this->_stock_file_object->getThumbnail1000Width());
        
        $this->_stock_file_object->setThumbnail1000Height(null);
        $this->assertEquals(null, $this->_stock_file_object->getThumbnail1000Height());
        
        $this->_stock_file_object->setWidth(1000);
        $this->assertEquals(1000, $this->_stock_file_object->getWidth());
        
        $this->_stock_file_object->setHeight(5000);
        $this->assertEquals(5000, $this->_stock_file_object->getHeight());
        
        $this->_stock_file_object->setIsLicensed('EMPTY');
        $this->assertEquals('', $this->_stock_file_object->getIsLicensed());
        
        $this->_stock_file_object->setCompUrl(null);
        $this->assertEquals(null, $this->_stock_file_object->getCompUrl());
        
        $this->_stock_file_object->setCompWidth(1000);
        $this->assertEquals(1000, $this->_stock_file_object->getCompWidth());
        
        $this->_stock_file_object->setCompHeight(null);
        $this->assertEquals(null, $this->_stock_file_object->getCompHeight());
        
        $this->_stock_file_object->setNbViews(123);
        $this->assertEquals(123, $this->_stock_file_object->getNbViews());
        
        $this->_stock_file_object->setNbDownloads(456);
        $this->assertEquals(456, $this->_stock_file_object->getNbDownloads());
        
        $this->_stock_file_object->setCategory(789, 'John');
        $this->assertInstanceOf(SearchCategoryResponse::class, $this->_stock_file_object->getCategory());
        
        $this->_stock_file_object->setKeywords([]);
        $this->assertEquals([], $this->_stock_file_object->getKeywords());
        
        $this->_stock_file_object->setHasReleases(false);
        $this->assertEquals(false, $this->_stock_file_object->getHasReleases());
        
        $this->_stock_file_object->setAssetTypeId('PHOTOS');
        $this->assertEquals(1, $this->_stock_file_object->getAssetTypeId());
        
        $this->_stock_file_object->setVectorType('test');
        $this->assertEquals('test', $this->_stock_file_object->getVectorType());
        
        $this->_stock_file_object->setFrameRate(1.1);
        $this->assertEquals(1.1, $this->_stock_file_object->getFrameRate());
        
        $this->_stock_file_object->setDuration(60);
        $this->assertEquals(60, $this->_stock_file_object->getDuration());
        
        $this->_stock_file_object->setStockId('test');
        $this->assertEquals('test', $this->_stock_file_object->getStockId());
        
        $this->_stock_file_object->setComps(new StockFileCompsModels([]));
        $this->assertInstanceOf(StockFileCompsModels::class, $this->_stock_file_object->getComps());
        
        $this->_stock_file_object->setDetailsUrl('test');
        $this->assertEquals('test', $this->_stock_file_object->getDetailsUrl());
        
        $this->_stock_file_object->setTemplateTypeId('PSDT');
        $this->assertEquals(1, $this->_stock_file_object->getTemplateTypeId());
        
        $template_ids = [
            'MOBILE',
            'WEB',
        ];
        $template_ids_value = [
            1,
            2,
        ];
        $this->_stock_file_object->setTemplateCategoryIds($template_ids);
        $this->assertEquals($template_ids_value, $this->_stock_file_object->getTemplateCategoryIds());
        
        $this->_stock_file_object->setMarketingText('test');
        $this->assertEquals('test', $this->_stock_file_object->getMarketingText());
        
        $this->_stock_file_object->setDescription('test');
        $this->assertEquals('test', $this->_stock_file_object->getDescription());
        
        $this->_stock_file_object->setSizeBytes(60);
        $this->assertEquals(60, $this->_stock_file_object->getSizeBytes());
        
        $this->_stock_file_object->setPremiumLevelId('FREE');
        $this->assertEquals(1, $this->_stock_file_object->getPremiumLevelId());
        
        $this->_stock_file_object->setIsPremium(false);
        $this->assertEquals(false, $this->_stock_file_object->getIsPremium());
        
        $this->_stock_file_object->setLicenses(new StockFileLicensesModels([]));
        $this->assertInstanceOf(StockFileLicensesModels::class, $this->_stock_file_object->getLicenses());
        
        $this->_stock_file_object->setVideoPreviewUrl('test');
        $this->assertEquals('test', $this->_stock_file_object->getVideoPreviewUrl());
        
        $this->_stock_file_object->setVideoPreviewHeight(60);
        $this->assertEquals(60, $this->_stock_file_object->getVideoPreviewHeight());
        
        $this->_stock_file_object->setVideoPreviewWidth(60);
        $this->assertEquals(60, $this->_stock_file_object->getVideoPreviewWidth());
        
        $this->_stock_file_object->setVideoPreviewContentLength(60);
        $this->assertEquals(60, $this->_stock_file_object->getVideoPreviewContentLength());
        
        $this->_stock_file_object->setVideoPreviewContentType('test');
        $this->assertEquals('test', $this->_stock_file_object->getVideoPreviewContentType());
        
        $this->_stock_file_object->setVideoSmallPreviewUrl('test');
        $this->assertEquals('test', $this->_stock_file_object->getVideoSmallPreviewUrl());
        
        $this->_stock_file_object->setVideoSmallPreviewHeight(60);
        $this->assertEquals(60, $this->_stock_file_object->getVideoSmallPreviewHeight());
        
        $this->_stock_file_object->setVideoSmallPreviewWidth(60);
        $this->assertEquals(60, $this->_stock_file_object->getVideoSmallPreviewWidth());
        
        $this->_stock_file_object->setVideoSmallPreviewContentLength(60);
        $this->assertEquals(60, $this->_stock_file_object->getVideoSmallPreviewContentLength());
        
        $this->_stock_file_object->setVideoSmallPreviewContentType('test');
        $this->assertEquals('test', $this->_stock_file_object->getVideoSmallPreviewContentType());
        
        $this->_stock_file_object->setMediaTypeId(1043);
        $this->assertEquals(1043, $this->_stock_file_object->getMediaTypeId());
        
        $this->_stock_file_object->setContentType('content');
        $this->assertEquals('content', $this->_stock_file_object->getContentType());
    }
}
