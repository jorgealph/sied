
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
				<li class="breadcrumb-item"><a href="javascript:;">Page Options</a></li>
				<li class="breadcrumb-item active">Blank Page</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Blank Page <small>header small text goes here...</small></h1>
			<!-- end page-header -->
			
			<!-- begin panel -->
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">Panel Title here</h4>
				</div>
				<div class="panel-body">
					<a href="#" class="btn" onclick="cargar('http://localhost/sied/C_intervencionpropuesta/mostrar_crud','#contenido');"> Agregar propuesta </a>
					<table class="table">
                        <thead class="thead-dark">
                            <td>
                                Intervención pública
                            </td>
                            <td>
                                Año de creación
                            </td>
                            <td>
                                Año de evaluación
                            </td>
                            <td>
                                Eje
                            </td>
                            <td>
                                Dependencia
                            </td>
                            <td>
                                Tipo de intervención
							</td>
							<td>
								Acción
							</td>
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
									<a href="#" class="btn">Editar</a>
									<a href="#" class="btn">Eliminar</a>
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