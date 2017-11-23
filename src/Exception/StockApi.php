<?php
/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */

namespace AdobeStock\Api\Exception;

final class StockApi extends \Exception
{
    /**
     * Constructor with two arguments.
     * @param string     $message   Message
     * @param \Exception $exception full exception
     * @return StockApi
     */
    public static function withMessage(string $message, \Exception $exception = null) : StockApi
    {
        $instance = static::withMessageAndErrorCode($message, 0, $exception);
        return $instance;
    }

    /**
     * Constructor with three arguments.
     * @param string     $message   Message
     * @param integer    $code      ErrorCode
     * @param \Exception $exception full exception
     * @return StockApi
     */
    public static function withMessageAndErrorCode($message, int $code, \Exception $exception = null) : StockApi
    {
        $instance = new static($message, $code, $exception);
        return $instance;
    }
}
