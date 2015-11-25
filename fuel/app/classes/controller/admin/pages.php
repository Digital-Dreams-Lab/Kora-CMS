<?php
class Controller_Admin_Pages extends Controller_Admin
{
   /*
	* Index action 
	* 
	* @return	list of pages 
	*/
	public function action_index()
	{
		Config::load('pages', 'public');
		
		if (Input::method() == 'POST')
		{
			$this->create_page(Input::post());		
		}
		
		$parents = Arr::assoc_to_keyval(Model_Page::find('all'), 'id', 'title');
		array_unshift($parents, "None");
		// Set globals
		$this->template->set_global('settings', 		Model_Setting::find('all')[1],				false);
		$this->template->set_global('parents', 			$parents,		 							false);	
		$this->template->set_global('pages',			$pages = Model_Page::query()
															->where('status', 0)
															->or_where('status', 1)
															->or_where('status', 2)
															->order_by('parent_id', 'asc')
															->get(),								false);
		// Plugins by permission only
		$this->template->set_global('plugins', 			Kora\Permissions::get_plugins('create'), 	false);
		$this->template->set_global('select_options',	Config::get('public.select'),				false);		

		// Build user group options		
		$model_users = Model_User::find('all');
		foreach($model_users as $row)
		{
			$user_groups[$row->group][$row->id] = $row->username;
		} 

		// Create form select visibility options
		$this->template->set_global('groups',			$groups = Arr::assoc_to_keyval(Model_Group::find('all'), 'id', 'name'),	false);
		$this->template->set_global('user_groups', 		$user_groups,								false);
		$this->template->set_global('users', 			Arr::assoc_to_keyval(Model_User::find('all'), 'id', 'username'),										false);
		// Build pages reference array		
		$db_pages			= DB::select()
							->from('pages')
							->where('status','!=',3)
							->and_where('status','!=',4)
							->execute()
							->as_array();
		if (count($db_pages) > 0) {
			foreach ($db_pages as $row)
			{
				$pages_array[$row['id']] = $row;
			}
			// Build page tree				
			$pagetree_array 	= Arr::assoc_to_keyval($pages, 'id', 'parent_id');
			$parsed_pagetree	= Vendor\Tree::parse($pages_array, $pagetree_array);
			$pagetree			= Vendor\Tree::flatten($parsed_pagetree, 0);
		}
		$this->template->set_global('pagetree', (isset($pagetree)?$pagetree: array()), false);	
				
		$create_panel_group = array(
			'panel_id' 			=> 'collapse_create',
			'panel_parent_id' 	=> 'parent_index',
			'panel_heading_id' 	=> 'heading_index',
			'panel_title' 		=> '<i class="fa fa-plus fa-fw"></i> Create new page',
			'panel_title_ext' 	=> '',
			'panel_body' 		=> render('admin/pages/_create'),
		);
		
		$this->template->set_global('archive_count', 	$archive_count = Model_Page::query()->where('status', 3)->count(), 	false);
		$this->template->set_global('trash_count',		$trash_count = Model_Page::query()->where('status', 4)->count(), 	false);
		
		$archive_link = Kora\Permissions::get_link('admin/pages/archives', '', '<i class="fa fa-archive fa-fw"></i> Archives <span class="">('.$archive_count.')</span>', 'index', array('class'=>'btn btn-xs btn-default'));
		$trash_link = Kora\Permissions::get_link('admin/pages/trash', '', '<i class="fa fa-trash fa-fw"></i> Trash <span class="">('.$trash_count.')</span>', 'index', array('class'=>'btn btn-xs btn-default'));
		
		$listings_panel_group = array(
			'panel_id' 			=> 'collapse_listing',
			'panel_parent_id' 	=> 'parent_listing',
			'panel_heading_id' 	=> 'heading_listing',
			'panel_title' 		=> '<i class="fa fa-files-o fa-fw"></i> Pages',	
			'panel_title_ext' 	=> '<span class="pull-right">'.$archive_link.'  '.$trash_link.'</span>',
			'panel_body' 		=> render('admin/pages/_listings'),
		);
		$listings_title = array(
			'listings_breadcrumb' => '<li>'
								. Kora\Permissions::get_link('admin/dashboard', '', '<i class="fa fa-dashboard fa-fw"></i> Dashboard', 'index')
								. '</li>',	
			'listings_title' => '<i class="fa fa-files-o fa-fw"></i> Pages',				
			'listings_extra' => '',
			//'listings_extra' => Kora\Permissions::get_link('admin/pages', '', '<i class="fa fa-plus fa-fw"></i>  Create new page', 'create', array('class'=>'btn btn-xs btn-success')),
		);
		
		$this->template->set_global('listings_title', 		$listings_title, 		false);
		$this->template->set_global('create_panel_group', 	$create_panel_group,	false);
		$this->template->set_global('listings_panel_group', $listings_panel_group,	false);
		
		$this->template->title 		= "pages";
		$this->template->content 	= View::forge('admin/pages/index');
	}
	
