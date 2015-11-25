<?php

namespace Fuel\Migrations;

class Create_plugins
{
	public function up()
	{
		\DBUtil::create_table('plugins', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'active' => array('constraint' => 2, 'type' => 'int'),
			'status' => array('constraint' => 2, 'type' => 'int'),
			'type' => array('constraint' => 2, 'type' => 'int'),
			'version' => array('constraint' => 50, 'type' => 'varchar'),
			'plugin_dir' => array('constraint' => 50, 'type' => 'varchar'),
			'name' => array('constraint' => 50, 'type' => 'varchar'),
			'namespace' => array('constraint' => 50, 'type' => 'varchar'),
			'path' => array('type' => 'text'),
			'description' => array('type' => 'text'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('plugins');
	}
}