<?php

class clinical_historyModel
{
	private $pdo;

	public function __CONSTRUCT()
	{
		try{
			$this->pdo= database::conectar();
		} catch (Exception $ex) {
			die ($e->getMessage());
		}
	}

/*CLASS REGISTRAR()-INSERT*/
public function Registrar_clinical_history(clinical_history $data)
{
	try
	{
	$sql = "INSERT INTO clinical_history (cod_hist_clini, date_opening, user_n_user_document, user_td_code_document ) 
			VALUES (NULL, NOW(), ?, ?)";

	$this->pdo->prepare($sql)
		->execute(
			 array(
			 	$data->__GET('user_n_user_document'),
			 	$data->__GET('user_td_code_document')
			 )
		);
		 	
		$stm1 = $this->pdo->prepare("SELECT cod_hist_clini FROM clinical_history ORDER BY cod_hist_clini DESC LIMIT 1");
		$stm1->execute();

		foreach($stm1->fetchAll(PDO::FETCH_OBJ) as $r)
		{
			$hc= $r->cod_hist_clini;

			echo $hc;
		}	


		$stm2 = $this->pdo->prepare("SELECT * from pathologies");
			$stm2->execute();

		foreach($stm2->fetchAll(PDO::FETCH_OBJ) as $r)
		{
				$p= $r->name_pathology;

				if (isset($_POST[$p])) {

					$sql1 = "INSERT INTO clinical_history_has_pathologies (clinical_history_cod_historical_clini, pathologies_name_pathology) VALUES ('$hc', '$p')";

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
public function Listar_clinical_history()
{
	try
	{
		$result =  array();

		$stm= $this->pdo->prepare("SELECT * FROM clinical_history join clinical_history_has_pathologies where cod_hist_clini = clinical_history_cod_historical_clini");
		$stm->execute();

		foreach ($stm->fetchALL(PDO::FETCH_OBJ) as $r)
		 {
			$cli = new  clinical_history();

			$cli->__SET('cod_hist_clini', $r->cod_hist_clini);
			$cli->__SET('date_opening', $r->date_opening);
			$cli->__SET('user_n_user_document', $r->user_n_user_document);
			$cli->__SET('user_td_code_document', $r->user_td_code_document);
			$cli->__SET('clinical_history_cod_historical_clini', $r->clinical_history_cod_historical_clini);
			$cli->__SET('pathologies_name_pathology', $r->pathologies_name_pathology);

			$result[] = $cli;
		}
		return $result;
	}
	catch(Exception $e)
	{
		die($e->getMessage());
	}
}

/*CLASS OBTENER()-SELECT*/
public function Obtener_clinical_history($clinical_history)
{
	try
	{
		$stm = $this->pdo
		->prepare("SELECT * FROM clinical_history WHERE cod_hist_clini = ?");

		$stm->execute(array($clinical_history));
		$c = $stm->fetch(PDO::FETCH_OBJ);

		$cli = new clinical_history();

		$cli->__SET('cod_hist_clini', $c->cod_hist_clini);
		$cli->__SET('date_opening', $c->date_opening);
		$cli->__SET('user_n_user_document', $c->user_n_user_document);
		$cli->__SET('user_td_code_document', $c->user_td_code_document);
		
		return $cli;
	} 	catch (Exception $e)
	{
		die($e->getMessage());
	}
}

/*CLASS ACTUALIZAR()-UPDATE*/
public function Actualizar_clinical_history(clinical_history $data)
{
	try
	{
		$sql = "UPDATE clinical_history SET cod_hist_clini = ?, date_opening = NOW(), user_n_user_document = ?, user_td_code_document = ?  WHERE cod_hist_clini = ?";

		$this->pdo->prepare($sql)
		     ->execute(
			   array(

				$data->__GET('cod_hist_clini2'),
				// $data->__GET('date_opening'),
				$data->__GET('user_n_user_document'),
				$data->__GET('user_td_code_document'),
				$data->__GET('cod_hist_clini')

			)
		);
				
	}	catch (Exception $e)
	{
		die($e->getMessage());
	}
}

/*CLASS ELIMINAR()-DELETE*/
public function Eliminar_clinical_history($clinical_history)
{
	try
	{
		$stm = $this->pdo
		        ->prepare("DELETE FROM clinical_history WHERE cod_hist_clini = ?");

		$stm->execute(array($clinical_history));
	}catch (Exception $e)
	{
		die($e->getMessage());
	}
}
}
?>