   /*
	* Archive action 
	* 
	* @return	list of pages 
	*/
	public function action_archives()
	{
		Config::load('pages', 'public');
		
		if (Input::method() == 'POST')
		{
			$this->create_page(Input::post());		
		}
		
		$parents = Arr::assoc_to_keyval(Model_Page::find('all'), 'id', 'title');
		array_unshift($parents, "None");
		// Set globals
		$this->template->set_global('settings', 		Model_Setting::find('all')[1],				false);
		$this->template->set_global('parents', 			$parents,		 							false);	
		$this->template->set_global('pages',			$pages = Model_Page::query()
															->where('status', 3)
															->order_by('parent_id', 'asc')
															->get(),								false);
		// Plugins by permission only
		$this->template->set_global('plugins', 			Kora\Permissions::get_plugins('create'), 	false);
		$this->template->set_global('select_options',	Config::get('public.select'),				false);		

		// Build user group options		
		$model_users = Model_User::find('all');
		foreach($model_users as $row)
		{
			$user_groups[$row->group][$row->id] = $row->username;
		} 

		// Create form select visibility options
		$this->template->set_global('groups',			$groups = Arr::assoc_to_keyval(Model_Group::find('all'), 'id', 'name'),	false);
		$this->template->set_global('user_groups', 		$user_groups,								false);
		$this->template->set_global('users', 			Arr::assoc_to_keyval(Model_User::find('all'), 'id', 'username'),										false);
		// Build pages reference array		
		$db_pages			= DB::select()
							->from('pages')
							->execute()
							->as_array();
		if (count($db_pages) > 0) {
			foreach ($db_pages as $row)
			{
				$pages_array[$row['id']] = $row;
			}
			// Build page tree				
			$pagetree_array 	= Arr::assoc_to_keyval($pages, 'id', 'parent_id');
			$parsed_pagetree	= Vendor\Tree::parse($pages_array, $pagetree_array);
			$pagetree			= Vendor\Tree::flatten($parsed_pagetree, 0);
		}
		$this->template->set_global('pagetree', (isset($pagetree)?$pagetree: array()), false);	

		
		$this->template->set_global('archive_count', 	$archive_count = Model_Page::query()->where('status', 3)->count(), 	false);
		$this->template->set_global('trash_count',		$trash_count = Model_Page::query()->where('status', 4)->count(), 	false);
		
		$archive_link = Kora\Permissions::get_link('admin/pages/archives', '', '<i class="fa fa-archive fa-fw"></i> Archives <span class="">('.$archive_count.')</span>', 'index', array('class'=>'btn btn-xs btn-default'));
		$trash_link = Kora\Permissions::get_link('admin/pages/trash', '', '<i class="fa fa-trash fa-fw"></i> Trash <span class="">('.$trash_count.')</span>', 'index', array('class'=>'btn btn-xs btn-default'));
						
		$create_panel_group = array(
			'panel_id' 			=> 'collapse_create',
			'panel_parent_id' 	=> 'parent_index',
			'panel_heading_id' 	=> 'heading_index',
			'panel_title' 		=> '<i class="fa fa-plus fa-fw"></i> Create new page',
			'panel_title_ext' 	=> '',
			'panel_body' 		=> render('admin/pages/_create'),
		);
		$listings_panel_group = array(
			'panel_id' 			=> 'collapse_listing',
			'panel_parent_id' 	=> 'parent_listing',
			'panel_heading_id' 	=> 'heading_listing',
			'panel_title' 		=> '<i class="fa fa-archive fa-fw"></i> Archives',	
			'panel_title_ext' 	=> '<span class="pull-right">'.$archive_link.'  '.$trash_link.'</span>',
			'panel_body' 		=> render('admin/pages/_archives'),
		);
		$listings_title = array(
			'listings_breadcrumb' => '<li>'
								. Kora\Permissions::get_link('admin/dashboard', '', '<i class="fa fa-dashboard fa-fw"></i> Dashboard', 'index')
								. '</li>'
								. '<li>'
								. Kora\Permissions::get_link('admin/pages', '', '<i class="fa fa-files-o fa-fw"></i> Pages', 'index')
								. '</li>',	
			'listings_title' => '<i class="fa fa-archive fa-fw"></i> Archives',				
			'listings_extra' => '',
			//'listings_extra' => Kora\Permissions::get_link('admin/pages', '', '<i class="fa fa-plus fa-fw"></i>  Create new page', 'create', array('class'=>'btn btn-xs btn-success')),
		);
		
		$this->template->set_global('listings_title', 		$listings_title, 		false);
		$this->template->set_global('create_panel_group', 	$create_panel_group,	false);
		$this->template->set_global('listings_panel_group', $listings_panel_group,	false);
		
		$this->template->title 		= "pages";
		$this->template->content 	= View::forge('admin/pages/index');
	}
		
