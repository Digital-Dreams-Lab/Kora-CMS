<?php

namespace Kora;


class Notifications
{
	public static function forge($event)
	{
		$route 		= isset(\Request::active()->route->segments[0]) ? \Request::active()->route->segments[0]: '';
		$controller	= isset(\Request::active()->route->segments[1]) ? \Request::active()->route->segments[1]: '';
		$action 	= isset(\Request::active()->route->segments[2]) ? \Request::active()->route->segments[2]: '';
		
		$_controller= isset(\Request::active()->route->controller) ? \Request::active()->route->controller: '';
		$_action	= isset(\Request::active()->route->action) ? \Request::active()->route->action: '';
		
		$_status	= '1';
		 
		$notification = \Model_Notification::forge(array(
			'route'			=> $route,
			'controller'	=> $controller,
			'action'		=> $action,
			'_controller'	=> $_controller,
			'_action'		=> $_action,
			'_status'		=> $_status,
			'event' 		=> $event,
		));

		if ($notification and $notification->save())
		{
			\Session::set_flash('success', e('Added notification #'.$notification->id.'.'));
		}

		else
		{
			\Session::set_flash('error', e('Could not save notification.'));
		}
	}
}