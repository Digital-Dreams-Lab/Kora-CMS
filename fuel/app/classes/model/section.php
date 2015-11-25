<?php

class Model_Section extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'user_id',
		'block_id',
		'page_id',
		'plugin_id',
		'order',
		'blocks_layout',
		'blocks_id',
		'blocks_class',
		'content',
		'settings',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_update'),
			'mysql_timestamp' => false,
		),
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('user_id', 'User Id', 'required|valid_string[numeric]');
		$val->add_field('page_id', 'Page Id', 'required|valid_string[numeric]');
		$val->add_field('plugin_id', 'Plugin Id', 'required|valid_string[numeric]');

		return $val;
	}
	
	protected static $_table_name = 'sections';

}