   /*
	* Trash action 
	* 
	* @return	list of pages 
	*/
	public function action_trash($page_id = null)
	{
		Config::load('pages', 'public');
		if ($page_id!==null)
		{
			if ($page = Model_Page::find($page_id))
			{
				$page->status = 4;
				
				if ($page->save())
				{
					Session::set_flash('success', e('Trash page #'.$page_id));
	
					Response::redirect('admin/pages/trash');
				}	
				else
				{
					Session::set_flash('error', e('Could not trash page #'.$page_id));
		
					Response::redirect('admin/pages');
				}
			}
		}
		
		$parents = Arr::assoc_to_keyval(Model_Page::find('all'), 'id', 'title');
		array_unshift($parents, "None");
		// Set globals
		$this->template->set_global('settings', 		Model_Setting::find('all')[1],				false);
		$this->template->set_global('parents', 			$parents,		 							false);	
		$this->template->set_global('pages',			$pages = Model_Page::query()
															->where('status', 4)
															->order_by('parent_id', 'asc')
															->get(),								false);
		// Plugins by permission only
		$this->template->set_global('plugins', 			Kora\Permissions::get_plugins('create'), 	false);
		$this->template->set_global('select_options',	Config::get('public.select'),				false);		

		// Build user group options		
		$model_users = Model_User::find('all');
		foreach($model_users as $row)
		{
			$user_groups[$row->group][$row->id] = $row->username;
		} 

		// Create form select visibility options
		$this->template->set_global('groups',			$groups = Arr::assoc_to_keyval(Model_Group::find('all'), 'id', 'name'),	false);
		$this->template->set_global('user_groups', 		$user_groups,								false);
		$this->template->set_global('users', 			Arr::assoc_to_keyval(Model_User::find('all'), 'id', 'username'),										false);
		// Build pages reference array		
		$db_pages			= DB::select()
							->from('pages')
							->where('status',4)
							->execute()
							->as_array();
		if (count($db_pages) > 0) {
			foreach ($db_pages as $row)
			{
				$pages_array[$row['id']] = $row;
			}
			// Build page tree				
			$pagetree_array 	= Arr::assoc_to_keyval($pages, 'id', 'parent_id');
			$parsed_pagetree	= Vendor\Tree::parse($pages_array, $pagetree_array);
			$pagetree			= Vendor\Tree::flatten($parsed_pagetree, 0);
		}
		$this->template->set_global('pagetree', (isset($pagetree)?$pagetree: array()), false);	
		
		$this->template->set_global('archive_count', 	$archive_count = Model_Page::query()->where('status', 3)->count(), 	false);
		$this->template->set_global('trash_count',		$trash_count = Model_Page::query()->where('status', 4)->count(), 	false);
		
		$archive_link = Kora\Permissions::get_link('admin/pages/archives', '', '<i class="fa fa-archive fa-fw"></i> Archives <span class="">('.$archive_count.')</span>', 'index', array('class'=>'btn btn-xs btn-default'));
		$trash_link = Kora\Permissions::get_link('admin/pages/trash', '', '<i class="fa fa-trash fa-fw"></i> Trash <span class="">('.$trash_count.')</span>', 'index', array('class'=>'btn btn-xs btn-default'));
				
		$create_panel_group = array(
			'panel_id' 			=> 'collapse_create',
			'panel_parent_id' 	=> 'parent_index',
			'panel_heading_id' 	=> 'heading_index',
			'panel_title' 		=> '<i class="fa fa-plus fa-fw"></i> Create new page',
			'panel_title_ext' 	=> '',
			'panel_body' 		=> render('admin/pages/_create'),
		);
		$listings_panel_group = array(
			'panel_id' 			=> 'collapse_listing',
			'panel_parent_id' 	=> 'parent_listing',
			'panel_heading_id' 	=> 'heading_listing',
			'panel_title' 		=> '<i class="fa fa-trash fa-fw"></i> Trash',	
			'panel_title_ext' 	=> '<span class="pull-right">'.$archive_link.'  '.$trash_link.'</span>',
			'panel_body' 		=> render('admin/pages/_trash'),
		);
		$listings_title = array(
			'listings_breadcrumb' => '<li>'
								. Kora\Permissions::get_link('admin/dashboard', '', '<i class="fa fa-dashboard fa-fw"></i> Dashboard', 'index')
								. '</li>'
								. '<li>'
								. Kora\Permissions::get_link('admin/pages', '', '<i class="fa fa-files-o fa-fw"></i> Pages', 'index')
								. '</li>',	
			'listings_title' => '<i class="fa fa-trash fa-fw"></i> Trash',					
			'listings_extra' => '',
			//'listings_extra' => Kora\Permissions::get_link('admin/pages', '', '<i class="fa fa-plus fa-fw"></i>  Create new page', 'create', array('class'=>'btn btn-xs btn-success')),
		);
		
		$this->template->set_global('listings_title', 		$listings_title, 		false);
		$this->template->set_global('create_panel_group', 	$create_panel_group,	false);
		$this->template->set_global('listings_panel_group', $listings_panel_group,	false);
		
		$this->template->title 		= "pages";
		$this->template->content 	= View::forge('admin/pages/index');
	}	
	
