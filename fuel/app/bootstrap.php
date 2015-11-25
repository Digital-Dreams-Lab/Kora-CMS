<?php
// Bootstrap the framework DO NOT edit this
require COREPATH.'bootstrap.php';
// 
define('PLUGINPATH', APPPATH.'plugins'.DS);
define('PUBPLUGINPATH', DOCROOT.'plugins'.DS);
define('THEMEPATH', DOCROOT.'themes'.DS);

function print_pre($data){ print "<pre>"; print_r($data); print "</pre>"; }

Autoloader::add_classes(array(

	// Add classes you want to override here	
	'Vendor\Tree'				 => APPPATH.'classes/vendor/tree.php',
	// Add classes you want to override here	
	'Kora'				 			=> APPPATH.'classes/kora/kora.php',
	'Kora\\System'		 			=> APPPATH.'classes/kora/system.php',
	'Kora\\Permissions' 			=> APPPATH.'classes/kora/permissions.php',
	'Kora\\Components' 				=> APPPATH.'classes/kora/components.php',
	'Kora\\View'	 				=> APPPATH.'classes/kora/view.php',
	'Kora\\Template' 				=> APPPATH.'classes/kora/template.php',
	'Kora\\Layouts' 				=> APPPATH.'classes/kora/layouts.php',
	'Kora\\Themer'	 				=> APPPATH.'classes/kora/themer.php',
	
	'Plugin\\Assets' 				=> APPPATH.'classes/plugin/assets.php',
	'Plugin\\Base' 					=> APPPATH.'classes/plugin/base.php',
	'Plugin\\Bootloader'			=> APPPATH.'classes/plugin/bootloader.php',
	'Plugin\\Config' 				=> APPPATH.'classes/plugin/config.php',
	'Plugin\\Folder' 				=> APPPATH.'classes/plugin/folder.php',
	'Plugin\\Loader'				=> APPPATH.'classes/plugin/loader.php',
	'Plugin\\Media'					=> APPPATH.'classes/plugin/media.php',
	'Plugin\\Page'					=> APPPATH.'classes/plugin/page.php',
	'Plugin\\Registry' 				=> APPPATH.'classes/plugin/registry.php',
	'Plugin\\Request' 				=> APPPATH.'classes/plugin/request.php',
	'Plugin\\View' 					=> APPPATH.'classes/plugin/view.php',	
));

// Register the autoloader
Autoloader::register();

/**
 * Your environment.  Can be set to any of the following:
 *
 * Fuel::DEVELOPMENT
 * Fuel::TEST
 * Fuel::STAGING
 * Fuel::PRODUCTION
 */
Fuel::$env = (isset($_SERVER['FUEL_ENV']) ? $_SERVER['FUEL_ENV'] : Fuel::DEVELOPMENT);

// Initialize the framework with the config file.
Fuel::init('config.php');
