
			<link href="<?=base_url()?>admin/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
            <link href="<?=base_url()?>admin/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css" rel="stylesheet" />
            <link href="<?=base_url()?>admin/assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
            <!-- begin breadcrumb -->
			<a onclick="filter()" class="btn btn-default pull-right">
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
					<h4 class="panel-title">Edición de evaluación</h4>
				</div>
				<div class="panel-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8">
							    <label for="nombre"> <span class="text-danger">*</span> Nombre de la evaluacion:</label>
							    <input type="text" name="nombre" id="nombre" class="form-control" value="<?=$eva->vNombreEvaluacion?>">
						    </div>
                            <div class="col-md-2">
							    <label for="finicio"> <span class="text-danger">*</span> Inicio de la evaluacion:</label>
							    <!--data-date-start-date="Date.default"-->
                                <div class="input-group date" id="datetimepicker1" >
									<input type="text" class="form-control" id="finicio" value="<?=date('d/m/Y', strtotime($eva->dFechaInicio));?>">
									<div class="input-group-addon">
									    <i class="fa fa-calendar"></i>
									</div>
								</div>
						    </div>
                            <div class="col-md-2">
							    <label for="ffin"> <span class="text-danger">*</span> Fin de la evaluacion:</label>
							    <div class="input-group date" id="datetimepicker2">
									<input type="text" class="form-control" id="ffin" value="<?=date('d/m/Y', strtotime($eva->dFechaFin));?>">
									<div class="input-group-addon">
									    <i class="fa fa-calendar"></i>
									</div>
								</div>
						    </div>
                        </div>
                        <div class="row" style="padding-top:10px;">
                            <div class="col-md-12">
                                <label for="objetivo">Objetivo:</label>
							    <textarea name="objetivo" id="objetivo" cols="30" rows="3" class="form-control"><?=$eva->vObjetivo?></textarea>
                            </div>
                        </div>
                        
                        <div class="row" style="padding-top:10px;">
                            <div class="col-md-12">
                                <label for="especifico">Objetivos especifícos:</label>
							    <textarea name="especifico" id="especifico" cols="30" rows="3" class="form-control"><?=$eva->vObjetivoEspecifico?></textarea>
                            </div>
                        </div>
                        <div class="row" style="padding-top:10px;">
                            <div class="col-md-4">
                                <label for="oficio">¿Envió oficio con la información sólicitada?</label>
							    <select name="oficio" id="oficio" class="form-control">
                                    <option value="">-Seleccione una opción-</option>
                                    <option value="1" <?=($eva->iEnvioOficio == 1) ? 'selected' : ''; ?>>Si</option>
                                    <option value="0" <?=($eva->iEnvioOficio == 0) ? 'selected' : ''; ?>>No</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="frecepcion">Fecha de recepción del oficio</label>
                                <div class="input-group date" id="datetimepicker3">
									<input type="text" class="form-control" id='frecepcion' value="<?=date('d/m/Y', strtotime($eva->dFechaRecepcionOficio));?>">
									<div class="input-group-addon">
									    <i class="fa fa-calendar"></i>
									</div>
								</div>
                            </div>
                            <div class="col-md-4">
                                <label for="completa">¿La información entregada estaba completa?</label>
							    <select name="completa" id="completa" class="form-control">
                                    <option value="">-Seleccione una opción-</option>
                                    <option value="1" <?=($eva->iInformacionCompleta == 1) ? 'selected' : ''; ?>>Si</option>
                                    <option value="0" <?=($eva->iInformacionCompleta == 0) ? 'selected' : ''; ?>>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="row" style="padding-top:20px;">
                            <div class="col-md-12">
                                <h4>Datos del evaluador</h4>
                                <hr>
                            </div>
                        </div>
                        <div class="row" style="padding-top:10px;">
                            <div class="col-md-4">
                                <label for="evaluador">Nombre completo</label>
							    <select class="form-control selectpicker" data-size="10" data-live-search="true" data-style="btn-white" id="evaluador" onchange="search()">
                                    <option value="">-Seleccione una opción-</option>
                                    <?=$option?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="">Puesto</label>
							    <input type="text" class="form-control" id="cargo" disabled>
                            </div>
                        </div>
                        <div class="row" style="padding-top:20px;">
                            <div class="col-md-12">
                                <h4>Datos de los colaboradores</h4>
                                <hr>
                            </div>
                        </div>
                        <div class="row" style="padding-top:10px;">
                            <div class="col-md-4">
                                <label for="colaborador">Nombre completo:</label>
							    <select class="form-control selectpicker" data-size="10" data-live-search="true" data-style="btn-white" id="colaborador">
                                    <option value="">-Seleccione una opción-</option>
                                    <?=$option?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-success" style="margin-top:25px;" onclick="addColaborador()">
                                    <li class="fa fa-lg fa-fw m-r-10 fa-plus"></li>
                                    <span>Agregar</span>
                                </button>
                            </div>
                        </div>
                        <div class="row" style="padding-top:10px">
                            <div class="col-md-12">
                                <div class="table-responsive" id="tabla">
                                    
                                </div>
                            </div>
                            <div class="col-md-4 offset-md-4">
                                <button class="btn btn-primary form-control" style="margin-top:25px;" onclick="updateEvaluacion()">
                                    <li class="fa fa-lg fa-fw m-r-10 fa-save"></li>
                                    <span>Guardar cambios</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
			<!-- end panel -->
		</div>
        <!-- end #content -->
        <script src="<?=base_url()?>admin/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script src="<?=base_url()?>admin/assets/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js"></script>
        <script src="<?=base_url()?>admin/assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
        <script>
            $( document ).ready(function() {
                
                datetimeInit('datetimepicker1');
                datetimeInit('datetimepicker2');
                datetimeInit('datetimepicker3');
                
                $("#tabla").load('C_evaluacion/drawColaborador');

                $('select[id=evaluador]').val(<?=$eva->iIdUsuario?>);
                search();
                $(".selectpicker").selectpicker("render");
            });

            function datetimeInit(dtp){
                $("#"+dtp).datepicker({
                    weekStart: 1,
                    daysOfWeekHighlighted: "6,0",
                    autoclose: true,
                    todayHighlight: true,
                    language: 'es',
                });
            }

            function search(){
                var formData = new FormData();
                formData.append('usuario', $("#evaluador").val());
                var url = 'C_evaluacion/getCargo';
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    async: false,
                    success: function(data){
                        $("#cargo").val(data);
                    },
                    error: function(){
                        notificacion('Error', 'error');
                    },
                    cache:false,
                    contentType: false,
                    processData: false
                });
            }
            
            function addColaborador(){
                var frmData = new FormData();
                var key = $("#colaborador").val();
                frmData.append('key', key);
                var url = '<?=base_url()?>C_evaluacion/addColaborador';
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: frmData,
                    async: false,
                    success: function(data){
                        if(data == 1){
                            $("#tabla").load('C_evaluacion/drawColaborador');
                            notificacion('Colaborador agregado','success');
                        }else{
                            notificacion('El colaborador ya ha sido agregado','error');
                        }
                    },
                    error: function(){
                        notificacion('Error', 'error');
                    },
                    cache:false,
                    contentType: false,
                    processData: false  
                })
            }

            function removeColaborador(key){
                var frmData = new FormData();
                frmData.append('key', key);
                var url = '<?=base_url()?>C_evaluacion/removeColaborador';
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: frmData,
                    async: false,
                    success: function(data){
                        if(data == 1){
                            $("#tabla").load('<?=base_url()?>C_evaluacion/drawColaborador');
                            notificacion('Colaborador eliminado con exito','success');
                        }else{
                            notificacion('El colaborador ya ha sido eliminado','error');
                        }
                    },
                    error: function(){
                        notificacion('Error', 'error');
                    },
                    cache:false,
                    contentType: false,
                    processData: false  
                })
            }
            function updateEvaluacion(){
                if (validateForm() == true){
                    var frmData = new FormData();
                    frmData.append('key', <?=$key?>);
                    frmData.append('vNombreEvaluacion', $('#nombre').val());
                    frmData.append('dFechaInicio', $('#finicio').val());
                    frmData.append('dFechaFin', $('#ffin').val());
                    frmData.append('vObjetivo', $('#objetivo').val());
                    frmData.append('vObjetivoEspecifico', $('#especifico').val());
                    frmData.append('iEnvioOficio', $('#oficio').val());
                    frmData.append('dFechaRecepcionOficio', $('#frecepcion').val());
                    frmData.append('iInformacionCompleta', $('#completa').val());
                    frmData.append('iIdUsuario', $('#evaluador').val());
                    var url = '<?=base_url()?>C_evaluacion/updateRecord';
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: frmData,
                        async: false,
                        dataType: 'json',
                        success: function(data){
                            if(data['result'] == 1){
                                notificacion('Datos guardados exitosamente','success');
                            }else{
                                notificacion('Ha ocurrido un error','error');
                            }

                            var msg = data['msg'];
                            $.each(msg,function(key, row) {
                                notificacion('No se ha podido agregar a ' + row.usuario,'error');
                            });

                            var usr = data['usr'];
                            $.each(usr,function(key, row) {
                                notificacion('Se ha agregado a ' + row.usuario + ' como colaborador','success');
                            });

                            var supr = data['supr'];
                            $.each(supr,function(key, row) {
                                notificacion(row.usuario + ' no es más un colaborador','success');
                            });
                        },
                        error: function(){
                            notificacion('Error en la petición', 'error');
                        },
                        cache:false,
                        contentType: false,
                        processData: false
                    })
                }else{
                    notificacion('No debe haber campos vacios');
                }
            }

            function validateForm(){
                var valido = true;
                var nombre = $('#nombre').val();
                var fi = $('#finicio').val();
                var ff = $('#ffin').val();
                var o = $('#objetivo').val();
                var oe = $('#especifico').val();
                var ofi = $('#oficio').val();
                var fr = $('#frecepcion').val();
                var c = $('#completa').val();
                var e = $('#evaluador').val();

                if(nombre == null || nombre == ''){
                    valido = false;
                }
                if(fi == null || fi == ''){
                    valido = false;
                }
                if(ff == null || ff == ''){
                    valido = false;
                }
                if(o == null || o == ''){
                    valido = false;
                }
                if(oe == null || oe == ''){
                    valido = false;
                }
                if(ofi == null || ofi == ''){
                    valido = false;
                }
                if(c == null || c == ''){
                    valido = false;
                }
                if(e == null || e == ''){
                    valido = false;
                }if(nombre == null && nombre == ''){
                    valido = false;
                }
                return valido;
            }

        </script>