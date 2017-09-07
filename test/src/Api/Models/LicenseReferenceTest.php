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

use \AdobeStock\Api\Models\LicenseReference;
use \PHPUnit\Framework\TestCase;

class LicenseReferenceTest extends TestCase
{
    /**
     * @var LicenseReference
     */
    private $_license_reference;
    
    /**
     * @var array
     */
    private $_data = [
        'id' => 1,
        'value' => 'test',
    ];
    
    /**
     * @test
     * @before
     */
    public function initializeConstructorOfLicenseReference()
    {
        $this->_license_reference = new LicenseReference($this->_data);
        $this->assertInstanceOf(LicenseReference::class, $this->_license_reference);
    }
    
    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function setterGetterShouldSetGetLicenseReferenceId()
    {
        $this->_license_reference->setLicenseReferenceId(1234);
        $this->assertEquals(1234, $this->_license_reference->getLicenseReferenceId());
        $this->_license_reference->setLicenseReferenceId(-1);
    }
    
    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function setterGetterShouldSetGetLicenseReferenceValue()
    {
        $this->_license_reference->setLicenseReferenceValue('test2');
        $this->assertEquals('test2', $this->_license_reference->getLicenseReferenceValue());
        $this->_license_reference->setLicenseReferenceValue('');
    }
}
