
<table id="data-table-default" class="table table-striped table-bordered">
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
			    <button onclick="cargar('<?=base_url();?>C_IntervencionPropuesta/edit/<?php echo $r->iIdIntervencionPropuesta; ?>', '#contenido');" class="btn btn-success btn-icon btn-sm"><i class="fas fa-fw fa-edit"></i></button>
		
			    <button onclick="Aprobar(<?php echo $r->iIdIntervencionPropuesta; ?>)" class="btn btn-grey btn-icon btn-sm"><i class="fas fa-lg fa-fw  fa-check-circle"></i></button>
			
			    <button onclick="confirmar('¿Desea eliminar este registro?',eliminar,'<?php echo $r->iIdIntervencionPropuesta; ?>');" class="btn btn-danger btn-icon btn-sm"><i class="fas fa-lg fa-fw  fa-exclamation-triangle"></i></button>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<script>
    $(document).ready(function() {
	    TableManageDefault.init();
    });
</script>