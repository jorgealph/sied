<html>

<head>
    
</head>

<body>
    <div class="card bg-light" name="capturar" id="capturar">
    <div class="container">
    <div class="col-md-12"> <br>


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

    <?php echo form_open_multipart('controller', 'id="form"');?>
    <div class="row">
        <div class="col-md-4">
        <div class="form-group">
            <input type="hidden" name="id_usuario" value="<?=$id_usuario?>">
                <?php
                echo form_label('Usuario', 'usuario');

                $input = array(
                    'name' => 'usuario',
                    'value' => $usuario,
                    'class' => 'form-control form-control-sm'
                );

                echo form_input($input);
                ?>
            </div></div>

            <div class="col-md-4">
            <div class="form-group">
                <?php
                echo form_label('Contraseña (8 caracteres mínimo)', 'contrasenia');

                $input = array(
                    'name' => 'contrasenia',
                    'value' => $contrasenia,
                    'class' => 'form-control form-control-sm'
                );

                echo form_password($input);
                ?>
            </div></div>

            <div class="col-md-4">
        <div class="form-group">
                <?php
                echo form_label('Confirmar contraseña', 'confirmar');

                $input = array(
                    'name' => 'confirmar',
                    'value' => '',
                    'class' => 'form-control form-control-sm'
                );

                echo form_password($input);
                ?>
            </div></div></div>


            <div class="row">
            <div class="col-md-4">
        <div class="form-group">
                <?php
                echo form_label('Nombre', 'nombre');

                $input = array(
                    'name' => 'nombre',
                    'value' => $nombre,
                    'class' => 'form-control form-control-sm'
                );

                echo form_input($input);
                ?>
            </div></div>

            <div class="col-md-4">
            <div class="form-group">
                <?php
                echo form_label('Apellido paterno', 'paterno');

                $input = array(
                    'name' => 'paterno',
                    'value' => $paterno,
                    'class' => 'form-control form-control-sm'
                );

                echo form_input($input);
                ?>
            </div></div>

            <div class="col-md-4">
            <div class="form-group">
                <?php
                echo form_label('Apellido materno', 'materno');

                $input = array(
                    'name' => 'materno',
                    'value' => $materno,
                    'class' => 'form-control form-control-sm'
                );

                echo form_input($input);
                ?>
            </div></div></div>

            

            <div class="row">
            <div class="col-md-4">
            <div class="form-group">
                <?php
                echo form_label('Correo principal', 'correo1');

                $input = array(
                    'name' => 'correo1',
                    'value' => $correo1,
                    'class' => 'form-control form-control-sm'
                );

                echo form_input($input);
                ?>
            </div></div>

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
            </div></div>

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
            </div></div></div>

            <div class="row">
            <div class="col-md-4">
            <div class="form-group">
                <?php
                echo form_label('Titulo', 'titulo');

                $input = array(
                    'name' => 'titulo',
                    'value' => $titulo,
                    'class' => 'form-control form-control-sm'
                );

                echo form_input($input);
                ?>
            </div></div>

            <div class="col-md-4">
            <div class="form-group">
                <?php
                echo form_label('Cargo', 'cargo');

                $input = array(
                    'name' => 'cargo',
                    'value' => $cargo,
                    'class' => 'form-control form-control-sm'
                );

                echo form_input($input);
                ?>
            </div></div>

            <div class="col-md-4">
            <div class="form-group">
                <?php
                echo form_label('Celular', 'celular');

                $input = array(
                    'name' => 'celular',
                    'value' => $celular,
                    'class' => 'form-control form-control-sm'
                );

                echo form_input($input);
                ?>
            </div></div></div>

            <div class="row">
            <div class="col-md-6">
            <div class="form-group">
            <?php
            echo form_label('Organización', 'organizacion'); echo "<br>";
            $options = array(
            '1' => 'Secretaria Técnica de Planeación y Evaluación'
            );
            echo form_dropdown('organismo', 
            $options, 
            'Secretaria Técnica de Planeación y Evaluación', 
            'class="form-control"'
            ); ?>
    </div></div>

            <div class="col-md-6">
            <div class="form-group">
            <?php
            echo form_label('Rol', 'rol'); echo "<br>";
            $options = array(
            '1' => 'Administrador',
            '2' => 'Evaluador'
            );
            echo form_dropdown('rol', 
            $options, 
            'Administrador', 
            'class="form-control"'
            ); ?>
            </div></div></div>
            <center>
            <button onclick="dataEntry()" type="button" class='btn btn-primary'>Enviar</button>
            <button type="button" class="btn btn-white" onclick="regresar();">Cancelar</button>
            </center>
                <?php echo form_close();?>
    </div> <br>
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
        </script>
</body>

</html>