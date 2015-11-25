<?php 
/**
 * These presets allow you to call controlled manipulations.
 */
return array(
    'images' => array(
		'resize' => array(
			'tiny'=>array(50, 50), // small h x w
			'small'=>array(150, 150), // small h x w
			'medium'=>array(300, 225), // medium h x w
			'large'=>array(500, 375), // large h x w
			'custom'=>array(768, 1024) // full h x w
		),
		'config' => array(
			'path' => DOCROOT.'uploads/media/',
			'randomize' => true,
			'ext_replace' => array('.jpg', '.jpeg', '.gif', '.png'),
			'ext_whitelist' => array('jpg', 'jpeg', 'gif', 'png'),
			'change_case' => true,
		),
	),
	'files' => array(
		'config' => array(
			'path' => DOCROOT.'uploads/media/',
			'randomize' => true,
			'ext_replace' => array('.doc', '.docx', '.pdf', '.odt', '.ods', '.odp', '.ppt', '.xlsx', '.txt', '.mp3', '.wav', '.mp4', '.mpeg', '.mpg', '.avi'),
			'ext_whitelist' => array('doc', 'docx', 'pdf', 'odt', 'ods', 'odp', 'ppt', 'xlsx', 'txt','mp3', 'wav', 'mp4', 'mpeg', 'mpg', 'avi'),
		),	
	),
);