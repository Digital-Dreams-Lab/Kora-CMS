<?php
namespace Plugin;

class Settings
{	
	private $property;
	
	public static  function __get($property) {
		if (property_exists($this, $property)) {
			return $this->$property;
		}
	}
	
	public static  function __set($property, $value) {
		if (property_exists($this, $property)) {
			$this->$property = $value;
		}	
	}
	
	
	public static function read($config, $plugin) {
		
		foreach ($this->$property as $key => $value)
		{
			\Form::input($key, $key, $value);
		}
	}
	
	public static function output() {
		
		foreach ($this->$property as $key => $value)
		{
			\Form::input($key, $key, $value);
		}
	}

}