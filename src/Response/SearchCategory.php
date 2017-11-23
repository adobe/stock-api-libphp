<?php
/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Response;

class SearchCategory
{
    /**
     * Stock asset id
     * @var integer
     */
    public $id;

    /**
     * category name
     * @var string
     */
    public $name;

    /**
     * category link
     * @var string
     */
    public $link;

    /**
     * Constructor function.
     * @param array $raw_response Raw response returned from api call.
     */
    public function __construct(array $raw_response)
    {
        foreach ($raw_response as $key => $val) {
            if (property_exists($this, $key)) {
                $this->$key = $val;
            }
        }
    }

    /**
     * Getter for Category id.
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Setter for Unique identifier for an existing category.
     * @param int $id passed value for category id
     * @return SearchCategory response object.
     */
    public function setId(int $id) : SearchCategory
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Getter for category name.
     * @return string category name
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Setter for category name.
     * @param string $name category name
     * @return SearchCategory response object.
     */
    public function setName(string $name) : SearchCategory
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Getter for category link.
     * @return string
     */
    public function getLink() : string
    {
        return $this->link;
    }

    /**
     * Setter for category Link.
     * @param string $link category link
     * @return SearchCategory response object.
     */
    public function setLink(string $link) : SearchCategory
    {
        $this->link = $link;
        return $this;
    }
}
