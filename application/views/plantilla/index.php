<html>
    <head>

    </head>
    <body>
        <h3 class="page-header panel-busqueda">Gestión de plantillas</h3>
        <div class="panel panel-inverse panel-busqueda">
            <div class="panel-heading">
                <h4 class="panel-title">Filtros de búsqueda</h4>
            </div>
            <div class="panel-body">
                <form id="frmbusqueda">
                <div class="col md-12">
                <div class="row">
                    <div class="col-md-2">
                    <label>Año: </label>
                    <select class="form-control" id="filtro-anio" name="filtro-anio">
                        <option value="">Seleccionar</option>
						<?php foreach ($anio as $row) {?>
							<option value="<?=$row->iAnioEvaluacion;?>"><?=$row->iAnioEvaluacion;?></option>
						<?php } ?>
                    </select>
                    </div>
                <div class="col-md-2">
                <label>Origen: </label>
                <select class="form-control" id="filtro-origen" name="filtro-origen">
                    <option value="">Seleccionar</option>
                    <?php foreach ($origen as $row) {?>
                        <option value="<?=$row->iOrigenEvaluacion;?>"><?=$row->iOrigenEvaluacion == 1 ? "Interna" : "Externa"?></option>
                    <?php } ?>
                </select>
                </div>
                <div class="col-md-2">
                <label>Tipo: </label>
                <select class="form-control" id="filtro-tipo" name="filtro-tipo">
                    <option value="">Seleccionar</option>
                    <?php foreach ($tipo as $row) {?>
                        <option value="<?=$row->iIdTipoEvaluacion;?>"><?=$row->vTipoEvaluacion;?></option>
                    <?php } ?>
                </select>
                </div>
                <div class="col md-4"> 
                    <label>Palabra clave: </label>
                    <div class="input-group mb-12">
                        <input type="text" class="form-control" name="filtro-texto_busqueda" id="filtro-texto_busqueda" placeholder="" aria-label="" aria-describedby="basic-addon1">
                            <div class="input-group-append">
                                <button class="btn btn-info" type="button" onclick="filter()"><i class="ti-search"></i>&nbsp;Buscar</button>
                            </div>
                    </div> 
                </div>
                <button class="btn btn-success col-md-2" type="button" onclick="agregar();" style="margin-top:25px;"><i class="fas fa-lg fa-fw m-r-10 fa-plus-circle"></i>Nueva plantilla</button>
                </div>
                </div> 
                </form>
            </div>  
        </div>


                <div id="panel-contenido"></div>
                <input type="hidden" id="currentPage">
    
        <link rel="stylesheet" href="<?=base_url()?>admin/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css">
	    <link rel="stylesheet" href="<?=base_url()?>admin/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css">
        <script src="<?=base_url()?>admin/assets/plugins/DataTables/media/js/jquery.dataTables.js"></script>
		<script src="<?=base_url()?>admin/assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
		<script src="<?=base_url()?>admin/assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
		<script src="<?=base_url()?>admin//assets/js/datatable.js"></script>
		<script>
		$(document).ready(function() {
			TableManageDefault.init();
		});
		</script>
    <script>
            
            $("#panel-contenido").load('<?=base_url()?>C_plantilla/tabla');
            </script>

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
						$.get("<?=base_url()?>C_plantilla/borrar_ajax/"+id, 
						function(data) {
							if(data == 1){
								$("#contenido").load('<?=base_url()?>C_plantilla/index');
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

            function filter(){
				$.ajax({
    				// la URL para la petición
    				url : '<?=base_url()?>C_plantilla/tabla',
					// la información a enviar
    				// (también es posible utilizar una cadena de datos)
    				data : $("#frmbusqueda").serialize(),
    				// especifica si será una petición POST o GET
    				type : 'POST',
					async: false,
    				// el tipo de información que se espera de respuesta
    				//dataType : 'json',
    				// código a ejecutar si la petición es satisfactoria;
    				// la respuesta es pasada como argumento a la función
    				success : function(json) {
						$("#panel-contenido").html(json);
						stateSave();
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

            function editar(key){
				$("#currentPage").val(table.page());
				var url = '<?=base_url()?>C_plantilla/modificar_plantilla/'+key;
				$(".panel-busqueda").hide();
				$("#panel-contenido").load(url);
			}

			function agregar(){
				$("#currentPage").val(table.page());
				var url = '<?=base_url()?>C_plantilla/guardar_plantilla';
				$(".panel-busqueda").hide();
				$("#panel-contenido").load(url);
			}

            function agregarC(key){
				$("#currentPage").val(table.page());
				var url = '<?=base_url()?>C_plantilla/guardar_cuestionario/'+key;
				$(".panel-busqueda").hide();
				$("#panel-contenido").load(url);
			}

            function stateSave(){
				$( document ).ready(function() {
					if(!$('.panel-busqueda').is(":visible")){
						var currentPage = parseInt($("#currentPage").val());
						table.page(currentPage).draw('page');
						$(".panel-busqueda").show();
					}
				});
			}
            </script>

</body>
</html>