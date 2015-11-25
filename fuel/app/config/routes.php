<?php
return array(
	'_root_'  => 'index',  // The default route
	'_404_'   => 'pages/404',    // The main 404 route
	
	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),
	'admin/pages/:segment/:id/:section/(:any)' => array(
		"admin/pages/create/$1/$2",
		"admin/pages/edit/$1/$2",
		"admin/pages/view/$1/$2",
		"admin/pages/delete/$1/$2",		
		),
);