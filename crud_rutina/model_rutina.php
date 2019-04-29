<?php 

class routineModel
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
public function Registrar_rutina(type_rutina $data)
{
	try
	{
	$sql = "INSERT INTO routine (cod_routine, desc_routine) 
			VALUES (?, ?)";

	$this->pdo->prepare($sql)
		 ->execute(
		 	array(
		 		$data->__GET('cod_routine'),
		 		$data->__GET('desc_routine')
		 	)
		 );	
		
		$stm1=$this->pdo->prepare("SELECT cod_routine FROM routine ORDER BY cod_routine DESC LIMIT 1");

      	$stm1->execute();

      	foreach ($stm1->fetchAll(PDO::FETCH_OBJ) as $r) {
      	$hc=$r->cod_routine;
      }

			$stm2 = $this->pdo->prepare("SELECT * from exercise");
			$stm2->execute();

			//Realiza el ciclo de todos los objetos o lines que se encuentra en la consulta color destru

			foreach($stm2->fetchAll(PDO::FETCH_OBJ) as $diss)
			{

				// variable que almacena lo que encunetra en el campo cod_telefono
				$routine= $diss->name_ejr;

				// Comporbar si el checbox esta selecionado (true) que tiene la variable seleccionada anteriormente - cod_telefono.
				if (isset($_POST[$routine])) {

					$des="des".$routine;
					$des1=$_REQUEST[$des];

			$sql1 = ("INSERT INTO routine_exercise (re_nom_exercise, re_cod_routine,rep_time) VALUES('$routine','$hc','$des1')");
			$this->pdo->prepare($sql1)->execute();

}
			}		 		
	} catch (exception $e)
	{
		die ($e->getMessage());
	}
}

/*CLASS LISTAR()-SELECT*/
public function Listar_rutina()
{
	try
	{
		$result = array();

		$stm = $this->pdo->prepare("SELECT * FROM routine join routine_exercise on cod_routine = re_cod_routine");
		$stm->execute();

		foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) 
		{
			$rutinas = new type_rutina();

			$rutinas->__SET('cod_routine', $r->cod_routine);
			$rutinas->__SET('desc_routine', $r->desc_routine);
			$rutinas->__SET('rep_time', $r->rep_time);

			$result[] = $rutinas;
		}
		return $result;
	}
	catch(exception $e)
	{
		die ($e->getMessage());
	}
}

/*CLASS OBTENER()-SELECT*/
public function Obtener_rutina($cod_routine)
{
	try
	{
		$stm = $this->pdo
				  ->prepare("SELECT * FROM routine WHERE cod_routine = ? ");
				   

		$stm->execute(array($cod_routine));
		$r = $stm->fetch(PDO::FETCH_OBJ);

		$rutinas = new type_rutina();

			$rutinas->__SET('cod_routine', $r->cod_routine);
			$rutinas->__SET('desc_routine', $r->desc_routine);

		return $rutinas;
	}	catch (exception $e)
	{
		die ($e->getMessage());
	}
}

/*CLASS ACTUALIZAR()-UPDATE*/
public function Actualizar_rutina(type_rutina $data)
{
	try
	{
		$sql = "UPDATE routine SET cod_routine = ?, desc_routine = ?	WHERE cod_routine = ?";

		
		$this->pdo->prepare($sql)
			 ->execute(
			 	array(

			 		$data->__GET('cod_routine2'),
			 		$data->__GET('desc_routine'),
			 		$data->__GET('cod_routine')

			 		)
			 );
	}	catch (exception $e)
	{
		die ($e->getMessage());
	}
}		

/*CLASS ELIMINAR()-DELETE*/
public function Eliminar_rutina($cod_routine)
{
	try
	{
		$stm = $this->pdo
				->prepare("DELETE FROM routine WHERE cod_routine = ?");

		$stm->execute(array($cod_routine));
	} catch (exception $e)
	{
		die ($e->getMessage());
	}
}
}
?>