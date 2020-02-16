<?php
/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Request;

use AdobeStock\Api\Core\Constants;
use \AdobeStock\Api\Exception\StockApi as StockApiException;

class Files
{
    /**
     * @var string File ids comma separated
     */
    private $ids;

    /**
     * @var string Language location code
     */
    private $locale;

    /**
     * @var array result column constants
     */
    private $result_columns;

    /**
     * @return string
     */
    public function getIds() : ?string
    {
        return $this->ids;
    }

    /**
     * @param string|null $ids
     * @return Files
     * @throws StockApiException
     */
    public function setIds(string $ids = null) : Files
    {
        if ($ids == null) {
            throw StockApiException::withMessage('Ids cannot be null');
        }
        $this->ids = $ids;
        return $this;
    }

    /**
     * Getter for Locale.
     * @return string|null Language location code.
     */
    public function getLocale() : ?string
    {
        return $this->locale;
    }

    /**
     * Setter for Locale.
     * @param string $locale Language location code.
     * @return Files
     * @throws StockApiException
     */
    public function setLocale(string $locale = null) : Files
    {
        if ($locale == null) {
            throw StockApiException::withMessage('Locale cannot be null');
        }
        $this->locale = $locale;
        return $this;
    }

    /**
     * Get ResultColumns array that you have included for columns
     * @return array|null
     */
    public function getResultColumns() : ?array
    {
        return $this->result_columns;
    }

    /**
     * Set ResultColumns array consisting of result column constants
     * @param array $result_columns
     * @return Files
     * @throws StockApiException
     */
    public function setResultColumns(array $result_columns = null) : Files
    {
        if (empty($result_columns)) {
            throw StockApiException::withMessage('ResultColumns array cannot be empty');
        }
        $this->result_columns = $result_columns;
        return $this;
    }

    /**
     * Transforms object to array
     *
     * @return array
     */
    public function toArray()
    {
        return [
            Constants::getQueryParamsProps()['IDS'] => $this->ids,
            Constants::getQueryParamsProps()['LOCALE'] => $this->locale,
            Constants::getQueryParamsProps()['RESULT_COLUMNS'] => $this->result_columns
        ];
    }
}
