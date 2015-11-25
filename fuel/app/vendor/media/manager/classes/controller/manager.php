<?php

namespace Plugin\Media;

class Media_Manager extends Media_Manager_Base
{	
	public function action_edit()
	{		
		echo $this->view->render_plugin('edit', $this->_data);
	}
	
	public function action_view()
	{		
		echo $this->view->render_plugin('index', $this->_data);
	}
}

