<?php 

namespace Plugin;

class Bootloader
{
	public static $file_list;
		
	public static function forge()
	{
		$iter = new \RecursiveIteratorIterator(
		new \RecursiveDirectoryIterator(PLUGINPATH, \RecursiveDirectoryIterator::SKIP_DOTS),
			\RecursiveIteratorIterator::SELF_FIRST // Ignore "Permission denied"
		);
		
		foreach ($iter as $path => $obj) {
			if ($obj->isFile() && $obj->getFilename() == 'bootstrap.php') 
			{
				static::$file_list[] =  $obj->getRealPath();
				
				$bootstrap_file = $obj->getRealPath();
				
				require ($bootstrap_file);
			}
		}
		
	}
}