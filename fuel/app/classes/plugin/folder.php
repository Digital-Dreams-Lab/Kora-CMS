<?php

namespace Plugin;


class Folder
{
	public $paths = array();
	public $trail = array();
	public $list = array();
	public $categories = array();
	public $folder_levels = array();

	public $li_pre = '<li><span class="divider"></span>';
	public $li_pos = '</li>';
	public $li_top = '<li><a href="#" class="call_get_folder" data-folder-id="0"><i class="fa fa-home"></i></a></li>';
    public $li_bot = '<li class="pull-right"><i class="fa fa-refresh" id="spinner"></i></li>';                            
							
	public function __construct($folder_id)
	{
		$this->folder_id = $folder_id;
	}

	public function set_paths($folder_id)
	{
		if (!null == $folder_id or $folder_id != 0)
		{		
			$row = \DB::select_array(array('*'))->from('folders')->where('id', $folder_id)->execute()->as_array();

			$this->paths[] = $row[0];		
			
			if ($row[0]['parent_id'])
			{
				$this->set_paths($row[0]['parent_id']);
			}
			return $this->paths;
		}
		// esle if folder  == 0 got to parent_id
	}

	public function get_folders_old()
	{
		$array = \DB::select_array(array('id', 'name'))->from('folders')->execute()->as_array();		
		$output = '<option value="0">Home</option>';
		foreach ($array as $value)
		{
                $output .= '<option value="'.$value['id'].'">';			
                $output .= $value['name'];			
                $output .= '</option>';			
		}
		return $output;		
	}

	public function set_tree()
	{
		$rows = \DB::select_array(array('id', 'parent_id', 'name', 'description'))->from('folders')->execute()->as_array();
		
		foreach ($rows as $row)
		{
			$this->categories[] = $row;
		}
	}

	public function set_exclude()
	{
		$rows = \DB::select_array(array('folder_id'))->from('medias')->execute()->as_array();
		
		foreach ($rows as $row)
		{
			$this->exclude[] = $row['folder_id'];
		}
	}


    public function view_tree()
    {
		$this->set_tree();
		$this->set_exclude();
				
        //Generate tree list
        $output = "";
        for ($i = 0; $i < count($this->categories); $i++) {
            if ($this->categories[$i]["parent_id"]=="0")
            {
                $output .= '<li class="list-unstyled call_folder_actions">';
				$output .= 		'<a href="#" class="call_get_folder" data-folder-id="'.$this->categories[$i]["id"].'">';
				$output .= 				(($this->folder_id==$this->categories[$i]["id"])? '<i class="fa fa-folder-open"></i> ':'<i class="fa fa-folder"></i> ');
				$output .= 				$this->categories[$i]["name"];
				$output .= 		'</a>';
				$output .= 		' <i data-folder-name="'.$this->categories[$i]["name"].'" data-folder-parent-id="'.$this->categories[$i]["parent_id"].'" data-folder-id="'.$this->categories[$i]["id"].'" class="fa fa-i-cursor show_rename_folder_action"></i>';
				
				$output .= 		in_array($this->categories[$i]["id"],$this->exclude) ? '': ' <i data-folder-name="'.$this->categories[$i]["name"].'" data-folder-id="'.$this->categories[$i]["id"].'" class="fa fa-trash show_delete_folder_action"></i>';	
				
				$output .= 		'<ul>';
                $output .= 			$this->get_children($this->categories[$i]["id"]);
                $output .= 		'</ul>';
				$output .= '</li>';
            }
        }
        return $output;
    }
    
    public function get_children($parent_id)
    {
        //Get all the nodes for particular ID
        $output = "";
        for ($i = 0; $i < count($this->categories); $i++) {
            if ($this->categories[$i]["parent_id"] == $parent_id)
            {
                $output .= '<li class="list-unstyled call_folder_actions">';
				$output .= '<a href="#" class="call_get_folder show_folder_actions" data-folder-id="'.$this->categories[$i]["id"].'">';
				$output .= (($this->folder_id==$this->categories[$i]["id"])? '<i class="fa fa-folder-open"></i> ':'<i class="fa fa-folder"></i> ');
				
				$output .= $this->categories[$i]["name"];
				$output .= "</a>";
				
				$output .= 		' <i data-folder-name="'.$this->categories[$i]["name"].'" data-folder-parent-id="'.$this->categories[$i]["parent_id"].'" data-folder-id="'.$this->categories[$i]["id"].'" class="fa fa-i-cursor show_rename_folder_action"></i>';	
				
				
				$output .= 		in_array($this->categories[$i]["id"],$this->exclude) ? '': ' <i data-folder-name="'.$this->categories[$i]["name"].'" data-folder-id="'.$this->categories[$i]["id"].'" class="fa fa-trash show_delete_folder_action"></i>';	
				
						
				$output .= 		'<ul>';
                $output .= 			$this->get_children($this->categories[$i]["id"]);
                $output .= 		'</ul>';
				$output .= '</li>';
            }
        }
        return $output;
    }
	
