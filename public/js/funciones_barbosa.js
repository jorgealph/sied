
function carga_temas(id) {

	loading = new Loading({
	    discription: 'Cargando...',
	    defaultApply: true
	});
	
	var funcion = 'C_propuestas/carga_temas';
	$.post(url_sitio+funcion, {id:id}, function(resp){
		$('#iIdTema').html(resp);
		loading.out();
		if(id=="") {
			carga_propuestas();
		}
	})
}

function carga_propuestas(id) {
	loading = new Loading({
	    discription: 'Cargando...',
	    defaultApply: true
	});

	var funcion = 'C_propuestas/carga_propuestas';
	$.post(url_sitio+funcion, {id:id}, function(resp){
		$('#iIdPropuesta').html(resp);
		loading.out();
	})
}

function carga_comentarios() {
	loading = new Loading({
	    discription: 'Cargando...',
	    defaultApply: true
	});

	var funcion = 'C_propuestas/carga_comentarios';
	//var idsector = $('#iIdSector option:selected').val();
	//var idtema = $('#iIdTema option:selected').val();
	//var idprop = $('#iIdPropuesta option:selected').val();
	var iEst = $('#iEstatus option:selected').val();

	if(iEst!="") {
		$.post(url_sitio+funcion, $('#form_comentarios').serialize(), function(resp){
			$('#contenido_comentarios').html(resp);
			loading.out();
		});
	} else {
		loading.out();
		toastr.warning('Debe seleccionar por lo menos el Estatus de la propuesta', 'Advertencia', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });
	}


}

function modera_coment(op,idcoment) {
	var funcion = 'C_propuestas/act_coment';
	if(op=="0")
	{
		Swal({
          title: 'Eliminar comentario',
          text: '¿Realmente desea eliminar este comentario?',
          type: 'question',
          showCancelButton: true,
          confirmButtonText: 'Confirmar',
          cancelButtonText: 'Cancelar'
        }).then((result) => {           
            if (result.value) {        
                $.post(url_sitio+funcion, {idcoment:idcoment,op:op}, function(resp){
                	
                	switch(resp) {
                		case "correcto": 
                			toastr.success('Comentario eliminado', 'Operación completa', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });
                			break;
                		case "error1": 
                			toastr.warning('No se ha podido enviar el correo, intente de nuevo más tarde', 'Operación completa', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });
                			break;
                		case "error2": 
	                		toastr.danger('Error al eliminar el comentario', 'Operación completa', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });
	                		break;
                	}
					//toastr.success('Comentario eliminado', 'Operación completa', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });
					carga_comentarios();
				});	
            } else if (result.dismiss === Swal.DismissReason.cancel) {
            
            }
        });
	}
	else
	{
		$.post(url_sitio+funcion, {idcoment:idcoment,op:op}, function(resp){
			toastr.success('comentario aceptado', 'Operación completa', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });
			carga_comentarios();
		});		
	}
}