	/*
	* Index action 
	* 
	* @return	list of pages 
	*/
	public function action_create()
	{		
		Config::load('pages', 'public');
		
		if (Input::method() == 'POST')
		{
			$this->create_page(Input::post());		
		}
		
		$model_pages 	= Model_Page::find('all');
		$parents 		= array('None');
		
		foreach ($model_pages as $row)
		{
			if ($row->parent_id==0)
			{
				$parents[$row->id]=$row->title;
			}
		}
		$this->template->set_global('parents', 			$parents, 														false);		
		$this->template->set_global('pages', 			Model_Page::find('all'),										false);			
		$this->template->set_global('plugins', 			Kora\Permissions::get_plugins('create'), 						false);
		$this->template->set_global('users', 			Arr::assoc_to_keyval(Model_User::find('all'), 'id', 'username'),false);	
		$this->template->set_global('groups',			Arr::assoc_to_keyval(Model_Group::find('all'), 'id', 'name'),	false);	
		$this->template->set_global('select_options', 	Config::get('public.select'),									false);		
		// Build user group options		
		$model_users = Model_User::find('all');
		foreach($model_users as $row)
		{
			$user_groups[$row->group][$row->id] = $row->username;
		} 
		$this->template->set_global('user_groups', 		$user_groups,													false);					
		
		$listings_panel_group = array(
			'panel_id' 			=> 'collapse_listing',
			'panel_parent_id' 	=> 'parent_listing',
			'panel_heading_id' 	=> 'heading_listing',
			'panel_title' 		=> '<i class="fa fa-plus fa-fw"></i> Create new page',	
			'panel_title_ext' 	=> '',
			'panel_body' 		=> render('admin/pages/_create'),
		);
		$listings_title = array(
			'listings_breadcrumb' => '<li>'
								. Kora\Permissions::get_link('admin/dashboard', '', '<i class="fa fa-dashboard fa-fw"></i> Dashboard', 'index')
								. '</li>'
								. '<li>'
								. Kora\Permissions::get_link('admin/pages', '', '<i class="fa fa-files-o fa-fw"></i> Pages', 'index')
								. '</li>',	
			'listings_title' => '<i class="fa fa-plus fa-fw"></i> Create new page',				
			'listings_extra' => '',
			//'listings_extra' => Kora\Permissions::get_link('admin/pages', '', '<i class="fa fa-plus fa-fw"></i>  Create new page', 'create', array('class'=>'btn btn-xs btn-success')),
		);
		
		$this->template->set_global('listings_title', 		$listings_title, 		false);
		$this->template->set_global('listings_panel_group', $listings_panel_group,	false);
		
		$this->template->title 		= "pages";
		$this->template->content 	= View::forge('admin/pages/create');
	}

   /*
	* View action 
	* 
	* @params	int		$page_id, $section_id
	* @return	array	$sections  
	*/	
	public function action_view($page_id = null)
	{
		$this->template->set_global('page', Model_Page::find($page_id));
	
		$view_panel_group = array(
			'panel_id' 			=> 'collapse_view',
			'panel_parent_id' 	=> 'parent_index',
			'panel_heading_id' 	=> 'heading_index',
			'panel_title' 		=> '<i class="fa fa-search fa-fw"></i> View page <small class="text-muted">Page ID #'.$page_id.'</small>',	
			'panel_title_ext' 	=> '',
			'panel_body' 		=> render('admin/pages/_view'),
		);
		$listings_title = array(
			'listings_breadcrumb' => '<li>'
								. Kora\Permissions::get_link('admin/dashboard', '', '<i class="fa fa-dashboard fa-fw"></i> Dashboard', 'index')
								. '</li>'
								. '<li>'
								. Kora\Permissions::get_link('admin/pages', '', '<i class="fa fa-files-o fa-fw"></i> Pages', 'index')
								. '</li>',	
			'listings_title' => '<i class="fa fa-search fa-fw"></i> View page <small class="text-muted">Page ID #'.$page_id.'</small>',					
			'listings_extra' => '',
			//'listings_extra' => Kora\Permissions::get_link('admin/pages', '', '<i class="fa fa-plus fa-fw"></i>  Create new page', 'create', array('class'=>'btn btn-xs btn-success')),
		);
		$this->template->set_global('listings_title', 		$listings_title, 		false);
		$this->template->set_global('view_panel_group', 	$view_panel_group,	false);
		$this->template->title = "Page";
		$this->template->content = View::forge('admin/pages/view');
	}

