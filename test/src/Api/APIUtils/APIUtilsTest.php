<?php
/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Test;

use \PHPUnit\Framework\TestCase;
use \AdobeStock\Api\Core\Config as CoreConfig;
use \AdobeStock\Api\Utils\APIUtils;

class APIUtilsTest extends TestCase
{
    /**
     * @test
     */
    public function generateCommonAPIHeadersShouldGenerateHeadersArrayFromConfigAndAcessToken()
    {
        $config = new CoreConfig('APIKey', 'Product', 'STAGE');
        $headers = APIUtils::generateCommonAPIHeaders($config, '');
        $this->assertEquals('APIKey', $headers['headers']['x-api-key']);
    }
    
    /**
     * @test
     */
    public function downSampleImageShouldResizeImagetoExpectedDimensionsIfWidthisGreaterThanHeight()
    {
        $image = APIUtils::downSampleImage('test/resources/TestFileWidth.png');
        $this->assertNotNull($image);
    }
    
    /**
     * @test
     */
    public function downSampleImageShouldResizeImagetoExpectedDimensionsIfHeightisGreaterThanWidth()
    {
        $image = APIUtils::downSampleImage('test/resources/TestFile.png');
        $this->assertNotNull($image);
    }
    
    /**
     * @test
     */
    public function downSampleImageShouldNotDownSampleSmallImage()
    {
        $image = APIUtils::downSampleImage('test/resources/SmallImage.jpg');
        $this->assertNotNull($image);
    }
    
    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function downSampleImageShouldThrowExceptionIfImageIsNotSupported()
    {
        $image = APIUtils::downSampleImage('test/resources/UnsupportedBMP.bmp');
    }
    
    /**
     * @test
     * @expectedException \AdobeStock\Api\Exception\StockApi
     */
    public function downSampleImageShouldThrowExceptionIfImageIsBiggerThanExpected()
    {
        $image = APIUtils::downSampleImage('test/resources/BigImage.jpg');
    }
}
