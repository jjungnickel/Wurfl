<?php
namespace Wurfl\VirtualCapability\UserAgentTool;

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
 * @package    WURFL_VirtualCapability_UserAgentTool
 * @copyright  ScientiaMobile, Inc.
 * @license    GNU Affero General Public License
 * @version    $id$
 */

/**
 * @package WURFL_VirtualCapability_UserAgentTool
 */
class PropertyList
{
    /**
     * @var \Wurfl\VirtualCapability\UserAgentTool\Device
     */
    protected $device;
    
    public function __construct(Device $device) 
    {
        $this->device = $device;
    }
    
    public function set() 
    {
        return true;
    }
}