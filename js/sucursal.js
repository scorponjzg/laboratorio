
function editaUnidad(){
	window.location.href= "editar_sucursal.php?sucursal="+$(this).attr("data-id");
}
function eliminaUnidad(){
	if(confirm("¿Desea eliminar la sucursal?")){
		var sucursal = $(this).attr("data-id");
		$.ajax({
			method:"POST",
			url: "php/elimina_sucursal_mtd.php",
			dataType: "json",
			data: {"sucursal":sucursal}
		}).done(function(data){
			if(data.eliminado == 'true'){
				alert("Sucursal eliminada");
				window.location.href = "sucursal.php";
			} else {
				alert("Por el momento no se ha podido eliminar la sucursal, intente nuevamente.");
			}
		}).fail(function(error){
			alert(error.responseText);
		});
	}
}
function encotrarEstudio(){

	var buscar = $("#buscar").val();
	
	$.ajax({
		method: "POST",
		url: "php/obtener_sucursal_mtd.php",
		dataType:"json",
		data:{"buscar":buscar}
	}).done(function(data){
		var unidad = "";
		
		if(typeof(data.unidad) != 'undefined'){
			data.unidad.forEach(function(entry){
				unidad += 
					'<tr><td>'+entry.sucursal+'</td>'+
					'<td>'+entry.lugar+'</td>'+
					'<td>'+entry.tel+'</td>'+
					'<td>'+entry.pagina+'</td>'+
					'<td>'+entry.email+'</td>';
				if(data.show == true){
		
					  unidad += '<td><a href="#" class="btn btn-default edita" role="button" data-id="'+entry.id+'">'+
					  '<span class="glyphicon glyphicon-pencil"></span></a></td>'+
					  '<td><a href="#" class="btn btn-default elimina" role="button" data-id="'+entry.id+'">'+
					  '<span class="glyphicon glyphicon-remove"></span></a></td>';
				}
							
				unidad +='</tr>';
			});
		}
		$('#sucursal').empty();
		$('#sucursal').append(unidad);

		$(".edita").on("click",editaUnidad);
		$(".elimina").on("click",eliminaUnidad);

	}).fail(function(error){
		alert("Por el momento no est\u00E1 disponible el servicio, intente m\u00E1s tarde");
		
	});
}
$(function(){
	encotrarEstudio();
	
});