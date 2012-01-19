<?php
declare(ENCODING = 'utf-8');
namespace Wurfl\Handlers;

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
 *
 * @category   WURFL
 * @package    WURFL_Handlers
 * @copyright  ScientiaMobile, Inc.
 * @license    GNU Affero General Public License
 * @version   SVN: $Id$
 */

/**
 * NokiaUserAgentHanlder
 *
 *
 * @category   WURFL
 * @package    WURFL_Handlers
 * @copyright  ScientiaMobile, Inc.
 * @license    GNU Affero General Public License
 * @version   SVN: $Id$
 */
class NokiaHandler extends Handler
{
    protected $prefix = 'NOKIA';
    
    public function __construct($wurflContext, $userAgentNormalizer = null)
    {
        parent::__construct($wurflContext, $userAgentNormalizer);
    }
    
    /**
     * Intercepting All User Agents containing 'Nokia'
     *
     * @param string $userAgent
     * @return boolean
     */
    public function canHandle($userAgent)
    {
        return Utils::checkIfContains($userAgent, 'Nokia');
    }
    
    /**
     *
     * Apply RIS with FS(First Slash) after Nokia String as a threshold.
     * 
     * 
     * @param string $userAgent
     * @return string
     */
    public function lookForMatchingUserAgent($userAgent)
    {
        //$tolerance = WU
        $tolerance = Utils::indexOfAnyOrLength($userAgent, array('/', ' '), strpos($userAgent, 'Nokia'));
        $userAgents = array_keys($this->userAgentsWithDeviceID);
        return parent::applyRisWithTollerance($userAgents, $userAgent, $tolerance);
    
    }

    /**
     * If the User Agent contains 'Series60' and 'Series80'. 
     * Return 'nokia_generic_series60' and 'nokia_generic_series80' 
     * respectively in case of success.
     *
     * @param string $userAgent
     * @return string
     */
    public function applyRecoveryMatch($userAgent)
    {
        if(!(strpos($userAgent, 'Nokia') === false)) {
            if(strpos($userAgent, 'Series60') != 0) {
                return 'nokia_generic_series60';
            }
            if(strpos($userAgent, 'Series80') != 0) {
                return 'nokia_generic_series80';
            }
        }
        
        return Constants::GENERIC;
    }

}
