<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    
</head>

<body>
    <h3 class="page-header">Organismos</h3>

    <div class="panel panel-inverse">
        <div class="panel-heading">
            <h4 class="panel-title">Filtros de búsqueda</h4>
        </div>
        <div class="panel-body">
	
			<form action="#" id="formbusqueda">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Eje</label>
                            <select class="form-control" id="iIdEje" name="iIdEje">
                                <option value="0">-Todos-</option>
                                <?=$options_eje?>
                            </select>
                        </div>
                    	<div class="col-md-7">
                    		<label>Nombre del organismo</label>
                    		<div class="input-group mb-12">
                                <input type="text" class="form-control" name="texto_busqueda" id="texto_busqueda" placeholder="" aria-label="" aria-describedby="basic-addon1">
                                <div class="input-group-append">
                                    <button class="btn btn-info" type="submit" onclick="buscar(0,event);"><i class="ti-search"></i>&nbsp;Buscar</button>
                                </div>
                            </div>
                    	</div>
                    	<div class="col-md-2">
                			<button class="btn btn-success" type="button" onclick="capturar(0);" style="margin-top:25px;"><i class="fas fa-lg fa-fw m-r-10 fa-plus-circle"></i>Nuevo organismo</button>
                    	</div>
                    </div>
                   
                </div>
            </form>
		</div>
	</div>

    <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            </div>
            <h4 class="panel-title">Resultados de la búsqueda</h4>
        </div>
        <div class="panel-body" id="listado"><?=$tabla_registros?></div>
    </div>
</body>
<script type="text/javascript">
    $(document).ready(function(){
        $('#tabla_registros').DataTable({
            responsive: true,
            searching: false,
            lengthChange: false
        });
    });

	function eliminar(id){
        $.post("<?=base_url();?>C_organismo/eliminar",{id:id},function(resultado,status){
        	if(resultado == "0"){                		
        	 	notificacion('El registro ha sido eliminado','success');
        	 	buscar();
        	}
    		else notificacion('El registro no pudo ser eliminado','error');					
    	});
	}

	function buscar(pag,e){
        if (!e) { var e = window.event; }
        e.preventDefault();

		var pag = pag || 1;

		var variables = $("#formbusqueda").serialize();
		variables = variables + '&pag=' + pag;

		cargar('<?=base_url();?>C_organismo/buscar','#listado','POST',variables);
	}
    

	function capturar(id){
		var vars = 'id=' + id;
		cargar('<?=base_url();?>C_organismo/capturar','#contenido','POST',vars);
	}

    function regresar(e){
        if (!e) { var e = window.event; }
        e.preventDefault();

        cargar('<?=base_url();?>C_organismo/index','#contenido','POST');
    }
</script>
</html>