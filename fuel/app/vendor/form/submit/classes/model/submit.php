<?php

namespace Plugin\Form;

class Model_Form_Submit extends \Orm\Model
{	
	protected static $_properties = array(
		'id',
		'user_id',
		'page_id',
		'section_id',
		'order',
		'type',
		'label',
		'label_control',
		'attributes',
		'options',
		'field',
		'placeholder',
		'class',
		'value',
		'required',
		'created_at',
		'updated_at',
	);
	
	public static function test($post)
	{
		return $post;
	}
	public static function add($post)
	{		
		if ($post['field'] && $post['label']  && $post['type'])
		{
			$type 			= $post['type'];
			$label 			= $post['label'];
			$field			= $post['field'];
			$required		= isset($post['required']) ? $post['required']: 0;
			$value			= isset($post['value']) ? $post['value']: '';
			$options		= isset($post['options']) ? $post['options']: array();
			$options		= serialize(array_filter($options));
			$class			= isset($post['class']) ? $post['class']: '';
			$placeholder	= isset($post['placeholder']) ? $post['placeholder']: '';
			$attributes		= serialize(array('class'=>'form-control '.$class, "placeholder"=>$placeholder));		
			$label_control	= serialize(array('class'=>'label-control'));
			
			$form = Model_Form_Submit::forge(array(
				'page_id' 			=> $post['page_id'],
				'user_id' 			=> $post['user_id'],
				'section_id' 		=> $post['section_id'],
				'order' 			=> 0,
				'type' 				=> $type,
				'label' 			=> $label,
				'label_control' 	=> $label_control,
				'attributes' 		=> $attributes,
				'options' 			=> $options,
				'field' 			=> $field,
				'placeholder' 		=> $placeholder,
				'class' 			=> $class,
				'value' 			=> $value,
				'required' 			=> $required,
				'created_at' 		=> time(),
				'updated_at' 		=> time(),
			));
			$form->save();
			
			return true;
		} else {
			return false;
		}
			
	}
	
	
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

	protected static $_table_name = 'forms';

}
