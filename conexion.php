<?php 
session_start();
class database {

public static function conectar(){

	try {
		$pdo=new PDO('mysql:host=localhost;dbname=gimbo;charset=utf8','root','');
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		return $pdo;
	} catch (Exception $e) {
		die($e->getMessage());
	}
  }
}
?>