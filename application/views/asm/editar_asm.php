<a onclick="regresar();" class="btn btn-default pull-right">
                <li class="fas fa-lg fa-fw m-r-10 fa-arrow-left"></li><span>Regresar</span>
            </a>
        <h3 class="page-header">Información general</h3>
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <h4 class="panel-title">Captura de datos</h4>
            </div>
            <div class="panel-body">
            <form class="form" id="form-captura" name="form-captura" onkeypress="return pulsar(event)">
                <div class="col-md-12">
                <input type="hidden" name="iIdASM" id="iIdASM" value="<?php if(isset($iIdASM)) echo $iIdASM;?>">
                <div class="row">
                    <div class="col-md-6">
                        <label>Nombre del ASM: </label>
                    </div>
                </div>.                <div class="row">
                    <div class="col-md-6">
                        <label>Nombre del ASM: </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Nombre del ASM: </label>
                    </div>
                </div>
                </div> 
                    <div class="row">
                        <div class="col-md-12" >
                            <textarea class="form-control" rows="2" cols="50" class="col-md-12" data-parsley-required="true" id="nombre" name="nombre"><?php if(isset($nombre)){echo $nombre;} ?></textarea> 
                        </div>
                    </div>
                    <br>

                <div class="row">
                    <div class="col-md-4">
                    <label>Año de la evaluación: </label>
                    <input type="text" id="anio" name="anio" class="form-control" maxlength="4" oninput="this.value=this.value.replace(/[^0-9]/g,'');" value="<?php if(isset($anio)){echo $anio;} ?>">
                    </div>
                <div class="col-md-4">
                <label>Prioridad: </label>
                <select class="form-control" id="prioridad" name="prioridad" <?php if(isset($iPrioridad)){echo $iPrioridad;} ?> data-parsley-required="true">
                    <option <?php if(isset($iPrioridad) && $iPrioridad == 1) echo 'selected'; ?> value="1">Bajo</option>
                    <option <?php if(isset($iPrioridad) && $iPrioridad == 2) echo 'selected'; ?> value="2">Media</option>
                    <option <?php if(isset($iPrioridad) && $iPrioridad == 3) echo 'selected'; ?> value="3">Alta</option>
                    <option <?php if(isset($iPrioridad) && $iPrioridad == 4) echo 'selected'; ?> value="4">Muy alta</option>
                </select>
                </div>
                <div class="col-md-4">
                <label>Clasificación: </label>
                <select class="form-control" id="clasificacion" name="clasificacion" data-parsley-required="true">
                    <option <?php if(isset($iClasificacion) && $iClasificacion == 1) echo 'selected'; ?> value="1">Especifico</option>
                    <option <?php if(isset($iClasificacion) && $iClasificacion == 2) echo 'selected'; ?> value="2">Institucional</option>
                    <option <?php if(isset($iClasificacion) && $iClasificacion == 3) echo 'selected'; ?> value="3">Interinstitucional</option>
                    <option <?php if(isset($iClasificacion) && $iClasificacion == 4) echo 'selected'; ?> value="4">Intergubernamental</option>
                </select>
                <script>
                    $("#prioridad").val(<?php if(isset($prioridad2)){echo $prioridad2;}?>);
                    $("#clasificacion").val(<?php if(isset($clasificiacion2)){echo $clasificiacion2;}?>);
                    $("#programa").val(<?php if(isset($programa2)){echo $programa2;}?>);
                </script>
                </div>
            </div> 
