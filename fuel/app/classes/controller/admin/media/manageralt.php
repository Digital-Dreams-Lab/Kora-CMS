<?php 

class Controller_Admin_Media_Manageralt extends Controller_Rest
{
	/*
	 * Main ajax call function
	 *
	 * @param	action		route methods
	 * 
	 */	
	public function post_list()
    {
		//and Security::check_token(Input::post('fuel_csrf_token'))
		if ($this->post = Input::post())
		{			
			switch ($this->post['action'])
			{			
				case 'folder_default':
					return $this->folder_default();
					break;
					
				case 'folder_rename':
					return $this->folder_rename();
					break;
					
				case 'folder_create':
					return $this->folder_create();
					break;
					
				case 'folder_delete':
					return $this->folder_delete();
					break;
					
				case 'files_batch_move':
					return $this->files_batch_move();
					break;
					
				case 'files_batch_delete':
					return $this->files_batch_delete();
					break;
					
				case 'file_create':	
					$this->files = $_FILES;
					return $this->file_create();
					break;
					
				case 'file_list':	
					return $this->file_list();
					break;
			}		
		}
	}

	/*
	 * Create IMAGE or FILE function
	 */		
	public function file_create()
    {		
		$this->folder_id = $this->post['folder_id'];		
		$this->per_page = $this->post['per_page'];
		$this->page_num = $this->post['page_num'];
		$this->list_style = $this->post['list_style'];
			
		\Config::load('media');

		$finfo = new finfo(FILEINFO_MIME_TYPE);
		$needle = $finfo->file($this->files['filetoupload']['tmp_name']);
		$haystack = array('image/jpeg','image/png','image/gif');
		if (in_array($needle,$haystack))
		{
			$check = true;
			$config = \Config::get('images.config');	
		}
		else
		{
			$check = false;
			$config = \Config::get('files.config');
		}
		
		\Upload::process($config);
		
		$folder_response = \Upload::is_valid();
		
		if (Upload::is_valid())
		{
			Upload::save();
			
			$files 		= Upload::get_files();
			$file 		= $files[0]['saved_to'].$files[0]['saved_as'];
			
			$filearray = Plugin\File::filearray($file, $files, $this->post);
			
			if($check === true)
			{
				$save_medium = Model_Medium::add_image($filearray);			
			}
			else
			{
				$save_medium = Model_Medium::add_file($filearray);				
			}
			
			if ($save_medium)
			{	
				$folder_response = 'File successfully created!';
			}
		}
		
		$this->set_folder_data();
		$this->set_media_data();
		$this->set_response();
	}

	/*
	 * Create FOLDER
	 */		
	public function folder_create()
    {			
		$this->folder_id = $this->post['folder_id'];	
		$this->page_num = $this->post['page_num'];	
		$this->per_page = $this->post['per_page'];	
		$this->list_style = $this->post['list_style'];
				
		if (!null == $this->post['name'] && !null == $this->post['description'] ) {
			$folder_create = \Model_Folder::forge(array(
				'parent_id' => $this->folder_id,
				'order' => 0,
				'active' => 1,
				'name' => $this->post['name'],
				'description' => $this->post['description'],
			));
		
			if ($folder_create and $folder_create->save())
			{
				$this->output_response = "Folder successfully created!";
			}
		
			else
			{
				$this->output_response = "Error creating folder!";
			}
		}
		
		$this->set_folder_data();
		$this->set_media_data();
		$this->set_response();
	}
	/*
	 * Rename FOLDER
	 */		
	public function folder_rename()
    {			
		$this->folder_id = $this->post['folder_id'];	
		$this->page_num = $this->post['page_num'];	
		$this->per_page = $this->post['per_page'];
		$this->list_style = $this->post['list_style'];	
				
		if (!null == $this->post['name']) {
			
			$folder = \Model_Folder::find($this->folder_id);
			
			$folder->name = $this->post['name'];

			if ($folder->save())
			{
				$this->output_response = "Folder successfully renamed!";
			}
		
			else
			{
				$this->output_response = "Error renaming folder!";
			}
		}
		
		$this->set_folder_data();
		$this->set_media_data();
		$this->set_response();
	}
	
	/*
	 * Delete FOLDER
	 */		
	public function folder_delete()
    {			
		$folder_id = $this->post['folder_id'];	
		$this->page_num = $this->post['page_num'];	
		$this->per_page = $this->post['per_page'];	
		$this->list_style = $this->post['list_style'];
				
		if (!null == $folder_id) {
			
			$folder = \Model_Folder::find($folder_id);

			if ($folder->delete())
			{
				$this->output_response = "Folder successfully deleted!";
			}
		
			else
			{
				$this->output_response = "Error deleting folder!";
			}
		}
		$this->folder_id = 0;
		$this->set_folder_data();
		$this->set_media_data();
		$this->set_response();
	}	

