<?php 

class exerciseModel
{
	private $pdo;

	public function __CONSTRUCT()
	{
		try {
			$this->pdo= database::conectar();
		} catch (exception $ex) {
			die($e->getMessage());
		}
	}


/*CLASS REGISTRAR()-INSERT*/
public function Registrar_ejercicio(type_exercise $data)
{
	try
	{
	$sql = "INSERT INTO exercise (name_ejr, state_ejr,machines_maqac) 
			VALUES (?, ?, ?)";

	$this->pdo->prepare($sql)
		 ->execute(
		 	array(
		 		$data->__GET('name_ejr'),
		 		$data->__GET('state_ejr'),
		 		$data->__GET('machines_maqac')
		 	)
		 );				       
	} catch (exception $e)
	{
		die ($e->getMessage());
	}
}

/*CLASS LISTAR()-SELECT*/
public function Listar_ejercicio()
{
	try
	{
		$result = array();

		$stm = $this->pdo->prepare("SELECT * FROM exercise");
		$stm->execute();

		foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) 
		{
			$ejercicio = new type_exercise();

			$ejercicio->__SET('name_ejr', $r->name_ejr);
			$ejercicio->__SET('state_ejr', $r->state_ejr);
			$ejercicio->__SET('machines_maqac', $r->machines_maqac);

			$result[] = $ejercicio;
		}
		return $result;
	}
	catch(exception $e)
	{
		die ($e->getMessage());
	}
}

/*CLASS OBTENER()-SELECT*/
public function Obtener_ejercicio($name_ejr)
{
	try
	{
		$stm = $this->pdo
				  ->prepare("SELECT * FROM exercise WHERE name_ejr = ? ");
				   

		$stm->execute(array($name_ejr));
		$r = $stm->fetch(PDO::FETCH_OBJ);

		$ejercicio = new type_exercise();

			$ejercicio->__SET('name_ejr', $r->name_ejr);
			$ejercicio->__SET('state_ejr', $r->state_ejr);
			$ejercicio->__SET('machines_maqac', $r->machines_maqac);

		return $ejercicio;
	}	catch (exception $e)
	{
		die ($e->getMessage());
	}
}

/*CLASS ACTUALIZAR()-UPDATE*/
public function Actualizar_ejercicio(type_exercise $data)
{
	try
	{
		$sql = "UPDATE exercise SET name_ejr = ?, state_ejr = ?, machines_maqac = ? 	WHERE name_ejr = ?";

		
		$this->pdo->prepare($sql)
			 ->execute(
			 	array(

			 		$data->__GET('name_ejr2'),
			 		$data->__GET('state_ejr'),
			 		$data->__GET('machines_maqac'),
			 		$data->__GET('name_ejr')

			 		)
			 );
	}	catch (exception $e)
	{
		die ($e->getMessage());
	}
}		

/*CLASS ELIMINAR()-DELETE*/
public function Eliminar_ejercicio($name_ejr)
{
	try
	{
		$stm = $this->pdo
				->prepare("DELETE FROM exercise WHERE name_ejr = ?");

		$stm->execute(array($name_ejr));
	} catch (exception $e)
	{
		die ($e->getMessage());
	}
}
}
?>