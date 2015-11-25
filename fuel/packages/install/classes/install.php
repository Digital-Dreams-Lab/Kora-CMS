<?php
/**
 * FuelPHP Auto-Installer Package
 *
 * Simple frontend Auto-Installer.
 *
 * @package    Install
 * @version    1.0
 * @author     Isiaha Barlow
 * @license    MIT License
 * @copyright  2015 Digital Dreams Lab Ltd
 * @link       http://digitaldreamslab.co.nz
 */
 
namespace Install;
/*
use Fuel\Core\Package;
use Fuel\Core\Fuel;
use Fuel\Core\View;
use Fuel\Core\Config;
*/
class Install
{
	/**
	 * @var  array  Holds defaults from config file.
	 */
	protected static $_defaults;
		
	/**
	 * @var  array  Holds dsn for database.
	 */
	protected static $_dsn;
	
	/**
	 * @var  array  Holds the list of loaded tables.
	 */
	protected static $_tables;
	
	/**
	 * @var  array  Holds the list of files for autoloader.
	 */
	protected static $_autoload;
	
	/**
	 * @var  array  Holds the list of migration files.
	 */
	protected static $_migrations;
	
	/**
	 * @var  array  Holds the list of loaded files.
	 */
	protected static $_files;
	
	/**
	 * @var  string  Holds directory path.
	 */
	protected static $_directory;
	
	/**
	 * @var  array  Holds the list of loaded files.
	 */
	public static $_filelist;

	/**
	 * @var  array  Holds flash data for Session::set_flash().
	 */
	public static $_flash;
	
	/**
	 * @var  array  Holds the list of loaded files.
	 */
	public static $_filechecks;
	public static $_tablechecks;
	public static $_dbchecks;

	public static function _init()
	{
		\Config::load('install');
		
		// Set default settings for static usage
		static::$_defaults = \Config::get('defaults');
	}
	
	/**
	 * Various get static vars functions
	 *
	 * @return	mixed		
	 */
	public static function get_filechecks() { return static::$_filechecks; }
	public static function get_tablechecks() { return static::$_tablechecks; }
	public static function get_dbchecks() { return static::$_dbchecks; }
	public static function get_filelist() { return static::$_filelist; }
	
	/**
	 * Get static vars flash
	 *
	 * @return	mixed		
	 */
	public static function get_flash()
	{	
		if (isset(static::$_flash['success']))
		{
			\Session::set_flash('success', "<strong>Success:</strong><br>".implode('<br>', static::$_flash['success']));
		}
		
		if (isset(static::$_flash['error']))
		{
			\Session::set_flash('error', "<strong>Error:</strong><br>".implode('<br>', static::$_flash['error']));
		}
	}
	
	/**
	 * Get table list from database
	 *
	 * @param	string	$dsn		dsn.
	 * @access  public
	 * @return	array				list of tables in database.		
	 */
	public static function get_tables($dsn)
	{
		try
		{
			return \DB::query(static::$_defaults['tables_sql']."'$dsn'")->execute();
		}
							
		catch(\Database_Exception $e) /// fix error message
		{
			static::$_flash['error'][] = $e->getMessage;
		}
			
		static::get_flash();	
	}	

	/**
	 * Check database connection.
	 *
	 * @param	array	$array		post data.
	 * @access  public
	 * @return	bool	true or false	
	 */
	public static function check_database($array=array())
	{	
		\Config::load($array['environment'].'/db');
	
		if($array) {
			$connection = $array['environment'].'.default.connection.';
			static::$_dsn = $array['dsn'];
			\Config::set($connection.'dsn', 'mysql:host='.$array['host'].';dbname='.$array['dsn']);
			\Config::set($connection.'username', $array['username']);
			\Config::set($connection.'password', $array['password']);			
			\Config::save($array['environment'].'/db', $array['environment']);
		}
		
		try
		{
			\Database_Connection::instance()->connect();
			
			static::$_flash['success'][] = "Database connected.";
			
			static::$_dbchecks[] = true;
		}
		
		catch(\Database_Exception $e)
		{
			static::$_flash['error'][] = static::$_defaults['errors'][$e->getCode()];
			
			static::$_dbchecks[] = false;
		}
		
		static::get_flash();
		
		return (in_array(false, static::$_dbchecks)) ? false: true;
	}
	
