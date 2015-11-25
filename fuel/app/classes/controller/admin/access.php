<?php

/**
 * Admin Access Controller
 *
 * Route:	/admin/access
 * File:	/fuel/app/classes/controller/admin/access 
 *
 */
 
class Controller_Admin_Access extends Controller_Admin
{

	/**
     * Route:	/admin/access
	 */
	public function action_index()
	{	
		$this->template->set_global('accesses', Model_Access::find('all'), false);	
		$this->template->set_global('groups_array', Arr::assoc_to_keyval(Model_Group::find('all'), 'id', 'name'), false);
	
		$listings_title = array(
			'listings_breadcrumb' => '<li>'
								. Kora\Permissions::get_link('admin/dashboard', '', '<i class="fa fa-dashboard fa-fw"></i> Dashboard', 'index')
								. '</li>'
								. '<li>'
								. Kora\Permissions::get_link('admin/permissions', '', '<i class="fa fa-lock fa-fw"></i> Permissions', 'index')
								. '</li>',	
			'listings_title' => '<i class="fa fa-user-secret fa-fw"></i> Access',				
			'listings_extra' => Kora\Permissions::get_link('admin/access', '', '<i class="fa fa-plus fa-fw"></i>  Create new access rules', 'create', array('class'=>'btn btn-xs btn-success')),
		);
		$listings_panel_group = array(
			'panel_id' 			=> 'collapse_listing',
			'panel_parent_id' 	=> 'parent_listing',
			'panel_heading_id' 	=> 'heading_listing',
			'panel_title' 		=> '<i class="fa fa-user-secret fa-fw"></i> Access',
			'panel_title_ext' 	=> '',
			'panel_body' 		=> render('admin/access/_listings'),
		);
		
		$this->template->set_global('listings_title', 		$listings_title, 		false);
		$this->template->set_global('listings_panel_group', $listings_panel_group,	false);
		
		$this->template->title = "Access";
		$this->template->content = View::forge('admin/access/index');
	}

	/**
     * Route:	/admin/view/:id
	 */
	public function action_view($id = null)
	{
		$access = Model_Access::find($id);	
				
		$this->template->set_global('access', $access, false);
		$this->template->set_global('registers_array', Arr::assoc_to_keyval(Model_Register::find('all'), 'route', 'route'), false);	
		$this->template->set_global('groups_array', Arr::assoc_to_keyval(Model_Group::find('all'), 'id', 'name'), false);
	
		$listings_title = array(
			'listings_breadcrumb' => '<li>'
								. Kora\Permissions::get_link('admin/dashboard', '', '<i class="fa fa-dashboard fa-fw"></i> Dashboard', 'index')
								. '</li>'
								. '<li>'
								. Kora\Permissions::get_link('admin/permissions', '', '<i class="fa fa-lock fa-fw"></i> Permissions', 'index')
								. '</li>'
								. '<li>'
								. Kora\Permissions::get_link('admin/access', '', '<i class="fa fa-user-secret fa-fw"></i> Access', 'index')
								. '</li>',	
			'listings_title' => '<i class="fa fa-search fa-fw"></i> View access rule #'.$access->id,				
			'listings_extra' => Kora\Permissions::get_link('admin/access', '', '<i class="fa fa-plus fa-fw"></i>  Create new access rules', 'create', array('class'=>'btn btn-xs btn-success')),
		);
		$listings_panel_group = array(
			'panel_id' 			=> 'collapse_listing',
			'panel_parent_id' 	=> 'parent_listing',
			'panel_heading_id' 	=> 'heading_listing',
			'panel_title' 		=> '<i class="fa fa-search fa-fw"></i> View access rule #'.$access->id,
			'panel_title_ext' 	=> '',
			'panel_body' 		=> render('admin/access/_view'),
		);
		
		$this->template->set_global('listings_title', 		$listings_title, 		false);
		$this->template->set_global('listings_panel_group', $listings_panel_group,	false);

		$this->template->title = "Access";
		$this->template->content = View::forge('admin/access/index');
	}

