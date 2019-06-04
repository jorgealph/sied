
            <table id="listado" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Nombre de la plantilla</th>
                        <th scope="col">Año</th>
                        <th scope="col">Orígen</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody class="contenidobusqueda">

                    <?php foreach ($plantilla as $key => $p) : ?>
                        <tr>
                            <th scope="row"><?php echo $p->vPlantilla ?></th>
                            <td><?php echo $p->iAnioEvaluacion ?></td>
                            <td><?php echo $p->iIdTipoEvaluacion ?></td>
                            <td><?php echo $p->iOrigenEvaluacion ?></td>
                             <td>
                                <button type="button" class="btn btn-grey btn-icon btn-sm" onclick="cargar('<?=base_url(); ?>C_usuario/guardar/<?=$p->iIdPlantilla?>/1','#contenido');" title="Editar"><i class="fas fa-pencil-alt fa-fw"></i></button>
                                
                                <button type="button" class="btn btn-danger btn-icon btn-sm" onclick="deleteRow(<?php echo $p->iIdPlantilla ?>)" title="Eliminar"><i class="fas fa-trash-alt fa-fw"></i></button>
                            </td> 
                        </tr>
                    <?php endforeach; ?>       
                </tbody>
            </table>
         <script>
         $(document).ready(function(){
            $('#listado').DataTable({
            responsive: true,
            searching: false,
            lengthChange: false
        });
    });</script>