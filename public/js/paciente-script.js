$(document).ready(function(){
	$('#alert').hide();
	$.ajaxSetup({
				headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
		});
	if(getQueryVariable()=="buscar_paciente")
	{
		document.getElementById("pacienteid").focus();
	}

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
	var role_id = $(this).data("id");
	//var url_destroy = "{{route('users.destroy',':id')}}";//esto solo funciona en blade.php
	//validar el usuario
	var url_destroy = "paciente/:id";
	url_destroy = url_destroy.replace(':id',paciente_id);

$('#alert').show();
		$.ajax({
			type: 'DELETE',
			url: url_destroy,
			dataType: 'json',
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
