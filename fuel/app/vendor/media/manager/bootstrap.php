<?php

Autoloader::add_classes(array(
	// Add classes you want to override here
	'Plugin\\Media_Manager'							=> PLUGINPATH.'media/manager/classes/manager.php',
	'Plugin\\Media\\Media_Manager'					=> PLUGINPATH.'media/manager/classes/controller/manager.php',
	'Plugin\\Media\\Media_Manager_Base'				=> PLUGINPATH.'media/manager/classes/controller/base.php',
));

// Register the autoloader
Autoloader::register();