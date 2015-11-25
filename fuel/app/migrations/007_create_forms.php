<?php 

namespace Fuel\Migrations;

class Create_forms
{
	public function up()
	{
		\DBUtil::create_table('forms', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'user_id' => array('constraint' => 11, 'type' => 'int'),
			'page_id' => array('constraint' => 11, 'type' => 'int'),
			'section_id' => array('constraint' => 11, 'type' => 'int'),
			'order' => array('constraint' => 11, 'type' => 'int'),
			'type' => array('constraint' => 11, 'type' => 'int'),
			'required' => array('constraint' => 11, 'type' => 'int'),
			'label' => array('constraint' => 255, 'type' => 'varchar'),
			'label_control' => array('constraint' => 255, 'type' => 'varchar'),
			'attributes' => array('constraint' => 255, 'type' => 'varchar'),
			'options' => array('constraint' => 255, 'type' => 'varchar'),
			'field' => array('constraint' => 255, 'type' => 'varchar'),
			'placeholder' => array('constraint' => 255, 'type' => 'varchar'),
			'class' => array('constraint' => 255, 'type' => 'varchar'),
			'value' => array('constraint' => 255, 'type' => 'varchar'),			
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('forms');
	}
}