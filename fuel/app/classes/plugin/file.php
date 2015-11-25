<?php

namespace Plugin;

class File
{
	public static function filearray($file, $array, $post)
	{
		try
		{		
			$pathinfo = pathinfo($file);
			// varchar[255]
			//$filearray['basename'] = basename($file);
			$filearray['filename'] = $pathinfo['filename'];
			$filearray['dirname'] = dirname($file);
			//$filearray['saved_as'] = $array[0]['saved_as'];
			$filearray['saved_to'] = $array[0]['saved_to'];
			
			// varchar[50]
			$filearray['extension'] = $pathinfo['extension'];
			$filearray['mimetype'] = $array[0]['mimetype'];	
			$filearray['ext'] = strtolower($array[0]['extension']);
			$filearray['type'] = filetype($file); 		
			
			// int[11]
			$filearray['group'] = filegroup($file); 
			$filearray['owner'] = fileowner($file); 
			$filearray['perms'] = fileperms($file);
			$filearray['inode'] = fileinode($file); 
			$filearray['size'] = filesize($file); 
						
			// boolean
			$filearray['is_executable'] = is_executable($file); 
			$filearray['is_dir'] = is_dir($file); 
			$filearray['is_file'] = is_file($file);
			$filearray['is_readable'] = is_readable($file); 
			$filearray['is_writable'] = is_writable($file);
			//
			switch (strtolower($array[0]['extension']))
			{
					case 'jpg':
					case 'jpeg':
					case 'gif':
					case 'png':
						list($width, $height, $type, $attr) = getimagesize($file);
						$post['custom_width'] = $width;
						$post['custom_height'] = $height;
					break;
			}
			// varchar[50]
			$filearray['name'] = $post['name'];	
			$filearray['custom_width'] = (!null == $post['custom_width'] ? $post['custom_width']: 0);	
			$filearray['custom_height'] = (!null == $post['custom_height'] ? $post['custom_height']: 0);
	
			// text
			$filearray['caption'] = $post['caption']; // symbolic folder	 	
			$filearray['description'] = $post['description']; // symbolic folder	
			$filearray['realpath'] = realpath($file); 
	
			// int[11]
			$filearray['user_id'] = $post['user_id']; // symbolic folder	
			$filearray['plugin_id'] = (!null == $post['plugin_id'] ? $post['plugin_id'] :0); // symbolic folder	
			$filearray['section_id'] = (!null == $post['section_id'] ? $post['section_id'] :0); // symbolic folder	
			$filearray['folder_id'] = (!null == $post['folder_id'] ? $post['folder_id'] :0); // symbolic folder
			
			$filearray['created_at'] = time(); // symbolic folder
			$filearray['updated_at'] = time(); // symbolic folder
			
			return $filearray;
		}
		catch (Exception $e)
		{
			var_dump($e);
		}
		
	}

}