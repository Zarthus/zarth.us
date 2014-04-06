<?php
if (!defined("SITE_INIT")) die("Website is not initialised properly, you cannot open this file directly");
/**
 *	Autoloader
 *
 *	The class that handles including pages that are not yet included.
 *
 *	@package	zarth.us
 *	@author		Zarthus <zarthus@zarth.us>
 *	@link		https://github.com/Zarthus/zarth.us
 *	@license	MIT - View http://zarth.us/licenses/zarth.us or the LICENSE.md file in the github repository
 *	@since		18/03/2014
 */

class Autoloader
{
    public static $loader;

    public static function init()
    {
        if (self::$loader == NULL)
            self::$loader = new self();

        return self::$loader;
    }

    public function __construct()
    {
        spl_autoload_register(array($this, 'classes'));
    }

    public function classes($class)
    {
        set_include_path(CLASSDIR);
        spl_autoload_extensions('.php');
        spl_autoload($class);
    }
}

Autoloader::init();
