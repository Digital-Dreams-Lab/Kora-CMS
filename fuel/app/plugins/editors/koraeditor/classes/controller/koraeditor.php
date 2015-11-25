<?php

namespace Plugin\Editors;

class Koraeditor extends Koraeditor_Base
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

