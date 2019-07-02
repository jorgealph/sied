			<!-- begin page-header -->
			<h1 class="page-header">Evaluaciones <!--<small>header small text goes here...</small>--></h1>
			<!-- end page-header -->
			<!-- begin panel -->
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<h4 class="panel-title">Filtro de búsqueda</h4>
				</div>
				<div class="panel-body">
				<form id="form" onkeypress="return pulsar(event)">
					<div class="row" style="padding-left:10px;padding-right:10px; padding-bottom:10px;">
						<div class="col-md-2">
							<label for="iAnioEvaluacion">Año de la evaluación:</label>
							<select name="iAnioEvaluacion" id="iAnioEvaluacion" class="form-control">
								<option value="">-Todos-</option>
								<?php
									foreach($anio as $r){
										echo "<option value='$r->iAnioEvaluacion'>$r->iAnioEvaluacion</option>";
									}
								?>
							</select>
						</div>
						<div class="col-md-2">
							<label for="iOrigenEvaluacion">Origen de la evaluación:</label>
							<select name="iOrigenEvaluacion" id="iOrigenEvaluacion" class="form-control">
								<option value="">-Todos-</option>
								<option value="1">Externa</option>
								<option value="2">Interna</option>
							</select>
						</div>
						<div class="col-md-2">
							<label for="iIdTipoEvaluacion">Tipo de evaluación:</label>
							<select name="iIdTipoEvaluacion" id="iIdTipoEvaluacion" class="form-control">
								<option value="">-Todos-</option>
								<?php
									foreach($tipo as $r){
										echo "<option value='$r->iIdTipoEvaluacion'>$r->vTipoEvaluacion</option>";
									}
								?>
							</select>
						</div>
						<div class="col-md-3">
							<label for="iIdEje">Eje:</label>
							<select name="iIdEje" id="iIdEje" class="form-control" onchange="loadDependencia()">
								<option value="">-Todos-</option>
								<?php
									foreach($eje as $r){
										echo "<option value='$r->iIdEje'>$r->vEje</option>";
									}
								?>
							</select>
						</div>
						<div class="col-md-3">
							<label for="iIdOrganismo">Dependencia responsable:</label>
							<select name="iIdOrganismo" id="iIdOrganismo" class="form-control">
								<option value="">-Todos-</option>
							</select>
						</div>
					</div>
					
					<div class="row" style="padding-left:10px;padding-right:10px;">
					<div class="col-md-2">
							<label for="iTipo">Tipo de intervención:</label>
							<select name="iTipo" id="iTipo" class="form-control">
								<option value="">-Todos-</option>
								<option value="1">Programa presupuestario</option>
								<option value="2">Fondo</option>
								<option value="3">Programa de bienes o servicio</option>
							</select>
						</div>
						<div class="col-md-8">
							<label for="vIntervencion">Nombre de la intervención pública:</label>
							<input type="text" name="vIntervencion" id="vIntervencion" class="form-control" onkeypress="return pulsar(event)">
						</div>
						<div class="col-md-2">
						<button class="btn btn-success form-control" onclick="filter()" type="button" style="margin-top:25px;"> 
							<li class="fas fa-lg fa-fw m-r-10 fa-search"></li>
							<span>Buscar</span>
						</button>
						</div>
					</div>
					</form>
				</div>
				
			</div>

			<!-- begin panel -->
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					</div>
					<h4 class="panel-title">Resultados de la búsqueda</h4>
				</div>
				<div class="panel-body">
					<div class="table-responsive" id="table">
							<!--<?=$tb?>-->
					</div>
				</div>
				
			</div>
			<!-- end panel -->
		</div>
        <!-- end #content -->
		<script>

	function eliminar(id){
        $.post("<?=base_url();?>C_intervencionpropuesta/delete",{id:id},function(resultado,status){
        	if(resultado == "1"){                		
        	 	notificacion('El registro ha sido eliminado','success');
        	 	$("#table").load('<?=base_url()?>C_IntervencionPropuesta/drawTable');
        	}
    		else notificacion('El registro no pudo ser eliminado','error');					
    	});
	}
		</script>
		
		<script src="<?=base_url()?>admin/assets/js/demo/table-manage-default.demo.min.js"></script>
		
		<script>
			
			$("#table").load('<?=base_url()?>C_evaluacion/drawTable');
			function filter(){
				$.ajax({
    				// la URL para la petición
    				url : '<?=base_url()?>C_evaluacion/drawTable',
					// la información a enviar
    				// (también es posible utilizar una cadena de datos)
    				data : $("#form").serialize(),
    				// especifica si será una petición POST o GET
    				type : 'POST',
    				// el tipo de información que se espera de respuesta
    				/*dataType : 'json',*/
    				// código a ejecutar si la petición es satisfactoria;
    				// la respuesta es pasada como argumento a la función
    				success : function(json) {
        				$("#table").html(json);
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
			function pulsar(e) {
  				// averiguamos el código de la tecla pulsada (keyCode para IE y which para Firefox)
  				tecla = (document.all) ? e.keyCode :e.which;
  				// si la tecla no es 13 devuelve verdadero,  si es 13 devuelve false y la pulsación no se ejecuta
  				return (tecla!=13);
			}
			function loadDependencia(){
            	var value = $("#iIdEje").val();
            	$("#iIdOrganismo").load('C_intervencionpropuesta/dependenciaQuery/'+value);
        	}
			

		</script>