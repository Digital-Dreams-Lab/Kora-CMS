<?php

namespace Plugin\Forms;

class Koraforms_Base extends \Plugin\Base
{
	public function __construct($data, $vars=null)
	{
		$this->start_plugin($data);
	}
}