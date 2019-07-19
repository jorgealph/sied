<a onclick="regresar();" class="btn btn-default pull-right">
                <li class="fas fa-lg fa-fw m-r-10 fa-arrow-left"></li><span>Regresar</span>
            </a>
        <h3 class="page-header">Información general</h3>
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <h4 class="panel-title">Captura de datos</h4>
            </div>
                <div class="panel-body">
                <form class="form" id="form-captura" name="form-captura" onsubmit="dataEntry2(this, event)">
                    <div class="col-md-12">
                        <input type="hidden" name="id_plantilla" value="<?php if(isset($id_plantilla)) echo $id_plantilla;?>">
                        <div class="row">
                            <div class="col-md-2">
                                <label>Crear apartado: </label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="nombre_apartado" id="nombre_apartado" placeholder="" aria-label="" aria-describedby="basic-addon1" data-parsley-required="true"> 
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-info" type="submit"><i class="ti-search"></i>&nbsp;Crear</button>
                            </div>
                        </div>
                    </div> 
                </form>
                </div></div>

                <div class="col-md-12">
                    <div class="row">
                        <h4>Apartados</h4>
                    </div>
                    <hr>
                    <div class="row">
                        <h6>
                            <label>Simbología:   </label>&nbsp;&nbsp;&nbsp;
                            <i class="fas fa-check-circle fa-lg"></i>&nbsp;&nbsp;
                            <label>  Pregunta ditoctómica</label>&nbsp;&nbsp;
                            <i class="fas fa-question-circle fa-lg"></i>&nbsp;&nbsp;
                            <label>  Pregunta abierta </label>
                        </h6>
                    </div>
                </div>

                <div id="apartado"></div>

                <form id="form-captura3">
                        <!-- The Modal -->
                        <div class="modal" id="myModal">
                        <div class="modal-dialog">
                            <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Preguntas</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            
                            <!-- Modal body -->
                            <div class="modal-body">
                            <input type="hidden" name="id2" id="id2">
                            <label>Pregunta: </label>
                                <textarea class="form-control" rows="3" cols="50" class="col-md-12" data-parsley-required="true" id="nombre" name="nombre"><?php if(isset($nombre)){echo $nombre;} ?></textarea>
                                <label>Tipo de pregunta: </label>
                                <select class="form-control" id="tipoP" name="tipoP" data-parsley-required="true">
                            <option value="">Seleccionar</option>
                            <?php foreach ($tipoP as $row) {?>
                                <option value="<?=$row->iIdTipoPregunta;?>"><?=$row->vTipoPregunta;?></option>
                            <?php } ?>
                        </select>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="updatePregunta()">Enviar</button>
                            </div>

                            </div>
                        </div>
                        </div>
                </form>

                <form id="form-captura4" >
                        <!-- The Modal -->
                        <div class="modal" id="myModal3">
                        <div class="modal-dialog">
                            <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Preguntas</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            
                            <!-- Modal body -->
                            <div class="modal-body">
                            <input type="hidden" name="id3" id="id3">
                            <label>Pregunta: </label>
                                <textarea class="form-control" rows="3" cols="50" class="col-md-12" data-parsley-required="true" id="nombreP" name="nombreP"></textarea>
                                <label>Tipo de pregunta: </label>
                                <select class="form-control" id="tipoPR" name="tipoPR" data-parsley-required="true">
                            <option value="">Seleccionar</option>
                            <?php foreach ($tipoP as $row) {?>
                                <option value="<?=$row->iIdTipoPregunta;?>"><?=$row->vTipoPregunta;?></option>
                            <?php } ?>
                        </select>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="insertarPregunta()">Enviar</button>
                            </div>

                            </div>
                        </div>
                        </div>
                </form>

                <!-- The Modal -->
                <form id="form-captura2" name="form-captura">
                <div class="modal" id="myModal2">
                    <div class="modal-dialog">
                        <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Apartados</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id">
                            <label>Nombre del apartado: </label>
                            <textarea class="form-control" rows="3" cols="50" class="col-md-12" data-parsley-required="true" id="nombre2" name="nombre2"></textarea>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="update()">Enviar</button>
                        </div>

                        </div>
                    </div>
                </div>
                </form>
            <script>

            function modal(id){
                $("#id2").val($("#iddos"+id).text());
                $("#nombre").val($("#Pregunta"+id).text());
                $("#tipoP").val($("#tipo"+id).text());
            }

            function modal2(id){
                $("#id").val($("#id"+id).text());
                $("#nombre2").val($("#"+id).text());
            }

            function modal3(id){
                $("#id3").val($("#id"+id).text());
            }

            $("#apartado").load('C_plantilla/GenerarApartado/<?=$id_plantilla?>');

             function regresar(e){
                        if (!e) { var e = window.event; }
                        e.preventDefault();

                        cargar('<?=base_url();?>C_plantilla/index','#contenido','POST');
                    }
                    function pulsar(e) {
  				// averiguamos el código de la tecla pulsada (keyCode para IE y which para Firefox)
  				tecla = (document.all) ? e.keyCode :e.which;
  				// si la tecla no es 13 devuelve verdadero,  si es 13 devuelve false y la pulsación no se ejecuta
  				return (tecla!=13);
			}

            function dataEntry2(form, event){
                event.preventDefault();
                if(validarFormulario(form)){
                    $.ajax({
                        type: "POST",
                        url: '<?=base_url()?>C_plantilla/insertar_apartado',
                        data: $("#form-captura").serialize(),
                        success: function(response){
                            if(response > 0){
                                $("#contenido").load('<?=base_url()?>C_plantilla/guardar_cuestionario/<?=$id_plantilla?>');
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
            }

            function insertarPregunta(){
                
                $.ajax({
                type: "POST",
                url: '<?=base_url()?>C_plantilla/insertar_pregunta',
                data: $("#form-captura4").serialize(),
                success: function(response){
                    if(response > 0){
                       //$("#contenido").load('<?=base_url()?>C_plantilla/guardar_cuestionario');
                       $("#apartado").load('C_plantilla/GenerarApartado/<?=$id_plantilla?>');
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
                            button: false,
                            timer: 1500
                        })
                    }
                }
            });
            }

            function deletePregunta(id){
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
						$.get("<?=base_url()?>C_plantilla/borrar_pregunta/"+id, 
						function(data) {
							if(data == 1){
                                $("#apartado").load('C_plantilla/GenerarApartado/<?=$id_plantilla?>');
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

            function deleteApartado(id){
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
						$.get("<?=base_url()?>C_plantilla/borrar_apartado/"+id, 
						function(data) {
							if(data == 1){
                                $("#apartado").load('C_plantilla/GenerarApartado/<?=$id_plantilla?>');
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

            function update(id){
				$.ajax({
    				// la URL para la petición
    				url : '<?=base_url()?>C_plantilla/ActualizarApartado/'+id,
					// la información a enviar
    				// (también es posible utilizar una cadena de datos)
    				data : $("#form-captura2").serialize(),

    				// especifica si será una petición POST o GET
    				type : 'POST',

    				// el tipo de información que se espera de respuesta
    				/*dataType : 'json',*/

    				// código a ejecutar si la petición es satisfactoria;
    				// la respuesta es pasada como argumento a la función
    				success : function(data) {
        				//alert(data);
                        swal({
                                        icon: 'success',
                                        title: 'Exito',
                                        text: 'El registro se ha guardado exitosamente',
                                        button: false,
                                        timer: 1500
                                    })
                                    $("#apartado").load('C_plantilla/GenerarApartado/<?=$id_plantilla?>');},
					
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

            function updatePregunta(id){
				$.ajax({
    				// la URL para la petición
    				url : '<?=base_url()?>C_plantilla/ActualizarPregunta/'+id,
					// la información a enviar
    				// (también es posible utilizar una cadena de datos)
    				data : $("#form-captura3").serialize(),

    				// especifica si será una petición POST o GET
    				type : 'POST',

    				// el tipo de información que se espera de respuesta
    				/*dataType : 'json',*/

    				// código a ejecutar si la petición es satisfactoria;
    				// la respuesta es pasada como argumento a la función
    				success : function(data) {
        				//alert(data);
                        swal({
                                        icon: 'success',
                                        title: 'Exito',
                                        text: 'El registro se ha guardado exitosamente',
                                        button: false,
                                        timer: 1500
                                    })
                                    $("#apartado").load('C_plantilla/GenerarApartado/<?=$id_plantilla?>');},
					
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
            </script>