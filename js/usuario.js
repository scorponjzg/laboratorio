
function editaUsuario(){
	window.location.href= "editar_usuario.php?usuario="+$(this).attr("data-id");
}
function eliminaUsuario(){
	if(confirm("¿Desea eliminar el usuario?")){
		var usuario = $(this).attr("data-id");
		$.ajax({
			method:"POST",
			url: "php/elimina_usuario_mtd.php",
			dataType: "json",
			data: {"usuario":usuario}
		}).done(function(data){
			if(data.eliminado == 'true'){
				alert("Usuario eliminado");
				window.location.href = "usuario.php";
			} else {
				alert("Por el momento no se ha podido eliminar al usuario, intente nuevamente.");
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
		url: "php/obtener_usuario_mtd.php",
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

		$(".edita").on("click",editaUsuario);
		$(".elimina").on("click",eliminaUsuario);

	}).fail(function(error){
		alert("Por el momento no est\u00E1 disponible el servicio, intente m\u00E1s tarde");
		
	});
}
$(function(){
	encotrarEstudio();
	
});