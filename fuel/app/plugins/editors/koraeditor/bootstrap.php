<?php

Autoloader::add_classes(array(
	// Add classes you want to override here
	'Plugin\\Editors\\Koraeditor' 				=> PLUGINPATH.'editors/koraeditor/classes/controller/koraeditor.php',
	'Plugin\\Editors\\Koraeditor_Base'			=> PLUGINPATH.'editors/koraeditor/classes/controller/base.php',
));

// Register the autoloader
Autoloader::register();