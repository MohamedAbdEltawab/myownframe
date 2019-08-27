<?php


function view($name, $data = [])
{

	extract($data);

	return require "app/views/{$name}.view.php";
}



function redirect($page, $data=[])
{
	
	extract($data);
	
	header("Location: /{$page}");

}

