<?php

class Controller_Pages_Base extends \Kora\Template
{	
	public function before()
	{
		parent::before();		
		
		// Before loading up head data check page meta data is set
		$this->_head = array(
			'website_description' 	=> $this->settings->website_description,
			'website_author' 		=> $this->settings->website_author,
			'website_keywords' 		=> $this->settings->website_keywords,
			'website_title' 		=> $this->settings->website_title,
			'website_meta'	 		=> $this->settings->website_meta,
			'theme_assets' 			=> $this->theme->assets,
		);
		$this->_scripts = array(
			'theme_assets' 			=> $this->theme->assets,
			'script_content' 		=> '',
		);
		
		$this->template->set_global('render_head', $this->theme->get('_head', $this->_head), false);
	}
			
	public function loop_sections($array)
	{  
		
		foreach($array as $v)
		{
			$return .= $v['content'];
		}
		
		return $return;
	}
	
	public function after($response)
	{
		// If nothing was returned default to the template		
		$this->template->set_global('render_scripts', $this->theme->get('_scripts', $this->_scripts), false);

		return parent::after($response);
	}
	
	public function action_404()
	{	
		
	}

}