	/*
	 * Batch IMAGE or File mover
	 */		
	public function files_batch_move()
    {	
		$this->folder_id = $this->post['move_folder_id'];
		$this->media_ids = array_filter(explode(',',urldecode($this->post['media_ids'])));		
		$this->per_page = $this->post['per_page'];
		$this->page_num = $this->post['page_num'];
		$this->list_style = $this->post['list_style'];
		
		foreach ($this->media_ids as $media_id)
		{
			$medium = \Model_Medium::find($media_id);
			$medium->folder_id = $this->folder_id;
			
			if ($medium->save())
			{
				$this->output_response[] = "Media has moved.";
			}
	
			else
			{
				$this->output_response[] = "Could not move the media.";
			}
		}	
				
		$this->set_folder_data();
		$this->set_media_data();
		$this->set_response();
	}

	/*
	 * Batch IMAGE or File delete
	 */		
	public function files_batch_delete()
    {	
		$this->folder_id = $this->post['folder_id'];
		$this->media_ids = array_filter(explode(',',urldecode($this->post['media_ids'])));		
		$this->per_page = $this->post['per_page'];
		$this->page_num = $this->post['page_num'];
		$this->list_style = $this->post['list_style'];
		
		foreach ($this->media_ids as $media_id)
		{
			$medium = \Model_Medium::find($media_id);

			$file_search = $medium->dirname.'/'.$medium->filename.'*';
			$files = new GlobIterator($file_search);			

			if ($medium->delete())
			{
				foreach ($files as $file => $empty_value)
				{
					$new_array[] = unlink($file);
				}
				$this->output_response[] = "Media successfully deleted.";
			}
	
			else
			{
				$this->output_response[] = "Could not delete media.";
			}
		}		
		$this->set_folder_data();
		$this->set_media_data();
		$this->set_response();
	}

	/*
	 * Folder default method
	 */		
	public function folder_default()
    {	
		$this->folder_id = $this->post['folder_id'];		
		$this->per_page = $this->post['per_page'];
		$this->page_num = $this->post['page_num'];
		$this->list_style = $this->post['list_style'];
		
		$this->set_folder_data();
		$this->set_media_data();
		$this->set_response();
	}

	/*
	 * Folder default method
	 */		
	public function file_list()
    {	
		$this->folder_id = $this->post['folder_id'];		
		$this->per_page = $this->post['per_page'];
		$this->page_num = $this->post['page_num'];
		$this->list_style = $this->post['list_style'];
		
		$this->set_folder_data();
		$this->set_media_data();
		$this->set_response();
	}

	/*
	 * Folder default method
	 */		
	public function reset_folder_data()
    {
		$media = new Plugin\Media;
		
		return $media->move($this->folder_id, $this->media_ids);
	}
	
	/*
	 * TEST FUNCTION NEEDS TO BE REMOVED
	 */		
	public function get_list()
    {
		$get = Input::get();	
		
		$this->folder_id = $get['folder_id'];	
		$this->page_num = $get['page_num'];	
		$this->per_page = $get['per_page'];	
		$this->list_style = $get['list_style'];
		
		$this->set_folder_data();
		$this->set_media_data();
		$this->set_response();
	}
	
	/*
	 * Pblic vars
	 */		
	public $media_list;
	public $folder_list;
	public $folder_input;
	public $folder_tree;
	public $output_response;

	/*
	 * Set response data to be send back
	 */		
	public function set_response()
	{
		$response = array(
				'folders_list'		=> $this->folders_list, 
				'folder_list'		=> $this->folder_list, 
				'folder_hidden'		=> $this->folder_hidden,
				'folder_tree'		=> $this->folder_tree,
				'media_list'		=> $this->media_list,
				'pagination'		=> $this->pagination->render(),
				'output_response'	=> $this->output_response,
				//'post_data'			=> $this->post,
			);
		
		$this->response($response);
	}

	/*
	 * Set folder data method
	 */		
	public function set_folder_data()
	{
		$folder = new Plugin\Folder($this->folder_id);
		
		$this->folders_list = $folder->get_folders();
		$this->folder_list = $folder->get_paths($this->folder_id, false);
		$this->folder_hidden = $folder->get_hidden_alt($this->folder_id, $this->per_page, $this->page_num, $this->list_style);
		$this->folder_tree = $folder->view_tree();
	}

	/*
	 * Set media data method
	 */		
	public function set_media_data()
	{
		$query = \DB::select('id')
			->from('medias')
			->where('folder_id',$this->folder_id)
			->execute()
			->as_array();
			
		$total_items = count($query);
		
		$config = array(
			'pagination_url' => '',
			'total_items'    => $total_items,
			'per_page'       => $this->per_page,
			'current_page'    => $this->page_num,
			'uri_segment'    => '',
		);
		$this->pagination = \Pagination::forge('pagination', $config);		
		
		$media = new Plugin\Media;
		
		$this->media_list = $media->get_list_alt($this->folder_id, false, $this->pagination->offset, $this->pagination->per_page, $this->list_style);
	}

}