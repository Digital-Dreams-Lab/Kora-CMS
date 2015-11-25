<?php
class Controller_Admin_Plugins extends Controller_Admin
{

	public function action_index()
	{
	
		if (Input::method() == 'POST') 
		{
			$this->upload_plugin();		
		}	
		$this->template->set_global('plugins', 				Model_Plugin::find('all'), 	false);
			
		$create_panel_group = array(
			'panel_id' 			=> 'collapse_create',
			'panel_parent_id' 	=> 'parent_index',
			'panel_heading_id' 	=> 'heading_index',
			'panel_title' 		=> '<i class="fa fa-upload fa-fw"></i> Install new plugin',
			'panel_title_ext' 	=> '',
			'panel_body' 		=> render('admin/plugins/_create'),
		);
		$listings_panel_group = array(
			'panel_id' 			=> 'collapse_listing',
			'panel_parent_id' 	=> 'parent_listing',
			'panel_heading_id' 	=> 'heading_listing',
			'panel_title' 		=> '<i class="fa fa-plug fa-fw"></i> Plugins',
			'panel_title_ext' 	=> '',
			'panel_body' 		=> render('admin/plugins/_listings'),
		);
		$listings_title = array(
			'listings_breadcrumb'   =>'<li>'
									. Kora\Permissions::get_link('admin/dashboard', '', '<i class="fa fa-dashboard fa-fw"></i> Dashboard', 'index')
									. '</li>'
									. '<li>'
									. Kora\Permissions::get_link('admin/addons', '', '<i class="fa fa-puzzle-piece fa-fw"></i> Add-ons', 'index')
									. '</li>',		
			'listings_title' 		=> '<i class="fa fa-plug fa-fw"></i> Plugins',
			'listings_extra' 		=> '',
		);
		
		$this->template->set_global('listings_title', 		$listings_title, 			false);
		$this->template->set_global('create_panel_group', 	$create_panel_group,		false);
		$this->template->set_global('listings_panel_group', $listings_panel_group,		false);
		$this->template->title = "Plugins";
		$this->template->content = View::forge('admin/plugins/index');
	}

	public function upload_plugin()
	{
		if (Input::method() == 'POST')
		{		
			$config = array(
				'path' => APPPATH.'tmp/plugins',
				'randomize' => false,
				'ext_whitelist' => array('zip'),
			);
			
			Upload::process($config);
			
			if (Upload::is_valid())
			{
				Upload::save();
				
				$upload = Upload::get_files();
				var_dump($upload);
				
				$zip_file = $upload[0]['saved_to'].$upload[0]['saved_as'];
				var_dump($zip_file);
				
				$zip = new ZipArchive();
				
				if ($zip->open($zip_file) === TRUE)
				{	
					$filedata = array();				
					$installfile = '';
					for($i = 0; $i < $zip->numFiles; $i++) {
						$filedata['filename'][$i] = $zip->getNameIndex($i);
						$filedata['fileinfo'][$i] = pathinfo($filedata['filename'][$i]);
						if (strpos($filedata['filename'][$i], '/config/install.php'))
						{
							$installfile = PLUGINPATH.$filedata['filename'][$i];
						}
						if (strpos($filedata['filename'][$i], 'bootstrap.php'))
						{
							$plugin_path = $filedata['fileinfo'][$i]['dirname'];
						}
						
					}  
					
					$zip->extractTo(PLUGINPATH);		
													
					$zip->close();
					
					if (File::exists($installfile)) 
					{
						Config::load($installfile);
						
						$installcfg 				= Config::get('plugin');
						
						$installcfg['path'] 		= $plugin_path;
						$installcfg['plugin_path'] 	= $plugin_path;
						
						var_dump($installcfg);
						var_dump($filedata);
						
						//unlink($zip_file);
						//*/
						// $val = Model_Plugin::validate('create');
						// call a model method to update the database
						$plugin = Model_Plugin::forge($installcfg);
		
						if ($plugin and $plugin->save())
						{
							Session::set_flash('success', e('Added plugin #'.$plugin->id.'.'));
	
							//Response::redirect('admin/plugins');
						}
		
						else
						{
							Session::set_flash('error', e('Could not save plugin.'));
						}
						//*/
						
					}
				}
				else
				{
					var_dump( 'failed' );
				}
				//\Model_Uploads::add();
			}
			
			// and process any errors
			foreach (\Upload::get_errors() as $file)
			{
				// $file is an array with all file information,
				// $file['errors'] contains an array of all error occurred
				// each array element is an an array containing 'error' and 'message'
				Session::set_flash('error', e(var_dump($file['errors'])));
			}
		}
	}

