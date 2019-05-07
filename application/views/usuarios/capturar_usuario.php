<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Chosen
	============================================= -->
    <link rel="stylesheet" href="<?=base_url();?>public/chosen/chosen.min.css?v=3" type="text/css" />
</head>

<body>
	<div class="card">
		<div class="card-body">
			<form action="#" id="register-form">
		        <div class="form-body">

		            <div class="row">
		                <div class="col-md-4">
		                    <div class="form-group">
		                    	<label>Nombre</label>
		                    	<input type="hidden" name="iIdUsuario" id="iIdUsuario" value="<?=$iIdUsuario;?>">
		                    	<input type="hidden" id="vista_admin" name="vista_admin" class="form-control" value="1">
		                        <input type="text" id="nombre" name="nombre" class="form-control" value="<?=$vNombre;?>">
		                    </div>
		                </div>
		                <div class="col-md-4">
		                    <div class="form-group">
		                    	<label>Apellido paterno</label>
		                        <input type="text" id="apellido_paterno" name="apellido_paterno" class="form-control" value="<?=$vApellidoPaterno;?>">
		                    </div>
		                </div>
		                <div class="col-md-4">
		                    <div class="form-group">
		                    	<label>Apellido materno</label>
		                        <input type="text" id="apellido_materno" name="apellido_materno" class="form-control" value="<?=$vApellidoMaterno;?>">
		                    </div>
		                </div>
		            </div>

					<div class="row">
		                <div class="col-md-4">
		                    <div class="form-group">
		                    	<label>Correo</label>
		                        <input type="text" id="correo" name="correo" class="form-control" value="<?=$vCorreo;?>">
		                    </div>
		                </div>
		                <?php if($iIdUsuario == 0 ){ ?>
		                <div class="col-md-4">
		                    <div class="form-group">
		                    	<label>Contraseña</label>
		                        <input type="password" id="contrasenia" name="contrasenia" class="form-control" value="">
		                    </div>
		                </div>
		                <div class="col-md-4">
		                    <div class="form-group">
		                    	<label>Repita la contraseña</label>
		                        <input type="password" id="contrasenia2" name="contrasenia2" class="form-control" value="">
		                    </div>
		                </div>
		            <?php } ?>
		            </div>

		            <div class="row">
		                <div class="col-md-4">
		                    <div class="form-group">
		                    	<label>Fecha de nacimiento</label>
		                        <div class="row">
		                        	<div class="col-md-4">
		                        		<select name="dia" id="dia" class="form-control">
											<?php echo $op_dias; ?>
										</select>
		                        	</div>
		                        	<div class="col-md-4">
		                        		<select name="mes" id="mes" class="form-control">
											<?php echo $op_meses; ?>
										</select>
		                        	</div>
		                        	<div class="col-md-4">
		                        		<select name="anio" id="anio" class="form-control">
											<?php echo $op_anios; ?>
										</select>
		                        	</div>
		                        </div>
		                    </div>
		                </div>
		                <div class="col-md-4">
		                    <div class="form-group">
		                    	<label>Genero</label>
		                        <select name="genero" id="genero" class="form-control">
									<option value="0">Seleccione un género</option>
									<option value="1" <?php if($iGenero == 1) echo 'selected'; ?>>Hombre</option>
									<option value="2" <?php if($iGenero == 2) echo 'selected'; ?>>Mujer</option>
									<option value="3" <?php if($iGenero == 3) echo 'selected'; ?>>Otro</option>
								</select>
		                    </div>
		                </div>
		                <div class="col-md-4">
		                    <div class="form-group">
		                    	<label for="register-form-name">Código postal:</label>
								<input type="text" id="codigo_postal" name="codigo_postal" class="form-control" onkeypress="return SoloDigitos(event);" maxlength="5" onblur="CompletarCampos();" data-toggle="tooltip" data-placement="top" title="Indique su código postal" value="<?=$iCodigoPostal;?>" />
								<input type="hidden" name="id_asentamiento" id="id_asentamiento" value="<?=$iIdAsentamiento;?>">
								<div class="form-check">
									<input type="checkbox" class="form-check-input" id="sincp" onchange="Determinar_CP(this);">
									<label class="form-check-label" for="exampleCheck1">No conozco el código postal</label>
								</div>
		                        
		                    </div>
		                </div>
		            </div>

		            <div class="row" id="divop1">
		                <div class="col-md-4">
		                	<div class="form-group">
			                	<label for="register-form-name">Colonia:</label>
								<select name="selasentamiento1" id="selasentamiento1" class="form-control" onchange="MostrarInfoFaltante();">
									<?php echo $op_asentamientos;?>
								</select>
							</div>
		                </div>
		                <div class="col-md-4">
		                	<div class="form-group">
			                	<label for="register-form-name">Localidad:</label>
								<input type="text" id="localidad" name="localidad" class="form-control" readonly="readonly" value="<?=$vLocalidad;?>" />
							</div>
		                </div>
		                <div class="col-md-4">
		                	<div class="form-group">
			                	<label for="register-form-name">Municipio:</label>
								<input type="text" id="municipio" name="municipio" class="form-control" readonly="readonly" value="<?=$vMunicipio;?>"/>
							</div>
		                </div>
	                </div>
		            
		            <!-- En caso de conocer el código postal -->
		            <div id="divop2" class="row" style="display: none;">
						<div class="col-md-4">
							<div class="form-group">
								<label for="register-form-name">Municipio:</label>
								<select name="selmunicipio" id="selmunicipio" class="form-control chosen-select" onchange="CargarListado('localidades', 'selmunicipio', 'sellocalidad');">
									<?php echo $op_municipios; ?>
								</select>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="register-form-name">Localidad:</label>
								<select name="sellocalidad" id="sellocalidad" class="form-control chosen-select" onchange="CargarListado('asentamientos', 'sellocalidad', 'selasentamiento');">
									<?php echo $op_localidades;?>
								</select>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="register-form-name">Colonia:</label>
								<select name="selasentamiento" id="selasentamiento" class="form-control chosen-select" onchange="MostrarCP(this);">
									<?php echo $op_asentamientos;?>
								</select>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="register-form-name">Nivel de estudio:</label>
								<select name="id_grado_estudio" id="id_grado_estudio" class="form-control">
									<?php echo $op_grados_estudio; ?>
								</select>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="register-form-name">Ocupación:</label>
								<select name="id_ocupacion" id="id_ocupacion" class="form-control chosen-select validate[required]" data-prompt-position="inline" data-prompt-target="id_ocupacion">
									<?php echo $op_ocupaciones; ?>
								</select>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="register-form-name">Rol en el sistema:</label>
								<select name="id_rol" id="id_rol" class="form-control" data-prompt-position="inline">
									<?php echo $op_roles; ?>
								</select>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<button class="btn btn-success" id="register-form-submit" name="register-form-submit" value="register">Guardar</button>
							</div>
						</div>
					</div>


		        </div>
		    </form>
		</div>
	</div>
