<?php

namespace App\Core;


class Input
{

	const POST 	=	'post';
	const GET 	=	'get';

	public static function exists($type)
	{
		switch ($type) {
			case 'post':
				return ( !empty($_POST) ) ? true : false;
				break;
			case 'get':
				return ( !empty($_GET) ) ? true : false;
				break;
			
			default:
				return false;
				break;
		}

	}


	public static function get($item)
	{
		if (isset($_POST[$item])) {
			
			return $_POST[$item];

		}elseif (isset($_GET['$item'])) {
			
			return $_GET[$item];
		}

		return '';
	}


	public static function required($value)
	{

		if (empty($value) || $value = '') {

			return true;
		}

	}


	public static function email($value)
	{

		return filter_var($value, FILTER_VALIDATE_EMAIL);
	
	}


    public static function filterInt($input)
    {

        return filter_var($input, FILTER_SANITIZE_NUMBER_INT);
    
    }

    public static function filterFloat($input)
    {

        return filter_var($input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    
    }

    public static function filterString($input)
    {

        return htmlspecialchars($input);
    
    }

    public static function filterEmail($input)
    {

    	return filter_var(

    		filter_var($input, FILTER_SANITIZE_EMAIL) , FILTER_VALIDATE_EMAIL
    		
    	);
    	
    }
}