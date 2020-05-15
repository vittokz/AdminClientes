<?php require_once("../seguridad/seguridad.php");
     include ('../conexion.php');
	
	   $identidad=$_GET["identidad"];
	   $idProceso=$_GET["idProceso"];
	   $radicado=$_GET["radicado"];
	   $conexion = Conectarse();
	    $sqlCliente=mysqli_query($conexion,"SELECT * FROM des_cliente WHERE cedula_cliente like '$identidad' and estado like 'Activo'");
        while($rowCliente=mysqli_fetch_assoc($sqlCliente)) {
			$nombre = $rowCliente["nombre"];
			$apellido = $rowCliente["apellido"];
			$municipio = $rowCliente["municipio"];
		}
		mysqli_free_result($sqlCliente);
		
		//verifico el idActuacion mayor para el numero de estado
		$numEstado=0;
		$sqlA=mysqli_query($conexion,"SELECT max(idActuacion) as mayor FROM des_actuaciones");
		while($rowA=mysqli_fetch_assoc($sqlA)) {
			$numEstado = $rowA["mayor"];
		}
		$numEstado++;
		mysqli_free_result($sqlA);	
?>

<!DOCTYPE html>
<html>
<head>
  
  <meta charset="utf-8">
  <title>.::Fijación en lista::.</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="shortcut icon" href="../img/icono.ico"> 
  
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<script type="text/javascript" src="select_dependientes.js"></script>
  <script language="JavaScript" type="text/javascript" src="ajax.js"></script>
 
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">


 <section class="content-header" style="width:100%">
        <h1>Fijación en lista</h1><br>
        <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
         <div class="box-body table-responsive no-padding">
               <table class="table table-hover">
                <tr style="background:#E5E5E5">
                  <th>N° Radicado</th>
                  <th style="color:#069"><?php echo $radicado;?></th>
                  <th>Identificación</th>
                  <th style="color:#069"><?php echo $identidad;?></th>
                  <th>Nombre Completo</th>
                  <th style="color:#069"><?php echo $nombre." ".$apellido;?></th>
                  <th>Municipio</th>
                  <th style="color:#069">
				     <?php 
					   $idCiudad=$municipio;
					   $nombreCiudad="";
					   $sqlCiudad=mysqli_query($conexion,"SELECT * FROM lista_estados where id like '$idCiudad'");
					   while($rowC=mysqli_fetch_assoc($sqlCiudad)) {
							$nombreCiudad = $rowC["opcion"];
						}
					   echo $nombreCiudad;
					 ?>
                  </th>
               </tr>
              </table>
           </div>
          <br><br>			  
          </div> 
          </div>
          <div class="box">
           <div class="box-body">
           <?php
		     $fecha="";$tipo ="";$des ="";$fechaA ="";$fechaI="";$fechaF="";$hora="";
		$sqlA=mysqli_query($conexion,"SELECT * FROM des_actuaciones WHERE idProceso like '$idProceso' and tipo like 'fijacionlista' order by fechaRegistro DESC");
		   ?>
         <div class="table-responsive">
             <h3>Listado</h3>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr style="background:#003A75; color:#FFF; font-size:12px">
                  <th>N. Estado</th>

                   <th>Fecha</th>
                  <th>Tipo</th>
                  <th>Descripción</th>
                  <th>Fecha Auto</th>
                  <th>Fecha Inicio</th>
                  <th>Fecha Final</th>
                 
                  <th>Ver Foto</th>
                </tr>
                </thead> 
                <tbody>
                <?php
				 while($rowA=mysqli_fetch_assoc($sqlA)) {
				    $fecha = $rowA["fecha"];
$idActuacion = $rowA["idActuacion"];
										
$tipo = $rowA["tipo"];
					$actuacion = $rowA["actuacion"];
					$fechaAuto = $rowA["fechaAuto"];
					$fechaInicio = $rowA["fechaInicio"];
					$fechaFin = $rowA["fechaFin"];
					$hora = $rowA["hora"];
					$nombreArchivo = $rowA["nombreArchivo"];
				?>
                  <tr style="font-size:11px">
<td><?php echo $idActuacion;?></td>

                   
<td><?php echo $fecha;?></td>
                   <td><?php echo strtoupper($tipo);?></td>
                  <td><?php  echo strtoupper($actuacion);?></td>
                  <td><?php echo $fechaAuto;?></td>
                  <td><?php echo $fechaInicio;?></td>
                  <td><?php echo $fechaFin;?></td>
                 
                  <td>
                    <a href="../../AdminDespacho/procesos/imgProcesos/proceso<?php echo $idProceso;?>/actuaciones/<?php echo $nombreArchivo;?>"target="_blank"
onClick="window.open(this.href, this.target, 'toolbar=0 , location=1 , status=0 , menubar=1 , scrollbars=0 , resizable=1 ,left=370pt,top=70pt,width=500px,height=500px'); return false;">
                  <img  src='../img/ver.png' width='28' height='25' title="Ver foto">VER</a>
                  </td>
                 
                      
               <?php
				 }
			   ?> 
                </tbody>
                <tfoot>
                <tr style="background:#003A75; color:#FFF; font-size:12px">
<th>N. Estado</th>

                  
 <th>Fecha</th>
                  <th>Tipo</th>
                  <th>Descripción</th>
                  <th>Fecha Auto</th>
                  <th>Fecha Inicio</th>
                  <th>Fecha Final</th>
                 
                  <th>Ver Foto</th>
                 
                </tr>
                </tfoot>
              </table>
            </div>
               </div>
          </div>             
       </section>      



<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="../bower_components/raphael/raphael.min.js"></script>
<script src="../bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="../bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jQuery Knob Chart -->
<script src="../bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../bower_components/moment/min/moment.min.js"></script>
<script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- DataTables -->
<script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>

</body>
</html>