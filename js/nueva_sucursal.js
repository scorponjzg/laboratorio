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
$(function(){

	$("#formulario").submit(function(event){
		event.preventDefault();
		var sucursal = $(this).serialize();
		console.log(sucursal);
		if(validaForm()){	
				
				$.ajax({
				method: "POST",
				url: "php/nueva_sucursal_mtd.php",
				dataType: "json",
				data: sucursal 
				}).done(function(entry){
					console.log(entry);
					if(entry.ingresado == 'true'){
						alert("Sucursal creada correctamente.");
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