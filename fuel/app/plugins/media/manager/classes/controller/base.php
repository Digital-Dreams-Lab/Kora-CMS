<?php

namespace Plugin\Media;

class Media_Manager_Base extends \Plugin\Base
{
	public function __construct($data, $vars=null)
	{
		$this->start_plugin($data);
	}
}