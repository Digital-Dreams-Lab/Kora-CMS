<?php

// Add namespace, necessary if you want the autoloader to be able to find classes
Autoloader::add_core_namespace('Install');

// And add the classes, this is useful for:
// - optimization: no path searching is necessary
// - it's required to be able to use as a core namespace
// - if you want to break the autoloader's path search rules
Autoloader::add_classes(array(
    'Install\\Install' => __DIR__.'/classes/install.php',
));