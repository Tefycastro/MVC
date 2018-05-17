<?php

$dsn = 'mysql:dbname=bdventas;localhost';
$user = 'root';
$password = '';

try{

	$pdo = new PDO(	$dsn, 
					$user, 
					$password
					);

	echo 'conecto: ';
}catch( PDOException $e ){
	echo 'Error al conectarnos: ' . $e->getMessage();
}


?>

