<?php

namespace Plugin;

class Loader
{
	public $json_media;
	
	public function forge($data, $edit_by_section_only=true)
	{		
		$this->_data = $data;
		$this->_data['edit_by_section_only'] = $edit_by_section_only;
		
		$this->setplugin();
		$this->setassets();
		$this->setdefaults();
		$this->setsection();
		
		$this->setrequest(); // hack \Request
		
		return $this->data;
	}
	
	public function setdefaults()
	{
		Config::load($this->data['plugin']['path_config']); // hack \Config::load(absolute_path)
		$this->data['defaults'] = \Config::get('defaults'); 		
	}
	
	public function setassets()
	{
		Assets::forge($this->data['plugin']['path_assets']);
	}
	
	public function getmedia()
	{
		return \Format::forge($this->json_media['media'])->to_json();
	}
			
	public function setplugin()
	{
		$plugin 								  = \Model_Plugin::find($this->_data['plugin_id']);
		
		$this->data['class'] 					  = \Inflector::words_to_upper('Plugin').'\\'.
													\Inflector::words_to_upper($plugin->namespace).'\\'.
													\Inflector::words_to_upper($plugin->plugin_name);
		$this->data['plugin']['plugin_namescape'] = \Inflector::words_to_upper($plugin->namespace).'\\'.
													\Inflector::words_to_upper($plugin->plugin_name);
		$this->data['plugin']['plugin_name'] 	  = \Inflector::words_to_upper($plugin->plugin_name);
		$this->data['plugin']['path_plugin'] 	  = PLUGINPATH.$plugin->path.DS;
		$this->data['plugin']['path_assets'] 	  = PUBPLUGINPATH.$plugin->path.DS.'assets'.DS;
		$this->data['plugin']['path_classes']	  = PLUGINPATH.$plugin->path.DS.'classes'.DS;
		$this->data['plugin']['path_config'] 	  = PLUGINPATH.$plugin->path.DS.'config'.DS;
		$this->data['plugin']['path_views']  	  = PLUGINPATH.$plugin->path.DS.'views'.DS;
		$this->data['plugin']['ele_id'] 		  = $plugin->plugin_name.'_'.$this->_data['id'];
		
		if ($plugin->type=='1') 
		{
			$this->_data['ele_id'] = $plugin->plugin_name.'_'.$this->_data['id'];
			$this->json_media['media'][$this->_data['id']] = Media::forge($this->_data);
		}
	}	

	public function setrequest()
	{
		$this->data['request'] = Request::forge();
	}	

	public function setsection()
	{
		$section = new Section($this->_data);
		$this->data['section'] = $section;
	}	

	public function setpage()
	{
		$this->data['page'] = Page::forge($this->_data['page_id']);
	}

}
