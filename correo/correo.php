<?php
			
			$nombre = $_POST["nombre"];
			$email = $_POST["email"];
			$tel = $_POST["tel"];
			$ciudad = $_POST["ciudad"];
			$mensaje = $_POST["mensaje"];
			
			require_once("../AdminClientes/conexion.php");
		    $sql=mysql_query("INSERT INTO des_suscriptores (nombre,email,telefono,ciudad,mensaje,fechaRegistro) VALUES ('$nombre','$email','$tel','$ciudad','$mensaje',now())");
			
			$asunto = "Solicitud VIACPRO-Vigilancia de Actuaciones Procesales"; 
         	//para el envío en formato HTML 
			$headers = "MIME-Version: 1.0\r\n"; 
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
			
			//dirección del remitente 
			$headers .= "From: Viacpro <correo@viacpro.com>\r\n"; 
			$headers .="Informacion del Usuario que realiza solicitud.<br><br>";
			$headers .= "Nombre : ".$nombre."<br>"; 
	    	$headers .= "email : ".$email."<br>";
			$headers .= "Telefono : ".$tel."<br>";
			$headers .= "Ciudad : ".$ciudad."<br>";
			$headers .= "Mensaje : ".$mensaje."<br>";
	    	mail("vittorio15@hotmail.com, asesoria@viacpro.com",$asunto,$cuerpo,$headers) ;
			echo "<script language='javascript' type='text/javascript'>
			alert('Se registro correctamente a nuestras nocticias!!!'); </script>";
		   echo "<script> location.href='../index.html' </script>";
?>