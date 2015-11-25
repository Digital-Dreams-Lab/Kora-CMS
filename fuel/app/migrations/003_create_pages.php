<?php

namespace Fuel\Migrations;

class Create_pages
{
	public function up()
	{
		\DBUtil::create_table('pages', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'user_id' => array('constraint' => 11, 'type' => 'int'),
			'parent_id' => array('constraint' => 11, 'type' => 'int'),
			'menu_id' => array('constraint' => 11, 'type' => 'int'),
			'order' => array('constraint' => 11, 'type' => 'int'),
			'visibility' => array('constraint' => 11, 'type' => 'int'),
			'active' => array('constraint' => 2, 'type' => 'int'),
			'status' => array('constraint' => 2, 'type' => 'int'),
			'home_page' => array('constraint' => 2, 'type' => 'int'),
			'title' => array('constraint' => 50, 'type' => 'varchar'),
			'slug' => array('constraint' => 50, 'type' => 'varchar'),
			'meta_title' => array('constraint' => 50, 'type' => 'varchar'),
			'meta_descrption' => array('type' => 'text'),
			'groups' => array('type' => 'text'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('pages');
	}
}