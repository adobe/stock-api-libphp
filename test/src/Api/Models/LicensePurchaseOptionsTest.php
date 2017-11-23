<?php

/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Test;

use \AdobeStock\Api\Models\LicensePurchaseOptions;
use \PHPUnit\Framework\TestCase;

class LicensePurchaseOptionsTest extends TestCase
{
    /**
     * @var LicensePurchaseOptions
     */
    private $_license_purchase_options;
    
    /**
     * @var array
     */
    private $_data = [
        'state' => 'test',
        'requires_checkout' => true,
        'message' => 'test',
        'url' => 'http://adobetest.com',
    ];
    
    /**
     * @test
     * @before
     */
    public function initializeConstructorOfLicensePurchaseOptions()
    {
        $this->_license_purchase_options = new LicensePurchaseOptions($this->_data);
        $this->assertInstanceOf(LicensePurchaseOptions::class, $this->_license_purchase_options);
    }
    
    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function setterGetterShouldSetGetState()
    {
        $this->_license_purchase_options->setPurchaseState('NOT_PURCHASED');
        $this->assertEquals('not_purchased', $this->_license_purchase_options->getPurchaseState());
        $this->_license_purchase_options->setPurchaseState('TEST');
    }
    
    /**
     * @test
     */
    public function setterGetterShouldSetGetRequiresCheckout()
    {
        $this->_license_purchase_options->setRequiresCheckout(true);
        $this->assertEquals(true, $this->_license_purchase_options->getRequiresCheckout());
    }
    
    /**
     * @test
     */
    public function setterGetterShouldSetGetMessage()
    {
        $this->_license_purchase_options->setMessage('Stock');
        $this->assertEquals('Stock', $this->_license_purchase_options->getMessage());
    }
    
    /**
     * @test
     */
    public function setterGetterShouldSetGetPurchaseUrl()
    {
        $this->_license_purchase_options->setPurchaseUrl('http');
        $this->assertEquals('http', $this->_license_purchase_options->getPurchaseUrl());
    }
}
