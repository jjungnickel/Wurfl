<?php
namespace Wurfl\Handlers;

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
 *
 * @category   WURFL
 * @package    \Wurfl\Handlers
 * @copyright  ScientiaMobile, Inc.
 * @license    GNU Affero General Public License
 * @version    $id$
 */

use \Wurfl\Constants;

/**
 * WebOSUserAgentHandler
 * 
 *
 * @category   WURFL
 * @package    \Wurfl\Handlers
 * @copyright  ScientiaMobile, Inc.
 * @license    GNU Affero General Public License
 * @version    $id$
 */
class WebOSHandler extends Handler {
    
    protected $prefix = "WEBOS";
    
    public static $constantIDs = array(
        'hp_tablet_webos_generic',
        'hp_webos_generic',
    );
    
    public function canHandle($userAgent) {
        if (Utils::isDesktopBrowser($userAgent)) return false;
        return Utils::checkIfContainsAnyOf($userAgent, array('webOS', 'hpwOS'));
    }
    
    public function applyConclusiveMatch($userAgent) {
        $delimiter_idx = strpos($userAgent, Constants::RIS_DELIMITER);
        if ($delimiter_idx !== false) {
            $tolerance = $delimiter_idx + strlen(Constants::RIS_DELIMITER);
            return $this->getDeviceIDFromRIS($userAgent, $tolerance);
        }
        
        return Constants::NO_MATCH;
    }
    
    public function applyRecoveryMatch($userAgent){
        return Utils::checkIfContains($userAgent, 'hpwOS/3')? 'hp_tablet_webos_generic': 'hp_webos_generic';
    }
    
    public static function getWebOSModelVersion($ua) {
        /* Formats:
         * Mozilla/5.0 (hp-tablet; Linux; hpwOS/3.0.5; U; es-US) AppleWebKit/534.6 (KHTML, like Gecko) wOSBrowser/234.83 Safari/534.6 TouchPad/1.0
         * Mozilla/5.0 (Linux; webOS/2.2.4; U; de-DE) AppleWebKit/534.6 (KHTML, like Gecko) webOSBrowser/221.56 Safari/534.6 Pre/3.0
         * Mozilla/5.0 (webOS/1.4.0; U; en-US) AppleWebKit/532.2 (KHTML, like Gecko) Version/1.0 Safari/532.2 Pre/1.0
         */
        if (preg_match('# ([^/]+)/([\d\.]+)$#', $ua, $matches)) {
            return $matches[1].' '.$matches[2];
        } else {
            return null;
        }
    }
    
    public static function getWebOSVersion($ua) {
        if (preg_match('#(?:hpw|web)OS.(\d)\.#', $ua, $matches)) {
            return 'webOS'.$matches[1];
        } else {
            return null;
        }
    }
}