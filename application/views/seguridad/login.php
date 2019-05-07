<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>SIED | Login Page</title>
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
	<link href="<?=base_url();?>admin/assets/plugins/parsley/src/parsley.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<script src="<?=base_url();?>admin/assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body class="pace-top bg-white">
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade">
	    <!-- begin login -->
        <div class="login login-with-news-feed">
            <!-- begin news-feed -->
            <div class="news-feed">
                <div class="news-image" style="background-image: url(<?=base_url();?>admin/assets/img/login-bg/bglogin.jpg)"></div>
            </div>
            <!-- end news-feed -->
            <!-- begin right-content -->
            <div class="right-content">
                <!-- begin login-header -->
                <div class="login-header">
                    <div class="brand">
                        <img src="<?=base_url()?>admin/assets/img/logo/logo_sied.png" width="100%">                       
                    </div>
                    <div class="icon">
                        <i class="fa fa-sign-in"></i>
                    </div>
                </div>
                <!-- end login-header -->
                <!-- begin login-content -->
                <div class="login-content">
                    <form id="login-form" name="login-form" method="post" action="" onsubmit="iniciarSesion(this,event);" class="margin-bottom-0"  data-parsley-validate="true">
                        <div class="form-group m-b-15">
							<input type="text" id="usuario" name="usuario" value="" class="form-control form-control-lg" autocomplete="off" placeholder="Usuario" autofocus required/>
                        </div>
                        <div class="form-group m-b-15">
							<input type="password" id="password" name="password" value="" class="form-control form-control-lg" autocomplete="off" placeholder="Password" required />
                        </div>
                        <div class="checkbox checkbox-css m-b-30">
							<div id="div_captcha"></div>
						</div>
                        <div class="login-buttons">
                            <button type="submit" class="btn btn-success btn-block btn-lg">Acceder</button>
                        </div>
                        <hr />
                        <p class="text-center text-grey-darker">
                            &copy; Secretaría Técnica de Planeación y Evaluación 2019
                        </p>
                    </form>
                </div>
                <!-- end login-content -->
            </div>
            <!-- end right-container -->
        </div>
        <!-- end login -->
       
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
	<script src="<?=base_url();?>admin/assets/plugins/parsley/dist/parsley.js?v=0.1"></script>
	<!-- ================== END BASE JS ================== -->
	<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"async defer></script>

	<script>
		var base_url = '<?=base_url()?>';
		$(document).ready(function() {
			App.init();
		});


		var get_r = <?php if(isset($_GET['r']) && !empty($_GET['r'])){echo 1;}else{echo 0;}?>;
		var div_captcha;
		var onloadCallback = function() {
	        div_captcha = grecaptcha.render('div_captcha', {
	          'sitekey' : '6LcFNH0UAAAAAELpmyqx2cXRiQQDG-Ip-Bk2ukFC'
	        });
	    };

	    function validarFormulario(f,objEsp){
			//	f: Objeto formulario (form)
			//	objEsp: Indica si se debe validar algún objeto no soportado por la librería Parsley.js
			var objEsp = objEsp || true;
			var expreg = /_$/;
			var resp = false;

			if(objEsp){
				for (i=0; i<f.elements.length; i++){
					objeto = f.elements[i];
					if(expreg.test(objeto.id)){
						//CKEditor
						var patron = /ckeditor/g;
						if(patron.test(objeto.className)){
							$("#"+objeto.id).val(CKEDITOR.instances[objeto.id].getData());
						}
					}
				}
			}

			resp = $("#"+f.id).parsley().validate();

			return resp;
		}
		

		function iniciarSesion(form,e){
			e.preventDefault();
			if(validarFormulario(form)){
			
				$.ajax({
			        url: base_url + 'acceder',
			        type: 'POST',
			        async: false,	//	Para obligar al usuario a esperar una respuesta
			        data: $(form).serialize(),
			        error: function(XMLHttpRequest, errMsg, exception){
			            var msg = "Ha fallado la petición al servidor";
			            alert(msg);
			        },
			        success: function(htmlcode){
			        	var cod = htmlcode.split("-");
			        	switch(cod[0]){
			                case "0":
			                    //Notificacion('Autentificado','success');			                    
			                    /*if(document.referrer && get_r == 1){
			                    	url = document.referrer;
			                    }*/
			                    window.location.href = base_url;
			                    
			                    break;
			                case "101":
			                	//Notificacion('Los datos son incorrectos','error');
			                	alert('Datos incorrectos');
			                	break;
			                default:
			                    //Notificacion(cod,'error');
			                    alert('Error: '+ cod);
			                    break;
			            }
			            grecaptcha.reset(div_captcha);
			        }
			    });
		    }	
		}
	</script>
</body>
</html>