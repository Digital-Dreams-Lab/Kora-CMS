<?php
namespace Kora;

class Permissions
{
	static $system_perms;
	static $plugin_perms;
	static $group_level;
	static $user_level;
	
	static public function check($action=null)
	{
		if ($action==null)
		{
			return Permissions::check_viewable();
		}
		
		else
		{
			return Permissions::check_action($action);
		}		
	}


		
	static public function check_action($action)
	{	
		$request = isset(\Request::active()->route->segments[1])? \Request::active()->route->segments[1]: null;
		
		if (isset(static::$system_perms[$request][$action]) && static::$system_perms[$request][$action]=='1')
		{
			return true;		
		}
		
		else
		{
			return false;		
		}
	}
		
	static public function check_group_level($level)
	{			
		if (static::$group_level <= $level)
		{
			return true;		
		}
		
		else
		{
			return false;		
		}
	}	
		
	static public function check_user_level($level)
	{			
		if (static::$user_level <= $level)
		{
			return true;		
		}
		
		else
		{
			return false;		
		}
	}	
	
	static public function check_viewable()
	{	
		if ($group = \Model_Group::find(\Auth::get('group')))
		{			
			static::$system_perms = unserialize($group->system_perms);
			static::$plugin_perms = unserialize($group->plugin_perms);
			static::$group_level = $group->level;
			static::$user_level = \Auth::get('level');
			
			// admin/ /pages /view
			$request_controller	 	= isset(\Request::active()->route->segments[1])? \Request::active()->route->segments[1]: null;
			$request_action 		= isset(\Request::active()->route->action)? \Request::active()->route->action: null;
			$view					= (isset(static::$system_perms[$request_controller]['view']) && static::$system_perms[$request_controller]['view']==1) ? true: false;			
						
			// Check if page is called and view permissions from system_perms array
			if ($request_controller!==null && $view)
			{
				$request_permission = isset(static::$system_perms[$request_controller][$request_action]) ? static::$system_perms[$request_controller][$request_action]: null;
				// check view, delete, edit, create permissions
				if ($request_permission!==null && $request_permission=='0')
				{	
					return false;
				}
				return true;
			} 
			
			else 
			{
				return false;
			}
			return true;
		}
		
		else 
		{
			return false;
		}	
	}


	
	static public function get_user_level() {
		return static::$user_level;
	}
	
	static public function get_group_level() {
		return static::$group_level;
	}
	
	static public function get_plugins($action)
	{
		if (Permissions::check_action($action))
		{		
			$_plugins = \Arr::assoc_to_keyval(\Model_Plugin::find('all'), 'id', 'name');
			$object = array();
			$plugin_perms = static::$plugin_perms;
			
			//var_dump(static::$plugin_perms);
			
			foreach ($plugin_perms as $plugin_id => $plugins)
			{
				foreach ($plugins as $plugin => $val)
				{
					if ($val=='1')
					{
						$object[$plugin_id] = \Inflector::humanize($plugin);
					}
				}
			}
			return $object;
		}
	}
	
	static public function get_modules($action)
	{	
	}
	
	static public function get_link($url, $id, $title, $action, $attr=false, $level=null)
	{	
		$link ='';	
		
		$request = isset(\Request::active()->route->segments[1])? \Request::active()->route->segments[1]: null;
		
		if ($action=='index')
		{		
			$link = \Html::anchor($url.'/'.$action, $title, $attr); 
		}
		else
		{
			if ($level!==null)
			{
				if (static::check_group_level($level))
				{
					if (isset(static::$system_perms[$request][$action]) && static::$system_perms[$request][$action]=='1')
					{
						$link = \Html::anchor($url.'/'.$action.'/'.$id, $title, $attr); 
					}
					else
					{
						$link = $title;
					}			
				}
				else
				{	
					$link = html_tag('span', $attr, '<i class="fa fa-exclamation-triangle"></i> Access level denied!');
				}
			}
			else
			{
				if (isset(static::$system_perms[$request][$action]) && static::$system_perms[$request][$action]=='1')
				{
					$link = \Html::anchor($url.'/'.$action.'/'.$id, $title, $attr); 
				}
				else
				{
					$link = $title;
				}
			}
		}		
		return $link;
	}
	
	static public function get_link_check($route, $controller, $action, $id, $title, $attr=false)
	{	
		$link ='';	
		// admin/ /pages /view
		$request = isset(\Request::active()->route->segments[1])? \Request::active()->route->segments[1]: null;
		
		if ($action=='index')
		{		
			$link = \Html::anchor($url.'/'.$action, $title, $attr); 
		}
		
		else
		{	
			$link = '';
		}		
		return $link;
	}
	
	
	static public function get_link_group_level($url, $id, $title, $action, $level, $attr=false)
	{	
		if (static::check_user_level($level))
		{
			if ($action=='index')
			{		
				$link = \Html::anchor($url.'/'.$action, $title, $attr); 
			}
			
			else
			{	
				$link = $title;
			}		
			return $link;
		}
		else
		{
			return '<i class="fa fa-warning"></i> '.$title;		
		}
	}
	
		
	static public function get_buttons($url, $id, $modal=null)
	{		
		// admin/ /pages /view
		$request = isset(\Request::active()->route->segments[1])? \Request::active()->route->segments[1]: null;
		$system_perms = static::$system_perms[$request];
		$links = array();
		
		if (isset($system_perms['view']) && $system_perms['view']=='1')
		{
			if($modal!==null)
			{
				$links[] = \Html::anchor($url.'/view/'.$id, '<span class="btn btn-xs btn-info" '.$modal.' data-toggle="tooltip" data-placement="top" title="View item."><i class="fa fa-eye fa-fw"></i></span>'); 
			}
			else
			{
				$links[] = \Html::anchor($url.'/view/'.$id, '<span class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="View item."><i class="fa fa-eye fa-fw"></i></span>'); 
        	}		
		}
		if (isset($system_perms['edit']) && $system_perms['edit']=='1')
		{		
			$links[] = \Html::anchor($url.'/edit/'.$id, '<span class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top" title="Edit item."><i class="fa fa-edit fa-fw"></i></span>');
		}
		if (isset($system_perms['delete']) && $system_perms['delete']=='1')
		{	
        	$links[] = \Html::anchor($url.'/delete/'.$id, '<span class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Delete item."><i class="fa fa-trash fa-fw"></i></span>', array('onclick' => "return confirm('Are you sure you want to delete this?')"));
		}
		
		return implode(' ', $links);
	}

}