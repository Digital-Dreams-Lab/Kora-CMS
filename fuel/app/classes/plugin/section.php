<?php

namespace Plugin;

interface intefaceSection
{
    public function edit_section();
    public function delete_section();
}

class Section implements intefaceSection
{
	private $vars = array();
	
	
	public function __construct($array)
	{
		$this->build_vars($array);
		$this->set_vars();
	}
    public function build_vars($array)
	{
		$this->vars['section_id'] 	= array('name'=>'section['.$array['id'].'][section_id]', 	'value'=>$array['id']);
		$this->vars['user_id'] 		= array('name'=>'section['.$array['id'].'][user_id]', 		'value'=>$array['user_id']);
		$this->vars['block_id'] 		= array('name'=>'section['.$array['id'].'][block_id]', 		'value'=>$array['block_id']);
		$this->vars['page_id'] 		= array('name'=>'section['.$array['id'].'][page_id]', 		'value'=>$array['page_id']);
		$this->vars['plugin_id']		= array('name'=>'section['.$array['id'].'][plugin_id]', 	'value'=>$array['plugin_id']);
		$this->vars['order'] 			= array('name'=>'section['.$array['id'].'][order]', 		'value'=>$array['order']);
		$this->vars['content'] 		= array('name'=>'section['.$array['id'].'][content]', 		'value'=>$array['content']);
		$this->vars['settings'] 		= array('name'=>'section['.$array['id'].'][settings]', 		'value'=>$array['settings']);
		$this->vars['created_at'] 	= array('name'=>'section['.$array['id'].'][created_at]', 	'value'=>$array['created_at']);
		$this->vars['updated_at'] 	= array('name'=>'section['.$array['id'].'][updated_at]', 	'value'=>$array['updated_at']);
	}
	
    public function set_vars()
	{
		$vars = $this->vars;
		
		foreach ($vars as $key => $value)
		{
			$this->$key = (object) $value;
		}
	}
    
    public function edit_section()
	{
	}
	public function delete_section()
	{
	
	}

}