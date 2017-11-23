<?php
/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

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
