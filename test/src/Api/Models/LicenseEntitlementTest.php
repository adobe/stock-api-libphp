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

use AdobeStock\Api\Models\LicenseEntitlementQuota;
use AdobeStock\Api\Models\LicenseEntitlement;
use PHPUnit\Framework\TestCase;

class LicenseEntitlementTest extends TestCase
{
    /**
     * @var LicenseEntitlement
     */
    private $_license_entitlement;
    
    /**
     * @var array
     */
    private $_data = [
        'quota' => 1,
        'license_type_id' => 2,
        'has_credit_model' => true,
        'has_agency_model' => false,
        'is_cce' => true,
        'full_entitlement_quota' => [],
    ];
    
    /**
     * @test
     * @before
     */
    public function initializeConstructorOfLicenseEntitlement()
    {
        $this->_license_entitlement = new LicenseEntitlement($this->_data);
        $this->assertInstanceOf(LicenseEntitlement::class, $this->_license_entitlement);
    }
    
    /**
     * @test
     */
    public function setterGetterShouldSetGetQuota()
    {
        $this->_license_entitlement->setQuota(3);
        $this->assertEquals(3, $this->_license_entitlement->getQuota());
    }
    
    /**
     * @test
     */
    public function setterGetterShouldSetGetLicenseTypeId()
    {
        $this->_license_entitlement->setLicenseTypeId(123);
        $this->assertEquals(123, $this->_license_entitlement->getLicenseTypeId());
    }
    
    /**
     * @test
     */
    public function setterGetterShouldSetGetHasCreditModel()
    {
        $this->_license_entitlement->setHasCreditModel(true);
        $this->assertEquals(true, $this->_license_entitlement->getHasCreditModel());
    }
    
    /**
     * @test
     */
    public function setterGetterShouldSetGetHasAgencyModel()
    {
        $this->_license_entitlement->setHasAgencyModel(true);
        $this->assertEquals(true, $this->_license_entitlement->getHasAgencyModel());
    }
    
    /**
     * @test
     */
    public function setterGetterShouldSetGetIsCce()
    {
        $this->_license_entitlement->setIsCce(false);
        $this->assertEquals(false, $this->_license_entitlement->getIsCce());
    }
    
    /**
     * @test
     */
    public function setterGetterShouldSetGetFullEntitlementQuota()
    {
        $quota = new LicenseEntitlementQuota([]);
        $quota->setCreditsQuota(5);
        $this->_license_entitlement->setFullEntitlementQuota($quota);
        $this->assertEquals(5, $this->_license_entitlement->getFullEntitlementQuota()->getCreditsQuota());
    }
}
