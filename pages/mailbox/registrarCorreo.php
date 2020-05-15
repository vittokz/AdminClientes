<?php //require_once("../seguridad/seguridad.php");?>

<?php

//Configuracion de la conexion a base de datos

   require_once ('../../conexion.php');
   $conexion = Conectarse();
	 if(!isset($_SESSION)) { session_start(); } 
	  $usuario = $_SESSION["usuario"]; 

      if(isset($_POST['asunto']) && isset($_POST['mensaje'])){
		$asunto=$_POST['asunto'];
		$mensaje=$_POST['mensaje'];
	  }
	  
	  if(isset($_GET['asunto']) && isset($_GET['mensaje'])){
		$asunto=$_GET['asunto'];
		$mensaje=$_GET['mensaje'];
	  }
	  

	  $destinatario="asesoria@viacpro.com";
	 
	 
	 
	  $cuerpo = "";
	 
	  $carpeta ="ArchivosCorreos/".$usuario."/";
	  if (!file_exists($carpeta)) {
			mkdir($carpeta, 0777, true);
		}
		$dir_subida = $carpeta;
		$ftp_servidor = "viacpro.com";
        $ftp_usuario = "desarrolladorviacpro@viacpro.com";
        $ftp_pass = "Viacpro2019.";
		
		$con_id = ftp_connect($ftp_servidor);
		$lr = ftp_login($con_id,$ftp_usuario,$ftp_pass);
		 if((!$con_id) || (!$lr)){
				echo "<center>No se pudo subir el archivo verifique con el administrador!!!</center>";
				exit;
		 }
		 else
		   {
				$destino ="AdminClientes/pages/mailbox/ArchivosCorreos/".$usuario."/";
				ftp_chdir($con_id, $destino);   
				$temp =explode(".",$_FILES["archivo"]["name"]);
		    	$source_file = $_FILES["archivo"]["tmp_name"];
				$nombre = $_FILES["archivo"]["name"];
				//ftp_pass($con_id,true);
				$subio=ftp_put($con_id,
				$nombre,
				$source_file,
				FTP_BINARY);
					if($subio) 
							{
							date_default_timezone_set('America/Bogota');
							$hoy = date("Y-m-d g:i a"); 
							$sql="INSERT INTO des_email(remitente,destinatario,asunto,descripcion,archivoAdjunto,estado,fechaRegistro)VALUES ('$usuario','$destinatario','$asunto','$mensaje','$nombre','Sin leer','$hoy')";
							mysqli_query($conexion,$sql) or die(mysql_error());
							echo "<script language='javascript'> 
								alert('Se envio correo correctamente!!');
								location.href='mailbox.php' </script>";
							}
					else{
						date_default_timezone_set('America/Bogota');
						$hoy = date("Y-m-d g:i a"); 
						$sql="INSERT INTO des_email(remitente,destinatario,asunto,descripcion,archivoAdjunto,estado,fechaRegistro)VALUES ('$usuario','$destinatario','$asunto','$mensaje','Sin archivo','Sin leer','$hoy')";
						mysqli_query($conexion,$sql) or die(mysql_error());
						echo "<script language='javascript'> 
							alert('Se envio correo correctamente!!');
							location.href='mailbox.php' </script>";
						
					}
					
			   
					//envio el correo electronico al cliente informando la actuacion
					//envio el correo electronico al cliente informando la actuacion
					/*
					$asunto = "Informe de registro de Actuacion VIACPRO-'Vigilancia de Actuaciones Procesales'"; 
					//para el envío en formato HTML 
					$headers = "MIME-Version: 1.0\r\n"; 
					$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
					$headers .= "From: VIACPRO <asesoria@viacpro.com>\r\n"; 
					$mensaje ='<a href="https://www.viacpro.com/AdminClientes"><img src="http://www.viacpro.com/AdminDespacho/img/viacpro2.png" width="100%"></a><br>';
					$mensaje .="<H1>Informacion de la Actuacion:</H1><br>";
					$mensaje .= 'N. Radicado:'.$idRadicado.'<br>Demandado :'.$demandado.' - Demandante: '.$demandante.'<BR>
					<br><table id="example1" class="table table-bordered table-striped">
						<thead>
						<tr style="background:#003A75; color:#FFF; font-size:12px">
							<th>N. Estado</th>
							<th>Fecha</th>
							<th>Descripcion</th>
							<th>Fecha Auto</th>
							<th>Fecha Inicio</th>
							<th>Fecha Final</th>
							<th>Juzgado</th>
							</tr>
						</thead> 
						<tbody>
						<td>'.$numEstado.'</td>
								<td>'.$fecha.'</td>
						
						<td>'.strtoupper($actuacion).'</td>
						<td>'.$fechaAuto.'</td>
						<td>'.$fechaInicio.'</td>
						<td>'.$fechaFin.'</td>
						<td>'.strtoupper($nomJuzgado).'</td>
						</tbody>
					<tfoot>
					<tr style="background:#003A75; color:#FFF">
						<th>N. Estado</th>       
						<th>Fecha</th>
						
						<th>Descripcion</th>
						<th>Fecha Auto</th>
						<th>Fecha Inicio</th>
						<th>Fecha Final</th>
						<th>Juzgado</th>
					</tr>
					</tfoot>
					</table>
				'; 
					$mensaje .= "<BR>Puede acceder a revisar la informacion :<br> 
					<a href='https://www.viacpro.com/AdminClientes'>www.viacpro.com/AdminClientes</a><br>
					<img src='../img/viacpro.png' width='20%'>
					";
					$mensaje .='<a href="https://www.viacpro.com/AdminClientes"><img src="https://www.viacpro.com/AdminDespacho/img/pieEmail.jpg" width="100%"></a><br>';
			$sqlEmail=mysql_query("SELECT distinct correo FROM des_envio_correos WHERE identidad like '$identidad'");
			 while($rowEmail=mysql_fetch_array($sqlEmail)) {
					$emailUsuarios = $emailUsuarios.','.$rowEmail["correo"];
						
				}
			  $long = strlen($emailUsuarios);
			 
			  $emailUsuarios=substr($emailUsuarios,0,($long-1));
			  $emailUsuarios=$emailUsuarios.",".$email;
			mail($emailUsuarios,$asunto,$mensaje,$headers) ;
			  */
			   //----fin---
			
			}
?>



