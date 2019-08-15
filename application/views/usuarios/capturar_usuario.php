<html>

<head>
    
</head>

<body>
<a onclick="filter();" class="btn btn-default pull-right">
                <li class="fas fa-lg fa-fw m-r-10 fa-arrow-left"></li><span>Regresar</span>
            </a>
<h3 class="page-header">Directorio</h3>
<div class="panel panel-inverse">
<div class="panel-heading">
    <h4 class="panel-title">Captura de datos</h4>
</div>
<div class="panel-body">


    <?php if(validation_errors() != ""):?>
    <div class="alert alert-danger" role="alert">
    <?php echo validation_errors();?>
    </div>
<?php endif; ?>


<?php if($error != ""):?>
    <div class="alert alert-danger" role="alert">
        <?php echo $error;?>
    </div>
    <?php endif; ?>

    <form class="form" onsubmit="guardar(this,event);" id="form-captura" name="form-captura">
        <legend>Datos generales</legend>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?php
                    echo form_label('Nombre <b class="text-danger">*</b>', 'nombre');

                    $input = array(
                        'name' => 'nombre',
                        'value' => $nombre,
                        'class' => 'form-control form-control-sm',
                        'data-parsley-required' => 'true'
                    );

                    echo form_input($input);
                    ?>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <?php
                    echo form_label('Apellido paterno <b class="text-danger">*</b>', 'paterno');

                    $input = array(
                        'name' => 'paterno',
                        'value' => $paterno,
                        'class' => 'form-control form-control-sm',
                        'data-parsley-required' => 'true'
                    );

                    echo form_input($input);
                    ?>
                </div>
            </div>

            <div class="col-md-4">
            <div class="form-group">
                <?php
                echo form_label('Apellido materno<b class="text-danger">*</b>', 'materno');

                $input = array(
                    'name' => 'materno',
                    'value' => $materno,
                    'class' => 'form-control form-control-sm',
                    'data-parsley-required' => 'true'
                );

                echo form_input($input);
                ?>
            </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <label>Organismo<b class="text-danger">*</b></label>
                <select class="form-control" id="organismo" name="organismo" data-parsley-required="true">
                <option value="">Seleccionar</option>
                <?php foreach ($organismo as $row) {?>
                    <option value="<?=$row->iIdOrganismo;?>"><?=$row->vOrganismo;?></option>
                <?php } ?>
                </select>
            </div>
            </div>

            <div class="col-md-6">
            <div class="form-group">
                <label for="">Rol<b class="text-danger">*</b> </label>
                <select class="form-control" id="rol" name="rol" data-parsley-required="true" min="1">
                    <option value="0">Seleccione un opción</option>
                    <?=$options_roles;?>
                </select>
            </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                <input type="hidden" name="id_usuario" value="<?=$id_usuario?>">
                    <?php
                    echo form_label('Usuario<b class="text-danger">*</b>', 'usuario');

                    $input = array(
                        'name' => 'usuario',
                        'value' => $usuario,
                        'class' => 'form-control form-control-sm',
                        'data-parsley-required' => 'true'
                    );

                    echo form_input($input);
                    ?>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <?php
                    echo form_label('Contraseña (8 caracteres mínimo)<b class="text-danger">*</b>', 'contrasenia');

                    $input = array(
                        'name' => 'contrasenia',
                        'value' => $contrasenia,
                        'class' => 'form-control form-control-sm',
                        'data-parsley-required' => 'true'
                    );

                    echo form_password($input);
                    ?>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <?php
                    echo form_label('Confirmar contraseña<b class="text-danger">*</b>', 'confirmar');

                    $input = array(
                        'name' => 'confirmar',
                        'value' => '',
                        'class' => 'form-control form-control-sm',
                        'data-parsley-required' => 'true'
                    );

                    echo form_password($input);
                    ?>
                </div>
            </div>
        </div>
        
        <legend>Datos de contacto</legend>
        <div class="row">
            <div class="col-md-4">
            <div class="form-group">
                <?php
                echo form_label('Titulo<b class="text-danger">*</b>', 'titulo');

                $input = array(
                    'name' => 'titulo',
                    'value' => $titulo,
                    'class' => 'form-control form-control-sm',
                    'data-parsley-required' => 'true'
                );

                echo form_input($input);
                ?>
            </div>
            </div>

            <div class="col-md-4">
            <div class="form-group">
                <?php
                echo form_label('Cargo<b class="text-danger">*</b>', 'cargo');

                $input = array(
                    'name' => 'cargo',
                    'value' => $cargo,
                    'class' => 'form-control form-control-sm',
                    'data-parsley-required' => 'true'
                );

                echo form_input($input);
                ?>
            </div>
            </div>

            <div class="col-md-4">
            <div class="form-group">
                <?php
                echo form_label('Celular<b class="text-danger">*</b>', 'celular');

                $input = array(
                    'name' => 'celular',
                    'value' => $celular,
                    'class' => 'form-control form-control-sm',
                    'data-parsley-required' => 'true'
                );

                echo form_input($input);
                ?>
            </div>
            </div>
        </div>

         <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?php
                    echo form_label('Correo principal <b class="text-danger">*</b>', 'correo1');

                    $input = array(
                        'name' => 'correo1',
                        'value' => $correo1,
                        'class' => 'form-control form-control-sm',
                        'data-parsley-required' => 'true'
                    );

                    echo form_input($input);
                    ?>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <?php
                    echo form_label('Correo secundario', 'correo2');

                    $input = array(
                        'name' => 'correo2',
                        'value' => $correo2,
                        'class' => 'form-control form-control-sm'
                    );

                    echo form_input($input);
                    ?>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <?php
                    echo form_label('Telefono', 'telefono');

                    $input = array(
                        'name' => 'telefono',
                        'value' => $telefono,
                        'class' => 'form-control form-control-sm'
                    );

                    echo form_input($input);
                    ?>
                </div>
            </div>
        </div>
       

        <center>
            <button type="submit" class='btn btn-primary'>Guardar</button>
            <button type="button" class="btn btn-white" onclick="filter();">Cancelar</button>
        </center>
    </form>
    <br>
    </div>
    
    </div>
    <script>
        function dataEntry(){
            $.ajax({
                type: "POST",
                url: '<?=base_url()?>C_usuario/guardar',
                data: $("#form").serialize(),
                success: function(response){
                    if(response > 0){
                        $("#contenido").load('<?=base_url()?>C_usuario/listado');
                        swal({
                            icon: 'success',
                            title: 'Exito',
                            text: 'El registro se ha guardado exitosamente',
                            button: false,
                            timer: 1500
                        })
                    }else{
                        swal({
                            icon: 'error',
                            title: 'Algo salio mal',
                            text: 'El registro no se guardó',
                            button: false
                        })
                    }
                }
            });
        }

        function regresar(e){
            if (!e) { var e = window.event; }
            e.preventDefault();

            cargar('<?=base_url();?>C_usuario/listado','#contenido','POST');
        }
       
	function guardar(form,event){
		event.preventDefault();
		var loading;
		if(validarFormulario(form)){
			$.ajax({
		        url: '<?=base_url()?>C_usuario/guardar',
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
		                case "1":
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
</body>
</html>