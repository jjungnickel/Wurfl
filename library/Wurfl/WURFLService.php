<?php
declare(ENCODING = 'utf-8');
namespace Wurfl;

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
 * @package    WURFL
 * @copyright  ScientiaMobile, Inc.
 * @license    GNU Affero General Public License
 * @version   SVN: $Id$
 */

/**
 * WURFL Service
 * @package    WURFL
 */
class WURFLService
{
    /**
     * @var WURFL_DeviceRepository
     */
    private $_deviceRepository;
    /**
     * @var WURFL_UserAgentHandlerChain
     */
    private $_userAgentHandlerChain;
    /**
     * @var WURFL_Storage
     */
    private $_cacheProvider;
    
    public function __construct(DeviceRepository $deviceRepository, UserAgentHandlerChain $userAgentHandlerChain, Storage $cacheProvider)
    {
        $this->_deviceRepository = $deviceRepository;
        $this->_userAgentHandlerChain = $userAgentHandlerChain;
        $this->_cacheProvider = $cacheProvider;
    }
    
    /**
     * Returns the version info about the loaded WURFL
     * @return WURFL_Xml_Info WURFL Version info
     * @see WURFL_DeviceRepository::getWURFLInfo()
     */
    public function getWURFLInfo()
    {
        return $this->_deviceRepository->getWURFLInfo();
    }
    
    /**
     * Returns the Device for the given \Wurfl\Request\GenericRequest
     *
     * @param \Wurfl\Request\GenericRequest $request
     * @return WURFL_CustomDevice
     */
    public function getDeviceForRequest(Request\GenericRequest $request)
    {
        $deviceId = $this->_deviceIdForRequest($request);
        
        return $this->_getWrappedDevice($deviceId);
    
    }
    
    /**
     * Retun a WURFL_Xml_ModelDevice for the given device id
     *
     * @param string $deviceID
     * @return WURFL_Xml_ModelDevice
     */
    public function getDevice($deviceID)
    {
        return $this->_getWrappedDevice($deviceID);
    }
    
    /**
     * Returns all devices ID present in WURFL
     *
     * @return array of strings
     */
    public function getAllDevicesID()
    {
        return $this->_deviceRepository->getAllDevicesID();
    }
    
    /**
     * Returns an array of all the fall back devices starting from
     * the given device
     *
     * @param string $deviceID
     * @return array
     */
    public function getDeviceHierarchy($deviceID)
    {
        return $this->_deviceRepository->getDeviceHierarchy($deviceID);
    }
    
    public function getListOfGroups()
    {
        return $this->_deviceRepository->getListOfGroups();
    }
    
    public function getCapabilitiesNameForGroup($groupId)
    {
        return $this->_deviceRepository->getCapabilitiesNameForGroup($groupId);
    }
    
    // ******************** private functions *****************************
    

    /**
     * Returns the device id for the device that matches the $request
     * @param \Wurfl\Request\GenericRequest $request WURFL Request object
     * @return string WURFL device id
     */
    private function _deviceIdForRequest($request)
    {
        $deviceId = $this->_cacheProvider->load($request->id);
        
        if (empty($deviceId)) {
            $deviceId = $this->_userAgentHandlerChain->match($request);
            
            // save it in cache
            $this->_cacheProvider->save($request->id, $deviceId);
        }
        
        return $deviceId;
    }
    
    /**
     * Wraps the model device with WURFL_Xml_ModelDevice
     *
     * @param string $deviceID
     * @return WURFL_CustomDevice
     */
    private function _getWrappedDevice($deviceID)
    {
        $modelDevices = $this->_deviceRepository->getDeviceHierarchy($deviceID);
        return new CustomDevice($modelDevices);
    }
}

