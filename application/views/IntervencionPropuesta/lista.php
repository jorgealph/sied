
	<link rel="stylesheet" href="<?=base_url()?>admin/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="<?=base_url()?>admin/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css">

			<!-- begin breadcrumb -->
			<a onclick="cargar('<?=base_url();?>C_intervencionpropuesta/mostrar_crud','#contenido');" class="btn btn-default pull-right">
                <li class="fas fa-lg fa-fw m-r-10 fa-plus-circle"></li><span>Agregar propuesta</span>
            </a>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Propuestas de intervenciones <!--<small>header small text goes here...</small>--></h1>
			<!-- end page-header -->
			
			<!-- begin panel -->
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					</div>
					<h4 class="panel-title">Lista de propuestas de intervenciones</h4>
				</div>
				<div class="panel-body">
					<table id="data-table-default" class="table table-striped table-bordered">
                        <thead>
							<tr>
								<th>Intervención pública</th>
								<th>Año de creación</th>
								<th>Año de evaluación</th>
								<th>Eje</th>
								<th>Dependencia</th>
								<th>Tipo de intervención</th>
								<th>Acción</th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($intpro as $r) {?>
							<tr>
								<td><?php echo($r->vIntervencion) ?></td>
								<td><?php echo($r->iAnioCreacion) ?></td>
								<td><?php echo($r->iAnioEvaluacion) ?></td>
								<td><?php echo($r->vEje) ?></td>
								<td><?php echo($r->vOrganismo) ?></td>
								<td><?php if($r->iTipo == 1){
									echo 'Programa presupuestario';
								}elseif($r->iTipo == 2){
									echo 'Fondo';
								}else{
									echo 'Programa de bienes o servicio';
								} ?></td>
								<td>
									<button onclick="cargar('<?=base_url();?>C_IntervencionPropuesta/edit/<?php echo $r->iIdIntervencionPropuesta; ?>', '#contenido');" class="btn btn-success"><i class="fas fa-lg fa-fw m-r-10 fa-edit"></i><span>Editar</span></button>
								</td>
								<td>
									<button onclick="Aprobar(<?php echo $r->iIdIntervencionPropuesta; ?>)" class="btn btn-primary"><i class="fas fa-lg fa-fw m-r-10 fa-check-circle"></i><span>Aprobar</span></button>
								</td>
								<td>
									<button onclick="deleteRow(<?php echo $r->iIdIntervencionPropuesta; ?>);" class="btn btn-danger"><i class="fas fa-lg fa-fw m-r-10 fa-exclamation-triangle"></i><span>Eliminar</span></button>
								</td>
							</tr>
							<?php } ?>
						</tbody>
                    </table>
				</div>
				
			</div>
			<!-- end panel -->
		</div>
        <!-- end #content -->
		<script>
			function deleteRow(id){
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
						$.get("<?=base_url()?>C_intervencionpropuesta/delete/"+id, 
						function(data) {
							if(data == 1){
								$("#contenido").load('<?=base_url()?>C_intervencionpropuesta/mostrar_vista');
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
		</script>
		<script src="<?=base_url()?>admin/assets/plugins/DataTables/media/js/jquery.dataTables.js"></script>
		<script src="<?=base_url()?>admin/assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
		<script src="<?=base_url()?>admin/assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
		<script src="<?=base_url()?>admin/assets/js/demo/table-manage-default.demo.min.js"></script>
		<script>
		$(document).ready(function() {
			TableManageDefault.init();
		});
		</script>
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
			function GetClave(){
				
			}
		</script>