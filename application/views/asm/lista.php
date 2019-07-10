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
						<div class="col-md-2">
							<label for="iIdEje">Año de la evaluación:</label>
							<select name="iIdEje" id="iIdEje" class="form-control" onchange="loadDependencia()">
								<option value="">-Todos-</option>
								<?php
									/*foreach($eje as $r){
										echo "<option value='$r->iIdEje'>$r->vEje</option>";
									}*/
								?>
							</select>
						</div>
						<div class="col-md-2">
							<label for="iIdEje">Origen de la evaluación:</label>
							<select name="iIdEje" id="iIdEje" class="form-control" onchange="loadDependencia()">
								<option value="">-Todos-</option>
								<?php
									/*foreach($eje as $r){
										echo "<option value='$r->iIdEje'>$r->vEje</option>";
									}*/
								?>
							</select>
						</div>
						<div class="col-md-2">
							<label for="iIdEje">Tipo de evaluación:</label>
							<select name="iIdEje" id="iIdEje" class="form-control" onchange="loadDependencia()">
								<option value="">-Todos-</option>
								<?php
									/*foreach($eje as $r){
										echo "<option value='$r->iIdEje'>$r->vEje</option>";
									}*/
								?>
							</select>
						</div>
						<div class="col-md-2">
							<label for="iIdEje">Tipo de intervención</label>
							<select name="iIdEje" id="iIdEje" class="form-control" onchange="loadDependencia()">
								<option value="">-Todos-</option>
								<?php
									/*foreach($eje as $r){
										echo "<option value='$r->iIdEje'>$r->vEje</option>";
									}*/
								?>
							</select>
						</div>
						<div class="col-md-2">
							<label for="iIdEje">Eje:</label>
							<select name="iIdEje" id="iIdEje" class="form-control" onchange="loadDependencia()">
								<option value="">-Todos-</option>
								<?php
									/*foreach($eje as $r){
										echo "<option value='$r->iIdEje'>$r->vEje</option>";
									}*/
								?>
							</select>
						</div>
						<div class="col-md-2">
							<label for="iIdEje">Dependencia:</label>
							<select name="iIdEje" id="iIdEje" class="form-control" onchange="loadDependencia()">
								<option value="">-Todos-</option>
								<?php
									/*foreach($eje as $r){
										echo "<option value='$r->iIdEje'>$r->vEje</option>";
									}*/
								?>
							</select>
						</div>
					</div>
					
					<div class="row" style="padding-left:10px;padding-right:10px;">
					<div class="col-md-6">
							<label for="iIdOrganismo">Intervención pública:</label>
							<select name="iIdOrganismo" id="iIdOrganismo" class="form-control">
								<option value="">-Todos-</option>
								<?php
									/*foreach($organismo as $r){
										echo "<option value='$r->iIdOrganismo'>$r->vOrganismo</option>";
									}*/
								?>
							</select>
						</div>
						<div class="col-md-4">
							<label for="vIntervencion">Nombre del asm:</label>
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
                			<button class="btn btn-success form-control" type="button" onclick="" style="margin-top:25px;"><i class="fas fa-lg fa-fw m-r-10 fa-plus-circle"></i>Agregar</button>
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
							<?=$tb?>
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
			function Aprobar(id){
				swal({
  					title: "¿Estás seguro?",
  					text: "La propuesta esta por ser aprobada",
  					icon: "warning",
  					buttons: true,
					buttons: ['Cancelar', 'Aceptar'],
  					dangerMode: true,
				})
				.then((willDelete) => {
  					if (willDelete) {
						swal({
							title: 'Estas por concluir',
							text: 'Captura la clave de intervención',
							buttons: {
								cancel: "Cancelar",
    							confirm: "Continuar",
  							},
  							content: {
    							element: "input",
    							attributes: {
      								placeholder: "Ingresa la clave",
      								type: "text",
									required: true
    							},
  							}
						})
						.then((value) => {
  							if(value != '' && value != null){
								$.ajax({
    								// la URL para la petición
    								url : '<?=base_url()?>C_IntervencionPropuesta/AprobarIntervencion',

    								// la información a enviar
    								// (también es posible utilizar una cadena de datos)
    								data : { id : id, clave : value },

    								// especifica si será una petición POST o GET
    								type : 'POST',

    								// el tipo de información que se espera de respuesta
    								dataType : 'json',

    								// código a ejecutar si la petición es satisfactoria;
    								// la respuesta es pasada como argumento a la función
    								success : function(json) {
        								$("#contenido").load('<?=base_url()?>C_IntervencionPropuesta/mostrar_vista');
										notificacion('La intervención ha sido aprobada','success');
    								},

    								/* código a ejecutar si la petición falla;
    								son pasados como argumentos a la función
    								el objeto de la petición en crudo y código de estatus de la petición*/
    								error : function(xhr, status) {
        								notificacion('La operación no pudo concluirse','error');
    								},

    								// código a ejecutar sin importar si la petición falló o no
    								/*complete : function(xhr, status) {
        								alert('Petición realizada');
									}*/
								});
							}else{
								if(value == ''){
									notificacion('Error, procure no dejar campos vacios','error');
								}else{
									if(value == null){
										notificacion('La operación ha sido cancelada','error');
									}
								}
							}
						});
  					}
				});
			}
			//	$("#table").load('<?=base_url()?>C_IntervencionPropuesta/drawTable');

			function filter(){
				$.ajax({
    				// la URL para la petición
    				url : '<?=base_url()?>C_IntervencionPropuesta/drawTable',
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