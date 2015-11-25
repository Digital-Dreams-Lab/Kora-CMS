<?php

namespace Fuel\Migrations;

class Create_settings
{
	public function up()
	{
		\DBUtil::create_table('settings', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'website_title' => array('constraint' => 255, 'type' => 'varchar'),
			'website_description' => array('type' => 'text'),
			'website_keywords' => array('type' => 'text'),
			'website_header' => array('type' => 'text'),
			'website_footer' => array('type' => 'text'),
			'page_level_limit' => array('constraint' => 11, 'type' => 'int'),
			'page_trash' => array('constraint' => 11, 'type' => 'int'),
			'page_lang' => array('constraint' => 11, 'type' => 'int'),
			'page_multiple_menus' => array('constraint' => 11, 'type' => 'int'),
			'page_home_page' => array('constraint' => 11, 'type' => 'int'),
			'user_media_folders' => array('constraint' => 11, 'type' => 'int'),
			'user_manage_sections' => array('constraint' => 11, 'type' => 'int'),
			'user_section_blocks' => array('constraint' => 11, 'type' => 'int'),
			'user_login' => array('constraint' => 11, 'type' => 'int'),
			'user_signup' => array('constraint' => 11, 'type' => 'int'),
			'default_lang' => array('constraint' => 11, 'type' => 'int'),
			'default_charset' => array('constraint' => 11, 'type' => 'int'),
			'default_timezone' => array('constraint' => 11, 'type' => 'int'),
			'default_date_format' => array('constraint' => 11, 'type' => 'int'),
			'default_time_format' => array('constraint' => 11, 'type' => 'int'),
			'default_page_theme' => array('constraint' => 11, 'type' => 'int'),
			'search_visibility' => array('constraint' => 11, 'type' => 'int'),
			'search_theme' => array('constraint' => 11, 'type' => 'int'),
			'search_header' => array('type' => 'text'),
			'search_footer' => array('type' => 'text'),
			'search_results_none' => array('type' => 'text'),
			'search_results_header' => array('type' => 'text'),
			'search_results_loop' => array('type' => 'text'),
			'search_results_footer' => array('type' => 'text'),
			'search_results_max' => array('constraint' => 255, 'type' => 'varchar'),
			'search_results_min' => array('constraint' => 255, 'type' => 'varchar'),
			'server_operating_system' => array('constraint' => 11, 'type' => 'int'),
			'server_file_permissions' => array('constraint' => 255, 'type' => 'varchar'),
			'server_dir_permissions' => array('constraint' => 255, 'type' => 'varchar'),
			'server_media_directory' => array('constraint' => 255, 'type' => 'varchar'),
			'server_page_extension' => array('constraint' => 255, 'type' => 'varchar'),
			'server_rename_files_on_upload' => array('constraint' => 255, 'type' => 'varchar'),
			'server_session_identifier' => array('constraint' => 255, 'type' => 'varchar'),
			'mail_default_from' => array('constraint' => 255, 'type' => 'varchar'),
			'mail_default_name' => array('constraint' => 255, 'type' => 'varchar'),
			'mail_default_company' => array('constraint' => 255, 'type' => 'varchar'),
			'mail_default_website' => array('constraint' => 255, 'type' => 'varchar'),
			'mail_default_routine' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('settings');
	}
}