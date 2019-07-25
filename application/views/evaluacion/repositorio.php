			<style>
                .custom-file-label::after{
                    content: "Examinar";
                }
			</style>
			<!-- begin breadcrumb -->
            <a onclick="cargar('ver/evaluacion', '#contenido')" class="btn btn-default pull-right">
                <li class="fas fa-lg fa-fw m-r-10 fa-arrow-left"></li><span>Regresar</span>
            </a>
            <!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Repositorio de archivos <!--<small>header small text goes here...</small>--></h1>
			<!-- end page-header -->
			<!-- begin panel -->
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<h4 class="panel-title">Documento</h4>
				</div>
				<div class="panel-body">
					<div class="container" style="padding-top:15px;padding-bottom:15px;">
						<div class="row">
							<?=($_SESSION[PREFIJO.'_idrol'] == 1) ? '<div class="col-md-6"><label for="" style="padding-top:8px"> Plantilla base del cuestionario&nbsp; &nbsp; </label><button class="btn btn-info" onclick="descargarPlantilla('.$eva->iIdPlantilla.')"> Descargar </button></div>' : '' ?>
							<div class="col-md-6">
								<label for="" style="padding-top:8px"> Última versión del cuestionario: <?=($eva->dFechaSubida == '1900-01-01 00:00:00') ? '' : $eva->dFechaSubida ?>&nbsp; &nbsp; </label>
								<?php
									if($_SESSION[PREFIJO.'_idrol'] == 2 && $eva->iEstatusArchivo == 0 || $eva->iEstatusArchivo == 3 || $eva->iEstatusArchivo == 4){
										if(!empty($eva->vRutaArchivo)){
											echo '<button class="btn btn-info" onclick="window.location.href=\''.base_url().'files/cuestionarios/'.$eva->vRutaArchivo.'\'">Descargar</button>';
										}
									}else{
										if ($_SESSION[PREFIJO.'_idrol'] == 2 && $eva->iEstatusArchivo != 2){
											echo "<script>$('#btn').prop('disabled', true); $('#save').prop('disabled', true)</script>";
										}
									}
									if($_SESSION[PREFIJO.'_idrol'] == 1 && !empty($eva->vRutaArchivo)){
										echo '<button class="btn btn-info" onclick="window.location.href=\''.base_url().'files/cuestionarios/'.$eva->vRutaArchivo.'\'">Descargar</button>';
									}
									if($_SESSION[PREFIJO.'_idrol'] == 3 && $eva->iEstatusArchivo == 1){
										echo '<button class="btn btn-info" onclick="window.location.href=\''.base_url().'files/cuestionarios/'.$eva->vRutaArchivo.'\'">Descargar</button>';
									}
								?>
							</div>
						</div>
						<div class="row" style="padding-top:15px;">
							<?=($_SESSION[PREFIJO.'_idrol'] == 1) ? $co : ''?>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">Cuestionario de evaluación</h4>
						</div>
						<div class="panel-body">
							<div class="container">
								<div class="row">
									<div class="col-md-6 offset-md-3">
                                        <div class="custom-file">
											<?php
											if($_SESSION[PREFIJO.'_idrol'] == 2 && $eva->iEstatusArchivo == 0 || $eva->iEstatusArchivo == 3 || $eva->iEstatusArchivo == 4){
                                            echo '<input type="file" class="custom-file-input" id="file" name="file" accept="application/msword, .docx" lang="es">
											<label class="custom-file-label" for="file">Seleccionar archivo</label>';
											}
											if($_SESSION[PREFIJO.'_idrol'] == 1 || $_SESSION[PREFIJO.'_idrol'] == 3){
												echo '<input type="file" class="custom-file-input" id="file" name="file" accept="application/msword, .docx" lang="es">
												<label class="custom-file-label" for="file">Seleccionar archivo</label>';
											}
											?>
                                        </div>
                                    </div>
								</div>
								<div class="row" style="padding-top:15px">
									<?=$tb?>
								</div>
								<div class="row" style="padding-top:15px">
									<div class="col-md-4 offset-md-4">
                                    	<button id="save" class="btn btn-primary form-control" style="margin-top:25px;" type="button" onclick="upload()">
                                            <li class="fa fa-lg fa-fw m-r-10 fa-save"></li>
                                            <span>Guardar cambios</span>
                                        </button>
                                	</div>
								</div>
							</div>
						</div>
					</div>
                </div>
			</div>
		</div>
		<!-- end #content -->

		<!-- begin js -->
		<script>
			// Add the following code if you want the name of the file appear on select
            $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });

			$("#estatus").val(<?=($eva->iEstatusArchivo != 2) ? $eva->iEstatusArchivo : ''?>);

			function upload(){
				var estatus = 0;
				if ($("#estatus").length) {
  					estatus = $("#estatus").val();
				}else{
					estatus = <?=($_SESSION[PREFIJO.'_idrol'] == 1) ? 0 : 2?>;
				}
				var formData = new FormData();
				var inputFile = document.getElementById("file");
				var file = inputFile.files[0];

				formData.append('userfile', file);
				formData.append('key', <?=$key?>);
				formData.append('estatus', estatus);
				$.ajax({
        			url: '<?=base_url()?>C_evaluacion/subir',
        			type: 'POST',
        			data: formData,
        			async: false,
                   // dataType: 'json',
        			success: function (data){
						if (data == 1){
							notificacion('El documento ha sido actualizado','success');
						}else{
							notificacion('Ha ocurrido un error','error');
						}
						cargar('ver/repositorio/<?=$key?>', '#contenido')
					},
        			cache: false,
        			contentType: false,
        			processData: false
				})
			}
			function descargarPlantilla(id){
				var win = window.open('C_Pregunta/word/'+id, '_blank');
				win.focus();
			}

			function borrar(){
				var formData = new FormData();
				formData.append('key', <?=$key?>);
				$.ajax({
        			url: '<?=base_url()?>C_evaluacion/eliminar_documento',
        			type: 'POST',
        			data: formData,
        			async: false,
                   // dataType: 'json',
        			success: function (data){
						if (data == 1){
							notificacion('El documento ha sido eliminado','success');
						}else{
							notificacion('Ha ocurrido un error','error');
						}
						cargar('ver/repositorio/<?=$key?>', '#contenido')
					},
        			cache: false,
        			contentType: false,
        			processData: false
				})
			}

		</script>
		<!-- end js -->