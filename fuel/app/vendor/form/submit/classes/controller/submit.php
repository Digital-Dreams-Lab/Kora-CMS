<?php

namespace Plugin\Form;

class Submit extends Submit_Base
{	
	public function action_edit()
	{	
		$this->content = $this->view->render_plugin('edit', $this->_data);
	}
	
	public function action_create()
	{
		echo $this->view->render_plugin('create', $this->_data);
	}
		
	public function forge($section)
	{
		if (Input::method() == 'POST')
		{
			$switch = \Input::post('switch');
			switch ($switch)
			{
				case 'form':
					$post['post']['label_field'] = \Inflector::tableize(Input::post('label'));
					$post['section_id'] = \Input::post('section_id');
					$post['page_id'] = \Input::post('page_id');
					$post['plugin_id'] = \Input::post('plugin_id');
						
					$post['post'] = (\Input::post()) ? \Input::post(): '';
					$entry = Model_Form_Submit::add($post['post']);
					if ($entry) 
					{
						\Session::set_flash('success', e('Form field added'));
					}
					else
					{
						\Session::set_flash('error', e('Error label, field or type not selected'));
					}
				break;
			}	
		} 
		else
		{
			$post['section_id'] = $section['id'];
			$post['page_id'] = $section['page_id'];
			$post['plugin_id'] = $section['plugin_id'];
			//$post['type'] = ($post['type']===NULL)?'input':$post['type'];
		}
		$form_list = Model_Form::find('all');		
		$config = Plugin::get_config('form','form');
		$page = $config['dir']['views'].'/edit.php';
		
		$view = new View;
		$view->bind('post', $post, false);
		$view->bind('form_list', $form_list, false);
		return $view->render($page);
		
	}

	protected function build_form($array)
	{
		$form_settings = $array['form_settings'];
		
		$form[] = \Form::open($form_settings);
		$form[] = \Form::csrf();

		foreach ($array['form_data'] as $value) 
		{		
		
			$type 			= $value['type'];
			$label 			= $value['label'];
			$field			= $value['field'];
			$value			= isset($value['value']) ? $value['value']: NULL;
			$options		= isset($value['options']) ? $value['options']: array();
			$options		= array_filter($options);
			$class			= isset($value['class']) ? $value['class']: '';
			$placeholder	= isset($value['placeholder']) ? $value['placeholder']: '';
			$attributes		= array('class'=>'form-control '.$class, "placeholder"=>$placeholder);	
			$att_file		= array('class'=>'form-control '.$class, "placeholder"=>$placeholder, "type"=>"file");		
			$label_control	= array('class'=>'label-control');
			
			switch ($type)
			{
				// input
				case 'input':
					$form[] = '<div class="form-group">';
					$form[] = \Form::label($label, $field, $label_control);
					$form[] = \Form::input($field, $value = NULL, $attributes);
					$form[] = '</div>';
				break;
				// email
				case 'email':
					$form[] = '<div class="form-group">';
					$form[] = \Form::label($label, $field, $label_control);
					$form[] = \Form::input($field, $value = NULL, $attributes);
					$form[] = '</div>';
				break;
				// hidden
				case 'hidden':
					$form[] = \Form::hidden($field, $value);
				break;
				// password
				case 'password':
					$form[] = '<div class="form-group">';
					$form[] = \Form::label($label, $field, $label_control);
					$form[] = \Form::password($field, $value = NULL, $attributes);
					$form[] = '</div>';
				break;
				// radio
				case 'radio':
					$form[] = '<div class="form-group">';										
					$form[] = \Form::label($label, $field, $label_control);	
					foreach ($options as $value)
					{						
						$form[] = '<div class="radio">';
						$form[] = '<label>';
						$form[] = \Form::radio(Inflector::tableize($value), $value);
						$form[] = $value;
						$form[] = '</label>';
						$form[] = '</div>';
					}
					$form[] = '</div>';
				break;
				// checkbox
				case 'checkbox':
					$form[] = '<div class="form-group">';										
					$form[] = \Form::label($label, $field, $label_control);	
					foreach ($options as $value)
					{						
						$form[] = '<div class="checkbox">';
						$form[] = '<label for="'.$field.'">';
						$form[] = \Form::checkbox($field, $value);
						$form[] = $value;
						$form[] = '</label>';
						$form[] = '</div>';
					}
					$form[] = '</div>';
				break;
				// file
				case 'file':
					$form[] = '<div class="form-group">';
					$form[] = \Form::label($label, $field, $label_control);
					$form[] = \Form::input($field, $attributes);
					$form[] = '</div>';
				break;
				// textarea
				case 'textarea':
					$form[] = '<div class="form-group">';
					$form[] = \Form::label($label, $field, $label_control);
					$form[] = \Form::textarea($field, $value = NULL, $attributes);
					$form[] = '</div>';
				break;
				// hidden
				case 'select':
					$form[] = '<div class="form-group">';
					$form[] = \Form::label($label, $field, $label_control);
					$form[] = \Form::select($field, $values = NULL, $options, $attributes);
					$form[] = '</div>';
				break;					
			}		
		}	
		// close form
		$form[] = \Form::close();
		
		return $form;
	}
}

