<?php
/*************************************************************************
 * ADOBE CONFIDENTIAL
 * ___________________
 *
 *  Copyright 2017 Adobe Systems Incorporated
 *  All Rights Reserved.
 *
 * NOTICE:  All information contained herein is, and remains
 * the property of Adobe Systems Incorporated and its suppliers,
 * if any.  The intellectual and technical concepts contained
 * herein are proprietary to Adobe Systems Incorporated and its
 * suppliers and are protected by all applicable intellectual property
 * laws, including trade secret and copyright laws.
 * Dissemination of this information or reproduction of this material
 * is strictly forbidden unless prior written permission is obtained
 * from Adobe Systems Incorporated.
 **************************************************************************/
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
     * @expectedException \AdobeStock\Api\Exception\StockApi
     * @expectedExceptionMessage Limit should be greater than 0
     */
    public function testLimit()
    {
        $this->search_params_license_history->setLimit(50);
        $this->assertEquals(50, $this->search_params_license_history->getLimit());
        $this->search_params_license_history->setLimit(-1);
    }
    
    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     * @expectedExceptionMessage Offset should be greater than 0
     */
    public function testOffset()
    {
        $this->search_params_license_history->setOffset(100);
        $this->assertEquals(100, $this->search_params_license_history->getOffset());
        $this->search_params_license_history->setOffset(-1);
    }
    
    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     * @expectedExceptionMessage Invalid Thumbnail size
     */
    public function testThumbnailSize()
    {
        $this->search_params_license_history->setThumbnailSize(110);
        $this->assertEquals(110, $this->search_params_license_history->getThumbnailSize());
        $this->search_params_license_history->setThumbnailSize(100);
    }
}
