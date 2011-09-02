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
class Chrome extends AbstractMatcher 
{
    
    public static $constantIDs = array("google_chrome");
    
    public function applyConclusiveMatch() 
    {
        $tolerance = $this->helper->indexOfOrLength('/', strpos($this->userAgent, 'Chrome'));
        return $this->risMatch($this->userAgent, $tolerance);
    }
    
    public function recoveryMatch()
    {
        return 'google_chrome';
    }
}