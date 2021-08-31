<?php
/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */
namespace AdobeStock\Test;

use \AdobeStock\Api\Models\SearchParamLicenseHistory as SearchParamLicenseHistoryModel;
use \PHPUnit\Framework\TestCase;

class SearchParamLicenseHistoryTest extends TestCase
{
    /**
     * @var SearchParamLicenseHistoryModel
     */
    public $search_params_license_history;
    
    /**
     * @test
     * @before
     */
    public function initialize()
    {
        $this->search_params_license_history = new SearchParamLicenseHistoryModel();
        $this->assertInstanceOf(SearchParamLicenseHistoryModel::class, $this->search_params_license_history);
    }
    
    /**
     * @test
     */
    public function testLimit()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->expectExceptionMessage('Limit should be greater than 0');
        $this->search_params_license_history->setLimit(50);
        $this->assertEquals(50, $this->search_params_license_history->getLimit());
        $this->search_params_license_history->setLimit(-1);
    }
    
    /**
     * @test
     */
    public function testOffset()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->expectExceptionMessage('Offset should be greater than 0');
        $this->search_params_license_history->setOffset(100);
        $this->assertEquals(100, $this->search_params_license_history->getOffset());
        $this->search_params_license_history->setOffset(-1);
    }
    
    /**
     * @test
     */
    public function testThumbnailSize()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->expectExceptionMessage('Invalid Thumbnail size');
        $this->search_params_license_history->setThumbnailSize(110);
        $this->assertEquals(110, $this->search_params_license_history->getThumbnailSize());
        $this->search_params_license_history->setThumbnailSize(100);
    }
}
