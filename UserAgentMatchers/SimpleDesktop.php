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
 * Matches desktop browsers.  This UserAgentMatcher is unlike the rest in that it is does not use any database functions to find a matching device.  If a device is not matched with this UserAgentMatcher, another one is assigned to match it using the database.
 * @package TeraWurflUserAgentMatchers
 */
class SimpleDesktop extends AbstractMatcher 
{
    public function applyConclusiveMatch() 
    {
        return TeraWurfl\Constants::GENERIC_WEB_BROWSER;
    }
    
    /**
     * Is the given user agent very likely to be a desktop browser
     * @param String User agent
     * @return Bool
     */
    public function isDesktopBrowser()
    {
        if (\TeraWurfl\UserAgentUtils::isMobileBrowser($this->userAgent)) {
            return false;
        }
        
        if($this->helper->contains(array(
            'HTC', // HTC; horrible user agents, especially with Opera
            'PPC', // PowerPC; not always mobile, but we'll kick it out of SimpleDesktop and match it in the WURFL DB
            'Nintendo' // too hard to distinguish from Opera
        ))) return false;
        // Firefox
        if($this->helper->contains("Firefox") && !$this->helper->contains($this->userAgent,'Tablet')) return true;
        if(\TeraWurfl\UserAgentUtils::isDesktopBrowser($this->userAgent)) return true;
        if($this->helper->startsWith('Opera/')) return true;
        if($this->helper->regexContains(array(
//            // Opera
//            '/Opera\/\d/',
            // Internet Explorer
            '/^Mozilla\/4\.0 \(compatible; MSIE \d.\d; Windows NT \d.\d/'
        ))) return true;
        if($this->helper->contains(array(
            "Chrome",
            "yahoo.com",
            "google.com",
            "Comcast"
        ))){
            return true;
        }
        return false;
    }
}