   /*
	* Create action 
	* 
	* @params	int		$plugin_id
	* @return	array	$sections  
	*/	
	public function create_page($post)
	{
		$val = Model_Page::validate('create');
		$settings = Model_Setting::find('all')[1];
		if ($val->run())
		{
			/*
			 * NEED TO GET DEFAULT SETTINGS FOR SINGLE PAGE LAYOUTS
			 */		
			$page = Model_Page::forge(array(
				'user_id' 			=> Input::post('user_id'),
				'slug' 				=> Input::post('slug'),
				'title' 			=> Input::post('title'),
				'plugin_id' 		=> Input::post('plugin_id'),
				'parent_id' 		=> Input::post('parent_id'),
				'visibility'		=> Input::post('visibility'),
				'menu_id'			=> Input::post('menu_id', 		1),
				'active'			=> Input::post('active', 		1),
				'status'			=> Input::post('status', 		0),
				'order'				=> Input::post('order', 		0),
				'home_page'			=> Input::post('home_page', 	0),
				'single_page'		=> Input::post('single_page', 	0),
				'single_id'			=> Input::post('single_id', 	''),
				'single_class'		=> Input::post('single_class', 	''),
				'single_layout'		=> Input::post('single_layout', ''),
				'menu_title'		=> Input::post('slug', 			''),
				'meta_title'		=> Input::post('title', 		$settings->website_title),
				'meta_description'	=> Input::post('title', 		$settings->website_description),
				'groups' 			=> implode(',', Input::post('groups',array(1))),
				'users' 			=> implode(',', Input::post('users',array(1))),
				'start_at'			=> Input::post('start_at',		''),
				'end_at'			=> Input::post('end_at', 		''),
			));			
			/*
			 * NEED TO CHECK IF PAGE AND SECTION BOTH SAVED, DON'T SAVE IF CAN'T BOTH 
			 */
			if ($page and $page->save())
			{	
				$section = Model_Section::forge(array(
					'page_id' 		=> $page->id,
					'user_id' 		=> Input::post('user_id'),
					'plugin_id'		=> Input::post('plugin_id',		1), // koraeditor
					'block_id' 		=> Input::post('block_id', 		1), // 
					'blocks_layout'	=> Input::post('blocks_layout', ''),
					'blocks_class'	=> Input::post('blocks_class', 	''),
					'blocks_id'		=> Input::post('blocks_id', 	''),
					'order' 		=> Input::post('order',			0), 
					'content' 		=> Input::post('content', 		''),
					'settings' 		=> Input::post('settings', 		''), 
				));

				if ($section and $section->save())
				{
					Session::set_flash('success', e('Added page #'.$page->id.'.'));					

					Response::redirect('admin/pages/edit/'.$page->id);
				}
	
				else
				{
					Session::set_flash('error', e('Could not create section.'));
				}							
			}

			else
			{
				Session::set_flash('error', e('Could not create page.'));
			}
		}
		else
		{
			Session::set_flash('error', $val->error());
		}

	}

