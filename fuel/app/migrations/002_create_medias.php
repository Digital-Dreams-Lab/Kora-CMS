<?php

namespace Fuel\Migrations;

class Create_medias
{
	public function up()
	{
		\DBUtil::create_table('medias', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'user_id' => array('constraint' => 11, 'type' => 'int'),
			'plugin_id' => array('constraint' => 11, 'type' => 'int'),
			'section_id' => array('constraint' => 11, 'type' => 'int'),
			'folder_id' => array('constraint' => 11, 'type' => 'int'),
			'group' => array('constraint' => 11, 'type' => 'int'),
			'owner' => array('constraint' => 11, 'type' => 'int'),
			'perms' => array('constraint' => 11, 'type' => 'int'),
			'inode' => array('constraint' => 11, 'type' => 'int'),
			'size' => array('constraint' => 11, 'type' => 'int'),
			'custom_width' => array('constraint' => 50, 'type' => 'varchar'),
			'custom_height' => array('constraint' => 50, 'type' => 'varchar'),
			'name' => array('constraint' => 50, 'type' => 'varchar'),
			'extension' => array('constraint' => 50, 'type' => 'varchar'),
			'mimetype' => array('constraint' => 50, 'type' => 'varchar'),
			'type' => array('constraint' => 50, 'type' => 'varchar'),
			'ext' => array('constraint' => 50, 'type' => 'varchar'),
			'dirname' => array('constraint' => 255, 'type' => 'varchar'),
			'filename' => array('constraint' => 255, 'type' => 'varchar'),
			'saved_to' => array('type' => 'text'),
			'caption' => array('type' => 'text'),
			'description' => array('type' => 'text'),
			'realpath' => array('type' => 'text'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('medias');
	}
}