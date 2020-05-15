<?php //require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
   include ('../conexion.php');
	  $identidad=$_POST['iden'];
	  $clave=$_POST['clave'];
	  $conexion = Conectarse();
      $sql="UPDATE des_clientes_usuario set clave_usuario = '$clave' where cedula_usuario like '$identidad'";
      mysqli_query($conexion,$sql) or die('<center><font color="red">No se modificco clave de usuario!!!..</font></center>');
   

      echo "<center><img  src='../img/correcto.png' width='75' height='72'></center><br>"; 
	  echo "<center><font color='red'>Se actualizo correctamente!!</font></center>";

?>

