<?php

require_once('../model/conect.php');

// $ver=$_GET['ver'];

$ver = isset($_GET['ver']) ? $_GET['ver']: 0;


// if ($ver==1){
//  $show_G = false;
//   $show_M=true;
// }else{

$show_G = true;
  $show_M=false;

  
if(isset( $_GET['cod'])){

 $cod = isset($_GET['cod']) ? $_GET['cod']: 0;

 $show_G = false;
 $show_M=true;
  //TODO: GET DETAILS
  $sql = "SELECT * FROM ventas WHERE id=$cod";

  $modificar = $pdo->prepare($sql);
  $modificar->execute(array($cod));
  $result = $modificar->fetchAll();
  $rs_up = $result[0];

  //echo '<pre>';
  //var_dump($rs_details);

}


 if(isset( $_GET['codigo'])){

 $co = isset($_POST['busca']) ? $_POST['busca']: 0;

  //TODO: GET DETAILS
  $sq = "SELECT * FROM ventas WHERE id=$co";

$buscar = $pdo->prepare($sq);
$buscar->execute();
$resul = $buscar->fetchAll();


}


$sql = 'SELECT * FROM Ventas';

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
		Ventas
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

<body onload="cargar(),cargar1()">


<?php
}
?>



<script type="text/javascript">

  function cargar(){

      var ajax = new XMLHttpRequest();

      ajax.open('POST', '../model/option1.php', true);

      ajax.send();

      ajax.onreadystatechange = function() {
            if (ajax.readyState == 4 && ajax.status == 200) {
                var datos = JSON.parse(ajax.responseText);
                // console.log(datos);

              var tipo = document.getElementById('empleado');

              for (var i = 0; i < datos.length; i++) {
                var option = document.createElement("option");
            option.text = datos[i].nombre;
            option.value = datos[i].id;
            empleado.add(option);
              }

            }
        };
    }


  function cargar1(){
    
      var ajax = new XMLHttpRequest();

      ajax.open('POST', '../model/option2.php', true);

      ajax.send();

      ajax.onreadystatechange = function() {
            if (ajax.readyState == 4 && ajax.status == 200) {
                var datos = JSON.parse(ajax.responseText);
                // console.log(datos);

              var tipo = document.getElementById('producto');

              for (var i = 0; i < datos.length; i++) {
                var option = document.createElement("option");
            option.text = datos[i].nombre;
            option.value = datos[i].id;
            producto.add(option);
              }

            }
        };
    }


</script>
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


  <form action="ventas.php?codigo=100" method="post">
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
<h2>.:Nueva Venta:.</h2>
<hr>
</div>

<?php 

if($show_G)
{ 
  $show_M = False;
?>

<div class="row column ">
<div class="callout secondary">
<h3>Registro..</h3>
<form action="../controller/product.php?accion=ven" method="post">
  <div class="row">

    <div class="medium-6 columns">

      <label>Codigo del empleado
       <select id="empleado" name="empleado" >
      <option value="" required>Seleccione...</option>
      </select>
      </label>

      <label>Codigo del Producto
      <select id="producto" name="producto" >
      <option value="" required>Seleccione...</option>
      </select>
      </label>

      <label>fecha
        <input type="date" name="fecha" required placeholder="fecha" value="">
      </label>

      <label>cantidad:
        <input type="number" name="cantidad" required placeholder="cantidad" value="">
      </label>
  

     
    </div>
    <div class="medium-6 columns">
      <label>
      <img src="../resources/imagen/ven.png" alt="" style="width:550px; height:280px;">
      </label>
      </label>
      </label>
    </div>
  </div>
  <div class="row">
    <div class="medium-12 columns ">
      <label>
        <input class="button primary" type="submit" value="AGREGAR" />
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
<form action="../controller/product.php?accion=mod2" method="post">
  <div class="row">

 <div class="medium-6 columns">

<input type="hidden" name="id" placeholder="Descripcion" value="<?php echo $rs_up['id'] ?>"> 

 <label>Empleado:
       <select id="empleado" name="empleado" >
      <option required value="<?php echo $rs_up['empleado'] ?>">Seleccione...</option>
      </select>
</label>

<label>Producto:
      <select id="producto" name="producto" >
      <option required value="<?php echo $rs_up['producto'] ?>">Seleccione...</option>
      </select>
</label>


<label>fecha:
<input type="date" name="fecha" required placeholder="fecha" required="el campo no puede quedar vacio" value="<?php echo $rs_up['fecha'] ?>">
</label>

<label>cantidad:
<input type="number" name="cantidad" required placeholder="cantidad" value="<?php echo $rs_up['cantidad'] ?>">
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
           <a class="alert button" href="ventas.php">Cancelar</a>
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
      <th>EMPLEADO</th>
      <th>PRODUCTO</th>
      <th>FECHA</th>
  
      <th>CANTIDAD</th>
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
      <td width="200"><?php echo $rs['empleado']; ?></td>
     <td width="200"><?php echo $rs['producto']; ?></td>
      <td width="200"><?php echo $rs['fecha']; ?></td>
       <td width="200"><?php echo $rs['cantidad']; ?></td>
    

      <td width="100">
      <a class="small hollow button" onclick="" href="ventas.php?cod=<?php echo $rs['id']; ?>">Modificar</a>
       </td>

     <td width="200">
        <a class="alert button" href="../controller/product.php?del2=<?php echo $rs['id']; ?>">Eliminar</a>
      </td>

    </tr>
    <?php
  }
    ?>
  </tbody>
</table>

<div class="large reveal" id="exampleModal9" data-reveal data-overlay="false">
  <p>Ventas!</p>

<table width="100%">
  <thead>
    <tr>
      <th>CODIGO</th>
      <th>EMPLEADO</th>
      <th>PRODUCTO</th>
      <th>FECHA</th>
  
      <th>CANTIDAD</th>
      <th></th>
       <th></th>

    </tr>
  </thead>
  <tbody>

    <?php
  
     
           foreach($resul as $r){
      
  ?>
    <tr>
   
       <td width="200"><?php echo $r['id']; ?></td>
      <td width="200"><?php echo $r['empleado']; ?></td>
     <td width="200"><?php echo $r['producto']; ?></td>
      <td width="200"><?php echo $r['fecha']; ?></td>
       <td width="200"><?php echo $r['cantidad']; ?></td>
    

      <td width="100">
      <a class="small hollow button" onclick="" href="ventas.php?cod=<?php echo $r['id']; ?>">Modificar</a>
       </td>

     <td width="200">
        <a class="alert button" href="../controller/product.php?del2=<?php echo $r['id']; ?>">Eliminar</a>
      </td>

    </tr>
    <?php
  }
    ?>
  </tbody>
</table>



<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="http://dhbhdrzi4tiry.cloudfront.net/cdn/sites/foundation.js"></script>
<script>

   $(document).foundation();
</script>



</body>
</html>