<?php
class Controller_Admin_Groups extends Controller_Admin
{

	public function action_index()
	{
		$this->template->set_global('groups', Model_Group::find('all'), false);	
		$this->template->set_global('groups_array', Arr::assoc_to_keyval(Model_Group::find('all'), 'id', 'name'), false);
	
		$listings_title = array(
			'listings_breadcrumb' => '<li>'
								. Kora\Permissions::get_link('admin/dashboard', '', '<i class="fa fa-dashboard fa-fw"></i> Dashboard', 'index')
								. '</li>'
								. '<li>'
								. Kora\Permissions::get_link('admin/permissions', '', '<i class="fa fa-lock fa-fw"></i> Permissions', 'index')
								. '</li>',	
			'listings_title' => '<i class="fa fa-users fa-fw"></i> User groups',				
			'listings_extra' => Kora\Permissions::get_link('admin/groups', '', '<i class="fa fa-plus fa-fw"></i>  Create new user group', 'create', array('class'=>'btn btn-xs btn-success')),
		);
		$listings_panel_group = array(
			'panel_id' 			=> 'collapse_listing',
			'panel_parent_id' 	=> 'parent_listing',
			'panel_heading_id' 	=> 'heading_listing',
			'panel_title' 		=> '<i class="fa fa-users fa-fw"></i> User groups',
			'panel_title_ext' 	=> '',
			'panel_body' 		=> render('admin/groups/_listings'),
		);
		
		$this->template->set_global('listings_title', 		$listings_title, 		false);
		$this->template->set_global('listings_panel_group', $listings_panel_group,	false);
		
		$this->template->title = "User groups";
		$this->template->content = View::forge('admin/groups/index');
	}

