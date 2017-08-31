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
use \AdobeStock\Api\Models\StockFileKeyword as StockFileKeyword;

class StockFileKeywordTest extends TestCase
{
    /**
     * Stock File Keyword test array
     * @var array
     */
    private $_stock_file_keyword_data = [
        'name' => 'hello',
    ];
    
    /**
     * StockFileKeywordTest class object
     * @var StockFileKeyword
     */
    private $_stock_file_keyword_object;
    
    /**
     * @test
     * @before
     */
    public function initializeConstructorOfStockFileKeyword()
    {
        $this->_stock_file_keyword_object = new StockFileKeyword($this->_stock_file_keyword_data);
        $this->assertInstanceOf(StockFileKeyword::class, $this->_stock_file_keyword_object);
    }
    
    /**
     * @test
     */
    public function testAllTheGettersSettersReturnandSetTheProperValue()
    {
        $this->_stock_file_keyword_object->setName('helloWorld');
        $this->assertEquals('helloWorld', $this->_stock_file_keyword_object->getName());
    }
}
