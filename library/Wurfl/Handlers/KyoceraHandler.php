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
 * KyoceraUserAgentHandler
 * 
 *
 * @category   WURFL
 * @package    \Wurfl\Handlers
 * @copyright  ScientiaMobile, Inc.
 * @license    GNU Affero General Public License
 * @version    $id$
 */
class KyoceraHandler extends Handler {
    
    protected $prefix = "KYOCERA";
    
    public function canHandle($userAgent) {
        if (Utils::isDesktopBrowser($userAgent)) return false;
        return Utils::checkIfStartsWithAnyOf($userAgent, array('kyocera', 'QC-', 'KWC-'));
    }
}
