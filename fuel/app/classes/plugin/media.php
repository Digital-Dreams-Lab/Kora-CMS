<?php

namespace Plugin;

class Media
{
	public $media_array = array();

	public $div_pre = '<div class="col-sm-2 col-md-4 text-center"><div class="thumbnail">';
	public $div_pos = '</div></div>'; 
	
	public $div_pre_alt = '<div class="col-xs-2 text-center"><div class="thumbnail thumbnail_alt">';
	public $div_pos_alt = '</div></div>';    
      
	public $caption_pre = '<div class="caption"><p>';
	public $caption_pos = '</p></div>';   
      
	public $label_pre = '<label>';
	public $label_pos = '</label>';	
	
	public $table_pre = '<table class="table table-condensed vert-align">
						<thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Author</th>
                                <th>Date</th>
                            </tr>
                        </thead>';
	public $table_pos = '</table>';
	public static function forge($array)
	{
	
		$data_reset['ele_id'] = $array['ele_id'];
		$data_reset['section_id'] = $array['id'];
		$data_reset['user_id'] = $array['user_id'];
		$data_reset['page_id'] = $array['page_id'];
		$data_reset['order'] = $array['order'];

		return $data_reset;
	} 
	
	public function move($folder_id, $media_ids, $user_id=null) {
		$response = "";

		foreach ($media_ids as $media_id)
		{
			$medium = \Model_Medium::find($media_id);
			$medium->folder_id = \Input::post('folder_id');
			
			if ($medium->save())
			{
				$response = "Media has moved.";
			}
	
			else
			{
				$response = "Could not move the media.";
			}
		}	
		return $response;
	}
	
