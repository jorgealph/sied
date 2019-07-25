<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class C_evaluacion extends CI_Controller{

    public function __construct(){
        parent::__construct();
        session_start();
        $this->load->helper('url');
        //$this->load->helper('Funciones');
        $this->load->library('Class_seguridad');
        $this->load->model('M_seguridad','ms');
    }

    public function display(){
        $this->load->model('M_evaluacion', 'me');
        $this->load->model('M_plantilla', 'mp');
        $this->load->model('M_intervencionpropuesta', 'mi');
        $data['anio'] = $this->mp->get_anio();
        $data['tipo'] = $this->mp->get_tipo();
        $data['eje'] = $this->mi->ejeQuery(); 
        $this->load->view('evaluacion/index', $data);
    }

    public function getCargo(){
        $cargo = null;
        if(isset($_POST['usuario']) && !empty($_POST['usuario'])){
            $key = $_POST['usuario'];
            $this->load->model('M_evaluacion', 'me');
            $query = $this->me->getCargo($key);
            if(isset($query[0])){
                $cargo = $query[0];
            }
        }
        echo json_encode($cargo);
    }

    public function updateView($key){
        $this->load->model('M_evaluacion', 'me');
        $_SESSION['colaborador'] = null;
        $_SESSION['delete'] = array();
        $_SESSION['instrumento'] = $this->loadInstrumentos($key);
        $data['key'] = $key;
        $data['option'] = $this->getUsuario();
        $data['eva'] = $this->me->findEvaluacion($key)[0];
        $data['instrumento'] = $this->generateOption($this->me->getInstrumento());
        $data['organismo'] = $this->generateOption($this->me->getOrganismo());
        $data['contratacion'] = $this->generateOption($this->me->getTipoContratacion());
        $data['financiamiento'] = $this->generateOption($this->me->getFinanciamiento());
        $this->findColaborador($key);
        
        $this->load->view('evaluacion/viewTabs', $data);
        //$this->load->view('evaluacion/viewUpdate', $data);
    }

    public function repositorio($key){
        $data['key'] = $key;
        $this->load->model('M_evaluacion', 'me');
        $data['eva'] = $this->me->findEvaluacion($key)[0];
        if($_SESSION[PREFIJO.'_idrol'] == 3){
            $organismo = $this->me->buscar_organismo($_SESSION[PREFIJO.'_idusuario']);
            $org = $organismo[0]->iIdOrganismo;
            if (isset($this->me->buscar_corresponsables($key, $org)[0])){
                $vdata = $this->me->buscar_corresponsables($key, $org)[0];
            }else{
                $vdata = array();
            }
        }else{
            $vdata = $data['eva'];
        }
        
        $data['tb'] = $this->subir_documento($vdata);
        $data['co'] = $this->documentos_corresponsables($this->me->corresponsables($key));
        $this->load->view('evaluacion/repositorio', $data);
    }

    public function subir(){
        $this->load->model('M_evaluacion', 'me');
        //Ruta donde se guardan los ficheros
        $key = $_POST['key'];
        $estatus = $_POST['estatus'];
        $colaborador = '';
        if($_SESSION[PREFIJO.'_idrol'] == 3){
            $colaborador = '_'.$_SESSION[PREFIJO.'_idusuario'];
        }
        $config['upload_path'] = './files/cuestionarios/'; 
       //Tipos de ficheros permitidos
        $config['allowed_types'] = 'docx';      
        $config['file_name'] = "Cuestionario_".$key."_".date('YmdHis')."_".$estatus.$colaborador.".docx";      
       //Se pueden configurar aun mas parámetros.
       //Cargamos la librería de subida y le pasamos la configuración
        $this->load->library('upload', $config);
        if(!$this->upload->do_upload()){
            /*Si al subirse hay algún error lo meto en un array para pasárselo a la vista*/
                /*$error=array('error' => $this->upload->display_errors());
                print_r($error);*/
                //echo 0;
                if ($estatus != 2){
                    $data['iEstatusArchivo'] = $estatus;
                    echo $this->me->update($data, $key);
                }else{
                    echo 0;
                }
        }else{
            //Datos del fichero subido
            //$datos["docx"] = $this->upload->data();
            //Cargamos la vista y le pasamos los datos
            $data['vRutaArchivo'] = $config['file_name'];
            $data['dFechaSubida'] = date('Y-m-d H:i:s');
            $data['iEstatusArchivo'] = $estatus;
            
            if($_SESSION[PREFIJO.'_idrol'] == 3){
                $organismo = $this->me->buscar_organismo($_SESSION[PREFIJO.'_idusuario']);
                $org = $organismo[0]->iIdOrganismo;
                if (isset($this->me->buscar_corresponsables($key, $org)[0])){
                    echo $this->me->actualizar_corresponsable($data, $key, $org);
                }else{
                    echo 0;
                }
            } else{
                echo $this->me->update($data, $key);
            }
        }
    }

    public function eliminar_documento(){
        $key = $_POST['key'];
        $this->load->model('M_evaluacion', 'me');
        if($_SESSION[PREFIJO.'_idrol'] == 3){
            $organismo = $this->me->buscar_organismo($_SESSION[PREFIJO.'_idusuario']);
            $org = $organismo[0]->iIdOrganismo;
            $data['vRutaArchivo'] = '';
            $data['iEstatusArchivo'] = 0;
            $data['dFechaSubida'] = '1900-01-01 00:00:00';
            $eva = $this->me->buscar_corresponsables($key, $org)[0];
            unlink('./files/cuestionarios/'.$eva->vRutaArchivo);
            echo $this->me->actualizar_corresponsable($data, $key, $org);
            //echo $this->me->borrar_corresponsable($key, $org);*/
        }else{
            $eva = $this->me->findEvaluacion($key)[0];
            $data['vRutaArchivo'] = '';
            $data['iEstatusArchivo'] = 0;
            $data['dFechaSubida'] = '1900-01-01 00:00:00';
            unlink('./files/cuestionarios/'.$eva->vRutaArchivo);
            echo $this->me->update($data, $key);
        }
    }

    private function subir_documento($eva){
        $tb = "<table class='table'>
                <thead>
                    <tr class='active'>
                        <th>Nombre del documento</th>
                        <th>Fecha de subida</th>
                        <th>Estatus</th>
                        <th width='120px'>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        ".$this->datos_documento($eva)."
                    </tr>
                </tbody>
            </table>";
        return $tb;
    }

    private function datos_documento($eva){
        $tb = '';
        if (!empty($eva->vRutaArchivo)){
            $tb = "<td>$eva->vRutaArchivo</td>
            <td>$eva->dFechaSubida</td>
            <td>".$this->crear_select($eva->iEstatusArchivo)."</td>
            <td><button id='btn' class='btn btn-danger btn-icon btn-sm' onclick='borrar()'><i class='fas fa-trash fa-fw'></i></button></td>";
        }else{
            $tb = "<tr><td valign='top' colspan='4' class='dataTables_empty'>No se encontro documento</td></tr>";
        }
        return $tb;
    }

    private function crear_select($estatus){
        $response = '';
        $activo = 'selected';
        switch ($_SESSION[PREFIJO.'_idrol']) {
            case 1:
                $response = '<select id="estatus" class="form-control">
                                <option value="0"> Versión base </option>
                                <option value="1"> Pendiente revisar organismo </option>
                                <option value="3"> Pendiente atender observaciones </option>
                                <option value="4">Validado para publicación </option>
                                <option value="5">Finalizado </option>
                            </select>';
                break;
            default:
                    $response = $this->obtener_estatus($estatus);
                break;
        }
        return $response;
    }

    private function obtener_estatus($estatus){
        $name = '';
        switch ($estatus) {
            case 0:
                $name = 'Versión base';
                break;
            case 1:
                $name = 'Pendiente revisar organismo';
                break;
                
            case 2:
                $name = 'Pendiente revisar SEPLAN';
                break;
            case 3:
                $name = 'Pendiente atender observaciones';
                break;
            case 4:
                $name = 'Validado para publicación';
                break;
            case 5:
                $name = 'Finalizado';
                break;
        }
        return $name;
    }

    private function documentos_corresponsables($data){
        $tb = '<table id="data-table-default" class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>Organismo a cargo del programa</th>
                    <th>Titular</th>
                    <th>Correo</th>
                    <th>Telefono</th>
                    <th>Fecha de subida</th>
                    <th width="100px">Documento</th>
                </tr>
            </thead>
            <tbody>';
            
        foreach($data as $r){
            $tb .= '<tr>
                    <td>'.$r->vSiglas.'</td>
                    <td>'.$r->vNombreTitular.'</td>
                    <td>'.$r->vCorreoContacto.'</td>
                    <td>'.$r->vTelefonoContacto.'</td>
                    <td>';
                    if ($r->dFechaSubida != '1900-01-01 00:00:00'){
                        $tb .= $r->dFechaSubida;
                    }
                    $tb .= '
                    </td>
                    <td>';
                    if(!empty($r->vRutaArchivo)){
                        $tb .=  '<a href="'.base_url().'files/cuestionarios/'.$r->vRutaArchivo.'" download="'.$r->vRutaArchivo.'">Descargar</a>';
                    }
                   $tb .= '</td>
            </tr>';
        }   

        $tb .=  '</tbody>
        </table>';
        return $tb;
    }

    private function prepareDelete($tmp){
        $existe = false;
        if(isset($_SESSION['delete']) && !empty($_SESSION['delete'])){
            $data = $_SESSION['delete'];
        }else{
            $data = array();
        }

        foreach ($data as $r){
            if($r->iIdUsuario == $tmp->iIdUsuario){
                $existe = true;
                break;
            }
        }

        if($existe == false){
            $data[] = $tmp;
        }
        
        $_SESSION['delete'] = $data;
    }

    private function loadInstrumentos($key){
        $data = $this->me->allInstrumentos($key);
        foreach ($data as $r){
            $r->iActivo = 1;
        }
        return $data;
    }

    public function updateContratacion(){
        $this->load->model('M_evaluacion', 'me');
        $key = $_POST['key'];
        if(!is_null($key)){
            $data['iIdTipoContratacion'] = $_POST['contratacion'];
            if(isset($_POST['esp'])){
                $data['vEspecificarContratacion'] = $_POST['esp'];
            }
            $data['iIdResponsableContratacion'] = $_POST['dependencia'];
            $data['nCostoEvaluacion'] = $_POST['costo'];
            $data['iIdFinanciamiento'] = $_POST['financiamiento'];
            $result = $this->me->update($data, $key);
        }
        echo json_encode($result);
    }

    public function updateSeguimiento(){
        $key = $_POST['key'];
        $result = 0;
        if(!is_null($key)){
            $this->load->model('M_evaluacion', 'me');
            $data['iEnvioOficio'] = $_POST['iEnvioOficio'];
            $data['iInformacionCompleta'] = $_POST['iInformacionCompleta'];
            
            if (!empty($_POST['dRecepcionOficio']) && !is_null($_POST['dRecepcionOficio']) && $this->validateDate($_POST['dRecepcionOficio']) == true){
                $data['dRecepcionOficio'] = $this->formatDate($_POST['dRecepcionOficio']);
            }
            if (!empty($_POST['dEntregaInformacion']) && !is_null($_POST['dEntregaInformacion']) && $this->validateDate($_POST['dEntregaInformacion']) == true){
                $data['dEntregaInformacion'] = $this->formatDate($_POST['dEntregaInformacion']);
            }
            if (!empty($_POST['dReunionPresentacion']) && !is_null($_POST['dReunionPresentacion']) && $this->validateDate($_POST['dReunionPresentacion']) == true){
                $data['dReunionPresentacion'] = $this->formatDate($_POST['dReunionPresentacion']);
            }
            if (!empty($_POST['dInicioRealizacion']) && !is_null($_POST['dInicioRealizacion']) && $this->validateDate($_POST['dInicioRealizacion']) == true){
                $data['dInicioRealizacion'] = $this->formatDate($_POST['dInicioRealizacion']);
            }
            if (!empty($_POST['dEntregaBorrador']) && !is_null($_POST['dEntregaBorrador']) && $this->validateDate($_POST['dEntregaBorrador']) == true){
                $data['dEntregaBorrador'] = $this->formatDate($_POST['dEntregaBorrador']);
            }
            if (!empty($_POST['dPresentacionBorrador']) && !is_null($_POST['dPresentacionBorrador']) && $this->validateDate($_POST['dPresentacionBorrador']) == true){
                $data['dPresentacionBorrador'] = $this->formatDate($_POST['dPresentacionBorrador']);
            }
            if (!empty($_POST['dPresentacionFinal']) && !is_null($_POST['dPresentacionFinal']) && $this->validateDate($_POST['dPresentacionFinal']) == true){
                $data['dPresentacionFinal'] = $this->formatDate($_POST['dPresentacionFinal']);
            }
            if (!empty($_POST['dEnvioVersionFinalDig']) && !is_null($_POST['dEnvioVersionFinalDig']) && $this->validateDate($_POST['dEnvioVersionFinalDig']) == true){
                $data['dEnvioVersionFinalDig'] = $this->formatDate($_POST['dEnvioVersionFinalDig']);
            }            
            if (!empty($_POST['dEntregaVersionImp']) && !is_null($_POST['dEntregaVersionImp']) && $this->validateDate($_POST['dEntregaVersionImp']) == true){
                $data['dEntregaVersionImp'] = $this->formatDate($_POST['dEntregaVersionImp']);
            }
            if (!empty($_POST['dFinEvaluadores']) && !is_null($_POST['dFinEvaluadores']) && $this->validateDate($_POST['dFinEvaluadores']) == true){
                $data['dFinEvaluadores'] = $this->formatDate($_POST['dFinEvaluadores']);
            }
            
            if (!empty($_POST['dEntregaInformeFinal']) && !is_null($_POST['dEntregaInformeFinal']) && $this->validateDate($_POST['dEntregaInformeFinal']) == true){
                $data['dEntregaInformeFinal'] = $this->formatDate($_POST['dEntregaInformeFinal']);
            }
            
            if (!empty($_POST['dPublicacion']) && !is_null($_POST['dPublicacion']) && $this->validateDate($_POST['dPublicacion']) == true){
                $data['dPublicacion'] = $this->formatDate($_POST['dPublicacion']);
            }
            if (!empty($_POST['dEntregaDocOpinion']) && !is_null($_POST['dEntregaDocOpinion']) && $this->validateDate($_POST['dEntregaDocOpinion']) == true){
                $data['dEntregaDocOpinion'] = $this->formatDate($_POST['dEntregaDocOpinion']);
            }
            if (!empty($_POST['dEntregaDocTrabajo']) && !is_null($_POST['dEntregaDocTrabajo']) && $this->validateDate($_POST['dEntregaDocTrabajo']) == true){
                $data['dEntregaDocTrabajo'] = $this->formatDate($_POST['dEntregaDocTrabajo']);
            }
            if (!empty($_POST['dPublicacionDocOpininTrabajo']) && !is_null($_POST['dPublicacionDocOpininTrabajo']) && $this->validateDate($_POST['dPublicacionDocOpininTrabajo']) == true){
                $data['dPublicacionDocOpininTrabajo'] = $this->formatDate($_POST['dPublicacionDocOpininTrabajo']);
            }
            $result = $this->me->update($data, $key);
        }
        echo json_encode($result);
    }
    public function updateDescripcion(){
        $this->load->model('M_evaluacion', 'me');
        $key = $_POST['key'];
        $result = [];
        $_count = 0;
        $count = 0;
        if(!is_null($key) && $this->validateDate($_POST['dinicio']) === true &&  $this->validateDate($_POST['dfin']) === true){
            $data['vNombreEvaluacion'] = $_POST['nombre'];
            $data['iIdResponsableSeguimiento'] = $_POST['responsable'];
            $data['dFechaInicio'] = $this->formatDate($_POST['dinicio']);
            $data['dFechaFin'] = $this->formatDate($_POST['dfin']);
            $data['vObjetivo'] = $_POST['objetivo'];
            $data['vObjetivoEspecifico'] = $_POST['especifico'];
            $data['vTecnicasModelos'] = $_POST['descripcion'];
            $result['descripcion'] = $this->me->update($data, $key);
            $data = [];
            if (!is_null($_SESSION['instrumento'])){
                $vdata = $_SESSION['instrumento'];
                foreach ($vdata as $r){
                    if ($r->iActivo === 1){
                        $data['iIdEvaluacion'] = $key;
                        $data['iIdInstrumento'] = $r->iIdInstrumento;
                        $data['vOtro'] = $r->vOtro;
                        $add = $this->me->addInstrumento($data);
                        if ($add > 0){
                            $_count += 1;
                        }
                        $result['instrumento-agregado'] = $_count;
                    }else{
                        $count += $this->me->deleteIntrumento($r->iIdInstrumento, $key);
                        $result['eliminados'] = $count;
                    }
                }
            }
        }else{
            $result['descripcion'] = 0;
        }

        echo json_encode($result);
    }

    public function agregarInstrumento(){
        $data = array();
        $result = 0;
        $existe = false;
        $key = $_POST['key'];
        if (!is_null($_SESSION['instrumento'])){
            $data = $_SESSION['instrumento'];
        }
        if (isset($_POST['key'])){
            foreach ($data as $r){
                if ($r->iIdInstrumento == $key){
                    $existe = true;
                    if ($r->iActivo == 1){
                        $result = 0;
                        break;
                    }else{
                        $r->iActivo = 1;
                        $result = 1;
                        if($r->iIdInstrumento == 4){
                            $r->vOtro = $_POST['content'];
                        }
                        break;
                    }
                }
            }
            if ($existe === false){
                $this->load->model('M_evaluacion', 'me');
                $instrumento = $this->me->filterInstrumento($key);
                if(isset($instrumento[0])){
                    $instrumento = $instrumento[0];
                    if(isset($_POST['content'])){
                        $instrumento->vOtro = $_POST['content'];
                    }else{
                        $instrumento->vOtro = null;
                    }
                    $instrumento->iActivo = 1;
                    $data[] = $instrumento;
                    $result = 1;
                }
            }
        }
        echo json_encode($result);
        $_SESSION['instrumento'] = $data;
    }
    
    public function addColaborador(){
        $data = array();
        //$_SESSION['colaborador'] = $data;
        $key = null;
        if (isset($_SESSION['colaborador']) && !empty($_SESSION['colaborador'])){
            $data = $_SESSION['colaborador'];
        }else{
            $_SESSION['colaborador'] = $data;
        }

        if (isset($_POST['key']) && !empty($_POST['key'])){
            $key = $_POST['key'];
            $this->load->model('M_evaluacion', 'me');
            if($this->findRecord($key) == false){
                $data[] = $this->me->getUsuario($key)[0];
                echo 1;
            }else{
                echo 0;
            }
        }
        $_SESSION['colaborador'] = $data;
    }

    private function findRecord($key){
        $data = $_SESSION['colaborador'];
        $existe = false;
        foreach($data as $r){
            if($r->iIdUsuario == $key){
                $existe = true;
                break;
            }
        }
        return $existe;
    }

    public function updateCoordinador(){
        $key = $_POST['key'];
        $response = array();

        if(!is_null($key)){
            $data['iIdUsuario'] = $_POST['evaluador'];
            $this->load->model('M_evaluacion', 'me');
            $result = $this->me->update($data, $key);
            $response['result'] = $result;
        }
        $vdata = $_SESSION['colaborador'];
        if (!empty($vdata)){
            $tmp = $this->saveColaborador($key);
            if(isset($tmp['usr'])){
                $response['usr'] = $tmp['usr'];
            }
            if(isset($tmp['msg'])){
                $response['msg'] = $tmp['msg'];
            }
        }

        $response['supr'] = $this->delete($key);

        echo json_encode($response);
    }

    private function validateDate($date, $format = 'd/m/Y'){
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }

    private function formatDate($date){
        $fecha = explode('/', $date);
        $date = $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
        return $date;
    }

    public function drawTable(){
        $this->load->model('M_evaluacion', 'me');
        $data = array();

        if ($_SESSION[PREFIJO.'_idrol'] == 2){
            $data['iIdUsuario'] = $_SESSION[PREFIJO.'_idusuario'];
        }

        if ($_SESSION[PREFIJO.'_idrol'] == 3){
            $org = $this->me->buscar_organismo($_SESSION[PREFIJO.'_idusuario']);
        }

        if(isset($_POST) && !empty($_POST)){
            $data = $this->validatePostData($_POST);
            if ($_SESSION[PREFIJO.'_idrol'] == 2){
                $data['iIdUsuario'] = $_SESSION[PREFIJO.'_idusuario'];
            }

            if ($_SESSION[PREFIJO.'_idrol'] == 3){
                $data['corresponsable'] = $org[0]->iIdOrganismo;
            }
            $tb = $this->generateTable($this->me->displayjoin($data));
        }else{
            if ($_SESSION[PREFIJO.'_idrol'] == 3){
                $data['corresponsable'] = $org[0]->iIdOrganismo;
            }
            $tb = $this->generateTable($this->me->displayjoin($data));
        }
        echo $tb; 
    }

    private function validatePostData($post){
        $data = array();
        if(isset($post['iAnioEvaluacion']) && !empty($post['iAnioEvaluacion'])){
            $data['iAnioEvaluacion'] = $post['iAnioEvaluacion'];
        }
        if(isset($post['iOrigenEvaluacion']) && !empty($post['iOrigenEvaluacion'])){
            $data['iOrigenEvaluacion'] = $post['iOrigenEvaluacion'];
        }
        if(isset($post['iIdTipoEvaluacion']) && !empty($post['iIdTipoEvaluacion'])){
            $data['iIdTipoEvaluacion'] = $post['iIdTipoEvaluacion'];
        }
        if(isset($post['iIdEje']) && !empty($post['iIdEje'])){
            $data['iIdEje'] = $post['iIdEje'];
        }
        if(isset($post['iIdOrganismo']) && !empty($post['iIdOrganismo'])){
            $data['iIdOrganismo'] = $post['iIdOrganismo'];
        }
        if(isset($post['iTipo']) && !empty($post['iTipo'])){
            $data['iTipo'] = $post['iTipo'];
        }
        if(isset($post['vIntervencion']) && !empty($post['vIntervencion'])){
            $data['vIntervencion'] = $post['vIntervencion'];
        }
        return $data;
    }

    public function drawColaborador(){
        echo $this->tableColaborador();
    }

    public function drawInstrumento(){
        echo $this->tableInstrumento();
    }

    private function generateTable($data){
        $tb = '<!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        </div>
                        <h4 class="panel-title">Resultados de la búsqueda</h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">';
        $tb .= '<table id="data-table-default" class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>Tipo de intervención pública</th>
                    <th>Nombre de la intervención pública</th>
                    <th>Dependencia responsable</th>
                    <th>Origen de la evaluación</th>
                    <th>Tipo de evaluación</th>
                    <th width="150px">Acciones</th>
                </tr>
            </thead>
            <tbody>
                '.$this->generateTableContent($data).'
            </tbody>
        </table>';
        $tb .= '		</div>
                    </div>
                </div>
                <!-- end panel -->';
        $document = '<script>
            $(document).ready(function() {
                TableManageDefault.init();
            });
        </script>';
        return $tb.$document;   
    }

    private function generateOption($data){
        $option = '';
        foreach ($data as $r){
            $option .= "<option value='$r->id'>$r->valor</option>";
        }
        return $option;
    }

    public function removeColaborador(){
        $data = $_SESSION['colaborador'];
        if (isset($_POST['key']) && !empty($_POST['key'])){
            $key = $_POST['key'];
            $c = 0;
            foreach ($data as $r){
                if($r->iIdUsuario == $key){
                    $this->prepareDelete($data[$c]);
                    unset($data[$c]);
                    echo 1;
                    break;
                }
            }
        }
        $_SESSION['colaborador'] = $data;
    }

    

    private function delete($key){
        $this->load->model('M_evaluacion', 'me');
        $founded = false;
        $result = array();
        $data = $_SESSION['delete'];
        $vdata = $_SESSION['colaborador'];
        foreach($data as $r){ 
            foreach ($vdata as $vr){
                if ($r->iIdUsuario == $vr->iIdUsuario){
                    $founded = true;
                    break;
                }
            }
            if($founded == false){
                $response = $this->me->deleteColaborador($r->iIdUsuario, $key);
                if($response > 0){
                    $result[] = array('usuario' => $r->vNombres.' '.$r->vApellidoPaterno.' '.$r->vApellidoMaterno);
                }
            }else{
                $founded = false;
            }
        }
        return $result;
    }

    private function getUsuario(){
        $this->load->model('M_evaluacion', 'me');
        $data = $this->me->getUsuario();
        $option = null;
        foreach($data as $r){
            $option .= '<option value="'.$r->iIdUsuario.'">'.$r->vNombres.' '.$r->vApellidoPaterno.' '.$r->vApellidoMaterno.'</option>';
        }
        return $option;
    }

    private function tableInstrumento(){
        $tb = '';
        $tb = '<table id="data-table-default" class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>Instrumento</th>
                    <th>Otro específica</th>
                    <th width="120px">Acciones</th>
                </tr>
            </thead>
            <tbody>
                '.$this->generateInstrumentoContent().'
            </tbody>
        </table>';
        $document = '<script>
            $(document).ready(function() {
                TableManageDefault.init();
            });
        </script>';
        return $tb;  
    }
    
    private function generateTableContent($data){
        $tb = '';
        foreach ($data as $r){
            $tb .= '<tr>';
                $tb .= '<td>'.$this->gettipo($r->iTipo).'</td>';
                $tb .= '<td>'.$r->vIntervencion.'</td>';
                $tb .= '<td>'.$r->vOrganismo.'</td>';
                $tb .= '<td>'.$this->getOrigen($r->iOrigenEvaluacion).'</td>';
                $tb .= '<td>'.$r->vTipoEvaluacion.'</td>';
                $tb .= '<td>';
                    $tb .= '<button onclick="cargar(\'ver/evaluacion/'.$r->iIdEvaluacion.'\', \'#contenido\')" class="btn btn-default btn-icon btn-sm" data-toggle="tooltip" data-placement="top" title="Seguimiento de la evaluación"><i class="fas fa-edit fa-fw"></i></button>&nbsp;';
                    $tb .= '<button onclick="cargar(\'ver/repositorio/'.$r->iIdEvaluacion.'\', \'#contenido\')" class="btn btn-default btn-icon btn-sm" data-toggle="tooltip" data-placement="top" title="Repositorio de documentos"><i class="fas fa-file-word fa-fw"></i></button>&nbsp;';
                    $tb .= '<button onclick="" class="btn btn-default btn-icon btn-sm" data-toggle="tooltip" data-placement="top" title="Documento de evaluación"><i class="fas fa-file fa-fw"></i></button>&nbsp;';
                    $tb .= '<button onclick="" class="btn btn-primary btn-icon btn-sm" data-toggle="tooltip" data-placement="top" title="Documento de opinión"><i class="fas fa-comments fa-fw"></i></button>&nbsp;';
                    $tb .= '<button onclick="" class="btn btn-primary btn-icon btn-sm" data-toggle="tooltip" data-placement="top" title="Descargar el documento de opinión"><i class="fas fa-copy fa-fw"></i></button>&nbsp;';
                    $tb .= '<button onclick="" class="btn btn-default btn-icon btn-sm" data-toggle="tooltip" data-placement="top" title="Bitácora digital"><i class="fas fa-paperclip fa-fw"></i></button>';
                $tb .= '</td>';
            $tb .= '</tr>';
        }
        return $tb;
    }

    private function gettipo($key){
        $origen = null;
        switch ($key) {
            case 1:
                $origen = 'Programa presupuestario';
                break;
            case 2:
                $origen = 'Fondo';
                break;
            case 3:
                $origen = 'Programa de bienes o servicios';
                break;
        }
        return $origen;
    }

    private function getOrigen($key){
        $origen = null;
        switch ($key) {
            case 1:
                $origen = 'Externa';
                break;
            case 2:
                $origen = 'Interna';
                break;
        }
        return $origen;
    }

    private function tableColaborador(){
        $tb = '';
        $tb = '<table id="data-table-default" class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>Nombre completo</th>
                    <th>Cargo</th>
                    <th>Organismo</th>
                    <th>Correo</th>
                    <th>Telefono</th>
                    <th width="120px">Acciones</th>
                </tr>
            </thead>
            <tbody>
                '.$this->generateColaboradorContent().'
            </tbody>
        </table>';
        $document = '<script>
            $(document).ready(function() {
                TableManageDefault.init();
            });
        </script>';
        return $tb;  
    }

    private function findColaborador($key){
        $this->load->model('M_evaluacion', 'me');
        $query = $this->me->findColaborador($key);
        $data = array();
        foreach ($query as $r){
            $tmp = $this->me->getUsuario($r->iIdUsuario);
            if(isset($tmp[0])){
                $data[] = $tmp[0];
            }
        }
        $_SESSION['colaborador'] = $data;
    }

    private function generateColaboradorContent(){
        $tb = '';
        $data = array();
        if (isset($_SESSION['colaborador']) && !empty($_SESSION['colaborador'])){
            $data = $_SESSION['colaborador'];
            foreach ($data as $r){
                $tb .= '<tr>';
                    $tb .= '<td>'.$r->vNombres.' '.$r->vApellidoPaterno.' '.$r->vApellidoMaterno.'</td>';
                    $tb .= '<td>'.$r->vCargo.'</td>';
                    $tb .= '<td>'.$r->vOrganismo.'</td>';
                    $tb .= '<td>'.$r->vCorreo1.'</td>';
                    $tb .= '<td>'.$r->vTelefono.'</td>';
                    $tb .= '<td>';
                        $tb .= '<button onclick="removeColaborador(\''.$r->iIdUsuario.'\')" class="btn btn-danger btn-icon btn-sm" type="button"><i class="fas fa-trash fa-fw"></i></button>';
                    $tb .= '</td>';
                $tb .= '</tr>';
            }
        }else{
            $tb .= "<tr><td valign='top' colspan='6' class='dataTables_empty'>No se encontron registros</td></tr>";
        }
        return $tb;
    }

    public function removeInstrumento(){
        $data = array();
        $result = 0;
        $key = $_POST['key'];
        if (isset($_SESSION['instrumento']) && !empty($_SESSION['instrumento'])){
            $data = $_SESSION['instrumento'];
            foreach ($data as $r){
                if ($r->iIdInstrumento == $key){
                    $r->iActivo = 0;
                    $result = 1;
                    break;
                }
            }
        }
        echo json_encode($result);
    }

    private function generateInstrumentoContent(){
        $tb = '';
        $empty = true;
        $data = array();
        if (isset($_SESSION['instrumento']) && !empty($_SESSION['instrumento'])){
            $data = $_SESSION['instrumento'];
            foreach ($data as $r){
                if($r->iActivo === 1){
                    $tb .= '<tr>';
                        $tb .= '<td>'.$r->vInstrumento.'</td>';
                        $tb .= '<td>'.$r->vOtro.'</td>';
                        $tb .= '<td>';
                            $tb .= '<button onclick="revoveInstrumento(\''.$r->iIdInstrumento.'\')" type="button" class="btn btn-danger btn-icon btn-sm"><i class="fas fa-trash fa-fw"></i></button>';
                        $tb .= '</td>';
                    $tb .= '</tr>';
                    $empty = false;
                }
            }
        }
        if($empty == true){
            $tb .= "<tr><td valign='top' colspan='6' class='dataTables_empty'>No se encontron registros</td></tr>";
        }
        return $tb;
    }

    public function saveColaborador($key){
        $this->load->model('M_evaluacion', 'me');
        $data = $_SESSION['colaborador'];
        $result = array();
        foreach($data as $r){
            $tmp = array('iIdEvaluacion' => $key, 'iIdUsuario' => $r->iIdUsuario);
            $response = $this->me->addColaborador($tmp);
            if($response < 1){
                $result['msg'][] = array('usuario' => $r->vNombres.' '.$r->vApellidoPaterno.' '.$r->vApellidoMaterno);
            }else{
                $result['usr'][] = array('usuario' => $r->vNombres.' '.$r->vApellidoPaterno.' '.$r->vApellidoMaterno);
            }
        }
        return $result;
    }
}