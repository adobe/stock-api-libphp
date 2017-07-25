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
