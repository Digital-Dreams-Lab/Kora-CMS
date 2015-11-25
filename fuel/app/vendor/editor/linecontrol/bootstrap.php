<?php

Autoloader::add_classes(array(
	// Add classes you want to override here
	'Plugin\\Editor\\Editor_Linecontrol' 				=> PLUGINPATH.'editor/linecontrol/classes/controller/linecontrol.php',
	'Plugin\\Editor\\Editor_Linecontrol_Base'			=> PLUGINPATH.'editor/linecontrol/classes/controller/base.php',
));

// Register the autoloader
Autoloader::register();