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

/**
 * SamsungUserAgentHandler
 *
 *
 * @category   WURFL
 * @package    \Wurfl\Handlers
 * @copyright  ScientiaMobile, Inc.
 * @license    GNU Affero General Public License
 * @version    $id$
 */
class SamsungHandler extends Handler {

    protected $prefix = "SAMSUNG";
    
    public function canHandle($userAgent) {
        if (Utils::isDesktopBrowser($userAgent)) return false;
        return Utils::checkIfContainsAnyOf($userAgent, array('Samsung', 'SAMSUNG'))
            || Utils::checkIfStartsWithAnyOf($userAgent, array('SEC-', 'SPH', 'SGH', 'SCH'));
    }
    
    public function applyConclusiveMatch($userAgent) {
        if (Utils::checkIfStartsWithAnyOf($userAgent, array("SEC-", "SAMSUNG-", "SCH"))) {
            $tolerance = Utils::firstSlash($userAgent);
        } else if (Utils::checkIfStartsWithAnyOf($userAgent, array("Samsung", "SPH", "SGH"))) {
            $tolerance = Utils::firstSpace($userAgent);
        } else {
            $tolerance = Utils::secondSlash($userAgent);
        }
        return $this->getDeviceIDFromRIS($userAgent, $tolerance);
    }
    
    public function applyRecoveryMatch($userAgent) {
        if (Utils::checkIfStartsWith($userAgent, 'SAMSUNG')) {
            $tolerance = 8;
            return $this->getDeviceIDFromLD($userAgent, $tolerance);
        } else {
            $tolerance = Utils::indexOfOrLength($userAgent, '/', strpos($userAgent, 'Samsung'));
            return $this->getDeviceIDFromRIS($userAgent, $tolerance);
        }
    }
}