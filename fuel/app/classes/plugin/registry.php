<?php

namespace Plugin; 


class Registry
{
    public static $objects;
	
	public static function set_scripts($index,$script) 
	{
		 static::$objects['assets']['scripts'][$index] = $script;
	}
	
	public static function get_scripts($html_entity_decode=true) 
	{
		$scripts =  static::$objects['assets']['scripts'];
		if ($scripts)
		{
			$return = array();
			$return[] = '<script>';
			$return[] = '$(document).ready(function(){';
			
			foreach($scripts as $js)
			{
				$return[] = $js;
			}
			
			$return[] = '});'; 
			$return[] = '</script>';
			if ($html_entity_decode==true)
			{
				$html_entity = implode("\n\n", $return);
				
				return html_entity_decode($html_entity);					
			}
			else
			{
				return implode("\n\n", $return);					
			}
		}
	}  
}