<?php

class Controller_Base extends Controller_Template
{

	public function before()
	{
		parent::before();

		// Assign current_user to the instance so controllers can use it
		$this->current_user = Auth::check()
			? (Config::get('auth.driver', 'Simpleauth') == 'Ormauth' ? Model\Auth_User::find_by_username(Auth::get_screen_name()) : Model_User::find_by_username(Auth::get_screen_name()))
			: null;
		// Set a global variable so views can use it
		$profile = Auth::get_profile_fields();
		$preferences = isset($profile['preferences']) ? (object) $profile['preferences']: null;

		// Set a global variable so views can use it		
		View::set_global('current_user', $this->current_user);	
		View::set_global('preferences', $preferences);
	}
	
	public function after($response)
    {
        $response = parent::after($response); // not needed if you create your own response object
		
		View::set_global('scripts', Plugin\Registry::get_scripts(true), false);
		
        return $response; // make sure after() returns the response object
    }

}
