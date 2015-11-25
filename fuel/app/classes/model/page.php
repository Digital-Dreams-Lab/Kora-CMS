<?php
class Model_Page extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'user_id',
		'parent_id',
		'menu_id',
		'order',
		'active',
		'status',
		'visibility',
		'home_page',
		'single_page',
		'single_id',
		'single_class',
		'single_layout',
		'menu_title',
		'title',
		'slug',
		'meta_title',
		'meta_description',
		'groups',
		'users',
		'start_at',
		'end_at',
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
		$val->add_field('parent_id', 'Parent Id', 'required|valid_string[numeric]');
		$val->add_field('visibility', 'Visibility', 'required|valid_string[numeric]');
		$val->add_field('title', 'Title', 'required|max_length[50]');
		$val->add_field('slug', 'Slug', 'required|max_length[50]');

		return $val;
	}

}
