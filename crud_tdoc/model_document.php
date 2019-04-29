<?php 

class documentModel
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
public function Registrar_documento(type_document $data)
{
	try
	{
	$sql = "INSERT INTO type_document (code_document, desc_document) 
			VALUES (?, ?)";

	$this->pdo->prepare($sql)
		 ->execute(
		 	array(
		 		$data->__GET('code_document'),
		 		$data->__GET('desc_document')
		 	)
		 );			
	} catch (exception $e)
	{
		die ($e->getMessage());
	}
}

/*CLASS LISTAR()-SELECT*/
public function Listar_documento()
{
	try
	{
		$result = array();

		$stm = $this->pdo->prepare("SELECT * FROM type_document");
		$stm->execute();

		foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) 
		{
			$documento = new type_document();

			$documento->__SET('code_document', $r->code_document);
			$documento->__SET('desc_document', $r->desc_document);

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
public function Obtener_documento($code_document)
{
	try
	{
		$stm = $this->pdo
				  ->prepare("SELECT * FROM type_document WHERE code_document = ? ");
				   

		$stm->execute(array($code_document));
		$r = $stm->fetch(PDO::FETCH_OBJ);

		$documento = new type_document();

			$documento->__SET('code_document', $r->code_document);
			$documento->__SET('desc_document', $r->desc_document);

		return $documento;
	}	catch (exception $e)
	{
		die ($e->getMessage());
	}
}

/*CLASS ACTUALIZAR()-UPDATE*/
public function Actualizar_documento(type_document $data)
{
	try
	{
		$sql = "UPDATE type_document SET code_document = ?, desc_document = ?	WHERE code_document = ?";

		
		$this->pdo->prepare($sql)
			 ->execute(
			 	array(

			 		$data->__GET('code_document2'),
			 		$data->__GET('desc_document'),
			 		$data->__GET('code_document')

			 		)
			 );
	}	catch (exception $e)
	{
		die ($e->getMessage());
	}
}		

/*CLASS ELIMINAR()-DELETE*/
public function Eliminar_documento($code_document)
{
	try
	{
		$stm = $this->pdo
				->prepare("DELETE FROM type_document WHERE code_document = ?");

		$stm->execute(array($code_document));
	} catch (exception $e)
	{
		die ($e->getMessage());
	}
}
}
?>