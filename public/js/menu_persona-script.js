	$(document).ready(function(){
		$('#alert').hide();
		$.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
		if(getQueryVariable()=="buscar_persona")
		{
			document.getElementById("personaid").focus();
		}
		$("#horario_id").change(function(){
			var persona = JSON.parse(localStorage.getItem('persona'));
			var persona_id=persona.id;
			var horario_id=$('#horario_id').val();
			console.log(persona);
			var selectRaciones=document.getElementById("racion_id");
			for (i = selectRaciones.length - 1; i >= 0; i--) {
				selectRaciones.remove(i);
			}

			var url="/ver-raciones-disponibles-persona";
			$.ajax({
				type: 'get',
				url: url,
				dataType: 'json',
				data:{horario_id,persona_id},
					success: function (data) {
								console.log(data);
								data.raciones.forEach(myFunction)
								function myFunction(item, i) {
									data.raciones_name.forEach(myRacionFunction)
									function myRacionFunction(racion, j) {
										if(i==j){
											console.log(item.id);
											console.log(racion.name);
											var miOption=document.createElement("option");
											miOption.setAttribute("value",item.id);
											miOption.setAttribute("label",racion.name);
											selectRaciones.appendChild(miOption);
										}
										j++;
									}
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
	$('#example2 tbody').on( 'click', '[class*=entregar]', function (e) {
	//$('.entregar').click(function(e){
		var menu_persona = $(this).data("id");
		//var btn=document.getElementById("btn-"+menu_persona.id).disabled = true;
		e.preventDefault();//evita cargar la pagina
		var url="/menu_persona/"+menu_persona.id;
		$.ajax({
			type: 'PUT',
			url: url,
			dataType: 'json',
				data:{menu_persona},
				success: function (data) {
					if (data.estado=='true'){
							console.log(data.success);
							document.getElementById("btn-"+menu_persona.id).disabled = true;
							document.getElementById("btn-eliminar-"+menu_persona.id).disabled = true;
							$('#alert').show();
							$('#alert').html(data.success);
							}else{
								console.log(data.success);
								$('#alert').html(data.success);
							}
							},
							error: function (data) {
								$('#alert').show();
								$('#alert').html(data);
								console.log('Error:', data);
							}
				});
	});
	$('#example2 tbody').on( 'click', '[class*=eliminar]', function (e) {
	//$('.eliminar').click(function(e){

		e.preventDefault();//evita cargar la pagina

		if(!confirm("¿Esta seguro que desea eliminar?")){
			return false;
		}

		var row = $(this).parents('tr');
		var token = $(this).data("token");
		var menu_persona = $(this).data("id");
		//var url_destroy = "{{route('users.destroy',':id')}}";//esto solo funciona en blade.php
		//validar el usuario
		var url_destroy = "menu_persona/"+menu_persona.id;

		console.log(menu_persona);
	$('#alert').show();
	    $.ajax({
	    	type: 'DELETE',
	    	url: url_destroy,
	    	dataType: 'json',
					data:{menu_persona},
		    	success: function (data) {
						if (data.estado=='true'){
								var table=$("#example2").DataTable();
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
	$('#example1 tbody').on( 'click', '[class*=crear_menu]', function (e) {
	//$('.crear_menu').click(function(e){
		var elemento=document.getElementById("modal-header");
		$('#alert-modal').hide();
		e.preventDefault();//evita cargar la pagina
		var s=document.getElementById("h4_modal");
		document.getElementById("horario_id").options[0].selected=true;
		//console.log(horarioSelect.options[0]);
		console.log(s);
		$(".close").remove();
		$(".h4_modal").remove();
		$(".p_modal_body").remove();
		var selectRaciones=document.getElementById("racion_id");
		for (i = selectRaciones.length - 1; i >= 0; i--) {
			selectRaciones.remove(i);
		}
		var paciente_name= $(this).data("paciente_name");
		var paciente_apellido= $(this).data("paciente_apellido");
		var paciente= $(this).data("paciente");

		localStorage.setItem('persona', JSON.stringify(paciente));
		var p = JSON.parse(localStorage.getItem('persona'));
		console.log("paciente "+p.id);
		console.log(paciente_name);

		var h4 = document.createElement("h4");
		h4.innerHTML = "Crear menú ";
		h4.setAttribute("id","h4_modal");
		h4.setAttribute("class","h4_modal");
		document.getElementById("modal-header").appendChild(h4);

		var p_modal = document.createElement("p");
		p_modal.innerHTML = paciente_name+" "+paciente_apellido;
		p_modal.setAttribute("id","h4_modal");
		p_modal.setAttribute("class","h4_modal");
		document.getElementById("p_body").appendChild(p_modal);


		var btn = document.createElement("BUTTON");
		var dateSpan = document.createElement('span')
		dateSpan.innerHTML = "×";
		console.log(dateSpan);
		btn.appendChild(dateSpan);
		btn.setAttribute("class", "close");
		btn.setAttribute("id", "close");
		btn.setAttribute("data-dismiss", "modal");
		console.log(btn);
		document.getElementById("modal-header").appendChild(btn);
		var p = document.createElement("p");
		p.setAttribute("id", "p_modal_body");
		p.setAttribute("class", "p_modal_body");
		var patologias = $(this).data("patologias");
		if(patologias.length==0){
			p.innerHTML = "No tiene patologías.";
			document.getElementById("p_body").appendChild(p);
		}else{
			var s="Tiene las patologías : ";
			patologias.forEach(myFunction)
			function myFunction(patologia, i) {
				console.log(patologia.name);
				s=s+" "+ patologia.name+ " ; ";
				i++;
			}
			p.innerHTML = s;
			document.getElementById("p_body").appendChild(p);
		}

		//OBTENER LOS HORARIOS Y MOSTRARLOS
		var selectHorarios=document.getElementById("horario_id");
		for (i = selectHorarios.length - 1; i >= 0; i--) {
			selectHorarios.remove(i);
		}
		var url="/ver-horarios-menus";
		var persona = JSON.parse(localStorage.getItem('persona'));
		console.log(persona.id);
		var persona_id=persona.id;
		$.ajax({
			type: 'get',
			url: url,
			dataType: 'json',
			data:{persona_id},
				success: function (data) {
							console.log(data);
							var miOption=document.createElement("option");
							miOption.setAttribute("value",0);
							miOption.setAttribute("label","Seleccione un horario");
							selectHorarios.appendChild(miOption);
							data.horarios.forEach(myFunction)
							function myFunction(item, i) {
										console.log(item.id);
										console.log(item.name);
										var miOption=document.createElement("option");
										miOption.setAttribute("value",item.id);
										miOption.setAttribute("label",item.name);
										selectHorarios.appendChild(miOption);

								i++;

								}
							},
							error: function (data) {
								console.log('Error:', data);

							}
		});
		document.getElementById("horario_id").options[0].selected=true;

	});
	$('.guardar_menu').click(function(e){
		e.preventDefault();
		var persona = JSON.parse(localStorage.getItem('persona'));
		var persona_id=persona.id;
		var racion_disponible_id=$('#racion_id').val();
		var url="/menu_persona";
		var horario_id=$('#horario_id').val();
		var modal=document.getElementById("create");
		$.ajax({
			type: 'post',
			url: url,
			dataType: 'json',
				data:{persona_id,racion_disponible_id,horario_id},
				success: function (data) {
					console.log(data);
					if(data.success=='true'){
						$('#create').modal('hide');
						$('#alert').show();
						$('#alert').html(data.data);
					}else{
						$('#alert-modal').show();
						$('#alert-modal').html(data.data);
					}
				},
				error: function (data) {
					console.log('Error:', data);
				}
		});

	});
