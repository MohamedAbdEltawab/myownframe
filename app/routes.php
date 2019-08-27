<?php

use App\Core\Router;
/*
|
|----------------------------------------------------
| 	Web Routes	
|----------------------------------------------------
|
| Here is where you can register web routes for your application
|
*/

Router::get('', 'PagesController@home');

