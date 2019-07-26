<html>

<head>
    
</head>

<body>
<a onclick="regresar();" class="btn btn-default pull-right">
                <li class="fas fa-lg fa-fw m-r-10 fa-arrow-left"></li><span>Regresar</span>
            </a>
<h3 class="page-header">Información general</h3>
<div class="panel panel-inverse">
<div class="panel-heading">
            <h4 class="panel-title">Captura de datos</h4>
            </div>
    <div class="card bg-light" name="capturar" id="capturar">
    <div class="container">
    <div class="col-md-12"> <br>


   
    <form class="form" onsubmit="guardar(this,event);" id="form-captura" name="form-captura">
    <div class="row">
        <div class="col-md-4">
        <div class="form-group">
            <input type="hidden" name="id_usuario" value="<?=$id_usuario?>">
                <?php
                echo form_label('Usuario', 'usuario');
                $input = array(
                    'name' => 'usuario',
                    'value' => $usuario,
                    'class' => 'form-control form-control-sm',
                    'data-parsley-required' => 'true'
                );

                echo form_input($input);
                ?>
            </div> </div>
            <div class="col-md-4">
            <div class="form-group">
            <label>Dependecia: </label>
            <select class="form-control" id="organismo" name="organismo">
            <!-- <option value="">Seleccionar</option> -->
            <?php foreach ($organismo as $row) {?>
                <option value="<?=$row->iIdOrganismo;?>"><?=$row->vOrganismo;?></option>
            <?php } ?>
            </select>
    </div></div>

            <div class="col-md-4">
            <div class="form-group">
            <label for="">Rol: </label>
            <select class="form-control" id="rol" name="rol" data-parsley-required="true" min="1">
                <option value="0">Seleccione un opción</option>
                <?=$options_roles;?>
            </select>
            </div></div></div>

            <script>
                    $("#rol").val(<?php if(isset($rol2)){echo $rol2;}?>);
                    $("#organismo").val(<?php if(isset($organismo2)){echo $organismo2;}?>);
                </script>

            <div class="row">
            <div class="col-md-4">
        <div class="form-group">
                <?php
                echo form_label('Nombre', 'nombre');

                $input = array(
                    'name' => 'nombre',
                    'value' => $nombre,
                    'class' => 'form-control form-control-sm',
                    'data-parsley-required' => 'true'
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
                    'class' => 'form-control form-control-sm',
                    'data-parsley-required' => 'true'
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
                    'class' => 'form-control form-control-sm',
                    'data-parsley-required' => 'true'
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
                    'class' => 'form-control form-control-sm',
                    'data-parsley-required' => 'true'
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
                    'class' => 'form-control form-control-sm',
                    'data-parsley-required' => 'true'
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
                    'class' => 'form-control form-control-sm',
                    'data-parsley-required' => 'true'
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
                    'class' => 'form-control form-control-sm',
                    'data-parsley-required' => 'true'
                );

                echo form_input($input);
                ?>
            </div></div></div>


            <center>
            <button type="submit" class='btn btn-primary'>Guardar</button>
            </center>
            </form>
    </div> <br>
    </div>
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

        <script type="text/javascript">
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