<?php
/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Test;

use \PHPUnit\Framework\TestCase;
use \AdobeStock\Api\Exception\StockApi as StockApiException;

class StockApiExceptionTest extends TestCase
{
    /**
     * @test
     * @before
     */
    public function initializeConstructorOfStockApiException()
    {
        $stock_exception = new StockApiException('', 1, new \Exception());
        $this->assertInstanceOf(StockApiException::class, $stock_exception);
    }

    /**
     * @test
     */
    public function withMessageWillReturnInstanceOfStockApiException()
    {
        $stock_exception = StockApiException::withMessage('hello');
        $this->assertInstanceOf(StockApiException::class, $stock_exception);
    }

    /**
     * @test
     */
    public function withMessageAndCodeWillReturnInstanceOfStockApiException()
    {
        $stock_exception = StockApiException::withMessageAndErrorCode('error', 100, new \Exception());
        $this->assertInstanceOf(StockApiException::class, $stock_exception);
    }
}
