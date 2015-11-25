<?php

namespace Plugin;

interface intefacePage
{
    public function edit_page();
    public function delete_page();
}

class Page implements intefacePage
{	
    public static function forge($page_id)
	{
		$array = \DB::select()->from('pages')->where('id', $page_id)->execute()->as_array();
		
		return $array[0];
	}
	
    public function edit_page()
	{
	
	}
    
	public function delete_page()
	{
	
	}

}