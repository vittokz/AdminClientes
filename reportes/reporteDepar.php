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
  
  $opcion=$_POST["opcion"];
   $sqlJuzgado=mysqli_query($conexion,"SELECT nombre FROM des_juzgados WHERE ciudad like '$opcion'");
		            $nomJuz="";
				    while($rowJ=mysqli_fetch_assoc($sqlJuzgado)) {
					  $nomJuz = $rowJ["nombre"];
					}
					mysqli_free_result($sqlJuzgado);

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
<h2>Reporte Completo por Municipio</h2>
</center>
<h3>Listado completo fecha: <?php echo $hoy;?></h3>
<div align="center">
<table id="mitabla" border="1">
    <tr bgcolor="#00CCFF" class="letras">
        <th>Fecha Proceso</th>
        <th>Radicado</th>
        <th>Juzgado</th>
        <th>Clase Proceso</th>
        <th>Demandado</th>
        <th>Demandante</th>
   </tr>
				<?php
				$sqlJuzgado=mysqli_query($conexion,"SELECT distinct(idJuzgado) FROM des_juzgados WHERE ciudad like '$opcion'");
		            $idJuz="";
				    while($rowJ=mysqli_fetch_assoc($sqlJuzgado)) {
					  $idJuz = $rowJ["idJuzgado"];
					 
				    	$sqlP=mysqli_query($conexion,"select * from des_procesos where idCliente like '$identidad' 
						and idJuzgado like '$idJuz' order by fechaProceso");
					 	 while($rowP = mysqli_fetch_assoc($sqlP)){	
							 $fechaP = $rowP["fechaProceso"];	
							 $radicado = $rowP["idRadicado"];	
							 $idJuzgado = $rowP["idJuzgado"];
							 $idTipoProceso = $rowP["idTipoProceso"];
							 $demandado = $rowP["demandado"];
							 $demandante = $rowP["demandante"];
					
						
				 
			        ?>   
						 <tr bgcolor="#EBEBEB">
							<td><?php echo  $fechaP;?></td>
							<td><?php echo  $radicado; ?></td>
							<td><?php echo  strtoupper($nomJuz); ?></td>
							<td><?php echo  strtoupper($idTipoProceso); ?></td>
							<td><?php echo  strtoupper($demandado); ?></td>
							<td><?php echo  strtoupper($demandante); ?></td>
				 	   </tr>
                  <?php
				         }
				        mysqli_free_result($sqlJuzgado);
					}
				mysql_free_result($sqlP);
?> </table>
</div>











