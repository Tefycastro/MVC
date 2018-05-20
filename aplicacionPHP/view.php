<?php session_start(); ?>
 
<?php
if(!isset($_SESSION['valid'])) {
    header('Location: login.php');
}
?>
 
<?php
//including the database connection file
include_once("connection.php");
 
//fetching data in descending order (lastest entry first)
$result = mysqli_query($mysqli, "SELECT * FROM products WHERE login_id=".$_SESSION['id']." ORDER BY id DESC");
?>
 
<html>
<head>
    <title>Pagina de inicio</title>
</head>
 
<body>
<a href="index.php">Inicio</a> | <a href="add.html">Agregar nuevo dato</a> | <a href="logout.php">Cerrar sesión</a>
<br/><br/>
    
<table width='80%' border=0>
    <tr bgcolor='#CCCCCC'>
        <td>Nombre</td>
        <td>Cantidad</td>
        <td>Precio</td>
        <td>Actualizar</td>
    </tr>
    <?php
    while($res = mysqli_fetch_array($result)) {        
        echo "<tr>";
        echo "<td>".$res['name']."</td>";
        echo "<td>".$res['qty']."</td>";
        echo "<td>".$res['price']."</td>";    
        echo "<td><a href=\"edit.php?id=$res[id]\">Editaar</a> | <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Está seguro que desea elimar el registro?')\">Eliminar</a></td>";        
    }
    ?>
</table>    
</body>
</html>