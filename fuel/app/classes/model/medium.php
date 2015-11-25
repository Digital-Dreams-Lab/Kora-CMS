<?php
class Model_Medium extends \Orm\Model
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
		'caption',
		'description',
		'realpath',
		'created_at',
		'updated_at',
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('name', 'Name', 'required|max_length[50]');
		$val->add_field('description', 'Description', 'required|max_length[255]');

		return $val;
	}
	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
	);

	public static function add_file($filearray)
	{
		$medium = Model_Medium::forge($filearray);
		
		if ($medium->save())
		{
			return true;		
		}		
		else
		{
			if (File::exists($saved_file))
			{
				File::delete($saved_file);
			}
			return false;
		}		
	}

	public static function add_image($filearray)
	{
		Config::load('media', true);

		$config = Config::get('images.config');
		$resize = Config::get('images.resize');
			
		$saved_file = $filearray['realpath'];	
		$new_save_dir = $filearray['saved_to'].$filearray['filename'];	
		
		$medium = Model_Medium::forge($filearray);
		
		if ($medium->save())
		{
			if ($image = Image::load($saved_file))				
			{						
				foreach ($resize as $key => $resized) {
					if ($key=='custom' && $filearray['custom_height'] && $filearray['custom_width'])
					{					
						$image
							->resize($filearray['custom_height'], $filearray['custom_width'])
							->save($new_save_dir.'_custom');
					}
					else
					{
						$image
							->resize($resized[0], $resized[1])
							->save($new_save_dir.'_'.$key);
					}
				}

				if (File::exists($saved_file))
				{
					File::delete($saved_file);
				}
				return true;		
			}	
		}
		
		else
		{
			if (File::exists($saved_file))
			{
				File::delete($saved_file);
			}
			return false;
		}		
	}

	protected static $_table_name = 'medias';
}
