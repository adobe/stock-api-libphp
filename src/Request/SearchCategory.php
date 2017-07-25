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

class SearchCategory
{
    /**
     * Language location code
     * @var string
     */
    public $locale;

    /**
     * Unique identifier for an existing category.
     * @var integer
     */
    public $category_id;

    /**
     * Getter for Locale.
     * @return string Language location code.
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Setter for Locale.
     * @param string $locale Language location code.
     * @return SearchCategory
     * @throws StockApiException if locale is empty.
     */
    public function setLocale(string $locale) : SearchCategory
    {
        if (!empty($locale)) {
            $this->locale = $locale;
        } else {
            throw StockApiException::withMessage('Locale cannot be empty string');
        }

        return $this;
    }

    /**
     * Getter for CategoryId.
     * @return int Unique identifier for an existing category.
     */
    public function getCategoryId() : int
    {
        return $this->category_id;
    }

    /**
     * Setter for CategoryId.
     * @param int $category_id Unique identifier for an existing category.
     * @return SearchCategory
     * @throws StockApiException if category id is negative.
     */
    public function setCategoryId(int $category_id) : SearchCategory
    {
        if ($category_id < 0) {
            throw StockApiException::withMessage('Category Id cannot be negative');
        }

        $this->category_id = $category_id;
        return $this;
    }
}
