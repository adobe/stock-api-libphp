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
use \AdobeStock\Api\Request\LicenseHistory as LicenseHistoryRequest;
use \AdobeStock\Api\Models\SearchParamLicenseHistory as SearchParamLicenseHistoryModel;

class LicenseHistoryRequestTest extends TestCase
{
    /**
     * Request object for License History.
     * @var LicenseHistoryRequest
     */
    private $_request;
    
    /**
     * @test
     * @before
     */
    public function initializeConstructorOfLicenseHistoryRequest()
    {
        $this->_request = new LicenseHistoryRequest();
        $this->assertInstanceOf(LicenseHistoryRequest::class, $this->_request);
    }
    
    /**
     * @test
     */
    public function testAllTheGettersSettersReturnandSetTheProperValue()
    {
        $search_params_license_history = new SearchParamLicenseHistoryModel();
        $search_params_license_history->setLimit(3)->setOffset(0);
        
        $result_column_array = [
            'THUMBNAIL_110_URL',
            'THUMBNAIL_110_WIDTH',
        ];
        
        $this->_request->setLocale('En-US');
        $this->assertEquals('En-US', $this->_request->getLocale());
        $this->_request->setSearchParams($search_params_license_history);
        $this->assertInstanceOf(SearchParamLicenseHistoryModel::class, $this->_request->getSearchParams());
        $this->_request->setResultColumns($result_column_array);
        $this->assertEquals($result_column_array, $this->_request->getResultColumns());
    }
    
    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function setSearchParamsThrowException()
    {
        $search_params = new SearchParamLicenseHistoryModel();
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
