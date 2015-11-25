<?php
class Controller_Admin_Permissions extends Controller_Admin
{
	public function action_index()
	{
		$this->template->set_global('accesses', Model_Access::find('all'), false);
		$this->template->set_global('users', Model_User::find('all'), false);	
		$this->template->set_global('groups', Model_Group::find('all'), false);
		$this->template->set_global('registers', Model_Register::find('all'), false);		
		$this->template->set_global('groups_array', Arr::assoc_to_keyval(Model_Group::find('all'), 'id', 'name'), false);		
		$this->template->set_global('registers_array', Arr::assoc_to_keyval(Model_Register::find('all'), 'route', 'route'), false);
		
		$listings_title = array(
			'listings_breadcrumb'   =>'<li>'
									. Kora\Permissions::get_link('admin/dashboard', '', '<i class="fa fa-dashboard fa-fw"></i> Dashboard', 'index')
									. '</li>',		
			'listings_title' 		=> '<i class="fa fa-lock fa-fw"></i> Permissions',
			'listings_extra' 		=> '',
		);
		$listings_panel_group = array(
			'panel_id' 			=> 'collapse_listing',
			'panel_parent_id' 	=> 'parent_listing',
			'panel_heading_id' 	=> 'heading_listing',
			'panel_title' 		=> '<i class="fa fa-lock fa-fw"></i> Permissions',
			'panel_title_ext' 	=> '',
			'panel_body' 		=> render('admin/permissions/_listings'),
		);
		
		$this->template->set_global('listings_title', 		$listings_title, 		false);
		$this->template->set_global('listings_panel_group', $listings_panel_group,	false);
		
		$this->template->title = "Permissions";
		$this->template->content = View::forge('admin/permissions/index');
	}
	
}