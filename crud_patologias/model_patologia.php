<?php 

class diseaseModel
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
public function Registrar_patologia(type_disease $data)
{
	try
	{
	$sql = "INSERT INTO disease (name_disease, state_disease) 
			VALUES (?, ?)";

	$this->pdo->prepare($sql)
		 ->execute(
		 	array(
		 		$data->__GET('name_disease'),
		 		$data->__GET('state_disease')
		 	)
		 );			
	} catch (exception $e)
	{
		die ($e->getMessage());
	}
}

/*CLASS LISTAR()-SELECT*/
public function Listar_patologia()
{
	try
	{
		$result = array();

		$stm = $this->pdo->prepare("SELECT * FROM disease");
		$stm->execute();

		foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) 
		{
			$disease = new type_disease();

			$disease->__SET('name_disease', $r->name_disease);
			$disease->__SET('state_disease', $r->state_disease);

			$result[] = $disease;
		}
		return $result;
	}
	catch(exception $e)
	{
		die ($e->getMessage());
	}
}

/*CLASS OBTENER()-SELECT*/
public function Obtener_patologia($name_disease)
{
	try
	{
		$stm = $this->pdo
				  ->prepare("SELECT * FROM disease WHERE name_disease = ? ");
				   

		$stm->execute(array($name_disease));
		$r = $stm->fetch(PDO::FETCH_OBJ);

		$disease = new type_disease();

			$disease->__SET('name_disease', $r->name_disease);
			$disease->__SET('state_disease', $r->state_disease);

		return $disease;
	}	catch (exception $e)
	{
		die ($e->getMessage());
	}
}

/*CLASS ACTUALIZAR()-UPDATE*/
public function Actualizar_patologia(type_disease $data)
{
	try
	{
		$sql = "UPDATE disease SET name_disease = ?, state_disease = ?	WHERE name_disease = ?";

		
		$this->pdo->prepare($sql)
			 ->execute(
			 	array(

			 		$data->__GET('name_disease2'),
			 		$data->__GET('state_disease'),
			 		$data->__GET('name_disease')

			 		)
			 );
	}	catch (exception $e)
	{
		die ($e->getMessage());
	}
}		

/*CLASS ELIMINAR()-DELETE*/
public function Eliminar_patologia($name_disease)
{
	try
	{
		$stm = $this->pdo
				->prepare("DELETE FROM disease WHERE name_disease = ?");

		$stm->execute(array($name_disease));
	} catch (exception $e)
	{
		die ($e->getMessage());
	}
}
}
?>