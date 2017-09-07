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

namespace AdobeStock\Api\Models;

class LicenseReferenceResponse
{
    /**
     * @var int The license reference id.
     */
    public $id;
    
    /**
     * @var string License reference description.
     */
    public $text;
    
    /**
     * Whether license reference must be submitted
     * when licensing the image.
     * @var bool
     */
    public $required;

    /**
     * @return license reference id.
     */
    public function getLicenseReferenceId(): int
    {
        return $this->id;
    }

    /**
     * @param int $val
     * @return LicenseReferenceResponse
     */
    public function setLicenseReferenceId(int $val) : LicenseReferenceResponse
    {
        $this->id = $val;
        return $this;
    }

    /**
     * Get whether license reference must be submitted
     * when licensing the image.
     * @return true if license reference must be submitted else false
     */
    public function getRequired(): bool
    {
        return $this->required;
    }

    /**
     * Sets whether license reference must be submitted
     * when licensing the image.
     * @param bool $val , required true if license reference must be submitted else false
     * @return LicenseReferenceResponse
     */
    public function setRequired(bool $val) : LicenseReferenceResponse
    {
        $this->required = $val;
        return $this;
    }

    /**
     * Get License reference description.
     * @return description of type String.
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * Sets License reference description.
     * @param string $val
     * @return LicenseReferenceResponse
     */
    public function setText(string $val) : LicenseReferenceResponse
    {
        $this->text = $val;
        return $this;
    }
}
