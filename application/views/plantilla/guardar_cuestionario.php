            <style>
                .custom-file-label::after{
                    content: "Seleccionar";
                }
			</style>
            <a onclick="filter();" class="btn btn-default pull-right">
                <li class="fas fa-lg fa-fw m-r-10 fa-arrow-left"></li><span>Regresar</span>
            </a>
            <h3 class="page-header">Información general</h3>
			    	<!-- begin nav-tabs -->
					<ul class="nav nav-tabs nav-tabs-inverse">
						<li class="nav-items">
							<a href="#default-tab-1" data-toggle="tab" class="nav-link active">
								<span class="d-sm-none">Tab 1</span>
								<span class="d-sm-block d-none">Capturar datos</span>
							</a>
						</li>
						<li class="nav-items">
							<a href="#default-tab-2" data-toggle="tab" class="nav-link">
								<span class="d-sm-none">Tab 2</span>
								<span class="d-sm-block d-none">Importar datos</span>
							</a>
						</li>
					</ul>
					<!-- end nav-tabs -->
					<!-- begin tab-content -->
					<div class="tab-content">
						<!-- begin tab-pane -->
						<div class="tab-pane fade" id="default-tab-2">
                            <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-2">
                                    <!-- <label> </label> -->
                                    <a href="<?=base_url();?>files/preguntas.csv" class="btn btn-info">Descargar plantilla</a>
                                </div>
                                <div class="col-md-8">
                                    <input type="file" class="custom-file-input form-control" id="file" name="file" accept=".csv" lang="es">
									<label class="custom-file-label" for="file">Seleccionar archivo</label>
                                </div>
                                <div class="col-md-2">
                                    <button style="height:38px;" onclick="importar_cuestionario()" class="btn btn-info" type="button"><i class="ti-search"></i>&nbsp;Importar apartados y preguntas</button>
                                </div>
                            </div>
                        </div> 
						</div>
						<!-- end tab-pane -->
						<!-- begin tab-pane -->
						<div class="tab-pane fade active show" id="default-tab-1">
                            <input type="hidden" name="iIdApartado" id="iIdApartado" value="0">
                            <input type="hidden" name="iIdPregunta" id="iIdPregunta" value="0">
                            <form class="form" id="form-captura" name="form-captura" onsubmit="dataEntry2(this, event)">
                                <div class="col-md-12">
                                    <input type="hidden" name="id_plantilla" value="<?php if(isset($id_plantilla)) echo $id_plantilla;?>">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>Nombre del apartado:</label>
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
						</div>
						<!-- end tab-pane -->
					</div>
					
                <div class="col-md-12">
                    <div class="row">
                        <h4>Apartados</h4>
                    </div>
                </div>

                <div id="apartado"></div>

                <!-- FORM nueva pregunta -->
                <form id="form-captura4" >
                    <div class="modal" id="myModal3">
                    <div class="modal-dialog">
                        <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Captura de datos</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        
                        <!-- Modal body -->
                        <div class="modal-body">
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
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" onclick="insertarPregunta()">Guardar</button>
                        </div>

                        </div>
                    </div>
                    </div>
                </form>
                <!-- FORM editar pregunta -->
                <form id="form-captura3">
                    <div class="modal" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Captura de datos</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        
                        <!-- Modal body -->
                        <div class="modal-body">
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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" onclick="updatePregunta()">Guardar</button>
                        </div>

                        </div>
                    </div>
                    </div>
                </form>

                <!-- FORM editar apartado -->
                <form id="form-captura2" name="form-captura">
                <div class="modal" id="myModal2">
                    <div class="modal-dialog">
                        <div class="modal-content">                        
                            <div class="modal-header">
                                <h4 class="modal-title">Captura de datos</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                           
                            <div class="modal-body">
                                <label>Nombre del apartado: </label>
                                <textarea class="form-control" rows="3" cols="50" class="col-md-12" data-parsley-required="true" id="nombre2" name="nombre2"></textarea>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" onclick="updateApartado()">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            <script>                
            $("#apartado").load('C_plantilla/GenerarApartado/<?=$id_plantilla?>');
            // Add the following code if you want the name of the file appear on select
            $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });

            function agregarPregunta(iIdApartado){
                $("#iIdApartado").val(iIdApartado);
            }

            function editarPregunta(iIdPregunta){
                $("#iIdPregunta").val(iIdPregunta);
                $("#nombre").val($("#Pregunta"+iIdPregunta).text());
                $("#tipoP").val($("#tipo"+iIdPregunta).text());
            }

            function editarApartado(iIdApartado,e){
                e.preventDefault();
               
                $("#iIdApartado").val(iIdApartado);
                $("#nombre2").val($("#nombreApartado"+iIdApartado).text());
                $("#myModal2").modal();
            }

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
                    data: $("#form-captura4").serialize()+'&iIdApartado='+$("#iIdApartado").val(),
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

            function updatePregunta(){
                $.ajax({
                    // la URL para la petición
                    url : '<?=base_url()?>C_plantilla/ActualizarPregunta',
                    // la información a enviar
                    // (también es posible utilizar una cadena de datos)
                    data : $("#form-captura3").serialize() + '&iIdPregunta=' + $("#iIdPregunta").val(),

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

            function updateApartado(){
				$.ajax({
    				// la URL para la petición
    				url : '<?=base_url()?>C_plantilla/ActualizarApartado/',
					// la información a enviar
    				// (también es posible utilizar una cadena de datos)
    				data : $("#form-captura2").serialize()+'&iIdApartado='+$("#iIdApartado").val(),

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

            

            function importar_cuestionario(){
				//var myFile = $('#file').prop('files')[0];
				//var myFile = $("#file").val().replace(/.*(\/|\\)/, '');
				var formData = new FormData();
				formData.append('file', $('input[type=file]')[0].files[0])
				formData.append('iIdPlantilla', <?=$id_plantilla?>);
				
				$.ajax({
        			url: '<?=base_url()?>C_pregunta/csvtodb',
        			type: 'POST',
        			data: formData,
        			async: false,
                    dataType: 'json',
        			success: function (json) {
            			console.log(json);
                        var error = json['error'];
                        var log = "";
                        
                        if(json['msg'] > 0){
                            notificacion("Se han agregado " + json['msg'] + " preguntas", "success");
                        }
                        $.each(error,function(index, value){
                            log += "Fila: " + value + "\n";
                        });
                        if(log != ''){
                            swal({
                                text: log,
                                title: "Error al capturar las siguientes filas",
                                icon: "error",
                                closeOnClickOutside: false,
                                closeOnEsc: false
                            });
                        }
                        if(json['falla'] > 0){
                            notificacion("Hay un error en el documento", "error");
                        }else{
                            cargar('<?=base_url()?>C_plantilla/guardar_cuestionario/<?=$id_plantilla?>/1','#contenido');
                        }
        			},
        			cache: false,
        			contentType: false,
        			processData: false
   				});
			}

            </script>