   /*
	* Edit action 
	* 
	* @params	int		$page_id, $section_id
	* @return	array	$sections  
	*/	
	public function action_edit($page_id = null, $section_id = null)
	{		
		Config::load('pages', 'public');
		
        Plugin\Bootloader::forge();

		$page_id = (is_int($page_id) !== null) ? $page_id: 1;
							
		$q_sections = DB::select()->from('sections')->where('page_id', $page_id);
				
		if (is_int($section_id) !== null)
		{
			DB::select()->from('sections')->where('page_id', $page_id)->and_where('id', $section_id)->execute();
			
			View::set_global('edit_by_section_only', false);
			
			if (DB::count_last_query() > 0)
			{
				$q_sections->and_where('id', $section_id);
				
				View::set_global('edit_by_section_only', true);
			}
		}
				
		$sections = $q_sections->order_by('order', 'asc')->execute()->as_array();
		
		$db_parents = DB::select()
						->from('pages')
						->where('id','!=', $page_id)
						->and_where('parent_id','!=', $page_id)
						->execute()
						->as_array();
		
		$parents = array("None");
		foreach ($db_parents as $value)
		{
			$parents[$value['id']] = $value['title'];
		}		
		$loader = new Plugin\Loader;		
		
		$this->template->set_global('users', 			Arr::assoc_to_keyval(Model_User::find('all'), 'id', 'username'),false);	
		$this->template->set_global('groups',			Arr::assoc_to_keyval(Model_Group::find('all'), 'id', 'name'),	false);	
		$this->template->set_global('select_options', 	Config::get('public.select'),									false);		
		// Build user group options		
		$model_users = Model_User::find('all');
		foreach($model_users as $row)
		{
			$user_groups[$row->group][$row->id] = $row->username;
		} 
		$this->template->set_global('user_groups', 		$user_groups,													false);		
		
		

		
		$this->template->set_global('menus', 	Arr::assoc_to_keyval(Model_Menus::find('all'), 'id', 'name'));	
		
		$this->template->set_global('page', 	$page = Model_Page::find($page_id));
		$this->template->set_global('sections', $sections);
		$this->template->set_global('parents', 	$parents);
		$this->template->set_global('page_id', 	$page_id);
		$this->template->set_global('loader', 	$loader);
	    
		$exploded_saved_groups = array_map('trim', explode(',', $page->groups));
        $exploded_saved_users = array_map('trim', explode(',', $page->users));		
		foreach(array_values($exploded_saved_groups) as $v)
		{
			$saved_groups[$v] = $v;
		}
		foreach(array_values($exploded_saved_users) as $v)
		{
			$saved_users[$v] = $v;
		}
		$this->template->set_global('saved_groups', 	$saved_groups,									false);
		$this->template->set_global('saved_users', 		$saved_users,									false);		
		
		if ($section_id!=null)
		{
			$listings_title  = '<i class="fa fa-edit fa-fw"></i> Edit section <small class="text-muted">Section ID: #'.$section_id.'</small>';
		}
		else
		{	
			$listings_title = '<i class="fa fa-edit fa-fw"></i> Edit page <small class="text-muted">Page ID #'.$page_id.'</small>';
		}
		
		$listings_breadcrumb  = ($section_id!=null) ? '<li>'.Kora\Permissions::get_link('admin/pages', $page_id, '<i class="fa fa-edit fa-fw"></i> Edit page ', 'edit').'</li>': '';
		
		$listings_title = array(
			'listings_breadcrumb' => '<li>'
								. Kora\Permissions::get_link('admin/dashboard', '', '<i class="fa fa-dashboard fa-fw"></i> Dashboard', 'index')
								. '</li>'
								. '<li>'
								. Kora\Permissions::get_link('admin/pages', '', '<i class="fa fa-files-o fa-fw"></i> Pages', 'index')
								. '</li>'.$listings_breadcrumb,	
			'listings_title' => $listings_title,				
			'listings_extra' => '',
			//'listings_extra' => Kora\Permissions::get_link('admin/pages', '', '<i class="fa fa-plus fa-fw"></i>  Create new page', 'create', array('class'=>'btn btn-xs btn-success')),
		);
		$this->template->set_global('listings_title', 		$listings_title, 		false);
				
		$components_array = array();
		
		foreach ($sections as $value)
		{			
			$plugin 		= $loader->forge($value);
			$section 		= $plugin['section'];
			$class 			= $plugin['class'];					
			$panel_title 	= explode('_', $plugin['plugin']['plugin_name']);
					
			$output = new $class($plugin);		
		
			//var_dump($plugin);
			
			$components[] = array(
				'panel_id' 			=> "panel_id_".$value['id'],
				'panel_class'		=> "",
				'panel_parent_id' 	=> "page_sections",
				'panel_heading_id' 	=> "panel_heading_id_".$value['id'],
				'panel_title' 		=> $panel_title[0],				
				'panel_title_id'	=> $value['id'],
				'panel_body' 		=> $output->get_content(),				
				'panel_edit_url' 	=> URI::base(false).'admin/pages/edit/'.$page_id.'/'.$value['id'],
				'panel_settings_url'=> '',
				'panel_settings_icon'=> '',
			);		
		}		
		
		$this->template->set_global('components', $components, false);		
		
		$this->template->title = "Pages";
		$this->template->content = View::forge('admin/pages/edit');
	}


