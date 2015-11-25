<?php
class Controller_Admin_Users extends Controller_Admin
{

	public function action_index()
	{	
		$this->template->set_global('users', Model_User::find('all'), false);		
		$this->template->set_global('groups_array', Arr::assoc_to_keyval(Model_Group::find('all'), 'id', 'name'), false);
	
		$listings_title = array(
			'listings_breadcrumb'   =>'<li>'
									. Kora\Permissions::get_link('admin/dashboard', '', '<i class="fa fa-dashboard fa-fw"></i> Dashboard', 'index')
									. '</li>'
									. '<li>'
									. Kora\Permissions::get_link('admin/permissions', '', '<i class="fa fa-lock fa-fw"></i> Permissions', 'index')
									. '</li>',		
			'listings_title' 		=> '<i class="fa fa-user fa-fw"></i> Users',
			'listings_extra' 		=> Kora\Permissions::get_link('admin/users', '', '<i class="fa fa-user-plus fa-fw"></i>  Create new user', 'create', array('class'=>'btn btn-xs btn-success')),
		);
		$listings_panel_group = array(
			'panel_id' 			=> 'collapse_listing',
			'panel_parent_id' 	=> 'parent_listing',
			'panel_heading_id' 	=> 'heading_listing',
			'panel_title' 		=> '<i class="fa fa-user fa-fw"></i> Users',
			'panel_title_ext' 	=> '',
			'panel_body' 		=> render('admin/users/_listings'),
		);
		
		$this->template->set_global('listings_title', 		$listings_title, 		false);
		$this->template->set_global('listings_panel_group', $listings_panel_group,	false);
		
		$this->template->title = "Users";
		$this->template->content = View::forge('admin/users/index');

	}

	public function action_view($id = null)
	{
		$data['user'] = Model_User::find($id);

		$this->template->title = "User";
		$this->template->content = View::forge('admin/users/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			//var_dump(Input::post());
			//*
			$val = Model_User::validate('create');

			if ($val->run())
			{				
                $created = \Auth::create_user(
                    Input::post('username'),
                    Input::post('password'),
                    Input::post('email'),
                    Input::post('group', 3),
					Input::post('profile_fields')
                );

                // if a user was created succesfully
				if ($created)
				{
					Session::set_flash('success', e('Added user.'));
					Kora\Notifications::forge('Added user');

					Response::redirect('admin/users');
				}

				else
				{
					Session::set_flash('error', e('Could not save user.'));
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
			//*/
		}
	
		Config::load('users');
		$users = Model_User::find('all');
		
		$emails_array = Format::forge(Arr::assoc_to_keyval($users, 'email', 'email'))->to_json();
		$usernames_array = Format::forge(Arr::assoc_to_keyval($users, 'name', 'name'))->to_json();
		
		$this->template->set_global('emails_array', $emails_array, false);
		$this->template->set_global('usernames_array', $usernames_array, false);
		$this->template->set_global('levels', Config::get('forms.select_options.levels'), false);
		$this->template->set_global('groups_array', Arr::assoc_to_keyval(Model_Group::find('all'), 'id', 'name'), false);
	
		$listings_title = array(
			'listings_breadcrumb'   =>'<li>'
									. Kora\Permissions::get_link('admin/dashboard', '', '<i class="fa fa-dashboard fa-fw"></i> Dashboard', 'index')
									. '</li>'
									. '<li>'
									. Kora\Permissions::get_link('admin/permissions', '', '<i class="fa fa-lock fa-fw"></i> Permissions', 'index')
									. '</li>'
									. '<li>'
									. Kora\Permissions::get_link('admin/users', '', '<i class="fa fa-user fa-fw"></i> Users', 'index')
									. '</li>',		
			'listings_title' 		=> '<i class="fa fa-plus fa-fw"></i>  Create new user',
			'listings_extra' 		=> Kora\Permissions::get_link('admin/users', '', '<i class="fa fa-user-plus fa-fw"></i>  Create new user', 'create', array('class'=>'btn btn-xs btn-success')),
		);
		$listings_panel_group = array(
			'panel_id' 			=> 'collapse_listing',
			'panel_parent_id' 	=> 'parent_listing',
			'panel_heading_id' 	=> 'heading_listing',
			'panel_title' 		=> '<i class="fa fa-plus fa-fw"></i>  Create new user',
			'panel_title_ext' 	=> '',
			'panel_body' 		=> render('admin/users/_create'),
		);
		
		$this->template->set_global('listings_title', 		$listings_title, 		false);
		$this->template->set_global('listings_panel_group', $listings_panel_group,	false);
		
		$this->template->title = "Users";
		$this->template->content = View::forge('admin/users/index');
	}

	public function action_edit($id = null)
	{
		$user = Model_User::find($id);
		$val = Model_User::validate('edit');

		if ($val->run())
		{
			$user->username = Input::post('username');
			$user->group = Input::post('group');
			$user->email = Input::post('email');
			$user->profile_fields = serialize(Input::post('profile_fields'));

			if ($user->save())
			{
				Session::set_flash('success', e('Updated user #' . $id));
				Kora\Notifications::forge('Updated user #' . $id);

				Response::redirect('admin/users');
			}

			else
			{
				Session::set_flash('error', e('Could not update user #' . $id));
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$user->username = $val->validated('username');
				$user->group = $val->validated('group');
				$user->email = $val->validated('email');
				$user->profile_fields = $val->validated('profile_fields');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('user', $user, false);
		}
		$profile_fields = (object) unserialize($user->profile_fields);
		$this->template->set_global('groups_array', Arr::assoc_to_keyval(Model_Group::find('all'), 'id', 'name'), false);
		$this->template->set_global('profile_fields', $profile_fields, false);
	
		$listings_title = array(
			'listings_breadcrumb'   =>'<li>'
									. Kora\Permissions::get_link('admin/dashboard', '', '<i class="fa fa-dashboard fa-fw"></i> Dashboard', 'index')
									. '</li>'
									. '<li>'
									. Kora\Permissions::get_link('admin/permissions', '', '<i class="fa fa-lock fa-fw"></i> Permissions', 'index')
									. '</li>'
									. '<li>'
									. Kora\Permissions::get_link('admin/users', '', '<i class="fa fa-user fa-fw"></i> Users', 'index')
									. '</li>',		
			'listings_title' 		=> '<i class="fa fa-edit fa-fw"></i>  Edit user #'.$id,
			'listings_extra' 		=> Kora\Permissions::get_link('admin/users', '', '<i class="fa fa-user-plus fa-fw"></i>  Create new user', 'create', array('class'=>'btn btn-xs btn-success')),
		);
		$listings_panel_group = array(
			'panel_id' 			=> 'collapse_listing',
			'panel_parent_id' 	=> 'parent_listing',
			'panel_heading_id' 	=> 'heading_listing',
			'panel_title' 		=> '<i class="fa fa-edit fa-fw"></i>  Edit user #'.$id,
			'panel_title_ext' 	=> '',
			'panel_body' 		=> render('admin/users/_edit'),
		);
		
		$this->template->set_global('listings_title', 		$listings_title, 		false);
		$this->template->set_global('listings_panel_group', $listings_panel_group,	false);
		
		$this->template->title = "Users";
		$this->template->content = View::forge('admin/users/index');

	}

	public function action_delete($id = null)
	{
		if ($user = Model_User::find($id))
		{
			$user->delete();

			Session::set_flash('success', e('Deleted user #'.$id));
		}

		else
		{
			Session::set_flash('error', e('Could not delete user #'.$id));
		}

		Response::redirect('admin/users');

	}

}
