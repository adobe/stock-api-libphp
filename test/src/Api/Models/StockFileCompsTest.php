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
use \AdobeStock\Api\Models\StockFileCompProp as StockFileCompPropModels;
use \AdobeStock\Api\Models\StockFileComps as StockFileCompsModels;

class StockFileCompsModelsTest extends TestCase
{
    /**
     * Stock File Comps Prop test array
     * @var array
     */
    private $_stock_file_comps_prop_data = [
        'width' => 100,
        'height' => 200,
        'url' => 'http://adobetest.com',
    ];
    
    /**
     * StockFileCompPropModelsTest class object
     * @var StockFileCompPropModels
     */
    private $_stock_file_comp_prop_object;
    
    /**
     * StockFileLicenses class object
     * @var StockFileCompsModels
     */
    private $_stock_file_comps_object;
    
    /**
     * @test
     * @before
     */
    public function initializeConstructorOfStockFileComps()
    {
        $this->_stock_file_comp_prop_object = new StockFileCompPropModels($this->_stock_file_comps_prop_data);
        $_stock_file_comps_data = [
            'Standard' => $this->_stock_file_comp_prop_object,
        ];
        $this->_stock_file_comps_object = new StockFileCompsModels($_stock_file_comps_data);
        $this->assertInstanceOf(StockFileCompsModels::class, $this->_stock_file_comps_object);
    }
    
    /**
     * @test
     */
    public function testAllTheGettersSettersReturnandSetTheProperValue()
    {
        $comp_models = [
            'width' => 100,
        ];
        $_stock_file_comp_prop_object = new StockFileCompPropModels($comp_models);
        $this->_stock_file_comps_object->setStandard($_stock_file_comp_prop_object);
        $this->assertEquals($_stock_file_comp_prop_object, $this->_stock_file_comps_object->getStandard());
        
        $this->_stock_file_comps_object->setVideoHD($_stock_file_comp_prop_object);
        $this->assertEquals($_stock_file_comp_prop_object, $this->_stock_file_comps_object->getVideoHD());
        
        $this->_stock_file_comps_object->setVideo4K($_stock_file_comp_prop_object);
        $this->assertEquals($_stock_file_comp_prop_object, $this->_stock_file_comps_object->getVideo4K());
    }
}
