<?php

return array(
	'defaults' => array(
		'errors' => array(
			// db custom error codes
			'1045' => "Please check your login details.",
			'2005' => "Please check your database host details.",
			'1049' => "Please check your database name.",
		),
		'tables_sql' => "select table_name from information_schema.tables where table_schema=",
	),
);