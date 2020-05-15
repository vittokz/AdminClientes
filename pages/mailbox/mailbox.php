<?php require_once("../../seguridad/seguridad.php");
     include ('../../conexion.php');
     if(!isset($_SESSION)) { session_start(); } 
       $usuario=$_SESSION["usuario"];
	   $conexion = Conectarse();
	   $identidad="";$nombre="";$apellido ="";$claveUsuario ="";$tipoUsuario ="";
       $sql=mysqli_query($conexion,"SELECT * FROM des_clientes_usuario WHERE nombre_usua like '$usuario' and estado_usuario like 'Activo'");
        while($row=mysqli_fetch_assoc($sql)) {
          $identidad = $row["cedula_usuario"];
          $nombre = $row["nombre"];
          $apellido = $row["apellido"];
          $nomUsuario = $row["nombre_usua"];
          $claveUsuario = $row["clave_usuario"];
          $tipoUsuario = $row["tipo_usuario"];
		}
    mysqli_free_result($sql);
    $sql=mysqli_query($conexion,"SELECT * FROM des_cliente WHERE cedula_cliente like '$identidad'");
    while($row=mysqli_fetch_assoc($sql)) {
      $logo = $row["logo"];
      $id_cliente = $row["id_cliente"];
    }
    mysqli_free_result($sql);
           
    if($logo==""){
        $logoImagen="../../dist/img/avatar5.png";
    }
    else{
      $logoImagen="../../perfil/imgLogos/".$id_cliente."/".$logo;
    }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>.::Email::.</title>
   <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../../plugins/iCheck/flat/blue.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

   <link rel="shortcut icon" href="../../img/icono.ico">
   <script src="../../push/push.min.js"></script>
  <script language="JavaScript" type="text/javascript" src="ajax.js"></script>
 </head>
<body class="hold-transition skin-blue sidebar-mini">
<?php
$sql=mysqli_query($conexion,"SELECT * FROM des_email where destinatario like '$usuario' and estado like 'Sin leer'");
$can=0;    
while($row=mysqli_fetch_assoc($sql)) 
     {
         $asunto= $row["asunto"];
         $can=$can+1;
     }

     if($can>0){
?>
    <script>
     		Push.create("Notificación Viacpro", { //Titulo de la notificación
      	body: "Hay correos sin leer!!!", //Texto del cuerpo de la notificación
        icon: '../../img/mensaje.png', //Icono de la notificación
        timeout: 6000, //Tiempo de duración de la notificación
          onClick: function () {//Función que se cumple al realizar clic cobre la notificación
             window.location = "https://www.viacpro.com/AdminClientes/pages/mailbox/mailbox.php"; //Redirige a la siguiente web
             this.close(); //Cierra la notificación
          }
        });
    </script>
 <?php
     }
 ?>
<center> <div style="width:100%; height:15%; background-image:url('../../img/FondoNuevo.jpg')">
<center><span style="font-size:26px; color:#FFF; font-weight:800; font-family:Georgia, 'Times New Roman', Times, serif">VIGILANCIA DE ACTUACIONES PROCESALES
<br><img src="../../img/viacpro.png" style="width:15%">
</span></center>
</div></center>
<?php
  if($logo==""){
   
?>  
    <script>
    //Todo el código que se encuentra aquí se auto explica 
    Push.create("Notificación Viacpro", { //Titulo de la notificación
      body: "Aun no actualiza su foto de perfil", //Texto del cuerpo de la notificación
      icon: '../../img/fotos.png', //Icono de la notificación
      timeout: 8000, //Tiempo de duración de la notificación
      onClick: function () {//Función que se cumple al realizar clic cobre la notificación
        window.location = "https://www.viacpro.com/AdminClientes/perfil/perfil.php"; //Redirige a la siguiente web
        this.close(); //Cierra la notificación
      }
    });
  </script>
<?php
  }
