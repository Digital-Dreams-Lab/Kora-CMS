<?php
class Controller_Admin_Registers extends Controller_Admin
{
	public function action_index()
	{	
		$this->template->set_global('registers', Model_Register::find('all'), false);	
		$this->template->set_global('registers_array', Arr::assoc_to_keyval(Model_Register::find('all'), 'route', 'route'), false);
	
		$listings_title = array(
			'listings_breadcrumb' => '<li>'
								. Kora\Permissions::get_link('admin/dashboard', '', '<i class="fa fa-dashboard fa-fw"></i> Dashboard', 'index')
								. '</li>'
								. '<li>'
								. Kora\Permissions::get_link('admin/permissions', '', '<i class="fa fa-lock fa-fw"></i> Permissions', 'index')
								. '</li>',	
			'listings_title' => '<i class="fa fa-sitemap fa-fw"></i> Registry',				
			'listings_extra' => Kora\Permissions::get_link('admin/registers', '', '<i class="fa fa-plus fa-fw"></i>  Create new registry rules', 'create', array('class'=>'btn btn-xs btn-success')),
		);
		$listings_panel_group = array(
			'panel_id' 			=> 'collapse_listing',
			'panel_parent_id' 	=> 'parent_listing',
			'panel_heading_id' 	=> 'heading_listing',
			'panel_title' 		=> '<i class="fa fa-sitemap fa-fw"></i> Registry',
			'panel_title_ext' 	=> '',
			'panel_body' 		=> render('admin/registers/_listings'),
		);
		
		$this->template->set_global('listings_title', 		$listings_title, 		false);
		$this->template->set_global('listings_panel_group', $listings_panel_group,	false);
		
		$this->template->title = "register";
		$this->template->content = View::forge('admin/registers/index');
	}
	
	
	
	
	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Register::validate('create');

