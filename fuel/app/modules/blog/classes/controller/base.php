<?php

namespace Blog; 

class Controller_Base extends \Controller_Template
{
	public function before()
	{
		parent::before();

	}
	
	public function after($response)
    {
        $response = parent::after($response); // not needed if you create your own response object
		
        return $response; // make sure after() returns the response object
    }
}