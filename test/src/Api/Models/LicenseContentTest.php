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

use \AdobeStock\Api\Models\LicenseContent;
use \AdobeStock\Api\Models\LicenseThumbnail;
use \AdobeStock\Api\Models\LicenseComp;
use \AdobeStock\Api\Models\LicensePurchaseDetails;
use \PHPUnit\Framework\TestCase;

class LicenseContentTest extends TestCase
{
    /**
     * @var LicenseContent
     */
    private $_license_content;
    
    /**
     * @var array
     */
    private $_data = [
        'content_id' => 1,
        'purchase_details' => [],
        'size' => 'test',
        'comp' => [],
        'thumbnail' => [],
    ];
    
    /**
     * @test
     * @before
     */
    public function initializeConstructorOfLicenseContent()
    {
        $this->_license_content = new LicenseContent($this->_data);
        $this->assertInstanceOf(LicenseContent::class, $this->_license_content);
    }
    
    /**
     * @test
     */
    public function setterGetterShouldSetGetContentId()
    {
        $this->_license_content->setContentId(123);
        $this->assertEquals(123, $this->_license_content->getContentId());
    }
    
    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function setterGetterShouldSetGetSize()
    {
        $this->_license_content->setSize('Comp');
        $this->assertEquals('Comp', $this->_license_content->getSize());
        $this->_license_content->setSize('Original');
        $this->assertEquals('Original', $this->_license_content->getSize());
        $this->_license_content->setSize('Compsss');
    }
    
    /**
     * @test
     */
    public function setterGetterShouldSetGetThumbnail()
    {
        $thumbnail = new LicenseThumbnail([]);
        $thumbnail->setUrl('test');
        $this->_license_content->setThumbnail($thumbnail);
        $this->assertEquals('test', $this->_license_content->getThumbnail()->getUrl());
    }
    
    /**
     * @test
     */
    public function setterGetterShouldSetGetComp()
    {
        $thumbnail = new LicenseComp([]);
        $thumbnail->setUrl('test');
        $this->_license_content->setComp($thumbnail);
        $this->assertEquals('test', $this->_license_content->getComp()->getUrl());
    }
    
    /**
     * @test
     */
    public function setterGetterShouldSetGetPurchaseDetails()
    {
        $thumbnail = new LicensePurchaseDetails([]);
        $thumbnail->setUrl('test');
        $this->_license_content->setPurchaseDetails($thumbnail);
        $this->assertEquals('test', $this->_license_content->getPurchaseDetails()->getUrl());
    }
}
