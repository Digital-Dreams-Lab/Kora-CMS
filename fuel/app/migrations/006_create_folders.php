<?php

namespace Fuel\Migrations;

class Create_folders
{
	public function up()
	{
		\DBUtil::create_table('folders', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'parent_id' => array('constraint' => 11, 'type' => 'int'),
			'order' => array('constraint' => 11, 'type' => 'int'),
			'active' => array('constraint' => 2, 'type' => 'int'),
			'name' => array('constraint' => 50, 'type' => 'varchar'),
			'description' => array('type' => 'text'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('folders');
	}
}