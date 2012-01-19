<?php
declare(ENCODING = 'utf-8');
namespace Wurfl\Request\UserAgentNormalizer\Specific;

/**
 * Copyright(c) 2011 ScientiaMobile, Inc.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or(at your option) any later version.
 *
 * Refer to the COPYING file distributed with this package.
 *
 * @category   WURFL
 * @package    WURFL_Request_UserAgentNormalizer_Specific
 * @copyright  ScientiaMobile, Inc.
 * @license    GNU Affero General Public License
 * @author     Fantayeneh Asres Gizaw
 * @version   SVN: $Id$
 */
/**
 * User Agent Normalizer - Trims the version number to two digits(e.g. 2.1.1 -> 2.1)
 * @package    WURFL_Request_UserAgentNormalizer_Specific
 */
class Android implements \Wurfl\Request\UserAgentNormalizer\NormalizerInterface
{
    const ANDROID_OS_VERSION = '/(Android[\s\/]\d.\d)(.*?;)/';
    
    public function normalize($userAgent)
    {
        return preg_replace(self::ANDROID_OS_VERSION, '$1;', $userAgent);
    }


}
