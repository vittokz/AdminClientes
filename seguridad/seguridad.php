<?php
//Inicio la sesión 
session_start(); 
//COMPRUEBA QUE EL USUARIO ESTA AUTENTIFICADO 
if ($_SESSION["autentificadoCliente"] != "SI") { 
    //si no existe, envio a la página de autentificacion 
	echo "<script> location.href='login.html' </script>" ;
   //ademas salgo de este script 
    exit(); 
} 
?> 
