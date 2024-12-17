<?php
/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Request;

use \AdobeStock\Api\Exception\StockApi as StockApiException;
use \AdobeStock\Api\Models\SearchParamLicenseHistory as SearchParamLicenseHistoryModel;

class LicenseHistory
{
    /**
     * @var string Language location code
     */
    public $locale;
    
    /**
     * @var SearchParamLicenseHistoryModel search params.
     */
    public $search_parameters;
    
    /**
     * @var array result column constants
     */
    public $result_columns;
    
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
     * @throws StockApiException if locale is null
     * @return LicenseHistory
     */
    public function setLocale(?string $locale = null) : LicenseHistory
    {
        if ($locale === null) {
            throw StockApiException::withMessage('Locale cannot be null');
        }
        
        $this->locale = $locale;
        return $this;
    }
    
    /**
     * Get SearchParameters array that consists of various search params
     * @return SearchParamLicenseHistoryModel|null
     */
    public function getSearchParams() : ?SearchParamLicenseHistoryModel
    {
        return $this->search_parameters;
    }
    
    /**
     * Sets SearchParameters object that consists of various search params
     * @param SearchParamLicenseHistoryModel $search_parameters
     * @throws StockApiException
     * @return LicenseHistory
     */
    public function setSearchParams(?SearchParamLicenseHistoryModel $search_parameters = null) : LicenseHistory
    {
        if ($search_parameters === null) {
            throw StockApiException::withMessage('SearchParams array cannot be null');
        }
        
        $this->search_parameters = $search_parameters;
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
     * @throws StockApiException
     * @return LicenseHistory
     */
    public function setResultColumns(?array $result_columns = null) : LicenseHistory
    {
        if (empty($result_columns)) {
            throw StockApiException::withMessage('ResultColumns array cannot be empty');
        }
        
        $this->result_columns = $result_columns;
        return $this;
    }
}
