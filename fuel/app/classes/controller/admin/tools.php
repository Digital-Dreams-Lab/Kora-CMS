<?php
class Controller_Admin_Tools extends Controller_Admin
{
	public function action_index()
	{

	
		$listings_title = array(
			'listings_breadcrumb'   =>'<li>'
									. Kora\permissions::get_link('admin/dashboard', '', '<i class="fa fa-dashboard fa-fw"></i> Dashboard', 'index')
									. '</li>',		
			'listings_title' 		=> '<i class="fa fa-lock fa-fw"></i> tools',
			'listings_extra' 		=> '',
		);
		$listings_panel_group = array(
			'panel_id' 			=> 'collapse_listing',
			'panel_parent_id' 	=> 'parent_listing',
			'panel_heading_id' 	=> 'heading_listing',
			'panel_title' 		=> '<i class="fa fa-wrench fa-fw"></i> Tools',
			'panel_title_ext' 	=> '',
			'panel_body' 		=> render('admin/tools/_listings'),
		);
		
		$this->template->set_global('listings_title', 		$listings_title, 		false);
		$this->template->set_global('listings_panel_group', $listings_panel_group,	false);
		
		$this->template->title = "Tools";
		$this->template->content = View::forge('admin/tools/index');
	}
	
}