            <table id="listado" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Año de evaluación</th>
                        <th>Nombre del ASM</th>
                        <th>Programa evaluado</th>
                        <th>Dependencia responsable</th>
                       <!--  <th>% Avance</th> -->
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="contenidobusqueda">
                
                    <?php foreach ($asm as $key => $p) : ?>
                        <tr>
                            <th scope="row"><?php echo $p->iAnioEvaluacion ?></th>
                            <td><?php echo $p->vNombreASM ?></td>
                            <td><?php echo $p->vPlantilla ?></td>
                            <td><?php echo $p->vSiglas ?></td>
                             <td>
                                <button type="button" class="btn btn-grey btn-icon btn-sm" onclick="cargar('<?=base_url(); ?>C_asm/modificar_asm/<?=$p->iIdASM?>/1','#contenido');" title="Editar"><i class="fas fa-pencil-alt fa-fw"></i></button>
                                
                                <button type="button" class="btn btn-danger btn-icon btn-sm" onclick="deleteRow(<?php echo $p->iIdASM ?>)" title="Eliminar"><i class="fas fa-trash-alt fa-fw"></i></button>
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