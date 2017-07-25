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
use \AdobeStock\Api\Request\SearchCategory as SearchCategoryRequest;
use \AdobeStock\Api\Core\Config as CoreConfig;
use \AdobeStock\Api\Utils\APIUtils as APIUtils;

class SearchCategoryRequestTest extends TestCase
{
    /**
     * Request object for search category.
     * @var SearchCategoryRequest
     */
    private $_request;

    /**
     * @test
     * @before
     */
    public function initializeConstructorOfSearchCategoryRequest()
    {
        $this->_request = new SearchCategoryRequest();
        $this->assertInstanceOf(SearchCategoryRequest::class, $this->_request);
    }

    /**
     * @test
     */
    public function setterGetterShouldSetGetCategoryId()
    {
        $this->_request->setCategoryId(1043);
        $this->assertEquals(1043, $this->_request->getCategoryId());
    }

    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function setterGetterShouldSetGetLocale()
    {
        $this->_request->setLocale('En-US');
        $this->assertEquals('En-US', $this->_request->getLocale());
        $this->_request->setLocale('');
    }

    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function setCategoryIdShouldThrowExceptionIfNegativeValueIsPassed()
    {
        $this->_request->setCategoryId(-1);
    }

    /**
     * @test
     */
    public function generateCommonAPIHeadersShouldGenerateHeadersArrayFromConfigAndAccessToken()
    {
        $config = new CoreConfig('APIKey', 'Product', 'STAGE');
        $headers = APIUtils::generateCommonAPIHeaders($config, '');
        $this->assertEquals('APIKey', $headers['headers']['x-api-key']);
    }
}
