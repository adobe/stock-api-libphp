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

namespace AdobeStock\Api\Client\Http;

use \GuzzleHttp\Psr7\Stream;

interface HttpInterface
{
    /**
     * Method to execute GET queries using custom http clients.
     * @param string $url     Endpoint that needs to hit.
     * @param array  $headers associative array of headers.
     * @return Stream raw response returned from the api call.
     */
    public function doGet(string $url, array $headers) : Stream;
    
    /**
     * Method to execute POST queries using custom http clients.
     * @param string $url       Endpoint that needs to hit.
     * @param array  $headers   associative array of headers.
     * @param array  $post_data data that need to send with post query.
     * @return Stream raw response returned from the api call.
     */
    public function doPost(string $url, array $headers, array $post_data) : Stream;
    
    /**
     * Method to upload multipart data using custom http clients.
     * @param string $url     Endpoint that needs to hit.
     * @param array  $headers associative array of headers.
     * @param string $file    File to be uploaded.
     * @return Stream raw response returned from the api call.
     */
    public function doMultiPart(string $url, array $headers, string $file) : Stream;
}
