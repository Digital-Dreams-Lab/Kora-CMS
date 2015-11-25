<?php

namespace Plugin\Editor;

class Editor_Linecontrol extends Editor_Linecontrol_Base
{	  
	public function __construct($data, $vars=null)
	{	
		parent::__construct($data, $vars=null);
	}
	
	public function action_edit()
	{		
		echo $this->view->render('edit');
	}
	
	public function action_create()
	{
		echo $this->view->render('create');
	}
}

