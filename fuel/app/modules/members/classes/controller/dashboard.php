<?php

namespace Members;

class Controller_Members_Dashboard extends Controller_Members
{


	/**
	 * The basic welcome message
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_index()
	{
		$this->template->title = "Dashboard";
		$this->template->content = \View::forge('members/dashboard');
	}
}