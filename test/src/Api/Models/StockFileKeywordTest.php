<?php
/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

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
