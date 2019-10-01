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
use \AdobeStock\Api\Exception\StockApi;

class APIUtilsTest extends TestCase
{
    /**
     * @test
     */
    public function generateCommonAPIHeadersShouldGenerateHeadersArrayFromConfigAndAcessToken(): void
    {
        $config = new CoreConfig('APIKey', 'Product', 'STAGE');
        $headers = APIUtils::generateCommonAPIHeaders($config, '');
        $this->assertEquals('APIKey', $headers['headers']['x-api-key']);
    }

    /**
     * @param string        $absolute_path
     * @param StockApi|null $expected_exception
     * @dataProvider downSampleImageProvider
     */
    public function testDownSampleImage(string $absolute_path, StockApi $expected_exception = null): void
    {
        if ($expected_exception) {
            $this->expectExceptionObject($expected_exception);
        }

        list($width, $height) = getimagesize($absolute_path);
        $image_string = APIUtils::downSampleImage($absolute_path);

        $image = imagecreatefromstring($image_string);
        $result_width = imagesx($image);
        $result_height = imagesy($image);

        $this->assertLessThanOrEqual(min($width, 1000), $result_width);
        $this->assertLessThanOrEqual(min($height, 1000), $result_height);

        $this->assertNotNull($image);
    }

    /**
     * @return array
     */
    public function downSampleImageProvider(): array
    {
        return [
            'width_greater_than_height' => [
                $this->_getAbsolutePath('test/resources/TestFileWidth.png'),
            ],
            'height_greater_than_width' => [
                $this->_getAbsolutePath('test/resources/TestFile.png'),
            ],
            'small_image' => [
                $this->_getAbsolutePath('test/resources/SmallImage.jpg'),
            ],
            'not_supported_image' => [
                $this->_getAbsolutePath('test/resources/UnsupportedBMP.bmp'),
                new StockApi('Only jpg, png and gifs are supported image formats'),
            ],
            'bigger_than_expected_image' => [
                $this->_getAbsolutePath('test/resources/BigImage.jpg'),
                new StockApi('Image is too large for visual search!'),
            ],
        ];
    }

    /**
     * @param string $path_in_project
     * @return string
     */
    private function _getAbsolutePath(string $path_in_project): string
    {
        return dirname(dirname(dirname(dirname(__DIR__)))) . '/' . $path_in_project;
    }
}
