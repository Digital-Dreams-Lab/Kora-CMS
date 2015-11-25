<?php

namespace Plugin\Media;

class Model_Media_Manager extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'user_id',
		'plugin_id',
		'section_id',
		'folder_id',
		'group',
		'owner',
		'perms',
		'inode',
		'size',
		'custom_width',
		'custom_height',
		'name',
		'extension',
		'mimetype',
		'type',
		'ext',
		'dirname',
		'filename',
		'saved_to',
		'folder_base',
		'folder_media',
		'caption',
		'description',
		'realpath',
		'created_at',
		'updated_at',
	);

	public static function validate($factory)
	{
		$val = \Validation::forge($factory);
		$val->add_field('name', 'Name', 'required|max_length[50]');
		$val->add_field('description', 'Description', 'required|max_length[255]');
		$val->add_field('image', 'Image', 'required');

		return $val;
	}
	protected static $_observers = array(
		'\Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'\Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
	);
	public static function add_doc($filearray)
	{
		$medium = Model_Media_Manager::forge($filearray);
		
		if ($medium->save())
		{
			return true;		
		}
		
		else
		{
			// Now we delete the original saved image
			if (\File::exists($saved_file))
			{
				\File::delete($saved_file);
			}
			return false;
		}		
	}
	public static function add_img($filearray)
	{
		// Custom configuration for this upload
		\Config::load('media', true);
		// Set custom config details 
		$config = Config::get($filearray['folder_base'].'.config');
		$resize = Config::get($filearray['folder_base'].'.resize');
			
		$saved_file = $filearray['realpath'];	
		$new_save_dir = $filearray['saved_to'].$filearray['filename'];	
		
		$medium = Model_Media_Manager::forge($filearray);
		
		var_dump($config);
		if ($medium->save())
		{
			// Load saved file to Image class 
			if ($image = \Image::load($saved_file))				
			{						
				// Loop through config create 3 additional file sizes
				foreach ($resize as $key => $resized) {
					if ($filearray['custom_height'] !='' && $filearray['custom_width'])
					{					
						$image
							->resize($filearray['custom_height'], $filearray['custom_width'])
							->save($new_save_dir.'_'.$key);
					}
					else
					{
						$image
							->resize($resized[0], $resized[1])
							->save($new_save_dir.'_'.$key);
					}
				}
				// Now we delete the original saved image
				if (\File::exists($saved_file))
				{
					\File::delete($saved_file);
				}
				return true;		
			}	
		}
		
		else
		{
			// Now we delete the original saved image
			if (\File::exists($saved_file))
			{
				\File::delete($saved_file);
			}
			return false;
		}		
	}

	protected static $_table_name = 'medias';
}

