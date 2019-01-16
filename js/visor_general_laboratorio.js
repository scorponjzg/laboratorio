var total = costo = utilidad = 0.00;

function crearCSV(tabla,nombreCSV){
	var totales = utilidad == 0.00 ? '<tr id="remover"><td></td><td></td><td></td><td></td><td>'+total+'</td><td></td></tr>' : '<tr id="remover"><td></td><td></td><td></td><td>Totales=</td><td>'+total+'</td><td>'+costo+'</td><td>'+utilidad+'</td><td></td><td></td></tr>';
	$('#orden').append(totales);
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
	var f = new Date();

	link.download =  nombreCSV+"-"+f.getFullYear() + "/" + (f.getMonth() +1) + "/" + f.getDate()+".csv";
	link.href = window.URL.createObjectURL(csvFile);

	link.click();
	$("#remover").remove();
}
function dobleDecimal(value){
		var valueString = value + "";
		
		if(valueString.indexOf(".") > 0){
				var separarDecimales = valueString.split(".");
				//var decimales = separarDecimales[1].spli("");
				
				if(separarDecimales[1].length < 2){
					//defaul sera 1
					return valueString + "0"
				} else {
					return separarDecimales[0] + "." + separarDecimales[1].substring(0.2);

				}
		} else {
			return valueString + ".00"
		}
}
function obtenerFechaSucursal(){

	$.ajax({
		method: "POST",
		url:"php/obtener_fecha_sucursal_mtd.php",
		dataType: "json"

	}).done(function(data){
		console.log(data);
		var fecha = "";
		var sucursal = "";
		if(typeof(data.fecha) != "undefined"){
			data.fecha.forEach(function(entry){
				fecha += "<option value="+entry.fecha+">"+entry.fecha+"</option>";
			});
		}
		data.unidad.forEach(function(entry){
			sucursal += "<option value="+entry.id+">"+entry.unidad+"</option>";
		});

		$("#fecha").append(fecha);
		$("#sucursal").append(sucursal);
	}).fail(function(error){
		console.log(error.responseText);

	});
}
function cancelarOrden(){
	//window.location.href= "imprimir_orden.php?orden="+$(this).attr("data-id");
	
	if(!$(this).attr('disabled')){

			
		 var orden = $(this).attr("data-id");
		$.ajax({
		method: "POST",
		url: "php/cancela_orden_mtd.php",
		dataType:"json",
		data:{"orden":orden}
		}).done(function(data){
		if(data.cancelar == 'true'){
				
				$("#estado"+atob(orden)).html("cancelado");
				alert("Orden cancelada correctamente.");
				window.location.href='visor_general_laboratorio.php';
			} else {
				alert(entry.editado);
			}
		}).fail(function(error){

		});
	}
}
function encotrarOrden(){

	var buscar = $("#buscar").val();
	var sucursal = $("#sucursal").val();
	var fecha = $("#fecha").val();
	total = costo = utilidad = 0.00;
	$.ajax({
		method: "POST",
		url: "php/obtener_orden_mtd.php",
		dataType:"json",
		data:{"buscar":buscar,"sucursal":sucursal,"fecha":fecha}
	}).done(function(data){
		console.log(data);
		var orden = activo = "";
		var  estadoLetra = "";
		if(typeof(data.orden) != 'undefined'){
			data.orden.forEach(function(entry){
				
				if(entry.estado == 1){
					
					estadoLetra = "Activo"; 
					activo = "";
				} else{
					
					estadoLetra = "Cacelado";
					activo = "disabled"; 
				}
				
				orden += '<tr><td>'+entry.folio+'</td>'+
								'<td>'+entry.estudios+'</td>'+
								'<td>'+entry.atendio+'</td>'+
								'<td>'+entry.registro+'</td>'+
								'<td>'+entry.total+'</td>';
				if(entry.estado == 1){
					total += parseFloat(entry.total);
				}				
				if(data.show == true){
					orden +='<td>'+entry.costo+'</td>'+
							  '<td>'+(entry.total - entry.costo)+'</td>';
					if(entry.estado == 1){
					    costo += parseFloat(entry.costo);
					    utilidad += parseFloat(entry.total - entry.costo);
					}
				}

				orden +='<td>'+estadoLetra+'</td>';
				if(data.show == true){
					orden +='<td><a href="#" class="btn btn-danger cancelar" role="button" data-id="'+entry.id+'"'+activo+' id="cancelar"'+atob(entry.id)+'>'+
							  '<span class="glyphicon glyphicon-remove"></span></a></td>';
				}
				orden +='</tr>';
			});
		}
		$('#orden').empty();
		$('#orden').append(orden);
		$("#total").html(dobleDecimal(total));
		$("#costo").html(dobleDecimal(costo));
		$("#utilidad").html(dobleDecimal(utilidad));
		$("#totalEnLetra").html("("+NumerosaLetras(dobleDecimal(total))+")");
		$(".cancelar").on("click",cancelarOrden);

	}).fail(function(error){
		alert("Por el momento no est\u00E1 disponible el servicio, intente m\u00E1s tarde");
		
	});
}
$(function(){
	encotrarOrden();
	obtenerFechaSucursal();
});