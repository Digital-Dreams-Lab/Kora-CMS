<?php

namespace Plugin;

class Request
{
	public static $action_params = array('page_id','section_id','plugin_id','block_id','action');
	public static $data;
	
	
	public static function forge()
	{
		static::$data['action'] = \Request::active()->action;
		static::$data['controller'] = \Request::active()->controller;
		static::$data['method'] = \Request::active()->get_method();
		static::$data['method_params'] = \Request::active()->method_params;
		
		Request::reset_actions();
		
		return static::$data;
	}	
	
	public static function reset_actions()
	{
		$array = static::$data['method_params'];
		
		$output = (null!==array_slice($array, 5))?array_slice($array, 5):''; 		
		
		foreach (static::$action_params as $key => $value)
		{
			static::$data['params'][static::$action_params[$key]] = (isset($array[$key])) ? $array[$key]: '';
		}		

		static::$data['params_extra'] = $output;
	}	
}
