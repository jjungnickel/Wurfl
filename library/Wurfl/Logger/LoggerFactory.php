<?php
declare(ENCODING = 'utf-8');
namespace Wurfl\Logger;

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
 * @package    WURFL_Logger
 * @copyright  ScientiaMobile, Inc.
 * @license    GNU Affero General Public License
 * @version   SVN: $Id$
 */
/**
 * Logging factory
 * 
 * @package    WURFL_Logger
 */
class LoggerFactory
{
    /**
     * Create Logger for undetected devices with filename undetected_devices.log
     * @param WURFL_Configuration_Config $wurflConfig
     * @return WURFL_Logger_Interface Logger object
     */
    static public function createUndetectedDeviceLogger($wurflConfig=null)
    {    
        if (self::_isLoggingConfigured($wurflConfig)) {
            return self::createFileLogger($wurflConfig, 'undetected_devices.log');
        }
        return new NullLogger();
    }
    
    /**
     * Creates Logger for general logging(not undetected devices)
     * @param WURFL_Configuration_Config $wurflConfig
     * @return WURFL_Logger_Interface Logger object
     */
    static public function create($wurflConfig = NULL)
    {
        if (self::_isLoggingConfigured($wurflConfig)) {
            return self::createFileLogger($wurflConfig, 'wurfl.log');
        }
        return new NullLogger();                
    }
    
    /**
     * Creates a new file logger
     * @param WURFL_Configuration_Config $wurflConfig
     * @param string $fileName
     * @return WURFL_Logger_FileLogger File logger
     */
    static public function createFileLogger($wurflConfig, $fileName)
    {
        $logFileName = self::_createLogFile($wurflConfig->logDir, $fileName);
        return new FileLogger($logFileName);
    }
    
    /**
     * Returns true if $wurflConfig specifies a Logger
     * @param WURFL_Configuration_Config $wurflConfig
     * @return bool
     */
    private static function _isLoggingConfigured($wurflConfig)
    {    
        if (is_null($wurflConfig)) {
            return false;
        }
        return !is_null($wurflConfig->logDir) && is_writable($wurflConfig->logDir);
    }
    
    /**
     * Creates a new log file in given $logDir with given $fileName
     * @param string $logDir
     * @param string $fileName
     * @return string Complete filename to created logfile
     */    
    private static function _createLogFile($logDir, $fileName)
    {
        $file = realpath($logDir . DIRECTORY_SEPARATOR . $fileName);
        touch($file);
        return $file;
    }
}