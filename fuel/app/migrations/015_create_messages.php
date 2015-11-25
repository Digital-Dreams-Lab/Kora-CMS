<?php

namespace Fuel\Migrations;

class Create_messages
{
	public function up()
	{
		\DBUtil::create_table('messages', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'user_id' => array('constraint' => 11, 'type' => 'int'),
			'section_id' => array('constraint' => 11, 'type' => 'int'),
			'parent_id' => array('constraint' => 11, 'type' => 'int'),
			'thread_id' => array('constraint' => 11, 'type' => 'int'),
			'status' => array('constraint' => 11, 'type' => 'int'),
			'type' => array('constraint' => 11, 'type' => 'int'),
			'groups' => array('type' => 'text'),
			'to' => array('type' => 'text'),
			'from' => array('type' => 'text'),
			'cc' => array('type' => 'text'),
			'message' => array('type' => 'text'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('messages');
	}
}