<?php

/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Test;

use \AdobeStock\Api\Models\LicenseReferenceResponse;
use \PHPUnit\Framework\TestCase;

class LicenseReferenceResponseTest extends TestCase
{
    /**
     * @var LicenseReferenceResponse
     */
    private $_license_reference_response;
    
    /**
     * @var array
     */
    private $_data = [
        'id' => 1,
        'text' => 'test',
        'required' => true,
    ];
    
    /**
     * @test
     * @before
     */
    public function initializeConstructorOfLicenseReferenceResponse()
    {
        $this->_license_reference_response = new LicenseReferenceResponse($this->_data);
        $this->assertInstanceOf(LicenseReferenceResponse::class, $this->_license_reference_response);
    }
    
    /**
     * @test
     */
    public function setterGetterShouldSetGetLicenseReferenceId()
    {
        $this->_license_reference_response->setLicenseReferenceId(1234);
        $this->assertEquals(1234, $this->_license_reference_response->getLicenseReferenceId());
    }
    
    /**
     * @test
     */
    public function setterGetterShouldSetGetRequired()
    {
        $this->_license_reference_response->setRequired(true);
        $this->assertEquals(true, $this->_license_reference_response->getRequired());
    }
    
    /**
     * @test
     */
    public function setterGetterShouldSetGetText()
    {
        $this->_license_reference_response->setText('test');
        $this->assertEquals('test', $this->_license_reference_response->getText());
    }
}
