<?php
/*************************************************************************
 * ADOBE CONFIDENTIAL
 * ___________________
 *
 *  Copyright 2017 Adobe Systems Incorporated
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
