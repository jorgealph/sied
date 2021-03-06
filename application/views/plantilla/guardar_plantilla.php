<link href="<?=base_url()?>admin/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="<?=base_url()?>admin/assets/plugins/select2/dist/select2-bootstrap4.css">

        <a onclick="filter();" class="btn btn-default pull-right">
                <li class="fas fa-lg fa-fw m-r-10 fa-arrow-left"></li><span>Regresar</span>
            </a>
        <h3 class="page-header panel-contenido">Información general</h3>
    <div class="panel panel-inverse panel-contenido">
        <div class="panel-heading panel-contenido">
            <h4 class="panel-title">Captura de datos</h4>
            </div>
            <div class="panel-body">
            <form class="form panel-contenido" id="form-captura" name="form-captura" onkeypress="return pulsar(event)">
                <div class="row">
                    <div class="col-md-12" >
                        <input type="hidden" name="id_plantilla" value="<?php if(isset($iIdPlantilla)) echo $iIdPlantilla;?>">
                        <label>Nombre de la plantilla:</label>
                        <textarea class="form-control" rows="3" cols="50" class="col-md-12" data-parsley-required="true" id="nombre" name="nombre"><?php if(isset($nombre)){echo $nombre;} ?></textarea> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                    <label>Año de la evaluación: </label>
                    <select class="form-control" id="anio" name="anio" data-parsley-required="true">
                        <option <?php if(isset($iAnioEvaluacion) && $iAnioEvaluacion == '2019') echo 'selected'; ?> value="2019">2019</option>
                        <option <?php if(isset($iAnioEvaluacion) && $iAnioEvaluacion == '2018') echo 'selected'; ?> value="2018">2018</option>
                        <option <?php if(isset($iAnioEvaluacion) && $iAnioEvaluacion == '2017') echo 'selected'; ?> value="2017">2017</option>
                        <option <?php if(isset($iAnioEvaluacion) && $iAnioEvaluacion == '2016') echo 'selected'; ?> value="2016">2016</option>
                        <option <?php if(isset($iAnioEvaluacion) && $iAnioEvaluacion == '2015') echo 'selected'; ?> value="2015">2015</option>
                        <option <?php if(isset($iAnioEvaluacion) && $iAnioEvaluacion == '2014') echo 'selected'; ?> value="2014">2014</option>
                    </select>
                    </div>
                <div class="col-md-4">
                <label>Origen de la envaluación: </label>
                <select class="form-control" id="origen" name="origen" <?php if(isset($iOrigenEvaluacion)){echo $iOrigenEvaluacion;} ?> data-parsley-required="true">
                    <option <?php if(isset($iOrigenEvaluacion) && $iOrigenEvaluacion == 1) echo 'selected'; ?> value="1">Externa</option>
                    <option <?php if(isset($iOrigenEvaluacion) && $iOrigenEvaluacion == 1) echo 'selected'; ?> value="1">Externa</option>
                    <option <?php if(isset($iOrigenEvaluacion) && $iOrigenEvaluacion == 2) echo 'selected'; ?> value="2">Interna</option>
                </select>
                </div>
                <div class="col-md-4">
                <label>Tipo de evaluación: </label>
                <select class="form-control" id="tipo" name="tipo" data-parsley-required="true">
                    <?php foreach ($tipo as $row) {?>
                        <option value="<?=$row->iIdTipoEvaluacion;?>"><?=$row->vTipoEvaluacion;?></option>
                    <?php } ?>
                </select>
                <script>
                    $("#tipo").val(<?php if(isset($tipo2)){echo $tipo2;}?>);
                    $("#anio").val(<?php if(isset($buscar)){echo $buscar;}?>);
                    $("#origen").val(<?php if(isset($origen2)){echo $origen2;}?>);
                </script>
                </div>
            </div> 
        </form> 
         
            <div class="row">
                <div class="col-md-12">
                    <h3><br> Tipo de intervención pública</h3>
                    <hr>
                </div>
            </div>
                
                    <div class="row">
                        <div class="col-md-4">
                            <label>Año: </label>
                            <select class="form-control" id="anio2" name="anio2" onchange="getIntervencion()">
                                <option value="0">Seleccionar</option>
                            <?php foreach ($anio2 as $row) {?>
                                <option value="<?=$row->iAnio;?>"><?=$row->iAnio;?></option>
                            <?php } ?>
                            </select>
                    </div>
                    <div class="col-md-4">
                        <label>Eje: </label>
                        <select class="form-control" id="eje" name="eje" onchange="loadDependencia()">
                            <option value="0">Seleccionar</option>
                            <?php foreach ($eje as $row) {?>
                                <option value="<?=$row->iIdEje;?>"><?=$row->vEje;?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Dependencia: </label>
                        <select class="form-control" id="dependencia" name="dependencia" onchange="getIntervencion()">
                            <option value="">Seleccionar</option>
                            
                        </select>
                    </div> 
                    
                <div class="col md-12"> <br>
                    <div class="row">
                        <div class="col-md-4">
                        <label>Tipo: </label>
                        <select class="form-control" id="tipo2" name="tipo2" onchange="getIntervencion()">
                        <option value="0">-Todos-</option>
								<option value="1">Programa presupuestario</option>
                                <option value="2">Fondo</option>
                                <option value="3">Programa de bienes o servicio</option>
                        </select>
                    </div>        
                    <div class="col-md-4">
                        <label>Nombre: </label>
                        <select class="form-control" id="intervencion" name="intervencion" data-parsley-required="true">
                            <option value="0">Seleccionar</option>
                        
                        </select>
                    </div>        
                <button class="btn btn-success" type="button" onclick="<?php echo (isset($iIdPlantilla)) ? 'setIntervencionCambio()': 'setIntervencion()'?>" style="margin-top:25px;"><i class="fas fa-lg fa-fw m-r-10 fa-plus-circle"></i>Agregar intervención pública</button>
               <!--  <button class="btn btn-success col-md-4" type="button" name="guardar" id="guardar" onclick="<?php echo (isset($iIdPlantilla)) ? 'setIntervencionCambio()': 'setIntervencion()'?>" style="margin-top:25px; color: white;"><i class="fas fa-lg fa-fw m-r-10 fa-plus-circle" style="color: white"></i>Agregar intervención pública</button> -->
            </div>
        </div>
    </div> <br>

    <div id="table"></div>
    <div id="bo"></div>

    <center>
        <button type="button" onclick="<?php echo (isset($iIdPlantilla)) ? 'update()': 'dataEntry()'; ?>" class='btn btn-primary'>Guardar</button>
    </center>
    
<!--
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
-->
<script src="<?=base_url()?>admin/assets/plugins/select2/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>

<script>
    $("#table").load('C_plantilla/GenerateTable');
    
    function loadDependencia(){
    	var value = $("#eje").val();
    	$("#dependencia").load('C_intervencionpropuesta/dependenciaQuery/'+value);
	}

    function dataEntry(){
        if( $("#form-captura").parsley().validate() ){
            $.ajax({
                // la URL para la petición
                url : '<?=base_url()?>C_plantilla/insertar_plantilla',
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
                    //alert(data);
                    if(data>0){
                       // $("#id_plantilla").val(data);
                       swal({
                                    icon: 'success',
                                    title: 'Exito',
                                    text: 'El registro se ha guardado exitosamente',
                                    button: false,
                                    timer: 1500
                                })
                    }
                },
                
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
    }

    function update(id){
        if( $("#form-captura").parsley().validate() ){
            $.ajax({
                // la URL para la petición
                url : '<?=base_url()?>C_plantilla/ActualizarPlantilla/'+id,
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
    }
    
    function de(){
        $.ajax({
            type: "POST",
            url: '<?=base_url()?>C_plantilla/insertar_plantilla',
            data: $("#form-captura").serialize(),
            success: function(response){
                if(response > 0){
                    $("#contenido").load('<?=base_url()?>C_plantilla/index');
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
            
    

        
            function getIntervencion(){
                var formData = new FormData();
                formData.append('anio2', $("#anio2").val());
                formData.append('dependencia', $("#dependencia").val());
                formData.append('tipo', $("#tipo2").val());
                var url = "C_plantilla/drawIntervencion";
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    async: false,
                    success: function(data){
                        $("#intervencion").html(data);
                    },
                    cache:false,
                    contentType: false,
                    processData: false
                });
            }
            

            function setIntervencion(){
                if ($('#intervencion').val().trim() == '0') {
                    swal("Debe seleccionar una opción", {
							title: 'Error',
								icon: "error",
							button: false,
								timer: 1500
						});

                }else{
                    var formData = new FormData();
                            formData.append('intervencion', $("#intervencion").val());
                            var url = "C_plantilla/tempIntervencion";
                            $.ajax({
                                url: url,
                                type: 'POST',
                                data: formData,
                                async: false,
                                success: function(data){
                                    if(data == 1){
                                        $("#table").load('C_plantilla/GenerateTable');
                                    }else{
                                        $("#table").load('C_plantilla/GenerateTable');
                                        swal("Ya ha sido agregada", {
							title: 'Error',
								icon: "error",
							button: false,
								timer: 1500
						});
                                        //$("#table").load('C_plantilla/GenerateTable');
                                    }
                                },
                                cache:false,
                                contentType: false,
                                processData: false
                            });
                }
            }

            function setIntervencionCambio(){
                if ($('#intervencion').val().trim() == '0') {
                    swal("Debe seleccionar una opción", {
							title: 'Error',
								icon: "error",
							button: false,
								timer: 1500
						});

                }else{
                    var formData = new FormData();
                            formData.append('intervencion', $("#intervencion").val());
                            var url = "C_plantilla/tempIntervencionCambio";
                            $.ajax({
                                url: url,
                                type: 'POST',
                                data: formData,
                                async: false,
                                success: function(data){
                                    if(data == 1){
                                        $("#table").load('C_plantilla/GenerateTable');
                                    }else{
                                        swal("Ya ha sido agregada", {
							title: 'Error',
								icon: "error",
							button: false,
								timer: 1500
						});
                                        //$("#table").load('C_plantilla/GenerateTable');
                                    }
                                },
                                cache:false,
                                contentType: false,
                                processData: false
                            });
                }
            }

            $(document).ready(function() {
                
            });

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
            
    function deleteRowIntervencion(id){
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
				$.get("<?=base_url()?>C_plantilla/borrar_registro/"+id, 
				function(data) {
					if(data == 1){
						//$("#contenido").load('<?=base_url()?>C_plantilla/guardar_plantilla');
                        $("#table").load('C_plantilla/GenerateTable');
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

    function guardarCorresponsable(id){
        
        var corresponsables = $("#select"+id).val();

        $.ajax({
            url: '<?=base_url()?>index.php/C_plantilla/guardarCorresponsable',
            type: 'POST',
            data: 'idintervencion='+id+'&corresponsables='+corresponsables,
            async: false,
            success: function(data){
                
            }
        });
    }
</script>
