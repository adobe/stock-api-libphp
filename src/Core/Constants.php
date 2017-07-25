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

namespace AdobeStock\Api\Core;

class Constants
{
    /**
     * array of supported environments.
     * @var array environments
     */
    protected static $_environments = [
        'PROD' => 'PROD',
        'STAGE' => 'STAGE',
    ];

    /**
     * Getter for environments.
     * @return array of supported environments
     */
    public static function getEnvironments() : array
    {
        return self::$_environments;
    }

    /**
     * array of stock api end points.
     * @var array end points.
     */
    protected static $_end_points = [
        'search' => 'https://stock.adobe.io/Rest/Media/1/Search/Files',
        'category' => 'https://stock.adobe.io/Rest/Media/1/Search/Category',
        'category_tree' => 'https://stock.adobe.io/Rest/Media/1/Search/CategoryTree',
        'license' => 'https://stock.adobe.io/Rest/Libraries/1/Content/License',
        'license_info' => 'https://stock.adobe.io/Rest/Libraries/1/Content/Info',
        'user_profile' => 'https://stock.adobe.io/Rest/Libraries/1/Member/Profile',
        'abandon' => 'https://stock.adobe.io/Rest/Libraries/1/Member/Abandon',
    ];

    /**
     * Getter for end points.
     * @return array of end points
     */
    public static function getEndPoints() : array
    {
        return self::$_end_points;
    }
}
