            <style>
                .custom-file-label::after{
                    content: "Subir";
                }
            </style>
            <link href="<?=base_url()?>admin/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
            <link href="<?=base_url()?>admin/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css" rel="stylesheet" />
            <link href="<?=base_url()?>admin/assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
            <!-- begin breadcrumb -->
			<a onclick="cargar('ver/evaluacion', '#contenido')" class="btn btn-default pull-right">
                <li class="fas fa-lg fa-fw m-r-10 fa-arrow-left"></li><span>Regresar</span>
            </a>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Edición <!--<small>header small text goes here...</small>--></h1>
            <!-- end page-header -->
            
            <!-- begin panel -->
			<div class="panel panel-inverse panel-with-tabs" data-sortable-id="ui-unlimited-tabs-1">
                <!-- begin panel-heading -->
                <div class="panel-heading p-0">
                    <div class="panel-heading-btn m-r-10 m-t-10">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    </div>
                    <!-- begin nav-tabs -->
                    <div class="tab-overflow">
                        <ul class="nav nav-tabs nav-tabs-inverse">
                            <li class="nav-item prev-button"><a href="javascript:;" data-click="prev-tab" class="nav-link text-success"><i class="fa fa-arrow-left"></i></a></li>
                            <li class="nav-item"><a href="#tab-1" data-toggle="tab" class="nav-link active">Pestaña 1</a></li>
                            <li class="nav-item"><a href="#tab-2" data-toggle="tab" class="nav-link">Pestaña 2</a></li>
                            <li class="nav-item"><a href="#tab-3" data-toggle="tab" class="nav-link">Pestaña 3</a></li>
                            <li class="nav-item"><a href="#tab-4" data-toggle="tab" class="nav-link">Pestaña 4</a></li>
                            <li class="nav-item"><a href="#tab-5" data-toggle="tab" class="nav-link">Pestaña 5</a></li>
                            <li class="nav-item next-button"><a href="javascript:;" data-click="next-tab" class="nav-link text-success"><i class="fa fa-arrow-right"></i></a></li>
                        </ul>
                    </div>
                    <!-- end nav-tabs -->
                </div>
                <!-- end panel-heading -->
                <!-- begin tab-content -->
                <div class="tab-content">
                    <!-- begin tab-pane -->
                    <div class="tab-pane fade active show" id="tab-1">
                        <!-- begin panel -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                </div>
                                <h4 class="panel-title">Descripción de la evaluación</h4>
                            </div>
                            <div class="panel-body">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label for="nombre"> <span class="text-danger">*</span> Nombre de la evaluacion:</label>
                                            <input type="text" name="nombre" id="nombre" class="form-control" value="<?=$eva->vNombreEvaluacion?>" data-parsley-required>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="finicio"> <span class="text-danger">*</span> Inicio de la evaluacion:</label>
                                            <!--data-date-start-date="Date.default"-->
                                            <div class="input-group  date" id="dt1" >
                                                <input type="text" class="form-control" id="finicio" value="<?=date('d/m/Y', strtotime($eva->dFechaInicio));?>">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="ffin"> <span class="text-danger">*</span> Fin de la evaluacion:</label>
                                            <div class="input-group  date" id="dt2">
                                                <input type="text" class="form-control" id="ffin" value="<?=date('d/m/Y', strtotime($eva->dFechaFin));?>">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="padding-top:10px;">
                                        <div class="col-md-4">
                                            <label for="responsable">Responsable del seguimiento</label>
                                            <select class="form-control selectpicker" data-size="10" data-live-search="true" data-style="btn-white" id="responsable" onchange="searchProcedencia()" data-parsley-required>
                                                <option value="">-Seleccione una opción-</option>
                                                <?=$option?>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="org">Organismo de procedencia</label>
                                            <input type="text" class="form-control" id="org" disabled>
                                        </div>
                                    </div>
                                    <div class="row" style="padding-top:10px;">
                                        <div class="col-md-12">
                                            <label for="objetivo">Objetivo general:</label>
                                            <textarea name="objetivo" id="objetivo" cols="30" rows="3" class="form-control"><?=$eva->vObjetivo?></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="row" style="padding-top:10px;">
                                        <div class="col-md-12">
                                            <label for="especifico">Objetivos especifícos:</label>
                                            <textarea name="especifico" id="especifico" cols="30" rows="3" class="form-control"><?=$eva->vObjetivoEspecifico?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end panel -->
                        <!-- begin panel -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                </div>
                                <h4 class="panel-title">Metodología utilizada</h4>
                            </div>
                            <div class="panel-body">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="instrumento">Instrumento de recolección de la información</label>
                                            <select class="form-control" id="instrumento" name="instrumento" onchange="instrumentoEspecificar()">
                                                <option value="">-Seleccione una opción-</option>
                                                <?=$instrumento?>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="especificar">En caso de otro especificar:</label>
                                            <input type="text" class="form-control" id="especificar" name="especificar" disabled>
                                        </div>
                                        <div class="col-md-2">
                                            <button class="btn btn-default form-control" onclick="console.log('hola mundo')" type="button" style="margin-top:25px;">Agregar</button>
                                        </div>
                                    </div>
                                    <div class="row" style="padding-top:10px;">
                                        <div class="col-md-12">
                                            <div class="table-responsive" id="tabla-instrumento"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="descripcion">Descripción de las técnicas y modelos:</label>
                                            <textarea name="descripcion" id="descripcion" cols="30" rows="3" class="form-control" data-parsley-required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end panel -->
                    </div>
                    <!-- end tab-pane -->
                    <!-- begin tab-pane -->
                    <div class="tab-pane" id="tab-2">
                        <!-- begin panel -->
                        <form onsubmit="updateCoordinador(this,event);" id="form-coordinador" name="coordinador">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-heading-btn">
                                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                    </div>
                                    <h4 class="panel-title">Datos de la instancia evaluadora</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="evaluador">Nombre del coordinador de la evaluación</label>
                                                <select class="form-control selectpicker" data-size="10" data-live-search="true" data-style="btn-white" name="evaluador" id="evaluador" onchange="search()" data-parsley-required="true">
                                                    <option value="">-Seleccione una opción-</option>
                                                    <?=$option?>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="">Cargo</label>
                                                <input type="text" class="form-control" id="cargo" disabled>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="">Organismo de procedencia</label>
                                                <input type="text" class="form-control" id="procedencia" disabled>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="">Correo electrónico</label>
                                                <input type="text" class="form-control" id="correo" disabled>
                                            </div>
                                        </div>
                                        <div class="row" style="padding-top:10px;">
                                            <div class="col-md-6">
                                                <label for="">Teléfono</label>
                                                <input type="text" class="form-control" id="tel" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end panel -->
                            <!-- begin panel -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-heading-btn">
                                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                    </div>
                                    <h4 class="panel-title">Principales colaboradores</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="container">
                                        <div class="row" style="padding-top:10px;">
                                            <div class="col-md-4">
                                                <label for="colaborador">Nombre completo:</label>
                                                <select class="form-control selectpicker" data-size="10" data-live-search="true" data-style="btn-white" id="colaborador">
                                                    <option value="">-Seleccione una opción-</option>
                                                    <?=$option?>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <button class="btn btn-success" type="button" style="margin-top:25px;" onclick="addColaborador()">
                                                    <li class="fa fa-lg fa-fw m-r-10 fa-plus"></li>
                                                    <span>Agregar</span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="row" style="padding-top:10px">
                                            <div class="col-md-12">
                                                <div class="table-responsive" id="tabla">
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-4 offset-md-4">
                                                <button class="btn btn-primary form-control" style="margin-top:25px;" type="submit">
                                                    <li class="fa fa-lg fa-fw m-r-10 fa-save"></li>
                                                    <span>Guardar cambios</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- end panel -->
                    </div>
                    <!-- end tab-pane -->
                    <!-- begin tab-pane -->
                    <div class="tab-pane" id="tab-3">
                        <!-- begin panel -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                </div>
                                <h4 class="panel-title">Datos de contratación</h4>
                            </div>
                            <div class="panel-body">
                                <form onsubmit="datosContratacion(this,event);" id="form-contratacion" name="contratacion" data-parsley-validate="">
                                    <div class="container">
                                        <div class="row" style="padding-top:10px">
                                            <div class="col-md-6">
                                                <label for="contratacion">Tipo de contratación:</label>
                                                <select class="form-control" id="contratacion" name="contratacion" data-parsley-required="true" onchange="contratacionEspecificar()">
                                                    <option value="">-Seleccione una opción-</option>
                                                    <?=$contratacion?>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="esp">Especificar:</label>
                                                <input type="text" id="esp" value="<?=$eva->vEspecificarContratacion?>" name="esp" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="row" style="padding-top:10px">
                                            <div class="col-md-12">
                                                <label for="responsable">Dependencia responsable de la contratación:</label>
                                                <select class="form-control" id="dependencia" name="dependencia" data-parsley-required="true">
                                                    <option value="">-Seleccione una opción-</option>
                                                    <?=$organismo?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row" style="padding-top:10px">
                                            <div class="col-md-6">
                                                <label for="costo">Costo total de la evaluación:</label>
                                                <input type="text" class="form-control" id="costo" value="<?=$eva->nCostoEvaluacion?>" name="costo" data-parsley-required="true" data-parsley-type="number"/>
                                                <!-- <div class="input-group">
                                                    
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">MXN</span>
                                                    </div>
                                                </div> -->
                                            </div>
                                            <div class="col-md-6">
                                                <label for="financiamiento">Fuente de financiamiento:</label>
                                                <select class="form-control"  id="financiamiento" name="financiamiento" data-parsley-required="true">
                                                    <option value="">-Seleccione una opción-</option>
                                                    <?=$financiamiento?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row" style="padding-top:10px">
                                            <div class="col-md-4 offset-md-4">
                                                <button class="btn btn-primary form-control" style="margin-top:25px;" type="submit">
                                                    <li class="fa fa-lg fa-fw m-r-10 fa-save"></li>
                                                    <span>Guardar cambios</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="response"></div>
                            </form>
                        </div>
                        <!-- end panel -->
                    </div>
                    <!-- end tab-pane -->
                    <!-- begin tab-pane -->
                    <div class="tab-pane" id="tab-4">
                        <!-- begin panel -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                </div>
                                <h4 class="panel-title">Datos de seguimiento</h4>
                            </div>
                            <div class="panel-body">
                                <form onsubmit="datosSeguimiento(this,event);" id="form-seguimiento" name="seguimiento" data-parsley-validate="">
                                    <div class="container">
                                        <div class="row" style="padding-top:10px;">
                                            <div class="col-md-6">
                                                <label for="iEnvioOficio">¿Envió oficio con la información sólicitada?</label>
                                                <select name="iEnvioOficio" data-parsley-required id="iEnvioOficio" class="form-control">
                                                    <option value="">-Seleccione una opción-</option>
                                                    <option value="1" <?=($eva->iEnvioOficio == 1) ? 'selected' : ''; ?>>Si</option>
                                                    <option value="0" <?=($eva->iEnvioOficio == 0) ? 'selected' : ''; ?>>No</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="dRecepcionOficio">Fecha de recepción del oficio</label>
                                                <div class="input-group  date" id="dt3">
                                                    <input type="text" class="form-control" data-parsley-errors-messages-disabled data-parsley-required name="dRecepcionOficio" id='dRecepcionOficio'  value="<?=date('d/m/Y', strtotime($eva->dRecepcionOficio));?>">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="padding-top:10px;">
                                            <div class="col-md-6">
                                                <label for="dEntregaInformacion">Fecha de entrega de la información</label>
                                                <div class="input-group  date" id="dt4">
                                                    <input type="text" class="form-control" data-parsley-errors-messages-disabled data-parsley-required name="dEntregaInformacion" id='dEntregaInformacion' value="<?=date('d/m/Y', strtotime($eva->dEntregaInformacion));?>">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="iInformacionCompleta">¿La información estaba completa?</label>
                                                <select name="iInformacionCompleta" id="iInformacionCompleta" class="form-control" data-parsley-required>
                                                    <option value="">-Seleccione una opción-</option>
                                                    <option value="1" <?=($eva->iInformacionCompleta == 1) ? 'selected' : ''; ?>>Si</option>
                                                    <option value="0" <?=($eva->iInformacionCompleta == 0) ? 'selected' : ''; ?>>No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row" style="padding-top:10px;">
                                            <div class="col-md-6">
                                                <label for="dReunionPresentacion">Fecha de la reunión inicio de la evaluación y presentación de la solicitud empleada</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="input-group  date" id="dt5">
                                                    <input type="text" class="form-control" data-parsley-errors-messages-disabled data-parsley-required name="dReunionPresentacion" id='dReunionPresentacion' value="<?=date('d/m/Y', strtotime($eva->dReunionPresentacion));?>">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="padding-top:10px;">
                                            <div class="col-md-6">
                                                <label for="dInicioRealizacion">Inicio de la realización de la evaluación por los evaluadores</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="input-group  date" id="dt6">
                                                    <input type="text" data-parsley-errors-messages-disabled data-parsley-required name="dInicioRealizacion" class="form-control" id='dInicioRealizacion' value="<?=date('d/m/Y', strtotime($eva->dInicioRealizacion));?>">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="padding-top:10px;">
                                            <div class="col-md-6">
                                                <label for="dEntregaBorrador">Fecha de entrega del primer borrador</label>
                                                <div class="input-group  date" id="dt7">
                                                    <input type="text" class="form-control" data-parsley-errors-messages-disabled data-parsley-required name="dEntregaBorrador" id='dEntregaBorrador' value="<?=date('d/m/Y', strtotime($eva->dEntregaBorrador));?>">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="dPresentacionBorrador">Presentación del borrador y solicitud de información adicional</label>
                                                <div class="input-group  date" id="dt8">
                                                    <input type="text" class="form-control" data-parsley-errors-messages-disabled data-parsley-required name="dPresentacionBorrador" id='dPresentacionBorrador' value="<?=date('d/m/Y', strtotime($eva->dPresentacionBorrador));?>">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="padding-top:10px;">
                                            <div class="col-md-6">
                                                <label for="dPresentacionFinal">Fecha de la presentación final de la evaluación</label>
                                                <div class="input-group  date" id="dt9">
                                                    <input type="text" class="form-control" data-parsley-errors-messages-disabled data-parsley-required name="dPresentacionFinal" id='dPresentacionFinal' value="<?=date('d/m/Y', strtotime($eva->dPresentacionFinal));?>">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="dEnvioVersionFinalDig">Fecha de envio de la versión final digital</label>
                                                <div class="input-group  date" id="dt10">
                                                    <input type="text" class="form-control" data-parsley-errors-messages-disabled data-parsley-required name="dEnvioVersionFinalDig" id='dEnvioVersionFinalDig' value="<?=date('d/m/Y', strtotime($eva->dEnvioVersionFinalDig));?>">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="padding-top:10px;">
                                            <div class="col-md-6">
                                                <label for="dEntregaVersionImp">Fecha de entrega de la versión impresa</label>
                                                <div class="input-group  date" id="dt11">
                                                    <input type="text" class="form-control" data-parsley-errors-messages-disabled data-parsley-required name="dEntregaVersionImp" id='dEntregaVersionImp' value="<?=date('d/m/Y', strtotime($eva->dEntregaVersionImp));?>">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="padding-top:10px;">
                                            <div class="col-md-6">
                                                <label for="dFinEvaluadores">Fin de la evaluación por parte de los evaluadores</label>
                                                <div class="input-group  date" id="dt12">
                                                    <input type="text" class="form-control" data-parsley-errors-messages-disabled data-parsley-required name="dFinEvaluadores" id='dFinEvaluadores' value="<?=date('d/m/Y', strtotime($eva->dFinEvaluadores));?>">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="padding-top:10px;">
                                            <div class="col-md-6">
                                                <label for="dEntregaInformeFinal">Entrega del informe final de la evaluación</label>
                                                <div class="input-group  date" id="dt13">
                                                    <input type="text" class="form-control" data-parsley-errors-messages-disabled data-parsley-required name="dEntregaInformeFinal" id='dEntregaInformeFinal' value="<?=date('d/m/Y', strtotime($eva->dEntregaInformeFinal));?>">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="padding-top:10px;">
                                            <div class="col-md-6">
                                                <label for="dPublicacion">Publicación de la evaluación</label>
                                                <div class="input-group  date" id="dt14">
                                                    <input type="text" class="form-control" data-parsley-errors-messages-disabled data-parsley-required name="dPublicacion" id='dPublicacion' value="<?=date('d/m/Y', strtotime($eva->dPublicacion));?>">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="padding-top:10px;">
                                            <div class="col-md-6">
                                                <label for="dEntregaDocOpinion">Entrega de documentos de opinión por parte de las dependencias</label>
                                                <div class="input-group  date" id="dt15">
                                                    <input type="text" class="form-control" data-parsley-errors-messages-disabled data-parsley-required name="dEntregaDocOpinion" id='dEntregaDocOpinion' value="<?=date('d/m/Y', strtotime($eva->dEntregaDocOpinion));?>">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="padding-top:10px;">
                                            <div class="col-md-6">
                                                <label for="dEntregaDocTrabajo">Entrega de los documentos 
                                                de trabajo por parte de las dependencias</label>
                                                <div class="input-group  date" id="dt16">
                                                    <input type="text" class="form-control" data-parsley-errors-messages-disabled data-parsley-required name="dEntregaDocTrabajo" id='dEntregaDocTrabajo' value="<?=date('d/m/Y', strtotime($eva->dEntregaDocTrabajo));?>">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="padding-top:10px;">
                                            <div class="col-md-6">
                                                <label for="dPublicacionDocOpininTrabajo">Publicación de los documentos de opinion y de trabajo</label>
                                                <div class="input-group  date" id="dt17">
                                                    <input type="text" class="form-control" data-parsley-errors-messages-disabled data-parsley-required name="dPublicacionDocOpininTrabajo" id='dPublicacionDocOpininTrabajo' value="<?=date('d/m/Y', strtotime($eva->dPublicacionDocOpininTrabajo));?>">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="padding-top:10px;">
                                            <div class="col-md-4 offset-md-4">
                                                <button class="btn btn-primary form-control" style="margin-top:25px;" type="submit">
                                                    <li class="fa fa-lg fa-fw m-r-10 fa-save"></li>
                                                    <span>Guardar cambios</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- end panel -->
                    </div>
                    <!-- end tab-pane -->
                    <!-- begin tab-pane -->
                    <div class="tab-pane" id="tab-5">
                        <!-- begin panel -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                </div>
                                <h4 class="panel-title">Cuestionario de evaluación</h4>
                            </div>
                            <div class="panel-body">
                                <div class="container">
                                    <div class="col-md-6 offset-md-3">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile" lang="es">
                                            <label class="custom-file-label" for="customFile">Seleccionar archivo</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end panel -->
                    </div>
                    <!-- end tab-pane -->
                </div>
                <!-- end tab-content -->
            </div>
			<!-- end panel -->
		</div>
        <div id="test"></div>
        <!-- end #content -->
        <script src="<?=base_url()?>admin/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script src="<?=base_url()?>admin/assets/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js"></script>
        <script src="<?=base_url()?>admin/assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
        <script>
            $( document ).ready(function() {
                
                $(".date").datepicker({
                    weekStart: 1,
                    daysOfWeekHighlighted: "6,0",
                    autoclose: true,
                    todayHighlight: true,
                    language: 'es',
                });
                
                $("#tabla").load('C_evaluacion/drawColaborador');
                $("#tabla-instrumento").load('C_evaluacion/drawInstrumento');

                $('select[id=evaluador]').val(<?=$eva->iIdUsuario?>);
                search();
                $('select[id=responsable]').val(<?=$eva->iIdResponsableSeguimiento?>);
                searchProcedencia();
                $(".selectpicker").selectpicker("render");
                $("#contratacion").val(<?=$eva->iIdTipoContratacion?>);
                $("#dependencia").val(<?=$eva->iIdResponsableContratacion?>);
                $("#financiamiento").val(<?=$eva->iIdFinanciamiento?>);
            });
            function datetime(key){
                $("#dt"+key).datepicker({
                    weekStart: 1,
                    daysOfWeekHighlighted: "6,0",
                    autoclose: true,
                    todayHighlight: true,
                    language: 'es',
                });
            }

            function searchProcedencia(){
                var usuario = $("#responsable").val();
                if(usuario != null && usuario != ''){
                    var formData = new FormData();
                    formData.append('usuario', usuario);
                    var url = 'C_evaluacion/getCargo';
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: formData,
                        async: false,
                        dataType: 'json',
                        success: function(data){
                            if(data != null){
                                $("#org").val(data['vOrganismo']);
                            }
                        },
                        error: function(){
                            notificacion('Error', 'error');
                        },
                        cache:false,
                        contentType: false,
                        processData: false
                    });
                }else{
                    $("#org").val(null);
                }
            }

            function search(){
                var usuario = $("#evaluador").val();
                if(usuario != null && usuario != ''){
                    var formData = new FormData();
                    formData.append('usuario', usuario);
                    var url = 'C_evaluacion/getCargo';
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: formData,
                        async: false,
                        dataType: 'json',
                        success: function(data){
                            if(data != null){
                                $("#cargo").val(data['vCargo']);
                                $("#procedencia").val(data['vOrganismo']);
                                $("#tel").val(data['vTelefono']);
                                $("#correo").val(data['vCorreo1']);
                            }
                        },
                        error: function(){
                            notificacion('Error', 'error');
                        },
                        cache:false,
                        contentType: false,
                        processData: false
                    });
                }else{
                    $("#cargo").val(null);
                    $("#procedencia").val(null);
                    $("#tel").val(null);
                    $("#correo").val(null);
                }
            }
            // Add the following code if you want the name of the file appear on select
            $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });

            function addColaborador(){
                var frmData = new FormData();
                var key = $("#colaborador").val();
                frmData.append('key', key);
                var url = '<?=base_url()?>C_evaluacion/addColaborador';
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: frmData,
                    async: false,
                    success: function(data){
                        if(data == 1){
                            $("#tabla").load('C_evaluacion/drawColaborador');
                            notificacion('Colaborador agregado','success');
                        }else{
                            notificacion('El colaborador ya ha sido agregado','error');
                        }
                    },
                    error: function(){
                        notificacion('Error', 'error');
                    },
                    cache:false,
                    contentType: false,
                    processData: false  
                })
            }
            function removeColaborador(key){
                var frmData = new FormData();
                frmData.append('key', key);
                var url = '<?=base_url()?>C_evaluacion/removeColaborador';
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: frmData,
                    async: false,
                    success: function(data){
                        if(data == 1){
                            $("#tabla").load('<?=base_url()?>C_evaluacion/drawColaborador');
                            notificacion('Colaborador eliminado con exito','success');
                        }else{
                            notificacion('El colaborador ya ha sido eliminado','error');
                        }
                    },
                    error: function(){
                        notificacion('Error', 'error');
                    },
                    cache:false,
                    contentType: false,
                    processData: false  
                })
            }
            function datosContratacion(form, event){
		        event.preventDefault();
                if(validarFormulario(form)){
                    var datos = $(form).serialize(); // convert form to array
                    datos += '&key=<?=$key?>';
                    
                    $.ajax({
                        url: '<?=base_url()?>C_evaluacion/updateContratacion',
                        type: 'POST',
                        data: datos,
                        async: false,
                        dataType: 'json',
                        success: function(data){
                            if(data == 1){
                                notificacion('Datos actualizados','success');
                            }else{
                                notificacion('Ha ocurrido un error','error');
                            }
                            $("#response").html('<pre>'+JSON.stringify(data)+'</pre>');
                        },
                        error: function(){
                            notificacion('Error', 'error');
                        },
                        cache:false,
                        //contentType: 'application/json',
                        processData: false
                    })
                }
            }
            
            function datosSeguimiento(form, event){
		        event.preventDefault();
                if(validarFormulario(form)){
                    var datos = $(form).serialize(); // convert form to array
                    datos += '&key=<?=$key?>';
                    
                    $.ajax({
                        url: '<?=base_url()?>C_evaluacion/updateSeguimiento',
                        type: 'POST',
                        data: datos,
                        async: false,
                        dataType: 'json',
                        success: function(data){
                            if(data == 1){
                                notificacion('Datos actualizados','success');
                            }else{
                                notificacion('Ha ocurrido un error','error');
                            }
                        },
                        error: function(){
                            notificacion('Error', 'error');
                        },
                        cache:false,
                        //contentType: 'application/json',
                        processData: false
                    })
                }
            }
            
            function updateCoordinador(form, event){
                event.preventDefault();
                if(validarFormulario(form)){
                    var datos = $(form).serialize(); // convert form to array
                    datos += '&key=<?=$key?>';
                    console.log(JSON.stringify(datos));
                    $.ajax({
                        url: '<?=base_url()?>C_evaluacion/updateCoordinador',
                        type: 'POST',
                        data: datos,
                        async: false,
                        dataType: 'json',
                        success: function(data){
                            if(data['result'] == 1){
                                notificacion('Se ha actualizado el coordinador de la evaluacion','success');
                            }else{
                                notificacion('No se han podido actualizar los datos','error');
                            }

                            var msg = data['msg'];
                            $.each(msg,function(key, row) {
                                notificacion('No se ha podido agregar a ' + row.usuario + 'como colaborador','error');
                            });

                            var usr = data['usr'];
                            $.each(usr,function(key, row) {
                                notificacion('Se ha agregado a ' + row.usuario + ' como colaborador','success');
                            });

                            var supr = data['supr'];
                            $.each(supr,function(key, row) {
                                notificacion(row.usuario + ' no es más un colaborador','success');
                            }); 
                        },
                        error: function(){
                            notificacion('Error', 'error');
                        },
                        cache:false,
                        //contentType: 'application/json',
                        processData: false
                    })
                }
            }
            function instrumentoEspecificar(){
                var instrumento = $("#instrumento").val();
                if(instrumento != 4){
                    $("#especificar").prop('disabled', true);
                }else{
                    $("#especificar").prop('disabled', false);
                }
            }

            function contratacionEspecificar(){
                var contratacion = $("#contratacion").val();
                if(contratacion != 5){
                    $("#esp").prop('disabled', true);
                }else{
                    $("#esp").prop('disabled', false);
                }
            }
	    </script>