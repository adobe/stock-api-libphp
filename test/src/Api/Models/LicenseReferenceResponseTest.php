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
