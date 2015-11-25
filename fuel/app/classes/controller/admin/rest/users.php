<?php

class Controller_Admin_Rest_Users extends Controller_Rest
{
	public function post_check_username()
    {
		$users = Model_User::find('all');
		$username = Input::post('username');
		$usernames_array = Arr::assoc_to_keyval($users, 'username', 'username');
		
		if (in_array($username,$usernames_array))
		{
			$message = 'Username exists.';
			$check = '0';
		}
		else
		{
			$message = 'Username avaliable.';
			$check = '1';
		}	

		$response = array(
			'message' => $message,
			'check' => $check
		);		
		return $this->response($response);	
	}

	public function post_check_email()
    {
		$users = Model_User::find('all');
		$email = Input::post('email');
		$emails_array = Arr::assoc_to_keyval($users, 'email', 'email');
		
		if (in_array($email,$emails_array))
		{
			$message = '<i class="fa fa-tick"></i> Email address exists.';
			$check = '0';
		}
		else
		{
			$message = '<i class="fa fa-cross"></i> Email address avaliable.';
			$check = '1';
		}	

		$response = array(
			'message' => $message,
			'check' => $check
		);		
		return $this->response($response);	
	}
	
}