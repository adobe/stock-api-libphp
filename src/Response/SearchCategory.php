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
