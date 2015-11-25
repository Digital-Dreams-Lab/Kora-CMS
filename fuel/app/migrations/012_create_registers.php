<?php

namespace Fuel\Migrations;

class Create_registers
{
	public function up()
	{
		\DBUtil::create_table('registers', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'type' => array('constraint' => 11, 'type' => 'int'),
			'level' => array('constraint' => 11, 'type' => 'int'),
			'route' => array('constraint' => 50, 'type' => 'varchar'),
			'controller' => array('constraint' => 50, 'type' => 'varchar'),
			'actions' => array('type' => 'text'),
			'methods' => array('type' => 'text'),
			'perms' => array('type' => 'text'),
			'rules' => array('type' => 'text'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('registers');
	}
}