<html>
    <head>

    </head>
    <body>
    <h3 class="page-header panel-busqueda">Directorio</h3>
    <div class="panel panel-inverse panel-busqueda">
        <div class="panel-heading">
            <h4 class="panel-title">Filtros de búsqueda</h4>
        </div>
        <div class="panel-body">
            <form id="frmbusqueda" onsubmit="event.preventDefault()">
            <div class="col md-12">
            <div class="row">
                <div class="col-md-2">
                <label>Eje: </label>
                <select class="form-control" id="filtro-eje" name="filtro-eje">
                    <option value="">Seleccionar</option>
                <?php foreach ($eje as $row) {?>
                    <option value="<?=$row->iIdEje;?>"><?=$row->vEje;?></option>
                <?php } ?>
                </select>
                </div>
            <div class="col-md-3">
            <label>Dependecia: </label>
            <select class="form-control" id="filtro-organismo" name="filtro-organismo">
            <option value="">Seleccionar</option>
            <?php foreach ($organismo as $row) {?>
                <option value="<?=$row->iIdOrganismo;?>"><?=$row->vOrganismo;?></option>
            <?php } ?>
            </select>
            </div>
            <div class="col md-5"> 
                <label>Palabra clave: </label>
                <div class="input-group mb-12">
                    <input type="text" class="form-control" name="filtro-texto_busqueda" id="filtro-texto_busqueda" placeholder="" aria-label="" aria-describedby="basic-addon1">
                        <div class="input-group-append">
                            <button class="btn btn-info" type="button" onclick="filter()"><i class="ti-search"></i>&nbsp;Buscar</button>
                        </div>
                </div>
            </div>
            <button class="btn btn-success col-md-2" type="button" onclick="agregar()" style="margin-top:25px;"><i class="fas fa-lg fa-fw m-r-10 fa-plus-circle"></i>Nuevo usuario</button>
            </div>
            </div> 
            </form>
        </div>  
    </div>
    
    <div id="panel-contenido"></div>
    <input type="hidden" id="currentPage">

             <script>
                var id;
                var link;
                function post (e){
                    e.preventDefault();
                    cargar('<?=base_url(); ?>C_usuario/guardar','#contenido');
                }

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
						$.get("<?=base_url()?>C_usuario/borrar_ajax/"+id, 
						function(data) {
							if(data == 1){
								$("#contenido").load('<?=base_url()?>C_usuario/listado');
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
            <link rel="stylesheet" href="<?=base_url()?>admin/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css">
	    <link rel="stylesheet" href="<?=base_url()?>admin/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css">
        <script src="<?=base_url()?>admin/assets/plugins/DataTables/media/js/jquery.dataTables.js"></script>
		<script src="<?=base_url()?>admin/assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
		<script src="<?=base_url()?>admin/assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
		<script src="<?=base_url()?>admin/assets/js/datatable.js"></script>
		<script>
		$(document).ready(function() {
			TableManageDefault.init();
		});
		</script>
        <script>
        $("#panel-contenido").load('<?=base_url()?>C_usuario/tabla');
        </script>

        <script>
        function filter(){
				$.ajax({
    				// la URL para la petición
    				url : '<?=base_url()?>C_usuario/tabla',
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
				var url = '<?=base_url()?>C_usuario/guardar/'+key;
				$(".panel-busqueda").hide();
				$("#panel-contenido").load(url);
			}

			function agregar(){
				$("#currentPage").val(table.page());
				var url = '<?=base_url()?>C_usuario/guardar/0/1';
				$(".panel-busqueda").hide();
				$("#panel-contenido").load(url);
			}

            function agregarC(key){
				$("#currentPage").val(table.page());
				var url = '<?=base_url()?>C_usuario/ver/'+key;
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