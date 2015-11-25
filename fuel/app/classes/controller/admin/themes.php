<?php
class Controller_Admin_Themes extends Controller_Admin
{
	public function action_index()
	{
		$this->template->set_global('themes', Model_Theme::find('all'), false);		
	
		$listings_title = array(
			'listings_breadcrumb'   =>'<li>'
									. Kora\Permissions::get_link('admin/dashboard', '', '<i class="fa fa-dashboard fa-fw"></i> Dashboard', 'index')
									. '</li>'
									. '<li>'
									. Kora\Permissions::get_link('admin/addons', '', '<i class="fa fa-puzzle-piece fa-fw"></i> Add-ons', 'index')
									. '</li>',		
			'listings_title' 		=> '<i class="fa fa-paint-brush fa-fw"></i> Themes',
			'listings_extra' 		=> '',
		);
		$listings_panel_group = array(
			'panel_id' 			=> 'collapse_listing',
			'panel_parent_id' 	=> 'parent_listing',
			'panel_heading_id' 	=> 'heading_listing',
			'panel_title' 		=> '<i class="fa fa-paint-brush fa-fw"></i> Themes',
			'panel_title_ext' 	=> '',
			'panel_body' 		=> render('admin/themes/_listings'),
		);
		
		$this->template->set_global('listings_title', 		$listings_title, 		false);
		$this->template->set_global('listings_panel_group', $listings_panel_group,	false);
		
		$this->template->title = "Themes";
		$this->template->content = View::forge('admin/themes/index');
	}
	
}