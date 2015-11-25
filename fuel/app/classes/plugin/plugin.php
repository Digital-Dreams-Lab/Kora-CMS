<?php
/**
 * Hack* version of Fuel Module Class replaced module with plugin
 * all rights reserved to 2010 - 2014 Fuel Development Team
 *
 * @package    Fuel
 * @version    1.7
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2014 Fuel Development Team
 * @link       http://fuelphp.com
 */
  
/**
 * This exception is thrown when a plugin cannot be found.
 *
 * @package     Core
 */
class PluginNotFoundException extends \FuelException { }


/**
 * Handles all the loading, unloading and management of plugins.
 *
 * @package     Core
 */
class Plugin
{

	/**
	 * @var  array  $plugins  Holds all the loaded plugin information.
	 */
	protected static $plugins = array();

	/**
	 * Loads the given plugin.  If a path is not given, then 'plugin_paths' is used.
	 * It also accepts an array of plugins as the first parameter.
	 *
	 * @param   string|array  $package  The plugin name or array of plugins.
	 * @param   string|null   $path     The path to the plugin
	 * @return  bool  True on success
	 * @throws  PluginNotFoundException
	 */
	public static function load($plugin, $path = null)
	{
		if (is_array($plugin))
		{
			foreach ($plugin as $mod => $path)
			{
				if (is_numeric($mod))
				{
					$mod = $path;
					$path = null;
				}
				static::load($mod, $path);
			}
			return false;
		}


		if (static::loaded($plugin))
		{
			return;
		}

		// if no path is given, try to locate the plugin
		if ($path === null)
		{
			$paths = array(PLUGINPATH, $path);

			if ( ! empty(static::$paths))
			{
				foreach ($paths as $modpath)
				{
					if (is_dir($path = $modpath.strtolower($plugin).DS))
					{
						break;
					}
				}
			}

		}

		// make sure the path exists
		if ( ! is_dir($path))
		{
			throw new PluginNotFoundException("Plugin '$plugin' could not be found at '".\Fuel::clean_path($path)."'");
		}

		// determine the plugin namespace
		echo $ns = '\\'.ucfirst($plugin);
		echo $path.'classes'.DS;
		// add the namespace to the autoloader
		\Autoloader::add_namespaces(array(
			$ns  => $path.'classes'.DS,
		), true);

		static::$plugins[$plugin] = $path;

		return true;
	}

	/**
	 * Unloads a plugin from the stack.
	 *
	 * @param   string  $plugin  The plugin name
	 * @return  void
	 */
	public static function unload($plugin)
	{
		// delete all routes for this plugin
		\Router::delete($plugin.'/(:any)');

		unset(static::$plugins[$plugin]);
	}

	/**
	 * Checks if the given plugin is loaded, if no plugin is given then
	 * all loaded plugins are returned.
	 *
	 * @param   string|null  $plugin  The plugin name or null
	 * @return  bool|array  Whether the plugin is loaded, or all plugins
	 */
	public static function loaded($plugin = null)
	{
		if ($plugin === null)
		{
			return static::$plugins;
		}

		return array_key_exists($plugin, static::$plugins);
	}

	/**
	 * Checks if the given plugin exists.
	 *
	 * @param   string  $plugin  The plugin name
	 * @return  bool|string  Path to the plugin found, or false if not found
	 */
	public static function exists($plugin)
	{
		if (array_key_exists($plugin, static::$plugins))
		{
			return static::$plugins[$plugin];
		}
		else
		{			
			$paths = array(PLUGINPATH, $path);

			foreach ($paths as $path)
			{
				if (is_dir($path.$plugin))
				{
					return $path.$plugin.DS;
				}
			}
		}

		return false;
	}
}
/*
class Plugin
{
	public static function get_config($plugin,$file)
	{	
		$config_file = DOCROOT.'plugins/'.$plugin.'/config/'.$file.'.php';
  		
		if(is_file($config_file)) 
		{
			return include($config_file);
		}
	}		
}
*/