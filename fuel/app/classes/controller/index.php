<?php

class Controller_Index extends Controller_Pages_Base
{
	public function action_index($id=null)
	{
		$page_sections = \Model_Section::query()->where('id', 1)->order_by('order', 'desc')->get()[1];
		
		$_header = array(
			'id' 			=> 'header',
			'class' 		=> 'intro paraxify',
			'content' 		=> '_header_content',
		);
		
		$_footer = array(
			'id' 			=> 'footer',
			'class' 		=> 'footer',
			'content' 		=> '_footer_content',
		);
		
		$_nav = array(
			'id' 			=> 'nav',
			'class' 		=> 'navbar navbar-custom navbar-fixed-top',
			'content' 		=> '_footer_content',
		);
		
		$this->template->set_global('render_nav', $this->theme->get('_nav', $_nav), false);
		$this->template->set_global('render_header', $this->theme->get('_header', $_header), false);
		$this->template->set_global('render_footer', $this->theme->get('_footer', $_footer), false);	
	}
}
