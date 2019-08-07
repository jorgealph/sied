<div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="table table-hover table-bordered dataTable no-footer dtr-inline" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    </div>
                    <h4 class="panel-title">Resultados de la búsqueda</h4>
                </div> <br>
            
            <table id="data-table" class="table table-striped table-bordered">
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
                            <td><?php echo $p->vTipoEvaluacion ?></td>
                            <td><?php $p->iOrigenEvaluacion == 1 ? print_r("Interna") : print_r("Externa") ?></td>
                             <td>
                                <button type="button" class="btn btn-grey btn-icon btn-sm" onclick="editar('<?=$p->iIdPlantilla?>/1');" title="Editar"><i class="fas fa-pencil-alt fa-fw"></i></button>

                                <button type="button" class="btn btn-primary btn-icon btn-sm" onclick="agregarC('<?=$p->iIdPlantilla?>/1');" title="Cuestionario"><i class="fas fa-edit fa-fw"></i></i></button>
                                
                                <button type="button" class="btn btn-danger btn-icon btn-sm" onclick="deleteRow(<?php echo $p->iIdPlantilla ?>)" title="Eliminar"><i class="fas fa-trash-alt fa-fw"></i></button>
                            </td> 
                        </tr>
                    <?php endforeach; ?>       
                </tbody>
            </table>
            </div>
         <script>
    
		$(document).ready(function() {
			TableManageDefault.init();
		});
		
    </script>