	/**
	 * Check file requirements.
	 *
	 * @param	array		$paths			paths directories.
	 * @access  protected
	 * @return	bool		true or false	
	 */
	public static function check_requirements($paths=array())
	{	
		foreach($paths as $obj)
		{
			static::$_directory = $obj['path'];
			static::$_files = $obj['files'];
			
			$files = self::append_path_to_file();
			$iterator = new \RecursiveIteratorIterator(
		                new \RecursiveDirectoryIterator(static::$_directory));
			
			foreach($iterator as $fileinfo)
			{		
				if (in_array($fileinfo->getRealPath(), array_keys($files)))
				{					
					$permissions = substr(sprintf('%o', $fileinfo->getPerms()), -4);
					$fileperms = $files[$fileinfo->getRealPath()];
					
					static::$_filechecks[] = $check = ($fileperms == $permissions)? true: false;
					$flash = ($check==true)?'success':'error';
					static::$_flash[$flash][] = ($check==true) ? $fileinfo->getRealPath(): $fileinfo->getRealPath();
					
					static::$_filelist[] = array(
						'path' => $fileinfo->getPath(),
						'file' => $fileinfo->getFilename(),
						'perms' => $fileinfo->getPerms(),
						'check' => $check,
						'permissions' => substr(sprintf('%o', $fileinfo->getPerms()), -4),
						'readable' => $fileinfo->isReadable(),
						'writable' => $fileinfo->isWritable(),
					);
				}
			}
		}		
		static::get_flash();
		
		return (isset(static::$_filelist)) ? true: false;
	}
	
	/**
	 * Append path to file name.
	 *
	 * @return	array		
	 */
	protected static function append_path_to_file()
	{	
		foreach(static::$_files as $keys => $value)
		{
			$return[static::$_directory.DS.$keys] = $value;
		}	
		return $return;
	}


	/**
	 * Check tables, load migration files.
	 *
	 * @param	string		$path			path to migration folder.
	 * @access  public
	 * @return	bool		true or false
	 */
	public static function check_tables()
	{
		if(static::$_migrations)
		{
			foreach(static::$_migrations as $keys => $value)
			{
				$class = new $keys;
				
				if(\DBUtil::table_exists($value))
				{
					static::$_flash['success'][] = "$value table already exists!";
					static::$_tablechecks[] = true;
				}
				
				else
				{					
					try
					{
						$class->up();
				
						static::$_flash['success'][] = "$value table installed!";
						static::$_tablechecks[] = true;
					}
										
					catch(\Database_Exception $e)
					{
						static::$_flash['error'][] = $e->getMessage();
						static::$_tablechecks[] = false;
					}
				}
				unset($class);
			}				
			static::get_flash();
			
			return (in_array(false, static::$_tablechecks)) ? false: true;
		}	
		
		else
		{
			static::$_flash['error'][] = "There are no migration files!";				
			static::get_flash();
			
			return false;
		}
			
	}
	
	/**
	 * Load migration files and set $_migrations array for load_tables.
	 *
	 * @param	string		$path			path to migration folder.
	 * @access  public
	 * @return	bool		true or false
	 */
	public static function load_migrations($array=array())
	{
		$files = new \GlobIterator($array['path'].'*.php');

		foreach($files as $file)
		{
			$filename = $file->getBasename('.php');
			$basename = substr_replace($file->getBasename('.php'), '', 0, 4);
			$class_name = ucfirst($basename);
			$class = str_replace("create_", "", $basename);
			static::$_autoload['Fuel\\Migrations\\'.$class_name] =  $array['path'].$filename.'.php';
			static::$_migrations['Fuel\\Migrations\\'.$class_name] =  $class;
		}		

		\Autoloader::add_classes(static::$_autoload);
		\Autoloader::register();
		
		return true;		
	}
}

?>