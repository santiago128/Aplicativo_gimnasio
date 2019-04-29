<?php 

class rolModel
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
public function Registrar_rol(type_role $data)
{
	try
	{
	$sql = "INSERT INTO role (name_rol, state_rol) 
			VALUES (?, ?)";

	$this->pdo->prepare($sql)
		 ->execute(
		 	array(
		 		$data->__GET('name_rol'),
		 		$data->__GET('state_rol')
		 	)
		 );			
	} catch (exception $e)
	{
		die ($e->getMessage());
	}
}

/*CLASS LISTAR()-SELECT*/
public function Listar_rol()
{
	try
	{
		$result = array();

		$stm = $this->pdo->prepare("SELECT * FROM role");
		$stm->execute();

		foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) 
		{
			$documento = new type_role();

			$documento->__SET('name_rol', $r->name_rol);
			$documento->__SET('state_rol', $r->state_rol);

			$result[] = $documento;
		}
		return $result;
	}
	catch(exception $e)
	{
		die ($e->getMessage());
	}
}

/*CLASS OBTENER()-SELECT*/
public function Obtener_rol($name_rol)
{
	try
	{
		$stm = $this->pdo
				  ->prepare("SELECT * FROM role WHERE name_rol = ? ");
				   

		$stm->execute(array($name_rol));
		$r = $stm->fetch(PDO::FETCH_OBJ);

		$documento = new type_role();

			$documento->__SET('name_rol', $r->name_rol);
			$documento->__SET('state_rol', $r->state_rol);

		return $documento;
	}	catch (exception $e)
	{
		die ($e->getMessage());
	}
}

/*CLASS ACTUALIZAR()-UPDATE*/
public function Actualizar_rol(type_role $data)
{
	try
	{
		$sql = "UPDATE role SET name_rol = ?, state_rol = ?	WHERE name_rol = ?";

		
		$this->pdo->prepare($sql)
			 ->execute(
			 	array(

			 		$data->__GET('name_rol2'),
			 		$data->__GET('state_rol'),
			 		$data->__GET('name_rol')

			 		)
			 );
	}	catch (exception $e)
	{
		die ($e->getMessage());
	}
}		

/*CLASS ELIMINAR()-DELETE*/
public function Eliminar_rol($name_rol)
{
	try
	{
		$stm = $this->pdo
				->prepare("DELETE FROM role WHERE name_rol = ?");

		$stm->execute(array($name_rol));
	} catch (exception $e)
	{
		die ($e->getMessage());
	}
}
}
?>