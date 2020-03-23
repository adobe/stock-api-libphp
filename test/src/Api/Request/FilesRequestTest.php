<?php
/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Test;

use \AdobeStock\Api\Core\Constants;
use \PHPUnit\Framework\TestCase;
use \AdobeStock\Api\Request\Files as FilesRequest;

class FilesRequestTest extends TestCase
{
    /**
     * Request object for Files API.
     *
     * @var FilesRequest
     */
    private $_request;

    /**
     * @test
     * @before
     */
    public function initializeConstructorOfFilesRequest() : void
    {
        $this->_request = new FilesRequest();
        $this->assertInstanceOf(FilesRequest::class, $this->_request);
    }

    /**
     * @test
     */
    public function testAllTheGettersSettersReturnandSetTheProperValue() : void
    {
        $result_column_array = [
            'nb_results',
            'country_name',
            'id',
        ];
        $this->_request->setIds([1, 2, 3]);
        $this->assertEquals([1, 2, 3], $this->_request->getIds());
        $this->_request->setLocale('En-US');
        $this->assertEquals('En-US', $this->_request->getLocale());
        $this->_request->setResultColumns($result_column_array);
        $this->assertEquals($result_column_array, $this->_request->getResultColumns());
    }

    /**
     * @test
     */
    public function testToArrayReturnsValidArray() : void
    {
        $result_column_array = [
            'nb_results',
            'country_name',
            'id',
        ];
        $this->_request->setIds([1, 2, 3]);
        $this->_request->setLocale('En-US');
        $this->_request->setResultColumns($result_column_array);
        $this->assertEquals([
            Constants::getQueryParamsProps()['IDS'] => '1,2,3',
            Constants::getQueryParamsProps()['LOCALE'] => 'En-US',
            Constants::getQueryParamsProps()['RESULT_COLUMNS'] => $result_column_array
        ], $this->_request->toArray());
    }



    /**
     * @test
     * @expectedException \TypeError
     */
    public function setIdsThrowException()
    {
        $this->_request->setIds(null);
    }

    /**
     * @test
     * @expectedException \TypeError
     */
    public function setLocaleThrowException()
    {
        $this->_request->setLocale(null);
    }

    /**
     * @test
     * @expectedException \TypeError
     */
    public function setResultColumnsThrowException()
    {
        $this->_request->setResultColumns(null);
    }
}
