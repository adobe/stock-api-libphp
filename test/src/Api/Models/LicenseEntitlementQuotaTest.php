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

use \AdobeStock\Api\Models\LicenseEntitlementQuota;
use \PHPUnit\Framework\TestCase;

class LicenseEntitlementQuotaTest extends TestCase
{
    /**
     * @var LicenseEntitlementQuota
     */
    private $_license_entitlement_quota;
    
    /**
     * LicenseEntitlementQuota Test data
     * @var array
     */
    private $_data = [
        'image_quota' => 1,
        'video_quota' => 1,
        'credits_quota' => 1,
        'standard_credits_quota' => 1,
        'premium_credits_quota' => 1,
        'universal_credits_quota' => 1,
    ];
    
    /**
     * @test
     * @before
     */
    public function initializeConstructorOfLicenseEntitlementQuota()
    {
        $this->_license_entitlement_quota = new LicenseEntitlementQuota($this->_data);
        $this->assertInstanceOf(LicenseEntitlementQuota::class, $this->_license_entitlement_quota);
    }
    
    /**
     * @test
     */
    public function setterGetterShouldSetGetImageQuota()
    {
        $this->_license_entitlement_quota->setImageQuota(2);
        $this->assertEquals(2, $this->_license_entitlement_quota->getImageQuota());
    }
    
    /**
     * @test
     */
    public function setterGetterShouldSetGetVideoQuota()
    {
        $this->_license_entitlement_quota->setVideoQuota(3);
        $this->assertEquals(3, $this->_license_entitlement_quota->getVideoQuota());
    }
    
    /**
     * @test
     */
    public function setterGetterShouldSetGetCreditsQuota()
    {
        $this->_license_entitlement_quota->setCreditsQuota(23);
        $this->assertEquals(23, $this->_license_entitlement_quota->getCreditsQuota());
    }
    
    /**
     * @test
     */
    public function setterGetterShouldSetGetStandardCreditQuota()
    {
        $this->_license_entitlement_quota->setStandardCreditQuota(23);
        $this->assertEquals(23, $this->_license_entitlement_quota->getStandardCreditQuota());
    }
    
    /**
     * @test
     */
    public function setterGetterShouldSetGetPremiumCreditsQuota()
    {
        $this->_license_entitlement_quota->setPremiumCreditsQuota(23);
        $this->assertEquals(23, $this->_license_entitlement_quota->getPremiumCreditsQuota());
    }
    
    /**
     * @test
     */
    public function setterGetterShouldSetGetUniversalCreditsQuota()
    {
        $this->_license_entitlement_quota->setUniversalCreditsQuota(23);
        $this->assertEquals(23, $this->_license_entitlement_quota->getUniversalCreditsQuota());
    }
}
