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

use \AdobeStock\Api\Response\SearchFiles as SearchFilesResponse;
use \PHPUnit\Framework\TestCase;

class SearchFilesResponseTest extends TestCase
{
    /**
     * Response object for Search Files.
     * @var SearchFilesResponse
     */
    private $_response;
    /**
     * @test
     * @before
     */
    public function initializeConstructorOfSearchFilesResponse()
    {
        $this->_response = new SearchFilesResponse();
        $this->assertInstanceOf(SearchFilesResponse::class, $this->_response);
    }
    /**
     * @test
     */
    public function testAllTheGettersSettersReturnandSetTheProperValue()
    {
        $this->_response->setNbResults(5);
        $this->assertEquals(5, $this->_response->getNbResults());
        
        $this->_response->setFiles([]);
        $this->assertEquals([], $this->_response->getFiles());
    }
}
