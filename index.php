<?php require_once("seguridad/seguridad.php");
     include ('conexion.php');
	 $conexion = Conectarse();
     if(!isset($_SESSION)) { session_start(); } 
       $usuario=$_SESSION["usuario"];
	
	   $identidad="";
       $sql=mysqli_query($conexion,"SELECT cedula_usuario FROM des_clientes_usuario WHERE nombre_usua like '$usuario' and estado_usuario like 'Activo'");
        while($row=mysqli_fetch_assoc($sql)) {
			$identidad = $row["cedula_usuario"];
		}
		mysqli_free_result($sql);
		$sql=mysqli_query($conexion,"SELECT * FROM des_cliente WHERE cedula_cliente like '$identidad'");
    while($row=mysqli_fetch_assoc($sql)) {
      $logo = $row["logo"];
      $id_cliente = $row["id_cliente"];
    }
    mysqli_free_result($sql);
           
    if($logo==""){
        $logoImagen="dist/img/avatar5.png";
    }
    else{
      $logoImagen="perfil/imgLogos/".$id_cliente."/".$logo;
    }

    

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>.::Administración::.</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
   <link rel="shortcut icon" href="img/icono.ico">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<style>
 .text {
  font-size:20px;
  font-family:helvetica;
  font-weight:bold;
  color:#FFF;
  text-transform:uppercase;
}
.parpadea {
  
  animation-name: parpadeo;
  animation-duration: 1s;
  animation-timing-function: linear;
  animation-iteration-count: infinite;

  -webkit-animation-name:parpadeo;
  -webkit-animation-duration: 1s;
  -webkit-animation-timing-function: linear;
  -webkit-animation-iteration-count: infinite;
}

@-moz-keyframes parpadeo{  
  0% { opacity: 1.0; }
  50% { opacity: 0.0; }
  100% { opacity: 1.0; }
}

@-webkit-keyframes parpadeo {  
  0% { opacity: 1.0; }
  50% { opacity: 0.0; }
   100% { opacity: 1.0; }
}

@keyframes parpadeo {  
  0% { opacity: 1.0; }
   50% { opacity: 0.0; }
  100% { opacity: 1.0; }
}
</style>
 
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <script src="push/push.min.js"></script>
  <!-- Smartsupp Live Chat script -->

<script type="text/javascript">
var _smartsupp = _smartsupp || {};
_smartsupp.key = 'ba5b5a860763d7e9d0a6c5dad8196b3ac22a96de';
window.smartsupp||(function(d) {
  var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
  s=d.getElementsByTagName('script')[0];c=d.createElement('script');
  c.type='text/javascript';c.charset='utf-8';c.async=true;
  c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
})(document);
</script>

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
        icon: 'img/mensaje.png', //Icono de la notificación
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

<?php
date_default_timezone_set('America/Bogota');
$hoy = date("Y-m-d");
$sql=mysqli_query($conexion,"SELECT * FROM des_oficios where fechaRegistro like '$hoy' and idCliente like '$identidad'");
$canO=0;    
while($row=mysqli_fetch_assoc($sql)) 
     {
         $asunto= $row["fecha"];
         $canO=$canO+1;
     }
   
                 if($canO>0){
               ?>           
                                <script>
                            		//Todo el código que se encuentra aquí se auto explica 
                            		Push.create("Notificación Oficios Viacpro", { //Titulo de la notificación
                            			body: "Verifique Notificación", //Texto del cuerpo de la notificación
                            			icon: 'img/archivos.png', //Icono de la notificación
                            			timeout: 8000, //Tiempo de duración de la notificación
                            			onClick: function () {//Función que se cumple al realizar clic cobre la notificación
                            				window.location = ""; //Redirige a la siguiente web
                            				this.close(); //Cierra la notificación
                            			}
                            		});
                            	</script>
                <?php
                 }
                ?>

