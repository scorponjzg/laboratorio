
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
function encotrarUsuario(){

	var buscar = $("#buscar").val();
	
	$.ajax({
		method: "POST",
		url: "php/obtener_usuario_mtd.php",
		dataType:"json",
		data:{"buscar":buscar}
	}).done(function(data){
		var usuario = "";
		console.log(data);
		if(typeof(data.usuario) != 'undefined'){
			data.usuario.forEach(function(entry){
				usuario += 
					'<tr><td>'+entry.sucursal+'</td>'+
					'<td>'+entry.nombre+'</td>'+
					'<td>'+entry.perfil+'</td>';
				if(data.show == true){
		
					  usuario += '<td><a href="#" class="btn btn-default edita" role="button" data-id="'+entry.id+'">'+
					  '<span class="glyphicon glyphicon-pencil"></span></a></td>'+
					  '<td><a href="#" class="btn btn-default elimina" role="button" data-id="'+entry.id+'">'+
					  '<span class="glyphicon glyphicon-remove"></span></a></td>';
				}
							
				usuario +='</tr>';
			});
		} else {
			alert(data.msg);
		}
		$('#sucursal').empty();
		$('#sucursal').append(usuario);

		$(".edita").on("click",editaUsuario);
		$(".elimina").on("click",eliminaUsuario);

	}).fail(function(error){
		console.log(error);
		alert("Por el momento no est\u00E1 disponible el servicio, intente m\u00E1s tarde");
		
	});
}
$(function(){
	encotrarUsuario();
	
});