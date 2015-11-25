<?php
class Model_Plugin extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'active',
		'status',
		'type',
		'category',
		'version',
		'author',
		'year',
		'company',
		'website',
		'email',
		'route',
		'controller',
		'actions',
		'name',
		'namespace',
		'plugin_path',
		'plugin_name',
		'path',
		'description',
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
	
		return $val;
	}
}
