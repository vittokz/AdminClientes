<?php //require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
   require_once ('../conexion.php');
	  $identidad=$_POST['identidad'];
      $sql="UPDATE des_usuario set nombre_usua = '$nomUsuario' where cedula_usuario like '$identidad'";
      mysql_query($sql) or die('<center><font color="red">No se modificco clave de usuario!!!..</font></center>');
   


?>

