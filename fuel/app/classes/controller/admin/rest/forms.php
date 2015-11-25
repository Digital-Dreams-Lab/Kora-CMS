<?php

class Controller_Admin_Rest_Forms extends Controller_Rest
{
	public $entry_id = '';	
	public function post_create()
    {
		$post = Input::post();
		$message = '';
		
		$this->entry_id = Model_Form::add($post);
		
		if ($this->entry_id!==false) 
		{
			$message = 'Input saved';
		}
		else
		{
			$message = 'Input not saved';
		}
		
		$form_list = $this->formlist($post['section_id']);
		//*/		
		$response = array(
			'response' => $post,
			'message' => $message,
			'entry' => $this->entry_id,
			'form_list' => $form_list
		);		
		
		return $this->response($response);	
	}
	
	
	public function post_edit()
    {
		$message = '';
		$post = Input::post();
		$form = Model_Form::find(Input::post('form_id'));
//*/
		$options		= Input::post('options', array());
		$options		= serialize(array_filter($options));
		$attributes		= serialize(array('class'=>'form-control '.Input::post('class'), "placeholder"=>Input::post('placeholder')));		
		$label_control	= serialize(array('class'=>'label-control'));
		
		$form->user_id 		= Input::post('user_id');
		$form->page_id 		= Input::post('page_id');
		$form->section_id	= Input::post('section_id');
		$form->order 		= Input::post('order');
		$form->type			= Input::post('type');
		$form->label 		= Input::post('label');
		$form->label_control= $label_control;
		$form->attributes	= $attributes;
		$form->options		= $options;
		$form->field		= Input::post('field');
		$form->placeholder	= Input::post('placeholder');
		$form->class		= Input::post('class');
		$form->value		= Input::post('value');

		if ($form->save())
		{			
			$message = 'Input updated';
		}
		else
		{
			$message = 'Input not updated';
		}
		
		$form_list = $this->formlist($post['section_id']);
		//*/		
		$response = array(
			'response' => $form,
			'message' => $message,
			'entry' => $this->entry_id,
			'form_list' => $form_list
		);		
		
		return $this->response($response);	
	}
	
	
	public function post_list()
	{
		$section_id = Input::post('section_id');
		
		$form_list = $this->formlist($section_id);
		
		$response = array(
			'form_list' => $form_list,
		);
		return $this->response($response);	
	}
	
	
	public function formlist($section_id) 
	{
		if ($this->entry_id!=false) {
			$entry_id = $this->entry_id;
		}	
		else
		{
			$entry_id = 0;
		}
		$form_list = DB::select('*')->from('forms')->where('section_id', (int) $section_id)->execute();

		$formlist = array();
		
		$formlist[] = '<table class="table table-condensed vert-align">';
		$formlist[] = '<thead>';
		$formlist[] = '<tr>';
		$formlist[] = '<th>Form order</th>';
		$formlist[] = '<th>Field labels</th>';
		$formlist[] = '<th>Field type</th>';
		$formlist[] = '<th>Required</th>';
		$formlist[] = '<th>Actions</th>';
		$formlist[] = '</tr>';
		$formlist[] = '</thead>';
		$formlist[] = '<tbody>';
		foreach ($form_list as $item)
		{
			$formlist[] = '<tr'.($item['id']==$entry_id ? 'class="success success_fade"':'').'>';
			$formlist[] = '<td>'.$item['order'].'</td>';
			$formlist[] = '<td>'.$item['label'].'</td>';
			$formlist[] = '<td>'.$item['type'].'</td>';
			$formlist[] = '<td>'.($item['required']==1 ? "Yes": "No").'</td>';
			$formlist[] = '<td><a href="?action=edit&type='.$item['type'].'&form_id='.$item['id'].'"><i class="fa fa-edit"></i></a> | <a href="#" class="open_form_modal call_delete_form_input" data-form-action="delete" data-form-id="'.$item['id'].'"><i class="fa fa-trash"></i></a> </td>';
			$formlist[] = '</tr>';
		}
		$formlist[] = '</tbody>';
		$formlist[] = '</table>';
		
		return implode("\n\n",$formlist);

	}	
	/*
	static protected function build_form($array)
	{
		$form_settings = $array['form_settings'];
		
		$form[] = Form::open($form_settings);
		$form[] = Form::csrf();

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
			$label_control	= array('class'=>'label-control');
			
			switch ($type)
			{
				// input
				case 'input':
					$form[] = '<div class="form-group">';
					$form[] = Form::label($label, $field, $label_control);
					$form[] = Form::input($field, $value = NULL, $attributes);
					$form[] = '</div>';
				break;
				// email
				case 'email':
					$form[] = '<div class="form-group">';
					$form[] = Form::label($label, $field, $label_control);
					$form[] = Form::input($field, $value = NULL, $attributes);
					$form[] = '</div>';
				break;
				// hidden
				case 'hidden':
					$form[] = Form::hidden($field, $value);
				break;
				// password
				case 'password':
					$form[] = '<div class="form-group">';
					$form[] = Form::label($label, $field, $label_control);
					$form[] = Form::password($field, $value = NULL, $attributes);
					$form[] = '</div>';
				break;
				// radio
				case 'radio':
					$form[] = '<div class="form-group">';										
					$form[] = Form::label($label, $field, $label_control);	
					foreach ($options as $value)
					{						
						$form[] = '<div class="radio">';
						$form[] = '<label>';
						$form[] = Form::radio(Inflector::tableize($value), $value);
						$form[] = $value;
						$form[] = '</label>';
						$form[] = '</div>';
					}
					$form[] = '</div>';
				break;
				// checkbox
				case 'checkbox':
					$form[] = '<div class="form-group">';										
					$form[] = Form::label($label, $field, $label_control);	
					foreach ($options as $value)
					{						
						$form[] = '<div class="checkbox">';
						$form[] = '<label for="'.$field.'">';
						$form[] = Form::checkbox($field, $value);
						$form[] = $value;
						$form[] = '</label>';
						$form[] = '</div>';
					}
					$form[] = '</div>';
				break;
				// file
				case 'file':
					$form[] = '<div class="form-group">';
					$form[] = Form::label($label, $field, $label_control);
					$form[] = Form::file($field, $attributes);
					$form[] = '</div>';
				break;
				// textarea
				case 'textarea':
					$form[] = '<div class="form-group">';
					$form[] = Form::label($label, $field, $label_control);
					$form[] = Form::textarea($field, $value = NULL, $attributes);
					$form[] = '</div>';
				break;
				// hidden
				case 'select':
					$form[] = '<div class="form-group">';
					$form[] = Form::label($label, $field, $label_control);
					$form[] = Form::select($field, $values = NULL, $options, $attributes);
					$form[] = '</div>';
				break;					
			}		
		}	
		// close form
		$form[] = Form::close();
		
		$this->form_list = $form;
	}
	*/
}