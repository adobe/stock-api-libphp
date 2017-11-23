<?php
/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

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
