<?php

namespace Fuel\Migrations;

class Create_themes
{
	public function up()
	{
		\DBUtil::create_table('themes', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'active' => array('constraint' => 11, 'type' => 'int'),
			'status' => array('constraint' => 11, 'type' => 'int'),
			'type' => array('constraint' => 11, 'type' => 'int'),
			'category' => array('constraint' => 225, 'type' => 'varchar'),
			'version' => array('constraint' => 225, 'type' => 'varchar'),
			'author' => array('constraint' => 225, 'type' => 'varchar'),
			'year' => array('constraint' => 225, 'type' => 'varchar'),
			'company' => array('constraint' => 225, 'type' => 'varchar'),
			'website' => array('constraint' => 225, 'type' => 'varchar'),
			'email' => array('type' => 'text'),
			'theme_name' => array('constraint' => 225, 'type' => 'varchar'),
			'theme_path' => array('type' => 'text'),
			'layout_default' => array('constraint' => 225, 'type' => 'varchar'),
			'layouts' => array('type' => 'text'),
			'blocks' => array('type' => 'text'),
			'name' => array('constraint' => 225, 'type' => 'varchar'),
			'description' => array('type' => 'text'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('themes');
	}
}