<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
//Exportar datos de php a Excel
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=reporte.xls");
include('../conexion.php'); 
   if(!isset($_SESSION)) { session_start(); } 
       $usuario=$_SESSION["usuario"];
	   $conexion = Conectarse();
       $identidad="";
       $sql=mysqli_query($conexion,"SELECT tipo_usuario,cedula_usuario FROM des_clientes_usuario WHERE nombre_usua like '$usuario' and estado_usuario like 'Activo'");
        while($row=mysqli_fetch_assoc($sql)) {
			$tipoUsuario = $row["tipo_usuario"];
			$identidad= $row["cedula_usuario"];
		}
		mysqli_free_result($sql);	     
		  
  date_default_timezone_set('America/Bogota');
  $hoy = date("Y-m-d g:i a"); 
 
  $fecha1=$_POST["fecha1"];
  $fecha2=$_POST["fecha2"];
 
?><style>

table#mitabla {
    border-collapse: collapse;
    border: 1px solid #CCC;
    font-size: 12px;
}
 
table#mitabla th {
    font-weight: bold;
    background-color: #E1E1E1;
    padding:5px;
}
 
table#mitabla tbody tr:hover td {
    background-color: #F3F3F3;
}
 
table#mitabla td {
    padding: 3px 6px;
}

</style>
<br /><br />
<center>
<h2>Reporte Completo de Eventos entre fechas <?php echo $fecha1." al ".$fecha2;?></h2>
</center>
<h3>fecha de generación: <?php echo $hoy;?></h3>
<div align="center">
<table id="mitabla" border="1">
    <tr bgcolor="#00CCFF" class="letras">
        <th>Titulo</th>
        <th>Evento</th>
        <th>Fecha Inicio</th>
        <th>Fecha Fin</th>
   </tr>
				<?php
				 /*$hoy = date("Y-m-d"); 
			     $nuevafecha = strtotime ( '+5 day' , strtotime ( $hoy ) ) ;
			     $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
				*/
				$sql=mysqli_query($conexion,"select * from eventos where idCliente like '$identidad' and inicio
				BETWEEN '$fecha1' and '$fecha2' order by inicio DESC");
                
				while($row = mysqli_fetch_assoc($sql)){	
						 $title = $row["title"];	
						 $body = $row["body"];	
						 $fechaInicio = $row["inicio"];
						 $fechaFin = $row["fin"];
					 
			        ?>   
						 <tr bgcolor="#EBEBEB">
							<td><?php echo  strtoupper($title);?></td>
							<td><?php echo  strtoupper($body); ?></td>
							<td><?php echo  $fechaInicio;?></td>
							<td><?php echo  $fechaFin;?></td>
				 	   </tr>
                  <?php
				}
				mysqli_free_result($sql);
?> </table>
</div>











