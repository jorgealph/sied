
			<link href="<?=base_url()?>admin/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
            <link href="<?=base_url()?>admin/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css" rel="stylesheet" />
            <link href="<?=base_url()?>admin/assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
            <!-- begin breadcrumb -->
			<a onclick="cargar('ver/evaluacion', '#contenido')" class="btn btn-default pull-right">
                <li class="fas fa-lg fa-fw m-r-10 fa-arrow-left"></li><span>Regresar</span>
            </a>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Evaluaciones <!--<small>header small text goes here...</small>--></h1>
			<!-- end page-header -->
			
			<!-- begin panel -->
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					</div>
					<h4 class="panel-title">Captura de conclusiones</h4>
				</div>
				<div class="panel-body">
                    <div class="container">
                        <form method="post" id="form" onsubmit="addConclusion(this,event);">
                            <input type="hidden" id="key">
                            <div class="form-group row m-b-15">
                                <label class="col-form-label col-md-1">Apartado: </label>
                                <div class="col-md-11">
                                    <select class="form-control" onchange="obtener_preguntas()" name="iIdApartado" id="iIdApartado">
                                        <?=$apartado?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row m-b-15">
                                <label class="col-form-label col-md-1"><span class="text-danger">*</span> Pregunta: </label>
                                <div class="col-md-11">
                                    <select class="form-control" name="iIdPregunta" id="iIdPregunta" data-parsley-required>
                                        <option value="">-SELECCIONA UNA PREGUNTA-</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row m-b-15">
                                <label class="col-form-label col-md-1"><span class="text-danger">*</span> Tipo: </label>
                                <div class="col-md-5">
                                    <select class="form-control" data-parsley-required name="iIdTipoConclusion" id="iIdTipoConclusion">
                                        <?=$tipo?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row m-b-15">
                                <div class="col-md-6">
                                    <label for="nombre"> <span class="text-danger">*</span> Conclusiones:</label>
                                    <textarea name="vConclusion" data-parsley-required id="vConclusion" rows="5" class="form-control"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="nombre">Recomendaciones:</label>
                                    <textarea name="vRecomendacion" id="vRecomendacion" rows="5" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group row m-b-15">
                                <div class="col-md-2 offset-md-4">
                                    <button class="btn btn-success form-control" style="margin-top:25px;" type="submit">
                                        <li class="fa fa-lg fa-fw m-r-10 fa-plus"></li>
                                        <span>Agregar</span>
                                    </button>
                                </div>

                                <div class="col-md-2">
                                    <button class="btn btn-danger form-control" style="margin-top:25px;" type="reset">
                                        <li class="fa fa-lg fa-fw m-r-10 fa-window-close"></li>
                                        <span>Cancelar</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive" id="table">
                            <?=$tb?>
                        </div>
                    </div>
                </div>
			</div>
			<!-- end panel -->
		</div>
        <!-- end #content -->
        
        <script>
            function addConclusion(form, event){
                event.preventDefault();
                if(validarFormulario(form)){
                    var key = $("#key").val();
                    var datos = $(form).serialize(); // convert form to array
                    if(key != null && key != ''){
                        var url = '<?=base_url()?>C_conclusion/updateConclusion';
                        datos += '&key='+key;
                    }else{
                        var url = '<?=base_url()?>C_conclusion/addConclusion';
                        datos += '&key=<?=$key?>';
                    }
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: datos,
                        async: false,
                        dataType: 'json',
                        success: function(response){
                            if(response > 0){
                                if(key != null && key != ''){
                                    notificacion('Actualización exitosa','success');
                                    $("#key").val(null);
                                }else{
                                    notificacion('Se ha agregado la conclusión exitosamente','success');
                                }
                                $("#table").load('<?=base_url()?>/C_conclusion/generateTable/<?=$key?>/1');
                                $("#form").trigger('reset');
                                $("#iIdPregunta").empty().append('<option selected="selected" value="">-SELECCIONE UNA PREGUNTA-</option>');
                            }else{
                                notificacion('Ha ocurrido un error','error');
                            }
                        },
                        cache:false,
                        //contentType: 'application/json',
                        processData: false
                    })
                }
            }
            function obtener_preguntas(){
                var key = $("#iIdApartado").val();
                var url = '<?=base_url()?>C_conclusion/obtener_preguntas';
                var formData = new FormData();
                formData.append('key', key);
                //console.log(key);
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    async: false,
                    //dataType: 'json',
                    success: function(response){
                        $("#iIdPregunta").html(response);
                    },
                    cache:false,
                    contentType: false,
                    processData: false
                })
            }
            function doSomething(checkox, key){
                var formData = new FormData();
                formData.append('key', key);
                if (checkox.checked) {
                    formData.append('iASM', 1);
                } else {
                    formData.append('iASM', 0);
                }
                var url = '<?=base_url()?>C_conclusion/actualizar_asm';
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    async: false,
                    //dataType: 'json',
                    success: function(response){
                        if (response > 0){
                            notificacion('Se ha actualizado el registro','success');
                        }else{
                            notificacion('Ha ocurrido un error','error');
                        }
                        $("#table").load('<?=base_url()?>/C_conclusion/generateTable/<?=$key?>/1');
                    },
                    cache:false,
                    contentType: false,
                    processData: false
                })
            }

            function deleteRecord(key){
                swal({
                    title: "¿Estás seguro que deseas continuar?",
                    text: "Una vez eliminado el registro, no lo podras recuperar",
                    icon: "warning",
                    buttons: ["Cancelar", "Eliminar"],
                    dangerMode: true,
                })
                .then((response) => {
                    if(response){
                        var formData = new FormData();
                        formData.append('key', key);
                        var url = '<?=base_url()?>C_conclusion/deleteRecord';
                        
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: formData,
                            async: false,
                            //dataType: 'json',
                            success: function(response){
                                if (response > 0){
                                    notificacion('Se ha eliminado el registro','success');
                                }else{
                                    notificacion('Ha ocurrido un error','error');
                                }
                                $("#table").load('<?=base_url()?>/C_conclusion/generateTable/<?=$key?>/1');
                            },
                            cache:false,
                            contentType: false,
                            processData: false
                        })
                    }
                })
            }

            function selectRecord(key){
                var formData = new FormData();
                formData.append('key', key);
                var url = '<?=base_url()?>C_conclusion/findRecord';       
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    async: false,
                    dataType: 'json',
                    success: function(response){
                        if(response != 0){
                            $("#iIdApartado").val(response['iIdApartado']);
                            obtener_preguntas(response['iIdApartado']);
                            $("#iIdPregunta").val(response['iIdPregunta']);
                            $("#iIdTipoConclusion").val(response['iTipoConclusion']);
                            $("#vConclusion").val(response['vConclusion']);
                            $("#vRecomendacion").val(response['vRecomendacion']);
                            $("#key").val(response['iIdConclusion']);
                        }
                    },
                    cache:false,
                    contentType: false,
                    processData: false
                })
            }

        </script>