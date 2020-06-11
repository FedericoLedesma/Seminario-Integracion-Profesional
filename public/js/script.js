	$(document).ready(function(){
		$.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
		$('#fecha_hasta').hide();
		$('#desde').hide();
		$('#fecha_hasta_title').hide();
		$('#checkbox_fecha').change(function() {
			if($("#checkbox_fecha").is(':checked')) {
				console.log("Mostrar fecha hasta");
				$('#fecha_hasta').show();
				$('#fecha_hasta_title').show();
				$('#desde').show();
			}else{
				console.log("Ocultar fecha");
				$('#fecha_hasta').hide();
				$('#fecha_hasta_title').hide();
				$('#desde').hide();
			}
		});
	});
	$('.buscar_user').click(function(e){

		e.preventDefault();//evita cargar la pagina
		console.log($(this).data("id"));
		 location.href="/admin/users?get="+$(this).data("id");

});
$('.buscar_role').click(function(e){

	e.preventDefault();//evita cargar la pagina
	console.log($(this).data("id"));
	 location.href="/admin/roles?get="+$(this).data("id");

});
$('.buscar_permiso').click(function(e){

	e.preventDefault();//evita cargar la pagina
	console.log($(this).data("id"));
	 location.href="/admin/permisos?get="+$(this).data("id");

});
$('.btn_generar_informe_raciones').click(function(e){
	console.log("hola");
	var fecha=document.getElementById("fecha").value;
	var checkbox_fecha=document.getElementById("checkbox_fecha").value;
	console.log(checkbox_fecha);
	var fecha_hasta=document.getElementById("fecha_hasta").value;
	var search=document.getElementById("sector_name").value;
	var search_habitacion=document.getElementById("habitacion_id").value;
	var busqueda_persona_por=document.getElementById("busqueda_persona_por").value;
	var busqueda_horario_por=document.getElementById("busqueda_horario_por").value;
	console.log(fecha);
	console.log(search);
	console.log(search_habitacion);
	console.log(busqueda_persona_por);
	console.log(busqueda_horario_por);

 $.ajax({
 	type:"post",
 	url:	"/informe/generar-informe-raciones",
 	data:{fecha,search,search_habitacion,busqueda_horario_por,busqueda_persona_por},
 	success:function(fecha,search,search_habitacion,busqueda_horario_por,busqueda_persona_por){
 		console.log("funciona");
 	}
	 }).done(function(  ) {
	 console.log( 'Termino' );
	});


});