<center> <div style="width:100%; height:15%; background-image:url('img/FondoNuevo.jpg')">
<center><span style="font-size:26px; color:#FFF; font-weight:800; font-family:Georgia, 'Times New Roman', Times, serif">VIGILANCIA DE ACTUACIONES PROCESALES
<br><img src="img/viacpro.png" style="width:15%">
</span></center>
</div></center>
<?php
  if($logo==""){
   
?>  
    <script>
    //Todo el código que se encuentra aquí se auto explica 
    Push.create("Notificación Viacpro", { //Titulo de la notificación
      body: "Aun no actualiza su foto de perfil", //Texto del cuerpo de la notificación
      icon: 'img/fotos.png', //Icono de la notificación
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
<div class="wrapper">

  <header class="main-header">
  <a href="index.php" class="logo" style="background-image:url('img/azulOscuro.png');">
    <!-- Logo -->
       <span class="logo-mini"><b>A</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg" style="font-family:Georgia, 'Times New Roman', Times, serif;font-size:16px; font-weight:800;">INICIO</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top"  style="background-image:url('img/azulOscuro.png')">
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
              <li><a href="alertas/alertas.php"><i class="fa fa-database"></i><?php echo substr($actuacion, 0, 26);?></a></li>
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
			   $sql="SELECT * FROM des_clientes_ayuda where estado like 'Pendiente' and idCliente like '$identidad' order by fechaRegistro ASC";
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
                   <li><a href="soporte/soporte.php"><i class="fa fa-file"></i> <?php echo "Solicitud de Ayuda: ".$temaAyuda;?></a></li>
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
                  <a href="perfil/perfil.php" class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                  <a href="seguridad/cerrar.php" class="btn btn-default btn-flat">Cerrar Sesión</a>
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
          <img src="<?php echo $logoImagen;?>" class="img-circle">
        </div>
        <div class="pull-left info">
          <p><?php echo $usuario;?></p>
          <a href="#"><i class="fa fa-circle text-success"></i>En Linea</a>
        </div>
      </div>
     
     <?php include("menuClientes.php");?>
      
    </section> 
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   <div class="table-responsive"> 
    <section class="content-header">
    
      <div class="row">
        
           <div class="col-md-9">
              <!-- Widget: user widget style 1 -->
              <div class="box box-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-yellow">
                  <div class="widget-user-image">
                    <img class="img-circle" src="img/archivos.png" alt="User Avatar">
                  </div>
                  <!-- /.widget-user-image -->
                  <h3 class="widget-user-username">Actuaciones del día</h3>
                  <h5 class="widget-user-desc">Listado</h5>
                </div>
                <div class="box-footer table-responsive no-padding">
                 <?php
                   date_default_timezone_set('America/Bogota');
                   $hoy = date("Y-m-d"); 
                  // $hoy = $hoy." 1:00 am";
                   $fin = date("Y-m-d"); 
                  // $fin = $fin." 11:59 pm";
                  $registros=0;
                  $sql="select * from des_actuaciones where idCliente like '$identidad' and fechaInicio like '$hoy' order by fechaRegistro";
                  $res=mysqli_query($conexion,$sql);
                  $registros=mysqli_num_rows($res);
                 
                 ?>
                 <table class="table table-hover">
                   <th>DESCRIPCIÓN</th>
                   <th align="center">FECHA AUTO Y/0 FIJACIÓN EN LISTA</th>
                   <th>FECHA INICIO</th>
                   <th>FECHA FIN</th>
                   <th>JUZGADO</th>
                   <th>CIUDAD</th>
                   <th>DEPARTAMENTO</th>
                   <th>VER</th>
                 <?php
                 $idProceso="";
                   while($rowA=mysqli_fetch_assoc($res)){
                       $idProceso=$rowA["idProceso"];
                       $logo= $rowA["nombreArchivo"];
					   $sqlP="select idJuzgado from des_procesos where idProceso like '$idProceso'";
                       $resP=mysqli_query($conexion,$sqlP);
                          $idJuzgado = "";
                          while($rowP=mysqli_fetch_assoc($resP)){
                             $idJuzgado= $rowP["idJuzgado"];
                              $sqlJ="select nombre,ciudad from des_juzgados where idJuzgado like '$idJuzgado'";
                              
							   $resJ=mysqli_query($conexion,$sqlJ);
                                $nomJuzgado = "";$ciudad="";
                                 while($rowJ=mysqli_fetch_assoc($resJ)){
                                     $nomJuzgado= $rowJ["nombre"]; 
                                     $ciudad=$rowJ["ciudad"]; 
                                     $sqlM="select opcion,relacion from lista_estados where id like '$ciudad'";
                                     $resM=mysqli_query($conexion,$sqlM);
                                      $nomCiudad="";$relacion="";$depar="";
                            
                                     while($rowM=mysqli_fetch_assoc($resM)){
                                        $nomCiudad= $rowM["opcion"]; 
										$relacion= $rowM["relacion"]; 
										
										$sqlR="select opcion from lista_paises where id like '$relacion'";
										 $resRe=mysqli_query($conexion,$sqlR);
										 
										  while($rowRe=mysqli_fetch_assoc($resRe)){
											$depar= $rowRe["opcion"]; 
										  }
                                     }
                                     mysqli_free_result($resM);
                                 }
                                 mysqli_free_result($resJ);
                          }
                           mysqli_free_result($resP);
                       $tipoA=$rowA["tipo"];
                       $act=$rowA["actuacion"];		
                       $fechaAuto=$rowA["fechaAuto"];	
                       $fechaInicio=$rowA["fechaInicio"];		
                       $fechaFin=$rowA["fechaFin"];		   
                 ?>
                 <a href="">
                  <tr style="color:#000">
                    <td><a href=""><?php echo strtoupper(substr($act,0, 40)); ?></td></a>
                    <td align="center"><a href=""><?php echo $fechaAuto;?></a></td>
                    <td><a href=""><?php echo $fechaInicio;?></a></td>
                    <td><a href=""><?php echo $fechaFin;?></a></td>
                    <td><a href=""><?php echo strtoupper($nomJuzgado);?></a></td>
                    <td><a href=""><?php echo strtoupper($nomCiudad);?></a></td>
                    <td><a href="#"><?php echo strtoupper($depar);?></a></td>
                    <td><a target="_blank" href="../AdminDespacho/procesos/imgProcesos/proceso<?php echo $idProceso;?>/actuaciones/<?php echo $logo;?>">VER</a></td>
                  </tr>
                  </a>
                <?php
                   }
                   mysqli_free_result($res);
                 ?>
                 
                </table>
                </div>
               <?php
                 if($registros>0){
               ?>           
                                <script>
                            		//Todo el código que se encuentra aquí se auto explica 
                            		Push.create("Notificación Viacpro", { //Titulo de la notificación
                            			body: "Verifique Actuaciones que vencen Hoy", //Texto del cuerpo de la notificación
                            			icon: 'img/usuario.png', //Icono de la notificación
                            			timeout: 8000, //Tiempo de duración de la notificación
                            			onClick: function () {//Función que se cumple al realizar clic cobre la notificación
                            				window.location = ""; //Redirige a la siguiente web
                            				this.close(); //Cierra la notificación
                            			}
                            		});
                            	</script>
                <?php
                 }
                ?>
              </div>
          <!-- /.widget-user -->
       
        </div>    
        
       <div class="col-md-3">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow">
              <div class="widget-user-image">
                <img class="img-circle" src="img/archivos.png" title="Acceso rápido a Calendario" alt="User Avatar">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username">
              <a href="alertas/index.php" target="popup" style="text-decoration:none; color:#FFF"
onClick="window.open(this.href, this.target, 'toolbar=0 , location=1 , status=0 , menubar=1 , scrollbars=0 , resizable=1 ,left=100pt,top=20pt,width=1210px,height=750px'); return false;" title="Acceso rápido a Calendario">
              
              Calendario de Eventos</a>
           
            </div>
            <div class="box-footer no-padding">
            </div>
          </div>
          <!-- /.widget-user -->
        </div> 
        
          
    </div>    
    
    <div class="row">
       <div class="col-md-12">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header" style="background:#1d1a31; color:#FFF">
              <div class="widget-user-image">
                <img class="img-circle" src="img/verificar.png" alt="User Avatar">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username">
              <span class="parpadea text"><strong>Actuaciones Próximas a vencer</strong>
             </h3>
              <h5 class="widget-user-desc">Listado</h5>
            </div>
            <div class="box-footer table-responsive no-padding">
             <?php
		       date_default_timezone_set('America/Bogota');
			   $hoy = date("Y-m-d"); 
			   $nuevafecha = strtotime ( '+5 day' , strtotime ( $hoy ) ) ;
			   $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
			  
			  $sql="select * from des_actuaciones where idCliente like '$identidad' and fechaFin BETWEEN '$hoy' and '$nuevafecha' order by fechaFin";
			  
			  $res=mysqli_query($conexion,$sql);
			   $registrosV=mysqli_num_rows($res);
			?>
             <table class="table table-hover table-responsive">
                <th>DESCRIPCIÓN</th>
                   <th align="center">FECHA AUTO Y/0 FIJACIÓN EN LISTA</th>
                   <th>FECHA INICIO</th>
                   <th>FECHA FIN</th>
                   <th>JUZGADO</th>
                   <th>CIUDAD</th>
                   <th>DEPARTAMENTO</th>
                   <th>VER</th>
             <?php
			   $idProceso="";
			   while($rowA=mysqli_fetch_assoc($res)){
				   $idProceso=$rowA["idProceso"];
				   $logo= $rowA["nombreArchivo"];
				   $sqlP="select idJuzgado from des_procesos where idProceso like '$idProceso'";
			       $resP=mysqli_query($conexion,$sqlP);
				      $idJuzgado = "";
					  while($rowP=mysqli_fetch_assoc($resP)){
						 $idJuzgado= $rowP["idJuzgado"];
						 
						  $sqlJ="select nombre,ciudad from des_juzgados where idJuzgado like '$idJuzgado'";
						   $resJ=mysqli_query($conexion,$sqlJ);
							$nomJuzgado = "";
							 while($rowJ=mysqli_fetch_assoc($resJ)){
								 $nomJuzgado= $rowJ["nombre"]; 
								 $ciudad= $rowJ["ciudad"]; 
								 $sqlM="select opcion,relacion from lista_estados where id like '$ciudad'";
								 $resM=mysqli_query($conexion,$sqlM);
								  $nomCiudad="";
						
								 while($rowM=mysqli_fetch_assoc($resM)){
								    $nomCiudad= $rowM["opcion"]; 
									$relacion= $rowM["relacion"]; 
										
										$sqlR="select opcion from lista_paises where id like '$relacion'";
										 $resRe=mysqli_query($conexion,$sqlR);
										 
										  while($rowRe=mysqli_fetch_assoc($resRe)){
											$depar= $rowRe["opcion"]; 
										  }
									
									
								 }
								 mysqli_free_result($resM);
								 
							 }
						     mysqli_free_result($resJ);
					  }
					   mysqli_free_result($resP);
				   
				   $tipoA=$rowA["tipo"];
				   $act=$rowA["actuacion"];		
				   $fechaAuto=$rowA["fechaAuto"];	
				   $fechaInicio=$rowA["fechaInicio"];		
				   $fechaFin=$rowA["fechaFin"];		   
			 ?>
              <tr style="color:#000; background:#FF9; font-weight:800">
                
                <td><a href=""><?php echo strtoupper(substr($act,0, 40)); ?></a></td>
                <td align="center"><a href=""><?php echo $fechaAuto;?></a></td>
                <td><a href=""><?php echo $fechaInicio;?></a></td>
                <td><a href=""><?php echo $fechaFin;?></a></td>
                <td><a href=""><?php echo strtoupper($nomJuzgado);?></a></td>
                <td><a href=""><?php echo strtoupper($nomCiudad);?></a></td>
                <td><a href=""><?php echo strtoupper($depar);?></a></td>
                <td><a target="_blank" href="../AdminDespacho/procesos/imgProcesos/proceso<?php echo $idProceso;?>/actuaciones/<?php echo $logo;?>">VER</a></td>
               
			<?php
			   }
			 ?>
             
            </table>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>  
        <?php
                 if($registrosV>0){
        ?>                  
                                <script>
                            		//Todo el código que se encuentra aquí se auto explica 
                            		Push.create("Notificación Viacpro", { //Titulo de la notificación
                            			body: "Verifique Actuaciones Proximas a vencer", //Texto del cuerpo de la notificación
                            			icon: 'img/usuario.png', //Icono de la notificación
                            			timeout: 6000, //Tiempo de duración de la notificación
                            			onClick: function () {//Función que se cumple al realizar clic cobre la notificación
                            				window.location = ""; //Redirige a la siguiente web
                            				this.close(); //Cierra la notificación
                            			}
                            		});
                            	</script>
         <?php               
                 }
                ?>
           
    </div>    
    
    <div class="row">
       <div class="col-md-12" >
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header" style="background:#900; color:#FFF">
              <div class="widget-user-image">
                <img class="img-circle" src="img/verificar.png" alt="User Avatar">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username">Actuaciones Vencidas (Hace 5 días)</h3>
              <h5 class="widget-user-desc">Listado</h5>
            </div>
            <div class="box-footer table-responsive no-padding">
             <?php
		       date_default_timezone_set('America/Bogota');
			   $hoy = date("Y-m-d"); 
			   $nuevafecha = strtotime ( '-5 day' , strtotime ( $hoy ) ) ;
			   $nuevafecha = date ( 'Y-m-d' , $nuevafecha );
			
			  $sql="select * from des_actuaciones where idCliente like '$identidad' and fechaFin BETWEEN '$nuevafecha' and '$hoy' order by fechaFin";
			 
			  $res=mysqli_query($conexion,$sql);
			  $registrosCe=mysqli_num_rows($res);
						 ?>
             <table class="table table-hover table-responsive">
                <th>DESCRIPCIÓN</th>
                   <th align="center">FECHA AUTO Y/0 FIJACIÓN EN LISTA</th>
                   <th>FECHA INICIO</th>
                   <th>FECHA FIN</th>
                   <th>JUZGADO</th>
                   <th>CIUDAD</th>
                   <th>DEPARTAMENTO</th>
                   <th>VER</th>
             <?php
			 
			   while($rowA=mysqli_fetch_assoc($res)){
				   $idProceso=$rowA["idProceso"];
				   $logo= $rowA["nombreArchivo"];
				   $sqlP="select idJuzgado from des_procesos where idProceso like '$idProceso'";
			       $resP=mysqli_query($conexion,$sqlP);
				      $idJuzgado = "";
					  while($rowP=mysqli_fetch_assoc($resP)){
						 $idJuzgado= $rowP["idJuzgado"];
						  $sqlJ="select nombre from des_juzgados where idJuzgado like '$idJuzgado'";
						   $resJ=mysqli_query($conexion,$sqlJ);
							$nomJuzgado = "";
							 while($rowJ=mysqli_fetch_assoc($resJ)){
								 $nomJuzgado= $rowJ["nombre"]; 
								 $sqlM="select opcion from lista_estados where id like '$ciudad'";
								 $resM=mysqli_query($conexion,$sqlM);
								  $nomCiudad="";
						
								 while($rowM=mysqli_fetch_assoc($resM)){
								    $nomCiudad= $rowM["opcion"]; 
									$relacion= $rowM["relacion"]; 
										
										$sqlR="select opcion from lista_paises where id like '$relacion'";
										 $resRe=mysqli_query($conexion,$sqlR);
										 
										  while($rowRe=mysqli_fetch_assoc($resRe)){
											$depar= $rowRe["opcion"]; 
										  }
									
									
								 }
								 mysqli_free_result($resM);
							 }
						     mysqli_free_result($resJ);
					  }
					   mysqli_free_result($resp);
				   $tipoA=$rowA["tipo"];
				   $act=$rowA["actuacion"];		
				   $fechaAuto=$rowA["fechaAuto"];	
				   $fechaInicio=$rowA["fechaInicio"];		
				   $fechaFin=$rowA["fechaFin"];		   
			 ?>
               <tr style="color:#000">
               
                <td><a href=""><?php echo strtoupper(substr($act,0, 40)); ?></a></td>
                <td align="center"><a href=""><?php echo $fechaAuto;?></a></td>
                <td><a href=""><?php echo $fechaInicio;?></a></td>
                <td><a href=""><?php echo $fechaFin;?></a></td>
                <td><a href=""><?php echo strtoupper($nomJuzgado);?></a></td>
                <td><a href=""><?php echo strtoupper($nomCiudad);?></a></td>
                <td><a href=""><?php echo strtoupper($depar);?></a></td>
                <td><a target="_blank" href="../AdminDespacho/procesos/imgProcesos/proceso<?php echo $idProceso;?>/actuaciones/<?php echo $logo;?>">VER</a></td>
              </tr>
			<?php
			   }
			 ?>
             
            </table>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>      
    </div>    
    <?php
                 if($registrosCe>0){
    ?>   
                                <script>
                            		//Todo el código que se encuentra aquí se auto explica 
                            		Push.create("Notificación Viacpro", { //Titulo de la notificación
                            			body: "Verifique Actuaciones Vencidas hace 5 dias", //Texto del cuerpo de la notificación
                            			icon: 'img/usuario.png', //Icono de la notificación
                            			timeout: 6000, //Tiempo de duración de la notificación
                            			onClick: function () {//Función que se cumple al realizar clic cobre la notificación
                            				window.location = ""; //Redirige a la siguiente web
                            				this.close(); //Cierra la notificación
                            			}
                            		});
                            	</script>
                <?php
                 }
                ?>
  </section>
  </DIV>
</div>
 
 
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<footer style="background-image:url('img/FondoNuevo.jpg')">
  <center><img src="img/viacpro.png"></center>
  </footer>
<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
