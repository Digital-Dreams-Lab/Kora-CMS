<?php

class Controller_Admin_Rest_Pages extends Controller_Rest
{	
	public function post_pages()
    {
		$page = Input::post('page');
		$response = array(
			'message' => $page
		);		
		return $this->response($response);	
	}	
	public function post_page()
    {		
		$page = Input::post('page');
		$section = Input::post('section');
		
        $newpage = Model_Page::find($page['id']);
		
		switch ($page['status'])
		{
			// 1 Publish active = 1
			case 1:
				$newpage->active 			= 1;
			break;
			// 0,3,4 Draft, archive, trash active = 0
			case 0:
			case 3:
			case 4:
				$newpage->active 			= 0;
			break;
			////////////////////////////////////////////////////////
			// Default - Temporary - need to fix to check if start_at is before or after
			//                       current timestamp, reset active accordingly
			////////////////////////////////////////////////////////
			default:
				$newpage->active 			= $page['active'];
			break;	
		}
		$newpage->status 			= $page['status'];
		$newpage->order 			= $page['order'];
		$newpage->slug 				= $page['slug'];
		$newpage->visibility 		= $page['visibility'];
		$newpage->parent_id 		= $page['parent_id'];
		$newpage->home_page 		= $page['home_page'];
		
		isset($row['single_page'])	? $newpage->single_page	 	= $page['single_page']		: ''; 
		isset($row['single_layout'])? $newpage->single_layout	= $page['single_layout']	: ''; 
		isset($row['single_id'])	? $newpage->single_id 		= $page['single_id']		: ''; 
		isset($row['single_class'])	? $newpage->single_class 	= $page['single_class']		: ''; 
		
		if (!empty($page['start_at']))
		{
			$start_at 					= DateTime::createFromFormat("m/d/Y h:i A", $page['start_at']);
			$newpage->start_at 			= $start_at->getTimestamp();
		}
		if (!empty($page['end_at']))
		{
			$end_at 					= DateTime::createFromFormat("m/d/Y h:i A", $page['end_at']);
			$newpage->end_at			= $end_at->getTimestamp();
		}
		$newpage->menu_id 			= $page['menu_id'];
		$newpage->menu_title 		= $page['menu_title'];
		$newpage->meta_title 		= $page['meta_title'];
		$newpage->meta_description 	= $page['meta_description'];
		$newpage->groups		 	= implode(',', $page['groups']);
		$newpage->users			 	= implode(',', $page['users']);

		if ($newpage->save())
		{
			$message[] = '<i class="fa fa-check"></i> Item Page ID #'.$newpage->id.' updated.';
		}
		else
		{
			$message[] = '<i class="fa fa-exclamation-triangle"></i> Update error.';
		}
		
		if (isset($section))
		{
			foreach ($section as $key => $row)
			{
				$newsection = Model_Section::find($row['section_id']);
				
				isset($row['content'])		? $newsection->content		 = $row['content']:			''; 
				isset($row['blocks_id'])	? $newsection->blocks_id	 = $row['blocks_id']:		''; 
				isset($row['blocks_class'])	? $newsection->blocks_class	 = $row['blocks_class']:	''; 
				isset($row['blocks_layout'])? $newsection->blocks_layout = $row['blocks_layout']:	''; 
				
				if ($newsection->save())
				{
					$message[] = '<i class="fa fa-check"></i> Item Section ID #'.$newsection->id.' updated.';
				}
				else
				{
					$message[] = '<i class="fa fa-exclamation-triangle"></i> Update error.';
				}	
			}
		}
		else
		{		
			$message[] = '<i class="fa fa-exclamation-triangle"></i> No sections loaded to save.';
		}		
		$response = array(
			'message' => implode('<br>', $message)
		);
		
		return $this->response($response);	
	}


	
	public function post_title()
    {
		$id = Input::post('id');
		$title = Input::post('title');
		$slug = Input::post('slug');

        $page = Model_Page::find($id);
		$page->title = $title;
		$page->slug = $slug;

		if ($page->save())
		{
			$message[] = '<i class="fa fa-check"></i> Item Page ID #'.$page->id.' updated.';
		}
		else
		{
			$message[] = '<i class="fa fa-exclamation-triangle"></i> Update error.';
		}
		
        $page = Model_Page::find($id);
		
		$response = array(
			'message' => implode('<br>', $message),
			'page_title' => '<span data-page-id="'.$page->id.'" data-page-title="'.$page->title.'" id="rename_page_action"><i class="fa fa-edit"></i> '.$page->title.'</span>',
			);
		
		return $this->response($response);
    }
	
	public function get_title()
    {
		$id = Input::get('id');
        $page = Model_Page::find($id);
		
		$response = array(
			'page_title' => '<span data-page-id="'.$page->id.'" data-page-title="'.$page->title.'" id="rename_page_action"><i class="fa fa-edit"></i> '.$page->title.'</span>',
			);
		
		return $this->response($response);
    }
}