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
    public function setLocale(string $locale = null) : LicenseHistory
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
    public function setSearchParams(SearchParamLicenseHistoryModel $search_parameters = null) : LicenseHistory
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
    public function setResultColumns(array $result_columns = null) : LicenseHistory
    {
        if (empty($result_columns)) {
            throw StockApiException::withMessage('ResultColumns array cannot be empty');
        }
        
        $this->result_columns = $result_columns;
        return $this;
    }
}
