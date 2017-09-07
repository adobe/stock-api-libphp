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

use \PHPUnit\Framework\TestCase;
use \AdobeStock\Api\Request\License as LicenseRequest;

class LicenseRequestTest extends TestCase
{
    /**
     * Request Object for License
     * @var LicenseRequest
     */
    private $_request;
    
    /**
     * @test
     * @before
     */
    public function initializeConstructorOfLicenseRequest()
    {
        $this->_request = new LicenseRequest();
        $this->assertInstanceOf(LicenseRequest::class, $this->_request);
    }
    
    /**
     * @test
     */
    public function setterGetterShouldSetGetContentId()
    {
        $this->_request->setContentId(10431);
        $this->assertEquals(10431, $this->_request->getContentId());
    }
    
    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function setterGetterShouldSetGetLocale()
    {
        $this->_request->setLocale('En-US');
        $this->assertEquals('En-US', $this->_request->getLocale());
        $this->_request->setLocale('');
    }
    
    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function setContentIdShouldThrowExceptionIfNegativeValueIsPassed()
    {
        $this->_request->setContentId(-1);
    }
    
    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function setterGetterShouldSetGetLicenseState()
    {
        $this->_request->setLicenseState('STANDARD');
        $this->assertEquals('Standard', $this->_request->getLicenseState());
        $this->_request->setLicenseState('');
    }
    
    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function setterGetterShouldSetGetPurchaseState()
    {
        $this->_request->setPurchaseState('NOT_PURCHASED');
        $this->assertEquals('not_purchased', $this->_request->getPurchaseState());
        $this->_request->setPurchaseState('');
    }
    
    /**
     * @test
     */
    public function setterGetterShouldSetGetFormat()
    {
        $this->assertEquals(false, $this->_request->getFormat());
        $this->_request->setFormat(true);
        $this->assertEquals(true, $this->_request->getFormat());
    }
    
    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function setterGetterShouldSetGetLicenseReference()
    {
        $data = [
                ['id' => 1,
                    'value' => 'test',
                ],
        ];
        $this->_request->setLicenseReference($data);
        $this->assertEquals(1, $this->_request->getLicenseReference()[0]->getLicenseReferenceId());
        $this->_request->setLicenseReference([]);
    }
}
