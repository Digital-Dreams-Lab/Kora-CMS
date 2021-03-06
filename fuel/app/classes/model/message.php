<?php

class Model_Message extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'user_id',
		'section_id',
		'parent_id',
		'thread_id',
		'status',
		'type',
		'groups',
		'to',
		'from',
		'cc',
		'message',
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

	protected static $_table_name = 'messages';

}
