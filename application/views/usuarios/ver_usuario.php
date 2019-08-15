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
                <?php echo form_open_multipart('');?>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php
                            echo form_label('Usuario', 'usuario');

                            $input = array(
                                'name' => 'usuario',
                                'value' => $usuario,
                                'readonly' => 'readonly',
                                'class' => 'form-control form-control-sm'
                            );

                            echo form_input($input);
                            ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                        <?php
                        echo form_label('Titulo', 'titulo');

                        $input = array(
                            'name' => 'titulo',
                            'value' => $titulo,
                            'readonly' => 'readonly',
                            'class' => 'form-control form-control-sm'
                        );

                        echo form_input($input);
                        ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                        <?php
                        echo form_label('Nombre', 'nombre');

                        $input = array(
                            'name' => 'nombre',
                            'value' => $nombre,
                            'readonly' => 'readonly',
                            'class' => 'form-control form-control-sm'
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
                        echo form_label('Paterno', 'paterno');

                        $input = array(
                            'name' => 'paterno',
                            'value' => $paterno,
                            'readonly' => 'readonly',
                            'class' => 'form-control form-control-sm'
                        );

                        echo form_input($input);
                        ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                        <?php
                        echo form_label('Materno', 'materno');

                        $input = array(
                            'name' => 'materno',
                            'value' => $materno,
                            'readonly' => 'readonly',
                            'class' => 'form-control form-control-sm'
                        );

                        echo form_input($input);
                        ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                        <?php
                        echo form_label('Correo1', 'correo1');

                        $input = array(
                            'name' => 'correo1',
                            'value' => $correo1,
                            'readonly' => 'readonly',
                            'class' => 'form-control form-control-sm'
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
                        echo form_label('Correo2', 'correo2');

                        $input = array(
                            'name' => 'correo2',
                            'value' => $correo2,
                            'readonly' => 'readonly',
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
                            'readonly' => 'readonly',
                            'class' => 'form-control form-control-sm'
                        );

                        echo form_input($input);
                        ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                        <?php
                        echo form_label('Cargo', 'cargo');

                        $input = array(
                            'name' => 'cargo',
                            'value' => $cargo,
                            'readonly' => 'readonly',
                            'class' => 'form-control form-control-sm'
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
                        echo form_label('Celular', 'celular');

                        $input = array(
                            'name' => 'celular',
                            'value' => $celular,
                            'readonly' => 'readonly',
                            'class' => 'form-control form-control-sm'
                        );

                        echo form_input($input);
                        ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                        <?php
                        echo form_label('Organismo', 'organismo');

                        $input = array(
                            'name' => 'celular',
                            'value' => $organismo,
                            'readonly' => 'readonly',
                            'class' => 'form-control form-control-sm'
                        );

                        echo form_input($input);
                        ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                        <?php
                        echo form_label('Rol', 'rol');

                        $input = array(
                            'name' => 'celular',
                            'value' => $rol,
                            'readonly' => 'readonly',
                            'class' => 'form-control form-control-sm'
                        );

                        echo form_input($input);
                        ?>
                        </div>
                    </div>
                </div>

                <script>
                    $("#rol").val(<?php if(isset($rol2)){echo $rol2;}?>);
                    $("#organismo").val(<?php if(isset($organismo2)){echo $organismo2;}?>);
                </script>
                <?php echo form_close();?>
            <legend>Actualizar contraseña</legend>
            <form class="form" onsubmit="guardar(this,event);" id="form-captura" name="form-captura">
                <div class="row">
                    <input type="hidden" name="id_usuario" value="<?=$id_usuario?>">

                    <div class="col-md-6">
                    <div class="form-group">
                        <?php
                        echo form_label('Contraseña (8 caracteres mínimo)<b class="text-danger">*</b>', 'contrasenia');

                        $input = array(
                            'id' => 'contrasenia',
                            'name' => 'contrasenia',
                            'value' => '',
                            'class' => 'form-control form-control-sm',
                            'data-parsley-required' => 'true'
                        );

                        echo form_password($input);
                        ?>
                    </div>
                    </div>

                    <div class="col-md-6">
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

                    <center>
                    <button type="submit" class='btn btn-primary'>Actualizar</button>
                    <button type="button" class="btn btn-white" onclick="regresar();">Cancelar</button>
                    </center>
            </form>
                

                
            
        </div>
    </div>
</body>
<script>
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
		        url: '<?=base_url()?>C_usuario/cambiar_contra',
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

</html>