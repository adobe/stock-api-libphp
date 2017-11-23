<?php
/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Test;

use \PHPUnit\Framework\TestCase;
use \AdobeStock\Api\Models\StockFileLicenseProp as StockFileLicensePropModels;
use \AdobeStock\Api\Models\StockFileLicenses as StockFileLicensesModels;

class StockFileLicensesModelsTest extends TestCase
{
    /**
     * Stock File License Prop test array
     * @var array
     */
    private $_stock_file_license_prop_data = [
        'width' => 100,
        'height' => 200,
        'url' => 'http://adobetest.com',
    ];
    
    /**
     * StockFileLicensePropModelsTest class object
     * @var StockFileLicensePropModels
     */
    private $_stock_file_license_prop_object;
    
    /**
     * StockFileLicensesModels class object
     * @var StockFileLicensesModels
     */
    private $_stock_file_licenses_object;
    
    /**
     * @test
     * @before
     */
    public function initializeConstructorOfStockFileLicensesModels()
    {
        $this->_stock_file_license_prop_object = new StockFileLicensePropModels($this->_stock_file_license_prop_data);
        $object = [
            'Standard' => $this->_stock_file_license_prop_object,
            'Standard_M' => $this->_stock_file_license_prop_object,
        ];
        $this->_stock_file_licenses_object = new StockFileLicensesModels($object);
        $this->assertInstanceOf(StockFileLicensesModels::class, $this->_stock_file_licenses_object);
    }
    
    /**
     * @test
     */
    public function testAllTheGettersSettersReturnandSetTheProperValue()
    {
        $this->_stock_file_license_prop_object = new StockFileLicensePropModels($this->_stock_file_license_prop_data);
        $this->_stock_file_licenses_object->setStandard($this->_stock_file_license_prop_object);
        $this->assertInstanceOf(StockFileLicensePropModels::class, $this->_stock_file_licenses_object->getStandard());
        $this->_stock_file_licenses_object->setStandardM($this->_stock_file_license_prop_object);
        $this->assertInstanceOf(StockFileLicensePropModels::class, $this->_stock_file_licenses_object->getStandardM());
    }
}
