<?php
/*************************************************************************
 * ADOBE CONFIDENTIAL
 * ___________________
 *
 *  Copyright 2017 Adobe Systems Incorporated
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
