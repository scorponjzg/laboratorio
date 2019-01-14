function validaForm(){
	var correcto = false;
	if($("#ap").val() == ''){
		alert("Debe de ingresar el apellido paterno");
		$("#ap").focus();
	} else if($("#nombre").val() == ''){
		alert("Debe de ingresar el nombre");
		$("#nombre").focus();
	} else if($("#usuario").val() == ''){
		alert("Debe de ingresar un usuario");
		$("#usuario").focus();
	}else if($("#clave").val() == ''){
		alert("Debe de ingresar la clave");
		$("#clave").focus();
	}else if($("#clave").val() != $("#confirmacion").val()){
		alert("Las claves no son iguales");
		$("#confirmacion").focus();
	}else if($("#perfil").val() == '0'){
		alert("Debe seleccionar un perfil para el usuario");
		$("#perfil").focus();
	}else if($("#sucursal").val() == '0'){
		alert("Debe seleccionar una sucursal");
		$("#sucursal").focus();
	}else {
		correcto =  true;
	}
	return correcto;
}
function obtenerPerfilSucursal(){

	$.ajax({
		method: "POST",
		url:"php/obtener_perfil_sucursal_mtd.php",
		dataType: "json"

	}).done(function(data){
	
		var perfil = "";
		var sucursal = "";
		data.perfil.forEach(function(entry){
			perfil += "<option value="+entry.id+">"+entry.perfil+"</option>";
		});
		data.unidad.forEach(function(entry){
			sucursal += "<option value="+entry.id+">"+entry.unidad+"</option>";
		});
		$("#perfil").append(perfil);
		$("#sucursal").append(sucursal);
	}).fail(function(error){
		console.log(error.responseText);

	});
}
$(function(){
	obtenerPerfilSucursal();
	$("#formulario").submit(function(event){
		event.preventDefault();
		var sucursal = $(this).serialize();
		console.log(sucursal);
		if(validaForm()){	
				
				$.ajax({
				method: "POST",
				url: "php/nuevo_usuario_mtd.php",
				dataType: "json",
				data: sucursal 
				}).done(function(entry){
					console.log(entry);
					if(entry.ingresado == 'true'){
						alert("Usuario creado correctamente.");
						window.location.replace("usuario.php");
					} else {
						alert(entry.ingresado);
					}
				}).fail(function(error){
					console.log(error);
				});
			
		} 
	})
	
});