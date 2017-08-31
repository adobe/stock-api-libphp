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

use \PHPUnit\Framework\TestCase;
use \AdobeStock\Api\Core\Constants as CoreConstants;

class ConstantsTest extends TestCase
{
    /**
     * @test
     */
    public function testGetLicenseStateParams()
    {
        $constants = CoreConstants::getLicenseStateParams();
        $this->assertEquals('Standard', $constants['STANDARD']);
    }
    
    /**
     * @test
     */
    public function testGetQueryParamsProps()
    {
        $constants = CoreConstants::getQueryParamsProps();
        $this->assertEquals('locale', $constants['LOCALE']);
    }
    
    /**
     * @test
     */
    public function testGetHttpMethod()
    {
        $constants = CoreConstants::getHttpMethod();
        $this->assertEquals('POST', $constants['POST']);
    }
    
    /**
     * @test
     */
    public function testgetSearchParams3DTypes()
    {
        $constants = CoreConstants::getSearchParams3DTypes();
        $this->assertEquals(1, $constants['MODELS']);
    }
    
    /**
     * @test
     */
    public function testgetSearchParamsType()
    {
        $constants = CoreConstants::getSearchParamsType();
        $this->assertEquals(0, $constants['STRING']);
    }

    /**
     * @test
     */
    public function testgetPurchaseStateParams()
    {
        $constants = CoreConstants::getPurchaseStateParams();
        $this->assertEquals('purchased', $constants['PURCHASED']);
    }
}