<br>
            <div class="row">
                <div class="col-md-4">
                    <label>Tipo de intervención:  </label>
                    <select name="tipoI" id="tipoI" class="form-control" onchange="getIntervencion()">
                        <option value="0">-Todos-</option>
                        <option value="1">Programa Presupuestario</option>
                        <option value="2">Fondo</option>
                        <option value="3">Programa de bienes o servicios</option>
					</select>            
                </div>
                <div class="col-md-4">
                    <label>Dependencia: </label>
                    <select name="dependencia" id="dependencia" class="form-control" onchange="getIntervencion()">
                        <option value="">-Todos-</option>
                        <?php
                            foreach($dependencia as $r){
                                echo "<option value='$r->iIdOrganismo'>$r->vOrganismo</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-4">
                <label>Eje: </label>
                <select class="form-control" id="eje" name="eje" <?php if(isset($iOrigenEvaluacion)){echo $iOrigenEvaluacion;} ?> data-parsley-required="true" onchange="getIntervencion()">
                <?php
                    foreach($eje as $r){
                        echo "<option value='$r->iIdEje'>$r->vEje</option>";
                    }
                    ?>
                </select>
                </div>
            </div> 
<br>
            <div class="col-md-12">
                <div class="row">
                    <label>Programa de bienes o servicios evaluado: </label>
                    <select class="form-control" id="programa" name="programa" data-parsley-required="true">
                        
                      
                    </select>
                </div>
            </div> 
<br>
            <div class="row">
                <div class="col-md-12" >
                    <label>Propósito: </label>
                    <textarea readonly="readonly" class="form-control" rows="2" cols="50" class="col-md-12" data-parsley-required="true" id="proposito" name="proposito"><?php if(isset($nombre)){echo $nombre;} ?></textarea> 
                </div>
            </div>
<br>
            <center>
                <button type="button" onclick="<?php echo (isset($iIdASM)) ? 'update()': 'de()'; ?>" class='btn btn-primary'>Enviar</button>
            </center>
        </form> 

        <script>
            function regresar(e){
                if (!e) { var e = window.event; }
                e.preventDefault();

                cargar('<?=base_url();?>C_asm/display','#contenido','POST');
            }

            function getIntervencion(){
                        var formData = new FormData();
                        formData.append('tipoI', $("#tipoI").val());                        
                        formData.append('dependencia', $("#dependencia").val());
                        formData.append('eje', $("#eje").val());
                        var url = "C_asm/drawIntervencion";
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: formData,
                            async: false,
                            success: function(data){
                                $("#programa").html(data);
                                //console.log(data);
                            },
                            cache:false,
                            contentType: false,
                            processData: false
                        });
                    }

            function de(){
                $.ajax({
                    type: "POST",
                    url: '<?=base_url()?>C_asm/insertar_asm',
                    data: $("#form-captura").serialize(),
                    success: function(response){
                        if(response > 0){
                            $("#contenido").load('<?=base_url()?>C_asm/guardar_asm');
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

            function update(id){
				$.ajax({
    				// la URL para la petición
    				url : '<?=base_url()?>C_asm/actualizar_asm/'+id,
					// la información a enviar
    				// (también es posible utilizar una cadena de datos)
    				data : $("#form-captura").serialize(),

    				// especifica si será una petición POST o GET
    				type : 'POST',

    				// el tipo de información que se espera de respuesta
    				/*dataType : 'json',*/

    				// código a ejecutar si la petición es satisfactoria;
    				// la respuesta es pasada como argumento a la función
    				success : function(data) {
        				swal({
                                        icon: 'success',
                                        title: 'Exito',
                                        text: 'El registro se ha guardado exitosamente',
                                        button: false,
                                        timer: 1500
                                    })
    				},
					//console.log(data);
					/* código a ejecutar si la petición falla;
    				son pasados como argumentos a la función
    				el objeto de la petición en crudo y código de estatus de la petición*/
    				error : function(xhr, status) {
        				swal(`La operación no pudo concluirse`, 'Intente nuevamente', 'error',
						{
							buttons: false,
							timer: 1500
						});
    				},

    				// código a ejecutar sin importar si la petición falló o no
    				/*complete : function(xhr, status) {
        				alert('Petición realizada');
					}*/
				});
			}

            function deleteRow(id){
				swal({
  					title: "¿Estás seguro?",
  					text: "Una vez eliminado, este registro no se puede recuperar",
  					icon: "warning",
  					buttons: true,
					buttons: ['Cancelar', 'Aceptar'],
  					dangerMode: true,
				})
				.then((willDelete) => {
  					if (willDelete) {
						$.get("<?=base_url()?>C_asm/borrarAsm/"+id, 
						function(data) {
							if(data == 1){
								//$("#contenido").load('<?=base_url()?>C_plantilla/guardar_plantilla');
                                $("#table").load('C_asm/display');
								swal("El registro ha sido eliminado correctamente", {
									title: 'Exito',
      								icon: "success",
									button: false,
  									timer: 1500
    							});
								
							}else{
								swal("El registro no pudo eliminarse", {
									title: 'Error',
      								icon: "error",
									button: false,
  									timer: 1500
    							});
							}
						});
  					}
				});
			}
        </script>