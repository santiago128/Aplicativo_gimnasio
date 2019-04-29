<?php 

class modelpeople
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
public function Registrar_personas(type_people $data)
{
	try
	{
	$sql = "INSERT INTO people (n_document,
	                            type_document_people,
	                            first_name,
	                            second_name,
	                            first_lastname,
	                            second_lastname,
	                            birth_date,
	                            age,
	                            address,
	                            number_phone,
	                            email,
	                            rol_user,
	                            routines_user) 

			VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";

	$this->pdo->prepare($sql)
		 ->execute(
		 	array(
		 		$data->__GET('n_document'),
		 		$data->__GET('type_document_people'),
		 		$data->__GET('first_name'),
		 		$data->__GET('second_name'),
		 		$data->__GET('first_lastname'),
		 		$data->__GET('second_lastname'),
		 		$data->__GET('birth_date'),
		 		$data->__GET('age'),
		 		$data->__GET('address'),
		 		$data->__GET('number_phone'),
		 		$data->__GET('email'),
		 		$data->__GET('rol_user'),
		 		$data->__GET('routines_user'),
		 		
		 	)
		 );			
	} catch (exception $e)
	{
		die ($e->getMessage());
	}
}

/*CLASS LISTAR()-SELECT*/
public function Listar_personas()
{
	try
	{
		$result = array();

		$stm = $this->pdo->prepare("SELECT * FROM people");
		$stm->execute();

		foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) 
		{
			$persona = new type_people();

			$persona->__SET('n_document', $r->n_document);
			$persona->__SET('type_document_people', $r->type_document_people);
			$persona->__SET('first_name', $r->first_name);
			$persona->__SET('second_name', $r->second_name);
			$persona->__SET('first_lastname', $r->first_lastname);
			$persona->__SET('second_lastname', $r->second_lastname);
			$persona->__SET('birth_date', $r->birth_date);
			$persona->__SET('age', $r->age);
			$persona->__SET('address', $r->address);
			$persona->__SET('number_phone', $r->number_phone);
			$persona->__SET('email', $r->email);
			$persona->__SET('rol_user', $r->rol_user);
			$persona->__SET('routines_user', $r->routines_user);

			$result[] = $persona;
		}
		return $result;
	}
	catch(exception $e)
	{
		die ($e->getMessage());
	}
}

/*CLASS OBTENER()-SELECT*/
public function Obtener_personas($n_document)
{
	try
	{
		$stm = $this->pdo
				  ->prepare("SELECT * FROM people WHERE n_document = ?");

		$stm->execute(array($n_document));
		$r = $stm->fetch(PDO::FETCH_OBJ);

		$persona = new type_people();

			$persona->__SET('n_document', $r->n_document);
			$persona->__SET('type_document_people', $r->type_document_people);
			$persona->__SET('first_name', $r->first_name);
			$persona->__SET('second_name', $r->second_name);
			$persona->__SET('first_lastname', $r->first_lastname);
			$persona->__SET('second_lastname', $r->second_lastname);
			$persona->__SET('birth_date', $r->birth_date);
			$persona->__SET('age', $r->age);
			$persona->__SET('address', $r->address);
			$persona->__SET('number_phone', $r->number_phone);
			$persona->__SET('email', $r->email);
			$persona->__SET('rol_user', $r->rol_user);
			$persona->__SET('routines_user', $r->routines_user);

		return $persona;
	}	catch (exception $e)
	{
		die ($e->getMessage());
	}
}

/*CLASS ACTUALIZAR()-UPDATE*/
public function Actualizar_personas(type_people $data)
{
	try
	{
		$sql = "UPDATE people SET n_document = ?,
		                          type_document_people = ?,
		                          first_name = ?,
		                          second_name = ?,
		                          first_lastname = ?,
		                          second_lastname = ?,
		                          birth_date = ?,
		                          age = ?,
		                          address = ?,
		                          number_phone = ?,
		                          email = ?,
		                          rol_user = ?,
		                          routines_user = ?	

		WHERE n_document = ? AND type_document_people=?";
		
		$this->pdo->prepare($sql)
			 ->execute(
			 	array(

			 		$data->__GET('n_document2'),
					$data->__GET('type_document_people2'),
					$data->__GET('first_name'),
					$data->__GET('second_name'),
					$data->__GET('first_lastname'),
					$data->__GET('second_lastname'),
					$data->__GET('birth_date'),
					$data->__GET('age'),
					$data->__GET('address'),
					$data->__GET('number_phone'),
					$data->__GET('email'),
					$data->__GET('rol_user'),
					$data->__GET('routines_user'),
					$data->__GET('n_document'),
					$data->__GET('type_document_people')

			 		)
			 );
	}	catch (exception $e)
	{
		die ($e->getMessage());
	}
}		

/*CLASS ELIMINAR()-DELETE*/
public function Eliminar_personas($n_document)
{
	try
	{
		$stm = $this->pdo
				->prepare("DELETE FROM people WHERE n_document = ?");

		$stm->execute(array($n_document));
	} catch (exception $e)
	{
		die ($e->getMessage());
	}
}
}
?>