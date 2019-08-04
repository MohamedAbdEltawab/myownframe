<?php

namespace App\Core;


trait Validator
{

	public $passed = false;

	private $errors = [];
	
	/**
	 * This function will validate request with the given rules 
	 */
	public function validate($request = [] , $rules = [])
	{

		foreach ($request as $requestname => $requestvalue) :
		
			if (array_key_exists($requestname, $rules)) :
				
				$ruleValue = $rules[$requestname];
				
				$requestvalue = trim($requestvalue);

				$array_rules = explode("|", $ruleValue);
				
				foreach ($array_rules as $rulekey => $rulevalue) :
						// var_dump($value);
				
					if($rulevalue === "required" && Input::required($requestvalue)){

						$this->addErrors("{$requestname} is required");
							
					} else {

						// check if string contain " : "
						$pos = strpos($rulevalue, ":");

						// if true 
						if ($pos == true) {
							
							// Convert this string to array
							$value = explode(":", $rulevalue);
							
							//	exp :  $value = ['min', '3'];

							list($key, $val) = $value; // 


							switch ($key) :

								case 'min':

									if(strlen($requestvalue) < (int)$val){

										$this->addErrors("{$requestname} must be minimum {$val} characters");
									}

									break;

								case 'max':

									if(strlen($requestvalue) > (int)$val){

										$this->addErrors("{$requestname} must be maximum {$val} characters");
									}

									break;

							endswitch;

							
						}else{
							
							switch ($rulevalue) :
								
								case 'email':

									if (! Input::email($requestvalue)) {

										$this->addErrors("{$requestname} is not valid");

									}

									break;

								case 'unique':

									break;

								case 'password':
									
									if($requestvalue != $request[$rulevalue]){

										$this->addErrors("{$requestname} must be match");

									}
									
									break;

							endswitch;
						}

					}
				
				endforeach;
			
			endif;
		
		endforeach;



		if (empty($this->errors)) {

			$this->passed = true;
			
		}

		return $this;
	}





	public function errors()
	{
		if (empty($this->errors)) return false;

		return $this->errors;
	}



	private function addErrors($errors)
	{
		$this->errors[] = $errors;
	}




}





