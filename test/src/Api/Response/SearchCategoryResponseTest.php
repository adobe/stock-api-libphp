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
        $data = array ('id' => 103,);
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
