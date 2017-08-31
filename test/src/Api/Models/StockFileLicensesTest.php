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
