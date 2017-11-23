<?php

/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Test;

use \AdobeStock\Api\Models\LicenseThumbnail;
use \PHPUnit\Framework\TestCase;

class LicenseThumbnailTest extends TestCase
{
    /**
     * @var LicenseThumbnail
     */
    private $_license_thumbnail;
    
    /**
     * @var array
     */
    private $_data = [
        'url' => 'test',
        'content_type' => 'image',
        'width' => 1,
        'height' => 5,
    ];
    
    /**
     * @test
     * @before
     */
    public function initializeConstructorOfLicenseThumbnail()
    {
        $this->_license_thumbnail = new LicenseThumbnail($this->_data);
        $this->assertInstanceOf(LicenseThumbnail::class, $this->_license_thumbnail);
    }
    
    /**
     * @test
     */
    public function setterGetterShouldSetGetUrl()
    {
        $this->_license_thumbnail->setUrl('testUrl');
        $this->assertEquals('testUrl', $this->_license_thumbnail->getUrl());
    }
    
    /**
     * @test
     */
    public function setterGetterShouldSetGetContentType()
    {
        $this->_license_thumbnail->setContentType('comp');
        $this->assertEquals('comp', $this->_license_thumbnail->getContentType());
    }
    
    /**
     * @test
     */
    public function setterGetterShouldSetGetWidth()
    {
        $this->_license_thumbnail->setWidth(23);
        $this->assertEquals(23, $this->_license_thumbnail->getWidth());
    }
    
    /**
     * @test
     */
    public function setterGetterShouldSetGetHeight()
    {
        $this->_license_thumbnail->setHeight(23);
        $this->assertEquals(23, $this->_license_thumbnail->getHeight());
    }
}
