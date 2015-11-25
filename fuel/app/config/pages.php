<?php

return array(

	'form' => array(
		'view'=>array('id','title',),
	),
	'select' => array(
		'active'=>array(
			0 => 'No',
			1 => 'Yes',
		),
		'noyes'=>array(
			0 => 'No',
			1 => 'Yes',
		),
		'status'=>array(
			0 => 'Draft',
			1 => 'Publish',
			2 => 'Temporary',
			3 => 'Archive',
			4 => 'Trash',
		),
		'visibility'=>array(
			0 => 'Public (Public access)',
			1 => 'Private (Limited access to selected groups)',
			2 => 'Restricted (Limited access to selected users)',
			3 => 'Hidden (Public access with no menu link)',
		),
	),
	'template' => array(
		'navbar' => array(
			'dashboard'		=>array('Dashboard',	'dashboard',	"View dashboard.",							array()),
			'pages'			=>array('Pages',		'files-o',		"Manage website pages.",					array()),
			'media'			=>array('Media',		'picture-o',	"Manage media files.",						array()),
			'addons'		=>array('Add-ons',		'puzzle-piece',	"Manage plugins, modules and templates.",	array('modules','templates','plugins')),
			'settings'		=>array('Settings',		'cog',			"Manage site settings.",					array()),
			'tools'			=>array('Tools',		'wrench',		"Manage admin tools.",						array('access','registers')),
			'permissions'	=>array('Permissions',	'lock',			"Manage site permissions.",					array('groups','users')),
		),
	),
		
);
