<HTML>
<HEAD>
<TITLE>.::Validacion datos usuarios clientes::.</TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
</HEAD>
<BODY BGCOLOR=#FFFFFF LEFTMARGIN=0 TOPMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0>

<!-- ImageReady Slices (recibo.jpg) -->
<div align="center">
  <?php  
 
 
 
      include("../conexion.php");
      $identidad=$_POST['identidad'];
	  $clave=$_POST['clave'];
	  $conexion = Conectarse();
      $usuario="";
    $sql ="SELECT * FROM des_usuariosviacpro where identidad like '$identidad' and clave like '$clave' and estado like 'Activo'";
    //Sentencia sql a realizar
	 $result= mysqli_query($conexion,$sql) or die("No se consulto en usuarios");//Ejecuta la sentencia sql.
    	 $result1 = mysqli_num_rows ($result);
          while($row=mysqli_fetch_assoc($result)){
		  				session_start();
	    		        $_SESSION["autentificadoCliente"]= "SI";
						 date_default_timezone_set('America/Bogota'); 
						$fecha= date("Y-m-d g:i a");
						$sqlU ="select cedula_usuario,nombre_usua FROM des_clientes_usuario WHERE 
						cedula_usuario like '$identidad'";
						$resultU= mysqli_query($conexion,$sqlU) or die("No se consulto en usuarios Clientes");
						 while($rowU=mysqli_fetch_assoc($resultU)){
							 $usuario = $rowU["nombre_usua"];
							 $usuarioCC = $rowU["cedula_usuario"];
						 }
						 mysqli_free_result($rowU);
	    		        $_SESSION["usuario"] = $usuario;
				        echo "<script language='javascript'> location.href='../index.php' </script>";
						
                        
           }
		if($result1 == 0){
			
			echo "<script language='javascript'> 
			alert('Validacion de datos incorrecta...!!');
			location.href='../login.html' </script>";
       		
	    }
    mysql_free_result($result);
   ?>
</div>
</BODY>
</HTML>