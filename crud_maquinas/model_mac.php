<?php 

class machinesModel
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
public function Registrar_maquinas(type_machines $data)
{
	try
	{
	$sql = "INSERT INTO machines_accessories (name_maq, state_mac) 
			VALUES (?, ?)";

	$this->pdo->prepare($sql)
		 ->execute(
		 	array(
		 		$data->__GET('name_maq'),
		 		$data->__GET('state_mac')
		 	)
		 );			
	} catch (exception $e)
	{
		die ($e->getMessage());
	}
}

/*CLASS LISTAR()-SELECT*/
public function Listar_maquinas()
{
	try
	{
		$result = array();

		$stm = $this->pdo->prepare("SELECT * FROM machines_accessories");
		$stm->execute();

		foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) 
		{
			$maquinas = new type_machines();

			$maquinas->__SET('name_maq', $r->name_maq);
			$maquinas->__SET('state_mac', $r->state_mac);

			$result[] = $maquinas;
		}
		return $result;
	}
	catch(exception $e)
	{
		die ($e->getMessage());
	}
}

/*CLASS OBTENER()-SELECT*/
public function Obtener_maquinas($name_maq)
{
	try
	{
		$stm = $this->pdo
				  ->prepare("SELECT * FROM machines_accessories WHERE name_maq = ? ");
				   

		$stm->execute(array($name_maq));
		$r = $stm->fetch(PDO::FETCH_OBJ);

		$maquinas = new type_machines();

			$maquinas->__SET('name_maq', $r->name_maq);
			$maquinas->__SET('state_mac', $r->state_mac);

		return $maquinas;
	}	catch (exception $e)
	{
		die ($e->getMessage());
	}
}

/*CLASS ACTUALIZAR()-UPDATE*/
public function Actualizar_maquinas(type_machines $data)
{
	try
	{
		$sql = "UPDATE machines_accessories SET name_maq = ?, state_mac = ?	WHERE name_maq = ?";

		
		$this->pdo->prepare($sql)
			 ->execute(
			 	array(

			 		$data->__GET('name_maq2'),
			 		$data->__GET('state_mac'),
			 		$data->__GET('name_maq')

			 		)
			 );
	}	catch (exception $e)
	{
		die ($e->getMessage());
	}
}		

/*CLASS ELIMINAR()-DELETE*/
public function Eliminar_maquinas($name_maq)
{
	try
	{
		$stm = $this->pdo
				->prepare("DELETE FROM machines_accessories WHERE name_maq = ?");

		$stm->execute(array($name_maq));
	} catch (exception $e)
	{
		die ($e->getMessage());
	}
}
}
?>