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

function showInput(){

	$('.editar').attr("disabled",false);
	$('.btnPrincipal').hide();
	$('.btnEditar').show();

}

function redireccion(){

	location.reload();
	
}

function eliminar(){
	if(confirm("¿Desea eliminar el estudio?")){
		var estudio = getQueryVariable('estudio');
		$.ajax({
			method:"POST",
			url: "php/elimina_estudio_mtd.php",
			dataType: "json",
			data: {"estudio":estudio}
		}).done(function(data){
			if(data.editado == 'true'){
				alert("Estudio eliminado");
				window.location.href = "estudio.php";
			} else {
				alert("Por el momento no se ha podido eliminar el estudio, intente nuevamente.");
			}
		}).fail(function(error){
			alert(error.responseText);
		});
	}
}
$(function(){
	var estudio = getQueryVariable('estudio');
	
	$.ajax({
		method: "POST",
		url: "php/detalle_estudios_mtd.php",
		dataType:"json",
		data: {'estudio' : estudio}
		
	}).done(function(data){
		var estudio = "";
				
		$('#estudio').val(data.estudio.id);
		$('#clave').val(data.estudio.codigo);
		$('#nombre').val(data.estudio.estudio);
		$('#precio').val(data.estudio.precio);
		if(data.estudio.consto != ''){
			$('#costo').val(data.estudio.costo);
		}
		$('#modificador').text(data.estudio.responsable);
		$('#registro').text(data.estudio.fecha_registro);
		$('#editado').text(data.estudio.fecha_editado);

	}).fail(function(error){
		alert("Por el momento no est\u00E1 disponible el servicio, intente m\u00E1s tarde");
	});
	$("#formulario").submit(function(event){
		event.preventDefault();
		var estudio = $(this).serialize();
		
		$.ajax({
			method: "POST",
			url: "php/actualiza_estudio_mtd.php",
			dataType: "json",
			data: estudio 
		}).done(function(entry){
			
			if(entry.editado == 'true'){
				alert("Estudio modificado correctamente.");
				redireccion();
			} else {
				alert(entry.editado);
			}
		}).fail(function(error){
			console.log(error);
		});
	})
	$("#cancelar").on("click",redireccion);
	$("#editar").on("click",showInput);
	$("#eliminar").on("click",eliminar);
	
});