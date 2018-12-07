function validaForm(){
	var correcto = false;
	if($("#clave").val() == ''){
		alert("Debe de ingresar una clave");
		$("#clave").focus();
	} else if($("#nombre").val() == ''){
		alert("Debe de ingresar un nombre");
		$("#nombre").focus();
	} else if($("#precio").val() == ''){
		alert("Debe de ingresar el precio al público");
		$("#precio").focus();
	} else if($("#costo").val() == ''){
		if(confirm("¿Quiere registrar el estudio sin el precio de costo?")){
			correcto = true;
		} else {
			
			$("#precio").focus();	
		}
		
	} else {
		correcto =  true;
	}
	return correcto;
}
function obtenerEstudios(){

	$.ajax({
		method: "POST",
		url:"php/obtener_estudios_mtd.php",
		dataType: "json"
	}).done(function(data){
		console.log(data);
		var estudio = '';
		data.estudio.forEach(function(entry){
			estudio += '<option value="'+entry.id+'">'+entry.codigo+' --- '+entry.estudio+'</option>';
			
		});
		$("#select").append(estudio);
		$('.selectpicker').selectpicker('refresh');
	}).fail(function(error){
		console.log(error.responseText);
	});
}
$(function(){
	obtenerEstudios();

	$("#formulario").submit(function(event){
		event.preventDefault();
		var estudio = $(this).serialize();
		console.log(estudio);
		if(validaForm()){	
				
				$.ajax({
				method: "POST",
				url: "php/nuevo_estudio_mtd.php",
				dataType: "json",
				data: estudio 
				}).done(function(entry){
					console.log(entry);
					if(entry.ingresado == 'true'){
						alert("Estudio creado correctamente.");
						window.location.replace("estudio.php");
					} else {
						alert(entry.ingresado);
					}
				}).fail(function(error){
					console.log(error);
				});
			
		} 
	})
	
});