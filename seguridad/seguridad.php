<?php
//Inicio la sesi�n 
session_start(); 
//COMPRUEBA QUE EL USUARIO ESTA AUTENTIFICADO 
if ($_SESSION["autentificadoCliente"] != "SI") { 
    //si no existe, envio a la p�gina de autentificacion 
	echo "<script> location.href='login.html' </script>" ;
   //ademas salgo de este script 
    exit(); 
} 
?> 
