<?php
/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Test;

use \AdobeStock\Api\Models\SearchParameters;
use \PHPUnit\Framework\TestCase;

class SearchParametersTest extends TestCase
{
    /**
     * Search Parameters object
     * @var SearchParameters
     */
    public $search_params;
    /**
     * @test
     * @before
     */
    public function initialize()
    {
        $this->search_params = new SearchParameters();
        $this->assertInstanceOf(SearchParameters::class, $this->search_params);
    }
    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function testCreatorId()
    {
        $this->search_params->setCreatorId(100);
        $this->assertEquals(100, $this->search_params->getCreatorId());
        $this->search_params->setCreatorId(-1);
    }
    
    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function testMediaId()
    {
        $this->search_params->setMediaId(100);
        $this->assertEquals(100, $this->search_params->getMediaId());
        $this->search_params->setMediaId(-1);
    }
    
    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function testModelId()
    {
        $this->search_params->setModelId(100);
        $this->assertEquals(100, $this->search_params->getModelId());
        $this->search_params->setModelId(-1);
    }
    
    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function testSerieId()
    {
        $this->search_params->setSerieId(100);
        $this->assertEquals(100, $this->search_params->getSerieId());
        $this->search_params->setSerieId(-1);
    }
    
    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function testSimilar()
    {
        $this->search_params->setSimilar(100);
        $this->assertEquals(100, $this->search_params->getSimilar());
        $this->search_params->setSimilar(-1);
    }
    
    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function testCategory()
    {
        $this->search_params->setCategory(100);
        $this->assertEquals(100, $this->search_params->getCategory());
        $this->search_params->setCategory(-1);
    }
    
    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function testLimit()
    {
        $this->search_params->setLimit(50);
        $this->assertEquals(50, $this->search_params->getLimit());
        $this->search_params->setLimit(-1);
    }
    
    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function testOffset()
    {
        $this->search_params->setOffset(100);
        $this->assertEquals(100, $this->search_params->getOffset());
        $this->search_params->setOffset(-1);
    }
    
    /**
     * @test
     * @expectedException \TypeError
     */
    public function testWords()
    {
        $this->search_params->setWords('Tree');
        $this->assertEquals('Tree', $this->search_params->getWords());
        $this->search_params->setWords(null);
    }
    
    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function testSimilarURL()
    {
        $this->search_params->setSimilarURL('xyz.com');
        $this->assertEquals('xyz.com', $this->search_params->getSimilarURL());
        $this->search_params->setSimilarURL('');
    }
    
    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function testFilterColors()
    {
        $this->search_params->setFilterColors('Blue');
        $this->assertEquals('Blue', $this->search_params->getFilterColors());
        $this->search_params->setFilterColors('');
    }
    
    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function testGalleryId()
    {
        $this->search_params->setGalleryId('Id');
        $this->assertEquals('Id', $this->search_params->getGalleryId());
        $this->search_params->setGalleryId('');
    }
    
    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function testFilterAreaPixels()
    {
        $this->search_params->setFilterAreaPixels(1000);
        $this->assertEquals(1000, $this->search_params->getFilterAreaPixels());
        $this->search_params->setFilterAreaPixels(-1);
    }
    
    /**
     * @test
     */
    public function testFilterContentTypePhotos()
    {
        $this->search_params->setFilterContentTypePhotos(false);
        $this->assertEquals(false, $this->search_params->getFilterContentTypePhotos());
        $this->search_params->setFilterContentTypePhotos(true);
        $this->assertEquals(true, $this->search_params->getFilterContentTypePhotos());
    }
    
    /**
     * @test
     */
    public function testFilterContentTypeIllustration()
    {
        $this->search_params->setFilterContentTypeIllustration(false);
        $this->assertEquals(false, $this->search_params->getFilterContentTypeIllustration());
        $this->search_params->setFilterContentTypeIllustration(true);
        $this->assertEquals(true, $this->search_params->getFilterContentTypeIllustration());
    }
    
    /**
     * @test
     */
    public function testFilterContentTypeVector()
    {
        $this->search_params->setFilterContentTypeVector(false);
        $this->assertEquals(false, $this->search_params->getFilterContentTypeVector());
        $this->search_params->setFilterContentTypeVector(true);
        $this->assertEquals(true, $this->search_params->getFilterContentTypeVector());
    }
    
    /**
     * @test
     */
    public function testFilterContentTypeVideo()
    {
        $this->search_params->setFilterContentTypeVideo(true);
        $this->assertEquals(true, $this->search_params->getFilterContentTypeVideo());
        $this->search_params->setFilterContentTypeVideo(false);
        $this->assertEquals(false, $this->search_params->getFilterContentTypeVideo());
    }
    
    /**
     * @test
     */
    public function testFilterContentTypeTemplate()
    {
        $this->search_params->setFilterContentTypeTemplate(true);
        $this->assertEquals(true, $this->search_params->getFilterContentTypeTemplate());
        $this->search_params->setFilterContentTypeTemplate(false);
        $this->assertEquals(false, $this->search_params->getFilterContentTypeTemplate());
    }
    
