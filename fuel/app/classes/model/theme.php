<?php

class Model_Theme extends \Orm\Model
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
		'theme_path',
		'theme_name',
		'layout_default',
		'layouts',
		'blocks',
		'name',
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
			'events' => array('before_update'),
			'mysql_timestamp' => false,
		),
	);

	protected static $_table_name = 'themes';

}
