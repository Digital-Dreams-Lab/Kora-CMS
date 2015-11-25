<?php

class Controller_Admin_Rest_Pages_Settings extends Controller_Rest
{
	public function post_list()
    {
		$response = array(
			'rest_response' => Input::post()
		);		
		return $this->response($response);	
	}	
	
	
	public function post_sortsections()
    {
		$this->post = Input::post();
		
		$response = array(
			'sortsections_list' => $this->sortlist()
		);		
		return $this->response($response);	
	}
	
	
	public function post_addsection()
    {
		$this->post = Input::post();	
		
		$response = array(
			'response' => $this->insertsection(),
			'sortsections_list' => $this->sortlist(),
		);		
		return $this->response($response);
	}
	
	
	public function post_resort()
    {
		$this->post = Input::post();
		$response = array(
			'response' => $this->resortlist(),
			'sortsections_list' => $this->sortlist(),
		);		
		return $this->response($response);
	}
	
	public function insertsection()
	{		
		$section = Model_Section::forge(array(
			'page_id' 		=> Input::post('page_id'),
			'user_id' 		=> Input::post('user_id'),
			'plugin_id'		=> Input::post('plugin_id'), // koraeditor
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
			return $message = 'Added section #'.$section->id.'.';
		}

		else
		{
			return $message = 'Could not create section.';
		}
	
	}
	public function resortlist()
	{
		if (Input::post('sortsections'))
		{
			$sortsections = Input::post('sortsections');
			
			foreach ($sortsections as $order => $section_id)
			{
				$message[]=$section_id['sectionId'];
				//*/
				$section = Model_Section::find($section_id);
				
				isset($section)		? $section->order		 = $order:			0; 
				
				if ($section->save())
				{
					$message[] = '<i class="fa fa-check"></i> Item Section ID #'.$section->id.' updated.';
				}
				else
				{
					$message[] = '<i class="fa fa-exclamation-triangle"></i> Update error.';
				}
				//*/	
			}
			
			
		}
	
		return $message;
	}	
	public function sortlist()
	{
		$plugins = Arr::assoc_to_keyval(Model_Plugin::find('all'), 'id', 'name');
		$sections = Model_Section::query()->where('page_id', $this->post['page_id'])->order_by('order', 'asc')->get();
	
		$sortsections_list = array();
        foreach ($sections as $row) 
		{
			$sortsections_list[] = '<li data-section-id="'.$row->id.'" class="list-group-item"><i class="fa fa-sort"></i> '.$plugins[$row->plugin_id].' <small class="text-muted">Section ID #'.$row->id.'</small></li>';
        }
		
		return implode('', $sortsections_list);
	}
}