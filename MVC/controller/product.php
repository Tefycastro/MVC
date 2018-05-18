<?php

	require '../model/model.php';

	
	
	//$productos = $db->getRecords();

	// echo json_encode($productos);


	//nuevo cambio


//Consultar registros
if ($_REQUEST['bus']){
	
		$db = new model('empleados');

	$emple = $db->getRecords();
	// $productos = $db->getRecord(0);
}else
//Insertar Registros

	if ($_GET['accion']=='pro'){
		$db = new model('productos');

	$nom=$_POST['nombre'];
	$desc=$_POST['descripcion'];
	$val=$_POST['valor'];

	$datos[] = $nom;
	$datos[] = $desc;
	$datos[] = $val;

	$db->insertRecord($datos);
	// $productos = $db->getRecords();

	header("Location: ../view/productos.php");
	}else

	if ($_GET['accion']=='emp'){

		$db = new model('empleados');

	$emple=$_POST['empleado'];
	$sex=$_POST['sexo'];
	$ema=$_POST['email'];

	$tel=$_POST['telefono'];
	$dir=$_POST['direccion'];

	$car=$_POST['cargo'];
	$sal=$_POST['salario'];

	$datos[] = $emple;
	$datos[] = $sex;
	$datos[] = $ema;
	$datos[] = $tel;
	$datos[] = $dir;
	$datos[] = $car;
	$datos[] = $sal;

	$db->insertRecord($datos);
	// $productos = $db->getRecords();

	header("Location: ../view/empleado.php");
	}else  

	if ($_GET['accion']=='ven'){
	
	$db = new model('ventas');

		$emple=$_POST['empleado'];
		$produc=$_POST['producto'];
		$fech=$_POST['fecha'];
		$cant=$_POST['cantidad'];

		$datos[]=$emple;
		$datos[]=$produc;
		$datos[]=$fech;
		$datos[]=$cant;


		$db->insertRecord($datos);
		header("Location: ../view/ventas.php");
	}else

	if ($_GET['accion']=='mod1'){
		$db = new model('productos');


// Actualizar Registros
	$id=$_POST['id'];

	$nom=$_POST['nombre'];
	$des=$_POST['descripcion'];
	$val=$_POST['valor'];

	
	$datos[] = $nom;
	$datos[] = $des;
	$datos[] = $val;

	// $id = '1';

	// $ultimo = $db->getLastId();
	// echo "<pre>";
	// print_r($ultimo);

	// echo "</pre>";

	$db->updateRecord($id, $datos);
	// $ultimo = $db->getLastId();

	// echo "<pre>";
	// print_r($ultimo);
	// echo "</pre>";
	// die();

	header("Location: ../view/productos.php");
}else

if ($_GET['accion']=='mod2'){
		$db = new model('ventas');


// Actualizar Registros
		$id=$_POST['id'];

		$emple=$_POST['empleado'];
		$produc=$_POST['producto'];
		$fech=$_POST['fecha'];
		$cant=$_POST['cantidad'];

		$datos[]=$emple;
		$datos[]=$produc;
		$datos[]=$fech;
		$datos[]=$cant;


	$db->updateRecord($id, $datos);

	header("Location: ../view/ventas.php");

}else
if ($_GET['accion']=='mod3'){
		$db = new model('empleados');


// Actualizar Registros
		$id=$_POST['id'];

		$emple=$_POST['empleado'];
	$sex=$_POST['sexo'];
	$ema=$_POST['email'];

	$tel=$_POST['telefono'];
	$dir=$_POST['direccion'];

	$car=$_POST['cargo'];
	$sal=$_POST['salario'];

	$datos[] = $emple;
	$datos[] = $sex;
	$datos[] = $ema;
	$datos[] = $tel;
	$datos[] = $dir;
	$datos[] = $car;
	$datos[] = $sal;


	$db->updateRecord($id, $datos);
	header("Location: ../view/empleado.php");
}else




// Elimnar Registro
if ($_REQUEST['del1']){
$db = new model('productos');

$id=$_REQUEST['del1'];

	// $ultimo = $db->getLastId();
	// $id = $ultimo[0]['id'];
	$db->deleteRecord($id);

	header('location: ../view/productos.php');

}else
// Elimnar Registro
if ($_REQUEST['del2']){
$db = new model('ventas');

$id=$_REQUEST['del2'];

	// $ultimo = $db->getLastId();
	// $id = $ultimo[0]['id'];
	$db->deleteRecord($id);

	header('location: ../view/ventas.php');

}
else
// Elimnar Registro
if ($_REQUEST['del3']){

$db = new model('empleados');

$id=$_REQUEST['del3'];

	// $ultimo = $db->getLastId();
	// $id = $ultimo[0]['id'];
	$db->deleteRecord($id);

	header('location: ../view/empleado.php');

}

	// echo "<pre>";
	// print_r($ultimo);
	// echo "</pre>";
	// die();



?>











