<html>
    <head>

    </head>
    <body>
        <h3 class="page-header">Gestión de plantillas</h3>
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Filtros de búsqueda</h4>
            </div>
            <div class="panel-body">
                <form id="frmbusqueda">
                <div class="col md-12">
                <div class="row">
                    <div class="col-md-2">
                    <label>Año: </label>
                    <select class="form-control" id="anio" name="anio">
                        <option value="">Seleccionar</option>
                    <?php foreach ($anio as $row) {?>
                        <option value="<?=$row->iIdPlantilla;?>"><?=$row->iAnioEvaluacion;?></option>
                    <?php } ?>
                    </select>
                    </div>
                <div class="col-md-2">
                <label>Origen: </label>
                <select class="form-control" id="origen" name="origen">
                    <option value="">Seleccionar</option>
                    <?php foreach ($origen as $row) {?>
                        <option value="<?=$row->iIdPlantilla;?>"><?=$row->iOrigenEvaluacion;?></option>
                    <?php } ?>
                </select>
                </div>
                <div class="col-md-2">
                <label>Tipo: </label>
                <select class="form-control" id="tipo" name="tipo">
                    <option value="">Seleccionar</option>
                    <?php foreach ($tipo as $row) {?>
                        <option value="<?=$row->iIdTipoEvaluacion;?>"><?=$row->vTipoEvaluacion;?></option>
                    <?php } ?>
                </select>
                </div>
                <div class="col md-4"> 
                    <label>Palabra clave: </label>
                    <div class="input-group mb-12">
                        <input type="text" class="form-control" name="texto_busqueda" id="texto_busqueda" placeholder="" aria-label="" aria-describedby="basic-addon1">
                            <div class="input-group-append">
                                <button class="btn btn-info" type="button" onclick="filter()"><i class="ti-search"></i>&nbsp;Buscar</button>
                            </div>
                    </div> 
                </div>
                <a class="btn btn-success col-md-2" type="button" name="guardar" id="guardar" onclick="cargar('<?=base_url(); ?>C_plantilla/guardar_plantilla/0/1','#contenido');"style="margin-top:25px; color: white;"><i class="fas fa-lg fa-fw m-r-10 fa-plus-circle" style="color: white"></i>Nueva plantilla</a>
                </div>
                </div> 
                </form>
            </div>  
        </div>

            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="table table-hover table-bordered dataTable no-footer dtr-inline" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    </div>
                    <h4 class="panel-title">Resultados de la búsqueda</h4>
                </div> <br>
                <div class="col-md-12" id="table">
                
                    </div>
                    <div class="col-md-12">
                    <div class="row">
           
            </div>
        </div>
    </div>
    
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
    <script>
            
            $("#table").load('<?=base_url()?>C_plantilla/tabla');
            </script>

</body>
</html>