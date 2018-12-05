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


function redireccion(){

	window.location.href="sucursal.php";
	
}


$(function(){
	var sucursal = getQueryVariable('sucursal');
	
	$.ajax({
		method: "POST",
		url: "php/detalle_sucursal_mtd.php",
		dataType:"json",
		data: {'sucursal' : sucursal}
		
	}).done(function(data){
		
		$('#sucursal').val(data.sucursal.id);
		$('#nombre').val(data.sucursal.sucursal);
		$('#dir').val(data.sucursal.lugar);
		$('#tel').val(data.sucursal.tel);
		$('#web').val(data.sucursal.pagina);
		$('#email').val(data.sucursal.email);


	}).fail(function(error){
		alert("Por el momento no est\u00E1 disponible el servicio, intente m\u00E1s tarde");
	});
	$("#formulario").submit(function(event){
		event.preventDefault();
		var estudio = $(this).serialize();
		
		$.ajax({
			method: "POST",
			url: "php/actualiza_sucursal_mtd.php",
			dataType: "json",
			data: estudio 
		}).done(function(entry){
			console.log(entry);
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
	
	
	
});