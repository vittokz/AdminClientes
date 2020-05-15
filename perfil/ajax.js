function objetoAjax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
   try {

		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

	} catch (E) {

		xmlhttp = false;
	}
}
if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
	  xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}


function enviarDatosPerfil(){
  //div donde se mostrará lo resultados
  divResultado = document.getElementById('resultadoC');
  //recogemos los valores de los inputs
  iden=document.perfil.identidad.value;
  clave=document.perfil.clave.value;
  ajax=objetoAjax();
  //uso del medotod POST
 //archivo que realizará la operacion
 //registro.php
  ajax.open("POST", "registro.php",true);
  //cuando el objeto XMLHttpRequest cambia de estado, la función se inicia
  ajax.onreadystatechange=function() {
	  //la función responseText tiene todos los datos pedidos al servidor
  	if (ajax.readyState==4) {
  		//mostrar resultados en esta capa
		divResultado.innerHTML = ajax.responseText
  		//llamar a funcion para limpiar los inputs
		LimpiarCampos();
	}
 }
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores a registro.php para que inserte los datos
	ajax.send("iden="+iden+"&clave="+clave) }


//función para limpiar los campos
function LimpiarCampos(){
 

}