	$(document).ready(function(){
		$('#alert').hide();
		
			$('.btn-delete').click(function(e){
				e.preventDefault();
				if(!confirm("¿Esta seguro que desea eliminar?")){
					return false;
				}
			});
		
	});
	
