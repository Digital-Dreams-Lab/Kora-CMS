<?php
class Controller_Admin_Accounts extends Controller_Admin
{
	public function action_index()
	{
		$account_details['profile_fields'] 	= Auth::get_profile_fields();
		$account_details['username'] 		= Auth::get_screen_name();
		$account_details['email'] 			= Auth::get_email();
		$account_details['groups'] 			= Auth::get_groups();
		$account_details['user_id']=$user_id= Auth::get('id');
		$account_details['level'] 			= Auth::get('level');
		$account_details['last_login'] 		= Auth::get('last_login');
		$account_details['created_at'] 		= Auth::get('created_at');
		$account_details['updated_at'] 		= Auth::get('updated_at');
		
		$group = Model_Group::find($user_id);
	
		$this->template->set_global('group', $group);
				
		$this->template->set_global('access_array', Model_Access::find('all'), false);
		$this->template->set_global('groups', Model_Group::find('all'), false);
		$this->template->set_global('groups_array', Arr::assoc_to_keyval(Model_Group::find('all'), 'id', 'name'), false);
		$this->template->set_global('account_details', $account_details, false);

		$registers = Model_Register::find('all', array('where' => array(array('route', 'admin'),),'order_by' => array('controller' => 'asc'),));
		$call_back = function($v){ return array_map('trim', explode(',', $v)); };
		
		$this->template->set_global('actions_array', $actions_array=array_map($call_back, Arr::assoc_to_keyval($registers, 'controller', 'actions')));
		$this->template->set_global('perms_array', array_map($call_back, Arr::assoc_to_keyval($registers, 'controller', 'perms')));
		$this->template->set_global('system_perms_saved', unserialize($group->system_perms));		
		$this->template->set_global('plugins_array', Arr::assoc_to_keyval(Model_Plugin::find('all'), 'id', 'name'));
		$this->template->set_global('plugin_perms_saved', unserialize($group->plugin_perms));

		//var_dump(Model_Access::find('all'));

		$listings_title = array(
			'listings_breadcrumb'   =>'<li>'
									. Kora\Permissions::get_link('admin/dashboard', '', '<i class="fa fa-dashboard fa-fw"></i> Dashboard', 'index')
									. '</li>'
									. '<li>'
									. Kora\Permissions::get_link('admin/settings', '', '<i class="fa fa-cog fa-fw"></i> Settings', 'index')
									. '</li>',		
			'listings_title' 		=> '<i class="fa fa-user-secret fa-fw"></i> Account',
			'listings_extra' 		=> '',
		);
		$listings_panel_group = array(
			'panel_id' 			=> 'collapse_listing',
			'panel_parent_id' 	=> 'parent_listing',
			'panel_heading_id' 	=> 'heading_listing',
			'panel_title' 		=> '<i class="fa fa-user-secret fa-fw"></i> Account',
			'panel_title_ext' 	=> '',
			'panel_body' 		=> render('admin/accounts/_listings'),
		);
		
		$this->template->set_global('listings_title', 		$listings_title, 		false);
		$this->template->set_global('listings_panel_group', $listings_panel_group,	false);
		
		$this->template->title = "Accounts";
		$this->template->content = View::forge('admin/accounts/index');
	}
	
	public function action_edit()
	{
		$id = Auth::get('id');
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

				Response::redirect('admin/accounts/index');
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
	
		//var_dump(Model_Access::find('all'));

		$listings_title = array(
			'listings_breadcrumb'   =>'<li>'
									. Kora\Permissions::get_link('admin/dashboard', '', '<i class="fa fa-dashboard fa-fw"></i> Dashboard', 'index')
									. '</li>'
									. '<li>'
									. Kora\Permissions::get_link('admin/settings', '', '<i class="fa fa-cog fa-fw"></i> Settings', 'index')
									. '</li>'
									. '<li>'
									. Kora\Permissions::get_link('admin/accounts', '', '<i class="fa fa-user-secret fa-fw"></i> Account settings', 'index')
									. '</li>',		
			'listings_title' 		=> '<i class="fa fa-edit fa-fw"></i>  Edit account details',
			'listings_extra' 		=> '',
		);
		
		$listings_panel_group = array(
			'panel_id' 			=> 'collapse_listing',
			'panel_parent_id' 	=> 'parent_listing',
			'panel_heading_id' 	=> 'heading_listing',
			'panel_title' 		=> '<i class="fa fa-edit fa-fw"></i>  Edit account details',
			'panel_title_ext' 	=> '',
			'panel_body' 		=> render('admin/users/_edit'),
		);
		
		$this->template->set_global('listings_title', 		$listings_title, 		false);
		$this->template->set_global('listings_panel_group', $listings_panel_group,	false);
		
		$this->template->title = "Users";
		$this->template->content = View::forge('admin/accounts/index');

	}
	
	
	public function action_password()
	{
		$id = Auth::get('id');
		
		if (Input::method() == 'POST')
		{
			if (Auth::change_password(Input::post('current_password'),Input::post('new_password')))
			{
				Session::set_flash('success', e('Updated password'));

				Response::redirect('admin/accounts/index');
			}

			else
			{
				Session::set_flash('error', e('Could not update password'));
			}
		}

		$listings_title = array(
			'listings_breadcrumb'   =>'<li>'
									. Kora\Permissions::get_link('admin/dashboard', '', '<i class="fa fa-dashboard fa-fw"></i> Dashboard', 'index')
									. '</li>'
									. '<li>'
									. Kora\Permissions::get_link('admin/settings', '', '<i class="fa fa-cog fa-fw"></i> Settings', 'index')
									. '</li>'
									. '<li>'
									. Kora\Permissions::get_link('admin/accounts', '', '<i class="fa fa-user-secret fa-fw"></i> Account settings', 'index')
									. '</li>',		
			'listings_title' 		=> '<i class="fa fa-key fa-fw"></i>  Change password',
			'listings_extra' 		=> '',
		);
		
		$listings_panel_group = array(
			'panel_id' 			=> 'collapse_listing',
			'panel_parent_id' 	=> 'parent_listing',
			'panel_heading_id' 	=> 'heading_listing',
			'panel_title' 		=> '<i class="fa fa-key fa-fw"></i>  Change password',
			'panel_title_ext' 	=> '',
			'panel_body' 		=> render('admin/accounts/_password'),
		);
		
		$this->template->set_global('listings_title', 		$listings_title, 		false);
		$this->template->set_global('listings_panel_group', $listings_panel_group,	false);
		
		$this->template->title = "Users";
		$this->template->content = View::forge('admin/accounts/index');

	}
	
}