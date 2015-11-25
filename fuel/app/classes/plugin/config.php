<?php

namespace Plugin;

class Config extends Finder
{
	public static $config;
	
	public static function load($file)
	{
		\Config::load($file);
	}
	
	public static function get($file)
	{
		\Config::get($file);
	}
}