</body>
<!-- Chosen
============================================= -->
<script src="<?=base_url();?>public/chosen/chosen.jquery.min.js"></script>
<script src="<?=base_url();?>public/chosen/chosen.proto.min.js"></script>

<script type="text/javascript">
	

	$(document).ready(function(){
		$(".chosen-select").chosen({width: "100%"});
		$('[data-toggle="tooltip"]').tooltip();

		$( "#register-form" ).validate({
			ignore: [],
			highlight: function (element) {
				if( $("#"+element.id).hasClass('chosen-select')){
					$("#"+element.id+"_chosen").addClass("error_chosen");
				}else $(element).closest('.form-control').addClass('error');
			},
			unhighlight: function (element) {
				//console.log(element);
				if( $("#"+element.id).hasClass('chosen-select')){
					$("#"+element.id+"_chosen").removeClass("error_chosen");
				}else $(element).closest('.form-control').removeClass('error');
			},
			errorPlacement: function (error, element) {
				if (element.hasClass("chosen-select")) {
					var id = ("#"+element[0].id)+"_chosen";
			      	error.insertAfter($(id));
			    }else{
			    	error.insertAfter(element);
			    }					
			},
		  	rules: {
		    	nombre: {
		      		required: true
		    	},
		    	contrasenia: {
		      		required: true
		    	},
		    	contrasenia2: {
		      		required: true,
		      		equalTo: "#contrasenia"
		    	},
		    	correo: {
		      		required: true,
		      		email: true
		    	},
		    	dia: {			      		
		      		min: 1
		    	},
		    	mes: {
		      		min: 1
		    	},
		    	anio: {
		      		min: 1
		    	},
		    	genero: {			      		
		      		min: 1
		    	},
		    	codigo_postal: {
		      		required: true,
		      		minlength: 5
		    	},
		    	id_grado_estudio: {
			 		min: 1
			 	},
			 	id_ocupacion:{
			 		min: 1
			 	},
			 	id_rol:{
			 		min: 1
			 	}

		  	},
		  	messages: {
		  		nombre: "Por favor rellene este campo",
			    apellido_paterno: "Por favor rellene este campo",
			    contrasenia: "Por favor rellene este campo",
			    contrasenia2:{
			    	required: "Por favor rellene este campo",
			    	equalTo: "Las contraseñas deben coincidir"
			 	},
			 	correo: {
			    	required: "Por favor rellene este campo",
			    	email: "Por favor ingrese un correo en formato ejemplo@dominio.com"
			    },
			    dia:{
			    	min: "Por favor elija un opción",

			    },
			    mes:{
			    	min: "Por favor elija un opción",

			    },
			    anio:{
			    	min: "Por favor elija un opción",

			    },				 	
			 	genero:{
			 		min: "Por favor elija una opción"	
			 	},
			 	codigo_postal:{
			 	 	required:"Por favor rellene este campo",
			 	 	minlength: "Por favor ingrese un código poostal válido"
			 	},
			 	id_grado_estudio: {
			 		min: "Por favor elija una opción"
			 	},
			 	id_ocupacion: {
			 		min: "Por favor elija una opción"
			 	},
			 	id_rol: {
			 		min: "Por favor elija una opción"
			 	}
			    
		  	},
		  	submitHandler: function(form){
		  		if(ValidarFecha())
		  		{
		  			GuardarUsuario(form);
		  		}
		  		else 
		  		{
		  			Notificacion('La fecha ingresada no es válida','error');
		  		}
		  	}
		});

	});

	function GuardarUsuario(form)
	{
		var loading;
		$.ajax({
	        url: '<?=base_url();?>C_seguridad/guardar_usuario',
	        type: 'POST',
	        async: false,	//	Para obligar al usuario a esperar una respuesta
	        data: $(form).serialize(),
	        error: function(XMLHttpRequest, errMsg, exception){
	            var msg = "Ha fallado la petición al servidor";
	            loading.out();
	            alert(msg);
	        },
	         beforeSend: function(){
	           loading = new Loading({
	                discription: 'Espere...',
	                defaultApply: true
	            });
	        },
	        success: function(htmlcode){
	        	loading.out();
	        	var cod = htmlcode.split("-");
	        	switch(cod[0])
	            {
	                case "0":
	                	if($("#iIdUsuario").val() > 0) Notificacion('Los datos han sido guardados','success');
	                	else Notificacion('Un correo ha sido enviado para confirmar la cuenta','success');
	                	Buscar(1);
	                    break;
	                case "*":
	                	$("#modal_login").modal();
	                default:
	                    Notificacion(htmlcode,'error');
	                    break;
	            }
	        }
	    });
	}

		function Determinar_CP(check)
		{
			if( $(check).is(":checked") )
			{
				$('#divop1').css('display','none');
				$('#divop2').css('display','');
				$('#codigo_postal').prop('readonly', true);
			}else 
			{
				$('#divop1').css('display','');
				$('#divop2').css('display','none');
				$('#codigo_postal').prop('readonly', false);
			}
		}

		function CompletarCampos()
		{
			
			var patron = /chosen-select/g;
			var codigo_postal = Trim($("#codigo_postal").val());
			if (codigo_postal != '' )
			{
				var loading = new Loading({
					discription: 'Espere...',
			    	defaultApply: true
			    });
				$.post("<?=base_url();?>Sitio/listado_dependiente",{nombrelst:'codigo_postal',valor:codigo_postal},function(resultado,status){
					$('#selasentamiento1 option[value!=""]').remove();
					if(codigo_postal > 0 && codigo_postal != '')
					{ // En este caso se utiliza el largo de la cadena debido a que no se recibe numero si no cadenas
						$('#selasentamiento1').append(resultado);
						$('#selasentamiento1').attr("disabled",false);
						MostrarInfoFaltante();
					}
					else $('#selasentamiento1').attr("disabled",true);

					if(patron.test($('#selasentamiento1').attr('class'))) $('#selasentamiento1').chosen({width:"100%"});
					loading.out();
				});	
			}else alert('Por favor, indique un código postal');
			
		}

		function MostrarInfoFaltante()
		{
			var loading = new Loading({
					discription: 'Espere...',
			    	defaultApply: true
			    });

			var id_asentamiento = $("#selasentamiento1 option:selected").attr('value');

			$.post("<?=base_url();?>Sitio/listado_dependiente",{nombrelst:'datos_faltantes',valor:id_asentamiento},function(resultado,status){
				var datos = jQuery.parseJSON(resultado);

				$("#municipio").val(datos.municipio);
				$("#localidad").val(datos.localidad);
				$("#id_asentamiento").val(datos.id_asentamiento);
			});
			loading.out();
		}

		function MostrarCP(t)
		{
			var id_asentamiento = $('option:selected',t).attr('value');
			var codigo_postal = $('option:selected',t).attr('rel');
			if(id_asentamiento != 0)
			{
				$("#id_asentamiento").val(id_asentamiento);
				$("#codigo_postal").val(codigo_postal);				
			}

		}

		function ValidarFecha()
		{
			var dia = $("#dia option:selected").attr('value');
			var mes = $("#mes option:selected").attr('value');
			var anio = $("#anio option:selected").attr('value');

			var fecha = mes+'/'+dia+'/'+anio;
			

			return IsDate(fecha);
		}
		
		function IsDate(txtDate, separator)
		{
			//	txtDateFormat in m/d/yyyy
		    var aoDate,           // needed for creating array and object
		        ms,               // date in milliseconds
		        month, day, year; // (integer) month, day and year
		    // if separator is not defined then set '/'
		    if (separator === undefined) {
		        separator = '/';
		    }
		    // split input date to month, day and year
		    aoDate = txtDate.split(separator);
		    // array length should be exactly 3 (no more no less)
		    if (aoDate.length !== 3) {
		        return false;
		    }
		    // define month, day and year from array (expected format is m/d/yyyy)
		    // subtraction will cast variables to integer implicitly
		    month = aoDate[0] - 1; // because months in JS start from 0
		    day = aoDate[1] - 0;
		    year = aoDate[2] - 0;
		    // test year range
		    if (year < 1000 || year > 3000) {
		        return false;
		    }
		    // convert input date to milliseconds
		    ms = (new Date(year, month, day)).getTime();
		    // initialize Date() object from milliseconds (reuse aoDate variable)
		    aoDate = new Date();
		    aoDate.setTime(ms);
		    // compare input date and parts from Date() object
		    // if difference exists then input date is not valid
		    if (aoDate.getFullYear() !== year ||
		        aoDate.getMonth() !== month ||
		        aoDate.getDate() !== day) {
		        return false;
		    }
		    // date is OK, return true
		    return true;
		}

	
</script>
</html>