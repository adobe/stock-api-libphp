<?php
/*************************************************************************
 * ADOBE CONFIDENTIAL
 * ___________________
 *
 *  Copyright 2016 Adobe Systems Incorporated
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
    }
    
    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function setSearchParamsThrowException()
    {
        $search_params = new SearchParametersModels();
        $this->_request->setSearchParams(null);
    }
    
    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function setLocaleThrowException()
    {
        $this->_request->setLocale(null);
    }
    
    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function setResultColumnsThrowException()
    {
        $this->_request->setResultColumns([]);
    }
}
