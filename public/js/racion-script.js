	$(document).ready(function(){
		$('#alert').hide();
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

			//	var a=document.querySelectorAll('input[type=checkbox]:checked');
			var a=document.getElementById("bootstrap-duallistbox-selected-list_");
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

							//data.alimentos.forEach(myFunction)

						/*	function myFunction(item, i) {
								console.log(item.id);
								var fila="<tr><td>"+item.name+"</td><td>";

								var btn = document.createElement("TR");
								btn.innerHTML=fila;
								document.getElementById("tablealimentosAgregados").appendChild(btn);
							//	document.getElementById("tablealimentos").appendChild(checkbox);
								i++;
								$('#tablealimentos tr').remove();
							}*/ location.href="/raciones/"+id+"/edit";

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
	$('#example1 tbody').on( 'click', '[class*=eliminar]', function (e) {
	//$('.eliminar').click(function(e){

		e.preventDefault();//evita cargar la pagina

		if(!confirm("¿Esta seguro que desea eliminar?")){
			return false;
		}

		var row = $(this).parents('tr');
		var token = $(this).data("token");
		var racion = $(this).data("id");

		var url_destroy = "raciones/:id";
		url_destroy = url_destroy.replace(':id',racion.id);
		console.log(racion);
	$('#alert').show();
	    $.ajax({
	    	type: 'DELETE',
	    	url: url_destroy,
	    	dataType: 'json',
		    	success: function (data) {
						if (data.estado=='true'){
								var table=$("#example1").DataTable();
								if ($(row).hasClass('child')) {
								 table.row($(row).prev('tr')).remove().draw();
								} else {
								table.row($(row)).remove().draw();
								}
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
	$('.quitarAlimento').click(function(e){

		e.preventDefault();//evita cargar la pagina

		if(!confirm("¿Esta seguro que desea quitar el Alimento?")){
			return false;
		}

		var row = $(this).parents('tr');
		var token = $(this).data("token");
		var racion = $(this).data("racion");
		var alimento=$(this).data("id");

		var url_quitar = "/raciones/:id/quitaralimento";
		url_quitar = url_quitar.replace(':id',racion.id);
		console.log(racion);
	$('#alert').show();
	    $.ajax({
	    	type: 'PUT',
	    	url: url_quitar,
	    	dataType: 'json',
				data:{data:[racion.id,alimento.id]},
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
		$('.nuevoAlimento').click(function(e){
			//evita cargar la pagina
			var name=	document.getElementById("nameAlimento").value;
			console.log(name);
			var url="/alimentos";
			$.ajax({
	    	type: 'POST',
	    	url: url,
	    	dataType: 'json',
				data:{name},
		    	success: function (data) {
						if (data.estado=='true'){

							  	console.log(data.success);
								}else{
										console.log(data.success);
								}
                },
                error: function (data) {
                    console.log('Error:', data);
                }

	        });

		});

		$('.quitarHorario').click(function(e){

			e.preventDefault();//evita cargar la pagina

			if(!confirm("¿Esta seguro que desea quitar el Horario?")){
				return false;
			}

			var row = $(this).parents('tr');
			var token = $(this).data("token");
			var racion = $(this).data("racion");
			var horario=$(this).data("horario");

			var url_quitar = "/raciones/:id/quitarhorario";
			url_quitar = url_quitar.replace(':id',racion.id);
			console.log(racion);
		$('#alert').show();
		    $.ajax({
		    	type: 'PUT',
		    	url: url_quitar,
		    	dataType: 'json',
					data:{data:[racion.id,horario.id]},
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

		$('.guardarHorarioRacion').on('click', function (e){
				e.preventDefault();

				var racion= $(this).data("racion");
				var horario_id=document.getElementById("select-horarios").value;
				console.log(horario_id);
				var ruta="/raciones/:id/guardarhorario";
				ruta= ruta.replace(':id',racion.id);
				$.ajax({
					type: 'PUT',
					url: ruta,
					dataType: 'json',
					data:{data:[racion.id,horario_id]},
						success: function (data) {
								console.log(data);
								location.reload(true);
									},
									error: function (data) {
											console.log('Error:', data);
									}

						});

			});
