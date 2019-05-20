			<!-- begin page-header -->
			<h1 class="page-header">Propuestas de intervenciones <!--<small>header small text goes here...</small>--></h1>
			<!-- end page-header -->
			
			
			
			<!-- begin panel -->
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<h4 class="panel-title">Filtro de búsqueda</h4>
				</div>
				<div class="panel-body">
				<form id="form">
					<div class="row" style="padding-left:10px;padding-right:10px;">
						<div class="col-md-3">
							<label for="iIdOrganismo">Dependencia</label>
							<select name="iIdOrganismo" id="iIdOrganismo" class="form-control">
								<option value="">-Todos-</option>
								<?php
									foreach($organismo as $r){
										echo "<option value='$r->iIdOrganismo'>$r->vOrganismo</option>";
									}
								?>
							</select>
						</div>
						<div class="col-md-2">
							<label for="iIdEje">Eje</label>
							<select name="iIdEje" id="iIdEje" class="form-control">
								<option value="">-Todos-</option>
								<?php
									foreach($eje as $r){
										echo "<option value='$r->iIdEje'>$r->vEje</option>";
									}
								?>
							</select>
						</div>
						<div class="col-md-2">
							<label for="iTipo">Tipo de intervención</label>
							<select name="iTipo" id="iTipo" class="form-control">
								<option value="">-Todos-</option>
								<option value="1">Programa presupuestario</option>
                                <option value="2">Fondo</option>
                                <option value="3">Programa de bienes o servicio</option>
							</select>
						</div>
						<div class="col-md-3">
							<label for="vIntervencion">Nombre</label>
							<div class="input-group mb-12">
								<input type="text" name="vIntervencion" id="vIntervencion" class="form-control">
								<div class="input-group-append">
									<button class="btn btn-success" onclick="filter()" type="button"> 
										<li class="fas fa-lg fa-fw m-r-10 fa-search"></li>
										<span>Buscar</span>
									</button>
								</div>
							</div>
							
						</div>
						<div class="col-md-2">
                			<button class="btn btn-success" type="button" onclick="cargar('<?=base_url();?>C_intervencionpropuesta/mostrar_crud','#contenido');" style="margin-top:25px;"><i class="fas fa-lg fa-fw m-r-10 fa-plus-circle"></i>Nueva intervención</button>
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
					<div class="row" style="padding-left:10px;padding-right:10px;" id="table">
							<!--Table here-->
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
										swal('Exito', 'La petición ha sido aprobada', 'success',{
											buttons: false,
											timer: 1500
										});
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
							}else{
								if(value == ''){
									swal(`La operación no pudo concluir`, 'Verifique no dejar campos vacios', 'error',{
										buttons: false,
										timer: 1500
									});
								}else{
									if(value == null){
										swal(`La operación fue cancelada`, 'Las cambios no fueron guardados', 'warning',
										{
											buttons: false,
											timer: 1500
										});
									}
								}
							}
						});
  					}
				});
			}
			$("#table").load('<?=base_url()?>C_IntervencionPropuesta/drawTable');

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

		</script>