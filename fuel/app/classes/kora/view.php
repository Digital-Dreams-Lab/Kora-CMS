<?php 

namespace Kora;

class View extends \View
{
	/**
	 * Sets the view filename.
	 *
	 *     $view->set_filename($file);
	 *
	 * @param   string  view filename
	 * @return  View
	 * @throws  FuelException
	 */
	static $theme;
	
	public static function set_theme($theme_path)
	{
		static::$theme = $theme_path;
	}
	
	public function get_theme()
	{
		return static::$theme;
	}
	
	public static function forge_theme($file = null, $data = null, $auto_filter = null)
	{
		return new static($file, $data, $auto_filter);
	}
		
	public function __construct($file = null, $data = null, $filter = null)
	{
		if (is_object($data) === true)
		{
			$data = get_object_vars($data);
		}
		elseif ($data and ! is_array($data))
		{
			throw new \InvalidArgumentException('The data parameter only accepts objects and arrays.');
		}

		$this->auto_filter = is_null($filter) ? \Config::get('security.auto_filter_output', true) : $filter;

		if ($file !== null)
		{
			$this->themes_set_filename($file);
		}

		if ($data !== null)
		{
			// Add the values to the current data
			$this->data = $data;
		}

		// store the current request search paths to deal with out-of-context rendering
		if (class_exists('Request', false) and $active = \Request::active() and \Request::main() !== $active)
		{
			$this->request_paths = $active->get_paths();
		}
		isset($active) and $this->active_request = $active;

		// store the active language, so we can render the view in the correct language later
		$this->active_language = \Config::get('language', 'en');
	}
		 
	public function themes_set_filename($file)
	{
		$theme = $this->get_theme();
		// set find_file's one-time-only search paths	
		\Finder::instance()->add_path(DOCROOT.'themes/'.$theme, -1);
		\Finder::instance()->flash($this->request_paths);
		
		if (($path = \Finder::search('templates', $file, '.'.$this->extension, false, false)) === false)
		{
			var_dump(DOCROOT.'themes/'.$theme);
			//throw new \FuelException('The requested view could not be found: '.\Fuel::clean_path($file));
		}

		// Store the file path locally
		$this->file_name = $path;

		return $this;
		
	}

	/**
	 * Renders the view object to a string. Global and local data are merged
	 * and extracted to create local variables within the view file.
	 *
	 *     $output = $view->render();
	 *
	 * [!!] Global variables with the same key name as local variables will be
	 * overwritten by the local variable.
	 *
	 * @param    string  view filename
	 * @return   string
	 * @throws   FuelException
	 * @uses     static::capture
	 */
	public function render_theme($file = null, $data=null)
	{
		if (is_object($data) === true)
		{
			$data = get_object_vars($data);
		}
		elseif ($data and ! is_array($data))
		{
			throw new \InvalidArgumentException('The data parameter only accepts objects and arrays.');
		}

		if ($data !== null)
		{
			// Add the values to the current data
			$this->data = $data;
		}

		// reactivate the correct request
		if (class_exists('Request', false))
		{
			$current_request = \Request::active();
			\Request::active($this->active_request);
		}

		// store the current language, and set the correct render language
		if ($this->active_language)
		{
			$current_language = \Config::get('language', 'en');
			\Config::set('language', $this->active_language);
		}

		// override the view filename if needed
		if ($file !== null)
		{
			$this->themes_set_filename($file);
		}

		// and make sure we have one
		if (empty($this->file_name))
		{
			throw new \FuelException('You must set the file to use within your view before rendering');
		}

		// combine local and global data and capture the output
		$return = $this->process_file();

		// restore the current language setting
		$this->active_language and \Config::set('language', $current_language);

		// and the active request class
		if (isset($current_request))
		{
			\Request::active($current_request);
		}

		return $return;
	}

}
