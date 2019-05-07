<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    
</head>

<body>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Buscar usuarios</h4>
					<form action="#" id="formbusqueda">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                    	<label>Estatus</label>
                                        <select name="fEstatus" id="fEstatus" class="form-control">
                                        	<?=$op_estatus;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                    	<label>Rol</label>
                                        <select name="fRol" id="fRol" class="form-control">
                                        	<?=$op_roles;?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                            	<div class="col-md-10">
                            		<label>Nombre del usuario</label>
                            		<div class="input-group mb-12">
                                        <input type="text" class="form-control" name="fTitulo" id="fTitulo" placeholder="" aria-label="" aria-describedby="basic-addon1">
                                        <div class="input-group-append">
                                            <button class="btn btn-info" type="submit" onclick="Buscar(0,event);"><i class="ti-search"></i>&nbsp;Buscar</button>
                                        </div>
                                    </div>
                            	</div>
                            	<div class="col-md-2">
                        			<button class="btn btn-success" type="button" onclick="CapturarUsuario(0);" style="margin-top:28px;">Crear usuario</button>
                            	</div>
                            </div>
                           
                        </div>
                    </form>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-12" id="contenidomodulo">
			<?php echo $resultado_busqueda; ?>
		</div>
	</div>
</body>
<script type="text/javascript">
	function Eliminar(id)
	{
		Swal({
          title: 'Eliminar usuario',
          text: '¿Realmente desea eliminar este usuario?',
          type: 'question',
          showCancelButton: true,
          confirmButtonText: 'Confirmar',
          cancelButtonText: 'Cancelar'
        }).then((result) => {           
            if (result.value) {           
                $.post("<?=base_url();?>C_seguridad/eliminar_usuario",{id:id},function(resultado,status){
                	if(resultado == "0"){                		
                	 	Notificacion('Usuario eliminado','success');
                	 	Cargar('<?=base_url()?>C_seguridad/index_usuarios','#contenido');
                	}
            		else Notificacion(resultado,'error');					
				});
            } else if (result.dismiss === Swal.DismissReason.cancel) {
            
            }
        });
	}

    function Bloquear(id)
    {
        Swal({
              title: 'Bloquear usuario',
              text: '¿Realmente desea Bloquear a este usuario?',
              type: 'question',
              showCancelButton: true,
              confirmButtonText: 'Confirmar',
              cancelButtonText: 'Cancelar'
            }).then((result) => {           
                if (result.value) {
                    var loading;
                    $.ajax({
                        url: '<?=base_url();?>C_seguridad/bloquear_usuario',
                        type: 'POST',
                        data: 'id='+id,
                        error: function(XMLHttpRequest, errMsg, exception){
                            var msg = "Ha fallado la petición al servidor";
                            loading.out();
                            alert(msg);
                        },
                         beforeSend: function(){
                           loading = new Loading({
                                discription: 'Espere...',
                                defaultApply: true
                            });
                        },
                        success: function(htmlcode){
                            loading.out();
                            var cod = htmlcode.split("-");
                            switch(cod[0])
                            {
                                case "0":
                                    Notificacion('Usuario bloqueado','success');    
                                    Buscar(1);
                                    break;
                                case "1":
                                    Notificacion('El usuario ha sido bloqueado, pero no se ha podido enviar correo','warning');    
                                    Buscar(1);
                                    break;
                                default:
                                    Notificacion(resultado,'error');
                                    break;
                            }
                        }
                    });
                }else if (result.dismiss === Swal.DismissReason.cancel) {
            }
        });
    }

    function Desbloquear(id)
    {
        Swal({
          title: 'Desbloquear usuario',
          text: '¿Realmente desea desbloquear a este usuario?',
          type: 'question',
          showCancelButton: true,
          confirmButtonText: 'Confirmar',
          cancelButtonText: 'Cancelar'
        }).then((result) => {           
            if (result.value) {           
                var loading;
                $.ajax({
                    url: '<?=base_url();?>C_seguridad/desbloquear_usuario',
                    type: 'POST',
                    data: 'id='+id,
                    error: function(XMLHttpRequest, errMsg, exception){
                        var msg = "Ha fallado la petición al servidor";
                        loading.out();
                        alert(msg);
                    },
                     beforeSend: function(){
                       loading = new Loading({
                            discription: 'Espere...',
                            defaultApply: true
                        });
                    },
                    success: function(htmlcode){
                        loading.out();
                        var cod = htmlcode.split("-");
                        switch(cod[0])
                        {
                            case "0":
                                Notificacion('Usuario desbloqueado','success');    
                                Buscar(1);
                                break;
                            case "1":
                                Notificacion('El usuario ha sido desbloqueado, pero no se ha podido enviar correo','warning');    
                                Buscar(1);
                                break;
                            default:
                                Notificacion(resultado,'error');
                                break;
                        }
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
            
            }
        });
    }

    function ReeviarCorreo(id)
    {
        Swal({
          title: 'Enviar correo de validación',
          text: '¿Desea reenviar el correo de validación a este usuario?',
          type: 'question',
          showCancelButton: true,
          confirmButtonText: 'Confirmar',
          cancelButtonText: 'Cancelar'
        }).then((result) => {           
            if (result.value) {           
                var loading;
                $.ajax({
                    url: '<?=base_url();?>C_seguridad/enviar_validacion_correo',
                    type: 'POST',
                    data: 'id='+id,
                    error: function(XMLHttpRequest, errMsg, exception){
                        var msg = "Ha fallado la petición al servidor";
                        loading.out();
                        alert(msg);
                    },
                     beforeSend: function(){
                       loading = new Loading({
                            discription: 'Espere...',
                            defaultApply: true
                        });
                    },
                    success: function(htmlcode){
                        loading.out();
                        var cod = htmlcode.split("-");
                        switch(cod[0])
                        {
                            case "0":
                                Notificacion('Correo enviado','success');    
                                Buscar(1);
                                break;
                            default:
                                Notificacion(htmlcode,'error');
                                break;
                        }
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
            
            }
        });
    }

	function Buscar(pag,e)
	{
        if (!e) { var e = window.event; }
        e.preventDefault();

		var pag = pag || 1;

		var variables = $("#formbusqueda").serialize();
		variables = variables + '&pag=' + pag;

		Cargar('<?=base_url();?>C_seguridad/buscar_usuarios','#contenidomodulo','POST',variables);
	}
    

	function CapturarUsuario(id)
	{
		var vars = 'id=' + id		
		Cargar('<?=base_url();?>C_seguridad/capturar_usuario','#contenidomodulo','POST',vars);
	}
</script>
</html>