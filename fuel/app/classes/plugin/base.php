<?php 
namespace Plugin;

abstract class Base
{
	public abstract function __construct($data, $vars=null);

	public function start_plugin($data)
	{			
		$this->_data = $data;
		$this->set_view();
		$this->set_user();
		
		$this->actions();
	}
	
	public function set_view()
	{	
		$this->view = new View;
		$this->view->path_plugin = $this->_data['plugin']['path_plugin'];
	}
	
	public function get_content()
	{	
		return $this->content;
	}
	
	public function set_user()
	{			
		// Assign current_user to the instance so controllers can use it
		$user = \Auth::check() ? (\Config::get('auth.driver', 'Simpleauth') == 'Ormauth' ? \Model\Auth_User::find_by_username(\Auth::get_screen_name()) : \Model_User::find_by_username(\Auth::get_screen_name())) : null;
		
		$this->user_id = $user->id;		
	}
	public function actions()
	{		
		$action = $this->_data['request']['action'];
		$action_function = 'action_'.$action;
		switch ($action) {
			case $action:
				$this->$action_function();
				break;		
		}
	}
}