	public function extract_dir($zipfile, $path, $folder)
	{
		if (file_exists($zipfile))
		{
			$files = array();
			$zip = new ZipArchive;
		
			if ($zip->open($zipfile) === TRUE)
			{
				for($i = 0; $i < $zip->numFiles; $i++)
				{
					$entry = $zip->getNameIndex($i);
					//Use strpos() to check if the entry name contains the directory we want to extract
					if (strpos($entry, $folder))
					{
						//Add the entry to our array if it in in our desired directory
						$files[] = $entry;
					}
				}
				//Feed $files array to extractTo() to get only the files we want
				if ($zip->extractTo($path, $files) === TRUE)
				{
					return TRUE;
				}

				else
				{
					return FALSE;
				}

				$zip->close();
			}

			else
			{
				return FALSE;
			}
		}
		else
		{
			return FALSE;
		}
	}

	public function action_view($id = null)
	{
		$plugin = Model_Plugin::find($id);
		$this->template->set_global('plugin', 		$plugin, 		false);
		
		$view_panel_group = array(
			'panel_id' 			=> 'collapse_view',
			'panel_parent_id' 	=> 'parent_view',
			'panel_heading_id' 	=> 'heading_view',
			'panel_title' 		=> '<i class="fa fa-search fa-fw"></i> View plugin',
			'panel_title_ext' 	=> '',
			'panel_body' 		=> render('admin/plugins/_view'),
		);
		$listings_title = array(
			'listings_breadcrumb'   =>'<li>'
									. Kora\Permissions::get_link('admin/dashboard', '', '<i class="fa fa-dashboard fa-fw"></i> Dashboard', 'index')
									. '</li>'
									. '<li>'
									. Kora\Permissions::get_link('admin/addons', '', '<i class="fa fa-puzzle-piece fa-fw"></i> Add-ons', 'index')
									. '</li>'
									. '<li>'
									. Kora\Permissions::get_link('admin/plugins', '', '<i class="fa fa-plug fa-fw"></i> Plugins', 'index')
									. '</li>',		
			'listings_title' 		=> '<i class="fa fa-search fa-fw"></i> View plugin #'.$id,
			'listings_extra' 		=> '',
		);
		
		$this->template->set_global('listings_title', 		$listings_title, 		false);
		$this->template->set_global('view_panel_group',		$view_panel_group,		false);
		
		$this->template->title = "Plugin";
		$this->template->content = View::forge('admin/plugins/view');
	}

	public function action_create()
	{
		if (Input::method() == 'POST') 
		{
			$this->upload_plugin();		
		}	
		$this->template->set_global('plugins', 				Model_Plugin::find('all'), 	false);
			
		$create_panel_group = array(
			'panel_id' 			=> 'collapse_create',
			'panel_parent_id' 	=> 'parent_index',
			'panel_heading_id' 	=> 'heading_index',
			'panel_title' 		=> '<i class="fa fa-upload fa-fw"></i> Install new plugin',
			'panel_title_ext' 	=> '',
			'panel_body' 		=> render('admin/plugins/_create'),
		);
		$listings_title = array(
			'listings_breadcrumb'   =>'<li>'
									. Kora\Permissions::get_link('admin/dashboard', '', '<i class="fa fa-dashboard fa-fw"></i> Dashboard', 'index')
									. '</li>'
									. '<li>'
									. Kora\Permissions::get_link('admin/addons', '', '<i class="fa fa-puzzle-piece fa-fw"></i> Add-ons', 'index')
									. '</li>'
									. '<li>'
									. Kora\Permissions::get_link('admin/plugins', '', '<i class="fa fa-plug fa-fw"></i> Plugins', 'index')
									. '</li>',		
			'listings_title' 		=> '<i class="fa fa-upload fa-fw"></i> Install new plugin',
			'listings_extra' 		=> '',
		);
		
		$this->template->set_global('listings_title', 		$listings_title, 			false);
		$this->template->set_global('create_panel_group', 	$create_panel_group,		false);
		$this->template->title = "Plugins";
		$this->template->content = View::forge('admin/plugins/create');

	}

