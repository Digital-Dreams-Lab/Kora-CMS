<?php

Autoloader::add_classes(array(
	// Add classes you want to override here
	'Plugin\\Editor\\Wysihtml5' 				=> PLUGINPATH.'editor/wysihtml5/classes/controller/wysihtml5.php',
	'Plugin\\Editor\\Wysihtml5_Base'			=> PLUGINPATH.'editor/wysihtml5/classes/controller/base.php',
));

// Register the autoloader
Autoloader::register();