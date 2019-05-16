<html>
    <head>

    </head>
    <body>
    <div class="card bg-light" name="listado" id="listado">
        <div class="container">
                <br>
            <table id="data-table-default" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Título</th>
                        <th scope="col">Nombres</th>
                        <th scope="col">Apellido paterno</th>
                        <th scope="col">Apellido materno</th>
                        <th scope="col">Correo 1</th>
                        <!-- <th scope="col">Correo 2</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Cargo</th>
                        <th scope="col">Celular</th> -->
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($personas as $key => $p) : ?>
                        <tr>
                            <th scope="row"><?php echo $p->iIdUsuario ?></th>
                            <td><?php echo $p->vUsuario ?></td>
                            <td><?php echo $p->vTitulo ?></td>
                            <td><?php echo $p->vNombres ?></td>
                            <td><?php echo $p->vApellidoPaterno ?></td>
                            <td><?php echo $p->vApellidoMaterno ?></td>
                            <td><?php echo $p->vCorreo1 ?></td>
                           <!--  <td><?php //echo $p->vCorreo2 ?></td>
                            <td><?php //echo $p->vTelefono ?></td>
                            <td><?php //echo $p->vCargo ?></td>
                            <td><?php //echo $p->vCelular ?></td> -->
                             <td>
                                <i class="fas fa-pencil-alt fa-fw"></i>
                                <a href="#" onclick="cargar('<?=base_url(); ?>C_usuario/guardar/<?=$p->iIdUsuario?>/1','#here');">Editar</a>
                                <br>
                                <i class="fas fa-user fa-fw"></i>
                                <a href="#" onclick="cargar('<?=base_url(); ?>C_usuario/ver/<?=$p->iIdUsuario?>/1','#here');">Ver</a>
                                <br>
                                <i class="fas fa-trash-alt fa-fw"></i>
                                <a href="#" onclick="deleteRow(<?php echo $p->iIdUsuario ?>)">Borrar</a>
                            </td> 
                        </tr>
                    <?php endforeach; ?>       
                </tbody>
            </table>

           <!--  <div class="modal fade" id="DeletePerson" tabindex="-1" role="dialog" aria-labelledby="DeletePersonLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="DeletePersonLabel">
                                Vas a borrar al usuario:
                                <span></span>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary" id="b-borrar">Borrar</button>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="col-md-12">
            <div class="row">
            <a class="btn btn-primary col-md-3" name="guardar" id="guardar" onclick="cargar('<?=base_url(); ?>C_usuario/guardar/0/1','#here');">Nuevo usuario</a>
            </div>
            </div>
            </div>  
            <br>


             <script>
                var id;
                var link;
                function post (e){
                    e.preventDefault();
                    cargar('<?=base_url(); ?>C_usuario/guardar','#contenido');
                }
                
/*                 $('#DeletePerson').on('show.bs.modal', function (event) {
                    link = $(event.relatedTarget) // Button that triggered the modal
                    id = link.data('id') // Extract info from data-* attributes
                    var name = link.data('name') // Extract info from data-* attributes
                    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                    var modal = $(this)
                    modal.find('.modal-title span').text(name);
                })

                $("#b-borrar").click(function () {
                    $.ajax({
                        url: "C_usuario/borrar_ajax/" + id,
                        context: document.body
                    }).done(function (res) {
                        console.log(res)
                        $("#DeletePerson").modal('hide');
                        $(link).parent().parent().remove();
                    });
                }); */

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
		<script src="<?=base_url()?>admin/assets/js/demo/table-manage-default.demo.min.js"></script>
		<script>
		$(document).ready(function() {
			TableManageDefault.init();
		});
		</script>

        </div>
        <div id="here">
        
        </div>
    </body>
</html>