<?php

/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

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
