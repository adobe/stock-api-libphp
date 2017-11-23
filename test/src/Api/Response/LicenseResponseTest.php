<?php
/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Test;

use \AdobeStock\Api\Response\License as LicenseResponse;
use \PHPUnit\Framework\TestCase;
use \AdobeStock\Api\Models\LicensePurchaseOptions;
use \AdobeStock\Api\Models\LicenseMemberInfo;
use \AdobeStock\Api\Models\LicenseEntitlement;

class LicenseResponseTest extends TestCase
{
    /**
     * Response object for search category.
     * @var LicenseResponse
     */
    private $_response;

    /**
     * @test
     * @before
     */
    public function initializeConstructorOfLicenseResponse()
    {
        $data = [
            'content_id' => 103,
        ];
        $this->_response = new LicenseResponse($data);
        $this->assertInstanceOf(LicenseResponse::class, $this->_response);
    }

    /**
     * @test
     */
    public function setterGetterShouldSetGetEntitlement()
    {
        $val = new LicenseEntitlement([]);
        $val->setQuota(5);
        $this->_response->setEntitlement($val);
        $this->assertEquals(5, $this->_response->getEntitlement()->getQuota());
    }
    
    /**
     * @test
     */
    public function setterGetterShouldSetGetPurchaseOptions()
    {
        $val = new LicensePurchaseOptions([]);
        $val->setMessage('stock');
        $this->_response->setPurchaseOptions($val);
        $this->assertEquals('stock', $this->_response->getPurchaseOptions()->getMessage());
    }

    /**
     * @test
     */
    public function setterGetterShouldSetGetMemberInfo()
    {
        $val = new LicenseMemberInfo([]);
        $val->setStockId(123);
        $this->_response->setMemberInfo($val);
        $this->assertEquals(123, $this->_response->getMemberInfo()->getStockId());
    }
    
    /**
     * @test
     */
    public function setterGetterShouldSetGetCceAgency()
    {
        $this->_response->setLicenseReference([]);
        $this->assertEquals([], $this->_response->getLicenseReference());
    }
    
    /**
     * @test
     */
    public function setterGetterShouldSetGetContents()
    {
        $data = [
            '59741022' => [],
        ];
        $this->_response->setContents($data);
        $this->assertEquals($data, $this->_response->getContents());
    }
}
