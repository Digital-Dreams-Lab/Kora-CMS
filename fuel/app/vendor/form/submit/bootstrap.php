<?php

Autoloader::add_classes(array(
	// Add classes you want to override here
	'Plugin\\Form\\Submit' 				=> PLUGINPATH.'form/submit/classes/controller/submit.php',
	'Plugin\\Form\\Submit_Base'			=> PLUGINPATH.'form/submit/classes/controller/base.php',
));

// Register the autoloader
Autoloader::register();