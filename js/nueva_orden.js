var estudios= new Array();
var total = 0.00;
function validaForm(){
	var correcto = false;
	if($("#ap").val() == ''){
		alert("Debe ingresar el apellido paterno");
		$("#ap").focus();
	} else if($("#nombre").val() == ''){
		alert("Debe de ingresar un nombre");
		$("#nombre").focus();
	} else if($("#edad").val() == ''){
		alert("Debe de ingresar la edad del paciente");
		$("#edad").focus();
	} else if($("#sexo").val() == 0){
		alert("Debe de ingresar el sexo del paciente");
		$("#sexo").focus();
	} else if(total == 0){
		alert("Debe de seleccionar por lo menos un estudio");
		$('#select').data('selectpicker').$button.focus();
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
			estudio += '<option  value="'+entry.id+'" >'+entry.codigo+' --- '+entry.estudio+' --- $'+entry.precio+'</option>';
			estudios['id'+entry.id] = {codigo: entry.codigo, estudio: entry.estudio, precio: entry.precio, activo:true}
		});
		$("#select").append(estudio);
		$('.selectpicker').selectpicker('refresh');
	}).fail(function(error){
		console.log(error.responseText);
	});
}
function cuatroDecimales(numero){
	var temporal = parseFloat(parseInt(numero * 10000) / 10000);
	return temporal;
}
function remover(){

	var id = $(this).attr("data-id");
	$( "#row"+atob(id)).remove();
	
	if(estudios['id'+id].activo == false){
		
		total -=parseFloat(estudios['id'+id].precio);
		$("#total").html(cuatroDecimales(total));
		$("#totalEnLetra").html("("+NumerosaLetras(cuatroDecimales(total))+")");
	}
	estudios['id'+id].activo = true;
		
}

function agregarEstudio(){
	var id = $("#select").val();
	var estudio = estudios['id'+id];
	if(estudio.activo == true){
		var listado = '<tr id="row'+atob(id)+'"><td>'+estudio.codigo+'</td><td>'+estudio.estudio+'</td><td>'+estudio.precio+'</td><td><a href="#" class="btn btn-danger btn-sm remover" role="button" data-id="'+id+'">'+'<input type="hidden" name="estudio'+id+'" value="'+atob(id)+'">'+
								  '<span class="glyphicon glyphicon-remove"></span></a></td></tr>';
		$("#estudioSeleccionado").append(listado);
		estudios['id'+id].activo = false;
		total+= parseFloat(estudios['id'+id].precio);
		$("#total").html(total);
		$("#totalEnLetra").html("("+NumerosaLetras(total)+")");
	}
	$(".remover").on("click",remover);
}
$(function(){
	
	obtenerEstudios();
		//console.log(estudios);

	$("#formulario").submit(function(event){
		event.preventDefault();
		console.log(estudios);
		var estudio = $(this).serialize();
		console.log(estudio);
		if(validaForm()){	
				
				$.ajax({
				method: "POST",
				url: "php/nueva_orden_mtd.php",
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
					console.log(error.responseText);
				});
			
		} 
	})
	
});