	public function action_settings($page_id=null)
	{		
		$page_id = (is_int($page_id) !== null) ? $page_id: 1;
	
		// Plugins by permission only
		
		$this->template->set_global('sections', 		$sections = Model_Section::query()
														->where('page_id', $page_id)
														->get(),									false);
		$this->template->set_global('page', 			$page = Model_Page::find($page_id),			false);
		$this->template->set_global('plugins', 			Kora\Permissions::get_plugins('create'), 	false);
		$this->template->set_global('select_options',	Config::get('public.select'),				false);
			
		$this->template->set_global('korasettings', $korasettings = Model_setting::find('all')[1],	false);	
		
		$theme_file = DOCROOT."themes/{$korasettings->website_theme}/templates/layout/blocks.xml";
		
		$this->template->set_global('block_data', 	Kora\Layouts::get_blocks($theme_file),			false);	
		$this->template->set_global('print_blocks', Kora\Layouts::print_blocks($sections, false),	false);
			
		
		$listings_title = array(
			'listings_breadcrumb' => '<li>'
								. Kora\Permissions::get_link('admin/dashboard', '', '<i class="fa fa-dashboard fa-fw"></i> Dashboard', 'index')
								. '</li>'
								. '<li>'
								. Kora\Permissions::get_link('admin/pages', '', '<i class="fa fa-files-o fa-fw"></i> Pages', 'index')
								. '</li>'
								. '<li>'
								. Kora\Permissions::get_link('admin/pages', $page_id, '<i class="fa fa-edit fa-fw"></i> Edit page', 'edit')
								. '</li>',	
			'listings_title' => '<i class="fa fa-cog fa-fw"></i> Page settings <small class="text-muted">Page ID #'.$page_id.'</small>',				
			'listings_extra' => '',
			//'listings_extra' => Kora\Permissions::get_link('admin/pages', '', '<i class="fa fa-plus fa-fw"></i>  Create new page', 'create', array('class'=>'btn btn-xs btn-success')),
		);		
		$listings_panel_group = array(
			'panel_id' 			=> "panel_id_",
			'panel_parent_id' 	=> "page_sections",
			'panel_heading_id' 	=> "panel_heading_id_",
			'panel_title' 		=> '<i id="spinner" class="fa fa-cog fa-fw"></i> Page settings <small class="text-muted">Page ID #'.$page_id.'</small>',							
			'panel_title_id'	=> '',
			'panel_body' 		=> render('admin/pages/_settings'),	
			'panel_title_ext' => '',
		);		
		$create_panel_group = array(
			'panel_id' 			=> 'collapse_create',
			'panel_parent_id' 	=> 'create_index',
			'panel_heading_id' 	=> 'create_heading',
			'panel_title' 		=> '<i class="fa fa-indent fa-fw"></i> Insert new section',
			'panel_title_ext' 	=> '',
			'panel_body' 		=> render('admin/pages/_plugin'),
		);		
		$details_panel_group = array(
			'panel_id' 			=> 'collapse_view',
			'panel_parent_id' 	=> 'view_index',
			'panel_heading_id' 	=> 'view_heading',
			'panel_title' 		=> '<i class="fa fa-file-o fa-fw"></i> Page details',
			'panel_title_ext' 	=> '',
			'panel_body' 		=> render('admin/pages/_view'),
		);
		
		$this->template->set_global('listings_title', 		$listings_title, 		false);
		$this->template->set_global('details_panel_group', 	$details_panel_group, 	false);
		$this->template->set_global('listings_panel_group', $listings_panel_group, 	false);
		$this->template->set_global('create_panel_group', 	$create_panel_group, 	false);
		
		$this->template->title = "Pages";
		$this->template->content = View::forge('admin/pages/settings');
	
	}
	
	
	