    public function get_folders()
    {
		$rows = \DB::select_array(array('id', 'parent_id', 'name', 'description'))->from('folders')->execute()->as_array();

		foreach ($rows as $row)
		{
			$this->folder_levels[] = $row;
		}
        //Generate tree list
        $output = '<option value="0">Home</option>';
        for ($i = 0; $i < count($this->folder_levels); $i++) {
            if ($this->folder_levels[$i]["parent_id"]=="0")
            {
                $output .= '<option value="'.$this->folder_levels[$i]["id"].'">';
				$output .= $this->folder_levels[$i]["name"];
				$output .= '</option>';
				$output .= $this->get_folders_children($this->folder_levels[$i]["id"]);
            }
        }
        return $output;
    }
    
    public function get_folders_children($parent_id)
    {
        //Get all the nodes for particular ID
        $output = "";
        for ($i = 0; $i < count($this->folder_levels); $i++) {
            if ($this->folder_levels[$i]["parent_id"] == $parent_id)
            {
                $output .= '<option value="'.$this->folder_levels[$i]["id"].'">';
				$output .= ' - '.$this->folder_levels[$i]["name"];
				$output .= '</option>';
				$output .= $this->get_folders_children($this->folder_levels[$i]["id"]);
            }
        }
        return $output;
    }


	public function get_folder($folder_id)
	{		
		if (!null == $folder_id or $folder_id != 0)
		{		
			$row = \DB::select_array(array('*'))->from('folders')->where('id', $folder_id)->execute()->as_array();
			
			return '<input type="hidden" id="folder_id" name="folder_id" value="'.$row[0]['id'].'" />';	
		}
		else
		{
			return '<input type="hidden" id="folder_id" name="folder_id" value="0" />';	
		}
	}	

	public function get_hidden($folder_id, $per_page, $page_num)
	{		
		if (!null == $folder_id)
		{		
			$row = \DB::select_array(array('*'))->from('folders')->where('id', $folder_id)->execute()->as_array();
						
			$hidden =  	'<input type="hidden" id="folder_id" name="folder_id" value="'.$row[0]['id'].'" />'.	
						'<input type="hidden" id="per_page" name="per_page" value="'.$per_page.'" />'.	
						'<input type="hidden" id="page_num" name="page_num" value="'.$page_num.'" />';		
		}
		else
		{
			$hidden =  	'<input type="hidden" id="folder_id" name="folder_id" value="0" />'.	
						'<input type="hidden" id="per_page" name="per_page" value="'.$per_page.'" />'.	
						'<input type="hidden" id="page_num" name="page_num" value="'.$page_num.'" />';
		}	
		
		return $hidden;
	}	

	public function get_hidden_alt($folder_id, $per_page, $page_num, $list_style)
	{		
		if (!null == $folder_id)
		{		
			$row = \DB::select_array(array('*'))->from('folders')->where('id', $folder_id)->execute()->as_array();
						
			$hidden =  	'<input type="hidden" id="folder_id" name="folder_id" value="'.$row[0]['id'].'" />'.	
						'<input type="hidden" id="per_page" name="per_page" value="'.$per_page.'" />'.	
						'<input type="hidden" id="page_num" name="page_num" value="'.$page_num.'" />'.	
						'<input type="hidden" id="list_style" name="list_style" value="'.$list_style.'" />';		
		}
		else
		{
			$hidden =  	'<input type="hidden" id="folder_id" name="folder_id" value="0" />'.	
						'<input type="hidden" id="per_page" name="per_page" value="'.$per_page.'" />'.	
						'<input type="hidden" id="page_num" name="page_num" value="'.$page_num.'" />'.	
						'<input type="hidden" id="list_style" name="list_style" value="'.$list_style.'" />';
		}	
		
		return $hidden;
	}
		
	public function get_paths($folder_id, $array=true)
	{
		$this->list[] = $this->li_top;

		if (!null == $this->set_paths($folder_id))
		{
			$paths = array_reverse($this->paths);
			
			foreach ($paths as $value)
			{
				$this->list[] = $this->li_pre.'<a href="#" class="call_get_folder" data-folder-id="'.$value['id'].'">'.$value['name'].'</a>'.$this->li_pos;
			}
		}

		$this->list[] = $this->li_bot;

		if ($array==true)
		{
			return $this->list;
		}
		else
		{
			return implode('', $this->list);
		}

	}

}