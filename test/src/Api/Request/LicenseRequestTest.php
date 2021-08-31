<?php

/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

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
     */
    public function setterGetterShouldSetGetLocale()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->_request->setLocale('En-US');
        $this->assertEquals('En-US', $this->_request->getLocale());
        $this->_request->setLocale('');
    }
    
    /**
     * @test
     */
    public function setContentIdShouldThrowExceptionIfNegativeValueIsPassed()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->_request->setContentId(-1);
    }
    
    /**
     * @test
     */
    public function setterGetterShouldSetGetLicenseState()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->_request->setLicenseState('STANDARD');
        $this->assertEquals('Standard', $this->_request->getLicenseState());
        $this->_request->setLicenseState('');
    }
    
    /**
     * @test
     */
    public function setterGetterShouldSetGetPurchaseState()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
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
     */
    public function setterGetterShouldSetGetLicenseReference()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
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
