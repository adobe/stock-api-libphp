<?php

/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

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
