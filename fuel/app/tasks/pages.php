<?php

namespace Fuel\Tasks;

class Pages
{
	/*
	 *	Publish task to check pages to publish every 6 hours	
	 *
	 *	@command	php oil refine pages:publish
	 *  @cron		* 6 * * * cd /var/www/cms/; /usr/bin/php oil r pages:publish
	 */
	public function publish()
    {
		// Query database and get temporary status: SELECT * FROM 'pages' WHERE 'status' = 2 
		$pages_query = \Model_Page::query()
				->where('status', '=', 2)
				->get();
		// Current timestamp
		$now = time(); 
		// Check start at date is greater than current date 
		// Check pages not active
		// Temporary pages have hit date to be published  	
		$pages_start = array();		
		$pages_end = array();			
		foreach ($pages_query as $item)
		{
			if ($now >= $item->start_at && $item->active == 0)
			{
				$reset_page = \Model_Page::find($item->id);
				$reset_page->active = 1;
				$reset_page->save();
			}
			
			if ($now >= $item->end_at && $item->active == 1)
			{
				$reset_page = \Model_Page::find($item->id);
				$reset_page->active = 0;
				$reset_page->status = 3;
				$reset_page->save();
			} 
		}	
		//*/
	}

	/*
	 *	@command	php oil refine pages:archive
	 *  @cron		* * * * * cd /var/www/cms/; /usr/bin/php oil r pages:archive
	 */
    public function archive()
    {
    }
	
	
}