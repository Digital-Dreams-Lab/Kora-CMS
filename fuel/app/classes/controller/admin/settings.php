<?php
class Controller_Admin_Settings extends Controller_Admin
{
	public function action_index()
	{
		Config::load('settings');
		
		$form = Config::get('form');
		
		$sql = 'SELECT * FROM `settings` WHERE `id` = 1';
		$query = DB::query($sql)->execute()->as_array();
		$settings  = $query[0];
		
		if (Input::method() == 'POST')
		{
			$post = Input::post();
			$id = $post['id'];
			
			// unset post data
			unset($post['submit'], $post['id'], $post['_wysihtml5_mode']);
			
			$update = implode(', ', array_map(function ($v, $k) { return sprintf("%s='%s'", $k, $v); }, $post, array_keys($post)));
			
			$sql = "UPDATE `settings` SET {$update} WHERE `id` = {$id}";
			
			$query = DB::query($sql)->execute();

			if ($query)
			{
				Session::set_flash('success', e('Website settings updated succesfully!'));
				Response::redirect('admin/settings');
			}
			else
			{
				Session::set_flash('error', e('Could not update settings!'));
			}		
		}

		$timezones_array = static::tz_list();
		
		//print_pre($timezones_array);
		
		$this->template->set_global('settings', $settings, false);
		$this->template->set_global('form', $form, false);	

		$listings_title = array(
			'listings_breadcrumb'   =>'<li>'
									. Kora\Permissions::get_link('admin/dashboard', '', '<i class="fa fa-dashboard fa-fw"></i> Dashboard', 'index')
									. '</li>',		
			'listings_title' 		=> '<i class="fa fa-cog fa-fw"></i> Settings',
			'listings_extra' 		=> '',
		);
		$listings_panel_group = array(
			'panel_id' 			=> 'collapse_listing',
			'panel_parent_id' 	=> 'parent_listing',
			'panel_heading_id' 	=> 'heading_listing',
			'panel_title' 		=> '<i class="fa fa-cog fa-fw"></i> Settings',
			'panel_title_ext' 	=> '',
			'panel_body' 		=> render('admin/settings/_listings'),
		);
		
		$this->template->set_global('listings_title', 		$listings_title, 		false);
		$this->template->set_global('listings_panel_group', $listings_panel_group,	false);
		
		$this->template->title = "Settings";
		$this->template->content = View::forge('admin/settings/index');
	}
	
	
	public function action_basic()
	{
		Config::load('settings');
		
		$form = Config::get('form');
		
		$sql = 'SELECT * FROM `settings` WHERE `id` = 1';
		$query = DB::query($sql)->execute()->as_array();
		$settings  = $query[0];
		
		if (Input::method() == 'POST')
		{
			$post = Input::post();
			$id = $post['id'];
			
			// unset post data
			unset($post['submit'], $post['id'], $post['_wysihtml5_mode']);
			
			$update = implode(', ', array_map(function ($v, $k) { return sprintf("%s='%s'", $k, $v); }, $post, array_keys($post)));
			
			$sql = "UPDATE `settings` SET {$update} WHERE `id` = {$id}";
			
			$query = DB::query($sql)->execute();

			if ($query)
			{
				Session::set_flash('success', e('Website settings updated succesfully!'));
				Response::redirect('admin/settings');
			}
			else
			{
				Session::set_flash('error', e('Could not update settings!'));
			}		
		}

		$timezones_array = static::tz_list();
		
		//print_pre($timezones_array);
		
		$this->template->set_global('settings', $settings, false);
		$this->template->set_global('form', $form, false);
		
		$listings_title = array(
			'listings_breadcrumb'   =>'<li>'
									. Kora\Permissions::get_link('admin/dashboard', '', '<i class="fa fa-dashboard fa-fw"></i> Dashboard', 'index')
									. '</li>'
									. '<li>'
									. Kora\Permissions::get_link('admin/settings', '', '<i class="fa fa-cog fa-fw"></i> Settings', 'index')
									. '</li>',		
			'listings_title' 		=> '<i class="fa fa-wrench fa-fw"></i> Basic settings',
			'listings_extra' 		=> '',
		);
		$listings_panel_group = array(
			'panel_id' 			=> 'collapse_listing',
			'panel_parent_id' 	=> 'parent_listing',
			'panel_heading_id' 	=> 'heading_listing',
			'panel_title' 		=> '<i class="fa fa-wrench fa-fw"></i> Basic settings',
			'panel_title_ext' 	=> '',
			'panel_body' 		=> render('admin/settings/_basic'),
		);
		
		$this->template->set_global('listings_title', 		$listings_title, 		false);
		$this->template->set_global('listings_panel_group', $listings_panel_group,	false);
		
		$this->template->title = "Settings";
		$this->template->content = View::forge('admin/settings/index');
	}	
		
	public function action_advanced()
	{
		Config::load('settings');
		
		$form = Config::get('form');
		
		$sql = 'SELECT * FROM `settings` WHERE `id` = 1';
		$query = DB::query($sql)->execute()->as_array();
		$settings  = $query[0];
		
		$timezone_array = static::tz_list();
		
		$this->template->set_global('timezone_array', $timezone_array, false);
		
		if (Input::method() == 'POST')
		{
			$post = Input::post();
			$id = $post['id'];
			unset($post['submit'], $post['id'], $post['_wysihtml5_mode']);
			
			$update = implode(', ', array_map(function ($v, $k) { return sprintf("%s='%s'", $k, $v); }, $post, array_keys($post)));
			
			$sql = "UPDATE `settings` SET {$update} WHERE `id` = {$id}";
			
			$query = DB::query($sql)->execute();

			if ($query)
			{
				Session::set_flash('success', e('Website settings updated succesfully!'));
				Response::redirect('admin/settings');
			}
			else
			{
				Session::set_flash('error', e('Could not update settings!'));
			}	
				
		}

		$this->template->set_global('settings', $settings, false);
		$this->template->set_global('form', $form, false);
		
		$listings_title = array(
			'listings_breadcrumb'   =>'<li>'
									. Kora\Permissions::get_link('admin/dashboard', '', '<i class="fa fa-dashboard fa-fw"></i> Dashboard', 'index')
									. '</li>'
									. '<li>'
									. Kora\Permissions::get_link('admin/settings', '', '<i class="fa fa-cog fa-fw"></i> Settings', 'index')
									. '</li>',		
			'listings_title' 		=> '<i class="fa fa-cogs fa-fw"></i> Advanced settings',
			'listings_extra' 		=> '',
		);
		$listings_panel_group = array(
			'panel_id' 			=> 'collapse_listing',
			'panel_parent_id' 	=> 'parent_listing',
			'panel_heading_id' 	=> 'heading_listing',
			'panel_title' 		=> '<i class="fa fa-cogs fa-fw"></i> Advanced settings',
			'panel_title_ext' 	=> '',
			'panel_body' 		=> render('admin/settings/_advanced'),
		);
		
		$this->template->set_global('listings_title', 		$listings_title, 		false);
		$this->template->set_global('listings_panel_group', $listings_panel_group,	false);
		
		$this->template->title = "Settings";
		$this->template->content = View::forge('admin/settings/index');
	}
	
	
		
	static function tz_list() {
		$timezones_array = array();
		$timestamp = time();
		foreach(timezone_identifiers_list() as $key => $zone) {
			date_default_timezone_set($zone);
			$timezones_array[$key]['zone'] = $zone;
			$timezones_array[$key]['diff_from_GMT'] = 'UTC/GMT ' . date('P', $timestamp);
		}
		return $timezones_array;
	}
}