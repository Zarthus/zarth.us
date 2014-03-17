<?php

/**
 *	Autoloader.php
 *
 *	Author: 	Zarthus <zarthus@zarth.us>
 *
 *	Date: 		12/03/2014
 *	License: 	MIT
 *
 *	The Autoloader class
 */

class Autoloader {

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
