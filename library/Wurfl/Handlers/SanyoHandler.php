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
 * SanyoUserAgentHandler
 *
 *
 * @category   WURFL
 * @package    \Wurfl\Handlers
 * @copyright  ScientiaMobile, Inc.
 * @license    GNU Affero General Public License
 * @version    $id$
 */
class SanyoHandler extends Handler {
    
    protected $prefix = "SANYO";

    public function canHandle($userAgent) {
        if (Utils::isDesktopBrowser($userAgent)) return false;
        return Utils::checkIfStartsWithAnyOf($userAgent, array('Sanyo', 'SANYO')) || Utils::checkIfContains($userAgent, 'MobilePhone');
    }
    
    public function applyConclusiveMatch($userAgent) {
        $idx = strpos($userAgent, 'MobilePhone');
        if ($idx !== false) {
            $tolerance = Utils::indexOfOrLength('/', $userAgent, $idx);
        } else {
            $tolerance = Utils::firstSlash($userAgent);
        }
        return $this->getDeviceIDFromRIS($userAgent, $tolerance);
    }
}