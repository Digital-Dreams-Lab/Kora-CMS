<?php

class Model_Register extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'type',
		'level',
		'route',
		'controller',
		'actions',
		'methods',
		'perms',
		'rules',
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
		$val->add_field('type', 'Type', 'required|max_length[50]');
		$val->add_field('route', 'Route', 'required|max_length[50]');
		$val->add_field('controller', 'Controller', 'required|max_length[50]');
		$val->add_field('actions', 'Actions', 'required');
		$val->add_field('methods', 'Methods', 'required|max_length[50]');

		return $val;
	}
	protected static $_table_name = 'registers';

}
