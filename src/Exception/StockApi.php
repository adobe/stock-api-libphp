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
