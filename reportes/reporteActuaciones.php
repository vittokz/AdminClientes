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
	   $conexion=Conectarse();
       $identidad="";
       $sql=mysqli_query($conexion,"SELECT tipo_usuario,cedula_usuario FROM des_clientes_usuario WHERE nombre_usua like '$usuario' and estado_usuario like 'Activo'");
        while($row=mysqli_fetch_assoc($sql)) {
			$tipoUsuario = $row["tipo_usuario"];
			$identidad= $row["cedula_usuario"];
		}
		mysqli_free_result($sql);	
  $radicado=$_POST["radicado"];
  $sqlP="select * from des_procesos where idCliente like '$identidad' and idRadicado like '$radicado'";
  
  $resulP = mysqli_query($conexion,$sqlP);
					 	 while($rowP = mysqli_fetch_assoc($resulP)){	
							 $idProceso = $rowP["idProceso"];	
						 }
	mysqli_free_result($resulP);						 
						 
  date_default_timezone_set('America/Bogota');
  $hoy = date("Y-m-d g:i a"); 
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
<h2>Reporte del proceso por radicado N°. <?php echo $radicado;?></h2>
</center>
<h3>fecha: <?php echo $hoy;?></h3>
<div align="center">
<table id="mitabla" border="1">
    <tr bgcolor="#00CCFF" class="letras">
        <th>Radicado</th>
        <th>Fecha</th>
        <th>Tipo</th>
        <th>Descripción Actuación</th>
        <th>Fecha Auto</th>
        <th>Fecha Inicio</th>
        <th>Fecha Final</th>
        <th>Hora</th>
   </tr>
				<?php
			    	$sqlP=mysqli_query($conexion,"select * from des_actuaciones where idCliente like '$identidad' 
						and idProceso like '$idProceso' order by fechaFin");
					 	 while($rowP = mysqli_fetch_assoc($sqlP)){	
							 $fecha = $rowP["fecha"];	
							 $tipo = $rowP["tipo"];	
							 $actuacion = $rowP["actuacion"];
							 $fechaAuto = $rowP["fechaAuto"];
							 $fechaInicio = $rowP["fechaInicio"];
							 $fechaFinal = $rowP["fechaFin"];
							 $hora = $rowP["hora"];
				 
			        ?>   
						 <tr bgcolor="#EBEBEB">
							<td><?php echo  $radicado;?></td>
							<td><?php echo  $fecha; ?></td>
							<td><?php echo  strtoupper($tipo); ?></td>
							<td><?php echo  strtoupper($actuacion); ?></td>
							<td><?php echo  strtoupper($fechaAuto); ?></td>
							<td><?php echo  strtoupper($fechaInicio); ?></td>
                            <td><?php echo  strtoupper($fechaFinal); ?></td>
                            <td><?php echo  strtoupper($hora); ?></td>
				 	   </tr>
                  <?php
				       
					}
				mysqli_free_result($sqlP);
?> </table>
</div>











