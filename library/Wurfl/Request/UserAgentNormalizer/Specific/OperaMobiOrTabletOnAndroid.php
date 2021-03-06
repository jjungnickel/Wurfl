<?php
namespace Wurfl\Request\UserAgentNormalizer\Specific;

/**
 * Copyright (c) 2012 ScientiaMobile, Inc.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * Refer to the COPYING.txt file distributed with this package.
 *
 * @category   WURFL
 * @package    WURFL_Request_UserAgentNormalizer_Specific
 * @copyright  ScientiaMobile, Inc.
 * @license    GNU Affero General Public License
 * @author     Fantayeneh Asres Gizaw
 * @version    $id$
 */

use \Wurfl\Request\UserAgentNormalizer\NormalizerInterface;
use \Wurfl\Handlers\SafariHandler;
use \Wurfl\Handlers\OperaMobiOrTabletOnAndroidHandler;
use \Wurfl\Handlers\AndroidHandler;
use \Wurfl\Handlers\Utils;
use \Wurfl\Constants;

/**
 * User Agent Normalizer
 * @package    WURFL_Request_UserAgentNormalizer_Specific
 */
class OperaMobiOrTabletOnAndroid implements NormalizerInterface
{
    public function normalize($userAgent) {
        
        $is_opera_mobi = Utils::checkIfContains($userAgent, 'Opera Mobi');
        $is_opera_tablet = Utils::checkIfContains($userAgent, 'Opera Tablet');
        if ($is_opera_mobi || $is_opera_tablet) {
            $opera_version = OperaMobiOrTabletOnAndroidHandler::getOperaOnAndroidVersion($userAgent, false);
            $android_version = AndroidHandler::getAndroidVersion($userAgent, false);
            if ($opera_version !== null && $android_version !== null) {
                $opera_model = $is_opera_tablet? 'Opera Tablet': 'Opera Mobi';
                $prefix = $opera_model.' '.$opera_version.' Android '.$android_version.Constants::RIS_DELIMITER;
                return $prefix.$userAgent;
            }
        }
        
        return $userAgent;
    }
}