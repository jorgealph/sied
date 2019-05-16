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

	<div class="panel panel panel-inverse">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            </div>
            <h4 class="panel-title">Captura de organismo</h4>
        </div>
		<div class="panel-body">
		<form class="form" onsubmit="guardar(this,event);" id="form-captura" name="form-captura">
			<div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    	<label>Nombre del organismo</label>
                    	<input type="hidden" name="iIdOrganismo" id="iIdOrganismo" value="<?=$iIdOrganismo;?>">
                        <input type="text" id="vOrganismo" name="vOrganismo" class="form-control" value="<?=$vOrganismo;?>" data-parsley-required="true">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    	<label>Siglas</label>
                        <input type="text" id="vSiglas" name="vSiglas" class="form-control" value="<?=$vSiglas;?>" data-parsley-required="true">
                    </div>
                </div>
            </div>
			<div class="row">           
                <div class="col-md-6">
                    <div class="form-group">
                    	<label>Nombre del titular</label>
                        <input type="text" id="vNombreTitular" name="vNombreTitular" class="form-control" value="<?=$vNombreTitular;?>" data-parsley-required="true">
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="form-group">
                    	<label>Nombre del enlace</label>
                        <input type="text" id="vNombreEnlace" name="vNombreEnlace" class="form-control" value="<?=$vNombreEnlace;?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    	<label>Correo de contacto</label>
                        <input type="text" id="vCorreoContacto" name="vCorreoContacto" class="form-control" value="<?=$vCorreoContacto;?>" data-parsley-type="email">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    	<label>Eje</label>
                        <select name="iIdEje" id="iIdEje" class="form-control" min="1">
                        	<option value="0">-Seleccione una opción-</option>
                        	<?=$options_eje?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
				<div class="col-md-12 text-center">
					<div class="form-group">
						<button type="submit" class="btn btn-success" >Guardar</button>&nbsp;
                        <button type="button" class="btn btn-white" onclick="regresar();">Cancelar</button>
					</div>
				</div>
			</div>
		</form>
		</div>
	</div>

</body>

<script type="text/javascript">
	function guardar(form,event){
		event.preventDefault();
		var loading;
		if(validarFormulario(form)){
			$.ajax({
		        url: '<?=base_url()?>C_organismo/guardar',
		        type: 'POST',
		        async: false,	//	Para obligar al usuario a esperar una respuesta
		        data: $(form).serialize(),
		        beforeSend: function(){
		           /*loading = new Loading({
		                discription: 'Espere...',
		                defaultApply: true
		            });*/
		        },
		        error: function(XMLHttpRequest, errMsg, exception){
		            var msg = "Ha fallado la petición al servidor";
		            //loading.out();
		            notificacion(msg);
		        },
		        success: function(htmlcode){
		        	//loading.out();
		        	var cod = htmlcode.split("-");
		        	switch(cod[0]){
		                case "0":
		                	notificacion('Los datos han sido guardados','success');
		                	regresar();
		                    break;
		                default:
		                    notificacion(htmlcode,'error');
		                    break;
		            }
		        }
		    });
		}
	}
</script>
</html>