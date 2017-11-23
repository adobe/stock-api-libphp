<?php

/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Test;

use \AdobeStock\Api\Models\LicenseComp;
use \PHPUnit\Framework\TestCase;

class LicenseCompTest extends TestCase
{
    /**
     * @var LicenseComp
     */
    private $_license_comp;
    
    /**
     * @var array
     */
    private $_data = [
        'url' => 'http://adobetest.com',
        'content_type' => 'test',
        'width' => 1,
        'heigth' => 1,
        'frame_rate' => 1.2,
        'content_length' => 1,
        'duration' => 1,
    ];
    
    /**
     * @test
     * @before
     */
    public function initializeConstructorOfLicenseComp()
    {
        $this->_license_comp = new LicenseComp($this->_data);
        $this->assertInstanceOf(LicenseComp::class, $this->_license_comp);
    }
    
    /**
     * @test
     */
    public function setterGetterShouldSetGetUrl()
    {
        $this->_license_comp->setUrl('testUrl');
        $this->assertEquals('testUrl', $this->_license_comp->getUrl());
    }
    
    /**
     * @test
     */
    public function setterGetterShouldSetGetContentType()
    {
        $this->_license_comp->setContentType('comp');
        $this->assertEquals('comp', $this->_license_comp->getContentType());
    }
    
    /**
     * @test
     */
    public function setterGetterShouldSetGetWidth()
    {
        $this->_license_comp->setWidth(23);
        $this->assertEquals(23, $this->_license_comp->getWidth());
    }
    
    /**
     * @test
     */
    public function setterGetterShouldSetGetHeight()
    {
        $this->_license_comp->setHeight(23);
        $this->assertEquals(23, $this->_license_comp->getHeight());
    }
    
    /**
     * @test
     */
    public function setterGetterShouldSetGetFrameRate()
    {
        $this->_license_comp->setFrameRate(2.1);
        $this->assertEquals(2.1, $this->_license_comp->getFrameRate());
    }
    
    /**
     * @test
     */
    public function setterGetterShouldSetGetContentLength()
    {
        $this->_license_comp->setContentLength(23);
        $this->assertEquals(23, $this->_license_comp->getContentLength());
    }
    
    /**
     * @test
     */
    public function setterGetterShouldSetGetDuration()
    {
        $this->_license_comp->setDuration(5);
        $this->assertEquals(5, $this->_license_comp->getDuration());
    }
}
