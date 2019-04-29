<?php 

class modelmeasurement
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
public function Registrar_medidas(type_measurement $data)
{
	try
	{
	$sql = "INSERT INTO measurement (cod_measurement,
	                            	 back,
	                            	 chest,
	                          	 	 abdomen,
	                           	 	 leg,
	                            	 calf_muscle,
	                            	 arm,
	                            	 forearm,
	                            	 weight)
	                            	 

			VALUES (?,?,?,?,?,?,?,?,?)";

	$this->pdo->prepare($sql)
		 ->execute(
		 	array(
		 		$data->__GET('cod_measurement'),
		 		$data->__GET('back'),
		 		$data->__GET('chest'),
		 		$data->__GET('abdomen'),
		 		$data->__GET('leg'),
		 		$data->__GET('calf_muscle'),
		 		$data->__GET('arm'),
		 		$data->__GET('forearm'),
		 		$data->__GET('weight'),
		 	)
		 );
	 $stm1=$this->pdo->prepare("SELECT cod_measurement FROM measurement ORDER BY cod_measurement DESC LIMIT 1");

      $stm1->execute();

      foreach ($stm1->fetchAll(PDO::FETCH_OBJ) as $r) {
      	$hc=$r->cod_measurement;
      	echo $hc;
      }

$stm2 = $this->pdo->prepare("SELECT * from history_clinic");
			$stm2->execute();

			//Realiza el ciclo de todos los objetos o lines que se encuentra en la consulta

			foreach($stm2->fetchAll(PDO::FETCH_OBJ) as $diss)
			{

				// variable que almacena lo que encunetra en el campo cod_telefono
				$history= $diss->cod_history;

				// Comporbar si el checbox esta selecionado (true) que tiene la variable seleccionada anteriormente - cod_telefono.
				if (isset($_POST[$history])) {

	$stm3 = $this->pdo->prepare("INSERT INTO history_clinic_measurement (history_cod_measurement, history_cod_history) VALUES('$history','$hc')");
			$stm3->execute();

}
			}	 			
	} catch (exception $e)
	{
		die ($e->getMessage());
	}
}

/*CLASS LISTAR()-SELECT*/
public function Listar_medidas()
{
	try
	{
		$result = array();

		$stm = $this->pdo->prepare("SELECT * FROM measurement");
		$stm->execute();

		foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) 
		{
			$measure = new type_measurement();

			$measure->__SET('cod_measurement', $r->cod_measurement);
			$measure->__SET('back', $r->back);
			$measure->__SET('chest', $r->chest);
			$measure->__SET('abdomen', $r->abdomen);
			$measure->__SET('leg', $r->leg);
			$measure->__SET('calf_muscle', $r->calf_muscle);
			$measure->__SET('arm', $r->arm);
			$measure->__SET('forearm', $r->forearm);
			$measure->__SET('weight', $r->weight);

			$result[] = $measure;
		}
		return $result;
	}
	catch(exception $e)
	{
		die ($e->getMessage());
	}
}

/*CLASS OBTENER()-SELECT*/
public function Obtener_medidas($cod_measurement)
{
	try
	{
		$stm = $this->pdo
				  ->prepare("SELECT * FROM measurement WHERE cod_measurement = ?");

		$stm->execute(array($cod_measurement));
		$r = $stm->fetch(PDO::FETCH_OBJ);

		$measure = new type_measurement();

			$measure->__SET('cod_measurement', $r->cod_measurement);
			$measure->__SET('back', $r->back);
			$measure->__SET('chest', $r->chest);
			$measure->__SET('abdomen', $r->abdomen);
			$measure->__SET('leg', $r->leg);
			$measure->__SET('calf_muscle', $r->calf_muscle);
			$measure->__SET('arm', $r->arm);
			$measure->__SET('forearm', $r->forearm);
			$measure->__SET('weight', $r->weight);

		return $measure;
	}	catch (exception $e)
	{
		die ($e->getMessage());
	}
}

/*CLASS ACTUALIZAR()-UPDATE*/
public function Actualizar_medidas(type_measurement $data)
{
	try
	{
		$sql = "UPDATE measurement SET cod_measurement = ?,
		                          	   back = ?,
		                          	   chest = ?,
		                          	   abdomen = ?,
		                          	   leg = ?,
		                          	   calf_muscle = ?,
		                          	   arm = ?,
		                               forearm = ?,
		                          	   weight = ?

		WHERE cod_measurement = ?";
		
		$this->pdo->prepare($sql)
			 ->execute(
			 	array(

			 		$data->__GET('cod_measurement2'),
					$data->__GET('back'),
					$data->__GET('chest'),
					$data->__GET('abdomen'),
					$data->__GET('leg'),
					$data->__GET('calf_muscle'),
					$data->__GET('arm'),
					$data->__GET('forearm'),
					$data->__GET('weight'),
					$data->__GET('cod_measurement'),

			 		)
			 );
	}	catch (exception $e)
	{
		die ($e->getMessage());
	}
}		

/*CLASS ELIMINAR()-DELETE*/
public function Eliminar_medidas($cod_measurement)
{
	try
	{
		$stm = $this->pdo
				->prepare("DELETE FROM measurement WHERE cod_measurement = ?");

		$stm->execute(array($cod_measurement));
	} catch (exception $e)
	{
		die ($e->getMessage());
	}
}
}
?>