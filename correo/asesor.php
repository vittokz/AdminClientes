<?php
			
			$nombre = $_POST["nombre"];
			$email = $_POST["email"];
			$tel = $_POST["tel"];
			$ciudad = $_POST["ciudad"];
	       	require_once("../AdminClientes/conexion.php");
			$conexion = Conectarse();
			$sql="INSERT INTO des_trabaje (nombre,email,telefono,ciudad,tipo,semestre,estudios,nomEstudios,fechaRegistro) 
			VALUES ('$nombre','$email','$tel','$ciudad','Asesor','$semestre','','',now())";
			mysqli_query($conexion,$sql) or die ("No se inserto:".mysql_error());
			
	
	       /* $asunto = "Solicitud VIACPRO-Registro Informacion Dependiente Judicial"; 
         	//para el envío en formato HTML 
			$headers = "MIME-Version: 1.0\r\n"; 
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
			
			//dirección del remitente 
			$headers .= "From: Viacpro <info@viacpro.com>\r\n"; 
			$headers .="Informacion del Usuario que realiza solicitud.<br><br>";
			$headers .= "Nombre : ".$nombre."<br>"; 
	    	$headers .= "email : ".$email."<br>";
			$headers .= "Telefono : ".$tel."<br>";
			$headers .= "Ciudad : ".$ciudad."<br>";
			$headers .= "Semestre : ".$semestre."<br>";
			*/
			//envio mail a cliente registrado
			$asunto = "Solicitud VIACPRO-Registro con exito Informacion Asesor Comercial"; 
         	//para el envío en formato HTML 
			$headers = "MIME-Version: 1.0\r\n"; 
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
			
			//dirección del remitente 
			$headers .= "From: Viacpro <info@viacpro.com>\r\n"; 
			$headers .="Informacion del Usuario que realiza solicitud.<br><br>";
			$headers .= "Nombre : ".$nombre."<br>"; 
	    	$headers .= "email : ".$email."<br>";
			$headers .= "Telefono : ".$tel."<br>";
			$headers .= "Ciudad : ".$ciudad."<br>";
			$headers .= "Sus datos se encuentran registrados en nuestra base de datos, pronto lo contactaremos!!!<br>";


	    	mail("cov1_1@hotmail.com",$asunto,$cuerpo,$headers) ;
			echo "<script language='javascript' type='text/javascript'>
			alert('Se registro correctamente su información!!!'); </script>";
		   echo "<script> location.href='../index.html' </script>";
?>


		