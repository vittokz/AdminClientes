<?php
 require_once('../seguridad/seguridad.php'); 
  require_once('../conexion.php'); 
	if(!isset($_SESSION)) { session_start(); } 
 	 $usuario = $_SESSION["usuario"];
      $conexion = Conectarse();
   $idCliente=$_POST["idCliente"];
   $carpeta ="imgLogos/".$idCliente."/";

   if (!file_exists($carpeta)) {
		mkdir($carpeta, 0777, true);
    }
	 
	$dir_subida = $carpeta;
	$nomImagen=basename($_FILES['imagen']['name']);
	$fichero_subido = $dir_subida.basename($_FILES['imagen']['name']);
  
	if (move_uploaded_file($_FILES['imagen']['tmp_name'], $fichero_subido)) {
		 $sql=mysqli_query($conexion,"UPDATE des_cliente SET logo ='$nomImagen' WHERE id_cliente like '$idCliente'");
		 echo "<script> alert('Se subio correctamente la imagen.'); </script>";
		 echo "<script> location.href='perfil.php' </script>";	
		
	
	} else {
		echo "¡No subio la imagen verifique!!\n";
	}


?>