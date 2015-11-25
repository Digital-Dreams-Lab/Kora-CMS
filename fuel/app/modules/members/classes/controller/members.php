<?php 

namespace Members;

class Controller_Members extends Controller_Base
{
	public $template = 'template';

	public function before()
	{
		parent::before();

		if (\Request::active()->controller !== 'Controller_Members' or ! in_array(\Request::active()->action, array('login', 'logout')))
		{
			if (\Auth::check()) // Check logged on
			{
				if (\Kora\Access::check(\Request::active()->route->segments[0])) // Check adminstrative privileges
				{
					if (\Kora\Permissions::check()) // Check create, edit, view, delete permissions
					{
					
					}
					else
					{
						\Session::set_flash('error', e('You do not have administrative privileges to access this page.'));
						\Response::redirect('members/dashboard');	
					}		
				}
				else
				{
					\Session::set_flash('error', e('You do not have administrative privileges to access admin area.'));
					\Response::redirect('/');					
				}
			}
			else
			{
				\Response::redirect('members/login');
			}
		}
	}

	public function action_login()
	{
		// Already logged in
		\Auth::check() and \Response::redirect('members');

		$val = \Validation::forge();

		if (\Input::method() == 'POST')
		{
			$val->add('email', 'Email or Username')
			    ->add_rule('required');
			$val->add('password', 'Password')
			    ->add_rule('required');

			if ($val->run())
			{
				$auth = \Auth::instance();

				// check the credentials. This assumes that you have the previous table created
				if (\Auth::check() or $auth->login(Input::post('email'), \Input::post('password')))
				{
					// credentials ok, go right in
					if (Config::get('auth.driver', 'Simpleauth') == 'Ormauth')
					{
						$current_user = \Model\Auth_User::find_by_username(\Auth::get_screen_name());
					}
					else
					{
						$current_user = \Model_User::find_by_username(\Auth::get_screen_name());
					}
					\Session::set_flash('success', e('Welcome, '.$current_user->username));
					\Response::redirect('members');
				}
				else
				{
					$this->template->set_global('login_error', 'Fail');
				}
			}
		}

		$this->template->title = 'Login';
		$this->template->content = \View::forge('members/login', array('val' => $val), false);
	}

	/**
	 * The logout action.
	 *
	 * @access  public
	 * @return  void
	 */
	public function action_logout()
	{
		Auth::logout();
		Response::redirect('members');
	}

	/**
	 * The index action.
	 *
	 * @access  public
	 * @return  void
	 */
	public function action_index()
	{
		var_dump(\Request::active());
		$this->template->title = 'Dashboard';
		$this->template->content = \View::forge('index');
	}

}

/* End of file admin.php */
