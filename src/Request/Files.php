<?php
/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

declare(strict_types=1);

namespace AdobeStock\Api\Request;

use \AdobeStock\Api\Core\Constants;
use \AdobeStock\Api\Exception\StockApi as StockApiException;

class Files
{
    /**
     * @var array File ids comma separated
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
     * @return array
     */
    public function getIds() : ?array
    {
        return $this->ids;
    }

    /**
     * @param array $ids
     * @return Files
     */
    public function setIds(array $ids) : Files
    {
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
     */
    public function setLocale(string $locale) : Files
    {
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
     */
    public function setResultColumns(array $result_columns) : Files
    {
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
            Constants::getQueryParamsProps()['IDS'] => implode(',', $this->ids),
            Constants::getQueryParamsProps()['LOCALE'] => $this->locale,
            Constants::getQueryParamsProps()['RESULT_COLUMNS'] => $this->result_columns
        ];
    }
}
