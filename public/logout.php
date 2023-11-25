<?php
//Clase logout.php realizada por Paula Salicio
//Clase que se ejecuta cuando se cierra sesión el usuario
session_start();
session_destroy();
header("Location: index.php");
?>