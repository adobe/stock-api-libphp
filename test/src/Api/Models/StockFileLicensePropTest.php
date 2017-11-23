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

class StockFileLicensePropModelsTest extends TestCase
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
     * @test
     * @before
     */
    public function initializeConstructorOfStockFileLicensePropModels()
    {
        $this->_stock_file_license_prop_object = new StockFileLicensePropModels($this->_stock_file_license_prop_data);
        $this->assertInstanceOf(StockFileLicensePropModels::class, $this->_stock_file_license_prop_object);
    }
    
    /**
     * @test
     */
    public function testAllTheGettersSettersReturnandSetTheProperValue()
    {
        $this->_stock_file_license_prop_object->setWidth(101);
        $this->assertEquals(101, $this->_stock_file_license_prop_object->getWidth());
        $this->_stock_file_license_prop_object->setHeight(201);
        $this->assertEquals(201, $this->_stock_file_license_prop_object->getHeight());
        $this->_stock_file_license_prop_object->setUrl('http://adobetest2.com');
        $this->assertEquals('http://adobetest2.com', $this->_stock_file_license_prop_object->getUrl());
    }
}
