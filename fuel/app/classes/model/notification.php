<?php
class Model_Notification extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'status',
		'route',
		'controller',
		'_controller',
		'action',
		'_action',
		'_status',
		'event',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('user_id', 'User Id', 'required|valid_string[numeric]');
		$val->add_field('event', 'Event', 'required');

		return $val;
	}

}
