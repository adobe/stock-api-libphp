<?php
/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Test;

use \AdobeStock\Api\Response\SearchCategory as SearchCategoryResponse;
use \PHPUnit\Framework\TestCase;

class SearchCategoryResponseTest extends TestCase
{
    /**
     * Response object for search category.
     * @var SearchCategoryResponse
     */
    private $_response;

    /**
     * @test
     * @before
     */
    public function initializeConstructorOfSearchCategoryResponse()
    {
        $data = [
            'id' => 103,
        ];
        $this->_response = new SearchCategoryResponse($data);
        $this->assertInstanceOf(SearchCategoryResponse::class, $this->_response);
    }

    /**
     * @test
     */
    public function setterGetterShouldSetGetCategoryId()
    {
        $this->_response->setId(1043);
        $this->assertEquals(1043, $this->_response->getId());
    }

    /**
     * @test
     */
    public function setterGetterShouldSetGetName()
    {
        $this->_response->setName('Travel');
        $this->assertEquals('Travel', $this->_response->getName());
    }

    /**
     * @test
     */
    public function setterGetterShouldSetGetLink()
    {
        $this->_response->setLink('/Category/travel/1043');
        $this->assertEquals('/Category/travel/1043', $this->_response->getLink());
    }
}
