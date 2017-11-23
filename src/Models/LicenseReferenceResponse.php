<?php

/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

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
