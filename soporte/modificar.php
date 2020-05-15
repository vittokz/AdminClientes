<?php //require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
   include ('../conexion.php');
	  if(!isset($_SESSION)) { session_start(); } 
	   $usuario = $_SESSION["usuario"]; 
	  $conexion = Conectarse();
	  $sql=mysqli_query($conexion,"SELECT * FROM des_clientes_usuario WHERE nombre_usua like '$usuario' and estado_usuario like 'Activo'");
        while($row=mysqli_fetch_assoc($sql)) {
			$identidad = $row["cedula_usuario"];
		}
	  mysqli_free_result($sql);
	  $tipo=$_POST['tipo'];
	  $detalle=$_POST['detalle'];
	
	  date_default_timezone_set('America/Bogota');
	  $hoy = date("Y-m-d g:i a"); 
	  
	  $sql="insert into des_clientes_ayuda 
	  (idCliente,temaAyuda,problema,estado,fechaRegistro,usuarioRegistra,fechaRespuesta,usuarioRespuesta,observacion)
	  values('$identidad','$tipo','$detalle','Pendiente','$hoy','$usuario','','','')";  
	  mysqli_query($conexion,$sql) or die('<center><font color="red">No se registro el ticket.. Verifique!!!..</font></center>');
      echo "<center><img  src='../img/correcto.png' width='75' height='72'></center><br>"; 
	  echo "<center><font color='red'>Se registro la solicitud correctamente</font></center>";
?>