    /**
     * @test
     */
    public function testFilterContentType3D()
    {
        $this->search_params->setFilterContentType3D(false);
        $this->assertEquals(false, $this->search_params->getFilterContentType3D());
        $this->search_params->setFilterContentType3D(true);
        $this->assertEquals(true, $this->search_params->getFilterContentType3D());
    }
    
    /**
     * @test
     */
    public function testFilterContentTypeAll()
    {
        $this->search_params->setFilterContentTypeAll(false);
        $this->assertEquals(false, $this->search_params->getFilterContentTypeAll());
        $this->search_params->setFilterContentTypeAll(true);
        $this->assertEquals(true, $this->search_params->getFilterContentTypeAll());
    }
    
    /**
     * @test
     */
    public function testFilterEditorial()
    {
        $this->search_params->setFilterContentTypeEditorial(true);
        $this->assertEquals(true, $this->search_params->getFilterContentTypeEditorial());
        $this->search_params->setFilterContentTypeEditorial(false);
        $this->assertEquals(false, $this->search_params->getFilterContentTypeEditorial());
    }
    
    /**
     * @test
     */
    public function testFilterOffensive2()
    {
        $this->search_params->setFilterOffensive2(true);
        $this->assertEquals(true, $this->search_params->getFilterOffensive2());
        $this->search_params->setFilterOffensive2(false);
        $this->assertEquals(false, $this->search_params->getFilterOffensive2());
    }
    
    /**
     * @test
     */
    public function testFilterIsolatedOn()
    {
        $this->search_params->setFilterIsolatedOn(true);
        $this->assertEquals(true, $this->search_params->getFilterIsolatedOn());
        $this->search_params->setFilterIsolatedOn(false);
        $this->assertEquals(false, $this->search_params->getFilterIsolatedOn());
    }
    
    /**
     * @test
     */
    public function testFilterPanoromicOn()
    {
        $this->search_params->setFilterPanoromicOn(false);
        $this->assertEquals(false, $this->search_params->getFilterPanoromicOn());
    }
    
    /**
     * @test
     */
    public function testThumbnailSize()
    {
        $this->search_params->setThumbnailSize('BIG');
        $this->assertEquals(160, $this->search_params->getThumbnailSize());
    }
    
    /**
     * @test
     */
    public function testOrientation()
    {
        $this->search_params->setOrientation('SQUARE');
        $this->assertEquals('square', $this->search_params->getOrientation());
    }
    
    /**
     * @test
     */
    public function testFilterAge()
    {
        $this->search_params->setFilterAge('ALL');
        $this->assertEquals('all', $this->search_params->getFilterAge());
    }
    
    /**
     * @test
     */
    public function testFilterVideoDuration()
    {
        $this->search_params->setFilterVideoDuration('ALL');
        $this->assertEquals('all', $this->search_params->getFilterVideoDuration());
    }
    
    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function testFilterTemplateTypes()
    {
        $type = [
            'PSDT',
        ];
        $this->search_params->setFilterTemplateTypes($type);
        $this->assertEquals($type, $this->search_params->getFilterTemplateTypes());
        $this->search_params->setFilterTemplateTypes([]);
    }
    
    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function testFilter3DTypeIds()
    {
        $type = [
            'Models',
        ];
        $this->search_params->setFilter3DTypeIds($type);
        $this->assertEquals($type, $this->search_params->getFilter3DTypeIds());
        $this->search_params->setFilter3DTypeIds([]);
    }
    
    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function testFilterTemplateCategoryIds()
    {
        $type = [
            'ALL',
        ];
        $this->search_params->setFilterTemplateCategoryIds($type);
        $this->assertEquals($type, $this->search_params->getFilterTemplateCategoryIds());
        $this->search_params->setFilterTemplateCategoryIds([]);
    }
    
    /**
     * @test
     */
    public function testOrder()
    {
        $this->search_params->setOrder('RELEVANCE');
        $this->assertEquals('relevance', $this->search_params->getOrder());
    }
    
    /**
     * @test
     */
    public function testFilterPremium()
    {
        $this->search_params->setFilterPremium('TRUE');
        $this->assertEquals('true', $this->search_params->getFilterPremium());
    }
    
    /**
     * @test
     */
    public function testFilterHasReleases()
    {
        $this->search_params->setFilterHasReleases('TRUE');
        $this->assertEquals('true', $this->search_params->getFilterHasReleases());
    }
    
    /**
     * @test
     */
    public function testFilterSimilarImage()
    {
        $this->search_params->setSimilarImage(true);
        $this->assertEquals(true, $this->search_params->getSimilarImage());
        $this->search_params->setSimilarImage(false);
        $this->assertEquals(false, $this->search_params->getSimilarImage());
    }
}
