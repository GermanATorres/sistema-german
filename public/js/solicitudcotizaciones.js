$(document).ready(function(){
	var proy=$("#proyecto").val();
	listarcategorias(proy);

	$("#categoria").change(function(){
		var idc = ( this.value );
		var idp = $("#proyecto").val();
		$.get('/'+carpeta()+'/public/solicitudcotizaciones/getpresupuesto/'+idc+'/'+idp , function(data){
			//console.log(data);
			$(cuerpo).empty();
		 console.log(data);
		 $(data).each(function(key, value){
			 $(cuerpo).append(
							 "<tr>"+
									 "<td>" + value.catalogo.nombre + "</td>" +
									 "<td>" + value.catalogo.unidad_medida + "</td>" +
									 "<td>" + value.cantidad + "</td>" +
									 "<td></td>"+
									 "<td></td>"+
							 "</tr>"
					 );
		 });
	 });
	});

function listarcategorias(idc)
{
	$.get('/'+carpeta()+'/public/solicitudcotizaciones/getcategorias/'+idc , function(data){
		var html_select = '<option value="">Seleccione una categoría</option>';
			$(data).each(function(key, value){
				html_select +='<option value="'+value.categoria_id+'">'+value.categoria.item+' '+ value.categoria.nombre_categoria+'</option>'
				//console.log(data[i]);
				$("#categoria").html(html_select);
				$("#categoria").trigger('chosen:updated');
			});
	});

}

});
