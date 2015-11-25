<?php
return array(
	'system_perms' => array(
	
		'dashboard'=> array(
				'view'		=> 1,
			),
	
		'permissions'=> array(
				'view'		=> 0,
				'edit'		=> 0,
				'create'	=> 0,
				'delete'	=> 0,
			),
		'pages'=> array(
				'view'		=> 1,
				'edit'		=> 0,
				'create'	=> 0,
				'delete'	=> 0,
				'levels'	=> 0, // parent_id above 0
				'settings'	=> 0,
				'blocks'	=> 0,
				'intro'		=> 0,
			),
		'blocks'=> array(
				'view'		=> 1,
				'edit'		=> 0,
				'create'	=> 0,
				'delete'	=> 0,
				'settings'	=> 0,
			),
		'media'=> array(
				'view'		=> 1,
				'edit'		=> 0,
				'create'	=> 0,
				'delete'	=> 0,
				'folders'	=> 0,
				'upload'	=> 0,
				'actions'	=> 0,
			),
		'settings'=> array(
				'view'		=> 1,
				'basic'		=> 1,
				'advanced'	=> 0,
			),
		'modules'=> array(
				'view'		=> 1,
				'edit'		=> 0,
				'create'	=> 0,
				'delete'	=> 0,
			),
		'templates'=> array(
				'view'		=> 1,
				'edit'		=> 0,
				'create'	=> 0,
				'delete'	=> 0,
			),
		'languages'=> array(
				'view'		=> 1,
				'edit'		=> 0,
				'create'	=> 0,
				'delete'	=> 0,
			),
		'menus'=> array(
				'view'		=> 1,
				'edit'		=> 0,
				'create'	=> 0,
				'delete'	=> 0,
			),
		'plugins'=> array(
				'view'		=> 1,
				'edit'		=> 0,
				'create'	=> 0,
				'delete'	=> 0,
			),
		'tools'=> array(
				'view'		=> 1,
				'edit'		=> 0,
				'create'	=> 0,
				'delete'	=> 0,
			),
		'registers'=> array(
				'view'		=> 1,
				'edit'		=> 0,
				'create'	=> 0,
				'delete'	=> 0,
			),
		'access'=> array(
				'view'		=> 1,
				'edit'		=> 0,
				'create'	=> 0,
				'delete'	=> 0,
			),
		'users'=> array(
				'view'		=> 1,
				'edit'		=> 0,
				'create'	=> 0,
				'delete'	=> 0,
			),
		'groups'=> array(
				'view'		=> 1,
				'edit'		=> 0,
				'create'	=> 0,
				'delete'	=> 0,
			),
		),
		
	'module_perms' => array(
		'members'=> array(
			'accounts'=> array(
					'view'		=> 1,
					'edit'		=> 0,
					'create'	=> 0,
					'delete'	=> 0,
				),
			'mail'=> array(
					'view'		=> 1,
					'edit'		=> 0,
					'create'	=> 0,
					'delete'	=> 0,
				),
			),
		),
		
	);