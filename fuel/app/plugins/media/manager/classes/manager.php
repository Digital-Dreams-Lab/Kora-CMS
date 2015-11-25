<?php

namespace Plugin;

class Media_Manager
{	
	public function forge($user_id, $json_sections=null)
	{
		$view = new View;
		$view->path_plugin = PLUGINPATH.'media/manager/';
		
		$data['section']['user_id'] = $user_id;	
		$data['section']['plugin_id'] = 1;
		$data['json_sections'] = $json_sections;
		
		echo $view->render_plugin('view', $data);
	}	
	public function factory($user_id)
	{
		$view = new View;
		$view->path_plugin = PLUGINPATH.'media/manager/';
		
		$data['section']['user_id'] = $user_id;	
		$data['section']['plugin_id'] = 1;
		
		echo $view->render_plugin('index', $data);
	}
}

