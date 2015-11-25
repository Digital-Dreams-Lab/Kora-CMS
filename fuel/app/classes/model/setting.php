<?php

class Model_Setting extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'website_title',
		'website_theme',
		'website_meta',
		'website_layout',
		'website_author',
		'website_description',
		'website_keywords',
		'website_header',
		'website_footer',
		'page_level_limit',
		'page_trash',
		'page_lang',
		'page_multiple_menus',
		'page_home_page',
		'user_media_folders',
		'user_manage_sections',
		'user_section_blocks',
		'user_login',
		'user_signup',
		'default_lang',
		'default_charset',
		'default_timezone',
		'default_date_format',
		'default_time_format',
		'default_page_theme',
		'search_visibility',
		'search_theme',
		'search_header',
		'search_footer',
		'search_results_none',
		'search_results_header',
		'search_results_loop',
		'search_results_footer',
		'search_results_max',
		'search_results_min',
		'server_operating_system',
		'server_file_permissions',
		'server_dir_permissions',
		'server_media_directory',
		'server_page_extension',
		'server_rename_files_on_upload',
		'server_session_identifier',
		'mail_default_from',
		'mail_default_name',
		'mail_default_company',
		'mail_default_website',
		'mail_default_routine',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_update'),
			'mysql_timestamp' => false,
		),
	);

	protected static $_table_name = 'settings';

}
