<?php
class Controller_Admin_Media extends Controller_Admin
{	
	public function action_index()
	{
        Plugin\Bootloader::forge();

		$per_page_array = array(
							'<!-- Per page -->',                        
							'<span class="label"><a href="javascript:void(0)" class="call_per_page" data-per-page="3">3</a></span>',
							'<span class="label"><a href="javascript:void(0)" class="call_per_page" data-per-page="5">5</a></span>',
							'<span class="label"><a href="javascript:void(0)" class="call_per_page" data-per-page="10">10</a></span>',
							'<span class="label"><a href="javascript:void(0)" class="call_per_page" data-per-page="15">15</a></span>',
							'<span class="label"><a href="javascript:void(0)" class="call_per_page" data-per-page="20">20</a></span>', 
						);
		$list_style_array = array(
					'<!-- List style -->',                        
					'<span class="label"><a href="javascript:void(0)" class="call_list_style" data-list-style="0"><i class="fa fa-th-list"></i></a></span>', 
					'<span class="label"><a href="javascript:void(0)" class="call_list_style" data-list-style="1"><i class="fa fa-th"></i></a></span>', 
					'<span class="label"><a href="javascript:void(0)" class="call_list_style" data-list-style="2"><i class="fa fa-th-large"></i></a></span>', 
				);				

		$listings_title = array(
			'listings_breadcrumb' 	=> '<li>'
								. Kora\Permissions::get_link('admin/dashboard', '', '<i class="fa fa-dashboard fa-fw"></i> Dashboard', 'index')
								. '</li>',
			'listings_title' 	=> '<i class="fa fa-picture-o fa-fw"></i> Media',
			'listings_extra' 	=> '',
		);
		
		$listings_panel_group = array(
			'panel_id' 			=> 'collapse_listing',
			'panel_parent_id' 	=> 'parent_listing',
			'panel_heading_id' 	=> 'heading_listing',
			'panel_title' 		=> '<i class="fa fa-picture-o fa-fw"></i> Media',
			'panel_title_ext'	=> '<div class="pull-right">'.implode(' ', $list_style_array).' | '.implode(' ', $per_page_array).'<div>',
			'panel_body' 		=> render('admin/media/_manager'),
		);
		$this->template->set_global('listings_title', 		$listings_title, 		false);
		$this->template->set_global('listings_panel_group', $listings_panel_group,	false);

		$this->template->title = "Media";
		$this->template->content = View::forge('admin/media/index');
	}
}
