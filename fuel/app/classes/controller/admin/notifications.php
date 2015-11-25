<?php
class Controller_Admin_Notifications extends Controller_Admin
{
	public function action_index()
	{
		$this->template->set_global('notifications', 		Model_Notification::find('all'), 		false);
		$listings_title = array(
			'listings_breadcrumb'   =>'<li>'
									. Kora\Permissions::get_link('admin/dashboard', '', '<i class="fa fa-dashboard fa-fw"></i> Dashboard', 'index')
									. '</li>'
									. '<li>'
									. Kora\Permissions::get_link('admin/settings', '', '<i class="fa fa-cog fa-fw"></i> settings', 'index')
									. '</li>',		
			'listings_title' 		=> '<i class="fa fa-flag fa-fw"></i> Notifications',
			'listings_extra' 		=> '',
		);
		$listings_panel_group = array(
			'panel_id' 			=> 'collapse_listing',
			'panel_parent_id' 	=> 'parent_listing',
			'panel_heading_id' 	=> 'heading_listing',
			'panel_title' 		=> '<i class="fa fa-flag fa-fw"></i> Notifications',
			'panel_title_ext' 	=> '',
			'panel_body' 		=> render('admin/notifications/_listings'),
		);
		
		$this->template->set_global('listings_title', 		$listings_title, 		false);
		$this->template->set_global('listings_panel_group', $listings_panel_group,	false);
		
		$this->template->title = "Notifications";
		$this->template->content = View::forge('admin/notifications/index');

	}

	public function action_view($id = null)
	{

		$this->template->title = "Notification";
		$this->template->content = View::forge('admin/notifications/view');

	}

}