?>
<div class="wrapper"  >

  <header class="main-header">
    <!-- Logo -->
    <a href="../../index.php" class="logo" style="background-image:url('../../img/azulOscuro.png')">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg" style="font-family:Georgia, 'Times New Roman', Times, serif;font-size:16px; font-weight:800;">INICIO</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" style="background-image:url('../../img/azulOscuro.png')">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
         <span style="font-size:16px; font-weight:800; font-family:Georgia, 'Times New Roman', Times, serif">VIACPRO</span>
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
              <li><a href="../../alertas/alertas.php"><i class="fa fa-database"></i><?php echo substr($actuacion, 0, 26);?></a></li>
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
                   <li><a href="../../soporte/soporte.php"><i class="fa fa-file"></i> <?php echo "Solicitud de Ayuda: ".$temaAyuda;?></a></li>
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
                  <a href="../../perfil/perfil.php" class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                  <a href="../../seguridad/cerrar.php" class="btn btn-default btn-flat">Cerrar Sesión</a>
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
          <a href="../../perfil/perfil.php">
            <i class="fa fa fa-user"></i>
            <span>Perfil</span>
            <span class="pull-right-container">
            
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="">
            <i class="fa fa-th"></i> <span>Procesos</span>
            <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <li><a href="../../juzgados/juzgados.php"><i class="fa fa-circle-o"></i> Juzgados</a></li>
             <li><a href="../../procesos/procesos.php"><i class="fa fa-circle-o"></i> Radicado</a></li>
             <li><a href="../../procesos/buscarDemandado.php"><i class="fa fa-circle-o"></i> Demandado</a></li>
             <li><a href="../../procesos/buscarDemandante.php"><i class="fa fa-circle-o"></i> Demandante</a></li>
             <li><a href="../../procesos/buscarMunicipio.php"><i class="fa fa-circle-o"></i> Municipio</a></li>
             <li><a href="../../procesos/buscarDepar.php"><i class="fa fa-circle-o"></i> Departamento</a></li>
          
          </ul>
        </li>
        <li>
          <a href="../../alertas/alertas.php">
            <i class="fa fa-newspaper-o"></i>
            <span>Alertas</span>
            <span class="pull-right-container">
             
            </span>
          </a>
         
        </li>
        <li>
          <a href="../../documentos/documentos.php">
            <i class="fa fa-archive"></i> <span>Documentos</span>
            <span class="pull-right-container">
             
            </span>
          </a>
         
        </li>
        <li>
          <a href="../../reportes/reportes.php">
            <i class="fa fa-bar-chart"></i> <span>Reportes</span>
            <span class="pull-right-container">
             
            </span>
          </a>
         
        </li>
        <li>
          <a href="../../soporte/soporte.php">
            <i class="fa fa-gavel"></i> <span>Soporte</span>
            <span class="pull-right-container">
             
            </span>
          </a>
          
        </li>
        <li class="active">
          <a href="">
            <i class="fa  fa-envelope-o"></i> <span>Correo</span>
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
    <!-- Content Header (Page header) -->

    <section class="content-header">
      <h1>
        Mailbox
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Correo</a></li>
       
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <a href="redactar.php" style="background-color:#1d1a31" class="btn btn-primary btn-block margin-bottom">Redactar</a>

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Menu</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="#"><i class="fa fa-inbox"></i> Bandeja de Entrada
                  <span class="label label-primary pull-right"></span></a></li>
                <li><a href="enviados.php"><i class="fa fa-envelope-o"></i> Enviados</a></li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
         
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Bandeja de Entrada</h3>

              <div class="box-tools pull-right">
                <div class="has-feedback">
                  <input type="text" class="form-control input-sm" placeholder="Search Mail">
                  <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                <div class="pull-right">
                  1-50/200
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
              </div>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
                  <?php
                     $sql=mysqli_query($conexion,"SELECT * FROM des_email where destinatario like '$usuario' order by fechaRegistro DESC");
                      $contMensajes=0; 
                     while($row=mysqli_fetch_assoc($sql)) {
                         $contMensajes=$contMensajes++;
                         $idEmail = $row["idEmail"];
                         $asunto= $row["asunto"];
                         $mensaje= $row["descripcion"];
                         $archivoAdjunto= $row["archivoAdjunto"];
                         $fechaRegistro = $row["fechaRegistro"];
 
                  ?>
                  <tr>
                    <td><input type="checkbox"></td>
                    <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
                    <td class="mailbox-name"><a href="leerMensajeRecibido.php?idEmail=<?php echo $idEmail;?>"><?php echo $asunto;?></a></td>
                    <td class="mailbox-subject"><b><?php echo substr($mensaje,0,15)."...";?></b> 
                    </td>
                    <td class="mailbox-attachment"> <?php echo $archivoAdjunto;?></td>
                    <td class="mailbox-date"> <?php echo $fechaRegistro;?></td>
                  </tr>
                  <?php
                        }
                  ?>
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                <div class="pull-right">
                  1-50/200
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
              </div>
            </div>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>

   </div>


  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<footer style="background-image:url('../../img/FondoNuevo.jpg')">
  <center><img src="../../img/viacpro.png"></center>
  </footer>
<!-- jQuery 3 -->
<!-- jQuery 3 -->
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Slimscroll -->
<script src="../../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- iCheck -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
<!-- Page Script -->
<script>
  $(function () {
    //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $('.mailbox-messages input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });

    //Handle starring for glyphicon and font awesome
    $(".mailbox-star").click(function (e) {
      e.preventDefault();
      //detect type
      var $this = $(this).find("a > i");
      var glyph = $this.hasClass("glyphicon");
      var fa = $this.hasClass("fa");

      //Switch states
      if (glyph) {
        $this.toggleClass("glyphicon-star");
        $this.toggleClass("glyphicon-star-empty");
      }

      if (fa) {
        $this.toggleClass("fa-star");
        $this.toggleClass("fa-star-o");
      }
    });
  });
</script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
</body>
</html>
