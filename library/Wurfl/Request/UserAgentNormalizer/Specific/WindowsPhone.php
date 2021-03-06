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
 * @package    \Wurfl\Request_UserAgentNormalizer_Specific
 * @copyright  ScientiaMobile, Inc.
 * @license    GNU Affero General Public License
 * @author     Fantayeneh Asres Gizaw
 * @version    $id$
 */

use \Wurfl\Request\UserAgentNormalizer\NormalizerInterface;
use \Wurfl\Constants;
use \Wurfl\Handlers\WindowsPhoneHandler;
use \Wurfl\Handlers\Utils;

/**
 * User Agent Normalizer
 * @package    \Wurfl\Request_UserAgentNormalizer_Specific
 */
class WindowsPhone implements NormalizerInterface
{
    public function normalize($userAgent)
    {
        if (Utils::checkIfStartsWith($userAgent, 'Windows Phone Ad Client')) {
            $model   = WindowsPhoneHandler::getWindowsPhoneAdClientModel($userAgent);
            $version = WindowsPhoneHandler::getWindowsPhoneAdClientVersion($userAgent);
        } else if (Utils::checkIfContains($userAgent, 'NativeHost')) {
            return $userAgent;
        } else {
            $model   = WindowsPhoneHandler::getWindowsPhoneModel($userAgent);
            $version = WindowsPhoneHandler::getWindowsPhoneVersion($userAgent);
        }
        
        if ($model !== null && $version !== null) {
            $prefix = 'WP' . $version . ' ' . $model . Constants::RIS_DELIMITER;
            return $prefix . $userAgent;
        }
        
        return $userAgent;
    }
}