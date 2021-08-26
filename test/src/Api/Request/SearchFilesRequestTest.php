<?php
/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Test;

use \PHPUnit\Framework\TestCase;
use \AdobeStock\Api\Request\SearchFiles as SearchFilesRequest;
use \AdobeStock\Api\Models\SearchParameters as SearchParametersModels;

class SearchFilesRequestTest extends TestCase
{
    /**
     * Request object for search Files.
     * @var SearchFiles
     */
    private $_request;
    
    /**
     * @test
     * @before
     */
    public function initializeConstructorOfSearchFilesRequest()
    {
        $this->_request = new SearchFilesRequest();
        $this->assertInstanceOf(SearchFilesRequest::class, $this->_request);
    }
    
    /**
     * @test
     */
    public function testAllTheGettersSettersReturnandSetTheProperValue()
    {
        $search_params = new SearchParametersModels();
        $search_params->setWords('tree')->setLimit(3)->setOffset(0);
        
        $result_column_array = [
            'nb_results',
            'country_name',
            'id',
        ];
        
        $this->_request->setLocale('En-US');
        $this->assertEquals('En-US', $this->_request->getLocale());
        $this->_request->setSearchParams($search_params);
        $this->assertInstanceOf(SearchParametersModels::class, $this->_request->getSearchParams());
        $this->_request->setResultColumns($result_column_array);
        $this->assertEquals($result_column_array, $this->_request->getResultColumns());
        $this->_request->setSimilarImage('test/resources/TestFile.png');
    }
    
    /**
     * @test
     */
    public function setSearchParamsThrowException()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->_request->setSearchParams(null);
    }
    
    /**
     * @test
     */
    public function setLocaleThrowException()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->_request->setLocale(null);
    }
    
    /**
     * @test
     */
    public function setResultColumnsThrowException()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->_request->setResultColumns([]);
    }
    
    /**
     * @test
     */
    public function setSimilarImageThrowExceptionIfFileDoesntExist()
    {
        $this->expectException(\AdobeStock\Api\Exception\StockApi::class);
        $this->_request->setSimilarImage('');
    }
}
