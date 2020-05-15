<?php
 function Conectarse() {
  if(!($link=mysql_connect("localhost","sistemaabogados","sisabogados"))){
    echo "ERROR CONECTANDO CON EL SERVIDOR DE MYSQL";
    exit();
  }
   if(!mysql_select_db("bd_abogados",$link)){
    echo "ERROR SELECCIONANDO LA BASE DE DATOS";
	exit();
   }
    return $link;
 }
Conectarse();
?>

