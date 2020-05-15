<?php require_once("../seguridad/seguridad.php");
     include ('../conexion.php');
     if(!isset($_SESSION)) { session_start(); } 
       $usuario=$_SESSION["usuario"];
	    $conexion = Conectarse();
	   $tipo=$_GET["tipo"];
       $sql=mysqli_query($conexion,"SELECT tipo_usuario FROM des_clientes_usuario WHERE nombre_usua like '$usuario' and estado_usuario like 'Activo'");
        while($row=mysqli_fetch_assoc($sql)) {
			$tipoUsuario = $row["tipo_usuario"];
		}
		mysqli_free_result($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>.::Busquedas::.</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
    <link rel="shortcut icon" href="../img/icono.ico">
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
  
       folder instead of downloading all of them to reduce the load. -->
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
  <script language="JavaScript" type="text/javascript" src="ajax.js"></script>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">

  <div class="content-wrapper">
  <center><br><h3>Generación de Reporte</h3></center>
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
           <br>
            <?php
			 if($tipo=="departamento"){
			 ?>  
           <form method="post" action="reporteDepar.php"> 
            <table id="example1" class="table table-bordered table-striped">
                <tr> 
            	 <th> 
                  <select name="opcion" id="opcion" class="form-control">
                  <?php 
				    $sqlJuzgado=mysqli_query($conexion,"SELECT distinct(ciudad) FROM des_juzgados");
		            $muni="";
				    while($rowJ=mysqli_fetch_array($sqlJuzgado)) {
					  $muni = $rowJ["ciudad"];
				    	$sqlM=mysqli_query($conexion,"select opcion from lista_estados where id like '$muni'");
						 $nomMuni="";
						 while($rowM = mysqli_fetch_assoc($sqlM)){	
							$nomMuni = $rowM["opcion"];	
                  ?>
                        <option value="<?php echo $muni;?>"><?php echo $nomMuni;?></option>
                        <?php
						 }
					}
					?>
                   </select>
                  </th>
                  <th><input style="background:#09F; color:#FFF" type="submit" class="form-control" value="Generar" title="Generar reporte"></th>
                </tr>
            </table> 
          </form>
          <?php
			 }
	  	       if($tipo=="Actuaciones"){
	 	   ?> 
            <form method="post" action="reporteActuaciones.php"> 
            <table id="example1" class="table table-bordered table-striped">
                <tr> 
            	 <th><input name="radicado" id="radicado" type="text" class="form-control" autofocus placeholder="Número de Radicado del Proceso"></th>
                  <th><input style="background:#09F; color:#FFF" type="submit" class="form-control" value="Generar" title="Generar reporte"></th>
                </tr>
            </table> 
          </form>
          <?php
			 }
		   if($tipo=="Fechas"){
	 	   ?> 
            <form method="post" action="reporteFechas.php"> 
            <table id="example1" class="table table-bordered table-striped">
                <tr> 
				 <th>Fecha Inicial</th>            	
                 <th><input name="fecha1" id="fecha1" type="date" class="form-control" autofocus></th>
               </tr>
               <tr>
                 <th>Fecha Final</th>            	
                 <th><input name="fecha2" id="fecha2" type="date" class="form-control" autofocus></th>
               </tr>
               <tr>  
                 <th><input style="background:#09F; color:#FFF" type="submit" class="form-control" value="Generar" 
                 title="Generar reporte"></th>
                </tr>
            </table> 
          </form>
          <?php
		   }
		   if($tipo=="Eventos"){
		   ?>
            <form method="post" action="reporteEventos.php"> 
            <table id="example1" class="table table-bordered table-striped">
                <tr> 
				 <th>Fecha Inicial</th>            	
                 <th><input name="fecha1" id="fecha1" type="date" class="form-control" autofocus></th>
               </tr>
               <tr>
                 <th>Fecha Final</th>            	
                 <th><input name="fecha2" id="fecha2" type="date" class="form-control" autofocus></th>
               </tr>
               <tr>  
                 <th><input style="background:#09F; color:#FFF" type="submit" class="form-control" value="Generar" 
                 title="Generar reporte"></th>
                </tr>
            </table> 
          </form>
          <?php
		   }
		  ?>
      </div>
     </div>
        
        
   
 </div>
<!-- ./wrapper -->

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
<!-- jvectormap -->
<script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
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
</body>
</html>