	public function action_blocks($page_id, $section_id)
	{	
		Config::load('pages', 'public');

		$page_id = (is_int($page_id) !== null) ? $page_id: 1;
		$section_id = (is_int($section_id) !== null) ? $section_id: 1;
		
		$parents = array();
		$parents[0] = "None";
		
		$q_parents = DB::select()->from('pages')->where('id','!=', $page_id)->execute()->as_array();
		
		foreach ($q_parents as $value)
		{
			$parents[$value['id']] = $value['title'];
		}		
		
		$this->template->set_global('select_options', Config::get('public.select'),	false);		
		$this->template->set_global('menus', 	Arr::assoc_to_keyval(Model_Menus::find('all'), 'id', 'name'));	
		$this->template->set_global('page', 	$page = Model_Page::find($page_id));
		$this->template->set_global('section', 	$section = Model_Section::find($section_id));
		$this->template->set_global('parents', 	$parents);
		$this->template->set_global('page_id', 	$page_id);
		$this->template->set_global('korasettings', $korasettings = Model_setting::find('all')[1]);
		
		$theme_file = DOCROOT."themes/{$korasettings->website_theme}/templates/layout/blocks.xml";
		
		$this->template->set_global('block_data', Kora\Layouts::get_blocks($theme_file));
		$this->template->set_global('print_blocks', Kora\Layouts::print_blocks($section, false), false);
			
		$listings_title = array(
			'listings_breadcrumb' => '<li>'
								. Kora\Permissions::get_link('admin/dashboard', '', '<i class="fa fa-dashboard fa-fw"></i> Dashboard', 'index')
								. '</li>'
								. '<li>'
								. Kora\Permissions::get_link('admin/pages', '', '<i class="fa fa-files-o fa-fw"></i> Pages', 'index')
								. '</li>'
								. '<li>'
								. Kora\Permissions::get_link('admin/pages', $page_id, '<i class="fa fa-edit fa-fw"></i> Edit page', 'edit')
								. '</li>',	
			'listings_title' => '<i class="fa fa-paint-brush fa-fw"></i> Blocks page layout <small class="text-muted">Section ID #'.$section_id.'</small>',					
			'listings_extra' => '',
			//'listings_extra' => Kora\Permissions::get_link('admin/pages', '', '<i class="fa fa-plus fa-fw"></i>  Create new page', 'create', array('class'=>'btn btn-xs btn-success')),
		);		
		$page_settings = array(
				'panel_id' 			=> "panel_id_".$section_id,
				'panel_parent_id' 	=> "page_sections",
				'panel_heading_id' 	=> "panel_heading_id_".$section_id,
				'panel_title' 		=> '<i class="fa fa-paint-brush fa-fw"></i> Blocks page layout <small class="text-muted">Section ID #'.$section_id.'</small>',							
				'panel_title_id'	=> '',
				'panel_body' 		=> render('admin/pages/_blocks'),	
				'panel_title_ext' => '',
			);	
		$this->template->set_global('listings_title', 		$listings_title, 		false);
		$this->template->set_global('page_settings', 		$page_settings, 		false);
		
		$this->template->title = "Pages";
		$this->template->content = View::forge('admin/pages/layout');	
	}
	
	
	public function action_single($page_id)
	{	
		Config::load('pages', 'public');

		$page_id = (is_int($page_id) !== null) ? $page_id: 1;
		$parents = array();
		$parents[0] = "None";
		$q_parents = DB::select()->from('pages')->where('id','!=', $page_id)->execute()->as_array();
		foreach ($q_parents as $value)
		{
			$parents[$value['id']] = $value['title'];
		}		
		
		$korasettings = Model_setting::find('all')[1];
		
		$page = Model_Page::find($page_id);
		
		$this->template->set_global('select_options', Config::get('public.select'),	false);		
		$this->template->set_global('menus', 	Arr::assoc_to_keyval(Model_Menus::find('all'), 'id', 'name'));	
		$this->template->set_global('page', 	$page);
		$this->template->set_global('parents', 	$parents);
		$this->template->set_global('page_id', 	$page_id);
		$this->template->set_global('korasettings', $korasettings);
		
		$theme_file = DOCROOT."themes/{$korasettings->website_theme}/templates/layout/single.xml";
		
		$this->template->set_global('block_data', Kora\Layouts::get_blocks($theme_file));
		$this->template->set_global('print_blocks', Kora\Layouts::print_blocks($page), false);
		
		
		
			
		$listings_title = array(
			'listings_breadcrumb' => '<li>'
								. Kora\Permissions::get_link('admin/dashboard', '', '<i class="fa fa-dashboard fa-fw"></i> Dashboard', 'index')
								. '</li>'
								. '<li>'
								. Kora\Permissions::get_link('admin/pages', '', '<i class="fa fa-files-o fa-fw"></i> Pages', 'index')
								. '</li>'
								. '<li>'
								. Kora\Permissions::get_link('admin/pages', $page_id, '<i class="fa fa-edit fa-fw"></i> Edit page', 'edit')
								. '</li>',	
			'listings_title' => '<i class="fa fa-paint-brush fa-fw"></i> Single page layout <small class="text-muted">Page ID #'.$page_id.'</small>',				
			'listings_extra' => '',
			//'listings_extra' => Kora\Permissions::get_link('admin/pages', '', '<i class="fa fa-plus fa-fw"></i>  Create new page', 'create', array('class'=>'btn btn-xs btn-success')),
		);		
		$page_settings = array(
				'panel_id' 			=> "panel_id_".$page_id,
				'panel_parent_id' 	=> "page_sections",
				'panel_heading_id' 	=> "panel_heading_id_".$page_id,
				'panel_title' 		=> '<i class="fa fa-paint-brush fa-fw"></i> Single page layout <small class="text-muted">Page ID #'.$page_id.'</small>',							
				'panel_title_id'	=> '',
				'panel_body' 		=> render('admin/pages/_single'),				
				'panel_edit_url' 	=> '',
				'panel_title_ext' => '',
			);	
		$this->template->set_global('listings_title', 		$listings_title, 		false);
		$this->template->set_global('page_settings', 		$page_settings, 		false);
		
		$this->template->title = "Pages";
		$this->template->content = View::forge('admin/pages/layout');	
	}
	

	
	

	
	
	
	
	
	
	
	
	
	
   /*
	* Delete action
	* Find page and sections by page_id delete from database
	* 
	* @params	int		$page_id
	*/
	public function action_delete($page_id = null)
	{
		if (is_numeric($page_id))
		{ 		
			if ($page = Model_Page::find($page_id))
			{
				if ($sections = Model_Section::find_by_page_id($page_id))
				{	
					$page->delete();
					$sections->delete();
	
					Session::set_flash('success', e('Deleted page #'.$page_id));
				}
			}
			else
			{
				Session::set_flash('error', e('Could not delete page #'.$page_id));
			}
			Response::redirect('admin/trash'); 
		}	
		
		if ($page_id==='all')
		{
			if ($query = Model_Page::find('all', array('where' => array('status' => 4))))
			{
				foreach ($query as $item)
				{
					if ($page = Model_Page::find($item->id))
					{
						if ($sections = Model_Section::find_by_page_id($page->id))
						{	
							$page->delete();
							$sections->delete();
			
							Session::set_flash('success', e('Deleted page #'.$page->id));
						}
					}
					else
					{
						Session::set_flash('error', e('Could not delete page #'.$page->id));
					}
				} 
				Response::redirect('admin/trash'); 
			}
			else
			{
				Session::set_flash('error', e('Could not delete page #'.$page_id));
			}
			Response::redirect('admin/trash'); 
		}
	}
}
