<?php

namespace Kora;

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
	public static function themes_instance()
	{
		if ( ! static::$instance)
		{
			static::$instance = static::forge(array(PLUGINPATH));
		}
		return static::$instance;
	}


}
