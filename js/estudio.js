function crearCSV(tabla,nombreCSV){
	var tablehtml = $("#"+tabla).html();
	
	var datos = tablehtml.replace(/\s\s+/g,'')
						 .replace(/<tr>/g,'')
						 .replace(/\r|\n/g,'')
						 .replace(/<thead>/g,'')
						 .replace(/<\/thead>/g,'')
						 .replace(/<tbody [a-z]*="[^"]*">/g,'')
						 .replace(/<button [^@]*/g,'')
						 .replace(/<\/tbody>/g,'')
						 .replace(/<tr [a-z]*="[a-z|A-Z|0-9|%|:|;]*">/g,'')
						 .replace(/<\/tr>/g,'\r\n')
						 .replace(/<th [a-z]*="[a-z|A-Z|0-9|%|:|;]*">/g,'')
						 .replace(/<\/th>/g,',')
						 .replace(/<a [^>]*>/g,'')
						 .replace(/<span [a-z]*="[a-z]* [a-z|-]*">/g,'')
						 .replace(/<b>/g,'')
						 .replace(/<\/a>/g,'')
						 .replace(/<\/span>/g,'')
						 .replace(/<\/b>/g,'')
						 .replace(/<td>/g,'')
						 .replace(/<\/td>/g,',')
						 .replace(/<\t>/g,'')
						 .replace(/<\n>/g,'')
						 .replace(/<img src="/g,'')
						 .replace(/" class="[^>]*>/g,'');
	var csvFile = new Blob([datos], {type: "text/csv"});
	var link = document.createElement("a");
	link.download = nombreCSV+".csv";
	link.href = window.URL.createObjectURL(csvFile);

	link.click();
	
}
function verDetalle(){
	window.location.href= "detalle_estudio.php?estudio="+$(this).attr("data-id");
}
function encotrarEstudio(){

	var buscar = $("#buscar").val();
	
	$.ajax({
		method: "POST",
		url: "php/obtener_estudios_mtd.php",
		dataType:"json",
		data:{"buscar":buscar}
	}).done(function(data){
		var estudio = "";
		
		data.estudio.forEach(function(entry){
			estudio += '<tr><td>'+entry.codigo+'</td>'+
							'<td>'+entry.estudio+'</td>'+
							'<td>'+entry.precio+'</td>';
			if(data.show == true){
				estudio +='<td>'+entry.costo+'</td>'+
						  '<td><a href="#" class="btn btn-default ver" role="button" data-id="'+entry.id+'">'+
						  '<span class="glyphicon glyphicon-eye-open"></span></a></td>';
			}
			estudio +='</tr>';
		});
		$('#estudios').empty();
		$('#estudios').append(estudio);

		$(".ver").on("click",verDetalle);

	}).fail(function(error){
		alert("Por el momento no est\u00E1 disponible el servicio, intente m\u00E1s tarde");
		
	});
}
$(function(){
	encotrarEstudio();
	
});