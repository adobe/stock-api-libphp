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
        $this->_config = new CoreConfig('APIKey', 'Product', '');
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
        $this->_config->setEndPoints(['endPoint']);
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