	/**
     * Route:	/admin/create/
	 */
	public function action_create()
	{		
		if (Input::method() == 'POST')
		{
			$val = Model_Access::validate('create');

			if ($val->run())
			{
				$access = Model_Access::forge(array(
					'name' => Input::post('name'),
					'groups' => implode(',',Input::post('groups')),
				));

				if ($access and $access->save())
				{
					Session::set_flash('success', e('Added access #'.$access->id.'.'));
					Kora\Notifications::forge('Added access #'.$access->id.'.');

					Response::redirect('admin/access');
				}

				else
				{
					Session::set_flash('error', e('Could not save access.'));
				}
			}
			
			else
			{
				Session::set_flash('error', $val->error());
			}
		}
		
		$this->template->set_global('registers_array', Arr::assoc_to_keyval(Model_Register::find('all'), 'route', 'route'), false);
		$this->template->set_global('access_check', Arr::assoc_to_keyval(Model_Access::find('all'), 'name', 'name'), false);
		$this->template->set_global('groups_array', Arr::assoc_to_keyval(Model_Group::find('all'), 'id', 'name'), false);
	
		$listings_title = array(
			'listings_breadcrumb' => '<li>'
								. Kora\Permissions::get_link('admin/dashboard', '', '<i class="fa fa-dashboard fa-fw"></i> Dashboard', 'index')
								. '</li>'
								. '<li>'
								. Kora\Permissions::get_link('admin/permissions', '', '<i class="fa fa-lock fa-fw"></i> Permissions', 'index')
								. '</li>'
								. '<li>'
								. Kora\Permissions::get_link('admin/access', '', '<i class="fa fa-user-secret fa-fw"></i> Access', 'index')
								. '</li>',	
			'listings_title' => '<i class="fa fa-plus fa-fw"></i> Create new access rule',				
			'listings_extra' => Kora\Permissions::get_link('admin/access', '', '<i class="fa fa-plus fa-fw"></i>  Create new access rules', 'create', array('class'=>'btn btn-xs btn-success')),
		);
		$listings_panel_group = array(
			'panel_id' 			=> 'collapse_listing',
			'panel_parent_id' 	=> 'parent_listing',
			'panel_heading_id' 	=> 'heading_listing',
			'panel_title' 		=> '<i class="fa fa-plus fa-fw"></i> Create new access rule',	
			'panel_title_ext' 	=> '',
			'panel_body' 		=> render('admin/access/_create'),
		);
		
		$this->template->set_global('listings_title', 		$listings_title, 		false);
		$this->template->set_global('listings_panel_group', $listings_panel_group,	false);
		
		$this->template->title = "Access";
		$this->template->content = View::forge('admin/access/index');


	}

	/**
     * Route:	/admin/edit/:id
	 */
	public function action_edit($id = null)
	{
		$access = Model_Access::find($id);		
		
		if (Input::method() == 'POST')
		{
			$val = Model_Access::validate('edit');
	
			if ($val->run())
			{
				$access->name = Input::post('name');
				$access->groups = implode(',', array_filter(Input::post('groups')));
	
				if ($access->save())
				{
					Session::set_flash('success', e('Updated access #' . $id));
	
					Response::redirect('admin/access');
				}
	
				else
				{
					Session::set_flash('error', e('Could not update access #' . $id));
				}
			}
	
			else
			{
				if (Input::method() == 'POST')
				{
					$access->name = $val->validated('name');
					$access->groups = $val->validated('groups');
	
					Session::set_flash('error', $val->error());
				}
	
				$this->template->set_global('access', $access, false);
			}
		}
		
		$this->template->set_global('access', $access, false);
		$this->template->set_global('registers_array', Arr::assoc_to_keyval(Model_Register::find('all'), 'route', 'route'), false);	
		$this->template->set_global('groups_array', Arr::assoc_to_keyval(Model_Group::find('all'), 'id', 'name'), false);
	
		$listings_title = array(
			'listings_breadcrumb' => '<li>'
								. Kora\Permissions::get_link('admin/dashboard', '', '<i class="fa fa-dashboard fa-fw"></i> Dashboard', 'index')
								. '</li>'
								. '<li>'
								. Kora\Permissions::get_link('admin/permissions', '', '<i class="fa fa-lock fa-fw"></i> Permissions', 'index')
								. '</li>'
								. '<li>'
								. Kora\Permissions::get_link('admin/access', '', '<i class="fa fa-user-secret fa-fw"></i> Access', 'index')
								. '</li>',	
			'listings_title' => '<i class="fa fa-edit fa-fw"></i> Edit access rule #'.$access->id,				
			'listings_extra' => Kora\Permissions::get_link('admin/access', '', '<i class="fa fa-plus fa-fw"></i>  Create new access rules', 'create', array('class'=>'btn btn-xs btn-success')),
		);
		$listings_panel_group = array(
			'panel_id' 			=> 'collapse_listing',
			'panel_parent_id' 	=> 'parent_listing',
			'panel_heading_id' 	=> 'heading_listing',
			'panel_title' 		=> '<i class="fa fa-edit fa-fw"></i> Edit access rule #'.$access->id,	
			'panel_title_ext' 	=> '',
			'panel_body' 		=> render('admin/access/_edit'),
		);
		
		$this->template->set_global('listings_title', 		$listings_title, 		false);
		$this->template->set_global('listings_panel_group', $listings_panel_group,	false);
		
		$this->template->title = "Access";
		$this->template->content = View::forge('admin/access/index');
	}

	/**
     * Route:	/admin/delete/:id
	 */
	public function action_delete($id = null)
	{
		if ($access = Model_Access::find($id))
		{
			$access->delete();
			
			Session::set_flash('success', e('Deleted access #'.$id));
		}
		
		else
		{
			Session::set_flash('error', e('Could not delete access #'.$id));
		}
		Response::redirect('admin/access');
	}

/* End of file */
}
