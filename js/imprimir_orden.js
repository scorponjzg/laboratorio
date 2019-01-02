function getQueryVariable(variable) {
   var query = window.location.search.substring(1);
   var vars = query.split("&");
  
  for (var i=0; i < vars.length; i++) {
       var pair = vars[i].replace('=','/').split("/");
      
       if(pair[0] == variable) {
           return pair[1];
       }
   }
   return false;
}


$(function(){
	var orden = getQueryVariable('orden');
	
	$.ajax({
		method: "POST",
		url: "php/imprimir_orden_mtd.php",
		dataType:"json",
		data: {'orden' : orden}
		
	}).done(function(data){
		var estudio = "";
				console.log(data);
		/*$('#estudio').val(data.estudio.id);
		$('#clave').val(data.estudio.codigo);
		$('#nombre').val(data.estudio.estudio);
		$('#precio').val(data.estudio.precio);
		if(data.estudio.costo != ''){
			$('#costo').val(data.estudio.costo);
		}
		$('#modificador').text(data.estudio.responsable);
		$('#registro').text(data.estudio.fecha_registro);
		$('#editado').text(data.estudio.fecha_editado);*/

	}).fail(function(error){
		console.log(error.responseText);
		alert("Por el momento no est\u00E1 disponible el servicio, intente m\u00E1s tarde");
	});
	
	
	
});