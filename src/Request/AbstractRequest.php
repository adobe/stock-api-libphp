<?php
/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Request;

use AdobeStock\Api\Exception\StockApi as StockApiException;

/**
 * Class AbstractRequest
 */
class AbstractRequest
{
    /**
     * Language location code
     *
     * @var string
     */
    public $locale;

    /**
     * x-request-id header
     *
     * @var string
     */
    private $requestId;

    /**
     * Getter for Locale.
     *
     * @return string Language location code.
     */
    public function getLocale(): ?string
    {
        return $this->locale;
    }

    /**
     * Setter for Locale.
     *
     * @param string $locale Language location code.
     * @return AbstractRequest
     * @throws StockApiException if locale is empty.
     */
    public function setLocale(string $locale) : AbstractRequest
    {
        if (!empty($locale)) {
            $this->locale = $locale;
        } else {
            throw StockApiException::withMessage('Locale cannot be empty string');
        }

        return $this;
    }

    /**
     * Set x-request-id header
     *
     * @param string $requestId
     * @return AbstractRequest
     */
    public function setRequestId(string $requestId): AbstractRequest
    {
        $this->requestId = $requestId;
        return $this;
    }

    /**
     * Get x-request-id header
     *
     * @return string|null
     */
    public function getRequestId(): ?string
    {
        return $this->requestId;
    }
}
