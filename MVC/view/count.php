
<?php

require_once('../model/conect.php');
// $sql = "SELECT * FROM empleados";

// $statement = $pdo->prepare($sql);
// $statement->execute();
// $results = $statement->fetchAll();
// //var_dump($results);
// $total_U = $results[0]['nombre'];




// $sql = 'SELECT * FROM productos';

// $statement = $pdo->prepare($sql);
// $statement->execute();
// $results = $statement->fetchAll();

// $total_V = $results[0]['nombre'];



$sql = 'SELECT * FROM productos';

$statement = $pdo->prepare($sql);
$statement->execute();
$results = $statement->fetchAll();


$sql = 'SELECT * FROM empleados';

$statement = $pdo->prepare($sql);
$statement->execute();
$results2 = $statement->fetchAll();



$sql = 'SELECT * FROM Ventas';

$statement = $pdo->prepare($sql);
$statement->execute();
$results3 = $statement->fetchAll();

$sql = 'SELECT * FROM Ventas WHERE id=(select max(id) from ventas)';

$statement = $pdo->prepare($sql);
$statement->execute();
$results4 = $statement->fetchAll();


$fech1= isset($_GET['fecha1']) ? $_GET['fecha1']: 0;
$fech2= isset($_GET['fecha2']) ? $_GET['fecha2']: 0;

// $sql = "SELECT COUNT(*) AS total FROM ventas WHERE fecha BETWEEN 2016-07-21 and 2016-07-23";

$sql="SELECT COUNT(*) AS total FROM ventas WHERE fecha BETWEEN '$fech1' AND '$fech2'";

$statement = $pdo->prepare($sql);
$statement->execute();
$results5 = $statement->fetchAll();
//var_dump($results);
$tot= $results5[0]['total'];


$sql="SELECT SUM(cantidad) AS valor FROM ventas WHERE fecha BETWEEN '$fech1' AND '$fech2'";

$statement = $pdo->prepare($sql);
$statement->execute();
$results5 = $statement->fetchAll();
//var_dump($results);
$sum= $results5[0]['valor'];





?>
<!doctype html>
<html class="no-js" lang="en">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Totales</title>


 <link href="../resources/foundation.js" rel="stylesheet" />
    <link href="../resources/jquery-2.1.4.min.js" rel="stylesheet" />
    <link href="../resources/foundation.min.css" rel="stylesheet" />


</head>
<body>
 

<div class="top-bar" id="example-menu">
  <div class="top-bar-left">
    <ul class="dropdown menu" data-dropdown-menu>
     <li class="menu-text">VENTAS INC.</li>
       <li><a href="../index.html">INICIO</a></li>
       <li><a href="productos.php">Productos</a></li>
      <li><a href="empleado.php">Empleados</a></li>
      <li><a href="ventas.php">Registro de Ventas</a></li>
      <li><a href="count.php">Reportes</a></li>
    </ul>
  </div>
</div>

<br>

 
<div class="row column text-center">
<h2>Control de Datos</h2>
<hr>
</div>
<div class="row column">
<div class="callout success">
<h3>Listado de Productos</h3>
</div>

<table width="100%">
  <thead>
    <tr>
      <th>CODIGO</th>
      <th>nombre</th>
      <th>Descripcion</th>
      <th>Valor</th>
    </tr>
  </thead>
  <tbody>

    <?php
      foreach($results as $rs)
    {
  ?>
    <tr>
   
       <td width="300"><?php echo $rs['id']; ?></td>
      <td width="300"><?php echo $rs['nombre']; ?></td>
     <td width="400"><?php echo $rs['descripcion']; ?></td>
      <td width="300"><?php echo $rs['valor']; ?></td>
    </tr>
    <?php
  }
    ?>

  </tbody>
</table>
</div>
<hr>

<br><br>
<div class="row column">
<div class="callout success">
<h3>Listado de Empleados</h3>
</div>

