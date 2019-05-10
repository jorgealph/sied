
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
				<li class="breadcrumb-item"><a href="javascript:;">Page Options</a></li>
				<li class="breadcrumb-item active">Blank Page</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Propuestas de intervenciones <!--<small>header small text goes here...</small>--></h1>
			<!-- end page-header -->
			
			<!-- begin panel -->
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					</div>
					<h4 class="panel-title">Captura de propuestas de intervenciones</h4>
				</div>
				<div class="panel-body">
                
	<link href="<?=base_url();?>admin/assets/plugins/parsley/src/parsley.css" rel="stylesheet">
	<link href="<?=base_url();?>admin/assets/plugins/jquery-smart-wizard/src/css/smart_wizard.css" rel="stylesheet">
	
<!-- begin wizard-form -->
<form action="/" method="POST" name="form-wizard" class="form-control-with-bg">
				<!-- begin wizard -->
				<div id="wizard">
					<!-- begin wizard-step -->
					<ul>
						<li class="col-md-3 col-sm-4 col-6">
							<a href="#step-1">
								<span class="number">1</span> 
								<span class="info text-ellipsis">
									Pestaña 1
									<small class="text-ellipsis">Name, Address, IC No and DOB</small>
								</span>
							</a>
						</li>
						<li class="col-md-3 col-sm-4 col-6">
							<a href="#step-2">
								<span class="number">2</span> 
								<span class="info text-ellipsis">
									Pestaña 2
									<small class="text-ellipsis">Email and phone no. is required</small>
								</span>
							</a>
						</li>
						<li class="col-md-3 col-sm-4 col-6">
							<a href="#step-3">
								<span class="number">3</span>
								<span class="info text-ellipsis">
									Pestaña 3
									<small class="text-ellipsis">Enter your username and password</small>
								</span>
							</a>
						</li>
						<li class="col-md-2 col-sm-4 col-6">
							<a href="#step-4">
								<span class="number">4</span> 
								<span class="info text-ellipsis">
									Finalizar
									<small class="text-ellipsis">Terminar registro</small>
								</span>
							</a>
						</li>
					</ul>
					<!-- end wizard-step -->
					<!-- begin wizard-content -->
					<div>
						<!-- begin step-1 -->
						<div id="step-1">
							<!-- begin fieldset -->
							<fieldset>
								<!-- Inicia parte 1 -->
					<div class="row" style="padding-bottom: 10px">
                        <div class="col-md-6">
                            <label for="" class="col-form-label text-md-left">Año del PAE</label>
                            <select name="" id="" class="form-control" data-parsley-min="1" data-parsley-required="true" data-parsley-group="step-1">
                                <option value="">Seleccionar</option>
                                <option value="1">2017</option>
                            </select>
                        </div>
                    </div>
                    <div class="row" style="padding-bottom: 10px">
                        <div class="col-md-6">
                            <label for="iIdEje" class="col-form-label text-md-left">Eje</label>
                            <select name="iIdEje" id="iIdEje" class="form-control" data-parsley-min="1" data-parsley-required="true" data-parsley-group="step-1">
                            <option value="">Seleccionar</option>
                                <option value="1">2017</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="iIdOrganismo" class="col-form-label text-md-left">Dependencia</label>
                            <select name="iIdOrganismo" id="iIdOrganismo" class="form-control" data-parsley-min="1" data-parsley-required="true" data-parsley-group="step-1">
                                <option value="">Seleccionar</option>
                                <option value="1">2017</option>
                            </select>
                        </div>
                    </div>
                    <div class="row" style="padding-bottom: 10px">
                        <div class="col-md-2">
                            <label for="vIntervencion" class="col-form-label text-md-left">Nombre de la intervención pública</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" name="vIntervencion" maxlength="250" id="vIntervencion" class="form-control" required data-parsley-group="step-1" data-parsley-required="true" data-parsley-maxlength="250">
                        </div>
                    </div>
                    <div class="row" style="padding-bottom: 10px">
                        <div class="col-md-2">
                            <label for="iAnioCreacion" class="col-form-label text-md-left"> Año de creación </label>
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="iAnioCreacion" id="iAnioCreacion" class="form-control" min="2000" max="2025" maxlength="4" data-parsley-group="step-1" data-parsley-required="true" data-parsley-type="number" data-parsley-min="2000" data-parsley-max="2025">
                        </div>
                        <div class="col-md-2" >
                            <label for="iAnioEvaluacion" class="col-form-label text-md-left"> Año de evaluación </label>
                        </div>
                        <div class="col-md-4" style="padding-left:32px">
                            <input type="number" name="iAnioEvaluacion" id="iAnioEvaluacion" class="form-control" min="2000" max="2025" maxlength="4" minlength="4" data-parsley-group="step-1" data-parsley-required="true" data-parsley-type="number" data-parsley-min="2000" data-parsley-max="2025" >
                        </div>
                    </div>
                    <div class="row" style="padding-bottom: 10px">
                        <div class="col-md-7">
                            <div class="row" style="padding-bottom: 10px">
                                <div class="col-md-4">
                                    <label for="iTipo" class="col-form-label text-md-left">Tipo de intervención pública</label>
                                </div>
                                <div class="col-md-8">
                                    <select name="iTipo" id="iTipo" class="form-control" data-parsley-min="1" data-parsley-required="true" data-parsley-group="step-1">
                                        <option value="">Seleccionar</option>
                                        <option value="1">Programa presupuestario</option>
                                        <option value="2">Fondo</option>
                                        <option value="3">Programa de bienes o servicio</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row" style="padding-bottom: 10px">
                                <div class="col-md-8">
                                    <label for="iEntregaBienServicio" class="col-form-label text-md-left">¿Entrega algún bien o servicio directamente a la población?</label>
                                </div>
                                <div class="col-md-4">
                                    <select name="iEntregaBienServicio" id="iEntregaBienServicio" class="form-control" data-parsley-min="0" data-parsley-required="true" data-parsley-group="step-1">
                                        <option value="">Seleccionar</option>
                                        <option value="1">Sí</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="iTipoPP" class="col-form-label text-md-left">Tipo de PP</label>
                                </div>
                                <div class="col-md-9">
                                    <select name="iTipoPP" id="iTipoPP" class="form-control" data-parsley-min="0" data-parsley-required="true" data-parsley-group="step-1">
                                        <option value="">Seleccionar</option>
                                        <option value="1">Próximamente</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding-bottom: 10px">
                        <div class="col-md-2">
                            <label for="vAreaResponsable" class="col-form-label text-md-left">Área responsable</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" name="vAreaResponsable" id="vAreaResponsable" class="form-control" required data-parsley-group="step-1" data-parsley-required="true" data-parsley-maxlength="200"maxlength="200">
                        </div>
                    </div>
                    <div class="row" style="padding-bottom: 10px">
                        <div class="col-md-2">
                            <label for="vObjetivo" class="col-form-label text-md-left">Próposito / objetivo de la intervención pública</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" name="vObjetivo" id="vObjetivo" class="form-control" required data-parsley-group="step-1" data-parsley-required="true" data-parsley-maxlength="200"maxlength="200">
                        </div>
                    </div>
                    <div class="row" style="padding-bottom: 10px">
                        <div class="col-md-2">
                            <label for="vPoblacionObjetivo" class="col-form-label text-md-left">Población objetiva</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" name="vPoblacionObjetivo" id="vPoblacionObjetivo" class="form-control" required data-parsley-group="step-1" data-parsley-required="true" data-parsley-maxlength="200"maxlength="200">
                        </div>
                    </div>
                    <!-- Termina parte 1 -->
							</fieldset>
							<!-- end fieldset -->
						</div>
						<!-- end step-1 -->
						<!-- begin step-2 -->
						<div id="step-2">
							<!-- begin fieldset -->
							<fieldset>
								<!-- Inicio de Alineación con el PED -->
                                <div class="row" style="padding-bottom: 10px">
                        <div class="col-md-12">
                            <label for="" class="col-form-label text-md-left">Alineación con el PED</label>
                        </div>
                        <div class="col-md-1">
                            <label for="" class="col-form-label text-md-left">Eje</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="" id="" class="form-control">
                        </div>

                        <div class="col-md-1">
                            <label for="" class="col-form-label text-md-left">Tema</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="" id="" class="form-control">
                        </div>

                        <div class="col-md-1">
                            <label for="" class="col-form-label text-md-left">Objetivo</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="" id="" class="form-control">
                        </div>
                    </div>
                    <div class="row" style="padding-bottom: 10px">
                        <div class="col-md-12">
                            <label for="">Alineación con programas de mediano plazo</label>
                        </div>
                        <div class="col-md-1">
                            <label for="" class="col-form-label text-md-left">PMP</label>
                        </div>
                        <div class="col-md-5">
                            <input type="text" name="" id="" class="form-control">
                        </div>
                        <div class="col-md-1">
                            <label for="" class="col-form-label text-md-left">Objetivo</label>
                        </div>
                        <div class="col-md-5">
                            <input type="text" name="" id="" class="form-control">
                        </div>
                    </div>
                    <div class="row" style="padding-bottom: 10px">
                        <div class="col-md-2">
                            <label for="nPresupuestoEjercidoAnterior" class="col-form-label text-md-left">Presupuesto ejercido en 2017</label>
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="nPresupuestoEjercidoAnterior" id="nPresupuestoEjercidoAnterior" class="form-control" data-parsley-type="number" placeholder="0.00" data-parsley-required="true" data-parsley-group="step-2">
                        </div>
                        <div class="col-md-2">
                            <label for="nPresupuestoEjercido" class="col-form-label text-md-left">Presupuesto ejercido en 2018</label>
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="nPresupuestoEjercido" id="nPresupuestoEjercido" class="form-control" data-parsley-type="number" data-parsley-required="true" placeholder="0.00" data-parsley-group="step-2">
                        </div>
                        <div class="col-md-2">
                            <label for="nPresupuestoEjercidoAprobado" class="col-form-label text-md-left">Presupuesto ejercido en 2019</label>
                        </div>
                        <div class="col-md-2">
                            <input type="numeric" name="nPresupuestoEjercidoAprobado" id="nPresupuestoEjercidoAprobado" class="form-control" data-parsley-type="number" data-parsley-required="true" placeholder="0.00" data-parsley-group="step-2">
                        </div>
                    </div>
                    <div class="row" style="padding-bottom: 10px">
                        <div class="col-md-3">
                            <label for="iEjerceRecursoRamo33" class="col-form-label text-md-left">¿Ejerce recursos del Ramo 33?</label>
                        </div>
                        <div class="col-md-3">
                            <select name="iEjerceRecursoRamo33" id="iEjerceRecursoRamo33" class="form-control" data-parsley-min="0" data-parsley-required="true" data-parsley-group="step-2">
                                <option value="">Seleccionar</option>
                                <option value="1">Sí</option>
                                <option value="0">No</option>
                             </select>
                        </div>
                        <div class="col-md-3">
                            <label for="iEjerceRecursoRamo23" class="col-form-label text-md-left">¿Ejerce recursos del Ramo 23?</label>
                        </div>
                        <div class="col-md-3">
                            <select name="iEjerceRecursoRamo23" id="iEjerceRecursoRamo23" class="form-control" data-parsley-min="0" data-parsley-required="true" data-parsley-group="step-2">
                                <option value="">Seleccionar</option>
                                <option value="1">Sí</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="row" style="padding-bottom: 10px">
                        <div class="col-md-4">
                            <label for="" class="col-form-label text-md-left"> ¿Ejerce recursos de algún convenio o subsidio?</label>
                        </div>
                        <div class="col-md-3">
                            <select name="iEjerceRecursoConvenioSubsidio" id="iEjerceRecursoRamo23" class="form-control" data-parsley-min="0" data-parsley-required="true" data-parsley-group="step-2">
                                <option value="">Seleccionar</option>
                                <option value="1">Sí</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="vEspecificar" class="col-form-label text-md-left">Especificar</label>
                        </div>
                        <div class="col-md-3">
                            <textarea name="vEspecificar" id="vEspecificar" class="form-control" rows="2" data-parsley-group="step-2" data-parsley-maxlength="200" maxlength="200"></textarea>
                        </div>
                    </div>
                    <!-- Fin de Alineación con el PED -->
							</fieldset>
							<!-- end fieldset -->
						</div>
						<!-- end step-2 -->
						<!-- begin step-3 -->
						<div id="step-3">
							<!-- begin fieldset -->
							<fieldset>
								<!-- Inicia parte 3 -->
                                <div class="row" style="padding-bottom: 10px">
                                <div class="col-md-12">
                                    <label for="checks" > <strong>¿La intervención cuenta con los siguientes elementos básicos de diseño? </strong></label>
                                </div>
                        <!-- inline -->
                        <div class="col-md-4">
                            <div class="checkbox checkbox-css checkbox-inline">
                                <input type="checkbox" id="iDiagnostico"  />
                                <label for="iDiagnostico">Diagnóstico basado en el análisis del problema</label>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="checkbox checkbox-css checkbox-inline">
                                <input type="checkbox" id="iIdentificacion"  />
                                <label for="iIdentificacion">Identificación y cuantificación de la población objetiva</label>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="checkbox checkbox-css checkbox-inline">
                                <input type="checkbox" id="iInformeEstudio"  />
                                <label for="inlineCssCheckbox1">Informes o estudios de los resultados de la intervención</label>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="padding-bottom: 10px">
                        <!-- inline -->
                        <div class="col-md-4">
                            <div class="checkbox checkbox-css checkbox-inline">
                                <input type="checkbox" id="iArbolProblemas"  />
                                <label for="iArbolProblemas">Árbol de problemas</label>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="checkbox checkbox-css checkbox-inline">
                                <input type="checkbox" id="iCalculoCobertura"  />
                                <label for="iCalculoCobertura">Cálculo de la cobertura</label>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="checkbox checkbox-css checkbox-inline">
                                <input type="checkbox" id="iManualProceso"  />
                                <label for="iManualProceso">Manual de procesos</label>
                            </div>
                        </div>
                    </div>


                    <div class="row" style="padding-bottom: 10px">
                        <!-- inline -->
                        <div class="col-md-4">
                            <div class="checkbox checkbox-css checkbox-inline">
                                <input type="checkbox" id="iArbolObjetivos"  />
                                <label for="iArbolObjetivos">Árbol de objetivos</label>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="checkbox checkbox-css checkbox-inline">
                                <input type="checkbox" id="iCriteriosFocalizacion"  />
                                <label for="iCriteriosFocalizacion">Críterios de focalización</label>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="checkbox checkbox-css checkbox-inline">
                                <input type="checkbox" id="iReglasOperacion"  />
                                <label for="iReglasOperacion">Reglas de operación</label>
                            </div>
                        </div>
                    </div>
                    

                    <div class="row" style="padding-bottom: 10px">
                        <!-- inline -->
                        <div class="col-md-4">
                            <div class="checkbox checkbox-css checkbox-inline">
                                <input type="checkbox" id="iMIR"  />
                                <label for="iMIR">MIR</label>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="checkbox checkbox-css checkbox-inline">
                                <input type="checkbox" id="iDescripcionIntervencion"  />
                                <label for="iDescripcionIntervencion">Descripción de la intervención</label>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="checkbox checkbox-css checkbox-inline">
                                <input type="checkbox" id="iPadronBeneficiarios"  />
                                <label for="iPadronBeneficiarios">Padrón de beneficiarios</label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="row" style="padding-bottom: 10px">
                        <div class="col-md-4">
                            <label for="iPreviamenteEvaluado" class="col-form-label text-md-left">¿La intervención ha sido evaluada previamente?</label>
                        </div>
                        <div class="col-md-2">
                            <select name="iPreviamenteEvaluado" id="iPreviamenteEvaluado" class="form-control">
                                <option value="">Seleccionar</option>
                                <option value="1">Sí</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="row" style="padding-bottom: 10px">
                        <div class="col-md-4">
                            <label for="" class="col-form-label text-md-left">Seleccione el tipo de evaluación que se le aplicó</label>
                        </div>
                        <div class="col-md-4">
                            <select name="" id="" class="form-control">
                            <option value="">Seleccionar</option>
                                <option value="1">Sí</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>

                    <div class="row" style="padding-bottom: 10px">
                        <div class="col-md-4">
                            <label for="vComentario" class="col-form-label text-md-center">Comentarios adicionales</label>
                        </div>
                        <div class="col-md-8">
                            <textarea name="vComentarios" id="vComentarios" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <!-- Termina parte 3 -->
							</fieldset>
							<!-- end fieldset -->
						</div>
						<!-- end step-3 -->
						<!-- begin step-4 -->
						<div id="step-4">
							<div class="jumbotron m-b-0 text-center">
								<h2 class="text-inverse">Register Successfully</h2>
								<p class="m-b-30 f-s-16">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris consequat commodo porttitor. <br />Vivamus eleifend, arcu in tincidunt semper, lorem odio molestie lacus, sed malesuada est lacus ac ligula. Aliquam bibendum felis id purus ullamcorper, quis luctus leo sollicitudin. </p>
								<p><a href="#" class="btn btn-primary btn-lg">Proceed to User Profile</a></p>
							</div>
						</div>
						<!-- end step-4 -->
					</div>
					<!-- end wizard-content -->
				</div>
				<!-- end wizard -->
			</form>
            <!-- end wizard-form -->
            
        <script src="<?=base_url();?>admin/assets/plugins/parsley/dist/parsley.js"></script>
	    <script src="<?=base_url();?>admin/assets/plugins/jquery-smart-wizard/src/js/jquery.smartWizard.js"></script>
        <script src="<?=base_url();?>admin/assets/js/demo/form-wizards-validation.demo.min.js"></script>
    
    <script>
		$(document).ready(function() {
			FormWizardValidation.init();
		});
    </script>
                </div>
			</div>
			<!-- end panel -->
		</div>
        <!-- end #content -->