	public function action_view($id = null)
	{
		$group = Model_Group::find($id);

		Config::load('kora/permissions');
			
		$this->template->set_global('group', $group);
		
		$registers = Model_Register::find('all', array('where' => array(array('route', 'admin'),),'order_by' => array('controller' => 'asc'),));
		$call_back = function($v){ return array_map('trim', explode(',', $v)); };
		
		$this->template->set_global('actions_array', $actions_array=array_map($call_back, Arr::assoc_to_keyval($registers, 'controller', 'actions')));
		$this->template->set_global('perms_array', array_map($call_back, Arr::assoc_to_keyval($registers, 'controller', 'perms')));
		$this->template->set_global('system_perms_saved', unserialize($group->system_perms));		
		$this->template->set_global('plugins_array', Arr::assoc_to_keyval(Model_Plugin::find('all'), 'id', 'name'));
		$this->template->set_global('plugin_perms_saved', unserialize($group->plugin_perms));
	
		$listings_title = array(
			'listings_breadcrumb' => '<li>'
								. Kora\Permissions::get_link('admin/dashboard', '', '<i class="fa fa-dashboard fa-fw"></i> Dashboard', 'index')
								. '</li>'
								. '<li>'
								. Kora\Permissions::get_link('admin/permissions', '', '<i class="fa fa-lock fa-fw"></i> Permissions', 'index')
								. '</li>'
								. '<li>'
								. Kora\Permissions::get_link('admin/groups', '', '<i class="fa fa-users fa-fw"></i> User groups', 'index')
								. '</li>',	
			'listings_title' => '<i class="fa fa-search fa-fw"></i> View user group #'.$group->id,				
			'listings_extra' => Kora\Permissions::get_link('admin/groups', '', '<i class="fa fa-plus fa-fw"></i>  Create new user group', 'create', array('class'=>'btn btn-xs btn-success')),
		);
		
		$listings_panel_group = array(
			'panel_id' 			=> 'collapse_listing',
			'panel_parent_id' 	=> 'parent_listing',
			'panel_heading_id' 	=> 'heading_listing',
			'panel_title' 		=> '<i class="fa fa-search fa-fw"></i> View user group #'.$group->id,	
			'panel_title_ext' 	=> '',
			'panel_body' 		=> render('admin/groups/_view'),
		);
		
		$this->template->set_global('listings_title', 		$listings_title, 		false);
		$this->template->set_global('listings_panel_group', $listings_panel_group,	false);
		
		$this->template->title = "User groups";
		$this->template->content = View::forge('admin/groups/index');
	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Group::validate('create');

			if ($val->run())
			{
				$group = Model_Group::forge(array(
					'name' 			=> Input::post('name'),
					'level' 			=> Input::post('level', 3),
					'system_perms'	=> serialize(Input::post('system_perms')),
					'plugin_perms'	=> serialize(Input::post('plugin_perms')),
				));

				if ($group and $group->save())
				{
					Session::set_flash('success', e('Added group #'.$group->id.'.'));

					Response::redirect('admin/groups');
				}

				else
				{
					Session::set_flash('error', e('Could not save group.'));
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}
		$registers = Model_Register::find('all', array('where' => array(array('route', 'admin'),),'order_by' => array('controller' => 'asc'),));
		
		$call_back = function($v){ return array_map('trim', explode(',', $v)); };
		
		$this->template->set_global('actions_array', $actions_array=array_map($call_back, Arr::assoc_to_keyval($registers, 'controller', 'actions')));
		$this->template->set_global('perms_array', array_map($call_back, Arr::assoc_to_keyval($registers, 'controller', 'perms')));
		$this->template->set_global('plugins_array', Arr::assoc_to_keyval(Model_Plugin::find('all'), 'id', 'name'));
		
		$listings_title = array(
			'listings_breadcrumb' => '<li>'
								. Kora\Permissions::get_link('admin/dashboard', '', '<i class="fa fa-dashboard fa-fw"></i> Dashboard', 'index')
								. '</li>'
								. '<li>'
								. Kora\Permissions::get_link('admin/permissions', '', '<i class="fa fa-lock fa-fw"></i> Permissions', 'index')
								. '</li>'
								. '<li>'
								. Kora\Permissions::get_link('admin/groups', '', '<i class="fa fa-users fa-fw"></i> User groups', 'index')
								. '</li>',	
			'listings_title' => '<i class="fa fa-plus fa-fw"></i> Create new user group',				
			'listings_extra' => Kora\Permissions::get_link('admin/groups', '', '<i class="fa fa-plus fa-fw"></i>  Create new user group', 'create', array('class'=>'btn btn-xs btn-success')),
		);
		$listings_panel_group = array(
			'panel_id' 			=> 'collapse_listing',
			'panel_parent_id' 	=> 'parent_listing',
			'panel_heading_id' 	=> 'heading_listing',
			'panel_title' 		=> '<i class="fa fa-plus fa-fw"></i> Create new user group',	
			'panel_title_ext' 	=> '',
			'panel_body' 		=> render('admin/groups/_create'),
		);
		
		$this->template->set_global('listings_title', 		$listings_title, 		false);
		$this->template->set_global('listings_panel_group', $listings_panel_group,	false);
		
		$this->template->title = "Groups";
		$this->template->content = View::forge('admin/groups/index');

	}

	public function action_edit($id = null)
	{
		$group = Model_Group::find($id);			
		
		if (Input::method() == 'POST')
		{
			$val = Model_Group::validate('edit');
			
			if ($val->run())
			{
				$group->name = Input::post('name');
				$group->level = Input::post('level', 3);
				$group->system_perms = serialize(Input::post('system_perms'));
				$group->plugin_perms = serialize(Input::post('plugin_perms'));
	
				if ($group->save())
				{
					Session::set_flash('success', e('Updated group #' . $id));
	
					Response::redirect('admin/groups');
				}
	
				else
				{
					Session::set_flash('error', e('Could not update group #' . $id));
				}
			}
	
			else
			{
				if (Input::method() == 'POST')
				{
					Session::set_flash('error', $val->error());
				}
			}
		}
		$this->template->set_global('group', $group);
		
		$registers = Model_Register::find('all', array('where' => array(array('route', 'admin'),),'order_by' => array('controller' => 'asc'),));
		$call_back = function($v){ return array_map('trim', explode(',', $v)); };
		
		$this->template->set_global('actions_array', $actions_array=array_map($call_back, Arr::assoc_to_keyval($registers, 'controller', 'actions')));
		$this->template->set_global('perms_array', array_map($call_back, Arr::assoc_to_keyval($registers, 'controller', 'perms')));
		$this->template->set_global('system_perms_saved', unserialize($group->system_perms));		
		$this->template->set_global('plugins_array', Arr::assoc_to_keyval(Model_Plugin::find('all'), 'id', 'name'));
		$this->template->set_global('plugin_perms_saved', unserialize($group->plugin_perms));
	
	
		$listings_title = array(
			'listings_breadcrumb' => '<li>'
								. Kora\Permissions::get_link('admin/dashboard', '', '<i class="fa fa-dashboard fa-fw"></i> Dashboard', 'index')
								. '</li>'
								. '<li>'
								. Kora\Permissions::get_link('admin/permissions', '', '<i class="fa fa-lock fa-fw"></i> Permissions', 'index')
								. '</li>'
								. '<li>'
								. Kora\Permissions::get_link('admin/groups', '', '<i class="fa fa-users fa-fw"></i> User groups', 'index')
								. '</li>',	
			'listings_title' => '<i class="fa fa-edit fa-fw"></i> Edit user group #'.$group->id,				
			'listings_extra' => Kora\Permissions::get_link('admin/groups', '', '<i class="fa fa-plus fa-fw"></i>  Create new user group', 'create', array('class'=>'btn btn-xs btn-success')),
		);
		
		$listings_panel_group = array(
			'panel_id' 			=> 'collapse_listing',
			'panel_parent_id' 	=> 'parent_listing',
			'panel_heading_id' 	=> 'heading_listing',
			'panel_title' 		=> '<i class="fa fa-edit fa-fw"></i> Edit user group #'.$group->id,
			'panel_title_ext' 	=> '',
			'panel_body' 		=> render('admin/groups/_edit'),
		);
		
		$this->template->set_global('listings_title', 		$listings_title, 		false);
		$this->template->set_global('listings_panel_group', $listings_panel_group,	false);
		
		$this->template->title = "User groups";
		$this->template->content = View::forge('admin/groups/index');

	}

	public function action_delete($id = null)
	{
		if ($group = Model_Group::find($id))
		{
			$group->delete();

			Session::set_flash('success', e('Deleted group #'.$id));
		}

		else
		{
			Session::set_flash('error', e('Could not delete group #'.$id));
		}

		Response::redirect('admin/groups');

	}

}
