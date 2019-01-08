function getQueryVariable(variable) {
   var query = window.location.search.substring(1);
   var vars = query.split("&");
  
  for (var i=0; i < vars.length; i++) {
       var pair = vars[i].replace('=','/').split("/");
      
       if(pair[0] == variable) {
           return pair[1];
       }
   }
   return false;
}

function dobleDecimal(value){
		var valueString = value + "";
		console.log(valueString.indexOf("."));
		if(valueString.indexOf(".") > 0){
				var separarDecimales = valueString.split(".");
				//var decimales = separarDecimales[1].spli("");
				console.log(typeof(separarDecimales[1]));
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
$(function(){
	var orden = getQueryVariable('orden');
	var listado = "";
	$.ajax({
		method: "POST",
		url: "php/imprimir_orden_mtd.php",
		dataType:"json",
		data: {'orden' : orden}
		
	}).done(function(data){
		var listado = "";
				console.log(data);
		$('.folio').text(data.orden.folio);
		$('.paciente').text(data.orden.nombre);
		$('.edad').text(data.orden.edad);
		$('.sexo').text(data.orden.sexo);
		$('.tel').text(data.orden.tel);
		$('.fIngreso').text(data.orden.f_ingreso);
		$('.hIngreso').text(data.orden.hora_ingreso);
		$('.fImpresion').text(data.orden.f_impresion);
		$('.direccion').text(data.orden.direccion);
		$('.tels').text(data.orden.telefono);
		$('.web').text(data.orden.web);
		$('.correo').text(data.orden.correo);
		$('.atendio').text(data.orden.atendio);
		data.estudio.forEach(function(entry){
			listado += '<tr style="padding: 0px;"><td style="padding: 0px;">'+entry.codigo+'</td><td style="padding: 0px;">'+entry.estudio+'</td><td style="padding: 0px;">'+dobleDecimal(entry.precio)+'</td>';
		});
		$(".total").html(dobleDecimal(data.orden.total));
		
		//$(".totalEnLetra").html("("+NumerosaLetras(dobleDecimal(data.orden.total))+")");
		$(".totalEnLetra").html("("+NumerosaLetras("10.50")+")");
		//console.log(listado);
		$(".estudioSeleccionado").append(listado);
		window.print();
		//window.close();
	}).fail(function(error){
		console.log(error.responseText);
		alert("Por el momento no est\u00E1 disponible el servicio, intente m\u00E1s tarde");
	});
	
	
	
});