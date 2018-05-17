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
  $sql = "SELECT * FROM productos WHERE id=$cod";

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
  $sq = "SELECT * FROM productos WHERE id=$co";

$buscar = $pdo->prepare($sq);
$buscar->execute();
$resul = $buscar->fetchAll();


}

$sql = 'SELECT * FROM productos';

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
		Productos
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
<form action="productos.php?codigo=100" method="post">
<div class="top-bar-right">
<ul class="dropdown menu" data-dropdown-menu>

<li>	<input type="text" name="busca" required placeholder="codigo a buscar" value=""></li>
           <li><input class="small hollow button" type="submit" value="Buscar" /></li>
</form>         
 </ul>
</div></div>


<br>


   


<div class="row column text-center">
<h2>.:Producto Nuevo:.</h2>
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
<form action="../controller/product.php?accion=pro" method="post">
  <div class="row">

    <div class="medium-6 columns">
      <label>Ingrese el Nombre
        <input type="text" name="nombre" required placeholder="Nombre" value="">
      </label>
      <label>Ingrese la Descripcion
        <input type="text" name="descripcion" required placeholder="descripcion" value="">
      </label>
      <label>Ingrese el Valor
        <input type="number" name="valor" required placeholder="Valor" value="">
      </label>
    
   <!--    <select id="tipos" name="tipos">
      <option value="">Seleccione...</option>
      </select> -->
     
    </div>
    <div class="medium-6 columns">

      <label>&nbsp;
 <img src="../resources/imagen/pro1.png" alt="" style="width:490px; height:240px;">
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


	
	# code...
?>


<div class="row column ">
<div class="callout secondary">
<h3>Modificar..</h3>
<form action="../controller/product.php?accion=mod1" method="post">
  <div class="row">

 <div class="medium-6 columns">

<input type="hidden" name="id" placeholder="id" value="<?php echo $rs_up['id'] ?>"> 


 <label>nombre:
<input type="text" name="nombre" required placeholder="nombre" value="<?php echo $rs_up['nombre'] ?>">
 </label>

<label>Descripcion:
<input type="text" name="descripcion" required placeholder="descripcion" value="<?php echo $rs_up['descripcion'] ?>">
</label>

<label>valor:
<input type="text" name="valor" required placeholder="valor" value="<?php echo $rs_up['valor'] ?>">
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
         <a class="alert button" href="productos.php">Cancelar</a>
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
      <th>nombre</th>
      <th>Descripcion</th>
      <th>Valor</th>
  
      <th></th>
      <th></th>

    </tr>
  </thead>
  <tbody>

    <?php

 
      foreach($results as $rs)
    {

    	
    		   // foreach($respuesta as $rs){
    	
  ?>
    <tr>
   
       <td width="300"><?php echo $rs['id']; ?></td>
      <td width="300"><?php echo $rs['nombre']; ?></td>
     <td width="400"><?php echo $rs['descripcion']; ?></td>
      <td width="300"><?php echo $rs['valor']; ?></td>
    

    	<td width="100">
      <a class="small hollow button" onclick="" href="productos.php?cod=<?php echo $rs['id']; ?>">Modificar</a>
       </td>

     <td width="200">
        <a class="alert button" href="../controller/product.php?del1=<?php echo $rs['id']; ?>">Eliminar</a>
      </td>

    </tr>
    <?php
  }
    ?>
  </tbody>
</table>



</div>
</div>


<!-- <p><a data-toggle="exampleModal9">Click me for an overlay-lacking modal</a></p>
 -->
<div class="reveal" id="exampleModal9" data-reveal data-overlay="false">
  <p>Busqueda de Productos!</p>




<table width="100%">
  <thead>
    <tr>
      <th>Codigo</th>
      <th>Nombre</th>
      <th>Descripcion</th>
      <th>Valor</th>

      <th></th>
      <th></th>

    </tr>
  </thead>
  <tbody>

    <?php
      foreach($resul as $r)
    {
  ?>
    <tr>
   
       <td width="100"><?php echo $r['id']; ?></td>
      <td width="200"><?php echo $r['nombre']; ?></td>
     <td width="300"><?php echo $r['descripcion']; ?></td>
      <td width="100"><?php echo $r['valor']; ?></td>
    

    	<td width="100">
      <a class="small hollow button" onclick="" href="productos.php?cod=<?php echo $r['id']; ?>">Modificar</a>
       </td>

     <td width="100">
        <a class="alert button" href="../controller/product.php?del1=<?php echo $r['id']; ?>">Eliminar</a>
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