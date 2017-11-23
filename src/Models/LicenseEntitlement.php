<?php

/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Models;

use AdobeStock\Api\Models\LicenseEntitlementQuota;

class LicenseEntitlement
{
    
    /**
     * @var int Quantity of remaining licenses available for the user.
     */
    public $quota;
    
    /**
     * @var int Stock Internal ID to know which kind of product can
     * be used for licensing.
     */
    public $license_type_id;
    
    /**
     * @var bool true if the selected entitlement is for an organization
     * and this organization is generation 2.
     */
    public $has_credit_model;
    
    /**
     * @var bool true if the selected entitlement is for an organization
     * and this organization is generation 3.
     */
    public $has_agency_model;
    
    /**
     * @var bool true if the selected entitlement for purchasing is one
     * of an organization.
     */
    public $is_cce;
    
    /**
     * @var LicenseEntitlementQuota|null Full quota of the user available entitlements.
     */
    public $full_entitlement_quota;

    /**
     * Constructor for LicenseEntitlement
     * @param array $response
     */
    public function __construct(array $response = null)
    {
        if ($response != null) {
            foreach ($response as $key => $val) {
                if (property_exists($this, $key)) {
                    if ($key == 'full_entitlement_quota') {
                        $this->full_entitlement_quota = new LicenseEntitlementQuota($val);
                    } else {
                        $this->$key = $val;
                    }
                }
            }
        }
    }

    /**
     * Get quantity of remaining licenses available for the user.
     * @return license quantity of type Integer
     */
    public function getQuota() : int
    {
        return $this->quota;
    }

    /**
     * Sets quantity of remaining licenses available for the user.
     * @param int $quota
     * @return LicenseEntitlement
     */
    public function setQuota(int $quota) : LicenseEntitlement
    {
        $this->quota = $quota;
        return $this;
    }

    /**
     * Get Full quota of the user available entitlements.
     * @return LicenseEntitlementQuota|null
     */
    public function getFullEntitlementQuota() : ?LicenseEntitlementQuota
    {
        return $this->full_entitlement_quota;
    }

    /**
     * Sets Full quota of the user available entitlements.
     * @param LicenseEntitlementQuota $license containing full quota of user available entitlements.
     * @return LicenseEntitlement
     */
    public function setFullEntitlementQuota(LicenseEntitlementQuota $license) : LicenseEntitlement
    {
        $this->full_entitlement_quota = $license;
        return $this;
    }

    /**
     * Get Stock Internal ID to know which kind of product can be used for licensing.
     * @return Stock Internal ID of type Int
     */
    public function getLicenseTypeId(): int
    {
        return $this->license_type_id;
    }

    /**
     * Sets Stock Internal ID to know which kind of product
     * can be used for licensing.
     * @param int $license_type_id Stock Internal ID.
     * @return LicenseEntitlement
     */
    public function setLicenseTypeId(int $license_type_id) : LicenseEntitlement
    {
        $this->license_type_id = $license_type_id;
        return $this;
    }

    /**
     * Returns true if the selected entitlement is for an organization
     * and this organization is generation 2.
     * @return true if the selected entitlement is for an organization
     * and this organization is generation 2 else false
     */
    public function getHasCreditModel(): bool
    {
        return $this->has_credit_model;
    }

    /**
     * Sets true if the selected entitlement is for an organization and
     * this organization is generation 2.
     * @param bool $has_credit_model , true if the selected entitlement is for an
     * organization and this organization is generation 2 else false
     * @return LicenseEntitlement
     */
    public function setHasCreditModel(bool $has_credit_model) : LicenseEntitlement
    {
        $this->has_credit_model = $has_credit_model;
        return $this;
    }

    /**
     * Returns true if the selected entitlement is for an organization
     * and this organization is generation 3.
     * @return bool true if the selected entitlement is for an organization
     * and this organization is generation 3 else false
     */
    public function getHasAgencyModel(): bool
    {
        return $this->has_agency_model;
    }

    /**
     * Sets true if the selected entitlement is for an organization and
     * this organization is generation 3.
     * @param bool $has_agency_model , true if the selected entitlement is for an
     * organization and this organization is generation 3 else false
     * @return LicenseEntitlement
     */
    public function setHasAgencyModel(bool $has_agency_model) : LicenseEntitlement
    {
        $this->has_agency_model = $has_agency_model;
        return $this;
    }

    /**
     * Get true if the selected entitlement for purchasing is one
     * of an organization.
     * @return true if the selected entitlement for purchasing is one
     * of an organization else false
     */
    public function getIsCce(): bool
    {
        return $this->is_cce;
    }

    /**
     * Sets true if the selected entitlement for purchasing is one of
     * an organization.
     * @param bool $is_cce , true if the selected entitlement for purchasing
     * is one of an organization else false
     * @return LicenseEntitlement
     */
    public function setIsCce(bool $is_cce) : LicenseEntitlement
    {
        $this->is_cce = $is_cce;
        return $this;
    }
}
