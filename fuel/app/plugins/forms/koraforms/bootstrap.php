<?php

Autoloader::add_classes(array(
	// Add classes you want to override here
	"Plugin\\Forms\\Koraforms" 				=> PLUGINPATH.'forms/koraforms/classes/controller/koraforms.php',
	'Plugin\\Forms\\Koraforms_Base'			=> PLUGINPATH.'forms/koraforms/classes/controller/base.php',
));
// Register the autoloader
Autoloader::register();