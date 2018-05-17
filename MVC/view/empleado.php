<?php

require_once('../model/conect.php');



$show_G = true;
  $show_M=false;

if(isset( $_GET['cod'])){

 $cod = isset($_GET['cod']) ? $_GET['cod']: 0;
 

 $show_G = false;
 $show_M=true;
  //TODO: GET DETAILS
  $sql = "SELECT * FROM empleados WHERE id=$cod";

  $modificar = $pdo->prepare($sql);
  $modificar->execute(array($cod));
  $result = $modificar->fetchAll();
  $rs_up = $result[0];

//   echo '<pre>';
//   var_dump($rs_up);
// die();
}

 if(isset( $_GET['codigo'])){

 $co = isset($_POST['busca']) ? $_POST['busca']: 0;

  //TODO: GET DETAILS
  $sq = "SELECT * FROM empleados WHERE id=$co";

$buscar = $pdo->prepare($sq);
$buscar->execute();
$resul = $buscar->fetchAll();


}


$sql = 'SELECT * FROM empleados';

$statement = $pdo->prepare($sql);
$statement->execute();
$results = $statement->fetchAll();

// $error = $statement->errorInfo();
// if($error[1])
// {
//   echo '<pre>';
//   var_dump($error[2]);
//   echo '</pre>';
// }
?>


<!DOCTYPE html>
<html>
<head>
	<title>
		Empleado
	</title>


	 <link href="../resources/foundation.js" rel="stylesheet" />
		<link href="../resources/jquery-2.1.4.min.js" rel="stylesheet" />
		<link href="../resources/foundation.min.css" rel="stylesheet" />


  <script type="text/javascript">



function moda()
{


$('#exampleModal9').foundation('open');


}
</script>


</head>


<?php
  if(isset( $_GET['codigo'] ) )
{
?>
<body onload="moda()">

<?php
}else{
?>

<body>

<?php
}
?>


<div class="top-bar" id="example-menu">
  <div class="top-bar-left">
    <ul class="dropdown menu" data-dropdown-menu>
     <li class="menu-text">PASTORA INC.</li>
       <li><a href="../index.html">INICIO</a></li>
       <li><a href="productos.php">Productos</a></li>
      <li><a href="empleado.php">Empleados</a></li>
      <li><a href="ventas.php">Registro de Ventas</a></li>
       <li><a href="count.php">Reportes</a></li>
    </ul>
  </div>

  <form action="empleado.php?codigo=100" method="post">
<div class="top-bar-right">
<ul class="dropdown menu" data-dropdown-menu>

<li>  <input type="text" name="busca" required placeholder="codigo a buscar" value=""></li>
           <li><input class="small hollow button" type="submit" value="Buscar" /></li>
        
 </ul>
</div>
</form>

</div>

<br>

<div class="row column text-center">
<h2>.:Nuevo Empleado:.</h2>
<hr>
</div>

<?php 
if( $show_G)
{ 
  $show_M = false;
?>

<div class="row column ">
<div class="callout secondary">
<h3>Registro..</h3>
<form action="../controller/product.php?accion=emp" method="post">
  <div class="row">

    <div class="medium-6 columns">

      <label>Nombre del empleado
        <input type="text" name="empleado" required placeholder="empleado" value="">
      </label>
      
    <label>seleccione el Sexo
    <select name="sexo">
     
      <option required value="Hombre">Hombre</option>
      <option required value="Mujer">Mujer</option>
    </select>
  </label> 

      <label>ingrese el email
        <input type="text" name="email" required placeholder="email" value="">
      </label>
  

      <label>ingrese el salario
        <input type="number" name="salario" required placeholder="salario" value="">
      </label>
     
    </div>


    <div class="medium-6 columns">
      <label>
 <img src="../resources/imagen/emple1.png" alt="" style="width:400px; height:80px;">
      </label>

          <label>ingrese el telefono 
        <input type="number" name="telefono" required placeholder="telefono" value="">
      </label>

      <label>ingrese la direccion
        <input type="text" name="direccion" required placeholder="direccion" value="">
      </label>

       <label>seleccione el cargo
       
    <select name="cargo">
    
      <option required value="Administrador">Administrador</option>
      <option required value="Vendedor">Vendedor</option>
    </select>
  </label> 
    </div>
  </div>
  <div class="row">
    <div class="medium-12 columns ">
      <label><br>
      <center>  <input class="button primary" type="submit" value="AGREGAR NUEVO EMPLEADO" /></center>

      </label>
      
    </div>
  </div>
</form>
</div>


<?php 

}
?>


