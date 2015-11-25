<?php

namespace Kora;


class Themer
{
	static $wrapper_start;
	static $wrapper_end;
	static $theme_path;
	static $view;

	static public function set_theme($theme, $layout)
	{
		static::$theme_path = DOCROOT."themes/{$theme}/templates/html/{$layout}/";
	}
		
	static public function get($component, $array=array())
	{
		// $array = color, icon, number, title, link, footer
		$file = static::$theme_path.$component.'.html';
		
		switch ($component)
		{
			case "$component";
				$contents = file_get_contents($file);
				break;
	
		}
		
		foreach ($array as $key => $value)
		{ 
			$contents = str_replace('{{'.$key.'}}', $value, $contents);
		}
		return $contents;
	}
	
	static public function set_wrapper($component)
	{
		$file = static::$theme_path.$component.'.html';
		
		switch ($component)
		{
			case "$component";
				$contents = file_get_contents($file);
				break;
		}
		if(preg_match("/{{wrapper_start}}(.*){{wrapper_start}}/", 	$contents, $wrapper_start))
		{
			static::$wrapper_start 	= $wrapper_start[1];
		}
		
		if(preg_match("/{{wrapper_end}}(.*){{wrapper_end}}/", 		$contents, $wrapper_end))
		{
			static::$wrapper_end 	= $wrapper_end[1];
		}
	}
	
	static public function start_wrapper($array)
	{
		$contents = static::$wrapper_start;	
		foreach ($array as $key => $value)
		{ 
			$contents = str_replace('{{'.$key.'}}', $value, $contents);
		}
		return $contents;
	}
	
	static public function end_wrapper()
	{
		return static::$wrapper_end;	
	}
}