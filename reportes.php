<?php require_once("../seguridad/seguridad.php");
     include ('../conexion.php');
     $conexion = Conectarse();
	 if(!isset($_SESSION)) { session_start(); } 
       $usuario=$_SESSION["usuario"];
	
	   $identidad="";
       $sql=mysqli_query($conexion,"SELECT tipo_usuario,cedula_usuario FROM des_clientes_usuario WHERE nombre_usua like '$usuario' and estado_usuario like 'Activo'");
        while($row=mysqli_fetch_assoc($sql)) {
			$tipoUsuario = $row["tipo_usuario"];
			$identidad= $row["cedula_usuario"];
		}
    mysqli_free_result($sql);
    $sql=mysqli_query($conexion,"SELECT * FROM des_cliente WHERE cedula_cliente like '$identidad'");
    while($row=mysqli_fetch_assoc($sql)) {
      $logo = $row["logo"];
      $id_cliente = $row["id_cliente"];
    }
    mysqli_free_result($sql);
           
    if($logo==""){
        $logoImagen="../dist/img/avatar5.png";
    }
    else{
      $logoImagen="../perfil/imgLogos/".$id_cliente."/".$logo;
    }  
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>.::Reportes de eventos::.</title>
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
<center> <div style="width:100%; height:15%; background:#003">
<center><span style="font-size:26px; color:#FFF; font-weight:800; font-family:Georgia, 'Times New Roman', Times, serif">VIGILANCIA DE ACTUACIONES PROCESALES
<img src="../../images/viacpro3.png" style="width:10%">
</span></center>
</div></center>
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="../index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b></span>
      <!-- logo for regular state and mobile devices -->
       <span class="logo-lg" style="font-family:Georgia, 'Times New Roman', Times, serif;font-size:16px; font-weight:800;">INICIO</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
     <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
         <span style="font-size:16px; font-weight:800; font-family:Georgia, 'Times New Roman', Times, serif">VIACPRO </span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
          <?php
            date_default_timezone_set('America/Bogota');
			   $hoy = date("Y-m-d"); 
			   $sql="select * from des_actuaciones where idCliente like '$identidad' and fechaFin like '$hoy' order by fechaFin DESC";
			   $res=mysqli_query($conexion,$sql);
			     $conActuaciones=0;	
				while($r=mysqli_fetch_assoc($res)){
					 $conActuaciones++;
				}
				mysqli_free_result($res);
			 ?>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success"><?php echo  $conActuaciones;?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Actuaciones que vencen hoy : <?php echo $hoy;?></li>
             <?php
               $sql="select * from des_actuaciones where idCliente like '$identidad' and fechaFin like '$hoy' order by fechaFin DESC";
			   $resul = mysqli_query($conexion,$sql);
			    while($row=mysqli_fetch_assoc($resul)) {
					$actuacion = $row["actuacion"];
			   ?>
              <li><a href="../alertas/alertas.php"><i class="fa fa-database"></i><?php echo substr($actuacion, 0, 26);?></a></li>
              <?php
			  }
				mysqli_free_result($resul);
			  ?>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
           <?php 
		       $temaAyuda ="";$estado="";$i=0;$problema = "";$fechaRegistro = "";$fechaRespuesta ="";$idCliente ="";
			   $sql="SELECT * FROM des_clientes_ayuda where estado like 'Pendiente' order by fechaRegistro ASC";
			   $resul = mysqli_query($conexion,$sql);
			    $con=0;		
			    while($row=mysqli_fetch_assoc($resul)) {
					$con ++;
					$idAyuda = $row["idAyuda"];
					$idCliente = $row["idCliente"];
					$temaAyuda = $row["temaAyuda"];
				}
				mysqli_free_result($resul);
			?>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning"><?php echo $con;?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Notificaciones Soporte Clientes</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
               <?php
                 $sql="SELECT * FROM des_clientes_ayuda where estado like 'Pendiente' order by fechaRegistro ASC";
                   $resul = mysqli_query($conexion,$sql);
                   while($row=mysqli_fetch_assoc($resul)) {
                        $idAyuda = $row["idAyuda"];
                        $idCliente = $row["idCliente"];
                        $temaAyuda = $row["temaAyuda"];
                ?>
                   <li><a href="../soporte/soporte.php"><i class="fa fa-file"></i> <?php echo "Solicitud de Ayuda: ".$temaAyuda;?></a></li>
                <?php
				   }
				 ?>
                </ul>
              </li>
              <li class="footer"></li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo $logoImagen;?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo $logoImagen;?>" class="img-circle" alt="User Image">

                <p>
                
                  <small> <?php echo $usuario;?></small>
                </p>
              </li>
              <!-- Menu Body -->
             
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="../perfil/perfil.php" class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                  <a href="../seguridad/cerrar.php" class="btn btn-default btn-flat">Cerrar Sesión</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $logoImagen;?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $usuario;?></p>
          <a href="#"><i class="fa fa-circle text-success"></i>En Linea</a>
        </div>
      </div>
     
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
   
        
        <li>
          <a href="../perfil/perfil.php">
            <i class="fa fa fa-user"></i>
            <span>Perfil</span>
            <span class="pull-right-container">
            
            </span>
          </a>
        </li>
        <li class="treeview menu-open">
          <a href="">
            <i class="fa fa-th"></i> <span>Procesos</span>
            <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
      
             <li><a href="../juzgados/juzgados.php"><i class="fa fa-circle-o"></i> Juzgados</a></li>
             <li><a href="../procesos/procesos.php"><i class="fa fa-circle-o"></i> Radicado</a></li>
             <li><a href="../procesos/buscarDemandado.php"><i class="fa fa-circle-o"></i> Demandado</a></li>
             <li><a href="../procesos/buscarDemandante.php"><i class="fa fa-circle-o"></i> Demandante</a></li>
             <li><a href="../procesos/buscarMunicipio.php"><i class="fa fa-circle-o"></i> Municipio</a></li>
             <li><a href="../procesos/buscarDepar.php"><i class="fa fa-circle-o"></i> Departamento</a></li>
          </ul>
        </li>
         <li>
          <a href="../alertas/alertas.php">
            <i class="fa fa-newspaper-o"></i>
            <span>Alertas</span>
            <span class="pull-right-container">
             
            </span>
          </a>
         
        </li>
        <li>
          <a href="../documentos/documentos.php">
            <i class="fa fa-archive"></i> <span>Documentos</span>
            <span class="pull-right-container">
             
            </span>
          </a>
         
        </li>
        <li class="active">
          <a href="../reportes/reportes.php">
            <i class="fa fa-bar-chart"></i> <span>Reportes</span>
            <span class="pull-right-container">
             
            </span>
          </a>
         
        </li>
        <li>
          <a href="../soporte/soporte.php">
            <i class="fa fa-gavel"></i> <span>Soporte</span>
            <span class="pull-right-container">
             
            </span>
          </a>
          
        </li>
        
         <li class="header"></li>
      
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Reportes
        <small></small>
      </h1>
