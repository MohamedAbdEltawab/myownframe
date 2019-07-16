<?php




class QueryBuilder
{



	protected $pdo;



	public function __construct($pdo)
	{

		$this->pdo = $pdo;

	}



	public function selectAll($table)
	{

		$statment = $this->pdo->prepare("SELECT * FROM {$table}");

		$statment->execute();

		return $statment->fetchAll(PDO::FETCH_CLASS); 
	}



	public function insert($table, $parameters)
	{

		$sql = sprintf('insert into %s (%s) values (%s)',
				$table,
				implode(', ', array_keys($parameters)),
				':' . implode(':', array_keys($parameters))
				
			);
		

		try{

			$statment = $this->pdo->prepare($sql);
	
			$statment->execute($parameters);

		}catch(Exception $e){
			
			die("Whoops, something went wrong");
		
		}


	}



	public function find($table, $id)
	{

		$sql = "SELECT * FROM {$table} WHERE id = {$id}";

		$statment = $this->pdo->prepare($sql);

		$statment->execute();

		return $statment->fetchAll(PDO::FETCH_OBJ);

	}



	private function buildParameters($parameters)
	{
		$params = '';

		foreach ($parameters as $key => $value) {
			$params .= $key . " = :". $key . ', ';
		}

		return trim($params, ', ');

	}



	public function update($table, $id, $parameters)
	{

		$params = $this->buildParameters($parameters);

		$sql = sprintf('UPDATE %s SET %s WHERE id = %s',
				
				$table,

				$params,
				
				$id
				
			);


		$statment = $this->pdo->prepare($sql);

		$statment->execute($parameters);
		

	}



	public function delete($table, $id)
	{

		$sql = "DELETE FROM {$table} WHERE id = {$id}";

		$statment = $this->pdo->prepare($sql);
		
		$statment->execute();

	}


	
}