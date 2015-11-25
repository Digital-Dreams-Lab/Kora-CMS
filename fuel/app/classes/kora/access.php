<?php

namespace Kora;

/*
  Access class:
  
  Use access to set what "GROUPS" and access particular parts of the site.
  
  The access class will check the what 'group' th e user belongs to
  and then see if that 'group' can access the page.
  
  accessess->name:			Refers to the Request::active() /name in the url
  accessess->groups: 		Refers to the groups
  
*/

class Access
{
	static $__access;
	static $_access;
	
	static public function check($page)
	{		
		if ($system = \Model_Group::find(\Auth::get('group')))
		{			
			$access = \Model_Access::find_by_name($page);
					
			static::$_access = explode(',',$access->groups);
			static::$__access = $access;
		
			return true;
		}
		else 
		{
			return false;
		}		
	}
}