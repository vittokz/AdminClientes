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


function buscarCedula(){
  //div donde se mostrará lo resultados
  divResultado = document.getElementById('resultado');
  //recogemos los valores de los inputs
  iden=document.busqueda.identidad.value;
  ajax=objetoAjax();
  //uso del medotod POST
 //archivo que realizará la operacion
 //registro.php
  ajax.open("POST", "buscarCedula.php",true);
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
	ajax.send("identidad="+iden) }
//función para limpiar los campos
function LimpiarCampos(){
}

//buscar RADICADO
function buscarRadicado(){
  //div donde se mostrará lo resultados
  divResultado = document.getElementById('resultado');
  //recogemos los valores de los inputs
  radicado=document.busqueda.radicado.value;
  ajax=objetoAjax();
  //uso del medotod POST
 //archivo que realizará la operacion
 //registro.php
  ajax.open("POST", "buscarRadicado.php",true);
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
	ajax.send("radicado="+radicado) }
///////////////////////////

//buscar demandado
function buscarDemandado(){
  //div donde se mostrará lo resultados
  divResultado = document.getElementById('resultado');
  //recogemos los valores de los inputs
  demandado=document.busqueda.nombre.value;
  ajax=objetoAjax();
  //uso del medotod POST
 //archivo que realizará la operacion
 //registro.php
  ajax.open("POST", "selectDemandado.php",true);
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
	ajax.send("demandado="+demandado) }	
	
///////////////////////////////////////////	
//buscar demandante
function buscarDemandante(){
  //div donde se mostrará lo resultados
  divResultado = document.getElementById('resultado');
  //recogemos los valores de los inputs
  demandante=document.busqueda.nombre.value;
  ajax=objetoAjax();
  //uso del medotod POST
 //archivo que realizará la operacion
 //registro.php
  ajax.open("POST", "selectDemandante.php",true);
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
	ajax.send("demandante="+demandante) }	
	
///////////////////////////////////////////	

//buscar municipio
function buscarMunicipio(){
  //div donde se mostrará lo resultados
  divResultado = document.getElementById('resultado');
  //recogemos los valores de los inputs
  municipio=document.busqueda.opcion.value;
  ajax=objetoAjax();
  //uso del medotod POST
 //archivo que realizará la operacion
 //registro.php
  ajax.open("POST", "selectMunicipios.php",true);
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
	ajax.send("municipio="+municipio) }	
	
///////////////////////////////////////////	
//buscar depar
function buscarDepar(){
  //div donde se mostrará lo resultados
  divResultado = document.getElementById('resultado');
  //recogemos los valores de los inputs
  depar=document.busqueda.opcion.value;
  ajax=objetoAjax();
  //uso del medotod POST
 //archivo que realizará la operacion
 //registro.php
  ajax.open("POST", "selectDepar.php",true);
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
	ajax.send("depar="+depar) }	
	
///////////////////////////////////////////	


//función para limpiar los campos
//registrar procesos
function registroProceso(){
  //div donde se mostrará lo resultados
  divResultado = document.getElementById('resultado');
  //recogemos los valores de los inputs
  identidad=document.procesos.oculto.value;
  idJuzgado=document.procesos.juzgado.value;
  radicado=document.procesos.radicado.value;
  tipo=document.procesos.tipo.value;
  demandante=document.procesos.demandante.value;
  demandado=document.procesos.demandado.value;
  descrip=document.procesos.descripcion.value;
  fechaProceso=document.procesos.fechaProceso.value;
  
  
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
	ajax.send("identidad="+identidad+"&idJuzgado="+idJuzgado+"&radicado="+radicado+"&tipo="+tipo+"&demandante="+demandante+"&demandado="+demandado+"&descrip="+descrip+"&fechaProceso="+fechaProceso) 
}

//modificar procesos
function modificarProceso(){
  //div donde se mostrará lo resultados
  divResultado = document.getElementById('resultado');
  //recogemos los valores de los inputs
  idProceso=document.procesos.oculto.value;
  idJuzgado=document.procesos.juzgado.value;
  radicado=document.procesos.radicado.value;
  tipo=document.procesos.tipo.value;
  demandante=document.procesos.demandante.value;
  demandado=document.procesos.demandado.value;
  descrip=document.procesos.descripcion.value;
  fechaProceso=document.procesos.fechaProceso.value;
  
  
  ajax=objetoAjax();
  //uso del medotod POST
 //archivo que realizará la operacion
 //registro.php
  ajax.open("POST", "modificar.php",true);
  //cuando el objeto XMLHttpRequest cambia de estado, la función se inicia
  ajax.onreadystatechange=function() {
	  //la función responseText tiene todos los datos pedidos al servidor
  	if (ajax.readyState==4) {
  		//mostrar resultados en esta capa
		divResultado.innerHTML = ajax.responseText
  		//llamar a funcion para limpiar los inputs
		//LimpiarCampos();
	}
 }
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores a registro.php para que inserte los datos
	ajax.send("idProceso="+idProceso+"&idJuzgado="+idJuzgado+"&radicado="+radicado+"&tipo="+tipo+"&demandante="+demandante+"&demandado="+demandado+"&descrip="+descrip+"&fechaProceso="+fechaProceso) 
}

//registrar actuaciones
function registrarActuacion(){
  //div donde se mostrará lo resultados
  divResultado = document.getElementById('resultadoA');
  //recogemos los valores de los inputs
  fecha=document.actuaciones.fecha.value;
  idProceso=document.actuaciones.oculto.value;
  actuacion=document.actuaciones.actuacion.value;

  tipo=document.actuaciones.tipo.value;
  fechaAuto=document.actuaciones.fechaAuto.value;
  
  if(actuacion==""){
	 alert("Actuacion es un campo obligatorio!!!");
	 ajax.open("POST", "procesoSeleccionado.php",true); 
  }
  
  ajax=objetoAjax();
  //uso del medotod POST
 //archivo que realizará la operacion
 //registro.php
  ajax.open("POST", "registroActuacion.php",true);
  //cuando el objeto XMLHttpRequest cambia de estado, la función se inicia
  ajax.onreadystatechange=function() {
	  //la función responseText tiene todos los datos pedidos al servidor
  	if (ajax.readyState==4) {
  		//mostrar resultados en esta capa
		divResultado.innerHTML = ajax.responseText
  		//llamar a funcion para limpiar los inputs
		LimpiarCamposA();
	}
 }
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores a registro.php para que inserte los datos
	ajax.send("idProceso="+idProceso+"&actuacion="+actuacion+"&fecha="+fecha+"&tipo="+tipo+"&fechaAuto="+fechaAuto) 
}
//función para limpiar los campos
function LimpiarCamposA(){
	document.actuaciones.actuacion.focus();
	document.actuaciones.actuacion.value="";
}

//función para limpiar los campos
function LimpiarCampos(){
	document.procesos.juzgado.focus();
	document.procesos.radicado.value="";
	document.procesos.tipo.value="";
    document.procesos.demandante.value="";
	document.procesos.demandado.value="";
	document.procesos.descripcion.value="";
	document.procesos.actuaciones.value="";
}
