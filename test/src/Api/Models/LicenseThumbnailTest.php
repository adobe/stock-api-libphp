<?php

/*************************************************************************
 * ADOBE CONFIDENTIAL
 * ___________________
 *
 *  Copyright 2016 Adobe Systems Incorporated
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
