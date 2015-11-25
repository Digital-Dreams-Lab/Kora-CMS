<?php

return array(
	'form'=>array(
		'website_details' => array(
			'website_title'=>'input',
			'website_description'=>'textarea',
			'website_keywords'=>'textarea',
			'website_header'=>'textarea',
			'website_footer'=>'textarea',
			'website_layout' => array(
			
				'select' => array(
					'blocks'=>'Blocks page layout',
					'single'=>'Single page layout',						
					),	
			),

		),
		'pages' => array(
						
			'page_level_limit' => array(
			
				'select' => array(
					'0'=>'No',
					'1'=>'Yes',						
					),	
			),
			'page_trash' => array(
			
				'select' => array(
					'0'=>'No',
					'1'=>'Yes',						
					),	
			),
			'page_lang' => array(
			
				'select' => array(
					'0'=>'No',
					'1'=>'Yes',						
					),	
			),
			'page_multiple_menus' => array(
			
				'select' => array(
					'0'=>'No',
					'1'=>'Yes',						
					),	
			),
			'page_home_page' => array(
			
				'select' => array(
					'0'=>'No',
					'1'=>'Yes',						
					),	
			),

		),
		'users' => array(
			
			'user_media_folders' => array(
			
				'select' => array(
					'0'=>'No',
					'1'=>'Yes',						
					),	
			),
			'user_manage_sections' => array(
			
				'select' => array(
					'0'=>'No',
					'1'=>'Yes',						
					),	
			),
			'user_section_blocks' => array(
			
				'select' => array(
					'0'=>'No',
					'1'=>'Yes',						
					),	
			),
			'user_login' => array(
			
				'select' => array(
					'0'=>'No',
					'1'=>'Yes',						
					),	
			),
			'user_signup' => array(
			
				'select' => array(
					'0'=>'No',
					'1'=>'Yes',						
					),	
			),

		),
		'default' => array(
					
			'default_lang'=>'input',
			'default_charset'=>'input',
			'default_timezone' => array(			
				'select' => array(
					'Africa' => DateTimeZone::AFRICA,
					'America' => DateTimeZone::AMERICA,
					'Antarctica' => DateTimeZone::ANTARCTICA,
					'Asia' => DateTimeZone::ASIA,
					'Atlantic' => DateTimeZone::ATLANTIC,
					'Europe' => DateTimeZone::EUROPE,
					'Indian' => DateTimeZone::INDIAN,
					'Pacific' => DateTimeZone::PACIFIC
				),
			),
			'default_date_format'=>'input',
			'default_time_format'=>'input',
			'default_page_theme'=>'input',

		),
		'search' => array(
			
			'search_visibility' => array(
			
				'select' => array(
					'0'=>'No',
					'1'=>'Yes',						
					),	
			),
			'search_theme' => array(
			
				'select' => array(
					'0'=>'No',
					'1'=>'Yes',						
					),	
			),
			'search_header'=>'textarea',
			'search_footer'=>'textarea',
			'search_results_none'=>'textarea',
			'search_results_header'=>'textarea',
			'search_results_loop'=>'textarea',
			'search_results_footer'=>'textarea',
			'search_results_max'=>'input',
			'search_results_min'=>'input',

		),
		'server' => array(
			
			'server_operating_system'=>'input',
			'server_file_permissions'=>'input',
			'server_dir_permissions'=>'input',
			'server_media_directory'=>'input',
			'server_page_extension'=>'input',
			'server_rename_files_on_upload'=>'input',
			'server_session_identifier'=>'input',

		),
		'mail' => array(
			
			'mail_default_from'=>'input',
			'mail_default_name'=>'input',
			'mail_default_company'=>'input',
			'mail_default_website'=>'input',
			'mail_default_routine' => array(
			
				'select' => array(
					'0'=>'No',
					'1'=>'Yes',						
					),	
			),
			'id'=>'hidden',
		),
	),
);