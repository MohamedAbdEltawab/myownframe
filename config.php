<?php

/*
|
|---------------------------------------------------------------------
| Config database
|---------------------------------------------------------------------
|
| Here is database configuration 
|
*/


return [

	'database' => [

		'name' 		 => '',

		'username' 	 => 'root',

		'password' 	 => '',

		'connection' => 'mysql:host=127.0.0.1',

		'options'	 => [

			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		]
	],


];