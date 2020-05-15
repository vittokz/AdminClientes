<?php //require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
   include ('../conexion.php');
	 $conexion = Conectarse();
	 if(!isset($_SESSION)) { session_start(); } 
	   $idAyuda=$_GET['idAyuda'];	 
		        $sql="DELETE FROM des_clientes_ayuda where idAyuda like '$idAyuda'";
				mysqli_query($conexion,$sql) or die('<center>No se elimino Solicitud !!..</center>');
				echo "<script language='javascript'> 
					alert('Se elimino solicitud correctamente...!!');
					location.href='soporte.php' </script>";
?>

