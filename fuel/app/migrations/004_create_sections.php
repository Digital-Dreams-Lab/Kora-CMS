<?php

namespace Fuel\Migrations;

class Create_sections
{
	public function up()
	{
		\DBUtil::create_table('sections', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'user_id' => array('constraint' => 11, 'type' => 'int'),
			'block_id' => array('constraint' => 11, 'type' => 'int'),
			'page_id' => array('constraint' => 11, 'type' => 'int'),
			'plugin_id' => array('constraint' => 11, 'type' => 'int'),
			'order' => array('constraint' => 11, 'type' => 'int'),
			'content' => array('type' => 'longtext'),
			'settings' => array('type' => 'longtext'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('sections');
	}
}