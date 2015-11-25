<?php 
namespace Plugin;

class Assets
{

	public static $scripts = array();
	
	public static function forge($startpath)
	{
		if (realpath($startpath))
		{		
			$iter = new \RecursiveIteratorIterator(
					new \RecursiveDirectoryIterator($startpath, 
						\RecursiveDirectoryIterator::SKIP_DOTS),
						\RecursiveIteratorIterator::SELF_FIRST);
	
			$paths = array($startpath);
			$return = array();
			foreach ($iter as $path => $obj)
			{
				if (
					strpos($path, 'locale') or
					strpos($path, 'locales') or
					strpos($path, 'calls') or
					strpos($path, 'vendor') or
					strpos($path, 'hide') or
					strpos($path, 'img') or
					strpos($path, 'src') or
					strpos($path, 'fonts') ) {}
				
				elseif (strpos($path, 'assets'))
				{
					if ($obj->isFile()) 
					{	
						Registry::$objects['assets'][$obj->getExtension()]['paths'][$obj->getPath()] = $obj->getPath();
						Registry::$objects['assets'][$obj->getExtension()]['files'][$obj->getBasename()] = $obj->getBasename();
					}
				}
			}
		}
	}

	public static function css($array)
	{
		if (isset($array['assets']['css']))
		{		
			foreach ($array['assets']['css']['paths'] as $path)
			{
				\Asset::add_path($path, 'css');
			}
			foreach ($array['assets']['css']['files'] as $css)
			{
				echo \Asset::css($css);	
			}
		}
	}
	
	public static function js($array)
	{
		if (isset($array['assets']['js']))
		{			
			foreach ($array['assets']['js']['paths'] as $path)
			{
				\Asset::add_path($path, 'js');
			}
			foreach ($array['assets']['js']['files'] as $js)
			{
				echo \Asset::js($js);	
			}
		}
	}
}