<br><br>
     <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-print"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><p style="font-weight:700; font-size:16px">
              <a style="text-decoration:none; color:#FFF" href="reporteClientes.php?identidad=<?php echo $identidad;?>">
              
              Reporte de Procesos</a></p><br></span>
              <span class="info-box-number"></span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description">
                    
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-download"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><p style="font-weight:700; font-size:16px">
              <a style="text-decoration:none; color:#FFF" href="busqueda.php?tipo=departamento" target="popup" style="text-decoration:none;" onClick="window.open(this.href, this.target, 'toolbar=0 , location=1 , status=0 , menubar=1 , scrollbars=0 , resizable=1 ,left=500pt,top=80pt,width=400px,height=350px'); return false;">
               Procesos por Departamento</a></p><br></span>
              <span class="info-box-number"></span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description">
                    
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="fa fa-newspaper-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><p style="font-weight:700; font-size:16px">
              <a style="text-decoration:none; color:#FFF" href="busqueda.php?tipo=Actuaciones" target="popup" style="text-decoration:none;" onClick="window.open(this.href, this.target, 'toolbar=0 , location=1 , status=0 , menubar=1 , scrollbars=0 , resizable=1 ,left=500pt,top=80pt,width=400px,height=350px'); return false;">
              Actuaciones por Proceso</a></p><br></span>
              <span class="info-box-number"></span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description">
                    
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>    
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box" style="background:#900; color:#FFF">
            <span class="info-box-icon"><i class="fa fa-map-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><p style="font-weight:700; font-size:16px">
              <a style="text-decoration:none; color:#FFF" href="busqueda.php?tipo=Fechas" target="popup" style="text-decoration:none;"
onClick="window.open(this.href, this.target, 'toolbar=0 , location=1 , status=0 , menubar=1 , scrollbars=0 , resizable=1 ,left=550pt,top=80pt,width=350px,height=300px'); return false;">
               Procesos por Fechas</a></p><br></span>
              <span class="info-box-number"></span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description">
                    
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-calendar"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><p style="font-weight:700; font-size:16px">
              <a style="text-decoration:none; color:#FFF" href="busqueda.php?tipo=Eventos" target="popup" style="text-decoration:none;"
onClick="window.open(this.href, this.target, 'toolbar=0 , location=1 , status=0 , menubar=1 , scrollbars=0 , resizable=1 ,left=550pt,top=80pt,width=350px,height=300px'); return false;">
               Reporte de Eventos</a></p><br></span>
              <span class="info-box-number"></span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description">
                    
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        
     </div>
   
 

   </section>
   
 </div>

 
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<footer style="background:#333">
  <center><img src="../img/viacpro.png"></center>
  </footer>
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
