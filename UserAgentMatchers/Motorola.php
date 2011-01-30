<?php
namespace TeraWurfl\UserAgentMatchers;

/**
 * Tera_WURFL - PHP MySQL driven WURFL
 * 
 * Tera-WURFL was written by Steve Kamerman, and is based on the
 * Java WURFL Evolution package by Luca Passani and WURFL PHP Tools by Andrea Trassati.
 * This version uses a MySQL database to store the entire WURFL file, multiple patch
 * files, and a persistent caching mechanism to provide extreme performance increases.
 * 
 * @package TeraWurflUserAgentMatchers
 * @author Steve Kamerman <stevekamerman AT gmail.com>
 * @version Stable 2.1.3 $Date: 2010/09/18 15:43:21
 * @license http://www.mozilla.org/MPL/ MPL Vesion 1.1
 */
/**
 * Provides a specific user agent matching technique
 * @package TeraWurflUserAgentMatchers
 */
class Motorola extends AbstractMatcher 
{
    
    public static $constantIDs = array('mot_mib22_generic');
    
    public function applyConclusiveMatch($ua) 
    {
        $tolerance = 5;
        
        if ($this->helper->startsWith($ua, "Mot-") 
            || $this->helper->startsWith($ua, "MOT-") 
            || $this->helper->startsWith($ua, "Motorola")
        ) {
            $deviceId = $this->risMatch($ua, $tolerance);
            return $deviceId;
        }
        
        $deviceId = $this->ldMatch($ua, $tolerance);
        return $deviceId;
    }
    
    public function recoveryMatch($ua)
    {
        if ($this->helper->contains($ua, 'MIB/2.2') 
            || $this->helper->contains($ua, 'MIB/BER2.2')
        ) {
            return 'mot_mib22_generic';
        }
        
        return TeraWurfl\Constants::GENERIC;
    }
}