<?php 
if( $show_M)
{ 

  $show_G = false;
?>


<div class="row column ">
<div class="callout secondary">
<h3>Modificar..</h3>
<form action="../controller/product.php?accion=mod3" method="post">
  <div class="row">

 <div class="medium-6 columns">

<input type="hidden" name="id" placeholder="Descripcion" value="<?php echo $rs_up['id'] ?>"> 

      <label>Nombre del empleado
        <input type="text" name="empleado" placeholder="empleado" value="<?php echo $rs_up['nombre'] ?>">
      </label>
      
    <label>seleccione el Sexo
    <select name="sexo">
      <option value="husker">Hombre</option>
      <option value="starbuck">Mujer</option>
    </select>
  </label> 

      <label>ingrese el email
        <input type="text" name="email" placeholder="email" value="<?php echo $rs_up['email'] ?>">
      </label>
      <label>ingrese el telefono 
        <input type="number" name="telefono" placeholder="telefono" value="<?php echo $rs_up['telefono'] ?>">
      </label>

      <label>ingrese la direccion
        <input type="text" name="direccion" placeholder="direccion" value="<?php echo $rs_up['direccion'] ?>">
      </label>

       <label>seleccione el cargo
       
    <select name="cargo">
      <option value="husker">Administrador</option>
      <option value="starbuck">Vendedor</option>
    </select>
  </label> 

      <label>ingrese el salario
        <input type="number" name="salario" placeholder="salario" value="<?php echo $rs_up['salario'] ?>">
      </label>



    </div>
    <div class="medium-4 columns">
      <label>&nbsp;
      </label>
    </div>
  </div>
  <div class="row">
    <div class="medium-12 columns ">
      <label>
        <input class="button primary" type="submit" value="MODIFICAR" />
           <a class="alert button" href="empleado.php">Cancelar</a>
      </label>
      
    </div>
  </div>

</form>

</div>
<?php } ?>


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

    </tr>
  </thead>
  <tbody>

    <?php

           foreach($results as $rs){
      
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
    

      <td width="100">
      <a class="small hollow button" onclick="" href="empleado.php?cod=<?php echo $rs['id']; ?>">Modificar</a>
       </td>

       <td width="200">
        <a class="alert button" href="../controller/product.php?del3=<?php echo $rs['id']; ?>">Eliminar</a>
      </td>

    </tr>
    <?php
  }
    ?>
  </tbody>
</table>

</form>
</div>
</div>

<div class="large reveal" id="exampleModal9" data-reveal data-overlay="false">
  <p>Busqueda de Empleados!</p>



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

    </tr>
  </thead>  <tbody>

    <?php

           foreach($resul as $r){
      
  ?>
    <tr>
   
       <td width="200"><?php echo $r['id']; ?></td>
      <td width="200"><?php echo $r['nombre']; ?></td>
     <td width="200"><?php echo $r['sexo']; ?></td>
      <td width="200"><?php echo $r['email']; ?></td>
        
         <td width="200"><?php echo $r['telefono']; ?></td>
      <td width="200"><?php echo $r['direccion']; ?></td>
     <td width="200"><?php echo $r['cargo']; ?></td>
      <td width="200"><?php echo $r['salario']; ?></td>
    

      <td width="100">
      <a class="small hollow button" onclick="" href="empleado.php?cod=<?php echo $r['id']; ?>">Modificar</a>
       </td>

       <td width="200">
        <a class="alert button" href="../controller/product.php?del3=<?php echo $r['id']; ?>">Eliminar</a>
      </td>

    </tr>
    <?php
  }
    ?>
  </tbody>

</table>


    <button class="close-button" data-close aria-label="Close reveal" type="button">
    <span aria-hidden="true">&times;</span>
  </button>
</div>


<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="http://dhbhdrzi4tiry.cloudfront.net/cdn/sites/foundation.js"></script>
<script>

   $(document).foundation();
</script>

</body>
</html>