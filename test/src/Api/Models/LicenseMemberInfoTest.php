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
