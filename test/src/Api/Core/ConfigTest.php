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

class ConfigTest extends TestCase
{
    /**
     * All configuration that needs to be initialized for api call.
     * @var CoreConfig
     */
    private $_config;

    /**
     * @test
     * @before
     */
    public function initializeConstructorOfConfig()
    {
        $this->_config = new CoreConfig('APIKey', 'Product', 'PROD');
        $this->assertInstanceOf(CoreConfig::class, $this->_config);
        $this->_config = new CoreConfig('APIKey', 'Product', 'STAGE');
        $this->assertEquals('STAGE', $this->_config->getTargetEnv());
    }

    /**
     * @test
     */
    public function setterGetterShouldSetGetApikey()
    {
        $this->_config->setApiKey('key');
        $this->assertEquals('key', $this->_config->getApiKey());
    }

    /**
     * @test
     */
    public function setterGetterShouldSetGetProduct()
    {
        $this->_config->setProduct('product');
        $this->assertEquals('product', $this->_config->getProduct());
    }

    /**
     * @test
     */
    public function setterGetterShouldSetGetTargetEnv()
    {
        $this->_config->setTargetEnv('STAG');
        $this->assertEquals('STAG', $this->_config->getTargetEnv());
    }

    /**
     * @test
     */
    public function setterGetterShouldSetGetEndPoints()
    {
        $end_points = [
            'endPoint',
        ];
        $this->_config->setEndPoints($end_points);
        $this->assertEquals('endPoint', $this->_config->getEndPoints()[0]);
    }

    /**
     * @test
     */
    public function isConfigInitializedShouldReturnFalseSinceEnvIsFalse()
    {
        $this->assertTrue($this->_config->isConfigInitialized());
        $this->_config->setTargetEnv('');
        $this->assertFalse($this->_config->isConfigInitialized());
    }
}
