<?php
/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Request;

use \AdobeStock\Api\Exception\StockApi as StockApiException;

class SearchCategory extends AbstractRequest
{
    /**
     * Unique identifier for an existing category.
     * @var integer
     */
    public $category_id;

    /**
     * Getter for CategoryId.
     * @return int|null Unique identifier for an existing category.
     */
    public function getCategoryId() : ?int
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
