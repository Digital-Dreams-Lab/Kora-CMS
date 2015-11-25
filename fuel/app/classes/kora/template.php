<?php

namespace Kora;

abstract class Template extends \Controller
{

	/**
	* @var string page template
	*/
	public $template = 'template';
	
	public function render()
	{
		return $this;	
	}

	/**
	 * Load the template and create the $this->template object
	 */
	public function before()
	{
		if ( ! empty($this->template) and is_string($this->template))
		{
			$this->settings = \Model_setting::find('all')[1];
			$this->layout = 'layout/'.$this->settings->website_layout;			

			$this->theme = new Themer;			
			$this->theme->set_theme($this->settings->website_theme, $this->settings->website_layout);
			$this->theme->assets = \Uri::base(false)."themes/{$this->settings->website_theme}/assets/";

			$this->view = new View;																				
			$this->view->set_theme($this->settings->website_theme);		
			
			$this->template = $this->view->forge_theme($this->template);
		}
		//var_dump($this);

		return parent::before();
	}

	/**
	 * After controller method has run output the template
	 *
	 * @param  Response  $response
	 */
	public function after($response)
	{
		// If nothing was returned default to the template
		if ($response === null)
		{
			$response = $this->template->render_layout = $this->view->forge_theme($this->layout);
		}

		return parent::after($response);
	}

}
