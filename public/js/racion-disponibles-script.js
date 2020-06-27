	$(document).ready(function(){
		$('#alert').hide();
		$("#cantidad").hide();
		$("#miSelect").hide();
		$("#guardarDisponibilidad").hide()
		$.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
		if(getQueryVariable()=="buscar_racion")
		{
			document.getElementById("racionid").focus();
		}
		$('.agregar').on('click', function (e){
				e.preventDefault();
			$('#tablealimentosAgregados tr').remove();
				console.log( $(this).data("id"));
				var id= $(this).data("id");
				var array=[];

				var a=document.querySelectorAll('input[type=checkbox]:checked');
				console.log(a);
				for (var i = 0; i < a.length; i++) {
			  	console.log(a[i].value);
					array.push(a[i].value);
					console.log(array);
			}

			var ruta="/raciones/:id/guardaralimentos";
			ruta= ruta.replace(':id',id);
			$.ajax({
				type: 'PUT',
				url: ruta,
				dataType: 'json',
				data:{data:[id,array]},
					success: function (data) {
							console.log(data);

							data.alimentos.forEach(myFunction)

							function myFunction(item, i) {
								console.log(item.id);
								var fila="<tr><td>"+item.name+"</td><td>";

								var btn = document.createElement("TR");
								btn.innerHTML=fila;
								document.getElementById("tablealimentosAgregados").appendChild(btn);
							//	document.getElementById("tablealimentos").appendChild(checkbox);
								i++;
								$('#tablealimentos tr').remove();
							}

								},
								error: function (data) {
										console.log('Error:', data);
								}

					});

			});

    $('.buscar').on('click', function (e){
        e.preventDefault();
				$('#tablealimentos tr').remove();
				const buscar = document.getElementById("busqueda_por").value;
				const search = document.getElementById("alimentoid").value;
				console.log(buscar);
				console.log(search);
				var ruta="/buscarAlimento";
				$('#tablealimentos tr').each(function(){
					$(this).find('tr').each(function(){
					console.log($(this).find('tr').checkbox);
					  })
					})



				$.ajax({
					type: 'POST',
					url: ruta,
					dataType: 'json',
					data:{data:[buscar,search]},
						success: function (data) {
								console.log(data);

								var i=0;
								data.forEach(myFunction)

								function myFunction(item, i) {
									console.log(item.id);
									var fila="<tr><td>"+item.name+"</td><td>";

							    var btn = document.createElement("TR");
							   	btn.innerHTML=fila;

									var checkbox = document.createElement('input');
					        checkbox.type = "checkbox";
					        checkbox.value = item.id;

					        checkbox.name = "agregarAlimentos[]";
									btn.appendChild(checkbox);
									document.getElementById("tablealimentos").appendChild(btn);

									i++;
								}

									},
									error: function (data) {
											console.log('Error:', data);
									}

						});
    })
		$('.custom-select').change(function(){

			//e.preventDefault();//evita cargar la pagina

			var url="/ver-raciones-disponibles";
			var optionHorario=document.getElementById("option-horario").value;
			console.log(optionHorario);
			var fecha=document.getElementById("fecha").value;
			console.log(fecha);
			$.ajax({
				type: 'get',
				url: url,
				dataType: 'json',
				data:{data:[optionHorario,fecha]},
					success: function (data) {
									$("#cantidad").show();
									$("#miSelect").show();
									$("#guardarDisponibilidad").show();
									var miSelect=document.getElementById("miSelect");

									for (i = miSelect.length - 1; i >= 0; i--) {
										miSelect.remove(i);
									}


									console.log(data.raciones);
									data.raciones.forEach(myFunction)

									function myFunction(item, i) {
										console.log(item.id);
										var miOption=document.createElement("option");
										miOption.setAttribute("value",item.id);
										miOption.setAttribute("label",item.name);
										miSelect.appendChild(miOption);
										i++;
									}
								},
								error: function (data) {
										console.log('Error:', data);
								}

					});

		});
	});
	function getQueryVariable() {
	 var query = window.location.search.substring(1);
	 var vars = query.split("&");
	 for (var i=0; i < vars.length; i++) {
			 var pair = vars[i].split("=");
			 if(pair[0] == "get") {
					 return (pair[1]);
			 }return("");
	 }
	};
	$('.eliminar').click(function(e){

		e.preventDefault();//evita cargar la pagina

		if(!confirm("¿Esta seguro que desea eliminar?")){
			return false;
		}

		var row = $(this).parents('tr');
		var token = $(this).data("token");
		var racionDisponible = $(this).data("id");
		var url_destroy = "/raciones-disponibles/destroy/:id";

		url_destroy = url_destroy.replace(':id',racionDisponible.id);

		console.log(racionDisponible);
	$('#alert').show();
	    $.ajax({
	    	type: 'DELETE',
	    	url: url_destroy,
	    	dataType: 'json',
				data:{racionDisponible},
		    	success: function (data) {
						if (data.estado=='true'){
						   		row.fadeOut();
	        			$('#alert').html(data.success);
							  	console.log(data.success);
								}else{
									$('#alert').html(data.success);
										console.log(data.success);
								}
                },
                error: function (data) {
                    console.log('Error:', data);
                }

	        });
	});
	$('.btn-ver').click(function(e){

		e.preventDefault();//evita cargar la pagina

		var url="/ver-raciones-disponibles";
		var optionHorario=document.getElementById("option-horario").value;
		console.log(optionHorario);
		var fecha=document.getElementById("fecha").value;
		console.log(fecha);
		$.ajax({
			type: 'get',
			url: url,
			dataType: 'json',
			data:{data:[optionHorario,fecha]},
				success: function (data) {
								$("#cantidad").show();
								$("#miSelect").show();
								$("#guardarDisponibilidad").show();
								var miSelect=document.getElementById("miSelect");

								for (i = miSelect.length - 1; i >= 0; i--) {
									miSelect.remove(i);
								}


								console.log(data.raciones);
								data.raciones.forEach(myFunction)

								function myFunction(item, i) {
									console.log(item.id);
									var miOption=document.createElement("option");
									miOption.setAttribute("value",item.id);
									miOption.setAttribute("label",item.name);
									miSelect.appendChild(miOption);
									i++;
								}
							},
							error: function (data) {
									console.log('Error:', data);
							}

				});


});
$('.guardarDisponibilidad').click(function(e){

	e.preventDefault();//evita cargar la pagina
	var user_id = $(this).data("user_id");
	var horario_id=document.getElementById("option-horario").value;
	var fecha=document.getElementById("fecha").value;
	var racion_id=document.getElementById("miSelect").value;
	var cantidad=document.getElementById("cantidad").value;
	console.log(racion_id);
	console.log(user_id);
	var url="/raciones-disponibles";
	$.ajax({
		type: 'POST',
		url: url,
		dataType: 'json',
		data:{data:[horario_id,fecha,racion_id,cantidad,user_id]},
			success: function (data) {
						console.log(data);
							if(!(data.data=="error")){
							 location.href="/raciones-disponibles";
						 }else{
							 console.log('Error:', data);
								 $('#alert').show();
								 $('#alert').html(data.mensaje);
						 }

						},
						error: function (data) {
								console.log('Error:', data);
									$('#alert').show();
									$('#alert').html(data.data);
						}

			});

});
$('.ver').click(function(e){

	e.preventDefault();//evita cargar la pagina

	var row = $(this).parents('tr');
	var token = $(this).data("token");
	var racionDisponible = $(this).data("id");

	var url_show = "/raciones-disponibles/show/:racion_id/:horario_id/:fecha";
	url_show = url_show.replace(':racion_id',racionDisponible.racion_id);
	url_show = url_show.replace(':horario_id',racionDisponible.horario_id);
	url_show = url_show.replace(':fecha',racionDisponible.fecha);
	console.log(url_show);
	$.ajax({
		type: 'GET',
		url: url_show,
		dataType: 'json',
		data:{racionDisponible},
			success: function (data) {
						console.log(data);
							if(!(data.data=="error")){
							 location.href="/raciones-disponibles";
						 }else{
							 console.log('Error:', data);
								 $('#alert').show();
								 $('#alert').html(data.mensaje);
						 }

						},
						error: function (data) {
								console.log('Error:', data);
									$('#alert').show();
									$('#alert').html(data.data);
						}

			});
});
$('.guardarRealizados').click(function(e){

	e.preventDefault();//evita cargar la pagina
	var racionDisponible=$(this).data("id");
	var user=$(this).data("user");
	var cantidad_realizados=document.getElementById("cantidad_realizados").value;
	console.log(racionDisponible);
	console.log(user);
	console.log(cantidad_realizados);
	var url_update = "/raciones-disponibles/update/:racion_id/:horario_id/:fecha";
	url_update = url_update.replace(':racion_id',racionDisponible.racion_id);
	url_update = url_update.replace(':horario_id',racionDisponible.horario_id);
	url_update = url_update.replace(':fecha',racionDisponible.fecha);
	console.log(url_update);
	$.ajax({
		type: 'PUT',
		url: url_update,
		dataType: 'json',
		data:{racionDisponible,cantidad_realizados,user},
			success: function (data) {
						console.log(data);
						location.reload(true);

						},
						error: function (data) {
								console.log(data);
								$('#alert').show();
								$('#alert').html("Hubo un error");
						}

			});

});

$('.btn-agregar').click(function(e){
	e.preventDefault();
	localStorage.setItem('racionDisponible',JSON.stringify($(this).data("id")));
});
$('.btn-movimientos').click(function(e){
	e.preventDefault();
	localStorage.setItem('racionDisponible',JSON.stringify($(this).data("id")));

});
$('.guardarStock').click(function(e){

	e.preventDefault();//evita cargar la pagina
	//var racionDisponible=$(this).data("id");
	var racionDisponible=JSON.parse(localStorage.getItem('racionDisponible'));
	var user=$(this).data("user");
	var cantidad_stock=document.getElementById("cantidad_stock").value;
	console.log(racionDisponible);
	console.log(user);
	console.log(cantidad_stock);
	var url_update = "/raciones-disponibles/update/:id";

	url_update = url_update.replace(':id',racionDisponible.id);
	console.log(url_update);
	$.ajax({
		type: 'PUT',
		url: url_update,
		dataType: 'json',
		data:{racionDisponible,cantidad_stock,user},
			success: function (data) {
						console.log(data);
						location.reload(true);

						},
						error: function (data) {
								console.log('Error:', data);
								$('#alert').show();
								$('#alert').html("Hubo un error");
						}

			});
});
