<?php 

class historyModel
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
public function Registrar_historia(type_history $data)
{
	try
	{
	$sql = "INSERT INTO history_clinic (cod_history, date_history, user_n_document, user_type_document ) 
			VALUES (NULL, NOW(), ?, ?)";

	$this->pdo->prepare($sql)
		->execute(
			 array(
			 	$data->__GET('user_n_document'),
			 	$data->__GET('user_type_document')
			 )
		);
		 	
		$stm1 = $this->pdo->prepare("SELECT cod_history FROM history_clinic ORDER BY cod_history DESC LIMIT 1");
		$stm1->execute();

		foreach($stm1->fetchAll(PDO::FETCH_OBJ) as $r)
		{
			$hc= $r->cod_history;
		}	


		$stm2 = $this->pdo->prepare("SELECT * from disease");
			$stm2->execute();

		foreach($stm2->fetchAll(PDO::FETCH_OBJ) as $r)
		{
				$p= $r->name_disease;

				if (isset($_POST[$p])) {

					$sql1 = "INSERT INTO history_clinic_disease (disease_cod_disease, history_cod_disease) VALUES ('$p', '$hc')";

		     		$this->pdo->prepare($sql1)->execute();
				}
		}
	}
		catch(Exception $e)
		{
			die($e->getMessage());
	}
}

/*CLASS LISTAR()-SELECT*/
public function Listar_historia()
{
	try
	{
		$result = array();

		$stm = $this->pdo->prepare("SELECT * FROM history_clinic");
		$stm->execute();

		foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) 
		{
			$historia = new type_history();

			$historia->__SET('cod_history', $r->cod_history);
			$historia->__SET('date_history', $r->date_history);
			$historia->__SET('user_n_document', $r->user_n_document);
			$historia->__SET('user_type_document', $r->user_type_document);
			

			$result[] = $historia;
		}
		return $result;
	}
	catch(exception $e)
	{
		die ($e->getMessage());
	}
}

/*CLASS OBTENER()-SELECT*/
public function Obtener_historia($cod_history)
{
	try
	{
		$stm = $this->pdo
				  ->prepare("SELECT * FROM history_clinic WHERE cod_history = ? ");
				   

		$stm->execute(array($cod_history));
		$r = $stm->fetch(PDO::FETCH_OBJ);

		$historia = new type_history();

			$historia->__SET('cod_history', $r->cod_history);
			$historia->__SET('date_history', $r->date_history);
			$historia->__SET('people_n_document', $r->people_n_document);
			$historia->__SET('people_type_document_people', $r->people_type_document_people);
			

		return $historia;
	}	catch (exception $e)
	{
		die ($e->getMessage());
	}
}

/*CLASS ACTUALIZAR()-UPDATE*/
public function Actualizar_historia(type_history $data)
{
	try
	{
		$sql = "UPDATE history_clinic SET cod_history = ?, date_history = ?, people_n_document=?,people_type_document_people=? WHERE cod_history = ?";

		
		$this->pdo->prepare($sql)
			 ->execute(
			 	array(

			 		$data->__GET('cod_history2'),
			 		$data->__GET('date_history'),
			 		$data->__GET('people_n_document'),
			 		$data->__GET('people_type_document_people'),
			 		$data->__GET('cod_history')
			 		

			 		)
			 );
	}	catch (exception $e)
	{
		die ($e->getMessage());
	}
}		

/*CLASS ELIMINAR()-DELETE*/
public function Eliminar_historia($cod_history)
{
	try
	{
		$stm = $this->pdo
				->prepare("DELETE FROM history_clinic WHERE cod_history = ?");

		$stm->execute(array($cod_history));
	} catch (exception $e)
	{
		die ($e->getMessage());
	}
}
}
?>