	public function get_list($folder_id, $array=true, $offset, $per_page)
	{		
		$media = \DB::select('*')
			->from('medias')
			->where('folder_id', $folder_id)
			->offset($offset)
			->limit($per_page)
			->execute()
			->as_array();

		$url_base = \Uri::base(false).'uploads/media/';	

		$list = array();
			
		foreach ($media as $item)
		{
			$list[] = $this->div_pre;
			$list[] = $this->label_pre;

			switch ($item['ext'])
			{
					case 'jpg':
					case 'jpeg':
					case 'gif':
					case 'png':
						$item_tiny = $url_base.$item['filename'].'_tiny.'.$item['ext'];
						$item_small = $url_base.$item['filename'].'_medium.'.$item['ext'];
						$item_attach = $url_base.$item['filename'];
						$item_ext = $item['ext'];
						$item_type = 'img';
						
						$list[] = \Html::img($item_small, array("class"=>"img img-responsive"));
						break;
						
					default:					
						$item_tiny = 'fa fa-file-text-o fa-3x media-size-50';
						$item_small = '<i class="fa fa-file-text-o fa-5x media-size-150"></i>';
						$item_type = 'doc';
						$item_attach = $url_base.$item['filename'];
						$item_ext = $item['ext'];
						
						$list[] = $item_small;						
						break;
			}

			$list[] = '<input type="checkbox" 
				id="call_image_check_'.$item['id'].'"
				value="'.$item['id'].'"				 
				data-preview-media="'.$item_tiny.'" 
				data-attach-media="'.$item_attach.'" 
				data-attach-ext="'.$item_ext.'" 
				data-file-type="'.$item_type.'"  
				data-file-src="'.$item_small.'"  
				data-file-name="'.$item['name'].'" 
				data-file-size="'.$item['size'].'" 
				data-file-height="'.$item['custom_height'].'" 
				data-file-width="'.$item['custom_width'].'"
				data-file-created-at="'.$item['created_at'].'"								
				class="check call_image_check">';	
			
			$list[] = $this->label_pos;			
			$list[] = $this->caption_pre;
			$list[] = $item['caption'];
			$list[] = $this->caption_pos;
			$list[] = $this->div_pos;
		}
		if ($array==true)
		{
			return $list;
		}
		else
		{
			return implode('', $list);
		}

	}
	
	
	
	
	/*
	 * Function to get list style for displaying media ie table, thumbnails
	 *  
	 *
	 *
	 */
	public function get_list_alt($folder_id, $array=true, $offset, $per_page, $list_stlye)
	{		
		$media = \DB::select('*')
			->from('medias')
			->where('folder_id', $folder_id)
			->offset($offset)
			->limit($per_page)
			->execute()
			->as_array();

		$url_base = \Uri::base(false).'uploads/media/';	

		$list = array();
			
		switch ($list_stlye)
		{
			// list
			default;
				$list[] = $this->table_pre;
				$list[] = '<tbody>';
				
				foreach ($media as $item)
				{
					switch ($item['ext'])
					{
							case 'jpg':
							case 'jpeg':
							case 'gif':
							case 'png':
								$item_tiny = $url_base.$item['filename'].'_tiny.'.$item['ext'];
								$item_small = $url_base.$item['filename'].'_tiny.'.$item['ext'];
								$item_attach = $url_base.$item['filename'];
								$item_ext = $item['ext'];
								$item_type = 'img';
								
								$list_img = \Html::img($item_small, array("class"=>"img img-responsive"));
								break;
								
							default:					
								$item_tiny = 'fa fa-file-text-o fa-3x media-size-50';
								$item_small = '<i class="fa fa-file-text-o fa-5x media-size-50"></i>';
								$item_type = 'doc';
								$item_attach = $url_base.$item['filename'];
								$item_ext = $item['ext'];
								
								$list_img = $item_small;						
								break;
					}
					$list_checkbox = '<input type="checkbox" 
						id="call_image_check_'.$item['id'].'"
						value="'.$item['id'].'"				 
						data-preview-media="'.$item_tiny.'" 
						data-attach-media="'.$item_attach.'" 
						data-attach-ext="'.$item_ext.'" 
						data-file-type="'.$item_type.'"  
						data-file-src="'.$item_small.'"  
						data-file-name="'.$item['name'].'" 
						data-file-size="'.$item['size'].'" 
						data-file-height="'.$item['custom_height'].'" 
						data-file-width="'.$item['custom_width'].'"
						data-file-created-at="'.$item['created_at'].'"								
						class="call_image_check">';
								
					$list_name = $item['name'];
					$list_caption = $item['caption'];	
					$list_date = '<small class="text-muted">'.date("d/m/Y H:i:sa",$item['created_at']).'</small>';
					
					$list[] = '<tr>';
					
					$list[] = '<td>';
					$list[] = $list_checkbox;
					$list[] = '</td>';
					
					$list[] = '<td>';
					$list[] = $list_img;
					$list[] = '</td>';
					
					$list[] = '<td>';
					$list[] = $list_name;
					$list[] = '</td>';
					
					$list[] = '<td>';
					$list[] = $list_date;
					$list[] = '</td>';
					
					$list[] = '<tr>';
				}
				$list[] = '</tbody>';
				$list[] = $this->table_pos;
			break;
			// Thumbnails
			case '1';
				foreach ($media as $item)
				{
					$list[] = $this->div_pre_alt;
					$list[] = $this->label_pre;
		
					switch ($item['ext'])
					{
							case 'jpg':
							case 'jpeg':
							case 'gif':
							case 'png':
								$item_tiny = $url_base.$item['filename'].'_tiny.'.$item['ext'];
								$item_small = $url_base.$item['filename'].'_medium.'.$item['ext'];
								$item_attach = $url_base.$item['filename'];
								$item_ext = $item['ext'];
								$item_type = 'img';
								
								$list[] = \Html::img($item_tiny, array("class"=>"img img-responsive"));
								break;
								
							default:					
								$item_tiny = 'fa fa-file-text-o fa-3x media-size-50';
								$item_small = '<i class="fa fa-file-text-o fa-5x media-size-150"></i>';
								$item_type = 'doc';
								$item_attach = $url_base.$item['filename'];
								$item_ext = $item['ext'];
								
								$list[] = $item_tiny;						
								break;
					}
		
					$list[] = '<input type="checkbox" 
						id="call_image_check_'.$item['id'].'"
						value="'.$item['id'].'"				 
						data-preview-media="'.$item_tiny.'" 
						data-attach-media="'.$item_attach.'" 
						data-attach-ext="'.$item_ext.'" 
						data-file-type="'.$item_type.'"  
						data-file-src="'.$item_small.'"  
						data-file-name="'.$item['name'].'" 
						data-file-size="'.$item['size'].'" 
						data-file-height="'.$item['custom_height'].'" 
						data-file-width="'.$item['custom_width'].'"
						data-file-created-at="'.$item['created_at'].'"								
						class="check_alt call_image_check">';	
					
					$list[] = $this->label_pos;	
					$list[] = $this->div_pos_alt;
				}
			break;
			// Details
			case '2';
				foreach ($media as $item)
				{
					$list[] = $this->div_pre;
					$list[] = $this->label_pre;
		
					switch ($item['ext'])
					{
							case 'jpg':
							case 'jpeg':
							case 'gif':
							case 'png':
								$item_tiny = $url_base.$item['filename'].'_tiny.'.$item['ext'];
								$item_small = $url_base.$item['filename'].'_medium.'.$item['ext'];
								$item_attach = $url_base.$item['filename'];
								$item_ext = $item['ext'];
								$item_type = 'img';
								
								$list[] = \Html::img($item_small, array("class"=>"img img-responsive"));
								break;
								
							default:					
								$item_tiny = 'fa fa-file-text-o fa-3x media-size-50';
								$item_small = '<i class="fa fa-file-text-o fa-5x media-size-150"></i>';
								$item_type = 'doc';
								$item_attach = $url_base.$item['filename'];
								$item_ext = $item['ext'];
								
								$list[] = $item_small;						
								break;
					}
		
					$list[] = '<input type="checkbox" 
						id="call_image_check_'.$item['id'].'"
						value="'.$item['id'].'"				 
						data-preview-media="'.$item_tiny.'" 
						data-attach-media="'.$item_attach.'" 
						data-attach-ext="'.$item_ext.'" 
						data-file-type="'.$item_type.'"  
						data-file-src="'.$item_small.'"  
						data-file-name="'.$item['name'].'" 
						data-file-size="'.$item['size'].'" 
						data-file-height="'.$item['custom_height'].'" 
						data-file-width="'.$item['custom_width'].'"
						data-file-created-at="'.$item['created_at'].'"								
						class="check call_image_check">';	
					
					$list[] = $this->label_pos;			
					$list[] = $this->caption_pre;
					$list[] = $item['caption'];
					$list[] = $this->caption_pos;
					$list[] = $this->div_pos;
				}
			break;
		}
		
		
		if ($array==true)
		{
			return $list;
		}
		else
		{
			return implode('', $list);
		}

	}
	
	
	
	
	
	
	
	
	
	
	
	
	
}