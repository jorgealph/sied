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
<table id="data-table" class="table table-hover table-bordered">
    <thead>
	    <tr>
		    <th>Intervención pública</th>
		    <th>Año de creación</th>
		    <th>Año de evaluación</th>
		    <th>Eje</th>
		    <th>Dependencia</th>
		    <th>Tipo de intervención</th>
		    <th width="100px">Acciones</th>
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
			} ?>
			</td>
			<td>
			    <button onclick="editar(<?=$r->iIdIntervencionPropuesta?>);" class="btn btn-grey btn-icon btn-sm"><i class="fas fa-pencil-alt fa-fw"></i></button>
		
			    <button onclick="Aprobar(<?php echo $r->iIdIntervencionPropuesta; ?>)" class="btn btn-success btn-icon btn-sm"><i class="fas fa-lg fa-fw fa-check-circle"></i></button>
			
			    <button onclick="confirmar('¿Desea eliminar este registro?',eliminar,'<?php echo $r->iIdIntervencionPropuesta; ?>');" class="btn btn-danger btn-icon btn-sm"><i class="fas fa-trash-alt fa-fw"></i></button>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>
</div>
					</div>
					
				</div>
				<!-- end panel -->'
<script>
    $(document).ready(function() {
	    TableManageDefault.init();
    });
</script>