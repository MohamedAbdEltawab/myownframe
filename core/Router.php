<?php


namespace App\Core;


class Router

{

	protected static $routes = [

		'GET' => [],
		'POST' => []
	];


	public static function load($file)
	{
		$router = new static;

		require $file;

		return $router;

	}


	public static function get($uri, $controller)
	{

		self::$routes['GET'][$uri] = $controller;
	
	}

	public static function post($uri, $controller)
	{

		self::$routes['POST'][$uri] = $controller;
	
	}



	public function direct ($uri, $requestType)

	{

		if (array_key_exists($uri, self::$routes[$requestType])) {
			
			return $this->callAction(
				
				...explode('@', self::$routes[$requestType][$uri])
			);

		}else{
			
			foreach (self::$routes[$requestType] as $key => $val){
			
				$pattern = preg_replace('#\(/\)#', '/?', $key);
				$pattern = "@^" .preg_replace('/{([a-zA-Z0-9\_\-]+)}/', '(?<$1>[a-zA-Z0-9\_\-]+)', $pattern). "$@D";
				preg_match($pattern, $uri, $matches);
				array_shift($matches);
			
				if($matches){
			
					$getAction = explode('@', $val);
					return $this->callAction($getAction[0], $getAction[1], $matches);
			
				}
			}
		
		}
		

		echo "<h1>Page Not Found </h1>";
		// throw new Exception('No route defined for this URI.');


	}

	protected function callAction($controller, $action, $vars = [])
	{

		$controller = "App\Controllers\\{$controller}";
		
		$controller = new $controller;

		if (! method_exists($controller, $action)) {
			
			throw new Exception("{$controller} doesnt respond to {$action} action");
			
		}

		return $controller->$action($vars);
	}

}