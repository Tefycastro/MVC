<?php session_start(); ?>
<html>
<head>
    <title>HOME</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
 
<body>
    <center><div id="header">
        BIENVENIDO AL SISTEMA DE CONTROL DE ACCESO!
    </div></center>
    
    <?php
    if(isset($_SESSION['valid'])) {            
        include("connection.php");                    
        $result = mysqli_query($mysqli, "SELECT * FROM login");
    ?>                
        Bienvenido <?php echo $_SESSION['name'] ?> ! <a href='logout.php'>Cerrar sesión</a><br/>
        <br/>
        <a href='view.php'>Ver y agregar productos</a>
        <br/><br/>
    <?php    
    } else {
        echo "Usted debe de uniciar sesión para ver esta página.<br/><br/>";
        echo "<a href='login.php'>Login</a> | <a href='register.php'>Registrar</a>";
    }
    ?>
    <div id="footer">
        Creado por feyber</a>
    </div>
</body>
</html>