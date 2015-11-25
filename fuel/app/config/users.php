<?php

return array(
	'forms' => array(
		'select_options' => array(
			'levels' => array(
				0 => 'Level 0',
				1 => 'Level 1',
				2 => 'Level 2',
				3 => 'Level 3',
			),
		),
		'profile_fields' => array(
			'profile' => array(
				'first_name' 	=> 'First name', 
				'last_name' 	=> 'Last name', 
				'address' 		=> 'Address', 
				'city'	 		=> 'City', 
			),
			'preferences' => array(			
				
				'avatar' => array(
					
					'data' 	=> array( 
						'1' 	=> '1',						 
						'2' 	=> '2',
						'3' 	=> '3',
						'4' 	=> '4',
						'5' 	=> '5',						 
						'6' 	=> '6',
						'7' 	=> '7',
						'8' 	=> '8',
						'9' 	=> '9',						 
						'10' 	=> '10',
						'11' 	=> '11',
						'12' 	=> '12',
					), 
				
					'title'	=> 'Avatar',
					'type'	=> 'radio'
				),			
				
				'notifications' => array(	
					'data' 	=> array( 
						'0' 	=> 'None',
						'1' 	=> 'New users only',						 
						'2' 	=> 'New pages only',
						'3' 	=> 'New users, pages only'
					), 
					'title'	=> 'System notifications',
					'type'	=> 'select'
				),	
				 
				'date_format' => array(	
					'data' 	=> array( 
						'd-m-y' 	=> 'd-m-y \(\d-\m-\y\)',						 
						'm-d-y' 	=> 'm-d-y',
						'd-m-Y' 	=> 'd-m-Y',
						'm-d-Y' 	=> 'm-d-Y', 
						'd/m/y' 	=> 'd/m/y',
						'm/d/y' 	=> 'm/d/y',
						'd/m/Y' 	=> 'd/m/Y',
						'm/d/Y' 	=> 'm/d/Y',						
						'jS F Y'	=> 'jS F Y',					
						'l jS F Y'	=> 'l jS F Y'
					), 
					'title'	=> 'Date format',
					'type'	=> 'select'
				),	
				
				'time_format' => array( 	
					'data' 	=> array(						 
						'h:i:s' 	=> 'h:i:s', 							
						'g:i a' 	=> 'g:i a', 							
						'g:i A' 	=> 'g:i A', 
						'H:i:s' 	=> 'H:i:s', 							
						'G:i a' 	=> 'G:i a', 							
						'G:i A' 	=> 'G:i A',							
					),
					'title'	=> 'Time format',
					'type'	=> 'select'
				),
				
				'language' => array( 
					'title'	=> 'System notifications',
					'type'	=> 'input',	
					'data' 	=> array()
				),
				'time_zone'=> array( 
					'title'	=> 'Time zone',
					'type'	=> 'input',	
					'data' 	=> array()
				),
			),
		),
	),
);

