<?php
function Conectarse(){
    $server = "localhost";
    $user = "viacpro2018";
    $pass = "despacho18";
    $bd = "despacho_viacpro";


    $conexion = mysqli_connect($server, $user, $pass,$bd) 
        or die("Ha sucedido un error inexperado en la conexion de la base de datos");

    return $conexion;
} 


?>

