<?php

/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */
namespace AdobeStock\Api\Response;

use \AdobeStock\Api\Models\LicenseEntitlement;
use \AdobeStock\Api\Models\LicensePurchaseOptions;
use \AdobeStock\Api\Models\LicenseMemberInfo;
use \AdobeStock\Api\Models\LicenseContent;
use \AdobeStock\Api\Models\LicenseReference;

class License
{
    /**
     * Information about licenses available for the user.
     * @var LicenseEntitlement|null
     */
    public $available_entitlement;
    
    /**
     * Information about the user's purchasing options for the asset.
     * @var LicensePurchaseOptions|null
     */
    public $purchase_options;
    
    /**
     * Information about the user.
     * @var LicenseMemberInfo|null
     */
    public $member;
    
    /**
     * List of license references of the user.
     * @var array|null
     */
    public $cce_agency;
    
    /**
     * Mapping from Asset unique identifier to Asset Licensing information.
     * @var array|null
     */
    public $contents;

    /**
     * Constructor function.
     * @param array $raw_response Raw response returned from api call.
     */
    public function __construct(array $raw_response)
    {
        foreach ($raw_response as $key => $val) {
            if (property_exists($this, $key)) {
                if ($key == 'available_entitlement') {
                    $this->available_entitlement = new LicenseEntitlement($val);
                } else if ($key == 'purchase_options') {
                    $this->purchase_options = new LicensePurchaseOptions($val);
                } else if ($key == 'member') {
                    $this->member = new LicenseMemberInfo($val);
                } else if ($key == 'cce_agency') {
                    foreach ($val as $index => $object) {
                        $val [$index] = new LicenseReference($object);
                    }
                    
                    $this->cce_agency = $val;
                } else if ($key == 'contents') {
                    foreach ($val as $index => $object) {
                        $this->contents [$index] = new LicenseContent($object);
                    }
                }
            }
        }
    }

    /**
     * Get Information about licenses available for the user.
     * @return LicenseEntitlement|null
     */
    public function getEntitlement() : ?LicenseEntitlement
    {
        return $this->available_entitlement;
    }

    /**
     * Get Information about the user's purchasing options for the asset.
     * @return LicensePurchaseOptions|null
     */
    public function getPurchaseOptions() : ?LicensePurchaseOptions
    {
        return $this->purchase_options;
    }

    /**
     * Get Information about the user.
     * @return LicenseMemberInfo|null
     */
    public function getMemberInfo() : ?LicenseMemberInfo
    {
        return $this->member;
    }

    /**
     * Get List of license references of the user.
     * @return array|null
     */
    public function getLicenseReference() : ?array
    {
        return $this->cce_agency;
    }

    /**
     * @return array|null
     */
    public function getContents() : ?array
    {
        return $this->contents;
    }

    /**
     * Sets Information about licenses available for the user.
     * @param LicenseEntitlement $val
     * @return License
     */
    public function setEntitlement(LicenseEntitlement $val) : License
    {
        $this->available_entitlement = $val;
        return $this;
    }

    /**
     * Sets Information about the user's purchasing options for the asset.
     * @param LicensePurchaseOptions $val
     * @return License
     */
    public function setPurchaseOptions(LicensePurchaseOptions $val) : License
    {
        $this->purchase_options = $val;
        return $this;
    }

    /**
     * Sets Information about the user.
     * @param LicenseMemberInfo $val
     * @return License
     */
    public function setMemberInfo(LicenseMemberInfo $val) : License
    {
        $this->member = $val;
        return $this;
    }

    /**
     * Sets List of license references of the user.
     * @param array $val
     * @return License
     */
    public function setLicenseReference(array $val) : License
    {
        $this->cce_agency = $val;
        return $this;
    }

    /**
     * Sets Mapping from Asset unique identifier to Asset Licensing information.
     * @param array $data
     * @return License
     */
    public function setContents(array $data) : License
    {
        foreach ($data as $key => $value) {
            $this->contents [$key] = $value;
        }
        
        return $this;
    }
}
