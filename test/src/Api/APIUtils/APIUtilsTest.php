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
     * @param string $absolutePath
     * @param StockApi|null $expectedException
     * @dataProvider downSampleImageProvider
     */
    public function testDownSampleImage(string $absolutePath, StockApi $expectedException = null): void
    {
        if ($expectedException) {
            $this->expectExceptionObject($expectedException);
        }
        list($width, $height) = getimagesize($absolutePath);
        $imageString = APIUtils::downSampleImage($absolutePath);

        $image = imagecreatefromstring($imageString);
        $resultWidth = imagesx($image);
        $resultHeight = imagesy($image);

        $this->assertLessThanOrEqual(min($width, 1000), $resultWidth);
        $this->assertLessThanOrEqual(min($height, 1000), $resultHeight);

        $this->assertNotNull($image);
    }

    public function downSampleImageProvider(): array
    {
        return [
            'width_greater_than_height' => [
                $this->getAbsolutePath('test/resources/TestFileWidth.png')
            ],
            'height_greater_than_width' => [
                $this->getAbsolutePath('test/resources/TestFile.png')
            ],
            'small_image' => [
                $this->getAbsolutePath('test/resources/SmallImage.jpg')
            ],
            'not_supported_image' => [
                $this->getAbsolutePath('test/resources/UnsupportedBMP.bmp'),
                new StockApi('Only jpg, png and gifs are supported image formats')
            ],
            'bigger_than_expected_image' => [
                $this->getAbsolutePath('test/resources/BigImage.jpg'),
                new StockApi('Image is too large for visual search!')
            ]
        ];
    }

    /**
     * @param string $pathInProject
     * @return string
     */
    private function getAbsolutePath(string $pathInProject): string
    {
        return dirname(dirname(dirname(dirname(__DIR__)))) . '/' . $pathInProject;
    }
}
