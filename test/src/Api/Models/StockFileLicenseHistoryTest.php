<?php
/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Test;

use \AdobeStock\Api\Models\StockFileLicenseHistory as StockFileLicenseHistoryModels;
use \PHPUnit\Framework\TestCase;

class StockFileLicenseHistoryTest extends TestCase
{
    /**
     * @var StockFileLicenseHistoryModels
     */
    private $_stock_file_license_history_object;
    
    /**
     * @test
     * @before
     */
    public function initializeConstructorOfStockFileLicenseHistory()
    {
        $raw_response = [
            'license' => 'FILE::LICENSE::N/A',
            'license_date' => '8/11/17, 9:38 AM',
            'download_url' => 'test',
            'id' => 1,
            'creator_name' => 'Patrick',
            'creator_id' => 2,
        ];
        $this->_stock_file_license_history_object = new StockFileLicenseHistoryModels($raw_response);
        $this->assertInstanceOf(StockFileLicenseHistoryModels::class, $this->_stock_file_license_history_object);
    }
    
    /**
     * @test
     */
    public function testAllTheGettersSettersReturnandSetTheProperValue()
    {
        $this->_stock_file_object_license_history = new StockFileLicenseHistoryModels([]);
        
        $this->_stock_file_object_license_history->setLicense('test');
        $this->assertEquals('test', $this->_stock_file_object_license_history->getLicense());
        
        $this->_stock_file_object_license_history->setLicenseDate('8/11/17, 9:38 AM');
        $this->assertEquals('8/11/17, 9:38 AM', $this->_stock_file_object_license_history->getLicenseDate());
        
        $this->_stock_file_object_license_history->setDownloadUrl('test');
        $this->assertEquals('test', $this->_stock_file_object_license_history->getDownloadUrl());
        
        $this->_stock_file_object_license_history->setContentUrl('test');
        $this->assertEquals('test', $this->_stock_file_object_license_history->getContentUrl());
        
        $this->_stock_file_object_license_history->setId(1);
        $this->assertEquals(1, $this->_stock_file_object_license_history->getId());
       
        $this->_stock_file_object_license_history->setTitle('test');
        $this->assertEquals('test', $this->_stock_file_object_license_history->getTitle());
        
        $this->_stock_file_object_license_history->setCreatorId(1);
        $this->assertEquals(1, $this->_stock_file_object_license_history->getCreatorId());
        
        $this->_stock_file_object_license_history->setVectorType('test');
        $this->assertEquals('test', $this->_stock_file_object_license_history->getVectorType());
        
        $this->_stock_file_object_license_history->setCreatorName('John');
        $this->assertEquals('John', $this->_stock_file_object_license_history->getCreatorName());
       
        $this->_stock_file_object_license_history->setThumbnailUrl('https://as2.ftcdn.net/jpg/00/97/43/17/500_F_97431744_D04XIt3wHS2hJI1ooXoHIdtHbLOrBMSE.jpg');
        $this->assertEquals('https://as2.ftcdn.net/jpg/00/97/43/17/500_F_97431744_D04XIt3wHS2hJI1ooXoHIdtHbLOrBMSE.jpg', $this->_stock_file_object_license_history->getThumbnailUrl());
       
        $this->_stock_file_object_license_history->setThumbnailWidth(101);
        $this->assertEquals(101, $this->_stock_file_object_license_history->getThumbnailWidth());
        
        $this->_stock_file_object_license_history->setThumbnailHeight(101);
        $this->assertEquals(101, $this->_stock_file_object_license_history->getThumbnailHeight());
        
        $this->_stock_file_object_license_history->setThumbnail110Url('https://as2.ftcdn.net/jpg/00/97/43/17/110_F_97431744_D04XIt3wHS2hJI1ooXoHIdtHbLOrBMSE.jpg');
        $this->assertEquals('https://as2.ftcdn.net/jpg/00/97/43/17/110_F_97431744_D04XIt3wHS2hJI1ooXoHIdtHbLOrBMSE.jpg', $this->_stock_file_object_license_history->getThumbnail110Url());
        
        $this->_stock_file_object_license_history->setThumbnail110Width(110.0);
        $this->assertEquals(110.0, $this->_stock_file_object_license_history->getThumbnail110Width());
        
        $this->_stock_file_object_license_history->setThumbnail110Height(110);
        $this->assertEquals(110, $this->_stock_file_object_license_history->getThumbnail110Height());
        
        $this->_stock_file_object_license_history->setThumbnail160Url('url');
        $this->assertEquals('url', $this->_stock_file_object_license_history->getThumbnail160Url());
        
        $this->_stock_file_object_license_history->setThumbnail160Width(160.0);
        $this->assertEquals(160.0, $this->_stock_file_object_license_history->getThumbnail160Width());
        
        $this->_stock_file_object_license_history->setThumbnail160Height(2);
        $this->assertEquals(2, $this->_stock_file_object_license_history->getThumbnail160Height());
        
        $this->_stock_file_object_license_history->setThumbnail220Url('test');
        $this->assertEquals('test', $this->_stock_file_object_license_history->getThumbnail220Url());
        
        $this->_stock_file_object_license_history->setThumbnail220Width(220.0);
        $this->assertEquals(220.0, $this->_stock_file_object_license_history->getThumbnail220Width());
        
        $this->_stock_file_object_license_history->setThumbnail220Height(2);
        $this->assertEquals(2, $this->_stock_file_object_license_history->getThumbnail220Height());
        
        $this->_stock_file_object_license_history->setThumbnail240Url('test');
        $this->assertEquals('test', $this->_stock_file_object_license_history->getThumbnail240Url());
        
        $this->_stock_file_object_license_history->setThumbnail240Width(240.0);
        $this->assertEquals(240.0, $this->_stock_file_object_license_history->getThumbnail240Width());
        
        $this->_stock_file_object_license_history->setThumbnail240Height(240);
        $this->assertEquals(240, $this->_stock_file_object_license_history->getThumbnail240Height());
        
        $this->_stock_file_object_license_history->setThumbnail500Url('test');
        $this->assertEquals('test', $this->_stock_file_object_license_history->getThumbnail500Url());
        
        $this->_stock_file_object_license_history->setThumbnail500Width(500.0);
        $this->assertEquals(500.0, $this->_stock_file_object_license_history->getThumbnail500Width());
        
        $this->_stock_file_object_license_history->setThumbnail500Height(500);
        $this->assertEquals(500, $this->_stock_file_object_license_history->getThumbnail500Height());
        
        $this->_stock_file_object_license_history->setThumbnail1000Url('url');
        $this->assertEquals('url', $this->_stock_file_object_license_history->getThumbnail1000Url());
        
        $this->_stock_file_object_license_history->setThumbnail1000Width(1000.0);
        $this->assertEquals(1000.0, $this->_stock_file_object_license_history->getThumbnail1000Width());
        
        $this->_stock_file_object_license_history->setThumbnail1000Height(1000);
        $this->assertEquals(1000, $this->_stock_file_object_license_history->getThumbnail1000Height());
        
        $this->_stock_file_object_license_history->setWidth(1000);
        $this->assertEquals(1000, $this->_stock_file_object_license_history->getWidth());
        
        $this->_stock_file_object_license_history->setHeight(5000);
        $this->assertEquals(5000, $this->_stock_file_object_license_history->getHeight());
        
        $this->_stock_file_object_license_history->setDetailsUrl('test');
        $this->assertEquals('test', $this->_stock_file_object_license_history->getDetailsUrl());
        
        $this->_stock_file_object_license_history->setMediaTypeId(1043);
        $this->assertEquals(1043, $this->_stock_file_object_license_history->getMediaTypeId());
        
        $this->_stock_file_object_license_history->setContentType('content');
        $this->assertEquals('content', $this->_stock_file_object_license_history->getContentType());
    }
}
