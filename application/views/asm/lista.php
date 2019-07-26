			<!-- begin page-header -->
			<h1 class="page-header">Aspectos Susceptibles de Mejora <!--<small>header small text goes here...</small>--></h1>
			<!-- end page-header -->
			<!-- begin panel -->
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<h4 class="panel-title">Filtro de búsqueda</h4>
				</div>
				<div class="panel-body">
				<form id="form" onkeypress="return pulsar(event)">
					<div class="row" style="padding-left:10px;padding-right:10px; padding-bottom:10px;">
						<div class="col-md-3">
							<label for="iIdEje">Año de la evaluación:</label>
							<select name="anio" id="anio" class="form-control" onchange="loadDependencia()">
								<option value="">-Todos-</option>
								<?php
									foreach($anio as $r){
										echo "<option value='$r->iIdASM'>$r->iAnioEvaluacion</option>";
									}
								?>
							</select>
						</div>
						<div class="col-md-3">
							<label for="iIdEje">Origen de la evaluación:</label>
							<select name="origen" id="origen" class="form-control" onchange="loadDependencia()">
								<option value="0">-Todos-</option>
								<option value="1">Externa</option>
								<option value="2">Interna</option>
							</select>
						</div>
						<div class="col-md-3">
							<label for="iIdEje">Tipo de evaluación:</label>
							<select name="tipoE" id="tipoE" class="form-control" onchange="loadDependencia()">
								<option value="">-Todos-</option>
								<?php
									foreach($tipoE as $r){
										echo "<option value='$r->iIdTipoEvaluacion'>$r->vTipoEvaluacion</option>";
									}
								?>
							</select>
						</div>
						<div class="col-md-3">
							<label for="iIdEje">Tipo de intervención:</label>
							<select name="tipoI" id="tipoI" class="form-control" onchange="loadDependencia()">
								<option value="0">-Todos-</option>
								<option value="1">Programa Presupuestario</option>
								<option value="2">Fondo</option>
								<option value="3">Programa de bienes o servicios</option>
							</select>
						</div>
					</div>
					
					<div class="row" style="padding-left:10px;padding-right:10px;">
						<div class="col-md-3">
							<label for="iIdEje">Eje:</label>
							<select name="eje" id="eje" class="form-control" onchange="loadDependencia()">
								<option value="">-Todos-</option>
								<?php
									foreach($eje as $r){
										echo "<option value='$r->iIdEje'>$r->vEje</option>";
									}
								?>
							</select>
						</div>
						<div class="col-md-3">
							<label for="iIdEje">Dependencia:</label>
							<select name="dependencia" id="dependencia" class="form-control" onchange="loadDependencia()">
								<option value="">-Todos-</option>
								<?php
									foreach($dependencia as $r){
										echo "<option value='$r->iIdOrganismo'>$r->vOrganismo</option>";
									}
								?>
							</select>
						</div>
						<div class="col-md-4">
							<label for="vIntervencion">Palabra clave </label>
							<div class="input-group mb-12">
								<input type="text" name="vIntervencion" id="vIntervencion" class="form-control" onkeypress="return pulsar(event)">
								<div class="input-group-append">
									<button class="btn btn-success" onclick="" type="button"> 
										<li class="fas fa-lg fa-fw m-r-10 fa-search"></li>
										<span>Buscar</span>
									</button>
								</div>
							</div>
							
						</div>
						<div class="col-md-2">
                			<button class="btn btn-success form-control" type="button" onclick="cargar('<?=base_url(); ?>C_asm/guardar_asm','#contenido');" style="margin-top:25px;"><i class="fas fa-lg fa-fw m-r-10 fa-plus-circle"></i>Agregar</button>
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
							
					</div>
				</div>
				
			</div>
			<!-- end panel -->
		</div>
        <!-- end #content -->
		<script>
		$("#table").load('<?=base_url()?>C_asm/tabla');

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