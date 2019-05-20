 <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="table table-hover table-bordered dataTable no-footer dtr-inline" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            </div>
            <h4 class="panel-title">Resultados de la búsqueda</h4>
        </div> <br>
        <div class="col-md-12">
            <table id="listado" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Título</th>
                        <th scope="col">Nombres</th>
                        <th scope="col">Apellido paterno</th>
                        <th scope="col">Apellido materno</th>
                        <th scope="col">Correo principal</th>
                        <!-- <th scope="col">Correo 2</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Cargo</th>
                        <th scope="col">Celular</th> -->
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody class="contenidobusqueda">

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
                                <button type="button" class="btn btn-grey btn-icon btn-sm" onclick="cargar('<?=base_url(); ?>C_usuario/guardar/<?=$p->iIdUsuario?>/1','#contenido');" title="Editar"><i class="fas fa-pencil-alt fa-fw"></i></button>
                                
                                <button type="button" class="btn btn-primary btn-icon btn-sm" onclick="cargar('<?=base_url(); ?>C_usuario/ver/<?=$p->iIdUsuario?>/1','#contenido');" title="Ver"><i class="fas fa-user fa-fw"></i></i></button>
                                
                                <button type="button" class="btn btn-danger btn-icon btn-sm" onclick="deleteRow(<?php echo $p->iIdUsuario ?>)" title="Eliminar"><i class="fas fa-trash-alt fa-fw"></i></button>
                            </td> 
                        </tr>
                    <?php endforeach; ?>       
                </tbody>
            </table>
            </div>
            <div class="col-md-12">
            <div class="row">
           
            </div>
        </div>
    </div>