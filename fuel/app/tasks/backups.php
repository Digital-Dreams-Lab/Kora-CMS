<?php

namespace Fuel\Tasks;

class Backups
{

	/*
	 *	@command	php oil refine pages:publish
	 *  @cron		* * * * * cd /var/www/cms/; /usr/bin/php oil r pages:publish
	 */
	public function database()
    {
    }

	/*
	 *	@command	php oil refine pages:archive
	 *  @cron		* * * * * cd /var/www/cms/; /usr/bin/php oil r pages:archive
	 */
    public function archive()
    {
    }
	
	
}