			if ($val->run())
			{

				$register = Model_Register::forge(array(
					'type' 			=> Input::post('type'),
					'level'			=> Input::post('level', '0'),
					'route' 		=> Input::post('route'),
					'controller' 	=> Input::post('controller'),
					'actions' 		=> Input::post('actions'),
					'methods' 		=> Input::post('methods'),
					'perms' 		=> Input::post('perms'),
					'rules' 		=> Input::post('rules'),
				));

				if ($register and $register->save())
				{
					Session::set_flash('success', e('Added register #'.$register->id.'.'));

					Response::redirect('admin/registers');
				}

				else
				{
					Session::set_flash('error', e('Could not save register.'));
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}
		Config::load('kora/registers');
		$this->template->set_global('registers', Model_Register::find('all'), false);	
		$this->template->set_global('types', Config::get('registry.types'), false);	
		
		$listings_title = array(
			'listings_breadcrumb' => '<li>'
								. Kora\Permissions::get_link('admin/dashboard', '', '<i class="fa fa-dashboard fa-fw"></i> Dashboard', 'index')
								. '</li>'
								. '<li>'
								. Kora\Permissions::get_link('admin/permissions', '', '<i class="fa fa-lock fa-fw"></i> Permissions', 'index')
								. '</li>'
								. '<li>'
								. Kora\Permissions::get_link('admin/registers', '', '<i class="fa fa-sitemap fa-fw"></i> Registry', 'index')
								. '</li>',	
			'listings_title' => '<i class="fa fa-plus fa-fw"></i> Create new registry rules',				
			'listings_extra' => Kora\Permissions::get_link('admin/registers', '', '<i class="fa fa-plus fa-fw"></i>  Create new registry rules', 'create', array('class'=>'btn btn-xs btn-success')),
		);
		$listings_panel_group = array(
			'panel_id' 			=> 'collapse_listing',
			'panel_parent_id' 	=> 'parent_listing',
			'panel_heading_id' 	=> 'heading_listing',
			'panel_title' 		=> '<i class="fa fa-plus fa-fw"></i> Create new registry rules',
			'panel_title_ext' 	=> '',
			'panel_body' 		=> render('admin/registers/_create'),
		);
		
		$this->template->set_global('listings_title', 		$listings_title, 		false);
		$this->template->set_global('listings_panel_group', $listings_panel_group,	false);
		
		$this->template->title = "register";
		$this->template->content = View::forge('admin/registers/index');
	}
	
	
	public function action_edit($id=null)
	{
		$register = Model_Register::find($id);
		
		$val = Model_Register::validate('edit');

		if ($val->run())
		{
			$register->type = Input::post('type');
			$register->level = Input::post('level', 0);
			$register->route = Input::post('route');
			$register->controller = Input::post('controller');
			$register->actions = Input::post('actions');
			$register->methods = Input::post('methods');
			$register->perms = Input::post('perms');
			$register->rules = Input::post('rules');

			if ($register->save())
			{
				Session::set_flash('success', e('Updated register #' . $id));

				Response::redirect('admin/registers');
			}

			else
			{
				Session::set_flash('error', e('Could not update register #' . $id));
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$register->type = $val->validated('type');
				$register->route = $val->validated('route');
				$register->controller = $val->validated('controller');
				$register->actions = $val->validated('actions');
				$register->methods = $val->validated('methods');
				$register->perms = $val->validated('perms');
				$register->rules = $val->validated('rules');

				Session::set_flash('error', $val->error());
			}
		}
		
		Config::load('kora/registers');
		$this->template->set_global('register', $register, false);	
		$this->template->set_global('types', Config::get('registry.types'), false);	
				
		$listings_title = array(
			'listings_breadcrumb' => '<li>'
								. Kora\Permissions::get_link('admin/dashboard', '', '<i class="fa fa-dashboard fa-fw"></i> Dashboard', 'index')
								. '</li>'
								. '<li>'
								. Kora\Permissions::get_link('admin/permissions', '', '<i class="fa fa-lock fa-fw"></i> Permissions', 'index')
								. '</li>'
								. '<li>'
								. Kora\Permissions::get_link('admin/registers', '', '<i class="fa fa-sitemap fa-fw"></i> Registry', 'index')
								. '</li>',	
			'listings_title' => '<i class="fa fa-edit fa-fw"></i> Edit register #'.$id,				
			'listings_extra' => Kora\Permissions::get_link('admin/registers', '', '<i class="fa fa-plus fa-fw"></i>  Create new registry rules', 'create', array('class'=>'btn btn-xs btn-success')),
		);
		$listings_panel_group = array(
			'panel_id' 			=> 'collapse_listing',
			'panel_parent_id' 	=> 'parent_listing',
			'panel_heading_id' 	=> 'heading_listing',
			'panel_title' 		=> '<i class="fa fa-edit fa-fw"></i> Edit register #'.$id,
			'panel_title_ext' 	=> '',
			'panel_body' 		=> render('admin/registers/_edit'),
		);
		
		$this->template->set_global('listings_title', 		$listings_title, 		false);
		$this->template->set_global('listings_panel_group', $listings_panel_group,	false);
		
		$this->template->title = "register";
		$this->template->content = View::forge('admin/registers/index');
	}
	public function action_view($id=null)
	{
		Config::load('kora/registers');

		$this->template->set_global('register', Model_Register::find($id), false);	
		$this->template->set_global('types', Config::get('registry.types'), false);	
				
		$listings_title = array(
			'listings_breadcrumb' => '<li>'
								. Kora\Permissions::get_link('admin/dashboard', '', '<i class="fa fa-dashboard fa-fw"></i> Dashboard', 'index')
								. '</li>'
								. '<li>'
								. Kora\Permissions::get_link('admin/permissions', '', '<i class="fa fa-lock fa-fw"></i> Permissions', 'index')
								. '</li>'
								. '<li>'
								. Kora\Permissions::get_link('admin/registers', '', '<i class="fa fa-sitemap fa-fw"></i> Registry', 'index')
								. '</li>',	
			'listings_title' => '<i class="fa fa-search fa-fw"></i> View register #'.$id,			
			'listings_extra' => Kora\Permissions::get_link('admin/registers', '', '<i class="fa fa-plus fa-fw"></i>  Create new registry rules', 'create', array('class'=>'btn btn-xs btn-success')),
		);
		$listings_panel_group = array(
			'panel_id' 			=> 'collapse_listing',
			'panel_parent_id' 	=> 'parent_listing',
			'panel_heading_id' 	=> 'heading_listing',
			'panel_title' 		=> '<i class="fa fa-search fa-fw"></i> View register #'.$id,
			'panel_title_ext' 	=> '',
			'panel_body' 		=> render('admin/registers/_view'),
		);
		
		$this->template->set_global('listings_title', 		$listings_title, 		false);
		$this->template->set_global('listings_panel_group', $listings_panel_group,	false);
		
		$this->template->title = "register";
		$this->template->content = View::forge('admin/registers/index');
	}
	
	/**
     * Route:	/registers/delete/:id
	 */
	public function action_delete($id = null)
	{
		if ($access = Model_Register::find($id))
		{
			$access->delete();
			
			Session::set_flash('success', e('Deleted register #'.$id));
		}
		
		else
		{
			Session::set_flash('error', e('Could not delete register #'.$id));
		}
		Response::redirect('admin/registers');
	}

/* End of file */
}
