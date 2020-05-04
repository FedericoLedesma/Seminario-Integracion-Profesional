	$(document).ready(function(){
		$.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
