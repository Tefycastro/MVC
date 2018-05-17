<?php

	$con = mysql_connect('localhost', 'root', '');
	$bd = mysql_select_db('bdventas');
	

		$sq = "SELECT * FROM empleados";		
	
		$res = mysql_query($sq);

		$datos = [];

		while ($fila = mysql_fetch_assoc($res) ) {
			$datos[] = $fila;
			
		}

		echo json_encode($datos);

		// echo "<pre>";
		// print_r($datos);
		// echo "</pre>";

		// die();
?>