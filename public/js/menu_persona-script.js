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
			var paciente = $(this).data("paciente");
			var horario_id=$('#horario_id').val();
			var persona_id=paciente.id;
			console.log(paciente);

			var url="/ver-raciones-disponibles-persona";
			$.ajax({
				type: 'get',
				url: url,
				dataType: 'json',
				data:{horario_id,persona_id},
					success: function (data) {
								console.log(data);
								var selectRaciones=document.getElementById("racion_id");
								for (i = selectRaciones.length - 1; i >= 0; i--) {
									selectRaciones.remove(i);
								}
								data.raciones.forEach(myFunction)
								function myFunction(item, i) {
									console.log(item.id);
									var miOption=document.createElement("option");
									miOption.setAttribute("value",item.id);
									miOption.setAttribute("label",item.name);
									selectRaciones.appendChild(miOption);
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
		var persona = $(this).data("id");
		//var url_destroy = "{{route('users.destroy',':id')}}";//esto solo funciona en blade.php
		//validar el usuario
		var url_destroy = "personas/:id";
		url_destroy = url_destroy.replace(':id',persona.id);
		console.log(persona);
	$('#alert').show();
	    $.ajax({
	    	type: 'DELETE',
	    	url: url_destroy,
	    	dataType: 'json',
					data:{data:persona},
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
	$('.crear_menu').click(function(e){
		var elemento=document.getElementById("modal-header");
		e.preventDefault();//evita cargar la pagina
		var s=document.getElementById("h4_modal");
		console.log(s);
		$(".close").remove();
		$(".h4_modal").remove();
		$(".p_modal_body").remove();
		var selectRaciones=document.getElementById("racion_id");
		for (i = selectRaciones.length - 1; i >= 0; i--) {
			selectRaciones.remove(i);
		}
		var paciente_name= $(this).data("paciente_name");
		var paciente= $(this).data("paciente");
		console.log(paciente_name);
		var h4 = document.createElement("h4");
		h4.innerHTML = "Crear menu para "+paciente_name;
		h4.setAttribute("id","h4_modal");
		h4.setAttribute("class","h4_modal");
		document.getElementById("modal-header").appendChild(h4);
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
		var url = "pacientes/:id/patologias";
		url= url.replace(':id',paciente.id);
		$.ajax({
			type: 'post',
			url: url,
			dataType: 'json',
				data:{paciente},
				success: function (data) {
					console.log(data);
					if(data.success=='true'){
					p.innerHTML = "Tiene las patologias "+data.patologias;
					document.getElementById("p_body").appendChild(p);
				}else{
					p.innerHTML = "No tiene patologias";
					document.getElementById("p_body").appendChild(p);
				}
					},
					error: function (data) {
						console.log('Error:', data);
					}
		});
	});
