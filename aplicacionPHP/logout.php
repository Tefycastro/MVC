<? php
session_start ();
session_destroy(); // destruyo la sesión 
      header(" Ubicación: index.php "); //envío al usuario a la pag. de autenticación 
      //sino, actualizo la fecha de la sesión 
? >

