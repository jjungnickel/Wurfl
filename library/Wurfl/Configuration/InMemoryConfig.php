<?php
namespace Wurfl\Configuration;

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
 * @package    \Wurfl\Configuration
 * @copyright  ScientiaMobile, Inc.
 * @license    GNU Affero General Public License
 * @version    $id$
 */

use \Wurfl\Exception;

/**
 * In-memory WURFL Configuration
 * @package    \Wurfl\Configuration
 */
class InMemoryConfig extends Config
{
    /**
     * @param string $wurflFile
     * @return \Wurfl\Configuration\InMemoryConfig $this
     */
    public function wurflFile($wurflFile)
    {
        $this->wurflFile = $wurflFile;
        
        return $this;
    }
    
    /**
     * @param string $wurflPatch
     * @return \Wurfl\Configuration\InMemoryConfig $this
     */
    public function wurflPatch($wurflPatch)
    {
        $this->wurflPatches[] = $wurflPatch;
        return $this;
    }
    
    /**
     * @param array $capabilityFilter
     * @return \Wurfl\Configuration\InMemoryConfig $this
     */
    public function capabilityFilter(array $capabilityFilter)
    {
        $this->capabilityFilter = $capabilityFilter;
        return $this;
    }
    
    /**
     * Set persistence provider
     * @param string $provider
     * @param array $params
     * @return \Wurfl\Configuration\InMemoryConfig $this
     */
    public function persistence($provider, $params = array())
    {
        $this->persistence = array('provider' => $provider, 'params' => $params);
        return $this;                
    }
    
    /**
     * Set Cache provider
     * @param string $provider
     * @param array $params
     * @return \Wurfl\Configuration\InMemoryConfig $this
     */
    public function cache($provider, $params = array())
    {
        $this->cache = array('provider' => $provider, 'params' => $params);
        return $this;
    }
    
    /**
     * Set logging directory
     * @param string $logger
     * @param string $logDir
     *
     * @return \Wurfl\Configuration\InMemoryConfig $this
     */
    public function logger($logger, $logDir)
    {
        $this->logger = array('type' => $logger, 'logDir' => $logDir);
        return $this;
    }
    
    /**
     * Specifies whether reloading is allowed
     * @param bool $reload
     * @return \Wurfl\Configuration\InMemoryConfig $this
     */
    public function allowReload($reload = true)
    {
        $this->allowReload = $reload;
        return $this;
    }
    
    /**
     * Sets the API match mode
     * @param string $mode
     * @return \Wurfl\Configuration\InMemoryConfig
     */
    public function matchMode($mode)
    {
        if (!self::validMatchMode($mode)) {
            throw new Exception('Invalid Match Mode: ' . $mode);
        }
        
        $this->matchMode = $mode;
        
        return $this;
    }
    
    protected function initialize()
    {
        // nothing to do
    }
}