<table width="100%">
  <thead>
    <tr>
      <th>CODIGO</th>
      <th>NOMBRE</th>
      <th>SEXO</th>
      <th>EMAIL</th>
      <th>TELEFONO</th>
      <th>DIRECCION</th>
      <th>CARGO</th>
       <th>SALARIO</th>
  
  
      <th></th>
      <th></th>

    
  </thead>
  <tbody>



    <?php
           foreach($results2 as $rs){ 
  ?>
    <tr>
   
       <td width="200"><?php echo $rs['id']; ?></td>
      <td width="200"><?php echo $rs['nombre']; ?></td>
     <td width="200"><?php echo $rs['sexo']; ?></td>
      <td width="200"><?php echo $rs['email']; ?></td>
        
         <td width="200"><?php echo $rs['telefono']; ?></td>
      <td width="200"><?php echo $rs['direccion']; ?></td>
     <td width="200"><?php echo $rs['cargo']; ?></td>
      <td width="200"><?php echo $rs['salario']; ?></td>


    </tr>
    <?php
  }
    ?>
  </tbody>
</table>

</div>


<hr>

<br><br>
<div class="row column">
<div class="callout success">
<h3>Listado de Ventas</h3>
</div>

<table width="100%">
  <thead>
    <tr>
      <th>CODIGO</th>
      <th>EMPLEADO</th>
      <th>PRODUCTO</th>
      <th>FECHA</th>
  
      <th>CANTIDAD</th>
     

    </tr>
  </thead>
  <tbody>

    <?php
  
     
           foreach($results3 as $rs){
      
  ?>
    <tr>
   
       <td width="200"><?php echo $rs['id']; ?></td>
      <td width="200"><?php echo $rs['empleado']; ?></td>
     <td width="200"><?php echo $rs['producto']; ?></td>
      <td width="200"><?php echo $rs['fecha']; ?></td>
       <td width="200"><?php echo $rs['cantidad']; ?></td>
    

   
    </tr>
    <?php
  }
    ?>
  </tbody>
</table>
</div>



<hr>

<br><br>
<div class="row column">
<div class="callout success">
<h3>Ultima Venta</h3>
</div>

<table width="100%">
  <thead>
    <tr>
      <th>CODIGO</th>
      <th>EMPLEADO</th>
      <th>PRODUCTO</th>
      <th>FECHA</th>
  
      <th>CANTIDAD</th>
     

    </tr>
  </thead>
  <tbody>

    <?php
  
     
           foreach($results4 as $rs){
      
  ?>
    <tr>
   
       <td width="200"><?php echo $rs['id']; ?></td>
      <td width="200"><?php echo $rs['empleado']; ?></td>
     <td width="200"><?php echo $rs['producto']; ?></td>
      <td width="200"><?php echo $rs['fecha']; ?></td>
       <td width="200"><?php echo $rs['cantidad']; ?></td>
    

   
    </tr>
    <?php
  }
    ?>
  </tbody>
</table>
</div>

<hr>

<br><br>

<div class="row column">
<div class="callout success">
<form action="count.php?" method="get">

<h3>Total de Ventas</h3>
  
<label>Ingrese la Fecha 1:
        <input type="date" name="fecha1" required placeholder="fecha1" value="">
</label>
<label>Ingrese la Fecha 2:
        <input type="date" name="fecha2" required placeholder="fecha2" value="">
</label>

  <input class="button primary" type="submit" value="BUSCAR" />

</form>

</div>

<table width="100%">
  <thead>
    <tr>
      <th>Ventas</th>
      <th>Valor</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td width="300"><?php echo $tot; ?></td>
      <td width="300"><?php echo $sum; ?></td>
      
    </tr>
  </tbody>
</table>
</div>
<hr>




<div class="large-3 large-offset-2 columns">
</div>
</div>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="http://dhbhdrzi4tiry.cloudfront.net/cdn/sites/foundation.js"></script>
<script>
      $(document).foundation();
    </script>
</body>
</html>