	public function action_edit($id = null)
	{
		$plugin = Model_Plugin::find($id);
		$val = Model_Plugin::validate('edit');

		if ($val->run())
		{
			$plugin->active = Input::post('active');
			$plugin->status = Input::post('status');
			$plugin->type = Input::post('type');
			$plugin->version = Input::post('version');

			if ($plugin->save())
			{
				Session::set_flash('success', e('Updated plugin #' . $id));

				Response::redirect('admin/plugins');
			}

			else
			{
				Session::set_flash('error', e('Could not update plugin #' . $id));
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$plugin->active = $val->validated('active');
				$plugin->status = $val->validated('status');
				$plugin->type = $val->validated('type');
				$plugin->version = $val->validated('version');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('plugin', $plugin, false);
		}
					
		$edit_panel_group = array(
			'panel_id' 			=> 'collapse_edit',
			'panel_parent_id' 	=> 'parent_edit',
			'panel_heading_id' 	=> 'heading_edit',
			'panel_title' 		=> '<i class="fa fa-edit fa-fw"></i> Edit plugin #'.$id,
			'panel_title_ext' 	=> '',
			'panel_body' 		=> render('admin/plugins/_edit'),
		);
		$view_panel_group = array(
			'panel_id' 			=> 'collapse_view',
			'panel_parent_id' 	=> 'parent_view',
			'panel_heading_id' 	=> 'heading_view',
			'panel_title' 		=> '<i class="fa fa-search fa-fw"></i> View plugin #'.$id,
			'panel_title_ext' 	=> '',
			'panel_body' 		=> render('admin/plugins/_view'),
		);
		$listings_title = array(
			'listings_breadcrumb'   =>'<li>'
									. Kora\Permissions::get_link('admin/dashboard', '', '<i class="fa fa-dashboard fa-fw"></i> Dashboard', 'index')
									. '</li>'
									. '<li>'
									. Kora\Permissions::get_link('admin/addons', '', '<i class="fa fa-puzzle-piece fa-fw"></i> Add-ons', 'index')
									. '</li>'
									. '<li>'
									. Kora\Permissions::get_link('admin/plugins', '', '<i class="fa fa-plug fa-fw"></i> Plugins', 'index')
									. '</li>',		
			'listings_title' 		=> '<i class="fa fa-edit fa-fw"></i> Edit plugin #'.$id,
			'listings_extra' 		=> '',
		);
		
		$this->template->set_global('listings_title', 		$listings_title, 		false);
		$this->template->set_global('edit_panel_group', 	$edit_panel_group,		false);
		$this->template->set_global('view_panel_group',		$view_panel_group,		false);

		$this->template->title = "Plugins";
		$this->template->content = View::forge('admin/plugins/edit');

	}

	public function action_delete($id = null)
	{
//*
 		if ($plugin = Model_Plugin::find($id))
		{
				
			$pulgin_config = array(
				'path' => PLUGINPATH,
				'randomize' => false,
				'ext_whitelist' => array('zip'),
			);
			$base_config = array(
				'area' => array(
					'basedir'		=> APPPATH.'tmp/',
					'use_locks'		=> true,
				)
			);

			//$dir = PLUGINPATH.$plugin->plugin_path; 
			//die($this->delete_dir($dir));
			//die($dir);
			
			//$plugindir = File_Handler_Directory::forge(PLUGINPATH.$plugin->plugin_path, $pulgin_config);
			//$plugindir->delete();
			
			//$tmpfile = File_Handler_File(APPPATH.'tmp/plugins/'.$plugin->plugin_name.'.zip');
			//$tmpfile->delete();
			
			$plugin->delete();

			Session::set_flash('success', e('Deleted plugin #'.$id));
		}

		else
		{
			Session::set_flash('error', e('Could not delete plugin #'.$id));
		}

		Response::redirect('admin/plugins');
 //*/
	}

	public function delete_dir($dir)
	{
/* 		$files = new RecursiveIteratorIterator(
			new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS),
			RecursiveIteratorIterator::CHILD_FIRST
		);
		
		foreach ($files as $fileinfo) {
			$todo = ($fileinfo->isDir() ? 'rmdir' : 'unlink');
			$todo($fileinfo->getRealPath());
		}
		
		rmdir($dir); */
	}
}
