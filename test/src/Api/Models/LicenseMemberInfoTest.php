<?php

/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Test;

use \AdobeStock\Api\Models\LicenseMemberInfo;
use \PHPUnit\Framework\TestCase;

class LicenseMemberInfoTest extends TestCase
{
    /**
     * @var LicenseMemberInfo
     */
    private $_license_member_info;
    
    /**
     * @var array
     */
    private $_data = [
        'stock_id' => 1,
    ];
    
    /**
     * @test
     * @before
     */
    public function initializeConstructorOfLicenseMemberInfo()
    {
        $this->_license_member_info = new LicenseMemberInfo($this->_data);
        $this->assertInstanceOf(LicenseMemberInfo::class, $this->_license_member_info);
    }
    
    /**
     * @test
     */
    public function setterGetterShouldSetGetStockId()
    {
        $this->_license_member_info->setStockId(1234);
        $this->assertEquals(1234, $this->_license_member_info->getStockId());
    }
}
