<?php

namespace Plugin;

/**
 * Fuel\Core\ Finder hack
 *
 */
class Finder extends \Finder
{

	/**
	 * Gets a singleton plugin_instance of Finder
	 *
	 * @return  Finder
	 */
	public static function plugin_instance()
	{
		if ( ! static::$instance)
		{
			static::$instance = static::forge(array(PLUGINPATH));
		}
		return static::$instance;
	}


}
