<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>SIED | Panel</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="<?=base_url();?>admin/assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
	<link href="<?=base_url();?>admin/assets/plugins/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?=base_url();?>admin/assets/plugins/font-awesome/5.0/css/fontawesome-all.min.css" rel="stylesheet" />
	<link href="<?=base_url();?>admin/assets/plugins/animate/animate.min.css" rel="stylesheet" />
	<link href="<?=base_url();?>admin/assets/css/default/style.min.css" rel="stylesheet" />
	<link href="<?=base_url();?>admin/assets/css/default/style-responsive.min.css" rel="stylesheet" />
	<link href="<?=base_url();?>admin/assets/css/default/theme/default.css" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?=base_url();?>admin/assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="page-container fade page-sidebar-fixed page-header-fixed">
		<!-- begin #header -->
		<div id="header" class="header navbar-default">
			<!-- begin navbar-header -->
			<div class="navbar-header">
				<a href="#" class="navbar-brand"><img src="<?=base_url();?>admin/assets/img/logo/favicon.png" height="40px;"><b>SIED</b></a>
				<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<!-- end navbar-header -->
			
			<!-- begin header-nav -->
			<ul class="navbar-nav navbar-right">
				<li class="dropdown navbar-user">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
						<img src="<?=base_url();?>admin/assets/img/user/user.png" alt="" /> 
						<span class="d-none d-md-inline"><?=$_SESSION[PREFIJO.'_usuario']?></span> <b class="caret"></b>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<!--<a href="javascript:;" class="dropdown-item">Edit Profile</a>-->
						<div class="dropdown-divider"></div>
						<a href="#" onclick="salir();" class="dropdown-item">Cerrar sesión</a>
					</div>
				</li>
			</ul>
			<!-- end header navigation right -->
		</div>
		<!-- end #header -->
		
		<!-- begin #sidebar -->
		<div id="sidebar" class="sidebar">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- inicia menú -->
				<?php echo $menu; ?>
				<!-- termina menú -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="contenido" class="content">
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
					Panel Content Here
				</div>
			</div>
			<!-- end panel -->
		</div>
        <!-- end #content -->
        
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?=base_url();?>admin/assets/plugins/jquery/jquery-3.2.1.min.js"></script>
	<script src="<?=base_url();?>admin/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
	<script src="<?=base_url();?>admin/assets/plugins/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
	<!--[if lt IE 9]>
		<script src="../assets/crossbrowserjs/html5shiv.js"></script>
		<script src="../assets/crossbrowserjs/respond.min.js"></script>
		<script src="../assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="<?=base_url();?>admin/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?=base_url();?>admin/assets/plugins/js-cookie/js.cookie.js"></script>
	<script src="<?=base_url();?>admin/assets/js/theme/default.min.js"></script>
	<script src="<?=base_url();?>admin/assets/js/apps.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
		});
    </script>
    <script type="text/javascript">
    	var base_url = '<?=base_url();?>';
        <?php /*
        $(document).ready(function(){
            <?php if ($modulo_inicial != ''){ ?>
            Cargar('<?=$modulo_inicial;?>','#contenido');
            <?php } ?>
        }); */ ?>

      
       

      	function salir(){
      		if(confirm('¿Desea cerrar sesión?')){
      			$.ajax({
	                url: base_url + 'salir',
	                type: 'POST',
	                async: true,
	                success: function(htmlcode){
	                    window.location.href = base_url;
	                },
	                error: function(XMLHttpRequest, errMsg, exception){
	                    //Notificacion(errMsg,"error");
	                    alert('No pudimos cerrar su sesión');
	                }
            	});
      		}
      	}

        function Confirmar_cerrar_sesion()
        {
            $('#confirmar_cerrar_sesion').modal();
        }


        function Cerrar_sesion()
        {
            Swal({
              title: 'Cerrar sesión',
              text: '¿Realmente desea cerrar sesión?',
              type: 'question',
              showCancelButton: true,
              confirmButtonText: 'Confirmar',
              cancelButtonText: 'Cancelar'
            }).then((result) => {           
                if (result.value) {           
                    window.location.href = '<?=base_url(); ?>/Sitio/cerrar_sesion';
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                
                }
            });
        }

        function cargar(pagina,obj,metodo,variables)
        {
            var loading = '<div id="page-loader" class="fade in"><span class="spinner"></span></div>';

            if(typeof(metodo) == "undefined" || metodo == ""){ metodo = "POST";}
            if(typeof(variables) == "undefined" || variables == ""){ variables = "";}
            $(obj).html(loading);
            $.ajax({
                url: pagina,
                type: metodo,
                async: true,
                data: variables,
                success: function(htmlcode){
                    $(obj).html(htmlcode);
                },
                error: function(XMLHttpRequest, errMsg, exception){
                    Notificacion(errMsg,"error");
                }
            });
          
        }
    </script>
</body>
</html>