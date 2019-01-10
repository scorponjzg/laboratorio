function validaForm(){
	var correcto = false;
	if($("#nombre").val() == ''){
		alert("Debe de ingresar el nombre de la sucursal");
		$("#nombre").focus();
	} else if($("#dir").val() == ''){
		alert("Debe de ingresar una dirección");
		$("#der").focus();
	} else {
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
		console.log(data);
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
						alert("Estudio creado correctamente.");
						window.location.replace("sucursal.php");
					} else {
						alert(entry.ingresado);
					}
				}).fail(function(error){
					console.log(error);
				});
			
		} 
	})
	
});