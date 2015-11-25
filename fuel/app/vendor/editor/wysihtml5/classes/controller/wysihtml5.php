<?php

namespace Plugin\Editor;

class Wysihtml5 extends Wysihtml5_Base
{	
	public function action_edit()
	{		
		$this->content = $this->view->render_plugin('edit', $this->_data);
	}
	
	public function action_create()
	{
		echo $this->view->render_plugin('create', $this->_data);
	}
	
	public function action_settings()
	{
		echo $this->view->render_plugin('settings', $this->_data);
	}
}

